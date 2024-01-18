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
<div class="modal fade" id="categoriesadd" style="background: rgb(63 63 63 / 75%);" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                    <input type="hidden" class="clspagetype" name="m_cat_type" value="">
                    <input type="hidden" class="addoncls" name="m_addon" id="cataddon" value="">

                    <label for="slug">Slug<span class="text-danger">*</span></label>
                    <input type="text" class="form-control  mb-3" id="slug" name="m_category_slug" placeholder="Please Enter Slug">

                    <label for="image">Logo</label><br>
                    <input type="file" class="form-control-file mb-3" name="m_category_image" id="exampleFormControlFile1">
                    <input type="hidden" class="form-control-file mb-3" name="m_category_image1">
                </div>
                <div class="modal-footer">
                    <button type="submit" id="cat_add_btn" class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i> Add</button>
                    <button aria-label="Close" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form><!---------------/form----------->
        </div>
    </div>
</div>
<!-- Add Category Modal -->

<!-- Add Group Modal -->
<div class="modal fade" id="groupadd" style="background: rgb(63 63 63 / 75%);" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" method="post" id="form_group_add">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label for="Name">Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="m_group_name" id="group_name" required placeholder="Enter Name">
                        <input type="hidden" name="m_group_id" value="">
                        <input type="hidden" class="clspagetype" id="grouptype" name="m_group_type" value="">
                        <input type="hidden" class="addoncls" name="m_addon" id="gropaddon" value="">
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

<!--add customer modal  -->

<div class="modal fade" id="addcustomermodal" tabindex="-1" style="--bs-modal-margin: 0px !important">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title m-0" id="staticBackdropLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">
                <form class="row g-3" method="POST" id="form-customer-add">

                    <div class="col-md-6">
                        <label for="Name">Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="m_cust_name" name="cust_name" required placeholder="Please Enter Name">
                    </div>
                    <div class="col-md-6">
                        <label for="cmobile">Phone Number<span class="text-danger">*</span></label>
                        <input type="tel" class="form-control" name="cust_mobile" id="cmobile" maxlength="10" minlength="10" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" placeholder="Please Enter Number" required>
                    </div>
                    <div class="col-md-6">
                        <label for="Name">Email</label>
                        <input type="hidden" class="clspagetype" name="m_acc_type" id="user_type" value="">
                        <input type="hidden" class="addoncls" name="m_addon" id="custaddon" value="">
                        <input type="email" class="form-control" name="cust_email" placeholder="Please Enter Email">
                    </div>
                    <!-- <div class="col-md-6">
                            <label for="order">Status </label>
                            <select class="form-control" name="cust_status" >
                                <option value="1" selected>Active</option>
                                <option value="2">In-Active</option>
                            </select>
                        </div> -->
                    <!-- <div class="col-md-6">
                            <label for="Name">Password</label>
                            <input type="text" class="form-control" name="cust_pass" placeholder="Please Enter Password">
                        </div> -->
                    <div class="col-md-6 ">
                        <label for="image">Profile Image</label>
                        <input type="file" class="form-control-file" name="cust_image">
                    </div>
                    <!-- <div class="col-md-6">
                            <label for="Name">Tax Number</label>
                            <input type="text" class="form-control" name="cust_text_num"  placeholder="Please Enter Tax Number"  onkeypress="return (event.charCode >= 48 && event.charCode <= 57)"  value="0" >
                        </div> -->
                    <div class="col-md-6">
                        <label for="Name">Opening Balance</label>
                        <input type="text" class="form-control" name="cust_open_balance" placeholder="Please Enter Tax Number" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" value="0">
                    </div>

                    <div class="col-md-6 suppfiled">
                        <label for="Name">Credit Period</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="cust_credit_period" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" aria-label="Dollar amount (with dot and two decimal places)" value="0">
                            <span class="input-group-text">Day(s)</span>
                        </div>
                    </div>
                    <div class="col-md-6 suppfiled">
                        <label for="Name">Credit Limit</label>
                        <div class="input-group">
                            <span class="input-group-text">₹</span>
                            <input type="text" class="form-control" name="credit_limit" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" aria-label="Dollar amount (with dot and two decimal places)" value="0">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label for="Name">Billing Address</label>
                        <textarea class="form-control" name="Billing_address" rows="2"></textarea>
                    </div>

                    <div class="canvas-footer justify-content-end d-flex">
                        <button type="submit" class="btn btn-primary me-2 btn-customer-add" data-frmid="#form-customer-add"><i class="fa-regular fa-pen-to-square"></i> Create</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>



<!--add customer modal  -->

<script>
    function openmodalfun(id, modaltitle, pagetype, addon) {
        $(id).modal('show');
        $(id).find('.modal-title').text(modaltitle)
        $(id).find('.clspagetype').val(pagetype)
        $(id).find('.addoncls').val(addon)

        if (id == '#addcustomermodal') {
            if(pagetype == 3){
                $('.suppfiled').addClass('d-none');
            }else {
                $('.suppfiled').removeClass('d-none');
            }
          
        }

    }
</script>