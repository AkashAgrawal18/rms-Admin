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
                    <a href="<?= base_url('Dashboard'); ?>" class="text-white text-decoration-none ">Dashboard</a> >> <a href="<?= base_url('Master/banner'); ?>" class="text-decoration-none fw-bold"><span class="text-warning">
                            Banners</span></a>
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

<div class="container-fluid bg-light pb-5" style="padding-top: 25px; min-height:75vh">
    <div class="card p-3 set-card">
        <div class="row">
            <div class="col-md-6 text-start">
                <h4>Top Banner</h4>
            </div>
            <div class="col-md-6 text-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdropadd"> + Add Banner </button>
            </div>
        </div>
        <hr>
        <div class="row g-3 align-items-stretch" id="banner_tbl">
            <?php
            if (!empty($all_value)) {
                foreach ($all_value as $value) {
                    if ($value->m_slider_type == 1) {
                        if (!empty($value->m_slider_image)) {
                            $slider = site_url('uploads/slider/') . $value->m_slider_image;
                        } else {
                            $slider = site_url('uploads/default.jpg');
                        }
            ?>
                        <div class="col-md-2">
                            <div class="card p-3 border border-1 border-primary h-100">
                                <img src="<?= $slider; ?>" alt="kurtis" class="w-100" style="aspect-ratio: 5/3;">
                                <h5 class="mt-3 mb-1">
                                    <?= $value->m_slider_title; ?>

                                </h5>
                                <div class="d-flex gap-1 align-items-stretch">

                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#banner1edit<?= $value->m_slider_id; ?>"><i class="fa-solid fa-pen-to-square"></i></button>

                                    <!-- top edit Modal -->
                                    <div class="modal fade" id="banner1edit<?= $value->m_slider_id; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Edit Banner</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" id="frm_slider_add<?= $value->m_slider_id; ?>">
                                                        <div class="form-group mb-3">
                                                            <label for="exampleInputEmail1">Title <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="m_slider_title" required aria-describedby="emailHelp" placeholder="Enter Title" value="<?= $value->m_slider_title; ?>">
                                                        </div>
                                                        <div class="form-group mb-3">
                                                            <label for="exampleInputEmail1">Image</label><br>
                                                            <input type="file" class="form-control-file" name="m_slider_image">
                                                            <input type="hidden" class="form-control-file" name="m_slider_image1" value="<?= $value->m_slider_image; ?>">
                                                            <input type="hidden" class="form-control-file" name="m_slider_type" value="<?= $value->m_slider_type; ?>">
                                                            <input type="hidden" class="form-control-file" name="m_slider_id" value="<?= $value->m_slider_id; ?>">
                                                        </div>


                                                        <div class="form-group mb-3">
                                                            <label for="exampleInputEmail1">Status</label>
                                                            <select class="form-control" name="m_slider_status">
                                                                <option value="1" <?php if ($value->m_slider_status == 1) echo "selected"; ?>>Active</option>
                                                                <option value="2" <?php if ($value->m_slider_status == 2) echo "selected"; ?>>Inactive</option>
                                                            </select>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary btn-sm btn_slider_add" data-frmid="#frm_slider_add<?= $value->m_slider_id; ?>">Update</button>
                                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <?php if ($value->m_slider_id == 1) {
                                    } else { ?>
                                        <button type="button" data-value="<?= $value->m_slider_id; ?>" class="btn btn-danger delete-banner btn-sm "><i class="fa-solid fa-trash"></i></button>
                                    <?php } ?>

                                </div>
                            </div>
                        </div>
            <?php }
                }
            } ?>
          
        </div>
        <div class="row">
            <div class="col-md-6 text-start">
                <h4>Second Banner</h4>
            </div>
            <div class="col-md-6 text-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">+ Add Banner</button>
            </div>
        </div>
        <hr>
        <div class="row g-3 align-items-stretch" id="banner_tbl1">
            <?php
            if (!empty($all_value)) {
                foreach ($all_value as $value) {
                    if ($value->m_slider_type == 2) {


                        if (!empty($value->m_slider_image)) {
                            $slider = site_url('uploads/slider/') . $value->m_slider_image;
                        } else {
                            $slider = site_url('uploads/default.jpg');
                        }
            ?>


                        <div class="col-md-2">
                            <div class="card p-3 border border-1 border-primary h-100">
                                <img src="<?= $slider; ?>" alt="kurtis" class="w-100" style="aspect-ratio: 5/3;">
                                <h5 class="mt-3 mb-1">
                                    <?= $value->m_slider_title; ?>

                                </h5>
                                <div class="d-flex gap-1 align-items-stretch">
                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdropview<?= $value->m_slider_id; ?>"><i class="fa-solid fa-file"></i></button>
                                    <!-- description -->
                                    <div class="modal fade" id="staticBackdropview<?= $value->m_slider_id; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel"><?= $value->m_slider_title; ?></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><?= $value->m_slider_des; ?></p>
                                                </div>
                                                <div class="modal-footer">

                                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" aria-label="Close">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#banner2edit<?= $value->m_slider_id; ?>"><i class="fa-solid fa-pen-to-square"></i></button>

                                    <!-- second edit Modal -->
                                    <div class="modal fade" id="banner2edit<?= $value->m_slider_id; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Update Banner</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" id="frm_slider_add<?= $value->m_slider_id; ?>">
                                                        <div class="form-group mb-3">
                                                            <label for="exampleInputEmail1">Title <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="m_slider_title" required aria-describedby="emailHelp" placeholder="Enter Title" value="<?= $value->m_slider_title; ?>">
                                                        </div>
                                                        <div class="form-group mb-3">
                                                            <label for="exampleInputEmail1">Image</label><br>
                                                            <input type="file" class="form-control-file" name="m_slider_image">
                                                            <input type="hidden" name="m_slider_image1" value="<?= $value->m_slider_image; ?>">
                                                            <input type="hidden" name="m_slider_type" value="<?= $value->m_slider_type; ?>">
                                                            <input type="hidden" name="m_slider_id" value="<?= $value->m_slider_id; ?>">
                                                        </div>
                                                        <div class="form-group mb-3">
                                                            <label for="exampleInputEmail1">Description</label>
                                                            <textarea class="form-control" name="m_slider_des" rows="2"><?= $value->m_slider_des; ?></textarea>
                                                        </div>

                                                        <div class="form-group mb-3">
                                                            <label for="exampleInputEmail1">Status</label>
                                                            <select class="form-control" name="m_slider_status">
                                                                <option value="1" <?php if ($value->m_slider_id == 1) echo "selected"; ?>>Active</option>
                                                                <option value="2" <?php if ($value->m_slider_id == 2) echo "selected"; ?>>Inactive</option>
                                                            </select>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary btn-sm btn_slider_add" data-frmid="#frm_slider_add<?= $value->m_slider_id; ?>">Update</button>
                                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <?php if ($value->m_slider_id == 4) {
                                    } else { ?>
                                        <button type="button" data-value="<?= $value->m_slider_id; ?>" class="btn btn-danger delete-banner1 btn-sm "><i class="fa-solid fa-trash"></i></button>
                                    <?php } ?>
                                </div>

                            </div>
                        </div>
            <?php }
                }
            } ?>
          
        </div>
    </div>
