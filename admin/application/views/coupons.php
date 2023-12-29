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
</style>

<!-- ========== Page Content ========== -->
<section class="py-1" style="background: #797979;">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-xl-11 col-lg-10">
                <p class="m-0 text-white small fw-light">
                    <a href="<?php echo base_url('Dashboard'); ?>" class="text-white text-decoration-none ">Dashboard</a> >> Coupons >> <a href="<?php echo base_url('Main/coupons'); ?>" class="text-decoration-none fw-bold"><span class="text-warning"> Coupons</span></a>
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
                <button onclick="history.back()"  class="btn btn-dark btn-sm rounded-pill w-100">
                    <i class="bi bi-arrow-bar-left me-1"></i><small>Back</small>
                </button>
            </div>
        </div>
    </div>
</section>

<div class="container-fluid bg-light">
    <div class="row pt-3">
        <div class="col-md-7">
            <button type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRightadd" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus"></i> Add New coupon</button>

             <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRightadd" aria-labelledby="offcanvasRightLabel">
                    <div class="offcanvas-header">
                        <h5 id="offcanvasRightLabel">Add Coupon</h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <form class="offcanvas-body" method="post" id="form_coupon_add">
                        <div class="row g-3">
                             <div class="col-md-6">
                                <label for="Name"> Title<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="coupon_title" name="coupon_title" required placeholder="Title">
                            </div>

                            <div class="col-md-6">
                                <label for="Name">Coupon code<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="code" name="coupon_code" required placeholder="Coupon code" >
                            </div>

                            <div class="col-md-12">
                                <label for="order">Coupon Detail</label>
                                <textarea class="form-control" name="coupon_details" rows="3"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="Name">Discount Type <span class="text-danger">*</span></label>
                                <select class="form-control mb-3" name="dis_type" required >
                                   <option value="">Select Discount Type</option>
                                    
                                    <option value="1" selected >Percentage</option>
                               
                                </select>
                            </div>
                            <div class="col-md-6">
                                    <label for="Name">Discount Percentage</label>
                                    <input type="text" class="form-control dis-percentage" name="dis_percentage" minlength="0" maxlength="3" pattern="\d+(\.\d{1,2})?" placeholder="Discount Percentage" title="Enter a valid percentage (up to two decimal places)" oninput="validateDiscount(this)">
                                    <div class="invalid-feedback dis-percentage-error">Discount percentage must be a valid number up to 100.</div>
                                </div>
                            <div class="col-md-6">
                                <label for="Name">Coupon Min Amount</label>
                                <input type="text" class="form-control" name="min_amount" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" placeholder="Coupon Min Amount">
                            </div>

                             <div class="col-md-6">
                                <label for="date">Start Date<span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="start_date"  required>
                            </div>
                             <div class="col-md-6">
                                <label for="date">End Date<span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="end_date"  required>
                            </div>
                            
                            <div class="canvas-footer justify-content-end d-flex">
                                <button type="submit" id="btn_coupon_add" class="btn btn-primary me-2"><i class="fa-regular fa-pen-to-square"></i> Create</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="offcanvas" aria-label="Close">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
        <div class="col-md-5">
            <div class="input-group form-group">
                <form method="get" action="<?php echo base_url('Main/coupons');  ?>">
                    <div class="form-outline" data-mdb-input-init>
                    <input type="text" name="search" class="form-control" value="<?php echo $search; ?>" />
                    <!-- <label class="form-label" for="form1">Search</label> -->
                </div>
                <button type="submit" class="btn btn-primary me-2" data-mdb-ripple-init>
                    <i class="fas fa-search"></i>
                </button>
                <a type="submit" href="<?php echo base_url('Main/coupons');  ?>" class="btn btn-primary me-2" data-mdb-ripple-init>
                   <i class="fa-solid fa-rotate"></i>
                </a>
                </form>
               <form action="<?php echo base_url('User/expenses');?>"  method="get" >
                    
                </form>
                <!-- <input type="date" id="date" name="date" class="form-control"> -->
            </div>
        </div>
    </div>
    <br>

    <table class="table my_custom_datatable table-bordered mt-3" id="coupon_tbl">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Coupon Code</th>
            <th>Title</th>
            <th>Type</th>
            <th>Discount</th>
            <th>Min Amount</th>
            <th>Start Date</th>
            <th>Expiry Date</th>
            <th>Status</th>
            <th>Action</th>

        </tr>
    </thead>
    <tbody>
         <?php 

            $i = 1;
              if($all_value){
              foreach($all_value as $value){

               
              ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $value->m_coupon_code; ?></td>
            <td><?php echo $value->m_coupon_title; ?></td>
            <td><?php if($value->m_coupon_discount_type ==1){ echo 'Percentage';}else{ } ?></td>
            <td><?php echo $value->m_coupon_discount; ?></td>
            <td>₹<?php echo $value->m_coupon_min_amount; ?></td>
            <td><?php echo date('d-n-Y', strtotime($value->m_coupon_start)); ?></td>
            <td><?php echo date('d-n-Y', strtotime($value->m_coupon_end)); ?></td>
            
            <td><?php if($value->m_coupon_status ==1){ echo 'Active';}else{ echo 'In-Active'; } ?></td>
            <td>
                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdropview<?php echo $value->m_coupon_id; ?>"><i class="fa-solid fa-file"></i></button>
                    <!-- description -->
                        <div class="modal fade" id="staticBackdropview<?php echo $value->m_coupon_id; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel"><?php echo $value->m_coupon_title; ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><?php echo $value->m_coupon_detail; ?></p>
                                    </div>
                                    <div class="modal-footer">
                                        
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" aria-label="Close">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight<?php echo $value->m_coupon_id  ?>" aria-controls="offcanvasRight<?php echo $value->m_coupon_id;?>"><i class="fa-solid fa-pen-to-square"></i></button>

                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight<?php echo $value->m_coupon_id?>" aria-labelledby="offcanvasRightLabel">
                    <div class="offcanvas-header">
                        <h5 id="offcanvasRightLabel">Edit Coupon</h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <form class="offcanvas-body" method="post" id="form_coupon_edit">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="Name"> Title<span class="text-danger">*</span></label>
                                 <input type="text" class="form-control coupon_title" name="coupon_title" required placeholder="Title" value="<?php echo $value->m_coupon_title?>">
                                 <input type="hidden" class="form-control" name="coupon_id" required placeholder="Title" value="<?php echo $value->m_coupon_id?>">
                            </div>

                            <div class="col-md-6">
                                <label for="Name">Coupon code<span class="text-danger">*</span></label>
                                 <input type="text" class="form-control code"  name="coupon_code" required placeholder="Coupon code" value="<?php echo $value->m_coupon_code?>">
                            </div>
                            <div class="col-md-12">
                                <label for="order">Coupon Detail</label>
                                <textarea class="form-control" name="coupon_details" rows="3"><?php echo $value->m_coupon_detail?></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="Name">Discount Type <span class="text-danger">*</span></label>
                                <select class="form-control mb-3" name="dis_type" required >
                                   <option value="">Select Discount Type</option>
                                    
                                    <option value="1" <?php if($value->m_coupon_discount_type ==1)echo 'selected'; ?> selected>Percentage</option>
                               
                                </select>
                            </div>
                            <div class="col-md-6">
                                    <label for="Name">Discount Percentage</label>
                                    <input type="text" class="form-control dis-percentage" name="dis_percentage" minlength="0" maxlength="3" pattern="\d+(\.\d{1,2})?" value="<?php echo $value->m_coupon_discount?>" placeholder="Discount Percentage" title="Enter a valid percentage (up to two decimal places)" oninput="validateDiscount(this)">
                                    <div class="invalid-feedback dis-percentage-error">Discount percentage must be a valid number up to 100.</div>
                                </div>
                            <div class="col-md-6">
                                <label for="Name">Coupon Min Amount</label>
                                <input type="text" class="form-control" name="min_amount" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" placeholder="Coupon Min Amount" value="<?php echo $value->m_coupon_min_amount?>">
                            </div>

                              <div class="col-md-6">
                                <label for="date">Start Date<span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="start_date"  required value="<?php echo $value->m_coupon_start ?>">
                            </div>
                             <div class="col-md-6">
                                <label for="date">End Date<span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="end_date"  required value="<?php echo $value->m_coupon_end ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="Name">Status <span class="text-danger">*</span></label>
                                <select class="form-control mb-3" name="coupon_status" required >
                                   <option value="">Select Status</option>
                                    
                                    <option value="1" <?php if($value->m_coupon_status ==1)echo 'selected'; ?> >Active</option>
                                    <option value="2" <?php if($value->m_coupon_status ==2)echo 'selected'; ?> >In-Active</option>
                               
                                </select>
                            </div>
                            
                            <div class="canvas-footer justify-content-end d-flex">
                                <button type="submit" id="btn_coupon_edit" class="btn btn-primary me-2"><i class="fa-regular fa-pen-to-square"></i> Create</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="offcanvas" aria-label="Close">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
                <button type="button" data-value="<?php echo $value->m_coupon_id;?>" class="btn btn-primary coupon-delete btn-sm"><i class="fa-solid fa-trash"></i></button>
                <!-- <a href="<?php echo base_url('uploads/expense_doc/'.$cat_img);  ?>" target="_blank" data-value="<?php echo $value->m_expense_id ?>" class="btn btn-primary  btn-sm"><i class="fa-solid fa-download"></i></a> -->
               

                   

            </td>
        </tr>
    <?php $i++;}}  ?>
    </tbody>
    </table>
</div>



<!-- ========== Page Content ========== -->
<?php include("footer.php"); ?>
<?php $this->view('js/main_js'); ?>
<?php $this->view('js/custom_js'); ?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {

        // Listen for the input event on the category_name field
        $('#coupon_title').on('input', function() {
            // alert('hello');
            generatecodeadd();
        });
    });

    function generatecodeadd() {
        var couponName = $('#coupon_title').val().trim();
        var code = couponName.toLowerCase().replace(/[^a-z0-9-]+/g, '-');
        $('#code').val(code);

        
    }
</script>
<script>

  $(document).ready(function() {

        // Listen for the input event on the category_name field
        $('.coupon_title').on('input', function() {
            // alert('hello');
            generatecode1add();
        });
    });

    function generatecode1add() {
        var couponName = $('.coupon_title').val().trim();
        var code = couponName.toLowerCase().replace(/[^a-z0-9-]+/g, '-');
        $('.code').val(code);

        
    }  
</script>


