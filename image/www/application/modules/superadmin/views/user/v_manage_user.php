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
                                    <a href="<?php echo base_url(); ?>index.php/superadmin/manage_user/dataDeleted" class="btn btn-default">Views Users Deleted</a>
                                    <a style="float:right;" href="<?php echo base_url(); ?>index.php/superadmin/manage_user/create" class="btn btn-primary">New Users</a>
                                    <?php echo $this->session->flashdata('result'); ?>
                                    <br>
                                    <?php
                                    /* Script untuk menampilkan pesan */

                                    if ($this->session->flashdata('delete_sukses')) {
                                        echo '<div class="alert alert-success" style="color:green;"><button type="button" class="close" data-dismiss="alert">×</button><h3>Success to Delete</h3></div>';
                                    } elseif ($this->session->flashdata('warning')) {
                                        echo '<div class="alert alert-warning" style="color:red;"><button type="button" class="close" data-dismiss="alert">×</button><h3>Check Box Empty List</h3></div>';
                                    }
                                    echo validation_errors('<div class="alert alert-warning"><a class="close" data-dismiss="alert">&times;</a>', '</div>');
                                    ?>
                                    <form id="form1" name="form1" method="post" action="<?php echo base_url() ?>index.php/superadmin/manage_user/delete_multiple">  
                                        <table id="Data_supp" class="table table-striped table-bordered" cellspacing="0" border="0" width="100%" style="overflow:scroll;">
                                            <thead>
                                                <tr>
                                                    <th>Check To Delete</th>
                                                    <th>No</th>
                                                    <th>Id Users</th>
                                                    <th>Username</th>
                                                    <th>Level</th>
                                                    <th>Create Date</th>
                                                    <th>Last Update</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>

                                            <tfoot>
                                                <tr>
                                                    <th>Check To Delete</th>
                                                    <th>No</th>
                                                    <th>Id Users</th>
                                                    <th>Username</th>
                                                    <th>Level</th>
                                                    <th>Create Date</th>
                                                    <th>Last Update</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </tfoot>

                                            <tbody>
                                                <?php
                                                $no = 1;
                                                foreach ($dt_user as $data) {
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <input name="id_user[]" type="checkbox" value="<?php echo $data->user_id ?>" /> <!-- propery checkbox yang digunakan -->
                                                            <input name="kode_user" type="hidden" value="<?php echo $this->uri->segment(3); ?>" /> <!-- Property textbox yang digunakan -->
                                                        </td>

                                                        <td width="2%"><?php echo $no++; ?></i></td>
                                                        <td><?php echo $data->user_id; ?></td>
                                                        <td><?php echo $data->username; ?></td>
                                                        <td><?php echo $data->level; ?></td>
                                                        <td><?php echo $data->create_date; ?></td>
                                                        <td><?php echo $data->last_update; ?></td>
                                                        <!-- <td><?php echo $data->delete; ?></td> -->
                                                        <td><a href="<?php echo base_url(); ?>index.php/superadmin/manage_user/edit/<?php echo $data->user_id; ?>" class="btn btn-success btn-small field_center">Edit</a></td>
                                                        <td><a href="<?php echo base_url(); ?>index.php/superadmin/manage_user/delete/<?php echo $data->user_id; ?>" onclick="javascript: return confirm('Anda yakin akan hapus <?php echo $data->username; ?> ?')" class="btn btn-danger btn-small field_center">Delete</a></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <br />
                                        <input class="btn btn-danger" name="Submit" type="submit" value="Delete By Checkbox" onclick="javascript: return confirm('Anda yakin akan hapus?')"/> <!-- Button yang digunakan untuk mengapus data -->
                                    </form>
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