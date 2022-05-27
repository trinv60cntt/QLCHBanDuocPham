@extends('layouts.admin')

@section('title')
    <title>Cập nhật sản phẩm</title>
@endsection

@section('content')
    <main class="h-full pb-16">
        <!-- Remove everything INSIDE this div to a really blank page -->
        <div class="container px-6 mx-auto py-4">
          <form action="{{ route('nhanviens.update', ['nhanvien_id' => $nhanvien->nhanvien_id]) }}" method="post" enctype="multipart/form-data">
            @csrf
        
            <div class="mb-6 w-40p">
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tên nhân viên</label>
              <input name="hotenNV" value="{{ $nhanvien->hotenNV }}" placeholder="Nhập tên nhân viên" class="w-full px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" type="text">
            </div>

            <div class="mb-6 w-40p">
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Giới tính</label>
              <div>
                  <input type="radio" name="gioiTinh" value="1" {{ $nhanvien->gioiTinh == '1' ? 'checked' : '' }}> Nam
                  <input style="margin-left: 10px;" type="radio" name="gioiTinh" value="0" {{ $nhanvien->gioiTinh == '0' ? 'checked' : '' }}> Nữ
              </div>
            </div>

          <div class="mb-6 w-40p">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Ngày sinh</label>
            <input name="ngaySinh" value="{{ $nhanvien->ngaySinh }}" type="date" class="w-full px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" >
          </div>

          <div class="mb-6 w-40p">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Địa chỉ</label>
            <input name="diaChi" value="{{ $nhanvien->diaChi }}" placeholder="Nhập địa chỉ" class="w-full px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" type="text">
          </div>

          <div class="mb-6 w-40p">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email</label>
            <input name="email" value="{{ $nhanvien->email }}" placeholder="Nhập email" class="w-full px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" type="text">
          </div>

          <div class="mb-6 w-40p">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Số điện thoại</label>
            <input name="sdt" value="{{ $nhanvien->sdt }}" placeholder="Nhập số điện thoại" class="w-full px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" type="text">
          </div>

          <div class="mb-6 w-40p">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Ảnh nhân viên</label>
            <input name="hinhAnh" type="file" class="w-full p-0 border-0 text-sm text-gray-700 dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:outline-none focus:shadow-outline-purple form-input">
            <div class="mt-2">
              <img src="storage/nhanvien/{{ $nhanvien->hinhAnh }}" alt="San pham" >
            </div>
          </div>

          <div class="mb-6 w-40p">
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nhóm nhân viên</label>
            <select name="vaiTro_id" class="w-full bg-gray-50 border-1 border-black text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-purple-300 form-select">
              {!! $htmlOptionVaiTro !!}
            </select>
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