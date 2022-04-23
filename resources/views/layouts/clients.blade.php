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
    <link rel="stylesheet" href="clientsAssets/css/style.css" />
    <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">
    <!--Totally optional :) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/9315670d89.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- <style>
		.list-item {
			height: 100vh;
		}
	</style> --}}
</head>

<body class="font-sans leading-normal tracking-normal">

    <nav class="flex items-center justify-between flex-wrap bg-white p-4 pl-6 fixed w-full z-10 top-0">
        <div class="header-logo flex items-center flex-shrink-0 text-white mr-6">
            <a class="text-white no-underline hover:text-white hover:no-underline" href="#">
                <img src="clientsAssets/img/logo.png" alt="Pharmacy Number 2">
            </a>
        </div>

        <div class="block lg:hidden">
            <button id="nav-toggle"
                class="flex items-center px-3 py-2 border rounded text-gray-500 border-gray-600 hover:text-white hover:border-white">
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
                    <a class="inline-block text-gray-600 no-underline hover:text-gray-200 hover:text-underline py-2 px-4"
                        href="#">Trang chủ</a>
                </li>
                <li class="mr-3">
                    <a class="inline-block text-gray-600 no-underline hover:text-gray-200 hover:text-underline py-2 px-4"
                        href="#">Giới thiệu</a>
                </li>
                <li class="mr-3">
                    <a class="inline-block text-gray-600 no-underline hover:text-gray-200 hover:text-underline py-2 px-4"
                        href="#">Sản phẩm</a>
                </li>
                <li class="mr-3">
                    <a class="inline-block text-gray-600 no-underline hover:text-gray-200 hover:text-underline py-2 px-4"
                        href="#">Tin tức</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="header-bottom pt-4">
        <div class="flex justify-center">
            <div class="mb-3 xl:w-2/5">
                <div class="input-group relative flex items-stretch w-full mb-4">
                    <input type="search"
                        class="form-search form-control relative flex-auto min-w-0 block w-full px-3 py-1.5 pb-1 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
                    <a href="#"
                        class="icon-search absolute right-0 btn px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700  focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out flex items-center"
                        type="button" id="button-addon2">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="search"
                            class="w-4" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="currentColor"
                                d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>
            <?php
              $customer_id = Session::get('khachhang_id');
              // dd($customer_id);
              if($customer_id == NULL) {

              
            ?>
            <a href="{{ URL::to('/login-checkout') }}">
              <div class="border-login flex"> 
                <span class="border-avatar"><i class="fas fa-user"></i></span>
                <p class="text-black font-medium">Đăng nhập / Đăng ký</p> 
              </div>
            </a>

            <?php 
              }else {
            ?>
            <a href="{{ URL::to('/logout-checkout') }}">
              <div class="border-login flex"> 
                <span class="border-avatar"><i class="fas fa-user"></i></span>
                <p class="text-black font-medium">Nguyễn Văn Trí</p> 
              </div>
            </a>
            <?php
              }
            ?>

            <a href="{{ URL::to('/show-cart') }}">
              <div class="text-white flex ml-5">
                <i class="fas fa-shopping-cart text-3xl"></i>
                <span class="badge">0</span>
                <p class="pt-3 pl-1">Giỏ hàng</p>
              </div>
            </a>
        </div>
        <div class="category-list">
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
</body>

</html>
