<?php include("head.php"); ?>
<?php include("header.php"); ?>
  <style>
       

        .color-option {
            /* Your styles for color options */
            margin-right: 10px;
            cursor: pointer;
        }

        .color-option.active {
            /* Your styles for active color */
            border: 2px solid #000;
            background-color: #a01074;
            color: #fff;

        }

         .size-option {
            /* Your styles for color options */
            margin-right: 10px;
            cursor: pointer;
        }

        .size-option.active {
            /* Your styles for active color */
            border: 2px solid #000;
            background-color: #a01074;
            color: #fff;
            
        }
    </style>

<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="<?php echo base_url('Welcome');  ?>">Home</a>
                <a class="breadcrumb-item text-dark" href="<?php echo base_url('Product');  ?>">Product</a>
                <span class="breadcrumb-item active">Product Details</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<?php


// $image = $this->db->where('m_image_product_id', $product_details[0]->m_product_id)->get('master_image_tbl')->result();

// print_r($image);die();



?>


<!-- Shop Detail Start -->
<div class="container-fluid pb-5">
    <div class="row px-xl-5">
        <div class="col-lg-4 mb-30">
            <div id="product-carousel" class="carousel slide" data-ride="carousel">
               <div class="carousel-inner bg-light">
    <?php foreach ($product_details[0]->m_product_image as $index => $image): ?>
        <?php
        if (!empty($image->m_image_product_img) && file_exists('admin/uploads/product/' . $image->m_image_product_img)) {
            $product_img = base_url('admin/uploads/product/' . $image->m_image_product_img);
        } else {
            $product_img = base_url('admin/uploads/default.jpg');
        }

        $active_class = $index === 0 ? 'active' : '';
        ?>
        <div class="carousel-item <?= $active_class ?>">
            <img class="w-75 h-100 m-auto d-block" src="<?php echo $product_img; ?>" alt="Image">
        </div>
    <?php endforeach; ?>
</div>
                <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                    <i class="fa fa-2x fa-angle-left text-dark"></i>
                </a>
                <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                    <i class="fa fa-2x fa-angle-right text-dark"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-5 h-auto mb-30">
            <div class="h-100 bg-light p-30">
                <h3><?php echo $product_details[0]->m_product_name; ?></h3>
                <div class="d-flex mb-3">
                    <div class="text-info mr-2">
                        <?php $totalreview = $this->db->where('m_review_produ_id', $id)->get('master_review_tbl')->num_rows(); ?>

                        <?php
                        $averageRating = $average_rating; // Assuming $average_rating is set in your controller

                        // Generate stars based on the average rating
                        for ($i = 1; $i <= 5; $i++) {
                            $starClass = $i <= $averageRating ? 'fa fa-star mr-1' : 'fa fa-star-o mr-1';
                            echo '<small class="' . $starClass . '"></small>';
                        }
                        ?>
                    </div>
                    <small class="pt-1">(<?= $totalreview ?>)</small>
                </div>
                 <div class="font-weight-semi-bold d-flex align-items-center">
                                <h5>₹<?php echo round($product_details[0]->m_product_seles_price, 3); ?></h5>
                                <h6 class="text-muted ml-2 mvc"><del>₹<?php echo round($product_details[0]->m_product_mrp, 3); ?></del></h6>
                            </div>
                <!-- <h3 class="font-weight-semi-bold">₹<?php echo round($product_details[0]->m_product_seles_price, 3); ?><h3 class="text-muted ml-2 mvc"><del>₹<?php echo round($product_details[0]->m_product_mrp, 3); ?></del></h3></h3> -->
                            
                <span class="badge badge-pill badge-secondary mb-4 mt-2 p-2 bp"> Free Delivery</span>
                <p class="mb-4"><?php echo $product_details[0]->m_product_des; ?></p>
            <div class="d-flex mb-3">
    <strong class="text-dark mr-3 mt-2">Sizes:</strong>
       <input type="hidden" id="size<?php echo $product_details[0]->m_product_id; ?>" value="<?php echo $product_details[0]->m_product_size[0]->m_size_id; ?>">
    <form>
        <?php foreach ($product_details[0]->m_product_size as $index => $size): ?>
            <div class="custom-control1 custom-radio ">
                <span class="psize size-option <?php echo $index === 0 ? 'active' : ''; ?>"
                      data-size-id="<?php echo $size->m_size_id; ?>">
                    <input type="radio" id="size_value<?php echo $product_details[0]->m_product_id; ?>" value="<?php echo $size->m_size_id; ?>" hidden
                           <?php echo $index === 0 ? 'checked' : ''; ?>>
                    <label for="size<?php echo $size->m_size_id; ?>">
                        <span class="fb"><?php echo $size->m_size_name; ?></span>
                    </label>
                </span>
            </div>
        <?php endforeach; ?>
    </form>
