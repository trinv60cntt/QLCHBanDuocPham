@extends('layouts.clients')

@section('title')
  <title>Trang chủ</title>
@endsection

@section('js')
    <script src="vendors/sweetAlert2/sweetalert2@11.js"></script>
    <script src="clients/khachhang/lichsu.js"></script>
@endsection

@section('content')
<section class="module mod-history py-10">
  <?php
  $customer_id = Session::get('khachhang_id');
  $hoKH = Session::get('hoKH');
  $tenKH = Session::get('tenKH');
  $hinhAnh = Session::get('hinhAnh');
  ?>
  <div class="container p-8 mx-auto">
    <div class="row flex">
      <div class="col w-1p5 hidden lg:block">
        <div class="bg-white shadow-lg p-2">
          <img
          class=""
          src="uploads/khachhang/{{ $hinhAnh }}"
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
                  class="inline-flex items-center w-full py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                  href="{{ route('khachhang.doimatkhau') }}"
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
                      d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
                    ></path>
                    <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                  </svg>
                  <span>Đổi mật khẩu</span>
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
      <div class="col w-full lg:w-4/5">
        <h2 class="text-xl font-bold">Lịch sử đơn hàng</h2>
        <div class="table-history w-full mt-4 overflow-hidden rounded-lg shadow-xs">
          <div class="w-full overflow-x-auto">
              <table class="w-full">
                  <thead>
                      <tr
                          class="text-xs font-semibold tracking-wide text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800 text-center">
                          <th class="px-4 py-3">STT</th>
                          <th class="px-4 py-3">Họ tên</th>
                          <th class="px-4 py-3">Tổng tiền</th>
                          <th class="px-4 py-3">Ngày mua</th>
                          <th class="px-4 py-3">Tình trạng</th>
                          <th class="px-4 py-3">Shipper</th>
                          <th class="px-4 py-3 text-center">Chức năng</th>
                      </tr>
                  </thead>
                  <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800 text-center">
                      @foreach ($hoadons as $hoadon)
                          <tr class="text-gray-700 dark:text-gray-400">
                              <td class="px-4 py-3 text-sm whitespace-nowrap">
                                  {{ $loop->index + 1 }}
                              </td>
                              <td class="px-4 py-3 text-sm">
                                  {{ $hoadon->hoTenKH }}
                              </td>
                              <td class="px-4 py-3 text-sm whitespace-nowrap">
                                {{ $hoadon->tongTien }}
                              </td>
                              <td class="px-4 py-3 text-sm whitespace-nowrap">
                                  {{ date('d/m/Y', strtotime($hoadon->created_at)) }}
                              </td>
                              <td class="px-4 py-3 text-sm whitespace-nowrap">
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
                              </td>
                              <td class="px-4 py-3 text-sm whitespace-nowrap">
                                  @if($hoadon->nhanvien_id === NULL)
                                      Chưa có
                                  @endif
                                      {{ optional($hoadon->nhanvien)->hotenNV }}
                              </td>

                              <td class="px-4 py-3 whitespace-nowrap">
                                  <div class="flex items-center text-sm text-blue-600 justify-center">
                                      <a href="{{ route('khachhang.details', ['hoaDon_id' => $hoadon->hoaDon_id]) }}">Xem đơn hàng</a>
                                      @if($hoadon->tinhTrang == 1 )
                                      
                                      &nbsp;|&nbsp;
                                      <a href="#" data-url="{{ route('khachhang.delete', ['hoaDon_id' => $hoadon->hoaDon_id]) }}" class="js-action-delete">Hủy đơn hàng</a>
                                      {{-- <a href="#"><i class='fa fa-print text-purple-600'></i></a> --}}
                                      @endif
                                  </div>
                              </td>
                          </tr>
                      @endforeach
                  </tbody>
              </table>
          </div>
          <div
              class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">


              {{-- <span class="flex items-center col-span-3">
            Showing 21-30 of 100
        </span>
        <span class="col-span-2"></span> --}}
              <!-- Pagination -->
              <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                  {{ $hoadons->links() }}

              </span>
          </div>
      </div>
      </div>
    </div>
  </div>
</section>
@endsection

