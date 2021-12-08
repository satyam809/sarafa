<div id="main-wrapper">
    <div class="page-wrapper">
       <div class="page-breadcrumb">
          <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Category Management</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/category">View Category</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form method="POST" action="<?php echo base_url().'admin/category/update_category/'.$data['int_glcode']; ?>" class="form-horizontal" enctype='multipart/form-data'>
                    <div class="card-body">
                      
                        <div class="form-group row">
                            <label for="var_title" class="col-sm-3 text-right control-label col-form-label">Category</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="var_title" name="var_title" value="<?php echo $data['var_title']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="var_image" class="col-sm-3 text-right control-label col-form-label">Category Icon</label>
                                  <?php
                            if ($data['var_icon'] != '') {
                                $Image = base_url().'uploads/category/'.$data['var_icon'];
                            } else{
                                $Image = base_url().'public/assets/images/site_imges/no_image.png';
                            }
                            ?>
                            <div class="col-sm-7">
                                <input type="file" class="form-control" id="var_image" name="var_image">
                            </div>
                            <a class="example-image-link" href="<?php echo $Image; ?>" data-lightbox="example-set" data-title="Click anywhere outside the image or the X to the right to close."><img class="example-image" src="<?php echo $Image; ?>" id="cate_ig" alt="<?php echo $Image; ?>" /></a>
                            <input type="hidden" name="hidvar_image" value="<?php echo $data['var_icon']; ?>">
                        </div>
                  </div>
                <hr>
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
    
$(function(){
    $('button[name=cancel]').click(function(){
        window.location = site_path+'admin/category';
    });
});
</script>