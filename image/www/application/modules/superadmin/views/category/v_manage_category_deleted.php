
<script>
    var jnoc = jQuery.noConflict();

    jnoc(document).ready(function() {
        jnoc('#Data_ctg').DataTable();
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
                                <h3>Manage Category delete</h3>
                            </div>
                            <div class="widget-content">
                                <div class="table_responsive">
                                    <?php echo $this->session->flashdata('result'); ?>
                                    <br>
                                    
                                    <a href="<?php echo base_url(); ?>index.php/superadmin/manage_category/" class="btn btn-default">Views Users Active</a>                                    
                                        <table id="Data_ctg" class="table table-striped table-bordered" cellspacing="0" border="0" width="100%" style="overflow:scroll;">
                                            <thead>
                                                <tr>                             
                                                    <th>No</th>
                                                    <th>Code</th>
                                                    <th>Name</th>                                                    
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tfoot>
                                                <tr>                                                    
                                                    <th>No</th>
                                                    <th>Code</th>
                                                    <th>Name</th>                                                    
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>

                                            <tbody>
                                                <?php
                                                $no = 1;
                                                foreach ($dt_ctg as $data) {
                                                    ?>
                                                    <tr>
                                                        <td width="2%"><?php echo $no++; ?></i></td>
                                                        <td><?php echo $data->ctg_code; ?></td>
                                                        <td><?php echo $data->ctg_name; ?></td>                                                        
                                                        <td><a href="<?php echo base_url(); ?>index.php/superadmin/manage_category/active/<?php echo $data->ctg_id; ?>" onclick="javascript: return confirm('Anda yakin akan aktif kan  <?php echo $data->ctg_name; ?> ?')" class="btn btn-danger btn-small field_center">Active</a></td>
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