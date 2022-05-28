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
              <form action="{{ route('canhans.luuMatKhau') }}" method="post" enctype="multipart/form-data">
                @csrf
              <div class="flex max-w-lg mx-auto items-center mb-3">
                <label for="email" class="w-1/3 block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Mật khẩu cũ</label>
                <input name="oldPass" placeholder="Nhập mật khẩu cũ"
                class="@error('password') error @enderror password w-2/3 px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                value="{{ old('oldPass') }}"
                type="password">
              </div>
              @error('oldPass')
              <p class="alert-error text-red-500 text-right mb-2 w-70p ml-1">{{ $message }}</p>
              @enderror
              <div class="flex max-w-lg mx-auto items-center mb-3">
                <label for="email" class="w-1/3 block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Mật khẩu mới</label>
                <input name="newPass" placeholder="Nhập mật khẩu mới"
                class="@error('password') error @enderror password w-2/3 px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                value="{{ old('newPass') }}"
                type="password">
              </div>
              @error('newPass')
              <p class="alert-error text-red-500 text-right mb-2 w-86p ml-1">{{ $message }}</p>
              @enderror
              <div class="max-w-lg mb-3">
                <i class="text-sm">(*)Mật khẩu phải chứa ít nhất 8 ký tự, ít nhất 1 số, ít nhất 1 chữ cái viết hoa và ít nhất 1 chữ cái thường</i>
              </div>
              <div class="flex max-w-lg mx-auto items-center mb-3">
                <label for="email" class="w-1/3 block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nhập lại mật khẩu</label>
                <input name="againPass" placeholder="Nhập lại mật khẩu"
                class="@error('password') error @enderror password w-2/3 px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                value="{{ old('againPass') }}"
                type="password">
              </div>
              @error('againPass')
              <p class="alert-error text-red-500 text-right mb-2 w-70p ml-1">{{ $message }}</p>
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
