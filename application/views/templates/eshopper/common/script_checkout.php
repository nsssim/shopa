<?php 
$ssl_port_num = ":".SSL_PORT;  // :443 is the default
$base_url_str = base_url(); 
$secure_base_url = str_replace("http","https",$base_url_str );
$secure_base_url = str_replace(".com",".com$ssl_port_num",$secure_base_url );
?>

<!--____________________________________/ javascript \____________________________________-->   
	
	
    <script src="<?php echo $secure_base_url.'assets/templates/eshopper/js/jquery.js';?>"> </script>
	<script src="<?php echo $secure_base_url.'assets/templates/eshopper/js/bootstrap.min.js';?>" ></script>
	<script src="<?php echo $secure_base_url.'assets/templates/eshopper/js/jquery.scrollUp.min.js';?>" ></script>
	<script src="<?php echo $secure_base_url.'assets/templates/eshopper/js/price-range.js';?>"> </script>
    <script src="<?php echo $secure_base_url.'assets/templates/eshopper/js/jquery.prettyPhoto.js';?>"> </script>
    <script src="<?php echo $secure_base_url.'assets/templates/eshopper/js/main.js';?>" > </script>
    <script src="<?php echo $secure_base_url.'assets/templates/eshopper/js/jquery-ui.js';?>" > </script>
    <!-- <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>-->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>

<script type="text/javascript" src="<?php echo $secure_base_url.'assets/templates/eshopper/js/thumbnailviewer2.js';?>"></script>


<?php echo '<script>var customer_take_care_of_customs_cookie 	 = '.$customer_take_care_of_customs_cookie. ';</script>'; ?>
<?php echo '<script>var sa_currency 							 = "'.$currency. '";</script>'; ?>
<?php echo '<script>var sa_rate 							 	 = '.$rate. ';</script>'; ?>
<?php echo '<script>var msg_promo_ok 							 = "'.$words['msg_promo_ok']. '";</script>'; ?>
<?php echo '<script>var msg_promo_bad 							 = "'.$words['msg_promo_bad']. '";</script>'; ?>

<script>

/////

$(".delivery_address").click(function(e)
{
	var address_id = $(this).attr('id');
	var line1 = $('#'+address_id+'-line_1').text();
	var line2 = $('#'+address_id+'-line_2').text();
	var line3 = $('#'+address_id+'-line_3').text();
	var city =  $('#'+address_id+'-city').text();
	var country_province =  $('#'+address_id+'-country_province').text();
	var zip_code =  $('#'+address_id+'-zip_code').text();
	var coutry =  $('#'+address_id+'-coutry').text();
	
	//alert(address_id+"-"+line1+"-"+line2+"-"+line3+"-"+city+"-"+country_province+"-"+zip_code+"-"+coutry);
	
	$('#shipping_address_id').val(address_id);
	$('#address1').val(line1);
	$('#address2').val(line2);
	$('#address3').val(line3);
	$('#city').val(city);
	$('#region').val(country_province);
	$('#zipcode').val(zip_code);
	$('#country').val(coutry);
	
}
);


$("#cart_notice").hide();

//demo user 
$( "#x, .coverbox").click(function(e) {
	//prevent other selectors than #x and .coverbox to get selected
	if( e.target !== this ) 
    return;
  	$( ".coverbox" ).fadeOut( 800 , function() {
    // Animation complete.
  });
});



