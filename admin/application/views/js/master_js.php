<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<script type="text/javascript">
  $(document).ready(function(e) {


    //===========================category ===========================//
    $("form#cat_add_form").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#cat_add_btn");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      var cataddon = $('#cataddon').val();
      var cat_name = $('#cat_name').val();

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Master/insert_categories'); ?>",
        data: formData,
        processData: false,
        contentType: false,
        dataType: "JSON",
        success: function(data) {
          if (data.status == 'success') {
            if (cataddon == 1) {
              $('#m_cat_id').append(`<option value="` + data.cat_id + `" selected>` + cat_name + `</option>`);
              $('#categoriesadd').modal('hide');
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


    $("form#cat_edit_form").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#cat_edit_btn");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Master/insert_categories'); ?>",
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
            url: "<?php echo site_url('Master/delete_categories'); ?>",
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

      var grouptype = $('#grouptype').val();
      var gropaddon = $('#gropaddon').val();
      var group_name = $('#group_name').val();

      if (grouptype == 1) {
        var filedid = "#m_unit";
      } else if (grouptype == 2) {
        var filedid = "#m_colour";
      } else if (grouptype == 3) {
        var filedid = "#m_size";
      } else if (grouptype == 4) {
        var filedid = "#m_taxgst";
      } else if (grouptype == 5) {
        var filedid = "#m_brand";
      } else if (grouptype == 6) {
        var filedid = "#m_paymode";
      }

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Master/insert_group'); ?>",
        data: formData,
        processData: false,
        contentType: false,
        dataType: "JSON",
        success: function(data) {
          if (data.status == 'success') {
            if (gropaddon == 1) {
              $(filedid).append(`<option value="` + data.group_id + `" selected>` + group_name + `</option>`);
              $('#groupadd').modal('hide');
              swal(data.message, {
                icon: "success",
                timer: 1000,
              });
              clkbtn.prop('disabled', false);
              $('#group_name').val("")
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


    $("form#form_group_edit").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn_group_edit");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Master/insert_group'); ?>",
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
            url: "<?php echo site_url('Master/delete_group'); ?>",
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

    //===========================coupon ===========================//

    $(".btn_coupon_add").click(function(e) {
      var frmid = $(this).data('frmid');
      var clkbtn = $(this);
      clkbtn.prop('disabled', true);
      var formData = $(frmid).serialize();


      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Master/insert_coupons'); ?>",
        data: formData,
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
            url: "<?php echo site_url('Master/delete_coupons'); ?>",
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

    //===========================product ===========================//
    $(".btn_add_product").click(function(e) {
      var frmid = $(this).data('frmid');
      var prodid = $(this).data('prodid');

      // alert(frmid)
      var myContent = tinymce.get("m_product_details" + prodid).getContent();
      $('#m_product_details' + prodid).val(myContent);

      var myContent1 = tinymce.get("m_product_information" + prodid).getContent();
      $('#m_product_information' + prodid).val(myContent1);
      var clkbtn = $(this);
      clkbtn.prop('disabled', true);

      var formData = $(frmid).serialize();

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Master/insert_product'); ?>",
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



    $(".delete_product").on("click",function() {
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
            url: "<?php echo site_url('Master/delete_product'); ?>",
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
        url: "<?php echo site_url('Master/insert_image'); ?>",
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
        url: "<?php echo site_url('Master/update_image'); ?>",
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
            url: "<?php echo site_url('Master/delete_image'); ?>",
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

    $(".btn-add-offer").click(function(e) {
      var frmid = $(this).data('frmid');
      var clkbtn = $(this);
      clkbtn.prop('disabled', true);
      var formData = $(frmid).serialize();

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Master/insert_offer'); ?>",
        data: formData,

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
            url: "<?php echo site_url('Master/delete_offer'); ?>",
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

    $(".btn_slider_add").click(function(e) {
      var frmid = $(this).data('frmid');
      var clkbtn = $(this);
      clkbtn.prop('disabled', true);
      var formData = $(frmid).serialize();
   

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Master/insert_banner'); ?>",
        data: formData,
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
            url: "<?php echo site_url('Master/delete_banner'); ?>",
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
            url: "<?php echo site_url('Master/delete_banner'); ?>",
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
      link_list: [{
          title: 'My page 1',
          value: 'http://www.tinymce.com'
        },
        {
          title: 'My page 2',
          value: 'http://www.moxiecode.com'
        }
      ],
      image_list: [{
          title: 'My page 1',
          value: 'http://www.tinymce.com'
        },
        {
          title: 'My page 2',
          value: 'http://www.moxiecode.com'
        }
      ],
      image_class_list: [{
          title: 'None',
          value: ''
        },
        {
          title: 'Some class',
          value: 'class-name'
        }
      ],
      importcss_append: true,
      file_picker_callback: function(callback, value, meta) {
        / Provide file and text for the link dialog /
        if (meta.filetype === 'file') {
          callback('https://www.google.com/logos/google.jpg', {
            text: 'My text'
          });
        }

        / Provide image and alt text for the image dialog /
        if (meta.filetype === 'image') {
          callback('https://www.google.com/logos/google.jpg', {
            alt: 'My alt text'
          });
        }

        / Provide alternative source and posted for the media dialog /
        if (meta.filetype === 'media') {
          callback('movie.mp4', {
            source2: 'alt.ogg',
            poster: 'https://www.google.com/logos/google.jpg'
          });
        }
      },
      templates: [{
          title: 'New Table',
          description: 'creates a new table',
          content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>'
        },
        {
          title: 'Starting my story',
          description: 'A cure for writers block',
          content: 'Once upon a time...'
        },
        {
          title: 'New list with dates',
          description: 'New List with dates',
          content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>'
        }
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