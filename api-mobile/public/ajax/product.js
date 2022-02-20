
$(document).ready(function() {
  $.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
 })
 $('#form_add_product').validate({
  rules: {
    name: 'required',
  },
  messages:{
    name: 'Vui lòng nhập tên bánh'
  },
});

$('#form_update_product').validate({
  rules: {
    name: 'required',
  },
  messages:{
    name: 'Vui lòng nhập tên bánh'
  },
});
 $('#form_add_product').submit(function (e) {
  $('#name-error').css('color', 'red');
  });
  $('#form_update_product').submit(function () { 
    $('#name-error').css('color', 'red');
   });
});
console.log('connected')
window.DeleteProduct = function(id)
{
  Swal.fire({
    title: 'Thông báo?',
    text: "Bạn có muốn loại bánh này!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Xóa'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: "/api/products/delete/"+id,
        data: {
          _token: $('input[name="_token"]').val()
        },
        dataType: "json",
        success: function (response) {
          Swal.fire(
            'Đã xóa thành công!',
            response.message,
            'success'
          )
          $('#pid'+id).remove();
        }
      });
     
    }
   
  })    
 
}