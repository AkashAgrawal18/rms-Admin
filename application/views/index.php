<?php include("head.php"); ?>
<?php include("header.php"); ?>
<style>
    #btn {
        display: inline !important;
        font-weight: 400;
        color: #6C757D;
        text-align: center;
        vertical-align: middle;
        user-select: none;
        background-color: transparent;
        border: 1px solid transparent;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: 0;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
</style>

<!-- search -->
<div class="row">
    <div class="col-lg-12 col-8 text-left d-block d-md-none py-2">
        <form action="">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for products">
                <div class="input-group-append">
                    <span class="input-group-text bg-transparent" style="color: #55093e;">
                        <i class="fa fa-search"></i>
                    </span>
                </div>
            </div>
        </form>
    </div>
    <div class="col-lg-12 col-4 text-right d-block d-md-none py-2 mt-2">
        <a href="<?php echo base_url('Wishlist') ?>" class="btn px-0" id="btn">
            <i class="fas fa-heart" style="color: #55093e;"></i>
            <span class="badge border rounded-circle" style="padding-bottom: 2px;color: #55093e;border:1px solid #55093e">0</span>
        </a>
        <a href="<?php echo base_url('Cart') ?>" class="btn px-0" id="btn">
            <i class="fas fa-shopping-cart" style="color: #55093e;"></i>
            <span class="badge border rounded-circle" style="padding-bottom: 2px;color: #55093e;border:1px solid #55093e">0</span>
        </a>
    </div>
</div>

<!-- hero carousel -->

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">

        <?php
        $caros_item = '';
        $liitem = '';
        if (!empty($slider_main)) {
            foreach ($slider_main as $cau => $value) {

                if (!empty($value->m_slider_image) && file_exists('admin/uploads/slider/' . $value->m_slider_image)) {
                    $slider_img = base_url('admin/uploads/slider/' . $value->m_slider_image);
                } else {
                    $slider_img = base_url('assets/img/banner2.jpg');
                }
                $acticlass = $cau == 0 ? 'active' : '';
                $liitem .= '<li data-target="#carouselExampleIndicators" data-slide-to="' . $cau . '" class="' . $acticlass . '"></li>';
                $caros_item .= '<div class="carousel-item ' . $acticlass . '" data-interval="3000">
                <img class="d-block w-100 bann" src="' . $slider_img . '" alt="First slide">
                </div>';
            }
        } ?>
        <?= $liitem ?>

    </ol>

    <div class="carousel-inner">
        <?= $caros_item ?>

    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>



<!-- Carousel Start -->
<section style="background-image: url('assets/img/pattern.png');">
    <div class="container-fluid py-4">
        <div class="row px-xl-5">
            <div class="col-lg-8 d-none d-md-block">


                <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">


                    <ol class="carousel-indicators">

                        <?php
                        $caros_item2 = '';
                        $liitem2 = '';
                        if (!empty($slider_card)) {
                            foreach ($slider_card as $cau => $value) {

                                if (!empty($value->m_slider_image) && file_exists('admin/uploads/slider/' . $value->m_slider_image)) {
                                    $slider_img = base_url('admin/uploads/slider/' . $value->m_slider_image);
                                } else {
                                    $slider_img = base_url('assets/img/banner2.jpg');
                                }
                                $acticlass = $cau == 0 ? 'active' : '';
                                $liitem2 .= '<li data-target="#header-carousel" data-slide-to="' . $cau . '" class="' . $acticlass . '"></li>';
                                $caros_item2 .= ' <div class="carousel-item position-relative ' . $acticlass . '" data-interval="3000" style="height: 430px;">
                                <img class="position-absolute w-100 h-100" src="' . $slider_img . '" style="object-fit: cover;">
                                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">' . $value->m_slider_title . '</h1>
                                <p class="mx-md-5 px-5 animate__animated animate__bounceIn">' . $value->m_slider_des . '</p>
                                <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="' . base_url('Product?cat=') . $value->m_slider_cat_id . '">Shop Now</a>
                                </div>
                                </div>
                                </div>';
                            }
                        } ?>
                        <?= $liitem2 ?>

                    </ol>
                    <div class="carousel-inner">
                        <?= $caros_item2 ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 d-none d-md-block ">
                <?php
                $webvie = '';
                $mobvie = '';
                $col12off = '';
                if (!empty($active_offer)) {
                    foreach ($active_offer as $value) {
                        if (!empty($value->m_offer_image) && file_exists('admin/uploads/offer/' . $value->m_offer_image)) {
                            $offer_img = base_url('admin/uploads/offer/' . $value->m_offer_image);
                        } else {
                            $offer_img = base_url('admin/uploads/default.jpg');
                        }
                        $webvie .= '<div class="product-offer mb-30" style="height: 200px;">
                        <a href="' . base_url('Product?offer=' . $value->m_offer_id) . '"><img class="img-fluid" src="' . $offer_img . '" alt=""></a>
                        <div class="offer-text">
                            <h6 class="text-white text-uppercase">Save ' . $value->m_offer_title . '</h6>
                            <h3 class="text-white mb-3">' . $value->m_offer_maintitle . '</h3>
                            <a href="' . base_url('Product?offer=' . $value->m_offer_id) . '" class="btn btn-primary">Shop Now</a>
                        </div>
                    </div>';


                        $mobvie .= ' <div class="col-6">
                        ' . $webvie . '
                    </div>';


                        $col12off .= '<div class="col-md-6">
                        <div class="product-offer mb-30" style="height: 300px;">
                            <img class="img-fluid" src="' . $offer_img . '" alt="">
                            <div class="offer-text">
                                <h6 class="text-white text-uppercase">Save ' . $value->m_offer_title . '</h6>
                                <h3 class="text-white mb-3">' . $value->m_offer_maintitle . '</h3>
                                <a href="' . base_url('Product?offer=' . $value->m_offer_id) . '" class="btn btn-primary">Shop Now</a>
                            </div>
                        </div>
                    </div>';
                    }
                } ?>

                <?= $webvie ?>
            </div>

            <div class="col-lg-12 d-block d-md-none mt-0">
                <div class="row">
                    <?= $mobvie ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Carousel End -->

