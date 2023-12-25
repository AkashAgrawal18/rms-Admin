<script type="text/javascript">
    $(document).ready(function(e) {

        $(document).on('click', '.groupproductclick', function() {
            // alert('workig');
            $('#productModal').modal('show');
            var item = $(this).data('itemid');
            $.ajax({

                url: "<?php echo site_url('User/get_avil_products') ?>",
                dataType: "JSON",
                method: "POST",
                data: {
                    item
                },
                success: function(data) {

                    // console.log(data);
                    $("#modalproduct_div").empty();

                    if (data != '') {

                        $.each(data, function(index, value) {

                            if (value.m_product_image != '') {
                                var imagepath = "<?= base_url('uploads/product/') ?>" + value.m_product_image;
                            } else {
                                var imagepath = '<?= base_url('assets/imgs/user.png') ?>';
                            }

                            $("#modalproduct_div").append(` 
                            <div class="col-2">
                        <div class="card p-2 " data-itemid="` + value.m_product_id + `">
                            <img src="` + imagepath + `" alt="kurtis" class="w-100 h-80" style="aspect-ratio: 1/1; object-fit: cover;">
                            
                            <div class="row para g-0">
                           
                            <div class="col-md-6 mt-2">
                            <p class="m-0">Size : ` + value.m_size_name + `</p>
                            </div>
                            <div class="col-md-6 mt-2">
                            <div style="height: 15px; width: 15px; background-color: ` + value.m_color_name + `;"></div>
                            </div>
                            <div class="col-md-12">
                                <p class="m-0">Remaining Stock : ` + value.closing_qty + `</p>
                            </div>
                            </div>
                            <p class="fw-bold m-0">₹ ` + value.m_product_seles_price + ` <small> <del>₹ ` + value.m_product_mrp + `</del></small></p>
                        </div>
                    </div>
                    `);
                        });
                    }

                }

            });
        });

        // $('#savecustbtn').on('click', function() {
        //     var customer_name = $('#customer_name').val() == '' ? 'Walking Customer' : $('#customer_name').val();
        //     var customer_contact = $('#customer_contact').val() == '' ? 'XXXXXXXXXX' : $('#customer_contact').val();
        //     var customer_city = $('#customer_city').val();
        //     $('#headcust').html(customer_name + ',' + customer_contact);
        // });

        var defalutcat = $(".catclick.active").data('cat_id');
        get_cate_items(defalutcat)



        $(".catclick").on('click', function() {
            var category = $(this).data('cat_id');
            get_cate_items(category)
        });

        $("#search_itemin").keyup(function() {
            var item_name = $(this).val();
            // alert(item_name);
            get_cate_items(null, item_name)

        });
        // $("#punch_itemin").enterKey(function() {
        //     var code = $(this).val();
        //     $.ajax({
        //         url: "<?php echo site_url('Welcome/punch_item_input') ?>",
        //         dataType: "JSON",
        //         method: "POST",
        //         data: {
        //             code
        //         },
        //         success: function(data) {
        //             if (data) {
        //                 // console.log(data);
        //                 if ($('#itmtr' + data.m_item_id).length) {
        //                     item_qtychanger(1, data.m_item_id);
        //                 } else {
        //                     add_ordered_item(data.m_item_id, data.m_item_name, data.m_item_offer_price)
        //                 }
        //                 calculate_total();
        //                 $('#punch_itemin').focus();
        //             } else {
        //                 swal("No Such Item Found! Please Try Again", {
        //                     icon: "error",
        //                     timer: 1000,
        //                 });
        //                 $('#punch_itemin').focus();
        //             }
        //         }

        //     });
        //     $(this).val('');
        //     $('#punch_itemin').focus();
        // });



    });


    function get_cate_items(category = '', search = '') {

        $.ajax({

            url: "<?php echo site_url('User/get_avil_products') ?>",
            dataType: "JSON",
            method: "POST",
            data: {
                cat: category,
                search,
                group: 1
            },
            success: function(data) {

                // console.log(data);
                $("#product_div").empty();

                if (data != '') {

                    $.each(data, function(index, value) {

                        if (value.m_product_image != '') {
                            var imagepath = "<?= base_url('uploads/product/') ?>" + value.m_product_image;
                        } else {
                            var imagepath = '<?= base_url('assets/imgs/user.png') ?>';
                        }

                        $("#product_div").append(` 
                        <div class="col-3">
                                    <div class="card p-2 groupproductclick" data-itemid="` + value.m_product_id + `">
                                        <img src="` + imagepath + `" alt="kurtis" class="w-100 h-80" style="aspect-ratio: 1/1; object-fit: cover;">
                                        <h6 class="mt-2 fw-normal">` + value.m_product_name + `</h6>
                                        <h6 class="mt-2">₹ ` + value.m_product_seles_price + ` <small> <del>₹  ` + value.m_product_mrp + `</del></small></h6>
                                    </div>
                                </div>
                                `);
                    });
                }

                $(".catclick").removeClass("active");
                $("#catdiv" + category).addClass("active");


            }

        });

    }

    // function remove_itmtr(item_id, order_item_id = '') {
    //     if (order_item_id != '') {
    //         // alert(item_id +'--'+ order_item_id)
    //         swal({
    //             title: "Are You Sure ?",
    //             text: "You want to Remove Item From List?",
    //             icon: "warning",
    //             buttons: true,
    //             dangerMode: true,
    //         }).then((willok2) => {
    //             if (willok2) {

    //                 $.ajax({
    //                     type: "POST",
    //                     url: "<?php echo site_url('Welcome/delete_order_item'); ?>",
    //                     dataType: "JSON",
    //                     data: {
    //                         order_item_id
    //                     },
    //                     success: function(data) {
    //                         $('#itmtr' + item_id).remove();
    //                         calculate_total();
    //                     }
    //                 });

    //             } else {
    //                 swal("Data is Safe", {
    //                     icon: "info",
    //                     timer: 1000,
    //                 });
    //             }

    //         });

    //     } else {
    //         $('#itmtr' + item_id).remove();
    //         calculate_total();
    //     }
    // }
</script>