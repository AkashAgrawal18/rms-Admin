<style>
    .cr {
        color: #fff;
    }

    @media (max-width:600px) {
        .navbar-collapse #main-nav {
            position: fixed !important;
            height: 80vh;
            top: 83px !important;
            left: -250px !important;
            z-index: 999999 !important;
            width: 250px;
            background-color: #55093e !important;
            padding: 20px !important;
            transition: all 800ms !important;
        }

        .navbar-collapse.show #main-nav {
            top: 83px !important;
            left: 0 !important;
            transition: all 800ms !important;
        }

        .navbar-collapse #main-nav .nav-item {
            margin: 10px 0px !important;


        }

        .cr {
            color: #55093e;
        }
    }
</style>

</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        
        <div class="row align-items-center bg-light py-2 px-xl-5 d-none d-lg-flex">
            <div class="col-lg-4">
                <?php

                $img_title = get_settings('m_app_logo');

                if (!empty($img_title)) {

                    if (file_exists('admin/uploads/logo/' . $img_title)) {

                        $fav_img = base_url('admin/uploads/logo/') . $img_title;
                    } else {

                        $fav_img  = base_url('assets/img/fashion.png');
                    }
                } else {

                    $fav_img  = base_url('assets/img/fashion.png');
                }


                ?>
                <a href="<?php echo base_url('Welcome') ?>">
                    <img class="d-block" src="<?php echo $fav_img ?>" alt="Fashion logo" style="width:200px"></a>
                <!-- <a href="<?php echo base_url('Welcome') ?>" class="text-decoration-none">
                    <span class="h1 text-uppercase text-primary bg-dark px-2">Fashion</span>
                    <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Lane</span>
                </a> -->
            </div>
            <?php
            ?>
            <div class="col-lg-4 col-6 text-left">
                <form action="<?php echo base_url('Product'); ?>" method='post'>
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Search for products">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search" style="color: #55093e;"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-2 col-6 text-center w-100">
                <div class="offer-text">

                    <?php if (!empty($this->session->userdata('is_customer_in'))) {  ?>
                        <a href="<?php echo base_url('Dashboard') ?>" class="btn btn-primary">My Account</a>
                    <?php } else { ?>
                        <a href="<?php echo base_url('Register') ?>" class="btn btn-primary">Login</a>
                    <?php } ?>
                </div>
                <!-- <div class="d-inline-flex align-items-center">
                    <div class="btn-group">
                        <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" style="font-weight: 500;">My Account</button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="<?php echo base_url('SignIn') ?>"><button class="dropdown-item" type="button">Sign In</button></a>
                            <a href="<?php echo base_url('Register') ?>"><button class="dropdown-item" type="button">Register</button></a>
                        </div>
                    </div>
                </div> -->
            </div>
            <div class="col-lg-2 col-6 text-center ">
                <p class="m-0">Customer Service</p>
                <h6 class="m-0">+91<?php echo get_settings('m_app_mobile')  ?></h6>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid" style="background-color: #55093e">
        <div class="row px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                    <h6 class="text-white m-0"><i class="fa fa-bars mr-2"></i>Categories</h6>
                    <i class="fa fa-angle-down text-white"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                    <?php $categories = $this->db->select('main_cat.*,main_cat.m_category_id as main_id,main_cat.m_category_name as main_name,parent_cat.m_category_name as parent_name')->join('master_categories parent_cat', 'parent_cat.m_pcategory_id = 
                        main_cat.m_category_id', 'left')->get('master_categories main_cat')->result();
                    // echo "<pre>"; print_r($categories);

                    ?>

                    <div class="navbar-nav w-100">

                        <?php foreach ($categories as $category) : ?>
                            <?php if ($category->m_pcategory_id == 0) : ?>


                                <div class="nav-item dropdown dropright">
                                    <a href="<?php echo base_url('Product?cat=' . $category->m_category_id);  ?>" class="nav-link dropdown-toggle" data-toggle="dropdown"><?php echo $category->m_category_name ?> <i class="fa fa-angle-right float-right mt-1"></i></a>
                                    <?php foreach ($categories as $sub_category) : ?>
                                        <?php if ($sub_category->m_pcategory_id == $category->m_category_id) : ?>
                                            <div class="dropdown-menu position-absolute rounded-0 border-0 m-0">
                                                <a href="<?php echo base_url('Product?cat=' . $sub_category->m_category_id);  ?>" class="dropdown-item"><?= $sub_category->m_category_name ?></a>
                                                <!-- <a href="" class="dropdown-item">Women's Dresses</a>
                                <a href="" class="dropdown-item">Baby's Dresses</a> -->
                                            </div>

                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <!-- <a href="" class="nav-item nav-link">Shirts</a>
                        <a href="" class="nav-item nav-link">Jeans</a>
                        <a href="" class="nav-item nav-link">Swimwear</a>
                        <a href="" class="nav-item nav-link">Sleepwear</a>
                        <a href="" class="nav-item nav-link">Sportswear</a>
                        <a href="" class="nav-item nav-link">Jumpsuits</a>
                        <a href="" class="nav-item nav-link">Blazers</a>
                        <a href="" class="nav-item nav-link">Jackets</a>
                        <a href="" class="nav-item nav-link">Shoes</a> -->
                    </div>
                </nav>
            </div>

            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg navbar-dark py-2 py-lg-0 px-0">
                    <img class=" d-block d-lg-none" src="<?php echo base_url() ?>assets/img/fashionlight.png" alt="Fashion logo" style="width:200px">
                    <!-- <a href="<?php echo base_url('Welcome') ?>" class="text-decoration-none d-block d-lg-none">
                        <span class="h1 text-uppercase text-dark bg-light px-2">Fashion</span>
                        <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Lane</span>
                    </a> -->
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0" id="main-nav">
                            <a href="<?php echo base_url('Welcome') ?>" class="nav-item nav-link active mr-3">Home</a>
                            <!-- <a href="<?php echo base_url('Product') ?>" class="nav-item nav-link  mr-3">All Product</a> -->
                            <?php foreach ($categories as $category) : ?>
                                <?php if ($category->m_pcategory_id == 0) : ?>
                                    <a href="<?php echo base_url('Product?cat=' . $category->m_category_id) ?>" class="nav-item nav-link mr-3"><?php echo $category->m_category_name ?> </a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <!-- <a href="<?php echo base_url('Product') ?>" class="nav-item nav-link mr-3">Cotton Kurtis</a>
                            <a href="<?php echo base_url('Product') ?>" class="nav-item nav-link mr-3">Embroidered Kurtis</a>
                            <a href="<?php echo base_url('Product') ?>" class="nav-item nav-link mr-3">Rayon Kurtis</a> -->

                            <!-- <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages <i class="fa fa-angle-down mt-1"></i></a>
                                <div class="dropdown-menu bg-primary rounded-0 border-0 m-0">
                                    <a href="cart.php" class="dropdown-item">Shopping Cart</a>
                                    <a href="checkout.php" class="dropdown-item">Checkout</a>
                                </div>
                            </div> -->
                            <a href="<?php echo base_url('Contact') ?>" class="nav-item nav-link">Contact Us</a>
                            <div class="offer-text d-block d-md-none mt-3">
                                <a href="<?php echo base_url('Register') ?>" class="btn btn-primary">Login / Register</a>
                            </div>
                            <h6 class="text-secondary text-uppercase mt-4 mb-3 d-block d-lg-none">Follow Us</h6>
                            <div class="d-flex d-block d-lg-none">
                                <a class="btn btn-primary btn-square mr-2" href="<?php echo get_settings('m_app_twitter')  ?>"><i class="fab fa-whatsapp"></i></a>
                                <a class="btn btn-primary btn-square mr-2" href="<?php echo get_settings('m_app_fb')  ?>"><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-primary btn-square mr-2" href="<?php echo get_settings('m_app_linkedin')  ?>"><i class="fab fa-youtube"></i></a>
                                <a class="btn btn-primary btn-square" href="<?php echo get_settings('m_app_insta')  ?>"><i class="fab fa-instagram"></i></a>
                            </div>

                        </div>
                        <?php $totalwishlist = $this->db->where('m_wishlist_user_id', $this->session->userdata('m_customer_id'))->get('master_wishlist')->num_rows();


                        ?>

                    </div>
                    <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                        <a href="<?php echo base_url('Wishlist') ?>" class="btn px-0">
                            <i class="fas fa-heart cr"></i>
                            <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;"><?php echo $totalwishlist  ?> </span>
                        </a>
                        <a href="<?php echo base_url('Cart') ?>" class="btn px-0 ml-3">
                            <i class="fas fa-shopping-cart cr"></i>
                            <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;"><?php echo count($this->cart->contents())? :  0; ?></span>
                        </a>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->