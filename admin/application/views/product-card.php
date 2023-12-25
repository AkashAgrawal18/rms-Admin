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
                    <a href="<?php echo base_url('Dashboard'); ?>" class="text-white text-decoration-none ">Dashboard</a> >> Website Setup >> <a href="<?php echo base_url('Setting/product_card'); ?>" class="text-decoration-none fw-bold"><span class="text-warning"> Product Cards</span></a>
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

<div class="container-fluid bg-light" >
    <div class="row pt-3">
        <div class="col-md-9">
            <button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus"></i> Add New Product Card</button>
        </div>
        <div class="col-md-3">
            <div class="input-group form-group">
                <div class="form-outline" data-mdb-input-init>
                    <input type="search" id="form1" class="form-control" />
                    <!-- <label class="form-label" for="form1">Search</label> -->
                </div>
                <button type="button" class="btn btn-primary me-3" data-mdb-ripple-init>
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>

    <table class="table table-bordered mt-3">
        <tr>
            <th>S.No</th>
            <th>Title</th>
            <th>Products</th>
            <th>Action</th>

        </tr>
        <tr>
            <td>01</td>
            <td>Kurtis <br>
                <span class="small">(Upto 60% off)</span>
            </td>
            <td>
                1. <img src="<?php echo base_url(); ?>assets/imgs/cotton.jpg" alt="kurtis" style="width:40px"> Cotton Kurtis <br>
                <hr>
                2. <img src="<?php echo base_url(); ?>assets/imgs/cotton.jpg" alt="kurtis" style="width:40px"> Chicken Kurtis <br>
                <hr>
                3. <img src="<?php echo base_url(); ?>assets/imgs/cotton.jpg" alt="kurtis" style="width:40px"> xyz
            </td>

            <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-pen-to-square"></i></button>
                <button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-download"></i></button>

            </td>
        </tr>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Product Card</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label for="Name">Title</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter Title">
                    </div>

                    <div class="col-md-12">
                        <label for="order">Subtitle</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter SubTitle">
                    </div>
                    <div class="col-md-12">
                        <label for="order">Products Image</label>
                        <input class="form-control" type="file" id="formFile">
                    </div>
                    <div class="col-md-12">
                        <label for="order">Products name</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter SubTitle">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"> <i class="fa-regular fa-pen-to-square"></i> Update</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- ========== Page Content ========== -->
<?php include("footer.php"); ?>