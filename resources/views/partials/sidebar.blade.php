<!-- Desktop sidebar -->
<aside class="sidebar-admin z-20 hidden w-64 bg-white dark:bg-gray-800 md:block flex-shrink-0 shadow-xl">
    <div class="py-4 text-gray-500 dark:text-gray-400">
        {{-- <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="#">
            Nhà thuốc số 2
        </a> --}}
        <img src="clientsAssets/img/logo.png" alt="Pharmacy Number 2" class="header-logo">
        <ul class="mt-6">
          <hr class="sidebar-divider">
            <li class="relative px-6 py-3 active">
                <span class="hidden absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                    aria-hidden="true"></span>
                <a class="link-sidebar inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                    href="{{ route('admin.home') }}">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                    <span class="ml-4">Trang chủ</span>
                </a>
            </li>
        </ul>
        <ul>
          <hr class="sidebar-divider">
          <div class="sidebar-heading">
            CỬA HÀNG
          </div>
            @can('nhasanxuat-list')
            <li class="relative px-6 py-3">
            <span class="hidden absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
            aria-hidden="true"></span>
                <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                    href="{{ route('nhasanxuats.index') }}">
                    <i class="fas fa-solid fa-user-tie"></i>
                    <span class="ml-4">Nhà sản xuất</span>
                </a>
            </li>
            @endcan
            @can('danhmuc-list')
            <li class="relative px-6 py-3">
            <span class="hidden absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
            aria-hidden="true"></span>
              <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                  href="{{ route('danhmucs.index') }}">
                  <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                      stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                      <path
                          d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                      </path>
                  </svg>
                  <span class="ml-4">Danh mục sản phẩm</span>
              </a>
          </li>
          @endcan
          @can('sanpham-list')
          <li class="relative px-6 py-3">
          <span class="hidden absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
            aria-hidden="true"></span>
            <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                href="{{ route('sanphams.index') }}">
                <i class="fas fa-solid fa-capsules"></i>
                <span class="ml-4">Sản phẩm</span>
            </a>
          </li>
          @endcan
          @can('hoadononl-list')
          <li class="relative px-6 py-3">
          <span class="hidden absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
            aria-hidden="true"></span>
            <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                href="{{ route('hoadons.index') }}">
                <i class="fas fa-solid fa-file-invoice-dollar"></i>
                <span class="ml-4">Đơn đặt hàng trực tuyến</span>
            </a>
          </li>
          @endcan
          @can('hoadonoff-list')
          <li class="relative px-6 py-3">
            <span class="hidden absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
              aria-hidden="true"></span>
              <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                  href="{{ route('hoadonoffline.index') }}">
                  <i class="fas fa-solid fa-file-invoice-dollar"></i>
                  <span class="ml-4">Đơn đặt hàng tại quầy</span>
              </a>
            </li>
          @endcan
          @can('binhluan-list')
          <hr class="sidebar-divider">
          <div class="sidebar-heading">
            KHÁCH HÀNG
          </div>
          <li class="relative px-6 py-3">
            <span class="hidden absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
              aria-hidden="true"></span>
              <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                  href="{{ route('binhluans.index') }}">
                  <i class="fas fa-solid fa-comments"></i>
                  <span class="ml-4">Bình luận</span>
              </a>
          </li>
          @endcan
          @if (Auth::user()->vaiTro_id === 5)
          <li class="relative px-6 py-3">
            <span class="hidden absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
              aria-hidden="true"></span>
              <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                  href="{{ route('inbox.index') }}">
                  <i class="fas fa-solid fa-comments"></i>
                  <span class="ml-4">Tư vấn trực tuyến</span>
              </a>
          </li>
          @endif
          @can('tktheosanpham-index')
          <hr class="sidebar-divider">
          <div class="sidebar-heading">
            THỐNG KÊ
          </div>
          <li class="relative px-6 py-3">
            <span class="hidden absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
              aria-hidden="true"></span>
              <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                  href="{{ route('thongkes.theoSanPham') }}">
                  <i class="fas fa-solid fa-chart-column"></i>
                  <span class="ml-4">Theo sản phẩm</span>
              </a>
          </li>
          @endcan
          @can('tktheohinhthuckinhdoanh-index')
          <li class="relative px-6 py-3">
            <span class="hidden absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
              aria-hidden="true"></span>
              <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                  href="{{ route('thongkes.theoHinhThucKD') }}">
                  <i class="fas fa-solid fa-chart-pie"></i>
                  <span class="ml-4">Theo hình thức KD</span>
              </a>
          </li>
          @endcan
          @can('tktongdoanhthu-index')
          <li class="relative px-6 py-3">
            <span class="hidden absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
              aria-hidden="true"></span>
              <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                  href="{{ route('thongkes.doanhThu') }}">
                  <i class="fas fa-solid fa-chart-line"></i>
                  <span class="ml-4">Tổng doanh thu</span>
              </a>
          </li>
          @endcan
          @can('khachhang-list')
          <hr class="sidebar-divider">
          <div class="sidebar-heading">
            NGƯỜI DÙNG
          </div>
          <li class="relative px-6 py-3">
          <span class="hidden absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
            aria-hidden="true"></span>
            <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                href="{{ route('khachhangs.index') }}">
                <i class="fas fa-solid fa-users"></i>
                <span class="ml-4">Danh sách khách hàng</span>
            </a>
          </li>
          @endcan
          @can('nhanvien-list')
          <li class="relative px-6 py-3">
          <span class="hidden absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
            aria-hidden="true"></span>
            <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                href="{{ route('nhanviens.index') }}">
                <i class="fas fa-solid fa-users-gear"></i>
                <span class="ml-4">Danh sách nhân viên</span>
            </a>
          </li>
          @endcan
          @can('nhomnhanvien-list')
          <li class="relative px-6 py-3">
            <span class="hidden absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
              aria-hidden="true"></span>
              <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                  href="{{ route('vaitros.index') }}">
                  <i class="fas fa-solid fa-user-tag"></i>
                  <span class="ml-4">Nhóm nhân viên</span>
              </a>
          </li>
          @endcan
          @can('quyen-list')
          <li class="relative px-6 py-3">
            <span class="hidden absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
              aria-hidden="true"></span>
              <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                  href="{{ route('quyens.index') }}">
                  <i class="fas fa-solid fa-user-slash"></i>
                  <span class="ml-4">Danh sách quyền</span>
              </a>
          </li>
          @endcan
        </ul>
    </div>
