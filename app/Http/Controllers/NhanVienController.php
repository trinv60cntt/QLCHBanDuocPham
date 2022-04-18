<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NhanVienController extends Controller
{
  public function loginAdmin()
  {
    if (auth()->check()) {
      return view('admin.home');
    }
    // dd(bcrypt('123'));
    return view('login');
  }

  public function postLoginAdmin(Request $request)
  {
    // dd($request->has('remember_me'));
    $remember = $request->has('remember_me') ? true : false;
    if (auth()->attempt([
      'email' => $request->email,
      'password' => $request->password
    ], $remember)) {
      return view('admin.home');
    } else {
      return back()->withInput()->with('error', '• Tài khoản hoặc mật khẩu chưa đúng');
    }
    // dd($request->all());
  }
}
