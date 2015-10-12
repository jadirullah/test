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
                                <h3>Add New Employe</h3>
                            </div>

                            <div class="widget-content">
                                <fieldset>
                                    <form method="post" action="<?php echo base_url(); ?>index.php/superadmin/manage_employed/act_create">
                                        <div class="control-group">                     
                                            <div class="controls">
                                                <input type="hidden" class="span3" id="user" value="<?php echo $kode; ?>" name="emp_id">
                                            </div> <!-- /controls -->       
                                        </div> <!-- /control-group -->


                                        <div class="control-group">                     
                                            <label class="control-label" for="firstname">Name</label>
                                            <div class="controls">
                                                <input type="text" class="span3" name="name" id="firstname" placeholder="Name ...">
                                                <?php if (validation_errors()) { ?>
                                                    <div class="alert alert-danger">
                                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                                        <strong><?php echo form_error("name"); ?></strong>
                                                    </div>
                                                <?php } ?>
                                            </div> <!-- /controls -->       
                                        </div> <!-- /control-group -->


                                        <div class="control-group">                     
                                            <label class="control-label" for="email">Email</label>
                                            <div class="controls">
                                                <input type="text" class="span3" name="email" id="email" placeholder="Email...">
                                            </div> <!-- /controls -->       
                                            <?php if (validation_errors()) { ?>
                                                <div class="alert alert-danger">
                                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                                    <strong><?php echo form_error("email"); ?></strong>
                                                </div>
                                            <?php } ?>
                                        </div> <!-- /control-group -->

                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-primary">Save</button> 
                                            <a href="<?php echo base_url(); ?>index.php/superadmin/manage_employed/" class="btn">Cancel</a>
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
