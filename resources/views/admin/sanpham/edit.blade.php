@extends('layouts.admin')

@section('title')
    <title>Cập nhật sản phẩm</title>
@endsection

@section('content')
    <main class="h-full pb-16 overflow-y-auto">
        <!-- Remove everything INSIDE this div to a really blank page -->
        <div class="container px-6 mx-auto py-4">
          <form action="{{ route('sanphams.update', ['sanPham_id' => $sanpham->sanPham_id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-6 w-40p">
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tên sản phẩm</label>
              <input name="tenSP" value="{{ $sanpham->tenSP }}" placeholder="Nhập tên sản phẩm" class="w-full px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" type="text">
            </div>

            <div class="mb-6 w-40p">
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Giá</label>
              <input name="donGia" value="{{ $sanpham->donGia }}" placeholder="Nhập giá sản phẩm" class="w-full px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" type="number">
            </div>

            <div class="mb-6 w-40p">
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Đơn vị tính</label>
              <input list="dvt" value="{{ $sanpham->donViTinh }}" name="donViTinh" placeholder="Đơn vị tính" class="w-full px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" type="text">
              <datalist id="dvt">
                <option>Hộp</option>
                <option>Gói</option>
                <option>Chai</option>
                <option>Viên</option>
                <option>Tuýp</option>
                <option>Cây</option>
                <option>Túi</option>
                <option>Lốc</option>
                <option>Cái</option>
                <option>Chiếc</option>
              </datalist>
            </div>

            <div class="mb-6 w-40p">
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Ảnh sản phẩm</label>
              <input name="hinhAnh" type="file" class="w-full p-0 border-0 text-sm text-gray-700 dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:outline-none focus:shadow-outline-purple form-input">
              <div class="mt-2">
                <img src="storage/sanpham/{{ $sanpham->hinhAnh }}" alt="San pham" >
              </div>
            </div>  

            <div class="mb-6 w-40p">
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Công dụng</label>
              <textarea name="congDung" cols="45" rows="6" class="border-1 border-black form-textarea">{{ $sanpham->congDung }}</textarea>
            </div>

            <div class="mb-6 w-40p">
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Ngày sản xuất</label>
              <input name="ngaySanXuat" value="{{ $sanpham->ngaySanXuat }}" type="date" class="w-full px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" >
            </div>

            <div class="mb-6 w-40p">
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Hạn sử dụng</label>
              <input name="hanSuDung" value="{{ $sanpham->hanSuDung }}" type="date" class="w-full px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" >
            </div>

            <div class="mb-6 marker:w-40p flex items-center">
              <label for="email" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Bán chạy</label>
              <input style="margin-left: 10px;" type="checkbox" name="banChay" value="{{ $sanpham->banChay }}" {{ $sanpham->banChay == '1' ? 'checked' : '' }} >
            </div>

            <div class="mb-6 w-40p">
              <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Chọn nhà sản xuất</label>
              <select name="NSX_id" class="w-full bg-gray-50 border-1 border-black text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-purple-300 form-select">
                {!! $htmlOptionNSX !!}
              </select>
            </div>

            <div class="mb-6 w-40p">
              <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Chọn danh mục</label>
              <select name="danhMuc_id" class="w-full bg-gray-50 border-1 border-black text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-purple-300 form-select">
                {!! $htmlOption !!}
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