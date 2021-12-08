<?php
//////////////////////////////////// check admin login or not ///////////////////////////////////
if ($this->session->userdata('admin_id') == '') {
    redirect(base_url() . 'admin');
}
?>
<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from wrappixel.com/demos/admin-templates/xtreme-admin/html/ltr/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 31 Jan 2019 06:39:50 GMT -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <!--<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>public/assets/images/site_imges/favicon.png">-->
    <title>Admin Panel | Sarafa Mart</title>
    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>public/assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>public/dist/css/style.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/dist/css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/dist/css/lightbox.min.css">
    <script src="<?php echo base_url(); ?>public/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" integrity="sha512-kq3FES+RuuGoBW3a9R2ELYKRywUEQv0wvPTItv3DSGqjpbNtGWVdvT8qwdKkqvPzT93jp8tSF4+oN4IeTEIlQA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="<?php echo base_url(); ?>admin">
                        <!-- Logo icon -->
                        <b class="logo-icon">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <!-- <img src="<?php //echo base_url();
                                            ?>public/assets/images/site_imges/Logo.png" alt="homepage" class="dark-logo">  -->
                            <!-- Light Logo icon -->
                            <!-- <img src="<?php //echo base_url();
                                            ?>public/assets/images/Suncity-logo.png" alt="homepage" class="light-logo"> -->
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text" style="margin-left: 20px;">
                            <!-- dark Logo text -->
                            <label class="dark-logo">
                                <img src="<?php echo base_url(); ?>public/assets/images/logo.png">
                            </label>
                            <!-- Light Logo text -->
                            <label class="light-logo">ADMIN PANEL</label>
                        </span>
                    </a>

                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-left mr-auto">
                        <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                        <li class="nav-item d-none d-md-block"><a class="nav-link">
                                <h4 style="padding-top: 20px;">Sarafa</h4>
                            </a></li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">
                        <!-- ============================================================== -->
                        <span class="wel_admin">Welcome Admin </span>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo base_url(); ?>public/assets/images/users/1.jpg" alt="user" class="rounded-circle" width="31"></a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY" id="dropdown_show">
                                <span class="with-arrow"><span class="bg-primary"></span></span>
                                <div class="d-flex no-block align-items-center p-15 bg-primary text-white mb-2">
                                    <div class=""><img src="<?php echo base_url(); ?>public/assets/images/users/1.jpg" alt="user" class="img-circle" width="60"></div>
                                    <div class="ml-2">
                                        <h4 class="mb-0"><?php echo $_SESSION['adminuser']; ?></h4>
                                        <p class=" mb-0"><?php echo $_SESSION['email']; ?></p>
                                    </div>
                                </div>

                                <div class="dropdown-divider"></div>
                                <a data-toggle="modal" data-target="#changepassword" class="dropdown-item" href="#"><i class="ti-settings mr-1 ml-1"></i> Change Password</a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php echo base_url() . 'admin/logout' ?>"><i class="fa fa-power-off mr-1 ml-1"></i> Logout</a>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>

        <div class="modal fade" id="changepassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="mdi mdi-close"></span>
                        </button>
                    </div>
                    <div class="card-body">

                        <div id="msgSubmit_changep"></div>
                        <form role="form" method="post" id="changepassword" class="f-form" data-toggle="validator">
                            <div class="form-group">
                                <label class="sr-only" for="l-form-username">Old Password</label>
                                <input type="password" name="var_opassword" placeholder="Old Password" class="form-control" id="var_opassword" required>
                            </div>

                            <div class="form-group">
                                <label class="sr-only" for="l-form-username">New Password</label>
                                <input type="password" name="var_npassword" placeholder="New Password" class="form-control" id="var_npassword" required>
                            </div>

                            <div class="form-group">
                                <label class="sr-only" for="l-form-username">Confirm Password</label>
                                <input type="password" name="var_rpassword" placeholder="Confirm Password" class="form-control" id="var_rpassword" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>




        <script src="<?php echo base_url(); ?>public/dist/js/validator.min.js"></script>
        <script type="text/javascript">
            //////////////////////////////// change password ///////////////////////////////////////////
            $("#changepassword").validator().on("submit", function(event) {
                if (event.isDefaultPrevented()) {
                    //alert("1");
                    //formError_Set(this.id);
                    // submitMSG_forget(false, "Please fill all details");
                } else {
                    //alert("2");
                    event.preventDefault();
                    change_password();
                }
            });

            $("#changedistancebtn").click(function() {
                //alert('hello');
                $.ajax({
                    type: "post",
                    url: sitepath + "admin/dashboard/showdistance",
                    success: function(response) {
                        // alert(response);
                        // $('#changedistance').modal('show');
                        $('#var_cdistance').val(response);

                    }
                });

                //$('#changedistance').show("modal");
            });

            $("#changedistance").validator().on("submit", function(event) {
                if (event.isDefaultPrevented()) {
                    //alert("1");
                    //formError_Set(this.id);
                    // submitMSG_forget(false, "Please fill all details");
                } else {
                    //alert("2");
                    event.preventDefault();
                    change_distance();
                }
            });

            // function logout()
            // {
            //     $('#dropdown_show').addClass('show');
            //     // $.ajax({
            //     //     type: "POST",
            //     //     url: sitepath + "admin/logout",
            //     //     success: function (response) 
            //     //     {
            //     //         $('#dropdown').modal('show');
            //     //         var msg =  "Logout Successfully.";
            //     //         var msgClasses = "mr-1 tada animated text-success";
            //     //         $("#log_out").removeClass().addClass(msgClasses).text(msg);
            //     //         setTimeout(function() {
            //     //             $('#dropdown').modal('hide');
            //     //             window.location.href = sitepath+'admin';
            //     //         }, 3000);
            //     //     }
            //     // });
            // }

            function change_password() {
                var opass = $("#var_opassword").val();
                var npass = $("#var_npassword").val();
                var rpass = $("#var_rpassword").val();
                if (npass == '' || rpass == '' || opass == '') {
                    var msg = "Please fill up all details.";

                    var msgClasses = "h5 text-center text-danger";

                    // submitMSG_forget(false, msg);

                    $("#msgSubmit_changep").removeClass().addClass(msgClasses).text(msg);
                    exit;
                }
                if (npass != rpass) {
                    var msg = "new and confirm Password does not match.";

                    var msgClasses = "h5 text-center text-danger";

                    // submitMSG_forget(false, msg);

                    $("#msgSubmit_changep").removeClass().addClass(msgClasses).text(msg);
                    exit;
                }
                $.ajax({
                    type: "POST",
                    url: sitepath + "admin/dashboard/change_password",
                    data: "opassword=" + opass + "&npassword=" + npass + "&rpassword=" + rpass,
                    success: function(response) {
                        if (response == 1) {

                            // $("#changepassword")[0].reset();
                            var msg = "Your Password Changed Successfully.";
                            var msgClasses = "h5 text-center tada animated text-success";
                            $("#msgSubmit_changep").removeClass().addClass(msgClasses).text(msg);
                            window.location.href = '';
                        } else {
                            // $("#changepassword")[0].reset();
                            var msg = response;
                            var msgClasses = "h5 text-center text-danger";
                            // submitMSG_forget(false, msg);
                            $("#msgSubmit_changep").removeClass().addClass(msgClasses).text(msg);
                        }
                    }
                });
            }

            function change_distance() {
                var cdist = $("#var_cdistance").val();
                if (cdist == '') {
                    var msg = "Please fill up all Distance.";

                    var msgClasses = "h5 text-center text-danger";

                    // submitMSG_forget(false, msg);

                    $("#msgSubmit_changed").removeClass().addClass(msgClasses).text(msg);
                    exit;
                }
                if (isNaN(cdist)) {
                    var msg = "Please Add Distance in Number only.";

                    var msgClasses = "h5 text-center text-danger";

                    // submitMSG_forget(false, msg);

                    $("#msgSubmit_changed").removeClass().addClass(msgClasses).text(msg);
                    exit;
                }
                $.ajax({
                    type: "POST",
                    url: sitepath + "admin/dashboard/change_distance",
                    data: "cdistance=" + cdist,
                    success: function(response) {
                        if (response == 1) {

                            // $("#changepassword")[0].reset();
                            var msg = "Distance Changed Successfully.";
                            var msgClasses = "h5 text-center tada animated text-success";
                            $("#msgSubmit_changed").removeClass().addClass(msgClasses).text(msg);
                            window.location.href = '';
                        } else {
                            // $("#changepassword")[0].reset();
                            var msg = response;
                            var msgClasses = "h5 text-center text-danger";
                            // submitMSG_forget(false, msg);
                            $("#msgSubmit_changed").removeClass().addClass(msgClasses).text(msg);
                        }
                    }
                });
            }
        </script>