<!-- Featured Start mobile view-->
<div class="container-fluid d-md-none d-block" style="padding-right: 0px; padding-left: 0px;">
    <div class="card p-3">
        <div class="row">
            <div class="col-3">
                <div class="d-flex align-items-center bg-light">
                    <!-- <h4 class="fas fa-exchange-alt text-primary m-0" style="padding-left: 22px;"></h4> -->
                    <img class="img-fluid w-50 m-auto d-block" src="<?php echo base_url() ?>assets/img/return.png" alt="">
                </div>
                <p class="mvc text-center font-weight-semi-bold m-0">Easy Returns & Refunds</p>
            </div>
            <div class="col-3">
                <div class="d-flex align-items-center bg-light text-center">
                    <!-- <h4 class="fa fa-shipping-fast text-primary m-0" style="padding-left: 22px;"></h4> -->
                    <img class="img-fluid w-50 m-auto d-block" src="<?php echo base_url() ?>assets/img/shipping.png" alt="">
                </div>
                <p class="mvc text-center font-weight-semi-bold m-0">Free Shipping</p>
            </div>
            <div class="col-3">
                <div class="d-flex align-items-center bg-light text-center">
                    <!-- <h4 class="fa fa-phone-volume text-primary m-0" style="padding-left: 22px;"></h4> -->
                    <img class="img-fluid w-50 m-auto d-block" src="<?php echo base_url() ?>assets/img/price.png" alt="">
                </div>
                <p class="mvc text-center font-weight-semi-bold m-0">Lowest <br> Price</p>
            </div>
            <div class="col-3">
                <div class="d-flex align-items-center bg-light text-center">
                    <!-- <h1 class="fa fa-check text-primary m-0" style="padding-left: 22px;"></h1> -->
                    <img class="img-fluid w-50 m-auto d-block" src="<?php echo base_url() ?>assets/img/quality.png" alt="">
                </div>
                <p class="mvc text-center font-weight-semi-bold m-0">Quality Product</p>
            </div>
        </div>
    </div>
</div>



<!-- Categories Start -->
<section style="background-image: url('assets/img/pattern.png');">
    <div class="container-fluid pt-5">
        <h4 class="section-title position-relative text-uppercase mx-xl-5 mb-2"><span class="bg-secondary pr-3">Categories</span></h4>
        <div class="row px-md-5">
            <?php if (!empty($all_category)) {
                foreach ($all_category as $value) {

                    if (!empty($value->m_category_image) && file_exists('admin/uploads/categories/' . $value->m_category_image)) {
                        $cat_img = base_url('admin/uploads/categories/' . $value->m_category_image);
                    } else {
                        $cat_img = base_url('admin/uploads/default.jpg');
                        //admin/uploads/default.jpg
                    }
         ?>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-4 pb-3">
                        <a href="<?php echo base_url('Product?cat=' . $value->m_category_id);  ?>" class="text-decoration-none">
                            <div class="card citem">
                                <div class="row align-items-center justify-content-center">
                                    <div class="col-xl-5 col-lg-4 col-md-4 col-12 overflow-hidden">
                                        <img class="w-75 m-auto d-block" src="<?php echo $cat_img ?>" alt="" style="aspect-ratio:1/1">
                                    </div>
                                    <div class="col-xl-7 col-lg-8 col-md-8 col-12 text-md-left text-center">
                                        <h6 class="pfont"><?php echo $value->m_category_name  ?></h6>
                                        <small class="text-dark"><?= $value->total_product; ?> Products</small>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
            <?php }
            } ?>

        </div>
    </div>
