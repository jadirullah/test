<div id="login-page">
    <div class="container">
        <?php
        // set message jika tdk bisa login
        
        echo form_open('main_module/attendance/', 'name="formLogin" class="form-login"');
        ?>
        <h2 class="form-login-heading">Attendance Web Base Aplication</h2>
        <div class="login-wrap">
            <?php
            if ($this->session->flashdata('msg')) {
            echo "<div class='alert alert-danger'><b>".$this->session->flashdata('msg')."</b></div>";
        }
            ?>
            <?php echo form_input('email', '', ' required="required" class="form-control" autofocus placeholder="Your Email" tabindex="1" id="email" title="Please enter your Email."'); ?>
            <br>
            
            <button class="btn btn-theme btn-block" href="index.html" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>