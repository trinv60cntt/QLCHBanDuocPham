<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', 'AdminController@login');

Route::get('/home', function () {
  return view('home');
});

// Route::prefix('danhmuc')->group(function () {
//   Route::get('/', [
//     'as' => 'danhmuc.index',
//     'uses' => 'App\Http\Controllers\DanhMucController@index',
//   ]);

//   Route::get('/create', [
//     'as' => 'danhmuc.create',
//     'uses' => 'App\Http\Controllers\DanhMucController@create',
//   ]);

//   Route::post('/store', [
//     'as' => 'danhmuc.store',
//     'uses' => 'App\Http\Controllers\DanhMucController@store',
//   ]);

//   Route::get('/edit/{id}', [
//     'as' => 'danhmuc.edit',
//     'uses' => 'App\Http\Controllers\DanhMucController@edit',
//   ]);

//   Route::post('/update/{id}', [
//     'as' => 'danhmuc.update',
//     'uses' => 'App\Http\Controllers\DanhMucController@update',
//   ]);

//   Route::get('/delete/{id}', [
//     'as' => 'danhmuc.delete',
//     'uses' => 'App\Http\Controllers\DanhMucController@delete',
//   ]);
// });

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
