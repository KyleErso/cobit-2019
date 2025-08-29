<?php

namespace App\Http\Controllers\AssessmentEval;

use App\Http\Controllers\Controller;
use App\Services\EvaluationService;
use App\Models\MstObjective;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AssessmentEvalController extends Controller
{
    protected $evaluationService;

    public function __construct(EvaluationService $evaluationService)
    {
        $this->evaluationService = $evaluationService;
    }

    /**
     * Display the list of assessments for the current user
     */
    public function listAssessments()
    {
        try {
            $evaluations = $this->evaluationService->getUserEvaluations();
            return view('assessment-eval.list', compact('evaluations'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to load assessments: ' . $e->getMessage()]);
        }
    }

    /**
     * Create a new assessment for the current user
     */
    public function createAssessment()
    {
        try {
            $evaluation = $this->evaluationService->createNewEvaluation(Auth::id());

            // pastikan kita punya identifier untuk redirect (eval_id jika ada, fallback ke primary key)
            $evalId = $evaluation->eval_id ?? $evaluation->{$evaluation->getKeyName()};

            // generate activity evaluations supaya halaman tidak kosong
            if (method_exists($this->evaluationService, 'generateActivityEvaluations')) {
                $this->evaluationService->generateActivityEvaluations($evalId);
            }

            return redirect()->route('assessment-eval.show', ['evalId' => $evalId]);
        } catch (\Exception $e) {
            Log::error("Failed to create assessment", [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->withErrors(['error' => 'Failed to create assessment: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the assessment evaluation page for a specific evaluation
     */
    public function showAssessment($evalId)
    {
        try {
            $evaluation = $this->evaluationService->getEvaluationById($evalId);

            // jangan langsung abort — kirim flag ke view agar frontend menampilkan alert
            $accessDenied = false;
            if (!$evaluation || $evaluation->user_id !== Auth::id()) {
                \Illuminate\Support\Facades\Log::warning('Assessment access issue', [
                    'eval_id' => $evalId,
                    'auth_id' => Auth::id(),
                    'found_evaluation' => $evaluation ? $evaluation->toArray() : null
                ]);
                $accessDenied = true;
            }

            $objectives = MstObjective::with(['practices.activities'])->get();
            return view('assessment-eval.show', compact('objectives', 'evalId', 'evaluation', 'accessDenied'));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Failed to load assessment', [
                'eval_id' => $evalId, 'error' => $e->getMessage()
            ]);
            return redirect()->route('assessment-eval.list')->withErrors(['error' => 'Failed to load assessment: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the assessment evaluation page (legacy support)
     */
    public function index()
    {
        return redirect()->route('assessment-eval.list');
    }

    /**
     * Save assessment data for a specific evaluation
     */
    public function save(Request $request, $evalId)
    {
        try {
            $evaluation = $this->evaluationService->getEvaluationById($evalId);
            
            if (!$evaluation || $evaluation->user_id !== Auth::id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Assessment not found or access denied'
                ], 404);
            }

            $data = $this->evaluationService->convertAssessmentData($request->all());
            $data['user_id'] = Auth::id();
            $data['eval_id'] = $evalId;

            $this->evaluationService->saveEvaluation($data);

            return response()->json([
                'success' => true,
                'message' => 'Assessment saved successfully',
                'eval_id' => $evalId
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to save assessment: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Load assessment data for a specific evaluation
     */
    public function load($evalId)
    {
        try {
            $evaluation = $this->evaluationService->getEvaluationById($evalId);
            
            if (!$evaluation || $evaluation->user_id !== Auth::id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Assessment not found or access denied'
                ], 404);
            }

            $data = $this->evaluationService->loadEvaluation($evalId);
            
            $assessmentData = [];
            $notes = [];
            
            foreach ($data['activity_evaluations'] as $activityId => $activityData) {
                $notes[$activityId] = $activityData['notes'];
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'eval_id' => $data['eval_id'],
                    'assessmentData' => $assessmentData,
                    'notes' => $notes,
                    'activityData' => $data['activity_evaluations']
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to load assessment: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get user's evaluations list
     */
    public function getUserEvaluations()
    {
        try {
            $evaluations = $this->evaluationService->getUserEvaluations();
            
            return response()->json([
                'success' => true,
                'data' => $evaluations
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to get evaluations: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete an evaluation
     */
    public function delete($evalId)
    {
        try {
            $evaluation = $this->evaluationService->getEvaluationById($evalId);
            
            if (!$evaluation || $evaluation->user_id !== Auth::id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Assessment not found or access denied'
                ], 404);
            }
            
            $this->evaluationService->deleteEvaluation($evalId);
            
            return response()->json([
                'success' => true,
                'message' => 'Assessment deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete assessment: ' . $e->getMessage()
            ], 500);
        }
    }
}
