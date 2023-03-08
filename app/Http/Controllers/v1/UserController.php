<?php

namespace App\Http\Controllers\v1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->input('userRole') !== 'ADMIN') {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $Users = User::select('id', 'name', 'role', 'email', 'created_at')->where('role', '<>', 'ADMIN')->get();
        return response()->json($Users);
    }

    public function show(User $User)
    {
        return response()->json($User);
    }

    public function store(Request $request)
    {
        if ($request->input('userRole') !== 'ADMIN') {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $User = User::create([
            'name' => $request['name'],
            'username' => $request['username'],
            'email' => $request['email'],
            'role' => $request['role'],
            'password' => Hash::make($request['password']),
        ]);
        $token = $User->createToken('LaravelTest')->plainTextToken;
        if ($User) {
            return response()->json(['result' => 'success', 'token' => $token]);
        } else {
            return response()->json(['result' => 'fail']);
        }
    }

    public function update(Request $request, User $User)
    {
        $User->update($request->all());
        return response()->json($User);
    }

    public function destroy(User $User)
    {
        $User->delete();
        return response()->json(null, 204);
    }
}
