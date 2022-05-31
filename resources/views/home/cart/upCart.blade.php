<script src="clients/detailsSanPham/cart.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $('.upCart').on('change keyup', function(e){
      var target = e.currentTarget;
      var newqty = $(target).val();
      var rowId = $(target).nextUntil("input").last().next().val();

      if(newqty <=0){ alert('enter only valid qty') }
      else {
        $.ajax({
            type: 'get',
            dataType: 'html',
            url: '<?php echo url('/update');?>/'+rowId,
            data: "qty=" + newqty + "& rowId=" + rowId,
            beforeSend: () => {
              $('.loading-ajax').removeClass('hidden');
            },
            success: function (response) {
              $('#updateDiv').html(response);
              $('.loading-ajax').addClass('hidden');
              const qtyProduct = $('.qty-product').text();
              $('.badge').text(qtyProduct);
            }
        });
      }
    });

    $('.button-minus').on('click', function (e) {
      var target = e.currentTarget;
      var newqty = $(target).next().val();
      var rowId = $(target).nextUntil("input:hidden").last().next().val();
      $.ajax({
        type: 'get',
        dataType: 'html',
        url: '<?php echo url('/update');?>/'+rowId,
        data: "qty=" + newqty + "& rowId=" + rowId,
        beforeSend: () => {
          $('.loading-ajax').removeClass('hidden');
        },
        success: function (response) {
          $('#updateDiv').html(response);
          $('.loading-ajax').addClass('hidden');
          const qtyProduct = $('.qty-product').text();
          $('.badge').text(qtyProduct);
        }
        });
      });

    $('.button-add').on('click', function (e) {
      var target = e.currentTarget;
      var newqty = $(target).prev().val();
      var rowId = $(target).next().val();
      $.ajax({
        type: 'get',
        dataType: 'html',
        url: '<?php echo url('/update');?>/'+rowId,
        data: "qty=" + newqty + "& rowId=" + rowId,
        beforeSend: () => {
          $('.loading-ajax').removeClass('hidden');
        },
        success: function (response) {
          $('#updateDiv').html(response);
          $('.loading-ajax').addClass('hidden');
          const qtyProduct = $('.qty-product').text();
          $('.badge').text(qtyProduct);
        }
        });
      });
  });
</script>
<script>
  $(document).ready(function () {
    $('.total-price').text($('.total-price-hidden').text());
    $('.total-pay').text($('.total-pay-hidden').text());
  });
</script>
<?php
$content = Cart::content();
?>
<div class="my-2">
    <h3 class="text-xl font-bold tracking-wider">CÓ <span class="qty-product">{{ Cart::count() }}</span> SẢN PHẨM TRONG GIỎ HÀNG</h3>