</div>

<!-- second add Modal -->
<div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Banner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="frm_slider_addd">
                    <div class="form-group mb-3">
                        <label for="exampleInputEmail1">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="m_slider_title" required aria-describedby="emailHelp" placeholder="Enter Title">
                    </div>
                    <div class="form-group mb-3">
                        <label for="exampleInputEmail1">Image</label><br>
                        <input type="file" class="form-control-file" name="m_slider_image">
                        <input type="hidden" class="form-control-file" name="m_slider_type" value="2">
                    </div>
                    <div class="form-group mb-3">
                        <label for="exampleInputEmail1">Description</label>
                        <textarea class="form-control" name="m_slider_des" id="exampleFormControlTextarea1" rows="2"></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="exampleInputEmail1">Status</label>
                        <select class="form-control" name="m_slider_status">
                            <option value="1" selected>Active</option>
                            <option value="2">Inactive</option>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm btn_slider_add" data-frmid="#frm_slider_addd">Add</button>
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!--top add Modal -->
<div class="modal fade" id="staticBackdropadd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Banner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="frm_slider_add">
                    <div class="form-group mb-3">
                        <label for="exampleInputEmail1">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="m_slider_title" required aria-describedby="emailHelp" placeholder="Enter Title">
                    </div>
                    <div class="form-group mb-3">
                        <label for="exampleInputEmail1">Image</label><br>
                        <input type="file" class="form-control-file" name="m_slider_image">
                        <input type="hidden" name="m_slider_type" value="1">
                    </div>
                    <div class="form-group mb-3">
                        <label for="exampleInputEmail1">Status</label>
                        <select class="form-control" name="m_slider_status">
                            <option value="1" selected>Active</option>
                            <option value="2">Inactive</option>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm btn_slider_add" data-frmid="#frm_slider_add">Add</button>
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- ========== Page Content ========== -->
<?php include("footer.php"); ?>
<?php $this->view('js/master_js'); ?>