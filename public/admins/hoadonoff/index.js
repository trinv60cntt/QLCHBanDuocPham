function actionDelete(event) {
  event.preventDefault();
  $(this).parents('tr').remove();

  // event.preventDefault();
  // let urlRequest = window.location.href;
  // let that = $(this);
  // Swal.fire({
  //   title: 'Bạn chắc chắn muốn xóa sản phẩm này ?',
  //   icon: 'warning',
  //   showCancelButton: true,
  //   confirmButtonColor: '#3085d6',
  //   cancelButtonColor: '#d33',
  //   confirmButtonText: 'Đồng ý xóa',
  //   cancelButtonText: 'Hủy bỏ',
  // }).then((result) => {
  //   if (result.isConfirmed) {
  //     $.ajax({
  //       type: 'GET',
  //       url: urlRequest,
  //       success: function (data) {
  //         if (data.code == 200) {
  //           Swal.fire(
  //             'Đã xóa thành công!',
  //             '',
  //             'success'
  //           )
  //         }
  //       },
  //     });
  //   }
  // })
}

$(function () {
  $(document).on('click', '.js-action-delete', actionDelete);
});