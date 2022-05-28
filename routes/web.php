<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Login - Logout
Route::group(['prefix' => 'login', 'middleware' => 'CheckLoggedIn'], function() {
  Route::get('/', 'App\Http\Controllers\AdminNhanVienController@loginAdmin');
  Route::post('/', 'App\Http\Controllers\AdminNhanVienController@postLoginAdmin');
});
Route::get('logout', 'App\Http\Controllers\AdminHomeController@getLogout');


// Route::get('/home', 'App\Http\Controllers\HomeController@index');

// BE
Route::prefix('admin')->group(function () {
  Route::get('/home', [
    'as' => 'admin.home',
    'uses' => 'App\Http\Controllers\AdminHomeController@home',
    'middleware' => 'CheckLoggedOut'
  ]);

});

// FE
Route::get('/', 'App\Http\Controllers\HomeController@index');
Route::post('/autocomplete-ajax', 'App\Http\Controllers\HomeController@autocomplete_ajax');

Route::prefix('home')->group(function () {
  Route::get('/', [
    'as' => 'home.index',
    'uses' => 'App\Http\Controllers\HomeController@index'
  ]);

  Route::get('/giohang', [
    'as' => 'home.giohang',
    'uses' => 'App\Http\Controllers\HomeController@giohang'
  ]);

});

// Menu
Route::prefix('menu')->group(function () {
  Route::get('/', [
    'as' => 'menus.index',
    'uses' => 'App\Http\Controllers\MenuController@index'
  ]);

  Route::get('/details/{sanPham_id}', [
    'as' => 'menus.details',
    'uses' => 'App\Http\Controllers\MenuController@details'
  ]);

  Route::get('/{danhMuc_id}', [
    'as' => 'menus.getCategory',
    'uses' => 'App\Http\Controllers\MenuController@getCategory'
  ]);

  Route::post('/tim-kiem', [
    'as' => 'menus.search',
    'uses' => 'App\Http\Controllers\MenuController@search'
  ]);

  Route::post('/load-comment', [
    'as' => 'menus.loadComment',
    'uses' => 'App\Http\Controllers\MenuController@loadComment'
  ]);

  Route::post('/send-comment', [
    'as' => 'menus.sendComment',
    'uses' => 'App\Http\Controllers\MenuController@sendComment'
  ]);

  Route::post('/insert-rating', [
    'as' => 'menus.insert_rating',
    'uses' => 'App\Http\Controllers\MenuController@insert_rating'
  ]);

});