</div>

<div class="d-flex mb-4">
    <strong class="text-dark mr-3 mt-2">Colors:</strong>
    <input type="hidden" id="color<?php echo $product_details[0]->m_product_id; ?>" value="<?php echo $product_details[0]->m_product_color[0]->m_color_id; ?>">
    <div class="color-options d-flex">
        <?php foreach ($product_details[0]->m_product_color as $index => $color): ?>
            <span class="psize color-option <?php echo $index === 0 ? 'active' : ''; ?>"
                  data-color-id="<?php echo $color->m_color_id; ?>">
                <input type="hidden" id="color_value<?php echo $product_details[0]->m_product_id; ?>" value="<?php echo $color->m_color_id; ?>" <?php echo $index === 0 ? 'checked' : ''; ?>>
                <span class="fb"><?php echo $color->m_color_name; ?></span>
            </span>
        <?php endforeach; ?>
    </div>
</div>
                <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group qtySelector mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-sm btn-primary decreaseQty" data-rowid="<?php echo $product_details[0]->m_product_id; ?>">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center increaseNo" id="qty<?php echo $product_details[0]->m_product_id; ?>" value="1">
                            <div class="input-group-btn">
                                <button class="btn btn-sm btn-primary increaseQty" data-rowid="<?php echo $product_details[0]->m_product_id; ?>">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>

                   <!--  <div class="input-group quantity mr-3" style="width: 130px;">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-minus">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control bg-secondary border-0 text-center" value="1">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-plus">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div> -->
                    <!-- <a href="<?php echo base_url('Cart') ?>"><button class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Add To
                            Cart</button></a> -->

                            <a class="add_to_cart" href="javascript:void(0)"
                               data-tippy="Add to cart" data-productid='<?php echo $product_details[0]->m_product_id ;?>'
                               data-productname='<?=$product_details[0]->m_product_name ;?>' data-price='<?php echo $product_details[0]->m_product_seles_price ?>'><button class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Add To
                            Cart</button>
                              
                            </a>
                </div>
                <div class="d-flex pt-2">
                    <strong class="text-dark mr-2">Share on:</strong>
                    <div class="d-inline-flex">
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 mb-30">
            <div class="h-100 bg-light p-30">
                <img src="<?php echo base_url() ?>assets/img/fashion-dark.jpg" alt="Fashion logo" class="w-100 m-auto d-block">
                <p class="mb-4 mt-3 justi">Fashion Lane, a term that resonates with style enthusiasts and trend seekers alike, embodies the dynamic intersection of creativity, culture, and commerce within the realm of fashion.</p>
                <h5>Delivery Details</h5>
                <p style="font-size: 14px;"><i class="fas fa-truck"></i> Expect your delivery between 5 and 7 days <br>
                    <i class="fas fa-exchange-alt"></i> Hassle free 7, 15 and 30 days return
                </p>
            </div>
        </div>

    </div>
    <div class="row px-xl-5">
        <div class="col-md-9">

            <div class="bg-light p-30">
                <div class="nav nav-tabs mb-4">
                    <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Details</a>
                    <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-2">Information</a>
                    <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">Reviews (<?= $totalreview; ?>)</a>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-pane-1">
                        <h4 class="mb-3">Product Details</h4>
                        <p class="pd"><?php echo  $product_details[0]->m_product_details; ?></p>
                    </div>
                    <div class="tab-pane fade" id="tab-pane-2">
                        <h4 class="mb-3">Product Information</h4>
                        <p class="pd"><?php echo  $product_details[0]->m_product_information; ?></p>
                        <!-- <h4 class="mb-3">Contact Information</h4> -->
                        <!-- <p>India</p> -->
                        <!-- <div class="row">
                            <div class="col-md-6">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item px-0">
                                        <h6>Manufacturer Information</h6>
                                        xyz
                                    </li>
                                    <li class="list-group-item px-0">
                                        <h6>Net Weight(g)</h6>
                                        xyz
                                    </li>
                                    <li class="list-group-item px-0">
                                        <h6>Supplier Information</h6>
                                        xyz
                                    </li>


                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item px-0">
                                        <h6>Importer Information</h6>
                                        xyz
                                    </li>
                                    <li class="list-group-item px-0">
                                        <h6>Packer Information</h6>
                                        xyz
                                    </li>
                                </ul>
                            </div>
                        </div> -->
                    </div>


                    <div class="tab-pane fade" id="tab-pane-3">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="mb-4"><?= $totalreview; ?> review for "<?php echo  $product_details[0]->m_product_name; ?>"</h4>

                                <?php foreach ($all_review as  $value) :

                                    $average_rating1 = $this->Main_model->getAverageRatinguser($value->m_acc_id);

                                    if (!empty($value->m_acc_image) && file_exists('admin/uploads/user/' . $value->m_acc_image)) {
                                        $user_img = base_url('admin/uploads/user/' . $value->m_acc_image);
                                    } else {
                                        $user_img = base_url('admin/assets/imgs/user.png');
                                    }

                                ?>
                                    <div class="media mb-4">
                                        <img src="<?php echo $user_img ?>" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                        <div class="media-body">
                                            <h6><?= $value->m_acc_name ?><small> - <i><?php echo date('d M Y', strtotime($value->m_review_added_on)); ?></i></small></h6>
                                            <div class="text-info mb-2">

                                                <?php
                                                $averageRating = $average_rating1; // Assuming $average_rating is set in your controller

                                                // Generate stars based on the average rating
                                                for ($i = 1; $i <= 5; $i++) {
                                                    $starClass = $i <= $averageRating ? 'fa fa-star mr-1' : 'fa fa-star-o mr-1';
                                                    echo '<small class="' . $starClass . '"></small>';
                                                }
                                                ?>
                                                <!--  <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="far fa-star"></i> -->
                                            </div>
                                            <p><?php echo $value->m_review_des; ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="col-md-6">
                                <h4 class="mb-4">Leave a review</h4>
                                <small>Your email address will not be published. Required fields are marked *</small>
                                <div class="d-flex my-3">
                                    <p class="mb-0 mr-2">Your Rating * :</p>
                                    <div class="text-info">
                                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                                            <i class="far fa-star" onclick="toggleStar(this, <?= $i ?>)"></i>
                                        <?php endfor; ?>
                                        <!--  <i class="far fa-star" value="1" onclick="yourOnClickFunction(this)"></i>
                                        <i class="far fa-star"  onclick="yourOnClickFunction(2)"></i>
                                        <i class="far fa-star"  onclick="yourOnClickFunction(3)"></i>
                                        <i class="far fa-star"  onclick="yourOnClickFunction(4)"></i>
                                        <i class="far fa-star"  onclick="yourOnClickFunction(5)"></i> -->
                                    </div>
                                </div>
                                <form method="post" id="form_review_add">
                                    <div class="form-group">
                                        <label for="message">Your Review *</label>
                                        <textarea id="message" cols="30" name="review_msg" rows="5" class="form-control" required></textarea>
                                    </div>
                                    <input type="hidden" id="selected-star" name="selected_star" value="0">

                                    <input type="hidden" class="form-control" id="uid" name="user" value="<?php echo $this->session->userdata('m_customer_id'); ?>">
                                    <input type="hidden" class="form-control" id="pid" name="product" value="<?php echo $id; ?>">
                                    <!-- <div class="form-group">
                                        <label for="name">Your Name *</label>
                                        <input type="text" class="form-control" id="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Your Email *</label>
                                        <input type="email" class="form-control" id="email">
                                    </div> -->
                                    <div class="form-group mb-0">

                                        <?php
                                        if (!empty($this->session->userdata('m_customer_id'))) {
                                        ?>
                                            <input type="submit" value="Leave Your Review" id="btn_review_add" class="btn btn-primary  px-3">


                                        <?php
                                        } else {
                                        ?>
                                            <input type="button" value="Leave Your Review" class="btn btn btn-primary disabled  px-3">
                                        <?php
                                        }
                                        ?>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class=" bg-light p-30">
                <h5 class="mb-3">Featured Products</h5>
                <hr>
                <div class="row mt-3">
                    <?php 
                    foreach($pfeatured as $value){ 

                        $image = $this->db->where('m_image_product_id', $value->m_product_id)->get('master_image_tbl')->result();

                        
                         if (!empty($image[0]->m_image_product_img) && file_exists('admin/uploads/product/' . $image[0]->m_image_product_img)) {
                            $product_img = base_url('admin/uploads/product/' . $image[0]->m_image_product_img);
                        } else {
                            $product_img = base_url('admin/uploads/default.jpg');
                        }


                        ?>
                    <div class="col-4 mb-2">
                        <a href="<?php echo base_url('Product?offer=' . $value->m_offer_id);  ?>"><img src="<?php echo $product_img ?>" alt="" class="w-100"></a>
                    </div>
                    <div class="col-8">
                        <a href="<?php echo base_url('Product?offer=' . $value->m_offer_id);  ?>"><h6 class="m-0 mt-3"><?php echo $value->m_product_name ?></h6>
                        <!-- <p class="m-0">1 Item</p> -->
                        <p class="m-0">₹<?php echo $value->m_product_mrp ?></p></a>
                    </div>
                <?php } ?>
                    
                    <!-- <div class="col-4 mb-2">
                        <img src="<?php echo base_url() ?>assets/img/kurta.jpg" alt="" class="w-100">
                    </div>
                    <div class="col-8">
                        <h6 class="m-0 mt-3">Cotton Kurta Set</h6>
                        <p class="m-0">1 Item</p>
                        <p class="m-0">₹300</p>
                    </div>

                    <div class="col-4 mb-2">
                        <img src="<?php echo base_url() ?>assets/img/kurta.jpg" alt="" class="w-100">
                    </div>
                    <div class="col-8">
                        <h6 class="m-0 mt-3">Cotton Kurta Set</h6>
                        <p class="m-0">1 Item</p>
                        <p class="m-0">₹300</p>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Shop Detail End -->


