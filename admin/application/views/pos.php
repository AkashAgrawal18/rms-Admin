<?php include("head.php"); ?>
<?php include("header.php"); ?>

<style>
    .input-box {
        position: relative;
    }

    .input-box i {
        position: absolute;
        right: 13px;
        top: 10px;
        color: #ced4da;

    }

    th,
    td {
        text-align: center;
    }

    .input-wrapper {
        width: 100px;
        height: 30px;
        display: flex;
        border-radius: 50%;
    }

    .input-wrapper input {
        text-align: center;
    }

    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        appearance: none;
        margin: 0;
    }

    input[type="number"] {
        /* -moz-appearance: textfield; */
        padding: 10px;
        text-align: center;
    }

    .input-wrapper * {
        border: none;
        width: 50px;
        flex: 1;
    }

    .input-wrapper button {
        cursor: pointer;
    }

    .input-wrapper button:first-child {
        border-radius: 50% 0 0 50%;
        color: red;
        font-size: 23px;
    }

    .input-wrapper button:last-child {
        border-radius: 0 50% 50% 0;
        color: green;
    }

    .offcanvas.offcanvas-end {
        width: 580px !important;
    }

    label {
        margin-bottom: 8px;
    }

    .ware {
        margin-bottom: 2px !important;
    }

    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

    #category_div .pcard2.active {
        border: 2px solid #8a00a3;
    }

    .pcard2 {
        aspect-ratio: 1/1;
        width: 75px !important;
        margin-right: 5px !important;
        background: white;
        display: inline-block;
        border: none;
        box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
        border-radius: 2px;
    }

    .para p {
        font-size: 14px;
    }

    .pos-s {
        font-size: 12px;
        font-weight: 900;
    }

    .pos-clr {
        width: 15px;
        height: 15px;
        border: 2px solid #000;

    }

    .left {
        text-align: left;
        font-size: 13px;
    }

    .fn {
        font-size: 13px;
    }

    .pcard1 {
        border: none;
        box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
        border-radius: 2px;
        height: 320px !important;
        overflow-y: scroll;
    }

    td {
        border-bottom: 1px dashed #88888880;
    }

    .wraptext {
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }
</style>

<!-- ========== Page Content ========== -->
<section class="py-1" style="background: #797979;">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-xl-11 col-lg-10">
                <p class="m-0 text-white small fw-light">
                    <a href="<?php echo base_url('Dashboard'); ?>" class="text-white text-decoration-none ">Dashboard</a> >> <a href="<?php echo base_url('Master/pos'); ?>" class="text-decoration-none fw-bold"><span class="text-warning"> POS</span></a>
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

