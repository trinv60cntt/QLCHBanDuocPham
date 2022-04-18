<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminHomeController extends Controller
{
  public function getLogout()
  {
    Auth::logout();
    return redirect()->intended('admin');
  }
}
