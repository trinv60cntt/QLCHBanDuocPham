@extends('layouts.admin')

@section('title')
    <title>Trang chủ</title>
@endsection

@section('content')
    <main class="h-full pb-16 overflow-y-auto">
        <!-- Remove everything INSIDE this div to a really blank page -->
        <div class="container px-6 mx-auto py-4">
          <form action="{{ route('quyens.store') }}" method="post" class="form-validate">
            @csrf
            {{-- <div class="mb-6">
              <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Chọn module cần phân quyền</label>
              <select name="module_parent" class="w-full bg-gray-50 border-1 border-black text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block pl-2 pr-2  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-purple-300 form-select">
                <option value="">Chọn tên module</option>
                @foreach(config('quyens.table_module') as $key => $moduleItem)
                  <option value="{{ $key }}">{{ $moduleItem }}</option>
                @endforeach
              </select>
            </div> --}}

            {{-- <div class="mb-6 ml-1">
              <div class="row flex">
                @foreach(config('quyens.module_children') as $moduleItemChildren)
                <div class="col w-25p">
                  <label for="">
                    <input type="checkbox" name="module_children[]" value="{{ $moduleItemChildren }}">
                    {{ $moduleItemChildren }}
                  </label>
                </div>
                @endforeach
              </div>
            </div> --}}

            <div class="mb-6 w-40p form-group">
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Mã Quyền</label>
              <input name="tenQuyen" class="tenQuyen w-full px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" type="text">
              <div class="form-message text-red-600 mt-2"></div>
            </div>

            <div class="mb-6 w-40p form-group">
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tên Quyền</label>
              <input name="moTa" class="moTa w-full px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" type="text">
              <div class="form-message text-red-600 mt-2"></div>
            </div>

            <div class="mb-6 w-40p form-group">
              <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Chọn module cần phân quyền</label>
              <input type="hidden" name="moTaModule" class="mota-module">
              <select name="module_parent" class="module-parent w-full bg-gray-50 border-1 border-black text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block pl-2 pr-2  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-purple-300 form-select">
                <option value="">Chọn tên module</option>
                @foreach(config('quyens.table_module') as $key => $moduleItem)
                  <option value="{{ $key }}">{{ $moduleItem }}</option>
                @endforeach
              </select>
              <div class="form-message text-red-600 mt-2"></div>
            </div>

            {{-- <div class="mb-6 w-40p">
              <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Chọn module cần phân quyền</label>
              <select name="danhMucCha_id" class="w-full bg-gray-50 border-1 border-black text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-3  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-purple-300 form-select">
                <option value="0">Module cha</option>
                {!! $htmlOption !!}
              </select>
            </div> --}}

            <button type="submit" class="mb-5 btn-submit px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
              Thêm mới
            </button>

            <br />
            <a href="{{ route('quyens.index') }}"
            class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
              Quay lại
            </a>
          </form>
        </div>
    </main>
@endsection
@section('js')
<script>
  $(document).ready(function(){
    $('select').on('change', function() {
        var moduleParent = $('.module-parent').val();
        $('select option').each(function() {
          if($(this).val() == moduleParent) {
              $(this).attr("selected", true);
          }
          else {
            $(this).attr("selected", false);
          }
        });
        var moTaModuleSelected = $('select option[selected]').text();
        $('.mota-module').val(moTaModuleSelected);
      });
  });
</script>
<script src="admins/khachhang/add.js"></script>
<script>
    Validator({
    form: '.form-validate',
      formGroupSelector: '.form-group',
      errorSelector: '.form-message',
      rules: [
        Validator.isRequired('.tenQuyen', 'Mã quyền không được phép để trống'),
        Validator.isRequired('.moTa', 'Tên quyền không được phép để trống'),
        Validator.isRequired('.module-parent', 'Vui lòng chọn module cần phân quyền'),
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
