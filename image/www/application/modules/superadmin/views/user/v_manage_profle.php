<script>
    var jnoc = jQuery.noConflict();

    jnoc(document).ready(function() {
        jnoc('#userProfile2').DataTable();
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
                                <h3>Your Profil <?php echo $this->session->userdata('username'); ?></h3>
                            </div>
                            <div class="widget-content">
                                <div class="table_responsive">
                                        <table id="userProfile" class="table table-striped table-bordered" cellspacing="0" border="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>   
                                                    <th>Users ID</th>                                                 
                                                    <th>Username</th>
                                                    <th>Password</th>                                                   
                                                    <th>Level</th>
                                                    <th>...</th>                                                    
                                                </tr>
                                            </thead>

                                            <tfoot>
                                                <tr>                                                    
                                                    <th>No</th>   
                                                    <th>Users ID</th>                                                 
                                                    <th>Username</th>
                                                    <th>Password</th>                                                   
                                                    <th>Level</th>
                                                    <th>...</th>   
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                            <?php 
                                            $no=1;
                                            foreach ($profile_user as $data) {                                                
                                            ?>
                                                <tr>
                                                    <td><?php echo $no++;?></td>
                                                    <td><?php echo $data->user_id; ?></td>
                                                    <td><?php echo $data->username; ?></td>
                                                    <td><input type="password" value="<?php echo $data->pass; ?>" disabled></td>
                                                    <?php
                                                    if ($data->level==1){
                                                        echo "<td>Administrator</td>";
                                                    }elseif($data->level==2){
                                                        echo "<td>Users</td>";
                                                    }
                                                    ?>
                                                    <td><a href="#" class="btn btn-success btn-small field_center">Update</a></td>                                                  
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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