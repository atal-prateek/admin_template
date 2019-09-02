<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
            	<img src="<?php echo $user['photo']; ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $this->session->userdata('name'); ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
        	<li class="header">MAIN NAVIGATION</li>
            <li class="<?php echo activate_menu("home"); ?>">
            	<a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> <span>Home</span></a>
            </li>
            <li class="<?php echo activate_menu("category"); ?>">
                <a href="<?php echo base_url("category/"); ?>"><i class="fa fa-cog"></i> <span>Category</span></a>
            </li>
            <li class="<?php echo activate_menu("users"); ?>">
                <a href="<?php echo base_url("users/"); ?>"><i class="fa fa-users"></i> <span>Users</span></a>
            </li>
            <li class="treeview <?php echo activate_dropdown("dashboard"); ?>">
              	<a href="#">
                	<i class="fa fa-dashboard"></i>
                	<span>App Dashboard</span>
                	<i class="fa fa-angle-down pull-right"></i>
              	</a>
              	<ul class="treeview-menu">
                    <li class="<?php echo activate_menu("dashboard/banner"); ?>"><a href="<?php echo base_url("dashboard/banner/"); ?>"><i class="fa fa-circle-o"></i>Banner</a></li>
                    <li class="<?php echo activate_menu("dashboard/topsellers"); ?>"><a href="<?php echo base_url("dashboard/topsellers/"); ?>"><i class="fa fa-circle-o"></i>Top Sellers</a></li>
              	</ul>
            </li>
            <?php if($this->session->role!='admin'){ ?>
            <li class="treeview <?php echo activate_dropdown("profile"); ?>">
              	<a href="#">
                	<i class="fa fa-users"></i>
                	<span>Member's Details</span>
                	<i class="fa fa-angle-down pull-right"></i>
              	</a>
              	<ul class="treeview-menu">
                    <li class="<?php echo activate_menu("profile"); ?>"><a href="<?php echo base_url("profile/"); ?>"><i class="fa fa-circle-o"></i>Change Profile</a></li>
                    <li class="<?php echo activate_menu("profile/changepassword"); ?>"><a href="<?php echo base_url("profile/changepassword/"); ?>"><i class="fa fa-circle-o"></i>Change Password</a></li>
                    <li class="<?php echo activate_menu("profile"); ?> hidden"><a href="<?php echo base_url("profile/"); ?>"><i class="fa fa-circle-o"></i>Change Trn Password</a></li>
                    <li class="<?php echo activate_menu("profile/accdetails"); ?>"><a href="<?php echo base_url("profile/accdetails/"); ?>"><i class="fa fa-circle-o"></i>Account Details</a></li>
                    <li class="<?php echo activate_menu("profile/kyc"); ?>"><a href="<?php echo base_url("profile/kyc/"); ?>"><i class="fa fa-circle-o"></i>Upload KYC</a></li>
                    <li class="<?php echo activate_menu("profile/welcomeletter"); ?> hidden"><a href="<?php echo base_url("profile/welcomeletter/"); ?>"><i class="fa fa-circle-o"></i>Welcome Letter</a></li>
              	</ul>
            </li>
            <?php 
				}
			?>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
<div class="content-wrapper">
    <div class="overlay" id="loading">
        <i class="fa fa-3x fa-refresh fa-spin"></i>
    </div>
	<?php
    	$this->load->view('includes/breadcrumb');
	?>
    <!-- Main content -->