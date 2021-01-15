<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function register(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        if ($v->fails())
            return response()->json($v->errors(), 422);

        $user = new User($request->all());
        $user->password = Hash::make($request->get('password'));
        $user->save();

        return response()->json(['data' => ['id' => $user->id]], 201);
    }

    public function login(Request $request)
    {
        $v = Validator::make($request->all(), [
            'email' => 'required|exists:users',
            'password' => 'required',
        ]);

        if ($v->fails())
            return response()->json($v->errors(), 422);

        $user = User::query()->where('email', $request->get('email'))->firstOrFail();

        if (!Hash::check($request->get('password'), $user->password)) {
            return response()->json(['login' => ['Email or password incorrect']], 404);
        }

        $token = $user->generateToken();

        return response()->json(['data' => ['token' => $token]]);
    }

    public function logout()
    {
        Auth::user()->logout();

        return response()->json(['data' => ['status' => 'ok']]);
    }

    public function about()
    {
        $user = Auth::user()->only(['id', 'name', 'email']);
        unset($user['api_token']);
        return response()->json(['data' => $user]);
    }
}
