@extends('layouts.clients')

@section('title')
  <title>Trang chủ</title>
@endsection

@section('content')
<section class="module mod-history py-10 mb-10">
  <?php
  $customer_id = Session::get('khachhang_id');
  $hoKH = Session::get('hoKH');
  $tenKH = Session::get('tenKH');
  $hinhAnh = Session::get('hinhAnh');
  ?>
  <div class="container p-8 mx-auto">
    <div class="row flex">
      <div class="col w-1p5 pr-5">
        <div class="bg-white shadow-lg p-2">
          <img
          class=""
          src="storage/khachhang/{{ $hinhAnh }}"
          alt=""
          aria-hidden="true"
          />
          <p class="text-black font-medium">Tài khoản của: {{ $hoKH }} {{ $tenKH }}</p>
          <hr class="my-1">
          <ul
              class="mt-2 space-y-2 text-gray-600"
              >
              <li class="flex">
                <a
                  class="inline-flex items-center w-full py-1 text-sm font-semibold transition-colors duration-150"
                  href="{{ route('khachhang.index') }}"
                >
                  <svg
                    class="w-4 h-4 mr-3"
                    aria-hidden="true"
                    fill="none"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                    ></path>
                  </svg>
                  <span>Thông tin tài khoản</span>
                </a>
              </li>
              <li class="flex">
                <a
                  class="inline-flex items-center w-full py-1 text-sm font-semibold"
                  href="{{ route('khachhang.lichsu') }}"
                >
                  <i class="fas fa-solid fa-clock-rotate-left w-4 h-4 mr-3"></i>
                  <span>Lịch sử mua hàng</span>
                </a>
              </li>
              <li class="flex">
                <a
                  class="inline-flex items-center w-full py-1 text-sm font-semibold"
                  href="{{ URL::to('/logout-checkout') }}"
                >
                  <svg
                    class="w-4 h-4 mr-3"
                    aria-hidden="true"
                    fill="none"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"
                    ></path>
                  </svg>
                  <span>Đăng xuất</span>
                </a>
              </li>
            </ul>
        </div>
      </div>
      <div class="col w-4p5">
        <div class="details">
            <h2 class="title-details text-center py-4 text-2xl">CHI TIẾT ĐƠN ĐẶT HÀNG</h2>
            <hr>
            <div class="info-details py-4">
                <div class="row flex flex-wrap">
                    <div class="col w-50p flex">
                        <p><span class="font-bold">Số HĐ:</span> {{ $chitiethd->hoaDon_id }}</p>
                    </div>

                    <div class="col w-50p flex">
                        <p><span class="font-bold">Ngày mua:</span>
                            {{ date('d/m/Y', strtotime($hoadon->created_at)) }}</p>
                    </div>

                    <div class="col w-50p flex mt-1">
                        <p><span class="font-bold">Họ tên:</span> {{ $hoadon->hoTenKH }}</p>
                    </div>

                    <div class="col w-50p flex mt-1">
                        <p><span class="font-bold">Số điện thoại:</span> {{ $hoadon->sdt }}</p>
                    </div>

                    <div class="col w-50p flex mt-1">
                        <p><span class="font-bold">Địa chỉ:</span> {{ $hoadon->diaChi }}</p>
                    </div>

                    <div class="col w-50p flex mt-1">
                        <p><span class="font-bold">Ghi chú:</span> </p>
                    </div>

                    <div class="col w-50p flex mt-1">
                        <p><span class="font-bold">Nhân viên giao hàng:</span>    
                        @if($hoadon->nhanvien_id === NULL)
                            Chưa có
                        @endif
                            {{ optional($hoadon->nhanvien)->hotenNV }}</p>
                    </div>

                    <div class="col w-50p flex mt-1">
                        <p><span class="font-bold">Tình trạng đơn:</span>
                            <?php
                            switch ($hoadon->tinhTrang)
                            {
                                case 1:
                                    echo 'Đơn chờ kiểm';
                                    break;
                                case 2:
                                    echo 'Đã giao cho shipper';
                                    break;
                                case 3:
                                    echo 'Đã giao hàng';
                                    break;
                                case 4:
                                    echo 'Đã nhận tiền từ shipper';
                                  break;
                                default:
                                    echo 'Đơn hủy';
                                break;
                            }
                            ?>
                        </p>
                    </div>
                </div>

            </div>

            <div class="info-products">
                <h4 class="title-products py-4 text-2xl">Danh sách sản phẩm</h4>
                <hr>
                <div class="w-full mt-4 overflow-hidden rounded-lg shadow-xs table-history">
                  <div class="w-full overflow-x-auto">
                      <table class="w-full">
                          <thead>
                              <tr
                                  class="text-xs font-semibold tracking-wide text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800 text-center">
                                  <th class="px-4 py-3">Hình ảnh</th>
                                  <th class="px-4 py-3">Tên sản phẩm</th>
                                  <th class="px-4 py-3">Số lượng</th>
                                  <th class="px-4 py-3">Đơn giá</th>
                                  <th class="px-4 py-3">Thành tiền</th>
                              </tr>
                          </thead>
                          <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800 text-center">
                              @foreach ($order_d_by_id as $v_order_d_by_id)

                                  <tr class="text-gray-700 dark:text-gray-400">
                                      <td class="px-4 py-3 text-sm whitespace-nowrap">
                                        <img height="100px" width="100px" src="storage/sanpham/{{ $v_order_d_by_id->hinhAnh }}" alt="San pham"
                                        class="sanpham-img mx-auto">
                                      </td>
                                      <td class="px-4 py-3 text-sm name-product">
                                        {{ $v_order_d_by_id->tenSP }}
                                      </td>
                                      <td class="px-4 py-3 text-sm whitespace-nowrap">
                                        {{ $v_order_d_by_id->soLuong }}
                                      </td>
                                      <td class="px-4 py-3 text-sm whitespace-nowrap">
                                        {{ $v_order_d_by_id->soLuong }} x {{ number_format($v_order_d_by_id->donGia, 0, ',', '.') }}
                                      </td>
                                      <td class="px-4 py-3 text-sm whitespace-nowrap">
                                        <?php
                                          $total = $v_order_d_by_id->donGia * $v_order_d_by_id->soLuong;
                                          echo number_format($total, 0, ',', '.');
                                        ?>
                                      </td>
                                  </tr>
                              @endforeach
                          </tbody>
                      </table>
                  </div>
              </div>
            </div>

            <div class="py-4">
              <hr>
            </div>

            <div class="details-total text-right">
              <p><span class="font-bold">Phí giao hàng: </span> 15.000đ</p>
              <p><span class="font-bold">Tổng tiền: </span> {{ number_format($v_order_d_by_id->tongTien, 0, ',', '.') }}đ</p>
            </div>
        </div>
        <div class="m-6 relative">
            <a href="{{ route('khachhang.lichsu') }}"
                class="absolute right-0 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Trở về
            </a>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

