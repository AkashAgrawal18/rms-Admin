<?php include("head.php"); ?>
<?php include("header.php"); ?>

<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light order">
                <a class="breadcrumb-item text-dark" href="<?php echo base_url('Welcome') ?>">Home</a>
                <!-- <a class="breadcrumb-item text-dark" href="<?php echo base_url('Shop') ?>">Profile</a> -->
                <span class="breadcrumb-item active">Profile</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<section class="py-5" style="background-image: url('<?php echo base_url() ?>assets/img/pattern.png');">
    <div class="row pr-lg-5">
        <div class="col-md-3">
            <?php include("sidebar.php"); ?>
        </div>
        <div class="col-md-9">

            <div class="container-fluid bg-light">
                <div class="offer-text text-right py-2">
                    <!-- <a href="<?php echo base_url('Profile/edit_profile') ?>" class="btn btn-primary">Edit Profile</a> -->
                </div>
                <?php $profile = $this->db->select('*')->where('m_user_id',$this->session->userdata('m_customer_id'))->where('m_user_type',3)->where('m_user_status',1)->get('master_users_tbl')->result();
                   
                   // print_r($profile);die();
                 ?>
                <div class="card profile-card pb-3">
                    <div class="container">
                        <form class="row py-5" method="post" id="frm-update-profile">
                            <div class="col-md-5 text-center">
                                <input type="hidden" name="pre_m_admin_img" value="<?php echo $profile[0]->m_user_image;  ?>">
                                  <?php 

                               $user_img = base_url('assets/img/user.png');

                                if (!empty($profile[0]->m_user_image)) {

                                   if (file_exists('admin/uploads/user/' .$profile[0]->m_user_image)) {

                                      $user_img = base_url('admin/uploads/user/').$profile[0]->m_user_image;
                                   }
                                }
                            
                              ?>   

                                <img src="<?php echo $user_img ?>" alt="" class="w-50 m-auto d-block" />
                                <!-- <input class="form-control mt-3" type="file" id="formFile"> -->
                                <!-- <button type="button" id="uploadImagebtn" class="btn btn-primary mt-3" style="text-align: center;"> -->
                                    <!-- <span class="d-sm-block">Update Profile Picture</span></button> -->
                                <input type="file" id="uploadImage" class="form-control mt-3" name="m_user_image"> 
                            </div>


                            <div class="col-md-7">
                                <div class="row pt-2">
                                    <div class="col-3 mb-3">
                                        <label for="name">Admin Name</label>
                                    </div>
                                    <div class="col-9 mb-3">
                                        
                                        <input type="hidden" name="m_user_id" value="<?php echo $profile[0]->m_user_id;  ?>">
                                        <input type="text" class="form-control" name="m_user_name"  placeholder="Enter Name" value="<?php echo $profile[0]->m_user_name  ?>" required>
                                    </div>

                                    <div class="col-3 mb-3">
                                        <label for="email">Email</label>
                                    </div>
                                    <div class="col-9 mb-3">
                                        <input type="email" class="form-control" name="m_user_email"  placeholder="Enter Email"  value="<?php echo $profile[0]->m_user_email  ?>" required>
                                    </div>
                                    <!-- <div class="col-3 mb-3">
                                        <label for="pass">Password</label>
                                    </div>
                                    <div class="col-9 mb-3">
                                        <input type="test" class="form-control" id="pass" name="m_user_pass" placeholder="Enter Password" required value="">
                                    </div>--->
                                    <div class="col-3 mb-3">
                                        <label for="Address">Address</label>
                                    </div>
                                    <div class="col-9 mb-3">
                                        <textarea type="text" name="m_user_addess"  class="form-control" placeholder="Address"><?php echo $profile[0]->m_user_address;?></textarea>
                                        <!-- <input type="text" class="form-control" name="m_user_mobile" placeholder=" enter contact number" aria-label="" aria-describedby="" required value="" placeholder="Enter mob"> -->
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
        </div>
    </div>
</section>

<section>

</section>
<?php include("footer.php"); ?>
<?php include("script.php"); ?>
<?php $this->view('js/master_js');  ?>