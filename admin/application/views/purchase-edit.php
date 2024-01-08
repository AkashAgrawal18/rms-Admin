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

    .table>:not(caption)>*>* {
        padding: 0.2rem 0.2rem !important;
    }
</style>

<!-- ========== Page Content ========== -->
<section class="py-1" style="background: #797979;">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-xl-11 col-lg-10">
                <p class="m-0 text-white small fw-light">
                <a href="<?php echo base_url('Dashboard'); ?>" class="text-white text-decoration-none ">Dashboard</a> >> <?= $pagename?>
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
    <form class="row pt-3" method="post" id="form-add-purchase" >

        <?php if (!empty($edit_value)) {
            $spo = $edit_value[0]->m_purchase_spo;
            $pdate = $edit_value[0]->m_purchase_date;
            $invoiceno = $edit_value[0]->m_purchase_invoiceno;
            $supplier = $edit_value[0]->m_purchase_supplier;
            $purtype = $edit_value[0]->m_purchase_type;
            $pushipping = $edit_value[0]->m_purchase_shipping;
            $puterms = $edit_value[0]->m_purchase_terms;
            $punote = $edit_value[0]->m_purchase_note;
        } else {
            $spo = '';
            $pdate = date('Y-m-d');
            $supplier = '';
            $invoiceno = '';
          
            $pushipping = 0;
            $puterms = '';
            $punote = '';
        } ?>


        <div class="col-md-3">
            <label for="Name"><?= $purtype == 1 ?'Purchase' : 'Return' ?> Date</label>
            <input type="date" class="form-control" id="date" name="m_purchase_date" value="<?= $pdate ?>">
           
        </div>
        <div class="col-md-3">
            <label for="Name">Invoice Number</label>
            <input type="text" class="form-control" id="name" name="m_purchase_invoice" placeholder="Enter Invoice Number" value="<?= $invoiceno ?>" required>
          
        </div>
        <div class="col-md-3">
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
            <div class="col-md-3">
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
                    <th>Discount (%)</th>
                    <th>Net Total</th>
                    <th></th>
                </thead>
                <tbody id="tableblock">
                    <?php if (!empty($id) && !empty($edit_value)) {
                        $cou = 0;
                       
                        foreach ($edit_value[0]->m_purchase_items as $kry) {

                            $product_colors = $this->db->select('m_group_id as m_color_id,m_group_name as m_color_name')->where_in('m_group_id', explode(',', $kry->m_product_color))->get('master_goups_tbl')->result();

                            $product_size = $this->db->select('m_group_id as m_size_id,m_group_name as m_size_name')->where_in('m_group_id', explode(',', $kry->m_product_size))->get('master_goups_tbl')->result();

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
                                                echo '<option value="' . $sizeit->m_size_id . '" ' . $op . '>' . $sizeit->m_size_name . '</option>';
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
                                                echo '<option value="' . $colorit->m_color_id . '" ' . $op . '>' . $colorit->m_color_name . '</option>';
                                            }
                                        } ?>
                                    </select>
                                </td>
                                <td><input type="text" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" id="pur_item_qty<?= $cou ?>" name="pur_item_qty[]" class="calcuclass" data-count="<?= $cou ?>" style="width:100%" value="<?= $kry->m_purchase_qty?>"></td>
              <td><input type="number" id="pur_item_total<?= $cou ?>" name="pur_item_total[]" class="prodrate prodtotal" data-count="<?= $cou ?>" style="width:100%" value="<?= $kry->m_purchase_total?>" readonly></td>



              <td><input type="number" id="pur_item_gst<?= $cou ?>" name="pur_item_gst[]" class="calcuclass" data-count="<?= $cou ?>" style="width:100%" value="<?= $kry->m_purchase_gst?>" readonly>
              <input type="hidden" id="pur_item_gstamt<?= $cou ?>" name="pur_item_gstamt[]" class="prodgst" data-count="<?= $cou ?>" style="width:100%" value="<?= $kry->m_purchase_gstamt?>"></td>
              <td><input type="text" id="pur_item_disc<?= $cou ?>" name="pur_item_disc[]" class="calcuclass" data-count="<?= $cou ?>" style="width:100%" value="<?= $kry->m_purchase_dis?>" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)">
              <input type="hidden" id="pur_item_discamt<?= $cou ?>" name="pur_item_discamt[]" class="proddisc" data-count="<?= $cou ?>" style="width:100%" value="<?= $kry->m_purchase_disamt?>"></td>
              <td><input type="number" id="pur_item_nettotal<?= $cou ?>" name="pur_item_nettotal[]" class="pnettotal" data-count="<?= $cou ?>" style="width:100%" value="<?= $kry->m_purchase_netamt?>" readonly></td>
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
        <div class="col-md-6">
            <label for="Name">Terms & Conditions</label>
            <textarea class="form-control" name="m_purchase_terms" id="m_purchase_terms" rows="3" placeholder="1. Goods once sold will not be taken back or exchanged 	2. All disputes are subject to [ENTER_YOUR_CITY_NAME] jurisdiction only"><?= $puterms?></textarea>

            <label for="Name">Notes</label>
            <textarea class="form-control" name="m_purchase_note" id="m_purchase_note" rows="4"><?= $punote?></textarea>

        </div>
        <div class="col-md-6 mb-5">

            <div class="row g-2">
                <div class="col-md-6">
                    Sub Total
                </div>
                <div class="col-md-6">
                    <input type="number" name="m_purchase_subtotal" id="m_purchase_subtotal" class="form-control" placeholder="Sub Total" readonly>
                </div>
                <div class="col-md-6">
                    GST Tax
                </div>

                <div class="col-md-6">
                    <input type="number" name="m_purchase_totalcgst" id="m_purchase_totalcgst" class="form-control" placeholder="Total GST" readonly>

                </div>
                <div class="col-md-6 ">
                    Discount
                </div>
                <div class="col-md-6">
                    <input type="number" name="m_purchase_disc" id="m_purchase_disc" class="form-control" placeholder="Discount" readonly>
                </div>
                <div class="col-md-6">
                    Shipping
                </div>
                <div class="col-md-6">
                    <input type="number" name="m_purchase_shipping" id="m_purchase_other_charges" class="form-control grandtotalclass" placeholder="other charges" value="<?= $pushipping?>">
                </div>
                <div class="col-md-6">
                    Grand Total
                </div>
                <div class="col-md-6">
                    <input type="number" name="m_purchase_grandt" id="m_purchase_grandt" class="form-control" placeholder="Grand Total"  readonly>
                </div>

                        <button type="submit" id="btn-add-purchase" class="btn btn-primary"><i class="fa-regular fa-pen-to-square"></i> Save</button>
                 
            </div>
        </div>
    </form>

    <!-- edit Modal -->
    <!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    </div> -->

    <!-- ========== Page Content ========== -->
    <?php include("footer.php"); ?>
    <?php $this->view('js/main_js');  ?>

    <script>
        $(document).ready(function(e) {
            total_sum_cal();
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
                total_sum_cal();
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



              <td><input type="number" id="pur_item_gst` + x + `" name="pur_item_gst[]" class="calcuclass" data-count="` + x + `" style="width:100%" value="0" readonly>
              <input type="hidden" id="pur_item_gstamt` + x + `" name="pur_item_gstamt[]" class="prodgst" data-count="` + x + `" style="width:100%" value=""></td>
              <td><input type="text" id="pur_item_disc` + x + `" name="pur_item_disc[]" class="calcuclass" data-count="` + x + `" style="width:100%" value="0" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)">
              <input type="hidden" id="pur_item_discamt` + x + `" name="pur_item_discamt[]" class="proddisc" data-count="` + x + `" style="width:100%" value=""></td>
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
            var disamount = amount * disc / 100;
            var gstamount = ((amount - disamount) * gst / 100);
            var netamount = (amount + gstamount - disamount);

            $('#pur_item_total' + count).val(amount.toFixed(2));
            $('#pur_item_nettotal' + count).val(netamount.toFixed(2));
            $('#pur_item_gstamt' + count).val(gstamount.toFixed(2));
            $('#pur_item_discamt' + count).val(disamount.toFixed(2));
            total_sum_cal();
        }

        function selectRefresh() {
            // location.reload();
        }

        function total_sum_cal() {
            var shipping = parseFloat($('#m_purchase_other_charges').val());
            var subTotal = 0;
            $('.prodtotal').each(function(index) {
                subTotal += parseFloat($(this).val());

            });

            var Tamount = 0;
            $('.pnettotal').each(function(index) {
                Tamount += parseFloat($(this).val());

            });

            var Tgst = 0;
            $('.prodgst').each(function(index) {
                Tgst += parseFloat($(this).val());

            });

            var Tdisc = 0;
            $('.proddisc').each(function(index) {
                Tdisc += parseFloat($(this).val());

            });

            var grand_totl = (subTotal + Tgst + shipping - Tdisc);

            $('#m_purchase_subtotal').val(subTotal.toFixed(2));
            $('#m_purchase_totalcgst').val(Tgst.toFixed(2));
            $('#m_purchase_disc').val(Tdisc.toFixed(2));

            $('#m_purchase_grandt').val(grand_totl.toFixed(2));

        }
    </script>