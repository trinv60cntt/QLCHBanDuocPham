<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ThongKe;
use App\Models\HoaDon;
use App\Models\HoaDonOff;
use App\Models\SanPham;
use App\Models\ChiTietHD;
use App\Models\ChiTietHDOff;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Components\SanPhamRecursive;

class AdminThongKeController extends Controller
{  
  public function __construct(
  HoaDon $hoadon,
  HoaDonOff $hoadonoff,
  ChiTietHD $chitiethd,
  ChiTietHDOff $chitiethdoff,
  SanPham $sanpham
  ) {
    $this->hoadon = $hoadon;
    $this->hoadonoff = $hoadonoff;
    $this->chitiethd = $chitiethd;
    $this->chitiethdoff = $chitiethdoff;
    $this->sanpham = $sanpham;
  }
  public function doanhThu()
  {
        
    // $between = DB::select("SELECT sp.sanPham_id as 'MaSP', sp.tenSP as 'TenSP', TableA.DoanhThuOff, TableB.DoanhThuOnl
    // from san_phams sp
    return view('admin.thongke.doanhThu');
  }

  public function filter_by_date(Request $request) {
    $data = $request->all();
    $from_date = $data['from_date'];
    $to_date = $data['to_date'];

    $hoadon = HoaDon::whereBetween('ngayLap', [$from_date, $to_date])->where('tinhTrang', 4)->orderBy('ngayLap', 'ASC')->get();
    $hoadonoff = HoaDonOff::whereBetween('ngayLap', [$from_date, $to_date])->orderBy('ngayLap', 'ASC')->get();
    
    $chitiethd = $this->chitiethd->get();
    $chitiethdoff = $this->chitiethdoff->get();
    date_default_timezone_set('UTC');
    $chart_data = [];
    while (strtotime($from_date) <= strtotime($to_date)) {
        $tongHD = 0;
        $doanhThuOff = 0;
        $doanhThuOnl = 0;
        $tongSL = 0;
        foreach($hoadon as $item) {
          if($item->ngayLap == $from_date) {
            foreach($chitiethd as $cthd) {
              if($item->hoaDon_id == $cthd->hoaDon_id) {
                $tongSL += $cthd->soLuong;
              }
            }
            $tongHD++;
            $doanhThuOff += $item->tongTien;
          }
        }
        foreach($hoadonoff as $item) {
          if($item->ngayLap == $from_date) {
            foreach($chitiethdoff as $cthdoff) {
              if($item->hoaDonOff_id == $cthdoff->hoaDonOff_id) {
                $tongSL += $cthdoff->soLuong;
              }
            }
            $tongHD++;
            $doanhThuOnl += $item->tongTien;
          }
        }
        $chart_data[] = array(
          'period' => $from_date,
          'order' => $tongHD,
          'doanhThuOff' => $doanhThuOff,
          'doanhThuOnl' => $doanhThuOnl,
          'sales' => $doanhThuOff + $doanhThuOnl,
          'quantity' => $tongSL
        );
        $from_date = date("Y-m-d", strtotime("+1 days", strtotime($from_date)));
    }
    $temp = $chart_data;
    for ($i = 0; $i < count($temp); $i++) {
      if($chart_data[$i]['order'] == 0) {
        unset($chart_data[$i]);
      }
    }
    $chart_data = array_values($chart_data);
    echo $data = json_encode($chart_data);
  }

