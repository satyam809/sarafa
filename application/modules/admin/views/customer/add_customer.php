<div id="main-wrapper">
   <div class="page-wrapper">
      <div class="page-breadcrumb">
         <div class="row">
            <div class="col-5 align-self-center">
               <h4 class="page-title">Customer</h4>
               <div class="d-flex align-items-center">
                  <nav aria-label="breadcrumb">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/user">View Customer</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add User</li>
                     </ol>
                  </nav>
               </div>
            </div>
         </div>
      </div>
      <?php echo validation_errors(); ?>
      <?php if ($this->session->flashdata('Invalid') != '') { ?>
         <div class="alert alert-danger hide_msg">
            <p><?php echo $this->session->flashdata('Invalid'); ?></p>
         </div>
      <?php } ?>
      <div class="container-fluid">
         <div class="row">
            <div class="col-12">
               <div class="card card-body">
                  <h3>User Management</h3>
                  <form action="<?php echo base_url() ?>admin/customer/insert_record" method="POST" class="form-horizontal" enctype='multipart/form-data'>
                     <div class="card-body">
                        <div class="form-row">
                           <div class="form-group col-lg-4">
                              <label for="fname" class="text-right control-label col-form-label">Registration As<span class="mandatory">*</span></label>
                              <input type="text" class="form-control" id="regAs" name="regAs" value="Customer" readonly>
                           </div>
                           <div class="form-group col-lg-4">
                              <label for="fname" class="text-right control-label col-form-label">Firstname<span class="mandatory">*</span></label>
                              <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name Here" required="">
                           </div>
                           <div class="form-group col-lg-4">
                              <label for="fname" class="text-right control-label col-form-label">Lastname<span class="mandatory">*</span></label>
                              <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name Here" required="">
                           </div>
                           <div class="form-group col-lg-4">
                              <label for="mobile" class=" text-right control-label col-form-label">Mobile No.<span class="mandatory">*</span></label>
                              <input type="text" class="form-control" id="mobile" name="mobile" onkeypress="return isNumberKey(event);" minlength="10" maxlength="10" placeholder="Mobile No. here" required="">
                           </div>
                           <div class="form-group col-lg-4">
                              <label for="landline" class=" text-right control-label col-form-label">Landline No.</label>
                              <input type="text" class="form-control" id="landline" name="landline" onkeypress="return isNumberKey(event);" minlength="10" maxlength="10" placeholder="Landline No. here">
                           </div>
                           <div class="form-group col-lg-4">
                              <label for="email" class=" text-right control-label col-form-label">Email<span class="mandatory">*</span></label>
                              <input type="email" class="form-control" id="email" name="email" placeholder="Email Here" required="">
                           </div>
                        </div>
                        <div class="form-group col-lg-4">
                           <label for="password" class=" text-right control-label col-form-label">Password<span class="mandatory">*</span></label>
                           <!-- <div class="col-sm-7"> -->
                           <input type="password" class="form-control" id="password" name="password" placeholder="Password Here" required="">
                           <span id="message"></span>
                           <!-- </div> -->
                        </div>
                        <label for="address" class=" text-right control-label col-form-label"> Address Details<span class="mandatory">*</span></label>
                        <div class="form-row">
                           <div class="form-group col-lg-12">
                              <input type="text" class="form-control" id="address" name="address" placeholder="Address">
                           </div>
                        </div>
                        <div class="form-row">
                           <div class="col-lg-3 form-group">
                              <input type="text" class="form-control" id="var_state" name="var_state" placeholder="State">
                           </div>
                           <div class="form-group col-lg-3">
                              <input type="text" class="form-control" id="var_city" name="var_city" placeholder="City">
                           </div>
                        </div>
                     </div>
               </div>
               <div class="card-body">
                  <div class="form-group mb-0 text-center">
                     <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                     <button type="reset" name="cancel" class="btn btn-dark waves-effect waves-light">Cancel</button>
                  </div>
               </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
<script type="text/javascript">
   var site_path = '<?php echo base_url(); ?>';
   $(function() {
      $('button[name=cancel]').click(function() {
         window.location = site_path + 'admin/user';
      });
   });
