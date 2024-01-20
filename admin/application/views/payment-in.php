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
                    <a href="<?php echo base_url('Dashboard');?>" class="text-white text-decoration-none ">Dashboard</a> >> Sales >> <a href="<?php echo base_url('Mainpayment_in');?>" class="text-decoration-none fw-bold"><span class="text-warning"> Payment In</span></a>
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
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="offcanvas" data-bs-target="#staticBackdropadd" aria-controls="staticBackdrop"><i class="fa-solid fa-plus"></i> Add New Payment</button>
        </div>
         <div class="col-md-5">
            <div class="input-group form-group">
                <form method="get" action="<?php echo base_url('Mainpayment_in');  ?>">
                    <div class="form-outline" data-mdb-input-init>
                    <input type="text" name="search" class="form-control" value="<?php echo $search; ?>" />
                    <!-- <label class="form-label" for="form1">Search</label> -->
                </div>
                <button type="submit" class="btn btn-primary me-2" data-mdb-ripple-init>
                    <i class="fas fa-search"></i>
                </button>
                <a type="submit" href="<?php echo base_url('Mainpayment_in');  ?>" class="btn btn-primary me-2" data-mdb-ripple-init>
                   <i class="fa-solid fa-rotate"></i>
                </a>
                </form>
                <form action="<?php echo base_url('Mainpayment_in');?>"  method="get" >
                    <select class="form-select" name="user" onchange="this.form.submit();" aria-label="Default select example" >
                    <option selected >Select Status</option>
                    <?php
                                      
                    foreach ($all_user as $value):
                    ?>
                        <option value="<?php echo $value->m_acc_id; ?>" <?php if($user ==$value->m_acc_id) echo 'selected'; ?>><?php echo $value->m_acc_name; ?></option>
                    <?php endforeach; ?>
                </select>
                </form>

                
            </div>
        </div>
    </div>
    <br>

    <table class="table my_custom_datatable table-bordered mt-3" id="paymentin_tbl">
        <thead>
        <tr>
            <th>S.No</th>
            <th>Payment Date</th>
            <th>Txns No.</th>
            <th>Customer</th>
            <th>Amount</th>
            <th>Action</th>

        </tr>
       </thead>
       <tbody>
        <?php 
        $i=1;  

        if(!empty($all_value)){
               foreach($all_value as $value){ ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo date('d-m-Y',strtotime($value->m_payment_date)); ?></td>
            <td><?php echo $value->m_payment_transno; ?></td>
            <td><?php echo $value->m_acc_name; ?></td>
            <td>₹<?php echo $value->m_payment_amount; ?></td>
            <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop<?php echo $value->m_payment_id; ?>" aria-controls="staticBackdrop"><i class="fa-solid fa-pen-to-square"></i></button>

                <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop<?php echo $value->m_payment_id; ?>" aria-labelledby="staticBackdropLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="staticBackdropLabel">SALE-155 (Invoice Number) <span class="badge bg-success">Paid</span></h5>
                        <button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-download"></i> Invoice</button>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <hr>
                    <div class="offcanvas-body">
                        <div>
                           <form class="row g-4" method="POST" id="form_paymentin_edit">
                                <div class="col-md-12">
                                    <label for="Name">Customer<span class="text-danger">*</span></label>
                                    <input type="hidden" class="form-control" name="m_payment_id" placeholder="Please Enter Name" value="<?php echo $value->m_payment_id; ?>">
                                    <select class="form-control" id="exampleFormControlSelect1" name="m_payment_user" required>
                                        <option value="">Select Customer</option>
                                        
                                        <?php
                                      
                                        foreach ($all_user as $user):
                                        ?>
                                            <option value="<?php echo $user->m_acc_id; ?>" <?php if($value->m_payment_user ==$user->m_acc_id) echo 'selected'; ?>><?php echo $user->m_acc_name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="Name">Payment Date<span class="text-danger">*</span></label>
                                    <input type="date" id="date" name="m_payment_date" value="<?php echo $value->m_payment_date;  ?>" class="form-control">
                                </div>
                                 <div class="col-md-6">
                                    <label for="Name">Amount<span class="text-danger">*</span></label>
                                    <input type="text" name="m_payment_amount" value="<?php echo $value->m_payment_amount;  ?>" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)"  class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="Name">Payment Mode<span class="text-danger">*</span></label>
                                    <select class="form-control" name="m_payment_pmode" id="exampleFormControlSelect1" required>
                                         <?php
                                      
                                        foreach ($all_pmode as $mode):
                                        ?>
                                            <option value="<?php echo $mode->m_pmode_id; ?>" <?php if($value->m_payment_pmode ==$mode->m_pmode_id) echo 'selected'; ?>><?php echo $mode->m_pmode_name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="Name">Transaction Number<span class="text-danger">*</span></label>
                                    <input type="text" name="m_payment_transno" value="<?php echo $value->m_payment_transno;  ?>" class="form-control" required>
                                </div>

                                <!-- <div class="col-md-12">
                                <label for="Name">Notes</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
                                </div> -->

                                <div class="canvas-footer justify-content-end d-flex">
                                    <button type="submit" class="btn btn-primary me-2" id="btn_paymentin_edit"><i class="fa-regular fa-pen-to-square"></i> Update</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="offcanvas" aria-label="Close" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <button type="button" data-value="<?php echo $value->m_payment_id; ?>" class="btn btn-primary btn-sm paymentin-delete"><i class="fa-solid fa-trash"></i></button>

            </td>

        </tr>
        <?php $i++; }}?>
      </tbody>
    </table>


