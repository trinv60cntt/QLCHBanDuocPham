@extends('layouts.admin')

@section('title')
    <title>Trang chủ</title>
@endsection

@section('content')
    <main class="h-full pb-16 overflow-y-auto">
        <!-- Remove everything INSIDE this div to a really blank page -->
        <div class="container px-6 mx-auto py-4">
          <form action="{{ route('danhmucs.store') }}" method="post" id="form-dm-add">
            @csrf
            <div class="mb-6 md:w-2/5 form-group">
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tên danh mục</label>
              <input name="tenDM" class="tenDM w-full px-2 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" type="text">
              <div class="form-message text-red-600 mt-2"></div>
            </div>
            <div class="mb-6 md:w-2/5">
              <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Chọn danh mục cha</label>
              <select name="danhMucCha_id" class="w-full bg-gray-50 border-1 border-black text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-2  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-purple-300 form-select">
                <option value="0">Chọn danh mục cha</option>
                {!! $htmlOption !!}
              </select>
            </div>
            <button type="submit" id="dm-add"
            class="mb-5 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
              Thêm mới
            </button>
            <br />
            <a href="{{ route('danhmucs.index') }}"
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
          form: '#form-dm-add',
          formGroupSelector: '.form-group',
          errorSelector: '.form-message',
          rules: [
            Validator.isRequired('.tenDM', 'Tên danh mục không được phép để trống')
          ],

        });


        $("#dm-add").click(function () {
        setTimeout(() => {
            $('html, body').animate({
            scrollTop: $(".form-group.invalid:first").offset().top
            }, 200);
        }, 10);

        });
    </script>
@endsection