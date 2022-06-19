<?php

namespace App\Services;

use Illuminate\Support\Facades\Gate;

class GatePolicyAccess {

  public function setGatePolicyAccess() {
    $this->defineGateNhaSanXuat();
    $this->defineGateDanhMuc();
    $this->defineGateSanPham();
    $this->defineGateHoaDonOnl();
    $this->defineGateHoaDonOff();
    $this->defineGateBinhLuan();
    $this->defineGateTuVan();
    $this->defineGateThongKe();
    $this->defineGateKhachHang();
    $this->defineGateNhanVien();
    $this->defineGateNhomNhanVien();
    $this->defineGateQuyen();
  }

  public function defineGateNhaSanXuat() {
    Gate::define('nhasanxuat-list', 'App\Policies\NhaSanXuatPolicy@view');
    Gate::define('nhasanxuat-add', 'App\Policies\NhaSanXuatPolicy@create');
    Gate::define('nhasanxuat-edit', 'App\Policies\NhaSanXuatPolicy@update');
    Gate::define('nhasanxuat-delete', 'App\Policies\NhaSanXuatPolicy@delete');
  }

  public function defineGateDanhMuc() {
    Gate::define('danhmuc-list', 'App\Policies\DanhMucPolicy@view');
    Gate::define('danhmuc-add', 'App\Policies\DanhMucPolicy@create');
    Gate::define('danhmuc-edit', 'App\Policies\DanhMucPolicy@update');
    Gate::define('danhmuc-delete', 'App\Policies\DanhMucPolicy@delete');
  }

  public function defineGateSanPham() {
    Gate::define('sanpham-list', 'App\Policies\SanPhamPolicy@view');
    Gate::define('sanpham-add', 'App\Policies\SanPhamPolicy@create');
    Gate::define('sanpham-edit', 'App\Policies\SanPhamPolicy@update');
    Gate::define('sanpham-delete', 'App\Policies\SanPhamPolicy@delete');
  }

  public function defineGateHoaDonOnl() {
    Gate::define('hoadononl-list', 'App\Policies\HoaDonPolicy@view');
    Gate::define('hoadononl-details', 'App\Policies\HoaDonPolicy@details');
    Gate::define('hoadononl-edit', 'App\Policies\HoaDonPolicy@update');
    Gate::define('hoadononl-delete', 'App\Policies\HoaDonPolicy@delete');
  }

  public function defineGateHoaDonOff() {
    Gate::define('hoadonoff-list', 'App\Policies\HoaDonOffPolicy@view');
    Gate::define('hoadonoff-details', 'App\Policies\HoaDonOffPolicy@details');
    Gate::define('hoadonoff-add', 'App\Policies\HoaDonOffPolicy@create');
    Gate::define('hoadonoff-edit', 'App\Policies\HoaDonOffPolicy@update');
    Gate::define('hoadonoff-delete', 'App\Policies\HoaDonOffPolicy@delete');
  }

  public function defineGateBinhLuan() {
    Gate::define('binhluan-list', 'App\Policies\BinhLuanPolicy@view');
  }

  public function defineGateThongKe() {
    Gate::define('tktheosanpham-index', 'App\Policies\ThongKePolicy@theoSanPham');
    Gate::define('tktheohinhthuckinhdoanh-index', 'App\Policies\ThongKePolicy@theoHinhThucKD');
    Gate::define('tktongdoanhthu-index', 'App\Policies\ThongKePolicy@doanhThu');
  }

  public function defineGateKhachHang() {
    Gate::define('khachhang-list', 'App\Policies\KhachHangPolicy@view');
    Gate::define('khachhang-add', 'App\Policies\KhachHangPolicy@create');
    Gate::define('khachhang-edit', 'App\Policies\KhachHangPolicy@update');
    Gate::define('khachhang-delete', 'App\Policies\KhachHangPolicy@delete');
  }

  public function defineGateNhanVien() {
    Gate::define('nhanvien-list', 'App\Policies\NhanVienPolicy@view');
    Gate::define('nhanvien-add', 'App\Policies\NhanVienPolicy@create');
    Gate::define('nhanvien-edit', 'App\Policies\NhanVienPolicy@update');
    Gate::define('nhanvien-delete', 'App\Policies\NhanVienPolicy@delete');
  }

  public function defineGateNhomNhanVien() {
    Gate::define('nhomnhanvien-list', 'App\Policies\VaiTroPolicy@view');
    Gate::define('nhomnhanvien-add', 'App\Policies\VaiTroPolicy@create');
    Gate::define('nhomnhanvien-edit', 'App\Policies\VaiTroPolicy@update');
    Gate::define('nhomnhanvien-delete', 'App\Policies\VaiTroPolicy@delete');
  }

  public function defineGateQuyen() {
    Gate::define('quyen-list', 'App\Policies\QuyenPolicy@view');
    Gate::define('quyen-add', 'App\Policies\QuyenPolicy@create');
    Gate::define('quyen-edit', 'App\Policies\QuyenPolicy@update');
    Gate::define('quyen-delete', 'App\Policies\QuyenPolicy@delete');
  }

  public function defineGateTuVan() {
    Gate::define('tuvan-list', 'App\Policies\TuVanPolicy@view');
  }
}