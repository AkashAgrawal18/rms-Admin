<style>
    .pagination strong {
        background-color: #a0107463;
        padding: 12px;
        color: #000;
        border-radius: 10px;
        margin-right: 10px;
    }
    .pagination a {
        background-color: #a0107463;
        padding: 12px;
        color: #000;
        border-radius: 10px;
        margin-right: 10px;
        font-weight: bold;
    }
</style>


<?php include("head.php"); ?>
<?php include("header.php"); ?>

<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="<?php echo base_url('Welcome'); ?>">Home</a>
                <a class="breadcrumb-item text-dark" href="<?php echo base_url('Product'); ?>">Product</a>
                <span class="breadcrumb-item active">Product List</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Shop Sidebar Starts -->
<div class="col-lg-12 col-md-12 filter">
    <div class="container-fluid d-md-none d-block" style="padding-right: 0px; padding-left: 0px;">
        <div class="card p-3">
            <div class="row">
                <div class="col-3">
                    <div class="d-flex align-items-center bg-light">
                        <p class="text-center font-weight-semi-bold m-0 dropdown-toggle" data-toggle="modal" data-target="#price">Filter by Price</p>
                    </div>
                </div>
                <div class="col-3">
                    <div class="d-flex align-items-center bg-light text-center">
                        <p class="text-center font-weight-semi-bold m-0 dropdown-toggle" data-toggle="modal" data-target="#color">Filter by Color</p>
                    </div>
                </div>
                <div class="col-3">
                    <div class="d-flex align-items-center bg-light text-center">
                        <p class="text-center font-weight-semi-bold m-0 dropdown-toggle" data-toggle="modal" data-target="#size">Filter by Size</p>
                    </div>
                </div>
                <div class="col-3">
                    <div class="d-flex align-items-center bg-light text-center">
                        <p class="text-center font-weight-semi-bold m-0 dropdown-toggle" data-toggle="modal" data-target="#fabric">Filter by Fabric</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Shop Sidebar End -->
