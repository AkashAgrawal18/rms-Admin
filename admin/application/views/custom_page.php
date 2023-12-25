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
                <a href="<?php echo base_url('uploads/categories_sample.xlsx'); ?>" class="btn btn-secondary btn-sm "><i class="fa-solid fa-download"></i> Download</a>
                <button type="submit" class="btn btn-primary btn-sm" data-bs-dismiss="modal">Import</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Import Modal -->

<!-- Add Category Modal -->
<div class="modal fade" id="categoriesadd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" id="cat_add_form">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="fa-regular fa-pen-to-square"></i> Add Category</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <label for="Name">Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control  mb-3" id="cat_name" name="m_category_name" required placeholder="Please Enter Name">

                    <label for="slug">Slug<span class="text-danger">*</span></label>
                    <input type="text" class="form-control  mb-3" id="slug" name="m_category_slug" placeholder="Please Enter Slug">

                    <label for="image">Logo</label><br>
                    <input type="file" class="form-control-file mb-3" name="m_category_image" id="exampleFormControlFile1">
                    <input type="hidden" class="form-control-file mb-3" name="m_category_image1" >
                </div>
                <div class="modal-footer">
                    <button type="submit" id="cat_add_btn" class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i> Add</button>
                    <button aria-label="Close" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form><!---------------/form----------->
        </div>
    </div>
</div>
<!-- Add Category Modal -->

<!-- Add Group Modal -->
<div class="modal fade" id="groupadd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" method="post" id="form_group_add">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add <?= $pagetitle?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label for="Name">Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="m_group_name" required placeholder="Enter Name">
                        <input type="hidden" name="m_group_id" value="">
                        <input type="hidden" name="m_group_type" value="<?= $type ?>">
                    </div>
                   
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="btn_group_add" class="btn btn-primary"> <i class="fa-regular fa-pen-to-square"></i> Submit </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
            </div>
        </form>
    </div>
</div>

<!-- Add Group Modal -->