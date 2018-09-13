   	<?php
	// load the url helper for base_url 
	$this->load->helper('url');
	$template_path= base_url()."assets/templates/adminlte/";
	 ?> 
	 
   <!-- jQuery 2.1.4 -->
    <script src='<?php echo($template_path."plugins/jQuery/jQuery-2.1.4.min.js")?>'></script>
    
    <!-- Bootstrap 3.3.2 JS -->
    <script src='<?php echo($template_path."bootstrap/js/bootstrap.min.js")?>' type="text/javascript"></script>
   
    <!-- FastClick -->
    <script src='<?php echo($template_path."plugins/fastclick/fastclick.min.js")?>'></script>
    
    <!-- AdminLTE App -->
    <script src='<?php echo($template_path."dist/js/app.min.js")?>' type="text/javascript"></script>
    
    <!-- Sparkline -->
    <script src='<?php echo($template_path."plugins/sparkline/jquery.sparkline.min.js")?>' type="text/javascript"></script>
    
    <!-- jvectormap -->
    <script src='<?php echo($template_path."plugins/jvectormap/jquery-jvectormap-1.2.2.min.js")?>' type="text/javascript"></script>
    <script src='<?php echo($template_path."plugins/jvectormap/jquery-jvectormap-world-mill-en.js")?>' type="text/javascript"></script>
    
    <!-- SlimScroll 1.3.0 -->
    <script src='<?php echo($template_path."plugins/slimScroll/jquery.slimscroll.min.js")?>' type="text/javascript"></script>
    
    <!-- ChartJS 1.0.1 -->
    <script src='<?php echo($template_path."plugins/chartjs/Chart.min.js")?>' type="text/javascript"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src='<?php echo($template_path."dist/js/pages/dashboard2.js")?>' type="text/javascript"></script>

    <!-- AdminLTE for demo purposes -->
    <script src='<?php echo($template_path."dist/js/demo.js")?>' type="text/javascript"></script>
  </body>
</html>