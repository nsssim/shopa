<script>
	$("#clctem").bind(
	{
		click: function() 
	  	{
	    	var typed_email = $("#clctem_input").val();
		    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  			var is_valid_email =  re.test(typed_email);
		        
		    if(!is_valid_email)
		    {
				//error
		    	$('#email_footer_error').show().delay(2000).fadeOut(4000);
			}
			else
			{
				//ok
		    	var target_url = '<?php echo($secure_base_url."emaily/add_email_news") ; ?>';
	 				  	 
				var Data2Send = {email:typed_email,<?php echo $this->security->get_csrf_token_name(); ?>:<?php echo '"'.$this->security->get_csrf_hash().'"'; ?>};
				
				$.ajax(
				{
					url : target_url,
					type: "POST",
					cache: false,
					data : Data2Send,
					success: function(data)
					{
						/// good
						if(data == "ok")
						{
							//thank you
							$('#email_footer_ok').show().delay(2000).fadeOut(4000);
						}
						
						/// bad 
						if(data == "error_email")
						{
							$('#email_footer_error').show().delay(2000).fadeOut(4000);
						}
						
						if(data == "error_email_exists")
						{
							// show thanks anyway
							$('#email_footer_ok2').show().delay(2000).fadeOut(4000);
						}
						
						
						
						//var rtrn = JSON && JSON.parse(data) || $.parseJSON(data);
					},
					error: function(jqXHR, textStatus, errorThrown)
					{
						alert(textStatus + "....." +errorThrown);
						
						//$("#cart_notice").show();
						//$("#cart_notice").html('<pre><code class="prettyprint">AJAX Request Failed<br/> textStatus='+textStatus+', errorThrown='+errorThrown+'</code></pre>');
					}
				});
		    	
			}
	    	
	    	
	  	//prevent default
		return false;	
		
	  	}
	});
	
	 $('#clctem_input').keyup(function(e)
	{
		//if enter key is pressed
		if(e.keyCode == 13)
		{
	    	var typed_email = $(this).val();
		    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  			var is_valid_email =  re.test(typed_email);
		        
		    if(!is_valid_email)
		    {
				//error
		    	$('#email_footer_error').show().delay(2000).fadeOut(4000);
			}
			else
			{
				//ok
		    	var target_url = '<?php echo($secure_base_url."emaily/add_email_news") ; ?>';
	 				  	 
				var Data2Send = {email:typed_email,<?php echo $this->security->get_csrf_token_name(); ?>:<?php echo '"'.$this->security->get_csrf_hash().'"'; ?>};
				
				$.ajax(
				{
					url : target_url,
					type: "POST",
					cache: false,
					data : Data2Send,
					success: function(data)
					{
						/// good
						if(data == "ok")
						{
							//thank you
							$('#email_footer_ok').show().delay(2000).fadeOut(4000);
						}
						
						/// bad 
						if(data == "error_email")
						{
							$('#email_footer_error').show().delay(2000).fadeOut(4000);
						}
						
						if(data == "error_email_exists")
						{
							// show thanks anyway
							$('#email_footer_ok2').show().delay(2000).fadeOut(4000);
						}
						
						
						
						//var rtrn = JSON && JSON.parse(data) || $.parseJSON(data);
					},
					error: function(jqXHR, textStatus, errorThrown)
					{
						alert(textStatus + "....." +errorThrown);
						
						//$("#cart_notice").show();
						//$("#cart_notice").html('<pre><code class="prettyprint">AJAX Request Failed<br/> textStatus='+textStatus+', errorThrown='+errorThrown+'</code></pre>');
					}
				});
		    	
			}
	    	
	    	
	  		//prevent default
			return false;
		  
		}
	});
	

</script>