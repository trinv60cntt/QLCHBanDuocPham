function actionDelete(event) {
  event.preventDefault();
  let urlRequest = $(this).data('url');
  let that = $(this);

  Swal.fire({
    title: 'Bạn chắc chắn muốn xóa sản phẩm này ?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Đồng ý xóa',
    cancelButtonText: 'Hủy bỏ',
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: 'GET',
        url: urlRequest,
        success: function (data) {
          if (data.code == 200) {
            that.parent().parent().parent().remove();
            Swal.fire(
              'Đã xóa thành công!',
              'Bản ghi này đã bị xóa.',
              'success'
            )
          }
        },
        error: function () {

        },
      });
    }
  })
}

$(function () {
  $(document).on('click', '.js-action-delete', actionDelete);
});