</aside>
<!-- Mobile sidebar -->

<div x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"></div>
<aside class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-white dark:bg-gray-800 md:hidden"
    x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
    x-transition:enter-start="opacity-0 transform -translate-x-20" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0 transform -translate-x-20" @click.away="closeSideMenu"
    @keydown.escape="closeSideMenu">
    <div class="py-4 text-gray-500 dark:text-gray-400">
        <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="#">
            Nhà thuốc số 2
        </a>
        <ul class="mt-6">
            <li class="relative px-6 py-3">
                <span class="hidden absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                    aria-hidden="true"></span>
                <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                    href="index.html">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                    <span class="ml-4">Trang chủ</span>
                </a>
            </li>
        </ul>
        <ul>
          <hr class="sidebar-divider">
          <div class="sidebar-heading">
            CỬA HÀNG
          </div>
            @can('nhasanxuat-list')
            <li class="relative px-6 py-3">
            <span class="hidden absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
            aria-hidden="true"></span>
                <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                    href="{{ route('nhasanxuats.index') }}">
                    <i class="fas fa-solid fa-user-tie"></i>
                    <span class="ml-4">Nhà sản xuất</span>
                </a>
            </li>
            @endcan
            @can('danhmuc-list')
            <li class="relative px-6 py-3">
            <span class="hidden absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
            aria-hidden="true"></span>
              <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                  href="{{ route('danhmucs.index') }}">
                  <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                      stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                      <path
                          d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                      </path>
                  </svg>
                  <span class="ml-4">Danh mục sản phẩm</span>
              </a>
          </li>
          @endcan
          @can('sanpham-list')
          <li class="relative px-6 py-3">
          <span class="hidden absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
            aria-hidden="true"></span>
            <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                href="{{ route('sanphams.index') }}">
                <i class="fas fa-solid fa-capsules"></i>
                <span class="ml-4">Sản phẩm</span>
            </a>
          </li>
          @endcan
          @can('hoadononl-list')
          <li class="relative px-6 py-3">
          <span class="hidden absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
            aria-hidden="true"></span>
            <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                href="{{ route('hoadons.index') }}">
                <i class="fas fa-solid fa-file-invoice-dollar"></i>
                <span class="ml-4">Đơn đặt hàng trực tuyến</span>
            </a>
          </li>
          @endcan
          @can('hoadonoff-list')
          <li class="relative px-6 py-3">
            <span class="hidden absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
              aria-hidden="true"></span>
              <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                  href="{{ route('hoadonoffline.index') }}">
                  <i class="fas fa-solid fa-file-invoice-dollar"></i>
                  <span class="ml-4">Đơn đặt hàng tại quầy</span>
              </a>
            </li>
          @endcan
          @can('binhluan-list')
          <hr class="sidebar-divider">
          <div class="sidebar-heading">
            KHÁCH HÀNG
          </div>
          <li class="relative px-6 py-3">
            <span class="hidden absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
              aria-hidden="true"></span>
              <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                  href="{{ route('binhluans.index') }}">
                  <i class="fas fa-solid fa-comments"></i>
                  <span class="ml-4">Bình luận</span>
              </a>
          </li>
          @endcan
          @if (Auth::user()->vaiTro_id === 5)
          <li class="relative px-6 py-3">
            <span class="hidden absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
              aria-hidden="true"></span>
              <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                  href="{{ route('inbox.index') }}">
                  <i class="fas fa-solid fa-comments"></i>
                  <span class="ml-4">Tư vấn trực tuyến</span>
              </a>
          </li>
          @endif
          @can('tktheosanpham-index')
          <hr class="sidebar-divider">
          <div class="sidebar-heading">
            THỐNG KÊ
          </div>
          <li class="relative px-6 py-3">
            <span class="hidden absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
              aria-hidden="true"></span>
              <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                  href="{{ route('thongkes.theoSanPham') }}">
                  <i class="fas fa-solid fa-chart-column"></i>
                  <span class="ml-4">Theo sản phẩm</span>
              </a>
          </li>
          @endcan
          @can('tktheohinhthuckinhdoanh-index')
          <li class="relative px-6 py-3">
            <span class="hidden absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
              aria-hidden="true"></span>
              <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                  href="{{ route('thongkes.theoHinhThucKD') }}">
                  <i class="fas fa-solid fa-chart-pie"></i>
                  <span class="ml-4">Theo hình thức KD</span>
              </a>
          </li>
          @endcan
          @can('tktongdoanhthu-index')
          <li class="relative px-6 py-3">
            <span class="hidden absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
              aria-hidden="true"></span>
              <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                  href="{{ route('thongkes.doanhThu') }}">
                  <i class="fas fa-solid fa-chart-line"></i>
                  <span class="ml-4">Tổng doanh thu</span>
              </a>
          </li>
          @endcan
          @can('khachhang-list')
          <hr class="sidebar-divider">
          <div class="sidebar-heading">
            NGƯỜI DÙNG
          </div>
          <li class="relative px-6 py-3">
          <span class="hidden absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
            aria-hidden="true"></span>
            <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                href="{{ route('khachhangs.index') }}">
                <i class="fas fa-solid fa-users"></i>
                <span class="ml-4">Danh sách khách hàng</span>
            </a>
          </li>
          @endcan
          @can('nhanvien-list')
          <li class="relative px-6 py-3">
          <span class="hidden absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
            aria-hidden="true"></span>
            <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                href="{{ route('nhanviens.index') }}">
                <i class="fas fa-solid fa-users-gear"></i>
                <span class="ml-4">Danh sách nhân viên</span>
            </a>
          </li>
          @endcan
          @can('nhomnhanvien-list')
          <li class="relative px-6 py-3">
            <span class="hidden absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
              aria-hidden="true"></span>
              <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                  href="{{ route('vaitros.index') }}">
                  <i class="fas fa-solid fa-user-tag"></i>
                  <span class="ml-4">Nhóm nhân viên</span>
              </a>
          </li>
          @endcan
          @can('quyen-list')
          <li class="relative px-6 py-3">
            <span class="hidden absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
              aria-hidden="true"></span>
              <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                  href="{{ route('quyens.index') }}">
                  <i class="fas fa-solid fa-user-slash"></i>
                  <span class="ml-4">Danh sách quyền</span>
              </a>
          </li>
          @endcan
        </ul>
    </div>
</aside>
