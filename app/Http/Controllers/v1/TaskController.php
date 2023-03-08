<?php

namespace App\Http\Controllers\v1;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    public function index()
    {
        $Tasks = Task::with('project', 'user')->get();
        return response()->json($Tasks);
    }

    public function show(Task $Task)
    {
        return response()->json($Task);
    }

    public function store(Request $request)
    {
        $Task = Task::create($request->all());
        return response()->json($Task, 201);
    }

    public function update(Request $request, Task $Task)
    {
        $Task->update($request->all());
        return response()->json($Task);
    }

    public function destroy(Task $Task)
    {
        $Task->delete();
        return response()->json(null, 204);
    }

    public function taskByUser(Request $request)
    {
        $id = $request->id;
        $Tasks = Task::with('project', 'user')->where('user_id', '=', $id)->get();
        return response()->json($Tasks);
    }
}
