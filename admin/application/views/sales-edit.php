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
                    <a href="<?php echo base_url('Dashboard');?>" class="text-white text-decoration-none ">Dashboard</a> >> Sales >> Sales >> <a href="#" class="text-decoration-none fw-bold"><span class="text-warning"><?php if(!empty($id)){ echo 'Edit';}else{echo 'Add';} ?></span></a>
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

<div class="container-fluid bg-light" id="main-body" style="min-height:75vh">
    <form class="row pt-3" method="post" <?php if(!empty($id)){ ?>id="form-edit-sale"<?php  }else{?>id="form-add-sale"<?php } ?> >

       <?php 
             $res = $this->db->select('m_sale_invoiceno')->order_by('m_sale_id', 'desc')->get('master_sales_tbl')->row();

                if (!empty($res)) {
                    // Extract the numerical part from the existing invoice number
                    $part = intval(substr($res->m_sale_invoiceno, 2));
                    $newInvoiceNumber = 'UT' . sprintf('%04d', ($part + 1));
                } else {
                    $newInvoiceNumber = 'UT0001';
                }

                // echo $newInvoiceNumber;



       if (!empty($edit_value)) {
                $spo = $edit_value->m_sale_spo;
                $pdate = $edit_value->m_sale_date;
                $invoiceno = $edit_value->m_sale_invoiceno;
                $customer = $edit_value->m_sale_customer;
                // $purtype = $edit_value->m_purchase_type;
                // $subtotal = $edit_value->m_purchase_subtotal;
                // $totalcgst = $edit_value->m_purchase_totalcgst;
                // $totaldiscount = $edit_value->m_purchase_totaldiscount;
                // $grandt = $edit_value->m_purchase_grandt;
                // $transportation_charges = $edit_value->m_purchase_transportation_charges;
                // $other_charges = $edit_value->m_purchase_other_charges;
                // $session = $edit_value->m_purchase_session;
            } else {
                $spo = '';
                $pdate = date('Y-m-d');
                $customer = '';
                $invoiceno = $newInvoiceNumber;
                // $subtotal = '';
                // $totalcgst = '';
                // $totaldiscount = '';
                // $grandt = '';
                // $transportation_charges = 0;
                // $other_charges = 0;
                // $session = '';
            } ?>



       <?php $nettotal =0;
                    $subtotal =0;
                    $tgst=0;
                    $tdiscout=0;?>



         <div class="col-md-4">
            <label for="Name">Purchase Date</label>
            <input type="date" class="form-control" id="date" name="m_sale_date" value="<?= $pdate?>">
        </div>
        <div class="col-md-4">
            <label for="Name">Invoice Number</label>
            <input type="text" class="form-control" id="name"  name="m_sale_invoice" placeholder="Enter Invoice Number" value="<?= $invoiceno ?>" readonly required>
            <input type="hidden" name="m_sop_id" value="<?= $spo; ?>">
        </div>
        <div class="col-md-4">
            <label for="Name">Customer</label>
            <!-- <input type="text" class="form-control" id="name" placeholder="Customer Name"> -->
            <select class="form-select" name="m_sale_customer"  required >
                    <option selected >Select Customer</option>
                    <?php foreach($all_user as $value){ ?>
                    <option value="<?php echo $value->m_acc_id; ?>" <?php if($customer == $value->m_acc_id)echo 'selected'; ?> ><?php echo $value->m_acc_name; ?></option>
                   <?php } ?>
                   
                </select>
        </div>
       
        <div class="col-md-6">
            <label for="Name">Product</label>
            <input type="text" class="form-control" list="items_datalist" id="item_serch_inp"  placeholder="Product Name" >

            <datalist id="items_datalist">
            <?php
            if (!empty($product_list)) {
                foreach ($product_list as $pvalue) {
                    // if ($kry->m_product_id == $pvalue->m_product_id) {
                    //     $op = 'selected';
                    // } else {
                    //     $op = '';
                    // }
            ?>  
                    <option value="<?php echo $pvalue->m_product_name; ?>" data-name="<?= $pvalue->m_product_name; ?>" data-itemid="<?= $pvalue->m_product_id ?>" data-rate="<?= $pvalue->m_product_mrp ?>" data-gst="<?= $pvalue->m_tax_value ?>"><?php echo $pvalue->m_product_name; ?></option>
                   
            <?php
                }
            }
            ?>
        </datalist>
        </div>
        <div class="col-md-12">
            <table class="table table-bordered mt-4"  id="sales_tbl">
                <thead>
                <th width="1%">Sn</th>
                <th>Description of Goods</th>
                <th>Rate</th>
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
                    $nettotal =0;
                    $subtotal =0;
                    $tgst=0;
                    $tdiscout=0;
                    foreach ($product_list1 as $kry) {

                     

                        $nettotal = $kry->m_sale_total + $kry->m_sale_gst - $kry->m_sale_discount;
                        $subtotal+= $subtotal+$kry->m_sale_total;
                        $tgst+= $tgst+$kry->m_sale_gst;
                        $tdiscout+= $tdiscout+$kry->m_sale_discount;
                        $cou++;
                ?>      

                        <tr>
                            <td id="rowcount<?= $cou ?>"><?= $cou ?></td>
                            <td> <input type="hidden" name="pur_item_id[]" value="<?php echo $kry->m_sale_id; ?>">
                               
                                 <input type="hidden" id="pur_item_itemid<?= $cou ?>" name="pur_item_itemid[]" class="form-control Itemna" data-count="<?= $cou ?>" style="width:100%" value="<?php echo $kry->m_sale_product; ?>">

                                  <input type="text" id="pur_item_name"  class="form-control Itemna" data-count="" style="width:100%" value="<?php echo $kry->m_product_name; ?>">
                            </td>
                            <td><input type="number" id="pur_item_rate<?= $cou ?>" name="pur_item_rate[]" class="calcuclass" data-count="<?= $cou ?>" style="width:100%" value="<?php echo $kry->m_sale_price; ?>"></td>
                            <td><input type="text" id="pur_item_qty<?= $cou ?>"   onkeypress="return (event.charCode >= 48 && event.charCode <= 57)"  name="pur_item_qty[]" class="calcuclass" data-count="<?= $cou ?>" style="width:100%" value="<?php echo $kry->m_sale_qty; ?>">
                                <input type="hidden" name="pre_item_qty[]" value="<?php echo $kry->m_sale_qty; ?>">
                            </td>
                            <td><input type="number" id="pur_item_total<?= $cou ?>" name="pur_item_total[]" class="prodtotal" data-count="<?= $cou ?>" style="width:100%" value="<?php echo $kry->m_sale_total; ?>" readonly></td>
                            <td><input type="number" id="pur_item_gst<?= $cou ?>" name="pur_item_gst[]" class="prodgst calcuclass" data-count="<?= $cou ?>" style="width:100%" value="<?php echo $kry->m_sale_gst; ?>" readonly></td>
                            <td><input type="text" id="pur_item_disc<?= $cou ?>" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" name="pur_item_disc[]" class="proddisc calcuclass" data-count="<?= $cou ?>" style="width:100%" value="<?php echo $kry->m_sale_discount; ?>"></td>
                            <td><input type="number" id="pur_item_nettotal<?= $cou ?>" name="pur_item_nettotal[]" class="pnettotal" data-count="<?= $cou ?>" style="width:100%" value="<?php echo $nettotal; ?>" readonly></td>
                            <td> <button type="button" class="btn btn-danger p-1 del-sale-product" data-value="<?php echo $kry->m_sale_id; ?>" title="Delete"><i class="fa-solid fa-trash"></i></button></td>
                        </tr>
                    <?php }
                    echo '<input type="hidden" id="rowunt" value="' . $cou . '">';
                } else { ?>
                       
                    <!-- <tr>
                        <td id="rowcount1">1</td>
                        <td> <input type="hidden" name="pur_item_id[]">
                            <select name="pur_item_itemid[]" id="pur_item_itemid1" class="form-control select2 Itemna" title="Select Item" required data-count="1">
                                <option value="">Select Item</option>
                                <?php
                                if (!empty($item_list)) {
                                    foreach ($item_list as $Vitem) {
                                ?>
                                        <option value="<?php echo $Vitem->m_item_id; ?>"><?php echo $Vitem->m_item_title; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </td>
                        <td><input type="number" id="pur_item_rate1" name="pur_item_rate[]" class="calcuclass" data-count="1" style="width:100%" value=""></td>
                        <td><input type="number" id="pur_item_qty1" name="pur_item_qty[]" class="calcuclass" data-count="1" style="width:100%" value=""></td>
                        <td><input type="number" id="pur_item_total1" name="pur_item_total[]" class="prodtotal" data-count="1" style="width:100%" value="" readonly></td>
                        <td><input type="number" id="pur_item_gst1" name="pur_item_gst[]" class="calcuclass" data-count="1" style="width:100%" value=""><input type="hidden" id="pur_item_gstamt1" name="pur_item_gstamt[]" class="prodgst" data-count="1" style="width:100%" value=""></td>
                        <td><input type="number" id="pur_item_disc1" name="pur_item_disc[]" class="proddisc calcuclass" data-count="1" style="width:100%" value=""></td>
                        <td><input type="number" id="pur_item_nettotal1" name="pur_item_nettotal[]" class="pnettotal" data-count="1" style="width:100%" value="" readonly></td>
                        <td></td>

                    </tr> -->
                <?php } ?>
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
            <input type="number" name="m_purchase_totalcgst" id="m_purchase_totalcgst" class="form-control" placeholder="Total GST" value="<?=$tgst?>" readonly>
            <!-- <select class="form-control mb-3" id="exampleFormControlSelect1">
                <option>GST (30%)</option>
                <option>GST (10%)</option>
            </select>
 -->
            <label for="order">Discount</label>
            <div class="input-group mb-3">
                <span class="input-group-text">₹</span>
                <input type="number" name="m_purchase_totaldiscount" id="m_purchase_totaldiscount" class="form-control" placeholder="Total Discount" value="<?=$tdiscout?>"  readonly>
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
                    Order Tax
                </div>
                <div class="col-md-6">
                    <input type="number" name="m_purchase_subtotal" id="m_purchase_subtotal" class="form-control" placeholder="Sub Total" value="<?=$subtotal?>" readonly>
                </div>
                <div class="col-md-6 ">
                    Discount
                </div>
                <div class="col-md-6">
                    <input type="number" name="m_purchase_" id="m_purchase_subtotal" class="form-control" placeholder="Discount" value="<?=$tdiscout?>" readonly>
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
                     <input type="number" name="m_purchase_grandt" id="m_purchase_grandt" class="form-control" placeholder="Grand Total" value="<?=$subtotal+$tgst?>"readonly>
            </div>
            <?php if(!empty($id)){?>
                <button type="submit" id="btn-edit-sale" class="btn btn-primary"><i class="fa-regular fa-pen-to-square"></i> Save</button>

           <?php  }else{ ?>
            <button type="submit" id="btn-add-sale" class="btn btn-primary"><i class="fa-regular fa-pen-to-square"></i> Save</button>
        <?php } ?>
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
            var name = $("#items_datalist option[value='" + $(this).val() + "']").attr('data-name')
            var rate = $("#items_datalist option[value='" + $(this).val() + "']").attr('data-rate')
            var gst = $("#items_datalist option[value='" + $(this).val() + "']").attr('data-gst')
            var itemid = $("#items_datalist option[value='" + $(this).val() + "']").attr('data-itemid')
            incount++

            addrow(incount)
            $('#pur_item_name' + incount).val(name);
            $('#pur_item_itemid' + incount).val(itemid);
            // $('#pur_item_id' + incount).val(itemid);
            $('#pur_item_gst' + incount).val(gst);
            $('#pur_item_rate' + incount).val(rate);
            calculate_function(incount)
            $(this).val('');
        });

        $(document).on("keyup", '.calcuclass', function() {
            // alert('hello');
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


    });

    function addrow(x) {
        // x++;
        $('#tableblock').append(` <tr id="rowcot` + x + `">
        <td id="rowcount` + x + `">` + x + `</td>
        <td> <input type="hidden" name="pur_item_id[]">
             <input type="text" id="pur_item_name` + x +`" name="pur_item_name[]" class="form-control Itemna" data-count="` + x + `" style="width:100%" value="">
        </td>
        <td>
        <input type="hidden" id="pur_item_itemid` + x +`" name="pur_item_itemid[]" class="form-control Itemna" data-count="` + x + `" style="width:100%" value="">
        <input type="number" id="pur_item_rate` + x + `" name="pur_item_rate[]" class="calcuclass" data-count="` + x + `" style="width:100%" value=""></td>
        <td><input type="text" id="pur_item_qty` + x + `" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" name="pur_item_qty[]" class="calcuclass" data-count="` + x + `" style="width:100%" value="1"></td>
        <td><input type="number" id="pur_item_total` + x + `" name="pur_item_total[]" class="prodrate prodtotal" data-count="` + x + `" style="width:100%" value="" readonly></td>



        <td><input type="number" id="pur_item_gst` + x + `" name="pur_item_gst[]" class="calcuclass" data-count="` + x + `" style="width:100%" value="0" readonly><input type="hidden" id="pur_item_gstamt` + x + `" name="pur_item_gstamt[]" class="prodgst" data-count="` + x + `" style="width:100%" value=""></td>
        <td><input type="text" id="pur_item_disc` + x + `" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" name="pur_item_disc[]" class="proddisc calcuclass" data-count="` + x + `" style="width:100%" value="0"></td>
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