<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $projects = Project::all();
        $users = User::where('role', '=', 'TEAM_MEMBER')->get();

        return view(Auth::user()->role . '.index', compact('projects', 'users'));
    }

    public function task()
    {
        $projects = Project::all();
        $users = User::where('role', '=', 'TEAM_MEMBER')->get();
        return view(Auth::user()->role . '.task', compact('projects', 'users'));
    }
}
