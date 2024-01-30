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

            <div class="col-xl-1 col-lg-2 text-end">
                <button onclick="history.back()" class="btn btn-dark btn-sm rounded-pill w-100">
                    <i class="bi bi-arrow-bar-left me-1"></i><small>Back</small>
                </button>
            </div>
        </div>
    </div>
</section>

<div class="container-fluid bg-light" id="main-body" style="min-height:75vh">
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
            <?php $i = 1;
            if (!empty($all_value)) {
                foreach ($all_value as $value) { ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $value->m_acc_name; ?> </td>
                        <td><?php echo $value->m_product_name; ?> </td>
                        <td><?php echo  date('d-m-Y', strtotime($value->m_review_added_on)); ?></td>
                        <td><?php echo $value->m_review_rating; ?></td>
                        <td><button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $value->m_review_id; ?>">Message</button></td>
                        <!--review Modal -->
                        <div class="modal fade" id="exampleModal<?php echo $value->m_review_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <button type="button" data-value="<?php echo $value->m_review_id; ?>" class="btn btn-primary detele-review btn-sm"><i class="fa-solid fa-trash"></i></button>

                        </td>
                    </tr>
            <?php $i++;
                }
            } ?>
        </tbody>
    </table>


</div>




<!-- ========== Page Content ========== -->
<?php include("footer.php"); ?>
<?php $this->view('js/main_js'); ?>
<?php $this->view('js/custom_js'); ?>