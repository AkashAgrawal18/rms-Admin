<?php include("head.php"); ?>
<?php include("header.php"); ?>

<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light order">
                <a class="breadcrumb-item text-dark" href="<?php echo base_url('Welcome') ?>">Home</a>
                <!-- <a class="breadcrumb-item text-dark" href="<?php echo base_url('Shop') ?>">Profile</a> -->
                <span class="breadcrumb-item active">Track order</span>
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
            <div class="card ocard">
                <div class="title">
                    <h5 class="pl-md-3 mt-3">Orders Tracking</h5>
                </div>
                <div class="cont1 p-3">
                    <p>To track your order please enter your OrderID in the box below and press "Track" button..</p>
                    <label for="fname">Order ID</label>
                    <div class="control-group col-md-6">
                        <input type="text" class="form-control" id="name" placeholder="Enter Your Order no." required="required" data-validation-required-message="Please enter your name" />
                        <p class="help-block text-danger"></p>
                        <div class="offer-text">
                            <a href="<?php echo base_url('Orders/order_details') ?>" class="btn btn-primary">Order Details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include("footer.php"); ?>
<?php include("script.php"); ?>