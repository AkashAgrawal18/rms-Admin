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
                    <a href="<?php echo base_url('Dashboard'); ?>" class="text-white text-decoration-none ">Dashboard</a> >> Product Images >> <a href="<?php echo base_url('Master/product_image/'.$pid); ?>" class="text-decoration-none fw-bold"><span class="text-warning"> Product Images</span></a>
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

<div class="container-fluid bg-light" id="main-body" style="min-height:75vh">
    <div class="row pt-3">
        <div class="col-md-9">
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#unitadd"><i class="fa-solid fa-plus"></i> Add New Product Image</button>
        </div>
        <div class="col-md-3">
           
        </div>
    </div>
      <br>
    <table class="table my_custom_datatable table-bordered mt-3" id="image_tbl">
    	<thead>
        <tr>
            <th>S.No</th>
            <th>Image</th>
            <th>Status</th>
            <th>Action</th>

        </tr>
    </thead>
     <tbody>
         <?php  $i = 1;
          if (!empty($all_value)) {
            foreach ($all_value as $value) {

              if (!empty($value->m_image_product_img) && file_exists('uploads/product/'.$value->m_image_product_img)) {
                $product_img = base_url('uploads/product/'.$value->m_image_product_img);
              } else {
                $product_img = base_url('assets/imgs/cotton.jpg');
              }



                ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><img src="<?php echo $product_img;?>" alt="kurtis" style="width:50px; height: 50px;"></td>
            <td><?php if($value->m_image_status == 1){ echo 'Active';}else{ echo 'In-Active';} ?></td>

            <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#unitedi<?php echo $value->m_image_id; ?>"><i class="fa-solid fa-pen-to-square"></i></button>
             
				<!-- Modal -->
				<div class="modal fade" id="unitedi<?php echo $value->m_image_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				    <div class="modal-dialog modal-dialog-centered">
				        <form class="modal-content" method="post" id="form_image_edit">
				            <div class="modal-header">
				                <h5 class="modal-title" id="exampleModalLabel">Edit Product Image</h5>
				                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				            </div>
				            <div class="modal-body">
				                <div class="row g-3">
				                    <div class="col-md-12">
				                        <label for="Name">Image<span class="text-danger">*</span></label>
				                        <input type="hidden" class="form-control" name="pimage"  value="<?php echo $value->m_image_product_img; ?>">
                                        <input type="file" class="form-control" name="m_pimage">
				                        <input type="hidden" class="form-control" name="image_id"  placeholder="Enter Name" value="<?php echo $value->m_image_id; ?>">
                                         <input type="hidden" class="form-control" name="product_id"  placeholder="Enter Name" value="<?php echo $pid; ?>">
				                    </div>

				                    <div class="col-md-12">
				                        <label for="order">Status</label>
				                        <select class="form-control" name="image_status" required>
				                        	<option value="" selected>Select Status</option>
				                        	<option value="1" <?php if ($value->m_image_status == 1) echo 'selected'; ?> >Active</option>
				                        	<option value="2" <?php if ($value->m_image_status == 2) echo 'selected'; ?> >In-Active</option>
				                        </select>
				                    </div>
				                </div>
				            </div>
				            <div class="modal-footer">
				                <button type="submit" id="btn_image_edit" class="btn btn-primary"> <i class="fa-regular fa-pen-to-square"></i> Update</button>
				                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
				            </div>
				        </form>
				    </div>
				</div>


                <button type="button" data-value="<?php echo $value->m_image_id;  ?>" class="btn btn-primary btn-sm image-delete"><i class="fa-solid fa-trash"></i></button>

            </td>
        </tr>
    <?php $i++;}} ?>
    </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="unitadd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" method="post" id="form_image_add">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Product Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label for="Name">Product Image<span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="m_pimage" required >
                        <input type="hidden" class="form-control" name="product_id"  placeholder="Enter Name" value="<?php echo $pid; ?>">
                    </div>

                    <div class="col-md-12">
                        <label for="order">Status</label>
                        <select class="form-control" name="image_status" required>
                        	<option value="" selected>Select Status</option>
                        	<option value="1">Active</option>
                        	<option value="2">In-Active</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="btn_imag_add" class="btn btn-primary"> <i class="fa-regular fa-pen-to-square"></i> Add</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
            </div>
        </form>
    </div>
</div>


<!-- ========== Page Content ========== -->
<?php include("footer.php"); ?>
<?php $this->view('js/main_js'); ?>
<?php $this->view('js/custom_js'); ?>