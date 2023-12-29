<?php include("head.php"); ?>
<?php include("header.php"); ?>

<style>
    .offcanvas-end {
        width: 720px !important;
    }

    .pro-link {
        color: #000 !important;
        font-size: 15px !important;
        text-align: start !important;
        margin-bottom: 10px;
        width: 200px !important;
    }

    td,
    th {
        vertical-align: middle !important;
    }

    .small {
        font-size: 11px;
    }

    .nav-pills .nav-link {
        border-radius: none !important;
        background-color: #d4d4d4 !important;
    }

    .nav-pills .nav-link.active {
        background-color: #0d6efd !important;
        color: #fff !important;
    }

    .set-card {
        border: none !important;
        background-color: #f4f4f4;
        box-shadow: rgba(149, 157, 165, 0.2) 0px 2px 8px;
    }

    label {
        margin-bottom: 5px;
        font-size: 15px;
    }
</style>

<!-- ========== Page Content ========== -->
<section class="py-1" style="background: #797979;">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-xl-11 col-lg-10">
                <p class="m-0 text-white small fw-light">
                    <a href="<?php echo base_url('Dashboard'); ?>" class="text-white text-decoration-none ">Dashboard</a> >> Website Setup >> <a href="<?php echo base_url('Setting/front_setting'); ?>" class="text-decoration-none fw-bold"><span class="text-warning"> Front Setting</span></a>
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