<!-- Products Start -->
<div class="container-fluid py-5">
    <h4 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also Like</span></h4>
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel related-carousel">

                <?php


                 foreach ($releted_product as $value) :

                    $totalreview = $this->db->where('m_review_produ_id', $value->m_product_id)->get('master_review_tbl')->num_rows();

                    $average_rating1 = $this->Main_model->getAverageRating($value->m_product_id);

                    $image =  $this->db->where('m_image_product_id', $value->m_product_id)->where('m_image_status', 1)->get('master_image_tbl')->result();

                    if (!empty($image[0]->m_image_product_img)) {
                        $product_img = base_url('admin/uploads/product/' . $image[0]->m_image_product_img);
                    } else {
                        $product_img = base_url('admin/uploads/default.jpg');
                    }
                ?>
                    <div class="product-item bg-light">
                        <div class="product-img position-relative overflow-hidden">
                            <img class=" msize" src="<?php echo $product_img ?>" alt="">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square add_to_cart" href="javascript:void(0)"
                               data-tippy="Add to cart" data-productid='<?php echo $product_details[0]->m_product_id ;?>'
                               data-productname='<?=$product_details[0]->m_product_name ;?>' data-price='<?php echo $product_details[0]->m_product_mrp ?>'><i class="fa fa-shopping-cart"></i></a>
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
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="<?php echo base_url('Product/product_details/' . $value->m_product_id . '/' . $value->m_category_slug);  ?>"><?php echo $value->m_product_name; ?></a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>₹<?php echo round($value->m_product_mrp, 3); ?></h5>
                                <h6 class="text-muted ml-2"><del>₹<?php echo round($value->m_product_mrp, 3); ?></del></h6>
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
                <?php endforeach; ?>

            </div>
        </div>
    </div>
