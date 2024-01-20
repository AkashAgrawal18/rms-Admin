<?php include("head.php"); ?>
<?php include("header.php"); ?>

<style>
    .cust {
        color: #000 !important;
    }

    .offcanvas.offcanvas-end {
        width: 700px !important;
    }

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
                    <a href="<?php echo base_url('Dashboard');?>" class="text-white text-decoration-none ">Dashboard</a> >> Parties >> <a href="<?php echo base_url('Main/supplier');?>" class="text-decoration-none fw-bold"><span class="text-warning"> Suppliers</span></a>
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

<div class="container-fluid bg-light" id="main-body" style="min-height:75vh">
    <div class="row pt-3">
        <div class="col-md-7">
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="offcanvas" data-bs-target="#staticBackdropadd" aria-controls="staticBackdrop"><i class="fa-solid fa-plus"></i> Add New Suppliers</button>

            <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="staticBackdropadd" aria-labelledby="staticBackdropLabel">
                                <div class="offcanvas-header">
                                    <h5 class="offcanvas-title m-0" id="staticBackdropLabel">Add Suppliers</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <hr>
                                <div class="offcanvas-body">
                                    <form class="row g-3" method="POST" id="form-supplier-add">
                                        
                                        <div class="col-md-6">
                                            <label for="Name">Name<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="suppl_name" required placeholder="Please Enter Name"  >
                                        </div>
                                        <div class="col-md-6">
                                            <input type="hidden" name="m_acc_type" value="4">
                                            <label for="Name">Phone Number<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="suppl_mobile" id="smobile" maxlength="10" minlength="10" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)"  placeholder="Please Enter Number" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Name">Email</label>
                                            <input type="email" class="form-control" name="suppl_email" placeholder="Please Enter Email" >
                                        </div>
                                        <div class="col-md-6">
                                            <label for="order">Status </label>
                                            <select class="form-control" name="suppl_status" >
                                                <option value="1" selected>Active</option>
                                                <option value="2">In-Active</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Name">Password</label>
                                            <input type="text" class="form-control" name="suppl_pass" placeholder="Please Enter Password">
                                        </div>
                                        <div class="col-md-6 ">
                                            <label for="image">Profile Image</label>
                                            <input type="file" class="form-control-file" name="suppl_image" >
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Name">Tax Number</label>
                                            <input type="text" class="form-control" name="suppl_text_num"  placeholder="Please Enter Tax Number"  onkeypress="return (event.charCode >= 48 && event.charCode <= 57)"  value="0" >
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Name">Opening Balance</label>
                                            <input type="text" class="form-control" name="suppl_open_balance"  placeholder="Please Enter Tax Number" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)"  value="0" >
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Name">Credit Period</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="suppl_credit_period"  onkeypress="return (event.charCode >= 48 && event.charCode <= 57)"   aria-label="Dollar amount (with dot and two decimal places)"  value="0">
                                                <span class="input-group-text">Day(s)</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Name">Credit Limit</label>
                                            <div class="input-group">
                                                <span class="input-group-text">₹</span>
                                                <input type="text" class="form-control" name="credit_limit" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" aria-label="Dollar amount (with dot and two decimal places)"  value="0">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="Name">Billing Address</label>
                                            <textarea class="form-control" name="Billing_address" rows="2"></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="Name">Shipping Address</label>
                                            <textarea class="form-control" name="shipping_address" rows="2"></textarea>
                                        </div>
                                        <div class="canvas-footer justify-content-end d-flex">
                                            <button type="submit" id="btn-supplier-add" class="btn btn-primary me-2"><i class="fa-regular fa-pen-to-square"></i> Create</button>
                                            <button type="button" class="btn btn-secondary"class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-file-import"></i> Import Supplierss</button>

           
        </div>
        <div class="col-md-5">
            <div class="input-group form-group">
                <form method="get" action="<?php echo base_url('Main/supplier');  ?>">
                    <div class="form-outline" data-mdb-input-init>
                    <input type="text" name="search" class="form-control" value="<?php echo $search; ?>" />
                    <!-- <label class="form-label" for="form1">Search</label> -->
                </div>
                <button type="submit" class="btn btn-primary me-2" data-mdb-ripple-init>
                    <i class="fas fa-search"></i>
                </button>
                <a type="submit" href="<?php echo base_url('Main/supplier');  ?>" class="btn btn-primary me-2" data-mdb-ripple-init>
                   <i class="fa-solid fa-rotate"></i>
                </a>
                </form>
                <form action="<?php echo base_url('Main/supplier');?>"  method="get" >
                    <select class="form-select" name="status" onchange="this.form.submit();" aria-label="Default select example" >
                    <option selected >Select Status</option>
                    <option value="1" <?php if($status == 1) echo "selected"; ?>>Active</option>
                    <option value="2" <?php if($status == 2) echo "selected"; ?>>In-Active</option>
                </select>
                </form>

                
            </div>
        </div>
    </div>
    <br>
    <table class="table my_custom_datatable table-bordered mt-4" id="supplier_tbl">
                 <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th>Balance</th>
                        <th>Status</th>
                        <th>Action</th>

                    </tr>
                    </thead>
                     <tbody>
                   <?php 
                   $i = 1;  
                   if (!empty($all_value)) {
                    foreach ($all_value as $value) {?>
                    
                  
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $value->m_acc_name; ?></td>
                        <td><?php echo $value->m_acc_email; ?></td>
                        <td><?php echo date('d-m-Y, h:i a', strtotime($value->m_acc_added_on));  ?></td>
                        <td><i class="fa-solid fa-arrow-up" style="color: #c61010;"></i> ₹<?php echo number_format($value->m_acc_open_balance, 2, '.', ','); ?></td>
                        <td><span class="badge badgef bg-success p-1"><?php if($value->m_acc_status == 1){echo 'Active';}else{echo 'In-Active';}  ?></span></td>
                        <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="offcanvas" data-bs-target="#staticBackdropview<?php echo $value->m_acc_id;?>" aria-controls="staticBackdrop"><i class="fas fa-eye"></i></button>

                            <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="staticBackdropview<?php echo $value->m_acc_id;?>" aria-labelledby="staticBackdropLabel">
                                <div class="offcanvas-header">
                                    <h5 class="offcanvas-title" id="staticBackdropLabel"><?php echo $value->m_acc_name; ?> (Supplier name)</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <hr>
                                <div class="offcanvas-body">
                                    <div>

                                        <?php
                                            if (!empty($value->m_acc_image) && file_exists('uploads/user/'.$value->m_acc_image)) {
                                                $user_img = base_url('uploads/user/'.$value->m_acc_image);
                                              } else {
                                                $user_img = base_url('assets/imgs/user.png');
                                              }
                                            ?>
                                        <div class="row g-4">
                                            <div class="col-md-3">
                                                <img src="<?php echo $user_img;?>" alt="" class="w-100">

                                            </div>
                                            <div class="col-md-9">
                                                <h6>Supplier Details</h6>
                                                <div class="row g-4">
                                                    <div class="col-4">
                                                        Name : <br> <?php echo $value->m_acc_name; ?>
                                                    </div>
                                                    <div class="col-4">
                                                        Email :<br> <?php echo $value->m_acc_email; ?>
                                                    </div>
                                                    <div class="col-4">
                                                        Phone Number :<br> <?php echo $value->m_acc_mobile; ?>
                                                    </div>
                                                    <div class="col-4">
                                                        Opening Balance :<br> ₹<?php echo number_format($value->m_acc_open_balance, 2, '.', ','); ?>
                                                    </div>
                                                    <div class="col-8">
                                                        Billing Address :<br> <?php echo $value->m_acc_address; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row g-4">

                                                    <div class="col-4">
                                                        Credit Period :<br> <?php echo $value->m_acc_credit_period; ?>Days
                                                    </div>
                                                    <div class="col-4">
                                                        Credit Limit :<br> <?php echo $value->m_acc_credit_limit; ?>
                                                    </div>
                                                    <div class="col-4">
                                                        Balance :<br><i class="fa-solid fa-arrow-down" style="color: #237500;"></i> ₹<?php echo number_format($value->m_acc_open_balance, 2, '.', ','); ?>
                                                    </div>
                                                    <div class="col-12">
                                                        Tax Number :<br>  <?php echo $value->m_acc_text_num; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-4">
                                                <h5>Transactions</h5>
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th>Payment Date</th>
                                                        <th>Txns No.</th>
                                                        <th>Payment Type</th>
                                                        <th>User</th>
                                                        <th>Amount</th>

                                                    </tr>
                                                    <!-- <tr>
                                                        <td>12-11-2023</td>
                                                        <td>SALE-RET-85</td>
                                                        <td>sales-returns</td>
                                                        <td>Shivani</td>
                                                        <td>₹500</td>
                                                    </tr>
                                                    <tr>
                                                        <td>12-11-2023</td>
                                                        <td>SALE-RET-85</td>
                                                        <td>sales-returns</td>
                                                        <td>Shivani</td>
                                                        <td>₹500</td>
                                                    </tr> -->
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="offcanvas" data-bs-target="#staticBackdropedit<?php echo $value->m_acc_id;?>" aria-controls="staticBackdrop"><i class="fa-solid fa-pen-to-square"></i></button>
                            

                            <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="staticBackdropedit<?php echo $value->m_acc_id;?>" aria-labelledby="staticBackdropLabel">
                                <div class="offcanvas-header">
                                    <h5 class="offcanvas-title m-0" id="staticBackdropLabel">Edit Supplier</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <hr>
                               
                                <div class="offcanvas-body">
                                    <form class="row g-3" method="POST" id="form-supplier-edit">
                                       
                                        <div class="col-md-6">
                                            <label for="Name">Name<span class="text-danger">*</span></label>
                                             <input type="hidden" class="form-control-file" name="suppl_id" value="<?php echo $value->m_acc_id;  ?>" >
                                              <input type="hidden" class="form-control-file" name="m_acc_type" value="4">

                                            <input type="text" class="form-control" name="suppl_name" required placeholder="Please Enter Name" value="<?php echo $value->m_acc_name;  ?>" >
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Name">Phone Number<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="suppl_mobile" maxlength="10" minlength="10" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)"  placeholder="Please Enter Number" value="<?php echo $value->m_acc_mobile;  ?>" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Name">Email</label>
                                            <input type="email" class="form-control" name="suppl_email" placeholder="Please Enter Email" value="<?php echo $value->m_acc_email;  ?>" >
                                        </div>
                                        <div class="col-md-6">
                                            <label for="order">Status</label>
                                            <select class="form-control" name="suppl_status" >
                                                <option value="1" <?php if($value->m_acc_status ==1)echo 'selected'; ?>>Active</option>
                                                <option value="2" <?php if($value->m_acc_status == 0)echo 'selected'; ?>>In-Active</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Name">Password</label>
                                            <input type="text" class="form-control" name="suppl_pass" placeholder="Please Enter Password" value="<?php echo $value->m_acc_password;  ?>">
                                        </div>
                                         <div class="col-md-6 ">
                                            <label for="image">Profile Image</label>
                                             <input type="hidden" class="form-control-file" name="suppl_image1" value="<?php echo $value->m_acc_image;  ?>" >
                                            <input type="file" class="form-control-file" name="suppl_image" >
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Name">Tax Number</label>
                                            <input type="text" class="form-control" name="suppl_text_num"  placeholder="Please Enter Tax Number"  onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" value="<?php echo $value->m_acc_text_num;  ?>"  >
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Name">Opening Balance</label>
                                            <input type="text" class="form-control" name="suppl_open_balance"  placeholder="Please Enter Tax Number" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" value="<?php echo $value->m_acc_open_balance;  ?>" >
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Name">Credit Period</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="suppl_credit_period"  onkeypress="return (event.charCode >= 48 && event.charCode <= 57)"   aria-label="Dollar amount (with dot and two decimal places)" value="<?php echo $value->m_acc_credit_period;  ?>">
                                                <span class="input-group-text">Day(s)</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Name">Credit Limit</label>
                                            <div class="input-group">
                                                <span class="input-group-text">₹</span>
                                                <input type="text" class="form-control" name="suppl_limit" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" aria-label="Dollar amount (with dot and two decimal places)" value="<?php echo $value->m_acc_credit_limit;  ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="Name">Billing Address</label>
                                            <textarea class="form-control" name="Billing_address" rows="2"><?php echo $value->m_acc_address  ?></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="Name">Shipping Address</label>
                                            <textarea class="form-control" name="shipping_address" rows="2"> <?php echo $value->m_acc_saddress  ?></textarea>
                                        </div>
                                        <div class="canvas-footer justify-content-end d-flex">
                                            <button type="submit" id="btn-supplier-edit" class="btn btn-primary me-2"><i class="fa-regular fa-pen-to-square"></i> Create</button>
                                            <button type="button" class="btn btn-secondary" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary delete_supplier btn-sm" data-value="<?php echo $value->m_acc_id; ?>" ><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                     <?php $i++; }}  ?>
                   </tbody>
                </table>



                <!-- Import Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Import Supplier</h5>
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
<form method="POST" action="<?php echo site_url('Main/import_supplier') ?>" enctype="multipart/form-data">
  <input class="form-control" type="file" id="formFile" name="import_file" required>
  
      </div>
      <div class="modal-footer">
        <a  href="<?php echo base_url('uploads/Users_sample.xlsx'); ?>" class="btn btn-secondary btn-sm "><i class="fa-solid fa-download"></i> Download</a>
        <button type="submit" class="btn btn-primary btn-sm" data-bs-dismiss="modal">Import</button>
      </div>
       </form>
    </div>
  </div>
</div>
    <!-- <div class="col-md-12 mt-4">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link cust active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all-tab-pane" type="button" role="tab" aria-controls="all-tab-pane" aria-selected="true">All</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link cust" id="collect-tab" data-bs-toggle="tab" data-bs-target="#collect-tab-pane" type="button" role="tab" aria-controls="collect-tab-pane" aria-selected="false">To Collect</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link cust" id="pay-tab" data-bs-toggle="tab" data-bs-target="#pay-tab-pane" type="button" role="tab" aria-controls="pay-tab-pane" aria-selected="false">To Pay</button>
            </li>
        </ul>
        
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="all-tab-pane" role="tabpanel" aria-labelledby="all-tab" tabindex="0">
                <table class="table table-bordered">
                    <tr>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th>Balance</th>
                        <th>Status</th>
                        <th>Action</th>

                    </tr>
                    <tr>
                        <td>01</td>
                        <td>XYZ</td>
                        <td>XYZ@gmail.com</td>
                        <td>26-11-2023, 04:30 pm</td>
                        <td><i class="fa-solid fa-arrow-up" style="color: #c61010;"></i> ₹100.00</td>
                        <td><span class="badge badgef bg-success p-1">Enabled</span></td>
                        <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop1" aria-controls="staticBackdrop"><i class="fas fa-eye"></i></button>

                            <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop1" aria-labelledby="staticBackdropLabel">
                                <div class="offcanvas-header">
                                    <h5 class="offcanvas-title" id="staticBackdropLabel">XYZ (customer name)</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <hr>
                                <div class="offcanvas-body">
                                    <div>
                                        <div class="row g-4">
                                            <div class="col-md-3">
                                                <img src="<?php echo base_url();?>assets/imgs/user.png" alt="" class="w-100">
                                            </div>
                                            <div class="col-md-9">
                                                <h6>Customer Details</h6>
                                                <div class="row g-4">
                                                    <div class="col-4">
                                                        Name : <br> XYZ
                                                    </div>
                                                    <div class="col-4">
                                                        Email :<br> XYZ@gmail.com
                                                    </div>
                                                    <div class="col-4">
                                                        Phone Number :<br> +1234567890
                                                    </div>
                                                    <div class="col-4">
                                                        Opening Balance :<br> ₹100.00
                                                    </div>
                                                    <div class="col-8">
                                                        Billing Address :<br> xyz
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row g-4">

                                                    <div class="col-4">
                                                        Credit Period :<br> 30Days
                                                    </div>
                                                    <div class="col-4">
                                                        Credit Limit :<br> -
                                                    </div>
                                                    <div class="col-4">
                                                        Balance :<br><i class="fa-solid fa-arrow-down" style="color: #237500;"></i> ₹500.59
                                                    </div>
                                                    <div class="col-12">
                                                        Tax Number :<br> -
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-4">
                                                <h5>Transactions</h5>
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th>Payment Date</th>
                                                        <th>Txns No.</th>
                                                        <th>Payment Type</th>
                                                        <th>User</th>
                                                        <th>Amount</th>

                                                    </tr>
                                                    <tr>
                                                        <td>12-11-2023</td>
                                                        <td>SALE-RET-85</td>
                                                        <td>sales-returns</td>
                                                        <td>XYZ</td>
                                                        <td>₹500</td>
                                                    </tr>
                                                    <tr>
                                                        <td>12-11-2023</td>
                                                        <td>SALE-RET-85</td>
                                                        <td>sales-returns</td>
                                                        <td>XYZ</td>
                                                        <td>₹500</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-trash"></i></button>

                            <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop" aria-labelledby="staticBackdropLabel">
                                <div class="offcanvas-header">
                                    <h5 class="offcanvas-title m-0" id="staticBackdropLabel">Edit Customer</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <hr>
                                <div class="offcanvas-body">
                                    <form class="row g-3" method="POST" id="form-supplier-edit">
                                        <div class="col-md-6 ">
                                            <label for="image">Profile Image</label>
                                            <input type="hidden" class="form-control-file" name="suppl_image1" value="<<?php echo $value->m_acc_image;  ?>" >
                                            <input type="file" class="form-control-file" name="suppl_image" >
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Name">Name<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="suppl_name" required placeholder="Please Enter Name"  >
                                        </div>
                                        <div class="col-md-6">
                                            <input type="hidden" name="m_acc_type" value="4">
                                            <label for="Name">Phone Number<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="suppl_mobile" maxlength="10" minlength="10" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)"  placeholder="Please Enter Number" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Name">Email<span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" name="suppl_email" placeholder="Please Enter Email" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="order">Status <span class="text-danger">*</span></label>
                                            <select class="form-control" name="suppl_status" required>
                                                <option value="1">Enabled</option>
                                                <option value="0">Disabled</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Name">Password</label>
                                            <input type="text" class="form-control" name="suppl_pass" placeholder="Please Enter Password">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Name">Tax Number</label>
                                            <input type="text" class="form-control" name="suppl_text_num"  placeholder="Please Enter Tax Number"  onkeypress="return (event.charCode >= 48 && event.charCode <= 57)"  >
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Name">Opening Balance</label>
                                            <input type="text" class="form-control" name="suppl_open_balance"  placeholder="Please Enter Tax Number" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" >
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Name">Credit Period</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="suppl_credit_period"  onkeypress="return (event.charCode >= 48 && event.charCode <= 57)"   aria-label="Dollar amount (with dot and two decimal places)">
                                                <span class="input-group-text">Day(s)</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Name">Credit Limit</label>
                                            <div class="input-group">
                                                <span class="input-group-text">₹</span>
                                                <input type="text" class="form-control" name="credit_limit" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" aria-label="Dollar amount (with dot and two decimal places)">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="Name">Billing Address</label>
                                            <textarea class="form-control" name="Billing_address" rows="2"></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="Name">Shipping Address</label>
                                            <textarea class="form-control" name="shipping_address" rows="2"></textarea>
                                        </div>
                                        <div class="canvas-footer justify-content-end d-flex">
                                            <button type="submit" id="btn-supplier-add" class="btn btn-primary me-2"><i class="fa-regular fa-pen-to-square"></i> Create</button>
                                            <button type="button" class="btn btn-secondary" ata-bs-dismiss="offcanvas" aria-label="Close" data-bs-dismiss="modal">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>01</td>
                        <td>XYZ</td>
                        <td>XYZ@gmail.com</td>
                        <td>26-11-2023, 04:30 pm</td>
                        <td><i class="fa-solid fa-arrow-down" style="color: #237500;"></i> ₹100.00</td>
                        <td><span class="badge badgef bg-success p-1">Enabled</span></td>
                        <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop1" aria-controls="staticBackdrop"><i class="fas fa-eye"></i></button>

                            <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop1" aria-labelledby="staticBackdropLabel">
                                <div class="offcanvas-header">
                                    <h5 class="offcanvas-title" id="staticBackdropLabel">XYZ (customer name)</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <hr>
                                <div class="offcanvas-body">
                                    <div>
                                        <div class="row g-4">
                                            <div class="col-md-3">
                                                <img src="<?php echo base_url();?>assets/imgs/user.png" alt="" class="w-100">
                                            </div>
                                            <div class="col-md-9">
                                                <h6>Customer Details</h6>
                                                <div class="row g-4">
                                                    <div class="col-4">
                                                        Name : <br> XYZ
                                                    </div>
                                                    <div class="col-4">
                                                        Email :<br> XYZ@gmail.com
                                                    </div>
                                                    <div class="col-4">
                                                        Phone Number :<br> +1234567890
                                                    </div>
                                                    <div class="col-4">
                                                        Opening Balance :<br> ₹100.00
                                                    </div>
                                                    <div class="col-8">
                                                        Billing Address :<br> xyz
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row g-4">

                                                    <div class="col-4">
                                                        Credit Period :<br> 30Days
                                                    </div>
                                                    <div class="col-4">
                                                        Credit Limit :<br> -
                                                    </div>
                                                    <div class="col-4">
                                                        Balance :<br><i class="fa-solid fa-arrow-down" style="color: #237500;"></i> ₹500.59
                                                    </div>
                                                    <div class="col-12">
                                                        Tax Number :<br> -
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-4">
                                                <h5>Transactions</h5>
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th>Payment Date</th>
                                                        <th>Txns No.</th>
                                                        <th>Payment Type</th>
                                                        <th>User</th>
                                                        <th>Amount</th>

                                                    </tr>
                                                    <tr>
                                                        <td>12-11-2023</td>
                                                        <td>SALE-RET-85</td>
                                                        <td>sales-returns</td>
                                                        <td>XYZ</td>
                                                        <td>₹500</td>
                                                    </tr>
                                                    <tr>
                                                        <td>12-11-2023</td>
                                                        <td>SALE-RET-85</td>
                                                        <td>sales-returns</td>
                                                        <td>XYZ</td>
                                                        <td>₹500</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-trash"></i></button>

                            <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop" aria-labelledby="staticBackdropLabel">
                                <div class="offcanvas-header">
                                    <h5 class="offcanvas-title m-0" id="staticBackdropLabel">Edit Customer</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <hr>
                                <div class="offcanvas-body">
                                    <div class="row g-3">
                                        <div class="col-md-6 ">
                                            <label for="image">Profile Image</label>
                                            <input type="file" class="form-control-file" id="exampleFormControlFile1">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Name">Name<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="name" placeholder="Please Enter Name">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Name">Phone Number<span class="text-danger">*</span></label>
                                            <input type="tel" class="form-control" id="num" placeholder="Please Enter Number">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Name">Email<span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" id="mail" placeholder="Please Enter Email">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="order">Status <span class="text-danger">*</span></label>
                                            <select class="form-control" id="exampleFormControlSelect1">
                                                <option>Enabled</option>
                                                <option>Disabled</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Name">Password</label>
                                            <input type="password" class="form-control" id="pass" placeholder="Please Enter Password">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Name">Tax Number</label>
                                            <input type="tel" class="form-control" id="tax" placeholder="Please Enter Tax Number">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Name">Opening Balance</label>
                                            <input type="tel" class="form-control" id="tax" placeholder="Please Enter Tax Number">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Name">Credit Period</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" aria-label="Dollar amount (with dot and two decimal places)">
                                                <span class="input-group-text">Day(s)</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Name">Credit Limit</label>
                                            <div class="input-group">
                                                <span class="input-group-text">₹</span>
                                                <input type="number" class="form-control" aria-label="Dollar amount (with dot and two decimal places)">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="Name">Billing Address</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="Name">Shipping Address</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
                                        </div>
                                        <div class="canvas-footer justify-content-end d-flex">
                                            <button type="button" class="btn btn-primary me-2"><i class="fa-regular fa-pen-to-square"></i> Create</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>


            <div class="tab-pane fade" id="collect-tab-pane" role="tabpanel" aria-labelledby="collect-tab" tabindex="0">
                <table class="table table-bordered">
                    <tr>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th>Balance</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    <tr>
                        <td>01</td>
                        <td>XYZ</td>
                        <td>XYZ@gmail.com</td>
                        <td>26-11-2023, 04:30 pm</td>
                        <td><i class="fa-solid fa-arrow-down" style="color: #237500;"></i> ₹100.00</td>
                        <td><span class="badge badgef bg-success p-1">Enabled</span></td>
                        <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop1" aria-controls="staticBackdrop"><i class="fas fa-eye"></i></button>

                            <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop1" aria-labelledby="staticBackdropLabel">
                                <div class="offcanvas-header">
                                    <h5 class="offcanvas-title" id="staticBackdropLabel">XYZ (customer name)</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <hr>
                                <div class="offcanvas-body">
                                    <div>
                                        <div class="row g-4">
                                            <div class="col-md-3">
                                                <img src="<?php echo base_url();?>assets/imgs/user.png" alt="" class="w-100">
                                            </div>
                                            <div class="col-md-9">
                                                <h6>Customer Details</h6>
                                                <div class="row g-4">
                                                    <div class="col-4">
                                                        Name : <br> XYZ
                                                    </div>
                                                    <div class="col-4">
                                                        Email :<br> XYZ@gmail.com
                                                    </div>
                                                    <div class="col-4">
                                                        Phone Number :<br> +1234567890
                                                    </div>
                                                    <div class="col-4">
                                                        Opening Balance :<br> ₹100.00
                                                    </div>
                                                    <div class="col-8">
                                                        Billing Address :<br> xyz
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row g-4">

                                                    <div class="col-4">
                                                        Credit Period :<br> 30Days
                                                    </div>
                                                    <div class="col-4">
                                                        Credit Limit :<br> -
                                                    </div>
                                                    <div class="col-4">
                                                        Balance :<br><i class="fa-solid fa-arrow-down" style="color: #237500;"></i> ₹500.59
                                                    </div>
                                                    <div class="col-12">
                                                        Tax Number :<br> -
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-4">
                                                <h5>Transactions</h5>
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th>Payment Date</th>
                                                        <th>Txns No.</th>
                                                        <th>Payment Type</th>
                                                        <th>User</th>
                                                        <th>Amount</th>

                                                    </tr>
                                                    <tr>
                                                        <td>12-11-2023</td>
                                                        <td>SALE-RET-85</td>
                                                        <td>sales-returns</td>
                                                        <td>XYZ</td>
                                                        <td>₹500</td>
                                                    </tr>
                                                    <tr>
                                                        <td>12-11-2023</td>
                                                        <td>SALE-RET-85</td>
                                                        <td>sales-returns</td>
                                                        <td>XYZ</td>
                                                        <td>₹500</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-trash"></i></button>

                            <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop" aria-labelledby="staticBackdropLabel">
                                <div class="offcanvas-header">
                                    <h5 class="offcanvas-title m-0" id="staticBackdropLabel">Edit Customer</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <hr>
                                <div class="offcanvas-body">
                                    <div class="row g-3">
                                        <div class="col-md-6 ">
                                            <label for="image">Profile Image</label>
                                            <input type="file" class="form-control-file" id="exampleFormControlFile1">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Name">Name<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="name" placeholder="Please Enter Name">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Name">Phone Number<span class="text-danger">*</span></label>
                                            <input type="tel" class="form-control" id="num" placeholder="Please Enter Number">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Name">Email<span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" id="mail" placeholder="Please Enter Email">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="order">Status <span class="text-danger">*</span></label>
                                            <select class="form-control" id="exampleFormControlSelect1">
                                                <option>Enabled</option>
                                                <option>Disabled</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Name">Password</label>
                                            <input type="password" class="form-control" id="pass" placeholder="Please Enter Password">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Name">Tax Number</label>
                                            <input type="tel" class="form-control" id="tax" placeholder="Please Enter Tax Number">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Name">Opening Balance</label>
                                            <input type="tel" class="form-control" id="tax" placeholder="Please Enter Tax Number">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Name">Credit Period</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" aria-label="Dollar amount (with dot and two decimal places)">
                                                <span class="input-group-text">Day(s)</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Name">Credit Limit</label>
                                            <div class="input-group">
                                                <span class="input-group-text">₹</span>
                                                <input type="number" class="form-control" aria-label="Dollar amount (with dot and two decimal places)">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="Name">Billing Address</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="Name">Shipping Address</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
                                        </div>
                                        <div class="canvas-footer justify-content-end d-flex">
                                            <button type="button" class="btn btn-primary me-2"><i class="fa-regular fa-pen-to-square"></i> Create</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                </table>
            </div>
            <div class="tab-pane fade" id="pay-tab-pane" role="tabpanel" aria-labelledby="pay-tab" tabindex="0">
                <table class="table table-bordered">
                    <tr>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th>Balance</th>
                        <th>Status</th>
                        <th>Action</th>

                    </tr>
                    <tr>
                        <td>01</td>
                        <td>XYZ</td>
                        <td>XYZ@gmail.com</td>
                        <td>26-11-2023, 04:30 pm</td>
                        <td><i class="fa-solid fa-arrow-up" style="color: #c61010;"></i> ₹100.00</td>
                        <td><span class="badge badgef bg-success p-1">Enabled</span></td>
                        <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop1" aria-controls="staticBackdrop"><i class="fas fa-eye"></i></button>


                            <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop1" aria-labelledby="staticBackdropLabel">
                                <div class="offcanvas-header">
                                    <h5 class="offcanvas-title" id="staticBackdropLabel">XYZ (customer name)</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <hr>
                                <div class="offcanvas-body">
                                    <div>
                                        <div class="row g-4">
                                            <div class="col-md-3">
                                                <img src="<?php echo base_url();?>assets/imgs/user.png" alt="" class="w-100">
                                            </div>
                                            <div class="col-md-9">
                                                <h6>Customer Details</h6>
                                                <div class="row g-4">
                                                    <div class="col-4">
                                                        Name : <br> XYZ
                                                    </div>
                                                    <div class="col-4">
                                                        Email :<br> XYZ@gmail.com
                                                    </div>
                                                    <div class="col-4">
                                                        Phone Number :<br> +1234567890
                                                    </div>
                                                    <div class="col-4">
                                                        Opening Balance :<br> ₹100.00
                                                    </div>
                                                    <div class="col-8">
                                                        Billing Address :<br> xyz
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row g-4">

                                                    <div class="col-4">
                                                        Credit Period :<br> 30Days
                                                    </div>
                                                    <div class="col-4">
                                                        Credit Limit :<br> -
                                                    </div>
                                                    <div class="col-4">
                                                        Balance :<br><i class="fa-solid fa-arrow-down" style="color: #237500;"></i> ₹500.59
                                                    </div>
                                                    <div class="col-12">
                                                        Tax Number :<br> -
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-4">
                                                <h5>Transactions</h5>
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th>Payment Date</th>
                                                        <th>Txns No.</th>
                                                        <th>Payment Type</th>
                                                        <th>User</th>
                                                        <th>Amount</th>

                                                    </tr>
                                                    <tr>
                                                        <td>12-11-2023</td>
                                                        <td>SALE-RET-85</td>
                                                        <td>sales-returns</td>
                                                        <td>XYZ</td>
                                                        <td>₹500</td>
                                                    </tr>
                                                    <tr>
                                                        <td>12-11-2023</td>
                                                        <td>SALE-RET-85</td>
                                                        <td>sales-returns</td>
                                                        <td>XYZ</td>
                                                        <td>₹500</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-trash"></i></button>

                            <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop" aria-labelledby="staticBackdropLabel">
                                <div class="offcanvas-header">
                                    <h5 class="offcanvas-title m-0" id="staticBackdropLabel">Edit Customer</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <hr>
                                <div class="offcanvas-body">
                                    <div class="row g-3">
                                        <div class="col-md-6 ">
                                            <label for="image">Profile Image</label>
                                            <input type="file" class="form-control-file" id="exampleFormControlFile1">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Name">Name<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="name" placeholder="Please Enter Name">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Name">Phone Number<span class="text-danger">*</span></label>
                                            <input type="tel" class="form-control" id="num" placeholder="Please Enter Number">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Name">Email<span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" id="mail" placeholder="Please Enter Email">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="order">Status <span class="text-danger">*</span></label>
                                            <select class="form-control" id="exampleFormControlSelect1">
                                                <option>Enabled</option>
                                                <option>Disabled</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Name">Password</label>
                                            <input type="password" class="form-control" id="pass" placeholder="Please Enter Password">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Name">Tax Number</label>
                                            <input type="tel" class="form-control" id="tax" placeholder="Please Enter Tax Number">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Name">Opening Balance</label>
                                            <input type="tel" class="form-control" id="tax" placeholder="Please Enter Tax Number">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Name">Credit Period</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" aria-label="Dollar amount (with dot and two decimal places)">
                                                <span class="input-group-text">Day(s)</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Name">Credit Limit</label>
                                            <div class="input-group">
                                                <span class="input-group-text">₹</span>
                                                <input type="number" class="form-control" aria-label="Dollar amount (with dot and two decimal places)">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="Name">Billing Address</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="Name">Shipping Address</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
                                        </div>
                                        <div class="canvas-footer justify-content-end d-flex">
                                            <button type="button" class="btn btn-primary me-2"><i class="fa-regular fa-pen-to-square"></i> Create</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div> 
    </div> -->
</div>



<!-- ========== Page Content ========== -->
<?php include("footer.php"); ?>
<?php $this->view('js/main_js');  ?>
<?php $this->view('js/custom_js'); ?>