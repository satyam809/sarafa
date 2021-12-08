<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>public/assets/images/site_imges/favicon.png">
    <title>Vruits - Reset Password</title>
    <link href="<?php echo base_url(); ?>public/dist/css/style.min.css" rel="stylesheet">
</head>
<body>
    <div class="main-wrapper">
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url(<?php echo base_url(); ?>public/assets/images/big/auth-bg.jpg) no-repeat center center;">
            <div class="auth-box">
                <div>
                    <div class="logo">
                        <span class="db"><img src="<?php echo base_url(); ?>public/assets/images/logo.png" alt="logo" style="width: 147px;" /></span>
                        <h5 class="font-medium mb-3">Reset Password</h5>
                    </div>
                    <?php if ($this->session->flashdata('admin_notfount') != '') { ?>
                        <center>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Oh snap!</strong> <?php echo $this->session->flashdata('admin_notfount');?></a>.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true" class="la la-close"></span>
                                </button>
                            </div>
                        </center>
                    <?php } ?>
                    <div class="row">
                        <div class="col-12">
                            <form class="sign-in-form" id="formReset_password" method="POST">
                                <div id="msgSubmit_reset"></div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <input type="password" id="new_password" name="new_password" class="form-control" placeholder="New Password" required="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirm Password" required="">
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <div class="col-xs-12 pb-3">
                                        <button class="btn btn-block btn-lg btn-info" type="submit">Reset Password</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url(); ?>public/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>public/dist/js/validator.min.js"></script>
    <script src="<?php echo base_url(); ?>public/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>public/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script>
        $('[data-toggle="tooltip"]').tooltip();
        $(".preloader").fadeOut();
    </script>
    
    <script type="text/javascript">
        var sitepath = '<?php echo base_url(); ?>';
        
        $("#formReset_password").validator().on("submit", function (event) {
            if (event.isDefaultPrevented()) {
                    // alert("1");
                     //formError_Set(this.id);
                     var msg = "Please fill all details";
                     var msgClasses = "h5 text-center text-danger";
                   // submitMSG_forget(false, msg);
                   $("#msgSubmit_reset").removeClass().addClass(msgClasses).text(msg);
               } else {
                  //alert("2");
                  event.preventDefault();
                  reset_password();
              }
          });

        function reset_password() {
            $.ajax({
                type: "POST",
                url: sitepath + "login/reset_password_action",
                data: $("#formReset_password").serialize(),
                success: function (response) {
                    if (response == 1) {
                       $("#formReset_password")[0].reset();
                       var msg =  "Password Changed Successfully !";
                       var msgClasses = "h5 text-center tada animated text-success";
                       $("#msgSubmit_reset").removeClass().addClass(msgClasses).text(msg);
                       setTimeout(function(){
                        window.location.href = sitepath + 'signin';
                    }, 3000);

                   } else {
                    $("#formReset_password")[0].reset();
                    var msg = response;
                    var msgClasses = "h5 text-center text-danger";
                   // submitMSG_forget(false, msg);
                   $("#msgSubmit_reset").removeClass().addClass(msgClasses).text(msg);
               }
           }
       });
    }
</script>
</body>
</html>