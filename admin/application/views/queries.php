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
                    <a href="<?php echo base_url('Dashboard'); ?>" class="text-white text-decoration-none ">Dashboard</a> >> <a href="<?php echo base_url('Query/queries'); ?>" class="text-decoration-none fw-bold"><span class="text-warning"> Queries</span></a>
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

    <table class="table my_custom_datatable table-bordered mt-3" id="queries_tbl">
        <thead>
        <tr>
            <th>S.No</th>
            <th>Full Name</th>
            <th>EmailID</th>
            <th>Mobile No. </th>
            <th>Subject</th>
            <th>Status</th>
            <th>Action</th>

        </tr>
    </thead>
    <tbody>
         <?php  $i = 1;
          if (!empty($all_value)) {
            foreach ($all_value as $value) {?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $value->m_contact_name ?></td>
            <td><?php echo $value->m_contact_email ?></td>
            <td><?php echo $value->m_contact_mobile ?></td>
            <td><?php echo $value->m_contact_subject ?></td>
            
             <td>
                <?php
                             if($value->m_contact_status==1){
                              $btn_color = 'btn btn-info';
                             }
                             else if($value->m_contact_status==2){
                              $btn_color = 'btn btn-danger';
                             }
                             else{
                              $btn_color = 'btn btn-secondary';

                             }
                             ?>
                <select class="<?php echo $btn_color;?>" id="feed_status<?php echo $value->m_contact_id;?>" onchange="changeStatus(<?php echo $value->m_contact_id;?>)">
                                      <!-- <option ><?php echo $value->m_feedback_status;?></option> -->
                                      <option value="1" class="btn btn-info pull-right" style="margin-bottom:10px" <?php if($value->m_contact_status== 1) echo 'selected';?>>New</option>
                                      <option value="2" class="btn btn-danger pull-right" style="margin-bottom:10px" <?php if($value->m_contact_status==2) echo 'selected';?>>Reviewed</option>
                                       <option value="3" class="btn btn-secondary pull-right" style="margin-bottom:10px" <?php if($value->m_contact_status==3) echo 'selected';?>>Resolved</option>
                                       
                                    </select>
               </td>
            <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="offcanvas" data-bs-target="#staticBackdropview<?php echo $value->m_contact_id ?>" aria-controls="staticBackdrop"><i class="fas fa-eye"></i></button>

                <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="staticBackdropview<?php echo $value->m_contact_id ?>" aria-labelledby="staticBackdropLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="staticBackdropLabel">Queries Details</h5>

                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <hr>
                    <div class="offcanvas-body">
                        <div>
                            <div class="row g-4">
                                <div class="col-md-12">
                                    <div class="row g-4">
                                        <div class="col-6">
                                            <b>Full Name</b> : <br> <br> <?php echo $value->m_contact_name?>
                                        </div>
                                        <div class="col-6">
                                            <b>EmailID</b> :<br> <br> <?php echo $value->m_contact_email ?>
                                        </div>
                                        <div class="col-6">
                                            <b>Mobile No.</b> :<br> <br> <?php echo $value->m_contact_mobile ?>
                                        </div>
                                        <div class="col-6">
                                            <b>Subject</b> : <br> <br> <?php echo $value->m_contact_subject ?>
                                        </div>
                                        <div class="col-6">
                                            <b>Added On</b> :<br> <br> <?php echo date('d M Y',strtotime($value->m_contact_added_on))  ?>
                                        </div>
                                        <div class="col-6">
                                            <b>Status</b> <br><br> <?php if($value->m_contact_status == 1){?><span class="badge bg-info">New</span><?php }else if($value->m_contact_status == 2){ ?><span class="badge bg-danger">Viewed</span><?php }else{?> <span class="badge bg-success">Solved</span><?php } ?>
                                        </div>
                                        <div class="col-12">
                                            Message :<br> <br> <?php echo $value->m_contact_msg ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="button" data-value="<?php echo $value->m_contact_id ?>" class="btn btn-primary quert-delete btn-sm"><i class="fa-solid fa-trash"></i></button>

            </td>
        </tr>
        <?php $i++; }} ?>
      </tbody>
    </table>


</div>



<!-- ========== Page Content ========== -->
<?php include("footer.php"); ?>
<?php $this->view('js/main_js'); ?>
<?php $this->view('js/custom_js'); ?>