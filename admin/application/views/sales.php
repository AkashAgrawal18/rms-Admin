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

                <?php //echo date('dmy'); 
                ?>


                <p class="m-0 text-white small fw-light">
                    <a href="<?php echo base_url('Dashboard'); ?>" class="text-white text-decoration-none ">Dashboard</a> >> Sales >> <a href="<?php echo base_url('Main/sales'); ?>" class="text-decoration-none fw-bold"><span class="text-warning"> Sales</span></a>
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

<div class="container-fluid bg-light" style="min-height:75vh">
    <div class="row pt-3">
        <div class="col-md-2">
            <a href="<?php echo base_url('Main/pos');  ?>" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus"></i> Add New Sales</a>
        </div>

        <div class="col-md-10">
            <form method="get" action="<?php echo base_url('Main/sales');  ?>">
                <div class="row d-flex justify-content-end">
                    <div class="col-3 d-flex justify-content-between">
                        <label>From Date </label>
                        <input type="date" name="from_date" onchange="this.form.submit();" class="form-control" value="<?php echo $from_date; ?>" />
                    </div>
                    <div class="col-3 d-flex justify-content-between">
                        <label>To Date </label>
                        <input type="date" name="to_date" onchange="this.form.submit();" class="form-control" value="<?php echo $to_date; ?>" />
                    </div>
                    <div class="col-3">
                        <input type="text" name="search" onchange="this.form.submit();" placeholder="Search Name|Mobile..." class="form-control" value="<?php echo $search; ?>" />
                    </div>

                    <div class="col-1">
                        <a type="submit" href="<?php echo base_url('Main/sales');  ?>" class="btn btn-primary me-2" data-mdb-ripple-init>
                            <i class="fa-solid fa-rotate"></i>
                        </a>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <br>

    <div class="row g-2">
        <?php
        if (!empty($all_value)) {
            foreach ($all_value as $value) {
                if ($value->m_sale_status == 1) {
                    $order_status = '<span class="badge bg-info">New</span>';
                } else if ($value->m_sale_status == 2) {
                    $order_status = '<span class="badge bg-primary">Running</span>';
                } else if ($value->m_sale_status == 3) {
                    $order_status = '<span class="badge bg-success">Deliverd</span>';
                }

                if ($value->m_sale_pstatus == 1) {
                    $paid_status = '<span class="badge bg-success">Paid</span>';
                } else {
                    $paid_status = '<span class="badge bg-danger">Un-Paid</span>';
                }
        ?>
                <div class="col-3" >
                    <div class="card profile-header">
                        <div class="body p-2 fs-6">
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="mt-4 mb-0"><i class="fa-solid fa-user"></i> <strong><?= $value->m_acc_name; ?></strong></h5>
                                    <div style="position: absolute; top:0.4rem; right:0.4rem;">
                                        <?= $order_status ?>
                                        <?= $paid_status ?>
                                    </div>
                                    <span style="position: absolute;top: 0.4rem;left: 0.4rem;"><i class="fa-solid fa-calendar-days"></i> <?= date('d-m-Y', strtotime($value->m_sale_date));  ?></span>
                                    <div> <i class="fa-solid fa-tag"></i> <?= $value->m_sale_spo; ?></div>

                                    <div class="py-1 d-flex justify-content-between fw-bold">
                                        <span>Net Total : ₹<?= $value->m_sale_nettotal; ?></span>
                                        <span>Paid Amt : ₹<?= ($value->m_sale_payamt + $value->m_sale_payamt2); ?></span>
                                    </div>

                                    <div class="text-end">
                                        <button type="button" title="Click to View The Details" class="btn btn-primary btn-sm" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop1<?php echo $value->m_sale_spo; ?>" aria-controls="staticBackdrop"><i class="fas fa-eye"></i></button>

                                        <!-- <a href="<?php // echo base_url('Main/edit_sales?id=') . $value->m_sale_spo; 
                                                        ?>"><button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></button></a> -->
                                        <button type="button" title="Delete Sale" data-value="<?php echo $value->m_sale_spo; ?>" class="btn btn-danger btn-sm sales-delete"><i class="fa-solid fa-trash"></i></button>
                                        <button type="button" title="Download Invoice" class="btn btn-success btn-sm"><i class="fa-solid fa-download"></i></button>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- order detail modal -->
                <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop1<?php echo $value->m_sale_spo; ?>" aria-labelledby="staticBackdropLabel">

                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="staticBackdropLabel">Order No :- <?php echo $value->m_sale_spo; ?> <?= $order_status . ' ' . $paid_status ?></h5>
                        <button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-download"></i> Invoice</button>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <hr>
                    <div class="offcanvas-body">
                        <div>
                            <div class="row g-4">
                                <div class="col-md-12">
                                    <div class="row g-4">
                                        <div class="col-4">
                                            Order Date : <br> <?php echo date('d-m-Y,H:i A', strtotime($value->m_sale_added_on)); ?>
                                        </div>
                                        <div class="col-4">
                                            Order Number :<br> <?php echo $value->m_sale_spo; ?>
                                        </div>
                                        <div class="col-4">
                                            Customer :<br> <?php echo $value->m_acc_name; ?>
                                        </div>
                                        <div class="col-4">
                                            Mobile :<br> <?php echo $value->m_acc_mobile; ?>
                                        </div>
                                        <div class="col-4">
                                            Email :<br> <?php echo $value->m_acc_email; ?>
                                        </div>
                                        <div class="col-4">
                                            Address :<br> <?php echo $value->m_acc_address; ?>
                                        </div>

                                    </div>
                                </div>


                                <div class="col-md-12 mt-4">
                                    <h5>Order Items</h5>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Brand</th>
                                                    <th>Colour</th>
                                                    <th>Size</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($value->m_sale_items)) {
                                                    foreach ($value->m_sale_items as $val) { ?>
                                                        <tr>
                                                            <td><?= $val->m_product_name; ?></td>
                                                            <td><?= $val->m_brand_name; ?></td>
                                                            <td><?= $val->m_color_name; ?></td>
                                                            <td><?= $val->m_size_name; ?></td>
                                                            <td><?= $val->m_sale_qty; ?></td>
                                                            <td>₹<?= $val->m_sale_price ?></td>
                                                            <td>₹<?= $val->m_sale_total ?></td>
                                                        </tr>
                                                <?php }
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="border-bottom border-1 border-secondary pb-2">Sub Total: ₹<?= $value->sub_total; ?></h6>
                                    <h6 class="border-bottom border-1 border-secondary pb-2"> Total Tax : ₹<?= $value->total_tax ?></h6>
                                    <h6 class="border-bottom border-1 border-secondary pb-2"> Discount : ₹<?= $value->m_sale_discount; ?></h6>
                                    <h6 class="border-bottom border-1 border-secondary pb-2"> Shipping : ₹<?= $value->m_sale_shipping; ?></h6>
                                    <h5> Grand Total : ₹<?= $value->m_sale_nettotal; ?></h5ss=>
                                </div>
                                <div class="col-md-6 text-end">
                                    <h6 class="border-bottom border-1 border-secondary pb-2"> Paid Amount (<?= $value->pmodename1; ?>) : ₹<?= $value->m_sale_payamt; ?></h6>

                                    <?php if ($value->m_sale_ispartial == 1) { ?>
                                        <h6 class="border-bottom border-1 border-secondary pb-2"> Paid Amount (<?= $value->pmodename2; ?>) : ₹<?= $value->m_sale_payamt2; ?></h6>
                                    <?php } ?>
                                    <h6 class="border-bottom border-1 border-secondary pb-2"> Balance Amount : ₹<?= $value->m_sale_balamt; ?></h6>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <!-- order detail modal -->

        <?php
            }
        } ?>

    </div>

    <!-- <table class="table my_custom_datatable table-bordered mt-3" id="sales_tbl">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Order Id</th>
                <th>Sales Date</th>
                <th>Customer</th>
                <th>Sales Status</th>
                <th>Net Amount</th>
                <th>Paid Amount</th>
                <th>Payment Status</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            if (!empty($all_value)) {
                foreach ($all_value as $value) {
                    if ($value->m_sale_status == 1) {
                        $order_status = '<span class="badge bg-info">New</span>';
                    } else if ($value->m_sale_status == 2) {
                        $order_status = '<span class="badge bg-primary">Running</span>';
                    } else if ($value->m_sale_status == 3) {
                        $order_status = '<span class="badge bg-success">Deliverd</span>';
                    }

                    if ($value->m_sale_pstatus == 1) {
                        $paid_status = '<span class="badge bg-success">Paid</span>';
                    } else {
                        $paid_status = '<span class="badge bg-danger">Un-Paid</span>';
                    }
            ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $value->m_sale_spo; ?></td>
                        <td><?php echo date('d-m-Y', strtotime($value->m_sale_date)); ?></td>
                        <td><?php echo $value->m_acc_name; ?></td>
                        <td><?= $order_status ?></td>
                        <td>₹<?php echo $value->m_sale_nettotal; ?></td>
                        <td>₹<?php echo ($value->m_sale_payamt + $value->m_sale_payamt2); ?></td>
                        <td><?= $paid_status ?></td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop1<?php echo $value->m_sale_spo; ?>" aria-controls="staticBackdrop"><i class="fas fa-eye"></i></button>

                            
                            <button type="button" data-value="<?php echo $value->m_sale_spo; ?>" class="btn btn-primary btn-sm sales-delete"><i class="fa-solid fa-trash"></i></button>
                            <button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-download"></i></button>

                        </td>
                    </tr>
            <?php $i++;
                }
            } ?>
        </tbody>
    </table> -->

</div>



<!-- ========== Page Content ========== -->
<?php include("footer.php"); ?>
<?php $this->view('js/main_js');  ?>
<?php $this->view('js/custom_js'); ?>