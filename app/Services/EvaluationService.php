<?php

namespace App\Services;

use App\Models\MstEval;
use App\Models\TrsActivityeval;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EvaluationService
{
    /**
     * Save evaluation data from the assessment form
     */
    public function saveEvaluation($data)
    {
        try {
            DB::beginTransaction();

            $evaluation = MstEval::updateOrCreate(
                [
                    'eval_id' => $data['eval_id'] ?? null
                ],
                [
                    'user_id' => $data['user_id'] ?? Auth::id()
                ]
            );

            if (isset($data['activity_evaluations'])) {
                // First, remove all existing activity evaluations for this assessment
                TrsActivityeval::where('eval_id', $evaluation->eval_id)->delete();
                
                foreach ($data['activity_evaluations'] as $activityData) {
                    // Only save activities that are not rated as 'N' (None)
                    if ($activityData['level_achieved'] !== 'N') {
                        TrsActivityeval::create([
                            'eval_id' => $evaluation->eval_id,
                            'activity_id' => $activityData['activity_id'],
                            'level_achieved' => $activityData['level_achieved'],
                            'notes' => $activityData['notes'] ?? null
                        ]);
                    }
                }
            }

            DB::commit();
            return $evaluation;

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Load evaluation data for the assessment form
     */
    public function loadEvaluation($evalId)
    {
        $evaluation = MstEval::with([
            'activityEvaluations.activity.practices.objective'
        ])->findOrFail($evalId);

        $formattedData = [
            'eval_id' => $evaluation->eval_id,
            'user_id' => $evaluation->user_id,
            'created_at' => $evaluation->created_at,
            'updated_at' => $evaluation->updated_at,
            'activity_evaluations' => []
        ];

        foreach ($evaluation->activityEvaluations as $activityEval) {
            $activity = $activityEval->activity;
            $practice = $activity->practices;
            $objective = $practice ? $practice->objective : null;
            
            $formattedData['activity_evaluations'][$activityEval->activity_id] = [
                'activity_id' => $activityEval->activity_id,
                'level_achieved' => $activityEval->level_achieved,
                'notes' => $activityEval->notes,
                'capability_lvl' => $activity->capability_lvl ?? null,
                'objective_id' => $objective ? $objective->objective_id : null
            ];
        }

        return $formattedData;
    }

    /**
     * Convert frontend assessment data to database format
     */
    public function convertAssessmentData($assessmentData)
    {
        $activityEvaluations = [];

        if (isset($assessmentData['assessmentData'])) {
            $levelScores = $assessmentData['assessmentData'];
            $notes = $assessmentData['notes'] ?? [];
            
            foreach ($levelScores as $objectiveId => $levels) {
                foreach ($levels as $level => $levelData) {
                    if (isset($levelData['activities'])) {
                        foreach ($levelData['activities'] as $activityId => $score) {
                            $levelAchieved = $this->scoreToLetter($score);
                            
                            // Only include activities that are not rated as 'N' (None)
                            if ($levelAchieved !== 'N') {
                                $activityEvaluations[] = [
                                    'activity_id' => $activityId,
                                    'level_achieved' => $levelAchieved,
                                    'notes' => $notes[$activityId] ?? null
                                ];
                            }
                        }
                    }
                }
            }
        } else {
            foreach ($assessmentData as $level => $levelData) {
                if (isset($levelData['activities'])) {
                    foreach ($levelData['activities'] as $activityId => $score) {
                        $levelAchieved = $this->scoreToLetter($score);
                        
                        // Only include activities that are not rated as 'N' (None)
                        if ($levelAchieved !== 'N') {
                            $activityEvaluations[] = [
                                'activity_id' => $activityId,
                                'level_achieved' => $levelAchieved,
                                'notes' => $levelData['evidence'][$activityId] ?? null
                            ];
                        }
                    }
                }
            }
        }

        return [
            'activity_evaluations' => $activityEvaluations
        ];
    }

    /**
     * Convert score to letter grade
     */
    private function scoreToLetter($score)
    {
        if ($score > 0.85) return 'F';
        if ($score > 0.50) return 'L';
        if ($score > 0.15) return 'P';
        return 'N';
    }

    /**
     * Convert letter grade to score (for loading data)
     */
    public function letterToScore($letter)
    {
        $scoreMap = [
            'N' => 0.00,
            'P' => 1/3,
            'L' => 2/3,
            'F' => 1.00
        ];
        
        return $scoreMap[$letter] ?? 0.00;
    }

    /**
     * Create a new evaluation for a user
     */
    public function createNewEvaluation($userId)
    {
        try {
            DB::beginTransaction();
            
            $evaluation = MstEval::create([
                'user_id' => $userId
            ]);
            
            DB::commit();

            // refresh model to ensure any DB-generated fields are loaded
            try {
                $evaluation->refresh();
            } catch (\Exception $e) {
                // ignore refresh failures, return created model anyway
            }

            return $evaluation;
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Failed to create new evaluation", [
                'user_id' => $userId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    /**
     * Get an evaluation by ID
     */
    public function getEvaluationById($evalId)
    {
        try {
            return MstEval::where('eval_id', $evalId)->first();
        } catch (\Exception $e) {
            Log::error("Failed to get evaluation by ID", [
                'eval_id' => $evalId,
                'error' => $e->getMessage()
            ]);
            return null;
        }
    }

    /**
     * Get all evaluations for a user
     */
    public function getUserEvaluations($userId = null)
    {
        $userId = $userId ?? Auth::id();
        
        return MstEval::with('activityEvaluations')
            ->where('user_id', $userId)
            ->orderBy('updated_at', 'desc')
            ->get();
    }

    /**
     * Delete an evaluation
     */
    public function deleteEvaluation($evalId)
    {
        try {
            DB::beginTransaction();
            
            $evaluation = MstEval::findOrFail($evalId);
            
            TrsActivityeval::where('eval_id', $evalId)->delete();
            
            $evaluation->delete();
            
            DB::commit();
            return true;
            
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Get basic evaluation statistics
     */
    public function getEvaluationStats($evalId)
    {
        $evaluation = MstEval::with('activityEvaluations')->findOrFail($evalId);
        
        $totalActivities = $evaluation->activityEvaluations->count();
        $achievementCounts = $evaluation->activityEvaluations
            ->groupBy('level_achieved')
            ->map->count();
            
        return [
            'total_activities' => $totalActivities,
            'achievement_distribution' => [
                'N' => $achievementCounts['N'] ?? 0,
                'P' => $achievementCounts['P'] ?? 0,
                'L' => $achievementCounts['L'] ?? 0,
                'F' => $achievementCounts['F'] ?? 0,
            ]
        ];
    }
}