  public function dashboard_filter(Request $request) {
    $data = $request->all();
    // $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
    $chart_data = [];

    $dau_thangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
    $dau_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
    $cuoi_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
    
    $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
    $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();

    $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

    if($data['dashboard_value'] == '7ngay') {
      $hoadon = HoaDon::whereBetween('ngayLap', [$sub7days, $now])->where('tinhTrang', 4)->orderBy('ngayLap', 'ASC')->get();
      $hoadonoff = HoaDonOff::whereBetween('ngayLap', [$sub7days, $now])->orderBy('ngayLap', 'ASC')->get();
      
      $chitiethd = $this->chitiethd->get();
      $chitiethdoff = $this->chitiethdoff->get();
      date_default_timezone_set('UTC');
      $chart_data = [];
      while (strtotime($sub7days) <= strtotime($now)) {
          $tongHD = 0;
          $doanhThuOff = 0;
          $doanhThuOnl = 0;
          $tongSL = 0;
          foreach($hoadon as $item) {
            if($item->ngayLap == $sub7days) {
              foreach($chitiethd as $cthd) {
                if($item->hoaDon_id == $cthd->hoaDon_id) {
                  $tongSL += $cthd->soLuong;
                }
              }
              $tongHD++;
              $doanhThuOff += $item->tongTien;
            }
          }
          foreach($hoadonoff as $item) {
            if($item->ngayLap == $sub7days) {
              foreach($chitiethdoff as $cthdoff) {
                if($item->hoaDonOff_id == $cthdoff->hoaDonOff_id) {
                  $tongSL += $cthdoff->soLuong;
                }
              }
              $tongHD++;
              $doanhThuOnl += $item->tongTien;
            }
          }
          $chart_data[] = array(
            'period' => $sub7days,
            'order' => $tongHD,
            'doanhThuOff' => $doanhThuOff,
            'doanhThuOnl' => $doanhThuOnl,
            'sales' => $doanhThuOff + $doanhThuOnl,
            'quantity' => $tongSL
          );
          $sub7days = date("Y-m-d", strtotime("+1 days", strtotime($sub7days)));
      }
    } else if($data['dashboard_value'] == 'thangtruoc') {
      $hoadon = HoaDon::whereBetween('ngayLap', [$dau_thangtruoc, $cuoi_thangtruoc])->where('tinhTrang', 4)->orderBy('ngayLap', 'ASC')->get();
      $hoadonoff = HoaDonOff::whereBetween('ngayLap', [$dau_thangtruoc, $cuoi_thangtruoc])->orderBy('ngayLap', 'ASC')->get();
      
      $chitiethd = $this->chitiethd->get();
      $chitiethdoff = $this->chitiethdoff->get();
      date_default_timezone_set('UTC');
      $chart_data = [];
      while (strtotime($dau_thangtruoc) <= strtotime($cuoi_thangtruoc)) {
      $tongHD = 0;
      $doanhThuOff = 0;
      $doanhThuOnl = 0;
      $tongSL = 0;
      foreach($hoadon as $item) {
        if($item->ngayLap == $dau_thangtruoc) {
          foreach($chitiethd as $cthd) {
            if($item->hoaDon_id == $cthd->hoaDon_id) {
              $tongSL += $cthd->soLuong;
            }
          }
          $tongHD++;
          $doanhThuOff += $item->tongTien;
        }
      }
      foreach($hoadonoff as $item) {
        if($item->ngayLap == $dau_thangtruoc) {
          foreach($chitiethdoff as $cthdoff) {
            if($item->hoaDonOff_id == $cthdoff->hoaDonOff_id) {
              $tongSL += $cthdoff->soLuong;
            }
          }
          $tongHD++;
          $doanhThuOnl += $item->tongTien;
        }
      }
      $chart_data[] = array(
        'period' => $dau_thangtruoc,
        'order' => $tongHD,
        'doanhThuOff' => $doanhThuOff,
        'doanhThuOnl' => $doanhThuOnl,
        'sales' => $doanhThuOff + $doanhThuOnl,
        'quantity' => $tongSL
      );
      $dau_thangtruoc = date("Y-m-d", strtotime("+1 days", strtotime($dau_thangtruoc)));
      }
    } else if($data['dashboard_value'] == 'thangnay') {
      $hoadon = HoaDon::whereBetween('ngayLap', [$dau_thangnay, $now])->where('tinhTrang', 4)->orderBy('ngayLap', 'ASC')->get();
      $hoadonoff = HoaDonOff::whereBetween('ngayLap', [$dau_thangnay, $now])->orderBy('ngayLap', 'ASC')->get();

      $chitiethd = $this->chitiethd->get();
      $chitiethdoff = $this->chitiethdoff->get();
      date_default_timezone_set('UTC');
      $chart_data = [];
      while (strtotime($dau_thangnay) <= strtotime($now)) {
          $tongHD = 0;
          $doanhThuOff = 0;
          $doanhThuOnl = 0;
          $tongSL = 0;
          foreach($hoadon as $item) {
            if($item->ngayLap == $dau_thangnay) {
              foreach($chitiethd as $cthd) {
                if($item->hoaDon_id == $cthd->hoaDon_id) {
                  $tongSL += $cthd->soLuong;
                }
              }
              $tongHD++;
              $doanhThuOff += $item->tongTien;
            }
          }
          foreach($hoadonoff as $item) {
            if($item->ngayLap == $dau_thangnay) {
              foreach($chitiethdoff as $cthdoff) {
                if($item->hoaDonOff_id == $cthdoff->hoaDonOff_id) {
                  $tongSL += $cthdoff->soLuong;
                }
              }
              $tongHD++;
              $doanhThuOnl += $item->tongTien;
            }
          }
          $chart_data[] = array(
            'period' => $dau_thangnay,
            'order' => $tongHD,
            'doanhThuOff' => $doanhThuOff,
            'doanhThuOnl' => $doanhThuOnl,
            'sales' => $doanhThuOff + $doanhThuOnl,
            'quantity' => $tongSL
          );
          $dau_thangnay = date("Y-m-d", strtotime("+1 days", strtotime($dau_thangnay)));
      }
    } else {
      $hoadon = HoaDon::whereBetween('ngayLap', [$sub365days, $now])->where('tinhTrang', 4)->orderBy('ngayLap', 'ASC')->get();
      $hoadonoff = HoaDonOff::whereBetween('ngayLap', [$sub365days, $now])->orderBy('ngayLap', 'ASC')->get();

      $chitiethd = $this->chitiethd->get();
      $chitiethdoff = $this->chitiethdoff->get();
      date_default_timezone_set('UTC');
      $chart_data = [];
      while (strtotime($sub365days) <= strtotime($now)) {
          $tongHD = 0;
          $doanhThuOff = 0;
          $doanhThuOnl = 0;
          $tongSL = 0;
          foreach($hoadon as $item) {
            if($item->ngayLap == $sub365days) {
              foreach($chitiethd as $cthd) {
                if($item->hoaDon_id == $cthd->hoaDon_id) {
                  $tongSL += $cthd->soLuong;
                }
              }
              $tongHD++;
              $doanhThuOff += $item->tongTien;
            }
          }
          foreach($hoadonoff as $item) {
            if($item->ngayLap == $sub365days) {
              foreach($chitiethdoff as $cthdoff) {
                if($item->hoaDonOff_id == $cthdoff->hoaDonOff_id) {
                  $tongSL += $cthdoff->soLuong;
                }
              }
              $tongHD++;
              $doanhThuOnl += $item->tongTien;
            }
          }
          $chart_data[] = array(
            'period' => $sub365days,
            'order' => $tongHD,
            'doanhThuOff' => $doanhThuOff,
            'doanhThuOnl' => $doanhThuOnl,
            'sales' => $doanhThuOff + $doanhThuOnl,
            'quantity' => $tongSL
          );
          $sub365days = date("Y-m-d", strtotime("+1 days", strtotime($sub365days)));
      }
    }

    date_default_timezone_set('UTC');

    $temp = $chart_data;
    for ($i = 0; $i < count($temp); $i++) {
      if($chart_data[$i]['order'] == 0) {
        unset($chart_data[$i]);
      }
    }
    $chart_data = array_values($chart_data);

    echo $data = json_encode($chart_data);
  }

