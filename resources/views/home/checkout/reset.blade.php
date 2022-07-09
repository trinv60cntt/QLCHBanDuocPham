@extends('layouts.clients')

@section('title')
    <title>Trang chủ</title>
@endsection

@section('content')
    <section class="module mod-login-checkout py-5">
        <div class="container mx-auto">
            <div class="flex items-center justify-center m-auto p-6 sm:p-12 md:w-1/2 user-form px-5 py-11 lg:px-16 shadow-lg">
                <div class="w-full">
                    <form action="{{ URL::to('/reset') }}" method="post">
                        @csrf
                        <h1 class="mb-3 text-3xl text-center font-semibold text-gray-700 dark:text-gray-200">
                          Đặt lại mật khẩu
                        </h1>
                        @include('errors.note')
                        <label class="block text-sm mt-2">
                            <span class="text-gray-700 dark:text-gray-400">Email</span>
                            <input readonly type="text" name="email" value="{{ $email ?? old('email') }}"
                                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                placeholder="Nhập email..." />
                            <p class="mt-2 text-left text-red-500">@error('email') {{ $message }} @enderror</p>
                        </label>
                        <label class="block mt-4 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Mật khẩu mới</span>
                            <input name="password"
                                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                placeholder="Mật khẩu" type="password" />
                            <p class="mt-2 text-left text-red-500">@error('password') {{ $message }} @enderror</p>
                        </label>
                        <label class="block mt-4 text-sm">
                          <span class="text-gray-700 dark:text-gray-400">Nhập lại mật khẩu</span>
                          <input name="password_confirm"
                              class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                              placeholder="Mật khẩu" type="password" />
                            <p class="mt-2 text-left text-red-500">@error('password_confirm') {{ $message }} @enderror</p>
                      </label>

                        <!-- You should use a button here, as the anchor is only used for the example  -->
                        <input type="submit" name="submit" value="Đặt lại mật khẩu"
                            class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
