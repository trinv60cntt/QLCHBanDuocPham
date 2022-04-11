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

Route::get('/admin', 'App\Http\Controllers\NhanVienController@loginAdmin');
Route::post('/admin', 'App\Http\Controllers\NhanVienController@postLoginAdmin');

// Route::get('/', function () {
//   return view('home');
// });

Route::post('/', 'App\Http\Controllers\HomeController@index');

Route::get('/home', function () {
  return view('home');
});

Route::prefix('admin')->group(function () {
  
  Route::prefix('lops')->group(function () {
    Route::get('/', [
      'as' => 'lops.index',
      'uses' => 'App\Http\Controllers\LopController@index'
    ]);
    Route::get('/create', [
      'as' => 'lops.create',
      'uses' => 'App\Http\Controllers\LopController@create'
    ]);
  
    Route::post('/store', [
      'as' => 'lops.store',
      'uses' => 'App\Http\Controllers\LopController@store'
    ]);
  
    Route::get('/edit/{MaLop}', [
      'as' => 'lops.edit',
      'uses' => 'App\Http\Controllers\LopController@edit'
    ]);
  
    Route::post('/update/{MaLop}', [
      'as' => 'lops.update',
      'uses' => 'App\Http\Controllers\LopController@update'
    ]);
  
    Route::get('/delete/{MaLop}', [
      'as' => 'lops.delete',
      'uses' => 'App\Http\Controllers\LopController@delete'
    ]);
  });
  
  Route::prefix('danhmucs')->group(function () {
    Route::get('/', [
      'as' => 'danhmucs.index',
      'uses' => 'App\Http\Controllers\DanhMucController@index'
    ]);
  
    Route::get('/create', [
      'as' => 'danhmucs.create',
      'uses' => 'App\Http\Controllers\DanhMucController@create'
    ]);
  
    Route::post('/store', [
      'as' => 'danhmucs.store',
      'uses' => 'App\Http\Controllers\DanhMucController@store'
    ]);
  
    Route::get('/edit/{danhMuc_id}', [
      'as' => 'danhmucs.edit',
      'uses' => 'App\Http\Controllers\DanhMucController@edit'
    ]);
  
    Route::post('/update/{danhMuc_id}', [
      'as' => 'danhmucs.update',
      'uses' => 'App\Http\Controllers\DanhMucController@update'
    ]);
  
    Route::get('/delete/{danhMuc_id}', [
      'as' => 'danhmucs.delete',
      'uses' => 'App\Http\Controllers\DanhMucController@delete'
    ]);
  });

  Route::prefix('nhasanxuats')->group(function () {
    Route::get('/', [
      'as' => 'nhasanxuats.index',
      'uses' => 'App\Http\Controllers\NhaSanXuatController@index'
    ]);
  
    Route::get('/create', [
      'as' => 'nhasanxuats.create',
      'uses' => 'App\Http\Controllers\NhaSanXuatController@create'
    ]);
  
    Route::post('/store', [
      'as' => 'nhasanxuats.store',
      'uses' => 'App\Http\Controllers\NhaSanXuatController@store'
    ]);
  
    Route::get('/edit/{NSX_id}', [
      'as' => 'nhasanxuats.edit',
      'uses' => 'App\Http\Controllers\NhaSanXuatController@edit'
    ]);
  
    Route::post('/update/{NSX_id}', [
      'as' => 'nhasanxuats.update',
      'uses' => 'App\Http\Controllers\NhaSanXuatController@update'
    ]);
  
    Route::get('/delete/{NSX_id}', [
      'as' => 'nhasanxuats.delete',
      'uses' => 'App\Http\Controllers\NhaSanXuatController@delete'
    ]);
  });

  Route::prefix('sanphams')->group(function () {
    Route::get('/', [
      'as' => 'sanphams.index',
      'uses' => 'App\Http\Controllers\AdminSanPhamController@index'
    ]);
  
    Route::get('/create', [
      'as' => 'sanphams.create',
      'uses' => 'App\Http\Controllers\AdminSanPhamController@create'
    ]);
  
    Route::post('/store', [
      'as' => 'sanphams.store',
      'uses' => 'App\Http\Controllers\AdminSanPhamController@store'
    ]);
  
    Route::get('/edit/{sanPham_id}', [
      'as' => 'sanphams.edit',
      'uses' => 'App\Http\Controllers\AdminSanPhamController@edit'
    ]);
  
    Route::post('/update/{sanPham_id}', [
      'as' => 'sanphams.update',
      'uses' => 'App\Http\Controllers\AdminSanPhamController@update'
    ]);
  
    Route::get('/delete/{sanPham_id}', [
      'as' => 'sanphams.delete',
      'uses' => 'App\Http\Controllers\AdminSanPhamController@delete'
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
});

