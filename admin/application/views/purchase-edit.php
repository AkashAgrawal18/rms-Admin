<?php include("head.php"); ?>
<?php include("header.php"); ?>

<style>
    .offcanvas-end {
        width: 720px !important;
    }

    .pro-link {
        color: #000 !important;
        font-weight: bold;
    }

    td,
    th {
        vertical-align: middle !important;
    }
</style>

<!-- ========== Page Content ========== -->
<section class="py-1" style="background: #797979;">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-xl-11 col-lg-10">
                <p class="m-0 text-white small fw-light">
                    <a href="<?php echo base_url('Dashboard'); ?>" class="text-white text-decoration-none ">Dashboard</a> >> <?php if ($purtype == 2) { ?> Purchases Return >> Purchases Return>><a href="#" class="text-decoration-none fw-bold"><span class="text-warning"><?php if (!empty($rdid == 1)) {
                                                                                                                                                                                                                                                                                    echo 'Edit';
                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                    echo 'Add';
                                                                                                                                                                                                                                                                                } ?></span></a> <?php } else { ?>Purchases >> Purchases >> <a href="#" class="text-decoration-none fw-bold"><span class="text-warning"><?php if (!empty($id)) {
                                                                                                                                                                                                                                                                                                                                                                                                                            echo 'Edit';
                                                                                                                                                                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                                                                                                                                                                            echo 'Add';
                                                                                                                                                                                                                                                                                                                                                                                                                        } ?></span></a> <?php } ?>
                </p>
            </div>
            <div class="col-xl-1 col-lg-2 text-end">
                <button onclick="history.back()" class="btn btn-dark btn-sm rounded-pill w-100">
                    <i class="bi bi-arrow-bar-left me-1"></i><small>Back</small>
                </button>
            </div>
        </div>
    </div>
</section>