</script>
<script type="text/javascript">
   $(document).ready(function() {
      var iCnt = 0;
      // CREATE A "DIV" ELEMENT AND DESIGN IT USING jQuery ".css()" CLASS.
      $('#btn_address').click(function() {
         iCnt = iCnt + 1;
         // ADD TEXTBOX.
         var tr = '<div class="con"><div class="form-group row"><div class="col-sm-8"><h5>Address ' + iCnt + '</div><div class="col-sm-4"><div class="remove_add"><a href="javascript:;" class="btnRemove"><img id="img" class="closeicondrag" src="' + site_path + 'public/assets/images/site_imges/x.png" alt="delete"></a></div></div></div><div class="form-group row"><div class="col-sm-4"><input type="text" class="form-control" name="new_var_house_no[]" placeholder="House No." required></div><div class="col-sm-4"><input type="text" class="form-control" name="new_var_app_name[]" placeholder="Apartment Name" required></div>';
         tr += '<div class="col-sm-4"><input type="text" class="form-control" name="new_var_landmark[]" placeholder="Landmark Here"></div></div>';
         tr += '<div class="form-group row"><div class="col-sm-4"><input type="text" class="form-control" name="new_var_country[]" placeholder="Country"></div>';
         tr += '<div class="col-sm-4"><input type="text" class="form-control" name="new_var_state[]" placeholder="State"></div>';
         tr += '<div class="col-sm-4"><input type="text" class="form-control" name="new_var_city[]" placeholder="City"></div></div>';
         tr += '<div class="form-group row"><div class="col-sm-4"><input type="text" class="form-control" name="new_var_pincode[]" placeholder="Pincode"></div>';
         tr += '<label for="type" class="col-sm-1 text-right control-label">Type:</label><div class="col-sm-3"><div class="form-check form-check-inline"><div class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="home' + iCnt + '" value="Home" name="new_address_type[' + iCnt + ']" checked=""><label class="custom-control-label" for="home' + iCnt + '">Home</label></div></div><div class="form-check form-check-inline"><div class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="work' + iCnt + '" value="Work" name="new_address_type[' + iCnt + ']"><label class="custom-control-label" for="work' + iCnt + '">Work</label></div></div><div class="form-check form-check-inline"><div class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="other' + iCnt + '" value="Other" name="new_address_type[' + iCnt + ']"><label class="custom-control-label" for="other' + iCnt + '">Other</label></div></div></div><label for="type" class="col-sm-2 text-left control-label">Set Default:</label><div class="col-sm-2 text-left"><input type="checkbox" class="form-control" name="default_status[]" value="Y"></div></div><hr></div>';

         // ADD BOTH THE DIV ELEMENTS TO THE "main" CONTAINER.
         $('#add_address').append(tr);
      });
      $('body').on('click', '.btnRemove', function() {
         $(this).parent().parent().parent().parent('div.con').remove();
      });
      // REMOVE ONE ELEMENT PER CLICK.
      // $('#btRemove').click(function() {
      //     if (iCnt != 0) { $('#tb' + iCnt).remove(); iCnt = iCnt - 1; }

      //     if (iCnt == 0) { 
      //         $(container)
      //         .empty() 
      //         .remove(); 

      //         $('#btSubmit').remove(); 
      //         $('#btAdd')
      //         .removeAttr('disabled') 
      //         .attr('class', 'bt');
      //     }
      // });
   });

   function onlyOne(checkbox) {
      var checkboxes = document.getElementsByName('default_status[]')
      checkboxes.forEach((item) => {
         if (item !== checkbox) item.checked = false
      })
   }

   function isNumberKey(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57))
         return false;
      return true;
   }

   $('#var_pincode').keyup(function() {
      var pincode = $("#var_pincode").val();

      $.ajax({

         type: "POST",
         url: site_path + "admin/user/get_address",
         data: 'pincode=' + pincode,

         success: function(response) {

            var res = response.split('***');

            $('#var_city').val(res[0]);
            $('#var_state').val(res[1]);
            $('#var_country').val(res[2]);

         }
      });
   });
</script>