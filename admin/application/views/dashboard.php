<?php include("head.php"); ?>
<?php include("header.php"); ?>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    td,
    th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
        vertical-align: middle !important;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>
<!-- ========== Page Content ========== -->
<section class="py-1" style="background: #797979;">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-xl-11 col-lg-10">
                <p class="m-0 text-white small fw-light">
                    <a href="#" class="text-white text-decoration-none ">Home</a> >> <a href="<?php echo base_url('Dashboard'); ?>" class="text-decoration-none fw-bold"><span class="text-warning"> Dashboard</span></a>

                </p>
            </div>
            <!-- <div class="col-xl-1 col-lg-2 text-end">
                <a href="#" class="btn btn-dark btn-sm rounded-pill w-100">
                    <i class="bi bi-arrow-bar-left me-1"></i><small>Back</small>
                </a>
            </div> -->
        </div>
    </div>
</section>
<section style="min-height: 75vh;" class="pb-5">
    <div class="container-fluid bg-light p-3">
        <div class="row g-3 align-items-stretch">
            <div class="col-md-3">
                <div class="card h-100 dash1 p-3 h-100" style="background: url('<?php echo base_url(); ?>assets/imgs/pattern.png'), linear-gradient(45deg, #0288d1, #26c6da);">
                    <div class="row align-items-stretch">
                        <div class="col-4">
                            <img src="<?php echo base_url(); ?>assets/icons/t-order.png" alt="" class="w-100">
                        </div>
                        <div class="col-8">
                            <h2 class="m-0 text-white mb-2"><?= $countRow['order']; ?></h2>
                            <a href="<?php echo base_url('Main/sales'); ?>" class="text-decoration-none text-white">
                                <h5 class="m-0">Orders</h5>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card h-100 dash3 p-3" style="background:url('<?php echo base_url(); ?>assets/imgs/pattern.png'), linear-gradient(45deg, #ff6f00, #ffca28)" ;>
                    <div class="row">
                        <div class="col-4">
                            <img src="<?php echo base_url(); ?>assets/icons/category.png" alt="" class="w-75 m-auto d-block">
                        </div>
                        <div class="col-8">
                            <h2 class="m-0 text-white mb-2"><?= $countRow['pcategory']; ?></h2>
                            <a href="<?php echo base_url('Master/categories'); ?>" class="text-decoration-none text-white">
                                <h5 class="m-0">Product Category</h5>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card h-100 dash2 p-3" style="background:url('<?php echo base_url(); ?>assets/imgs/pattern.png'), linear-gradient(45deg, #ff5252, #f48fb1)" ;>
                    <div class="row">
                        <div class="col-4">
                            <img src="<?php echo base_url(); ?>assets/icons/products.png" alt="" class="w-75 m-auto d-block">
                        </div>
                        <div class="col-8">
                            <h2 class="m-0 text-white mb-2"><?= $countRow['product']; ?></h2>
                            <a href="<?php echo base_url('Master/products'); ?>" class="text-decoration-none text-white">
                                <h5 class="m-0">Products</h5>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php $offer = $this->db->get('master_offers')->result(); ?>
            <?php foreach ($offer as $value) {

                $poffer =  $this->db->where('offer_id', $value->m_offer_id)->get('product_offers')->num_rows();

            ?>
                <div class="col-md-3">
                    <div class="card h-100 dash4 p-3" style="background:url('<?php echo base_url(); ?>assets/imgs/pattern.png'), linear-gradient(45deg, #43a047, #1de9b6)">
                        <div class="row">
                            <div class="col-4">
                                <img src="<?php echo base_url(); ?>assets/icons/offers.png" alt="" class="w-75 m-auto d-block">
                            </div>

                            <div class="col-8">
                                <h2 class="m-0 text-white mb-2"><?= $poffer; ?><span style="font-size:20px;">(<?php echo $value->m_offer_title; ?>)</span></h2>
                                <a href="<?php echo base_url('Master/product_offers/' . $value->m_offer_id); ?>" class="text-decoration-none text-white">
                                    <h5 class="m-0"><?php echo $value->m_offer_maintitle; ?></h5>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="col-md-3">
                <div class="card h-100 dash5 p-3" style="background:url('<?php echo base_url(); ?>assets/imgs/pattern.png'), linear-gradient(to right, #ad5389, #3c1053)">
                    <div class="row">
                        <div class="col-4">
                            <img src="<?php echo base_url(); ?>assets/icons/total-cus.png" alt="" class="w-75 m-auto d-block">
                        </div>
                        <div class="col-8">
                            <h2 class="m-0 text-white mb-2"><?= $countRow['customer']; ?></h2>
                            <a href="<?php echo base_url('Account/customer'); ?>" class="text-decoration-none text-white">
                                <h5 class="m-0">Total Customers</h5>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card h-100 dash6 p-3" style="background:url('<?php echo base_url(); ?>assets/imgs/pattern.png'), linear-gradient(to right, #000046, #1cb5e0)">
                    <div class="row">
                        <div class="col-4">
                            <img src="<?php echo base_url(); ?>assets/icons/enquiry.png" alt="" class="w-75 m-auto d-block">
                        </div>
                        <div class="col-8">
                            <h2 class="m-0 text-white mb-2"><?= $countRow['enqueries']; ?></h2>
                            <a href="<?php echo base_url('Query/queries'); ?>" class="text-decoration-none text-white">
                                <h5 class="m-0">Total Enquiries</h5>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card h-100 dash7 p-3" style="background:url('<?php echo base_url(); ?>assets/imgs/pattern.png'), linear-gradient(45deg, #cd1d1d, #ff6161)">
                    <div class="row">
                        <div class="col-4">
                            <img src="<?php echo base_url(); ?>assets/icons/inactive.png" alt="" class="w-75 m-auto d-block">
                        </div>
                        <div class="col-8">
                            <h2 class="m-0 text-white mb-2"><?= $countRow['inactive_customer']; ?></h2>
                            <a href="<?php echo base_url('Account/customer?status=2'); ?>" class="text-decoration-none text-white">
                                <h5 class="m-0">Inactive Customers</h5>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 mt-5">
            <div class="card h-100 dcard h-100">
                <h2 class="text-center text-dark mt-3">Placed Order <span class="text-danger">(<?= $countRow['order']; ?>)</span></h2>
                <hr>
                <table class="my_custom_datatable m-0" id="order_tbl">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Order Date</th>
                            <th>Customer</th>
                            <!-- <th>Vendor</th> -->
                            <th>Phone</th>
                            <th>Amount</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        if (!empty($all_order)) {
                            foreach ($all_order as $value) {
                                $total = $value->total_gst + $value->total_base_total;
                        ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($value->m_sale_date)); ?></td>
                                    <td><?php echo $value->customer_name; ?></td>
                                    <!-- <td>Harsh</td> -->
                                    <td><?php echo $value->customer_mobile; ?></td>
                                    <td><?php echo $total; ?></td>
                                    <td><button type="button" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></button></td>
                                </tr>
                        <?php }
                        } ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</section>

<!-- ========== Page Content ========== -->
<?php include("footer.php"); ?>
<?php $this->view('js/custom_js'); ?>
