$(document).ready(function() {
  $('.table-display').DataTable({
    "pagingType": "full_numbers",
    "lengthMenu": [[5, 10, 20, 50, -1], [5, 10, 20, 50, "Tất cả"]],
    "language"  : {
      "lengthMenu": "Hiển thị _MENU_ dòng trên 1 trang",
      "zeroRecords": "Không có tài liệu nào phù hợp",
      "info": "Hiển thị trang _PAGE_ của _PAGES_ trang",
      "sSearch": "Tìm kiếm: ",
      "paginate": {
        "first" : "Đầu tiên",
        "previous": "Trước",
        "next": "Sau",
        "last": "Cuối cùng"
      },
      "infoFiltered": "(Lọc từ tổng số _MAX_ tài liệu)",
      "infoEmpty": "Không có tài liệu nào",
    }
    });
});