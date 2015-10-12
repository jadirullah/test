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
                                    <form method="post" action="<?php echo base_url(); ?>index.php/superadmin/manage_user/act_create">
                                        <div class="control-group">                     
                                            <div class="controls">
                                                <input type="hidden" class="span3" id="user" value="<?php echo $kode; ?>" name="user_id">
                                            </div> <!-- /controls -->       
                                        </div> <!-- /control-group -->


                                        <div class="control-group">                     
                                            <label class="control-label" for="firstname">Name</label>
                                            <div class="controls">
                                                <input type="text" class="span3" name="username" id="firstname" placeholder="Name ...">
                                                <?php if (validation_errors()) { ?>
                                                    <div class="alert alert-danger">
                                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                                        <strong><?php echo form_error("username"); ?></strong>
                                                    </div>
                                                <?php } ?>
                                            </div> <!-- /controls -->       
                                        </div> <!-- /control-group -->


                                        <div class="control-group">                     
                                            <label class="control-label" for="password">Password</label>
                                            <div class="controls">
                                                <input type="text" class="span3" name="password" id="password" placeholder="Password...">
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
                                              <!-- <input type="text" class="span3" name="level" id="level" placeholder="Email Address"> -->
                                                <select class="selectpicker span3" name="level">
                                                    <option value="1">Admin</option>
                                                    <option value="2">Users</option>

                                                </select>
                                            </div> <!-- /controls -->       
                                        </div> <!-- /control-group -->

                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-primary">Save</button> 
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
