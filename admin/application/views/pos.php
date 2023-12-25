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
        padding-left: 40px;
    }

    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        appearance: none;
        margin: 0;
    }

    input[type="number"] {
        -moz-appearance: textfield;
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
    .para p{
        font-size: 14px;
    }
</style>

<!-- ========== Page Content ========== -->
<section class="py-1" style="background: #797979;">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-xl-11 col-lg-10">
                <p class="m-0 text-white small fw-light">
                    <a href="<?php echo base_url('Dashboard'); ?>" class="text-white text-decoration-none ">Dashboard</a> >> <a href="<?php echo base_url('Main/pos'); ?>" class="text-decoration-none fw-bold"><span class="text-warning"> POS</span></a>
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

<section class="bg-light">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5 mt-3">
                <div class="row g-3">
                    <div class="col-md-12">
                        <div class="card pcard p-3">
                            <div class="row g-2">
                                <div class="col-11">
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Select Customer</option>
                                        <?php
                                        if (!empty($customer)) {
                                            foreach ($customer as $value) {
                                        ?>
                                                <option value="<?php echo $value->m_user_id; ?>"><?php echo $value->m_user_name; ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-1">
                                    <button type="button" class="btn btn-light" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop"><i class="fa-solid fa-plus"></i></button>
                                    <!-- <img src="<?php echo base_url(); ?>assets/imgs/plus.png" alt="add more" class="w-100" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop"> -->

                                    <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop" aria-labelledby="staticBackdropLabel">
                                        <div class="offcanvas-header">
                                            <h5 class="offcanvas-title m-0" id="staticBackdropLabel">Add New Customer</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                        </div>
                                        <hr>
                                        <div class="offcanvas-body">
                                            <form class="row g-3" method="POST" id="form-newcustomer-add">

                                                <div class="col-md-6">
                                                    <label for="Name">Name<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="cust_name" required placeholder="Please Enter Name">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="Name">Phone Number<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="cust_mobile" id="cust_mobile" maxlength="10" minlength="10" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" placeholder="Please Enter Number" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="Name">Email</label>
                                                    <input type="hidden" name="m_user_type" id="user_type" value="3">
                                                    <input type="email" class="form-control" name="cust_email" placeholder="Please Enter Email">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="order">Status </label>
                                                    <select class="form-control" name="cust_status">
                                                        <option value="1" selected>Active</option>
                                                        <option value="2">In-Active</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="Name">Password</label>
                                                    <input type="text" class="form-control" name="cust_pass" placeholder="Please Enter Password">
                                                </div>
                                                <div class="col-md-6 ">
                                                    <label for="image">Profile Image</label>
                                                    <input type="file" class="form-control-file" name="cust_image">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="Name">Tax Number</label>
                                                    <input type="text" class="form-control" name="cust_text_num" placeholder="Please Enter Tax Number" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" value="0">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="Name">Opening Balance</label>
                                                    <input type="text" class="form-control" name="cust_open_balance" placeholder="Please Enter Tax Number" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" value="0">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="Name">Credit Period</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="cust_credit_period" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" aria-label="Dollar amount (with dot and two decimal places)" value="0">
                                                        <span class="input-group-text">Day(s)</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="Name">Credit Limit</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">₹</span>
                                                        <input type="text" class="form-control" name="credit_limit" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" aria-label="Dollar amount (with dot and two decimal places)" value="0">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="Name">Billing Address</label>
                                                    <textarea class="form-control" name="Billing_address" rows="2"></textarea>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="Name">Shipping Address</label>
                                                    <textarea class="form-control" name="shipping_address" rows="2"></textarea>
                                                </div>
                                                <div class="canvas-footer justify-content-end d-flex">
                                                    <button type="submit" id="btn-newcustomer-add" class="btn btn-primary me-2"><i class="fa-regular fa-pen-to-square"></i> Create</button>
                                                    <button type="button" class="btn btn-secondary" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                                <form method="get" action="<?php echo base_url('Main/pos'); ?>">
                                    <div class="col-auto w-100">
                                        <label class="sr-only" for="inlineFormInputGroup">Username</label>
                                        <div class="input-group mb-2">

                                            <input type="text" class="form-control me-2" name="search" id="search_itemin" placeholder="Search Product name/Item code/Scan bar code" value="<?php echo $search; ?>">
                                            <!-- <div class="input-group-prepend">
                                                <button class="input-group-text me-1"><i class="fa-solid fa-magnifying-glass"></i></button>
                                            </div> -->
                                            <div class="input-group-prepend">
                                                <a href="<?php echo base_url('Main/pos');  ?>" class="input-group-text me-1"><i class="fa-solid fa-rotate"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card pcard1 p-3">
                            <table>
                                <thead>
                                    <tr class="bg-light">
                                        <th class="p-2">#</th>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>SubTotal</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Cotton kurti</td>
                                        <td><span class="input-wrapper">
                                                <button id="decrement">-</button>
                                                <input type="number" value="1" id="quantity" />
                                                <button id="increment">+</button>
                                            </span></td>
                                        <td>₹500</td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-pen-to-square"></i></button>
                                            <button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-trash"></i></button>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td colspan="5">
                                            <img src="<?php echo base_url(); ?>assets/imgs/no-data.png" alt="add more" class="w-25 m-auto d-block">
                                            <h6 class="m-0">No Data</h6>
                                        </td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card pcard p-3">
                            <div class="row g-3">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="order">Order Tax</label>
                                        <select class="form-control">
                                            <option>Default select</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="order">Discount</label>
                                        <input type="number" class="form-control" id="discount" placeholder="In %">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="order">Shipping</label>
                                        <input type="number" class="form-control" id="discount" placeholder="In ₹">
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="card p-2" style="background-color: #ced4da;">
                                        <h5>Grand Total : ₹0.00</h5>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <p style="font-size: 12px;" class="mt-2">Tax : ₹0.00|Discount</p>
                                </div>
                                <div class="col-4">
                                    <div class="row g-1">
                                        <div class="col-7">
                                            <button type="button" class="btn btn-success w-100" style="font-size: 14px;">Pay Now</button>
                                        </div>
                                        <div class="col-5">
                                            <button type="button" class="btn btn-danger w-100" style="font-size: 14px;">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
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
                                $cat_img = base_url('assets/imgs/user.png');
                            } ?>
                            <div class="card pcard2 catclick" data-cat_id="<?= $value->m_category_id ?>" id="catdiv<?= $value->m_category_id ?>">
                                <!-- <a href="<?php echo base_url('Main/pos/' . $value->m_category_slug); ?>" class="text-decoration-none"> -->
                                <img src="<?php echo $cat_img; ?>" alt="kurtis" class="w-100 ar">
                                <p class="text-center m-0 small"><?php echo $value->m_category_name ?></p>
                                <!-- </a> -->
                            </div>
                    <?php }
                    } ?>

                </div>
                <div class="col-md-12 mt-3 over" style="height: 400px;">
                    <div class="row g-3" id="product_div">
                        <!-- dynamically fatch from pos_js.php get_cate_items() -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

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
                    <input type="number" class="form-control" aria-label="Dollar amount (with dot and two decimal places)">
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


<!-- products list modal -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="productModalLabel">Cotton Kurti</h1>
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

<?php $this->view('js/main_js');
$this->view('js/pos_js'); ?>
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