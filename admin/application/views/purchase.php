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

        <?php if ($purtype == 1) {
            $redirlink = 'User/purchase';
            $hednam = 'Purchase';
        } else {
            $redirlink = 'User/purchase_return';
            $hednam = 'Return';
        } ?>

        <div class="row align-items-center">
            <div class="col-xl-11 col-lg-10">
                <p class="m-0 text-white small fw-light">
                    <a href="<?php echo base_url('Dashboard'); ?>" class="text-white text-decoration-none ">Dashboard</a> >> <?= $pagename ?> >> <a href="<?php echo base_url($redirlink); ?>" class="text-decoration-none fw-bold"><span class="text-warning"> <?= $pagename ?></span></a>
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
        <div class="col-md-3">
            <a type="button" href="<?php echo base_url('User/edit_purchase/') . $purtype; ?>" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus"></i> Add New <?= $hednam ?> </a>
        </div>

        <div class="col-md-9">
            <div class="input-group form-group">


                <form method="get" action="<?php echo base_url($redirlink); ?>">
                    <!-- Add "from date" and "to date" input fields -->
                    <!-- <div class="date-inputs"> -->
                    <div class="form-outline me-1" data-mdb-input-init>
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

                    <a href="<?php echo base_url($redirlink); ?>" class="btn btn-primary me-2" data-mdb-ripple-init>
                        <i class="fa-solid fa-rotate"></i>
                    </a>
                </form>

                <form action="<?php echo base_url($redirlink); ?>" method="get">
                    <select class="form-select" name="user" onchange="this.form.submit();" aria-label="Default select example">
                        <option selected>Select Supplier</option>
                        <?php foreach ($all_user as $value) { ?>
                            <option value="<?php echo $value->m_acc_id; ?>" <?php if ($user == $value->m_acc_id) echo "selected"; ?>><?php echo $value->m_acc_name; ?></option>
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
                <th><?= $hednam ?> No</th>
                <th>Invoice Number</th>
                <th><?= $hednam ?> Date</th>
                <th>Supplier</th>
                <th>Total Qty</th>
                <th>Total Amount</th>

                <!-- <th>Purchase Return</th> -->
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            if (!empty($all_value)) {
                foreach ($all_value as $value) {

            ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $value->m_purchase_spo; ?></td>
                        <td><?php echo $value->m_purchase_invoiceno; ?></td>
                        <td><?php echo date('d-m-Y', strtotime($value->m_purchase_date)); ?></td>
                        <td><?php echo $value->m_acc_name; ?></td>

                        <td><?php echo $value->total_qty; ?></td>
                        <td>₹<?php echo $value->m_purchase_nettotal; ?></td>

                        <!-- <td><a href="<?php // echo base_url('User/edit_purchase?id=') . $value->m_purchase_spo . '&purtype=2';  
                                            ?>"><button type="button" class="btn btn-primary btn-sm">Add Purchase Return</button></a></td> -->
                        <td>


                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop1<?php echo $value->m_purchase_spo; ?>" aria-controls="staticBackdrop"><i class="fas fa-eye"></i></button>

                            <!-- view purchase detail -->

                            <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop1<?php echo $value->m_purchase_spo; ?>" aria-labelledby="staticBackdropLabel">

                                <div class="offcanvas-header">
                                    <h5 class="offcanvas-title" id="staticBackdropLabel"><?= $hednam ?> No :- <?php echo $value->m_purchase_spo; ?></h5>
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
                                                        <?= $hednam ?> Date : <br> <?php echo date('d-m-Y,h:i A', strtotime($value->m_purchase_added_on)); ?>
                                                    </div>
                                                    <div class="col-4">
                                                        Invoice Number :<br> <?php echo $value->m_purchase_invoiceno; ?>
                                                    </div>
                                                    <div class="col-4">
                                                        Supplier :<br> <?php echo $value->m_acc_name; ?>
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
                                                <h5><?= $hednam ?> Items</h5>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Product</th>
                                                                <th>Fabric</th>
                                                                <th>Colour</th>
                                                                <th>Size</th>
                                                                <th>Quantity</th>
                                                                <th>Price</th>
                                                                <th>Total</th>
                                                                <th>Gst %</th>
                                                                <th>Dis %</th>
                                                                <th>Net Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php if (!empty($value->m_purchase_items)) {
                                                                foreach ($value->m_purchase_items as $val) { ?>
                                                                    <tr>
                                                                        <td><?= $val->m_product_name; ?></td>
                                                                        <td><?= $val->m_fabric_name; ?></td>
                                                                        <td><?= $val->m_color_name; ?></td>
                                                                        <td><?= $val->m_size_name; ?></td>
                                                                        <td><?= $val->m_purchase_qty; ?></td>
                                                                        <td>₹<?= $val->m_purchase_price ?></td>
                                                                        <td>₹<?= $val->m_purchase_total ?></td>
                                                                        <td><?= $val->m_purchase_gst ?></td>
                                                                        <td><?= $val->m_purchase_dis ?></td>
                                                                        <td>₹<?= $val->m_purchase_netamt ?></td>
                                                                    </tr>
                                                            <?php }
                                                            } ?>
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                            <div class="col-8">
                                                <h6>Terms and Conditions</h6>
                                                <p><?= $value->m_purchase_terms ?></p>
                                                <h6>Note</h6>
                                                <p><?= $value->m_purchase_note ?></p>
                                            </div>
                                            <div class="col-4 text-end fw-bold">
                                                    <h6 class="border-bottom border-1 border-secondary pb-2"> Sub Total: ₹<?= $value->item_sub_total; ?></h6>

                                                    <h6 class="border-bottom border-1 border-secondary pb-2">Total Tax : ₹<?= $value->total_tax ?></h6>

                                                    <h6 class="border-bottom border-1 border-secondary pb-2">Discount : ₹<?= $value->total_disc; ?></h6>

                                                    <h6 class="border-bottom border-1 border-secondary pb-2">Shipping : ₹<?= $value->m_purchase_shipping; ?></h6>

                                                    <h5>Grand Total : ₹<?= $value->m_purchase_nettotal; ?></h5>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- view purchase detail -->
                            <a href="<?php echo base_url('User/edit_purchase/' . $purtype . '?id=') . $value->m_purchase_spo;  ?>"><button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></button></a>
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