// Admin
Route::prefix('admin')->group(function () {

  Route::prefix('danhmucs')->group(function () {
    Route::get('/', [
      'as' => 'danhmucs.index',
      'uses' => 'App\Http\Controllers\DanhMucController@index',
      'middleware' => 'can:danhmuc-list',
      'middleware' => 'CheckLoggedOut'
    ]);

    Route::get('/create', [
      'as' => 'danhmucs.create',
      'uses' => 'App\Http\Controllers\DanhMucController@create',
      'middleware' => 'can:danhmuc-add',
      'middleware' => 'CheckLoggedOut'
    ]);

    Route::post('/store', [
      'as' => 'danhmucs.store',
      'uses' => 'App\Http\Controllers\DanhMucController@store'
    ]);

    Route::get('/edit/{danhMuc_id}', [
      'as' => 'danhmucs.edit',
      'uses' => 'App\Http\Controllers\DanhMucController@edit',
      'middleware' => 'can:danhmuc-edit',
      'middleware' => 'CheckLoggedOut'
    ]);

    Route::post('/update/{danhMuc_id}', [
      'as' => 'danhmucs.update',
      'uses' => 'App\Http\Controllers\DanhMucController@update'
    ]);

    Route::get('/delete/{danhMuc_id}', [
      'as' => 'danhmucs.delete',
      'uses' => 'App\Http\Controllers\DanhMucController@delete',
      'middleware' => 'can:danhmuc-delete',
      'middleware' => 'CheckLoggedOut'
    ]);
  });

  Route::prefix('nhasanxuats')->group(function () {
    Route::get('/', [
      'as' => 'nhasanxuats.index',
      'uses' => 'App\Http\Controllers\NhaSanXuatController@index',
      'middleware' => 'can:nhasanxuat-list',
      'middleware' => 'CheckLoggedOut'
    ]);

    Route::get('/create', [
      'as' => 'nhasanxuats.create',
      'uses' => 'App\Http\Controllers\NhaSanXuatController@create',
      'middleware' => 'can:nhasanxuat-add',
      'middleware' => 'CheckLoggedOut'
    ]);

    Route::post('/store', [
      'as' => 'nhasanxuats.store',
      'uses' => 'App\Http\Controllers\NhaSanXuatController@store',
    ]);

    Route::get('/edit/{NSX_id}', [
      'as' => 'nhasanxuats.edit',
      'uses' => 'App\Http\Controllers\NhaSanXuatController@edit',
      'middleware' => 'can:nhasanxuat-edit',
      'middleware' => 'CheckLoggedOut'
    ]);

    Route::post('/update/{NSX_id}', [
      'as' => 'nhasanxuats.update',
      'uses' => 'App\Http\Controllers\NhaSanXuatController@update',
    ]);

    Route::get('/delete/{NSX_id}', [
      'as' => 'nhasanxuats.delete',
      'uses' => 'App\Http\Controllers\NhaSanXuatController@delete',
      'middleware' => 'can:nhasanxuat-delete',
      'middleware' => 'CheckLoggedOut'
    ]);
  });

  Route::prefix('sanphams')->group(function () {
    Route::get('/', [
      'as' => 'sanphams.index',
      'uses' => 'App\Http\Controllers\AdminSanPhamController@index',
      'middleware' => 'can:sanpham-list',
      'middleware' => 'CheckLoggedOut'
    ]);

    Route::get('/create', [
      'as' => 'sanphams.create',
      'uses' => 'App\Http\Controllers\AdminSanPhamController@create',
      'middleware' => 'can:sanpham-add',
      'middleware' => 'CheckLoggedOut'
    ]);

    Route::post('/store', [
      'as' => 'sanphams.store',
      'uses' => 'App\Http\Controllers\AdminSanPhamController@store',
    ]);

    Route::get('/edit/{sanPham_id}', [
      'as' => 'sanphams.edit',
      'uses' => 'App\Http\Controllers\AdminSanPhamController@edit',
      'middleware' => 'can:sanpham-edit',
      'middleware' => 'CheckLoggedOut'
    ]);

    Route::post('/update/{sanPham_id}', [
      'as' => 'sanphams.update',
      'uses' => 'App\Http\Controllers\AdminSanPhamController@update',
    ]);

    Route::get('/delete/{sanPham_id}', [
      'as' => 'sanphams.delete',
      'uses' => 'App\Http\Controllers\AdminSanPhamController@delete',
      'middleware' => 'can:sanpham-delete',
      'middleware' => 'CheckLoggedOut'
    ]);
  });

  Route::prefix('users')->group(function () {
    Route::get('/', [
      'as' => 'users.index',
      'uses' => 'App\Http\Controllers\AdminUserController@index'
    ]);
  
    Route::get('/create', [
      'as' => 'users.create',
      'uses' => 'App\Http\Controllers\AdminUserController@create'
    ]);
  
    Route::post('/store', [
      'as' => 'users.store',
      'uses' => 'App\Http\Controllers\AdminUserController@store'
    ]);
  
    Route::get('/edit/{id}', [
      'as' => 'users.edit',
      'uses' => 'App\Http\Controllers\AdminUserController@edit'
    ]);
  
    Route::post('/update/{id}', [
      'as' => 'users.update',
      'uses' => 'App\Http\Controllers\AdminUserController@update'
    ]);
  
    Route::get('/delete/{id}', [
      'as' => 'users.delete',
      'uses' => 'App\Http\Controllers\AdminUserController@delete'
    ]);
  });

  Route::prefix('hoadons')->group(function () {
    Route::get('/', [
      'as' => 'hoadons.index',
      'uses' => 'App\Http\Controllers\AdminHoaDonController@index',
      'middleware' => 'can:hoadononl-list',
      'middleware' => 'CheckLoggedOut'
    ]);

    Route::get('/edit/{hoaDon_id}', [
      'as' => 'hoadons.edit',
      'uses' => 'App\Http\Controllers\AdminHoaDonController@edit',
      'middleware' => 'can:hoadononl-edit',
      'middleware' => 'CheckLoggedOut'
    ]);

    Route::post('/update/{hoaDon_id}', [
      'as' => 'hoadons.update',
      'uses' => 'App\Http\Controllers\AdminHoaDonController@update',
    ]);

    Route::get('/details/{hoaDon_id}', [
      'as' => 'hoadons.details',
      'uses' => 'App\Http\Controllers\AdminHoaDonController@details',
      'middleware' => 'can:hoadononl-details',
      'middleware' => 'CheckLoggedOut'
    ]);

    Route::get('/delete/{hoaDon_id}', [
      'as' => 'hoadons.delete',
      'uses' => 'App\Http\Controllers\AdminHoaDonController@delete',
      'middleware' => 'can:hoadononl-delete',
      'middleware' => 'CheckLoggedOut'
    ]);

  });

  Route::prefix('khachhangs')->group(function () {
    Route::get('/', [
      'as' => 'khachhangs.index',
      'uses' => 'App\Http\Controllers\AdminKhachHangController@index',
      'middleware' => 'can:khachhang-list',
      'middleware' => 'CheckLoggedOut'
    ]);

    Route::get('/create', [
      'as' => 'khachhangs.create',
      'uses' => 'App\Http\Controllers\AdminKhachHangController@create',
      'middleware' => 'can:khachhang-add',
      'middleware' => 'CheckLoggedOut'
    ]);

    Route::post('/store', [
      'as' => 'khachhangs.store',
      'uses' => 'App\Http\Controllers\AdminKhachHangController@store'
    ]);

    Route::get('/edit/{khachhang_id}', [
      'as' => 'khachhangs.edit',
      'uses' => 'App\Http\Controllers\AdminKhachHangController@edit',
      'middleware' => 'can:khachhang-edit',
      'middleware' => 'CheckLoggedOut'
    ]);

    Route::post('/update/{khachhang_id}', [
      'as' => 'khachhangs.update',
      'uses' => 'App\Http\Controllers\AdminKhachHangController@update'
    ]);

    Route::get('/delete/{khachhang_id}', [
      'as' => 'khachhangs.delete',
      'uses' => 'App\Http\Controllers\AdminKhachHangController@delete',
      'middleware' => 'can:khachhang-delete',
      'middleware' => 'CheckLoggedOut'
    ]);

    Route::post('/tim-kiem', [
      'as' => 'khachhangs.search',
      'uses' => 'App\Http\Controllers\AdminKhachHangController@search'
    ]);

    Route::get('/details/{khachhang_id}', [
      'as' => 'khachhangs.details',
      'uses' => 'App\Http\Controllers\AdminKhachHangController@details',
      // 'middleware' => 'can:hoadononl-details'
    ]);
  });

  Route::prefix('nhanviens')->group(function () {
    Route::get('/', [
      'as' => 'nhanviens.index',
      'uses' => 'App\Http\Controllers\AdminNhanVienController@index',
      'middleware' => 'can:nhanvien-list',
      'middleware' => 'CheckLoggedOut'
    ]);

    Route::get('/create', [
      'as' => 'nhanviens.create',
      'uses' => 'App\Http\Controllers\AdminNhanVienController@create',
      'middleware' => 'can:nhanvien-add',
      'middleware' => 'CheckLoggedOut'
    ]);

    Route::post('/store', [
      'as' => 'nhanviens.store',
      'uses' => 'App\Http\Controllers\AdminNhanVienController@store'
    ]);

    Route::get('/edit/{nhanvien_id}', [
      'as' => 'nhanviens.edit',
      'uses' => 'App\Http\Controllers\AdminNhanVienController@edit',
      'middleware' => 'can:nhanvien-edit',
      'middleware' => 'CheckLoggedOut'
    ]);

    Route::post('/update/{nhanvien_id}', [
      'as' => 'nhanviens.update',
      'uses' => 'App\Http\Controllers\AdminNhanVienController@update'
    ]);

    Route::get('/delete/{nhanvien_id}', [
      'as' => 'nhanviens.delete',
      'uses' => 'App\Http\Controllers\AdminNhanVienController@delete',
      'middleware' => 'can:nhanvien-delete',
      'middleware' => 'CheckLoggedOut'
    ]);

    Route::post('/tim-kiem', [
      'as' => 'nhanviens.search',
      'uses' => 'App\Http\Controllers\AdminNhanVienController@search'
    ]);

    Route::get('/details/{nhanvien_id}', [
      'as' => 'nhanviens.details',
      'uses' => 'App\Http\Controllers\AdminNhanVienController@details',
      // 'middleware' => 'can:hoadononl-details'
    ]);
  });

  Route::prefix('thongkes')->group(function () {
    Route::get('/', [
      'as' => 'thongkes.doanhThu',
      'uses' => 'App\Http\Controllers\AdminThongKeController@doanhThu',
      'middleware' => 'can:tktongdoanhthu-index',
      'middleware' => 'CheckLoggedOut'
    ]);

    Route::post('/filter-by-date', [
      'as' => 'thongkes.filter_by_date',
      'uses' => 'App\Http\Controllers\AdminThongKeController@filter_by_date'
    ]);

    Route::post('/dashboard-filter', [
      'as' => 'thongkes.dashboard_filter',
      'uses' => 'App\Http\Controllers\AdminThongKeController@dashboard_filter'
    ]);

    Route::get('/theosanpham', [
      'as' => 'thongkes.theoSanPham',
      'uses' => 'App\Http\Controllers\AdminThongKeController@theoSanPham',
      'middleware' => 'can:tktheosanpham-index',
      'middleware' => 'CheckLoggedOut'
    ]);

    Route::post('/product-filter-by-date', [
      'as' => 'thongkes.product_filter_by_date',
      'uses' => 'App\Http\Controllers\AdminThongKeController@product_filter_by_date'
    ]);

    Route::post('/product-dashboard-filter', [
      'as' => 'thongkes.product_dashboard_filter',
      'uses' => 'App\Http\Controllers\AdminThongKeController@product_dashboard_filter'
    ]);

    Route::get('/theoHinhThucKD', [
      'as' => 'thongkes.theoHinhThucKD',
      'uses' => 'App\Http\Controllers\AdminThongKeController@theoHinhThucKD',
      'middleware' => 'can:tktheohinhthuckinhdoanh-index',
      'middleware' => 'CheckLoggedOut'
    ]);

    Route::post('/type-bussiness-filter-by-date', [
      'as' => 'thongkes.type_bussiness_filter_by_date',
      'uses' => 'App\Http\Controllers\AdminThongKeController@type_bussiness_filter_by_date'
    ]);

    Route::post('/type-bussiness-dashboard-filter', [
      'as' => 'thongkes.type_bussiness_dashboard_filter',
      'uses' => 'App\Http\Controllers\AdminThongKeController@type_bussiness_dashboard_filter'
    ]);
  });

  Route::prefix('vaitros')->group(function () {
    Route::get('/', [
      'as' => 'vaitros.index',
      'uses' => 'App\Http\Controllers\AdminVaiTroController@index',
      'middleware' => 'can:nhomnhanvien-list',
      'middleware' => 'CheckLoggedOut'
    ]);

    Route::get('/create', [
      'as' => 'vaitros.create',
      'uses' => 'App\Http\Controllers\AdminVaiTroController@create',
      'middleware' => 'can:nhomnhanvien-add',
      'middleware' => 'CheckLoggedOut'
    ]);

    Route::post('/store', [
      'as' => 'vaitros.store',
      'uses' => 'App\Http\Controllers\AdminVaiTroController@store'
    ]);

    Route::get('/edit/{vaiTro_id}', [
      'as' => 'vaitros.edit',
      'uses' => 'App\Http\Controllers\AdminVaiTroController@edit',
      'middleware' => 'can:nhomnhanvien-edit',
      'middleware' => 'CheckLoggedOut'
    ]);

    Route::post('/update/{vaiTro_id}', [
      'as' => 'vaitros.update',
      'uses' => 'App\Http\Controllers\AdminVaiTroController@update'
    ]);

    Route::get('/delete/{vaiTro_id}', [
      'as' => 'vaitros.delete',
      'uses' => 'App\Http\Controllers\AdminVaiTroController@delete',
      'middleware' => 'can:nhomnhanvien-delete',
      'middleware' => 'CheckLoggedOut'
    ]);

  });

  Route::prefix('quyens')->group(function () {
    Route::get('/', [
      'as' => 'quyens.index',
      'uses' => 'App\Http\Controllers\AdminQuyenController@index',
      'middleware' => 'can:quyen-list',
      'middleware' => 'CheckLoggedOut'
    ]);

    Route::get('/create', [
      'as' => 'quyens.create',
      'uses' => 'App\Http\Controllers\AdminQuyenController@create',
      'middleware' => 'can:quyen-add',
      'middleware' => 'CheckLoggedOut'
    ]);

    Route::post('/store', [
      'as' => 'quyens.store',
      'uses' => 'App\Http\Controllers\AdminQuyenController@store'
    ]);

    Route::get('/edit/{quyen_id}', [
      'as' => 'quyens.edit',
      'uses' => 'App\Http\Controllers\AdminQuyenController@edit',
      'middleware' => 'can:quyen-edit',
      'middleware' => 'CheckLoggedOut'
    ]);

    Route::post('/update/{quyen_id}', [
      'as' => 'quyens.update',
      'uses' => 'App\Http\Controllers\AdminQuyenController@update'
    ]);

    Route::get('/delete/{quyen_id}', [
      'as' => 'quyens.delete',
      'uses' => 'App\Http\Controllers\AdminQuyenController@delete',
      'middleware' => 'can:quyen-delete',
      'middleware' => 'CheckLoggedOut'
    ]);

  });

  Route::prefix('binhluans')->group(function () {
    Route::get('/', [
      'as' => 'binhluans.index',
      'uses' => 'App\Http\Controllers\AdminBinhLuanController@index',
      'middleware' => 'can:binhluan-list',
      'middleware' => 'CheckLoggedOut'
    ]);

    Route::post('/reply-comment', [
      'as' => 'binhluans.replyComment',
      'uses' => 'App\Http\Controllers\AdminBinhLuanController@replyComment'
    ]);

    Route::get('/delete/{binhLuan_id}', [
      'as' => 'binhluans.delete',
      'uses' => 'App\Http\Controllers\AdminBinhLuanController@delete'
    ]);

    Route::post('/allow-comment', [
      'as' => 'binhluans.allow_comment',
      'uses' => 'App\Http\Controllers\AdminBinhLuanController@allow_comment'
    ]);

  });

  Route::prefix('hoadonoffline')->group(function () {
    Route::get('/', [
      'as' => 'hoadonoffline.index',
      'uses' => 'App\Http\Controllers\AdminHoaDonOffLineController@index',
      'middleware' => 'can:hoadonoff-list',
      'middleware' => 'CheckLoggedOut'
    ]);

    Route::get('/create', [
      'as' => 'hoadonoffline.create',
      'uses' => 'App\Http\Controllers\AdminHoaDonOffLineController@create',
      'middleware' => 'can:hoadonoff-add',
      'middleware' => 'CheckLoggedOut'
    ]);

    Route::post('/store', [
      'as' => 'hoadonoffline.store',
      'uses' => 'App\Http\Controllers\AdminHoaDonOffLineController@store',
    ]);

    Route::post('/load-product', [
      'as' => 'hoadonoffline.loadProduct',
      'uses' => 'App\Http\Controllers\AdminHoaDonOffLineController@loadProduct',
    ]);

    Route::get('/edit/{hoaDonOff_id}', [
      'as' => 'hoadonoffline.edit',
      'uses' => 'App\Http\Controllers\AdminHoaDonOffLineController@edit',
      'middleware' => 'can:hoadonoff-edit',
      'middleware' => 'CheckLoggedOut'
    ]);

    Route::post('/update/{hoaDonOff_id}', [
      'as' => 'hoadonoffline.update',
      'uses' => 'App\Http\Controllers\AdminHoaDonOffLineController@update',
    ]);

    Route::get('/details/{hoaDonOff_id}', [
      'as' => 'hoadonoffline.details',
      'uses' => 'App\Http\Controllers\AdminHoaDonOffLineController@details',
      'middleware' => 'can:hoadonoff-details',
      'middleware' => 'CheckLoggedOut'
    ]);

    Route::get('/delete/{hoaDonOff_id}', [
      'as' => 'hoadonoffline.delete',
      'uses' => 'App\Http\Controllers\AdminHoaDonOffLineController@delete',
      'middleware' => 'can:hoadonoff-delete',
      'middleware' => 'CheckLoggedOut'
    ]);

  });

  Route::prefix('canhans')->group(function () {
    Route::get('/', [
      'as' => 'canhans.index',
      'uses' => 'App\Http\Controllers\AdminCaNhanController@index',
      'middleware' => 'CheckLoggedOut'
    ]);

    Route::get('/edit', [
      'as' => 'canhans.edit',
      'uses' => 'App\Http\Controllers\AdminCaNhanController@edit',
      'middleware' => 'CheckLoggedOut'
    ]);

    Route::post('/update', [
      'as' => 'canhans.update',
      'uses' => 'App\Http\Controllers\AdminCaNhanController@update'
    ]);

    Route::get('/doimatkhau', [
      'as' => 'canhans.doimatkhau',
      'uses' => 'App\Http\Controllers\AdminCaNhanController@doimatkhau',
      'middleware' => 'CheckLoggedOut'
    ]);


    Route::post('/luumatkhau', [
      'as' => 'canhans.luuMatKhau',
      'uses' => 'App\Http\Controllers\AdminCaNhanController@luuMatKhau'
    ]);
    
  });
});


