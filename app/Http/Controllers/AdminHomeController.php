<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;


class AdminHomeController extends Controller
{
  public function home() {
    return view('admin.home');
  }

  public function getLogout()
  {
    Auth::logout();
    return redirect()->intended('login');
  }

  public function forgot() {
    return view('admin.forgot');
  }

  public function showResetForm(Request $request, $token = null) {
    return view('admin.reset')->with(['token'=>$token,'email'=>$request->email]);
  }

  public function resetPassword(Request $request) {
    $request->validate([
      // 'email'=>'required|email|exists:khachhang,email',
      'password'=>'required|min:5',
      'password_confirm'=>'required',
    ]);
    $check_token = DB::table('password_resets')->where([
      'email'=>$request->email,
      'token'=>$request->_token,
    ])->first();
    if(!$check_token) {
      return back()->withInput()->with('fail', 'Invalid token');
    } else {
      User::where('email', $request->email)->update([
        'password' => Hash::make($request->password),
      ]);

      DB::table('password_resets')->where([
        'email'=>$request->email
      ])->delete();
      return redirect('/login');
    }
  }

  public function sendResetLink(Request $request) {
    $request->validate([
      'email' => 'required|email|exists:users,email'
    ]);

    $token = Str::random(64);
    DB::table('password_resets')->insert([
      'email' => $request->email,
      'token' => $request->_token,
      'created_at' => Carbon::now(),
    ]);

    $action_link = route('reset.password.showResetFormAdmin', ['token'=>$request->_token, 'email'=>$request->email]);
    $body = "We are received a request to reset the password for <b>Your app Name</b> account with ".$request->email.
    ". You can reset your password by clicking the link below";

    Mail::send('email-forgot', ['action_link'=>$action_link,'body'=>$body], function($message) use ($request){
      $message->from('noreply@example.com', 'Your App Name');
      $message->to($request->email, 'Your Name')
                ->subject('Reset Password'); 
    });

    return back()->with('success', 'We have e-mailed your password reset link');
  }
}