</div>

<div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="staticBackdropadd" aria-labelledby="staticBackdropLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="staticBackdropLabel">SALE-155 (Invoice Number) <span class="badge bg-success">Paid</span></h5>
                        <button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-download"></i> Invoice</button>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <hr>
                    <div class="offcanvas-body">
                        <div>
                            <form class="row g-4" method="POST" id="form_paymentin_add">
                                <div class="col-md-12">
                                    <label for="Name">Customer<span class="text-danger">*</span></label>
                                    

                                    <select class="form-control" id="exampleFormControlSelect1" name="m_payment_user" required>
                                        <option value="">Select Customer</option>
                                        
                                        <?php
                                      
                                        foreach ($all_user as $user):
                                        ?>
                                            <option value="<?php echo $user->m_acc_id; ?>" ><?php echo $user->m_acc_name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="Name">Payment Date<span class="text-danger">*</span></label>
                                    <input type="date" id="date" name="m_payment_date" value="<?php echo date('Y-m-d');  ?>" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="Name">Amount<span class="text-danger">*</span></label>
                                    <input type="text" name="m_payment_amount"  onkeypress="return (event.charCode >= 48 && event.charCode <= 57)"  class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="Name">Payment Mode<span class="text-danger">*</span></label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="m_payment_pmode" required>
                                         <?php
                                      
                                        foreach ($all_pmode as $mode):
                                        ?>
                                            <option value="<?php echo $mode->m_pmode_id; ?>" ><?php echo $mode->m_pmode_name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="Name">Transaction Number<span class="text-danger">*</span></label>
                                    <input type="text" name="m_payment_transno"  class="form-control" required>
                                </div>
                                <!-- <div class="col-md-12">
                                <label for="Name">Notes</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
                                </div> -->

                                <div class="canvas-footer justify-content-end d-flex">
                                    <button type="submit" class="btn btn-primary me-2" id="btn_paymentin_add"><i class="fa-regular fa-pen-to-square"></i> Add</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="offcanvas" aria-label="Close" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>



<!-- ========== Page Content ========== -->
<?php include("footer.php"); ?>
<?php $this->view('js/custom_js');  ?>
<?php $this->view('js/main_js');  ?>