</section>
<!-- Categories End -->


<!-- Products Start -->
<section style="background-image: url('assets/img/pattern.png');">
    <div class="container-fluid pt-5 pb-3">
        <h4 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3"><?php
                                                                                                                $featured = $this->db->select('*')->where('m_offer_status', 1)->where('m_offer_id', 1)->get('master_offers')->result();

                                                                                                                echo $featured[0]->m_offer_maintitle; ?></span></h4>
        <div class="row px-xl-5">

            <?php foreach ($product_featured as $value) :

                $totalreview = $this->db->where('m_review_produ_id', $value->m_product_id)->get('master_review_tbl')->num_rows();

                $image =  $this->db->where('m_image_product_id', $value->m_product_id)->where('m_image_status', 1)->get('master_image_tbl')->result();
                $average_rating1 = $this->Main_model->getAverageRating($value->m_product_id);

                if (!empty($image[0]->m_image_product_img)) {
                    $product_img = base_url('admin/uploads/product/' . $image[0]->m_image_product_img);
                } else {
                    $product_img = base_url('admin/uploads/default.jpg');
                }
            ?>
                <input type='hidden' id='qty<?php echo $value->m_product_id; ?>' value='1'>
                <input type="hidden" id="color<?php echo $value->m_product_id; ?>" value='<?php echo $value->m_color_id; ?>'>
                <input type="hidden" id="size<?php echo $value->m_product_id; ?>" value="<?php echo $value->m_size_id; ?>">
                <div class="col-lg-3 col-md-4 col-sm-6 col-6 pb-1">
                    <div class="product-item bg-light mb-4">
                        <div class="product-img position-relative overflow-hidden">
                            <a href="<?php echo base_url('Product/product_details/' . $value->m_product_id . '/' . $value->m_category_slug);  ?>"><img class="img-fluid w-100 msize" src="<?php echo $product_img ?>" alt=""></a>
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square add_to_cart" href="javascript:void(0)" data-tippy="Add to cart" data-productid='<?php echo $value->m_product_id; ?>' data-productname='<?= $value->m_product_name; ?>' data-price='<?php echo $value->m_product_seles_price  ?>'><i class="fa fa-shopping-cart"></i></a>
                                <?php if (!empty($this->session->userdata('is_customer_in'))) {
                                    $check_cust_id = $this->session->userdata('m_customer_id');
                                } else {
                                    $check_cust_id = 0;
                                }

                                $this->db->where('m_wishlist_product_id', $value->m_product_id);
                                $this->db->where('m_wishlist_user_id', $check_cust_id);
                                $check_wish = $this->db->get('master_wishlist')->result();


                                ?>
                                <?php if (!empty($check_wish)) { ?>

                                    <a class="btn btn-outline-dark btn-square" href='javascript:void(0)' id='wish_col<?php echo $value->m_product_id; ?>' onclick='setWish(<?php echo $check_cust_id . ',' . $value->m_product_id; ?>)' style="background: red;"><i class="far fa-heart"></i></a>
                                    <input type='hidden' id='wish_id<?php echo $value->m_product_id; ?>' value='1'>

                                <?php } else { ?>


                                    <a class="btn btn-outline-dark btn-square" href='javascript:void(0)' id='wish_col<?php echo $value->m_product_id; ?>' onclick='setWish(<?php echo $check_cust_id . ',' . $value->m_product_id; ?>)'><i class="far fa-heart"></i></a>
                                    <input type='hidden' id='wish_id<?php echo $value->m_product_id; ?>' value='0'>
                                <?php } ?>
                                <a class="btn btn-outline-dark btn-square" href="<?php echo base_url('Product/product_details/' . $value->m_product_id . '/' . $value->m_category_slug);  ?>"><i class="fas fa-eye"></i></a>
                                <!-- <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a> -->
                            </div>
                        </div>

                        <div class="clr button p-1" style="background-color: #000000a1;">
                            <div class="row d-flex justify-content-end align-items-center">
                                <div class="col-md-6">
                                    <h6 class="text-white m-0 text-center"> Size -<?php echo $value->m_size_name ?> &nbsp; &nbsp;</h6>
                                </div>
                                <div class="col-md-6 d-flex justify-content-center">
                                    <p class="m-0 text-center" style="width: 15px; height:15px; border:2px solid #000; background-color:<?php echo $value->m_color_name ?>"></p>
                                </div>
                            </div>
                        </div>
                        <div class="text-center py-4" style="height: 150px;">
                            <a class="h6 text-decoration-none text-truncate" href="<?php echo base_url('Product/product_details/' . $value->m_product_id . '/' . $value->m_category_slug);  ?>"><?php echo $value->m_product_name;  ?></a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h6>₹<?php echo round($value->m_product_seles_price, 3); ?></h6>
                                <h6 class="text-muted ml-2 mvc"><del>₹<?php echo round($value->m_product_mrp, 3); ?></del></h6>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1 text-info">
                                <?php
                                $averageRating = $average_rating1; // Assuming $average_rating is set in your controller

                                // Generate stars based on the average rating
                                for ($i = 1; $i <= 5; $i++) {
                                    $starClass = $i <= $averageRating ? 'fa fa-star mr-1' : 'fa fa-star-o mr-1';
                                    echo '<small class="' . $starClass . '"></small>';
                                }
                                ?>
                                <small>(<?= $totalreview ?>)</small>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>
