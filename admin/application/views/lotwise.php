<?php include("head.php"); ?>
<?php include("header.php"); ?>
<!-- ========== Page Content ========== -->
<section class="py-1" style="background: #bbf;">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-6">
                <h6 class="m-0 text-white">
                    Home >> <span class="text-primary">Lot Wise Sales Report</span>
                </h6>
            </div>
            <div class="col-6 text-end">
                <a href="#" class="btn btn-danger btn-sm">
                    <i class="bi bi-box-arrow-left me-2"></i>Exit
                </a>
            </div>
        </div>
    </div>
</section>
<section class="py-4 d-flex align-items-center" style="background:#f3f3ff;min-height:70vh;">
    <div class="container-fluid">
        <div class="row justify-content-evenly g-0">
            <div class="col-7">
                <form action="#" method="POST" class="row align-items-center">
                    <div class="col-2">
                        <a href="#" class="btn btn-warning btn-sm w-100">
                            <i class="bi bi-receipt-cutoff me-2"></i>Lot Report
                        </a>
                    </div>
                    <div class="col-4">
                        <div class="input-group">
                            <input type="date" class="form-control">
                            <button class="btn btn-info">View Lot</button>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for Items, Lots or Chalaan">
                            <button class="btn btn-info"><i class="bi bi-search mx-1"></i></button>
                        </div>
                    </div>
                </form>
                <div class="table-responsive mt-3 bg-light" style="height: 64vh;">
                    <table class="table table-light table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width: 30px;">SN</th>
                                <th style="width: 250px;">Item Name</th>
                                <th class="text-center">Lot</th>
                                <th class="text-center">Challan</th>
                                <th class="text-center">Opening</th>
                                <th class="text-center">Closing</th>
                                <th class="text-center">Unit</th>
                                <th class="text-center">Wait</th>
                                <th class="text-center">Crate</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>---</td>
                                <td>---</td>
                                <td>---</td>
                                <td>---</td>
                                <td>---</td>
                                <td>---</td>
                                <td>---</td>
                                <td>---</td>
                                <td>---</td>
                            </tr>
                            <tr>
                                <td>---</td>
                                <td>---</td>
                                <td>---</td>
                                <td>---</td>
                                <td>---</td>
                                <td>---</td>
                                <td>---</td>
                                <td>---</td>
                                <td>---</td>
                            </tr>
                            <tr>
                                <td>---</td>
                                <td>---</td>
                                <td>---</td>
                                <td>---</td>
                                <td>---</td>
                                <td>---</td>
                                <td>---</td>
                                <td>---</td>
                                <td>---</td>
                            </tr>
                            <tr>
                                <td>---</td>
                                <td>---</td>
                                <td>---</td>
                                <td>---</td>
                                <td>---</td>
                                <td>---</td>
                                <td>---</td>
                                <td>---</td>
                                <td>---</td>
                            </tr>
                            <tr>
                                <td>---</td>
                                <td>---</td>
                                <td>---</td>
                                <td>---</td>
                                <td>---</td>
                                <td>---</td>
                                <td>---</td>
                                <td>---</td>
                                <td>---</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-4">
                <nav>
                    <div class="nav nav-tabs d-flex" id="nav-tab" role="tablist" style="flex-wrap: nowrap;">
                        <button class="nav-link ll1 w-100 active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Opening</button>
                        <button class="nav-link ll2 w-100" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Today's
                            Sale</button>
                        <button class="nav-link ll3 w-100" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Closing</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                        <div class="table-responsive" style="height: 60vh; background:#fff3cd;overflow-y:scroll;">
                            <table class="table table-warning table-bordered table-hover m-0">
                                <thead>
                                    <tr>
                                        <th style="width: 30px;">SN</th>
                                        <th>Customer</th>
                                        <th class="text-center" style="width: 60px;">Quantity</th>
                                        <th class="text-center" style="width: 60px;">Wait</th>
                                        <th class="text-center" style="width: 70px;">Price</th>
                                        <th class="text-center" style="width: 80px;">total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                    </tr>
                                    <tr>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                    </tr>
                                    <tr>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                    </tr>
                                    <tr>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                    </tr>
                                    <tr>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Total</th>
                                    <th class="text-center" style="width: 60px;">---</th>
                                    <th class="text-center" style="width: 60px;">---</th>
                                    <th class="text-center" style="width: 70px;"></th>
                                    <th class="text-center" style="width: 80px;">₹--</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                        <div class="table-responsive" style="height: 60vh;background:#d1e7dd; overflow-y:scroll;">
                            <table class="table table-success table-bordered table-hover m-0">
                                <thead>
                                    <tr>
                                        <th style="width: 30px;">SN</th>
                                        <th>Customer</th>
                                        <th class="text-center" style="width: 60px;">Quantity</th>
                                        <th class="text-center" style="width: 60px;">Wait</th>
                                        <th class="text-center" style="width: 70px;">Price</th>
                                        <th class="text-center" style="width: 80px;">total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                    </tr>
                                    <tr>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                    </tr>
                                    <tr>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                    </tr>
                                    <tr>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                    </tr>
                                    <tr>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Total</th>
                                    <th class="text-center" style="width: 60px;">---</th>
                                    <th class="text-center" style="width: 60px;">---</th>
                                    <th class="text-center" style="width: 70px;"></th>
                                    <th class="text-center" style="width: 80px;">₹--</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">
                        <div class="table-responsive" style="height: 60vh;background:#cfe2ff; overflow-y:scroll;">
                            <table class="table table-primary table-bordered table-hover m-0">
                                <thead>
                                    <tr>
                                        <th style="width: 30px;">SN</th>
                                        <th>Customer</th>
                                        <th class="text-center" style="width: 60px;">Quantity</th>
                                        <th class="text-center" style="width: 60px;">Wait</th>
                                        <th class="text-center" style="width: 70px;">Price</th>
                                        <th class="text-center" style="width: 80px;">total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                    </tr>
                                    <tr>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                    </tr>
                                    <tr>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                    </tr>
                                    <tr>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                    </tr>
                                    <tr>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Total</th>
                                    <th class="text-center" style="width: 60px;">---</th>
                                    <th class="text-center" style="width: 60px;">---</th>
                                    <th class="text-center" style="width: 70px;"></th>
                                    <th class="text-center" style="width: 80px;">₹--</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========== Page Content ========== -->
<?php include("footer.php"); ?>
