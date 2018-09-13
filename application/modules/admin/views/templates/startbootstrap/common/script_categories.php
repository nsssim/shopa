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
    
    <!-- bootbox 4.4.0 -->
    <script src='<?php echo($template_path."bootstrap/js/bootbox.min.js")?>' type="text/javascript"></script>
    
    <!--<script src='https://github.com/makeusabrew/bootbox/releases/download/v4.4.0/bootbox.min.js' type="text/javascript"></script>-->

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
   <!-- <script src='<?php echo($template_path."dist/js/pages/dashboard2.js")?>' type="text/javascript"></script>-->

    <!-- AdminLTE for demo purposes -->
   <!-- <script src='<?php echo($template_path."dist/js/demo.js")?>' type="text/javascript"></script>-->
    
    
    
    <script>
    	
        
		
	$(document).ready(function(){
		
		
    /////////////////////////////////////// prevent category links to behave like links if no subcategories  ////////////////////////////
    $('.catline').click(function(){
    	var reference = ($(this).attr('href'));
    	if(reference == '#')
    	{
    		return false;
		}
    });
    
    /////////////////////////////////////// highlight the inputs when hover a category name  ////////////////////////////
	$( ".catline" ).bind({
	  mouseenter: function() 
	  {
	    var cat_id = ($(this).attr('id')).slice(6);
		$('#shipfact_'+cat_id).css('background-color','#FDFFDA');
		$('#promcode_'+cat_id).css('background-color','#FDFFDA');
		$('#dismoney_'+cat_id).css('background-color','#FDFFDA');
		$('#discperc_'+cat_id).css('background-color','#FDFFDA');
		$('#servifee_'+cat_id).css('background-color','#FDFFDA');
	  },
	  mouseleave: function() 
	  {
	    var cat_id = ($(this).attr('id')).slice(6);
		$('#shipfact_'+cat_id).css('background-color','#FFFFFF');
		$('#promcode_'+cat_id).css('background-color','#FFFFFF');
		$('#dismoney_'+cat_id).css('background-color','#FFFFFF');
		$('#discperc_'+cat_id).css('background-color','#FFFFFF');
		$('#servifee_'+cat_id).css('background-color','#FFFFFF');
	  }
	});


    /////////////////////////////////////// highlight the category name when input gets focusin / focusout   ////////////////////////////
    
	$( ".ship_fact, .cat_pcod, .disc_mon, .disc_per, .cat_srvfee" ).focusin(
	function()
	{
		var cat_id = ($(this).attr('id')).slice(9);
		$('#catid_'+cat_id).css('color','red');
		//alert(cat_id);
	});
	
	$( ".ship_fact, .cat_pcod, .disc_mon, .disc_per, .cat_srvfee" ).focusout(
	function()
	{
		var cat_id = ($(this).attr('id')).slice(9);
		$('#catid_'+cat_id).css('color','black');
		//alert(cat_id);
	});
	
    /////////////////////////////////////// check/unckeck the  status checkbox    ////////////////////////////
    $('.cat_status').click(function()
    {
    	var cat_id = ($(this).attr('id')).slice(7);
    	console.info(cat_id);
    	
    	var c = this.checked;
    	
		bootbox.confirm("All the subcategories (if any) of this Category will inherit the same STATUS.<br> Are you sure you want to continue doing this?", function(result) {
	  	if(result)
	  	{ 
	  		//ok clicked
	  	if (c)
	  		//if checked
	    	{
				//let's ajax
				var target_url = '<?php echo(base_url()."categories/set_category_tree_status") ; ?>'; 
				var data_send = {node_cat_id:cat_id,node_status:1};
				
				$.ajax(
				{
					url : target_url,
					data: data_send,
					type: "GET",
					success: function(return_data)
					{
						//check children 
	    				$('#'+cat_id).find(".cat_status").prop('checked', true);
					},
					error: function(jqXHR, textStatus, errorThrown)
					{
						console.log('textStatus='+textStatus);
						console.log('errorThrown='+errorThrown);
					}
				});		
				
			}
			else
			{
				//let's ajax
				var target_url = '<?php echo(base_url()."categories/set_category_tree_status") ; ?>'; 
				var data_send = {node_cat_id:cat_id,node_status:0};
				
				$.ajax(
				{
					url : target_url,
					data: data_send,
					type: "GET",
					success: function(return_data)
					{
						//uncheck children
	    				$('#'+cat_id).find(".cat_status").prop('checked', false); 
					},
					error: function(jqXHR, textStatus, errorThrown)
					{
						console.log('textStatus='+textStatus);
						console.log('errorThrown='+errorThrown);
					}
				});		
			}
	  	}
	  	//if Cancel clicked
	  	else
	  	{
	  		if (c)
	  		//if checked
	    	{
	    		//uncheck
	    		$('#status_'+cat_id).prop('checked', false);
	    	}
	  		//if uncheked
	    	else
	    	{
	    		//check it
	    		$('#status_'+cat_id).prop('checked', true);
			}
			
		}
		
		}); 
    	
    });
    
    /////////////////////////////////////// [+] or [-]   ////////////////////////////
    $('.catline').click(function(){
    	var cat_id = ($(this).attr('id')).slice(6);
    	//alert(cat_id); 
    	var div_expanded = $('#'+cat_id).attr('aria-expanded');
    	if(div_expanded == 'true')
    	{
			//console.info('div unvisible');
			$('#sign_'+cat_id).html('[+]');
		}
		else
		{
			//console.info('div expanded');
			$('#sign_'+cat_id).html('[-]');
		}
    	
    });
    
    /////////////////////////////////////// center message box     ////////////////////////////
    $("body").on("shown.bs.modal", ".modal", function() 
    {
	    $(this).find('div.modal-dialog').css({
	        'margin-top': function () {
	            var modal_height = $('.modal-dialog').first().height();
	            var window_height = $(window).height();
	            return ((window_height/2) - (modal_height/2));
	        }
	    });
	});
    /////////////////////////////////////// save shipping factor for later use (mem)   ////////////////////////////
    //global variable
    var temp_ship_fact = [];
    $( ".ship_fact" ).each(function( index ) 
    {
    	var cat_id = ($(this).attr('id')).slice(9);
    	temp_ship_fact[cat_id] = $('#shipfact_'+cat_id).val();
    });
    	
	
    /////////////////////////////////////// shipping factor    ////////////////////////////
    $('.ship_fact').keyup(function(e)
	{
		//if enter key is pressed
		if(e.keyCode == 13)
		{
		  	var cat_id = ($(this).attr('id')).slice(9);
		  	shipping_factor = $(this).val();
		  	bootbox.confirm("All the subcategories (if any) of this Category will inherit the same SHIPPING FACTOR.<br> Are you sure you want to continue doing this?", function(result) 
		  	{
				if(result)
				//ok
				{
			  		var is_a_number =  check_is_number(shipping_factor);
			  		if(is_a_number)
			  		{
			  			set_cat_and_subcats_shipping_fee(cat_id,shipping_factor);
			  			temp_ship_fact[cat_id] = shipping_factor;
					}
			  		else
			  		{
			  			//alert('value not allowed!');
			  			$('#shipfact_'+cat_id).val(temp_ship_fact[cat_id]);
			  			bootbox.alert("value not allowed, shipping factor must be a number");
			  			//$('#shipfact_'+cat_id).focus(); //does not work ??
					}
			  	}
			  	else
			  	//cancel
			  	{
			  		console.log('shipping factor : nothing happend');
			  	}
		  	
		  	});
		  
		}
	});
	
	function set_cat_and_subcats_shipping_fee(c_id,sf)
	{
		
		//let's ajax 
		var target_url = '<?php echo(base_url()."categories/set_category_tree_shipping_factor") ; ?>'; 
		var data_send = {node_cat_id:c_id, shipping_factor:sf};
		
		$.ajax(
		{
			url : target_url,
			data: data_send,
			type: "GET",
			success: function(return_data)
			{
				//write shipping factor into children
	    		$('#'+c_id).find(".ship_fact").val(sf); 
			},
			error: function(jqXHR, textStatus, errorThrown)
			{
				console.log('textStatus='+textStatus);
				console.log('errorThrown='+errorThrown);
			}
		});	
		
	}
	
    ///////////////////////////////////////  promotion code   ////////////////////////////
    $('.cat_pcod').keyup(function(e)
	{
		//if enter key is pressed
		if(e.keyCode == 13)
		{
		  	var cat_id = ($(this).attr('id')).slice(9);
		  	//alert(cat_id);
		  	promo_code = $(this).val();
		  	promo_code = promo_code.toUpperCase();
		  	$(this).val(promo_code) ;
		  	bootbox.confirm("All the subcategories (if any) of this Category will inherit the same PROMOTION CODE.<br> Are you sure you want to continue doing this?", function(result) 
		  	{
				if(result)
				//ok
				{
			  		var regex_check =  check_promo_code_value(promo_code);
			  		if(regex_check || promo_code=="")
			  		{
			  			set_cat_and_subcats_promo_code(cat_id,promo_code);
					}
			  		else
			  		{
			  			//alert('value not allowed! only alphanumeric characters can be used and those special characters _+-%@$');
			  			bootbox.alert("value not allowed! only alphanumeric characters can be used and the following characters <br> _+-%@$");
					}
			  	}
			  	else
			  	//cancel
			  	{
			  		console.log('promo code : nothing happend');
			  	}
		  	
		  	});
		  
		}
	});
	
	function check_promo_code_value(pcv)
	{
		var re = /[ 0-9a-zA-Z_+\-%@$]+/; //alphanumeric + some special characters
		var m;
		 
		if ((m = re.exec(pcv)) !== null) 
		{
		    if (m.index === re.lastIndex) {
		        re.lastIndex++;
		    }
		    // View your result using the m-variable.
		    // eg m[0] etc.
		}
		// console.info(m);
		if(m)
		{
			if(pcv == m[0])
			return true ; 
			else
			return false ;
		}
		else
		{
			return false;
		}
	}
	
	function set_cat_and_subcats_promo_code(cat_id,promo_code)
	{
		//let's ajax 
		var target_url = '<?php echo(base_url()."categories/set_category_tree_promotion_code") ; ?>'; 
		var data_send = {node_cat_id:cat_id, promotion_code:promo_code};
		
		$.ajax(
		{
			url : target_url,
			data: data_send,
			type: "GET",
			success: function(return_data)
			{
				//write promotion codes to children
	    		$('#'+cat_id).find(".cat_pcod").val(promo_code);
			},
			error: function(jqXHR, textStatus, errorThrown)
			{
				console.log('textStatus='+textStatus);
				console.log('errorThrown='+errorThrown);
			}
		});	
		
	}
    /////////////////////////////////////// avoid discount conflict  + set discount $ + set discount %    ////////////////////////////
    	
    $('.disc_mon').keyup(function(e){
    	
    	if(e.keyCode == 13)
		{
	    	var cat_id = ($(this).attr('id')).slice(9);
	    	//alert(cat_id);
	    	
	    	var discount_percent_val =  $("#discperc_"+cat_id).val();
	    	
	    	if(discount_percent_val.length > 0)
	    	{
				//alert('discount conflict, remove discount % for this category to be able to to edit this value');
				bootbox.alert("discount conflict, remove discount % for this category to be able to to edit this value");
	    		$(this).val('');
			}
			else
			{
				var discount_money_value =$(this).val();
				var is_a_number = check_is_number_or_dotted_number(discount_money_value)
				if(is_a_number)
				{
					bootbox.confirm('All the subcategories (if any) of this Category will inherit the same DISCOUNT MONEY <br> <span style="color:red"> All DISCOUNT % values will be lost </span> <br> Are you sure you want to continue doing this?', function(result) 
					{
						if(result)
						//ok
						{
							set_cat_and_subcats_discount_money(cat_id,discount_money_value);
					  	}
					  	else
					  	//cancel
					  	{
					  		console.log('discount money  : nothing happend');
					  	}
					});
				}
				else
				{
					bootbox.alert("value must be a valid number");
				}
				
			}
		}
    });
   
    $('.disc_per').keyup(function(e)
    {
    	if(e.keyCode == 13)
		{
	    	var cat_id = ($(this).attr('id')).slice(9);
	    	//alert(cat_id);
	    	
	    	var discount_money_val =  $("#dismoney_"+cat_id).val();
	    	
			
		    if(discount_money_val.length > 0)
		    {
				//alert('discount conflict, remove discount $ for this category to be able to edit this value');
				bootbox.alert("discount conflict, remove discount $ for this category to be able to edit this value");
		    	$(this).val('');
			}
			else
			{
				var discount_percentage_value = $(this).val();
				var is_a_number = check_is_number_or_dotted_number(discount_percentage_value); // 2 or 3.123 
				
				if(is_a_number && (discount_percentage_value < 1) )
				{
					bootbox.confirm('All the subcategories (if any) of this Category will inherit the same DISCOUNT PERCENTAGE <br> <span style="color:red"> All DISCOUNT $ values will be lost </span> <br> Are you sure you want to continue doing this?', function(result) 
					{
						if(result)
						//ok
						{
							set_cat_and_subcats_discount_percentage(cat_id,discount_percentage_value);
					  	}
					  	else
					  	//cancel
					  	{
					  		console.log('discount percent  : nothing happend');
					  	}
					
					});
				}
				else
				{
					bootbox.alert("value must be between 0 and 1 (example 0.1 = %10)");
				}
			}
			
			
		}
    });
    
    
    //~~~set discount money    
    function set_cat_and_subcats_discount_money(cat_id,discount_money_value)
    {
		//let's ajax
		var target_url = '<?php echo(base_url()."categories/set_category_tree_discount_money") ; ?>'; 
		var data_send = {node_cat_id:cat_id,discount_money:discount_money_value};
		
		$.ajax(
		{
			url : target_url,
			data: data_send,
			type: "GET",
			success: function(return_data)
			{
				//write discount money into discount $ children and erase discount % children (as it is already erased on db side)
	    		$('#'+cat_id).find(".disc_mon").val(discount_money_value); 
	    		$('#'+cat_id).find(".disc_per").val(''); 
			},
			error: function(jqXHR, textStatus, errorThrown)
			{
				console.log('textStatus='+textStatus);
				console.log('errorThrown='+errorThrown);
			}
		});	
		
	}
	
    //~~~set discount percentage    
	function set_cat_and_subcats_discount_percentage(cat_id,discount_percentage_value)
	{
		//let's ajax
		var target_url = '<?php echo(base_url()."categories/set_category_tree_discount_percentage") ; ?>'; 
		var data_send = {node_cat_id:cat_id,discount_percentage:discount_percentage_value};
		
		$.ajax(
		{
			url : target_url,
			data: data_send,
			type: "GET",
			success: function(return_data)
			{
				//write discount percentage into discount % children and erase discount $ children (as it is already erased on db side)
	    		$('#'+cat_id).find(".disc_per").val(discount_percentage_value); 
	    		$('#'+cat_id).find(".disc_mon").val(''); 
			},
			error: function(jqXHR, textStatus, errorThrown)
			{
				console.log('textStatus='+textStatus);
				console.log('errorThrown='+errorThrown);
			}
		});	
	}
	
	//~~~check if is a number
	function check_is_number(n)
	{
		var re = /[0-9]+/; //number
		var m;
		 
		if ((m = re.exec(n)) !== null) 
		{
		    if (m.index === re.lastIndex) {
		        re.lastIndex++;
		    }
		    // View your result using the m-variable.
		    // eg m[0] etc.
		}
		// console.info(m);
		if(m)
		{
			if(n == m[0])
			return true ; 
			else
			return false ;
		}
		else
		{
			return false;
		}
	}
	
	//~~~check if is a number ot a dotted number 
	function check_is_number_or_dotted_number(n)
	{
		var re = /\d*\.?\d*/; // 1 or 1.54564
		var m;
		 
		if ((m = re.exec(n)) !== null) 
		{
		    if (m.index === re.lastIndex) {
		        re.lastIndex++;
		    }
		    // View your result using the m-variable.
		    // eg m[0] etc.
		}
		// console.info(m);
		if(m)
		{
			if(n == m[0])
			return true ; 
			else
			return false ;
		}
		else
		{
			return false;
		}
	}
	
    
    ///////////////////////////////////////  service fee    ////////////////////////////
    $('.cat_srvfee').click(function()
    {
    	var cat_id = ($(this).attr('id')).slice(9);
    	console.info(cat_id);
    	
    	var c = this.checked;
    	
		bootbox.confirm("All the subcategories (if any) of this Category will inherit the same SERVICE FEE STATUS.<br> Are you sure you want to continue doing this?", function(result) {
	  	if(result)
	  	{ 
	  		//ok clicked
	  	if (c)
	  		//if checked
	    	{
				//let's ajax
				var target_url = '<?php echo(base_url()."categories/set_category_tree_service_fee") ; ?>'; 
				var data_send = {node_cat_id:cat_id,node_status:1};
				
				$.ajax(
				{
					url : target_url,
					data: data_send,
					type: "GET",
					success: function(return_data)
					{
						//check children 
	    				$('#'+cat_id).find(".cat_srvfee").prop('checked', true);
					},
					error: function(jqXHR, textStatus, errorThrown)
					{
						console.log('textStatus='+textStatus);
						console.log('errorThrown='+errorThrown);
					}
				});		
				
			}
			else
			{
				//let's ajax
				var target_url = '<?php echo(base_url()."categories/set_category_tree_service_fee") ; ?>'; 
				var data_send = {node_cat_id:cat_id,node_status:0};
				
				$.ajax(
				{
					url : target_url,
					data: data_send,
					type: "GET",
					success: function(return_data)
					{
						//uncheck children
	    				$('#'+cat_id).find(".cat_srvfee").prop('checked', false); 
					},
					error: function(jqXHR, textStatus, errorThrown)
					{
						console.log('textStatus='+textStatus);
						console.log('errorThrown='+errorThrown);
					}
				});		
			}
	  	}
	  	//if Cancel clicked
	  	else
	  	{
	  		if (c)
	  		//if checked
	    	{
	    		//uncheck
	    		$('#servifee_'+cat_id).prop('checked', false);
	    	}
	  		//if uncheked
	    	else
	    	{
	    		//check it
	    		$('#servifee_'+cat_id).prop('checked', true);
			}
			
		}
		
		}); 
    	
    });
    
    /////////////////////////////////////// flush cache  ////////////////////////////
    
    $('#flush_cache').click(function(){
    	//let's ajax
		var target_url = '<?php echo(base_url()."cachy/del_k_like") ; ?>'; 
		
		$.ajax(
		{
			url : target_url,
			type: "GET",
			success: function(return_data)
			{
				//write discount percentage into discount % children and erase discount $ children (as it is already erased on db side)
				if(return_data == 'Could not connect to Redis server')
					alert("Could not connect cache server");
				else
				alert('all done');
			},
			error: function(jqXHR, textStatus, errorThrown)
			{
				console.log('textStatus='+textStatus);
				console.log('errorThrown='+errorThrown);
			}
		});	
    });
    
    /////////////////////////////////////// do something else   ////////////////////////////
	
	
	
	
	
	
	}); // end document ready 

    </script>
    
  </body>
</html>