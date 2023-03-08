<?php

namespace App\Http\Controllers\v1;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{

    public function index(Request $request)
    {
        if ($request->input('userRole') !== 'PRODUCT_OWNER') {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $Projects = Project::all();
        return response()->json($Projects);
    }

    public function show(Request $request, Project $Project)
    {
        if ($request->input('userRole') !== 'PRODUCT_OWNER') {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        return response()->json($Project);
    }

    public function store(Request $request)
    {
        if ($request->input('userRole') !== 'PRODUCT_OWNER') {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $Project = Project::create($request->all());
        return response()->json(['result' => 'success']);
    }

    public function update(Request $request, Project $Project)
    {
        if ($request->input('userRole') !== 'PRODUCT_OWNER') {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $Project->update($request->all());
        return response()->json($Project);
    }

    public function destroy(Request $request, Project $Project)
    {
        if ($request->input('userRole') !== 'PRODUCT_OWNER') {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $Project->delete();
        return response()->json(null, 204);
    }
}
