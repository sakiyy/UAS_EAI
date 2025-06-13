<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller {
  public function register(Request $r) {
    $data = $r->validate([
      'name'=>'required|string',
      'email'=>'required|email|unique:users',
      'password'=>'required|min:6',
      'role'=>'in:admin,customer'
    ]);
    $data['password'] = Hash::make($data['password']);
    $user = User::create($data);
    $token = JWTAuth::fromUser($user);
    return response()->json(compact('user','token'),201);
  }

  public function login(Request $r) {
    $credentials = $r->only('email','password');
    if (!$token = JWTAuth::attempt($credentials)) {
      return response()->json(['error'=>'Unauthorized'],401);
    }
    return response()->json(compact('token'));
  }

  public function me() {
    return response()->json(auth()->user());
  }

  public function logout() {
    auth()->logout();
    return response()->json(['message'=>'Successfully logged out']);
  }
}
