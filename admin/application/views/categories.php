<?php include("head.php"); ?>
<?php include("header.php"); ?>

<style>
    td,
    th {
        vertical-align: middle !important;
    }

    .modal-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
</style>

<!-- ========== Page Content ========== -->
<section class="py-1" style="background: #797979;">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-xl-10 col-lg-10">
                <p class="m-0 text-white small fw-light">
                    <a href="<?php echo base_url('Dashboard'); ?>" class="text-white text-decoration-none ">Dashboard</a> >> Sales >> <a href="<?php echo base_url('Master/categories'); ?>" class="text-decoration-none fw-bold"><span class="text-warning"> Categories</span></a>
                </p>
            </div>
            <!--  <div class="col-lg-1 text-end">
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


<div class="container-fluid bg-light" id="main-body" style="min-height:75vh">
    <div class="row pt-3">
        <div class="col-md-9">
            <button type="button" class="btn btn-primary btn-sm" onclick="openmodalfun('#categoriesadd','Add New Category','1','0')"><i class="fa-solid fa-plus"></i> Add New Category</button>
            <!-- <button type="button" class="btn btn-primary btn-sm" 
                     data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-file-import"></i> Import Categories</button> -->


        </div>
        <div class="col-md-3">
            <form class="input-group form-group" method="get" action="<?php echo base_url('Master/categories'); ?>">
                <div class="form-outline" data-mdb-input-init>
                    <input type="search" name="search" value="<?php echo $search; ?>" class="form-control" />
                    <!-- <label class="form-label" for="form1">Search</label> -->
                </div>
                <button type="submit" class="btn btn-primary me-1" data-mdb-ripple-init>
                    <i class="fas fa-search"></i>
                </button>
                <a href="<?php echo base_url('Master/categories'); ?>" class="btn btn-primary me-1" data-mdb-ripple-init>
                    <i class="fa-solid fa-rotate"></i>
                </a>
            </form>
        </div>
    </div>
    <br>

    <div class="row p-1 m-2">
        <?php
        $i = 1;
        if (!empty($all_value)) {
            foreach ($all_value as $value) {

                if (!empty($value->m_category_image) && file_exists('uploads/categories/' . $value->m_category_image)) {
                    $cat_img = base_url('uploads/categories/' . $value->m_category_image);
                } else {
                    $cat_img = base_url('assets/imgs/user.png');
                }


        ?>
                <div class="col-3">
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="<?= $cat_img ?>" class="img-fluid rounded-start" style="aspect-ratio: 2/2;" alt="<?= $value->m_category_name ?>">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="card-title"><?= $value->m_category_name ?></h5>
                                            <?php if ($value->m_category_status == 1) {
                                                echo '<span class="badge btn btn-success" style="position: absolute;top: 0.3rem;right: 0.3rem;">Active</span>';
                                            } else {
                                                echo '<span class="badge btn btn-danger" style="position: absolute;top: 0.3rem;right: 0.3rem;">In Active</span>';
                                            } ?>
                                        </div>
                                        <div class="col-2">
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#categoriesedit<?php echo $value->m_category_id ?>"><i class="fa-solid fa-pen-to-square"></i></button>
                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="categoriesedit<?php echo $value->m_category_id ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <form method="POST" id="cat_edit_form">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="fa-regular fa-pen-to-square"></i> Edit Category</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <!-- <label for="parent">Parent Category</label> -->
                                                                <!-- <select class="form-select" name="parent_cat" aria-label="Default select example">

                                                                <option selected>Select Category</option>
                                                                <?php
                                                                if (!empty($category)) {
                                                                    foreach ($category as $cat) {
                                                                ?>
                                                                        <option value="<?php echo $cat->m_category_id; ?>"><?php echo $cat->m_category_name; ?></option>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>


                                                            </select> -->
                                                                <!-- <p class="text-primary sm">Leave it blank to create parent category</p> -->

                                                                <label for="Name">Name<span class="text-danger">*</span></label>
                                                                <input type="hidden" class="form-control mb-3" id="cat_id" name="m_category_id" value="<?php echo $value->m_category_id ?>">
                                                                <input type="text" class="form-control cat_name  mb-3" name="m_category_name" required placeholder="Please Enter Name" value="<?php echo $value->m_category_name ?>">

                                                                <label for="slug">Slug<span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control slug mb-3" name="m_category_slug" placeholder="Please Enter Slug" value="<?php echo $value->m_category_slug ?>">

                                                                <label for="image">Logo</label><br>
                                                                <input type="hidden" class="form-control-file mb-3" name="m_category_image1" id="exampleFormControlFile1" value="<?php echo $value->m_category_image ?>">
                                                                <input type="file" class="form-control-file mb-3" name="m_category_image" id="exampleFormControlFile1">

                                                                <label for="Status">Status</label><br>
                                                                <select name="m_category_status" id="m_category_status" class="form-control">
                                                                    <option value="1" <?php if ($value->m_category_status == 1) echo 'selected'; ?>>Active</option>
                                                                    <option value="0" <?php if ($value->m_category_status == 0) echo 'selected'; ?>>In-Active</option>
                                                                </select>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" id="cat_edit_btn" class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i> Update</button>
                                                                <a href="<?php echo base_url('Master/categories'); ?>" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</a>
                                                            </div>
                                                        </form><!---------------/form----------->
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-2">
                                            <button type="button" data-value="<?php echo $value->m_category_id; ?>" class="btn btn-danger delete_cotegory btn-sm"><i class="fa-solid fa-trash"></i></button>
                                        </div>
                                    </div>
                                    <!-- <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <?php $i++;
            }
        }  ?>

    </div>
</div>


<!-- ========== Page Content ========== -->
<?php include("footer.php"); ?>
<?php $this->view('custom_page');  ?>
<?php $this->view('js/master_js');  ?>
<?php $this->view('js/custom_js'); ?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        // Listen for the input event on the category_name field
        $('#cat_name').on('input', function() {
            generateSlugadd();
        });
    });

    function generateSlugadd() {
        var categoryName = $('#cat_name').val().trim();
        var slug = categoryName.toLowerCase().replace(/[^a-z0-9-]+/g, '-');
        $('#slug').val(slug);
    }
</script>

<script>
    $(document).ready(function() {
        // Listen for the input event on the category_name field
        $('.cat_name').on('input', function() {
            generateSlugedit();
        });
    });

    function generateSlugedit() {
        var categoryName = $('.cat_name').val().trim();
        var slug = categoryName.toLowerCase().replace(/[^a-z0-9-]+/g, '-');
        $('.slug').val(slug);
    }
</script>