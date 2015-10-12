<script>
    var jnoc = jQuery.noConflict();

    jnoc(document).ready(function() {
        jnoc('#Data_category').DataTable();
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
                                <h3>Manage Category</h3>
                            </div>
                            <div class="widget-content">
                                <div class="table_responsive">
                                    <a href="<?php echo base_url(); ?>index.php/superadmin/manage_category/dataDeleted" class="btn btn-default">Views Category Deleted</a>
                                    <a style="float:right;" href="<?php echo base_url(); ?>index.php/superadmin/manage_category/create" class="btn btn-primary">New Category</a>
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
                                    <form id="form1" name="form1" method="post" action="<?php echo base_url() ?>index.php/superadmin/manage_category/delete_multiple">  
                                        <table id="Data_category" class="table table-striped table-bordered" cellspacing="0" border="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Check To Delete</th>
                                                    <th>No</th>
                                                    <th>Kode</th>
                                                    <th>Name</th>
                                                    <th>Last Update</th>                                                
                                                    <th>Update</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                foreach ($dt_category as $data) {
                                                    ?>
                                                    <tr>
                                                        <td width="10">
                                                            <input name="ctg_id[]" type="checkbox" value="<?php echo $data->ctg_id ?>" /> <!-- propery checkbox yang digunakan -->
                                                            <input name="kode_ctg" type="hidden" value="<?php echo $this->uri->segment(3); ?>" /> <!-- Property textbox yang digunakan -->
                                                        </td>

                                                        <td width="2%"><?php echo $no++; ?></i></td>
                                                        <td><?php echo $data->ctg_code; ?></td>
                                                        <td><?php echo $data->ctg_name; ?></td>                                                        
                                                        <td><?php echo $data->last_update; ?></td>                                                        
                                                        <td><a href="<?php echo base_url(); ?>index.php/superadmin/manage_category/edit/<?php echo $data->ctg_id; ?>" class="btn btn-success btn-small field_center">Edit</a></td>
                                                        <td><a href="<?php echo base_url(); ?>index.php/superadmin/manage_category/delete/<?php echo $data->ctg_id; ?>" onclick="javascript: return confirm('Anda yakin akan hapus <?php echo $data->ctg_name; ?> ?')" class="btn btn-danger btn-small field_center">Delete</a></td>
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