@extends('layouts.admin')

@section('title')
    <title>Thêm mới</title>
@endsection

@section('css') 
    <link rel="stylesheet" href="admins/sanpham/add.css">
@endsection

@section('content')
    <main class="h-full pb-16">
        <div class="container px-6 mx-auto py-4">
            <form action="{{ route('sanphams.store') }}" method="post" enctype="multipart/form-data" id="form-sp-add">
                @csrf
                <div class="mb-6 md:w-2/5 form-group">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tên sản phẩm</label>
                    <input name="tenSP" placeholder="Nhập tên sản phẩm"
                        class="@error('tenSP') error @enderror tenSP w-full px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                        value="{{ old('tenSP') }}"
                        type="text">
                    <div class="form-message text-red-600 mt-2"></div>
                    @error('tenSP')
                        <div class="text-red-600 mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-6 md:w-2/5 form-group">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Giá</label>
                    <input name="donGia" placeholder="Nhập giá sản phẩm"
                        class="@error('donGia') error @enderror donGia w-full px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                        value="{{ old('donGia') }}"
                        min="0"
                        onkeypress='validate(event)'
                        type="number">
                    <div class="form-message text-red-600 mt-2"></div>
                    @error('donGia')
                        <div class="text-red-600 mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-6 md:w-2/5 form-group">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Đơn vị tính</label>
                    <input list="dvt" name="donViTinh" placeholder="Đơn vị tính" autocomplete="off"
                        class="@error('donViTinh') error @enderror donViTinh w-full px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                        value="{{ old('donViTinh') }}"
                        type="text">
                    <div class="form-message text-red-600 mt-2"></div>
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
                    @error('donViTinh')
                        <div class="text-red-600 mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-6 md:w-2/5 form-group">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Ảnh sản phẩm</label>
                    <input name="hinhAnh" type="file"
                        value="{{ old('hinhAnh') }}"
                        class="hinhAnh w-full p-0 border-0 text-sm text-gray-700 dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:outline-none focus:shadow-outline-purple form-input">
                    <div class="form-message text-red-600 mt-2"></div>
                    @error('hinhAnh')
                        <div class="text-red-600 mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-6 md:w-2/5 form-group">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Công dụng</label>
                    <textarea name="congDung" cols="45" rows="6" class="@error('congDung') error @enderror congDung w-full border-1 border-black form-textarea">{{ old('congDung') }}</textarea>
                    <div class="form-message text-red-600 mt-2"></div>
                    @error('congDung')
                        <div class="text-red-600 mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-6 md:w-2/5 form-group">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Ngày sản xuất</label>
                    <input name="ngaySanXuat" type="date"
                        value="{{ old('ngaySanXuat') }}"
                        class="@error('ngaySanXuat') error @enderror ngaySanXuat w-full px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input">
                    <div class="form-message text-red-600 mt-2"></div>
                    @error('ngaySanXuat')
                        <div class="text-red-600 mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-6 md:w-2/5 form-group">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Hạn sử dụng</label>
                    <input name="hanSuDung" type="date"
                        value="{{ old('hanSuDung') }}"
                        class="@error('hanSuDung') error @enderror hanSuDung w-full px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input">
                    <div class="form-message text-red-600 mt-2"></div>
                    @error('hanSuDung')
                        <div class="text-red-600 mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-6 marker:w-2/5 flex items-center">
                    <label for="email" class="block text-sm font-medium text-gray-900 dark:text-gray-300 mr-0">Bán chạy</label>
                    <input style="margin-left: 10px;" type="checkbox" name="banChay" value="1">
                </div>

                <div class="mb-6 md:w-2/5 form-group">
                    <div class="form-message text-red-600 mt-2"></div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Chọn nhà sản xuất</label>
                    <select name="NSX_id"
                        class="w-full bg-gray-50 border-1 border-black text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-purple-300 form-select">
                        {!! $htmlOptionNSX !!}
                    </select>
                </div>

                <div class="mb-6 md:w-2/5 form-group">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Chọn danh mục</label>
                    <select name="danhMuc_id"
                        class="w-full bg-gray-50 border-1 border-black text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-purple-300 form-select">
                        {!! $htmlOption !!}
                    </select>
                </div>

                <button type="submit"
                    class="mb-5 btn-submit px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Thêm mới
                </button>
                <br />
                <a href="{{ route('sanphams.index') }}"
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
          form: '#form-sp-add',
          formGroupSelector: '.form-group',
          errorSelector: '.form-message',
          rules: [
            Validator.isRequired('.tenSP', 'Tên sản phẩm không được phép để trống'),
            Validator.isRequired('.donGia', 'Đơn giá không được phép để trống'),
            Validator.isRequired('.donViTinh', 'Đơn vị tính không được phép để trống'),
            Validator.isRequired('.hinhAnh', 'Vui lòng chọn ảnh sản phẩm'),
            Validator.isRequired('.congDung', 'Công dụng sản phẩm không được phép để trống'),
            Validator.isRequired('.ngaySanXuat', 'Ngày sản xuất không được phép để trống'),
            Validator.isRequired('.hanSuDung', 'Hạn sử dụng không được phép để trống')
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
    <script>
        $('.donGia').on('input', (e) => {
        const $currentInput = $(e.currentTarget);
            if (/^0/.test($currentInput.val())) {
            $currentInput.val($currentInput.val().replace(/^0/, ''))
            }
        });

        function validate(evt) {
            var theEvent = evt || window.event;

            // Handle paste
            if (theEvent.type === 'paste') {
                key = event.clipboardData.getData('text/plain');
            } else {
            // Handle key press
                var key = theEvent.keyCode || theEvent.which;
                key = String.fromCharCode(key);
            }
            var regex = /[0-9]|\./;
            if( !regex.test(key) ) {
                theEvent.returnValue = false;
                if(theEvent.preventDefault) theEvent.preventDefault();
            }
            }function validate(evt) {
            var theEvent = evt || window.event;

            // Handle paste
            if (theEvent.type === 'paste') {
                key = event.clipboardData.getData('text/plain');
            } else {
            // Handle key press
                var key = theEvent.keyCode || theEvent.which;
                key = String.fromCharCode(key);
            }
            var regex = /[0-9]|\./;
            if( !regex.test(key) ) {
                theEvent.returnValue = false;
                if(theEvent.preventDefault) theEvent.preventDefault();
            }
        }
    </script>
@endsection