</div>
<!-- Products End -->

<!-- <section>
    <div class="container-fluid">
        <div class="card pdcard p-4">
            <h4>More About Fashion Lane</h4>
            <hr>
            <a href="<?php echo base_url('Welcome') ?>">
                <h5 class="more mb-4">Online Shopping</h5>
            </a>

            <?php foreach ($all_category as $category) : ?>
                <?php if ($category->m_pcategory_id == 0) : ?>

                    <h6><?php echo $category->m_category_name ?> | Shop Now</h6>

                    <?php foreach ($all_category as $sub_category) : ?>
                        <?php if ($sub_category->m_pcategory_id == $category->m_category_id) : ?>
                            <a href="#"><?= $sub_category->m_category_name ?></a>
                        <?php endif; ?>
                    <?php endforeach; ?>

                <?php endif; ?>
            <?php endforeach; ?>

        </div>
    </div>
</section> -->

<?php include("footer.php"); ?>
<?php include("script.php"); ?>
<?php $this->view('js/master_js');  ?>
<?php $this->view('js/cart_js');  ?>

<script>
    function toggleStar(element, starNumber) {
        // Toggle the "checked" class on click
        element.classList.toggle('fas');
        element.classList.toggle('far');

        // Update the hidden input field with the selected star value
        document.getElementById('selected-star').value = element.classList.contains('fas') ? starNumber : 0;

        // Your additional JavaScript logic here
        if (element.classList.contains('fas')) {
            // alert('Star ' + starNumber + ' checked!');
            // Perform actions when the star is checked
        } else {
            // alert('Star ' + starNumber + ' unchecked!');
            // Perform actions when the star is unchecked
        }
    }


