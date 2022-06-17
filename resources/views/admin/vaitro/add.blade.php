@extends('layouts.admin')

@section('title')
    <title>Thêm mới</title>
@endsection

@section('css') 
    <link rel="stylesheet" href="admins/khachhang/add.css">
@endsection

@section('content')
    <main class="h-full pb-16">
        <div class="container px-6 mx-auto py-4">
            <form action="{{ route('vaitros.store') }}" method="post" enctype="multipart/form-data" class="form-validate">
                @csrf
                <div class="mb-6 w-40p form-group">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Mã nhóm nhân viên</label>
                    <input name="tenVT" placeholder="Nhập mã nhóm nhân viên"
                        class="@error('tenVT') error @enderror tenVT w-full px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                        value="{{ old('tenVT') }}"
                        type="text">
                    <div class="form-message text-red-600 mt-2"></div>
                </div>

                <div class="mb-6 w-40p form-group">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tên nhóm nhân viên</label>
                    <input name="moTa" placeholder="Nhập tên nhóm nhân viên"
                        class="@error('moTa') error @enderror moTa w-full px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                        value="{{ old('moTa') }}"
                        type="text">
                    <div class="form-message text-red-600 mt-2"></div>
                </div>

                <div class="checkall-wrap p-3">
                    <label>
                        <input type="checkbox" class="checkall">
                        Chọn tất cả
                    </label>
                </div>
                @foreach($quyenCha as $quyenChaItem)
                <div class="mb-6 bg-purple-600 text-white rounded-lg">
                    <div class="p-3">
                        <label>
                            <input type="checkbox" value="" class="checkbox-wrapper">
                        </label>
                        Module {{ $quyenChaItem->moTa }}
                    </div>
                    <div class="bg-white shadow-xl text-black flex justify-between">
                    @foreach($quyenChaItem->quyenChildren as $quyenChildrenItem)
                        <div class="p-3">
                            <label>
                                <input type="checkbox" class="checkbox-children" name="quyen_id[]" value="{{ $quyenChildrenItem->quyen_id }}">
                            </label>
                            {{ $quyenChildrenItem->moTa }}
                        </div>
                    @endforeach
                    </div>
                </div>
                @endforeach

                <button type="submit" id="MyButton-nhanvien"
                    class="btn-submit px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Thêm mới
                </button>
            </form>
        </div>
    </main>
@endsection
@section('js')
    <script src="admins/vaitro/add.js"></script>
    <script src="admins/khachhang/add.js"></script>
    <script>
        Validator({
        form: '.form-validate',
          formGroupSelector: '.form-group',
          errorSelector: '.form-message',
          rules: [
            Validator.isRequired('.tenVT', 'Mã nhóm nhân viên không được phép để trống'),
            Validator.isRequired('.moTa', 'Tên nhóm nhân viên không được phép để trống'),
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