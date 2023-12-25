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
            <div class="col-xl-10 col-lg-10">
                <p class="m-0 text-white small fw-light">
                    <a href="<?php echo base_url('Dashboard'); ?>" class="text-white text-decoration-none ">Dashboard</a> >> Expenses >> <a href="<?php echo base_url('User/expenses'); ?>" class="text-decoration-none fw-bold"><span class="text-warning"> Expenses</span></a>
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
            <button type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRightadd" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus"></i> Add New Expense</button>

             <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRightadd" aria-labelledby="offcanvasRightLabel">
                    <div class="offcanvas-header">
                        <h5 id="offcanvasRightLabel">Add Expense</h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <form class="offcanvas-body" method="post" id="form_expense_add">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="Name">Expense Category <span class="text-danger">*</span></label>
                                <select class="form-control mb-3" name="m_expense_cat_id" required>
                                       <option value="">Select Expense Category </option>
                                    <?php if($expcat){
                                         foreach($expcat as $value){  ?>
                                    
                                    <option value="<?php echo $value->m_expcat_id;  ?>"><?php echo $value->m_expcat_title;  ?></option>
                                <?php }} ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="Name">User <span class="text-danger">*</span></label>
                                <select class="form-control mb-3" name="m_expense_user_id" required >
                                   <option value="">Select User</option>
                                    <?php if($user){
                                         foreach($user as $value){  ?>
                                    
                                    <option value="<?php echo $value->m_user_id;  ?>"><?php echo $value->m_user_name;  ?></option>
                                <?php }} ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="Name">Date<span class="text-danger">*</span></label>
                                <input type="date" class="form-control" required  name="m_expense_date">
                            </div>
                            <div class="col-md-6">
                                <label for="Name">Amount</label>
                                <input type="text" class="form-control" name="m_expense_amount" id="amount" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" placeholder="Amount">
                            </div>
                            <div class="col-md-6">
                                <label for="Name">Expense Bill</label>
                                <input class="form-control" type="file" name="m_expense_image" id="formFile">
                            </div>
                            <div class="col-md-12">
                                <label for="order">Notes</label>
                                <textarea class="form-control" name="m_expense_note" rows="3"></textarea>
                            </div>
                            <div class="canvas-footer justify-content-end d-flex">
                                <button type="submit" id="btn_expense_add" class="btn btn-primary me-2"><i class="fa-regular fa-pen-to-square"></i> Create</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="offcanvas" aria-label="Close">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
        <div class="col-md-5">
            <div class="input-group form-group">
                <form method="get" action="<?php echo base_url('User/expenses');  ?>">
                    <div class="form-outline" data-mdb-input-init>
                    <input type="text" name="search" class="form-control" value="<?php echo $search; ?>" />
                    <!-- <label class="form-label" for="form1">Search</label> -->
                </div>
                <button type="submit" class="btn btn-primary me-2" data-mdb-ripple-init>
                    <i class="fas fa-search"></i>
                </button>
                <a type="submit" href="<?php echo base_url('User/expenses');  ?>" class="btn btn-primary me-2" data-mdb-ripple-init>
                   <i class="fa-solid fa-rotate"></i>
                </a>
                </form>
               <form action="<?php echo base_url('User/expenses');?>"  method="get" >
                    <select class="form-select" name="user" onchange="this.form.submit();" aria-label="Default select example" >
                        <option value="">Select User</option>
                     <?php if($user){
                         foreach($user as $value){  ?>
                    
                    <option value="<?php echo $value->m_user_id;  ?>"<?php if($user_exp ==$value->m_user_id)echo 'selected';  ?>><?php echo $value->m_user_name;  ?></option>
                <?php }} ?>
                </select>
                </form>
                <!-- <input type="date" id="date" name="date" class="form-control"> -->
            </div>
        </div>
    </div>
    <br>

    <table class="table my_custom_datatable table-bordered mt-3" id="expense_tbl">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Expense Category</th>
            <th>Amount</th>
            <th>Date</th>
            <th>User</th>
            <th>Action</th>

        </tr>
    </thead>
    <tbody>
         <?php 

            $i = 1;
              if($all_value){
              foreach($all_value as $value){

                if (!empty($value->m_expense_image) && file_exists('uploads/categories/'.$value->m_expense_image)) {
                $cat_img = base_url('uploads/categories/'.$value->m_expense_image);
              } else {
                $cat_img = base_url('assets/imgs/user.png');
              }

              ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $value->m_expcat_title; ?></td>
            <td>₹<?php echo $value->m_expense_amount; ?></td>
            <td><?php echo date('d-n-Y', strtotime($value->m_expense_date)); ?></td>
            <td><?php echo $value->m_user_name; ?></td>

            <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight<?php echo $value->m_expense_id  ?>" aria-controls="offcanvasRight<?php echo $value->m_expense_id  ?>"><i class="fa-solid fa-pen-to-square"></i></button>

                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight<?php echo $value->m_expense_id  ?>" aria-labelledby="offcanvasRightLabel">
                    <div class="offcanvas-header">
                        <h5 id="offcanvasRightLabel">Edit Expense</h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                   <form class="offcanvas-body" method="post" id="form_expense_edit">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="Name">Expense Category <span class="text-danger">*</span></label>
                                <input type="hidden" name="m_expense_id" value="<?php echo $value->m_expense_id  ?>">
                                <select class="form-control mb-3" name="m_expense_cat_id" required >
                                       <option value="">Select Expense Category </option>
                                    <?php if($expcat){
                                         foreach($expcat as $val){  ?>
                                    
                                    <option value="<?php echo $val->m_expcat_id;  ?>" <?php if($val->m_expcat_id == $value->m_expense_cat_id)echo 'selected'; ?>><?php echo $val->m_expcat_title;  ?></option>
                                <?php }} ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="Name">User <span class="text-danger">*</span></label>
                                <select class="form-control mb-3" name="m_expense_user_id" required >
                                   <option value="">Select User</option>
                                    <?php if($user){
                                         foreach($user as $val){  ?>
                                    
                                    <option value="<?php echo $val->m_user_id;  ?>" <?php if($val->m_user_id == $value->m_expense_user_id)echo 'selected'; ?>><?php echo $val->m_user_name;  ?></option>
                                <?php }} ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="Name">Date<span class="text-danger">*</span></label>
                                <input type="date" class="form-control" required  name="m_expense_date" value="<?php echo $value->m_expense_date  ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="Name">Amount</label>
                                <input type="text" class="form-control" name="m_expense_amount" value="<?php echo $value->m_expense_amount  ?>" id="amount">
                            </div>
                            <div class="col-md-6">
                                <label for="Name">Expense Bill</label>
                                <input class="form-control" type="hidden" name="m_expense_image1" id="formFile" value="<?php echo $value->m_expense_image  ?>">
                                <input class="form-control" type="file" name="m_expense_image" id="formFile">

                            </div>
                            <div class="col-md-12">
                                <label for="order">Notes</label>
                                <textarea class="form-control" name="m_expense_note" rows="3"> <?php echo $value->m_expense_note  ?></textarea>
                            </div>
                            <div class="canvas-footer justify-content-end d-flex">
                                <button type="submit" id="btn_expense_edit" class="btn btn-primary me-2"><i class="fa-regular fa-pen-to-square"></i> Update</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="offcanvas" aria-label="Close">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
                <button type="button" data-value="<?php echo $value->m_expense_id ?>" class="btn btn-primary expense-delete btn-sm"><i class="fa-solid fa-trash"></i></button>
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