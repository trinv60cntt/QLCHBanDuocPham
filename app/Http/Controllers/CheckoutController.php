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
      Session::put('password', $result->password);
      return Redirect::to('/home');
    } else {
      return Redirect::to('/login-checkout');
    }
  }

  public function announceGioHang() {
    return view('home.announceGioHang');
  }

  public function login_facebook(){
    return Socialite::driver('facebook')->redirect();
  }

  public function callback_facebook(){
    $provider = Socialite::driver('facebook')->user();
    $account = Social::where('provider','facebook')->where('provider_user_id',$provider->getId())->first();
    if($account){
        $account_name = KhachHang::where('khachhang_id',$account->khachhang_id)->first();
        Session::put('tenKH', $account_name->tenKH);
        Session::put('khachhang_id', $account_name->khachhang_id);
        Session::put('hinhAnh', $account_name->hinhAnh);
    }else{
        $social = new Social([
            'provider_user_id' => $provider->getId(),
            'provider' => 'facebook'
        ]);

        $orang = KhachHang::where('email',$provider->getEmail())->first();

        if(!$orang){
            $orang = KhachHang::create([
                'hoKH' => '',
                'tenKH' => $provider->getName(),
                'gioiTinh' => 1,
                'ngaySinh' => '2000-01-01',
                'diaChi' => '',
                'email' => $provider->getEmail(),
                'password' => '',
                'sdt' => '',
                'hinhAnh' => 'avatar.jpg',
            ]);
        }
        $social->login()->associate($orang);
        $social->save();

        $account_name = KhachHang::where('khachhang_id',$account->khachhang_id)->first();

        Session::put('tenKH', $account_name->tenKH);
        Session::put('khachhang_id', $account_name->khachhang_id);
        Session::put('hinhAnh', $account_name->hinhAnh);
      }
      return redirect('/home')->with('message', 'Đăng nhập Facebook thành công');
  }

  public function login_google(){
    return Socialite::driver('google')->redirect();
  }
  public function callback_google(){
    $provider = Socialite::driver('google')->user();
    $account = Social::where('provider','google')->where('provider_user_id',$provider->getId())->first();
    if($account){
        $account_name = KhachHang::where('khachhang_id',$account->khachhang_id)->first();
        Session::put('hoKH', $account_name->hoKH);
        Session::put('tenKH', $account_name->tenKH);
        Session::put('khachhang_id', $account_name->khachhang_id);
        Session::put('hinhAnh', $account_name->hinhAnh);
    }else{
        $social = new Social([
            'provider_user_id' => $provider->getId(),
            'provider' => 'google'
        ]);

        $orang = KhachHang::where('email',$provider->getEmail())->first();

        if(!$orang){
            $orang = KhachHang::create([
                'hoKH' => '',
                'tenKH' => $provider->getName(),
                'gioiTinh' => 1,
                'ngaySinh' => '2000-01-01',
                'diaChi' => '',
                'email' => $provider->getEmail(),
                'password' => '',
                'sdt' => '',
                'hinhAnh' => 'avatar.jpg',
            ]);
        }
        $social->login()->associate($orang);
        $social->save();

        $account = Social::where('provider','google')->where('provider_user_id',$provider->getId())->first();
        $account_name = KhachHang::where('khachhang_id',$account->khachhang_id)->first();

        Session::put('tenKH', $account_name->tenKH);
        Session::put('khachhang_id', $account_name->khachhang_id);
        Session::put('hinhAnh', $account_name->hinhAnh);
      }
      return redirect('/home')->with('message', 'Đăng nhập Google thành công');
  }
}