// Cart
Route::post('/save-cart', 'App\Http\Controllers\CartController@save_cart');
Route::get('/show-cart', 'App\Http\Controllers\CartController@show_cart');
Route::get('/delete-to-cart/{rowId}', 'App\Http\Controllers\CartController@delete_to_cart');
Route::get('/update', 'App\Http\Controllers\CartController@getUpdateCart');
Route::get('/update/{rowId}', 'App\Http\Controllers\CartController@update');

// Checkout
Route::get('/login-checkout', 'App\Http\Controllers\CheckoutController@login_checkout');
Route::get('/logout-checkout', 'App\Http\Controllers\CheckoutController@logout_checkout');

//Login facebook
Route::get('/login-facebook','App\Http\Controllers\CheckoutController@login_facebook');
Route::get('/login-checkout/callback','App\Http\Controllers\CheckoutController@callback_facebook');

//Login  google
Route::get('/login-google','App\Http\Controllers\CheckoutController@login_google');
Route::get('/google/callback','App\Http\Controllers\CheckoutController@callback_google');

Route::get('/register-checkout', 'App\Http\Controllers\CheckoutController@register_checkout');
Route::post('/order-place', 'App\Http\Controllers\CheckoutController@order_place');
Route::post('/add-customer', 'App\Http\Controllers\CheckoutController@add_customer');
Route::post('/login-customer', 'App\Http\Controllers\CheckoutController@login_customer');
Route::get('/checkout', 'App\Http\Controllers\CheckoutController@checkout');
Route::get('/announceGioHang', 'App\Http\Controllers\CheckoutController@announceGioHang');
// ------

