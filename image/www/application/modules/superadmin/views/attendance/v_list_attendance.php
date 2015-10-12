<script>
    var jnoc = jQuery.noConflict();

    jnoc(document).ready(function() {
        jnoc('#attendanceList').DataTable({
            "pageLength": 10,
            "responsive":true
        });
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
                                <h3>Attandance</h3>
                            </div>
                            <div class="widget-content">
                                <div class="table_responsive">
                                        <div class="top-search">
                                            <form action="<?php echo base_url(); ?>index.php/superadmin/manage_attandance/" method="post">
                                                <div class="row">
                                                      <div class="col-md-4"><div class="col-xs-12">Name:</div>
                                                        <div class="col-xs-12"><input list="name" name="name" placeholder="Search By Name..." class="form-control">
                                                            <datalist id="name">
                                                            <?php foreach ($dt_list_attendance as $name) {?>
                                                              <option value="<?php echo $name->att_name;?>">
                                                            <?php } ?>
                                                            </datalist> 
                                                        </div>                                                       
                                                      </div>
                                                      <div class="col-md-4"><div class="col-xs-12">Date:</div>  <div class="col-xs-12"><input name="tanggal_awal" class="datepicker form-control" placeholder="Search By Date..." type="text"></div>  </div>
                                                      <div class="col-md-4"><div class="col-xs-12">To:</div> <div class="col-xs-12"> <input name="tanggal_akhir" class="datepicker form-control" placeholder="Search To Date..." type="text"></div>  </div>
                                                      <div class="col-md-2"><div class="col-xs-12"></div>&nbsp;<div class="col-xs-12"><input type="submit" value="Search" class="btn btn-primary"></div></div>
                                                </div>
                                            </form>
                                        </div>
                                        <table id="attendanceList" class="table table-striped table-bordered" cellspacing="0" border="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>   
                                                    <th>Employe ID</th>                                                 
                                                    <th>Name</th>
                                                    <th>Email</th>                                                   
                                                    <th>Date </th>
                                                    <th>Clock In</th>
                                                    <th>Clock Out</th>
                                                    <th>..</th>
                                                </tr>
                                            </thead>

                                            <tfoot>
                                                <tr>                                                    
                                                    <th>No</th>   
                                                    <th>Employe ID</th>                                                 
                                                    <th>Name</th>
                                                    <th>Email</th>                                                   
                                                    <th>Date </th>
                                                    <th>Clock In</th>
                                                    <th>Clock Out</th>
                                                    <th>..</th>
                                                </tr>
                                            </tfoot>

                                            <tbody>
                                            <?php 
                                            $no=1;
                                            foreach ($dt_list_attendance as $data) {                                                
                                            ?>
                                                <tr>
                                                    <td><?php echo $no++;?></td>
                                                    <td><?php echo $data->emp_id; ?></td>
                                                    <td><a style="font-size:15px" href="<?php echo base_url() ?>index.php/superadmin/manage_attandance/detailEmp/<?php echo $data->emp_id;?>"><?php echo $data->att_name; ?></a></td>
                                                    <td><?php echo $data->att_email; ?></td>
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
                                                    <?php if($data->ctg_id ==0 && $data->osw_id==0 ){?>
                                                    <td><a href="#" class="btn btn-success" data-toggle="modal" data-target="<?php echo $data->att_id;?>">On Time</a></td>
                                                    <?php }elseif($data->osw_id ==1){ ?>
                                                    <td><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#Modalmeeting-<?php echo $data->att_id;?>">Meeting</a></td>
                                                    <?php }elseif($data->osw_id ==2){?> 
                                                    <td><a href="#" class="btn btn-warning" data-toggle="modal" data-target="#Modalonsite-<?php echo $data->att_id;?>">On Site</a></td>
                                                    <?php }else{ ?>   
                                                    <td><a href="#" class="btn btn-danger" data-toggle="modal" data-target="#employe-<?php echo $data->att_id;?>">Late</a></td>                                                    
                                                    <?php } ?>                                               
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                        <?php 
                                        foreach ($dt_list_attendance as $dataatt)  {                                      
                                        //late modal 
                                        $dt_late=$this->db->query("SELECT att_id,emp_id,att_name,hris_categories.ctg_id,ctg_name,reason_late,att_image
                                                                            FROM hris_attendance
                                                                            JOIN hris_categories ON hris_attendance.ctg_id=hris_categories.ctg_id
                                                                            WHERE att_id='$dataatt->att_id'");
                                        foreach ($dt_late->result() as $late) {

                                            $image=$late->att_image;
                                            $att_image = explode("|", $image);                                            
                                        ?>                
                                        <div class="modal fade" id="employe-<?php echo $dataatt->att_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display:none; overflow:scroll;top:39%; height:600px">
                                        <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title" id="myModalLabel">Data Late Current, <?php echo $dataatt->tanggal.", ".$late->att_name; ?></h4>
                                                    </div>
                                                    <div class="modal-footer">                                                
                                                        <table class="table">
                                                            <tr>
                                                                <th>Emp ID</th><td><?php echo $late->emp_id; ?></td>
                                                            </tr>                                                            
                                                            <tr>
                                                                <th>Name</th><td><?php echo $late->att_name; ?></td>
                                                            </tr>                                                          
                                                            <tr>
                                                                <th>Late Category</th><td><?php echo $late->ctg_name; ?></td>
                                                            </tr>                                                           
                                                            <tr>
                                                                <th>Late reason</th><td><?php echo $late->reason_late; ?></td>
                                                            </tr>
                                                        </table>                                                                                                
                                                        <div style="position: relative;margin:0 auto;line-height:1.4em;">
                                                            <div><img style=" max-width:100%;height: auto;" src="<?php echo base_url(); ?>media/<?php echo $att_image[0]; ?>"></div><br><br>
                                                            <?php if ($att_image[1]==''){ ?>
                                                            <?php }else{ ?>
                                                            <div><img style="max-width:100%;height: auto;" src="<?php echo base_url(); ?>media/<?php echo $att_image[1]; ?>"></div>  
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Late modal -->
                                        <?php }

                                        
                                        $dt_meeting=$this->db->query("SELECT att_id,emp_id,att_name,hris_outsidework.osw_id,hris_outsidework.osw_name,reason_meeting
                                                                      FROM hris_attendance 
                                                                      JOIN hris_outsidework ON hris_attendance.osw_id=hris_outsidework.osw_id WHERE att_id='$dataatt->att_id'");
                                            foreach ($dt_meeting->result() as $meeting) {
                                        ?>
                                        <!-- Meeting Modal -->
                                        <div class="modal fade" id="Modalmeeting-<?php echo ($dataatt->att_id);?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display:none; overflow:scroll;top:39%; height:600px">
                                        <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title" id="myModalLabel">Data Metting, <?php echo $dataatt->tanggal.", ".$meeting->att_name; ?></h4>
                                                    </div>
                                                    <div class="modal-footer">                                                
                                                        <table class="table">
                                                            <tr>
                                                                <th>Emp ID</th><td><?php echo $meeting->emp_id; ?></td>
                                                            </tr>                                                            
                                                            <tr>
                                                                <th>Name</th><td><?php echo $meeting->att_name; ?></td>
                                                            </tr>                                                          
                                                            <tr>
                                                                <th>Metting Category</th><td><?php echo $meeting->osw_name; ?></td>
                                                            </tr>                                                           
                                                            <tr>
                                                                <th>Meeting Event</th><td><?php echo $meeting->reason_meeting; ?></td>
                                                            </tr>
                                                        </table>                                                                                              
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Meeting Modal -->

                                        <?php } 

                                        $dt_onsite=$this->db->query("SELECT att_id,emp_id,att_name,hris_outsidework.osw_id,hris_outsidework.osw_name,reason_onsite
                                                                      FROM hris_attendance 
                                                                      JOIN hris_outsidework ON hris_attendance.osw_id=hris_outsidework.osw_id WHERE att_id='$dataatt->att_id'");
                                            foreach ($dt_onsite->result() as $onsite) {
                                        ?>
                                        <!-- Meeting Modal -->
                                        <div class="modal fade" id="Modalonsite-<?php echo ($dataatt->att_id);?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display:none; overflow:scroll;top:39%; height:600px">
                                        <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title" id="myModalLabel">Data On Site, <?php echo $dataatt->tanggal.", ".$onsite->att_name; ?></h4>
                                                    </div>
                                                    <div class="modal-footer">                                                
                                                        <table class="table">
                                                            <tr>
                                                                <th>Emp ID</th><td><?php echo $onsite->emp_id; ?></td>
                                                            </tr>                                                            
                                                            <tr>
                                                                <th>Name</th><td><?php echo $onsite->att_name; ?></td>
                                                            </tr>                                                          
                                                            <tr>
                                                                <th>On Site Category</th><td><?php echo $onsite->osw_name; ?></td>
                                                            </tr>                                                           
                                                            <tr>
                                                                <th>On Site Event</th><td><?php echo $onsite->reason_onsite; ?></td>
                                                            </tr>
                                                        </table>                                                                                              
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Meeting Modal -->
                                        <?php }} ?>
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
</div>