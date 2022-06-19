<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trang chủ</title>
    <meta name="author" content="name">
    <meta name="description" content="description here">
    <meta name="keywords" content="keywords,here">
    <base href="{{ asset('') }}">
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/3.6.95/css/materialdesignicons.css" />
    <link rel="stylesheet" href="clientsAssets/css/style.css" />
    <link rel="stylesheet" href="css/clients/style.css" />
    <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
    {{-- <link href="{{ asset('css/app1.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    @livewireStyles

    <!--Totally optional :) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://kit.fontawesome.com/9315670d89.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- <style>
		.list-item {
			height: 100vh;
		}
	</style> --}}
  <style>
		#journal-scroll::-webkit-scrollbar {
            width: 6px;
            cursor: pointer;
           

        }
        #journal-scroll::-webkit-scrollbar-track {
            background-color: rgba(229, 231, 235, var(--bg-opacity));
            cursor: pointer;
          
        }
        #journal-scroll::-webkit-scrollbar-thumb {
            cursor: pointer;
            background-color: #a0aec0;
                   }
	</style>
</head>

<body class="font-sans leading-normal tracking-normal">
    <nav class="nav-home-page flex items-center justify-between flex-wrap bg-white p-4 pl-6 fixed w-full z-10 top-0">
        <div class="header-logo flex items-center flex-shrink-0 text-white mr-6">
            <a class="text-white no-underline hover:text-white hover:no-underline" href="#">
                <img src="clientsAssets/img/logo.png" alt="Pharmacy Number 2">
            </a>
        </div>

        <div class="block lg:hidden">
            <button id="nav-toggle"
                class="flex items-center px-3 py-2 border rounded text-gray-500 border-gray-600">
                <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <title>Menu</title>
                    <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                </svg>
            </button>
        </div>

        <div class="list-item w-full flex-grow lg:flex lg:items-center lg:w-auto hidden lg:block pt-6 lg:pt-0"
            id="nav-content">
            <ul class="list-reset lg:flex justify-end flex-1 items-center">
                <li class="mr-3">
                    <a class="inline-block text-gray-600 no-underline hover:underline py-2 px-4"
                        href="#">Trang chủ</a>
                </li>
                <li class="mr-3">
                    <a class="inline-block text-gray-600 no-underline hover:underline py-2 px-4"
                        href="#">Giới thiệu</a>
                </li>
                <li class="mr-3">
                    <a class="inline-block text-gray-600 no-underline hover:underline py-2 px-4"
                        href="{{ route('menus.index') }}">Sản phẩm</a>
                </li>
                <li class="mr-3">
                    <a class="inline-block text-gray-600 no-underline hover:underline py-2 px-4"
                        href="#">Tin tức</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="header-bottom mt-16 py-5">
        <div class="flex justify-between px-4 lg:justify-center">
            <div class="hidden lg:block mb-3 lg:w-2/5">
              <form action="{{ URL::to('menu/tim-kiem') }}" autocomplete="off" method="POST">
                @csrf
                <div class="input-group relative flex items-stretch w-full mb-4">
                    <input type="search" name="keywords_submit" id="keywords"
                        class="form-search form-control relative flex-auto min-w-0 block w-full px-3 py-1.5 pb-1 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        placeholder="Tìm kiếm sản phẩm">
                    <div id="search_ajax" style="display: none;"></div>

                    <button type="submit" class="icon-search absolute right-0 btn px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700  focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out flex items-center">
                      <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="search"
                      class="w-4" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                      <path fill="currentColor"
                          d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z">
                      </path>
                      </svg>
                    </button>
                  </div>
                </form>
            </div>
            <?php
              $customer_id = Session::get('khachhang_id');
              $hoKH = Session::get('hoKH');
              $tenKH = Session::get('tenKH');
              $hinhAnh = Session::get('hinhAnh');
              // dd($hinhAnh);
              // dd($customer_id);
              if($customer_id == NULL) {

              
            ?>
            <a href="{{ URL::to('/login-checkout') }}">
              <div class="border-login ml-0 lg:ml-5 flex"> 
                <span class="border-avatar"><i class="fas fa-user"></i></span>
                <p class="text-black font-medium">Đăng nhập / Đăng ký</p> 
              </div>
            </a>

            <?php 
              }else {
            ?>
            <button
              class="js-handle-profile flex align-middle rounded-full focus:outline-none relative"
              aria-label="Account"
              aria-haspopup="true"
            >
              <div class="border-login-customer flex">
                {{-- <span class="border-avatar"><i class="fas fa-user"></i></span> --}}
                <img
                class="border-customer"
                src="storage/khachhang/{{ $hinhAnh }}"
                alt=""
                aria-hidden="true"
                />
                <p class="text-black font-medium">{{ $hoKH }} {{ $tenKH }}</p>
              </div>
              <ul
              class="hidden open-profile absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:border-gray-700 dark:text-gray-300 dark:bg-gray-700"
              >
              <li class="flex">
                <a
                  class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                  href="{{ route('khachhang.index') }}"
                >
                  <svg
                    class="w-4 h-4 mr-3"
                    aria-hidden="true"
                    fill="none"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                    ></path>
                  </svg>
                  <span>Thông tin tài khoản</span>
                </a>
              </li>
              <li class="flex">
                <a
                  class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                  href="{{ route('khachhang.lichsu') }}"
                >
                  <i class="fas fa-solid fa-clock-rotate-left w-4 h-4 mr-3"></i>
                  <span>Lịch sử mua hàng</span>
                </a>
              </li>
              <li class="flex">
                <a
                  class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                  href="{{ route('khachhang.doimatkhau') }}"
                >
                  <svg
                    class="w-4 h-4 mr-3"
                    aria-hidden="true"
                    fill="none"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
                    ></path>
                    <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                  </svg>
                  <span>Đổi mật khẩu</span>
                </a>
              </li>
              <li class="flex">
                <a
                  class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                  href="{{ URL::to('/logout-checkout') }}"
                >
                  <svg
                    class="w-4 h-4 mr-3"
                    aria-hidden="true"
                    fill="none"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"
                    ></path>
                  </svg>
                  <span>Đăng xuất</span>
                </a>
              </li>
            </ul>
            </button>
         
            <?php
              }
            ?>

            <a href="{{ URL::to('/show-cart') }}">
              <div class="text-white flex ml-5">
                <i class="fas fa-shopping-cart text-3xl"></i>
                <span class="badge">{{ Cart::count() }}</span>
                <p class="text-sm pt-3 pl-1">Giỏ hàng</p>
              </div>
            </a>
        </div>
        <div class="mt-3 lg:hidden">
          <form action="{{ URL::to('menu/tim-kiem') }}" autocomplete="off" method="POST">
            @csrf
            <div class="input-group relative flex items-stretch w-full mb-4 px-4">
                <input type="search" name="keywords_submit" id="keywords"
                    class="form-search form-control relative flex-auto min-w-0 block w-full px-3 py-1.5 pb-1 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    placeholder="Tìm kiếm sản phẩm">
                <div id="search_ajax" style="display: none;"></div>

                <button type="submit" class="icon-search mr-4 absolute right-0 btn px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700  focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out flex items-center">
                  <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="search"
                  class="w-4" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                  <path fill="currentColor"
                      d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z">
                  </path>
                  </svg>
                </button>
              </div>
            </form>
        </div>
        <div class="category-list hidden lg:block">
            <ul>
                <li>
                    <a href="#">Tra cứu thuốc kê đơn</a>
                    <ul class="dropdown">
                        <li><a href="#" class="text-black">Thuốc chống dị ứng</a></li>
                        <li><a href="#" class="text-black">Thuốc cảm ho</a></li>
                        <li><a href="#" class="text-black">Thuốc tai, mũi họng</a></li>
                        <li><a href="#" class="text-black">Thuốc nhỏ mắt</a></li>
                        <li><a href="#" class="text-black">Thuốc da liễu</a></li>
                        <li><a href="#" class="text-black">Thuốc gan mật</a></li>
                        <li><a href="#" class="text-black">Thuốc đường tiêu hóa</a></li>
                        <li><a href="#" class="text-black">Thuốc hạ mỡ máu</a></li>
                        <li><a href="#" class="text-black">Thuốc cầm máu</a></li>
                        <li><a href="#" class="text-black">Thuốc kháng sinh</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">Thực phẩm chức năng</a>
                    <ul class="dropdown">
                        <li><a href="#" class="text-black">Laptops</a></li>
                        <li><a href="#" class="text-black">Monitors</a></li>
                        <li><a href="#" class="text-black">Printers</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">Chăm sóc cá nhân</a>
                    <ul class="dropdown">
                        <li><a href="#" class="text-black">Laptops</a></li>
                        <li><a href="#" class="text-black">Monitors</a></li>
                        <li><a href="#" class="text-black">Printers</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">Tủ thuốc Covid</a>
                    <ul class="dropdown">
                        <li><a href="#" class="text-black">Laptops</a></li>
                        <li><a href="#" class="text-black">Monitors</a></li>
                        <li><a href="#" class="text-black">Printers</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">Thuốc</a>
                    <ul class="dropdown">
                        <li><a href="#" class="text-black">Laptops</a></li>
                        <li><a href="#" class="text-black">Monitors</a></li>
                        <li><a href="#" class="text-black">Printers</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">Dụng cụ y tế</a>
                    <ul class="dropdown">
                        <li><a href="#" class="text-black">Laptops</a></li>
                        <li><a href="#" class="text-black">Monitors</a></li>
                        <li><a href="#" class="text-black">Printers</a></li>
                    </ul>
                </li>
                {{-- <li><a href="#">Contact</a></li> --}}
                {{-- <li>
                    <a href="#">Thuốc &#9662;</a>
                    <ul class="dropdown">
                        <li><a href="#" class="text-black">Laptops</a></li>
                        <li><a href="#" class="text-black">Monitors</a></li>
                        <li><a href="#" class="text-black">Printers</a></li>
                    </ul>
                </li> --}}
            </ul>
        </div>
    </div>

    @yield('content')

  </div>
    <a href="{{ url('/inbox') }}" class="livechat-button z-50 livechat-button--icon screen__chat-button bottom-10 right-3 rounded-full">
      <i class="fas fa-solid fa-comments text-2xl"></i>
    </a>
    <footer id="footer" class="footer py-16">
        <div class="container">
          <div class="flex flex-wrap">
            <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/4 wow fadeInUp animated" data-wow-delay="0.2s" style="visibility: visible;-webkit-animation-delay: 0.2s; -moz-animation-delay: 0.2s; animation-delay: 0.2s;">
              <div class="mx-3 mb-8">
                <div class="footer-logo mb-3">
                  <img src="assets/img/logo-footer.png" alt="logo footer" class="logo-footer">
                </div>
                <p class="text-white -mt-14">Số điện thoại: 1900636893</p>
                <p class="text-white">Email: 1900636893</p>
              </div>
            </div>
            <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/4 wow fadeInUp animated" data-wow-delay="0.4s" style="visibility: visible;-webkit-animation-delay: 0.4s; -moz-animation-delay: 0.4s; animation-delay: 0.4s;">
              <div class="mx-3 mb-8">
                <h3 class="font-bold text-xl text-white mb-5">VỀ CHÚNG TÔI</h3>
                <ul class="text-white">
                  <li><a href="#" class="footer-links">Press Releases</a></li>
                  <li><a href="#" class="footer-links">Mission</a></li>
                  <li><a href="#" class="footer-links">Strategy</a></li>
                </ul>
              </div>
            </div>
            <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/4 wow fadeInUp animated" data-wow-delay="0.6s" style="visibility: visible;-webkit-animation-delay: 0.6s; -moz-animation-delay: 0.6s; animation-delay: 0.6s;">
              <div class="mx-3 mb-8">
                <h3 class="font-bold text-xl text-white mb-5">DANH MỤC</h3>
                <ul class="text-white">
                  <li><a href="#" class="footer-links">Career</a></li>
                  <li><a href="#" class="footer-links">Team</a></li>
                  <li><a href="#" class="footer-links">Clients</a></li>
                </ul>
              </div>
            </div>
            <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/4 wow fadeInUp animated" data-wow-delay="0.8s" style="visibility: visible;-webkit-animation-delay: 0.8s; -moz-animation-delay: 0.8s; animation-delay: 0.8s;">
                <div class="mx-3 mb-8">
                    <h3 class="font-bold text-xl text-white mb-5">Địa chỉ</h3>
                    <p class="text-white">Nhà thuốc số 02, Số 91 Đặng Tất, TP Nha Trang</p>
                </div>
                <div class="mx-3 mb-8">
                <h3 class="font-bold text-xl text-white mb-5">Theo dõi chúng tôi tại</h3>
          
                <ul class="social-icons flex justify-start">
                  <li class="mx-2">
                    <a href="#" class="footer-icon hover:bg-indigo-500">
                      <i class="lni lni-facebook-original" aria-hidden="true"></i>
                    </a>
                  </li>
                  <li class="mx-2">
                    <a href="#" class="footer-icon hover:bg-blue-400">
                      <i class="lni lni-twitter-original" aria-hidden="true"></i>
                    </a>
                  </li>
                  <li class="mx-2">
                    <a href="#" class="footer-icon hover:bg-red-500">
                      <i class="lni lni-instagram-original" aria-hidden="true"></i>
                    </a>
                  </li>
                  <li class="mx-2">
                    <a href="#" class="footer-icon hover:bg-indigo-600">
                      <i class="lni lni-linkedin-original" aria-hidden="true"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>     
      </footer>
      @yield('js')
      <script type="text/javascript">
        $(document).ready(function() {
          $('#sort').on('change', function() {
            var url = $(this).val();
            if(url) {
              window.location = url;
            }
            return false;
          });
        });
      </script>
        <script type="text/javascript">
        //Javascript to toggle the menu
        document.getElementById('nav-toggle').onclick = function(){
          document.getElementById("nav-content").classList.toggle("hidden");
        }
      </script>
      <script type="text/javascript">
        $('#keywords').keyup(function () {
          var query = $(this).val();
          // console.log(query);
          if(query != '') {
            var _token = $('input[name="_token"]').val();
            $.ajax({
              url: "{{ url('/autocomplete-ajax') }}",
              method: "POST",
              data: {query: query, _token:_token},
              success: function(data){
                $('#search_ajax').fadeIn();
                $('#search_ajax').html(data);
              }
            });
          } else {
            $('#search_ajax').fadeOut();
          }
        });

        $(document).on('click', '.li_search_ajax', function() {
          $('#keywords').val($(this).text());
          $('#search_ajax').fadeOut();
          $(".icon-search").trigger("click");
        });
        // list-products
        $(document).on('click', '.js-handle-profile', function() {
          $('.open-profile').toggleClass("hidden");
          // e.preventDefault();
        });
        $('.js-handle-profile').blur(function(){
          setTimeout(() => {
            $('.open-profile').addClass('hidden');
          }, 150)
        });
      </script>
      <script>
        function sendbtn() {
          var printtext = document.getElementById('chatmsg');
          var copytext = document.getElementById('typemsg');
          var currentdate = new Date();
          var copiedtext = copytext.value;

          var printnow = '<div class="flex justify-end pt-2 pl-10">'+'<span class="bg-green-900 h-auto text-gray-200 text-xs font-normal rounded-sm px-1 items-end flex justify-end overflow-hidden " style="font-size: 10px;">'+copiedtext+'<span class="text-gray-400 pl-1" style="font-size: 8px;">'+currentdate.getHours()+':'+currentdate.getMinutes()+'</span>'+'</span>'+'</div>';
          printtext.insertAdjacentHTML('beforeend', printnow);
          var box = document.getElementById('journal-scroll');
          box.scrollTop = box.scrollHeight;
        }
        $(document).ready(function(){
          $('.livechat-button').on('click', () => {
            if($('.live-chat').hasClass('hidden')) {
              $('.live-chat').removeClass('hidden');
            } else {
              $('.live-chat').addClass('hidden');
            }
          });
        });
      </script>
    @livewireScripts
</body>
</html>
