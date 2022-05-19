<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart;
use Carbon\Carbon;


session_start();

class CheckoutController extends Controller
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

    // Session::put('khachhang_id', $request->khachhang_id);
    Session::put('khachhang_id', $customer_id);
    Session::put('tenKH', $request->tenKH);

    return Redirect::to('/login-checkout');
  }

  public function order_place(Request $request) {
    $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

    // insert order
    $order_data = array(); 
    $order_data['hoTenKH'] = $request->hoTenKH;
    $order_data['sdt'] = $request->sdt;
    $order_data['diaChi'] = $request->diaChi;
    $order_data['email'] = $request->email;
    $order_data['ghiChu'] = $request->ghiChu;
    $order_data['tongTien'] = Cart::totalFloat() + 15000;
    $order_data['ngayLap'] = $now;
    $order_data['tinhTrang'] = 1;
    $order_data['khachhang_id'] = $request->customer_id;
    $order_data['created_at'] =new \DateTime();
    $order_id = DB::table('hoadon')->insertGetId($order_data);

    // insert order details
    $content = Cart::content();
    foreach($content as $v_content) {
      $order_d_data = array(); 
      $order_d_data['hoaDon_id'] = $order_id;
      $order_d_data['sanPham_id'] = $v_content->id;
      $order_d_data['soLuong'] = $v_content->qty;
  
      DB::table('chitiethd')->insert($order_d_data);
    }

    Cart::destroy();
    return Redirect::to('/announceGioHang');
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
      return Redirect::to('/home');
    } else {
      return Redirect::to('/login-checkout');
    }
  }

  public function announceGioHang() {
    return view('home.announceGioHang');
  }


}