<!-- Shop Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4 d-none d-md-block">
            <!-- Price Start -->
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by price</span></h5>
            <div class="bg-light p-5 mb-30">
                <form>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" checked id="price-all">
                        <label class="custom-control-label" for="price-all">All Price</label>
                        <span class="badge border font-weight-normal">1000</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-1">
                        <label class="custom-control-label" for="price-1">₹500 ₹500</label>
                        <span class="badge border font-weight-normal">150</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-2">
                        <label class="custom-control-label" for="price-2">₹500 - ₹500</label>
                        <span class="badge border font-weight-normal">295</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-3">
                        <label class="custom-control-label" for="price-3">₹500 - ₹500</label>
                        <span class="badge border font-weight-normal">246</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-4">
                        <label class="custom-control-label" for="price-4">₹500 - ₹500</label>
                        <span class="badge border font-weight-normal">145</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                        <input type="checkbox" class="custom-control-input" id="price-5">
                        <label class="custom-control-label" for="price-5">₹500 - ₹500</label>
                        <span class="badge border font-weight-normal">168</span>
                    </div>
                </form>
            </div>
            <!-- Price End -->

            <!-- Color Start -->
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by color</span></h5>
            <div class="bg-light p-5 mb-30">
                <form id="filterForm" action="<?php echo base_url('product'); ?>" method="post">
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input color-checkbox" id="color-0" <?php if ($color == '') echo 'checked'; ?> name="color" value="">
                        <label class="custom-control-label" for="color-0">All Color</label>
                        <span class="badge border font-weight-normal"><?php $ctproduct1 = $this->db->where('m_product_color >', 0)->get('master_product')->num_rows();
                              echo $ctproduct1
                             ?></span>
                    </div>

                    <?php foreach ($all_color as $value) :
                        
                       $tproduct = $this->db->where("FIND_IN_SET($value->m_color_id, m_product_color) >", 0)->get('master_product')->num_rows();

                           
                        ?>

                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input color-checkbox" id="color-<?php echo $value->m_color_id; ?>" <?php if($color == $value->m_color_id){?> checked <?php }else{ ?> <?php } ?> value="<?php echo $value->m_color_id; ?>" name="color">
                        <label class="custom-control-label" for="color-<?php echo $value->m_color_id; ?>"><?php echo $value->m_color_name; ?></label>
                        <span class="badge border font-weight-normal"><?=$tproduct?></span>
                    </div>
                        <?php endforeach; ?>
                  
                </form>
            </div>
            <!-- Color End -->

            <!-- Size Start -->
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by size</span></h5>
            <div class="bg-light p-5 mb-30">
                <form id="filterForm1" action="<?php echo base_url('product'); ?>" method="post">
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input size-checkbox" id="size-0" <?php if ($size == '') echo 'checked'; ?> name="size" value="">
                        <label class="custom-control-label" for="size-0">All Size</label>
                        <span class="badge border font-weight-normal">
                            <?php $stproduct1 = $this->db->where('m_product_size >', 0)->get('master_product')->num_rows();
                              echo $stproduct1
                             ?>
                        </span>
                    </div>
                      <?php foreach ($all_size as $value) :

                       $tproduct = $this->db->where("FIND_IN_SET($value->m_size_id, m_product_size) >", 0)->get('master_product')->num_rows();

                           
                        ?>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input size-checkbox" id="size-<?php echo $value->m_size_id; ?>" <?php if($size == $value->m_size_id){?> checked <?php }else{ ?> <?php } ?> name="size"
                          value="<?php echo $value->m_size_id; ?>">
                        <label class="custom-control-label" for="size-<?php echo $value->m_size_id; ?>"><?php echo $value->m_size_name; ?></label>
                        <span class="badge border font-weight-normal"><?=$tproduct?></span>
                    </div>
                    <?php endforeach; ?>
                   
                </form>
            </div>
            <!-- Size End -->
            <!-- fabric Start -->
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by fabric</span></h5>
            <div class="bg-light p-5 mb-30">
                <form id="filterForm2" action="<?php echo base_url('product'); ?>" method="post">
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input fabric-checkbox" id="fabric-0" <?php if ($fabric == '') echo 'checked'; ?> name="fabric" value="">
                        <label class="custom-control-label" for="fabric-0">All fabric</label>
                        <span class="badge border font-weight-normal"><?php $ftproduct1 = $this->db->where('m_product_fabric >', 0)->get('master_product')->num_rows();
                              echo $ftproduct1
                             ?></span>
                    </div>
                    
                     <?php foreach ($all_fabric as $value) :

                       $tproduct = $this->db->where("FIND_IN_SET($value->m_fabric_id, m_product_fabric) >", 0)->get('master_product')->num_rows();

                           
                        ?>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input fabric-checkbox" id="fabric-<?php echo $value->m_fabric_id; ?>" value="<?php echo $value->m_fabric_id; ?>" <?php if($fabric == $value->m_fabric_id){?> checked <?php }else{ ?> <?php } ?> name="fabric">
                        <label class="custom-control-label" for="fabric-<?php echo $value->m_fabric_id; ?>"><?php echo $value->m_fabric_name; ?></label>
                        <span class="badge border font-weight-normal"><?=$tproduct?></span>
                    </div>
                        <?php endforeach; ?>
                  
                </form>
            </div>
            <!-- fabric End -->
        </div>
        <!-- Shop Sidebar End -->







        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-8 pt-3">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <!-- <div>
                            <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                            <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                        </div> -->
                        <div class="ml-2">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Sorting</button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">Latest</a>
                                    <a class="dropdown-item" href="#">Popularity</a>
                                    <a class="dropdown-item" href="#">Best Rating</a>
                                </div>
                            </div>
                            <div class="btn-group ml-2">
                                <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Showing</button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">10</a>
                                    <a class="dropdown-item" href="#">20</a>
                                    <a class="dropdown-item" href="#">30</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        <?php foreach ($all_product as $value) :
                $totalreview = $this->db->where('m_review_produ_id',$value->m_product_id)->get('master_review_tbl')->num_rows();
                $average_rating1 = $this->Main_model->getAverageRating($value->m_product_id);

         $image =  $this->db->where('m_image_product_id',$value->m_product_id)->where('m_image_status',1)->get('master_image_tbl')->result();

        if (!empty($image[0]->m_image_product_img)) {
            $product_img = base_url('admin/uploads/product/'.$image[0]->m_image_product_img);
          } else {
            $product_img = base_url('admin/uploads/default.jpg');
          }

                    
                ?>
                 <input type='hidden' id='qty<?php echo $value->m_product_id ;?>' value='1'>
                 <input type="hidden" id="color<?php echo $value->m_product_id; ?>" value='0'>
                  <input type="hidden" id="size<?php echo $value->m_product_id; ?>" value='0' >
                    <div class="col-lg-4 col-md-6 col-sm-6 col-6 pb-1">
                        <div class="product-item bg-light mb-4">

                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100 msize" src="<?php echo $product_img ?>" alt="">
                                <div class="product-action">

                    <a class="btn btn-outline-dark btn-square add_to_cart" href="javascript:void(0)"  data-tippy="Add to cart" data-productid='<?php echo $value->m_product_id ;?>' data-productname='<?=$value->m_product_name ;?>' data-price='<?php echo $value->m_product_mrp  ?>'  ><i class="fa fa-shopping-cart"></i></a>

                            <?php if(!empty($this->session->userdata('is_customer_in'))) {
                                  $check_cust_id = $this->session->userdata('m_customer_id');
                                 } else {
                                    $check_cust_id = 0;
                                } 
                            
                             $this->db->where('m_wishlist_product_id', $value->m_product_id);
                             $this->db->where('m_wishlist_user_id', $check_cust_id);
                             $check_wish = $this->db->get('master_wishlist')->result();


                                ?>
                                 <?php if (!empty($check_wish)){?>

                                    <a class="btn btn-outline-dark btn-square" href='javascript:void(0)' id='wish_col<?php echo $value->m_product_id; ?>' onclick='setWish(<?php echo $check_cust_id . ',' . $value->m_product_id; ?>)' style="background: red;" ><i class="far fa-heart"></i></a>
                                    <input type='hidden' id='wish_id<?php echo $value->m_product_id; ?>' value='1'>

                                  <?php }else{ ?>


                                    <a class="btn btn-outline-dark btn-square" href='javascript:void(0)' id='wish_col<?php echo $value->m_product_id; ?>' onclick='setWish(<?php echo $check_cust_id . ',' . $value->m_product_id; ?>)'  ><i class="far fa-heart"></i></a>
                                        <input type='hidden' id='wish_id<?php echo $value->m_product_id; ?>' value='0'>
                                    <?php }?>
                                
                                    <!-- <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a> -->
                                    <!-- <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a> -->
                                <a class="btn btn-outline-dark btn-square" href="<?php echo base_url('Product/product_details/' . $value->m_product_id . '/' . $value->m_category_slug);  ?>"><i class="fas fa-eye"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="<?php echo base_url('Product/product_details/' . $value->m_product_id . '/' . $value->m_category_slug);  ?>"><?php echo $value->m_product_name;  ?></a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>₹<?php echo round($value->m_product_mrp, 3); ?></h5>
                                    <!-- <h6 class="text-muted ml-2"><del>₹500.00</del> <span class="badge bp badge-secondary p-2"> Free Delivery</span></h6> -->
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
                                    <small>(<?=$totalreview;?>)</small>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

              
                <div class="col-12">

                    <nav>
                        <ul class="pagination justify-content-center">
                            <?php echo $this->pagination->create_links(); ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
