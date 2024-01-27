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
                    <a href="<?= base_url('Dashboard'); ?>" class="text-white text-decoration-none">Dashboard</a> >> Sales >><span class="text-warning"> <?= $pagename ?></span>
                </p>
            </div>

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
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#myaddModal" aria-controls="staticBackdrop"><i class="fa-solid fa-plus"></i> Add New Payment</button>
        </div>
        <div class="col-md-5">
            <div class="input-group form-group">
                <form method="get" action="<?= base_url('Main/payment_in');  ?>">
                    <div class="form-outline" data-mdb-input-init>
                        <input type="text" name="search" class="form-control" value="<?= $search; ?>" />
                        <!-- <label class="form-label" for="form1">Search</label> -->
                    </div>
                    <button type="submit" class="btn btn-primary me-2" data-mdb-ripple-init>
                        <i class="fas fa-search"></i>
                    </button>
                    <a type="submit" href="<?= base_url('Main/payment_in');  ?>" class="btn btn-primary me-2" data-mdb-ripple-init>
                        <i class="fa-solid fa-rotate"></i>
                    </a>
                </form>
                <form action="<?= base_url('Main/payment_in'); ?>" method="get">
                    <select class="form-select" name="user" onchange="this.form.submit();" aria-label="Default select example">
                        <option selected>Select Status</option>
                        <?php

                        foreach ($all_user as $value) :
                        ?>
                            <option value="<?= $value->m_acc_id; ?>" <?php if ($user == $value->m_acc_id) echo 'selected'; ?>><?= $value->m_acc_name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </form>


            </div>
        </div>
    </div>
    <br>

    <table class="table my_custom_datatable table-bordered mt-3" id="payment_tbl">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Date</th>
                <th>Recipt</th>
                <th>Act Type</th>
                <th>Act Name</th>
                <th>Mobile</th>
                <th>Amount</th>
                <th>Method</th>
                <!-- <th>Txns No.</th> -->
                <th>Remark</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;

            if (!empty($all_value)) {
                foreach ($all_value as $value) { ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= date('d-m-Y', strtotime($value->m_pay_date)); ?></td>
                        <td><?= $value->m_pay_uno; ?></td>
                        <td><?= $value->account_type; ?></td>
                        <td><?= $value->account_name; ?></td>
                        <td><?= $value->account_mobile; ?></td>
                        <td>₹<?= $value->m_pay_amount; ?></td>
                        <td><?= $value->method_name; ?></td>
                        <!-- <td><?= $value->m_pay_transno; ?></td> -->
                        <td><?= $value->m_pay_remark; ?></td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm p-1 me-1 myeditpayModal" data-value="<?= $value->m_pay_id; ?>" data-bs-toggle="modal" data-bs-target="#myeditModal<?= $value->m_pay_id; ?>" title="Edit"><i class="bi bi-pencil-square"></i></button>

                            <button type="button" data-value="<?= $value->m_pay_id; ?>" class="btn btn-primary btn-sm pay-delete"><i class="fa-solid fa-trash"></i></button>

                            <!-- Edit Modal start -->
                            <div id="myeditModal<?= $value->m_pay_id; ?>" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header justify-content-between">
                                            <h4 class="modal-title">Edit <?= $pagetype == 1 ? 'Payment Recieved' : 'Payment Paid' ?></h4>
                                            <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                        </div>
                                        <form method="POST" id="frm_pay_add<?= $value->m_pay_id; ?>" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                <div class="row g-3">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Date</label>
                                                            <input type="hidden" name="m_pay_id" value="<?= $value->m_pay_id ?>">
                                                            <input type="hidden" name="m_pay_type" value="<?= $pagetype ?>">
                                                            <input type="date" name="m_pay_date" class="form-control" value="<?= $value->m_pay_date ?>">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label><?= $value->account_type ?> Name </label>
                                                            <input type="hidden" id="m_pay_acctype<?= $value->m_pay_id ?>"  name="m_pay_acctype" value="<?= $value->m_pay_acctype ?>">
                                                            <input type="hidden" id="m_accname<?= $value->m_pay_id ?>" value="<?= $value->m_pay_account ?>">

                                                            <select class="form-select select2" id="m_pay_account<?= $value->m_pay_id ?>" name="m_pay_account" aria-label="Default select example" required>
                                                                <option value="">-- First Select Account Type--</option>
                                                            </select>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Amount <span class="text-danger">*</span></label>
                                                            <input type="text" name="m_pay_amount" id="m_pay_amount<?= $value->m_pay_id ?>" class="form-control" required="" value="<?= $value->m_pay_amount ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Method</label>
                                                            <select name="m_pay_method" id="m_pay_method<?= $value->m_pay_id ?>" class="form-control">
                                                                <option value="">Select Method</option>
                                                                <?php
                                                                if (!empty($all_pmode)) {
                                                                    foreach ($all_pmode as $pmod) {
                                                                        if ($value->m_pay_method == $pmod->m_acc_id) {
                                                                            $op = 'selected';
                                                                        } else {
                                                                            $op = '';
                                                                        }
                                                                ?>
                                                                        <option value="<?= $pmod->m_acc_id; ?>" <?= $op ?>><?= $pmod->m_acc_name; ?></option>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Remark</label>
                                                            <textarea name="m_pay_remark" id="m_pay_remark<?= $value->m_pay_id ?>" class="form-control"><?= $value->m_pay_remark ?></textarea>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <div>
                                                    <input type="submit" class="btn btn-success btn-sm btn_pay_add" data-frmid="#frm_pay_add<?= $value->m_pay_id ?>" value="Submit">
                                                    <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Close</button>
                                                </div>


                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Edit modal end -->
                        </td>

                    </tr>
            <?php $i++;
                }
            } ?>
        </tbody>
    </table>


</div>

<!-- Add Modal start -->
<div id="myaddModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header justify-content-between">
                <h4 class="modal-title">Add <?= $pagetype == 1 ? 'Payment Recieved' : 'Payment Paid' ?></h4>
                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
            </div>
            <form method="POST" id="frm_pay_add" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date</label>
                                <input type="hidden" name="m_pay_id" value="">
                                <input type="hidden" name="m_pay_type" value="<?= $pagetype ?>">
                                <input type="date" name="m_pay_date" class="form-control" value="<?= date('Y-m-d') ?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Account Type </label>
                                <select class="form-select select2" id="m_pay_acctype" name="m_pay_acctype" aria-label="Default select example" required>
                                    <option value="">-- Select Account Type--</option>
                                    <?php if ($pagetype == 1) {
                                        echo '<option value="1">Customer</option>
                                        <option value="4">General</option>
                                        <option value="6">Cash</option>';
                                    } else if ($pagetype == 2) {
                                        echo '<option value="2">Supplier</option>
                                        <option value="3">Expense</option>
                                        <option value="4">General</option>
                                        <option value="5">Bank</option>';
                                    } ?>

                                </select>

                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Account Name </label>
                                <input type="hidden" id="m_accname" value="">

                                <select class="form-select select2" id="m_pay_account" name="m_pay_account" aria-label="Default select example" required>
                                    <option value="">-- First Select Account Type--</option>
                                </select>

                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Amount <span class="text-danger">*</span></label>
                                <input type="text" name="m_pay_amount" id="m_pay_amount" class="form-control" required="" value="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Method</label>
                                <select class="form-select select2" id="m_pay_method" name="m_pay_method" aria-label="Default select example" required>
                                    <option value="">Select Method</option>
                                    <?php
                                    if (!empty($all_pmode)) {
                                        foreach ($all_pmode as $pmod) {
                                    ?>
                                            <option value="<?= $pmod->m_acc_id; ?>"><?= $pmod->m_acc_name; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Remark</label>
                                <textarea name="m_pay_remark" id="m_pay_remark" class="form-control"></textarea>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <div>
                        <input type="submit" class="btn btn-success btn-sm btn_pay_add" data-frmid="#frm_pay_add" value="Submit">
                        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Close</button>
                    </div>


                </div>
            </form>
        </div>
    </div>
</div>
<!-- Add modal end -->


<!-- ========== Page Content ========== -->
<?php include("footer.php"); ?>
<?php $this->view('js/custom_js');  ?>
<?php $this->view('js/main_js');  ?>