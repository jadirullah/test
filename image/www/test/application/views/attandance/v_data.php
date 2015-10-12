<script>
    var jnoc = jQuery.noConflict();

    jnoc(document).ready(function() {
        jnoc('#Data_supp').DataTable();
    });
</script>
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
                                <h3>Attandance</h3>
                            </div>
                            <div class="widget-content">
                                <div class="table_responsive">
                                        <table id="Data_supp" class="table table-striped table-bordered" cellspacing="0" border="0" width="100%" style="overflow:scroll;">
                                            <thead>
                                                <tr>
                                                    <th>No</th>                                                    
                                                    <th>Name</th>
                                                    <th>Email</th>                                                    
                                                    <th>Time</th>                                                    
                                                    <th>Date </th>
                                                    <th>Status</th>
                                                    <th>Limit</th>
                                                    <th>Latitude</th>
                                                    <th>Longtitude</th>
                                                    <th>Detail</th>
                                                </tr>
                                            </thead>

                                            <tfoot>
                                                <tr>                                                    
                                                    <th>No</th>                                                    
                                                    <th>Name</th>  
                                                    <th>Email</th>                                                  
                                                    <th>Time</th>                                                    
                                                    <th>Date </th>
                                                    <th>Status</th>
                                                    <th>Limit</th>
                                                    <th>Latitude</th>
                                                    <th>Longtitude</th>
                                                    <th>Detail</th>
                                                </tr>
                                            </tfoot>

                                            <tbody>
                                            <?php 
                                            $no=1;
                                            foreach ($data_attandance as $data) {                                                
                                            ?>
                                                <tr>
                                                    <td><?php echo $no++;?></td>
                                                    <td><?php echo $data->name; ?></td>
                                                    <td><?php echo $data->email; ?></td>
                                                    <td><?php echo $data->time; ?></td>
                                                    <td><?php echo $data->date; ?></td>
                                                    <td><?php echo $data->status; ?></td>
                                                    <td><?php echo $data->limit; ?></td>
                                                    <td><?php echo $data->latitude; ?></td>
                                                    <td><?php echo $data->longtitude; ?></td>
                                                    <td><a href="<?php echo base_url(); ?>index.php/admin/DetailAttandance/<?php echo $data->id; ?>" class="btn btn-default">Detail</td>                                                    
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
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