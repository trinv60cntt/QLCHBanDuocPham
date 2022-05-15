<?php

namespace App\Services;

use Illuminate\Support\Facades\Gate;

class QuyenGateAndPolicyAccess {

  public function setGateAndPolicyAccess() {
    $this->defineGateDanhMuc();
    $this->defineGateSanPham();
    $this->defineGateNhaSanXuat();
    $this->defineGateHoaDon();
  }

  public function defineGateNhaSanXuat() {
    Gate::define('nhasanxuat-index', 'App\Policies\NhaSanXuatPolicy@view');
    Gate::define('nhasanxuat-add', 'App\Policies\NhaSanXuatPolicy@create');
    Gate::define('nhasanxuat-edit', 'App\Policies\NhaSanXuatPolicy@update');
    Gate::define('nhasanxuat-delete', 'App\Policies\NhaSanXuatPolicy@delete');
  }

  public function defineGateDanhMuc() {
    Gate::define('danhmuc-index', 'App\Policies\DanhMucPolicy@view');
    Gate::define('danhmuc-add', 'App\Policies\DanhMucPolicy@create');
    Gate::define('danhmuc-edit', 'App\Policies\DanhMucPolicy@update');
    Gate::define('danhmuc-delete', 'App\Policies\DanhMucPolicy@delete');
  }

  public function defineGateSanPham() {
    Gate::define('sanpham-index', 'App\Policies\SanPhamPolicy@view');
    Gate::define('sanpham-add', 'App\Policies\SanPhamPolicy@create');
    Gate::define('sanpham-edit', 'App\Policies\SanPhamPolicy@update');
    Gate::define('sanpham-delete', 'App\Policies\SanPhamPolicy@delete');
  }

  public function defineGateHoaDon() {
    Gate::define('hoadon-index', 'App\Policies\HoaDonPolicy@view');
    Gate::define('hoadon-add', 'App\Policies\HoaDonPolicy@create');
    Gate::define('hoadon-edit', 'App\Policies\HoaDonPolicy@update');
    Gate::define('hoadon-delete', 'App\Policies\HoaDonPolicy@delete');
  }
}