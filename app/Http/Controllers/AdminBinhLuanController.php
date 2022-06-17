<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BinhLuan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Traits\StorageImageTrait;
use Carbon\Carbon;

class AdminBinhLuanController extends Controller
{
  // use StorageImageTrait;

  public function __construct(
    BinhLuan $binhluan
  ) {
    $this->binhluan = $binhluan;
  }

  public function index()
  {
    // $binhluans = $this->binhluan->with('sanpham')->latest()->paginate(10);
    $binhluans = BinhLuan::with('sanpham')->where('binhLuanCha_id', '=', 0)->latest()->paginate(10);
    $comment_rep = BinhLuan::with('sanpham')->where('binhLuanCha_id', '>', 0)->orderBy('binhLuan_id', 'DESC')->paginate(10);
    return view('admin.binhluan.index', compact('binhluans', 'comment_rep'));
  }

  public function replyComment(Request $request) {
    $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

    $data = $request->all();
    $binhluan = new BinhLuan();
    $binhluan->noiDung = $data['comment'];
    $binhluan->sanPham_id = $data['comment_product_id'];
    $binhluan->binhLuanCha_id = $data['comment_id'];
    $binhluan->tinhTrang = 0;
    $binhluan->ten = 'Quản trị viên';
    $binhluan->ngay = $now;
    $binhluan->save();
  }

  public function allow_comment(Request $request) {
    $data = $request->all();
    $binhluan = BinhLuan::find($data['comment_id']);
    $binhluan->tinhTrang = $data['comment_status'];
    $binhluan->save();
  }

  public function delete($binhLuan_id) {
    try {
      $binhluan = $this->binhluan->all();
      foreach ($binhluan as $item) {
        if($item->binhLuanCha_id == $binhLuan_id) {
          $this->binhluan->find($item['binhLuan_id'])->delete();
        }
      }
      $this->binhluan->find($binhLuan_id)->delete();
      return response()->json([
        'code' => 200,
        'message' => 'success'
      ], 200);

    } catch (\Exception $exception) {
      Log::error('Message: ' . $exception->getMessage() . ' --- Line : ' . $exception->getLine());
      return response()->json([
        'code' => 500,
        'message' => 'fail'
      ], 500);
    }
  }
}
