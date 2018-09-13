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

    
    <!-- AdminLTE for demo purposes -->
    <script src='<?php echo($template_path."dist/js/demo.js")?>' type="text/javascript"></script>
    
    <script>
    	

    // open and close the pop up div
	$(function() 
	{
	    //----- OPEN
	    $('[data-popup-open]').on('click', function(e)  {
	        var targeted_popup_class = jQuery(this).attr('data-popup-open');
	        $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);
	 
	        e.preventDefault();
	    });
	 
	    //----- CLOSE
	    $('[data-popup-close]').on('click', function(e)  {
	        var targeted_popup_class = jQuery(this).attr('data-popup-close');
	        $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);
	 
	        e.preventDefault();
	    });
	});
	// end  open the pop up div
    
    $(".edt_administrator_btn").bind("click",function()
    {
		 var admin_id = ($(this).attr('id')).slice(22);
		 var admin_email = $('#admin_email_'+admin_id).html();
		 $("#popup_email_edit").val(admin_email);
		 //alert(admin_email);
		///////////////////////////////////////
		$("#update_admin_popup_btn").bind("click",function()
		{
			
			var admin_group_id = $('#popup_group_update').val();
			//alert(admin_group_id);
			
			// ajax 
			$('#update_permissions_btn').fadeIn()
			
			var target_url = '<?php echo(base_url()."admin/add_administrator") ; ?>';
			var ping = {admin_group_id:admin_group_id,email:admin_email};
			
			$.ajax(
			{
				url : target_url,
				type: "GET",
				cache: false,
				data : ping,
				success: function(pong)
				{
					//pong = JSON && JSON.parse(pong) || $.parseJSON(pong);
					$('#update_permissions_btn').fadeOut();
					
					if(pong == 0)
						alert("this email is not registred , please register it first via <?php echo base_url().'login' ?> ");	
					if(pong == 1)
					{
						//alert("User Admin updated!");	
						//----- RELOAD
						location.reload();
					}
					if(pong == 2)
						alert("Admin must belong to a group!");	
					
				},
				error: function(jqXHR, textStatus, errorThrown)
				{
					$('#update_permissions_btn').fadeOut();
				}
			});   
			
		});
		///////////////////////////////////////
		 
		 
	});
    
    
    $(".grp_chkbox").bind("click",function()
		{
			$('#update_permissions_btn').fadeIn();	
			
			
			//var admin_group_id = $(this).prev("td").prev("td").html();
			var privilege_name = ($(this).attr('id')).slice(0,5);
			var admin_group_id = ($(this).attr('id')).slice(13);
			
			var status = $(this).prop('checked');
			
			switch(privilege_name){
				case "dsbrd":
					privilege_name = "dashboard";
					break;
				case "order":
					privilege_name = "order";
					break;
				case "cstmr":
					privilege_name = "customers";
					break;
				case "prule":
					privilege_name = "price_rules";
					break;
				case "eproc":
					privilege_name = "eprocessors";
					break;
				case "admin":
					privilege_name = "Admins";
					break;
				case "lists":
					privilege_name = "lists";
					break;
				case "categ":
					privilege_name = "categories";
					break;
				case "email":
					privilege_name = "emails";
					break;
				case "wwwen":
					privilege_name = "whowhatwhen";
					break;
				
				default:
					break;
			}
		
			//alert(admin_group_id+","+privilege_name+","+status);
			
			
			//the target (cart controller / add method)
			var target_url = '<?php echo(base_url()."admin/update_admin_group_privileges") ; ?>';
			var privilege_data = {admin_group_id:admin_group_id,privilege_name:privilege_name,state:status};
			
			$.ajax(
			{
				url : target_url,
				type: "GET",
				cache: false,
				data : privilege_data,
				success: function(data)
				{
					//data = JSON && JSON.parse(data) || $.parseJSON(data);
					$('#update_permissions_btn').fadeOut();	
				},
				error: function(jqXHR, textStatus, errorThrown)
				{
					
				}
			});
			
		});
		
		$(".detete_admin_grp").bind("click",function()
		{
			  
			  if (confirm('Are you sure you want to remove this admin group from the database?')) {
				    // Save it!
				    $('#update_permissions_btn').fadeIn();	
				    var admin_group_id = ($(this).attr('id')).slice(12);
				    //alert(admin_group_id);
				    $('#update_permissions_btn').fadeOut();	
					
					// ajax 
					var target_url = '<?php echo(base_url()."admin/delete_admin_group") ; ?>';
					var ping = {admin_group_id:admin_group_id};
					
					$.ajax(
					{
						url : target_url,
						type: "GET",
						cache: false,
						data : ping,
						success: function(pong)
						{
							//pong = JSON && JSON.parse(pong) || $.parseJSON(pong);
							$('#update_permissions_btn').fadeOut();
							//$('#grp_rw_'+admin_group_id).fadeOut("slow");
							
							//----- RELOAD
							location.reload();
							
							//alert(pong)	
						},
						error: function(jqXHR, textStatus, errorThrown)
						{
							$('#update_permissions_btn').fadeOut();
						}
					});   
				    
				} else 
				{
				    // Do nothing!
				}
			  
		});
		
		$("#add_new_admin_popup_btn").bind("click",function()
		{
			var email = $('#popup_email').val();
			var admin_group_id = $('#popup_group').val();
			//alert(group);
			
			// ajax 
			$('#update_permissions_btn').fadeIn()
			
			var target_url = '<?php echo(base_url()."admin/add_administrator") ; ?>';
			var ping = {admin_group_id:admin_group_id,email:email};
			
			$.ajax(
			{
				url : target_url,
				type: "GET",
				cache: false,
				data : ping,
				success: function(pong)
				{
					//pong = JSON && JSON.parse(pong) || $.parseJSON(pong);
					$('#update_permissions_btn').fadeOut();
					
					if(pong == 0)
						alert("this email is not registred , please register it first via <?php echo base_url().'login' ?> ");	
					if(pong == 1)
					{
						alert("User Admin Granted!");	
						//----- RELOAD
						location.reload();
					}
					if(pong == 2)
						alert("Admin must belong to a group!");	
					
				},
				error: function(jqXHR, textStatus, errorThrown)
				{
					$('#update_permissions_btn').fadeOut();
				}
			});   
			
		});
		
		$(".del_administrator_btn").bind("click",function()
		{
			if (confirm('Are you sure you want to remove this admin privileges ?')) 
			{
				var admin_id = ($(this).attr('id')).slice(22);
				//alert(admin_id);
				
			// ajax 
			$('#update_permissions_btn').fadeIn()
			
			var target_url = '<?php echo(base_url()."admin/demote_administrator") ; ?>';
			var ping = {admin_id:admin_id};
			
			$.ajax(
			{
				url : target_url,
				type: "GET",
				cache: false,
				data : ping,
				success: function(pong)
				{
					//pong = JSON && JSON.parse(pong) || $.parseJSON(pong);
					$('#update_permissions_btn').fadeOut();

					alert("Admin was demoted !");
					//----- RELOAD
					location.reload();	
					
				},
				error: function(jqXHR, textStatus, errorThrown)
				{
					$('#update_permissions_btn').fadeOut();
				}
			});   
				
			}
			else
			{
				//nothing
			}
		});
		
		$("#add_new_admin_btn").bind("click",function()
		{
			var group_name = $('#groupname').val();
			if(group_name)
			{
				//alert(group_name);
				
				var target_url = '<?php echo(base_url()."admin/add_admin_group") ; ?>';
				var ping = {group_name:group_name};
				
				$.ajax(
				{
					url : target_url,
					type: "GET",
					cache: false,
					data : ping,
					success: function(pong)
					{
						//pong = JSON && JSON.parse(pong) || $.parseJSON(pong);
						$('#update_permissions_btn').fadeOut();

						//alert("Group was added !");
						//----- RELOAD
						location.reload();	
						
					},
					error: function(jqXHR, textStatus, errorThrown)
					{
						$('#update_permissions_btn').fadeOut();
					}
				}); 
				
				
				
				
			}
			else
			{
				alert("name can not be empty!");
			}
			
		});
		
		
    	
    </script>
    
    
    
  </body>
</html>