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
                    <a href="<?php echo base_url('Dashboard'); ?>" class="text-white text-decoration-none ">Dashboard</a> >> Product Manager >> <a href="<?php echo base_url('Main/products'); ?>" class="text-decoration-none fw-bold"><span class="text-warning"> Products</span></a>
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
        <form method="get" action="<?php echo base_url('Main/products');  ?>">
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
                        <a href="<?php echo base_url('Main/products'); ?>" class="btn btn-primary me-2" data-mdb-ripple-init>
                            <i class="fa-solid fa-rotate"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <br>

    <table class="table my_custom_datatable table-bordered mt-3" id="product_tbl">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Product</th>
                <th>Category</th>
                <th>Purchase Price</th>
                <th>MRP Price</th>
                <th>Sales Price</th>
                <th>Image</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            if (!empty($all_value)) {
                foreach ($all_value as $value) {

                    if (!empty($value->m_product_image[0]->m_image_product_img) && file_exists('uploads/product/' . $value->m_product_image[0]->m_image_product_img)) {
                        $product_img = base_url('uploads/product/' . $value->m_product_image[0]->m_image_product_img);
                    } else {
                        $product_img = base_url('uploads/default.jpg');
                    }
            ?>

                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><img src="<?php echo $product_img; ?>" alt="kurtis" style="width:50px; height: 50px;">&nbsp; &nbsp;<?php echo $value->m_product_name; ?></td>

                        <td><?php echo $value->m_category_name; ?></td>
                        <td>₹<?php echo round($value->m_product_purche_price, 3); ?></td>
                        <td>₹<?php echo round($value->m_product_mrp, 3); ?></td>
                        <td>₹<?php echo round($value->m_product_seles_price, 3); ?></td>
                        <td><a href="<?php echo base_url('Main/products_image/' . $value->m_product_id);  ?>" class="btn btn-primary btn-sm">Add Image</a></td>
                        <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#viewproductdetail<?php echo $value->m_product_id  ?>" aria-controls="staticBackdrop"><i class="fas fa-eye"></i></button>

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
                                                            <b> Fabric Name : </b> <?= $value->m_fabric_name ?>
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

                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdropedit<?php echo $value->m_product_id; ?>"><i class="fa-solid fa-pen-to-square"></i></button>
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
                                                    <label>Fabric <span class="text-danger">*</span></label>
                                                    <select name="m_product_fabric" class="form-control" required>
                                                        <option value="">Select Fabric</option>
                                                        <?php
                                                        if (!empty($fabric_list)) {
                                                            foreach ($fabric_list as $fabric) {
                                                                if ($value->m_product_fabric == $fabric->m_group_id) {
                                                                    $op = 'selected';
                                                                } else {
                                                                    $op = '';
                                                                }
                                                                echo '<option value="' . $fabric->m_group_id . '" ' . $op . '>' . $fabric->m_group_name . '</option>';
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
                            <button type="button" data-value="<?php echo $value->m_product_id; ?>" class="btn btn-primary delete_product btn-sm"><i class="fa-solid fa-trash"></i></button>

                        </td>
                    </tr>
            <?php $i++;
                }
            }  ?>
        </tbody>
    </table>

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

                        <select class="form-control" id="m_product_cat_id" name="m_product_cat_id" required>
                            <option value="">Select Category</option>
                            <?php foreach ($categories as $category) : ?>

                                <option value="<?= $category->m_category_id  ?>"><?= $category->m_category_name ?></option>

                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label>Unit <span class="text-danger">*</span></label>
                        <select class="form-control" id="product_unit" name="m_product_unit" required>
                            <option value="">Select Unit</option>
                            <?php if (!empty($unit)) {
                                foreach ($unit as $val) {  ?> <option value="<?php echo $val->m_group_id;  ?>"><?php echo $val->m_group_name;  ?></option>
                            <?php }
                            } ?>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label>Barcode Symbology <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="m_product_barscode" placeholder="Please Enter Barcode Symbology">

                    </div>


                    <div class="col-md-4">
                        <label>Fabric <span class="text-danger">*</span></label>
                        <select name="m_product_fabric" id="m_product_fabric" class="form-control" required>
                            <option value="">Select Fabric</option>
                            <?php
                            if (!empty($fabric_list)) {
                                foreach ($fabric_list as $fabric) {

                                    echo '<option value="' . $fabric->m_group_id . '" >' . $fabric->m_group_name . '</option>';
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
                        <select class="form-control" id="exampleFormControlSelect1" name="m_product_taxgst">
                            <option value="">Select Tax</option>
                            <?php if (!empty($taxgst)) {
                                foreach ($taxgst as $val) {  ?>
                                    <option value="<?php echo $val->m_group_id;  ?>"><?php echo $val->m_group_name;  ?></option>
                            <?php }
                            } ?>
                        </select>
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
<?php $this->view('js/main_js');  ?>
<?php $this->view('js/custom_js'); ?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {

        // Listen for the input event on the category_name field
        $('#product_name').on('input', function() {
            // alert('hello');
            generateSlugadd();
        });
    });

    function generateSlugadd() {
        var categoryName = $('#product_name').val().trim();
        var slug = categoryName.toLowerCase().replace(/[^a-z0-9-]+/g, '-');
        var code = categoryName.toLowerCase().replace(/[^a-z0-9-]+/g, '-');
        var barcode = categoryName.toLowerCase().replace(/[^a-z0-9-]+/g, '-');

        $('#product_code').val(code);

        $('#product_barcode').val(barcode);
        $('#product_slug').val(slug);
    }
</script>

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