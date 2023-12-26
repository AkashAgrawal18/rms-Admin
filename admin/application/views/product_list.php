<?php include("head.php"); ?>
<?php include("header.php"); ?>

<style>
    .offcanvas-end {
        width: 720px !important;
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
            <!-- <div class="col-lg-1 text-end">
                <div class="dropdown">
                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-plus"></i> Add
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#">Add xyz</a></li>
                        <li><a class="dropdown-item" href="#">Add xyz</a></li>
                        <li><a class="dropdown-item" href="#">Add xyz</a></li>
                    </ul>
                </div>
            </div> -->
            <div class="col-xl-1 col-lg-2 text-end">
                <button onclick="history.back()" class="btn btn-dark btn-sm rounded-pill w-100">
                    <i class="bi bi-arrow-bar-left me-1"></i><small>Back</small>
                </button>
            </div>
        </div>
    </div>
</section>

<div class="container-fluid bg-light">
    <div class="row pt-3">
        <div class="col-md-7">
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addproductmodal" ><i class="fa-solid fa-plus"></i> Add New Products</button>
            <!-- <button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-file-import"></i> Import Products</button> -->
        </div>
        <div class="col-md-5">
            <div class="input-group form-group">
                <form method="get" action="<?php echo base_url('Main/products');  ?>">
                    <div class="form-outline" data-mdb-input-init>
                        <input type="text" name="search" class="form-control" value="<?php echo $search; ?>" />
                        <!-- <label class="form-label" for="form1">Search</label> -->
                    </div>
                    <button type="submit" class="btn btn-primary me-2" data-mdb-ripple-init>
                        <i class="fas fa-search"></i>
                    </button>

                </form>
                <a type="submit" href="<?php echo base_url('Main/products');  ?>" class="btn btn-primary me-2" data-mdb-ripple-init>
                    <i class="fa-solid fa-rotate"></i>
                </a>
                <form action="<?php echo base_url('Main/products'); ?>" method="get">
                    <select class="form-select" name="category" onchange="this.form.submit();" aria-label="Default select example">
                        <option selected>Select Status</option>
                        <?php foreach ($categories as $category) : ?>

                            <option value="<?= $category->m_category_id  ?>" <?php if ($category->m_category_id == $cat) echo "selected";  ?>><?= $category->m_category_name ?></option>

                        <?php endforeach; ?>
                    </select>
                </form>

            </div>
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


                    $image =  $this->db->where('m_image_product_id', $value->m_product_id)->where('m_image_status', 1)->get('master_image_tbl')->result();

                    if (!empty($image[0]->m_image_product_img) && file_exists('uploads/product/' . $image[0]->m_image_product_img)) {
                        $product_img = base_url('uploads/product/' . $image[0]->m_image_product_img);
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
                        <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="offcanvas" data-bs-target="#staticBackdropview<?php echo $value->m_product_id  ?>" aria-controls="staticBackdrop"><i class="fas fa-eye"></i></button>

                            <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="staticBackdropview<?php echo $value->m_product_id  ?>" aria-labelledby="staticBackdropLabel">
                                <div class="offcanvas-header">
                                    <h5 class="offcanvas-title" id="staticBackdropLabel"><?php echo $value->m_product_name  ?> (product name)</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>


                                </div>
                                <hr>
                                <div class="offcanvas-body">
                                    <div>
                                        <div class="row g-4">
                                            <?php



                                            $image =  $this->db->where('m_image_product_id', $value->m_product_id)->where('m_image_status', 1)->get('master_image_tbl')->result();

                                            if (!empty($image[0]->m_image_product_img) && file_exists('uploads/product/' . $image[0]->m_image_product_img)) {
                                                $product_img = base_url('uploads/product/' . $image[0]->m_image_product_img);
                                            } else {
                                                $product_img = base_url('uploads/default.jpg');
                                            } ?>
                                            <div class="col-md-3">
                                                <img src="<?php echo $product_img; ?>" alt="" class="w-100">
                                            </div>

                                            <div class="col-md-9">
                                                <h6>Customer Details</h6>
                                                <div class="row g-4">
                                                    <div class="col-4">
                                                        Name : <br> <?php echo $value->m_product_name  ?>
                                                    </div>
                                                    <div class="col-4">
                                                        Item Code :<br> <?php echo $value->m_product_code  ?>
                                                    </div>
                                                    <div class="col-4">
                                                        Category :<br> <?php echo $value->m_category_name  ?>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row g-4">
                                                    <div class="col-4">
                                                        Purchase Price :<br>
                                                        ₹<?php echo round($value->m_product_purche_price, 3); ?>
                                                    </div>
                                                    <div class="col-4">
                                                        MRP :<br> <?php echo $value->m_product_mrp  ?>
                                                    </div>
                                                    <div class="col-4">
                                                        Sales Price :<br> ₹<?php echo round($value->m_product_seles_price, 3); ?>
                                                    </div>

                                                    <div class="col-4">
                                                        Tax Rate :<br> -
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-4">
                                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link pro-link active" id="product-tab" data-bs-toggle="tab" data-bs-target="#product-tab-pane" type="button" role="tab" aria-controls="product-tab-pane" aria-selected="true">Product Orders</button>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link pro-link" id="stock-tab" data-bs-toggle="tab" data-bs-target="#stock-tab-pane" type="button" role="tab" aria-controls="stock-tab-pane" aria-selected="false">Stock History</button>
                                                    </li>
                                                </ul>
                                                <div class="tab-content" id="myTabContent">
                                                    <div class="tab-pane fade show active" id="product-tab-pane" role="tabpanel" aria-labelledby="product-tab" tabindex="0">
                                                        <table class="table table-bordered">
                                                            <tr>
                                                                <th>Order Date</th>
                                                                <th>Order Type</th>
                                                                <th>Quantity</th>
                                                                <th>Unit Price</th>
                                                                <th>Discount</th>
                                                                <th>Tax</th>
                                                                <th>SubTotal</th>
                                                            </tr>


                                                        </table>
                                                    </div>
                                                    <div class="tab-pane fade" id="stock-tab-pane" role="tabpanel" aria-labelledby="stock-tab" tabindex="0">
                                                        <table class="table table-bordered">
                                                            <tr>
                                                                <th>Date</th>
                                                                <th>Order Type</th>
                                                                <th>Quantity</th>
                                                                <th>Stocks</th>
                                                                <th>Remarks</th>
                                                            </tr>


                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdropedit<?php echo $value->m_product_id; ?>"><i class="fa-solid fa-pen-to-square"></i></button>

                            <div class="modal fade-scale" id="staticBackdropedit<?php echo $value->m_product_id; ?>" tabindex="-1" style="--bs-modal-margin: 0px !important">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title m-0" id="staticBackdropLabel">Edit Products</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                        </div>
                                        <div class="modal-body">
                                            <form class="row g-3" method="post" id="update_product_form">

                                                <div class="col-md-4">
                                                    <label for="Name">Name<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control product_name" name="product_name" placeholder="Please Enter Name" value="<?php echo $value->m_product_name ?>" required>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="Name">Slug<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control product_slug" name="product_slug" placeholder="Please Enter Slug" value="<?php echo $value->m_product_slug ?>" required>
                                                    <input type="hidden" name="product_id" value="<?php echo $value->m_product_id ?>">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="Name">Category<span class="text-danger">*</span></label>

                                                    <select class="form-control" name="category" required>
                                                        <option>Select Category</option>
                                                        <?php foreach ($categories as $category) : ?>

                                                            <option value="<?= $category->m_category_id  ?>" <?php if ($value->m_product_cat_id == $category->m_category_id) echo "selected";  ?>><?= $category->m_category_name ?></option>

                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                                <div class="col-md-4">
                                                    <label >Unit <span class="text-danger">*</span></label>
                                                    <select class="form-control" name="product_unit" required>
                                                        <option value="">Select Unit</option>
                                                        <?php if (!empty($unit)) {
                                                                foreach ($unit as $val) {  ?> <option value="<?php echo $val->m_group_id;  ?>" <?php if ($value->m_product_unit == $val->m_group_id) echo "selected";  ?>><?php echo $val->m_group_name;  ?></option>
                                                    <?php }
                                                            } ?>
                                                    </select>
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="order">Barcode Symbology <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control product_barcode" name="product_code" placeholder="Please Enter Barcode Symbology" value="<?php echo $value->m_product_barscode;  ?>">

                                                </div>


                                                <div class="col-md-4">
                                                    <label for="fabrics">Fabric <span class="text-danger">*</span></label>
                                                    <select name="fabrics" id="fabrics" class="form-control" required>
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

                                                <div class="col-md-6" style="box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;">
                                                    <label for="colors">Color</label>
                                                    <div class="d-flex justify-content-between">
                                                        <?php
                                                        // An array of color options

                                                        // Loop through the color options and create checkboxes
                                                        foreach ($color_list as $color) {
                                                        ?>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="<?php echo strtolower($color->m_group_id); ?>" name="colors[]" value="<?php echo $color->m_group_id; ?>" <?php echo (in_array($color->m_group_id, explode(',', $value->m_product_color))) ? 'checked' : ''; ?>>
                                                                <label class="custom-control-label" for="<?php echo strtolower($color->m_group_id); ?>"><?php echo $color->m_group_name; ?></label>
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>

                                                <div class="col-md-6" style="box-shadow: rgba(9, 30, 66, 0.25) 0px 4px 8px -2px, rgba(9, 30, 66, 0.08) 0px 0px 0px 1px;">
                                                    <label >Size</label>
                                                    <div class="d-flex justify-content-between">
                                                        <?php
                                                        // An array of size options

                                                        // Loop through the size options and create checkboxes
                                                        foreach ($size_list as $size) {
                                                        ?>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="<?php echo strtolower($size->m_group_id); ?>" name="sizes[]" value="<?php echo $size->m_group_id; ?>" <?php echo (in_array($size->m_group_id, explode(',', $value->m_product_size))) ? 'checked' : ''; ?>>
                                                                <label class="custom-control-label" for="<?php echo strtolower($size->m_group_id); ?>"><?php echo $size->m_group_name; ?></label>
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>


                                                <h5>Price & Tax</h5>
                                                <hr class="my-1">

                                                <div class="col-md-4">
                                                    <label >Tax</label>
                                                    <select class="form-control" id="exampleFormControlSelect1" name="product_tax">
                                                        <option value="">Select Tax</option>
                                                        <?php if (!empty($taxgst)) {
                                                            foreach ($taxgst as $val) {  ?>
                                                                <option value="<?php echo $val->m_group_id;  ?>" <?php if ($value->m_product_taxgst == $val->m_group_id) echo "selected";  ?>><?php echo $val->m_group_name;  ?></option>
                                                        <?php }
                                                        } ?>
                                                    </select>
                                                </div>

                                                <div class="col-md-4">
                                                    <label >MRP</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">₹</span>
                                                        <input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" name="product_mrp" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" value="<?php echo $value->m_product_mrp   ?>" value="0">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="Name">Sales Price</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">₹</span>
                                                        <input type="text" class="form-control" name="product_sales" aria-label="Dollar amount (with dot and two decimal places)" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" value="<?php echo $value->m_product_seles_price   ?>" value="0">
                                                    </div>
                                                </div>

                                                <h5>Custom Fields</h5>
                                                <hr class="my-1">

                                                <div class="col-md-6">
                                                    <label for="Name">Details</label>
                                                    <textarea class="form-control editor" name="m_product_details" id="m_product_details1"><?php echo $value->m_product_details  ?></textarea>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="Name">Information</label>
                                                    <textarea class="form-control editor" name="m_product_information" id="m_product_information1"><?php echo $value->m_product_information  ?></textarea>
                                                </div>
                                                <div class="canvas-footer justify-content-end d-flex">
                                                    <button type="submit" class="btn btn-primary me-2" id="update_product_btn"><i class="fa-regular fa-pen-to-square"></i> Update</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="offcanvas" aria-label="Close" data-bs-dismiss="modal">Cancel</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>


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
                <form class="row g-3" method="post" id="update_product_form">

                    <div class="col-md-4">
                        <label for="Name">Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control product_name" name="product_name" placeholder="Please Enter Name" value="" required>
                    </div>
                    <div class="col-md-4">
                        <label for="Name">Slug<span class="text-danger">*</span></label>
                        <input type="text" class="form-control product_slug" name="product_slug" placeholder="Please Enter Slug" value="" required>
                        <input type="hidden" name="product_id" value="">
                    </div>
                    <div class="col-md-4">
                        <label for="category">Category<span class="text-danger">*</span></label>

                        <select class="form-control" id="category" name="category" required>
                            <option>Select Category</option>
                            <?php foreach ($categories as $category) : ?>

                                <option value="<?= $category->m_category_id  ?>"><?= $category->m_category_name ?></option>

                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="product_unit">Unit <span class="text-danger">*</span></label>
                        <select class="form-control" id="product_unit" name="product_unit" required>
                            <option value="">Select Unit</option>
                            <?php if (!empty($unit)) {
                                foreach ($unit as $val) {  ?> <option value="<?php echo $val->m_group_id;  ?>"><?php echo $val->m_group_name;  ?></option>
                            <?php }
                            } ?>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="order">Barcode Symbology <span class="text-danger">*</span></label>
                        <input type="text" class="form-control product_barcode" name="product_code" placeholder="Please Enter Barcode Symbology">

                    </div>


                    <div class="col-md-4">
                        <label for="fabrics">Fabric <span class="text-danger">*</span></label>
                        <select name="fabrics" id="fabrics" class="form-control" required>
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
                        <label for="colors">Color</label>
                        <div class="d-flex justify-content-between">
                            <?php
                            // An array of color options

                            // Loop through the color options and create checkboxes
                            foreach ($color_list as $color) {
                            ?>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="<?php echo strtolower($color->m_group_id); ?>" name="colors[]" value="<?php echo $color->m_group_id; ?>">
                                    <label class="custom-control-label" for="<?php echo strtolower($color->m_group_id); ?>"><?php echo $color->m_group_name; ?></label>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="sizes">Size</label>
                        <div class="d-flex justify-content-between">
                            <?php
                            // An array of size options

                            // Loop through the size options and create checkboxes
                            foreach ($size_list as $size) {
                            ?>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="<?php echo strtolower($size->m_group_id); ?>" name="sizes[]" value="<?php echo $size->m_group_id; ?>">
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
                        <label for="Name">Tax</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="product_tax">
                            <option value="">Select Tax</option>
                            <?php if (!empty($taxgst)) {
                                foreach ($taxgst as $val) {  ?>
                                    <option value="<?php echo $val->m_group_id;  ?>"><?php echo $val->m_group_name;  ?></option>
                            <?php }
                            } ?>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="Name">MRP</label>
                        <div class="input-group">
                            <span class="input-group-text">₹</span>
                            <input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" name="product_mrp" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" value="0">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="Name">Sales Price</label>
                        <div class="input-group">
                            <span class="input-group-text">₹</span>
                            <input type="text" class="form-control" name="product_sales" aria-label="Dollar amount (with dot and two decimal places)" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" value="0">
                        </div>
                    </div>

                    <h5>Custom Fields</h5>
                    <hr>

                    <div class="col-md-6">
                        <label for="Name">Details</label>
                        <textarea class="form-control editor" name="m_product_details" id="m_product_details1"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="Name">Information</label>
                        <textarea class="form-control editor" name="m_product_information" id="m_product_information1"></textarea>
                    </div>
                    <div class="canvas-footer justify-content-end d-flex">
                        <button type="submit" class="btn btn-primary me-2" id="add_product_btn"><i class="fa-regular fa-pen-to-square"></i> Add Product</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="offcanvas" aria-label="Close" data-bs-dismiss="modal">Cancel</button>
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