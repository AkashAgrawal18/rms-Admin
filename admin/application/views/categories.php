<?php include("head.php"); ?>
<?php include("header.php"); ?>

<style>
    
    td,
    th {
        vertical-align: middle !important;
    }
     .modal-footer{
            display: flex;
    align-items: center;
    justify-content: space-between;
    }
</style>

<!-- ========== Page Content ========== -->
<section class="py-1" style="background: #797979;">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-xl-11 col-lg-10">
                <p class="m-0 text-white small fw-light">
                    <a href="<?php echo base_url('Dashboard');?>" class="text-white text-decoration-none ">Dashboard</a> >> Sales >> <a href="<?php echo base_url('Main/categories');?>" class="text-decoration-none fw-bold"><span class="text-warning"> Categories</span></a>
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


<div class="container-fluid bg-light">
    <div class="row pt-3 mt-4">
        <div class="col-md-9">
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#categoriesadd"><i class="fa-solid fa-plus"></i> Add New Category</button>
            <!-- <button type="button" class="btn btn-primary btn-sm" 
                     data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-file-import"></i> Import Categories</button> -->

              <!-- Import Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Import Categories</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
   <p><b>Criteria</b>
    <ol>
        <li>Your Excel data should be in the format below! The first row of your Excel needs a column header as in the example table! Also make sure your file is UTF-8 to avoid unnecessary encoding problems.</li>
        <li> If you're trying to rectangle the date column, make sure the format is formatted in Y-m-d (2021-01-01).</li>
        <li>Import only 1000 data at a time.</li>
    </ol>
</p>
<hr>
<form method="POST" action="<?php echo site_url('Main/import_categories') ?>" enctype="multipart/form-data">
  <input class="form-control" type="file" id="formFile" name="import_file" required>
  
      </div>
      <div class="modal-footer">
        <a  href="<?php echo base_url('uploads/categories_sample.xlsx'); ?>" class="btn btn-secondary btn-sm "><i class="fa-solid fa-download"></i> Download</a>
        <button type="submit" class="btn btn-primary btn-sm" data-bs-dismiss="modal">Import</button>
      </div>
       </form>
    </div>
  </div>
</div>
        </div>
        <div class="col-md-3">
            <form class="input-group form-group" method="get" action="<?php echo base_url('Main/categories'); ?>">
                <div class="form-outline" data-mdb-input-init>
                    <input type="search"  name="search" value="<?php echo $search; ?>" class="form-control" />
                    <!-- <label class="form-label" for="form1">Search</label> -->
                </div>
                <button type="submit" class="btn btn-primary me-1" data-mdb-ripple-init>
                    <i class="fas fa-search"></i>
                </button>
                 <a href="<?php echo base_url('Main/categories'); ?>" class="btn btn-primary me-1" data-mdb-ripple-init>
                    <i class="fa-solid fa-rotate"></i>
                </a>
            </form>
        </div>
    </div>
