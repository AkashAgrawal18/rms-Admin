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
                    <a href="<?php echo base_url('Dashboard'); ?>" class="text-white text-decoration-none ">Dashboard</a> >> <a href="<?php echo base_url('Main/offer'); ?>" class="text-decoration-none fw-bold"><span class="text-warning">
                            Offers</span></a>
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
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-plus"></i> Add New Offer</button>
        </div>
        <div class="col-md-3">
           <!--  <div class="input-group form-group">
                <button type="button" class="btn btn-primary me-3" data-mdb-ripple-init>
                    <i class="fas fa-search"></i>
                </button>
                <input type="date" id="date" name="date" class="form-control">
            </div> -->
        </div>
    </div>
  <br>
    <table class="table my_custom_datatable table-bordered mt-3" id="offer_tbl">
        <thead>
        <tr>
            <th>S.No</th>
            <th>Main Title</th>
            <th>Title</th>
            <th>Priority</th>
            <th>Image</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
     <?php  $i = 1;
          if (!empty($all_value)) {
            foreach ($all_value as $value) {

                if (!empty($value->m_offer_image)) {
                    $imgsrc2 = site_url('uploads/offer/').$value->m_offer_image;
                } else {
                    $imgsrc2 = site_url('uploads/default.jpg');
                }


                ?>
        <tr>
            <td><?php echo  $i;?></td>
            <td><?php echo  $value->m_offer_maintitle;?></td>
            <td><?php echo  $value->m_offer_title;?></td>
            <td><?php echo  $value->m_offer_priority;?></td>
            <td><img src="<?php echo $imgsrc2 ?>" alt="" width="40px"></td>
            <td><?php if($value->m_offer_status== 1){echo 'Active';}else{echo 'In-Active';}?></td>
            <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo  $value->m_offer_id;?>"><i class="fa-solid fa-pen-to-square"></i></button>
              <!-- Modal -->
            <div class="modal fade" id="exampleModal<?php echo  $value->m_offer_id;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Offer</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="post" id="frm-edit-offer">
                    <div class="form-group mb-3">
                    <label for="exampleInputEmail1">Main Title</label>
                    <input type="text" class="form-control" name="m_offer_maintitle" aria-describedby="emailHelp" value="<?php echo $value->m_offer_maintitle;  ?>" placeholder="Enter Main Title">
                </div>
                    <div class="form-group mb-3">
                        <label for="exampleInputEmail1">Title</label>
                        <input type="text" class="form-control" name="m_offer_title" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $value->m_offer_title;  ?>" placeholder="Enter Title">
                        <input type="hidden" name="m_offer_id" value="<?php echo  $value->m_offer_id;?>">
                    </div>
                    <div class="form-group mb-3">
                        <label for="exampleInputEmail1">Priority</label>
                        <input type="text" class="form-control" name="m_offer_priority" id="exampleInputEmail1" value="<?php echo $value->m_offer_priority;  ?>" aria-describedby="emailHelp" placeholder="Enter Priority">
                    </div>
                    <div class="form-group mb-3">
                        <label for="exampleInputEmail1">Image</label><br>
                        <input type="file" class="form-control-file" name="m_offer_image" id="exampleFormControlFile1">
                          <input type="hidden" name="m_offer_images" id="m_offer_images" value="<?php echo $value->m_offer_image;  ?>">
                    </div>
                    <div class="form-group mb-3">
                        <label for="exampleInputEmail1">Status</label>
                        <select class="form-control" name="m_offer_status" id="exampleFormControlSelect1">
                            <option value="1" <?php if($value->m_offer_status == 1)echo "selected";  ?>>Active</option>
                            <option value="2" <?php if($value->m_offer_status == 2)echo "selected";  ?>>Inactive</option>
                        </select>
                    </div>

                    <div class="modal-footer">
                <button type="submit" id="btn-edit-offer" class="btn btn-primary">Update</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
            </div>
                </form>

                        </div>
                        
                    </div>
                </div>
            </div>


                <button type="button" data-value="<?php echo $value->m_offer_id;?>" class="btn btn-primary btn-sm delete-offer"><i class="fa-solid fa-trash"></i></button>
            </td>
        </tr>
    <?php $i++;}} ?>
        </tbody>
    </table>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Offer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="frm-add-offer">
                    <div class="form-group mb-3">
                    <label for="exampleInputEmail1">Main Title</label>
                    <input type="text" class="form-control" name="m_offer_maintitle" aria-describedby="emailHelp" placeholder="Enter Main Title">
                </div>
                    <div class="form-group mb-3">
                        <label for="exampleInputEmail1">Title</label>
                        <input type="text" class="form-control" name="m_offer_title" id="exampleInputEmail1" aria-describedby="emailHelp"  placeholder="Enter Title">
                    </div>
                    <div class="form-group mb-3">
                        <label for="exampleInputEmail1">Priority</label>
                        <input type="text" class="form-control" name="m_offer_priority" id="exampleInputEmail1"  aria-describedby="emailHelp" placeholder="Enter Priority">
                    </div>
                    <div class="form-group mb-3">
                        <label for="exampleInputEmail1">Image</label><br>
                        <input type="file" class="form-control-file" name="m_offer_image" id="exampleFormControlFile1">
                          
                    </div>
                    <div class="form-group mb-3">
                        <label for="exampleInputEmail1">Status</label>
                        <select class="form-control" name="m_offer_status" >
                            <option value="1" >Active</option>
                            <option value="2" >Inactive</option>
                        </select>
                    </div>

                    <div class="modal-footer">
                <button type="submit" id="btn-add-offer" class="btn btn-primary">Add</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
            </div>
                </form>
            </div>
            
        </div>
    </div>
</div>



<!-- ========== Page Content ========== -->
<?php include("footer.php"); ?>
<?php $this->view('js/main_js'); ?>
<?php $this->view('js/custom_js'); ?>