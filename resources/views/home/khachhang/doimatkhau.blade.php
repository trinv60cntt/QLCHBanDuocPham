@extends('layouts.clients')

@section('title')
  <title>Trang chủ</title>
@endsection

@section('content')

@section('js')
  <script src="admins/khachhang/add.js"></script>
  <script>
    document.getElementById('go-back').addEventListener('click', () => {
      history.back();
    });
  </script>
  <script>
      Validator({
      form: '.form-validate',
        formGroupSelector: '.form-group',
        errorSelector: '.form-message',
        rules: [
          Validator.isRequired('.oldPass'),
          Validator.isRequired('.newPass'),
          Validator.minLength('.newPass', 8),
          Validator.includeOneNumber('.newPass'),
          Validator.includeOneCharacter('.newPass'),
          Validator.includeOneUppercase('.newPass'),
          Validator.isRequired('.againPass'),
          Validator.isConfirmed('.againPass', function () {
            return document.querySelector('.form-validate .newPass').value;
          }, 'Mật khẩu nhập lại không chính xác'),
        ],
      });


      $(".btn-submit").click(function () {
      setTimeout(() => {
          $('html, body').animate({
          scrollTop: $(".form-group.invalid:first").offset().top
          }, 200);
      }, 10);

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
      <div class="col w-full lg:w-4/5 flex justify-center">
        <div class="details">
          <h2 class="font-bold text-3xl text-center mb-5">ĐỔI MẬT KHẨU</h2>
          <div>
            <form action="{{ route('khachhang.luuMatKhau') }}" method="post" enctype="multipart/form-data" class="form-validate">
              @csrf
              <div class="form-group">
                <div class="flex max-w-lg mx-auto items-center mb-3">
                  <label for="email" class="w-1/3 block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Mật khẩu cũ</label>
                  <input name="oldPass" placeholder="Nhập mật khẩu cũ"
                  class="@error('password') error @enderror oldPass w-2/3 px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                  value="{{ old('oldPass') }}"
                  type="password">
                </div>
                <div class="form-message text-red-600 text-right mb-2 ml-1"></div>
              </div>
              @error('oldPass')
              <p class="form-message text-red-500 text-right mb-2 ml-1">{{ $message }}</p>
              @enderror
            <div class="form-group">
              <div class="flex max-w-lg mx-auto items-center mb-3">
                <label for="email" class="w-1/3 block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Mật khẩu mới</label>
                <input name="newPass" placeholder="Nhập mật khẩu mới"
                class="@error('password') error @enderror newPass w-2/3 px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                value="{{ old('newPass') }}"
                type="password">
              </div>
              <div class="form-message text-red-600 text-right mb-2 ml-1"></div>
            </div>
            @error('newPass')
            <p class="form-message text-red-500 text-right mb-2 ml-1">{{ $message }}</p>
            @enderror
            <div class="max-w-lg mb-3">
              <i class="text-sm">(*)Mật khẩu phải chứa ít nhất 8 ký tự, ít nhất 1 số, ít nhất 1 chữ cái viết hoa và ít nhất 1 chữ cái thường</i>
            </div>

            <div class="form-group">
              <div class="flex max-w-lg mx-auto items-center mb-3">
                <label for="email" class="w-1/3 block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nhập lại mật khẩu</label>
                <input name="againPass" placeholder="Nhập lại mật khẩu"
                class="@error('password') error @enderror againPass w-2/3 px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                value="{{ old('againPass') }}"
                type="password">
              </div>
              <div class="form-message text-red-600 text-right mb-2 ml-1"></div>
            </div>
            @error('againPass')
            <p class="form-message text-red-500 text-right mb-2 ml-1">{{ $message }}</p>
            @enderror
          </div>
          <div class="mt-10 flex justify-center items-center">
            <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
              Lưu
            </button>
            &nbsp;|&nbsp;
            <a href="{{ URL::to('admin/home') }}"
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

