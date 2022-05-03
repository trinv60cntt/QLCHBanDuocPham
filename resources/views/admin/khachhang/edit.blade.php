@extends('layouts.admin')

@section('title')
    <title>Cập nhật sản phẩm</title>
@endsection

@section('content')
    <main class="h-full pb-16 overflow-y-auto">
        <!-- Remove everything INSIDE this div to a really blank page -->
        <div class="container px-6 mx-auto py-4">
          <form action="{{ route('khachhangs.update', ['khachhang_id' => $khachhang->khachhang_id]) }}" method="post" enctype="multipart/form-data">
            @csrf
        
            <div class="mb-6 w-40p">
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Họ khách hàng</label>
              <input name="hoKH" value="{{ $khachhang->hoKH }}" placeholder="Nhập họ khách hàng" class="w-full px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" type="text">
            </div>

            <div class="mb-6 w-40p">
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tên khách hàng</label>
              <input name="tenKH" value="{{ $khachhang->tenKH }}" placeholder="Nhập tên khách hàng" class="w-full px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" type="text">
            </div>

            <div class="mb-6 w-40p">
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Giới tính</label>
              <div>
                  <input type="radio" name="gioiTinh" value="1" {{ $khachhang->gioiTinh == '1' ? 'checked' : '' }}> Nam
                  <input style="margin-left: 10px;" type="radio" name="gioiTinh" value="0" {{ $khachhang->gioiTinh == '0' ? 'checked' : '' }}> Nữ
              </div>
            </div>

          <div class="mb-6 w-40p">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Ngày sinh</label>
            <input name="ngaySinh" value="{{ $khachhang->ngaySinh }}" type="date" class="w-full px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" >
          </div>

          <div class="mb-6 w-40p">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Địa chỉ</label>
            <input name="diaChi" value="{{ $khachhang->diaChi }}" placeholder="Nhập địa chỉ" class="w-full px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" type="text">
          </div>

          <div class="mb-6 w-40p">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email</label>
            <input name="email" value="{{ $khachhang->email }}" placeholder="Nhập email" class="w-full px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" type="text">
          </div>

          <div class="mb-6 w-40p">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Mật khẩu</label>
            <input name="password" value="{{ $khachhang->password }}" placeholder="Nhập mật khẩu" class="w-full px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" type="password">
          </div>

          <div class="mb-6 w-40p">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Số điện thoại</label>
            <input name="sdt" value="{{ $khachhang->sdt }}" placeholder="Nhập số điện thoại" class="w-full px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" type="text">
          </div>

          <div class="mb-6 w-40p">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Ảnh khách hàng</label>
            <input name="hinhAnh" type="file" class="w-full p-0 border-0 text-sm text-gray-700 dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:outline-none focus:shadow-outline-purple form-input">
            <div class="mt-2">
              <img src="storage/khachhang/{{ $khachhang->hinhAnh }}" alt="San pham" >
            </div>
          </div>  

            <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
              Lưu
            </button>
          </form>
        </div>
    </main>
@endsection

@section('js')

@endsection