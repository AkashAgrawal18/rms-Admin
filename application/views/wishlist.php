<?php include("head.php"); ?>
<?php include("header.php"); ?>

<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light order">
                <a class="breadcrumb-item text-dark" href="<?php echo base_url('Welcome') ?>">Home</a>
                <!-- <a class="breadcrumb-item text-dark" href="<?php echo base_url('Shop') ?>">Products</a> -->
                <span class="breadcrumb-item active">Wishlist</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->


<!-- Cart Start -->
<section class="pt-3" style="background-image: url('assets/img/pattern.png');">
    <div class="row pr-lg-5">
        <div class="col-md-3">
            <?php include("sidebar.php"); ?>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-lg-12 table-responsive mb-5">
                    <table class="table table-light table-borderless table-hover text-center mb-0">
                        <thead class="thead-dark" id="wishlist_tbl">
                            <tr>
                                <th>Image</th>
                                <th>Products</th>
                                <th>Price</th>
                                <!-- <th>Quantity</th> -->
                                <!-- <th>Stock</th> -->
                                <th> Add To Cart</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            <?php 
                                 $i =1;
                                 if(!empty($all_value)) {
                                foreach ($all_value as $value) {

                                    $image = $this->db->where('m_image_product_id',$value->m_product_id)->where('m_image_status',1)->get('master_image_tbl')->result();

                                     if (!empty($image[0]->m_image_product_img) && file_exists('admin/uploads/product/' . $image[0]->m_image_product_img)) {
                                        $product_img = base_url('admin/uploads/product/' . $image[0]->m_image_product_img);
                                    } else {
                                        $product_img = base_url('admin/uploads/default.jpg');
                                    }


                                    ?>
                            <tr>
                                <td class="align-middle"><img src="<?php echo $product_img; ?>" alt="" style="width: 50px;"></td>
                                <td class="align-middle"><?php echo $value->m_product_name;  ?></td>
                                <td class="align-middle">₹<?php echo round($value->m_product_mrp, 3); ?></td>
                               <!--  <td class="align-middle">
                                        <h6><?php echo $value->m_sale_qty; ?></h6>
                                    </td> -->
                                <!-- <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" value="1">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td> -->
                                <td class="align-middle">
                                    <div class="offer-text">
                                        <a href="<?php echo base_url('Cart') ?>" class="btn btn-primary"> <i class="fas fa-shopping-cart text-white"></i></a>
                                    </div>
                                </td>
                                <td class="align-middle"><button  data-value="<?php echo $value->m_wishlist_id ;?>" class="btn btn-sm wishlist-delete btn-danger"><i class="fa fa-times"></i></button></td>
                            </tr>
                            <?php $i++; }} ?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

<?php include("footer.php"); ?>
<?php include("script.php"); ?>
<?php $this->view('js/master_js'); ?>