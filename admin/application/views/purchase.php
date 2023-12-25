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
                    <a href="<?php echo base_url('Dashboard'); ?>" class="text-white text-decoration-none ">Dashboard</a> >> Purchases >> <a href="<?php echo base_url('User/purchase'); ?>" class="text-decoration-none fw-bold"><span class="text-warning"> Purchase</span></a>
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


<div class="container-fluid bg-light">
    <div class="row pt-3">
        <div class="col-md-3">
            <a type="button" href="<?php echo base_url('User/edit_purchase'); ?>" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus"></i> Add New Purchase </a>
        </div>

        <div class="col-md-9">
            <div class="input-group form-group">


                <form method="get" action="<?php echo base_url('User/purchase'); ?>">
                    <!-- Add "from date" and "to date" input fields -->
                    <!-- <div class="date-inputs"> -->
                    <div class="form-outline me-1" data-mdb-input-init >
                        <label class="form-label p-1" for="form1"> From Date </label>
                    </div>
                    &nbsp;
                    <div class="form-outline me-1" data-mdb-input-init>
                        <input type="date" name="from_date" class="form-control" value="<?php echo $from_date; ?>" />
                    </div>
                    &nbsp;
                    <div class="form-outline me-1 " data-mdb-input-init>
                        <label class="form-label p-1" for="form1"> To Date </label>
                    </div>
                    &nbsp;
                    <div class="form-outline me-1" data-mdb-input-init>
                        <input type="date" name="to_date" class="form-control" value="<?php echo $to_date; ?>" />
                    </div>
                    <!-- </div> -->&nbsp;

                    <div class="form-outline" data-mdb-input-init>
                        <input type="text" name="search" class="form-control" value="<?php echo $search; ?>" />
                    </div>

                    <button type="submit" class="btn btn-primary me-2" data-mdb-ripple-init>
                        <i class="fas fa-search"></i>
                    </button>

                    <a href="<?php echo base_url('User/purchase'); ?>" class="btn btn-primary me-2" data-mdb-ripple-init>
                        <i class="fa-solid fa-rotate"></i>
                    </a>
                </form>

                <form action="<?php echo base_url('User/purchase'); ?>" method="get">
                    <select class="form-select" name="user" onchange="this.form.submit();" aria-label="Default select example">
                        <option selected>Select Supplier</option>
                        <?php foreach ($all_user as $value) { ?>
                            <option value="<?php echo $value->m_user_id; ?>" <?php if ($user == $value->m_user_id) echo "selected"; ?>><?php echo $value->m_user_name; ?></option>
                        <?php } ?>
                    </select>
                </form>
            </div>
        </div>

    </div>
    <br>

    <table class="table my_custom_datatable table-bordered mt-3" id="purchase_tbl">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Purchase Id</th>
                <th>Invoice Number</th>
                <th>Purchase Date</th>
                <th>Supplier</th>
                <!-- <th>Purchase Status</th> -->
                <th>Paid Amount</th>
                <th>Total Amount</th>

                <th>Payment Status</th>
                <th>Purchase Return</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            if (!empty($all_value)) {
                foreach ($all_value as $value) {
                    $balance = $value->total_net_amount + $value->total_gst;

                    $purchase  = $this->User_model->get_purchase_details($value->m_purchase_spo, $value->supplier_id);

            ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $value->m_purchase_spo; ?></td>
                        <td><?php echo $value->m_purchase_invoiceno; ?></td>
                        <td><?php echo date('d-m-Y', strtotime($value->purchase_date)); ?></td>
                        <td><?php echo $value->supplier_name; ?></td>
                        <!-- <td><span class="badge bg-success"><?php if ($value->m_purchase_status == 1) {
                                                                    echo 'Running';
                                                                } else if ($value->m_purchase_status == 2) {
                                                                    echo 'Delivered';
                                                                } else {
                                                                    echo 'New';
                                                                } ?></span></td> -->
                        <td>₹<?php echo $value->paid_amount; ?></td>
                        <td>₹<?php echo $balance; ?></td>
                        <td><span class="badge bg-success"><?php if ($value->m_purchase_pstatus == 1) {
                                                                echo 'Paid';
                                                            } else {
                                                                echo 'Un-paid';
                                                            } ?></span></td>
                        <td><a href="<?php echo base_url('User/edit_purchase?id=') . $value->m_purchase_spo . '&purtype=2';  ?>"><button type="button" class="btn btn-primary btn-sm">Add Purchase Return</button></a></td>
                        <td>


                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop1<?php echo $value->m_purchase_spo; ?>" aria-controls="staticBackdrop"><i class="fas fa-eye"></i></button>



                            <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop1<?php echo $value->m_purchase_spo; ?>" aria-labelledby="staticBackdropLabel">

                                <div class="offcanvas-header">
                                    <h5 class="offcanvas-title" id="staticBackdropLabel"><?php echo $value->m_purchase_invoiceno; ?> (Invoice Number) <span class="badge bg-success"><?php if ($value->m_purchase_pstatus == 1) {
                                                                                                                                                                                            echo 'Paid';
                                                                                                                                                                                        } else {
                                                                                                                                                                                            echo 'Un-paid';
                                                                                                                                                                                        } ?></span></h5>
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
                                                        Purchase Date : <br> <?php echo date('d-m-Y,H:i A', strtotime($value->purchase_date)); ?>
                                                    </div>
                                                    <div class="col-4">
                                                        Invoice Number :<br> <?php echo $value->m_purchase_invoiceno; ?>
                                                    </div>
                                                    <div class="col-4">
                                                        Supplier :<br> <?php echo $value->supplier_name; ?>
                                                    </div>
                                                    <!-- <div class="col-4">
                                            Order Status :<br> <span class="badge bg-success"><?php if ($value->m_purchase_status == 1) {
                                                                                                    echo 'Running';
                                                                                                } else if ($value->m_purchase_status == 2) {
                                                                                                    echo 'Delivered';
                                                                                                } else {
                                                                                                    echo 'New';
                                                                                                } ?></span>
                                        </div> -->
                                                    <div class="col-4">
                                                        Payment Status :<br> <span class="badge bg-success"><?php if ($value->m_purchase_pstatus == 1) {
                                                                                                                echo 'Paid';
                                                                                                            } else {
                                                                                                                echo 'Un-paid';
                                                                                                            } ?></span>
                                                    </div>
                                                    <div class="col-4">
                                                        Purchase Taken By:<br> <?php echo $value->added_by_name; ?>
                                                    </div>

                                                    <div class="col-4">
                                                        Total Amount:<br> ₹<?php echo $value->total_net_amount + $value->total_gst; ?>
                                                    </div>
                                                    <div class="col-4">
                                                        Paid Amount :<br>
                                                        ₹<?php echo round($value->paid_amount, 3); ?>
                                                    </div>
                                                    <div class="col-4">
                                                        Due Amount :<br> ₹00.00
                                                    </div>
                                                    <div class="col-4">
                                                        Discount :<br> ₹<?php echo number_format($value->total_discount_amount, 2, '.', ','); ?>
                                                    </div>
                                                    <div class="col-4">
                                                        Shipping :<br> ₹00.00
                                                    </div>
                                                    <div class="col-4">
                                                        purchase Tax :<br><?php echo number_format($value->total_gst, 2, '.', ','); ?>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-12 mt-4">
                                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link pro-link active" id="payment-tab" data-bs-toggle="tab" data-bs-target="#payment-tab-pane<?php echo $value->m_purchase_spo; ?>" type="button" role="tab" aria-controls="payment-tab-pane" aria-selected="true">Payments</button>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link pro-link" id="order-tab" data-bs-toggle="tab" data-bs-target="#order-tab-pane<?php echo $value->m_purchase_spo; ?>" type="button" role="tab" aria-controls="order-tab-pane" aria-selected="false">Purchase Items</button>
                                                    </li>
                                                </ul>
                                                <div class="tab-content" id="myTabContent">
                                                    <div class="tab-pane fade show active " id="payment-tab-pane<?php echo $value->m_purchase_spo; ?>" role="tabpanel" aria-labelledby="payment-tab" tabindex="0">
                                                        <table class="table table-bordered">
                                                            <tr>
                                                                <th>Payment Date</th>
                                                                <th>Amount</th>
                                                                <th>Payment Mode</th>

                                                            </tr>
                                                            <?php
                                                            if (!empty($purchase[0]['product_payment'])) {
                                                                foreach ($purchase[0]['product_payment'] as $val) { ?>
                                                                    <tr>
                                                                        <td><?php echo date('d-n-Y', strtotime($val->pay_date)); ?></td>
                                                                        <td>₹<?php echo round($val->paid_amount, 3); ?></td>
                                                                        <td><?php if ($val->paymode == 1) {
                                                                                echo 'Upi';
                                                                            } else {
                                                                                echo 'Cash';
                                                                            } ?></td>
                                                                    </tr>
                                                            <?php }
                                                            } ?>
                                                        </table>
                                                    </div>


                                                    <div class="tab-pane fade" id="order-tab-pane<?php echo $value->m_purchase_spo; ?>" role="tabpanel" aria-labelledby="order-tab" tabindex="0">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>Product</th>
                                                                    <th>Quantity</th>
                                                                    <th>Unit Price</th>
                                                                    <th>Discount</th>
                                                                    <th>Tax</th>
                                                                    <th>Subtotal</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                if (!empty($purchase[0]['m_purchase_items'])) {
                                                                    foreach ($purchase[0]['m_purchase_items'] as $val) { ?>
                                                                        <tr>
                                                                            <td><?php echo $val->m_product_name; ?></td>
                                                                            <td><?php echo $val->m_purchase_qty; ?></td>
                                                                            <td>₹<?php echo $val->m_purchase_price; ?></td>
                                                                            <td>₹<?php echo $val->m_purchase_discount; ?></td>
                                                                            <td>₹<?php echo $val->m_purchase_gst; ?></td>
                                                                            <td>₹<?php echo $val->m_purchase_price * $val->m_purchase_qty; ?></td>
                                                                        </tr>
                                                                <?php }
                                                                } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <a href="<?php echo base_url('User/edit_purchase?id=') . $value->m_purchase_spo;  ?>"><button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></button></a>
                            <button type="button" data-value="<?php echo $value->m_purchase_spo; ?>" class="btn btn-primary purchase-delete btn-sm"><i class="fa-solid fa-trash"></i></button>
                            <!-- <button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-download"></i></button> -->

                        </td>
                    </tr>
            <?php $i++;
                }
            } ?>
        </tbody>
    </table>


</div>



<!-- ========== Page Content ========== -->
<?php include("footer.php"); ?>
<?php $this->view('js/main_js'); ?>
<?php $this->view('js/custom_js'); ?>