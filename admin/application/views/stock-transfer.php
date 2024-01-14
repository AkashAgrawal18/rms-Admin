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
            <div class="col-xl-10 col-lg-10">
                <p class="m-0 text-white small fw-light">
                    <a href="<?php echo base_url('Dashboard'); ?>" class="text-white text-decoration-none ">Dashboard</a> >> <a href="<?php echo base_url('User/stock_transfer'); ?>" class="text-decoration-none fw-bold"><span class="text-warning"> Stock Transfer</span></a>
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
            <button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus"></i> Add New Transfer</button>
        </div>
        <div class="col-md-5">
            <div class="input-group form-group">
                <div class="form-outline" data-mdb-input-init>
                    <input type="search" id="form1" class="form-control" />
                    <!-- <label class="form-label" for="form1">Search</label> -->
                </div>
                <button type="button" class="btn btn-primary me-3" data-mdb-ripple-init>
                    <i class="fas fa-search"></i>
                </button>
                <select class="form-select me-3" aria-label="Default select example">
                    <option selected>Select Customer</option>
                    <option value="1">xyz</option>
                    <option value="2">abc</option>
                </select>
                <input type="date" id="date" name="date" class="form-control">
            </div>
        </div>
    </div>

    <ul class="nav nav-tabs mt-3 mb-3" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link pro-link active" id="transfered-tab" data-bs-toggle="tab" data-bs-target="#transfered" type="button" role="tab" aria-controls="transfered" aria-selected="false">Transfered</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link pro-link" id="received-tab" data-bs-toggle="tab" data-bs-target="#received" type="button" role="tab" aria-controls="received" aria-selected="true">Received</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="transfered" role="tabpanel" aria-labelledby="transfered-tab">
            <table class="table table-bordered mt-3">
                <tr>
                    <th>S.No</th>
                    <th>Invoice Number</th>
                    <th>Warehouse</th>
                    <th>Stock Transfer Date</th>
                    <th>Stock Transfer Status</th>
                    <th>Paid Amount</th>
                    <th>Total Amount</th>
                    <th>Payment Status</th>
                    <th>Action</th>

                </tr>
                <tr>
                    <td>01</td>
                    <td>STK-TRANS-116</td>
                    <td>test</td>
                    <td>29-11-2023</td>
                    <td><span class="badge bg-success">Delivered</span></td>
                    <td>₹00.00</td>
                    <td>₹1000.00</td>
                    <td><span class="badge bg-danger">UnPaid</span></td>
                    <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop1" aria-controls="staticBackdrop"><i class="fas fa-eye"></i></button>

                        <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop1" aria-labelledby="staticBackdropLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="staticBackdropLabel">STK-TRANS-116 <span class="badge bg-danger">UnPaid</span></h5>
                                <button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus"></i> Add New Payment</button>
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
                                                    Order Date : <br> 28-11-2023 01:12 pm
                                                </div>
                                                <div class="col-4">
                                                    Invoice Number :<br> SALE-155
                                                </div>
                                                <div class="col-4">
                                                    To Warehouse :<br> xyz
                                                </div>
                                                <div class="col-4">
                                                    From Warehouse : <br> xyz
                                                </div>
                                                <div class="col-4">
                                                    Order Status :<br> <span class="badge bg-success">Delivered</span>
                                                </div>
                                                <div class="col-4">
                                                    Payment Status :<br> <span class="badge bg-danger">UnPaid</span>
                                                </div>
                                                <div class="col-4">
                                                    Order Taken By:<br> Admin
                                                </div>

                                                <div class="col-4">
                                                    Total Amount:<br> ₹1000.00
                                                </div>
                                                <div class="col-4">
                                                    Paid Amount :<br>
                                                    ₹00.00
                                                </div>
                                                <div class="col-4">
                                                    Due Amount :<br> ₹00.00
                                                </div>
                                                <div class="col-4">
                                                    Discount :<br> ₹00.00
                                                </div>
                                                <div class="col-4">
                                                    Shipping :<br> ₹00.00
                                                </div>
                                                <div class="col-4">
                                                    Order Tax :<br> -
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-4">
                                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link pro-link active" id="payment-tab" data-bs-toggle="tab" data-bs-target="#payment-tab-pane" type="button" role="tab" aria-controls="payment-tab-pane" aria-selected="true">Payments</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link pro-link" id="order-tab" data-bs-toggle="tab" data-bs-target="#order-tab-pane" type="button" role="tab" aria-controls="order-tab-pane" aria-selected="false">Order Items</button>
                                                </li>
                                            </ul>
                                            <div class="tab-content" id="myTabContent">
                                                <div class="tab-pane fade show active" id="payment-tab-pane" role="tabpanel" aria-labelledby="payment-tab" tabindex="0">
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <th>Payment Date</th>
                                                            <th>Amount</th>
                                                            <th>Payment Mode</th>

                                                        </tr>
                                                        <tr>
                                                            <td>28-11-2023</td>
                                                            <td>₹5000.00</td>
                                                            <td>Cash</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="tab-pane fade" id="order-tab-pane" role="tabpanel" aria-labelledby="order-tab" tabindex="0">
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <th>Product</th>
                                                            <th>Quantity</th>
                                                            <th>Unit Price</th>
                                                            <th>Discount</th>
                                                            <th>Tax</th>
                                                            <th>Subtotal</th>
                                                        </tr>
                                                        <tr>
                                                            <td>xyz</td>
                                                            <td>2</td>
                                                            <td>₹10000.00</td>
                                                            <td>₹00.00</td>
                                                            <td>₹00.00</td>
                                                            <td>₹10000.00</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="<?php echo base_url('User/stock_transfer_edit');?>"><button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></button></a>
                        <button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-trash"></i></button>
                        <button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-download"></i></button>

                    </td>
                </tr>

            </table>
        </div>
        <div class="tab-pane fade active" id="received" role="tabpanel" aria-labelledby="received-tab">
            <table class="table table-bordered mt-3">
                <tr>
                    <th>S.No</th>
                    <th>Invoice Number</th>
                    <th>Warehouse</th>
                    <th>Stock Transfer Date</th>
                    <th>Stock Transfer Status</th>
                    <th>Paid Amount</th>
                    <th>Total Amount</th>
                    <th>Payment Status</th>
                    <th>Action</th>
                </tr>
                <tr>
                    <td>01</td>
                    <td>STK-TRANS-116</td>
                    <td>test</td>
                    <td>29-11-2023</td>
                    <td><span class="badge bg-success">Delivered</span></td>
                    <td>₹00.00</td>
                    <td>₹1000.00</td>
                    <td><span class="badge bg-success">Paid</span></td>
                    <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop1" aria-controls="staticBackdrop"><i class="fas fa-eye"></i></button>

                        <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop1" aria-labelledby="staticBackdropLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="staticBackdropLabel">SALE-155 (Invoice Number) <span class="badge bg-success">Paid</span></h5>
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
                                                    Order Date : <br> 28-11-2023 01:12 pm
                                                </div>
                                                <div class="col-4">
                                                    Invoice Number :<br> SALE-155
                                                </div>
                                                <div class="col-4">
                                                    Customer :<br> xyz
                                                </div>
                                                <div class="col-4">
                                                    Order Status :<br> <span class="badge bg-success">Delivered</span>
                                                </div>
                                                <div class="col-4">
                                                    Payment Status :<br> <span class="badge bg-success">Paid</span>
                                                </div>
                                                <div class="col-4">
                                                    Order Taken By:<br> Admin
                                                </div>

                                                <div class="col-4">
                                                    Total Amount:<br> ₹6000.00
                                                </div>
                                                <div class="col-4">
                                                    Paid Amount :<br>
                                                    ₹5000.00
                                                </div>
                                                <div class="col-4">
                                                    Due Amount :<br> ₹00.00
                                                </div>
                                                <div class="col-4">
                                                    Discount :<br> ₹00.00
                                                </div>
                                                <div class="col-4">
                                                    Shipping :<br> ₹00.00
                                                </div>
                                                <div class="col-4">
                                                    Order Tax :<br> -
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-4">
                                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link pro-link active" id="payment-tab" data-bs-toggle="tab" data-bs-target="#payment-tab-pane" type="button" role="tab" aria-controls="payment-tab-pane" aria-selected="true">Payments</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link pro-link" id="order-tab" data-bs-toggle="tab" data-bs-target="#order-tab-pane" type="button" role="tab" aria-controls="order-tab-pane" aria-selected="false">Order Items</button>
                                                </li>
                                            </ul>
                                            <div class="tab-content" id="myTabContent">
                                                <div class="tab-pane fade show active" id="payment-tab-pane" role="tabpanel" aria-labelledby="payment-tab" tabindex="0">
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <th>Payment Date</th>
                                                            <th>Amount</th>
                                                            <th>Payment Mode</th>

                                                        </tr>
                                                        <tr>
                                                            <td>28-11-2023</td>
                                                            <td>₹5000.00</td>
                                                            <td>Cash</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="tab-pane fade" id="order-tab-pane" role="tabpanel" aria-labelledby="order-tab" tabindex="0">
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <th>Product</th>
                                                            <th>Quantity</th>
                                                            <th>Unit Price</th>
                                                            <th>Discount</th>
                                                            <th>Tax</th>
                                                            <th>Subtotal</th>
                                                        </tr>
                                                        <tr>
                                                            <td>xyz</td>
                                                            <td>2</td>
                                                            <td>₹10000.00</td>
                                                            <td>₹00.00</td>
                                                            <td>₹00.00</td>
                                                            <td>₹10000.00</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-trash"></i></button>
                        <button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-download"></i></button>

                    </td>
                </tr>

            </table>
        </div>
    </div>
</div>



<!-- ========== Page Content ========== -->
<?php include("footer.php"); ?>