<section class="bg-light pb-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5 mt-3">
                <form method="post" id="frm_add_sale">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <div class="card pcard p-2">
                                <div class="row g-2">
                                    <div class="col-5">
                                        <select class="form-select" id="m_customer" name="m_sale_customer" aria-label="Default select example" required>
                                            <option value="" selected>Select Customer</option>
                                            <?php
                                            if (!empty($customer)) {
                                                foreach ($customer as $value) {
                                            ?>
                                                    <option value="<?php echo $value->m_acc_id; ?>" data-custname="<?php echo $value->m_acc_name; ?>"><?php echo $value->m_acc_name; ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-1">
                                        <button type="button" class="btn btn-light" onclick="openmodalfun('#addcustomermodal','Add Customer','1','1')" aria-controls="staticBackdrop"><i class="fa-solid fa-plus"></i></button>

                                    </div>
                                    <div class="col-5">
                                        <input type="text" class="form-control" name="search" id="search_itemin" placeholder="Search Product name/Item code/Scan bar code" value="<?php echo $search; ?>">

                                    </div>
                                    <div class="col-1">
                                        <a href="<?php echo base_url('Master/pos');  ?>" class="input-group-text "><i class="fa-solid fa-rotate p-1"></i></a>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card pcard1 p-2">
                                <table>
                                    <thead>
                                        <tr class="bg-light">
                                            <th>Name</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id='ordered_itemlist'>
                                        <!-- dynamically fatch from pos_js onclick  -->
                                        <tr id='trnodata'>
                                            <td colspan="5">
                                                <img src="<?php echo base_url('assets/imgs/no-data.png'); ?>" alt="add more" class="w-25 m-auto d-block">
                                                <h6 class="m-0">No Data</h6>
                                            </td>
                                        </tr>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card pcard p-2">
                                <div class="row g-3">
                                    <div class="col-xl-3 col-lg-6">
                                        <label class="mb-1 small" for="sub">Sub Total</label>
                                        <input type="number" class="form-control" id="m_subtotal" placeholder="Sub Total" readonly>
                                    </div>
                                    <div class="col-xl-3 col-lg-6">
                                        <label class="mb-1 small" for="order">Order Tax</label>
                                        <input type="number" class="form-control" id="m_total_tax" placeholder="Total Tax" readonly>
                                    </div>
                                    <div class="col-xl-3 col-lg-6">
                                        <label class="mb-1 small" for="order">Discount</label>
                                        <input type="number" class="form-control amtcal" onClick="this.select();" name="m_sale_discount" id="m_sale_discount" placeholder="Discount Amount" value="0">
                                    </div>
                                    <div class="col-xl-3 col-lg-6">
                                        <label class="mb-1 small" for="order">Shipping</label>
                                        <input type="number" class="form-control amtcal" onClick="this.select();" name="m_sale_shipping" id="m_sale_shipping" placeholder="In ₹" value="0">
                                        <input type="hidden" name="m_sale_nettotal" id="m_sale_nettotal">
                                    </div>
                                    <div class="col-xl-6 col-6">
                                        <div class="card p-2" style="background-color: #ced4da;border:none">
                                            <h5 class="m-0">Grand Total : <span class="grandtotal">₹0.00</span></h5>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-3">
                                        <button type="button" id="paymodeModalbtn" class="btn btn-success w-100" style="font-size: 15px;">Pay Now</button>
                                        <!-- payment method Modal -->
                                        <div class="modal fade" id="paymodeModal" tabindex="-1" aria-labelledby="paymodeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="paymodeModalLabel"></h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row g-3">
                                                            <div class="col-5">
                                                                <div class="row">
                                                                    <div class="col-7">
                                                                        <h6 class="mb-2">Sub Total : </h6>
                                                                    </div>
                                                                    <div class="col-5">
                                                                        <h6> <span id="subtotal">: ₹0.00</span></h6>
                                                                    </div>
                                                                    <div class="col-7">
                                                                        <h6 class="mb-2">Total Tax : </h6>
                                                                    </div>
                                                                    <div class="col-5">
                                                                        <h6> <span id="taxtotal">₹0.00</span></h6>
                                                                    </div>
                                                                </div>
                                                                <!-- <h6 class="mb-2">Sub Total : <span id="subtotal">₹0.00</span></h6> -->
                                                                <!-- <h6 class="mb-2">Total Tax: <span id="taxtotal">₹0.00</span></h6> -->
                                                            </div>
                                                            <div class="col-7 text-end">
                                                                <div class="row">
                                                                    <div class="col-7">
                                                                        <h6 class="mb-2">Total Discount : </h6>
                                                                    </div>
                                                                    <div class="col-5">
                                                                        <h6> <span id="distotal">₹0.00</span></h6>
                                                                    </div>
                                                                    <div class="col-7">
                                                                        <h6 class="mb-2">Shipping Charge : </h6>
                                                                    </div>
                                                                    <div class="col-5">
                                                                        <h6> <span id="shipptotal">₹0.00</span></h6>
                                                                    </div>
                                                                    <!-- <h6 class="mb-2">Total Discount: <span id="distotal">₹0.00</span></h6>
                                                                        <h6 class="mb-2">Shipping Charge : <span id="shipptotal">₹0.00</span></h6> -->
                                                                </div>
                                                            </div>
                                                            <div class="col-12" style="border: 1px dashed #88888880;">
                                                                <h5 class="m-0">Grand Total : <span class="grandtotal">₹0.00</span></h5>
                                                            </div>

                                                            <div class="col-md-12 cashdiv paypartial" style="display: none; margin-top:30px">
                                                                <div class="form-check">
                                                                    <input type="checkbox" class="form-check-input" id="m_sales_ispartial" name="m_sale_ispartial" value="1">
                                                                    <label class="form-check-label" for="m_sales_ispartial"> Partial Payment</label>
                                                                </div>
                                                            </div>


                                                            <div class="col-6 cashdiv" style="display: block;" id="Ampayty_in">
                                                                <div class="form-group">
                                                                    <label>Payment Mode</label>
                                                                    <select name="m_sale_pmode" id="m_sales_paytype" class="form-control select2">
                                                                        <?php if (!empty($paymode_list)) {
                                                                            foreach ($paymode_list as $pkey) {
                                                                                echo '<option value="' . $pkey->m_group_id . '">' . $pkey->m_group_name . '</option>';
                                                                            }
                                                                        }
                                                                        ?>
                                                                        <option value="partial" id="partial_op">Partial Payment</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label>Amount Paid</label>
                                                                    <input type="text" onkeypress="return (event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46)" name="m_sale_payamt" id="m_sales_paidAmt" class="form-control" required value="0">
                                                                </div>
                                                            </div>
                                                            <div class="col-6 cashdiv paypartial" style="display: none;">
                                                                <div class="form-group">
                                                                    <label>Payment Mode2</label>
                                                                    <select name="m_sale_pmode2" id="m_sales_paytype2" class="form-control select2" style="width:100%">
                                                                        <?php if (!empty($paymode_list)) {
                                                                            foreach ($paymode_list as $pkey) {
                                                                                echo '<option value="' . $pkey->m_group_id . '">' . $pkey->m_group_name . '</option>';
                                                                            }
                                                                        }
                                                                        ?>

                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-6 cashdiv paypartial" style="display: none;">
                                                                <div class="form-group">
                                                                    <label>Amount Paid2</label>
                                                                    <input type="text" onkeypress="return (event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46)" name="m_sale_payamt2" id="m_sales_paidAmt2" class="form-control" value="0">
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" id="btn_add_sale" class="btn btn-success w-100" style="font-size: 15px;">Add Order</button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- payment method Modal -->
                                    </div>
                                    <div class="col-xl-3 col-3">
                                        <a href="<?= base_url('Master/pos') ?>" class="btn btn-danger w-100" style="font-size: 15px;">Reset</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-7 mt-3">
                <div id="category_div" class="main-div">

                    <div class="card pcard2 catclick active" data-cat_id="" id="catdiv">
                        <a class="text-decoration-none"><img src="<?php echo base_url('assets/imgs/all.jpg'); ?>" alt="kurtis" class="w-100 ar">
                            <p class="text-center m-0 small">All</p>
                        </a>
                    </div>
                    <?php if (!empty($category)) {
                        foreach ($category as $value) {

                            if (!empty($value->m_category_image) && file_exists('uploads/categories/' . $value->m_category_image)) {
                                $cat_img = base_url('uploads/categories/' . $value->m_category_image);
                            } else {
                                $cat_img = base_url('assets/imgs/no-data.png');
                            } ?>
                            <div class="card pcard2 catclick" data-cat_id="<?= $value->m_category_id ?>" id="catdiv<?= $value->m_category_id ?>">
                                <!-- <a href="<?php echo base_url('Master/pos/' . $value->m_category_slug); ?>" class="text-decoration-none"> -->
                                <img src="<?php echo $cat_img; ?>" alt="kurtis" class="w-100 ar">
                                <p class="text-center m-0 small"><?php echo $value->m_category_name ?></p>
                                <!-- </a> -->
                            </div>
                    <?php }
                    } ?>

                </div>
                <div class="row g-3 justify-content-stretch d-flex mt-2" id="product_div" style="height: 55vh;overflow-y:auto;">
                    <!-- dynamically fatch from pos_js.php get_cate_items() -->

                </div>
            </div>
        </div>
    </div>
</section>



<!-- products list modal -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="productModalLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3" id="modalproduct_div">
                    <!-- dynamically fatch from pos_js.php get_cate_items() -->

                </div>
            </div>

        </div>
    </div>
</div>

<!-- ========== Page Content ========== -->
<?php include("footer.php"); ?>
<?php $this->view('custom_page'); ?>
<?php $this->view('js/main_js');
$this->view('js/pos_js'); 
$this->view('js/account_js'); ?>
<script>
    const incrementButton = document.querySelector("#increment");
    const decrementButton = document.querySelector("#decrement");
    const quantityInput = document.querySelector("#quantity");

    incrementButton.addEventListener("click", () => {
        quantityInput.value = parseInt(quantityInput.value) + 1;
    });
    decrementButton.addEventListener("click", () => {
        quantityInput.value = parseInt(quantityInput.value) - 1;
    });
</script>