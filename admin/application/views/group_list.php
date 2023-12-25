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
                    <a href="<?php echo base_url('Dashboard'); ?>" class="text-white text-decoration-none ">Dashboard</a> >> <?= $pagetitle ?> >> <a href="<?php echo base_url('Main/group_list/').$type; ?>" class="text-decoration-none fw-bold"><span class="text-warning"> <?= $pagetitle ?></span></a>
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
    <div class="row pt-3">
        <div class="col-md-9">
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#groupadd"><i class="fa-solid fa-plus"></i> Add New <?= $pagetitle ?></button>
        </div>
        <div class="col-md-3">
            <form class="input-group form-group" method="post" action="<?php echo base_url('Main/group_list/').$type;  ?>">
                <div class="form-outline" data-mdb-input-init>
                    <input type="text" name="search" value="<?php echo $search; ?>" class="form-control" />
                    <!-- <label class="form-label" for="form1">Search</label> -->
                </div>
                <button type="submit" class="btn btn-primary me-3" data-mdb-ripple-init>
                    <i class="fas fa-search"></i>
                </button>
                <a type="submit" href="<?php echo base_url('Main/group_list').$type;  ?>" class="btn btn-primary me-2" data-mdb-ripple-init>
                    <i class="fa-solid fa-rotate"></i>
                </a>
            </form>
        </div>
    </div>
    <br>

    <div class="row p-1 m-2">
        <?php
        $i = 1;
        if (!empty($all_value)) {
            foreach ($all_value as $value) {
        ?>
                <div class="col-2">

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="card-title"><?= $value->m_group_name; ?></h5>
                                    <?php if ($value->m_group_status == 1) {
                                        echo '<span class="badge btn btn-success" style="position: absolute;top: 0.3rem;right: 0.3rem;">Active</span>';
                                    } else {
                                        echo '<span class="badge btn btn-danger" style="position: absolute;top: 0.3rem;right: 0.3rem;">In Active</span>';
                                    } ?>
                                </div>

                            </div>
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#groupedi<?php echo $value->m_group_id; ?>"><i class="fa-solid fa-pen-to-square"></i></button>

                            <!-- Modal -->
                            <div class="modal fade" id="groupedi<?php echo $value->m_group_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <form class="modal-content" method="post" id="form_group_edit">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit <?= $pagetitle ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row g-3">
                                                <div class="col-md-12">
                                                    <label for="Name">Name<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="m_group_name" required placeholder="Enter Name" value="<?= $value->m_group_name; ?>">
                                                    <input type="hidden" name="m_group_id"  value="<?= $value->m_group_id; ?>">
                                                    <input type="hidden" name="m_group_type" value="<?= $type; ?>">
                                                </div>

                                                <div class="col-md-12">
                                                    <label for="order">Status</label>
                                                    <select class="form-control" name="m_group_status" required>
                                                        <option value="" selected>Select Status</option>
                                                        <option value="1" <?php if ($value->m_group_status == 1) echo 'selected'; ?>>Active</option>
                                                        <option value="2" <?php if ($value->m_group_status == 2) echo 'selected'; ?>>In-Active</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" id="btn_group_edit" class="btn btn-primary"> <i class="fa-regular fa-pen-to-square"></i> Update</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <button type="button" data-value="<?php echo $value->m_group_id;  ?>" class="btn btn-danger btn-sm group-delete"><i class="fa-solid fa-trash"></i></button>

                            <!-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> -->
                            <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->

                        </div>
                    </div>

                </div>
        <?php $i++;
            }
        }  ?>

    </div>


    
</div>


<!-- ========== Page Content ========== -->
<?php include("footer.php"); ?>
<?php $this->view('custom_page'); ?>
<?php $this->view('js/main_js'); ?>
<?php $this->view('js/custom_js'); ?>