<?php include("head.php"); ?>
<?php include("header.php"); ?>
<style>
    .sm {
        font-size: 14px !important;
        font-weight: bold;
    }

   
</style>
<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="<?php echo base_url('Welcome');?>">Home</a>
                <a class="breadcrumb-item text-dark" href="javascript:void(0)">Shop</a>
                <span class="breadcrumb-item active">Checkout</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->


<!-- Checkout Start -->
<div class="container-fluid pb-4">
 <form method="post" id="form_order_add">
    <div class="row px-xl-5">
        <div class="col-lg-7">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Contact Details</span></h5>
            <form method="post" id="update_profile">
            <div class="bg-light p-30 mb-3" >
                <div class="row d-flex justify-content-end">
                    <div class="col-md-3 ">
                        <button type="submit" class="btn btn-block btn-primary font-weight-bold" id="btn_update">Edit</button>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-12 form-group">
                        <label> Name</label>
                        <input class="form-control" type="text" name="m_user_name" value="<?php echo $log_customer_dtl[0]->m_user_name; ?>"  placeholder="John" required>
                        <input type="hidden" name="m_user_id" value="<?php echo $log_customer_dtl[0]->m_user_id; ?>">
                    </div>
                    
                    <div class="col-md-6 form-group">
                        <label>E-mail</label>
                        <input class="form-control" type="email" name="m_user_email" value="<?php echo $log_customer_dtl[0]->m_user_email; ?>" placeholder="example@email.com" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Mobile No</label>
                        <input class="form-control" readonly type="text" name="m_user_mobile" value="<?php echo $log_customer_dtl[0]->m_user_mobile; ?>" maxlength="10" minlength="10" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" placeholder="Mobile No" required>
                    </div>
                </div>
            </div>
            </form>
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Shipping  Address</span></h5>
            <div class="bg-light p-30 mb-3">
                <div class="row">

                    <!-- <div class="col-md-6 form-group">
                        <label>Address Line 1</label>
                        <input class="form-control" type="text" name="m_user_address" value="<?php echo $log_customer_dtl[0]->m_user_address; ?>" required placeholder="123 Street">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Address Line 2</label>
                        <input class="form-control" type="text" name="m_user_address1" value="<?php echo $log_customer_dtl[0]->m_user_address1; ?>" required placeholder="Address Line 2">
                    </div> -->
                   <!--  <div class="col-md-6 form-group">
                        <label>Country</label>
                        <select class="custom-select">
                            <option selected>United States</option>
                            <option>Afghanistan</option>
                           
                        </select>
                    </div> -->
                     <div class="col-md-6 form-group">
                        <label>Country<span class="text-danger"> *</span></label>
                        <input class="form-control" type="text" name="m_user_country" value="<?php echo $log_customer_dtl[0]->m_user_country; ?>" required placeholder="Country">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>State<span class="text-danger"> *</span></label>
                        <input class="form-control" type="text"  name="m_user_state" value="<?php echo $log_customer_dtl[0]->m_user_state; ?>" required placeholder="State">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>City<span class="text-danger"> *</span></label>
                        <input class="form-control" type="text" name="m_user_city" value="<?php echo $log_customer_dtl[0]->m_user_city; ?>" required placeholder="city">
                    </div>
                    
                    <div class="col-md-6 form-group">
                        <label>Pincode<span class="text-danger"> *</span></label>
                        <input class="form-control" type="text" name="m_user_pincode" value="<?php echo $log_customer_dtl[0]->m_user_pincode; ?>" maxlength="6" minlength="6" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" required  placeholder="Pincode">
                    </div>

                    <div class="col-md-12 form-group">
                        <label>Address <span class="text-danger"> *</span></label>
                        <textarea class="form-control" type="text" name="m_user_address" placeholder="Full Address" required><?php echo $log_customer_dtl[0]->m_user_address; ?></textarea>
                        <!-- <input class="form-control" type="text" name="m_user_address" value="<?php echo $log_customer_dtl[0]->m_user_address; ?>" required placeholder="123 Street"> -->
                          <input class="form-control" type="hidden" name="user_email" value="<?php echo $log_customer_dtl[0]->m_user_email; ?>"  >
                          <input class="form-control" type="hidden" name="user_name" value="<?php echo $log_customer_dtl[0]->m_user_name; ?>"  >
                    </div>


                    <!-- <div class="col-md-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="shipto">
                            <label class="custom-control-label" for="shipto" data-toggle="collapse" data-target="#shipping-address">Ship to different address</label>
                        </div>
                    </div> -->
                </div>
            </div>
           <!--  <div class="collapse mb-5" id="shipping-address">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Shipping Address</span></h5>
                <div class="bg-light p-30">
                    <div class="row">

                         <div class="col-md-6 form-group">
                        <label>Address Line 1</label>
                        <input class="form-control" type="text" name="m_user_address" value="<?php echo $log_customer_dtl[0]->m_user_address; ?>" required placeholder="123 Street">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Address Line 2</label>
                        <input class="form-control" type="text" name="m_user_address1" value="<?php echo $log_customer_dtl[0]->m_user_address1; ?>" required placeholder="123 Street">
                    </div>
                        <div class="col-md-6 form-group">
                        <label>Country</label>
                        <input class="form-control" type="text" name="m_user_scountry" value="<?php echo $log_customer_dtl[0]->m_user_country; ?>" required placeholder="Country">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>State</label>
                        <input class="form-control" type="text"  name="m_user_sstate" value="<?php echo $log_customer_dtl[0]->m_user_state; ?>" required placeholder="State">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>City</label>
                        <input class="form-control" type="text" name="m_user_scity" value="<?php echo $log_customer_dtl[0]->m_user_city; ?>" required placeholder="city">
                    </div>
                    
                    <div class="col-md-6 form-group">
                        <label>Pincode</label>
                        <input class="form-control" type="text" name="m_user_spincode" value="<?php echo $log_customer_dtl[0]->m_user_spincode; ?>" required  placeholder="Pincode">
                    </div>
                    </div>
                </div>
            </div> -->

        </div>
        <div class="col-lg-5">
            <!-- <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Order Total</span></h5> -->
            <div class="bg-light p-30 mb-2">
                <div class="border-bottom">
                    <h6 class="mb-1">Products</h6>

                    <?php  

                    $gst = 0;
                    $subtotal =0;
                    $coupon =0;
                   

                    foreach ($cart_items as $product) :

                      $productgst =  $this->db->select('*')->where('m_product_id', $product['id'])->join('master_taxgst', 'master_taxgst.m_taxgst_id =master_product.m_product_taxgst', 'left')->join('master_fabric_tbl', 'master_fabric_tbl.m_fabric_id =master_product.m_product_fabric', 'left')->get('master_product')->result();

                       $tasgst = $this->db->select('mp.*, mtg.m_tax_value AS gst_rate')->from('master_product mp')->join('master_taxgst mtg', 'mp.m_product_taxgst = mtg.m_taxgst_id')->get()->result();


                           $color_id = $product['options']['color'];

                        // Fetch color details from the database
                        $color = $this->db->select('*')->where('m_color_id', $color_id)->get('master_color_tbl')->row();

                        // Now $color contains the details of the color, and you can access the name
                        $color_name = $color->m_color_name;

                         $size_id = $product['options']['size'];

                        // Fetch color details from the database
                        $size = $this->db->select('*')->where('m_size_id', $size_id)->get('master_size_tbl')->row();

                        // Now $color contains the details of the color, and you can access the name
                        $size_name = $size->m_size_name;



                        $image =  $this->db->where('m_image_product_id', $product['id'])->where('m_image_status', 1)->get('master_image_tbl')->result();

                        if (!empty($image[0]->m_image_product_img)) {
                            $product_img = base_url('admin/uploads/product/' . $image[0]->m_image_product_img);
                        } else {
                            $product_img = base_url('admin/uploads/default.jpg');
                        }

                        $gst += $product['price'] * $productgst[0]->m_tax_value/100;
                        $subtotal += $product['subtotal'];
                        $coupon  +=  0;  
                         
                        // print_r($gst);die();


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
                                            <p class="sm">Qty : <?php echo $product['qty']; ?></p>
                                        </div>
                                        <div class="col-3">
                                            <p class="sm"><?php echo $productgst[0]->m_fabric_name ?></p>
                                        </div>
                                        <div class="col-3">
                                            <p class="sm">Size-<?php echo $size_name; ?></p>
                                        </div>
                                        <div class="col-3">
                                            <p style="height: 20px;width: 20px;background-color: <?php echo $color_name ?>;"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1 text-end">
                                    <p class="mt-2 text-dark text-end"><?php echo '₹' . $product['subtotal']; ?></p>
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
                        <h6>₹<?php echo $subtotal; ?></h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <input type="hidden" name="m_sale_shipping" value="0">
                        <h6 class="font-weight-medium">Shipping</h6>
                        <h6 class="font-weight-medium">₹0</h6>
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
                         <input type="hidden" name="m_sale_discount" value="0">
                        <h6 class="font-weight-medium">₹0</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">GST</h6>
                        <h6 class="font-weight-medium">₹<?php echo $gst; ?></h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5>₹<?php echo $subtotal+ $gst - $coupon; ?></h5>
                    </div>
                </div>
            </div>

            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Payment Mode</span></h5>
            <!-- <div class="bg-light p-30 mb-3">
                    <?php
                    // Fetch payment modes from the database
                   

                    foreach ($paymentModes as $mode) :
                    ?>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio<?php echo $mode->m_pmode_id; ?>" <?php if($mode->m_pmode_id ==1)echo 'checked'?> value="<?php echo $mode->m_pmode_id; ?>">
                            <label class="form-check-label" for="inlineRadio<?php echo $mode->m_pmode_id; ?>"><?php echo $mode->m_pmode_name; ?></label>
                        </div>
                    <?php endforeach; ?>

                       <div class="additional-fields" id="cash-fields" style="display: none;">
                            <label for="cashAmount">Cash Amount:</label>
                            <input type="text" class="form-control" id="cashAmount" name="cashAmount">
                        </div>

                         Additional fields for UPI payment -->
                        <!-- <div class="additional-fields" id="upi-fields" style="display: none;">
                            <label for="upiTransactionNumber">UPI Transaction Number:</label>
                            <input type="text" class="form-control" id="upiTransactionNumber" name="upiTransactionNumber">
                            <label for="upiAmount">UPI Amount:</label>
                            <input type="text" class="form-control" id="upiAmount" name="upiAmount">
                        </div>

                </div>  -->

                <div class="bg-light p-30 mb-3">
                    <?php
                    // Fetch payment modes from the database
                    foreach ($paymentModes as $mode) :
                    ?>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input payment-mode" type="radio" name="m_sale_pmode" id="inlineRadio<?php echo $mode->m_pmode_id; ?>" <?php if($mode->m_pmode_id ==1)echo 'checked'?> value="<?php echo $mode->m_pmode_id; ?>">
                            <label class="form-check-label" for="inlineRadio<?php echo $mode->m_pmode_id; ?>"><?php echo $mode->m_pmode_name; ?></label>
                        </div>
                    <?php endforeach; ?>

                    <!-- Additional fields for Cash payment -->
                    
                    <!-- Additional fields for UPI payment -->
                    <div class="additional-fields" id="cash-fields" >
                        <label for="cashAmount">Paid Amount:</label>
                        <input type="text" class="form-control" required  onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" name="m_sale_payamt" value='<?php echo $subtotal+ $gst - $coupon; ?>' >
                    </div>

                </div>


           


            <button type="submit" class="btn btn-block btn-primary font-weight-bold py-3" id="btn_order_add">Place Order</button>

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
 </form>
</div>
<!-- Checkout End -->


<?php include("footer.php"); ?>
<?php include("script.php"); ?>
<?php $this->view('js/master_js'); ?>

<script>
// Add an event listener to the payment mode radio buttons
// document.querySelectorAll('.payment-mode').forEach(function (radio) {
//     radio.addEventListener('change', function () {
//         // Hide all additional fields
//         document.querySelectorAll('.additional-fields').forEach(function (field) {
//             field.style.display = 'none';
//         });

//         // Show additional fields based on the selected payment mode
//         var selectedMode = document.querySelector('input[name="inlineRadioOptions"]:checked').value;
//         if (selectedMode === '1') {
//             document.getElementById('cash-fields').style.display = 'block';
//         } else if (selectedMode === '2') {
//             document.getElementById('upi-fields').style.display = 'block';
//         }
//     });
// });
</script>