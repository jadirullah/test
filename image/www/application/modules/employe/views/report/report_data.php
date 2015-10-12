<script>
    var jnoc = jQuery.noConflict();

    jnoc(document).ready(function() {
        jnoc('#employe').DataTable();
        responsive: true
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
                                <h3>Attandance Report <?php echo $user; ?></h3>
                            </div>
                            <div class="widget-content">
                                <div class="table_responsive">
                                   <div class="top-search">                                            
                                        <div class="row">
                                            <form action="<?php echo base_url(); ?>index.php/employe/report/" method="post">
                                              <div class="col-md-4"><div class="col-xs-12">Date:</div>  <div class="col-xs-12"><input name="tanggal_awal" class="datepicker form-control" placeholder="Search By Date..." type="text"></div>  </div>
                                              <div class="col-md-4"><div class="col-xs-12">To:</div> <div class="col-xs-12"> <input name="tanggal_akhir" class="datepicker form-control" placeholder="Search To Date..." type="text"></div>  </div>
                                              <div class="col-md-2"><div class="col-xs-12"></div>&nbsp;<div class="col-xs-12"><input type="submit" value="Search" class="btn btn-primary"></div></div> 
                                            </form>
                                             <table id="employe" class="table table-striped table-bordered" cellspacing="0" border="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>                                                                                                           
                                                        <th>Date </th>
                                                        <th>Clock In</th>
                                                        <th>Clock Out</th>
                                                        <th>Status</th>
                                                    </tr>
                                               </thead>                                
                                                <tbody>
                                                    <?php
                                                        $no=1;
                                                        foreach ($attendance_detil->result() as $data) {                                                    
                                                        ?>
                                                    <tr>
                                                        <td><?php echo $no++; ?></td>
                                                        <td><?php echo $data->tanggal; ?></td>
                                                        <td><?php echo $data->clock_in; ?></td>
                                                        <?php
                                                            $clock_in=$data->clock_in;
                                                            $clock_out=$data->clock_out;
                                                            if ($clock_in == $clock_out){
                                                        ?>
                                                        <td>00:00:00</td>
                                                        <?php }else{ ?>
                                                        <td><?php echo $data->clock_out; ?></td>
                                                            <?php }?>
                                                        <?php if($data->ctg_id ==0 && $data->osw_id==0){?>
                                                        <td>On Time</td>
                                                        <?php }elseif($data->osw_id ==1){ ?>
                                                        <td>Meeting</td>
                                                        <?php }elseif($data->osw_id ==2){?> 
                                                        <td>On Site</td>
                                                        <?php }else{?> 
                                                        <td>Late</td>
                                                        <?php } ?> 
                                                    </tr>
                                                    <?php }
                                                    ?>
                                                </tbody>
                                            </table>
                                            </div>
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


<!-- this java script must be appear when you use twitter bootstrop -->