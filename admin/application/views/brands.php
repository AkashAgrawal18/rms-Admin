<?php include("head.php"); ?>
<?php include("header.php"); ?>

<style>
    td,th{
        vertical-align: middle !important;
    }
</style>

<!-- ========== Page Content ========== -->
<section class="py-1" style="background: #797979;">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-xl-10 col-lg-10">
                <p class="m-0 text-white small fw-light">
                    <a href="<?php echo base_url('Dashboard');?>" class="text-white text-decoration-none ">Dashboard</a> >> Product Manager >> <a href="<?php echo base_url('Main/brands');?>" class="text-decoration-none fw-bold"><span class="text-warning"> Brands</span></a>
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
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa-solid fa-plus"></i> Add New Brands</button>
            <button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-file-import"></i> Import Brands</button>
        </div>
        <div class="col-md-3">
            <div class="input-group form-group">
                <div class="form-outline" data-mdb-input-init>
                    <input type="search" id="form1" class="form-control" />
                    <!-- <label class="form-label" for="form1">Search</label> -->
                </div>
                <button type="button" class="btn btn-primary me-5" data-mdb-ripple-init>
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>

    <table class="table table-bordered mt-3">
        <tr>
            <th>S.No</th>
            <th>Name</th>
            <th>Brand Logo</th>
            <th>Action</th>

        </tr>
        <tr>
            <td>01</td>
            <td>EXAMPLE</td>
            <td>
                <img src="<?php echo base_url();?>assets/imgs/cotton.jpg" alt="kurtis" style="width:80px">
            </td>
            <td>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa-solid fa-pen-to-square"></i></button>
                <button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-trash"></i></button>
            </td>
        </tr>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="fa-regular fa-pen-to-square"></i> Edit Brand</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label for="Name">Name<span class="text-danger">*</span></label>
                <input type="text" class="form-control mb-3" id="name" placeholder="Please Enter Name">

                <label for="slug">Slug<span class="text-danger">*</span></label>
                <input type="text" class="form-control mb-3" id="slug" placeholder="Please Enter Slug">

                <label for="image">Brand Logo</label><br>
                <input type="file" class="form-control-file mb-3" id="exampleFormControlFile1">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i> Update</button>
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- ========== Page Content ========== -->
<?php include("footer.php"); ?>