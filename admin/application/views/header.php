<!-- ========== header ========== -->
<style>
    table.table td,
    table.table th {
        border: 0.3px solid #80808040 !important;
    }

    .modal-content{
        background-color: #c5c5c5 !important;
    }

    .bg-light {
        background-color: #afafafa8 !important;
    }

</style>
<!-- top navigation -->
<nav class="navbar navbar-expand-lg border-bottom sticky-top py-0" data-bs-theme="dark" style="background: #797979 !important;">
    <div class=" container-fluid">
        <a class="navbar-brand" href="<?php echo base_url('Dashboard'); ?>"><i class="bi bi-house-fill"></i></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li> -->
                <li class="nav-item dropdown me-xl-3 me-1">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Parties
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo base_url('Account/customer'); ?>">Customers</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url('Account/supplier'); ?>">Suppliers</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url('Account/expense_acc'); ?>">Expense</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url('Account/cash_bank_acc'); ?>">Cash Bank</a></li>

                    </ul>
                </li>
                <li class="nav-item dropdown me-xl-3 me-1">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Product Manager
                    </a>
                    <ul class="dropdown-menu">
                        <!-- <li><a class="dropdown-item" href="<?php echo base_url('Master/brands'); ?>">Brands</a></li> -->
                        <li><a class="dropdown-item" href="<?php echo base_url('Master/categories'); ?>">Categories</a></li>
                        <!-- <li><a class="dropdown-item" href="<?php echo base_url('Master/variations'); ?>">Variations</a></li> -->
                        <li><a class="dropdown-item" href="<?php echo base_url('Master/products'); ?>">Products</a></li>
                        <?php
                        $offer_type = $this->db->where('m_offer_status', 1)->get('master_offers')->result();

                        if (!empty($offer_type)) {
                            foreach ($offer_type as $otype) {  ?>

                                <li><a class="dropdown-item" href="<?php echo base_url('Master/product_offers/') . $otype->m_offer_id; ?>"><?php echo $otype->m_offer_title; ?>(<?php echo $otype->m_offer_maintitle; ?>)</a></li>
                        <?php  }
                        }
                        ?>



                    </ul>
                </li>
                <li class="nav-item dropdown me-xl-3 me-1">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Sales
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo base_url('Main/sales'); ?>">Sales</a></li>
                        <!-- <li><a class="dropdown-item" href="<?php echo base_url('Main/sales_return'); ?>">Sales Return</a></li> -->
                        <li><a class="dropdown-item" href="<?php echo base_url('Main/payment_recieved'); ?>">Payment In</a></li>
                        <!-- <li><a class="dropdown-item" href="<?php echo base_url('Main/quotation'); ?>">Quotation / Estimate</a></li> -->
                    </ul>
                </li>
                <li class="nav-item dropdown me-xl-3 me-1">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Purchases
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo base_url('Main/purchase'); ?>">Purchases</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url('Main/purchase_return'); ?>">Purchases Return</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url('Main/payment_paid'); ?>">Payment Out</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown me-xl-3 me-1">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Stocks
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo base_url('Report/stock_ledger'); ?>">Stock Ledger</a></li>
                        <!-- <li><a class="dropdown-item" href="<?php echo base_url('Main/stock_transfer'); ?>">Stocks Transfer</a></li> -->
                    </ul>
                </li>
                <!-- <li class="nav-item dropdown me-xl-3 me-1">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Expenses
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo base_url('Main/expense_categories'); ?>">Expenses Categories</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url('Main/expenses'); ?>">Expenses</a></li>
                    </ul>
                </li> -->
                <li class="nav-item dropdown me-xl-3 me-1">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Website Setup
                    </a>
                    <ul class="dropdown-menu">
                        <!-- <li><a class="dropdown-item" href="<?php echo base_url('Account/product_card'); ?>">Product Cards</a></li> -->
                        <li><a class="dropdown-item" href="<?php echo base_url('Account/front_setting'); ?>">Front Setting</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown me-3">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Master
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo base_url('Master/group_list/1'); ?>">Units</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url('Master/group_list/4'); ?>">Taxgsts</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url('Master/group_list/2'); ?>">Colors</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url('Master/group_list/3'); ?>">Sizes</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url('Master/group_list/5'); ?>">Brands</a></li>
                        <!-- <li><a class="dropdown-item" href="<?php echo base_url('Master/group_list/6'); ?>">Pay Mode</a></li> -->
                    </ul>
                </li>

            </ul>

            <?php

            $user_img = base_url('uploads/default-user0.png');

            if (!empty($log_user_dtl[0]->m_admin_img)) {

                if (file_exists('uploads/user/' . $log_user_dtl[0]->m_admin_img)) {

                    $user_img = base_url('uploads/user/') . $log_user_dtl[0]->m_admin_img;
                }
            }

            ?>
            <div class="d-inline-flex justify-content-start p-1 gap-2 align-items-center rounded-pill" style="align-self: center;background:#f4f4f4;">
                <img src="<?php echo $user_img; ?>" alt="" class="rounded-circle" style="aspect-ratio: 1/1;height:20px;">
                <div>
                    <h6 class="m-0 text-dark pe-3"><?php echo $log_user_dtl[0]->m_admin_name; ?></h6>
                </div>
            </div>
        </div>
    </div>
