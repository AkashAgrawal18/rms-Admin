<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<script type="text/javascript">
 $(document).ready(function(e) {


  //===========================customer ===========================//
    $('#cmobile').change(function(){
        let cust_mobile = this.value;
          // console.log(contact_number);die();
        $.post("<?= base_url('User/get_cust_mobile') ?>",{cust_mobile},function(data){

          if (data.status)
           {
           
            // alert('District already exist');
            swal("Mobile already exist!!", { icon: "error", timer: 3000, });
             $('#cmobile').val('');
           }
          
            // $('#contact_number').html(text);
        },'json');
      })

   // pos customer add
   $(".btn-customer-add").click(function(e) {
      var frmid = $(this).data('frmid');
      var clkbtn = $(this);
      clkbtn.prop('disabled', true);
     
      var formData = $(frmid).serialize();

      var pagtype = $('#user_type').val();
      if(pagtype == 3){
        var relink = "<?= base_url('User/customer')?>";
      }else  if(pagtype == 4){
        var relink = "<?= base_url('User/suppiler')?>";
      }

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('User/insert_customer'); ?>",
        data: formData,
        // processData: false,
        // contentType: false,
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

 
   $("#customer_tbl").on("click", ".delete_customer", function() {
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
            url: "<?php echo site_url('User/delete_customer'); ?>",
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

  //===========================supplier ===========================//

  $('#smobile').change(function(){
        let supl_mobile = this.value;
          // console.log(contact_number);die();
        $.post("<?= base_url('User/get_suppl_mobile') ?>",{supl_mobile},function(data){

          if (data.status)
           {
           
            // alert('District already exist');
            swal("Mobile already exist!!", { icon: "error", timer: 3000, });
             $('#smobile').val('');
           }
          
            // $('#contact_number').html(text);
        },'json');
      })


   $("#supplier_tbl").on("click", ".delete_supplier", function() {
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
            url: "<?php echo site_url('User/delete_supplier'); ?>",
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


  
  //===========================/supplier ===========================//
  //===========================category ===========================//
  $("form#cat_add_form").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#cat_add_btn");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Main/insert_categories'); ?>",
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


    $("form#cat_edit_form").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#cat_edit_btn");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Main/insert_categories'); ?>",
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

    $(".delete_cotegory").on("click", function() {
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
            url: "<?php echo site_url('Main/delete_categories'); ?>",
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


    //===========================category ===========================//
    //=========================== Group Master ===========================//

    $("form#form_group_add").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn_group_add");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Main/insert_group'); ?>",
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


    $("form#form_group_edit").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn_group_edit");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Main/insert_group'); ?>",
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

    $(document).on("click", ".group-delete", function() {
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
            url: "<?php echo site_url('Main/delete_group'); ?>",
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


    //=========================== Group Master ===========================//


    //===========================paymentin ===========================//
  $("form#form_paymentin_add").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn_paymentin_add");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('User/insert_payment_in'); ?>",
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


   $("form#form_paymentin_edit").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn_paymentin_edit");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('User/update_payment_in'); ?>",
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

    $("#paymentin_tbl").on("click", ".paymentin-delete", function() {
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
            url: "<?php echo site_url('User/delete_payment_in'); ?>",
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


//===========================payment in ===========================//
 //===========================paymentout ===========================//
  $("form#form_paymentout_add").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn_paymentout_add");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('User/insert_payment_out'); ?>",
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


   $("form#form_paymentout_edit").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn_paymentout_edit");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('User/update_payment_out'); ?>",
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

    $("#paymentout_tbl").on("click", ".paymentout-delete", function() {
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
            url: "<?php echo site_url('User/delete_payment_out'); ?>",
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


//===========================payment out ===========================//   
//===========================coupon ===========================//
  $("form#form_coupon_add").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn_coupon_add");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Main/insert_coupons'); ?>",
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


   $("form#form_coupon_edit").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn_coupon_edit");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Main/update_coupons'); ?>",
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

    $("#coupon_tbl").on("click", ".coupon-delete", function() {
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
            url: "<?php echo site_url('Main/delete_coupons'); ?>",
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


//===========================/coupon ===========================//

//===========================expcategory ===========================//
  $("form#form_expcat_add").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn_expcat_add");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('User/insert_expense_categories'); ?>",
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


   $("form#form_expcat_edit").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn_expcat_edit");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('User/update_expense_categories'); ?>",
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

    $("#expcat_tbl").on("click", ".expcat-delete", function() {
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
            url: "<?php echo site_url('User/delete_expense_categories'); ?>",
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


//===========================/expcat ===========================//

    //===========================expense ===========================//
  $("form#form_expense_add").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn_expense_add");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('User/insert_expense'); ?>",
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


   $("form#form_expense_edit").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn_expense_edit");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('User/update_expense'); ?>",
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

    $("#expense_tbl").on("click", ".expense-delete", function() {
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
            url: "<?php echo site_url('User/delete_expense'); ?>",
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


//===========================/expense ===========================//
    //===========================product ===========================//
    $(".btn_add_product").click(function(e) {
      var frmid = $(this).data('frmid');
      var prodid = $(this).data('prodid');
      
      // alert(frmid)
      var myContent = tinymce.get("m_product_details"+prodid).getContent();
      $('#m_product_details'+prodid).val(myContent);

      var myContent1 = tinymce.get("m_product_information"+prodid).getContent();
      $('#m_product_information'+prodid).val(myContent1);
      var clkbtn = $(this);
      clkbtn.prop('disabled', true);
     
      var formData = $(frmid).serialize();

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Main/insert_product'); ?>",
        data: formData,
        // processData: false,
        // contentType: false,
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



    $("#product_tbl").on("click", ".delete_product", function() {
      var clkbtn = $(this);
      clkbtn.prop('disabled', true);
      var dlt_id = $(this).data('value');

      swal({
        title: "Are you sure?",
        text: "Once deleted,all sales and purchase data of this product will also deleted and you will not be able to recover this data!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {

          $.ajax({
            type: "POST",
            url: "<?php echo site_url('Main/delete_product'); ?>",
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


    //===========================product ===========================//

      //===========================product image ===========================//
  $("form#form_image_add").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn_image_add");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Main/insert_image'); ?>",
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


   $("form#form_image_edit").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn_image_edit");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Main/update_image'); ?>",
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

    $("#image_tbl").on("click", ".image-delete", function() {
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
            url: "<?php echo site_url('Main/delete_image'); ?>",
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


//===========================product imag ===========================//
  


  ///====================== offer ============================================////

    $("form#frm-add-offer").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn-add-offer");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);


      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Main/insert_offer'); ?>",
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


     $("form#frm-edit-offer").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn-edit-offer");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);


      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Main/update_offer'); ?>",
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


    $("#offer_tbl").on("click", ".delete-offer", function() {
      var clkbtn = $(this);
      clkbtn.prop('disabled', true);
      var dlt_id = $(this).data('value');
      // alert(dlt_id);
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
            url: "<?php echo site_url('Main/delete_offer'); ?>",
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

    ///====================== offer ============================================////

     ///====================== banners ============================================////

    $("form#form_slider_add").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#form_slider_add");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);


      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Main/insert_banner'); ?>",
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


     $("form#form_slider_edit").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn_slider_edit");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);


      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Main/update_banner'); ?>",
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


    $("#banner_tbl").on("click", ".delete-banner", function() {
      var clkbtn = $(this);
      clkbtn.prop('disabled', true);
      var dlt_id = $(this).data('value');
      // alert(dlt_id);
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
            url: "<?php echo site_url('Main/delete_banner'); ?>",
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


    $("#banner_tbl1").on("click", ".delete-banner1", function() {
      var clkbtn = $(this);
      clkbtn.prop('disabled', true);
      var dlt_id = $(this).data('value');
      // alert(dlt_id);
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
            url: "<?php echo site_url('Main/delete_banner'); ?>",
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

    ///====================== offer ============================================////
    ///====================== sales ============================================////


     $("form#form-add-sale").submit(function(e) {
      e.preventDefault();


      var clkbtn = $("#btn-add-sale");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);
          // alert('hello');

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('User/insert_sales'); ?>",
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
              window.location = "<?php echo site_url('User/sales'); ?>";
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
    
     $("form#form-edit-sale").submit(function(e) {
      e.preventDefault();


      var clkbtn = $("#btn-edit-sale");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);
          // alert('hello');

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('User/update_sales'); ?>",
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
              window.location = "<?php echo site_url('User/sales'); ?>";
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
   

    $(document).on("click", ".del-sale-product", function() {
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
            url: "<?php echo site_url('User/delete_sale_item'); ?>",
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


     
    $('#sales_tbl').on("click", ".sales-delete", function() {

      // alert('hello');
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
            url: "<?php echo site_url('User/delete_sales'); ?>",
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


    ///====================== sales ============================================////
    
    ///====================== Purchase ============================================////
      $("form#form-add-purchase").submit(function(e) {
      e.preventDefault();


      var clkbtn = $("#btn-add-purchase");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);
          // alert('hello');

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('User/insert_purchase'); ?>",
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
              window.location = "<?php echo site_url('User/purchase'); ?>";
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
    

    $(document).on("click", ".del-purchase-product", function() {
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
            url: "<?php echo site_url('User/delete_purchase_item'); ?>",
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



    $('#purchase_tbl').on("click", ".purchase-delete", function() {

      // alert('hello');
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
            url: "<?php echo site_url('User/delete_purchase'); ?>",
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



 ///====================== Purchase ============================================////
    
///====================== queries ============================================////

 $("#queries_tbl").on("click", ".quert-delete", function() {
      var clkbtn = $(this);
      clkbtn.prop('disabled', true);
      var dlt_id = $(this).data('value');
      // alert(dlt_id);
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
            url: "<?php echo site_url('Query/delete_query'); ?>",
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
  ///====================== /contact us ============================================////

    ///====================== /review ============================================////

    $("#review_tbl").on("click", ".detele-review", function() {
      var clkbtn = $(this);
      clkbtn.prop('disabled', true);
      var dlt_id = $(this).data('value');
      // alert(dlt_id);
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
            url: "<?php echo site_url('Query/delete_review'); ?>",
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


    ///====================== /review ============================================////
    




 //===========================appliction setting  ===========================//
  
  $("form#update_app_form").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#update_app_btn");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Setting/update_application'); ?>",
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
        url: "<?php echo site_url('Setting/update_social'); ?>",
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
        url: "<?php echo site_url('Setting/update_logo'); ?>",
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
  var clkbtn = $("#btn-update-profile"); clkbtn.prop('disabled',true);

  var adminname = $("#aname").val();
  if(adminname==""){ alert("Please Enter Admin Name");
    $("#aname").focus(); $("#aname").addClass('input-error');

    clkbtn.prop('disabled',false); return false;
  }

  var adminemail = $("#aemail").val();
  if(adminemail==""){ alert("Please Entervalid Emailid");
    $("#aemail").focus(); $("#aemail").addClass('input-error');

    clkbtn.prop('disabled',false); return false;
  }

  var adminpassword = $("#apass").val();
  if(adminpassword==""){ alert("Please Enter Password");
    $("#apass").focus(); $("#apass").addClass('input-error');

    clkbtn.prop('disabled',false); return false;
  }

  var formData = new FormData(this);
  $.ajax({
    type: "POST",
    url: "<?php echo site_url('Setting/update_profile'); ?>",
    data: formData,
    processData: false,
    contentType: false,
    dataType: "JSON", 
    success: function(data) {
      if(data.status=='success'){
        swal(data.message, {icon: "success", timer: 1000, });
        setTimeout(function(){ location.reload(); },1000);
      }else{ clkbtn.prop('disabled',false);
        swal(data.message, {icon: "error", timer: 5000, });
      }  
    }, error: function (jqXHR, status, err) { clkbtn.prop('disabled',false);
      swal("Some Problem Occurred!! please try again",{ icon: "error", timer: 2000, });
    }
  });

});

 //===========================/profile ===========================//


   //------------customer------------------\\

   tinymce.init({
      selector: '.editor',
  plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
  imagetools_cors_hosts: ['picsum.photos'],
  menubar: 'file edit view insert format tools table help',
  toolbar: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
  toolbar_sticky: true,
  autosave_ask_before_unload: true,
  autosave_interval: "30s",
  autosave_prefix: "{path}{query}-{id}-",
  autosave_restore_when_empty: false,
  autosave_retention: "2m",
  image_advtab: true,
  content_css: '//www.tiny.cloud/css/codepen.min.css',
  link_list: [
    { title: 'My page 1', value: 'http://www.tinymce.com' },
    { title: 'My page 2', value: 'http://www.moxiecode.com' }
  ],
  image_list: [
    { title: 'My page 1', value: 'http://www.tinymce.com' },
    { title: 'My page 2', value: 'http://www.moxiecode.com' }
  ],
  image_class_list: [
    { title: 'None', value: '' },
    { title: 'Some class', value: 'class-name' }
  ],
  importcss_append: true,
  file_picker_callback: function (callback, value, meta) {
    / Provide file and text for the link dialog /
    if (meta.filetype === 'file') {
      callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
    }

    / Provide image and alt text for the image dialog /
    if (meta.filetype === 'image') {
      callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
    }

    / Provide alternative source and posted for the media dialog /
    if (meta.filetype === 'media') {
      callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
    }
  },
  templates: [
        { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
    { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
    { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
  ],
  template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
  template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
  height: 520,
  image_caption: true,
  quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
  noneditable_noneditable_class: "mceNonEditable",
  toolbar_mode: 'sliding',
  contextmenu: "link image imagetools table",
 });

 //===========================/product tany editor ===========================//


 

   
  });
</script>

<script type="text/javascript">

$("#uploadImagebtn").click(function(){
  $("#uploadImage").trigger('click');
  return false;
});

function PreviewImage(){
  var myadminimg = document.getElementById("myadminimg");
  var myuploadimg = $('#uploadImage').val();
  if(myuploadimg==''){ 
    document.getElementById("uploadPreview").src = myadminimg.src; 
  }

  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

  oFReader.onload = function (oFREvent) {
    document.getElementById("uploadPreview").src = oFREvent.target.result;
  };
};
</script>

<script>
  function changeStatus(feed_id){
    var feed_status = $('#feed_status'+feed_id).val();
    // alert(cand_id);
    //  alert(cand_status);
     if(feed_status==1){
            var tuser = 'New';
        }
        else if(feed_status==2){
            var tuser = ' Reviewed ';
         }
        else{
            var tuser = ' Resolved';
        }

    swal({
    title: "Are you sure?",
    text: tuser,
    icon: "warning",
    buttons: true,
    dangerMode: true,
  }).then((willDelete) => {
    if (willDelete) {

    $.ajax({
          type: "POST",
          url: "<?php echo site_url('Query/update_query_status'); ?>",
          data: {feed_id:feed_id,feed_status:feed_status},
          dataType: "JSON",
          success: function(data) { 
            if(data.status=='success'){
              swal(data.message, {icon: "success", timer: 1000, });
              setTimeout(function(){ location.reload(); },1000);
            }else{ clkbtn.prop('disabled',false);
              swal(data.message, {icon: "error", timer: 5000, });
            }  
          }, error: function (jqXHR, status, err) { clkbtn.prop('disabled',false);
            swal("Some Problem Occurred!! please try again", { icon: "error", timer: 2000, });
          }
        });

     } else { clkbtn.prop('disabled',false);
      swal("Your Data is safe!", { icon: "info", timer: 2000, });
    }
  });

  }
</script>

