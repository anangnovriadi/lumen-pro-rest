<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Checklist;

class ChecklistController extends Controller {
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() 
    {
        $checklist = Checklist::all(); 

        return response()->json([
            'status' => 'success',
            'data' => $checklist
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'type' => 'required',
            'object_id' => 'required',
            'object_domain' => 'required',
            'due' => 'required'
        ]);

        $checklist = Checklist::create([
            'type' => $request->type,
            'object_id' => $request->object_id,
            'object_domain' => $request->object_domain,
            'due' => $request->due,
            'completed_at' => $request->completed_at,
            'updated_by' => $request->updated_by,
            'self' => $request->self,
            'is_completed' => $request->is_completed,
            'description' => $request->description,
            'urgency' => $request->urgency
        ]);

        return response()->json([
            'status' => 'success',
            'result' => $checklist
        ]);
    }

    public function show($id)
    {
        $checklist = Checklist::find($id);

        return response()->json([
            'status' => 'success',
            'result' => $checklist
        ]);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'type' => 'required',
            'object_id' => 'required',
            'object_domain' => 'required',
            'due' => 'required'
        ]);
        
        $checklist = Checklist::find($id);

        $checklist->update([
            'type' => $request->type,
            'object_id' => $request->object_id,
            'object_domain' => $request->object_domain,
            'due' => $request->due,
            'completed_at' => $request->completed_at,
            'updated_by' => $request->updated_by,
            'self' => $request->self,
            'is_completed' => $request->is_completed,
            'description' => $request->description,
            'urgency' => $request->urgency
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Success Update Checklist'
        ]);
    }

    public function delete($id)
    {
        $checklist = Checklist::find($id);
        $checklist->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Success Delete Checklist'
        ]);
    }
}