<?php include("head.php"); ?>
<?php include("header.php"); ?>

<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light order">
                <a class="breadcrumb-item text-dark" href="<?php echo base_url('Welcome') ?>">Home</a>
                <a class="breadcrumb-item text-dark" href="<?php echo base_url('Shop') ?>">Profile</a>
                <span class="breadcrumb-item active">Edit Profile</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<section class="pt-3" style="background-image: url('<?php echo base_url() ?>assets/img/pattern.png');">
    <div class="row pr-lg-5">
        <div class="col-md-3">
            <?php include("sidebar.php"); ?>
        </div>
        <div class="col-md-9">

        </div>
    </div>
</section>

<?php include("footer.php"); ?>
<?php include("script.php"); ?>