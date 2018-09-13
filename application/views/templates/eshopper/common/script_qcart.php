<script>
//~~~~~~~~~~~~~~~~~ cart_quickview code below ~~~~~~~~~~~~~~~~~~~
    ////  cart x button is clicked  ///////////////////////////////////
	$('.header_top').on('click', '#xclose', function() {
		
		$("#cart_quickview").hide();	
	});
		
	
	
    
    ////  cart is hovered button is clicked  ///////////////////////////////////
	$( "#cart" ).bind(
	{
		  mouseenter: function() 
		  {
		    	//console.log("focus in " );
		    	clearTimeout($("#cart_quickview").data('timeoutId'));
		    	if ($('#cart_quickview').is(":hidden"))
		    	{
		    		$("#cart_quickview").fadeIn();
				} 
				else
				{
					$("#cart_quickview").show();
				}
		  },
		  mouseleave: function() 
		  {
		    timeoutId = setTimeout(function()
		   	 //ok 650 ms passed now execute this block
		   	 {
            	//if the mouse  hovers
            	if ($('#cart:hover').length != 0 || $('#cart_quickview:hover').length != 0 ) {
					    $("#cart_quickview").show();
					}
					else
					{
            			$("#cart_quickview").fadeOut();
					}
        	 },
        	  650
        	 );
        	 
		  }
	});
	
	 ////  when mouse enters or leave the cart_quickview box   ///////////////////////////////////
	 
	$("#cart_quickview").bind(
	{
		  mouseenter: function() 
		  {
		    	clearTimeout($("#cart_quickview").data('timeoutId'));
		    	//console.log("focus in " );
		    	$(this).show();
		  },
		  mouseleave: function() 
		  {
		   	 timeoutId = setTimeout(function()
		   	 //ok 650 ms passed now execute this block
		   	 {
            	//if the mouse  hovers
            	if ($('#cart:hover').length != 0 || $('#cart_quickview:hover').length != 0 ) {
					    $("#cart_quickview").show();
					}
					else
					{
            			$("#cart_quickview").fadeOut();
					}
        	 },
        	  650
        	 );
		   	
		  }
	});
	
	////  when click on removeitem    ///////////////////////////////////
	
	//$(".qrmv").click(function(){
	$("#cart_quickview").on("click", ".qrmv", function() {
		
		 
		var qrmv_id = $(this).attr('id');
    	var row_id = qrmv_id.slice(6);
    	//$("#qv_"+row_id).fadeOut();
    	//$("#ftr_"+row_id).fadeOut();
		
		$('html, body').css("cursor", "wait");
		$('#'+qrmv_id).hide();
    	
    	//let's ajax
    	var target_url = '<?php echo(base_url()."carta/remove") ; ?>';
 				  	 
		var Data2Send = {r_id:row_id,quantity:0,<?php echo $this->security->get_csrf_token_name(); ?>:<?php echo '"'.$this->security->get_csrf_hash().'"'; ?>};
		
		$.ajax(
		{
			url : target_url,
			type: "POST",
			cache: false,
			data : Data2Send,
			success: function(data)
			{
				 $('html, body').css("cursor", "auto");
				//update the cart icon
				cart = JSON && JSON.parse(data) || $.parseJSON(data);
				//alert(cart.num_of_items);
				var num_items = "( "+ cart.num_of_items + " )";
				$("#cart_num").html(num_items);
				
				$("#cart_quickview").empty();
				$("#cart_quickview").append(cart.cart_qview);
			},
			error: function(jqXHR, textStatus, errorThrown)
			{
				$('html, body').css("cursor", "auto");
				//  to do
				//$("#cart_notice").show();
				//$("#cart_notice").html('<pre><code class="prettyprint">AJAX Request Failed<br/> textStatus='+textStatus+', errorThrown='+errorThrown+'</code></pre>');
			}
		});
		//////////// end ajax cart update
  	
  		//prevent default
		return false;
	}); 
	
	$(".qrmvdd").bind(
	{
		  click: function() 
		  	{
		    	var qrmv_id = $(this).attr('id');
		    	var row_id = qrmv_id.slice(6);
		    	$("#qv_"+row_id).fadeOut();
		    	$("#ftr_"+row_id).fadeOut();
		    	
		    	//let's ajax
		    	var target_url = '<?php echo(base_url()."carta/remove") ; ?>';
		 				  	 
				var Data2Send = {r_id:row_id,quantity:0,<?php echo $this->security->get_csrf_token_name(); ?>:<?php echo '"'.$this->security->get_csrf_hash().'"'; ?>};
				
				$.ajax(
				{
					url : target_url,
					type: "POST",
					cache: false,
					data : Data2Send,
					success: function(data)
					{
						//update the cart icon
						cart = JSON && JSON.parse(data) || $.parseJSON(data);
						//alert(cart.num_of_items);
						var num_items = "( "+ cart.num_of_items + " )";
						$("#cart_num").html(num_items);
						
						//$("#cart_quickview").empty();
						//$("#cart_quickview").append(cart.cart_qview);
					},
					error: function(jqXHR, textStatus, errorThrown)
					{
						//  to do
						//$("#cart_notice").show();
						//$("#cart_notice").html('<pre><code class="prettyprint">AJAX Request Failed<br/> textStatus='+textStatus+', errorThrown='+errorThrown+'</code></pre>');
					}
				});
				//////////// end ajax cart update
		  	
		  	//prevent default
			return false;	
			
		  	}
	});
		
	//~~~~~~~~~~~~~~~~~ end cart_quickview code ~~~~~~~~~~~~~~~~~~~ 
</script>