<!-- Products End -->

<!-- Offer Start -->
<div class="container-fluid pt-5 pb-3">
    <div class="row px-xl-5">
        <?= $col12off ?>
    </div>
</div>
<!-- Offer End -->

<!-- Featured Start -->
<div class="container-fluid d-md-block d-none pt-4">
    <div class="row px-xl-5">
        <div class="col-lg-3 col-md-6 col-sm-6 col-6">
            <div class="d-flex align-items-center bg-light mb-4" style="padding: 25px;">
                <!-- <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1> -->
                <img class="img-fluid w-25 mr-3" src="<?php echo base_url() ?>assets/img/return.png" alt="">
                <h5 class="font-weight-semi-bold m-0">Easy Returns & Refunds</h5>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-6">
            <div class="d-flex align-items-center bg-light mb-4" style="padding: 25px;">
                <!-- <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1> -->
                <img class="img-fluid w-25 mr-3" src="<?php echo base_url() ?>assets/img/shipping.png" alt="">
                <h5 class="font-weight-semi-bold m-0">Free Shipping</h5>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-6">
            <div class="d-flex align-items-center bg-light mb-4" style="padding: 25px;">
                <!-- <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1> -->
                <img class="img-fluid w-25 mr-3" src="<?php echo base_url() ?>assets/img/price.png" alt="">
                <h5 class="font-weight-semi-bold m-0">Lowest Price</h5>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-6">
            <div class="d-flex align-items-center bg-light mb-4" style="padding: 25px;">
                <!-- <h1 class="fa fa-check text-primary m-0 mr-3"></h1> -->
                <img class="img-fluid w-25 mr-3" src="<?php echo base_url() ?>assets/img/quality.png" alt="">
                <h5 class="font-weight-semi-bold m-0">Quality Product</h5>
            </div>
        </div>
    </div>
</div>
<!-- Featured End -->

