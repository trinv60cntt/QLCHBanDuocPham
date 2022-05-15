<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BinhLuan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Traits\StorageImageTrait;

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
    $binhluans = $this->binhluan->with('sanpham')->latest()->paginate(10);
    return view('admin.binhluan.index', compact('binhluans'));
  }

}
