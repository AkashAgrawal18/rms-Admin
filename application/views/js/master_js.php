<script type="text/javascript">
 $(document).ready(function() {
    
    //============================category============================//
  

   $('#mobile').change(function(){
        let cust_mobile = this.value;
          // console.log(contact_number);die();
        $.post("<?= base_url('Register/get_mobile') ?>",{cust_mobile},function(data){

          if (data.status)
           {
           
            // alert('District already exist');
            swal("Mobile already exist!!", { icon: "error", timer: 3000, });
             $('#mobile').val('');
           }
          
            // $('#contact_number').html(text);
        },'json');
      })

     $('#email').change(function(){
        let cust_email = this.value;
          // console.log(contact_number);die();
        $.post("<?= base_url('Register/get_email') ?>",{cust_email},function(data){

          if (data.status)
           {
           
            // alert('District already exist');
            swal("Email already exist!!", { icon: "error", timer: 3000, });
             $('#email').val('');
           }
          
            // $('#contact_number').html(text);
        },'json');
      })






$("form#rst_form").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn_rst");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Register/insert_user'); ?>",
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
              window.location = "<?php echo site_url('Register'); ?>";
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


   $("form#frm-update-profile").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn-update-profile");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Profile/update_profile'); ?>",
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
              window.location = "<?php echo site_url('Profile'); ?>";
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


    $("form#update_profile").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn_update");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Checkout/update_profile'); ?>",
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
 

   //----------------------wishlist -----------------------\\
   

    $(document).on("click", ".wishlist-delete", function() {
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
            url: "<?php echo site_url('Wishlist/delete_wishlist'); ?>",
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

   //----------------------wishlist -----------------------\\
   //----------------------contact -----------------------\\
     $("form#form_contact_add").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn_contact_add");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Contact/insert_contact'); ?>",
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

   //----------------------contact -----------------------\\
///====================== review ============================================////

   $("form#form_review_add").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn_review_add");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);


      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Product/review_add'); ?>",
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

    ///====================== review ============================================////

   ///====================== forgot pass ============================================////
   
    $('#fmobile').change(function(){
        let cust_mobile = this.value;
          // console.log(contact_number);die();
        $.post("<?= base_url('Forgot/get_mobile') ?>",{cust_mobile},function(data){

          if (data.status=='success')
           {
           
            // alert('District already exist');
            swal("Not Register Phone Number!!", { icon: "error", timer: 3000, });
             $('#fmobile').val('');
           }else{
              
           }
          
            // $('#contact_number').html(text);
        },'json');
      })



   $("form#forgot_pass_form").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#forgot_pass_btn");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);


      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Forgot/forgot_pass'); ?>",
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
               window.location = "<?php echo site_url('Register'); ?>";
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

    ///====================== forgot pass ============================================////

    ///======================order ============================================////
    $("form#form_order_add").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn_order_add");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Checkout/order_insert'); ?>",
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
              window.location = "<?php echo site_url('Success'); ?>";
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
    ///======================order ============================================////
   
   
 });
</script>
<script>
    function setWish(uid, prod_id) {
        var wish_id = $('#wish_id' + prod_id).val();
        if (uid == '' || uid == 0) {
            swal('Please Login', { icon: "error", timer: 3000 });
        } else {
            $.ajax({
                type: "post",
                url: '<?php echo base_url("Wishlist/insert_wish_list");?>',
                dataType: 'json',
                data: {
                    uid: uid,
                    prod_id: prod_id,
                    wish_id: wish_id
                },
                success: function (data){
                  if (data.status == 'success') {
                          swal(data.message, {
                            icon: "success",
                            timer: 1000,
                          });

                        if (wish_id == 0) {
                            $('#wish_col' + prod_id).css('background-color', '#eb0029');
                            $('#wish_id' + prod_id).val(1);
                        } else {
                            $('#wish_col' + prod_id).css('background-color', '#FDE5E9');
                            $('#wish_id' + prod_id).val(0);
                        }
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
        }
    }
</script>


    

