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

    li {
        font-size: 14px;
    }

    .modal-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
</style>

<?php
switch ($pagtype) {
    case 1: {
            $hedname = 'Customer';
            $relink = "Account/customer";
        }
        break;
    case 2: {
            $hedname = 'Supplier';
            $relink = "Account/supplier";
        }
        break;
    case 3: {
            $hedname = 'Expense';
            $relink = "Account/expense_acc";
        }
        break;
    case 5: {
            $hedname = 'Bank Account';
            $relink = "Account/cash_bank_acc";
        }
        break;
}
?>

<!-- ========== Page Content ========== -->
<section class="py-1" style="background: #797979;">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-xl-11 col-lg-10">
                <p class="m-0 text-white small fw-light">
                    <a href="<?php echo base_url('Dashboard'); ?>" class="text-white text-decoration-none ">Dashboard</a> >> Parties >> <a href="<?php echo base_url($relink); ?>" class="text-decoration-none fw-bold"><span class="text-warning"> <?= $pagename ?></span></a>
                </p>
            </div>

            <div class="col-xl-1 col-lg-2 text-start">
                <button onclick="history.back()" class="btn btn-dark btn-sm rounded-pill w-100">
                    <i class="bi bi-arrow-bar-left me-1"></i><small>Back</small>
                </button>
            </div>
        </div>
    </div>
</section>

