<?php

namespace App\Http\Controllers\AssessmentEval;

use App\Models\MstObjective;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AssessmentEvalController extends Controller
{
    // Show list of all objectives
    public function index()
    {
        // eager load practices and activities for efficiency
        $objectives = MstObjective::with(['practices.activities'])->get();

        return view('assessment-eval.index', compact('objectives'));
    }
}
