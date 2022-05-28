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
      <div class="col w-1p5">
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
      <div class="col w-4p5 flex justify-center">
        <div class="details">
          <h2 class="font-bold text-3xl text-center mb-5">CẬP NHẬT THÔNG TIN CÁ NHÂN</h2>
          <hr>
          <div>
            <form action="{{ route('khachhang.update') }}" method="post" enctype="multipart/form-data">
              @csrf
            <div class="flex max-w-lg mx-auto items-center mb-3">
              <label for="email" class="w-1/3 block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Họ khách hàng</label>
              <input name="hoKH" placeholder="Nhập họ"
              class="@error('hoKH') error @enderror password w-2/3 px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
              value="{{ $khachhang->hoKH }}"
              type="text">
            </div>

            <div class="flex max-w-lg mx-auto items-center mb-3">
              <label for="email" class="w-1/3 block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tên khách hàng</label>
              <input name="tenKH" placeholder="Nhập tên"
              class="@error('tenKH') error @enderror password w-2/3 px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
              value="{{ $khachhang->tenKH }}"
              type="text">
            </div>

            <div class="flex max-w-lg mx-auto items-center mb-3">
              <label for="email" class="w-1/3 block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Giới tính</label>
              <div class="w-2/3">
                  <input type="radio" name="gioiTinh" value="1" {{ $khachhang->gioiTinh == '1' ? 'checked' : '' }}> Nam
                  <input style="margin-left: 10px;" type="radio" name="gioiTinh" value="0" {{ $khachhang->gioiTinh == '0' ? 'checked' : '' }}> Nữ
              </div>
            </div>

            <div class="flex max-w-lg mx-auto items-center mb-3">
              <label for="email" class="w-1/3 block text-sm font-medium text-gray-900 dark:text-gray-300">Ngày sinh</label>
              <input name="ngaySinh" value="{{ $khachhang->ngaySinh }}" type="date" class="w-2/3 px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" >
            </div>

            <div class="flex max-w-lg mx-auto items-center mb-3">
              <label for="email" class="w-1/3 block text-sm font-medium text-gray-900 dark:text-gray-300">Địa chỉ</label>
            <input name="diaChi" value="{{ $khachhang->diaChi }}" placeholder="Nhập địa chỉ" class="w-2/3 px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" type="text">
            </div>

            <div class="flex max-w-lg mx-auto items-center mb-3">
              <label for="email" class="w-1/3 block text-sm font-medium text-gray-900 dark:text-gray-300">Email</label>
              <input name="email" readonly value="{{ $khachhang->email }}" placeholder="Nhập email" class="w-2/3 px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" type="text">
            </div>

            <div class="flex max-w-lg mx-auto items-center mb-3">
              <label for="email" class="w-1/3 block text-sm font-medium text-gray-900 dark:text-gray-300">Số điện thoại</label>
            <input name="sdt" value="{{ $khachhang->sdt }}" placeholder="Nhập số điện thoại" class="w-2/3 px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" type="text">
            </div>

            <div class="flex max-w-lg mx-auto items-center mb-3 flex-wrap justify-center">
              <label for="email" class="w-1/3 block text-sm font-medium text-gray-900 dark:text-gray-300">Ảnh khách hàng</label>
              <input name="hinhAnh" type="file" class="w-2/3 p-0 border-0 text-sm text-gray-700 dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:outline-none focus:shadow-outline-purple mt-2">
              <div class="mt-2">
                <img src="storage/khachhang/{{ $khachhang->hinhAnh }}" alt="San pham" >
              </div>
            </div>

          </div>
          <div class="mt-10 flex justify-center items-center">
            <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
              Lưu
            </button>
            &nbsp;|&nbsp;
            <a href="{{ URL::to('khachhang') }}"
                class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Quay lại
            </a>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