/// click on flag 
$(".country_flag").click(function()
	{
		
		 // get the language id from the html
		 var lng_id = $(".country_flag").attr("id");
		 
		 //the target (language controller / change_language method)
		 var target_url = '<?php echo(base_url()."language/change_language/") ; ?>' + lng_id;
	  	 
		$.ajax(
		{
			url : target_url,
			type: "POST",
			success: function(return_data)
			{
				console.log(return_data);
				
				// refresh page
				//location.reload(); 
			},
			error: function(jqXHR, textStatus, errorThrown)
			{
				console.log('textStatus='+textStatus);
				console.log('errorThrown='+errorThrown);
			}
		});
		
		
		
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

<script>


// to escape special characters see  http://stackoverflow.com/a/9310752/1636522
RegExp.escape = function (text) {
    return text.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, '\\$&');
};
</script>



<?php // if ($this->cart->total_items() > 0): ?>
<script>
$(document).ready(function()
{
	Number.prototype.formatMoney = function(decPlaces, thouSeparator, decSeparator) 
	{
    	var n = this,
    	decPlaces = isNaN(decPlaces = Math.abs(decPlaces)) ? 2 : decPlaces,
    	decSeparator = decSeparator == undefined ? "." : decSeparator,
    	thouSeparator = thouSeparator == undefined ? "," : thouSeparator,
    	sign = n < 0 ? "-" : "",
    	i = parseInt(n = Math.abs(+n || 0).toFixed(decPlaces)) + "",
    	j = (j = i.length) > 3 ? j % 3 : 0;
    	return sign + (j ? i.substr(0, j) + thouSeparator : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thouSeparator) + (decPlaces ? decSeparator + Math.abs(n - i).toFixed(decPlaces).slice(2) : "");
	};
		
	// for the tool tip on the check box 
    $('[data-toggle="tooltip"]').tooltip();
	
	//hide the billing address container if the checkbox is checked

	var flag_same_as_shipping_address_checked = 0 ;
	
	// save billing form data into temporary variables to restore it if customer changes his mind 
	var mem_billing_address1 = $('#billing_address1').val();
	var mem_billing_address2 = $('#billing_address2').val();
	var mem_billing_address3 = $('#billing_address3').val();
	var mem_billing_city 	 = $('#billing_city').val();
	var mem_billing_region   = $('#billing_region').val();
	var mem_billing_zipcode  = $('#billing_zipcode').val();
	var mem_billing_country  = $('#billing_country').val(); 
	
	$('#same_as_shipping').click(function() 
	{
		if(document.getElementById('same_as_shipping').checked) 
		{
			flag_same_as_shipping_address_checked = 1;
			
			// copy shipping form 
			var address1 = $('#address1').val();
			var address2 = $('#address2').val();
			var address3 = $('#address3').val();
			var city 	 = $('#city').val();
			var region 	 = $('#region').val();
			var zipcode  = $('#zipcode').val();
			var country  = $('#country').val();
			
			//alert(address1+"..."+address2+"..."+address3+"..."+city+"..."+region+"..."+zipcode+"..."+country);
			
			// paste billing form
			$('#billing_address1').val(address1);
			$('#billing_address2').val(address2);
			$('#billing_address3').val(address3);
			$('#billing_city').val(city);
			$('#billing_region').val(region);
			$('#billing_zipcode').val(zipcode);
			$('#billing_country').val(country);
			
			$('#billing_address').fadeOut(2000);
		} 
		else 
		{
		    $('#billing_address').fadeIn();
		    
		    //restore initial value if customer checked "same as shipping address" and then unchecked it 
		    if(flag_same_as_shipping_address_checked == 1)
		    {
				$('#billing_address1').val(mem_billing_address1);
				$('#billing_address2').val(mem_billing_address2);
				$('#billing_address3').val(mem_billing_address3);
				$('#billing_city').val(mem_billing_city);
				$('#billing_region').val(mem_billing_region);
				$('#billing_zipcode').val(mem_billing_zipcode);
				$('#billing_country').val(mem_billing_country);
			}
		    
		}
	});
		
		
	/*$('#same_as_shipping').click(function() {
	 //alert(1);
	 $('#billing_address').toggle('blind');
	});*/
	
	//fill the shipping address input with 0 if no id was there before 
	var tmp_shipping_address_id = $('#shipping_address_id').val();
	if(!tmp_shipping_address_id)
	{
		$('#shipping_address_id').val(0);
	}

	//fill the billing address input with 0 if no id was there before 
	var tmp_billing_address_id = $('#billing_address_id').val();
	if(!tmp_billing_address_id)
	{
		$('#billing_address_id').val(0);
	}
	
	//check the radio button on page load 
	var tmp_shipping_address_id = $('#shipping_address_id').val();
	if(tmp_shipping_address_id)
	{
		$('input#'+tmp_shipping_address_id).prop('checked', true);
	}
	
	
	
	//apply promotion code here
	$("#promo_code_btn").click(apply_promo_code);
	$('#promo_code_field').keyup(function(e)
	{
		//if enter key is pressed
		if(e.keyCode == 13)
		{
		  apply_promo_code();
		}
	});
	
	//function called by button and by "enter key"
	function apply_promo_code()
	{
		var promotion_code = $("#promo_code_field").val();
	
		if(promotion_code)
		{
			//show the spinning wheel while processing
			//$("#loadingDiv").css("display", "block");
			//hide the message box
			//$("#message_box").css("background-color", "#FFE6E6");
			$("#message_box").hide();
			
			var DataPromotion = {promotion_code_value:promotion_code};
			//
			//var target_url = '<?php echo(base_url()."carta/apply_promo_code") ; ?>';
			var target_url = '<?php echo($secure_base_url."checkout/apply_promo_code") ; ?>';
			//var target_url = 'https://www.local.com:4433/usa/checkout/apply_promo_code'; //todo //// delete this later in production 
			$.ajax
			(
				{
					url : target_url,
					type: "GET",
					cache: false,
					data:DataPromotion,
					success: function(data)
					{
						//parse json data
						data = JSON && JSON.parse(data) || $.parseJSON(data);
						
						//$("#loadingDiv").css("display", "none");
						if(data == "empty")
						{
							// no promotion code was entred 
						}
						if(data == "0")
						{
							// no valid code entered
							$("#message_box").show();
							//$("#message_box").html("<strong>code not valid</storng>");
							$("#message_box").html('<div class="alert alert-danger" role="alert">'+msg_promo_bad+'</div>');
							
							//alert("not_valid");
						}
						if(data == "1")
						{
							//alert(1);
							// code applied
							// $('[data-popup="pop_up_box"]').fadeIn(350);
							//$("#message_box").css("background-color", "#DCFFDC");
							$("#message_box").show();
							//$("#message_box").html('<span class="glyphicon glyphicon-ok"> </span> Promotion Code Applied! ');
							$("#message_box").html('<div class="alert alert-success" role="alert">'+msg_promo_ok+'</div>');
							
							$("#discount_total_line").show();
							
							//ajax call to update the prices
							//lets ajax 
						    var target_url = '<?php echo(base_url()."carta/ajax_calc") ; ?>'; // the script where you handle the form input.
							var form_data = {bool_customer_take_care_of_customs:customer_take_care_of_customs_cookie};
							
							$.ajax(
							{
								url : target_url,
								data: form_data,
								type: "GET",
								success: function(return_data)
								{
									if(customer_take_care_of_customs_cookie == 1){$('#custom_fee_line').fadeOut(200);/*console.log('customer will handle customs');*/}else{$('#custom_fee_line').fadeIn(200);/*console.log('shopamerika will handle customs');*/}
									prices = JSON && JSON.parse(return_data) || $.parseJSON(return_data);
									//prices.order_sub_total = 1457;
									$('#order_sub_total').html(sa_currency+(prices.order_sub_total).formatMoney(2,',','.'));
									$('#shipping_fee').html(sa_currency+(prices.shipping_and_handling_fee).formatMoney(2,',','.'));
									
									if(prices.discount_total > 0)
									{
										$('#discount_total_line').fadeIn();
										$('#total_discount').html(sa_currency+(prices.discount_total).formatMoney(2,',','.'));
									}
									else
									{
										$('#discount_total_line').fadeOut();
									}
									
									$('#sub_total').html(sa_currency+(prices.subtotal).formatMoney(2,',','.'));
									$('#custom_fee').html(sa_currency+(prices.optional_custom_fees).formatMoney(2,',','.'));
									$('#grand_total').html(sa_currency+(prices.grand_total).formatMoney(2,',','.'));
								},
								error: function(jqXHR, textStatus, errorThrown)
								{
									console.log('textStatus='+textStatus);
									console.log('errorThrown='+errorThrown);
								}
							});
							
							//end ajax call 
							
						}
					
					},
					error: function(jqXHR, textStatus, errorThrown)
					{
						//$("#loadingDiv").css("display", "none");
						alert("error "+textStatus+": "+textStatus);
					}
				}
			);
		}
		return false;
	}
	
	
	
	
	
	
});		
</script>
<?php //endif ; ?>

<script>
	
	function setcolororder(colororderid,colororderphoto){
	//alert(colororderid);
	var colours=document.getElementsByName("colorboxalt")
	for(var k=0;k<colours.length;k++){
	colours[k].className='color-filter-box-single';}
	document.getElementById("colorbox"+colororderid).className='color-filter-box-single-cliked';
	document.getElementById("color_id").value=colororderid;
	orginal_photo=colororderphoto;
	
	
};
function setthumorder(altimg){

	orginal_photo=altimg;
	
	
};
function setsizeorder(sizeorderid){
	var sizez=document.getElementsByName("size-box")
	for(var k=0;k<sizez.length;k++){
	sizez[k].className='size-box';}
	document.getElementById("size-box"+sizeorderid).className='size-box-clicked ';
	document.getElementById("size_id").value=sizeorderid;
	//document.getElementById("color_name_input").value=colorfiltername;
	
	
};
function colorphoto(imageurl){
	document.getElementById("image2").src=imageurl;
	
};
function thubover(imageurl){
	document.getElementById("image2").src=imageurl;
	
};

function orginalimage(){
 document.getElementById("image2").src=orginal_photo;
};

$(document).ready(function(){
	
$("#cart_num").html('( <?php echo($this->cart->total_items());?> )');
	
	//orginal_photo=document.getElementById("image2").src;
	
	/*$(".remove").click(function(){
		alert(11);
		//var row_id = $(this).attr("id");
		//alert(row_id);
		//remove_cart_item(row_id);
		
		//prevent default
		return false;
		
	});*/
	function remove_itm(){
		alert(11);
		console.log("removing item ... ");
		return false;
	}
	
	function remove_cart_item(row_id)
	{
		///////////// ajax cart update below
		
		var target_url = '<?php echo(base_url()."carta/remove") ; ?>';
		 				  	 
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
			},
			error: function(jqXHR, textStatus, errorThrown)
			{
				//  to do
				//$("#cart_notice").show();
				//$("#cart_notice").html('<pre><code class="prettyprint">AJAX Request Failed<br/> textStatus='+textStatus+', errorThrown='+errorThrown+'</code></pre>');
			}
		});
		//////////// end ajax cart update
	}
	
	//cookies for the radio button 
	if(customer_take_care_of_customs_cookie == 1)
	   {
	   		console.log('customer will handle customs');
	   		radiobtn = document.getElementById("ctcoc0");
			radiobtn.checked = true;
	   		$('#custom_fee_line').fadeOut(200);
	   }
	else
	   {
		   	console.log('shopamerika will handle customs');
		   	radiobtn = document.getElementById("ctcoc1");
			radiobtn.checked = true;
			$('#custom_fee_line').fadeIn(200);
	   }
	
	//--when radio button is clicked
	$('.customer_take_care_of_customs').click(function() {
		
		if ($('input[name=customer_take_care_of_customs]:checked').length > 0) 
		{
    		var value = $(this).val();
    		//console.log(value);
    		
    		// do something here
	    	//alert(value);
			createCookie('bool_customer_take_care_of_customs',value,3);
			   	
	    	//lets ajax 
		    //var target_url = '<?php echo(base_url()."carta/ajax_calc") ; ?>'; // the script where you handle the form input.
		    var target_url = '<?php echo($secure_base_url."checkout/ajax_calc") ; ?>'; // the script where you handle the form input.
		    //var target_url = 'https://www.local.com:4433/usa/checkout/ajax_calc'; // the script where you handle the form input.
			var form_data = {bool_customer_take_care_of_customs:value};
			
			$.ajax(
			{
				url : target_url,
				data: form_data,
				type: "GET",
				success: function(return_data)
				{
					if(value == 1) 
						{
							$('#custom_fee_line').fadeOut(200);
							console.log('customer will handle customs');
						}
					else
						{
							$('#custom_fee_line').fadeIn(200);
							console.log('shopamerika will handle customs');
						}
					
					prices = JSON && JSON.parse(return_data) || $.parseJSON(return_data);
					//prices.order_sub_total = 1457;
					$('#order_sub_total').html(sa_currency+(prices.order_sub_total).formatMoney(2,',','.'));
					$('#shipping_fee').html(sa_currency+(prices.shipping_and_handling_fee).formatMoney(2,',','.'));
					if(prices.discount_total > 0)
					{
						$('#discount_total_line').fadeIn();
						$('#total_discount').html(sa_currency+(prices.discount_total).formatMoney(2,',','.'));
					}
					else
					{
						$('#discount_total_line').fadeOut();
					}
					
					$('#sub_total').html(sa_currency+(prices.subtotal).formatMoney(2,',','.'));
					$('#custom_fee').html(sa_currency+(prices.optional_custom_fees).formatMoney(2,',','.'));
					$('#grand_total').html(sa_currency+(prices.grand_total).formatMoney(2,',','.'));
					
					//alert(return_data)
					//console.log(return_data);
					
					// refresh page
					//location.reload(); 
				},
				error: function(jqXHR, textStatus, errorThrown)
				{
					console.log('textStatus='+textStatus);
					console.log('errorThrown='+errorThrown);
				}
			});
			
			
		
	    	
		}
		
		
		
	});
	
	
	
});


