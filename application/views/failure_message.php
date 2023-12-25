<?php include("head.php") ?>
<?php include("header.php") ?>

<style>
    .sm {
        box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
        border: none;
        border-radius: 15px;
    }
</style>

<section class=" d-flex align-items-center " style="min-height: 100vh; background-image: url('assets/img/failurebg.jpg'); background-size:cover">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="card sm p-5 " style="background-color:#f9f9f9">
                    <div class="col-md-12">
                        <h6 class="text-center">Hey XYZ,</h6>
                        <h4 class="text-center m-0 text-danger fb">"Failed"</h4>
                    </div>
                    <img src="<?php echo base_url(); ?>assets/img/failure.gif" alt="" class="w-25 m-auto d-block">

                    <div class="col-md-12">
                        <h5 class="text-center m-0 mb-3 mt-3 ">Sorry, Unfortunately Payment was Rejected !</h5>
                        <p class="text-center m-0" style="line-height: 1.8rem; font-size:1.3rem">Please, asure that the information you provided is correct.</p>
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