<!-- Products Start -->
<section style="background-image: url('assets/img/pattern.png');">
    <div class="container-fluid pt-5 pb-3">
        <h4 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3"><?php
                                                                                                                $recent = $this->db->select('*')->where('m_offer_status', 1)->where('m_offer_id', 2)->get('master_offers')->result();

                                                                                                                echo $recent[0]->m_offer_maintitle; ?></span></h4>

        <div class="row px-xl-5">

            <?php foreach ($product_recent as $value) :

                $totalreview = $this->db->where('m_review_produ_id', $value->m_product_id)->get('master_review_tbl')->num_rows();

                $average_rating1 = $this->Main_model->getAverageRating($value->m_product_id);

                $image =  $this->db->where('m_image_product_id', $value->m_product_id)->where('m_image_status', 1)->get('master_image_tbl')->result();
                // print_r($image);

                if (!empty($image[0]->m_image_product_img)) {
                    $product_img = base_url('admin/uploads/product/' . $image[0]->m_image_product_img);
                } else {
                    $product_img = base_url('admin/uploads/default.jpg');
                }
            ?>
                <input type='hidden' id='qty<?php echo $value->m_product_id; ?>' value='1'>
                <input type="hidden" id="color<?php echo $value->m_product_id; ?>" value='<?php echo $value->m_color_id; ?>'>
                <input type="hidden" id="size<?php echo $value->m_product_id; ?>" value="<?php echo $value->m_size_id; ?>">
                <div class="col-lg-3 col-md-4 col-sm-6 pb-1 col-6">
                    <div class="product-item bg-light mb-4">
                        <div class="product-img position-relative overflow-hidden">
                            <a href="<?php echo base_url('Product/product_details/' . $value->m_product_id . '/' . $value->m_category_slug);  ?>"> <img class="img-fluid w-100 msize" src="<?php echo $product_img ?>" alt=""></a>
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square add_to_cart" href="javascript:void(0)" data-tippy="Add to cart" data-productid='<?php echo $value->m_product_id; ?>' data-productname='<?= $value->m_product_name; ?>' data-price='<?php echo $value->m_product_seles_price  ?>'><i class="fa fa-shopping-cart"></i></a>

                                <?php if (!empty($this->session->userdata('is_customer_in'))) {
                                    $check_cust_id = $this->session->userdata('m_customer_id');
                                } else {
                                    $check_cust_id = 0;
                                }

                                $this->db->where('m_wishlist_product_id', $value->m_product_id);
                                $this->db->where('m_wishlist_user_id', $check_cust_id);
                                $check_wish = $this->db->get('master_wishlist')->result();


                                ?>
                                <?php if (!empty($check_wish)) { ?>

                                    <a class="btn btn-outline-dark btn-square" href='javascript:void(0)' id='wish_col<?php echo $value->m_product_id; ?>' onclick='setWish(<?php echo $check_cust_id . ',' . $value->m_product_id; ?>)' style="background: red;"><i class="far fa-heart"></i></a>
                                    <input type='hidden' id='wish_id<?php echo $value->m_product_id; ?>' value='1'>

                                <?php } else { ?>


                                    <a class="btn btn-outline-dark btn-square" href='javascript:void(0)' id='wish_col<?php echo $value->m_product_id; ?>' onclick='setWish(<?php echo $check_cust_id . ',' . $value->m_product_id; ?>)'><i class="far fa-heart"></i></a>
                                    <input type='hidden' id='wish_id<?php echo $value->m_product_id; ?>' value='0'>
                                <?php } ?>
                                <a class="btn btn-outline-dark btn-square" href="<?php echo base_url('Product/product_details/' . $value->m_product_id . '/' . $value->m_category_slug);  ?>"><i class="fas fa-eye"></i></a>

                                <!-- <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
<a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a> -->
                            </div>
                        </div>
                        <div class="clr button p-1" style="background-color: #000000a1;">
                            <div class="row d-flex justify-content-end align-items-center">
                                <div class="col-md-6">
                                    <h6 class="text-white m-0 text-center"> Size -<?php echo $value->m_size_name ?> &nbsp; &nbsp;</h6>
                                </div>
                                <div class="col-md-6 d-flex justify-content-center">
                                    <p class="m-0 text-center" style="width: 15px; height:15px; border:2px solid #000; background-color:<?php echo $value->m_color_name ?>"></p>
                                </div>
                            </div>
                        </div>

                        <div class="text-center py-4" style="height: 150px;">
                            <a class="h6 text-decoration-none text-truncate" href="<?php echo base_url('Product/product_details/' . $value->m_product_id . '/' . $value->m_category_slug);  ?>"><?php echo $value->m_product_name;  ?></a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h6>₹<?php echo round($value->m_product_seles_price, 3); ?></h6>
                                <h6 class="text-muted ml-2 mvc"><del>₹<?php echo round($value->m_product_mrp, 3); ?></del></h6>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1 text-info">
                                <?php
                                $averageRating = $average_rating1; // Assuming $average_rating is set in your controller

                                // Generate stars based on the average rating
                                for ($i = 1; $i <= 5; $i++) {
                                    $starClass = $i <= $averageRating ? 'fa fa-star mr-1' : 'fa fa-star-o mr-1';
                                    echo '<small class="' . $starClass . '"></small>';
                                }
                                ?>
                                <small>(<?= $totalreview ?>)</small>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>
<!-- Products End -->



<?php include("footer.php"); ?>
<?php include("script.php"); ?>
<?php $this->view('js/master_js'); ?>
<?php $this->view('js/cart_js'); ?>
<script>
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        autoplay: true,
        autoplayTimeout: 2000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 3
            },
            600: {
                items: 4
            },
            1000: {
                items: 5
            }
        }
    })
</script>