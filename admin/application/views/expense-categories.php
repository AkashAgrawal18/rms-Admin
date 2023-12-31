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
                    <a href="<?php echo base_url('Dashboard'); ?>" class="text-white text-decoration-none ">Dashboard</a> >> Expenses >> <a href="<?php echo base_url('User/expense_categories'); ?>" class="text-decoration-none fw-bold"><span class="text-warning"> Expense Categories</span></a>
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

<div class="container-fluid bg-light">
    <div class="row pt-3">
        <div class="col-md-9">
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModaladd"><i class="fa-solid fa-plus"></i> Add New Expense Category</button>
        </div>
        <div class="col-md-3">
            <form class="input-group form-group" method="get" action="<?php echo base_url('User/expense_categories');  ?>">
                <div class="form-outline" data-mdb-input-init>
                    <input type="text"  name="search" value="<?php echo $search;?>" class="form-control" />
                    <!-- <label class="form-label" for="form1">Search</label> -->
                </div>
                <button type="submit" class="btn btn-primary me-3" data-mdb-ripple-init>
                    <i class="fas fa-search"></i>
                </button>
                <a type="submit" href="<?php echo base_url('User/expense_categories');  ?>" class="btn btn-primary me-2" data-mdb-ripple-init>
                   <i class="fa-solid fa-rotate"></i>
                </a>
            </form>
        </div>
    </div>
    <br>

    <table class="table my_custom_datatable table-bordered mt-3" id="expcat_tbl">
        <thead>
        <tr>
            <th>S.No</th>
            <th>Expense Category Name</th>
            <th>Description</th>
            <th>Status</th>
            <th>Action</th>

        </tr>
        </thead>
        <tbody>
            <?php 

            $i = 1;
              if($all_value){
              foreach($all_value as $value){

              ?>
        <tr>
            <td><?php echo $i;?></td>
            <td><?php echo $value->m_expcat_title;?></td>
            <td><?php echo $value->m_expcat_des;?></td>
            <td><?php if($value->m_expcat_status == 1){echo 'Active';}else{ echo 'In-Active';}?></td>
            <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModaledit<?php echo $value->m_expcat_id;?>"><i class="fa-solid fa-pen-to-square"></i></button>
                <!-- Modal -->
                    <div class="modal fade" id="exampleModaledit<?php echo $value->m_expcat_id;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <form class="modal-content" method="post" id="form_expcat_edit">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Expense Category</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row g-3">
                                        <div class="col-md-12">
                                            <label for="Name">Expense Category Name<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control"  name="m_expcat_title" placeholder="Enter Expense Category Name"  value="<?php echo $value->m_expcat_title;?>">
                                            <input type="hidden" name="m_expcat_id" value="<?php echo $value->m_expcat_id;?>">
                                        </div>

                                        <div class="col-md-12">
                                            <label for="order">Description</label>
                                            <textarea class="form-control" name="m_expcat_des"  rows="3"><?php echo $value->m_expcat_des;  ?></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="order">Status<span class="text-danger">*</span></label>
                                            <select class="form-control" name="m_expcat_status" required>
                                               <option value="" selected>Select Status</option>
                                               <option value="1" <?php if ($value->m_expcat_status == 1) echo 'selected'; ?> >Active</option>
                                                <option value="2" <?php if ($value->m_expcat_status == 2) echo 'selected'; ?> >In-Active</option>
                                        </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" id="btn_expcat_edit" class="btn btn-primary"> <i class="fa-regular fa-pen-to-square"></i> Update</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>

                <button type="button" data-value="<?php echo $value->m_expcat_id;  ?>" class="btn btn-primary expcat-delete btn-sm"><i class="fa-solid fa-trash"></i></button>

            </td>
        </tr>
        <?php $i++; }}  ?>
    </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModaladd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" method="post" id="form_expcat_add">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Expense Category</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row g-3">
                <div class="col-md-12">
                    <label for="Name">Expense Category Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control"  name="m_expcat_title" required placeholder="Enter Expense Category Name">
                </div>

                <div class="col-md-12">
                    <label for="order">Description</label>
                    <textarea class="form-control" name="m_expcat_des"  rows="3"></textarea>
                </div>
                <div class="col-md-12">
                    <label for="order">Status<span class="text-danger">*</span></label>
                    <select class="form-control" name="m_expcat_status" required>
                       <option value="" selected>Select Status</option>
                       <option value="1">Active</option>
                        <option value="2">In-Active</option>
                </select>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" id="btn_expcat_add" class="btn btn-primary"> <i class="fa-regular fa-pen-to-square"></i> add</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
        </div>
    </form>
    </div>
</div>


<!-- ========== Page Content ========== -->
<?php include("footer.php"); ?>
<?php $this->view('js/main_js'); ?>
<?php $this->view('js/custom_js'); ?>