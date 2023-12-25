<?php include("head.php"); ?>
<?php include("header.php"); ?>




<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light order">
                <a class="breadcrumb-item text-dark" href="<?php echo base_url('Welcome') ?>">Home</a>
                <!-- <a class="breadcrumb-item text-dark" href="<?php echo base_url('Shop') ?>">Products</a> -->
                <span class="breadcrumb-item active">My Orders</span>
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
        <div class="col-md-9">
            <div class="row">

                <?php foreach ($all_value as $value):  ?>
                <div class="col-md-4 col-12 mb-4">
                    <div class="card ocard p-3">
                        <h5 class="text-center">Order No : <?= $value->m_sale_spo;?> </h5>
                        <h6>
                            <div class="container">
                                <div class="row">
                                    <div class="col-7 text-left">
                                        Order Date
                                    </div>
                                    <div class="col-5">
                                        : <?php echo date("d-m-Y", strtotime($value->m_sale_added_on));?>
                                    </div>
                                </div>
                            </div>
                        </h6>
                        <h6>
                            <div class="container">
                                <div class="row">
                                    <div class="col-7 text-left">
                                        Delivery Date
                                    </div>
                                    <div class="col-5">
                                        : <?php echo date("d-m-Y", strtotime($value->m_sale_added_on));?>
                                    </div>
                                </div>
                            </div>
                        </h6>
                        <h6>
                            <div class="container">
                                <div class="row">
                                    <div class="col-7 text-left">
                                        Status
                                    </div>
                                    <div class="col-5">
                                        : <?php if($m_sale_status = 1){ echo 'New Order';}else{ echo "Runing";
                                        }?>
                                    </div>
                                </div>
                            </div>
                        </h6>
                        <h6>
                            <div class="container">
                                <div class="row">
                                    <div class="col-7 text-left">
                                        Total
                                    </div>
                                    <div class="col-5">
                                        : ₹<?php echo $value->m_sale_gtotal;?>
                                    </div>
                                </div>
                            </div>
                        </h6>
                        <div class="offer-text">
                            <a href="<?php echo base_url('Orders/order_details/'.$value->m_sale_spo) ?>" class="btn btn-primary">Order Details</a>
                        </div>

                    </div>
                </div>
              <?php endforeach; ?>

               <!--  <div class="col-md-4 col-12 mb-4">
                    <div class="card ocard p-3">
                        <h5 class="text-center">Order No : #12345</h5>
                        <h6>
                            <div class="container">
                                <div class="row">
                                    <div class="col-7 text-left">
                                        Order Date
                                    </div>
                                    <div class="col-5">
                                        : 11-11-2023
                                    </div>
                                </div>
                            </div>
                        </h6>
                        <h6>
                            <div class="container">
                                <div class="row">
                                    <div class="col-7 text-left">
                                        Delivery Date
                                    </div>
                                    <div class="col-5">
                                        : 11-11-2023
                                    </div>
                                </div>
                            </div>
                        </h6>
                        <h6>
                            <div class="container">
                                <div class="row">
                                    <div class="col-7 text-left">
                                        Status
                                    </div>
                                    <div class="col-5">
                                        : Shipped
                                    </div>
                                </div>
                            </div>
                        </h6>
                        <h6>
                            <div class="container">
                                <div class="row">
                                    <div class="col-7 text-left">
                                        Total
                                    </div>
                                    <div class="col-5">
                                        : ₹500
                                    </div>
                                </div>
                            </div>
                        </h6>
                        <div class="offer-text">
                            <a href="<?php echo base_url('Orders/order_details') ?>" class="btn btn-primary">Order Details</a>
                        </div>

                    </div>
                </div> -->
            </div>

        </div>
    </div>
</section>



<!-- <div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Order No.</th>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    <tr>
                        <td class="align-middle">#12345</td>
                        <td class="align-middle"><img src="<?php echo base_url() ?>assets/img/m1.jpg" alt="" style="width: 50px;"> Product Name</td>
                        <td class="align-middle">₹500</td>
                        <td class="align-middle">
                            <h6>1</h6>
                        </td>
                        <td class="align-middle">Shipped</td>
                    </tr>
                    <tr>
                        <td class="align-middle">#12345</td>
                        <td class="align-middle"><img src="<?php echo base_url() ?>assets/img/product-2.jpg" alt="" style="width: 50px;"> Product Name</td>
                        <td class="align-middle">₹500</td>
                        <td class="align-middle">
                            <h6>1</h6>
                        </td>
                        <td class="align-middle">Shipped</td>
                    </tr>


                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">My Order Summary</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Total</h6>
                        <h6>₹1000</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Shipping</h6>
                        <h6 class="font-weight-medium">₹10</h6>
                    </div>
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
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Order Date</h6>
                        <h6 class="font-weight-medium">11-11-2023</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Delivery Date</h6>
                        <h6 class="font-weight-medium">18-11-2023</h6>
                    </div>
                    <a href="<?php echo base_url('Checkout') ?>"><button class="btn btn-block btn-primary font-weight-bold my-3 py-3">Contiune Shopping</button></a>
                </div>
            </div>
        </div>
    </div>
</div> -->


<?php include("footer.php"); ?>
<?php include("script.php"); ?>