<script src="<?php echo base_url().'assets/templates/eshopper/js/jquery.js';?>"> </script>
	<script src="<?php echo base_url().'assets/templates/eshopper/js/bootstrap.min.js';?>" ></script>
	<script src="<?php echo base_url().'assets/templates/eshopper/js/jquery.scrollUp.min.js';?>" ></script>
    <script src="<?php echo base_url().'assets/templates/eshopper/js/jquery.prettyPhoto.js';?>"> </script>
    <script src="<?php echo base_url().'assets/templates/eshopper/js/main.js';?>" > </script>
    
    <script>
    	// increment the qty and update the price in the row
    	$(".cart_quantity_up").click(function()
		{
			var qty = $(this).next(".cart_quantity_input" ).val();
			if (qty > 1) qty--;
			$(this).next(".cart_quantity_input" ).val(qty);
			
			//$(this).parent().parent().prev().find("p").css( "background", "#f99" );
			var price = $(this).parent().parent().prev().find("p").text();
			price = Number(price);
			//var price = $(this).prev(".cart_price p" ).val();
			//alert(price);
			 $(this).parent().parent().next().find("p").text("$"+(price * qty).toFixed(2));
			$(this).next(".cart_total_price" ).val( price * qty );
				
		});
		
		// decrement the qty and update the price in the row
		$(".cart_quantity_down").click(function()
		{
			var qty = $(this).prev(".cart_quantity_input" ).val();
			 qty++;
			$(this).prev(".cart_quantity_input" ).val(qty);
			//$(this).parent().parent().prev().find("p").css( "background", "#41f81b" );
			var price = $(this).parent().parent().prev().find("p").text();
			price = Number(price);
			//var price = $(this).prev(".cart_price p" ).val();
			//alert(price);
			 //$(this).parent().parent().next().find("p").css( "background", "#aa5ab8" );
			 $(this).parent().parent().next().find("p").text("$"+(price * qty).toFixed(2));
			$(this).next(".cart_total_price" ).val( price * qty );
				
		});
		
		//delete product = delete row + remove productfrom the cart in the session 
		$(".cart_quantity_delete").click(function()
		{ 
			$(this).parents(".crow").css( "background", "#ffc4c4" );
			$(this).parents(".crow").fadeOut( 1000 , function() { /*fade complete.*/  });
			//$(this).remove();
			
			///////////// ajax cart update below
			
					 //the target (cart controller / add method)
					 var target_url = '<?php echo(base_url()."cart/remove") ; ?>';
				  	 				  	 
				  	// get the product id from the DOM
					var row_id = $(this).parents(".crow").attr('id');
					//alert(row_id);
				  	//var qty = 1;
				  	// must work on product size and color //////////////////////////////
					var ProductData = {r_id:row_id,quantity:0};
					
					$.ajax(
					{
						url : target_url,
						type: "POST",
						cache: false,
						data : ProductData,
						success: function(data)
						{
							//update the cart icon
							cart = JSON && JSON.parse(data) || $.parseJSON(data);
							//alert(cart.num_of_items);
							var num_items = "( "+ cart.num_of_items + " )";
							$("#cart_num").html(num_items);
							//var num_items = $('.crow').length-1;
							//$("#cart_num").text(num_items);
							
							//alert('product deleted!\n' + data);
							//cart = JSON && JSON.parse(data) || $.parseJSON(data);
							//alert('there are \n' + cart.num_of_items + ' items in your cart');
						},
						error: function(jqXHR, textStatus, errorThrown)
						{
							//  to do
							//$("#cart_notice").show();
							//$("#cart_notice").html('<pre><code class="prettyprint">AJAX Request Failed<br/> textStatus='+textStatus+', errorThrown='+errorThrown+'</code></pre>');
						}
					});
			//////////// end ajax cart update
			
			// prevent default
			return false; 
		});
		
		
    </script>


<?php 
//update the login menu and cart icon 

//show the nmber of items in the cart
if ($this->cart->total_items() > 0)
{?>
	<script>
	 $("#cart_num").html('( <?php echo($this->cart->total_items());?> )');
	 
	</script> 
<?php 	 
}
?>

<?php 
//if the user is logged hide the login btn
if ($this->session->userdata('user_id'))
{?>
	 <script>
	 $("#login_btn").hide();
	 $("#account_btn").html('<i class="fa fa-user"></i>'+ ' <?php echo($this->session->userdata('usrname'));?>'  );
	 </script> 
<?php 	 
}
//if the user is not logged hide the loginout btn
else
{
	?><script>
	$("#logout_btn").hide(); 
	</script>
<?php 	
}
?>   


</body>
</html>