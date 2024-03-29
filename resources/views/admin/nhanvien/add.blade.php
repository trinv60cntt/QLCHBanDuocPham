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
            <form action="{{ route('nhanviens.store') }}" method="post" enctype="multipart/form-data" id="form-nhanvien">
                @csrf
                <div class="mb-6 w-40p form-group">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tên nhân viên</label>
                    <input name="hotenNV" placeholder="Nhập tên nhân viên"
                        class="@error('hotenNV') error @enderror hotenNV w-full px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                        value="{{ old('hotenNV') }}"
                        type="text">
                    <div class="form-message text-red-600 mt-2"></div>
                </div>

                <div class="mb-6 w-40p form-group">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Giới tính</label>
                    <div class="col-md-8">
                        <input type="radio" name="gioiTinh" value="1" checked=""> Nam
                        <input style="margin-left: 10px;" type="radio" name="gioiTinh" value="0"> Nữ
                    </div>
                    <div class="form-message text-red-600 mt-2"></div>
                </div>

                <div class="mb-6 w-40p form-group">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Ngày sinh</label>
                    <input name="ngaySinh" type="date"
                        value="{{ old('ngaySinh') }}"
                        class="@error('ngaySinh') error @enderror ngaySinh w-full px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input">
                    <div class="form-message text-red-600 mt-2"></div>
                </div>

                <div class="mb-6 w-40p form-group">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Địa chỉ</label>
                    <input name="diaChi" placeholder="Nhập địa chỉ"
                        class="@error('diaChi') error @enderror diaChi w-full px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                        value="{{ old('diaChi') }}"
                        type="text">
                    <div class="form-message text-red-600 mt-2"></div>
                </div>

                <div class="mb-6 w-40p form-group">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email</label>
                    <input name="email" placeholder="Nhập Email"
                        class="@error('email') error @enderror email w-full px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                        value="{{ old('email') }}"
                        type="text">
                    <div class="form-message text-red-600 mt-2"></div>
                </div>

                <div class="mb-6 w-40p form-group">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Mật khẩu</label>
                    <input name="password" placeholder="Nhập Password"
                        class="@error('password') error @enderror password w-full px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                        value="{{ old('password') }}"
                        type="password">
                    <div class="form-message text-red-600 mt-2"></div>
                </div>

                <div class="mb-6 w-40p form-group">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Số điện thoại</label>
                    <input name="sdt" placeholder="Nhập sdt"
                        class="@error('sdt') error @enderror sdt w-full px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                        value="{{ old('sdt') }}"
                        type="text">
                    <div class="form-message text-red-600 mt-2"></div>
                </div>
          
                <div class="mb-6 w-40p form-group">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Ảnh nhân viên</label>
                    <input name="hinhAnh" type="file"
                        value="{{ old('hinhAnh') }}"
                        class="hinhAnh w-full p-0 border-0 text-sm text-gray-700 dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:outline-none focus:shadow-outline-purple form-input">
                    <div class="form-message text-red-600 mt-2"></div>
                </div>

                <div class="mb-6 w-40p">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nhóm nhân viên</label>
                    <select name="vaiTro_id"
                        class="w-full bg-gray-50 border-1 border-black text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-purple-300 form-select">
                        {!! $htmlOptionVaiTro !!}
                    </select>
                </div>

                <button type="submit" id="MyButton-nhanvien"
                    class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Thêm mới
                </button>
            </form>
        </div>
    </main>
@endsection

@section('js')
    <script src="admins/khachhang/add.js"></script>
    <script>
        Validator({
          form: '#form-nhanvien',
          formGroupSelector: '.form-group',
          errorSelector: '.form-message',
          rules: [
            Validator.isRequired('.hotenNV', 'Tên nhân viên không được phép để trống'),
            Validator.isRequired('.ngaySinh'),
            Validator.isRequired('.diaChi'),
            Validator.isRequired('.email'),
            Validator.isEmail('.email'),
            Validator.isRequired('.password'),
            // Validator.minLength('.password', 6),
            Validator.isRequired('.sdt'),
            Validator.isRequired('.hinhAnh'),

          ],
    
        });
    
        
        $("#MyButton-nhanvien").click(function () {
        setTimeout(() => {
            $('html, body').animate({
            scrollTop: $(".form-group.invalid:first").offset().top
            }, 200);
        }, 10);
    
        });
    </script>
@endsection