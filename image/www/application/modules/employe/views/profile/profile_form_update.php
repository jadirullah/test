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
                                <h3>Update Page Profil</h3>
                            </div>

                            <div class="widget-content">
                                <fieldset>
                                    <form method="post" action="<?php echo base_url(); ?>index.php/employe/my_profile/act_edit">
                                        <div class="control-group">                     
                                            <div class="controls">
                                                <input type="hidden" class="span3" id="employe" value="<?php echo $emp_id; ?>" name="emp_id">
                                            </div> <!-- /controls -->     
                                        </div> <!-- /control-group -->


                                        <div class="control-group">                     
                                            <label class="control-label" for="name">Name</label>
                                            <div class="controls">
                                                <input readonly="readonly" type="text" class="span3" name="name" id="name" value="<?php echo $name; ?>">
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->


                                        <div class="control-group">                     
                                            <label class="control-label" for="email">Email</label>
                                            <div class="controls">
                                                <input  readonly="readonly" type="text" class="span3" name="email" id="email" value="<?php echo $email; ?>">
                                            </div> <!-- /controls -->                                               
                                        </div> <!-- /control-group -->



                                        <div class="control-group">                     
                                            <label class="control-label" for="password">Password</label>
                                            <div class="controls">
                                                <input type="text" class="span3" name="password" maxlength="6" id="password" value="<?php echo $password; ?>">
                                            </div> <!-- /controls -->  

                                            <?php if (validation_errors()) { ?>
                                                <div class="alert alert-danger">
                                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                                    <strong><?php echo form_error("password"); ?></strong>
                                                </div>
                                            <?php } ?>  

                                        </div> <!-- /control-group -->

                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-primary">Update</button> 
                                            <a href="<?php echo base_url(); ?>index.php/employe/my_profile" class="btn">Cancel</a>
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
