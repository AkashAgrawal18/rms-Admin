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
                    <a href="dashboard.php" class="text-white text-decoration-none ">Dashboard</a> >> Purchases >>
                    Stock Transfer >> <a href="#" class="text-decoration-none fw-bold"><span class="text-warning">Edit</span></a>
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
        <div class="col-md-6">
            <label for="Name">Invoice Number</label>
            <input type="text" class="form-control" id="name" placeholder="Enter Invoice Number">
        </div>
        <div class="col-md-6">
            <label for="Name">Warehouse</label>
            <input type="text" class="form-control" id="name" placeholder="Customer Name">
        </div>
        <div class="col-md-6">
            <label for="Name">Stock Transfer Date</label>
            <input type="date" class="form-control" id="date">
        </div>
        <div class="col-md-6">
            <label for="Name">Product</label>
            <input type="text" class="form-control" id="product" placeholder="Product Name">
        </div>
        <div class="col-md-12">
            <table class="table table-bordered mt-4">
                <tr>
                    <th>S.no</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Discount</th>
                    <th>Tax</th>
                    <th>SubTotal</th>
                    <th>Action</th>

                </tr>
                <tr>
                    <td>1</td>
                    <td>xyz</td>
                    <td>1</td>
                    <td>₹500.00</td>
                    <td>0</td>
                    <td>₹00.00</td>
                    <td>₹500.00</td>
                    <td>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-pen-to-square"></i></button>
                        <button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-md-8">
            <label for="Name">Terms & Conditions</label>
            <textarea class="form-control mb-4" id="exampleFormControlTextarea1" rows="2" placeholder="1. Goods once sold will not be taken back or exchanged 	2. All disputes are subject to [ENTER_YOUR_CITY_NAME] jurisdiction only"></textarea>

            <label for="Name">Notes</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="5"></textarea>

        </div>
        <div class="col-md-4 mb-5">
            <label for="order">Order Status</label>
            <select class="form-control mb-3" id="exampleFormControlSelect1">
                <option>Completed</option>
                <option>Pending</option>
            </select>
            <label for="order">Order Tax</label>
            <select class="form-control mb-3" id="exampleFormControlSelect1">
                <option>GST (30%)</option>
                <option>GST (10%)</option>
            </select>

            <label for="order">Discount</label>
            <div class="input-group mb-3">
                <span class="input-group-text">₹</span>
                <input type="number" class="form-control" aria-label="Dollar amount (with dot and two decimal places)">
            </div>
            <label for="order">Shipping</label>
            <div class="input-group mb-3">
                <span class="input-group-text">₹</span>
                <input type="number" class="form-control" aria-label="Dollar amount (with dot and two decimal places)">
            </div>

            <div class="row">
                <div class="col-md-6">
                    Order Tax
                </div>
                <div class="col-md-6">
                    ₹00.00
                </div>
                <div class="col-md-6">
                    Discount
                </div>
                <div class="col-md-6">
                    ₹00.00
                </div>
                <div class="col-md-6">
                    Shipping
                </div>
                <div class="col-md-6">
                    ₹00.00
                </div>
                <div class="col-md-6">
                    Grand Total
                </div>
                <div class="col-md-6">
                    ₹500.00
                </div>
            </div>
            <button type="button" class="btn btn-primary w-100 btn-sm"><i class="fa-solid fa-file"></i> Save</button>

        </div>
    </div>
</div>

<!-- edit Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Cotton Kurti</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label for="order">Price</label>
                <div class="input-group mb-3">
                    <span class="input-group-text">₹</span>
                    <input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)">
                </div>

                <label for="order">Discount</label>
                <div class="input-group mb-3">
                    <input type="number" class="form-control" aria-label="Dollar amount (with dot and two decimal places)">
                    <span class="input-group-text">%</span>
                </div>
                <label for="order">Tax</label>
                <select class="form-control mb-3" id="exampleFormControlSelect1">
                    <option>GST (30%)</option>
                    <option>GST (10%)</option>
                </select>
                <label for="order">Tax Type</label>
                <select class="form-control mb-3" id="exampleFormControlSelect1">
                    <option>Exclusive</option>
                    <option>Inclusive</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"><i class="fa-regular fa-pen-to-square"></i> Update</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- ========== Page Content ========== -->
<?php include("footer.php"); ?>