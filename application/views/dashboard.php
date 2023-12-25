<?php include("head.php"); ?>
<?php include("header.php"); ?>




<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light order">
                <a class="breadcrumb-item text-dark" href="<?php echo base_url('Welcome') ?>">Home</a>
                <!-- <a class="breadcrumb-item text-dark" href="<?php echo base_url('Shop') ?>">Products</a> -->
                <span class="breadcrumb-item active">Dashboard</span>
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
                <div class="col-md-4 col-12 mb-4">
                    <a href="<?php echo base_url('Orders') ?>">
                        <div class="card ocard p-3">
                            <img src="<?php echo base_url() ?>assets/img/order.png" alt="order" class="w-25 m-auto d-block">
                            <h5 class="text-center">Your Orders</h5>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-12 mb-4">
                    <a href="<?php echo base_url('Orders') ?>">
                        <div class="card ocard p-3">
                            <img src="<?php echo base_url() ?>assets/img/address.png" alt="order" class="w-25 m-auto d-block">
                            <h5 class="text-center">Your Addresses</h5>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-12 mb-4">
                    <a href="<?php echo base_url('Orders') ?>">
                        <div class="card ocard p-3">
                            <img src="<?php echo base_url() ?>assets/img/account.png" alt="order" class="w-25 m-auto d-block">
                            <h5 class="text-center">Account Details</h5>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>



<?php include("footer.php"); ?>
<?php include("script.php"); ?>