<div class="container-fluid bg-light">
    <form class="row pt-3" method="post" <?php if ($purtype == 2) { ?> id="form-add-preturn" <?php } else { ?> <?php if (!empty($id)) { ?>id="form-edit-purchase" <?php  } else { ?>id="form-add-purchase" <?php } ?> <?php  }  ?>>

        <?php if (!empty($edit_value)) {
            $spo = $edit_value->m_purchase_spo;
            $pdate = $edit_value->m_purchase_date;
            $invoiceno = $edit_value->m_purchase_invoiceno;
            $supplier = $edit_value->m_purchase_supplier;
        } else {
            $spo = '';
            $pdate = date('Y-m-d');
            $supplier = '';
            $invoiceno = '';
        } ?>



        <?php $nettotal = 0;
        $subtotal = 0;
        $tgst = 0;
        $tdiscout = 0; ?>



        <div class="col-md-4">
            <label for="Name">Purchase Date</label>
            <input type="date" class="form-control" id="date" name="m_purchase_date" value="<?= $pdate ?>">
            <input type="hidden" class="form-control" name="rdid" value="<?= $rdid ?>">

        </div>
        <div class="col-md-4">
            <label for="Name">Invoice Number</label>
            <input type="text" class="form-control" id="name" name="m_purchase_invoice" placeholder="Enter Invoice Number" value="<?= $invoiceno ?>" required>
            <input type="hidden" name="m_sop_id" value="<?= $spo; ?>">
        </div>
        <div class="col-md-4">
            <label for="Name">Supplier</label>
            <!-- <input type="text" class="form-control" id="name" placeholder="Customer Name"> -->
            <select class="form-select" name="m_purchase_supplier" required>
                <option selected>Select Supplier</option>
                <?php foreach ($all_user as $value) { ?>
                    <option value="<?php echo $value->m_user_id; ?>" <?php if ($supplier == $value->m_user_id) echo 'selected'; ?>><?php echo $value->m_user_name; ?></option>
                <?php } ?>

            </select>
            <input type="hidden" name="m_purchase_type" value="<?php echo  $purtype; ?>">
        </div>

        <?php if ($purtype == 2) { ?>

        <?php } else { ?>

            <div class="col-md-6">
                <label for="Name">Product</label>
                <input type="text" class="form-control" list="items_datalist" id="item_serch_inp" placeholder="Product Name">

                <datalist id="items_datalist">
                    <?php
                    if (!empty($product_list)) {
                        foreach ($product_list as $pvalue) {

                    ?>
                            <option value="<?php echo $pvalue->m_product_name . '-' . $pvalue->m_fabric_name; ?>" data-itemid="<?= $pvalue->m_product_id ?>"><?php echo $pvalue->m_product_name . '-' . $pvalue->m_fabric_name; ?></option>

                    <?php
                        }
                    }
                    ?>
                </datalist>
            </div>
        <?php } ?>
        <div class="col-md-12">
            <table class="table table-bordered mt-4" id="purchase_tbl">
                <thead>
                    <th width="1%">Sn</th>
                    <th>Description of Goods</th>
                    <th>Rate</th>
                    <th>Color</th>
                    <th>Size</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Gst (%)</th>
                    <th>Discount</th>
                    <th>Net Total</th>
                    <th></th>
                </thead>
                <tbody id="tableblock">
                    <?php if (!empty($id)) {
                        $cou = 0;
                        $nettotal = 0;
                        $subtotal = 0;
                        $tgst = 0;
                        $tdiscout = 0;
                        foreach ($product_list1 as $kry) {

                            $product_colors = $this->db->select('m_color_id,m_color_name')->where_in('m_color_id', explode(',', $kry->m_product_color))->get('master_color_tbl')->result();

                            $product_size = $this->db->select('m_size_id,m_size_name')->where_in('m_size_id', explode(',', $kry->m_product_size))->get('master_size_tbl')->result();

                            $nettotal = $kry->m_purchase_total + $kry->m_purchase_gst - $kry->m_purchase_discount;
                            $subtotal += $subtotal + $kry->m_purchase_total;
                            $tgst += $tgst + $kry->m_purchase_gst;
                            $tdiscout += $tdiscout + $kry->m_purchase_discount;
                            $cou++;
                    ?>

                            <tr id="countrow<?= $cou ?>">
                                <td id="rowcount<?= $cou ?>"><?= $cou ?></td>
                                <td> <input type="hidden" name="pur_item_id[]" value="<?php echo $kry->m_purchase_id; ?>">

                                    <input type="hidden" id="pur_item_itemid<?= $cou ?>" name="pur_item_itemid[]" class="form-control Itemna" data-count="<?= $cou ?>" style="width:100%" value="<?php echo $kry->m_purchase_product; ?>">

                                    <input type="text" id="pur_item_name" class="form-control Itemna" data-count="" style="width:100%" value="<?php echo $kry->m_product_name; ?>">
                                </td>
                                <td><input type="number" id="pur_item_rate<?= $cou ?>" name="pur_item_rate[]" class="calcuclass" data-count="<?= $cou ?>" style="width:100%" value="<?php echo $kry->m_purchase_price; ?>"></td>
                                <td>
                                    <select name="m_purchase_size[]" id="m_purchase_size<?= $cou ?>">
                                        <option value="">select size</option>
                                        <?php if (!empty($product_size)) {

                                            foreach ($product_size as  $sizeit) {
                                                if ($sizeit->m_size_id == $kry->m_purchase_size) {
                                                    $op = 'selected';
                                                } else {
                                                    $op = '';
                                                }
                                                echo '<option value="' . $sizeit->m_size_id . '" '.$op.'>' . $sizeit->m_size_name . '</option>';
                                            }
                                        } ?>
                                    </select>
                                </td>
                                <td>
                                    <select name="m_purchase_color[]" id="m_purchase_color<?= $cou ?>">
                                        <option value="">select colour</option>
                                        <?php if (!empty($product_colors)) {

                                            foreach ($product_colors as  $colorit) {
                                                if ($colorit->m_color_id == $kry->m_purchase_color) {
                                                    $op = 'selected';
                                                } else {
                                                    $op = '';
                                                }
                                                echo '<option value="' . $colorit->m_color_id . '" '.$op.'>' . $colorit->m_color_name . '</option>';
                                            }
                                        } ?>
                                    </select>
                                </td>
                                <td><input type="text" id="pur_item_qty<?= $cou ?>" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" name="pur_item_qty[]" class="calcuclass" data-count="<?= $cou ?>" style="width:100%" value="<?php echo $kry->m_purchase_qty; ?>">
                                    <input type="hidden" name="pre_item_qty[]" value="<?php echo $kry->m_purchase_qty; ?>">
                                </td>
                                <td><input type="number" id="pur_item_total<?= $cou ?>" name="pur_item_total[]" class="prodtotal" data-count="<?= $cou ?>" style="width:100%" value="<?php echo $kry->m_purchase_total; ?>" readonly></td>
                                <td><input type="number" id="pur_item_gst<?= $cou ?>" name="pur_item_gst[]" class="prodgst calcuclass" data-count="<?= $cou ?>" style="width:100%" value="<?php echo $kry->m_purchase_gst; ?>" readonly></td>
                                <td><input type="text" id="pur_item_disc<?= $cou ?>" name="pur_item_disc[]" class="proddisc calcuclass" data-count="<?= $cou ?>" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" style="width:100%" value="<?php echo $kry->m_purchase_discount; ?>"></td>
                                <td><input type="number" id="pur_item_nettotal<?= $cou ?>" name="pur_item_nettotal[]" class="pnettotal" data-count="<?= $cou ?>" style="width:100%" value="<?php echo $nettotal; ?>" readonly></td>
                                <?php if ($purtype == 2) { ?>

                                    <td> <button type="button" class="btn btn-danger p-1" id="removerow" data-count="<?= $cou ?>" title="Delete"><i class="fa-solid fa-trash"></i></button></td>
                                <?php } else { ?>
                                    <td> <button type="button" class="btn btn-danger p-1 del-purchase-product" data-value="<?php echo $kry->m_purchase_id; ?>" title="Delete"><i class="fa-solid fa-trash"></i></button></td>
                                <?php } ?>
                            </tr>
                    <?php }
                        echo '<input type="hidden" id="rowunt" value="' . $cou . '">';
                    } ?>

                    <input type="hidden" id="rowunt" value="0">
                </tbody>

            </table>
        </div>
        <div class="col-md-8">
            <label for="Name">Terms & Conditions</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" placeholder="1. Goods once sold will not be taken back or exchanged 	2. All disputes are subject to [ENTER_YOUR_CITY_NAME] jurisdiction only"></textarea>

            <label for="Name">Notes</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>

        </div>
        <div class="col-md-4 mb-5">
            <label for="order">Gst tax</label>
            <input type="number" name="m_purchase_totalcgst" id="m_purchase_totalcgst" class="form-control" placeholder="Total GST" value="<?= $tgst ?>" readonly>
            <!-- <select class="form-control mb-3" id="exampleFormControlSelect1">
                <option>GST (30%)</option>
                <option>GST (10%)</option>
            </select>
 -->
            <label for="order">Discount</label>
            <div class="input-group mb-3">
                <span class="input-group-text">₹</span>
                <input type="number" name="m_purchase_totaldiscount" id="m_purchase_totaldiscount" class="form-control" placeholder="Total Discount" value="<?= $tdiscout ?>" readonly>
                <!-- <input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)"> -->
            </div>
            <label for="order">Shipping</label>
            <div class="input-group mb-3">
                <span class="input-group-text">₹</span>
                <input type="number" name="m_purchase_other_charges" id="m_purchase_other_charges" class="form-control grandtotalclass" placeholder="Grand Total" value="0">
                <!-- <input type="number" class="form-control" aria-label="Dollar amount (with dot and two decimal places)"> -->
            </div>

            <div class="row">
                <div class="col-md-6">
                    Sub Total
                </div>
                <div class="col-md-6">
                    <input type="number" name="m_purchase_subtotal" id="m_purchase_subtotal" class="form-control" placeholder="Sub Total" value="<?= $subtotal ?>" readonly>
                </div>
                <div class="col-md-6 ">
                    Discount
                </div>
                <div class="col-md-6">
                    <input type="number" name="m_purchase_disc" id="m_purchase_disc" class="form-control" placeholder="Discount" value="<?= $tdiscout ?>" readonly>
                </div>
                <div class="col-md-6">
                    Shipping
                </div>
                <div class="col-md-6">
                    <input type="number" name="m_purchase_other_charges" id="m_purchase_other_charges" class="form-control grandtotalclass" placeholder="other charges" value="0">
                </div>
                <div class="col-md-6">
                    Grand Total
                </div>
                <div class="col-md-6">
                    <input type="number" name="m_purchase_grandt" id="m_purchase_grandt" class="form-control" placeholder="Grand Total" value="<?= $subtotal + $tgst ?>" readonly>
                </div>

                <?php if ($purtype == 2) { ?>
                    <button type="submit" id="btn-add-preturn" class="btn btn-primary"><i class="fa-regular fa-pen-to-square"></i> Save</button>


                <?php } else { ?>


                    <?php if (!empty($id)) { ?>
                        <button type="submit" id="btn-edit-purchase" class="btn btn-primary"><i class="fa-regular fa-pen-to-square"></i> Save</button>

                    <?php  } else { ?>
                        <button type="submit" id="btn-add-purchase" class="btn btn-primary"><i class="fa-regular fa-pen-to-square"></i> Save</button>
                    <?php } ?>


                <?php  }  ?>
                <!-- <button type="submit" class="btn btn-primary w-100 btn-sm" id="btn-add-purchase"><i class="fa-solid fa-file"></i> Save</button> -->
                <!-- <button type="submit" id="btn-add-purchase" class="btn btn-primary w-100 btn-sm">Save</button> -->
                <!-- <a href="<?php echo site_url('User/purchase') ?>" class="btn btn-primary w-100 btn-sm">Cancel </a> -->



            </div>
        </div>
    </form>

    <!-- edit Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cotton Kurti</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="order">Price</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">₹</span>
                        <input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)">
                    </div>

                    <label for="order">Discount</label>
                    <div class="input-group mb-3">
                        <input type="number" class="form-control " aria-label="Dollar amount (with dot and two decimal places)">
                        <span class="input-group-text">%</span>
                    </div>
                    <label for="order">Tax</label>
                    <select class="form-control mb-3" id="exampleFormControlSelect1">
                        <option>GST (30%)</option>
                        <option>GST (10%)</option>
                    </select>
                    <label for="order">Tax Type</label>
                    <select class="form-control mb-3" id="exampleFormControlSelect1">
                        <option>Exclusive</option>
                        <option>Inclusive</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary"><i class="fa-regular fa-pen-to-square"></i> Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ========== Page Content ========== -->
    <?php include("footer.php"); ?>
    <?php $this->view('js/main_js');  ?>

    <script>
        $(document).ready(function(e) {

            let incount = $('#rowunt').val();
            $(document).on('change', '#item_serch_inp', function() {
                var name = $(this).val()
                var itemid = $("#items_datalist option[value='" + $(this).val() + "']").attr('data-itemid')

                $.ajax({
                    url: "<?php echo site_url('User/get_product_dtl'); ?>",
                    type: "POST",
                    data: {
                        itemid
                    },
                    dataType: "JSON",
                    success: function(data) {
                        if (data != '') {
                            // console.log(data);
                            incount++
                            addrow(incount)
                            $('#m_purchase_size' + incount).empty().html(`<option value="">select size</option>`);
                            $.each(data[0].m_product_size, function(i, sizeit) {
                                $('#m_purchase_size' + incount).append(`<option value="` + sizeit.m_size_id + `">` + sizeit.m_size_name + `</option>`);

                            });

                            $('#m_purchase_color' + incount).empty().html(`<option value="">select colour</option>`);
                            $.each(data[0].m_product_color, function(i, coloit) {
                                $('#m_purchase_color' + incount).append(`<option value="` + coloit.m_color_id + `">` + coloit.m_color_name + `</option>`);

                            });


                            $('#pur_item_name' + incount).val(name);
                            $('#pur_item_itemid' + incount).val(itemid);

                            $('#pur_item_gst' + incount).val(data[0].m_tax_value);
                            $('#pur_item_rate' + incount).val(data[0].m_product_purche_price);
                            calculate_function(incount)

                        }

                    }
                });

                $(this).val('');
            });

            $(document).on("keyup", '.calcuclass', function() {
                var count = $(this).data('count');
                calculate_function(count)
            });

            $(document).on('change', '.Itemna', function() {
                var count = $(this).data('count');
                var rate = $(this).find(':selected').data('rate')
                var gst = $(this).find(':selected').data('gst')
                $('#pur_item_gst' + count).val(gst);
                $('#pur_item_rate' + count).val(rate);
                calculate_function(count)
            });

            $(document).on("change", '.grandtotalclass', function() {

                var transportation_charges = parseFloat($('#m_purchase_transportation_charges').val());
                var other_charges = parseFloat($('#m_purchase_other_charges').val());
                var grandt = 0;
                $('.pnettotal').each(function(index) {
                    grandt += parseInt($(this).val());

                });
                if (transportation_charges == null) {
                    transportation_charges = 0;
                }
                if (other_charges == null) {
                    other_charges = 0;
                }

                // alert(transportation_charges);
                // alert(other_charges);
                // alert(grandt);
                var Tamount = transportation_charges + other_charges + grandt;
                // alert(Tamount);
                $('#m_purchase_grandt').val(Tamount);

            });



            $(document).on("click", '.removerow', function() {

                var count = $(this).data('count');

                $('#rowcot' + count).remove();
                calculate_function(count)

            });


            $(document).on("click", '#removerow', function() {

                var count = $(this).data('count');

                $('#countrow' + count).remove();
                calculate_function(count)

            });


        });

        function addrow(x) {
            // x++;
            $('#tableblock').append(` <tr id="rowcot` + x + `">
        <td id="rowcount` + x + `">` + x + `</td>
        <td> <input type="hidden" name="pur_item_id[]">
             <input type="text" id="pur_item_name` + x + `" name="pur_item_name[]" class="form-control Itemna" data-count="` + x + `" style="width:100%" value="">
        </td>
        <td>
        <input type="hidden" id="pur_item_itemid` + x + `" name="pur_item_itemid[]" class="form-control Itemna" data-count="` + x + `" style="width:100%" value="">
        <input type="number" id="pur_item_rate` + x + `" name="pur_item_rate[]" class="calcuclass" data-count="` + x + `" style="width:100%" value=""></td>
        <td> 
        <select name="m_purchase_size[]" id="m_purchase_size` + x + `">

</select>
        </td>
        <td> 
        <select name="m_purchase_color[]" id="m_purchase_color` + x + `">

</select>
        </td>
       
        <td><input type="text" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" id="pur_item_qty` + x + `" name="pur_item_qty[]" class="calcuclass" data-count="` + x + `" style="width:100%" value="1"></td>
        <td><input type="number" id="pur_item_total` + x + `" name="pur_item_total[]" class="prodrate prodtotal" data-count="` + x + `" style="width:100%" value="" readonly></td>



        <td><input type="number" id="pur_item_gst` + x + `" name="pur_item_gst[]" class="calcuclass" data-count="` + x + `" style="width:100%" value="0" readonly><input type="hidden" id="pur_item_gstamt` + x + `" name="pur_item_gstamt[]" class="prodgst" data-count="` + x + `" style="width:100%" value=""></td>
        <td><input type="text" id="pur_item_disc` + x + `" name="pur_item_disc[]" class="proddisc calcuclass" data-count="` + x + `" style="width:100%" value="0" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)"></td>
        <td><input type="number" id="pur_item_nettotal` + x + `" name="pur_item_nettotal[]" class="pnettotal" data-count="` + x + `" style="width:100%" value="" readonly></td>
        <td>  <button type="button" class="btn btn-danger p-1 removerow" data-count="` + x + `" title="Delete"><i class="fa-solid fa-trash"></i></button></td>
        </tr>`);
            selectRefresh();
        }

        function calculate_function(count) {
            var rate = $('#pur_item_rate' + count).val();
            var qty = $('#pur_item_qty' + count).val();
            var gst = parseFloat($('#pur_item_gst' + count).val());
            var disc = parseFloat($('#pur_item_disc' + count).val());


            var amount = (qty * rate);
            var gstamount = amount * gst / 100;
            var netamount = (amount + gstamount - disc);


            $('#pur_item_total' + count).val(amount);
            $('#pur_item_nettotal' + count).val(netamount);
            $('#pur_item_gstamt' + count).val(gstamount);

            var subTotal = 0;
            $('.prodtotal').each(function(index) {
                subTotal += parseInt($(this).val());

            });

            var Tamount = 0;
            $('.pnettotal').each(function(index) {
                Tamount += parseInt($(this).val());

            });

            var Tgst = 0;
            $('.prodgst').each(function(index) {
                Tgst += parseInt($(this).val());

            });

            var Tdisc = 0;
            $('.proddisc').each(function(index) {
                Tdisc += parseInt($(this).val());

            });


            $('#m_purchase_subtotal').val(subTotal);
            $('#m_purchase_totaldiscount').val(Tdisc);
            $('#m_purchase_totalcgst').val(Tgst);
            $('#m_purchase_grandt').val(Tamount);


        }

        function selectRefresh() {
            // location.reload();
        }
    </script>