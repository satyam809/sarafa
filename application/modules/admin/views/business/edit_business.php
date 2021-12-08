<div id="main-wrapper">
   <div class="page-wrapper">
      <div class="page-breadcrumb">
         <div class="row">
            <div class="col-5 align-self-center">
               <h4 class="page-title">Business</h4>
               <div class="d-flex align-items-center">
                  <nav aria-label="breadcrumb">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/business">View Business</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Business</li>
                     </ol>
                  </nav>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-12">
            <div class="card">
               <form method="POST" action="<?php echo base_url() . 'admin/business/update_business/' . $data['int_glcode'];
                                             ?>" class="form-horizontal" enctype='multipart/form-data'>
                  <div class="card-body">
                     <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Registration As<span class="mandatory">*</span></label>
                        <div class="col-sm-7">
                           <input type="text" class="form-control" id="regAs" name="regAs" value="<?php echo $data['regAs']; ?>" readonly>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">First Name<span class="mandatory">*</span></label>
                        <div class="col-sm-7">
                           <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name Here" value="<?php echo $data['fname']; ?>" required>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">Last Name<span class="mandatory">*</span></label>
                        <div class="col-sm-7">
                           <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name Here" value="<?php echo $data['lname']; ?>" required>
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
                        <label for="company" class="col-sm-3 text-right control-label col-form-label">Company<span class="mandatory">*</span></label>
                        <div class="col-sm-7">
                           <input type="text" class="form-control" id="company" name="company" value="<?php echo $data['company']; ?>" required>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="category" class="col-sm-3 text-right control-label col-form-label">Category<span class="mandatory">*</span></label>
                        <div class="col-sm-7">
                           <select class="form-control" name="catAs" required>
                              <option <?php if ($data['catAs'] == "Manufacturer") echo 'selected="selected"'; ?>>Manufacturer</option>
                              <option <?php if ($data['catAs'] == "Dealer") echo 'selected="selected"'; ?>>Dealer</option>
                              <option <?php if ($data['catAs'] == "Wholesaler") echo 'selected="selected"'; ?>>Wholesaler</option>
                              <option <?php if ($data['catAs'] == "Retailer") echo 'selected="selected"'; ?>>Retailer</option>
                           </select>
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
                     <div class="form-group row">
                        <label for="city" class="col-sm-3 text-right control-label col-form-label">Select Business<span class="mandatory">*</span></label>
                        <div class="col-sm-7 checkboxReq" required>
                           <?php
                           $cat = explode(",", $data['businessCat']);
                           ?>
                           <?php foreach ($business as $value) { ?>
                              <div class="form-check form-check-inline">
                                 <input class="form-check-input" type="checkbox" name="businessCat[]" <?php if (in_array($value->int_glcode, $cat)) echo 'checked'; ?> value="<?php echo $value->int_glcode; ?>" />
                                 <label class="form-check-label"><?php echo $value->var_title; ?></label>
                              </div>
                           <?php } ?>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="var_image" class="col-sm-3 text-right control-label col-form-label">Profile Image <span class="mandatory">*</span></label>
                        <?php
                        if ($data['var_image'] != '') {
                           $Image = base_url() . 'uploads/user/' . $data['var_image'];
                        } else {
                           $Image = base_url() . 'public/assets/images/site_imges/no_image.png';
                        }
                        ?>
                        <div class="col-sm-7">
                           <input type="file" class="form-control" id="var_image" name="var_image">
                        </div>
                        <a class="example-image-link" href="<?php echo $Image; ?>" data-lightbox="example-set" data-title="Click anywhere outside the image or the X to the right to close."><img class="example-image" src="<?php echo $Image; ?>" id="cate_ig" alt="<?php echo $Image; ?>" /></a>
                        <input type="hidden" name="hidvar_image" value="<?php echo $data['var_image']; ?>">
                     </div>
                     <div class="form-group row">
                        <label for="var_image" class="col-sm-3 text-right control-label col-form-label">Company Logo <span class="mandatory">*</span></label>
                        <?php
                        if ($data['c_logo'] != '') {
                           $Image = base_url() . 'uploads/user/' . $data['c_logo'];
                        } else {
                           $Image = base_url() . 'public/assets/images/site_imges/no_image.png';
                        }
                        ?>
                        <div class="col-sm-7">
                           <input type="file" class="form-control" id="c_logo" name="c_logo">
                        </div>
                        <a class="example-image-link" href="<?php echo $Image; ?>" data-lightbox="example-set" data-title="Click anywhere outside the image or the X to the right to close."><img class="example-image" src="<?php echo $Image; ?>" id="cate_ig" alt="<?php echo $Image; ?>" /></a>
                        <input type="hidden" name="hidc_logo" value="<?php echo $data['c_logo']; ?>">
                     </div>

                     <div class="form-group row">
                        <label for="gistin" class="col-sm-3 text-right control-label col-form-label">GSTIN</label>
                        <div class="col-sm-7">
                           <input type="text" class="form-control" id="gistin" name="gistin" value="<?php echo $data['gistin']; ?>">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="bisno" class="col-sm-3 text-right control-label col-form-label">BISNO<span class="mandatory">*</span></label>
                        <div class="col-sm-7">
                           <input type="text" class="form-control" id="bisno" name="bisno" value="<?php echo $data['bisno']; ?>" required>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="message" class="col-sm-3 text-right control-label col-form-label">Message<span class="mandatory">*</span></label>
                        <div class="col-sm-7">
                           <textarea class="form-control" id="message" name="message" rows="4" cols="50" required><?php echo $data['message']; ?></textarea>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="offers" class="col-sm-3 text-right control-label col-form-label">Offers<span class="mandatory">*</span></label>
                        <div class="col-sm-7">
                           <textarea class="form-control" id="offers" name="offers" rows="4" cols="50" required><?php echo $data['offers']; ?></textarea>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="offers" class="col-sm-3 text-right control-label col-form-label">Product Description<span class="mandatory">*</span></label>
                        <div class="col-sm-7">
                           <textarea class="form-control" id="p_desc" name="p_desc" rows="4" cols="50" required><?php echo $data['p_desc']; ?></textarea>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="var_image" class="col-sm-3 text-right control-label col-form-label">Product Images<span class="mandatory">*</span></label>
                        <div class="col-sm-7">

                           <?php if (!empty($data['p_images'])) {
                              //echo $data['p_images'];
                              $productImages = explode(",", $data['p_images'], -1);
                              //echo $mul_images[0]['p_images'];
                              //print_r($productImages);
                              foreach ($productImages as $val) {

                                 $Image =
                                    base_url() .
                                    "uploads/userProduct/" .
                                    $val;

                                 $show_rimg =
                                    '<a class="example-image-link banner_aimg upload_doc_img" href="' .
                                    $Image .
                                    '" data-lightbox="example-set" data-title="Click anywhere outside the image or the X to the right to close."><img class="example-image" src="' .
                                    $Image .
                                    '" id="cate_ig" alt="' .
                                    $Image .
                                    '"/></a>';
                           ?>

                                 <div class="mb-30 abcd" data-src="" id="remove_image">
                                    <div class="frame">
                                       <a class="delet_button" id="btn_delete" data-eid="<?php echo $data['int_glcode']; ?>" data-image="<?php echo $val; ?>"><img id="img" class="closeicondrag" src="<?php echo base_url(); ?>public/assets/images/site_imges/x.png" alt="delete" />
                                       </a>
                                       <?php echo $show_rimg; ?>

                                    </div>
                                 </div>

                           <?php
                              }
                           } ?>
                           <input type="hidden" name="hidp_images" value="<?php echo $data['p_images']; ?>">
                           <a class="btn btn-success" id="addFile"> + Add Image</a><br><br>
                           <div id="filesContainer" class="connectedSortable"></div>

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
                        "<br/><span class=\"remove\">Remove image</span></span>").insertAfter("#1doc_count_" + dId1);
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
<script type="text/javascript">
   var site_path = '<?php echo base_url(); ?>';
   $(function() {
      $('button[name=cancel]').click(function() {
         window.location = site_path + 'admin/business';
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
   $(document).on("click", "#btn_delete", function(e) {
      //console.log("test");
      e.preventDefault();
      if (confirm("Do you really want to delete this")) {
         var id = $(this).data("eid");
         //alert(id);
         var image = $(this).data("image");
         //alert(image);
         $.ajax({
            url: site_path + "admin/business/deleteProductImges",
            type: "POST",

            data: {
               id: id,
               image: image
            },
            success: function(data) {
               //alert(data);
               //console.log('#remove_image' + image);
               if (data == 1) {
                  //alert("hii");
                  $("#remove_image").remove();
               }

            }
         });
      }
   });
</script>