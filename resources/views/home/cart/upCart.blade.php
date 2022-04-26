<script type="text/javascript">
  // $('.badge').text()
    // function updateCart(qty, rowId) {
    //   $.get(
    //     '{{ asset('/update') }}',
    //     {qty: qty,rowId:rowId },
    //     function () {
    //       location.reload();
    //     }
    //   );
    // }

    function addQty(rowId) {
        const qty = (parseInt)($('.number-product').val()) + 1;
        console.log(typeof qty);
        console.log(qty);
        $.get(
            '{{ asset('/update') }}', {
                qty: qty,
                rowId: rowId
            },
            function() {
                location.reload();
            }
        );
    }

    function minusQty(rowId) {
        const qty = (parseInt)($('.number-product').val()) - 1;
        $.get(
            '{{ asset('/update') }}', {
                qty: qty,
                rowId: rowId
            },
            function() {
                location.reload();
            }
        );
    }

    // ----------------
    $(document).ready(function() {
        <?php for($i=1;$i<20;$i++){?>
        $('#upCart<?php echo $i; ?>').on('change keyup', function() {
            var newqty = $('#upCart<?php echo $i; ?>').val();
            var rowId = $('#rowId<?php echo $i; ?>').val();

            if (newqty <= 0) {
                alert('enter only valid qty')
            } else {
                $.ajax({
                    type: 'get',
                    dataType: 'html',
                    url: '<?php echo url('/update'); ?>/' + rowId,
                    data: "qty=" + newqty + "& rowId=" + rowId,
                    success: function(response) {
                        // console.log(response);
                        $('#updateDiv').html(response);
                    }
                });
            }
        });
        <?php } ?>
        const qtyProduct = $('.qty-product').text();
    $('.badge').text(qtyProduct);
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
        <?php $count = 1; ?>
        @foreach ($content as $v_content)
            <tr class="js-product-count">
                <td>
                    <div class="flex justify-center">
                        <img src="{{ URL::to('storage/sanpham/1/' . $v_content->options->image) }}"
                            class="object-cover h-28 w-28 rounded-2xl" alt="image" />
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
                                <svg xmlns="http://www.w3.org/2000/svg" class="inline-flex w-6 h-6 text-red-600"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </a>
                            <input type="text" name="cart_quantity" value="{{ $v_content->qty }}" min="1" data-dvt="2"
                                id="upCart<?php echo $count; ?>"
                                class="number-product w-12 text-center bg-gray-100 outline-none" />
                            <a class="button-count" onclick="addQty('{{ $v_content->rowId }}')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="inline-flex w-6 h-6 text-green-600"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </a>
                            <input type="hidden" id="rowId<?php echo $count; ?>" value="{{ $v_content->rowId }}"
                                name="rowId_cart">
                        </form>
                    </div>
                </td>
                <td class="p-4 px-6 text-center whitespace-nowrap">{{ $v_content->qty }} x
                    {{ number_format($v_content->price, 0, ',', '.') }}</td>
                <td class="p-4 px-6 text-center whitespace-nowrap">
                    <?php
                    $subtotal = $v_content->price * $v_content->qty;
                    echo number_format($subtotal, 0, ',', '.') . 'đ';
                    ?>
                </td>
                <td class="p-4 px-6 text-center whitespace-nowrap">
                    <a href="{{ URL::to('/delete-to-cart/' . $v_content->rowId) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </a>
                </td>
            </tr>
            <?php $count++; ?>
        @endforeach

    </tbody>
</table>
