@extends('layouts.admin')

@section('title')
    <title>Trang chủ</title>
@endsection

@section('content')
    <main class="h-full pb-16 overflow-y-auto">
        <!-- Remove everything INSIDE this div to a really blank page -->
        <div class="container px-6 mx-auto py-4">
          <form action="{{ route('nhasanxuats.store') }}" method="post" id="form-nsx-add">
            @csrf
            <div class="mb-6 w-full md:w-2/5 form-group">
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tên nhà sản xuất</label>
              <input name="tenNSX" class="tenNSX w-full px-2 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" type="text">
              <div class="form-message text-red-600 mt-2"></div>
            </div>
            <div class="mb-6 w-full md:w-2/5 form-group">
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nước sản xuất</label>
              <input name="nuocSX" class="nuocSX w-full px-2 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" type="text">
              <div class="form-message text-red-600 mt-2"></div>
            </div>
            <button type="submit" id="nsx-add"
            class="mb-5 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
              Thêm mới
            </button>
            <br />
            <a href="{{ route('nhasanxuats.index') }}"
            class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
              Quay lại
            </a>
          </form>
        </div>
    </main>
@endsection

@section('js')
    <script src="admins/khachhang/add.js"></script>
    <script>
        Validator({
          form: '#form-nsx-add',
          formGroupSelector: '.form-group',
          errorSelector: '.form-message',
          rules: [
            Validator.isRequired('.tenNSX', 'Tên nhà sản xuất không được phép để trống'),
            Validator.isRequired('.nuocSX', 'Nước sản xuất không được phép để trống')
          ],

        });

        $("#nsx-add").click(function () {
        setTimeout(() => {
            $('html, body').animate({
            scrollTop: $(".form-group.invalid:first").offset().top
            }, 200);
        }, 10);

        });
    </script>
@endsection