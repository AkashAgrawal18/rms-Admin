<script type="text/javascript">
    $(document).ready(function(e) {
        //===========================customer ===========================//
    
        // pos customer add
        $(".btn-customer-add").click(function(e) {
            var frmid = $(this).data('frmid');
            var clkbtn = $(this);
            clkbtn.prop('disabled', true);

            var formData = $(frmid).serialize();

            var pagtype = $('#user_type').val();
            var custaddon = $('#custaddon').val();
            var custname = $('#m_cust_name').val();

            if (pagtype == 1) {
                var relink = "<?= base_url('Account/customer') ?>";
            } else if (pagtype == 2) {
                var relink = "<?= base_url('Account/suppiler') ?>";
            }

            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Account/insert_customer'); ?>",
                data: formData,
                // processData: false,
                // contentType: false,
                dataType: "JSON",
                success: function(data) {
                    if (data.status == 'success') {
                        if (custaddon == 1 && pagtype == 1) {
                            $('#m_customer').append(`<option value="` + data.cust_id + `" selected>` + custname + `</option>`);
                            $('#addcustomermodal').modal('hide');
                            swal(data.message, {
                                icon: "success",
                                timer: 1000,
                            });
                        } else {
                            swal(data.message, {
                                icon: "success",
                                timer: 1000,
                            });

                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        }

                    } else {
                        clkbtn.prop('disabled', false);
                        swal(data.message, {
                            icon: "error",
                            timer: 5000,
                        });
                    }
                },
                error: function(jqXHR, status, err) {
                    clkbtn.prop('disabled', false);
                    swal("Some Problem Occurred!! please try again", {
                        icon: "error",
                        timer: 2000,
                    });
                }
            });

        });


        $(document).on("click", ".delete_customer", function() {
            var clkbtn = $(this);
            clkbtn.prop('disabled', true);
            var dlt_id = $(this).data('value');

            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this data!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {

                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('Account/delete_customer'); ?>",
                        data: {
                            delete_id: dlt_id
                        },
                        dataType: "JSON",
                        success: function(data) {
                            if (data.status == 'success') {
                                swal(data.message, {
                                    icon: "success",
                                    timer: 1000,
                                });
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
                            } else {
                                clkbtn.prop('disabled', false);
                                swal(data.message, {
                                    icon: "error",
                                    timer: 5000,
                                });
                            }
                        },
                        error: function(jqXHR, status, err) {
                            clkbtn.prop('disabled', false);
                            swal("Some Problem Occurred!! please try again", {
                                icon: "error",
                                timer: 2000,
                            });
                        }
                    });

                } else {
                    clkbtn.prop('disabled', false);
                    swal("Your Data is safe!", {
                        icon: "info",
                        timer: 2000,
                    });
                }
            });
        });


        //===========================/customer ===========================//

        //===========================appliction setting  ===========================//

        $("form#update_app_form").submit(function(e) {
            e.preventDefault();
            var clkbtn = $("#update_app_btn");
            clkbtn.prop('disabled', true);
            var formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Account/update_application'); ?>",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "JSON",
                success: function(data) {
                    if (data.status == 'success') {
                        swal(data.message, {
                            icon: "success",
                            timer: 1000,
                        });

                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    } else {
                        clkbtn.prop('disabled', false);
                        swal(data.message, {
                            icon: "error",
                            timer: 5000,
                        });
                    }
                },
                error: function(jqXHR, status, err) {
                    clkbtn.prop('disabled', false);
                    swal("Some Problem Occurred!! please try again", {
                        icon: "error",
                        timer: 2000,
                    });
                }
            });

        });



        $("form#update_social_form").submit(function(e) {
            e.preventDefault();
            var clkbtn = $("#update_social_btn");
            clkbtn.prop('disabled', true);
            var formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Account/update_social'); ?>",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "JSON",
                success: function(data) {
                    if (data.status == 'success') {
                        swal(data.message, {
                            icon: "success",
                            timer: 1000,
                        });

                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    } else {
                        clkbtn.prop('disabled', false);
                        swal(data.message, {
                            icon: "error",
                            timer: 5000,
                        });
                    }
                },
                error: function(jqXHR, status, err) {
                    clkbtn.prop('disabled', false);
                    swal("Some Problem Occurred!! please try again", {
                        icon: "error",
                        timer: 2000,
                    });
                }
            });

        });


        $("form#update_logo_form").submit(function(e) {
            e.preventDefault();
            var clkbtn = $("#update_logo_btn");
            clkbtn.prop('disabled', true);
            var formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Account/update_logo'); ?>",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "JSON",
                success: function(data) {
                    if (data.status == 'success') {
                        swal(data.message, {
                            icon: "success",
                            timer: 1000,
                        });

                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    } else {
                        clkbtn.prop('disabled', false);
                        swal(data.message, {
                            icon: "error",
                            timer: 5000,
                        });
                    }
                },
                error: function(jqXHR, status, err) {
                    clkbtn.prop('disabled', false);
                    swal("Some Problem Occurred!! please try again", {
                        icon: "error",
                        timer: 2000,
                    });
                }
            });

        });

        //===========================/appliction setting  ===========================//

        //===========================profile ===========================//

        $("form#frm-update-profile").submit(function(e) {
            e.preventDefault();
            var clkbtn = $("#btn-update-profile");
            clkbtn.prop('disabled', true);

            var adminname = $("#aname").val();
            if (adminname == "") {
                alert("Please Enter Admin Name");
                $("#aname").focus();
                $("#aname").addClass('input-error');

                clkbtn.prop('disabled', false);
                return false;
            }

            var adminemail = $("#aemail").val();
            if (adminemail == "") {
                alert("Please Entervalid Emailid");
                $("#aemail").focus();
                $("#aemail").addClass('input-error');

                clkbtn.prop('disabled', false);
                return false;
            }

            var adminpassword = $("#apass").val();
            if (adminpassword == "") {
                alert("Please Enter Password");
                $("#apass").focus();
                $("#apass").addClass('input-error');

                clkbtn.prop('disabled', false);
                return false;
            }

            var formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Account/update_profile'); ?>",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "JSON",
                success: function(data) {
                    if (data.status == 'success') {
                        swal(data.message, {
                            icon: "success",
                            timer: 1000,
                        });
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    } else {
                        clkbtn.prop('disabled', false);
                        swal(data.message, {
                            icon: "error",
                            timer: 5000,
                        });
                    }
                },
                error: function(jqXHR, status, err) {
                    clkbtn.prop('disabled', false);
                    swal("Some Problem Occurred!! please try again", {
                        icon: "error",
                        timer: 2000,
                    });
                }
            });

        });

        //===========================/profile ===========================//




    });

    $("#uploadImagebtn").click(function() {
        $("#uploadImage").trigger('click');
        return false;
    });

    function PreviewImage() {
        var myadminimg = document.getElementById("myadminimg");
        var myuploadimg = $('#uploadImage').val();
        if (myuploadimg == '') {
            document.getElementById("uploadPreview").src = myadminimg.src;
        }

        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

        oFReader.onload = function(oFREvent) {
            document.getElementById("uploadPreview").src = oFREvent.target.result;
        };
    };
</script>