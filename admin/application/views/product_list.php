<?php include("head.php"); ?>
<?php include("header.php"); ?>

<style>
    .offcanvas-end {
        width: 720px !important;
    }

    label {
        font-weight: 500;
        font-size: 15px;
    }

    .pro-link {
        color: #000 !important;
        font-weight: bold;
    }

    td,
    th {
        vertical-align: middle !important;
    }

    .tox-notifications-container {
        visibility: hidden !important;
    }
</style>

<!-- ========== Page Content ========== -->
<section class="py-1" style="background: #797979;">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-xl-10 col-lg-10">
                <p class="m-0 text-white small fw-light">
                    <a href="<?php echo base_url('Dashboard'); ?>" class="text-white text-decoration-none ">Dashboard</a> >> Product Manager >> <a href="<?php echo base_url('Master/products'); ?>" class="text-decoration-none fw-bold"><span class="text-warning"> Products</span></a>
                </p>
            </div>

            <div class="col-xl-1 col-lg-2 text-end">
                <button onclick="history.back()" class="btn btn-dark btn-sm rounded-pill w-100">
                    <i class="bi bi-arrow-bar-left me-1"></i><small>Back</small>
                </button>
            </div>
        </div>
    </div>
</section>

<div class="container-fluid bg-light" id="main-body" style="min-height:75vh">
    <div class="row pt-3">
        <div class="col-md-4">
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addproductmodal"><i class="fa-solid fa-plus"></i> Add New Products</button>
            <!-- <button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-file-import"></i> Import Products</button> -->
        </div>
        <div class="col-md-8">
            <form method="get" action="<?php echo base_url('Master/products');  ?>">
                <div class="row">

                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="search" class="form-control" onchange="this.form.submit();" value="<?php echo $search; ?>" placeholder="Search..." />
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <select class="form-select" name="status" onchange="this.form.submit();" aria-label="Default select example">
                                <option value="">All Status</option>
                                <option value="1" <?php if ($status == 1) echo "selected"; ?>>Active</option>
                                <option value="2" <?php if ($status == 2) echo "selected"; ?>>In-Active</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-2">
                        <a href="<?php echo base_url('Master/products'); ?>" class="btn btn-primary me-2" data-mdb-ripple-init>
                            <i class="fa-solid fa-rotate"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <br>

    <div class="row g-2">

        <?php
      
        if (!empty($all_value)) {
            foreach ($all_value as $value) {

                if (!empty($value->m_product_image[0]->m_image_product_img) && file_exists('uploads/product/' . $value->m_product_image[0]->m_image_product_img)) {
                    $product_img = base_url('uploads/product/' . $value->m_product_image[0]->m_image_product_img);
                } else {
                    $product_img = base_url('uploads/default.jpg');
                }
        ?>
                <div class="col-3" >
                    <div class="card mb-3">
                        <div class="card-body p-2">
                            <div class="row g-2">
                                <div class="col-md-4">
                                    <img src="<?= $product_img ?>" class="img-fluid rounded-start" style="aspect-ratio: 2/2;" alt="<?= $value->m_product_name ?>">
                                </div>
                                <div class="col-md-8 mt-4">

                                    <div class="row">
                                        <div class="col-12">
                                            <h4 class="mb-0"><strong><?= $value->m_product_name ?></strong></h4>
                                            <span><?= $value->m_category_name ?></span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span>MRP <br> <b>₹<?= round($value->m_product_mrp, 2); ?></b></span>
                                            <span>Sale Price <br> <b>₹<?= round($value->m_product_seles_price, 2); ?></b></span>
                                            <span>Pur Price <br> <b>₹<?= round($value->m_product_purche_price, 2); ?></b></span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <span style="position: absolute;bottom: 0.4rem;left: 0.4rem;"><i class="fa-regular fa-clock"></i> <?= date('d-m-Y h:i A', strtotime($value->m_product_updated_on));  ?></span>
                            <span class="badge badge <?= $value->m_product_status == 1 ? 'bg-success' : 'bg-danger' ?> p-1" style="position: absolute;top: 0.4rem;right: 0.4rem;"><?= $value->m_product_status == 1 ? 'Active' : 'In-Active' ?></span>

                            <div class="text-end mt-2">
                                <a href="<?php echo base_url('Master/products_image/' . $value->m_product_id);  ?>" class="btn btn-primary btn-sm">Add Image</a>
                                <button type="button" title="Click to View The Details" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#viewproductdetail<?php echo $value->m_product_id  ?>" aria-controls="staticBackdrop"><i class="fas fa-eye"></i></button>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdropedit<?php echo $value->m_product_id; ?>"><i class="fa-solid fa-pen-to-square"></i></button>
                                <button type="button" data-value="<?php echo $value->m_product_id; ?>" class="btn btn-danger delete_product btn-sm"><i class="fa-solid fa-trash"></i></button>

                            </div>
                        </div>

                    </div>
                </div>
            
                <!-- product edit modal -->
                <div class="modal fade-scale" id="staticBackdropedit<?php echo $value->m_product_id; ?>" tabindex="-1" style="--bs-modal-margin: 0px !important">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title m-0">Edit Products</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                            </div>
                            <div class="modal-body">
                                <form class="row g-3" method="post" id="frm_update_product<?php echo $value->m_product_id; ?>">

                                    <div class="col-md-4">
                                        <label>Name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="m_product_name" placeholder="Please Enter Name" value="<?php echo $value->m_product_name ?>" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Slug<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="m_product_slug" placeholder="Please Enter Slug" value="<?php echo $value->m_product_slug ?>" required>
                                        <input type="hidden" name="m_product_id" value="<?php echo $value->m_product_id ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Category<span class="text-danger">*</span></label>

                                        <select class="form-control" name="m_product_cat_id" required>
                                            <option value="">Select Category</option>
                                            <?php foreach ($categories as $category) : ?>

                                                <option value="<?= $category->m_category_id  ?>" <?php if ($value->m_product_cat_id == $category->m_category_id) echo "selected";  ?>><?= $category->m_category_name ?></option>

                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label>Unit <span class="text-danger">*</span></label>
                                        <select class="form-control" name="m_product_unit" required>
                                            <option value="">Select Unit</option>
                                            <?php if (!empty($unit)) {
                                                foreach ($unit as $val) {  ?> <option value="<?php echo $val->m_group_id;  ?>" <?php if ($value->m_product_unit == $val->m_group_id) echo "selected";  ?>><?php echo $val->m_group_name;  ?></option>
                                            <?php }
                                            } ?>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label>Barcode Symbology <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="m_product_barscode" placeholder="Please Enter Barcode Symbology" value="<?php echo $value->m_product_barscode;  ?>">
                                    </div>

                                    <div class="col-md-4">
                                        <label>Brand <span class="text-danger">*</span></label>
                                        <select name="m_product_brand" class="form-control" required>
                                            <option value="">Select Brand</option>
                                            <?php
                                            if (!empty($brand_list)) {
                                                foreach ($brand_list as $brand) {
                                                    if ($value->m_product_brand == $brand->m_group_id) {
                                                        $op = 'selected';
                                                    } else {
                                                        $op = '';
                                                    }
                                                    echo '<option value="' . $brand->m_group_id . '" ' . $op . '>' . $brand->m_group_name . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="col-md-6">
                                        <label>Color</label>
                                        <div class="d-flex justify-content-between">
                                            <?php
                                            // An array of color options

                                            // Loop through the color options and create checkboxes
                                            foreach ($color_list as $color) {
                                            ?>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="m_product_color[]" value="<?php echo $color->m_group_id; ?>" <?php echo (in_array($color->m_group_id, explode(',', $value->product_color))) ? 'checked' : ''; ?>>
                                                    <label class="custom-control-label"><?php echo $color->m_group_name; ?></label>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6" style="box-shadow: 0 -15px 13px -20px rgba(0,0,0,0.45) inset, 17px 0 12px -20px rgba(0,0,0,0.45) inset;">
                                        <label>Size</label>
                                        <div class="d-flex justify-content-between">
                                            <?php
                                            // An array of size options

                                            // Loop through the size options and create checkboxes
                                            foreach ($size_list as $size) {
                                            ?>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="m_product_size[]" value="<?php echo $size->m_group_id; ?>" <?php echo (in_array($size->m_group_id, explode(',', $value->product_size))) ? 'checked' : ''; ?>>
                                                    <label class="custom-control-label"><?php echo $size->m_group_name; ?></label>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>


                                    <h5>Price & Tax</h5>
                                    <hr class="my-1">

                                    <div class="col-md-4">
                                        <label>Tax</label>
                                        <select class="form-control" name="m_product_taxgst">
                                            <option value="">Select Tax</option>
                                            <?php if (!empty($taxgst)) {
                                                foreach ($taxgst as $val) {  ?>
                                                    <option value="<?php echo $val->m_group_id;  ?>" <?php if ($value->m_product_taxgst == $val->m_group_id) echo "selected";  ?>><?php echo $val->m_group_name;  ?></option>
                                            <?php }
                                            } ?>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label>MRP</label>
                                        <div class="input-group">
                                            <span class="input-group-text">₹</span>
                                            <input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" name="m_product_mrp" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" value="<?php echo $value->m_product_mrp   ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Sales Price</label>
                                        <div class="input-group">
                                            <span class="input-group-text">₹</span>
                                            <input type="text" class="form-control" name="m_product_seles_price" aria-label="Dollar amount (with dot and two decimal places)" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" value="<?php echo $value->m_product_seles_price   ?>">
                                        </div>
                                    </div>

                                    <h5>Custom Fields</h5>
                                    <hr class="my-1">

                                    <div class="col-md-6">
                                        <label>Details</label>
                                        <textarea class="form-control editor" id="m_product_details<?php echo $value->m_product_id; ?>" name="m_product_details"><?php echo $value->m_product_details  ?></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Information</label>
                                        <textarea class="form-control editor" id="m_product_information<?php echo $value->m_product_id; ?>" name="m_product_information"><?php echo $value->m_product_information  ?></textarea>
                                    </div>
                                    <div class="canvas-footer justify-content-end d-flex">
                                        <button type="submit" class="btn btn-primary me-2 btn_add_product" data-prodid="<?php echo $value->m_product_id; ?>" data-frmid="#frm_update_product<?php echo $value->m_product_id; ?>"><i class="fa-regular fa-pen-to-square"></i> Update</button>
                                        <button type="button" class="btn btn-secondary" aria-label="Close" data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- product edit modal -->

                <!-- product view modal -->
                <div class="modal fade-scale" id="viewproductdetail<?php echo $value->m_product_id; ?>" tabindex="-1" style="--bs-modal-margin: 0px !important">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title m-0"><?= $value->m_product_name ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                            </div>
                            <div class="modal-body">
                                <div class="row g-3 " style="font-size: 16px;">
                                    <div class="col-9">
                                        <div class="row g-3">
                                            <h5>Product Details</h5>
                                            <div class="col-6">
                                                <b> Product Name : </b> <br> <?= $value->m_product_name ?>
                                            </div>
                                            <div class="col-6">
                                                <b> Product Slug :</b> <br> <?= $value->m_product_slug ?>
                                            </div>
                                            <div class="col-3">
                                                <b> Category Name :</b> <?= $value->m_category_name ?>
                                            </div>
                                            <div class="col-3">
                                                <b> Product Code :</b> <?= $value->m_product_barscode ?>
                                            </div>
                                            <div class="col-3">
                                                <b> Brand Name : </b> <?= $value->m_brand_name ?>
                                            </div>
                                            <div class="col-3">
                                                <b> Product Unit :</b> <?= $value->m_unit_title ?>
                                            </div>
                                            <div class="col-6">
                                                <b> Product Sizes :</b>
                                                <?php
                                                if (!empty($value->m_product_size)) {
                                                    foreach ($value->m_product_size as $siz) {
                                                        echo '<span class="btn btn-info me-2" style=" --bs-btn-padding-x: 0.55rem; --bs-btn-padding-y: 0.205rem;">' . $siz->m_size_name . '</span>';
                                                    }
                                                }
                                                ?>
                                            </div>
                                            <div class="col-6">
                                                <b> Product Colors :</b> <?php
                                                                            if (!empty($value->m_product_color)) {
                                                                                foreach ($value->m_product_color as $colu) {
                                                                                    echo '<span class="btn me-2" style="background-color:' . $colu->m_color_name . ' ;color:' . $colu->m_color_name . '; --bs-btn-padding-x: 0.55rem; --bs-btn-padding-y: 0.205rem;">X</span>';
                                                                                }
                                                                            }
                                                                            ?>
                                            </div>
                                            <div class="col-3">
                                                <b> Tax (%) :</b> <?= $value->m_tax_value ?> %
                                            </div>
                                            <div class="col-3">
                                                <b> Purchase Price : </b> ₹<?= $value->m_product_purche_price ?>
                                            </div>
                                            <div class="col-3">
                                                <b> MRP Price : </b> ₹<?= $value->m_product_mrp ?>
                                            </div>
                                            <div class="col-3">
                                                <b> Sale Price : </b> ₹<?= $value->m_product_seles_price ?>
                                            </div>
                                            <div class="col-12">
                                                <b> Description : </b>
                                                <p><?= $value->m_product_details ?> </p>
                                            </div>
                                            <div class="col-12">
                                                <b> Information : </b>
                                                <p><?= $value->m_product_information ?> </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="row">
                                            <?php
                                            if (!empty($value->m_product_image)) {
                                                foreach ($value->m_product_image as $key => $imval) {

                                                    if (!empty($imval->m_image_product_img) && file_exists('uploads/product/' . $imval->m_image_product_img)) {
                                                        $product_img = base_url('uploads/product/' . $imval->m_image_product_img);
                                                    } else {
                                                        $product_img = base_url('uploads/default.jpg');
                                                    }
                                                    echo ' <div class="col-12 mb-1">
                                                            <img src="' . $product_img . '" alt="" class="w-100">
                                                        </div> ';
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- product view modal -->

        <?php
            }
        }  ?>


    </div>

</div>

<!---------------add model -------------------->

<div class="modal fade-scale" id="addproductmodal" tabindex="-1" style="--bs-modal-margin: 0px !important">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title m-0" id="addproductmodalLabel">Add New Products</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">
                <form class="row g-3" method="post" id="frm_add_product">

                    <div class="col-md-4">
                        <label>Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="m_product_name" placeholder="Please Enter Name" value="" required>
                    </div>
                    <div class="col-md-4">
                        <label>Slug<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="m_product_slug" placeholder="Please Enter Slug" value="" required>
                        <input type="hidden" name="m_product_id" value="">
                    </div>
                    <div class="col-md-4">
                        <label>Category<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <select class="form-select" id="m_cat_id" name="m_product_cat_id" required aria-label="Example select with button addon">
                                <option value="">Select Category</option>
                                <?php if (!empty($categories)) {
                                    foreach ($categories as $category) { ?>

                                        <option value="<?= $category->m_category_id  ?>"><?= $category->m_category_name ?></option>

                                <?php }
                                } ?>
                            </select>
                            <button class="btn btn-outline-secondary" onclick="openmodalfun('#categoriesadd','Add New Category','1','1')" type="button"><i class="fa-solid fa-plus"></i></button>
                        </div>

                    </div>

                    <div class="col-md-4">
                        <label>Unit <span class="text-danger">*</span></label>

                        <div class="input-group">
                            <select class="form-select" id="m_unit" name="m_product_unit" required aria-label="Example select with button addon">
                                <option value="">Select Unit</option>
                                <?php if (!empty($unit)) {
                                    foreach ($unit as $val) {  ?> <option value="<?php echo $val->m_group_id;  ?>"><?php echo $val->m_group_name;  ?></option>
                                <?php }
                                } ?>
                            </select>
                            <button class="btn btn-outline-secondary" onclick="openmodalfun('#groupadd','Add New Unit','1','1')" type="button"><i class="fa-solid fa-plus"></i></button>
                        </div>

                    </div>

                    <div class="col-md-4">
                        <label>Barcode Symbology <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="m_product_barscode" placeholder="Please Enter Barcode Symbology">

                    </div>


                    <div class="col-md-4">
                        <label>Brand <span class="text-danger">*</span></label>

                        <div class="input-group">
                            <select class="form-select" id="m_brand" name="m_product_brand" required aria-label="Example select with button addon">
                                <option value="">Select Brand</option>

                                <?php
                                if (!empty($brand_list)) {
                                    foreach ($brand_list as $brand) {

                                        echo '<option value="' . $brand->m_group_id . '" >' . $brand->m_group_name . '</option>';
                                    }
                                }
                                ?>
                            </select>
                            <button class="btn btn-outline-secondary" onclick="openmodalfun('#groupadd','Add New Brand','5','1')" type="button"><i class="fa-solid fa-plus"></i></button>
                        </div>

                    </div>

                    <div class="col-md-6">
                        <label>Color</label>
                        <div class="d-flex justify-content-between">
                            <?php
                            // An array of color options

                            // Loop through the color options and create checkboxes
                            foreach ($color_list as $color) {
                            ?>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="<?php echo strtolower($color->m_group_id); ?>" name="m_product_color[]" value="<?php echo $color->m_group_id; ?>">
                                    <label class="custom-control-label" for="<?php echo strtolower($color->m_group_id); ?>"><?php echo $color->m_group_name; ?></label>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>

                    <div class="col-md-6" style="box-shadow: 0 -15px 13px -20px rgba(0,0,0,0.45) inset, 17px 0 12px -20px rgba(0,0,0,0.45) inset;">
                        <label>Size</label>
                        <div class="d-flex justify-content-between">
                            <?php
                            // An array of size options

                            // Loop through the size options and create checkboxes
                            foreach ($size_list as $size) {
                            ?>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="<?php echo strtolower($size->m_group_id); ?>" name="m_product_size[]" value="<?php echo $size->m_group_id; ?>">
                                    <label class="custom-control-label" for="<?php echo strtolower($size->m_group_id); ?>"><?php echo $size->m_group_name; ?></label>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>


                    <h5>Price & Tax</h5>
                    <hr>

                    <div class="col-md-4">
                        <label>Tax</label>
                        <div class="input-group">
                            <select class="form-select" id="m_taxgst" name="m_product_taxgst" aria-label="Example select with button addon">
                                <option value="">Select Tax</option>

                                <?php if (!empty($taxgst)) {
                                    foreach ($taxgst as $val) {  ?>
                                        <option value="<?php echo $val->m_group_id;  ?>"><?php echo $val->m_group_name;  ?></option>
                                <?php }
                                } ?>
                            </select>
                            <button class="btn btn-outline-secondary" onclick="openmodalfun('#groupadd','Add Tax','4','1')" type="button"><i class="fa-solid fa-plus"></i></button>
                        </div>

                    </div>

                    <div class="col-md-4">
                        <label>MRP</label>
                        <div class="input-group">
                            <span class="input-group-text">₹</span>
                            <input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" name="m_product_mrp" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" value="0">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>Sales Price</label>
                        <div class="input-group">
                            <span class="input-group-text">₹</span>
                            <input type="text" class="form-control" name="m_product_seles_price" aria-label="Dollar amount (with dot and two decimal places)" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" value="0">
                        </div>
                    </div>

                    <h5>Custom Fields</h5>
                    <hr>

                    <div class="col-md-6">
                        <label>Details</label>
                        <textarea class="form-control editor" name="m_product_details" id="m_product_details"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label>Information</label>
                        <textarea class="form-control editor" name="m_product_information" id="m_product_information"></textarea>
                    </div>
                    <div class="canvas-footer justify-content-end d-flex">
                        <button type="submit" class="btn btn-primary me-2 btn_add_product" data-prodid="" data-frmid="#frm_add_product"><i class="fa-regular fa-pen-to-square"></i> Add Product</button>
                        <button type="button" class="btn btn-secondary" aria-label="Close" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!---------------/add model -------------------->


<!-- ========== Page Content ========== -->
<?php include("footer.php"); ?>
<?php $this->view('custom_page'); ?>
<?php $this->view('js/master_js');  ?>
<?php $this->view('js/custom_js'); ?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function() {
        // Listen for the input event on the category_name field
        $('.product_name').on('input', function() {
            generateSlugedit();
        });
    });

    function generateSlugedit() {
        var categoryName = $('.product_name').val().trim();
        var slug = categoryName.toLowerCase().replace(/[^a-z0-9-]+/g, '-');
        var code = categoryName.toLowerCase().replace(/[^a-z0-9-]+/g, '-');
        var barcode = categoryName.toLowerCase().replace(/[^a-z0-9-]+/g, '-');
        $('.product_code').val(code);
        $('.product_barcode').val(barcode);
        $('.product_slug').val(slug);
    }
</script>