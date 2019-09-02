<!-- <body><div> in top-section-->
        <div class="login-box">
            <div class="login-logo">
                <a href="<?php echo base_url(); ?>"><b>Wholesale</b>Factory</a>
            </div>
            <div class="login-box-body">
                <p class="login-box-msg">Enter Username to recover Password</p>
                
                <form action="<?php echo base_url('login/validateuser'); ?>" method="post">
                    <div class="form-group has-feedback">
                        <input type="username" class="form-control" name="username" placeholder="Username" required>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="text-center text-danger form-group">
                    	<?php if($this->session->flashdata("logerr")!==NULL){ echo $this->session->flashdata("logerr");} ?>
                    </div>
                    <div class="row">
                        <div class="col-xs-6"><a href="<?php echo base_url(); ?>">Login</a></div>
                        <div class="col-xs-6">
                            <button type="submit" class="btn btn-primary btn-block btn-flat" name="forgotpassword">Forgot Password</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->
    </div>
    
</body>