<div class="container-fluid bg-white">
    <div class="d-flex align-items-start pt-4">
        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <!-- <button class="nav-link pro-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fa-solid fa-layer-group"></i> Featured Categories</button>
            <button class="nav-link pro-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false"><i class="fa-brands fa-product-hunt"></i> Featured Products</button> -->
            <button class="nav-link pro-link active" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false"><i class="fa-solid fa-star"></i> Application Setting</button>
            <button class="nav-link pro-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false"><i class="fa-solid fa-link"></i> Social Links</button>
            <button class="nav-link pro-link" id="v-pills-banner-tab" data-bs-toggle="pill" data-bs-target="#v-pills-banner" type="button" role="tab" aria-controls="v-pills-banner" aria-selected="false"><i class="fa-solid fa-signs-post"></i> Logo</button>

        </div>
        <div class="tab-content w-100" id="v-pills-tabContent">
            <!-- <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <div class="card p-3 set-card">
                    <h4><i class="fa-solid fa-layer-group"></i> Featured Categories</h4>
                    <hr>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="Name">Featured Categories Title</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter Title">
                        </div>
                        <div class="col-md-6">
                            <label for="Name">Featured Categories Subtitle</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter SubTitle">
                        </div>
                        <div class="col-md-6">
                            <label for="Name">Category</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter Category">
                        </div>
                        <div class="modal-footer me-5">
                            <button type="button" class="btn btn-primary"> <i class="fa-regular fa-pen-to-square"></i> Update</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                <div class="card p-3 set-card">
                    <h2><i class="fa-brands fa-product-hunt"></i> Featured Products</h2>
                    <hr>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="Name">Featured Products Title</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter Title">
                        </div>
                        <div class="col-md-6">
                            <label for="Name">Featured Products Subtitle</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter SubTitle">
                        </div>
                        <div class="col-md-6">
                            <label for="Name">Category</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter Category">
                        </div>
                        <div class="modal-footer me-5">
                            <button type="button" class="btn btn-primary"> <i class="fa-regular fa-pen-to-square"></i> Update</button>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                <div class="card p-3 set-card">
                    <h4><i class="fa-solid fa-link"></i> Social Links</h4>
                    <hr>
                    <form class="row g-3" method="POST" id="update_social_form">
                        <div class="col-md-6">
                            <label for="Name">Instagram</label>
                            <input type="text" class="form-control"  name="instagram" value="<?php echo $app_details[0]->m_app_insta  ?>" placeholder="Please Enter Url">
                        </div>
                        <div class="col-md-6">
                            <label for="Name">Facebook</label>
                            <input type="text" class="form-control"  name="facebook" value="<?php echo $app_details[0]->m_app_fb  ?>"  placeholder="Please Enter Url">
                        </div>
                        <div class="col-md-6">
                            <label for="Name">Twitter</label>
                            <input type="text" class="form-control"  name="twitter" value="<?php echo $app_details[0]->m_app_twitter  ?>" placeholder="Please Enter Url">
                        </div>
                        <div class="col-md-6">
                            <label for="Name">LinkedIn</label>
                            <input type="text" class="form-control"  name="linkedIn" value="<?php echo $app_details[0]->m_app_linkedin  ?>"  placeholder="Please Enter Url">
                        </div>
                        <div class="col-md-6">
                            <label for="Name">Youtube</label>
                            <input type="text" class="form-control" name="youtube"  value="<?php echo $app_details[0]->m_app_youtube  ?>" placeholder="Please Enter Url">
                        </div>
                        <div class="modal-footer me-5">
                            <button type="submit" id="update_social_btn"  class="btn btn-primary"> <i class="fa-regular fa-pen-to-square"></i> Update</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="tab-pane fade show active" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                <div class="card p-3 set-card">
                    <h4><i class="fa-solid fa-star"></i> Application Setting</h4>
                    <hr>
                    <form class="row g-3" method="POST" id="update_app_form">
                        <!-- <div class="col-md-6">
                            <label for="Name">Footer Company Description</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter Description">
                        </div>
                        <div class="col-md-6">
                            <label for="Name">Copyright Text</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter Copyright Text">
                        </div>
                        <div class="col-md-6">
                            <label for="Name">Twitter</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter Url">
                        </div>
                        <hr> -->
                        <!-- <h4>Footer Contact Widget</h4> -->
                        <div class="col-md-6">
                            <label for="Name">Application Name</label>
                            <input type="tel" class="form-control" name="m_app_name" value="<?php echo $app_details[0]->m_app_name  ?>" placeholder="Application Name" >
                        </div>
                        <div class="col-md-6">
                            <label for="Name">Email</label>
                            <input type="text" class="form-control"  name="m_app_email"  value="<?php echo $app_details[0]->m_app_email  ?>" placeholder="Enter Email">
                        </div>
                        <div class="col-md-6">
                            <label for="Name">Contact</label>
                            <input type="text" class="form-control"  name="m_app_contact"  value="<?php echo $app_details[0]->m_app_mobile  ?>" placeholder="Enter Contact" maxlength="10" minlength="10" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" >
                        </div>
                        <div class="col-md-6">
                            <label for="Name">Alternative Contact</label>
                            <input type="text" class="form-control"  name="m_app_al_contact" value="<?php echo $app_details[0]->m_app_alt_mobile  ?>" placeholder="Enter Alternative Contact" maxlength="10" minlength="10" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" >
                        </div>
                        <div class="col-md-12">
                            <label for="Name">Address</label>
                            <textarea class="form-control" name="m_app_address" id="exampleFormControlTextarea1" placeholder="Address" rows="3"><?php echo $app_details[0]->m_app_address  ?></textarea>
                        </div>
                        <div class="modal-footer me-5">
                            <button type="submit" id="update_app_btn" class="btn btn-primary"> <i class="fa-regular fa-pen-to-square"></i> Update</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="tab-pane fade" id="v-pills-banner" role="tabpanel" aria-labelledby="v-pills-banner-tab">
                <div class="card p-3 set-card">
                    <h4> <i class="fa-solid fa-signs-post"></i> Logo</h4>
                    <hr>
                    <form class="row g-3" method="POST" id="update_logo_form">
                        <div class="col-md-3"  style="border: 2px solid #f1f2f4;height: 210px;">
                                <div class="form-group">

                                    <?php
                                        if(!empty($app_details[0]->m_app_logo) && file_exists('uploads/logo/'.$app_details[0]->m_app_logo))
                                        {   
                                          $applogo = base_url('uploads/logo/'.$app_details[0]->m_app_logo);
                                        }else{
                                          $applogo = base_url('assets/imgs/fashion.png');
                                        }
                                      ?>
                                    <img src="<?php echo $applogo;?>" alt="kurtis" class="img-responsive img-thumbnail" style="max-height:120px"><br>
                                    <label class="control-label mt-3">Color Logo</label>
                                 <input type="hidden" name="applogo" value="<?php echo $app_details[0]->m_app_logo ?>">
                                    <input type="file" name="m_app_logo" class="form-control">
                                </div>
                            </div>


                            <div class="col-md-3"  style="border: 2px solid #f1f2f4;height: 210px;">
                                <div class="form-group">
                                    <?php
                                      if(!empty($app_details[0]->m_app_icon) && file_exists('uploads/logo/'.$app_details[0]->m_app_icon))
                                      {
                                        $appfavi = base_url('uploads/logo/'.$app_details[0]->m_app_icon);}else{
                                        $appfavi = base_url('assets/imgs/fashion.png');
                                      }
                                     ?>
                                    <img src="<?php echo $appfavi;?>" alt="kurtis" class="img-responsive img-thumbnail" style="max-height:120px"><br>
                                    <label class="control-label mt-3">Favicon Logo</label>
                                     <input type="hidden" name="appfavicon" value="<?php echo $app_details[0]->m_app_icon ?>">
                                    <input type="file" name="m_app_icon" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3"  style="border: 2px solid #f1f2f4;height: 210px;">
                                <div class="form-group">
                                     <?php
                                       if(!empty($app_details[0]->m_app_black_logo) && file_exists('uploads/logo/'.$app_details[0]->m_app_black_logo))
                                       {
                                         $appblack_logo = base_url('uploads/logo/'.$app_details[0]->m_app_black_logo);
                                       }else{
                                           $appblack_logo = base_url('assets/imgs/fashion.png');
                                         }
                                        ?>
                                    <img src="<?php echo $appblack_logo;?>" alt="kurtis" class="img-responsive img-thumbnail" style="max-height:120px"><br>
                                    <label class="control-label mt-3">Black Logo</label>
                                     <input type="hidden" name="app_black_logo" value="<?php echo $app_details[0]->m_app_black_logo ?>">
                                    <input type="file" name="m_app_black_logo" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3"  style="border: 2px solid #f1f2f4;height: 210px;">
                                <div class="form-group">
                                    <?php
                                       if(!empty($app_details[0]->m_app_white_logo) && file_exists('uploads/logo/'.$app_details[0]->m_app_white_logo))
                                       {
                                         $appwhite_logo = base_url('uploads/logo/'.$app_details[0]->m_app_white_logo);
                                       }else{
                                           $appwhite_logo = base_url('assets/imgs/fashion.png');
                                         }
                                        ?>
                                    <img src="<?php echo $appwhite_logo;?>" alt="kurtis" class="img-responsive img-thumbnail" style="max-height:120px"><br>
                                    <label class="control-label mt-3">White Logo</label>
                                     <input type="hidden" name="app_white_logo" value="<?php echo $app_details[0]->m_app_white_logo ?>">
                                    <input type="file" name="m_app_white_logo" class="form-control">
                                </div>
                            </div>
                        
                        <div class="modal-footer me-5">
                            <button type="submit" id="update_logo_btn" class="btn btn-primary"> <i class="fa-regular fa-pen-to-square"></i> Update Setting</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- ========== Page Content ========== -->
<?php include("footer.php"); ?>
<?php  $this->view('js/main_js');  ?>