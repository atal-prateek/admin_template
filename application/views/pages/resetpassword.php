<!-- <body><div> in top-section-->
        <div class="login-box">
            <div class="login-logo">
                <a href="<?php echo base_url(); ?>"><b>Wholesale</b>Factory</a>
            </div>
            <div class="login-box-body">
                <p class="login-box-msg">Enter New Password</p>
                
                <form action="<?php echo base_url('login/changepassword'); ?>" method="post">
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="text-center text-danger form-group">
                    	<?php if($this->session->flashdata("logerr")!==NULL){ echo $this->session->flashdata("logerr");} ?>
                    </div>
                    <div class="row">
                        <div class="col-xs-6"><a href="<?php echo base_url('login/skipreset/'); ?>">Skip &amp; Login</a></div>
                        <div class="col-xs-6">
                            <button type="submit" class="btn btn-primary btn-block btn-flat" name="changepassword">Reset Password</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->
    </div>
    
</body>