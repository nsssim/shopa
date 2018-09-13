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
    <!--<script src='<?php echo($template_path."dist/js/pages/dashboard2.js")?>' type="text/javascript"></script>-->

    <!-- AdminLTE for demo purposes -->
    <script src='<?php echo($template_path."dist/js/demo.js")?>' type="text/javascript"></script>
    
    <script>
    //------------------------------------------------------------------------------------------------------
    //globals
    var current_url = window.location.href;
    var url_sorting = "";
    var new_sorting_direction = "";
    //alert(current_url);
	
    //------------------------------------------------------------------------------------------------------
	//arrows code here up and down depending on url
	
	//get the current url with pagination offset
    var re = /(.+orders\/[0-9]+\?)-ob-(.+)%3A([a-z])/g; 
    var m;
	while ((m = re.exec(current_url)) !== null) 
	{
		if (m.index === re.lastIndex) 
		{
	   		re.lastIndex++;
		}
	    // View your result using the m-variable.
	    // eg m[0] etc.
	    //m[1] = baseurl
	    //m[2] = header_id
	    //m[3] = dirrection
	    if(m[2]) // if header_id exists like "date_add" or "email"
	    {
		    if(m[3] == "d")
		    {
		     	if(m[2] =="email")
		     	{
					$('#email_dn').css('display','inline');
				}
				if(m[2] =="date_add")
		     	{
					$('#date_add_dn').css('display','inline');
				}
				
			}
		    else 
		    {
		    	if(m[2] =="email")
		     	{
					$('#email_up').css('display','inline');
				}
				if(m[2] =="date_add")
		     	{
					$('#date_add_up').css('display','inline');
				}
			}

		}
    
	}
	//end arrows code
	
	   
    
    //------------------------------------------------------------------------------------------------------
    //when table header is clicked
    $('.sortable').click(function(){
    	$('.sort_arrow').css('display','none');
    	var header_id_raw = $(this).attr('id');
    	var header_id = header_id_raw.substring(0, header_id_raw.length - 4);
    	
    	//get the current url with pagination offset
    	var re = /(.+orders\/[0-9]+\?)-ob-(.+)%3A([a-z])/g; 
    	
		var matches;
		 
		while ((matches = re.exec(current_url)) !== null) 
			{
		    	if (matches.index === re.lastIndex) 
		    	{
		       		re.lastIndex++;
		    	}
			    // View your result using the matches-variable.
			    // eg matches[0] etc.
			    //matches[1] = baseurl
			    //matches[2] = header_id
			    //matches[3] = dirrection
			    if(matches[2]) // if header_id exists like "date_add" or "email"
			    {
					
				    var current_sorting_direction =matches[3]; 
				    if(current_sorting_direction == "d")
				    {
				     	new_sorting_direction = "a";
				     	if(header_id =="email")
				     	{
							$('#email_up').css('display','inline');
						}
						if(header_id =="date_add")
				     	{
							$('#date_add_up').css('display','inline');
						}
						
					}
				    else 
				    {
				    	new_sorting_direction = "d";
					}
				    var url_header_id = matches[2];
			    
				    if(header_id == url_header_id)
				    {
		    			url_sorting = matches[1] + "-ob-"+header_id+"%3A"+ new_sorting_direction;
					}
					else{
		    			url_sorting = matches[1] + "-ob-"+header_id+"%3A" + "a";
					}
				}
    		
			}
    	
    	//alert(url_sorting);
    	window.location.replace(url_sorting);
    	
    	
    });
    
    
    //------------------------------------------------------------------------------------------------------
    // when checkmark is clicked
    
    $(".od_chbox").click(function()
		{ 
			var check_box_str_id = $(this).attr('id');
			var check_box_str = "";
			var check_box_id = 0;
			var check_box_value = 0;
			
			//regex start - split the string into row and id 
			var re = /(.+)--([0-9]+)/g; 
		    var m;
		     
		    while ((m = re.exec(check_box_str_id)) !== null) {
		        if (m.index === re.lastIndex) 
		        {
		            re.lastIndex++;
		        }
		        // View your result using the m-variable.
		        // eg m[0] etc.
		        check_box_str = m[1];
		        check_box_id = m[2];
		        
		    }
			//end regex
			
			if(document.getElementById(check_box_str_id).checked) 
			{
				//console.info(check_box_str_id + " is checked!!!!");
				check_box_value = 1;
			} 
			else {
				//console.info(check_box_str_id + " is NOT checked.");
				check_box_value = 0;
			}
			
			//console.info(check_box_str + "==="+ check_box_id);
			
			var target_url = '<?php echo(base_url()."admin/update_order_details") ; ?>';
			  	 				  	 
			var OrderData = {o_id:check_box_id,o_option_name:check_box_str,value:check_box_value};
				
				$.ajax(
				{
					url : target_url,
					type: "GET",
					cache: false,
					data : OrderData,
					success: function(data)
					{
						//update the cart icon
						cart = JSON && JSON.parse(data) || $.parseJSON(data);
						
						var num_items = "( "+ cart.num_of_items + " )";
						$("#cart_num").html(num_items);
					},
					error: function(jqXHR, textStatus, errorThrown)
					{
						console.log(textStatus + " : " + errorThrown) ;
					}
				});
			//return false; 
		});
    
    //end checkmark checked
    
    
    //------------------------------------------------------------------------------------------------------
    //save current vlue in tracking number for later comparison 
    var temp_array = {};
    //when tracking input gets focus save the current string in a temp var
	$('.od_tracknum').focusin(function(){
		current_input_id = $(this).attr('id');
		order_id = current_input_id.substr(17);
		current_value = $(this).val();
		
				
		temp_array[order_id] = current_value ;
	})
	
     //------------------------------------------------------------------------------------------------------
    //when tracking input is being typed show the floppy disk icon
	//on keyup, start the countdown
	$('.od_tracknum').keyup(function()
	{
		current_typed_value = $(this).val();
		
		current_input_id = $(this).attr('id');
		order_id = current_input_id.substr(17);
		//tracking_num = $(this).val();
		
		//if($(this).val())
		//{
			//$('#save_btn--'+order_id).fadeIn();
			if(current_typed_value != temp_array[order_id])
			{
				$('#save_btn--'+order_id).fadeIn(100);
				$('#save_btn--'+order_id).css('color','red'); 	
			}
			else
			{
				$('#save_btn--'+order_id).fadeOut(100);
			}
		//}
		
		//tracking_number--130
		//console.log(order_id+"..."+tracking_num );
	});
	
	//------------------------------------------------------------------------------------------------------
	//when clicking on save icon, hide it and send tracking number to db
	$('.save_tracking_number').click(function()
	{
		current_input_id = $(this).attr('id');
		order_id = current_input_id.substr(10);
		//$('#save_btn--'+order_id).fadeOut();
		new_val =  $('#tracking_number--'+order_id).val();
		new_val = new_val.toUpperCase(); 
		console.log(order_id+" : "+new_val);
		
		//XHR here
		var target_url = '<?php echo(base_url()."admin/update_order_details") ; ?>';
			  	 				  	 
		var OrderData = {o_id:order_id,o_option_name:"tracking_num",value:new_val};
			
			$.ajax(
			{
				url : target_url,
				type: "GET",
				cache: false,
				data : OrderData,
				success: function(data)
				{
					//ok hide the save icon
					$('#save_btn--'+order_id).fadeOut();
				},
				error: function(jqXHR, textStatus, errorThrown)
				{
					console.log(textStatus + " : " + errorThrown) ;
				}
			});
		
	});
    
    //------------------------------------------------------------------------------------------------------
	//when track it is clicked get the tracking number and redirect to ups site http://wwwapps.ups.com/WebTracking/track?loc=en_US&track.x=Track&trackNums=put_tracking_number_here
	$('.trackit').click(function()
	{
		current_element_id = $(this).attr('id');
		order_id = current_element_id.substr(9);
		
		track_num = new_val =  $('#tracking_number--'+order_id).val();
		
		if(track_num)
		{
			var url = "http://wwwapps.ups.com/WebTracking/track?loc=en_US&track.x=Track&trackNums="+track_num;
			var win = window.open(url, '_blank');
  			win.focus();
			//console.log(track_num);
		}
		
		
		
		
	});
	    

    

    
    </script>
    
    
    
  </body>
</html>