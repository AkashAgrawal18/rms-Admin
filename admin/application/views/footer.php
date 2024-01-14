<footer class="mt-2">
    <!-- <div class="text-end w-100 px-3 pb-2">

        <?php

        $img_title = get_settings('m_app_black_logo');

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
        <img src="<?php echo $fav_img; ?>" alt="" style="height: 30px;">
    </div> -->
    <div class="container-fluid py-1 bg-dark text-light w-100 border-top border-primary border-4">
        <div class="row justify-content-between g-2">
            <div class="col-xl-4 col-lg-5">
                <p class="m-0 small">
                    &copy;<?php echo date("Y"); ?> <?php echo get_settings('m_app_name'); ?> | Design & Developed by <a href="https://www.logixhunt.com" class="text-decoration-none text-warning opacity-05">Logixhunt</a>
                </p>
            </div>
            <div class="col-xl-5 col-lg-4">
                <marquee class="small">
                    Fashion Lane, a term that resonates with style enthusiasts and trend seekers alike, embodies the dynamic intersection of
                    creativity, culture, and commerce within the realm of fashion. This metaphorical lane serves as a metaphorical runway
                    where clothing transcends mere utility, transforming into a canvas for expression and a mirror reflecting societal shifts.
                </marquee>
            </div>
            <div class="col-xl-3 col-lg-3">
                <p class="m-0 small text-light text-end">
                    support period expired in : <span class="text-warning">22 Days</span>
                </p>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" integrity="sha512-uKQ39gEGiyUJl4AI6L+ekBdGKpGw4xJ55+xyJG7YFlJokPNYegn9KwQ3P8A7aFQAUtUsAQHep+d/lrGqrbPIDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="<?php echo base_url();  ?>assets/js/buttons.js"></script>
<script type="text/javascript" src="<?php echo base_url();  ?>assets/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();  ?>assets/js/sweetalert.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">

</body>

</html>
