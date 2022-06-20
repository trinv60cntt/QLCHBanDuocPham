@extends('layouts.clients')

@section('title')
  <title>Trang chủ</title>
@endsection

@section('content')

@section('js')
  <script>
    document.getElementById('go-back').addEventListener('click', () => {
      history.back();
    });
  </script>
@endsection

<section class="module mod-history py-10 mb-10">
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
      <div class="col w-full lg:w-4p5">
        <table class="details details-table mx-auto mt-2" cellpadding="0" cellspacing="0">
          <tbody><tr>
              <td>
                  <table class="m-5 md:m-14 mt-5" cellpadding="2" cellspacing="10">
                      <tbody><tr>
                          <td colspan="3">
                              <h3 class="text-center mb-4"><b>THÔNG TIN CHI TIẾT</b></h3>
                          </td>
                      </tr>
                      <tr class="inline ml-20 md:ml-0 md:hidden">
                        <td><img src="uploads/khachhang/{{ $khachhang->hinhAnh }}" width="300" height="300" class="mr-5"></td>
                    </tr>
                      <tr class="hidden ml-20 md:ml-0 md:table-row">
                          <td rowspan="8"><img src="uploads/khachhang/{{ $khachhang->hinhAnh }}" width="300" height="300" class="mr-5"></td>
                      </tr>
                      <tr>
                          <td>Tên khách hàng:</td>
                          <td>{{ $khachhang->hoKH }} {{ $khachhang->tenKH }}</td>
                      </tr>
                      <tr>
                          <td>Giới tính:</td>
                          <td>{{ $khachhang->gioiTinh == 1 ? 'Nam' : 'Nữ' }}</td>
                      </tr>
                      <tr>
                          <td>Ngày sinh:</td>
                          <td>{{ str_replace('-', '/', date('d-m-Y', strtotime($khachhang->ngaySinh))) }}</td>
                      </tr>
                      <tr>
                          <td>Địa chỉ:</td>
                          <td>{{ $khachhang->diaChi }}</td>
                      </tr>
                      <tr>
                          <td>Email:</td>
                          <td>{{ $khachhang->email }}</td>
                      </tr>
                      <tr>
                          <td>Số điện thoại:</td>
                          <td>{{ $khachhang->sdt }}</td>
                      </tr>

                  </tbody></table>
              </td>
          </tr>
      </tbody></table>
      <div class="mt-6 flex justify-center items-center">
        <a href="{{ route('khachhang.edit') }}"
        class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
        Cập nhật
        </a>
        &nbsp;|&nbsp;
        <button id="go-back"
            class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            Quay lại
        </button>
    </div>
      </div>
    </div>
  </div>
</section>
@endsection

