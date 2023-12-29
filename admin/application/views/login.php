<?php include("head.php"); ?>

<body>
    <header class="py-3 fixed-top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-1">
                    <?php

                    $img_title = get_settings('m_app_white_logo');

                    if (!empty($img_title)) {

                        if (file_exists('uploads/logo/' . $img_title)) {

                            $fav_img = base_url('uploads/logo/') . $img_title;
                        } else {

                            $fav_img  = base_url('assets/imgs/Logo22.png');
                        }
                    } else {

                        $fav_img  = base_url('assets/imgs/Logo22.png');
                    }

                    ?>
                    <img src="<?php echo $fav_img; ?>" alt="" style="width:200px">
                </div>
            </div>
        </div>
    </header>
    <section class="main-wrapper d-flex align-items-center" style="min-height: 100vh; padding: 10vh 5vw; background:url('<?php echo base_url(); ?>assets/imgs/login.jpg');background-size:cover; background-position:center">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                </div>
                <div class="col-lg-4">
                    <div class="card p-3 rounded-4">
                        <h4 class="m-0 mb-1 fw-bold text-center mt-3">Admin Login</h4>
                        <!--  <p class="m-0 text-secondary">
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                        </p> -->
                        <form action="<?php echo base_url('Login'); ?>" method="POST" class="mt-4">
                            <label for="">User Name</label>

                            <input type="email" class="form-control" id="login_email" name="login_email" placeholder="Enter your username" required="true" value="<?php echo set_value('login_email'); ?>" autofocus />
                            <span class="text-danger"><?php echo form_error('login_email'); ?> </span>
                            <label for="" class="mt-3">Password</label>
                            <div class="input-group input-group-merge">
                                <!-- <input type="password" class="form-control"> -->
                                <input type="password" id="login_pass" required="true" value="<?php echo set_value('login_pass'); ?>" class="form-control" name="login_pass" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"><?php echo form_error('login_pass'); ?></i></span>
                                <!-- <button class="btn btn-light border" style="width: 40px;"><i
                                        class="bi bi-eye" ></i></button> -->
                            </div>

                            <input type="submit" class="btn btn-warning w-100 btn-lg mt-4 fw-bold" id="btn-login" value="Login">
                            <?php if ($this->session->flashdata('status')) echo $this->session->flashdata('status'); ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="fixed-bottom">
        <!-- <div class="text-end w-100 px-3 pb-2">
            <img src="<?php echo $fav_img; ?>" alt="" style="height: 30px;">
        </div> -->
        <div class="container-fluid py-1 bg-dark text-light w-100 border-top border-primary border-4">
            <div class="row justify-content-between g-2">
                <div class="col-12">
                    <p class="m-0 small text-center">
                        &copy;<?php echo date('Y'); ?> <?php echo get_settings('m_app_name'); ?> | Design & Developed by <a href="https://logixhunt.com/" class="footer-link">Logixhunt</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>