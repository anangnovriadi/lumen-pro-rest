<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Checklist;
use Carbon\Carbon;

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
            'due_interval' => 'required',
            'due_unit' => 'required'
        ]);

        $checklist = Checklist::create([
            'type' => $request->type,
            'name' => $request->name,
            'object_id' => $request->object_id,
            'object_domain' => $request->object_domain,
            'due_interval' => $request->due_interval,
            'due_unit' => $request->due_unit,
            'completed_at' => $request->completed_at,
            'updated_by' => $request->updated_by,
            'self' => $request->self,
            'is_completed' => $request->is_completed,
            'description' => $request->description,
            'urgency' => $request->urgency,
        ]);
        
        $data = new \stdClass();
        $attr = new \stdClass();
        $checklst = new \stdClass();

        $data->id = $checklist->id;
        $name = $request->name;
        
        $checklst->description = $request->description;
        $checklst->due_interval = $request->due_interval;
        $checklst->due_unit = $request->due_unit;

        $data->attributes = $attr;
        $data->items = [
            'description' => $request->description,
            'urgency' => $checklist->created_at->diffForHumans(),
            'due_interval' => $request->due_interval,
            'due_unit' => $request->due_unit
        ];

        $attr->name = $name;
        $attr->checklist = $checklst;
        
        return response()->json([
            'status' => 'success',
            'data' => $data
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
            'name' => $request->name,
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