//  Customer
Route::prefix('khachhang')->group(function () {
  Route::get('/', [
    'as' => 'khachhang.index',
    'uses' => 'App\Http\Controllers\KhachHangController@index'
  ]);

  Route::get('/lichsu', [
    'as' => 'khachhang.lichsu',
    'uses' => 'App\Http\Controllers\KhachHangController@lichsu'
  ]);

  Route::get('/details/{hoaDon_id}', [
    'as' => 'khachhang.details',
    'uses' => 'App\Http\Controllers\KhachHangController@details'
  ]);

  Route::get('/delete/{hoaDon_id}', [
    'as' => 'khachhang.delete',
    'uses' => 'App\Http\Controllers\KhachHangController@delete'
  ]);

  Route::get('/edit', [
    'as' => 'khachhang.edit',
    'uses' => 'App\Http\Controllers\KhachHangController@edit',
  ]);

  Route::post('/update', [
    'as' => 'khachhang.update',
    'uses' => 'App\Http\Controllers\KhachHangController@update'
  ]);

  Route::get('/doimatkhau', [
    'as' => 'khachhang.doimatkhau',
    'uses' => 'App\Http\Controllers\KhachHangController@doimatkhau',
  ]);


  Route::post('/luumatkhau', [
    'as' => 'khachhang.luuMatKhau',
    'uses' => 'App\Http\Controllers\KhachHangController@luuMatKhau'
  ]);

});

Route::get('/Add-Cart/{id}', 'App\Http\Controllers\AdminHoaDonOffLineController@AddCart');