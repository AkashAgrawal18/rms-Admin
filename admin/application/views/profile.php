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

    .profile-card {
        border: none;
        border-radius: 10px;
        box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
    }
</style>

<!-- ========== Page Content ========== -->
<section class="py-1" style="background: #797979;">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-xl-10 col-lg-10">
                <p class="m-0 text-white small fw-light">
                    <a href="<?php echo base_url('Dashboard'); ?>" class="text-white text-decoration-none ">Dashboard</a> >> <a href="<?php echo base_url('Setting/profile'); ?>" class="text-decoration-none fw-bold"><span class="text-warning"> Profile</span></a>
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

<?php 
         $admin_img = base_url('uploads/default-user0.png');
         if (!empty($user_dtl[0]->m_user_image)) {
           $img_title = $user_dtl[0]->m_user_image; 
           if (file_exists('uploads/user/'.$img_title)){
             $admin_img = base_url('uploads/user/').$img_title;
           }
         }
         ?>

<div class="container-fluid bg-light" style="padding-top: 40px;">
    <div class="card profile-card">
        <div class="container">
            <form class="row py-5" method="post" id="frm-update-profile">
                <div class="col-md-5 text-center">
                    <input type="hidden" name="pre_m_admin_img" value="<?php echo $user_dtl[0]->m_user_image; ?>">
                    <img src="<?php echo $admin_img; ?>" alt="" class="w-50 m-auto d-block" />
                    <!-- <input class="form-control mt-3" type="file" id="formFile"> -->
                    <button type="button" id="uploadImagebtn" class="btn btn-primary mt-3" style="text-align: center;"> 
                            <span class="d-sm-block">Update Profile Picture</span></button>
                    <input
                              type="file"
                              id="uploadImage"
                              class="form-control mt-3"
                              name="m_user_image" onchange="PreviewImage();"
                              hidden
                              accept="image/png, image/jpeg, image/jpg"
                            />
                </div>
                

                <div class="col-md-7">
                    <div class="row g-3 pt-4" >
                        <div class="col-3">
                            <label for="name">Admin Name</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control" name="m_user_name" value="<?php echo $user_dtl[0]->m_user_name; ?>" placeholder="Enter Name" required>
                        </div>

                        <div class="col-3">
                            <label for="email">Email</label>
                        </div>
                        <div class="col-9">
                            <input type="email" class="form-control" name="m_user_email"  value="<?php echo $user_dtl[0]->m_user_email; ?>" placeholder="Enter Email" required>
                        </div>
                        <div class="col-3">
                            <label for="pass">Password</label>
                        </div>
                        <div class="col-9">
                            <input type="test" class="form-control" id="pass" name="m_user_pass" placeholder="Enter Password" required value="<?php echo $user_dtl[0]->m_user_password; ?>">
                        </div>
                        <div class="col-3">
                            <label for="mob">Mobile No.</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control" name="m_user_mobile"  maxlength="10" minlength="10" onkeypress="return /[0-9]/i.test(event.key)"   - only number  placeholder=" enter admin contact number" aria-label="" aria-describedby="" required  value="<?php echo $user_dtl[0]->m_user_mobile; ?>" placeholder="Enter mob">
                        </div>
                        <div class="col-4">
                            <button type="submit" id="btn-update-profile" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i> Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- ========== Page Content ========== -->
<?php include("footer.php"); ?>
<?php $this->view('js/main_js');  ?>