@extends('layouts.admin')

@section('title')
    <title>Cập nhật sản phẩm</title>
@endsection

@section('content')
    <main class="h-full pb-16">
        <!-- Remove everything INSIDE this div to a really blank page -->
        <div class="container px-6 mx-auto py-4">
          <form action="{{ route('sanphams.update', ['sanPham_id' => $sanpham->sanPham_id]) }}" method="post" enctype="multipart/form-data" class="form-validate">
            @csrf
            <div class="mb-6 md:w-2/5 form-group">
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tên sản phẩm</label>
              <input name="tenSP" value="{{ old('tenSP') !== null ? old('tenSP') : $sanpham->tenSP }}" placeholder="Nhập tên sản phẩm" class="tenSP w-full px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" type="text">
              <div class="form-message text-red-600 mt-2"></div>
              @if(Session::has('error'))
                <p class="text-red-600 mt-2">{{ Session::get('error') }}</p>
              @endif
            </div>

            <div class="mb-6 md:w-2/5 form-group">
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Số lượng</label>
              <input name="soLuongTon" onkeypress='validate(event)' min="0"
              value="{{ old('soLuongTon') !== null ? old('soLuongTon') : $sanpham->soLuongTon }}" placeholder="Nhập số lượng tồn sản phẩm"
              class="soLuongTon w-full px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" type="number">
              <div class="form-message text-red-600 mt-2"></div>
            </div>

            <div class="mb-6 md:w-2/5 form-group">
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Giá nhập</label>
              <input name="giaNhap" onkeypress='validate(event)' min="0" value="{{ old('giaNhap') !== null ? old('giaNhap') : $sanpham->giaNhap }}" placeholder="Nhập giá nhập sản phẩm" class="giaNhap w-full px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" type="number">
              <div class="form-message text-red-600 mt-2"></div>
            </div>

            <div class="mb-6 md:w-2/5 form-group">
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Giá bán</label>
              <input name="donGia" onkeypress='validate(event)' min="0" value="{{ old('donGia') !== null ? old('donGia') : $sanpham->donGia }}" placeholder="Nhập giá bán sản phẩm" class="donGia w-full px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" type="number">
              <div class="form-message text-red-600 mt-2"></div>
            </div>

            <div class="mb-6 md:w-2/5 form-group">
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Đơn vị tính</label>
              <input list="dvt" value="{{ old('donViTinh') !== null ? old('donViTinh') : $sanpham->donViTinh }}" name="donViTinh" placeholder="Đơn vị tính" class="donViTinh w-full px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" type="text">
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
              <div class="form-message text-red-600 mt-2"></div>
            </div>

            <div class="mb-6 md:w-2/5 form-group">
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Ảnh sản phẩm</label>
              <input name="hinhAnh" type="file" class="w-full p-0 border-0 text-sm text-gray-700 dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:outline-none focus:shadow-outline-purple form-input">
              <div class="mt-2">
                <img src="uploads/sanpham/{{ $sanpham->hinhAnh }}" alt="San pham" >
              </div>
            </div> 

            <div class="mb-6 md:w-2/5 form-group">
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Công dụng</label>
              <textarea name="congDung" cols="45" rows="6" class="congDung w-full border-1 border-black form-textarea">{{ $sanpham->congDung }}</textarea>
              <div class="form-message text-red-600 mt-2"></div>
            </div>

            <div class="mb-6 md:w-2/5 form-group">
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Ngày sản xuất</label>
              <input name="ngaySanXuat" value="{{ old('ngaySanXuat') !== null ? old('ngaySanXuat') : $sanpham->ngaySanXuat }}" type="date" class="ngaySanXuat w-full px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" >
              <div class="form-message text-red-600 mt-2"></div>
            </div>

            <div class="mb-6 md:w-2/5 form-group">
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Hạn sử dụng</label>
              <input name="hanSuDung" value="{{ old('hanSuDung') !== null ? old('hanSuDung') : $sanpham->hanSuDung }}" type="date" class="hanSuDung w-full px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" >
              <div class="form-message text-red-600 mt-2"></div>
            </div>

            <div class="mb-6 md:w-2/5 form-group">
              <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Chọn nhà sản xuất</label>
              <select name="NSX_id" class="w-full bg-gray-50 border-1 border-black text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-purple-300 form-select">
                {!! $htmlOptionNSX !!}
              </select>
            </div>

            <div class="mb-6 md:w-2/5 form-group">
              <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Chọn danh mục</label>
              <select name="danhMuc_id" class="w-full bg-gray-50 border-1 border-black text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-purple-300 form-select">
                {!! $htmlOption !!}
              </select>
            </div>

            <button type="submit" class="mb-5 btn-submit px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
              Lưu
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
          form: '.form-validate',
          formGroupSelector: '.form-group',
          errorSelector: '.form-message',
          rules: [
            Validator.isRequired('.tenSP', 'Tên sản phẩm không được phép để trống'),
            Validator.isRequired('.soLuongTon', 'Số lượng không được phép để trống'),
            Validator.isRequired('.giaNhap', 'Giá nhập không được phép để trống'),
            Validator.isRequired('.donGia', 'Đơn giá không được phép để trống'),
            Validator.isRequired('.donViTinh', 'Đơn vị tính không được phép để trống'),
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