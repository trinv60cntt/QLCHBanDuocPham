<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart;
use Carbon\Carbon;
use App\Models\Social;
use App\Models\KhachHang;
use Laravel\Socialite\Facades\Socialite;

session_start();

class KhachHangNewController extends Controller
{
  public function login_checkout() {

    return view('home.checkout.login_checkout');
  }

  public function register_checkout() {
    
    return view('home.checkout.register_checkout');
  }

  public function add_customer(Request $request) {
    $data = array();
    $data['hoKH'] = $request->hoKH;
    $data['tenKH'] = $request->tenKH;
    $data['gioiTinh'] = $request->gioiTinh;
    $data['ngaySinh'] = $request->ngaySinh;
    $data['diaChi'] = $request->diaChi;
    $data['email'] = $request->email;
    $data['password'] = md5($request->password);
    $data['sdt'] = $request->sdt;
    $data['hinhAnh'] = 'avatar.jpg';

    $customer_id = DB::table('khachhang')->insertGetId($data);

    Session::put('khachhang_id', $customer_id);
    Session::put('tenKH', $request->tenKH);

    return Redirect::to('/login-checkout');
  }


  public function logout_checkout() {
    Session::flush();
    return Redirect::to('/login-checkout');
  }

  public function login_customer(Request $request) {
    $email = $request->email_account;
    $password = md5($request->password_account);
    $result = DB::table('khachhang')->where('email', $email)->where('password', $password)->first();
    
    if($result) {
      Session::put('khachhang_id', $result->khachhang_id);
      Session::put('hoKH', $result->hoKH);
      Session::put('tenKH', $result->tenKH);
      Session::put('diaChi', $result->diaChi);
      Session::put('email', $result->email);
      Session::put('sdt', $result->sdt);
      Session::put('hinhAnh', $result->hinhAnh);
      Session::put('password', $result->password);
      return redirect()->to(route('inbox.index'));
    } else {
      return Redirect::to('/login-checkout');
    }
  }


}
