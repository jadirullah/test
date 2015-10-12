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
                                <h3>My Profile</h3>
                            </div>
                            <div class="widget-content">
                                <div class="table_responsive">
                                    <?php echo $this->session->flashdata('result'); ?>
                                    <br>
                                        <div class="top-search">
                                           <table class="table table-bordered">
											    <thead>
											      <tr>
											        <th>#</th>
											        <th>ID Employe</th>
											        <th>Name</th>
											        <th>Email</th>
											        <th>Password</th>
											        <th>Update</th>
											      </tr>
											    </thead>
											    <tbody>
											     <?php
													foreach ($profile_user as $data) {
												?>
											      <tr>
											        <td>1</td>
											        <td><?php echo $data->emp_id; ?></td>
											        <td><?php echo $data->name; ?></td>
											        <td><?php echo $data->email; ?></td>
											        <td><input type="password" disabled value="<?php echo $data->password; ?>"></td>
											        <td><a href="<?php echo base_url(); ?>index.php/employe/my_profile/update/<?php echo $data->emp_id; ?>" class="btn btn-info">Update password</a></td>
											      </tr>	
											    <?php } ?>										      
											    </tbody>
											  </table>                                            
                                        </div>
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
    </div>
</div>
<div class="extra">

    <!-- /extra-inner --> 
</div>