</nav>
<header style="background: #bbbbbb;">
    <div class="container-fluid d-flex align-items-center justify-content-start">
        <div class="d-inline-flex justify-content-start px-2 gap-2">
            <a href="#" class="d-block text-dark main-link active">
                <img src="<?php echo base_url(); ?>assets/icons/user.png" style="width:40%;" class="mx-auto mt-1" />
                <p class="m-0">
                    Add User
                </p>
            </a>
        </div>

        <!--line -->
        <div style="border: 1px dashed gray; width: 1px; height:70px;" class="mx-2"></div>
        <!--line -->

        <div class="d-inline-flex justify-content-start px-2 gap-1">
            <a href="<?php echo base_url('Dashboard'); ?>" class="d-block text-dark py-1 main-link">
                <img src="<?php echo base_url(); ?>assets/icons/dash.png" style="width:40%;" class="mx-auto" />
                <p class="m-0">
                    Dashboard
                </p>
            </a>
            <a href="<?php echo base_url('Main/pos'); ?>" class="d-block text-dark py-1 main-link">
                <img src="<?php echo base_url(); ?>assets/icons/order.png" style="width:40%;" class="mx-auto" />
                <p class="m-0">
                    POS
                </p>
            </a>
            <!-- <a href="<?php echo base_url('Master/cash_bank');  ?>" class="d-block text-dark py-1 main-link">
                <img src="<?php echo base_url(); ?>assets/icons/product.png" style="width:40%;" class="mx-auto" />
                <p class="m-0">
                    Cash & Bank
                </p>
            </a> -->
            <a href="<?php echo base_url('Master/offer'); ?>" class="d-block text-dark py-1 main-link">
                <img src="<?php echo base_url(); ?>assets/icons/gift.png" style="width:40%;" class="mx-auto" />
                <p class="m-0">
                    Offers
                </p>
            </a>
            <a href="<?php echo base_url('Master/coupons'); ?>" class="d-block text-dark py-1 main-link">
                <img src="<?php echo base_url(); ?>assets/icons/coupon.png" style="width:40%;" class="mx-auto" />
                <p class="m-0">
                    Coupons
                </p>
            </a>
        </div>

        <!--line -->
        <div style="border: 1px dashed gray; width: 1px; height:70px;" class="mx-2"></div>
        <!--line -->

        <!-- <div class="d-inline-flex justify-content-start px-2 gap-1">
            <a href="<?php echo base_url('Master/banner'); ?>" class="d-block text-dark py-1 main-link">
                <img src="<?php echo base_url(); ?>assets/icons/banner.png" style="width:40%;" class="mx-auto" />
                <p class="m-0">
                    Banners
                </p>
            </a>
            <a href="<?php echo base_url('Query/queries'); ?>" class="d-block text-dark py-1 main-link">
                <img src="<?php echo base_url(); ?>assets/icons/query.png" style="width:40%;" class="mx-auto" />
                <p class="m-0">
                    Queries
                </p>
            </a>
            <a href="<?php echo base_url('Query/review'); ?>" class="d-block text-dark py-1 main-link">
                <img src="<?php echo base_url(); ?>assets/icons/review.png" style="width:40%;" class="mx-auto" />
                <p class="m-0">
                    Reviews
                </p>
            </a>
          
        </div> -->


        <div class="d-inline-flex justify-content-start px-2 gap-1">
            <a href="<?php echo base_url('Account/profile'); ?>" class="d-block text-dark py-1 main-link">
                <img src="<?php echo base_url(); ?>assets/icons/profile.png" style="width:40%;" class="mx-auto" />
                <p class="m-0">
                    Profile
                </p>
            </a>
            <a href="<?php echo base_url('Login/logout') ?>" class="d-block text-dark py-1 main-link">
                <img src="<?php echo base_url(); ?>assets/icons/logout.png" style="width:40%;" class="mx-auto" />
                <p class="m-0">
                    Logout
                </p>
            </a>

        </div>
        <div class="ms-auto">

            <?php

            $img_title = get_settings('m_app_black_logo');

            if (!empty($img_title)) {

                if (file_exists('uploads/logo/' . $img_title)) {

                    $fav_img = base_url('uploads/logo/') . $img_title;
                } else {

                    $fav_img  = base_url('assets/imgs/Logo22.png');
                }
            } else {

                $fav_img  = base_url('assets/imgs/Logo22.png');
            }

            ?>
            <img src="<?php echo $fav_img; ?>" alt="" style="height: 40px;">
        </div>
    </div>
</header>