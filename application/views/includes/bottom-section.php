            	</div>
            <footer class="main-footer">
                <div class="pull-right hidden-xs hidden">
                	<b>Version</b> 2.4.0
                </div>
                <strong>Copyright &copy; <?php echo SESSION_YEAR;?> <a href="https://www.brightcodess.com/" class=""></a><?php echo OUR_BRAND;?></strong> All rights reserved.
            </footer>
        </div>
        <!-- jQuery UI 1.11.4 -->
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
          	$.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.7 -->
        <script src="<?php echo file_url("includes/bootstrap/js/bootstrap.min.js"); ?>"></script>
        <!-- Slimscroll -->
        <script src="<?php echo file_url("includes/plugins/slimScroll/jquery.slimscroll.min.js"); ?>"></script>
        <!-- FastClick -->
        <script src="<?php echo file_url("includes/plugins/fastclick/fastclick.js"); ?>"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo file_url("includes/dist/js/adminlte.min.js"); ?>"></script>
        <?php
		if(!empty($bottom_script)){
		  foreach($bottom_script as $key=>$script){
			  if($key=="link"){
					if(is_array($script)){
						foreach($script as $single_script){
							echo "<script src='$single_script'></script>\n\t\t";
						}
					}
					else{
						echo "<script src='$script'></script>\n\t\t";
					}
			  }
			  elseif($key=="file"){
				if(is_array($script)){
					foreach($script as $single_script){
						echo "<script src='".file_url("$single_script")."'></script>\n\t\t";
					}
				}
				else{
					echo "<script src='".file_url("$script")."'></script>\n\t\t";
				}
			  }
		  }
		}
		?>
        <script src="<?php echo file_url('includes/custom/custom.js'); ?>"></script>
        
  	</body>
</html>