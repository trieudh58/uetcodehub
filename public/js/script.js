$(document).ready(function() {
  $('.table-display').DataTable({
    "pagingType": "full_numbers",
    "bInfo": false,
    "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Tất cả"]],
    "language"  : {
      "lengthMenu": "Số lượng: _MENU_",
      "zeroRecords": "Không có tài liệu nào phù hợp",
      "info": "Hiển thị trang _PAGE_ của _PAGES_ trang",
      "sSearch": "Tìm kiếm: ",
      "paginate": {
        "first" : "<<",
        "previous": "<",
        "next": ">",
        "last": ">>"
      },
      "infoFiltered": "(Lọc từ tổng số _MAX_ tài liệu)",
      "infoEmpty": "Không có tài liệu nào",
    }
    });

});