<script type="text/javascript">
    $(document).ready(function(e) {


        $('#m_sale_iscredit').click(function() {
            if ($(this).prop('checked') == true) {
                $('#creditdiv').removeClass('d-none');
                $('.sales_paidAmt').val(0);
            } else {
                $('#creditdiv').addClass('d-none');
                calculate_total();
            }
        });

        $('#m_sales_ispartial').click(function() {
            if ($(this).prop('checked') == false) {
                $('.paypartial').css('display', 'none');
                $('#m_sales_paytype').append(`<option value="partial" id="partial_op">Partial Payment</option>`);
                $('#m_sales_ispartial').prop('checked', false);
                calculate_total();
            }
        });

        $('#m_sales_paytype').change(function() {

            if ($(this).val() == 'partial') {
                $('.paypartial').css('display', 'block');
                $('#partial_op').remove();
                $('#m_sales_ispartial').prop('checked', true);
                // $('#m_sales_paytype').val(1);
            }

        });

        $('.sales_paidAmt').change(function() {
            var netamout = parseFloat($('#m_sale_nettotal').val());

            if ($('#m_sale_iscredit').prop('checked') == true) {
                if ($(this).attr('id') == 'm_sales_paidAmt') {
                    var paidt1 = parseFloat($('#m_sales_paidAmt').val());
                    var paidt2 = parseFloat($('#m_sales_paidAmt2').val());
                } else {
                    var paidt1 = parseFloat($('#m_sales_paidAmt2').val());
                    var paidt2 = parseFloat($('#m_sales_paidAmt').val());
                }

            } else {
                var paidt1 = parseFloat($(this).val());
                var paidt2 = (netamout - paidt1) < 0 ?0 : (netamout - paidt1);
            }
            if ($('#m_sales_ispartial').prop('checked') == true) {
                if ($(this).attr('id') == 'm_sales_paidAmt') {
                    $('#m_sales_paidAmt2').val(paidt2);
                } else {
                    $('#m_sales_paidAmt').val(paidt2);
                }
            }
            var balance = (netamout - paidt1 - paidt2);
            $("#m_sale_balamt").val(balance.toFixed(2));

            $("#sale_balamt").text('₹' + balance.toFixed(2));
        });

        $(document).on('click', '.qtybtn', function() {
            var item_id = $(this).data('item_id');
            var trans_id = $(this).data('trans_id');
            var type = $(this).val();
            item_qtychanger(type, item_id, trans_id);
            calculate_total();
        });

        $(document).on('keyup', '.amtcal', function() {
            calculate_total();
        });

        $(document).on('click', '.salepdtclk', function() {

            $('#productModal').modal('hide');

            var productid = $(this).data('itemid');
            var itemcolor = $(this).data('itemcolor');
            var itemsize = $(this).data('itemsize');
            var sizename = $(this).data('sizename');
            var colorname = $(this).data('colorname');
            var itemname = $(this).data('itemname');
            var itemrate = $(this).data('itemrate');
            var taxgst = $(this).data('taxgst');
            var maxqty = $(this).data('maxqty');

            var itemid = productid + '_' + itemsize + '_' + itemcolor;

            if ($('#itmtr' + itemid).length) {
                item_qtychanger(1, itemid);
            } else {
                add_ordered_item(itemid, productid, itemname, itemrate, itemsize, itemcolor, sizename, colorname, taxgst, maxqty)
            }
            item_total_cal(itemid);
            calculate_total();
        });


        $(document).on('click', '.groupproductclick', function() {
            // alert('workig');
            $('#productModal').modal('show');
            var item = $(this).data('itemid');
            var itemname = $(this).data('itemname');
            var itembrand = $(this).data('itembrand');

            $('#productModalLabel').html(itemname + ' (' + itembrand + ')')
            $.ajax({

                url: "<?php echo site_url('Main/get_avil_products') ?>",
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
                                var imagepath = '<?= base_url('assets/imgs/no-data.png') ?>';
                            }

                            $("#modalproduct_div").append(` 
                            <div class="col-2">
                        <div class="card p-2 salepdtclk" data-itemid="` + value.m_product_id + `" data-itemcolor="` + value.m_color_id + `" data-itemsize="` + value.m_size_id + `" data-sizename="` + value.m_size_name + `" data-colorname="` + value.m_color_name + `" data-itemname="` + value.m_product_name + `" data-itemrate="` + value.m_product_seles_price + `" data-maxqty="` + value.closing_qty + `" data-taxgst="` + value.m_tax_value + `">
                            <img src="` + imagepath + `" alt="kurtis" class="w-100 h-80" style="aspect-ratio: 1/1; object-fit: cover;">
                            
                            <div class="row para g-0">
                           
                            <div class="col-md-6 mt-2">
                            <p class="m-0">Size : ` + value.m_size_name + `</p>
                            </div>
                            <div class="col-md-6 mt-2">
                            <div style="height: 15px; width: 15px; background-color: ` + value.m_color_name + `; border:2px solid #000"></div>
                            </div>
                            <div class="col-md-12">
                                <p class="m-0">Available Stock : ` + value.closing_qty + `</p>
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

        $("#paymodeModalbtn").on('click', function(e) {
            var amount = $("#m_total_tax").val();
            var cust = $("#m_customer").val();

            if (cust == null || cust == '') {
                swal("Please Select Customer First", {
                    icon: "error",
                    timer: 3000,
                });
                return false
            }
            if (amount <= 0) {
                swal("Please Select Any Item From List", {
                    icon: "error",
                    timer: 3000,
                });
                return false
            }
            var custname = $('#m_sale_customer').find(":selected").data('custname');
            $('#paymodeModalLabel').html(custname);
            $('#paymodeModal').modal('show');
        });

        $("#btn_add_sale").click(function(e) {

            var clkbtn = $("#btn_add_sale");
            clkbtn.prop('disabled', true);
            var formData = $("#frm_add_sale").serialize();


            $.ajax({
                url: "<?php echo site_url('Main/insert_sales') ?>",
                type: "POST",
                data: formData,
                // processData: false,
                // contentType: false,
                dataType: "JSON",
                success: function(data) {
                    if (data.status == 'success') {
                        swal("Order Added Successfully", {
                            icon: "success",
                            timer: 1000,
                        });
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    } else {
                        clkbtn.prop('disabled', false);
                        swal(data.message, {
                            icon: "error",
                            timer: 5000,
                        });
                    }


                },
                error: function(jqXHR, status, err) {
                    clkbtn.prop('disabled', false);

                    swal("Somthing Went Wrong", {
                        icon: "error",
                        timer: 3000,
                    });
                }
            });

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

            url: "<?php echo site_url('Main/get_avil_products') ?>",
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
                            var imagepath = '<?= base_url('assets/imgs/no-data.png') ?>';
                        }

                        $("#product_div").append(` 
                        <div class="col-xl-2 col-lg-4">
                                    <div class="card h-100 p-2 groupproductclick" data-itemid="` + value.m_product_id + `" data-itemname="` + value.m_product_name + `" data-itembrand="` + value.m_brand_name + `">
                                        <img src="` + imagepath + `" alt="kurtis" class="w-100 h-80" style="aspect-ratio: 1/1; object-fit: cover;">
                                        <p class="mt-2 mb-0 fw-normal fn wraptext">` + value.m_product_name + `</p><span class="badge bg-success" style="position: absolute;top: 3px;right: 3px;padding: 0.2rem;">` + value.m_brand_name + `</span>
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

    function remove_itmtr(item_id, order_item_id = '') {
        if (order_item_id != '') {
            // alert(item_id +'--'+ order_item_id)
            swal({
                title: "Are You Sure ?",
                text: "You want to Remove Item From List?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willok2) => {
                if (willok2) {

                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('Welcome/delete_order_item'); ?>",
                        dataType: "JSON",
                        data: {
                            order_item_id
                        },
                        success: function(data) {
                            $('#itmtr' + item_id).remove();
                            calculate_total();
                        }
                    });

                } else {
                    swal("Data is Safe", {
                        icon: "info",
                        timer: 1000,
                    });
                }

            });

        } else {
            $('#itmtr' + item_id).remove();
            calculate_total();
        }
    }

    function item_qtychanger(type, item_id, trans_id = '') {
        var curqty = parseInt($('#t_item_qty' + item_id).val());

        if (type == 1) {
            curqty += 1;
        } else {
            if (curqty > 1) {
                curqty -= 1;
            } else {
                remove_itmtr(item_id, trans_id)
            }

        }
        $('#t_item_qty' + item_id).val(curqty);
        item_total_cal(item_id);

    }

    function add_ordered_item(itemid, productid, itemname, itemrate, itemsize, itemcolor, sizename, colorname, taxgst, maxqty) {

        $('#trnodata').remove();
        $('#ordered_itemlist').append(`<tr id="itmtr` + itemid + `">
                                                   
                                                        <td class="left">` + itemname + ` <br> 
                                                        <div class="row">
                                                        <div class="col-md-4">
                                                        <p class="pos-s m-0">Size - ` + sizename + `</p>
                                                        </div>
                                                        <div class="col-md-8">
                                                        <div class="pos-clr" style="background-color: ` + colorname + `"></div>
                                                        </div>
                                                        </div> 
                                                        </td>
                                                        <td><span class="input-wrapper">
                                                <button type="button" class="qtybtn" data-item_id="` + itemid + `" data-trans_id="" value="2">-</button>
                                                <input type="tel" name="m_sale_qty[]" id="t_item_qty` + itemid + `" value="1">
                                                                <input type="hidden" name="m_sale_product[]" id="t_item_id` + itemid + `" value="` + productid + `">
                                                                <input type="hidden" name="m_sale_price[]" id="t_item_price` + itemid + `" value="` + itemrate + `">
                                                                <input type="hidden" name="m_sale_taxgst[]" id="m_sale_taxgst` + itemid + `" value="` + taxgst + `">
                                                                <input type="hidden" class="item_grossamt" name="m_sale_total[]" id="t_item_gross_amt` + itemid + `" value="` + itemrate + `">
                                                                <input type="hidden" class="item_gsttax" name="m_sale_gst[]" id="m_sale_gst` + itemid + `" value="` + itemrate + `">
                                                                <input type="hidden" name="m_sale_id[]" id="t_trans_id` + itemid + `" >
                                                                <input type="hidden" name="m_sale_color[]" id="m_sale_color` + itemid + `" value="` + itemcolor + `">
                                                                <input type="hidden" name="m_sale_size[]" id="m_sale_size` + itemid + `" value="` + itemsize + `">
                                                <button type="button" class="qtybtn" data-item_id="` + itemid + `" value="1">+</button>
                                            </span></td>
                                                       
                                                        <td style="width: 60px;" id="item_total` + itemid + `">₹` + itemrate + `</td>
                                                        <td style="width: 30px;">
                                                            <a class="delbtn" onclick="remove_itmtr('` + itemid + `')" ><i class="fa fa-trash text-danger" aria-hidden="true"></i></a>
                                                        </td>
                                                    </tr>`);

    }

    function item_total_cal(item_id) {
        var qty = parseInt($('#t_item_qty' + item_id).val());
        var price = parseInt($('#t_item_price' + item_id).val());
        var taxgst = parseInt($('#m_sale_taxgst' + item_id).val());
        var itemtotal = qty * price;
        var taxamt = (itemtotal * taxgst / 100);
        $('#item_total' + item_id).text('₹' + itemtotal);
        $('#t_item_gross_amt' + item_id).val(itemtotal);
        $('#m_sale_gst' + item_id).val(taxamt);

    }

    function calculate_total() {

        var subtotal = 0;
        var sumtaxgst = 0;

        var discount = parseInt($("#m_sale_discount").val());
        var shipping = parseInt($("#m_sale_shipping").val());

        $(".item_grossamt").each(function() {
            subtotal = subtotal + parseFloat($(this).val());
        });

        $(".item_gsttax").each(function() {
            sumtaxgst = sumtaxgst + parseFloat($(this).val());
        });

        var natamout = (subtotal + sumtaxgst + shipping - discount);

        $("#m_subtotal").val(subtotal.toFixed(2));
        $("#m_total_tax").val(sumtaxgst.toFixed(2));
        $("#m_sale_nettotal").val(natamout.toFixed(2));
        $("#m_sale_balamt").val(natamout.toFixed(2));
        $("#m_sales_paidAmt").val(natamout.toFixed(2));
        $("#m_sales_paidAmt2").val(0);

        $("#sale_balamt").text('₹' + natamout.toFixed(2));
        $(".grandtotal").html('₹' + natamout.toFixed(2));
        $("#subtotal").html('₹' + subtotal.toFixed(2));
        $("#taxtotal").html('₹' + sumtaxgst.toFixed(2));
        $("#distotal").html('₹' + discount.toFixed(2));
        $("#shipptotal").html('₹' + shipping.toFixed(2));


    }
</script>