</div>
<br>
<table class="table my_custom_datatable table-bordered mt-3" id="category_tbl">
    <thead>
    <tr>
        <th>S.No</th>
        <th>Name</th>
        <th>Parent Name</th>
        <th>Category Logo</th>
        <th>Action</th>

    </tr>
    </thead>
    <tbody>
   <?php
      $i = 1;
      if (!empty($all_value)) {
        foreach ($all_value as $value) {

        if (!empty($value->m_category_image) && file_exists('uploads/categories/'.$value->m_category_image)) {
            $cat_img = base_url('uploads/categories/'.$value->m_category_image);
          } else {
            $cat_img = base_url('assets/imgs/user.png');
          }
                                          
         
     ?> 
    
    <tr>
        <td><?php  echo $i; ?></td>
        <td><?php  echo $value->main_name; ?></td>
        <td><?php  echo $value->parent_name?: 'NA'; ?></td>
        <td>
            <img src="<?php echo $cat_img;?>" alt="kurtis" style="width:40px; height:40px;">
        </td>
        <td>
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#categoriesedit<?php  echo $value->m_category_id ?>"><i class="fa-solid fa-pen-to-square"></i></button>
            <!-- Modal -->
            <div class="modal fade" id="categoriesedit<?php  echo $value->m_category_id ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                       <form  method="POST" id="cat_edit_form">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="fa-regular fa-pen-to-square"></i> Edit Category</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label for="parent">Parent Category</label>
                            <select class="form-select" name="parent_cat"  aria-label="Default select example">

                                <option selected>Select Category</option>
                                 <?php 
                                  if(!empty($category))
                                  {
                                    foreach($category as $cat)
                                    {
                                      ?>
                                      <option value="<?php echo $cat->m_category_id; ?>"
                                     
                                      ><?php echo $cat->m_category_name; ?></option>
                                      <?php
                                    }
                                  }
                                  ?>

                                
                            </select>
                            <p class="text-primary sm">Leave it blank to create parent category</p>

                            <label for="Name">Name<span class="text-danger">*</span></label>
                             <input type="hidden" class="form-control mb-3" id="cat_id" name="cat_id" value="<?php  echo $value->m_category_id ?>">
                            <input type="text" class="form-control cat_name  mb-3"  name="cat_name" required placeholder="Please Enter Name" value="<?php  echo $value->m_category_name ?>" >

                            <label for="slug">Slug<span class="text-danger">*</span></label>
                            <input type="text" class="form-control slug mb-3"  name="cat_slug" placeholder="Please Enter Slug" value="<?php  echo $value->m_category_slug ?>">

                            <label for="image">Logo</label><br>
                            <input type="hidden" class="form-control-file mb-3" name="cat_image1"  id="exampleFormControlFile1" value="<?php  echo $value->m_category_image ?>">
                            <input type="file" class="form-control-file mb-3" name="cat_image"  id="exampleFormControlFile1">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="cat_edit_btn" class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i> Update</button>
                            <a href="<?php echo base_url('Main/categories'); ?>" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</a>
                        </div>
                         </form><!---------------/form----------->
                    </div>
                </div>
            </div>

            <button type="button"  data-value="<?php echo $value->m_category_id; ?>"  class="btn btn-primary delete_cotegory btn-sm"><i class="fa-solid fa-trash"></i></button>
        </td>
    </tr>
<?php $i++; }}  ?>
 </tbody>
</table>


<!-- Modal -->
<div class="modal fade" id="categoriesadd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="<?php echo base_url();  ?>" method="POST" id="cat_add_form">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="fa-regular fa-pen-to-square"></i> Add Category</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label for="parent">Parent Category</label>
                <select class="form-select" name="parent_cat"  aria-label="Default select example">

                    <option selected>Select Category</option>
                     <?php 
                      if(!empty($category))
                      {
                        foreach($category as $cat)
                        {
                          ?>
                          <option value="<?php echo $cat->m_category_id; ?>"
                          
                          ><?php echo $cat->m_category_name; ?></option>
                          <?php
                        }
                      }
                      ?>

                                
                </select>
                <p class="text-primary sm">Leave it blank to create parent category</p>

                <label for="Name">Name<span class="text-danger">*</span></label>
                <input type="text" class="form-control  mb-3" id="cat_name" name="cat_name" required placeholder="Please Enter Name" >

                <label for="slug">Slug<span class="text-danger">*</span></label>
                <input type="text" class="form-control  mb-3" id="slug" name="cat_slug" placeholder="Please Enter Slug">

                <label for="image">Logo</label><br>
                <input type="file" class="form-control-file mb-3" name="cat_image"  id="exampleFormControlFile1">
            </div>
            <div class="modal-footer">
                <button type="submit" id="cat_add_btn" class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i> Add</button>
                <a href="<?php echo base_url('Main/categories'); ?>" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</a>
            </div>
             </form><!---------------/form----------->
        </div>
    </div>
</div>

<!-- ========== Page Content ========== -->
<?php include("footer.php"); ?>
<?php $this->view('js/main_js');  ?>
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

