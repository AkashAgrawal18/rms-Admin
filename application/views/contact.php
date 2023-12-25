<?php include("head.php"); ?>
<?php include("header.php"); ?>


<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="<?php echo base_url('Welcome');  ?>">Home</a>
                <span class="breadcrumb-item active">Contact</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->


<!-- Contact Start -->
<section style="background-image: url('assets/img/pattern.png');">
    <div class="container-fluid">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Contact Us</span></h2>
        <div class="row px-xl-5">
            <div class="col-lg-7 mb-5">
                <div class="contact-form bg-light p-30">
                  
                    <form method="Post" id="form_contact_add" >
                        <h5>GET IN TOUCH</h5>
                        <p class="text-dark">Feel Free To Contact Us Anytime, We Will Get Back To You As Soon As We Can..!</p>
                        <div class="row">
                            <div class="control-group col-md-6">
                                <input type="text" class="form-control" name="name" placeholder="Enter Your Name" required=""  />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group col-md-6">
                                <input type="email" class="form-control" name="email"  placeholder="Enter Your Email" required=""  />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group col-md-6">
                                <input type="text" class="form-control" name="mobile" placeholder="Enter Your Contact No." maxlength="10" minlength="10" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" required="required"  />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group col-md-6">
                                <input type="text" class="form-control"  name="subject" placeholder="Enter Your Subject" required=""  />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group col-md-12">
                                <textarea class="form-control" rows="8" name="message"  placeholder="Enter Your Message" required="" ></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                            <div>
                                <button class="btn btn-primary py-2 px-4" type="submit" id="btn_contact_add">Send
                                    Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5 mb-5">
               
                <div class="bg-light p-30 mb-3">
                    <p class="mb-2 text-dark"><i class="fas fa-map-marker-alt text-primary mr-3"></i><?php echo get_settings('m_app_address')  ?></p>
                    <p class="mb-2 text-dark"><i class="fa fa-envelope text-primary mr-3"></i><?php echo get_settings('m_app_email')  ?></p>
                    <p class="mb-2 text-dark"><i class="fas fa-phone-alt text-primary mr-3"></i>+91<?php echo get_settings('m_app_mobile')  ?></p>
                </div>
                <div class="bg-light p-30 mb-30">
                    <iframe style="width: 100%; height: 250px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3001156.4288297426!2d-78.01371936852176!3d42.72876761954724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ccc4bf0f123a5a9%3A0xddcfc6c1de189567!2sNew%20York%2C%20USA!5e0!3m2!1sen!2sbd!4v1603794290143!5m2!1sen!2sbd" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact End -->


<?php include("footer.php"); ?>
<?php include("script.php"); ?>
<?php $this->view('js/master_js'); ?>