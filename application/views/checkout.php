<?php include("head.php"); ?>
<?php include("header.php"); ?>
<style>
    .sm {
        font-size: 14px !important;
        font-weight: bold;
    }

    .color {
        height: 20px;
        width: 40px;
        background-color: red;
    }
</style>
<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="#">Home</a>
                <a class="breadcrumb-item text-dark" href="#">Shop</a>
                <span class="breadcrumb-item active">Checkout</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->


<!-- Checkout Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-7">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Contact Details</span></h5>
            <div class="bg-light p-30 mb-3">
                <div class="row d-flex justify-content-end">
                    <div class="col-md-3 ">
                        <button class="btn btn-block btn-primary font-weight-bold">Edit</button>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-6 form-group">
                        <label>First Name</label>
                        <input class="form-control" type="text" placeholder="John">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Last Name</label>
                        <input class="form-control" type="text" placeholder="Doe">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>E-mail</label>
                        <input class="form-control" type="text" placeholder="example@email.com">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Mobile No</label>
                        <input class="form-control" type="text" placeholder="+123 456 789">
                    </div>
                </div>
            </div>
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Billing Address</span></h5>
            <div class="bg-light p-30 mb-3">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Address Line 1</label>
                        <input class="form-control" type="text" placeholder="123 Street">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Address Line 2</label>
                        <input class="form-control" type="text" placeholder="123 Street">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Country</label>
                        <select class="custom-select">
                            <option selected>United States</option>
                            <option>Afghanistan</option>
                            <option>Albania</option>
                            <option>Algeria</option>
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>City</label>
                        <input class="form-control" type="text" placeholder="New York">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>State</label>
                        <input class="form-control" type="text" placeholder="New York">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>ZIP Code</label>
                        <input class="form-control" type="text" placeholder="123">
                    </div>

                    <div class="col-md-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="shipto">
                            <label class="custom-control-label" for="shipto" data-toggle="collapse" data-target="#shipping-address">Ship to different address</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="collapse mb-5" id="shipping-address">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Shipping Address</span></h5>
                <div class="bg-light p-30">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Address Line 1</label>
                            <input class="form-control" type="text" placeholder="123 Street">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address Line 2</label>
                            <input class="form-control" type="text" placeholder="123 Street">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Country</label>
                            <select class="custom-select">
                                <option selected>United States</option>
                                <option>Afghanistan</option>
                                <option>Albania</option>
                                <option>Algeria</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>City</label>
                            <input class="form-control" type="text" placeholder="New York">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>State</label>
                            <input class="form-control" type="text" placeholder="New York">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>ZIP Code</label>
                            <input class="form-control" type="text" placeholder="123">
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-5">
            <!-- <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Order Total</span></h5> -->
            <div class="bg-light p-30 mb-2">
                <div class="border-bottom">
                    <h6 class="mb-1">Products</h6>

                    <?php foreach ($cart_items as $product) :

                        $image =  $this->db->where('m_image_product_id', $product['id'])->where('m_image_status', 1)->get('master_image_tbl')->result();

                        if (!empty($image[0]->m_image_product_img)) {
                            $product_img = base_url('admin/uploads/product/' . $image[0]->m_image_product_img);
                        } else {
                            $product_img = base_url('admin/uploads/default.jpg');
                        }

                    ?>
                        <div class="d-flex justify-content-between mb-4">
                            <div class="row">
                                <div class="col-2">
                                    <img src="<?php echo $product_img; ?>" alt="" style="width: 50px;">
                                </div>
                                <div class="col-9">
                                    <p class="mt-2 text-dark"><?php echo $product['name']; ?></p>
                                    <div class="row m-0">
                                        <div class="col-3">
                                            <p class="sm">Qty : 1</p>
                                        </div>
                                        <div class="col-3">
                                            <p class="sm">Cotton </p>
                                        </div>
                                        <div class="col-3">
                                            <p class="sm"> Size - S </p>
                                        </div>
                                        <div class="col-3">
                                            <p class="color"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <p class="mt-2 text-dark"><?php echo '₹' . $product['subtotal']; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>

                <!-- <div class="border-bottom">
                    <h6 class="mb-3">Products</h6>
                    <div class="d-flex justify-content-between">
                        <img src="<?php echo base_url() ?>assets/img/m1.jpg" alt="" style="width: 50px;">
                        <p class="mt-2 text-dark">Product Name</p>
                        <p class="mt-2 text-dark">₹500</p>
                    </div>
                    <div class="d-flex justify-content-between mb-4">
                        <img src="<?php echo base_url() ?>assets/img/product-2.jpg" alt="" style="width: 50px;">
                        <p class="mt-2 text-dark">Product Name</p>
                        <p class="mt-2 text-dark">₹500</p>
                    </div>
                </div> -->
                <div class="border-bottom pt-3">
                    <div class="d-flex justify-content-between">
                        <h6>Subtotal</h6>
                        <h6>₹1000</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Shipping</h6>
                        <h6 class="font-weight-medium">₹10</h6>
                    </div>
                    <form class="py-2" action="">
                        <div class="input-group">
                            <input type="text" class="form-control border-1" placeholder="Coupon Code">
                            <div class="input-group-append">
                                <button class="btn btn-primary">Apply Coupon</button>
                            </div>
                        </div>
                    </form>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Coupon</h6>
                        <h6 class="font-weight-medium">₹10</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">GST</h6>
                        <h6 class="font-weight-medium">₹10</h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5>₹1030</h5>
                    </div>
                </div>
            </div>

            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Payment Mode</span></h5>
            <div class="bg-light p-30 mb-3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                    <label class="form-check-label" for="inlineRadio1">COD</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                    <label class="form-check-label" for="inlineRadio2">PhonePe</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3">
                    <label class="form-check-label" for="inlineRadio3">UPI</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio4" value="option4">
                    <label class="form-check-label" for="inlineRadio4">Debit Card</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio5" value="option5">
                    <label class="form-check-label" for="inlineRadio5">Credit Card</label>
                </div>
            </div>
            <a href="<?php echo base_url('Success') ?>"><button class="btn btn-block btn-primary font-weight-bold py-3">Place Order</button></a>

            <!-- <div class="mb-5">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Payment</span></h5>
                <div class="bg-light p-5">
                    <div class="form-group mb-4">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="payment" id="cod">
                            <label class="custom-control-label" for="cod">COD</label>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="payment" id="phone">
                            <label class="custom-control-label" for="phone">PhonePe</label>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="payment" id="upi">
                            <label class="custom-control-label" for="upi">UPI</label>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="payment" id="debitcard">
                            <label class="custom-control-label" for="debitcard">Debit Card</label>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="payment" id="credit">
                            <label class="custom-control-label" for="credit">Credit Card</label>
                        </div>
                    </div>
                    <a href="<?php echo base_url('Success') ?>"><button class="btn btn-block btn-primary font-weight-bold py-3">Place Order</button></a>
                </div>
            </div> -->
        </div>
    </div>
</div>
<!-- Checkout End -->


<?php include("footer.php"); ?>
<?php include("script.php"); ?>