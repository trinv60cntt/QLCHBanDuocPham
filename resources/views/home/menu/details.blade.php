@extends('layouts.clients')

@section('title')
  <title>Trang chủ</title>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/locale/vi.min.js" integrity="sha512-LvYVj/X6QpABcaqJBqgfOkSjuXv81bLz+rpz0BQoEbamtLkUF2xhPNwtI/xrokAuaNEQAMMA1/YhbeykYzNKWg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="clients/detailsSanPham/details.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        function convertDateTime() {
          $('.time-comment').each(function() {
            $(this).text(moment($(this).text(), "YYYYMMDDHmm").fromNow());
          }); 
        }

        load_comment();
        function load_comment() {
          var sanPham_id = $('.sanPham_id').val();
          var _token = $('input[name="_token"]').val();
          $.ajax({
            url: "{{ url('menu/load-comment') }}",
            method: "POST",
            data: {sanPham_id:sanPham_id, _token:_token},
            async: false,
            success:function (data) {
              $('#comment_show').html(data);
              convertDateTime();
            }
          });
        }

        $('.send-comment').click(function (e) {
          e.preventDefault();
          var sanPham_id = $('.sanPham_id').val();
          var comment_name = $('.comment_name').val();
          var comment_content = $('.comment_content').val();
          var _token = $('input[name="_token"]').val();

          $.ajax({
            url: "{{ url('menu/send-comment') }}",
            method: "POST",
            data: {sanPham_id:sanPham_id, comment_name:comment_name, comment_content: comment_content, _token:_token},
            async: false,
            success:function (data) {
              $('#notify_comment').css('display', 'block');
              $('#notify_comment').html('<p class="mt-2 p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"><span class="font-medium">Thêm bình luận thành công</span></p>');
              load_comment();
              $('.comment_name').val('')
              $('.comment_content').val('')
              $('#notify_comment').fadeOut(2000);
            }
          });
        })
      });
    </script>
    <script>
      $(document).ready(function() {
      
      });
    </script>
@endsection

@section('content')
  <section class="mod mod-details-product py-10">
    <div class="container mx-auto">
      <div class="row flex flex-wrap">
        <div class="col w-1/2 pl-3 pr-5">
          <div class="img-left">
            <img src="storage/sanpham/1/{{ $sanpham->hinhAnh }}" alt="xit mui">
          </div>
        </div>
        <div class="col w-1/2 details-right pl-5 pr-3">
          <h1 class="title-product text-2xl font-medium pb-4">
            {{ $sanpham->tenSP }}
          </h1>
          <div class="detail-line"></div>
          <div class="pt-4">
            <span class="detail-price text-3xl">{{ str_replace(',', '.', number_format($sanpham->donGia)) }}đ</span><span class="text-2xl"> / {{ $sanpham->donViTinh }}</span>
          </div>
          <div>
            <table>
              <tbody>
                <tr class="block mb-2">
                  <td class="font-medium inline">Danh mục: </td>
                  <td class="inline"><a href="#" class="text-blue-500">{{ optional($sanpham->danhmuc)->tenDM }}</a></td>
                </tr>

                <tr class="block mb-2">
                  <td class="font-medium inline">Công dụng: </td>
                  <td class="inline">{{ $sanpham->congDung }}</td>
                </tr>

                <tr class="block mb-2">
                  <td class="font-medium inline">Ngày sản xuất: </td>
                  <td class="inline">{{ str_replace('-', '/', date('d-m-Y', strtotime($sanpham->ngaySanXuat))) }}</td>
                </tr>

                <tr class="block mb-2">
                  <td class="font-medium inline">Hạn sử dụng: </td>
                  <td class="inline">{{ str_replace('-', '/', date('d-m-Y', strtotime($sanpham->hanSuDung))) }}</td>
                </tr>
                
                <tr class="block mb-2">
                  <td class="font-medium inline">Nhà sản xuất: </td>
                  <td class="inline"><a href="#">{{ optional($sanpham->nhasanxuat)->tenNSX }}</a></td>
                </tr>

                <tr class="block mb-2">
                  <td class="font-medium inline">Nước sản xuất: </td>
                  <td class="inline"><a href="#">{{ optional($sanpham->nhasanxuat)->nuocSX }}</a></td>
                </tr>
              </tbody>
            </table>
          </div>

          <form action="{{ URL::to('/save-cart') }}" method="post">
            {{ csrf_field() }}
          <div class="detail-quantity flex mt-5">
            <p class="font-medium">Chọn số lượng</p>
            <div class="flex ml-4">
              <a id="botSL" class="input-group-addon input-minus">
                <span class="fas fa-minus" style="margin-top: 7px" aria-hidden="true"></span>
              </a>
              <input type="text" 
              class="input-quantity text-center text-base font-bold" 
              name="qty" id="quantity" value="1">
              <input type="hidden"
              name="productid_hidden" id="quantity" value="{{ $sanpham->sanPham_id }}">
            </div>
            <a id="themSL" class="input-group-addon input-plus">
              <span class="fas fa-plus" style="margin-top: 7px" aria-hidden="true"></span>
            </a>
          </div>

          <div class="add-to-cart mt-5">
            <button type="submit" class="btn text-xl">Thêm vào giỏ hàng</button>
          </div>
        </form>
        </div>
      </div>

      <div class="mt-5 ml-4 comment-product py-3 px-4 bg-blue-200 rounded-t-2xl shadow-lg">
        <div class="box-title text-xl">Bình luận</div>
        <div class="bg-blue-200 p-4">
          <div class="">
            <form>
            <input placeholder="Nhập họ và tên"
            value=""
            class="comment_name w-40p px-3 text-sm text-gray-700 border-1 border-black rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
            type="text">
            <textarea name="noiDung" class="comment_content w-full form-input form-input-lg" rows="3" placeholder="Nhập nội dung bình luận (Vui lòng gõ tiếng Việt có dấu)…" spellcheck="false"></textarea>
            <div class="add-to-cart mt-3 flex justify-end">
              <button type="submit" class="btn text-xl send-comment">Gửi bình luận</button>
            </div>
            <div id="notify_comment"></div>
            </form>
          </div>
          <hr class="mt-5 bg-black">
          <form>
            @csrf
            <input type="hidden" name="sanPham_id" class="sanPham_id" value="{{ $sanpham->sanPham_id }}">
            <div id="comment_show"></div>
          </form>
        </div>
      </div>
    </div>
  </section>
@endsection