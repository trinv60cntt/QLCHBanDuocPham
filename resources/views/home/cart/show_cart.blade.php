@extends('layouts.clients')

@section('title')
  <title>Trang chủ</title>
@endsection

@section('js')
    <script src="clients/detailsSanPham/cart.js"></script>
    <script type="text/javascript">
      function updateCart(qty, rowId) {
        $.get(
          '{{ asset('/update') }}',
          {qty: qty,rowId:rowId },
          function () {
            location.reload();
          }
        );
      }

      function addQty(rowId) {
        const qty = (parseInt)($('.number-product').val()) + 1;
        console.log(typeof qty);
        console.log(qty);
        $.get(
          '{{ asset('/update') }}',
          {qty: qty,rowId:rowId },
          function () {
            location.reload();
          }
        );
      }

      function minusQty(rowId) {
        const qty = (parseInt)($('.number-product').val()) - 1;
        $.get(
          '{{ asset('/update') }}',
          {qty: qty,rowId:rowId },
          function () {
            location.reload();
          }
        );
      }
    </script>
@endsection

@section('content')
  <section class="mod mod-cart py-10">
    <div class="container p-8 mx-auto">
      <div class="w-full overflow-x-auto">
        @if(Cart::count() >= 1)
        <div class="my-2">
          <h3 class="text-xl font-bold tracking-wider">CÓ {{ Cart::count() }} SẢN PHẨM TRONG GIỎ HÀNG</h3>
        </div>
        <div class="detail-line"></div>
        <?php
        $content = Cart::content();
        ?>
        <table class="table-cart w-full shadow-lg mt-3">
          <thead>
            <tr class="bg-headline text-white">
              <th class="px-6 py-3 font-bold whitespace-nowrap">Hình ảnh</th>
              <th class="px-6 py-3 font-bold whitespace-nowrap">Tên sản phẩm</th>
              <th class="px-6 py-3 font-bold whitespace-nowrap">Số lượng</th>
              <th class="px-6 py-3 font-bold whitespace-nowrap">Đơn giá</th>
              <th class="px-6 py-3 font-bold whitespace-nowrap">Thành tiền</th>
              <th class="px-6 py-3 font-bold whitespace-nowrap"></th>
            </tr>
          </thead>
          <tbody>
            @foreach($content as $v_content)
            <tr class="js-product-count">
              <td>
                <div class="flex justify-center">
                  <img
                    src="{{ URL::to('storage/sanpham/1/'.$v_content->options->image) }}"
                    class="object-cover h-28 w-28 rounded-2xl"
                    alt="image"
                  />
                </div>
              </td>
              <td class="p-4 px-6 text-center">
                <div class="flex flex-col items-center justify-center">
                  <h3>{{ $v_content->name }}</h3>
                </div>
              </td>
              <td class="p-4 px-6 text-center whitespace-nowrap">
                <div>
                  <form action="{{ URL::to('/update-cart-quantity') }}" method="post">
                    {{ csrf_field() }}
                  <a class="button-count" onclick="minusQty('{{ $v_content->rowId }}')">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="inline-flex w-6 h-6 text-red-600"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"
                      />
                    </svg>
                  </a>
                  <input
                    type="text"
                    name="cart_quantity"
                    value="{{ $v_content->qty }}"
                    min="1"
                    data-dvt="2"
                    onchange="updateCart(this.value, '{{ $v_content->rowId }}')"
                    id="qty-product"
                    class="number-product w-12 text-center bg-gray-100 outline-none"
                  />
                  <a class="button-count" onclick="addQty('{{ $v_content->rowId }}')">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="inline-flex w-6 h-6 text-green-600"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"
                      />
                    </svg>
                  </a>
                  <input type="hidden" value="{{ $v_content->rowId }}" name="rowId_cart">
                  </form>
                </div>
              </td>
              <td class="p-4 px-6 text-center whitespace-nowrap">{{ $v_content->qty }} x {{ number_format($v_content->price,0, ',', '.') }}</td>
              <td class="p-4 px-6 text-center whitespace-nowrap">
                <?php
                  $subtotal = $v_content->price * $v_content->qty;
                  echo number_format($subtotal, 0, ',', '.').'đ'; 
                ?>
              </td>
              <td class="p-4 px-6 text-center whitespace-nowrap">
                <a href="{{ URL::to('/delete-to-cart/'.$v_content->rowId) }}">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-6 h-6 text-red-400"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                    />
                  </svg>
                </a>
              </td>
            </tr>

            @endforeach
      
          </tbody>
        </table>

        <div class="detail-line my-4"></div>
        <form action="{{ URL::to('/order-place') }}" method="post">
          @csrf
          <?php
          $customer_id = Session::get('khachhang_id');
          $hoKH = Session::get('hoKH');
          $tenKH = Session::get('tenKH');
          $diaChi = Session::get('diaChi');
          $email = Session::get('email');
          $sdt = Session::get('sdt');
          $hoTenKH = $hoKH . ' ' .$tenKH;
          ?>
        <div class="info-address bg-white">
          <div class="p-4 rounded-md shadow">
            <h3 class="text-xl font-bold"><span class="text-blue-600 text-2xl">01</span> Địa chỉ giao hàng</h3> 
            <div class="px-4 pt-2">
              <p class="font-bold">Địa chỉ:</p>
              <input name="diaChi" placeholder="Địa chỉ" 
              value="{{ $diaChi }}"
              class="w-full px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
              type="text">
            </div>
          </div>
        </div>

        <div class="detail-line my-4"></div>

        <div class="info-clients bg-white">
          <div class="p-4 rounded-md shadow">
            <h3 class="text-xl font-bold"><span class="text-blue-600 text-2xl">02</span> Thông tin liên lạc</h3> 
            <div class="px-4 pt-2">
              <div class="row flex flex-wrap">
                <div class="col w-1/2 pr-2">
                  <input name="hoTenKH" placeholder="Nhập họ và tên"
                  value="{{ trim($hoTenKH) }}"
                  class="w-full px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                  type="text">
                </div>
                <div class="col w-1/2 pl-2">
                  <input name="sdt" placeholder="Nhập số điện thoại"
                  value="{{ $sdt }}"
                  class="w-full px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                  type="text">
                </div>
              </div>
        
              <input name="email" placeholder="Nhập Email"
              value="{{ $email }}"
              class="w-full px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
              type="text">
            </div>
     
          </div>
        </div>

        <div class="detail-line my-4"></div>

        <div class="info-order">
          <div class="p-4 rounded-md shadow">
            <h3 class="text-xl font-bold text-blue-600">THÔNG TIN ĐƠN HÀNG</h3>
            <div class="flex justify-between px-4">
              <span class="font-bold">Tổng tiền</span>
              <span class="font-bold">{{ Cart::priceTotal(0, ',', '.') }}đ</span>
            </div>
    
            <div class="flex justify-between px-4">
              <span class="font-bold">Phí giao hàng</span>
              <span class="font-bold">15.000đ</span>
            </div>
            {{-- <div class="flex justify-between px-4">
              <span class="font-bold">Sales Tax</span>
              <span class="font-bold">$2.25</span>
            </div> --}}
            <div
              class="
                flex
                items-center
                justify-between
                px-4
                py-2
                mt-3
                border-t-2
              "
            >
              <span class="text-xl font-bold">Cần thanh toán</span>
              <span class="text-2xl font-bold text-blue-800">
                {{ number_format(Cart::totalFloat() + 15000, 0, ',', '.')}}đ
              </span>
            </div>
          </div>
        </div>

        <div class="detail-line my-4"></div>

        <div class="print-bill">
          <div class="p-4 rounded-md shadow flex items-center">
            <input type="checkbox" class="w-5 h-5">
            <span class="text-xl font-bold ml-2">Xuất hóa đơn cho đơn hàng này</span>
          </div>
        </div>

        <div class="mt-4">
    
            <input type="submit" name="send_order_place" value="Xác nhận đặt hàng" class="
            w-full
            py-2
            text-center text-white
            bg-blue-500
            rounded-md
            shadow
            hover:bg-blue-600
          "> 
          </form>
  
        </div>
        @else
        Giỏ hàng rỗng
        @endif
      </div>
    </div>
  </section>
@endsection