</script>
<script type="text/javascript">
  $(document).ready(function() {


    var minVal = 1, maxVal = 100; 
    $(".increaseQty").on('click', function(){
    // alert('hello');
    var row_id = $(this).data("rowid");

        var $parentElm = $(this).parents(".qtySelector");
        $(this).addClass("clicked");
        setTimeout(function(){
            $(".clicked").removeClass("clicked");
        },100);
        var value = $parentElm.find("#qty"+row_id).val();
        if (value < maxVal) {
            value++;
        }
        $parentElm.find("#qty").val(value);
        $(".increaseNo").attr('value', value);
});

$(".decreaseQty").on('click', function(){
    var row_id = $(this).data("rowid");
        var $parentElm = $(this).parents(".qtySelector");
        $(this).addClass("clicked");
        setTimeout(function(){
            $(".clicked").removeClass("clicked");
        },100);
        var value = $parentElm.find("#qty"+row_id).val();
        if (value > 1) {
            value--;
        }
        $parentElm.find("#qty").val(value);
        $(".increaseNo").attr('value', value);
    });

  });

</script>

<script>
    // jQuery script for toggling selected and active states
    $(document).ready(function () {
        $('.size-option').on('click', function () {
            $('.size-option').removeClass('active');
            $(this).addClass('active');
            var selectedSize = $(this).data('size-id');
            $("#size<?php echo $product_details[0]->m_product_id; ?>").val(selectedSize);
        });

        $('.color-option').on('click', function () {
            $('.color-option').removeClass('active');
            $(this).addClass('active');
            var selectedColor = $(this).data('color-id');
            $("#color<?php echo $product_details[0]->m_product_id; ?>").val(selectedColor);
        });
    });
</script>





