<div id="main-wrapper">
   <div class="page-wrapper">
      <div class="page-breadcrumb">
         <div class="row">
            <div class="col-5 align-self-center">
               <h4 class="page-title">Customers</h4>
               <div class="d-flex align-items-center">
                  <nav aria-label="breadcrumb">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/customer">View Customers</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Customer</li>
                     </ol>
                  </nav>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-12">
            <div class="card">
               <form method="POST" action="<?php echo base_url() . 'admin/customer/update_customer/' . $data['int_glcode'];
                                             ?>" class="form-horizontal" enctype='multipart/form-data'>
                  <div class="card-body">
                     <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Registration As<span class="mandatory">*</span></label>
                        <div class="col-sm-7">
                           <input type="text" class="form-control" id="regAs" name="regAs" value="Customer" readonly>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">First Name<span class="mandatory">*</span></label>
                        <div class="col-sm-7">
                           <input type="text" class="form-control" id="fname" name="fname" placeholder="Fist Name Here" value="<?php echo $data['fname']; ?>" required>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">Last Name<span class="mandatory">*</span></label>
                        <div class="col-sm-7">
                           <input type="text" class="form-control" id="lname" name="lname" placeholder="last Name Here" value="<?php echo $data['lname']; ?>" required>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="email" class="col-sm-3 text-right control-label col-form-label">Email<span class="mandatory">*</span></label>
                        <div class="col-sm-7">
                           <input type="email" class="form-control" id="email" name="email" placeholder="Email Here" value="<?php echo $data['var_email']; ?>" required>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="password" class="col-sm-3 text-right control-label col-form-label">Password<span class="mandatory">*</span></label>
                        <div class="col-sm-7">
                           <div class="icon_show">
                              <input type="password" class="form-control" id="var_password" name="var_password" placeholder="Password Here" value="<?php echo $this->mylibrary->decryptPass($data['var_password']); ?>" required="">
                              <a href="javascript:void(0)" class="show_password" onclick="toggle_password()"><i class="mr-2 mdi mdi-eye-outline show_pass"></i></a>
                           </div>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="date" class="col-sm-3 text-right control-label col-form-label">Mobile No.<span class="mandatory">*</span></label>
                        <div class="col-sm-7">
                           <input type="text" class="form-control" id="phone" onkeypress="return isNumberKey(event);" name="phone" value="<?php echo $data['var_mobile_no']; ?>" required>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="date" class="col-sm-3 text-right control-label col-form-label">Landline No.</label>
                        <div class="col-sm-7">
                           <input type="text" class="form-control" id="landline" onkeypress="return isNumberKey(event);" name="landline" value="<?php echo $data['var_alt_mobile']; ?>">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="address" class="col-sm-3 text-right control-label col-form-label">Address<span class="mandatory">*</span></label>
                        <div class="col-sm-7">
                           <input type="text" class="form-control" id="address" name="address" value="<?php echo $data['address']; ?>" required>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="state" class="col-sm-3 text-right control-label col-form-label">State<span class="mandatory">*</span></label>
                        <div class="col-sm-7">
                           <input type="text" class="form-control" id="state" name="state" value="<?php echo $data['var_state']; ?>" required>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="city" class="col-sm-3 text-right control-label col-form-label">City<span class="mandatory">*</span></label>
                        <div class="col-sm-7">
                           <input type="text" class="form-control" id="city" name="city" value="<?php echo $data['var_city']; ?>" required>
                        </div>
                     </div>
                  </div>
                  <div class="card-body">
                     <div class="form-group mb-0 text-center">
                        <button type="submit" name="submit" class="btn btn-info waves-effect waves-light">Save</button>
                        <button type="reset" name="cancel" class="btn btn-dark waves-effect waves-light">Cancel</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   var site_path = '<?php echo base_url(); ?>';

   $(function() {
      $('button[name=cancel]').click(function() {
         window.location = site_path + 'admin/customer';
      });
   });

   function toggle_password() {
      var x = document.getElementById("var_password");
      if (x.type === "password") {
         x.type = "text";
      } else {
         x.type = "password";
      }
   }
</script>
<script type="text/javascript">
   function isNumberKey(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57))
         return false;
      return true;
   }
</script>