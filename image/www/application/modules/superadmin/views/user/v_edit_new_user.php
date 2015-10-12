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
                                <h3>Add New User</h3>
                            </div>

                            <div class="widget-content">
                                <fieldset>
                                    <form method="post" action="<?php echo base_url(); ?>index.php/superadmin/manage_user/act_edit">
                                        <div class="control-group">                     
                                            <div class="controls">
                                                <input type="hidden" class="span3" id="supp" value="<?php echo $user_id; ?>" name="user_id">
                                            </div> <!-- /controls -->     
                                        </div> <!-- /control-group -->


                                        <div class="control-group">                     
                                            <label class="control-label" for="username">Name</label>
                                            <div class="controls">
                                                <input type="text" class="span3" name="username" id="username" value="<?php echo $username; ?>">
                                            </div> <!-- /controls -->     
                                            <?php if (validation_errors()) { ?>
                                                <div class="alert alert-danger">
                                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                                    <strong><?php echo form_error("username"); ?></strong>
                                                </div>
                                            <?php } ?>

                                        </div> <!-- /control-group -->


                                        <div class="control-group">                     
                                            <label class="control-label" for="password">Password</label>
                                            <div class="controls">
                                                <input type="text" class="span3" name="password" id="password" value="<?php echo $password; ?>">
                                            </div> <!-- /controls -->
                                            <?php if (validation_errors()) { ?>
                                                <div class="alert alert-danger">
                                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                                    <strong><?php echo form_error("password"); ?></strong>
                                                </div>
                                            <?php } ?>       
                                        </div> <!-- /control-group -->



                                        <div class="control-group">                     
                                            <label class="control-label" for="level">Level</label>
                                            <div class="controls">
                                                <select class="selectpicker span3" name="level">
                                                    <option value="1">Admin</option>
                                                    <option value="2">Users</option>
                                                </select>
                                            </div> <!-- /controls -->       
                                        </div> <!-- /control-group -->

                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-primary">Update</button> 
                                            <a href="<?php echo base_url(); ?>index.php/superadmin/manage_user/" class="btn">Cancel</a>
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
