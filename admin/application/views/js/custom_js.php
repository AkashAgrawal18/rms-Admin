<script type="text/javascript">



 var cls_table = $(".dash_datatable").DataTable({

   'order': [[0, "asc"]],

   'paging': true,

   'pageLength': 5,

   'pagingType': "numbers",

   'language': {

     searchPlaceholder: 'Search...',

     sSearch: ''

   }

 });


 var cls_table = $(".my_custom_datatable").DataTable({
  dom: 'rtip',
   'order': [[0, "asc"]],

   'paging': true,

   'pageLength': 200,

   'pagingType': "numbers",

   'language': {

     searchPlaceholder: 'Search...',

     sSearch: ''

   }

 });



 $(".my_custom_datatable").each(function(i,element) { 
//    new $.fn.dataTable.Buttons(cls_table.eq(i), {
//      buttons: [{
//          extend: "excel",
//          className: "datatable-btn btn-sm"
//        },
//        {
//          extend: "pdf",
//          className: "datatable-btn btn-sm"
//        },
//        {
//          extend: "print",
//          className: "datatable-btn btn-sm"
//        }
//      ]
//    });



   cls_table.eq(i).buttons().container().appendTo(

     $('.col-sm-6:eq(0)', 

     cls_table.eq(i).table().container())

   );



 });



</script>