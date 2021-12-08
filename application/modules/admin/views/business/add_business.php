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
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/business">View Business</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Business</li>
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
                  <form action="<?php echo base_url() ?>admin/business/insert_record" method="POST" class="form-horizontal" enctype='multipart/form-data'>
                     <div class="card-body">
                        <div class="form-row">
                           <div class="form-group col-lg-4">
                              <label for="fname" class="text-right control-label col-form-label">Registration As<span class="mandatory">*</span></label>
                              <input type="text" class="form-control" id="regAs" name="regAs" value="Business" readonly>
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
                           <div class="form-group col-lg-4">
                              <label for="password" class=" text-right control-label col-form-label">Password<span class="mandatory">*</span></label>
                              <!-- <div class="col-sm-7"> -->
                              <input type="password" class="form-control" id="password" name="password" placeholder="Password Here" required="">
                              <span id="message"></span>
                              <!-- </div> -->
                           </div>
                           <div class="form-group col-lg-4">
                              <label for="company" class=" text-right control-label col-form-label">Company<span class="mandatory">*</span></label>
                              <input type="text" class="form-control" id="company" name="company" placeholder="Company Here" required="">
                           </div>
                           <div class="form-group col-lg-4">
                              <label for="category" class=" text-right control-label col-form-label">Category<span class="mandatory">*</span></label>
                              <select class="form-control" name="catAs" required>
                                 <option disabled selected>Select Category</option>
                                 <option>Manufacturer</option>
                                 <option>Dealer</option>
                                 <option>Wholesaler</option>
                                 <option>Retailer</option>
                              </select>
                           </div>

                        </div>
                        <label for="address" class=" text-right control-label col-form-label"> Address Details<span class="mandatory">*</span></label>
                        <div class="form-row">
                           <div class="form-group col-lg-12">
                              <input type="text" class="form-control" id="address" name="address" placeholder="Address" required>
                           </div>
                        </div>
                        <div class="form-row">
                           <div class="col-lg-3 form-group">
                              <input type="text" class="form-control" id="var_state" name="var_state" placeholder="State" required>
                           </div>
                           <div class="form-group col-lg-3">
                              <input type="text" class="form-control" id="var_city" name="var_city" placeholder="City" required>
                           </div>
                        </div>
                        <label for="address" class=" text-right control-label col-form-label"> Select Business<span class="mandatory">*</span></label>
                        <div class="form-row">
                           <div class="form-group col-lg-12 checkboxReq" required>
                              <?php foreach ($business as $value) { ?>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="businessCat[]" value="<?php echo $value->int_glcode; ?>" />
                                    <label class="form-check-label"><?php echo $value->var_title; ?></label>
                                 </div>
                              <?php } ?>

                           </div>
                        </div>
                        <div class="form-row">
                           <div class="form-group col-lg-4">
                              <label for="var_image" class=" text-right control-label col-form-label">Profile Image<span class="mandatory">*</span></label>
                              <!-- <div class="col-sm-7"> -->
                              <input type="file" class="form-control" id="var_image" name="var_image" required>
                              <!-- </div> -->
                           </div>
                           <div class="form-group col-lg-4">
                              <label for="c_logo" class=" text-right control-label col-form-label">Company Logo<span class="mandatory">*</span></label>
                              <!-- <div class="col-sm-7"> -->
                              <input type="file" class="form-control" id="c_logo" name="c_logo" required>
                              <!-- </div> -->
                           </div>
                           <div class="form-group col-lg-4">
                              <label for="gistin" class=" text-right control-label col-form-label">GSTIN</label>
                              <!-- <div class="col-sm-7"> -->
                              <input type="text" class="form-control" name="gistin">
                              <!-- </div> -->
                           </div>
                           <div class="form-group col-lg-4">
                              <label for="bisno" class=" text-right control-label col-form-label">BISNO<span class="mandatory">*</span></label>
                              <!-- <div class="col-sm-7"> -->
                              <input type="text" class="form-control" name="bisno" required>
                              <!-- </div> -->
                           </div>
                           <div class="form-group col-lg-4">
                              <label for="message" class=" text-right control-label col-form-label">Message<span class="mandatory">*</span></label>
                              <!-- <div class="col-sm-7"> -->
                              <textarea class="form-control" name="message" rows="4" cols="50" required>
                              </textarea>
                              <!-- </div> -->
                           </div>
                           <div class="form-group col-lg-4">
                              <label for="offers" class=" text-right control-label col-form-label">Offers<span class="mandatory">*</span></label>
                              <!-- <div class="col-sm-7"> -->
                              <textarea class="form-control" name="offers" rows="4" cols="50" required>
                              </textarea>
                              <!-- </div> -->
                           </div>
                           <div class="form-group col-lg-4">
                              <label for="p_desc" class=" text-right control-label col-form-label">Product Description<span class="mandatory">*</span></label>
                              <!-- <div class="col-sm-7"> -->
                              <textarea class="form-control" name="p_desc" rows="4" cols="50" required>
                              </textarea>
                              <!-- </div> -->
                           </div>
                           <div class="form-group col-lg-4">
                              <label for="email" class="col-sm-3 text-right control-label col-form-label">Product Images</label>
                              <div class="col-sm-7">
                                 <a class="btn btn-success" id="addFile"> + Add Image</a><br><br>
                                 <div id="filesContainer" class="connectedSortable"></div>
                              </div>
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
   $('div.checkboxReq.required :checkbox:checked').length > 0;
   var site_path = '<?php echo base_url(); ?>';
   $(function() {
      $('button[name=cancel]').click(function() {
         window.location = site_path + 'admin/business';
      });
   });
</script>
<script>
   $(document).ready(function() {
      var dId1 = 0;

      $('#addFile').click(function() {

         $('#addFile').addClass('disabled');
         dId1++;

         $('#filesContainer').append(
            $('<input type="file" class="hide_img_tag" name="p_images[]" id="1doc_count_' + dId1 + '">')
         );
         if (window.File && window.FileList && window.FileReader) {
            $("#1doc_count_" + dId1).on("change", function(e) {
               var rem_input = "#1doc_count_" + dId1;
               var files = e.target.files,
                  filesLength = files.length;
               for (var i = 0; i < filesLength; i++) {
                  var ext = files[i].name.substr(-4);
                  var f = files[i]
                  var fileReader = new FileReader();
                  fileReader.onload = (function(e) {
                     var file = e.target;
                     $("<span class=\"pip\">" +
                        "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                        "<br/><span class=\"remove\">Remove image</span>" +
                        "</span>").insertAfter("#1doc_count_" + dId1);
                     $("#1doc_count_" + dId1).css("display", "none");
                     $('#addFile').removeClass('disabled');
                     $(".remove").click(function() {
                        $(this).parent(".pip").remove();
                        $(rem_input).remove();
                     });
                  });
                  fileReader.readAsDataURL(f);
               }
            });
            //$("#1doc_count_"+dId1).css("display", "none");
         } else {
            alert("Your browser doesn't support to File API")
         }
      });
   });
</script>