<!-- Shop End -->
<!-- <section>
    <div class="container-fluid py-4">
        <div class="card pdcard p-4">
            <h4>More About Fashion Lane</h4>
            <hr>
            <a href="<?php echo base_url('Welcome') ?>">
                <h5 class="more mb-4">Online Shopping</h5>
            </a>

           <?php foreach ($all_category as $category): ?>
                 <?php if ($category->m_pcategory_id == 0): ?>

            <h6><?php echo $category->m_category_name ?> | Shop Now</h6>

              <?php foreach ($all_category as $sub_category): ?>
                <?php if ($sub_category->m_pcategory_id == $category->m_category_id): ?>
            <a href="#"><?= $sub_category->m_category_name ?></a>
               <?php endif; ?>
             <?php endforeach; ?>

              <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section> -->

<!-- Modal 1 -->
<div class="modal fade" id="price" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Filter by Price</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-5">
                <form>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" checked id="price-all">
                        <label class="custom-control-label" for="price-all">All Price</label>
                        <span class="badge border font-weight-normal">1000</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-1">
                        <label class="custom-control-label" for="price-1">₹500 ₹500</label>
                        <span class="badge border font-weight-normal">150</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-2">
                        <label class="custom-control-label" for="price-2">₹500 - ₹500</label>
                        <span class="badge border font-weight-normal">295</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-3">
                        <label class="custom-control-label" for="price-3">₹500 - ₹500</label>
                        <span class="badge border font-weight-normal">246</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-4">
                        <label class="custom-control-label" for="price-4">₹500 - ₹500</label>
                        <span class="badge border font-weight-normal">145</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                        <input type="checkbox" class="custom-control-input" id="price-5">
                        <label class="custom-control-label" for="price-5">₹500 - ₹500</label>
                        <span class="badge border font-weight-normal">168</span>
                    </div>
                </form>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
        </div>
    </div>
