<?php
namespace App\Http\Controllers\cobit2019;

use App\Http\Controllers\Controller;
use App\Models\Assessment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class Step3Controller extends Controller
{
    /**
     * Menampilkan halaman summary untuk Design Factor 5-10
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $assessment = $this->getAssessmentWithRelativeImportances();
        
        if (!$assessment) {
            return $this->handleAssessmentNotFound();
        }

        return $this->renderStep3View($assessment);
    }

    /**
     * Mengambil data assessment beserta relative importances
     *
     * @return Assessment|null
     */
    private function getAssessmentWithRelativeImportances(): ?Assessment
    {
        $assessmentId = session('assessment_id');
        
        if (!$assessmentId) {
            return null;
        }

        return Assessment::with([
            'df5RelativeImportances' => function($query) {
                $query->latest();
            },
            'df6RelativeImportances' => function($query) {
                $query->latest();
            },
            'df7RelativeImportances' => function($query) {
                $query->latest();
            },
            'df8RelativeImportances' => function($query) {
                $query->latest();
            },
            'df9RelativeImportances' => function($query) {
                $query->latest();
            },
            'df10RelativeImportances' => function($query) {
                $query->latest();
            }
        ])->where('assessment_id', $assessmentId)->first();
    }

    /**
     * Menangani kasus ketika assessment tidak ditemukan
     *
     * @return View
     */
    private function handleAssessmentNotFound(): View
    {
        return view('cobit2019.step3.step3sumaryblade')
            ->with('error', 'Data Assessment tidak ditemukan.');
    }

    /**
     * Merender view Step 3 dengan data yang diperlukan
     *
     * @param Assessment $assessment
     * @return View
     */
    private function renderStep3View(Assessment $assessment): View
    {
        $userIds = collect([Auth::id()]);

        return view('cobit2019.step3.step3sumaryblade', [
            'assessment' => $assessment,
            'userIds' => $userIds
        ]);
    }
}