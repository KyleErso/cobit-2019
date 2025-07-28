<?php

namespace App\Http\Controllers\cobit2019;

use App\Models\MstObjective;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MstObjectiveController extends Controller
{
    /**
     * Display a listing of objectives.
     */
    public function index()
    {
        // Fetch all objectives
        // dd("aaa");
        // print_r("index");
        // $objectives = MstObjective::all();
        $objectives = MstObjective::with(['domains',
        'practices',
        'practices.guidances', 
        'policies',
        'SIA'])->get();

        // Return as JSON (you could also pass to a view)
        return response()->json($objectives);
    }

    /**
     * Display the specified objective.
     */
    public function show($id)
    {
        // Find objective by primary key
        $all = MstObjective::all();
        // dd($all->pluck('objective_id')); 
        $objective = MstObjective::with([
        'domains',
        'aligngoals',
        'aligngoals.aligngoalsmetr',
        'entergoals',
        'entergoals.entergoalsmetr',
        'practices',
        'practices.guidances',
        'practices.activities',
        'practices.practicemetr',
        'practices.roles',
        'practices.infoflowinput',
        'practices.infoflowinput.connectedoutputs',
        'practices.infoflowoutput',
        'policies',
        'policies.guidances',
        'skill',
        'skill.guidances',
        'keyculture',
        'keyculture.guidances',
        's_i_a',
        'guidance',
        ])->findOrFail($id);
        $allObjectives = MstObjective::select('objective_id', 'objective')->get();
        // return response()->json($objective);
        return view('cobit2019.objectives.show', compact('objective','allObjectives'));
    }

    /**
     * Store a newly created objective.
     */
    public function store(Request $request)
    {
        // Validate input
        $data = $request->validate([
            'objective_id'          => 'required|string|unique:mst_objective',
            'objective'             => 'required|string',
            'objective_description' => 'nullable|string',
            'objective_purpose'     => 'nullable|string',
        ]);

        // Create new record
        $objective = MstObjective::create($data);

        return response()->json($objective, 201);
    }

    /**
     * Update the specified objective.
     */
    public function update(Request $request, $id)
    {
        $objective = MstObjective::findOrFail($id);

        $data = $request->validate([
            'objective'             => 'sometimes|required|string',
            'objective_description' => 'sometimes|nullable|string',
            'objective_purpose'     => 'sometimes|nullable|string',
        ]);

        $objective->update($data);

        return response()->json($objective);
    }

    /**
     * Remove the specified objective.
     */
    public function destroy($id)
    {
        $objective = MstObjective::findOrFail($id);
        $objective->delete();

        return response()->json(null, 204);
    }
}
