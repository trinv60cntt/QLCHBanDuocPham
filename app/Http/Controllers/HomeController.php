<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\DanhMuc;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

  public function __construct(
    SanPham $sanpham
  ) {
    $this->sanpham = $sanpham;
  }

  public function index() {
    $sanPhamCovid = SanPham::where('danhMuc_id', 11)->latest()->take(6)->get();

    $data = [];
    $dau_thangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
    $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
    $between = DB::select("SELECT sp.\"sanPham_id\" as \"MaSP\", sp.\"tenSP\" as \"TenSP\", TableA.\"SLBanChayOff\", TableB.\"SLBanChayOnl\"
    from san_phams sp
    left outer join(
      SELECT sp.\"sanPham_id\", sum(cthdoff.\"soLuong\") as \"SLBanChayOff\"
      from san_phams sp, hoadonoff hdoff, chitiethdoff cthdoff
      where sp.\"sanPham_id\" = cthdoff.\"sanPham_id\" and hdoff.\"hoaDonOff_id\" = cthdoff.\"hoaDonOff_id\" and hdoff.\"ngayLap\" >= \'$dau_thangnay\' and hdoff.\"ngayLap\" <= \'$now\'
      group by sp.\"sanPham_id\") as TableA on sp.\"sanPham_id\" = TableA.sanPham_id
    left outer join(
      SELECT sp.\"sanPham_id\", sum(cthd.\"soLuong\") as \"SLBanChayOnl\"
      from san_phams sp, hoadon hd, chitiethd cthd
      where sp.\"sanPham_id\" = cthd.\"sanPham_id\" and hd.\"hoaDon_id\" = cthd.\"hoaDon_id\" and hd.\"TinhTrang\" = \'4\' and hd.\"ngayLap\" >= \'$dau_thangnay\' and hdoff.\"ngayLap\" <= \'$now\'
      group by sp.\"sanPham_id\") as TableB on sp.\"sanPham_id\" = TableB.\"sanPham_id\"
    ");
    foreach ($between as $key => $val) {
      if($val->SLBanChayOff == NULL) {
        $val->SLBanChayOff = 0;
      }
      if($val->SLBanChayOnl == NULL) {
        $val->SLBanChayOnl = 0;
      }
      $data[] = array(
        'MaSP' => $val->MaSP,
        'SLBanChayOff' => $val->SLBanChayOff,
        'SLBanChayOnl' => $val->SLBanChayOnl,
      );
    }

    $temp = $data;
    for ($i = 0; $i < count($temp); $i++) {
      if(($data[$i]['SLBanChayOff'] == 0 && $data[$i]['SLBanChayOnl'] == 0)) {
        unset($data[$i]);
      }
    }

    $data = array_values($data);
    $temp1 = $data;
    for ($i = 0; $i < count($temp1); $i++) {
      if(($data[$i]['SLBanChayOff'] + $data[$i]['SLBanChayOnl']) < 5) {
        unset($data[$i]);
      }
    }
    $data = array_values($data);

    $sanpham = $this->sanpham->get();
    $sanphams = [];
    foreach($sanpham as $item) {
        foreach($data as $dt) {
          if($item->sanPham_id == $dt['MaSP']) {
            $sanphams[] = array(
              'sanPham_id' => $item->sanPham_id,
              'hinhAnh' => $item->hinhAnh,
              'tenSP' => $item->tenSP,
              'donGia' => $item->donGia,
              'donViTinh' => $item->donViTinh,
            );
          }
      }
    }

    $sanphams = array_slice($sanphams, 0, 5);

    return view('home.home', compact('sanphams', 'sanPhamCovid'));
  }

  public function autocomplete_ajax(Request $request) {
    $data = $request->all();

    if($data['query']) {
      $sanpham = SanPham::where('tenSP','LIKE','%'.$data['query'].'%')->get();

      $output = '<ul style="display:block; position:relative">';

      foreach($sanpham as $key => $val) {
        $output .= '
        <div class="flex"><i class="fas fa-search"></i><li class="li_search_ajax cursor-pointer">'.$val->tenSP.'</li></div>
        ';
      }

      $output .= '</ul>';
      echo $output;
    }
  }

}