</div>

<!-- Modal 2-->
<div class="modal fade" id="color" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Filter by Color</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-5">
               <form id="filterForm" action="<?php echo base_url('product'); ?>" method="post">
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input color-checkbox" id="color-0" <?php if ($color == '') echo 'checked'; ?> name="color" value="">
                        <label class="custom-control-label" for="color-0">All Color</label>
                        <span class="badge border font-weight-normal"><?php $ctproduct1 = $this->db->where('m_product_color >', 0)->get('master_product')->num_rows();
                              echo $ctproduct1
                             ?></span>
                    </div>

                    <?php foreach ($all_color as $value) :
                        
                       $tproduct = $this->db->where("FIND_IN_SET($value->m_color_id, m_product_color) >", 0)->get('master_product')->num_rows();

                           
                        ?>

                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input color-checkbox" id="color-<?php echo $value->m_color_id; ?>" <?php if($color == $value->m_color_id){?> checked <?php }else{ ?> <?php } ?> value="<?php echo $value->m_color_id; ?>" name="color">
                        <label class="custom-control-label" for="color-<?php echo $value->m_color_id; ?>"><?php echo $value->m_color_name; ?></label>
                        <span class="badge border font-weight-normal"><?=$tproduct?></span>
                    </div>
                        <?php endforeach; ?>
                  
                </form>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
        </div>
    </div>
</div>

<!-- Modal 3-->
<div class="modal fade" id="size" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Filter by Size</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-5">
                
                 <form id="filterForm1" action="<?php echo base_url('product'); ?>" method="post">
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input size-checkbox" id="size-0" <?php if ($size == '') echo 'checked'; ?> name="size" value="">
                        <label class="custom-control-label" for="size-0">All Size</label>
                        <span class="badge border font-weight-normal">
                            <?php $stproduct1 = $this->db->where('m_product_size >', 0)->get('master_product')->num_rows();
                              echo $stproduct1
                             ?>
                        </span>
                    </div>
                      <?php foreach ($all_size as $value) :

                       $tproduct = $this->db->where("FIND_IN_SET($value->m_size_id, m_product_size) >", 0)->get('master_product')->num_rows();

                           
                        ?>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input size-checkbox" id="size-<?php echo $value->m_size_id; ?>" <?php if($size == $value->m_size_id){?> checked <?php }else{ ?> <?php } ?> name="size"
                          value="<?php echo $value->m_size_id; ?>">
                        <label class="custom-control-label" for="size-<?php echo $value->m_size_id; ?>"><?php echo $value->m_size_name; ?></label>
                        <span class="badge border font-weight-normal"><?=$tproduct?></span>
                    </div>
                    <?php endforeach; ?>
                   
                </form>

            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
        </div>
    </div>
