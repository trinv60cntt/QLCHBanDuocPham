@extends('layouts.admin')

@section('title')
    <title>Trang chủ</title>
@endsection

@section('content')
    <main class="h-full pb-16 overflow-y-auto">
        <!-- Remove everything INSIDE this div to a really blank page -->
        <div class="container px-6 mx-auto py-4">
          <form action="{{ route('quyens.store') }}" method="post">
            @csrf
            <div class="mb-6">
              <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Chọn module cần phân quyền</label>
              <select name="module_parent" class="w-full bg-gray-50 border-1 border-black text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block pl-2 pr-2  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-purple-300 form-select">
                <option value="">Chọn tên module</option>
                @foreach(config('quyens.table_module') as $moduleItem)
                  <option value="{{ $moduleItem }}">{{ $moduleItem }}</option>
                @endforeach
              </select>
            </div>

            <div class="mb-6 ml-1">
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
            </div>


            <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
              Thêm mới
            </button>
          </form>
        </div>
    </main>
@endsection