  public function theoSanPham() {
    $htmlOptionSanPham = $this->getSanPham($sanPham_id_fk = '');
    return view('admin.thongke.theoSanPham', compact('htmlOptionSanPham'));
  }

  public function getSanPham($sanPham_id_fk)
  {
    $data = $this->sanpham->all();
    $recursiveSanPham = new SanPhamRecursive($data);
    $htmlOptionSanPham = $recursiveSanPham->SanPhamRecursive($sanPham_id_fk);
    return $htmlOptionSanPham;
  }

  public function product_filter_by_date(Request $request) {
    $data = $request->all();
    $from_date = $data['from_date'];
    $to_date = $data['to_date'];
    $productId = $data['product_id'];

    if($productId == "null") {
      $between = DB::select("SELECT sp.sanPham_id as 'MaSP', sp.tenSP as 'TenSP', TableA.DoanhThuOff, TableB.DoanhThuOnl, TableA.LaiSuatOff, TableB.LaiSuatOnl
      from san_phams sp
      left outer join(
        SELECT sp.sanPham_id, sum(sp.donGia * cthdoff.soLuong) as 'DoanhThuOff', sum(sp.giaNhap * cthdoff.soLuong) as 'LaiSuatOff'
        from san_phams sp, hoadonoff hdoff, chitiethdoff cthdoff
        where sp.sanPham_id = cthdoff.sanPham_id and hdoff.hoaDonOff_id = cthdoff.hoaDonOff_id and hdoff.ngayLap BETWEEN '$from_date' and '$to_date'
        group by sp.sanPham_id) as TableA on sp.sanPham_id = TableA.sanPham_id
      left outer join(
        SELECT sp.sanPham_id, sum(sp.donGia * cthd.soLuong) as 'DoanhThuOnl', sum(sp.giaNhap * cthd.soLuong) as 'LaiSuatOnl'
        from san_phams sp, hoadon hd, chitiethd cthd
        where sp.sanPham_id = cthd.sanPham_id and hd.hoaDon_id = cthd.hoaDon_id and hd.TinhTrang = 4 and hd.ngayLap BETWEEN '$from_date' and '$to_date'
        group by sp.sanPham_id) as TableB on sp.sanPham_id = TableB.sanPham_id
      ");
    } else {
      $between = DB::select("SELECT sp.sanPham_id as 'MaSP', sp.tenSP as 'TenSP', TableA.DoanhThuOff, TableB.DoanhThuOnl, TableA.LaiSuatOff, TableB.LaiSuatOnl
      from san_phams sp
      left outer join(
        SELECT sp.sanPham_id, sum(sp.donGia * cthdoff.soLuong) as 'DoanhThuOff', sum(sp.giaNhap * cthdoff.soLuong) as 'LaiSuatOff'
        from san_phams sp, hoadonoff hdoff, chitiethdoff cthdoff
        where sp.sanPham_id = $productId and sp.sanPham_id = cthdoff.sanPham_id and hdoff.hoaDonOff_id = cthdoff.hoaDonOff_id and hdoff.ngayLap BETWEEN '$from_date' and '$to_date'
        group by sp.sanPham_id) as TableA on sp.sanPham_id = TableA.sanPham_id
      left outer join(
        SELECT sp.sanPham_id, sum(sp.donGia * cthd.soLuong) as 'DoanhThuOnl', sum(sp.giaNhap * cthd.soLuong) as 'LaiSuatOnl'
        from san_phams sp, hoadon hd, chitiethd cthd
        where sp.sanPham_id = $productId and sp.sanPham_id = cthd.sanPham_id and hd.hoaDon_id = cthd.hoaDon_id and hd.TinhTrang = 4 and hd.ngayLap BETWEEN '$from_date' and '$to_date'
        group by sp.sanPham_id) as TableB on sp.sanPham_id = TableB.sanPham_id
      ");
    }

    foreach ($between as $key => $val) {
      if($val->DoanhThuOff == NULL) {
        $val->DoanhThuOff = 0;
      }
      if($val->DoanhThuOnl == NULL) {
        $val->DoanhThuOnl = 0;
      }
      $chart_data[] = array(
        'product' => $val->TenSP,
        'doanhThuOff' => $val->DoanhThuOff,
        'doanhThuOnl' => $val->DoanhThuOnl,
        'sales' => $val->DoanhThuOff + $val->DoanhThuOnl,
        'laiSuat' => ($val->DoanhThuOff + $val->DoanhThuOnl) - ($val->LaiSuatOff + $val->LaiSuatOnl)
      );
    }

    $temp = $chart_data;
    for ($i = 0; $i < count($temp); $i++) {
      if($chart_data[$i]['sales'] == 0) {
        unset($chart_data[$i]);
      }
    }
    $chart_data = array_values($chart_data);
    echo $data = json_encode($chart_data);
  }

  public function product_dashboard_filter(Request $request) {
    $data = $request->all();
    $productId = $data['product_id'];

    // $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
    $chart_data = [];

    $dau_thangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
    $dau_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
    $cuoi_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
    
    $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
    $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();

    $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

    if($data['dashboard_value'] == '7ngay') {
      if($productId == "null") {
        $between = DB::select("SELECT sp.sanPham_id as 'MaSP', sp.tenSP as 'TenSP', TableA.DoanhThuOff, TableB.DoanhThuOnl, TableA.LaiSuatOff, TableB.LaiSuatOnl
        from san_phams sp
        left outer join(
          SELECT sp.sanPham_id, sum(sp.donGia * cthdoff.soLuong) as 'DoanhThuOff', sum(sp.giaNhap * cthdoff.soLuong) as 'LaiSuatOff'
          from san_phams sp, hoadonoff hdoff, chitiethdoff cthdoff
          where sp.sanPham_id = cthdoff.sanPham_id and hdoff.hoaDonOff_id = cthdoff.hoaDonOff_id and hdoff.ngayLap BETWEEN '$sub7days' and '$now'
          group by sp.sanPham_id) as TableA on sp.sanPham_id = TableA.sanPham_id
        left outer join(
          SELECT sp.sanPham_id, sum(sp.donGia * cthd.soLuong) as 'DoanhThuOnl', sum(sp.giaNhap * cthd.soLuong) as 'LaiSuatOnl'
          from san_phams sp, hoadon hd, chitiethd cthd
          where sp.sanPham_id = cthd.sanPham_id and hd.hoaDon_id = cthd.hoaDon_id and hd.TinhTrang = 4 and hd.ngayLap BETWEEN '$sub7days' and '$now'
          group by sp.sanPham_id) as TableB on sp.sanPham_id = TableB.sanPham_id
        ");
      } else {
        $between = DB::select("SELECT sp.sanPham_id as 'MaSP', sp.tenSP as 'TenSP', TableA.DoanhThuOff, TableB.DoanhThuOnl, TableA.LaiSuatOff, TableB.LaiSuatOnl
        from san_phams sp
        left outer join(
          SELECT sp.sanPham_id, sum(sp.donGia * cthdoff.soLuong) as 'DoanhThuOff', sum(sp.giaNhap * cthdoff.soLuong) as 'LaiSuatOff'
          from san_phams sp, hoadonoff hdoff, chitiethdoff cthdoff
          where sp.sanPham_id = $productId and sp.sanPham_id = cthdoff.sanPham_id and hdoff.hoaDonOff_id = cthdoff.hoaDonOff_id and hdoff.ngayLap BETWEEN '$sub7days' and '$now'
          group by sp.sanPham_id) as TableA on sp.sanPham_id = TableA.sanPham_id
        left outer join(
          SELECT sp.sanPham_id, sum(sp.donGia * cthd.soLuong) as 'DoanhThuOnl', sum(sp.giaNhap * cthd.soLuong) as 'LaiSuatOnl'
          from san_phams sp, hoadon hd, chitiethd cthd
          where sp.sanPham_id = $productId and sp.sanPham_id = cthd.sanPham_id and hd.hoaDon_id = cthd.hoaDon_id and hd.TinhTrang = 4 and hd.ngayLap BETWEEN '$sub7days' and '$now'
          group by sp.sanPham_id) as TableB on sp.sanPham_id = TableB.sanPham_id
        ");
      }
    } else if($data['dashboard_value'] == 'thangtruoc') {
      if($productId == "null") {
        $between = DB::select("SELECT sp.sanPham_id as 'MaSP', sp.tenSP as 'TenSP', TableA.DoanhThuOff, TableB.DoanhThuOnl, TableA.LaiSuatOff, TableB.LaiSuatOnl
        from san_phams sp
        left outer join(
          SELECT sp.sanPham_id, sum(sp.donGia * cthdoff.soLuong) as 'DoanhThuOff', sum(sp.giaNhap * cthdoff.soLuong) as 'LaiSuatOff'
          from san_phams sp, hoadonoff hdoff, chitiethdoff cthdoff
          where sp.sanPham_id = cthdoff.sanPham_id and hdoff.hoaDonOff_id = cthdoff.hoaDonOff_id and hdoff.ngayLap BETWEEN '$dau_thangtruoc' and '$cuoi_thangtruoc'
          group by sp.sanPham_id) as TableA on sp.sanPham_id = TableA.sanPham_id
        left outer join(
          SELECT sp.sanPham_id, sum(sp.donGia * cthd.soLuong) as 'DoanhThuOnl', sum(sp.giaNhap * cthd.soLuong) as 'LaiSuatOnl'
          from san_phams sp, hoadon hd, chitiethd cthd
          where sp.sanPham_id = cthd.sanPham_id and hd.hoaDon_id = cthd.hoaDon_id and hd.TinhTrang = 4 and hd.ngayLap BETWEEN '$dau_thangtruoc' and '$cuoi_thangtruoc'
          group by sp.sanPham_id) as TableB on sp.sanPham_id = TableB.sanPham_id
        ");
      } else {
        $between = DB::select("SELECT sp.sanPham_id as 'MaSP', sp.tenSP as 'TenSP', TableA.DoanhThuOff, TableB.DoanhThuOnl, TableA.LaiSuatOff, TableB.LaiSuatOnl
        from san_phams sp
        left outer join(
          SELECT sp.sanPham_id, sum(sp.donGia * cthdoff.soLuong) as 'DoanhThuOff', sum(sp.giaNhap * cthdoff.soLuong) as 'LaiSuatOff'
          from san_phams sp, hoadonoff hdoff, chitiethdoff cthdoff
          where sp.sanPham_id = $productId and sp.sanPham_id = cthdoff.sanPham_id and hdoff.hoaDonOff_id = cthdoff.hoaDonOff_id and hdoff.ngayLap BETWEEN '$dau_thangtruoc' and '$cuoi_thangtruoc'
          group by sp.sanPham_id) as TableA on sp.sanPham_id = TableA.sanPham_id
        left outer join(
          SELECT sp.sanPham_id, sum(sp.donGia * cthd.soLuong) as 'DoanhThuOnl', sum(sp.giaNhap * cthd.soLuong) as 'LaiSuatOnl'
          from san_phams sp, hoadon hd, chitiethd cthd
          where sp.sanPham_id = $productId and sp.sanPham_id = cthd.sanPham_id and hd.hoaDon_id = cthd.hoaDon_id and hd.TinhTrang = 4 and hd.ngayLap BETWEEN '$dau_thangtruoc' and '$cuoi_thangtruoc'
          group by sp.sanPham_id) as TableB on sp.sanPham_id = TableB.sanPham_id
        ");
      }
    } else if($data['dashboard_value'] == 'thangnay') {
      if($productId == "null") {
        $between = DB::select("SELECT sp.sanPham_id as 'MaSP', sp.tenSP as 'TenSP', TableA.DoanhThuOff, TableB.DoanhThuOnl, TableA.LaiSuatOff, TableB.LaiSuatOnl
        from san_phams sp
        left outer join(
          SELECT sp.sanPham_id, sum(sp.donGia * cthdoff.soLuong) as 'DoanhThuOff', sum(sp.giaNhap * cthdoff.soLuong) as 'LaiSuatOff'
          from san_phams sp, hoadonoff hdoff, chitiethdoff cthdoff
          where sp.sanPham_id = cthdoff.sanPham_id and hdoff.hoaDonOff_id = cthdoff.hoaDonOff_id and hdoff.ngayLap BETWEEN '$dau_thangnay' and '$now'
          group by sp.sanPham_id) as TableA on sp.sanPham_id = TableA.sanPham_id
        left outer join(
          SELECT sp.sanPham_id, sum(sp.donGia * cthd.soLuong) as 'DoanhThuOnl', sum(sp.giaNhap * cthd.soLuong) as 'LaiSuatOnl'
          from san_phams sp, hoadon hd, chitiethd cthd
          where sp.sanPham_id = cthd.sanPham_id and hd.hoaDon_id = cthd.hoaDon_id and hd.TinhTrang = 4 and hd.ngayLap BETWEEN '$dau_thangnay' and '$now'
          group by sp.sanPham_id) as TableB on sp.sanPham_id = TableB.sanPham_id
        ");
      } else {
        $between = DB::select("SELECT sp.sanPham_id as 'MaSP', sp.tenSP as 'TenSP', TableA.DoanhThuOff, TableB.DoanhThuOnl, TableA.LaiSuatOff, TableB.LaiSuatOnl
        from san_phams sp
        left outer join(
          SELECT sp.sanPham_id, sum(sp.donGia * cthdoff.soLuong) as 'DoanhThuOff', sum(sp.giaNhap * cthdoff.soLuong) as 'LaiSuatOff'
          from san_phams sp, hoadonoff hdoff, chitiethdoff cthdoff
          where sp.sanPham_id = $productId and sp.sanPham_id = cthdoff.sanPham_id and hdoff.hoaDonOff_id = cthdoff.hoaDonOff_id and hdoff.ngayLap BETWEEN '$dau_thangnay' and '$now'
          group by sp.sanPham_id) as TableA on sp.sanPham_id = TableA.sanPham_id
        left outer join(
          SELECT sp.sanPham_id, sum(sp.donGia * cthd.soLuong) as 'DoanhThuOnl', sum(sp.giaNhap * cthd.soLuong) as 'LaiSuatOnl'
          from san_phams sp, hoadon hd, chitiethd cthd
          where sp.sanPham_id = $productId and sp.sanPham_id = cthd.sanPham_id and hd.hoaDon_id = cthd.hoaDon_id and hd.TinhTrang = 4 and hd.ngayLap BETWEEN '$dau_thangnay' and '$now'
          group by sp.sanPham_id) as TableB on sp.sanPham_id = TableB.sanPham_id
        ");
      }
    } else {
      if($productId == "null") {
        $between = DB::select("SELECT sp.sanPham_id as 'MaSP', sp.tenSP as 'TenSP', TableA.DoanhThuOff, TableB.DoanhThuOnl, TableA.LaiSuatOff, TableB.LaiSuatOnl
        from san_phams sp
        left outer join(
          SELECT sp.sanPham_id, sum(sp.donGia * cthdoff.soLuong) as 'DoanhThuOff', sum(sp.giaNhap * cthdoff.soLuong) as 'LaiSuatOff'
          from san_phams sp, hoadonoff hdoff, chitiethdoff cthdoff
          where sp.sanPham_id = cthdoff.sanPham_id and hdoff.hoaDonOff_id = cthdoff.hoaDonOff_id and hdoff.ngayLap BETWEEN '$sub365days' and '$now'
          group by sp.sanPham_id) as TableA on sp.sanPham_id = TableA.sanPham_id
        left outer join(
          SELECT sp.sanPham_id, sum(sp.donGia * cthd.soLuong) as 'DoanhThuOnl', sum(sp.giaNhap * cthd.soLuong) as 'LaiSuatOnl'
          from san_phams sp, hoadon hd, chitiethd cthd
          where sp.sanPham_id = cthd.sanPham_id and hd.hoaDon_id = cthd.hoaDon_id and hd.TinhTrang = 4 and hd.ngayLap BETWEEN '$sub365days' and '$now'
          group by sp.sanPham_id) as TableB on sp.sanPham_id = TableB.sanPham_id
        ");
      } else {
        $between = DB::select("SELECT sp.sanPham_id as 'MaSP', sp.tenSP as 'TenSP', TableA.DoanhThuOff, TableB.DoanhThuOnl, TableA.LaiSuatOff, TableB.LaiSuatOnl
        from san_phams sp
        left outer join(
          SELECT sp.sanPham_id, sum(sp.donGia * cthdoff.soLuong) as 'DoanhThuOff', sum(sp.giaNhap * cthdoff.soLuong) as 'LaiSuatOff'
          from san_phams sp, hoadonoff hdoff, chitiethdoff cthdoff
          where sp.sanPham_id = $productId and sp.sanPham_id = cthdoff.sanPham_id and hdoff.hoaDonOff_id = cthdoff.hoaDonOff_id and hdoff.ngayLap BETWEEN '$sub365days' and '$now'
          group by sp.sanPham_id) as TableA on sp.sanPham_id = TableA.sanPham_id
        left outer join(
          SELECT sp.sanPham_id, sum(sp.donGia * cthd.soLuong) as 'DoanhThuOnl', sum(sp.giaNhap * cthd.soLuong) as 'LaiSuatOnl'
          from san_phams sp, hoadon hd, chitiethd cthd
          where sp.sanPham_id = $productId and sp.sanPham_id = cthd.sanPham_id and hd.hoaDon_id = cthd.hoaDon_id and hd.TinhTrang = 4 and hd.ngayLap BETWEEN '$sub365days' and '$now'
          group by sp.sanPham_id) as TableB on sp.sanPham_id = TableB.sanPham_id
        ");
      }
    }

    foreach ($between as $key => $val) {
      if($val->DoanhThuOff == NULL) {
        $val->DoanhThuOff = 0;
      }
      if($val->DoanhThuOnl == NULL) {
        $val->DoanhThuOnl = 0;
      }
      $chart_data[] = array(
        'product' => $val->TenSP,
        'doanhThuOff' => $val->DoanhThuOff,
        'doanhThuOnl' => $val->DoanhThuOnl,
        'sales' => $val->DoanhThuOff + $val->DoanhThuOnl,
        'laiSuat' => ($val->DoanhThuOff + $val->DoanhThuOnl) - ($val->LaiSuatOff + $val->LaiSuatOnl)
      );
    }

    $temp = $chart_data;
    for ($i = 0; $i < count($temp); $i++) {
      if($chart_data[$i]['sales'] == 0) {
        unset($chart_data[$i]);
      }
    }
    $chart_data = array_values($chart_data);
    echo $data = json_encode($chart_data);
  }

  public function theoHinhThucKD() {
    return view('admin.thongke.theoHinhThucKD');
  }

  public function type_bussiness_filter_by_date(Request $request) {
    $data = $request->all();
    $from_date = $data['from_date'];
    $to_date = $data['to_date'];
    $totalOnline = DB::select("SELECT sum(hd.tongTien) as 'DoanhThuOnl'
    from hoadon hd
    where hd.TinhTrang = 4 and hd.ngayLap BETWEEN '$from_date' and '$to_date'");
    $totalOffline = DB::select("SELECT sum(hdoff.tongTien) as 'DoanhThuOff'
    from hoadonoff hdoff
    where hdoff.ngayLap BETWEEN '$from_date' and '$to_date'");
    if($totalOnline[0]->DoanhThuOnl == null) {
      $totalOnline[0]->DoanhThuOnl = 0;
    }
    if($totalOffline[0]->DoanhThuOff == null) {
      $totalOffline[0]->DoanhThuOff = 0;
    }
    $chart_data[] = array(
      'DoanhThuOnl' => $totalOnline[0]->DoanhThuOnl,
      'DoanhThuOff' => $totalOffline[0]->DoanhThuOff,
    );
    // dd($chart_data);s
    echo $data = json_encode($chart_data);
  }

  public function type_bussiness_dashboard_filter(Request $request) {
    $data = $request->all();
    // $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
    $chart_data = [];

    $dau_thangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
    $dau_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
    $cuoi_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
    
    $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
    $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();

    $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

    if($data['dashboard_value'] == '7ngay') {
      $totalOnline = DB::select("SELECT sum(hd.tongTien) as 'DoanhThuOnl'
      from hoadon hd
      where hd.TinhTrang = 4 and hd.ngayLap BETWEEN '$sub7days' and '$now'");
      $totalOffline = DB::select("SELECT sum(hdoff.tongTien) as 'DoanhThuOff'
      from hoadonoff hdoff
      where hdoff.ngayLap BETWEEN '$sub7days' and '$now'");
    } else if($data['dashboard_value'] == 'thangtruoc') {
      $totalOnline = DB::select("SELECT sum(hd.tongTien) as 'DoanhThuOnl'
      from hoadon hd
      where hd.TinhTrang = 4 and hd.ngayLap BETWEEN '$dau_thangtruoc' and '$cuoi_thangtruoc'");
      $totalOffline = DB::select("SELECT sum(hdoff.tongTien) as 'DoanhThuOff'
      from hoadonoff hdoff
      where hdoff.ngayLap BETWEEN '$dau_thangtruoc' and '$cuoi_thangtruoc'");
    }  else if($data['dashboard_value'] == 'thangnay') {
      $totalOnline = DB::select("SELECT sum(hd.tongTien) as 'DoanhThuOnl'
      from hoadon hd
      where hd.TinhTrang = 4 and hd.ngayLap BETWEEN '$dau_thangnay' and '$now'");
      $totalOffline = DB::select("SELECT sum(hdoff.tongTien) as 'DoanhThuOff'
      from hoadonoff hdoff
      where hdoff.ngayLap BETWEEN '$dau_thangnay' and '$now'");
    } else {
      $totalOnline = DB::select("SELECT sum(hd.tongTien) as 'DoanhThuOnl'
      from hoadon hd
      where hd.TinhTrang = 4 and hd.ngayLap BETWEEN '$sub365days' and '$now'");
      $totalOffline = DB::select("SELECT sum(hdoff.tongTien) as 'DoanhThuOff'
      from hoadonoff hdoff
      where hdoff.ngayLap BETWEEN '$sub365days' and '$now'");
    }

    date_default_timezone_set('UTC');

    if($totalOnline[0]->DoanhThuOnl == null) {
      $totalOnline[0]->DoanhThuOnl = 0;
    }
    if($totalOffline[0]->DoanhThuOff == null) {
      $totalOffline[0]->DoanhThuOff = 0;
    }
    $chart_data[] = array(
      'DoanhThuOnl' => $totalOnline[0]->DoanhThuOnl,
      'DoanhThuOff' => $totalOffline[0]->DoanhThuOff,
    );

    echo $data = json_encode($chart_data);
  }
}
