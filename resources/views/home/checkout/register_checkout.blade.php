@extends('layouts.clients')

@section('title')
    <title>Trang chủ</title>
@endsection

@section('content')
    <section class="module mod-register-checkout py-5">
        <div class="container mx-auto">
            <div class="flex items-center justify-center m-auto p-6 sm:p-12 md:w-1/2 user-form px-5 py-11 lg:px-16 shadow-lg">
                <div class="w-full">
                    <form action="{{ URL::to('/add-customer') }}" method="post" class="form-validate">
                        @csrf
                        <h1 class="mb-3 text-3xl text-center font-semibold text-gray-700 dark:text-gray-200">
                          Đăng ký
                        </h1>
                        @include('errors.note')
                        <label class="form-group block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Số điện thoại</span>
                            <input type="text" name="sdt" value="{{ old('sdt') }}"
                                class="sdt block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                placeholder="Số điện thoại" />
                            <div class="form-message text-red-600 mt-2"></div>
                            </label>
                        <label class="form-group block text-sm pt-1">
                            <span class="text-gray-700 dark:text-gray-400">Email</span>
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="email block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                placeholder="Email" />
                            <div class="form-message text-red-600 mt-2"></div>
                            @error('email')
                                <div class="text-red-600 mt-2">{{ $message }}</div>
                            @enderror
                            </label>
                        <label class="form-group block text-sm pt-1">
                            <span class="text-gray-700 dark:text-gray-400">Mật khẩu</span>
                            <input type="password" name="matKhau" value="{{ old('matKhau') }}"
                                class="matKhau block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                placeholder="Mật khẩu" />
                            <div class="form-message text-red-600 mt-2"></div>
                            </label>
                        <label class="form-group block text-sm pt-1">
                            <span class="text-gray-700 dark:text-gray-400">Họ</span>
                            <input type="text" name="hoKH" value="{{ old('hoKH') }}"
                                class="hoKH block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                placeholder="Họ" />
                            <div class="form-message text-red-600 mt-2"></div>
                            </label>
                        <label class="form-group block text-sm pt-1">
                            <span class="text-gray-700 dark:text-gray-400">Tên</span>
                            <input name="tenKH" value="{{ old('tenKH') }}"
                                class="tenKH block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                placeholder="Tên" type="text" />
                            <div class="form-message text-red-600 mt-2"></div>
                            </label>
                        <label class="block mt-4 text-sm pt-1">
                            <span class="text-gray-700 dark:text-gray-400">Giới tính</span>
                            <input style="margin-left: 15px;" type="radio" name="gioiTinh" value="1" checked=""> Nam
                            <input style="margin-left: 10px;" type="radio" name="gioiTinh" value="0"> Nữ
                        </label>
    
                        <label class="form-group block mt-4 text-sm pt-1">
                            <span class="text-gray-700 dark:text-gray-400">Ngày sinh</span>
                            <input name="ngaySinh" type="date"
                            value="{{ old('ngaySinh') }}"
                            class="@error('ngaySinh') error @enderror ngaySinh w-full px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input">
                            <div class="form-message text-red-600 mt-2"></div>
                        </label>
    
                        <label class="form-group block text-sm pt-1">
                            <span class="text-gray-700 dark:text-gray-400">Địa chỉ</span>
                            <input type="text" name="diaChi" value="{{ old('diaChi') }}"
                                class="diaChi block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                placeholder="Địa chỉ" />
                            <div class="form-message text-red-600 mt-2"></div>
                            </label>
    
                        <div class="form-check mt-4 form-group flex">
                            {{-- <input class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="checkbox" value="" id="flexCheckDefault"> --}}
                            <input name="remember_me" class="form-check-input h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 my-1 align-top bg-no-repeat bg-center bg-contain float-left cursor-pointer mr-2" type="checkbox" value="Remember Me" id="flexCheckDefault3">
                            <label class="form-check-label inline-block text-gray-800" for="flexCheckDefault">
                              Tôi đã đọc và đồng ý với <span class="text-sm mt-1 font-medium text-purple-600">Điều khoản và điều kiện.</span>
                            <div class="form-message text-red-600 mt-2 -ml-6"></div>
                            </label>
                          </div>
    
                        <!-- You should use a button here, as the anchor is only used for the example  -->
                        {{-- <input type="submit" name="submit" value="Đăng ký"
                            class="btn-submit block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"> --}}
                        <button type="submit"
                            class="btn-submit w-full mt-3 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            Đăng ký
                        </button>
                        <hr class="my-8" />
                        {{-- <button
                      class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                      <svg class="w-4 h-4 mr-2" aria-hidden="true" viewBox="0 0 24 24" fill="currentColor">
                          <path
                              d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12" />
                      </svg>
                      Github
                  </button>
                  <button
                      class="flex items-center justify-center w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                      <svg class="w-4 h-4 mr-2" aria-hidden="true" viewBox="0 0 24 24" fill="currentColor">
                          <path
                              d="M23.954 4.569c-.885.389-1.83.654-2.825.775 1.014-.611 1.794-1.574 2.163-2.723-.951.555-2.005.959-3.127 1.184-.896-.959-2.173-1.559-3.591-1.559-2.717 0-4.92 2.203-4.92 4.917 0 .39.045.765.127 1.124C7.691 8.094 4.066 6.13 1.64 3.161c-.427.722-.666 1.561-.666 2.475 0 1.71.87 3.213 2.188 4.096-.807-.026-1.566-.248-2.228-.616v.061c0 2.385 1.693 4.374 3.946 4.827-.413.111-.849.171-1.296.171-.314 0-.615-.03-.916-.086.631 1.953 2.445 3.377 4.604 3.417-1.68 1.319-3.809 2.105-6.102 2.105-.39 0-.779-.023-1.17-.067 2.189 1.394 4.768 2.209 7.557 2.209 9.054 0 13.999-7.496 13.999-13.986 0-.209 0-.42-.015-.63.961-.689 1.8-1.56 2.46-2.548l-.047-.02z" />
                      </svg>
                      Twitter
                  </button> --}}
    
                    <span class="text-xl font-bold"> Bạn đã có tài khoản?</span>
    
                    <a class="text-lg mt-1 font-medium text-purple-600 dark:text-purple-400 hover:underline"
                      href="{{ URL::to('/login-checkout') }}">
                      Đăng nhập
                    </a>
                        {{-- <p class="mt-1">
                      <a class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline"
                          href="./create-account.html">
                          Create account
                      </a>
                  </p> --}}
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script src="admins/khachhang/add.js"></script>
    <script>
        Validator({
        form: '.form-validate',
          formGroupSelector: '.form-group',
          errorSelector: '.form-message',
          rules: [
            Validator.isRequired('.sdt'),
            Validator.equalLength('.sdt'),
            Validator.isRequired('.email'),
            Validator.isEmail('.email'),

            // Password
            Validator.isRequired('.matKhau'),
            Validator.minLength('.matKhau', 8),
            Validator.includeOneNumber('.matKhau'),
            Validator.includeOneCharacter('.matKhau'),
            Validator.includeOneUppercase('.matKhau'),

            Validator.isRequired('.hoKH'),
            Validator.isRequired('.tenKH'),

            Validator.isRequired('.ngaySinh'),
            Validator.isRequired('.diaChi'),
            Validator.isRequired('.form-check-input'),
          ],

        });

        $(".btn-submit").click(function () {
            console.log('a');
        setTimeout(() => {
            $('html, body').animate({
            scrollTop: $(".form-group.invalid:first").offset().top - 80 + 'px'
            }, 200);
        }, 10);

        });
    </script>
@endsection