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
                            <li class="breadcrumb-item active" aria-current="page">Add Category</li>
                        </ol>
                    </nav>
                </div>
            </div>
       </div>
   </div>
       <?php echo validation_errors(); ?>
            <?php if($this->session->flashdata('Invalid') != ''){ ?>
                <div class="alert alert-danger hide_msg">
                    <p><?php echo $this->session->flashdata('Invalid');?></p>
                </div>
            <?php } ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-body">
                <form action="<?php echo base_url() ?>admin/category/insert_record" method="POST" class="form-horizontal" enctype='multipart/form-data'>
                    <div class="card-body">
                        
                        <div class="form-group row">
                            <label for="var_username" class="col-sm-3 text-right control-label col-form-label">Category Title<span class="mandatory">*</span></label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="var_title" name="var_title" placeholder="Category Title Here" required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="var_image" class="col-sm-3 text-right control-label col-form-label">Category Icon</label>
                            <div class="col-sm-7">
                                <input type="file" class="form-control" id="var_image" name="var_image">
                            </div>
                        </div>
                    </div>
                    <hr>
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
    
$(function(){
    $('button[name=cancel]').click(function(){
        window.location = site_path+'admin/category';
    });
});
</script>