</div>

<!-- Modal 4-->
<div class="modal fade" id="fabric" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Filte by Fabric</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-5">
                <!-- <form>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" checked id="fabric-all">
                        <label class="custom-control-label" for="fabric-all">All fabric</label>
                        <span class="badge border font-weight-normal">1000</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="fabric-1">
                        <label class="custom-control-label" for="fabric-1">Acrylic</label>
                        <span class="badge border font-weight-normal">150</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="fabric-2">
                        <label class="custom-control-label" for="fabric-2">Cotton</label>
                        <span class="badge border font-weight-normal">295</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="fabric-3">
                        <label class="custom-control-label" for="fabric-3">Denim</label>
                        <span class="badge border font-weight-normal">246</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="fabric-4">
                        <label class="custom-control-label" for="fabric-4">Silk</label>
                        <span class="badge border font-weight-normal">145</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                        <input type="checkbox" class="custom-control-input" id="fabric-5">
                        <label class="custom-control-label" for="fabric-5">Satin</label>
                        <span class="badge border font-weight-normal">168</span>
                    </div>
                </form> -->
                 <form id="filterForm2" action="<?php echo base_url('product'); ?>" method="post">
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input fabric-checkbox" id="fabric-0" <?php if ($fabric == '') echo 'checked'; ?> name="fabric" value="">
                        <label class="custom-control-label" for="fabric-0">All fabric</label>
                        <span class="badge border font-weight-normal"><?php $ftproduct1 = $this->db->where('m_product_fabric >', 0)->get('master_product')->num_rows();
                              echo $ftproduct1
                             ?></span>
                    </div>
                    
                     <?php foreach ($all_fabric as $value) :

                       $tproduct = $this->db->where("FIND_IN_SET($value->m_fabric_id, m_product_fabric) >", 0)->get('master_product')->num_rows();

                           
                        ?>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input fabric-checkbox" id="fabric-<?php echo $value->m_fabric_id; ?>" value="<?php echo $value->m_fabric_id; ?>" <?php if($fabric == $value->m_fabric_id){?> checked <?php }else{ ?> <?php } ?> name="fabric">
                        <label class="custom-control-label" for="fabric-<?php echo $value->m_fabric_id; ?>"><?php echo $value->m_fabric_name; ?></label>
                        <span class="badge border font-weight-normal"><?=$tproduct?></span>
                    </div>
                        <?php endforeach; ?>
                  
                </form>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
        </div>
    </div>
</div>

<?php include("footer.php"); ?>
<?php include("script.php"); ?>
<?php $this->view('js/master_js');?>
<?php $this->view('js/cart_js');?>
<script>
    $(document).ready(function() {
        // When a checkbox with class 'color-checkbox' is checked, submit the form
        $('.color-checkbox').on('change', function() {
            $('#filterForm').submit();
        });
    });
    $(document).ready(function() {
        // When a checkbox with class 'color-checkbox' is checked, submit the form
        $('.size-checkbox').on('change', function() {
            $('#filterForm1').submit();
        });
    });

    $(document).ready(function() {
        // When a checkbox with class 'color-checkbox' is checked, submit the form
        $('.fabric-checkbox').on('change', function() {
            $('#filterForm2').submit();
        });
    });
</script>
