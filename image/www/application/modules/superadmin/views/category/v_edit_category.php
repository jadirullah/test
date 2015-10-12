<!--content-->

<div class="main">
    <div class="main-inner">
        <div class="container">
            <div class="row">
                <div class="span6">
                    <!--isi kontent-->
                    <div class="container">
                        <div class="widget center">
                            <div class="widget-header">
                                <i></i>
                                <h3>Update Category</h3>
                            </div>

                            <div class="widget-content">
                                <fieldset>
                                    <form method="post" action="<?php echo base_url(); ?>index.php/superadmin/manage_category/act_edit">
                                        <div class="control-group">                     
                                            <div class="controls">
                                                <input type="hidden" class="span3" id="ctg_id" value="<?php echo $ctg_id; ?>" name="ctg_id">
                                            </div> <!-- /controls -->     
                                        </div> <!-- /control-group -->


                                        <div class="control-group">                     
                                            <label class="control-label" for="ctg_code">Code</label>
                                            <div class="controls">
                                                <input type="text" class="span3" name="ctg_code" id="ctg_code" value="<?php echo $ctg_code; ?>">
                                            </div> <!-- /controls -->     
                                            <?php if (validation_errors()) { ?>
                                                <div class="alert alert-danger">
                                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                                    <strong><?php echo form_error("ctg_code"); ?></strong>
                                                </div>
                                            <?php } ?>

                                        </div> <!-- /control-group -->


                                        <div class="control-group">                     
                                            <label class="control-label" for="ctg_name">Category Name</label>
                                            <div class="controls">
                                                <input type="text" class="span3" name="ctg_name" id="ctg_name" value="<?php echo $ctg_name; ?>">
                                            </div> <!-- /controls -->
                                            <?php if (validation_errors()) { ?>
                                                <div class="alert alert-danger">
                                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                                    <strong><?php echo form_error("ctg_name"); ?></strong>
                                                </div>
                                            <?php } ?>       
                                        </div> <!-- /control-group -->

                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-primary">Update</button> 
                                            <a href="<?php echo base_url(); ?>index.php/superadmin/manage_category/" class="btn">Cancel</a>
                                        </div> <!-- /form-actions -->
                                    </form>
                                </fieldset>
                                <div>
                                </div>
                            </div>
                            <!--tutup isi kontent-->
                        </div>
                    </div>
                    <!-- /row --> 
                </div>
                <!-- /container --> 
            </div>
            <!-- /main-inner --> 
        </div>
        <!-- /main -->
        <div class="extra">

            <!-- /extra-inner --> 
        </div>
        <!-- /extra -->
        <!--content-->
