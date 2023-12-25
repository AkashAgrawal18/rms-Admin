
<!-- bottom navigation -->
<main class="bottom-nav d-md-none d-block position-fixed w-100" style="bottom:0; z-index:99999;">
    <div class="container-fluid" style="background-color: #55093e;">
        <div class="row py-2">
            <div class="col-3 text-center text-white">
                <i class="fas fa-home"></i>
                <a href="<?php echo base_url('Welcome') ?>">
                    <p class="text-white">Home</p>
                </a>
            </div>
            <div class="col-3 text-center text-white">
                <i class="fab fa-buffer"></i>
                <a href="<?php echo base_url('Offer') ?>">
                    <p class="text-white">Offers</p>
                </a>
            </div>
            <div class="col-3 text-center text-white">
                <i class="fas fa-shopping-cart"></i>
                <a href="<?php echo base_url('Cart') ?>">
                    <p class="text-white">Cart</p>
                </a>
            </div>

            <div class="col-3 text-center text-white">
                <i class="fas fa-user-circle"></i>
                <a href="<?php echo base_url('Dashboard') ?>">
                    <p class="text-white">Account</p>
                </a>
            </div>
        </div>
    </div>
</main>

<!-- Footer Start -->
<div class="container-fluid bg-dark text-secondary pt-5" style="background-image: url('assets/img/footerbg.png');">
    <div class="row px-xl-5 pt-5">
        <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
            <!-- <h5 class="text-secondary text-uppercase mb-4">Get In Touch</h5> -->
            <img src="<?php echo base_url() ?>assets/img/fashionlight.png" alt="Fashion logo" class="w-75 m-auto d-block">
            <!-- <a href="<?php echo base_url('Welcome') ?>" class="text-decoration-none">
                <span class="h1 text-uppercase text-primary bg-dark px-2">Fashion</span>
                <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Lane</span>
            </a> -->
            <p class="mb-4 mt-3 justi">Fashion Lane, a term that resonates with style enthusiasts and trend seekers alike, embodies the dynamic intersection of creativity, culture, and commerce within the realm of fashion.</p>

        </div>
        <div class="col-lg-8 col-md-12">
            <div class="row justify-content-between">
                <div class="col-lg-3 col-md-4 col-6 mb-5 offset-lg-1">
                    <h5 class="text-secondary text-uppercase mb-4">Quick Shop</h5>
                    <div class="d-flex flex-column justify-content-start foot">
                        <a class="text-secondary mb-2" href="<?php echo base_url('Welcome') ?>"><i class="fa fa-angle-right mr-2"></i>Home</a>
                        <a class="text-secondary mb-2" href="<?php echo base_url('About') ?>"><i class="fa fa-angle-right mr-2"></i>About Us</a>
                        <a class="text-secondary mb-2" href="<?php echo base_url('Product') ?>"><i class="fa fa-angle-right mr-2"></i>Our Products</a>
                        <!-- <a class="text-secondary mb-2" href="<?php echo base_url('Product/product_details') ?>"><i class="fa fa-angle-right mr-2"></i>Products Details</a> -->
                        <a class="text-secondary mb-2" href="<?php echo base_url('Offer') ?>"><i class="fa fa-angle-right mr-2"></i>Offers</a>
                        <a class="text-secondary" href="<?php echo base_url('Contact') ?>"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6 mb-5">
                    <h5 class="text-secondary text-uppercase mb-4">My Account</h5>
                    <div class="d-flex flex-column justify-content-start foot">
                        <a class="text-secondary mb-2" href="<?php echo base_url('Register') ?>"><i class="fa fa-angle-right mr-2"></i>Login</a>
                        <a class="text-secondary mb-2" href="<?php echo base_url('Dashboard') ?>"><i class="fa fa-angle-right mr-2"></i>Dashboard</a>
                        <a class="text-secondary mb-2" href="<?php echo base_url('Profile') ?>"><i class="fa fa-angle-right mr-2"></i>My Profile</a>
                        <a class="text-secondary mb-2" href="<?php echo base_url('Cart') ?>"><i class="fa fa-angle-right mr-2"></i>View Cart</a>
                        <a class="text-secondary mb-2" href="<?php echo base_url('Wishlist') ?>"><i class="fa fa-angle-right mr-2"></i>My Wishlist</a>
                        <a class="text-secondary" href="<?php echo base_url('Orders') ?>"><i class="fa fa-angle-right mr-2"></i>My Order</a>
                    </div>
                </div>
                <div class="col-md-4 mb-5 foot1">
                    <h5 class="text-secondary text-uppercase mb-4">Get In Touch</h5>
                    <p class="mb-2"><i class="fa fa-map-marker text-white mr-3"></i><?php echo get_settings('m_app_address')  ?></p>
                    <p class="mb-2"><i class="fa fa-envelope text-white mr-3"></i><?php echo get_settings('m_app_email')  ?></p>
                    <p class="mb-0"><i class="fa fa-phone text-white mr-3"></i>+91<?php echo get_settings('m_app_mobile')  ?></p>
                    <!-- <h6 class="text-secondary text-uppercase mb-4 mt-4">Secured Payment Gateways</h6>
                    <img class="img-fluid" src="<?php echo base_url() ?>assets/img/payments.png" alt=""> -->
                    <h6 class="text-secondary text-uppercase mt-4 mb-3">Follow Us</h6>
                    <div class="d-flex">
                        <a class="btn btn-primary btn-square mr-2" href="<?php echo get_settings('m_app_twitter')  ?>"><i class="fab fa-whatsapp"></i></a>
                        <a class="btn btn-primary btn-square mr-2" href="<?php echo get_settings('m_app_fb')  ?>"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-primary btn-square mr-2" href="<?php echo get_settings('m_app_linkedin')  ?>"><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-primary btn-square" href="<?php echo get_settings('m_app_insta')  ?>"><i class="fab fa-instagram"></i></a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row border-top mx-xl-5 py-md-4 py-5 mb-xl-0 mb-5" style="border-color: rgba(256, 256, 256, .1) !important;">
        <div class="col-md-8 px-xl-0">
            <p class="mb-md-0 text-center text-md-left text-secondary">
                &copy;<?php echo date('Y'); ?> <?php echo get_settings('m_app_name'); ?> | Design & Developed by <a href="https://logixhunt.com/" class="footer-link">Logixhunt</a>
            </p>
        </div>
        <div class="col-md-4 px-xl-0 text-center text-md-right">
            <a class="text-secondary mb-2" href="<?php echo base_url('Terms_conditions') ?>">Terms & Conditions</a>
            <a class="text-secondary mb-2" href="<?php echo base_url('Privacy_policy') ?>">| Privacy Policy</a>
            <a class="text-secondary mb-2" href="<?php echo base_url('Privacy_policy') ?>">| Refund Policy</a>


        </div>
    </div>
</div>
<!-- Footer End -->

<a href="https://wa.me/+911234567890" style="aspect-ratio: 1/1; width: 4rem; position: fixed; bottom:10%; left: 3%; z-index:999">
    <img src="<?php echo base_url() ?>assets/img/whatsapp.png" class="w-100 d-none d-md-block">

</a>


<!-- Back to Top -->
<a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>