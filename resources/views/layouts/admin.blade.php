<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('title')
    <base href="{{ asset('') }}">
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="assets/css/tailwind.output.css" />
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" />

    <link rel="stylesheet" href="assets/css/style.css" />
    <!-- Scripts -->
    <!-- Styles -->
    {{-- <link href="{{ asset('css/app1.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    @livewireStyles
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
      defer
    ></script>
    <script src="assets/js/init-alpine.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://kit.fontawesome.com/9315670d89.js" crossorigin="anonymous"></script>
    {{-- <script src="https://kit.fontawesome.com/47bf8473f8.js" crossorigin="anonymous"></script> --}}
    <style>
        .alert-success {
        color: #1d643b;
        background-color: #d7f3e3;
        border-color: #c7eed8;
      }
    </style>
    @yield('css')
  </head>
  <body>
    @php
    $user = auth()->user();
    // dd($user);
      if($user == null) {
        return view('login');
      }
    @endphp
    <div
      class="flex h-screen bg-gray-50 dark:bg-gray-900"
      :class="{ 'overflow-hidden': isSideMenuOpen }"
    >
      {{-- Sidebar --}}
      @include('partials.sidebar')
      <!-- Backdrop -->

      <div class="flex flex-col flex-1 w-full">
        {{-- Header --}}
        @include('partials.header')
        @yield('content')
      </div>
    </div>
    @yield('js')
    
    {{-- <script type="text/javascript">
      $(document).ready(function(){
        $('.link-sidebar').on('click', (event) => {
          const $target = $(event.currentTarget)


        });
      });
    </script> --}}
    @livewireScripts
  </body>
</html>

