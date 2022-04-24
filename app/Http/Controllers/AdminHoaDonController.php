<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HoaDon;
use Illuminate\Support\Facades\DB;

class AdminHoaDonController extends Controller
{
  public function __construct(
    HoaDon $hoadon
  ) {
    $this->hoadon = $hoadon;
  }

  public function index()
  {
    $hoadons = $this->hoadon->latest()->paginate(5);
    return view('admin.hoadon.index', compact('hoadons'));
  }
}
