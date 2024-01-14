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

    .small {
        font-size: 11px;
    }
</style>

<!-- ========== Page Content ========== -->
<section class="py-1" style="background: #797979;">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-xl-10 col-lg-10">
                <p class="m-0 text-white small fw-light">
                    <a href="<?php echo base_url('Dashboard'); ?>" class="text-white text-decoration-none ">Dashboard</a> >> <a href="<?php echo base_url('Setting/product_card'); ?>" class="text-decoration-none fw-bold"><span class="text-warning">
                            Cash & Bank</span></a>
                </p>
            </div>
            <div class="col-lg-1 text-end">
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
            </div>
            <div class="col-xl-1 col-lg-2 text-end">
                <a href="#" class="btn btn-dark btn-sm rounded-pill w-100">
                    <i class="bi bi-arrow-bar-left me-1"></i><small>Back</small>
                </a>
            </div>
        </div>
    </div>
</section>

<div class="container-fluid bg-light" id="main-body" style="min-height:75vh">
    <div class="row pt-3">
        <div class="col-md-9">
            <!-- <button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus"></i> Add New Product Card</button> -->
        </div>
        <div class="col-md-3">
            <div class="input-group form-group">

                <input type="date" id="date" name="date" class="form-control">
            </div>
        </div>
    </div>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link pro-link active" id="cash-tab" data-bs-toggle="tab" data-bs-target="#cash" type="button" role="tab" aria-controls="cash" aria-selected="true">Cash</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link pro-link" id="bank-tab" data-bs-toggle="tab" data-bs-target="#bank" type="button" role="tab" aria-controls="bank" aria-selected="false">Bank</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="cash" role="tabpanel" aria-labelledby="cash-tab">
            <table class="table table-bordered mt-3">
                <tr>
                    <th>S.No</th>
                    <th>Payment Date</th>
                    <th>Reference Number</th>
                    <th>Payment Type</th>
                    <th>User</th>
                    <th>Mode Type</th>
                    <th>Amount</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>01-12-2023</td>
                    <td>PAY-IN-20</td>
                    <td>Payment In</td>
                    <td>Xyz</td>
                    <td>Cash</td>
                    <td>₹123.00</td>
                </tr>

            </table>
        </div>
        <div class="tab-pane fade" id="bank" role="tabpanel" aria-labelledby="bank-tab">
            <table class="table table-bordered mt-3">
                <tr>
                    <th>S.No</th>
                    <th>Payment Date</th>
                    <th>Reference Number</th>
                    <th>Payment Type</th>
                    <th>User</th>
                    <th>Mode Type</th>
                    <th>Amount</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>01-12-2023</td>
                    <td>PAY-IN-20</td>
                    <td>Payment In</td>
                    <td>Xyz</td>
                    <td>Paypal</td>
                    <td>₹123.00</td>
                </tr>

            </table>
        </div>
    </div>
</div>


<!-- ========== Page Content ========== -->
<?php include("footer.php"); ?>