</div>
<div class="detail-line"></div>

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
            src="{{ URL::to('storage/sanpham/'.$v_content->options->image) }}"
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
          <a class="button-count button-minus">
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
            class="upCart number-product w-12 text-center bg-gray-100 outline-none"
          />
          <a class="button-count button-add">
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
          <input type="hidden" class="rowId" value="{{ $v_content->rowId }}" name="rowId_cart">
          </form>
          <div class="loading-ajax loading hidden fixed inset-0 z-9999">
            <div class="absolute inset-0 bg-gray-500 opacity-50 z-a-1"></div>
            <div div class="flex justify-center items-center w-full h-full">
                <svg class="lds-spinner" width="54px"  height="54px"
                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 100 100"
                preserveAspectRatio="xMidYMid" style="background: none;">
                <g transform="rotate(0 50 50)">
                    <rect x="47" y="24" rx="9.4" ry="4.8" width="6" height="12" fill="#f5490f">
                    <animate attributeName="opacity" values="1;0" times="0;1" dur="1s"
                    begin="-0.9166666666666666s" repeatCount="indefinite"></animate>
                    </rect>
                </g><g transform="rotate(30 50 50)">
                    <rect x="47" y="24" rx="9.4" ry="4.8" width="6" height="12" fill="#f5490f">
                    <animate attributeName="opacity" values="1;0" times="0;1" dur="1s"
                    begin="-0.8333333333333334s" repeatCount="indefinite"></animate>
                    </rect>
                </g><g transform="rotate(60 50 50)">
                    <rect x="47" y="24" rx="9.4" ry="4.8" width="6" height="12" fill="#f5490f">
                    <animate attributeName="opacity" values="1;0" times="0;1" dur="1s"
                    begin="-0.75s" repeatCount="indefinite"></animate>
                    </rect>
                </g><g transform="rotate(90 50 50)">
                    <rect x="47" y="24" rx="9.4" ry="4.8" width="6" height="12" fill="#f5490f">
                    <animate attributeName="opacity" values="1;0" times="0;1" dur="1s"
                    begin="-0.6666666666666666s" repeatCount="indefinite"></animate>
                    </rect>
                </g><g transform="rotate(120 50 50)">
                    <rect x="47" y="24" rx="9.4" ry="4.8" width="6" height="12" fill="#f5490f">
                    <animate attributeName="opacity" values="1;0" times="0;1" dur="1s"
                    begin="-0.5833333333333334s" repeatCount="indefinite"></animate>
                    </rect>
                </g><g transform="rotate(150 50 50)">
                    <rect x="47" y="24" rx="9.4" ry="4.8" width="6" height="12" fill="#f5490f">
                    <animate attributeName="opacity" values="1;0" times="0;1" dur="1s"
                    begin="-0.5s" repeatCount="indefinite"></animate>
                    </rect>
                </g><g transform="rotate(180 50 50)">
                    <rect x="47" y="24" rx="9.4" ry="4.8" width="6" height="12" fill="#f5490f">
                    <animate attributeName="opacity" values="1;0" times="0;1" dur="1s"
                    begin="-0.4166666666666667s" repeatCount="indefinite"></animate>
                    </rect>
                </g><g transform="rotate(210 50 50)">
                    <rect x="47" y="24" rx="9.4" ry="4.8" width="6" height="12" fill="#f5490f">
                    <animate attributeName="opacity" values="1;0" times="0;1" dur="1s"
                    begin="-0.3333333333333333s" repeatCount="indefinite"></animate>
                    </rect>
                </g><g transform="rotate(240 50 50)">
                    <rect x="47" y="24" rx="9.4" ry="4.8" width="6" height="12" fill="#f5490f">
                    <animate attributeName="opacity" values="1;0" times="0;1" dur="1s"
                    begin="-0.25s" repeatCount="indefinite"></animate>
                    </rect>
                </g><g transform="rotate(270 50 50)">
                    <rect x="47" y="24" rx="9.4" ry="4.8" width="6" height="12" fill="#f5490f">
                    <animate attributeName="opacity" values="1;0" times="0;1" dur="1s"
                    begin="-0.16666666666666666s" repeatCount="indefinite"></animate>
                    </rect>
                </g><g transform="rotate(300 50 50)">
                    <rect x="47" y="24" rx="9.4" ry="4.8" width="6" height="12" fill="#f5490f">
                    <animate attributeName="opacity" values="1;0" times="0;1" dur="1s"
                    begin="-0.08333333333333333s" repeatCount="indefinite"></animate>
                    </rect>
                </g><g transform="rotate(330 50 50)">
                    <rect x="47" y="24" rx="9.4" ry="4.8" width="6" height="12" fill="#f5490f">
                    <animate attributeName="opacity" values="1;0" times="0;1" dur="1s"
                    begin="0s" repeatCount="indefinite"></animate>
                    </rect>
                </g>
                </svg>
            </div>
          </div>
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
<span class="hidden total-price-hidden">{{ Cart::priceTotal(0, ',', '.') }}đ</span>
<span class="hidden total-pay-hidden">{{ number_format(Cart::totalFloat() + 15000, 0, ',', '.')}}đ</span>