<div class="container-fluid bg-light" id="main-body" style="min-height:75vh">
    <div class="row pt-3">
        <div class="col-md-6">
            <button type="button" class="btn btn-primary btn-sm" onclick="openmodalfun('#addcustomermodal','Add New <?= $hedname ?>','<?= $pagtype ?>','0')" aria-controls="staticBackdrop"><i class="fa-solid fa-plus"></i> Add New <?= $hedname ?></button>

            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-file-import"></i> Import Customers</button>
        </div>
        <div class="col-md-6">
            <form method="get" action="<?php echo base_url($relink);  ?>">
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <select class="form-select" name="status" onchange="this.form.submit();" aria-label="Default select example">
                                <option value="">All Status</option>
                                <option value="1" <?php if ($status == 1) echo "selected"; ?>>Active</option>
                                <option value="2" <?php if ($status == 2) echo "selected"; ?>>In-Active</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="search" class="form-control" onchange="this.form.submit();" value="<?php echo $search; ?>" placeholder="Search..." />
                        </div>
                    </div>
                    <div class="col-2">
                        <a href="<?php echo base_url($relink); ?>" class="btn btn-primary me-2" data-mdb-ripple-init>
                            <i class="fa-solid fa-rotate"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <br>

    <div class="table-responsive">
        <table class="table my_custom_datatable table-bordered mt-4" id="customer_tbl">
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
                    foreach ($all_value as $value) { ?>


                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $value->m_acc_name; ?></td>
                            <td><?php echo $value->m_acc_email; ?></td>
                            <td><?php echo date('d-m-Y,h:i A', strtotime($value->m_acc_added_on));  ?></td>
                            <td><i class="fa-solid fa-arrow-up" style="color: #c61010;"></i> ₹<?php echo number_format($value->m_acc_open_balance, 2, '.', ','); ?></td>
                            <td><span class="badge badgef bg-success p-1"><?php if ($value->m_acc_status == 1) {
                                                                                echo 'Active';
                                                                            } else {
                                                                                echo 'In-Active';
                                                                            }  ?></span></td>
                            <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdropview<?php echo $value->m_acc_id; ?>" aria-controls="staticBackdrop"><i class="fas fa-eye"></i></button>

                                <div class="modal fade" id="staticBackdropview<?php echo $value->m_acc_id; ?>" tabindex="-1" style="--bs-modal-margin: 0px !important">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel"><?php echo $value->m_acc_name; ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div>

                                                    <?php
                                                    if (!empty($value->m_acc_image) && file_exists('uploads/user/' . $value->m_acc_image)) {
                                                        $user_img = base_url('uploads/user/' . $value->m_acc_image);
                                                    } else {
                                                        $user_img = base_url('assets/imgs/user.png');
                                                    }
                                                    ?>
                                                    <div class="row g-4">
                                                        <div class="col-md-3">
                                                            <img src="<?php echo $user_img; ?>" alt="" class="w-100">

                                                        </div>
                                                        <div class="col-md-9">
                                                            <h6><?= $hedname ?> Details</h6>
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

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdropedit<?php echo $value->m_acc_id; ?>" aria-controls="staticBackdrop"><i class="fa-solid fa-pen-to-square"></i></button>

                                <div class="modal fade" id="staticBackdropedit<?php echo $value->m_acc_id; ?>" tabindex="-1" style="--bs-modal-margin: 0px !important">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title m-0" id="staticBackdropLabel">Edit <?= $hedname ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                            </div>
                                            <div class="modal-body">
                                                <form class="row g-3" method="POST" id="form-customer-edit<?php echo $value->m_acc_id; ?>">

                                                    <div class="col-md-6">
                                                        <label for="Name">Name<span class="text-danger">*</span></label>
                                                        <input type="hidden" name="m_acc_id" value="<?php echo $value->m_acc_id;  ?>">
                                                        <input type="hidden" name="m_acc_type" value="<?= $value->m_acc_type ?>">
                                                        <input type="text" class="form-control" name="m_acc_name" required placeholder="Please Enter Name" value="<?php echo $value->m_acc_name;  ?>">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="Name">Phone Number<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="m_acc_mobile" maxlength="10" minlength="10" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" placeholder="Please Enter Number" value="<?php echo $value->m_acc_mobile;  ?>" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="Name">Email</label>
                                                        <input type="email" class="form-control" name="m_acc_email" placeholder="Please Enter Email" value="<?php echo $value->m_acc_email;  ?>">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="image">Profile Image</label>
                                                        <input type="hidden" name="m_acc_image1" value="<?php echo $value->m_acc_image; ?>">
                                                        <input type="file" class="form-control-file" name="m_acc_image">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="Name">GST No</label>
                                                        <input type="text" class="form-control" name="m_acc_gst_no" placeholder="Please Enter gst Number"  value="<?php echo $value->m_acc_gst_no;  ?>">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="Name">Bank Name</label>
                                                        <input type="text" class="form-control" name="m_acc_bankname" placeholder="Please Enter Bank Name" value="<?php echo $value->m_acc_bankname;  ?>">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="Name">Bank Account No</label>
                                                        <input type="text" class="form-control" name="m_acc_bankacc" placeholder="Please Enter Account"  value="<?php echo $value->m_acc_bankacc;  ?>">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="Name">Opening Balance</label>
                                                        <input type="text" class="form-control" name="m_acc_open_balance" placeholder="Please Enter Balance" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" value="<?php echo $value->m_acc_open_balance;  ?>">
                                                    </div>
                                                   
                                                        <div class="col-md-6">
                                                            <label for="Name">Credit Period</label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" name="m_acc_credit_period" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" aria-label="Dollar amount (with dot and two decimal places)" value="<?php echo $value->m_acc_credit_period;  ?>">
                                                                <span class="input-group-text">Day(s)</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="Name">Credit Limit</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text">₹</span>
                                                                <input type="text" class="form-control" name="m_acc_credit_limit" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" aria-label="Dollar amount (with dot and two decimal places)" value="<?php echo $value->m_acc_credit_limit;  ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                        <label for="order">Status </label>
                                                        <select class="form-control" name="m_acc_status">
                                                            <option value="1" <?php if ($value->m_acc_status == 1) echo 'selected'; ?>>Active</option>
                                                            <option value="2" <?php if ($value->m_acc_status == 2) echo 'selected'; ?>>In-Active</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="Name">Billing Address</label>
                                                        <textarea class="form-control" name="m_acc_address" rows="2"><?php echo $value->m_acc_address  ?></textarea>
                                                    </div>

                                                    <div class="canvas-footer justify-content-end d-flex">
                                                        <button type="submit" class="btn btn-primary me-2 btn-customer-add" data-frmid="#form-customer-edit<?php echo $value->m_acc_id; ?>"><i class="fa-regular fa-pen-to-square"></i> Create</button>
                                                        <button type="button" class="btn btn-secondary" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">Cancel</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary delete_customer btn-sm" data-value="<?php echo $value->m_acc_id; ?>"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                <?php $i++;
                    }
                }  ?>
            </tbody>
        </table>
    </div>

</div>



<!-- ========== Page Content ========== -->
<?php include("footer.php"); ?>
<?php $this->view('custom_page'); ?>
<?php $this->view('js/account_js');  ?>
<?php $this->view('js/custom_js'); ?>