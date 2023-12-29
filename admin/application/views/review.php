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
                    <a href="<?php echo base_url('Dashboard'); ?>" class="text-white text-decoration-none ">Dashboard</a> >> <a href="<?php echo base_url('Query/review'); ?>" class="text-decoration-none fw-bold"><span class="text-warning"> Reviews</span></a>
                </p>
            </div>
           <!--  <div class="col-lg-1 text-end">
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

<div class="container-fluid bg-light">
    <!-- <div class="row pt-3">
        <div class="col-md-7">
            <button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus"></i> Add New Transfer</button> 
        </div>
        <div class="col-md-5">
            <div class="input-group form-group">
                <div class="form-outline" data-mdb-input-init>
                    <input type="search" id="form1" class="form-control" />
                    <label class="form-label" for="form1">Search</label> 
                </div>
                <button type="button" class="btn btn-primary me-3" data-mdb-ripple-init>
                    <i class="fas fa-search"></i>
                </button>
                <input type="date" id="date" name="date" class="form-control">
            </div>
        </div>
    </div> -->
   <br>
    <table class="table my_custom_datatable table-bordered mt-3" id="review_tbl">
        <thead>
        <tr>
            <th>S.No</th>
            <th>User</th>
            <th>Product</th>
            <th>Date</th>
            <th>Star</th>
            <th>Review</th>
            <!-- <th>Status</th> -->
            <th>Action</th>

        </tr>
        </thead>
        <tbody>
            <?php  $i = 1;
          if (!empty($all_value)) {
            foreach ($all_value as $value) {?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $value->m_user_name; ?> </td>
            <td><?php echo $value->m_product_name; ?> </td>
            <td><?php echo  date('d-m-Y',strtotime($value->m_review_added_on)); ?></td>
            <td><?php echo $value->m_review_rating; ?></td>
            <td><button class="btn btn-primary btn-sm"  data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $value->m_review_id ; ?>">Message</button></td>
            <!--review Modal -->
                <div class="modal fade" id="exampleModal<?php echo $value->m_review_id ; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Message</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                       <?php echo $value->m_review_des; ?>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                      </div>
                    </div>
                  </div>
                </div>
            <td>
                <!-- <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop1" aria-controls="staticBackdrop"><i class="fa-solid fa-pen-to-square"></i></button> -->

                <!-- <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop1" aria-labelledby="staticBackdropLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="staticBackdropLabel">Customer Queries</h5>

                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <hr>
                    <div class="offcanvas-body">
                        <div>
                            <div class="row g-4">
                                <div class="col-md-12">
                                    <div class="row g-4">
                                        <div class="col-6">
                                            <b>Full Name</b> : <br> <br> shivani
                                        </div>
                                        <div class="col-6">
                                            <b>EmailID</b> :<br> <br> shivani@gmail.com
                                        </div>
                                        <div class="col-6">
                                            <b>Mobile No.</b> :<br> <br> 1234567890
                                        </div>
                                        <div class="col-6">
                                            <b>Subject</b> : <br> <br> xyz
                                        </div>
                                        <div class="col-6">
                                            <b>Added On</b> :<br> <br> 04 December 2023
                                        </div>
                                        <div class="col-6">
                                            <b>Status</b> <br><br> <select class="form-select" aria-label="Default select example">
                                                <option selected>Select Status</option>
                                                <option value="1">New</option>
                                                <option value="2">Viewed</option>
                                                <option value="3">Solved</option>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            Message :<br> <br> xyz
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

                <button type="button" data-value="<?php echo $value->m_review_id; ?>" class="btn btn-primary detele-review btn-sm"><i class="fa-solid fa-trash"></i></button>

            </td>
        </tr>
        <?php $i++;}} ?>
       </tbody>
    </table>


</div>




<!-- ========== Page Content ========== -->
<?php include("footer.php"); ?>
<?php $this->view('js/main_js'); ?>
<?php $this->view('js/custom_js'); ?>