$( ".delivery_address" ).click(function() 
	{
	 	var delivery_address_id = $(this).attr('id');
	 
	  
	 	var target_url = '<?php echo($secure_base_url."customer/get_address_details/") ; ?>'+delivery_address_id;
		//alert( target_url );
		
		$.ajax(
		{
			url : target_url,
			type: "POST",
			cache: false,
			//data : ProductData,
			success: function(data)
			{
				//update the cart icon
				address = JSON && JSON.parse(data) || $.parseJSON(data);
				//alert(address.line_1);
				
				//fill in the form
				$("#shipping_address_id").val(address.id);
				$("#address1").val(address.line_1);
				$("#address2").val(address.line_2);
				$("#address3").val(address.line_3);
				$("#region").val(address.country_province);
				$("#zipcode").val(address.zip_code);
				$("#coutry").val(address.coutry);
			},
			error: function(jqXHR, textStatus, errorThrown)
			{
				//  to do
				//alert("can not get address");
			}
		});
		 				  	 
		
		
		
	});

/*helper functions */

//see http://stackoverflow.com/questions/901115/how-can-i-get-query-string-values-in-javascript/901144#901144
function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}


//create cookie easy peasy see http://stackoverflow.com/questions/7551113/how-to-set-path-while-saving-the-cookie-value-in-javascript
function createCookie(name,value,days) 
{
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/"; 
}

// convert any string to a url friendly string
function convertToSlug(Text)
{
    return Text
        .toLowerCase()
        .replace('/ /g','-' )
        .replace(/[^\w-]+/g,'-')
        ;
}



</script>

<?php include "script_email_collector_https.php"; ?>

</body>
</html>