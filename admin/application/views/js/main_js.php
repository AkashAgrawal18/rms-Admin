<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<script type="text/javascript">
  $(document).ready(function(e) {

    //===========================paymentin ===========================//

    $('.myeditpayModal').on('click', function(e) {
      var count = $(this).data('value');
      var actype = $("#m_pay_acctype" + count).val();
      var vaue = $("#m_accname" + count).val();

      get_accounts_by_type("#m_pay_account" + count, actype, vaue);
    });

    $('#m_pay_acctype').on('change', function(e) {
      var actype = $(this).val();
      get_accounts_by_type("#m_pay_account", actype);
    });


    $(".btn_pay_add").click(function(e) {
      var frmid = $(this).data('frmid');
    
      var clkbtn = $(this);
      clkbtn.prop('disabled', true);
      var formData = $(frmid).serialize();

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Main/insert_payment'); ?>",
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

    $(document).on("click", ".pay-delete", function() {
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
            url: "<?php echo site_url('Main/delete_payment'); ?>",
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
    ///====================== sales ============================================////

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
            url: "<?php echo site_url('Main/delete_sale_item'); ?>",
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



    $(".sales-delete").on("click", function() {

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
            url: "<?php echo site_url('Main/delete_sales'); ?>",
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
        url: "<?php echo site_url('Main/insert_purchase'); ?>",
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
              window.location = "<?php echo site_url('Main/purchase'); ?>";
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
            url: "<?php echo site_url('Main/delete_purchase_item'); ?>",
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



    $(document).on("click", ".purchase-delete", function() {

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
            url: "<?php echo site_url('Main/delete_purchase'); ?>",
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


  });
</script>

<script>
  function changeStatus(feed_id) {
    var feed_status = $('#feed_status' + feed_id).val();
    // alert(cand_id);
    //  alert(cand_status);
    if (feed_status == 1) {
      var tuser = 'New';
    } else if (feed_status == 2) {
      var tuser = ' Reviewed ';
    } else {
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
          data: {
            feed_id: feed_id,
            feed_status: feed_status
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

  }

  function get_accounts_by_type(filed, actype, vaue = '') {

    $.post("<?= base_url('Main/get_accounts_by_type') ?>", {
        actype
      },
      function(data) {
        if (data != "") {
          $(filed).empty();
          result = '';

          $.each(data, function(i, item) {

            if (vaue == item.m_acc_id) {
              var op = "selected";
            } else {
              var op = "";

            }

            result +=
              '<option value="' +
              item.m_acc_id +
              '" ' + op + '>' +
              item.m_acc_name +
              "</option>";
          });

          $(filed).append(result);
        } else {
          $(filed).html("");
        }
      },
      "json"
    );
  }
</script>