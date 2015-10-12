<script>
    var jnoc = jQuery.noConflict();

    jnoc(document).ready(function() {
        jnoc('#Data_supp').DataTable();
    });
</script>
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
                                <h3>Manage User</h3>
                            </div>
                            <div class="widget-content">
                                <div class="table_responsive">
                                    <?php echo $this->session->flashdata('result'); ?>
                                    <br>
                                    
                                    <a href="<?php echo base_url(); ?>index.php/superadmin/manage_user/" class="btn btn-default">Views Users Active</a>                                    
                                        <table id="Data_supp" class="table table-striped table-bordered" cellspacing="0" border="0" width="100%" style="overflow:scroll;">
                                            <thead>
                                                <tr>                             
                                                    <th>No</th>
                                                    <th>Id Users</th>
                                                    <th>Username</th>
                                                    <th>Level</th>
                                                    <th>Create Date</th>
                                                    <th>Last Update</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tfoot>
                                                <tr>                                                    
                                                    <th>No</th>
                                                    <th>Id Users</th>
                                                    <th>Username</th>
                                                    <th>Level</th>
                                                    <th>Create Date</th>
                                                    <th>Last Update</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>

                                            <tbody>
                                                <?php
                                                $no = 1;
                                                foreach ($dt_user as $data) {
                                                    ?>
                                                    <tr>
                                                        <td width="2%"><?php echo $no++; ?></i></td>
                                                        <td><?php echo $data->user_id; ?></td>
                                                        <td><?php echo $data->username; ?></td>
                                                        <td><?php echo $data->level; ?></td>
                                                        <td><?php echo $data->create_date; ?></td>
                                                        <td><?php echo $data->last_update; ?></td>
                                                        <td><a href="<?php echo base_url(); ?>index.php/superadmin/manage_user/active/<?php echo $data->user_id; ?>" onclick="javascript: return confirm('Anda yakin akan aktif kan  <?php echo $data->username; ?> ?')" class="btn btn-danger btn-small field_center">Active</a></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                </div>
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
    </div>
</div>
<div class="extra">

    <!-- /extra-inner --> 
</div>
<!-- /extra -->
<!--content-->