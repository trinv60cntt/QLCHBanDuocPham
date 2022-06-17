@extends('layouts.admin')

@section('title')
    <title>Cập nhật sản phẩm</title>
@endsection

@section('content')
    <main class="h-full pb-16">
        <!-- Remove everything INSIDE this div to a really blank page -->
        <div class="container px-6 mx-auto py-4 flex justify-center mt-5">
          <div class="details">
            <h2 class="font-bold text-3xl text-center mb-5">ĐỔI MẬT KHẨU</h2>
            <div>
              <form action="{{ route('canhans.luuMatKhau') }}" method="post" enctype="multipart/form-data" class="form-validate">
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
    </main>
@endsection

@section('js')
    <script src="admins/khachhang/add.js"></script>
    <script>
        Validator({
        form: '.form-validate',
          formGroupSelector: '.form-group',
          errorSelector: '.form-message',
          rules: [
            Validator.isRequired('.oldPass'),
            Validator.isRequired('.newPass'),
            Validator.minLength('.newPass', 6),
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