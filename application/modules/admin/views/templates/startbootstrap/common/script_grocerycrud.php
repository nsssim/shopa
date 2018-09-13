   	<?php
	// load the url helper for base_url 
	$this->load->helper('url');
	$template_path= base_url()."assets/templates/adminlte/";
	 ?> 
	
  	 <!-- Grocery crud -->
	<?php foreach($crud_data->js_files as $file): ?>
		<script src="<?php echo $file; ?>"></script>
	<?php endforeach; ?>
	 
   <!-- jQuery 2.1.4 -->
   <!-- <script src='<?php echo($template_path."plugins/jQuery/jQuery-2.1.4.min.js")?>'></script>-->
    
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
  
  	<script>
  		$("#apply_max_price").click(function(){
  			var the_max_price_id =   $("#max_price").children(":selected").attr("id");
  			//var the_max_price_val =  $("#max_price").val();
  			
  			//let's ajax
				var target_url = '<?php echo(base_url()."price_rules/update_max_price") ; ?>'; 
				var data_send = {max_price_id:the_max_price_id,"<?php echo $this->security->get_csrf_token_name();?>":"<?php echo $this->security->get_csrf_hash();?>"};
				
				$.ajax(
				{
					url : target_url,
					data: data_send,
					type: "POST",
					success: function(return_data)
					{
						if(return_data == "1" )
						{
							$("#max_price_msg_ok").fadeIn(2000).delay(1000).fadeOut(1000);
						}
						else
						{
							$("#max_price_msg_error").fadeIn(2000).delay(1000);
							
						}
	    				
					},
					error: function(jqXHR, textStatus, errorThrown)
					{
						$("#max_price_msg_error").fadeIn(2000).delay(1000);
						console.log('textStatus='+textStatus);
						console.log('errorThrown='+errorThrown);
					}
				});
		//end ajax	
  			
  		});
  	</script>
  
  </body>
</html>