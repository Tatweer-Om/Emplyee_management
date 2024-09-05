<script type="text/javascript">
    $(document).ready(function() {
     // إعادة تعيين النموذج عند إخفاء المودال
     $('.branch_modal').on('hidden.bs.modal', function() {
         $(".add_branch")[0].reset();
         $('.branch_id').val('');
     });

     // تهيئة DataTable
     $('#all_branch').DataTable().clear().destroy();
     $('#all_branch').DataTable({
         "sAjaxSource": "{{ url('show_branch') }}",
         "bFilter": true,
        //  "sDom": 'fBtlpi',
         'pagingType': 'numbers',
         "ordering": true,
         "language": {
             search: ' ',
             sLengthMenu: '_MENU_',
             searchPlaceholder: 'بحث',
             info: "_START_ - _END_ من _TOTAL_ العناصر",
         },
         initComplete: (settings, json) => {
             $('.dataTables_filter').appendTo('#tableSearch');
             $('.dataTables_filter').appendTo('.search-input');
         },
     });

     // معالجة إرسال النموذج
     $('.add_branch').off().on('submit', function(e){
         e.preventDefault();
         var formdatas = new FormData($('.add_branch')[0]);
         var title = $('.branch_name').val();

         // التحقق من صحة إدخالات النموذج
         if (title == "") {
             show_notification('error', 'يرجى إدخال اسم الفرع');
             return false;
         }

         // تحديد الإجراء بناءً على ما إذا كان branch_id موجودًا
         var url = $('.branch_id').val() ? "{{ url('update_branch') }}" : "{{ url('add_branch') }}";

         $.ajax({
             type: "POST",
             url: url,
             data: formdatas,
             contentType: false,
             processData: false,
             success: function(data) {
                 show_notification('success', 'تمت إضافة البيانات بنجاح');
                 $('#branch_modal').modal('hide');
                 $('#all_branch').DataTable().ajax.reload();
                 $(".add_branch")[0].reset();
             },
             error: function(data) {
                 show_notification('error', 'فشل إضافة البيانات');
                 $('#all_branch').DataTable().ajax.reload();
                 console.log(data);
             }
         });
     });
 });

 // دالة تعديل الفرع
 function edit(id) {
     var csrfToken = $('meta[name="csrf-token"]').attr('content');
     $.ajax({
         dataType: 'JSON',
         url: "{{ url('edit_branch') }}",
         method: "POST",
         data: {id: id, _token: csrfToken},
         success: function(fetch) {
             if (fetch) {
                 $(".branch_name").val(fetch.branch_name);
                 $(".branch_phone").val(fetch.branch_phone);
                 $(".branch_address").val(fetch.branch_address);
                 $(".branch_detail").val(fetch.branch_detail);
                 $(".branch_id").val(fetch.branch_id);
                 $(".modal-title").html('تحديث');
             }
         },
         error: function(html) {
             show_notification('error', 'فشل التعديل');
             console.log(html);
         }
     });
 }

 // دالة حذف الفرع
 function del(id) {
     Swal.fire({
         title: 'هل أنت متأكد من الحذف؟',
         text: 'حذف',
         type: "warning",
         showCancelButton: true,
         confirmButtonColor: "#3085d6",
         cancelButtonColor: "#d33",
         confirmButtonText: 'حذف',
         confirmButtonClass: "btn btn-primary",
         cancelButtonClass: "btn btn-danger ml-1",
         buttonsStyling: false
     }).then(function(result) {
         if (result.value) {
             var csrfToken = $('meta[name="csrf-token"]').attr('content');
             $.ajax({
                 url: "{{ url('delete_branch') }}",
                 type: 'POST',
                 data: {id: id, _token: csrfToken},
                 success: function(data) {
                     $('#all_branch').DataTable().ajax.reload();
                     show_notification('success', 'تم الحذف بنجاح');
                 },
                 error: function() {
                     show_notification('error', 'فشل الحذف');
                 }
             });
         } else if (result.dismiss === Swal.DismissReason.cancel) {
             show_notification('success', 'تم الحفاظ على البيانات');
         }
     });
 }
 </script>
