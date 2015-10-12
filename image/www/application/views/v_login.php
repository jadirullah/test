<div id="login-page">
    <div class="container">
        <?php
        // set message jika tdk bisa login
        
        echo form_open('main_module/in/', 'name="formLogin" class="form-login"');
        ?>
        <h2 class="form-login-heading">HRIS Login</h2>
        <div class="login-wrap">
            <?php
            if ($this->session->flashdata('msg')) {
            echo "<div class='alert alert-danger'><b>".$this->session->flashdata('msg')."</b></div>";
        }
            ?>
            <?php echo form_input('username', '', ' required="required" class="form-control" autofocus placeholder="Input Username" tabindex="1" id="username" title="Please enter your Username."'); ?>
            <br>
            <?php echo form_password('password', '', 'required="required" class="form-control" placeholder="Input Password" tabindex="2" id="password" title="Please enter your password."'); ?>
            <label class="checkbox">
                <span class="pull-right">
                    <a data-toggle="modal" href="login.html#myModal"> Forgot Password?</a>

                </span>
            </label>
            <button class="btn btn-theme btn-block" href="index.html" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>
        </div>
        <?php echo form_close(); ?>
        <!-- Modal -->
        <form method="post" action="footer.php">
            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Forgot Password ?</h4>
                        </div>
                        <div class="modal-body">
                            <p>Enter your e-mail address below to reset your password.</p>
                            <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                        </div>
                        <div class="modal-footer">
                            <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                            <button class="btn btn-theme" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal -->

        </form>     

    </div>
</div>