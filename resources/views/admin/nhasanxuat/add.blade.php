@extends('layouts.admin')

@section('title')
    <title>Trang chủ</title>
@endsection

@section('content')
    <main class="h-full pb-16 overflow-y-auto">
        <!-- Remove everything INSIDE this div to a really blank page -->
        <div class="container px-6 mx-auto py-4">
          <form action="{{ route('nhasanxuats.store') }}" method="post">
            @csrf
            <div class="mb-6 w-40p">
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tên nhà sản xuất</label>
              <input name="tenNSX" class="w-full pl-8 pr-2 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" type="text">
            </div>
            <div class="mb-6 w-40p">
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nước sản xuất</label>
              <input name="nuocSX" class="w-full pl-8 pr-2 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" type="text">
            </div>
            <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
              Thêm mới
            </button>
          </form>
        </div>
    </main>
@endsection
