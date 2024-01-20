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
                    <a href="<?php echo base_url('Dashboard'); ?>" class="text-white text-decoration-none ">Dashboard</a> >> <a href="<?php echo base_url('Mainstock_adjust'); ?>" class="text-decoration-none fw-bold"><span class="text-warning"> Stock Ledger</span></a>
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
        <div class="col-md-12">
            <form method="post" action="<?php echo base_url('Report/stock_ledger'); ?>">
                <div class="input-group form-group">
                    <!-- Add "from date" and "to date" input fields -->
                    <!-- <div class="date-inputs"> -->
                    <div class="form-outline me-1" data-mdb-input-init>
                        <label class="form-label p-1" for="form1"> From Date </label>
                    </div>
                    &nbsp;
                    <div class="form-outline me-1" data-mdb-input-init>
                        <input type="date" name="from_date" class="form-control" onchange="this.form.submit();" value="<?php echo $from_date; ?>" />
                    </div>
                    &nbsp;
                    <div class="form-outline me-1 " data-mdb-input-init>
                        <label class="form-label p-1" for="form1"> To Date </label>
                    </div>
                    &nbsp;
                    <div class="form-outline me-1" data-mdb-input-init>
                        <input type="date" name="to_date" class="form-control" onchange="this.form.submit();" value="<?php echo $to_date; ?>" />
                    </div>
                    <!-- </div> -->&nbsp;

                    <select class="form-select" name="cat_id" onchange="this.form.submit();" aria-label="Default select example">
                        <option value="">All Category</option>
                        <?php if (!empty($all_cate)) {
                            foreach ($all_cate as $value) { ?>
                                <option value="<?php echo $value->m_category_id; ?>" <?php if ($cat_id == $value->m_category_id) echo "selected"; ?>><?php echo $value->m_category_name; ?></option>
                        <?php }
                        } ?>
                    </select>
                    &nbsp;
                    <select class="form-select" name="item_id" onchange="this.form.submit();" aria-label="Default select example">
                        <option value="">All Product</option>
                        <?php if (!empty($all_items)) {
                            foreach ($all_items as $value) { ?>
                                <option value="<?php echo $value->m_product_id; ?>" <?php if ($item_id == $value->m_product_id) echo "selected"; ?>><?php echo $value->m_product_name; ?></option>
                        <?php }
                        } ?>
                    </select>
                    &nbsp;
                    <a href="<?php echo base_url('Report/stock_ledger'); ?>" class="btn btn-primary me-2" data-mdb-ripple-init>
                        <i class="fa-solid fa-rotate"></i>
                    </a>

                </div>
            </form>
        </div>
        <!-- <div class="col-md-3">
            <div class="input-group form-group">
                <div class="form-outline" data-mdb-input-init>
                    <input type="search" id="form1" class="form-control" />
                  
                </div>
                <button type="button" class="btn btn-primary me-3" data-mdb-ripple-init>
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div> -->
    </div>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Category</th>
                <th>Product</th>
                <th>Size</th>
                <th>Colour</th>
                <th>Price</th>
                <th>Opening</th>
                <th>Closing</th>


            </tr>
        </thead>
        <tbody>
            <?php if (!empty($all_value)) {
                foreach ($all_value as $key => $value) { ?>
                    <tr>
                        <td><?= ($key + 1) ?></td>
                        <td><?= $value->m_category_name ?></td>
                        <td><?= $value->m_product_name ?></td>
                        <td><?= $value->m_size_name ?></td>
                        <td><?= $value->m_color_name ?></td>
                        <td><?= $value->m_product_seles_price ?></td>
                        <td><?= $value->opening_qty ?></td>
                        <td><?= $value->closing_qty ?></td>

                        <!-- <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-pen-to-square"></i></button>
                <button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-download"></i></button>

            </td> -->
                    </tr>
            <?php  }
            } ?>
        </tbody>

    </table>
</div>

<!-- Modal -->
<!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Adjustment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label for="Name">Product</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter Product">
                    </div>
                    <div class="col-md-4">
                        <label for="Name">Product</label><br>
                        84
                    </div>
                    <div class="col-md-4">
                        <label for="Name">Quantity</label><br>
                        <input type="text" class="form-control" id="name" placeholder="Enter quantity">
                    </div>
                    <div class="col-md-4">
                        <label for="order">Adjustment Type</label>
                        <select class="form-control mb-3" id="exampleFormControlSelect1">
                            <option>Add</option>
                            <option>Substract</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                    <label for="order">Notes</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"> <i class="fa-regular fa-pen-to-square"></i> Update</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div> -->


<!-- ========== Page Content ========== -->
<?php include("footer.php"); ?>