<?php include("head.php"); ?>
<?php include("header.php"); ?>


<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light">
                <a class="breadcrumb-item text-dark" href="<?php echo base_url('Welcome') ?>">Home</a>
                <a class="breadcrumb-item text-dark" href="<?php echo base_url('Shop') ?>">My Orders</a>
                <span class="breadcrumb-item active">Orders Details</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<section class="pt-3" style="background-image: url('<?php echo base_url() ?>assets/img/pattern.png');">
    <div class="row pr-lg-5">
        <div class="col-md-3">
            <?php include("sidebar.php"); ?>
        </div>
        <!-- <div class="col-md-9">
                <div class="row">
                    <div class="col-lg-8 table-responsive mb-5">
                        <table class="table table-light table-borderless table-hover text-center mb-0">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Order No.</th>
                                    <th>Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>


                            <tbody class="align-middle">
                         <?php 
                         
                          
                            $mtotal = 0;
                             $sub_total = 0;
                             $total_gst = 0;
                             $grand_total = 0;
                              if (!empty($order_details->m_sale_items)) {
                                foreach ($order_details->m_sale_items as $value) {

                                    print_r($order_details[0]->m_sale_items);die();
                               
                            $image =  $this->db->where('m_image_product_id',$value->m_product_id)->where('m_image_status',1)->get('master_image_tbl')->result();

                            if (!empty($image[0]->m_image_product_img)) {
                                $product_img = base_url('admin/uploads/product/'.$image[0]->m_image_product_img);
                              } else {
                                $product_img = base_url('admin/uploads/default.jpg');
                              }

                               
                                $mtotal = $value->m_sale_price *$value->m_sale_qty;
                                 $sub_total += $mtotal; 
                                 $total_gst += $value->m_sale_gst;
                                

                              ?>
                                <tr>
                                    <td class="align-middle"><?php echo $value->m_sale_spo; ?></td>
                                    <td class="align-middle"><img src="<?php echo $product_img ?>assets/img/m1.jpg" alt="" style="width: 50px;">&nbsp; <?php echo $value->m_product_name; ?></td>
                                    <td class="align-middle">₹<?php  echo round($value->m_sale_price, 3); ?></td>
                                    <td class="align-middle">
                                        <h6><?php echo $value->m_sale_qty; ?></h6>
                                    </td>
                                    <td class="align-middle">₹<?php  echo round($mtotal, 3); ?></td>
                                </tr>
                                <?php }} ?>
                                


                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-4">
                        <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Order Summary</span></h5>
                        <div class="bg-light p-30 mb-5">
                            <div class="border-bottom pb-2">
                            <div class="d-flex justify-content-between">
                                    <h6 class="font-weight-medium">Items</h6>
                                    <h6 class="font-weight-medium"><?php echo  $total_product; ?></h6>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h6>SubTotal</h6>
                                    <h6>₹<?php  echo round($sub_total, 3); ?></h6>
                                </div>
                                
                                <div class="d-flex justify-content-between">
                                    <h6 class="font-weight-medium">Shipping</h6>
                                    <h6 class="font-weight-medium">₹0.00</h6>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h6 class="font-weight-medium">Coupon</h6>
                                    <h6 class="font-weight-medium">₹0.00</h6>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h6 class="font-weight-medium">GST</h6>
                                    <h6 class="font-weight-medium">₹<?php  echo round($total_gst, 3); ?></h6>
                                </div>
                               

                            </div>
                            <div class="pt-2">
                                <div class="d-flex justify-content-between mt-2">
                                    <h5>Total</h5>
                                    <h5>₹<?php  echo round($total_gst+$sub_total, 3); ?></h5>
                                </div>
                                <a href="<?php echo base_url('Orders/track_order') ?>"><button class="btn btn-block btn-primary font-weight-bold my-3 py-3">Track Your Order</button></a>
                            </div>
                        </div>
                    </div>
                </div>
        </div> -->
        <div class="col-md-9">
    <?php foreach ($order_datails as $order): ?>
        <div class="row">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Order No.</th>
                            <th>Products</th>
                            <th>Price</th>

                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <?php if (!empty($order->m_sale_items)): ?>
                            <?php foreach ($order->m_sale_items as $item): 
                                     
                           

                              $image =  $this->db->where('m_image_product_id',$item->m_product_id)->where('m_image_status',1)->get('master_image_tbl')->result();

                            if (!empty($image[0]->m_image_product_img)) {
                                $product_img = base_url('admin/uploads/product/'.$image[0]->m_image_product_img);
                              } else {
                                $product_img = base_url('admin/uploads/default.jpg');
                              }


                   
                                ?>
                                <tr>
                                    <td class="align-middle"><?php echo $item->m_sale_spo; ?></td>
                                    <td class="align-middle"><img src="<?php echo $product_img ?>" alt="" style="width: 50px;">&nbsp; <?php echo $item->m_product_name; ?></td>
                                    <td class="align-middle">₹<?php  echo round($item->m_sale_price, 3); ?></td>
                                    <td class="align-middle">
                                        <h6><?php echo $item->m_sale_qty; ?></h6>
                                    </td>
                                    <td class="align-middle">₹<?php  echo round($item->m_sale_total, 3); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Order Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Items</h6>
                            <h6 class="font-weight-medium"><?php echo $order->total_qty; ?></h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6>SubTotal</h6>
                            <h6>₹<?php echo round($order->sub_total, 3); ?></h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">₹<?php echo round($order->m_sale_shipping, 3); ?></h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Coupon</h6>
                            <h6 class="font-weight-medium">₹<?php echo round($order->m_sale_discount, 3); ?></h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">GST</h6>
                            <h6 class="font-weight-medium">₹<?php echo round($order->total_tax, 3); ?></h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5>₹<?php echo round($order->sub_total + $order->total_tax, 3); ?></h5>
                        </div>
                        <a href="<?php echo base_url('Orders/track_order') ?>"><button class="btn btn-block btn-primary font-weight-bold my-3 py-3">Track Your Order</button></a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

    </div>
</section>

<?php include("footer.php"); ?>
<?php include("script.php"); ?>