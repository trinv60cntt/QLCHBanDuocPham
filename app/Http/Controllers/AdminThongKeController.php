<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ThongKe;
use App\Models\HoaDon;
use App\Models\SanPham;
use App\Models\ChiTietHD;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminThongKeController extends Controller
{  
  public function __construct(
  HoaDon $hoadon,
  ChiTietHD $chitiethd,
  SanPham $sanpham
  ) {
    $this->hoadon = $hoadon;
    $this->chitiethd = $chitiethd;
    $this->sanpham = $sanpham;
  }
  public function doanhThu()
  {
    return view('admin.thongke.doanhThu');
  }

  public function filter_by_date(Request $request) {
    $data = $request->all();
    $from_date = $data['from_date'];
    $to_date = $data['to_date'];
    
    $hoadon = HoaDon::whereBetween('ngayLap', [$from_date, $to_date])->where('tinhTrang', 4)->orderBy('ngayLap', 'ASC')->get();
    $chitiethd = $this->chitiethd->get();
    date_default_timezone_set('UTC');
    $chart_data = [];
    while (strtotime($from_date) <= strtotime($to_date)) {
        $tongHD = 0;
        $tongTien = 0;
        $tongSL = 0;
        foreach($hoadon as $item) {
          if($item->ngayLap == $from_date) {
            foreach($chitiethd as $cthd) {
              if($item->hoaDon_id == $cthd->hoaDon_id) {
                $tongSL += $cthd->soLuong;
              }
            }
            $tongHD++;
            $tongTien += $item->tongTien;
          }
        }
        $chart_data[] = array(
          'period' => $from_date,
          'order' => $tongHD,
          'sales' => $tongTien,
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
    $chitiethd = $this->chitiethd->get();
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

      while (strtotime($sub7days) <= strtotime($now)) {
        $tongHD = 0;
        $tongTien = 0;
        $tongSL = 0;
        foreach($hoadon as $item) {
          if($item->ngayLap == $sub7days) {
            foreach($chitiethd as $cthd) {
              if($item->hoaDon_id == $cthd->hoaDon_id) {
                $tongSL += $cthd->soLuong;
              }
            }
            $tongHD++;
            $tongTien += $item->tongTien;
          }
        }
        $chart_data[] = array(
          'period' => $sub7days,
          'order' => $tongHD,
          'sales' => $tongTien,
          'quantity' => $tongSL
        );
        $sub7days = date("Y-m-d", strtotime("+1 days", strtotime($sub7days)));
      }
    } else if($data['dashboard_value'] == 'thangtruoc') {
      $hoadon = HoaDon::whereBetween('ngayLap', [$dau_thangtruoc, $cuoi_thangtruoc])->where('tinhTrang', 4)->orderBy('ngayLap', 'ASC')->get();
      while (strtotime($dau_thangtruoc) <= strtotime($cuoi_thangtruoc)) {
        $tongHD = 0;
        $tongTien = 0;
        $tongSL = 0;
        foreach($hoadon as $item) {
          if($item->ngayLap == $dau_thangtruoc) {
            foreach($chitiethd as $cthd) {
              if($item->hoaDon_id == $cthd->hoaDon_id) {
                $tongSL += $cthd->soLuong;
              }
            }
            $tongHD++;
            $tongTien += $item->tongTien;
          }
        }
        $chart_data[] = array(
          'period' => $dau_thangtruoc,
          'order' => $tongHD,
          'sales' => $tongTien,
          'quantity' => $tongSL
        );
        $dau_thangtruoc = date("Y-m-d", strtotime("+1 days", strtotime($dau_thangtruoc)));
      }
    } else if($data['dashboard_value'] == 'thangnay') {
      $hoadon = HoaDon::whereBetween('ngayLap', [$dau_thangnay, $now])->where('tinhTrang', 4)->orderBy('ngayLap', 'ASC')->get();
            while (strtotime($dau_thangnay) <= strtotime($now)) {
        $tongHD = 0;
        $tongTien = 0;
        $tongSL = 0;
        foreach($hoadon as $item) {
          if($item->ngayLap == $dau_thangnay) {
            foreach($chitiethd as $cthd) {
              if($item->hoaDon_id == $cthd->hoaDon_id) {
                $tongSL += $cthd->soLuong;
              }
            }
            $tongHD++;
            $tongTien += $item->tongTien;
          }
        }
        $chart_data[] = array(
          'period' => $dau_thangnay,
          'order' => $tongHD,
          'sales' => $tongTien,
          'quantity' => $tongSL
        );
        $dau_thangnay = date("Y-m-d", strtotime("+1 days", strtotime($dau_thangnay)));
      }


    } else {
      $hoadon = HoaDon::whereBetween('ngayLap', [$sub365days, $now])->where('tinhTrang', 4)->orderBy('ngayLap', 'ASC')->get();
            while (strtotime($sub365days) <= strtotime($now)) {
        $tongHD = 0;
        $tongTien = 0;
        $tongSL = 0;
        foreach($hoadon as $item) {
          if($item->ngayLap == $sub365days) {
            foreach($chitiethd as $cthd) {
              if($item->hoaDon_id == $cthd->hoaDon_id) {
                $tongSL += $cthd->soLuong;
              }
            }
            $tongHD++;
            $tongTien += $item->tongTien;
          }
        }
        $chart_data[] = array(
          'period' => $sub365days,
          'order' => $tongHD,
          'sales' => $tongTien,
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
    return view('admin.thongke.theoSanPham');
  }

  public function product_filter_by_date(Request $request) {
    $data = $request->all();
    $from_date = $data['from_date'];
    $to_date = $data['to_date'];
    $chitiethd = DB::select("SELECT sp.sanPham_id, sum(sp.donGia * cthd.soLuong) as 'DoanhThuOnl'
    from san_phams sp, hoadon hd, chitiethd cthd
     where sp.sanPham_id = cthd.sanPham_id and hd.hoaDon_id = cthd.hoaDon_id and hd.TinhTrang = 4 and hd.ngayLap BETWEEN '$from_date' and '$to_date'
     group by sp.sanPham_id");
    $sanpham = $this->sanpham->get();
    foreach ($chitiethd as $key => $val) {
      foreach($sanpham as $sp) {
        if($val->sanPham_id == $sp->sanPham_id) {
          $name = $sp->tenSP;
        }
      }
      $chart_data[] = array(
        'product' => $name,
        'sales' => $val->DoanhThuOnl
      );
    }

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
    $chart_data[] = array(
      'DoanhThuOnl' => $totalOnline[0]->DoanhThuOnl,
      'DoanhThuOff' => $totalOffline[0]->DoanhThuOff,
    );

    echo $data = json_encode($chart_data);
  }
}
