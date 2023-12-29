<?php include("head.php") ?>
<?php include("header.php") ?>

<style>
    .sm {
        box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
        border: none;
        border-radius: 15px;
    }
</style>

<section class=" d-flex align-items-center " style="min-height: 100vh; background-image: url('assets/img/successbg.jpg'); background-size:cover">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="card sm p-5 " style="background-color:#f9f9f9">
                    <div class="col-md-12">
                        <h6 class="text-center">Hey <?php echo $this->session->userdata('m_customer_name')?>,</h6>
                        <h4 class="text-center m-0 text-success fb">"Your Order Is Confirmed"</h4>
                    </div>
                    <img src="<?php echo base_url(); ?>assets/img/success.gif" alt="" class="w-25 m-auto d-block">

                    <div class="col-md-12">
                        <h3 class="text-center m-0 mb-3 mt-3 ">Thank You For Ordering !</h3>
                        <p class="text-center m-0" style="line-height: 1.8rem; font-size:1.3rem">We'll send you a Shipping Confirmation email <br> as soon as your order ships...!!</p>
                        <div class="rbt-button-group d-flex justify-content-center mt-4">
                            <div class="offer-text">
                                <a href="<?php echo base_url('Orders') ?>" class="btn btn-primary">Back to My Orders</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include("footer.php") ?>

<?php include("script.php") ?>