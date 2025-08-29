<?php

namespace App\Services;

use App\Models\MstEval;
use App\Models\TrsActivityeval;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
                foreach ($data['activity_evaluations'] as $activityData) {
                    TrsActivityeval::updateOrCreate(
                        [
                            'eval_id' => $evaluation->eval_id,
                            'activity_id' => $activityData['activity_id']
                        ],
                        [
                            'level_achieved' => $activityData['level_achieved'],
                            'notes' => $activityData['notes'] ?? null
                        ]
                    );
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
                            
                            $activityEvaluations[] = [
                                'activity_id' => $activityId,
                                'level_achieved' => $levelAchieved,
                                'notes' => $notes[$activityId] ?? null
                            ];
                        }
                    }
                }
            }
        } else {
            foreach ($assessmentData as $level => $levelData) {
                if (isset($levelData['activities'])) {
                    foreach ($levelData['activities'] as $activityId => $score) {
                        $levelAchieved = $this->scoreToLetter($score);
                        
                        $activityEvaluations[] = [
                            'activity_id' => $activityId,
                            'level_achieved' => $levelAchieved,
                            'notes' => $levelData['evidence'][$activityId] ?? null
                        ];
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
        return MstEval::create([
            'user_id' => $userId
        ]);
    }

    /**
     * Get an evaluation by ID
     */
    public function getEvaluationById($evalId)
    {
        return MstEval::find($evalId);
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
