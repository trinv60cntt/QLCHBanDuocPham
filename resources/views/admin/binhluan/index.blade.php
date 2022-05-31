@extends('layouts.admin')

@section('title')
    <title>Trang chủ</title>
@endsection

@section('css')
    <link rel="stylesheet" href="admins/binhluan/index.css">
@endsection

@section('js')
    {{-- <script src="vendors/sweetAlert2/sweetalert2@11.js"></script>
    <script src="admins/nhanvien/index.js"></script> --}}

    <script type="text/javascript">
        $('.btn-reply-comment').click(function(){
            let that = $(this);

            var comment_id = $(this).data('comment_id');

            var comment = $('.reply_comment_'+comment_id).val();

            var comment_product_id = $(this).data('sanpham_id');

            $.ajax({
                url:"{{ url('/admin/binhluans/reply-comment') }}",
                method: "POST",
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{comment:comment, comment_id:comment_id, comment_product_id:comment_product_id},
                success: function (data) {
                    $('.reply_comment_'+comment_id).val('');
                    $('#notify-comment').html('<p class="mt-2 p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"><span class="font-medium">Trả lời bình luận thành công</span></p>');
                    location.reload();
                }
            })

        })

        $('.icon-reply').click((e) => {
            const $ele = e.currentTarget;
            $($ele).parents('.table-row').find('.reply-comment').removeClass('hidden')
        });

        const $hasReply = $('.icon-reply').parents('.table-row').find('.comment-reply');
        // console.log($hasReply);
        var result = Object.keys($hasReply).map((key) => [Number(key), $hasReply[key]]);
        // console.log(result);
        result.forEach(element => $(element).parents('.table-row').find('.icon-reply').addClass('hidden'));
    </script>
    <script type="text/javascript">
        $('.comment_duyet_btn').click(function () {
            var comment_status = $(this).data('comment_status');
            var comment_id = $(this).data('comment_id');
            var comment_product_id = $(this).attr('id');
            if(comment_status == 1) {
                var alert = 'Duyệt bình luận thành công';
            } else {
                var alert = 'Bỏ duyệt bình luận thành công';
            }

            $.ajax({
                url:"{{ url('/admin/binhluans/allow-comment') }}",
                method: "POST",
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{comment_status:comment_status, comment_id:comment_id, comment_product_id:comment_product_id},
                success: function (data) {
                    location.reload();
                    $('#notify-comment').html('<p class="mt-2 p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"><span class="font-medium">'+ alert +'</span></p>');
                }
            })
        });
    </script>
@endsection

@section('content')
    <main class="h-full pb-16">
        <div class="container px-6 mx-auto py-4">
            <h4 class="mb-4 text-2xl text-center font-semibold text-gray-600 dark:text-gray-300">
                LIỆT KÊ BÌNH LUẬN SẢN PHẨM
            </h4>
            <div id="notify-comment"></div>
            <div class="w-full mt-6 overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr
                                class="text-xs font-semibold tracking-wide text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800 text-center">
                                <th class="px-4 py-3">STT</th>
                                <th class="px-4 py-3">Người gửi</th>
                                <th class="px-4 py-3">Nội dung</th>
                                <th class="px-4 py-3">Ngày gửi</th>
                                <th class="px-4 py-3">Sản phẩm</th>
                                <th class="px-4 py-3">Duyệt bình luận</th>
                                <th class="px-4 py-3 text-left">Chức năng</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800 text-center">
                            @foreach ($binhluans as $binhluan)
                                <tr class="table-row text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3 text-sm whitespace-nowrap">
                                        {{ $loop->index + 1 }}
                                    </td>

                                    <td class="px-4 py-3 text-sm">
                                        {{ $binhluan->ten }}
                                    </td>

                                    @if ($binhluan->tinhTrang == 0)
                                    <td class="px-4 py-3 text-sm">
                                        {{ $binhluan->noiDung }} 
                                    </td>
                                    @else
                                    <td class="px-4 py-3 text-sm text-left flex flex-col">
                                        {{ $binhluan->noiDung }} 
                                        @foreach($comment_rep as $key => $binhluan_reply)
                                            @if($binhluan_reply->binhLuanCha_id == $binhluan->binhLuan_id)
                                            <p class="comment-reply ml-3 p-2 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800">Trả lời: {{ $binhluan_reply->noiDung }}</p>
                                            @endif
                                          @endforeach
                                        <div class="reply-comment hidden">
                                          <textarea name="" id="" cols="30" rows="5" class="reply_comment_{{ $binhluan->binhLuan_id }} mt-1 p-2 border-black border-1 border-solid"></textarea>
                                          <button data-comment_id="{{ $binhluan->binhLuan_id }}" data-sanpham_id="{{ $binhluan->sanPham_id }}"
                                          class="btn-reply-comment mt-2 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                          Trả lời bình luận
                                          </button>
                                        </div>
                                    @endif

                                    <td class="px-4 py-3 text-sm whitespace-nowrap">
                                        {{ str_replace('-', '/', date('d-m-Y', strtotime($binhluan->ngay))) }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <a class="text-blue-500" href="{{ '/menu/details/' . $binhluan->sanpham->sanPham_id }}" target="_blank">{{  $binhluan->sanpham->tenSP  }}</a>
                                    </td>

                                    <td class="px-4 py-3 text-sm">
                                        @if ($binhluan->tinhTrang == 0)
                                            <input type="button" data-comment_status="1" data-comment_id="{{ $binhluan->binhLuan_id }}" id="{{ $binhluan->sanPham_id }}" 
                                            class="cursor-pointer comment_duyet_btn px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-green-500 border border-transparent rounded-lg active:bg-green-500 hover:bg-green-500 focus:outline-none focus:shadow-outline-purple" 
                                            value="Duyệt bình luận">
                                        @else
                                            <input type="button" data-comment_status="0" data-comment_id="{{ $binhluan->binhLuan_id }}" id="{{ $binhluan->sanPham_id }}" 
                                            class="cursor-pointer comment_duyet_btn px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-500 border border-transparent rounded-lg active:bg-red-500 hover:bg-red-500 focus:outline-none focus:shadow-outline-purple" 
                                            value="Bỏ duyệt">
                                        @endif
                                    </td>

                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <div class="flex items-center text-sm">
                                        @if ($binhluan->tinhTrang == 1)
                                            <span data-comment_id="{{ $binhluan->binhLuan_id }}" class="mr-4 icon-reply cursor-pointer text-purple-600"><i class='fas fa-solid fa-reply text-purple-600'></i> Trả lời</span>
                                        @endif
                                            {{-- <a href="#"
                                                class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                                aria-label="Edit">
                                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                    </path>
                                                </svg>
                                            </a> --}}
                                            <a href="#"
                                                data-url="{{ route('binhluans.delete', ['binhLuan_id' => $binhluan->binhLuan_id]) }}"
                                                class="js-action-delete flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                                aria-label="Delete">
                                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                Xóa
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div
                    class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">

                    <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                        {{ $binhluans->links() }}

                    </span>
                </div>
            </div>
        </div>
    </main>
@endsection
