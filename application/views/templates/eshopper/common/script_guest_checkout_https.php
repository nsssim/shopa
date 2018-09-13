<?php 
$ssl_port_num = ":".SSL_PORT;  // :443 is the default
$base_url_str = base_url(); 
$secure_base_url = str_replace("http","https",$base_url_str );
$secure_base_url = str_replace(".com",".com$ssl_port_num",$secure_base_url );
?>
	
	<?php $CI =& get_instance();?>

	 
<!--____________________________________/ javascript \____________________________________-->   
	
	
    <script src="<?php echo $secure_base_url.'assets/templates/eshopper/js/jquery.js';?>"> </script>
	<script src="<?php echo $secure_base_url.'assets/templates/eshopper/js/bootstrap.min.js';?>" ></script>
	<script src="<?php echo $secure_base_url.'assets/templates/eshopper/js/jquery.scrollUp.min.js';?>" ></script>
	<script src="<?php echo $secure_base_url.'assets/templates/eshopper/js/price-range.js';?>"> </script>
    <script src="<?php echo $secure_base_url.'assets/templates/eshopper/js/jquery.prettyPhoto.js';?>"> </script>
    <script src="<?php echo $secure_base_url.'assets/templates/eshopper/js/jquery-ui.js';?>" > </script>
    <!-- <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>-->
<!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>-->


<?php echo '<script>var customer_take_care_of_customs_cookie = '.$customer_take_care_of_customs_cookie. ';</script>'; ?>
<?php echo '<script>var sa_currency 							 = "'.$currency. '";</script>'; ?>
<?php echo '<script>var sa_rate 							 	 = '.$rate. ';</script>'; ?>

<script>

  // for the tool tip on the check box 
    	$(".tooltip").show();
    	$('[data-toggle="tooltip"]').tooltip();

  
	//search autocomplete just text
	/*$("#search").autocomplete
		({
	    	source: '<?php echo($secure_base_url."product/autocomplete") ; ?>', // path to the autosearch method
	    	//source: 'http://www.usa.com/usa/product/autocomplete', // path to the autosearch method 
	    	minLength: 2
	  	 });*/
	


//change language
$(".country_flag").click(function(e) {
	var lang_str_id = this.id;
	var lang_id = lang_str_id.slice(-1);
	
	//alert(lang_id);
	
	//the target (language controller / change_language method)
	var target_url = '<?php echo($secure_base_url."lng/set_language_id/") ; ?>' + lang_id;
	  	 
	$.ajax(
	{
		url : target_url,
		type: "GET",
		success: function(return_data)
		{
			//console.log(return_data);
			location.reload(); 
			
			// refresh page
			//location.reload(); 
		},
		error: function(jqXHR, textStatus, errorThrown)
		{
			console.log('textStatus='+textStatus);
			console.log('errorThrown='+errorThrown);
		}
	});
	
	//var oo = 55 ;
	//oo++;
});

/////
function convertToSlug(Text)
{
    return Text
        .toLowerCase()
        .replace('/ /g','-' )
        .replace(/[^\w-]+/g,'-')
        ;
}
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

function gototop(){
	$('html, body').animate({ scrollTop: 0 }, 'slow');
}

//globals
var frm_errors = na_firstname_errors = na_lastname_errors = na_sha_line1_errors = na_sha_line2_errors = na_zipcode_errors = na_date_errors = na_email_errors = na_confirm_email_errors = na_confirm_email_errors2 = na_login_password_errors = na_confirm_password_errors = na_phone_errors = na_email_already_in_use_error = na_attention_errors = 1;
var ba_firstname_errors = ba_lastname_errors = ba_zipcode_errors = ba_email_errors = ba_phone_errors = na_card_num_error = na_ccard_date_select_error = na_sec_code_error = ba_email_already_in_use_error = 1;
var order_form_errors = 1;

 $( document ).ready(function() 
 	{
 		if(customer_take_care_of_customs_cookie == 1)
	   {
	   		//console.log('customer will handle customs');
	   		radiobtn = document.getElementById("ctcoc0");
			radiobtn.checked = true;
	   		$('#custom_fee_line').fadeOut(200);
	   }
	   else
	   {
		   	//console.log('shopamerika will handle customs');
		   	radiobtn = document.getElementById("ctcoc1");
			radiobtn.checked = true;
			$('#custom_fee_line').fadeIn(200);
	   }
	   
	 
	   
	   //--when radio button is clicked
		$('.customer_take_care_of_customs').click(function() {
			
			if ($('input[name=customer_take_care_of_customs]:checked').length > 0) 
			{
	    		var value = $(this).val();
	    		
	    		// do something here
		    	//alert(value);
				createCookie('bool_customer_take_care_of_customs',value,3);
				   	
		    	//lets ajax 
			    var target_url = '<?php echo($secure_base_url."carta/ajax_calc") ; ?>'; // the script where you handle the form input.
				var form_data = {bool_customer_take_care_of_customs:value};
				
				$.ajax(
				{
					url : target_url,
					data: form_data,
					type: "GET",
					success: function(return_data)
					{
						if(value == 1){$('#custom_fee_line').fadeOut(200);/*console.log('customer will handle customs');*/}else{$('#custom_fee_line').fadeIn(200);/*console.log('shopamerika will handle customs');*/}
						prices = JSON && JSON.parse(return_data) || $.parseJSON(return_data);
						//prices.order_sub_total = 1457;
						$('#order_sub_total').html(sa_currency+(prices.order_sub_total).formatMoney(2,',','.'));
						$('#shipping_fee').html(sa_currency+(prices.shipping_and_handling_fee).formatMoney(2,',','.'));
						if(prices.discount_total > 0)
						{
							$('#discount_total_line').fadeIn();
							$('#total_discount').html("- "+sa_currency+(prices.discount_total).formatMoney(2,',','.'));
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
		
		
 		
 		
 		////////////// edit address /////////////////
 		$(".edit_address").bind(
	 	{
		  click: function() 
		   {
		    	//console.log("focus in " );
		    	var this_id = $(this).attr('id');
		    	var address_id = this_id.slice(13); ; 
		    	//alert(address_id);
		    	
		    	//lets ajax
				var Data2send = {addressid:address_id};
				var target_url = '<?php echo($secure_base_url."addressman/get_address_details/") ; ?>';
				//alert(111);
		  	 	
				$.ajax(
				{
					url : target_url,
					data: Data2send,
					type: "GET",
					success: function(data)
					{
						address_details = JSON && JSON.parse(data) || $.parseJSON(data);
						
		 				//console.info(address_details);
		 				//alert(address_details[0].first_name)
		 				$('#na_attention').val(address_details[0].attention);
		 				$('#na_firstname').val(address_details[0].first_name);
		 				$('#na_lastname').val(address_details[0].last_name);
		 				$('#na_sha_line1').val(address_details[0].line_1);
		 				$('#na_sha_line2').val(address_details[0].line_2);
		 				$('#na_country_select').val(address_details[0].coutry);
		 				$('#na_city_select').val(address_details[0].city);
		 				$('#na_county_select').val(address_details[0].country_province);
		 				$('#na_zipcode').val(address_details[0].zip_code);
		 				$('#na_phone').val(address_details[0].tel);
		 				$('#address_id').val(address_details[0].id);
		 				$('#na_submit_btn').hide();
		 				$('#na_submit_btn2')[0].type = 'submit'; 
		 				
		 				//loop through all inputs and focus in out to check values against rules 
		 				$("#na_form").each(function(){
					    input_elm = $(this).find(':input') //<-- Should return all input elements in that specific form.
					    $(input_elm).focus(); // focus in and out to trigger the validation mechanism
					    
					    $('#na_attention').focus();
					    var position = $('#na_attention').position();
					    window.scrollTo(position.left, position.top+300);
					    
					        
					    
						});
		 				
		 				/*
		 				var option_line;
						$.each(counties_tr, function(indx,val){
						    option_line += '<option value=' + val.id + '>' + val.name + '</option>';
						});
						$('#na_county_select').append(option_line);
		 				*/	
						
					},
					error: function(jqXHR, textStatus, errorThrown)
					{
						console.log('textStatus='+textStatus);
						console.log('errorThrown='+errorThrown);
					}
				});
		    	
		   }
		});
		
		/////////////////////// delete address 
		
		$(".delete_address").bind(
	 	{
		  click: function() 
		   {
		    	if (confirm('Are you sure ?')) 
		    	{
			    	//console.log("focus in " );
			    	var this_id = $(this).attr('id');
			    	var address_id = this_id.slice(12); ; 
			    	//alert(address_id);
			    	
			    	//lets ajax
					var Data2send = {addressid:address_id};
					var target_url = '<?php echo($secure_base_url."addressman/x_del_shipping_address/") ; ?>';
					//alert(111);
			  	 	
					$.ajax(
					{
						url : target_url,
						data: Data2send,
						type: "GET",
						success: function(data_return)
						{
							window.location.href = data_return+'?address_deleted=1';
							
						},
						error: function(jqXHR, textStatus, errorThrown)
						{
							console.log('textStatus='+textStatus);
							console.log('errorThrown='+errorThrown);
						}
					});
		    	}
		   }
		});
		
		/////////////////////// set address as primary 
		
		$(".set_address").bind(
	 	{
		  click: function() 
		   {
		    	
				//console.log("focus in " );
				var this_id = $(this).attr('id');
				var address_id = this_id.slice(12); ; 
				//alert(address_id);
				
				//lets ajax
				var Data2send = {addressid:address_id};
				var target_url = '<?php echo($secure_base_url."addressman/x_set_as_primary/") ; ?>';
				//alert(111);
			 	
				$.ajax(
				{
					url : target_url,
					data: Data2send,
					type: "GET",
					success: function(data_return)
					{
						//alert(data_return+'?address_set=1');
						window.location.href = data_return+'?address_set=1';
						//window.location.href = 'https://www.local.com:4433/usa/customer/my_address_book?ddd=1';
						
					},
					error: function(jqXHR, textStatus, errorThrown)
					{
						console.log('textStatus='+textStatus);
						console.log('errorThrown='+errorThrown);
					}
				});
		    	
		   }
		});
		
		

 		
	 	
	 	//// login email focus in and out ///////////////////////////////////
	 	$( "#login_email" ).bind(
	 	{
		  focusin: function() {
		    	//console.log("focus in " );
		    	$(this).css('border-color','rgba(0, 0, 0, 0.8)');
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 4px rgba(0, 0, 0, 0.6)');
		    	$(this).css('outline','0 none');
		  },
		  blur: function() {
		    // Do something on mouseenter
		    var typed_email = $(this).val();
		    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  			var is_valid_email =  re.test(typed_email);
		    
		    if(!is_valid_email)
		    {
		    	na_email_errors = 1;
				$('#email_error').show();
				//red shadow
				$(this).css('border-color','rgba(215, 44, 44, 0.8)');
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$(this).css('outline','0 none');
			}
			else
			{
				na_email_errors = 0;
				$('#email_error').hide();
				$(this).css('border-color','black');
		    	$(this).css('box-shadow','none');
		    	$(this).css('outline','0 none');
		    	
		    	//email is valid we check it now via ajax 
		    	//start ajax
		    	var target_url = '<?php echo($secure_base_url."customer/xcheck_customer/") ; ?>' 
	
				var Data2send = {email:typed_txt};
				var email_flag = 0;
				  	 
				$.ajax(
				{
					url : target_url,
					data: Data2send,
					type: "GET",
					success: function(return_data)
					{
						//console.log(return_data);
						if(return_data == 1)
						{
							ba_email_already_in_use_error = 1;
							$('#ba_email_already_in_use_error').show();
							//red shadow
							$('#na_email').css('border-color','rgba(215, 44, 44, 0.8)'); 
					    	$('#na_email').css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
					    	$('#na_email').css('outline','0 none');
						}
						else
						{
							ba_email_already_in_use_error = 0;
							$('#ba_email_already_in_use_error').hide();
							$('#na_email').css('border-color','rgb(157, 168, 179)'); 
					    	$('#na_email').css('box-shadow','none');
					    	$('#na_email').css('outline','0 none');
							
						}
						
					},
					error: function(jqXHR, textStatus, errorThrown)
					{
						console.log('textStatus='+textStatus);
						console.log('errorThrown='+errorThrown);
					}
				});
				//finish ajax
		    	
			}
			
		    //console.log("focus out ..." + is_valid_email)
		   
		    
		  }
		});
		
	 	//// login password focus in and out ///////////////////////////////////
		$( "#login_password" ).bind(
	 	{
		  focusin: function() {
		    	//console.log("focus in " );
		    	$(this).css('border-color','rgba(0, 0, 0, 0.8)');
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 4px rgba(0, 0, 0, 0.6)');
		    	$(this).css('outline','0 none');
		  },
		  blur: function() {
		    // Do something on mouseenter
		    var typed_password = $(this).val();
		    var password_length_ok = false;
		    password_length = typed_password.length;
		    if((password_length > 4) && (password_length < 17) )
		    {
				password_length_ok = true;
			}
		    //alert(password_length_ok);
		    
		    password_length_bad = !password_length_ok;
		    
		    var re = /(.*\+)|(.*\=)|(.*,)|(.*\\)|(.*\+)|(.*\-)|(.*\|)|(.*\/)|(.* )|(.*%)/; 
		    var m;
 
			if ((m = re.exec(typed_password)) !== null) {
			    if (m.index === re.lastIndex) {
			        re.lastIndex++;
			    }
			    // View your result using the m-variable.
			    // eg m[0] etc.
			}
			
			//if a match was found		    
		    if(m || password_length_bad)
		    {
				frm_errors = 1;
				$('#password_error').show();
				//red shadow
				$(this).css('border-color','rgba(215, 44, 44, 0.8)');
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$(this).css('outline','0 none');
			}
			else
			{
				frm_errors = 0;
				$('#password_error').hide();
				$(this).css('border-color','black');
		    	$(this).css('box-shadow','none');
		    	$(this).css('outline','0 none');
			}
		    
		    
		   // console.log("focus out ..." + m)
		   
		    
		  }
		});
		
	 	//// get city id and find its counties and populate the na_county_select drop down ///////////////////////////////////
	 	//1 when user clicks 		
	 	$( "#na_city_select" ).bind( "change keyup", function() {
	 		var cityid = $(this).val();
	 		//lets ajax 
	 		///// update via 
			var Data2send = {city_id:cityid};
			var target_url = '<?php echo($secure_base_url."addressman/get_counties_tr/") ; ?>';
			//alert(111);
	  	 	
			$.ajax(
			{
				url : target_url,
				data: Data2send,
				type: "GET",
				success: function(data)
				{
					counties_tr = JSON && JSON.parse(data) || $.parseJSON(data);
	 				//console.info(cities_tr);
	 				$('#na_county_select').empty();
	 				var option_line;
					$.each(counties_tr, function(indx,val){
					    option_line += '<option value=' + val.id + '>' + val.name + '</option>';
					});
					$('#na_county_select').append(option_line);
	 				
					
				},
				error: function(jqXHR, textStatus, errorThrown)
				{
					console.log('textStatus='+textStatus);
					console.log('errorThrown='+errorThrown);
				}
			});
	 		
	 		//console.info(cityid);
	 	});
	 	
	 	/*//2 when page is loaded 
	 	var cityid = $( "#na_city_select" ).val();
	 	var Data2send = {city_id:cityid};
		var target_url = '<?php echo($secure_base_url."addressman/get_counties_tr/") ; ?>';
		$.ajax(
			{
				url : target_url,
				data: Data2send,
				type: "GET",
				success: function(data)
				{
					counties_tr = JSON && JSON.parse(data) || $.parseJSON(data);
	 				//console.info(cities_tr);
	 				$('#na_county_select').empty();
	 				var option_line= '';
					$.each(counties_tr, function(indx,val){
					    option_line += '<option value=' + val.id + '>' + val.name + '</option>';
					});
					$('#na_county_select').append(option_line);
	 				
					
				},
				error: function(jqXHR, textStatus, errorThrown)
				{
					console.log('textStatus='+textStatus);
					console.log('errorThrown='+errorThrown);
				}
			});*/
			
			
	////  new event  ///////////////////////////////////
	$( "#na_attention" ).bind(
	{
		  focusin: function() {
		    	//console.log("focus in " );
		    	$(this).css('border-color','rgba(0, 0, 0, 0.8)');
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 4px rgba(0, 0, 0, 0.6)');
		    	$(this).css('outline','0 none');
		  },
		  blur: function() {
		    // Do something on mouseenter
		    var typed_txt = $(this).val();
		    var na_attention_length_ok = false;
		    typed_txt_length = typed_txt.length;
		    if((typed_txt_length > 0) )
		    {
				na_attention_length_ok = true;
			    //alert(password_length_ok);
			    
			    na_attention_length_bad = !na_attention_length_ok;
			    
			    // any special charachters
			    var re = /(.*\+)|(.*\=)|(.*,)|(.*\\)|(.*\+)|(.*\|)|(.*\/)|(.*%)|(.*#)|(.*\$)|(.*\@)|(.*\~)|(.*\?)|(.*\>)|(.*\<)|(.*\!)|(.*\[)|(.*\])|(.*\{)|(.*\})|(.*\^)|(.*\&)|(.*\*)|(.*\()|(.*\))|(.*\=)|(.*\:)|(.*\;)/; 
			    var m;
	 
				if ((m = re.exec(typed_txt)) !== null) {
				    if (m.index === re.lastIndex) {
				        re.lastIndex++;
				    }
				    //  m[0] etc... 
				}
				
				//if a match was found		    
			    if(m || na_attention_length_bad)
			    {
					na_attention_errors = 1;
					$('#na_attention_error').show();
					//red shadow
					$(this).css('border-color','rgba(215, 44, 44, 0.8)'); 
			    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
			    	$(this).css('outline','0 none');
				}
				else
				{
					na_attention_errors = 0;
					$('#na_attention_error').hide();
					$(this).css('border-color','rgb(157, 168, 179)'); 
			    	$(this).css('box-shadow','none');
			    	$(this).css('outline','0 none');
				}
			}
			else
			{
					na_attention_errors = 0;
					$('#na_attention_error').hide();
					$(this).css('border-color','rgb(157, 168, 179)'); 
			    	$(this).css('box-shadow','none');
			    	$(this).css('outline','0 none');
			}
		    
		    
		    //console.log("focus out ..." + m)
		   
		    
		  }
	});	
	
	////  new event  ///////////////////////////////////
	$( "#na_firstname" ).bind(
	{
		  focusin: function() {
		    	//console.log("focus in " );
		    	$(this).css('border-color','rgba(0, 0, 0, 0.8)');
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 4px rgba(0, 0, 0, 0.6)');
		    	$(this).css('outline','0 none');
		  },
		  blur: function() {
		    // Do something on mouseenter
		    var typed_firstname = $(this).val();
		    var firstname_length_ok = false;
		    firstname_length = typed_firstname.length;
		    if((firstname_length > 2) )
		    {
				firstname_length_ok = true;
			}
		    //alert(password_length_ok);
		    
		    firstname_length_bad = !firstname_length_ok;
		    
		    // any special charachters
		    var re = /(.*\+)|(.*\=)|(.*,)|(.*\\)|(.*\+)|(.*\|)|(.*\/)|(.*%)|(.*#)|(.*\$)|(.*\@)|(.*\~)|(.*\?)|(.*\>)|(.*\<)|(.*\!)|(.*\[)|(.*\])|(.*\{)|(.*\})|(.*\^)|(.*\&)|(.*\*)|(.*\()|(.*\))|(.*\=)|(.*\:)|(.*\;)/; 
		    var m;
 
			if ((m = re.exec(typed_firstname)) !== null) {
			    if (m.index === re.lastIndex) {
			        re.lastIndex++;
			    }
			    //  m[0] etc... 
			}
			
			//if a match was found		    
		    if(m || firstname_length_bad)
		    {
				na_firstname_errors = 1;
				$('#fname_error').show();
				//red shadow
				$(this).css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$(this).css('outline','0 none');
			}
			else
			{
				na_firstname_errors = 0;
				$('#fname_error').hide();
				$(this).css('border-color','rgb(157, 168, 179)'); 
		    	$(this).css('box-shadow','none');
		    	$(this).css('outline','0 none');
			}
		    
		    
		    //console.log("focus out ..." + m)
		   
		    
		  }
	});		
	
	////  new event  ///////////////////////////////////
	$( "#ba_firstname" ).bind(
	{
		  focusin: function() {
		    	//console.log("focus in " );
		    	$(this).css('border-color','rgba(0, 0, 0, 0.8)');
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 4px rgba(0, 0, 0, 0.6)');
		    	$(this).css('outline','0 none');
		  },
		  blur: function() {
		    // Do something on mouseenter
		    var typed_firstname = $(this).val();
		    var firstname_length_ok = false;
		    firstname_length = typed_firstname.length;
		    if((firstname_length > 2) )
		    {
				firstname_length_ok = true;
			}
		    //alert(password_length_ok);
		    
		    firstname_length_bad = !firstname_length_ok;
		    
		    // any special charachters
		    var re = /(.*\+)|(.*\=)|(.*,)|(.*\\)|(.*\+)|(.*\|)|(.*\/)|(.*%)|(.*#)|(.*\$)|(.*\@)|(.*\~)|(.*\?)|(.*\>)|(.*\<)|(.*\!)|(.*\[)|(.*\])|(.*\{)|(.*\})|(.*\^)|(.*\&)|(.*\*)|(.*\()|(.*\))|(.*\=)|(.*\:)|(.*\;)/; 
		    var m;
 
			if ((m = re.exec(typed_firstname)) !== null) {
			    if (m.index === re.lastIndex) {
			        re.lastIndex++;
			    }
			    //  m[0] etc... 
			}
			
			//if a match was found		    
		    if(m || firstname_length_bad)
		    {
				ba_firstname_errors = 1;
				$('#ba_fname_error').show();
				//red shadow
				$(this).css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$(this).css('outline','0 none');
			}
			else
			{
				ba_firstname_errors = 0;
				$('#ba_fname_error').hide();
				$(this).css('border-color','rgb(157, 168, 179)'); 
		    	$(this).css('box-shadow','none');
		    	$(this).css('outline','0 none');
			}
		    
		    
		    //console.log("focus out ..." + m)
		   
		    
		  }
	});		
	
	////  new event  ///////////////////////////////////
	$( "#na_lastname" ).bind(
	{
		  focusin: function() {
		    	//console.log("focus in " );
		    	$(this).css('border-color','rgba(0, 0, 0, 0.8)');
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 4px rgba(0, 0, 0, 0.6)');
		    	$(this).css('outline','0 none');
		  },
		  blur: function() {
		    var typed_txt = $(this).val();
		    var txt_length_ok = false;
		    var txt_length = typed_txt.length;
		    if((txt_length > 2) )
		    {
				txt_length_ok = true;
			}
		    //alert(password_length_ok);
		    
		    txt_length_bad = !txt_length_ok;
		    
		    // any special charachters
		    var re = /(.*\+)|(.*\=)|(.*,)|(.*\\)|(.*\+)|(.*\|)|(.*\/)|(.*%)|(.*#)|(.*\$)|(.*\@)|(.*\~)|(.*\?)|(.*\>)|(.*\<)|(.*\!)|(.*\[)|(.*\])|(.*\{)|(.*\})|(.*\^)|(.*\&)|(.*\*)|(.*\()|(.*\))|(.*\=)|(.*\:)|(.*\;)/; 
		    var m;
 
			if ((m = re.exec(typed_txt)) !== null) {
			    if (m.index === re.lastIndex) {
			        re.lastIndex++;
			    }
			    //  m[0] etc... 
			}
			
			//if a match was found		    
		    if(m || txt_length_bad)
		    {
				na_lastname_errors = 1;
				$('#lname_error').show();
				//red shadow
				$(this).css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$(this).css('outline','0 none');
			}
			else
			{
				na_lastname_errors = 0;
				$('#lname_error').hide();
				$(this).css('border-color','rgb(157, 168, 179)'); 
		    	$(this).css('box-shadow','none');
		    	$(this).css('outline','0 none');
			}
		    
		    
		    //console.log("focus out ..." + m)
		   
		    
		  }
	});
	
	////  new event  ///////////////////////////////////
	$( "#ba_lastname" ).bind(
	{
		  focusin: function() {
		    	//console.log("focus in " );
		    	$(this).css('border-color','rgba(0, 0, 0, 0.8)');
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 4px rgba(0, 0, 0, 0.6)');
		    	$(this).css('outline','0 none');
		  },
		  blur: function() {
		    var typed_txt = $(this).val();
		    var txt_length_ok = false;
		    var txt_length = typed_txt.length;
		    if((txt_length > 2) )
		    {
				txt_length_ok = true;
			}
		    //alert(password_length_ok);
		    
		    txt_length_bad = !txt_length_ok;
		    
		    // any special charachters
		    var re = /(.*\+)|(.*\=)|(.*,)|(.*\\)|(.*\+)|(.*\|)|(.*\/)|(.*%)|(.*#)|(.*\$)|(.*\@)|(.*\~)|(.*\?)|(.*\>)|(.*\<)|(.*\!)|(.*\[)|(.*\])|(.*\{)|(.*\})|(.*\^)|(.*\&)|(.*\*)|(.*\()|(.*\))|(.*\=)|(.*\:)|(.*\;)/; 
		    var m;
 
			if ((m = re.exec(typed_txt)) !== null) {
			    if (m.index === re.lastIndex) {
			        re.lastIndex++;
			    }
			    //  m[0] etc... 
			}
			
			//if a match was found		    
		    if(m || txt_length_bad)
		    {
				ba_lastname_errors = 1;
				$('#ba_lname_error').show();
				//red shadow
				$(this).css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$(this).css('outline','0 none');
			}
			else
			{
				ba_lastname_errors = 0;
				$('#ba_lname_error').hide();
				$(this).css('border-color','rgb(157, 168, 179)'); 
		    	$(this).css('box-shadow','none');
		    	$(this).css('outline','0 none');
			}
		    
		    
		    //console.log("focus out ..." + m)
		   
		    
		  }
	});
	
	////  new event  ///////////////////////////////////
	$( "#na_sha_line1" ).bind(
	{
		  focusin: function() {
		    	//console.log("focus in " );
		    	$(this).css('border-color','rgba(0, 0, 0, 0.8)');
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 4px rgba(0, 0, 0, 0.6)');
		    	$(this).css('outline','0 none');
		  },
		  blur: function() {
		    var typed_txt = $(this).val();
		    var txt_length_ok = false;
		    var txt_length = typed_txt.length;
		    if((txt_length > 2) )
		    {
				txt_length_ok = true;
			}
		    //alert(password_length_ok);
		    
		    txt_length_bad = !txt_length_ok;
		    
		    // some special charachters
		    var re = /(.*\+)|(.*\=)|(.*%)|(.*\$)|(.*\~)|(.*\{)|(.*\})|(.*\^)|(.*\*)|(.*\;)|(.*\\)/; 
		    var m;
 
			if ((m = re.exec(typed_txt)) !== null) {
			    if (m.index === re.lastIndex) {
			        re.lastIndex++;
			    }
			    //  m[0] etc... 
			}
			
			//if a match was found		    
		    if(m || txt_length_bad)
		    {
				na_sha_line1_errors = 1;
				$('#na_line1_error').show();
				//red shadow
				$(this).css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$(this).css('outline','0 none');
			}
			else
			{
				na_sha_line1_errors = 0;
				$('#na_line1_error').hide();
				$(this).css('border-color','rgb(157, 168, 179)'); 
		    	$(this).css('box-shadow','none');
		    	$(this).css('outline','0 none');
			}
		    
		    
		    //console.log("focus out ..." + m)
		   
		    
		  }
	});
	
	////  new event  ///////////////////////////////////
	$( "#ba_sha_line1" ).bind(
	{
		  focusin: function() {
		    	//console.log("focus in " );
		    	$(this).css('border-color','rgba(0, 0, 0, 0.8)');
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 4px rgba(0, 0, 0, 0.6)');
		    	$(this).css('outline','0 none');
		  },
		  blur: function() {
		    var typed_txt = $(this).val();
		    var txt_length_ok = false;
		    var txt_length = typed_txt.length;
		    if((txt_length > 2) )
		    {
				txt_length_ok = true;
			}
		    //alert(password_length_ok);
		    
		    txt_length_bad = !txt_length_ok;
		    
		    // some special charachters
		    var re = /(.*\+)|(.*\=)|(.*%)|(.*\$)|(.*\~)|(.*\{)|(.*\})|(.*\^)|(.*\*)|(.*\;)|(.*\\)/; 
		    var m;
 
			if ((m = re.exec(typed_txt)) !== null) {
			    if (m.index === re.lastIndex) {
			        re.lastIndex++;
			    }
			    //  m[0] etc... 
			}
			
			//if a match was found		    
		    if(m || txt_length_bad)
		    {
				ba_sha_line1_errors = 1;
				$('#ba_line1_error').show();
				//red shadow
				$(this).css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$(this).css('outline','0 none');
			}
			else
			{
				ba_sha_line1_errors = 0;
				$('#ba_line1_error').hide();
				$(this).css('border-color','rgb(157, 168, 179)'); 
		    	$(this).css('box-shadow','none');
		    	$(this).css('outline','0 none');
			}
		    
		    
		    //console.log("focus out ..." + m)
		   
		    
		  }
	});
			
	////  new event  ///////////////////////////////////
	$( "#na_sha_line2" ).bind(
	{
		  focusin: function() {
		    	//console.log("focus in " );
		    	$(this).css('border-color','rgba(0, 0, 0, 0.8)');
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 4px rgba(0, 0, 0, 0.6)');
		    	$(this).css('outline','0 none');
		  },
		  blur: function() {
		    var typed_txt = $(this).val();
		    var txt_length_ok = false;
		    var txt_length = typed_txt.length;
		    if((txt_length >= 0) ) // not important :p 
		    {
				txt_length_ok = true;
			}
		    //alert(password_length_ok);
		    
		    txt_length_bad = !txt_length_ok;
		    
		    // some special charachters
		    var re = /(.*\+)|(.*\=)|(.*%)|(.*\$)|(.*\~)|(.*\{)|(.*\})|(.*\^)|(.*\*)|(.*\;)|(.*\\)/; 
		    var m;
 
			if ((m = re.exec(typed_txt)) !== null) {
			    if (m.index === re.lastIndex) {
			        re.lastIndex++;
			    }
			    //  m[0] etc... 
			}
			
			//if a match was found		    
		    if(m || txt_length_bad)
		    {
				na_sha_line2_errors = 1;
				$('#na_sha_line2_error').show();
				//red shadow
				$(this).css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$(this).css('outline','0 none');
			}
			else
			{
				na_sha_line2_errors = 0;
				$('#na_sha_line2_error').hide();
				$(this).css('border-color','rgb(157, 168, 179)'); 
		    	$(this).css('box-shadow','none');
		    	$(this).css('outline','0 none');
			}
		    
		    
		    //console.log("focus out ..." + m)
		   
		    
		  }
	});
	
	////  new event  ///////////////////////////////////
	$( "#ba_sha_line2" ).bind(
	{
		  focusin: function() {
		    	//console.log("focus in " );
		    	$(this).css('border-color','rgba(0, 0, 0, 0.8)');
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 4px rgba(0, 0, 0, 0.6)');
		    	$(this).css('outline','0 none');
		  },
		  blur: function() {
		    var typed_txt = $(this).val();
		    var txt_length_ok = false;
		    var txt_length = typed_txt.length;
		    if((txt_length >= 0) ) // not important :p 
		    {
				txt_length_ok = true;
			}
		    //alert(password_length_ok);
		    
		    txt_length_bad = !txt_length_ok;
		    
		    // some special charachters
		    var re = /(.*\+)|(.*\=)|(.*%)|(.*\$)|(.*\~)|(.*\{)|(.*\})|(.*\^)|(.*\*)|(.*\;)|(.*\\)/; 
		    var m;
 
			if ((m = re.exec(typed_txt)) !== null) {
			    if (m.index === re.lastIndex) {
			        re.lastIndex++;
			    }
			    //  m[0] etc... 
			}
			
			//if a match was found		    
		    if(m || txt_length_bad)
		    {
				ba_sha_line2_errors = 1;
				$('#ba_sha_line2_error').show();
				//red shadow
				$(this).css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$(this).css('outline','0 none');
			}
			else
			{
				ba_sha_line2_errors = 0;
				$('#ba_sha_line2_error').hide();
				$(this).css('border-color','rgb(157, 168, 179)'); 
		    	$(this).css('box-shadow','none');
		    	$(this).css('outline','0 none');
			}
		    
		    
		    //console.log("focus out ..." + m)
		   
		    
		  }
	});			
	
	////  new event  ///////////////////////////////////
	$( "#na_zipcode" ).bind(
	{
		  focusin: function() {
		    	//console.log("focus in " );
		    	$(this).css('border-color','rgba(0, 0, 0, 0.8)');
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 4px rgba(0, 0, 0, 0.6)');
		    	$(this).css('outline','0 none');
		  },
		  blur: function() {
		    var typed_txt = $(this).val();
		   		    
		    // zipcode regex
		    var re = /^\d{5}(?:[-\s]\d{4})?$/; 
		    var m;
 
			if ((m = re.exec(typed_txt)) !== null) {
			    if (m.index === re.lastIndex) {
			        re.lastIndex++;
			    }
			    //  m[0] etc... 
			}
			
			//if a match was found		    
		    if(m)
		    {
				na_zipcode_errors = 0;
				$('#na_zip_error').hide();
				$(this).css('border-color','rgb(157, 168, 179)'); 
		    	$(this).css('box-shadow','none');
		    	$(this).css('outline','0 none');
			}
			else
			{
		    	na_zipcode_errors = 1;
		    	$('#na_zip_error').show();
				//red shadow
				$(this).css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$(this).css('outline','0 none');
			}
		    
		    
		    //console.log("focus out ..." + m)
		   
		    
		  }
	});	
	
	////  new event  ///////////////////////////////////
	$( "#ba_zipcode" ).bind(
	{
		  focusin: function() {
		    	//console.log("focus in " );
		    	$(this).css('border-color','rgba(0, 0, 0, 0.8)');
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 4px rgba(0, 0, 0, 0.6)');
		    	$(this).css('outline','0 none');
		  },
		  blur: function() {
		    var typed_txt = $(this).val();
		   		    
		    // zipcode regex
		    var re = /^\d{5}(?:[-\s]\d{4})?$/; 
		    var m;
 
			if ((m = re.exec(typed_txt)) !== null) {
			    if (m.index === re.lastIndex) {
			        re.lastIndex++;
			    }
			    //  m[0] etc... 
			}
			
			//if a match was found		    
		    if(m)
		    {
				ba_zipcode_errors = 0;
				$('#ba_zip_error').hide();
				$(this).css('border-color','rgb(157, 168, 179)'); 
		    	$(this).css('box-shadow','none');
		    	$(this).css('outline','0 none');
			}
			else
			{
		    	ba_zipcode_errors = 1;
		    	$('#ba_zip_error').show();
				//red shadow
				$(this).css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$(this).css('outline','0 none');
			}
		    
		    
		    //console.log("focus out ..." + m)
		   
		    
		  }
	});
	
	////  new event  ///////////////////////////////////
	$( "#na_month_select" ).bind(
	{
		  focusin: function() {
		    	//console.log("focus in " );
		    	$(this).css('border-color','rgba(0, 0, 0, 0.8)');
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 4px rgba(0, 0, 0, 0.6)');
		    	$(this).css('outline','0 none');
		  },
		  blur: function() {
		    var month_val = $('#na_month_select').val();
		    var date_val = $('#na_date_select').val();
		    var year_val = $('#na_year_select').val();
		  	    
		    if(month_val=="" && date_val =="" && year_val =="")
		    {
				na_date_errors = 1;
		    	$('#na_birthdate_error').show();
				
				//red red red
				$('#na_month_select').css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$('#na_month_select').css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$('#na_month_select').css('outline','0 none');
		    	
		    	$('#na_date_select').css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$('#na_date_select').css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$('#na_date_select').css('outline','0 none');
		    	
		    	$('#na_year_select').css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$('#na_year_select').css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$('#na_year_select').css('outline','0 none');
			}
			
			if(month_val!="" && date_val =="" && year_val =="")
		    {
				na_date_errors = 1;
		    	$('#na_birthdate_error').show();
				
				//black red red
				$('#na_month_select').css('border-color','rgb(157, 168, 179)'); 
			    $('#na_month_select').css('box-shadow','none');
			    $('#na_month_select').css('outline','0 none');
		    	
		    	$('#na_date_select').css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$('#na_date_select').css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$('#na_date_select').css('outline','0 none');
		    	
		    	$('#na_year_select').css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$('#na_year_select').css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$('#na_year_select').css('outline','0 none');
			}
			
			if(month_val=="" && date_val !="" && year_val =="")
		    {
				na_date_errors = 1;
		    	$('#na_birthdate_error').show();
				
				//red black red
				$('#na_month_select').css('border-color','rgba(215, 44, 44, 0.8)'); 
			    $('#na_month_select').css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
			    $('#na_month_select').css('outline','0 none');
		    	
		    	$('#na_date_select').css('border-color','rgb(157, 168, 179)');
		    	$('#na_date_select').css('box-shadow','none');
		    	$('#na_date_select').css('outline','0 none');
		    	
		    	$('#na_year_select').css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$('#na_year_select').css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$('#na_year_select').css('outline','0 none');
			}
			
			if(month_val!="" && date_val !="" && year_val =="")
		    {
				na_date_errors = 1;
		    	$('#na_birthdate_error').show();
				
				//black black red
				$('#na_month_select').css('border-color','rgb(157, 168, 179)'); 
			    $('#na_month_select').css('box-shadow','none');
			    $('#na_month_select').css('outline','0 none');
		    	
		    	$('#na_date_select').css('border-color','rgb(157, 168, 179)');
		    	$('#na_date_select').css('box-shadow','none');
		    	$('#na_date_select').css('outline','0 none');
		    	
		    	$('#na_year_select').css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$('#na_year_select').css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$('#na_year_select').css('outline','0 none');
			}
			
			if(month_val=="" && date_val =="" && year_val !="")
		    {
				na_date_errors = 1;
		    	$('#na_birthdate_error').show();
				
				//red red black 
				$('#na_month_select').css('border-color','rgba(215, 44, 44, 0.8)');
			    $('#na_month_select').css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
			    $('#na_month_select').css('outline','0 none');
		    	
		    	$('#na_date_select').css('border-color','rgba(215, 44, 44, 0.8)');
		    	$('#na_date_select').css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$('#na_date_select').css('outline','0 none');
		    	
		    	$('#na_year_select').css('border-color','rgb(157, 168, 179)');
		    	$('#na_year_select').css('box-shadow','none');
		    	$('#na_year_select').css('outline','0 none');
			}
			
			if(month_val!="" && date_val =="" && year_val !="")
		    {
				na_date_errors = 1;
		    	$('#na_birthdate_error').show();
				
				//black red black 
				$('#na_month_select').css('border-color','rgb(157, 168, 179)');
			    $('#na_month_select').css('box-shadow','none');
			    $('#na_month_select').css('outline','0 none');
		    	
		    	$('#na_date_select').css('border-color','rgba(215, 44, 44, 0.8)');
		    	$('#na_date_select').css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$('#na_date_select').css('outline','0 none');
		    	
		    	$('#na_year_select').css('border-color','rgb(157, 168, 179)');
		    	$('#na_year_select').css('box-shadow','none');
		    	$('#na_year_select').css('outline','0 none');
			}
			
			if(month_val=="" && date_val !="" && year_val !="")
		    {
				na_date_errors = 1;
		    	$('#na_birthdate_error').show();
				
				//red black black 
				$('#na_month_select').css('border-color','rgba(215, 44, 44, 0.8)');
			    $('#na_month_select').css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
			    $('#na_month_select').css('outline','0 none');
		    	
		    	$('#na_date_select').css('border-color','rgb(157, 168, 179)');
		    	$('#na_date_select').css('box-shadow','none');
		    	$('#na_date_select').css('outline','0 none');
		    	
		    	$('#na_year_select').css('border-color','rgb(157, 168, 179)');
		    	$('#na_year_select').css('box-shadow','none');
		    	$('#na_year_select').css('outline','0 none');
			}
			
			if(month_val!="" && date_val !="" && year_val !="")
		    {
				na_date_errors = 0;
		    	$('#na_birthdate_error').hide();
				
				//black black black 
				$('#na_month_select').css('border-color','rgb(157, 168, 179)');
			    $('#na_month_select').css('box-shadow','none');
			    $('#na_month_select').css('outline','0 none');
		    	
		    	$('#na_date_select').css('border-color','rgb(157, 168, 179)');
		    	$('#na_date_select').css('box-shadow','none');
		    	$('#na_date_select').css('outline','0 none');
		    	
		    	$('#na_year_select').css('border-color','rgb(157, 168, 179)');
		    	$('#na_year_select').css('box-shadow','none');
		    	$('#na_year_select').css('outline','0 none');
			}
		    
		    //console.log("focus out ..." + m)
		   
		    
		  }
	});	
	
	////  new event  ///////////////////////////////////
	$( "#na_date_select" ).bind(
	{
		  focusin: function() {
		    	//console.log("focus in " );
		    	$(this).css('border-color','rgba(0, 0, 0, 0.8)');
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 4px rgba(0, 0, 0, 0.6)');
		    	$(this).css('outline','0 none');
		  },
		  blur: function() 
		  {
		  	var month_val = $('#na_month_select').val();
		    var date_val = $('#na_date_select').val();
		    var year_val = $('#na_year_select').val();
		  	    
		    if(month_val=="" && date_val =="" && year_val =="")
		    {
				na_date_errors = 1;
		    	$('#na_birthdate_error').show();
				
				//red red red
				$('#na_month_select').css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$('#na_month_select').css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$('#na_month_select').css('outline','0 none');
		    	
		    	$('#na_date_select').css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$('#na_date_select').css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$('#na_date_select').css('outline','0 none');
		    	
		    	$('#na_year_select').css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$('#na_year_select').css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$('#na_year_select').css('outline','0 none');
			}
			
			if(month_val!="" && date_val =="" && year_val =="")
		    {
				na_date_errors = 1;
		    	$('#na_birthdate_error').show();
				
				//black red red
				$('#na_month_select').css('border-color','rgb(157, 168, 179)'); 
			    $('#na_month_select').css('box-shadow','none');
			    $('#na_month_select').css('outline','0 none');
		    	
		    	$('#na_date_select').css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$('#na_date_select').css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$('#na_date_select').css('outline','0 none');
		    	
		    	$('#na_year_select').css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$('#na_year_select').css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$('#na_year_select').css('outline','0 none');
			}
			
			if(month_val=="" && date_val !="" && year_val =="")
		    {
				na_date_errors = 1;
		    	$('#na_birthdate_error').show();
				
				//red black red
				$('#na_month_select').css('border-color','rgba(215, 44, 44, 0.8)'); 
			    $('#na_month_select').css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
			    $('#na_month_select').css('outline','0 none');
		    	
		    	$('#na_date_select').css('border-color','rgb(157, 168, 179)');
		    	$('#na_date_select').css('box-shadow','none');
		    	$('#na_date_select').css('outline','0 none');
		    	
		    	$('#na_year_select').css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$('#na_year_select').css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$('#na_year_select').css('outline','0 none');
			}
			
			if(month_val!="" && date_val !="" && year_val =="")
		    {
				na_date_errors = 1;
		    	$('#na_birthdate_error').show();
				
				//black black red
				$('#na_month_select').css('border-color','rgb(157, 168, 179)'); 
			    $('#na_month_select').css('box-shadow','none');
			    $('#na_month_select').css('outline','0 none');
		    	
		    	$('#na_date_select').css('border-color','rgb(157, 168, 179)');
		    	$('#na_date_select').css('box-shadow','none');
		    	$('#na_date_select').css('outline','0 none');
		    	
		    	$('#na_year_select').css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$('#na_year_select').css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$('#na_year_select').css('outline','0 none');
			}
			
			if(month_val=="" && date_val =="" && year_val !="")
		    {
				na_date_errors = 1;
		    	$('#na_birthdate_error').show();
				
				//red red black 
				$('#na_month_select').css('border-color','rgba(215, 44, 44, 0.8)');
			    $('#na_month_select').css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
			    $('#na_month_select').css('outline','0 none');
		    	
		    	$('#na_date_select').css('border-color','rgba(215, 44, 44, 0.8)');
		    	$('#na_date_select').css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$('#na_date_select').css('outline','0 none');
		    	
		    	$('#na_year_select').css('border-color','rgb(157, 168, 179)');
		    	$('#na_year_select').css('box-shadow','none');
		    	$('#na_year_select').css('outline','0 none');
			}
			
			if(month_val!="" && date_val =="" && year_val !="")
		    {
				na_date_errors = 1;
		    	$('#na_birthdate_error').show();
				
				//black red black 
				$('#na_month_select').css('border-color','rgb(157, 168, 179)');
			    $('#na_month_select').css('box-shadow','none');
			    $('#na_month_select').css('outline','0 none');
		    	
		    	$('#na_date_select').css('border-color','rgba(215, 44, 44, 0.8)');
		    	$('#na_date_select').css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$('#na_date_select').css('outline','0 none');
		    	
		    	$('#na_year_select').css('border-color','rgb(157, 168, 179)');
		    	$('#na_year_select').css('box-shadow','none');
		    	$('#na_year_select').css('outline','0 none');
			}
			
			if(month_val=="" && date_val !="" && year_val !="")
		    {
				na_date_errors = 1;
		    	$('#na_birthdate_error').show();
				
				//red black black 
				$('#na_month_select').css('border-color','rgba(215, 44, 44, 0.8)');
			    $('#na_month_select').css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
			    $('#na_month_select').css('outline','0 none');
		    	
		    	$('#na_date_select').css('border-color','rgb(157, 168, 179)');
		    	$('#na_date_select').css('box-shadow','none');
		    	$('#na_date_select').css('outline','0 none');
		    	
		    	$('#na_year_select').css('border-color','rgb(157, 168, 179)');
		    	$('#na_year_select').css('box-shadow','none');
		    	$('#na_year_select').css('outline','0 none');
			}
			
			if(month_val!="" && date_val !="" && year_val !="")
		    {
				na_date_errors = 0;
		    	$('#na_birthdate_error').hide();
				
				//black black black 
				$('#na_month_select').css('border-color','rgb(157, 168, 179)');
			    $('#na_month_select').css('box-shadow','none');
			    $('#na_month_select').css('outline','0 none');
		    	
		    	$('#na_date_select').css('border-color','rgb(157, 168, 179)');
		    	$('#na_date_select').css('box-shadow','none');
		    	$('#na_date_select').css('outline','0 none');
		    	
		    	$('#na_year_select').css('border-color','rgb(157, 168, 179)');
		    	$('#na_year_select').css('box-shadow','none');
		    	$('#na_year_select').css('outline','0 none');
			}
		    
		    //console.log("focus out ..." + m)
		  }
	});	
	
	////  new event  ///////////////////////////////////
	$( "#na_year_select" ).bind(
	{
		  focusin: function() {
		    	//console.log("focus in " );
		    	$(this).css('border-color','rgba(0, 0, 0, 0.8)');
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 4px rgba(0, 0, 0, 0.6)');
		    	$(this).css('outline','0 none');
		  },
		  blur: function() 
		  {
		  	var month_val = $('#na_month_select').val();
		    var date_val = $('#na_date_select').val();
		    var year_val = $('#na_year_select').val();
		  	    
		    if(month_val=="" && date_val =="" && year_val =="")
		    {
				na_date_errors = 1;
		    	$('#na_birthdate_error').show();
				
				//red red red
				$('#na_month_select').css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$('#na_month_select').css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$('#na_month_select').css('outline','0 none');
		    	
		    	$('#na_date_select').css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$('#na_date_select').css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$('#na_date_select').css('outline','0 none');
		    	
		    	$('#na_year_select').css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$('#na_year_select').css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$('#na_year_select').css('outline','0 none');
			}
			
			if(month_val!="" && date_val =="" && year_val =="")
		    {
				na_date_errors = 1;
		    	$('#na_birthdate_error').show();
				
				//black red red
				$('#na_month_select').css('border-color','rgb(157, 168, 179)'); 
			    $('#na_month_select').css('box-shadow','none');
			    $('#na_month_select').css('outline','0 none');
		    	
		    	$('#na_date_select').css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$('#na_date_select').css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$('#na_date_select').css('outline','0 none');
		    	
		    	$('#na_year_select').css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$('#na_year_select').css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$('#na_year_select').css('outline','0 none');
			}
			
			if(month_val=="" && date_val !="" && year_val =="")
		    {
				na_date_errors = 1;
		    	$('#na_birthdate_error').show();
				
				//red black red
				$('#na_month_select').css('border-color','rgba(215, 44, 44, 0.8)'); 
			    $('#na_month_select').css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
			    $('#na_month_select').css('outline','0 none');
		    	
		    	$('#na_date_select').css('border-color','rgb(157, 168, 179)');
		    	$('#na_date_select').css('box-shadow','none');
		    	$('#na_date_select').css('outline','0 none');
		    	
		    	$('#na_year_select').css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$('#na_year_select').css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$('#na_year_select').css('outline','0 none');
			}
			
			if(month_val!="" && date_val !="" && year_val =="")
		    {
				na_date_errors = 1;
		    	$('#na_birthdate_error').show();
				
				//black black red
				$('#na_month_select').css('border-color','rgb(157, 168, 179)'); 
			    $('#na_month_select').css('box-shadow','none');
			    $('#na_month_select').css('outline','0 none');
		    	
		    	$('#na_date_select').css('border-color','rgb(157, 168, 179)');
		    	$('#na_date_select').css('box-shadow','none');
		    	$('#na_date_select').css('outline','0 none');
		    	
		    	$('#na_year_select').css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$('#na_year_select').css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$('#na_year_select').css('outline','0 none');
			}
			
			if(month_val=="" && date_val =="" && year_val !="")
		    {
				na_date_errors = 1;
		    	$('#na_birthdate_error').show();
				
				//red red black 
				$('#na_month_select').css('border-color','rgba(215, 44, 44, 0.8)');
			    $('#na_month_select').css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
			    $('#na_month_select').css('outline','0 none');
		    	
		    	$('#na_date_select').css('border-color','rgba(215, 44, 44, 0.8)');
		    	$('#na_date_select').css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$('#na_date_select').css('outline','0 none');
		    	
		    	$('#na_year_select').css('border-color','rgb(157, 168, 179)');
		    	$('#na_year_select').css('box-shadow','none');
		    	$('#na_year_select').css('outline','0 none');
			}
			
			if(month_val!="" && date_val =="" && year_val !="")
		    {
				na_date_errors = 1;
		    	$('#na_birthdate_error').show();
				
				//black red black 
				$('#na_month_select').css('border-color','rgb(157, 168, 179)');
			    $('#na_month_select').css('box-shadow','none');
			    $('#na_month_select').css('outline','0 none');
		    	
		    	$('#na_date_select').css('border-color','rgba(215, 44, 44, 0.8)');
		    	$('#na_date_select').css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$('#na_date_select').css('outline','0 none');
		    	
		    	$('#na_year_select').css('border-color','rgb(157, 168, 179)');
		    	$('#na_year_select').css('box-shadow','none');
		    	$('#na_year_select').css('outline','0 none');
			}
			
			if(month_val=="" && date_val !="" && year_val !="")
		    {
				na_date_errors = 1;
		    	$('#na_birthdate_error').show();
				
				//red black black 
				$('#na_month_select').css('border-color','rgba(215, 44, 44, 0.8)');
			    $('#na_month_select').css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
			    $('#na_month_select').css('outline','0 none');
		    	
		    	$('#na_date_select').css('border-color','rgb(157, 168, 179)');
		    	$('#na_date_select').css('box-shadow','none');
		    	$('#na_date_select').css('outline','0 none');
		    	
		    	$('#na_year_select').css('border-color','rgb(157, 168, 179)');
		    	$('#na_year_select').css('box-shadow','none');
		    	$('#na_year_select').css('outline','0 none');
			}
			
			if(month_val!="" && date_val !="" && year_val !="")
		    {
				na_date_errors = 0;
		    	$('#na_birthdate_error').hide();
				
				//black black black 
				$('#na_month_select').css('border-color','rgb(157, 168, 179)');
			    $('#na_month_select').css('box-shadow','none');
			    $('#na_month_select').css('outline','0 none');
		    	
		    	$('#na_date_select').css('border-color','rgb(157, 168, 179)');
		    	$('#na_date_select').css('box-shadow','none');
		    	$('#na_date_select').css('outline','0 none');
		    	
		    	$('#na_year_select').css('border-color','rgb(157, 168, 179)');
		    	$('#na_year_select').css('box-shadow','none');
		    	$('#na_year_select').css('outline','0 none');
			}
		    
		    //console.log("focus out ..." + m)  
		  }
	});		
	
	
	////  new event  ///////////////////////////////////
	$( "#na_email" ).bind(
	{
		  focusin: function() {
		    	//console.log("focus in " );
		    	$(this).css('border-color','rgba(0, 0, 0, 0.8)');
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 4px rgba(0, 0, 0, 0.6)');
		    	$(this).css('outline','0 none');
		  },
		  blur: function() {
		    var typed_txt = $(this).val();
		    var txt_length_ok = false;
		    var txt_length = typed_txt.length;
		    if((txt_length > 4) )
		    {
				txt_length_ok = true;
			}
		    //alert(password_length_ok);
		    
		    txt_length_bad = !txt_length_ok;
		    
		    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  			var is_valid_email =  re.test(typed_txt);
  			
		    if(is_valid_email && txt_length_ok)
		    {
				na_email_errors = 0;
				$('#na_email_error').hide();
				$(this).css('border-color','rgb(157, 168, 179)'); 
		    	$(this).css('box-shadow','none');
		    	$(this).css('outline','0 none');
		    	
		    	na_email_already_in_use_error = 0;
		    	
		    	

			}
			else
			{
		    	na_email_errors = 1;
				$('#na_email_error').show();
				//red shadow
				$(this).css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$(this).css('outline','0 none');
		    	
			}
   
		    
		  }
	});
	
	////  new event  ///////////////////////////////////
	$( "#ba_email" ).bind(
	{
		  focusin: function() {
		    	//console.log("focus in " );
		    	$(this).css('border-color','rgba(0, 0, 0, 0.8)');
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 4px rgba(0, 0, 0, 0.6)');
		    	$(this).css('outline','0 none');
		  },
		  blur: function() {
		    var typed_txt = $(this).val();
		    var txt_length_ok = false;
		    var txt_length = typed_txt.length;
		    if((txt_length > 4) )
		    {
				txt_length_ok = true;
			}
		    //alert(password_length_ok);
		    
		    txt_length_bad = !txt_length_ok;
		    
		    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  			var is_valid_email =  re.test(typed_txt);
  			
		    if(is_valid_email && txt_length_ok)
		    {
				ba_email_errors = 0;
				$('#ba_email_error').hide();
				$(this).css('border-color','rgb(157, 168, 179)'); 
		    	$(this).css('box-shadow','none');
		    	$(this).css('outline','0 none');
		    	
		    	//email is valid we check it now via ajax 
		    	//start ajax
		    	var target_url = '<?php echo($secure_base_url."customer/xcheck_customer/") ; ?>' 
	
				var Data2send = {email:typed_txt};
				var email_flag = 0;
				  	 
				$.ajax(
				{
					url : target_url,
					data: Data2send,
					type: "GET",
					success: function(return_data)
					{
						//console.log(return_data);
						if(return_data == 1)
						{
							ba_email_already_in_use_error = 1;
							$('#ba_email_already_in_use_error').show();
							//red shadow
							$('#ba_email').css('border-color','rgba(215, 44, 44, 0.8)'); 
					    	$('#ba_email').css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
					    	$('#ba_email').css('outline','0 none');
						}
						else
						{
							ba_email_already_in_use_error = 0;
							$('#ba_email_already_in_use_error').hide();
							$('#ba_email').css('border-color','rgb(157, 168, 179)'); 
					    	$('#ba_email').css('box-shadow','none');
					    	$('#ba_email').css('outline','0 none');
							
						}
						
					},
					error: function(jqXHR, textStatus, errorThrown)
					{
						console.log('textStatus='+textStatus);
						console.log('errorThrown='+errorThrown);
					}
				});
				//finish ajax
		    	
		    	

			}
			else
			{
		    	ba_email_errors = 1;
				$('#ba_email_error').show();
				//red shadow
				$(this).css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$(this).css('outline','0 none');
		    	
			}
   
		    
		  }
	});
	
	////  new event  ///////////////////////////////////
	$( "#na_confirm_email" ).bind(
	{
		  focusin: function() {
		    	//console.log("focus in " );
		    	$(this).css('border-color','rgba(0, 0, 0, 0.8)');
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 4px rgba(0, 0, 0, 0.6)');
		    	$(this).css('outline','0 none');
		  },
		  blur: function() {
		    var na_email_value =  $( "#na_email" ).val();
		    var typed_txt = $(this).val();
		    var txt_length_ok = false;
		    var txt_length = typed_txt.length;
		    if((txt_length > 4) )
		    {
				txt_length_ok = true;
			}
		    //alert(password_length_ok);
		    
		    txt_length_bad = !txt_length_ok;
		    
		    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  			var is_valid_email =  re.test(typed_txt);
  			
		    if(is_valid_email && txt_length_ok)
		    {
				na_confirm_email_errors = 0;
				$('#na_confirm_email_error').hide();
				$(this).css('border-color','rgb(157, 168, 179)'); 
		    	$(this).css('box-shadow','none');
		    	$(this).css('outline','0 none');
			}
			else
			{
		    	na_confirm_email_errors = 1;
				$('#na_confirm_email_error').show();
				//red shadow
				$(this).css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$(this).css('outline','0 none');
			}
			
			if(typed_txt != na_email_value )
			{
				na_confirm_email_errors2 = 1;
				$('#na_confirm_email_error2').show();
				//red shadow
				$(this).css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$(this).css('outline','0 none');
			}
			else
			{
		    	na_confirm_email_errors2 = 0;
				$('#na_confirm_email_error2').hide();
				$(this).css('border-color','rgb(157, 168, 179)'); 
		    	$(this).css('box-shadow','none');
		    	$(this).css('outline','0 none');
			}
   
		    
		  }
	});
	
	
	////  new event  ///////////////////////////////////
	$( "#na_login_password" ).bind(
	{
		  focusin: function() {
		    	//console.log("focus in " );
		    	$(this).css('border-color','rgba(0, 0, 0, 0.8)');
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 4px rgba(0, 0, 0, 0.6)');
		    	$(this).css('outline','0 none');
		  },
		  blur: function() {
		    var typed_txt = $(this).val();
		    var typed_password2 = $('#na_confirm_password').val();
		    var txt_length_ok = false;
		    var txt_length = typed_txt.length;
		    if((txt_length > 4) && (txt_length < 17) )
		    {
				txt_length_ok = true;
			}
		    //alert(password_length_ok);
		    
		    txt_length_bad = !txt_length_ok;
		    
			var re = /(.*\+)|(.*\=)|(.*,)|(.*\\)|(.*\+)|(.*\-)|(.*\|)|(.*\/)|(.* )|(.*%)/; 
		    var m;
 
			if ((m = re.exec(typed_txt)) !== null) {
			    if (m.index === re.lastIndex) {
			        re.lastIndex++;
			    }
			    // View your result using the m-variable.
			    // eg m[0] etc.
			}
			
			//if a match was found		    
		    if(m || txt_length_bad)  		
		    {
				na_login_password_errors = 1;
				$('#na_login_password_error').show();
				//red shadow
				$(this).css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$(this).css('outline','0 none');
			}
			else
			{
		    	
		    	na_login_password_errors = 0;
				$('#na_login_password_error').hide();
				$(this).css('border-color','rgb(157, 168, 179)'); 
		    	$(this).css('box-shadow','none');
		    	$(this).css('outline','0 none');
			}
			if(typed_password2.length > 0  && typed_txt != typed_password2)
			{
				na_login_password_errors = 1;
				$('#na_login_password_error2').show();
				//red shadow
				$(this).css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$(this).css('outline','0 none');
			}
			else
			{
				na_login_password_errors = 0;
				$('#na_login_password_error2').hide();
				$('#na_confirm_password_error2').hide();
				$(this).css('border-color','rgb(157, 168, 179)'); 
		    	$(this).css('box-shadow','none');
		    	$(this).css('outline','0 none');
			}
		  }
	});
	
	
	
	////  new event  ///////////////////////////////////
	$( "#na_confirm_password" ).bind(
	{
		  focusin: function() {
		    	//console.log("focus in " );
		    	$(this).css('border-color','rgba(0, 0, 0, 0.8)');
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 4px rgba(0, 0, 0, 0.6)');
		    	$(this).css('outline','0 none');
		  },
		  blur: function() {
		    var typed_txt = $(this).val();
		    var txt_length_ok = false;
		    var txt_length = typed_txt.length;
		    if((txt_length > 4) && (txt_length < 17) )
		    {
				txt_length_ok = true;
			}
		    //alert(password_length_ok);
		    
		    txt_length_bad = !txt_length_ok;
		    
		    var pass1 = $( "#na_login_password" ).val();
		    
		    if(pass1 != typed_txt )
		    {
				//password not matching
				na_confirm_password_errors = 1;
				$('#na_confirm_password_error2').show();
			}
			else
			{
				na_confirm_password_errors = 0;
				$('#na_confirm_password_error2').hide();
				$('#na_login_password_error2').hide();
				
			}
		    
			var re = /(.*\+)|(.*\=)|(.*,)|(.*\\)|(.*\+)|(.*\-)|(.*\|)|(.*\/)|(.* )|(.*%)/; 
		    var m;
 
			if ((m = re.exec(typed_txt)) !== null) {
			    if (m.index === re.lastIndex) {
			        re.lastIndex++;
			    }
			    // View your result using the m-variable.
			    // eg m[0] etc.
			}
			
			//if a match was found		    
		    if(m || txt_length_bad)  		
		    {
				na_confirm_password_errors = 1;
				$('#na_confirm_password_error').show();
				//red shadow
				$(this).css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$(this).css('outline','0 none');
			}
			else
			{
		    	
		    	na_confirm_password_errors = 0;
				$('#na_confirm_password_error').hide();
				$(this).css('border-color','rgb(157, 168, 179)'); 
		    	$(this).css('box-shadow','none');
		    	$(this).css('outline','0 none');
			}
   
		    
		  }
	});
	
	////  new event  ///////////////////////////////////
	$( "#na_phone" ).bind(
	{
		  focusin: function() {
		    	//console.log("focus in " );
		    	$(this).css('border-color','rgba(0, 0, 0, 0.8)');
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 4px rgba(0, 0, 0, 0.6)');
		    	$(this).css('outline','0 none');
		  },
		  blur: function() {
		    // Do something on mouseenter
		    var typed_phone = $(this).val();
		    var typed_phone_ok = false;
		    typed_phone_length = typed_phone.length;
		    if((typed_phone_length > 4) )
		    {
				typed_phone_ok = true;
			}
		    //alert(password_length_ok);
		    
		    typed_phone_length_bad = !typed_phone_ok;
				
		    // any special charachters
		    var re = /(.*\=)|(.*,)|(.*\\)|(.*\|)|(.*\/)|(.*%)|(.*#)|(.*\$)|(.*\@)|(.*\~)|(.*\?)|(.*\>)|(.*\<)|(.*\!)|(.*\[)|(.*\])|(.*\{)|(.*\})|(.*\^)|(.*\&)|(.*\*)|(.*\=)|(.*\:)|(.*\;)|[a-w]|[y-z]|[A-W]|[Y-Z]/;
		    var m;
 
			if ((m = re.exec(typed_phone)) !== null) {
			    if (m.index === re.lastIndex) {
			        re.lastIndex++;
			    }
			    //  m[0] etc... 
			}
			
			//if a match was found		    
		    if(m || typed_phone_length_bad)
		    {
				na_phone_errors = 1;
				$('#na_phone_error').show();
				//red shadow
				$(this).css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$(this).css('outline','0 none');
			}
			else
			{
				na_phone_errors = 0;
				$('#na_phone_error').hide();
				$(this).css('border-color','rgb(157, 168, 179)'); 
		    	$(this).css('box-shadow','none');
		    	$(this).css('outline','0 none');
			}
			
			
		    
		    
		    //console.log("focus out ..." + m)
		   
		    
		  }
	});	
	
	////  new event  ///////////////////////////////////
	$( "#ba_phone" ).bind(
	{
		  focusin: function() {
		    	//console.log("focus in " );
		    	$(this).css('border-color','rgba(0, 0, 0, 0.8)');
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 4px rgba(0, 0, 0, 0.6)');
		    	$(this).css('outline','0 none');
		  },
		  blur: function() {
		    // Do something on mouseenter
		    var typed_phone = $(this).val();
		    var typed_phone_ok = false;
		    typed_phone_length = typed_phone.length;
		    if((typed_phone_length > 4) )
		    {
				typed_phone_ok = true;
			}
		    //alert(password_length_ok);
		    
		    typed_phone_length_bad = !typed_phone_ok;
				
		    // any special charachters
		    var re = /(.*\=)|(.*,)|(.*\\)|(.*\|)|(.*\/)|(.*%)|(.*#)|(.*\$)|(.*\@)|(.*\~)|(.*\?)|(.*\>)|(.*\<)|(.*\!)|(.*\[)|(.*\])|(.*\{)|(.*\})|(.*\^)|(.*\&)|(.*\*)|(.*\=)|(.*\:)|(.*\;)|[a-w]|[y-z]|[A-W]|[Y-Z]/;
		    var m;
 
			if ((m = re.exec(typed_phone)) !== null) {
			    if (m.index === re.lastIndex) {
			        re.lastIndex++;
			    }
			    //  m[0] etc... 
			}
			
			//if a match was found		    
		    if(m || typed_phone_length_bad)
		    {
				ba_phone_errors = 1;
				$('#ba_phone_error').show();
				//red shadow
				$(this).css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$(this).css('outline','0 none');
			}
			else
			{
				ba_phone_errors = 0;
				$('#ba_phone_error').hide();
				$(this).css('border-color','rgb(157, 168, 179)'); 
		    	$(this).css('box-shadow','none');
		    	$(this).css('outline','0 none');
			}
			
			
		    
		    
		    //console.log("focus out ..." + m)
		   
		    
		  }
	});	
	
	////  when promo code gets and loses focus  ///////////////////////////////////
	$( "#promo_code_field" ).bind(
	{
		  focusin: function() {
		    	//console.log("focus in " );
		    	$(this).css('border-color','rgba(0, 0, 0, 0.8)');
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 4px rgba(0, 0, 0, 0.6)');
		    	$(this).css('outline','0 none');
		  },
		  blur: function() {
		    var typed_txt = $(this).val();
		    var txt_length_ok = false;
		    var txt_length = typed_txt.length;
		    if(1)
		    {
				txt_length_ok = true;
			}
		    //alert(password_length_ok);
		    
		    txt_length_bad = !txt_length_ok;
		    
		    // any special charachters
		    var re = /(.*\+)|(.*\=)|(.*,)|(.*\\)|(.*\+)|(.*\|)|(.*\/)|(.*%)|(.*#)|(.*\$)|(.*\@)|(.*\~)|(.*\?)|(.*\>)|(.*\<)|(.*\!)|(.*\[)|(.*\])|(.*\{)|(.*\})|(.*\^)|(.*\&)|(.*\*)|(.*\()|(.*\))|(.*\=)|(.*\:)|(.*\;)/; 
		    var m;
 
			if ((m = re.exec(typed_txt)) !== null) {
			    if (m.index === re.lastIndex) {
			        re.lastIndex++;
			    }
			    //  m[0] etc... 
			}
			
			//if a match was found		    
		    if(m || txt_length_bad)
		    {
				promo_code_field_errors = 1;
				$('#promo_code_field_error').show();
				//red shadow
				$(this).css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$(this).css('outline','0 none');
			}
			else
			{
				promo_code_field_errors = 0;
				$('#promo_code_field_error').hide();
				$(this).css('border-color','rgb(157, 168, 179)'); 
		    	$(this).css('box-shadow','none');
		    	$(this).css('outline','0 none');
			}
		    
		    
		    //console.log("focus out ..." + m)
		   
		    
		  }
	});
	
	///////////////////////
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
			$("#loadingDiv").css("display", "block");
			//hide the message box
			$("#message_box").css("background-color", "#FFE6E6");
			$("#message_box").hide();
			
			var DataPromotion = {promotion_code_value:promotion_code};
			//
			var target_url = '<?php echo($secure_base_url."carta/apply_promo_code") ; ?>';
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
						
						$("#loadingDiv").css("display", "none");
						if(data == "empty")
						{
							// no promotion code was entred 
						}
						if(data == "0")
						{
							// no valid code entered
							$("#success_promo_msg").hide();
							$("#error_promo_msg").show();
							//$("#message_box").show();
							//$("#message_box").html("<strong>code not valid</storng>");
							//$("#message_box").html('<div class="alert alert-danger" role="alert">'+msg_promo_bad+'</div>');
							
							//alert("not_valid");
						}
						if(data == "1")
						{
							// code applied
							$("#error_promo_msg").hide();
							$("#success_promo_msg").show();
							//alert(1);
							// $('[data-popup="pop_up_box"]').fadeIn(350);
							//$("#message_box").css("background-color", "#DCFFDC");
							//$("#message_box").show();
							//$("#message_box").html('<span class="glyphicon glyphicon-ok"> </span> Promotion Code Applied! ');
							//$("#message_box").html('<div class="alert alert-success" role="alert">'+msg_promo_ok+'</div>');
							
							
							//ajax call to update the prices
							//lets ajax 
						    var target_url = '<?php echo($secure_base_url."carta/ajax_calc") ; ?>'; // the script where you handle the form input.
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
										$('#total_discount').html("- "+sa_currency+(prices.discount_total).formatMoney(2,',','.'));
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
	
	////  new event  ///////////////////////////////////
	//WHEN CLICK ON place order 
	$( "#place_order" ).bind(
	{
		  click: function(e) 
		  {
				
	    	//e.preventDefault();
	    	
	    	//if no form errors
	    	if(na_firstname_errors == 0 && na_lastname_errors == 0 && na_sha_line1_errors == 0 && na_sha_line2_errors == 0 && na_zipcode_errors == 0 && na_phone_errors == 0 && na_attention_errors == 0 &&	ba_firstname_errors == 0 && ba_lastname_errors == 0 && ba_zipcode_errors == 0 && ba_email_errors == 0 && ba_phone_errors == 0 && na_card_num_error == 0 && na_ccard_date_select_error == 0 && na_sec_code_error == 0 && ba_email_already_in_use_error ==0)
	    	{
	    		//submit
	    		var forms_data = $('#na_form, #ba_form').serialize();
	    		
	    		//lets ajax 
				//alert(email);

				var target_url = '<?php echo($secure_base_url."checkout/xcheckout_as_guest/") ; ?>' ;
				
				var Data2send = {checkout_data:forms_data};
				
				$('#progress_bar').show(); 
				$("#declined").hide(1000);
				  	 
				$.ajax(
				{
					url : target_url,
					data: forms_data,
					type: "GET",
					success: function(return_data)
					{
						$('#progress_bar').hide();
						
						data = JSON && JSON.parse(return_data) || $.parseJSON(return_data);
						console.log(data);
						
						//////////////////////// success no email
						if(data.order_flag == 1 && data.payement_flag == 1 && data.email_flag == 0 )
						{
							//alert('thank you ! your order was succesfully processed but our mail system is temporary down for maintenece , you can still access your order details by going to your profile/ order history.');
							$('#checkout_data_input').hide(1000);
							$('#checkout_data_output_out_success').show(1000,scroll_to_black_single_text);
							$('#cart').hide(1000);
							
							var name = data.user_f_name
							var UpperCasename = name.toUpperCase();
							$('#user__name').text(UpperCasename);
							
							$('#order__no').text(data.order_id);
						}
						//////////////////////// success with email
						if(data.order_flag == 1 && data.payement_flag == 1 && data.email_flag == 1 )
						{
							//alert('Thank you! <br> Your order was succesfully processed an email has been sent');
							$('#checkout_data_output_out_success').show(1000,scroll_to_black_single_text);
							$('#checkout_data_input').hide(1000);
							$('#cart').hide(1000);
							
							var name = data.user_f_name
							var UpperCasename = name.toUpperCase();
							$('#user__name').text(UpperCasename);
							
							$('#order__no').text(data.order_id);
						}
						//////////////////////// connection error
						if(data.conn_error_flag ==1)
						{
							alert('your payment did not go through, pease try again there was a connection problem with the server.');
						}
						//////////////////////// form error
						if(data.regex_error == "1")
						{
							alert('please turn on javascript on your browser');
						}
						//////////////////////// declined
						if (data.declined_flag == "1") 
						{
							$('#declined').show(1000).delay(5000).fadeOut(1000);
						}
						//////////////////////// session expired
						if(data.sessionexpired_flag == "1")
						{
							alert('your session expired!');
						}
						////////////////////////
						
					},
					error: function(jqXHR, textStatus, errorThrown)
					{
						console.log('textStatus='+textStatus);
						console.log('errorThrown='+errorThrown);
					}
				});
	    		
	    		
	    		//submit
	    		//return true;
	    		
	    		//alert('submitting...');
	    		return false; // for debugging
			}
			else
			{
				// loop through all form input elements, and focusin then focusout
				$("#na_form").each(function()
				{
			    	input_elm = $(this).find(':input') //<-- Should return all input elements in that specific form.
			    	$(input_elm).focus(); // focus in and out to trigger the validation mechanism
				});
				
				return false;
				
			}
		  }
	});
	
	function scroll_to_address_summary(){
		$('html, body').animate({        scrollTop: $("#address_summary").offset().top    }, 2000);
	}
	
	function scroll_to_black_single_text(){
		$('html, body').animate({        scrollTop: $(".black-single-text").offset().top    }, 2000);
	}
	

	
	
	////  new event  ///////////////////////////////////
	//when click on continue  
	$( "#na_continue_btn" ).bind(
	{
		  click: function(e) 
		  {
				
			// loop through all form input elements, and focusin then focusout
			$("#na_form").each(function(){
		    input_elm = $(this).find(':input') //<-- Should return all input elements in that specific form.
		    $(input_elm).focus(); // focus in and out to trigger the validation mechanism
		    
		        
		    
			});
	    	
	    	//e.preventDefault();
	    	if(na_firstname_errors == 0 && na_lastname_errors == 0 && na_sha_line1_errors == 0 && na_sha_line2_errors == 0 && na_zipcode_errors == 0 && na_phone_errors == 0 && na_attention_errors == 0 )
	    	{
	    		if(ba_firstname_errors == 0 && ba_lastname_errors == 0 && ba_zipcode_errors == 0 && ba_email_errors == 0 && ba_phone_errors == 0 && na_card_num_error == 0 && na_ccard_date_select_error == 0 && na_sec_code_error == 0 && ba_email_already_in_use_error ==0 )
	    		{
					order_form_errors = 0;
					//alert('everything seems alright, you can place the order' );
					$("#place_order").removeClass( "place_order_inactive" ).addClass( "place_order_active" );
				}
				else
				{
					order_form_errors = 1;
					//alert('somrthing is not right, you can not place the order yet!');
					$("#place_order").removeClass( "place_order_active" ).addClass( "place_order_inactive" );
				}
	    		//submit
	    		//return true;
	    		
				$("#payement_method").show(2000);
				$("#payment_summary").hide(2000);
				
				$("#address_summary").show(2000);
		    	$("#spacer123564540").show();
				$( "#spcer4654321" ).hide(2000);
				//$( "#shipping_address_details" ).hide(2000);
				$( "#shipping_address_details" ).hide(2000,scroll_to_address_summary);
				
	    		$("#summary_first_name" ).text($("#na_firstname" ).val()) ;
	    		$("#summary_last_name" ).text($("#na_lastname" ).val()) ;
	    		$("#summary_line1" ).text($("#na_sha_line1" ).val()) ;
	    		$("#summary_line2" ).text($("#na_sha_line2" ).val()) ;
	    		$("#summary_city" ).text($("#na_city_select option:selected" ).text()) ;
	    		$("#summary_county" ).text($("#na_county_select option:selected" ).text()) ;
	    		//$("#xxxxxxxxx" ).text($("#na_country_select" ).text()) ;
	    		$("#summary_zip" ).text($("#na_zipcode" ).val()) ;
	    		$("#summary_phone" ).text($("#na_phone" ).val()) ;
	    		
	    		return false; // for debugging
			}
			else
			{	
				order_form_errors = 1;
				$("#place_order").removeClass( "place_order_active" ).addClass( "place_order_inactive" );
				
				return false;
				
			}
		  }
	});
	
		////  new event  ///////////////////////////////////
	//when click on continue  
	$( "#review_order_btn" ).bind(
	{
		  click: function(e) 
		  {
				
			// loop through all form input elements, and focusin then focusout
			$("#ba_form").each(function(){
		    input_elm = $(this).find(':input') //<-- Should return all input elements in that specific form.
		    $(input_elm).focus(); // focus in and out to trigger the validation mechanism
			});
	    	
	    	if(ba_firstname_errors == 0 && ba_lastname_errors == 0 && ba_zipcode_errors == 0 && ba_email_errors == 0 && ba_phone_errors == 0 && na_card_num_error == 0 && na_ccard_date_select_error == 0 && na_sec_code_error == 0 && ba_email_already_in_use_error ==0 && na_login_password_errors ==0 && na_confirm_password_errors ==0 ) 
	    	{
	    		if( na_firstname_errors == 0 && na_lastname_errors == 0 && na_sha_line1_errors == 0 && na_sha_line2_errors == 0 && na_zipcode_errors == 0 &&   na_phone_errors == 0 &&  na_attention_errors == 0 )
	    		{
					order_form_errors = 0;
					//alert('everything seems alright, you can place the order');
					$("#place_order").removeClass( "place_order_inactive" ).addClass( "place_order_active" );
					
				}
				else
				{
					order_form_errors = 1;
					//alert('somrthing is not right, you can not place the order yet!');
					$("#place_order").removeClass( "place_order_active" ).addClass( "place_order_inactive" );
				}
	    		//submit
	    		//return true;
	    		//alert('no payement error');
				$("#payment_summary").show(2000);
				//$( "#payement_method" ).hide(2000);
				$( "#spacer123564540" ).hide(2000);
				$( "#payement_method" ).hide(2000,scroll_to_address_summary);
				
				// stars instead of numbers
				var cnum = $("#na_card_num" ).val();
				var last4 = cnum.slice(-4);
				var cnum_length = cnum.length;
				var cnum_starred = "";
				for(z = 0; z<cnum_length-4; z++)
				{
					cnum_starred += "*";
				}
				cnum_starred += last4;
				
	    		$("#summary_card_type" ).text($("#na_ccard_select option:selected" ).text()) ;
	    		$("#summary_card_number " ).text(cnum_starred) ;
	    		$("#summary_exiration_month" ).text($("#na_ccard_month_select option:selected" ).text()) ;
	    		$("#summary_exiration_year" ).text($("#na_ccard_year_select option:selected" ).text()) ;
	    		$("#summary_email" ).text($("#ba_email" ).val()) ;
	    		$("#summary_phone" ).text($("#ba_phone" ).val()) ;
	    		
	    		return false; // for debugging
			}
			else
			{
				order_form_errors = 1;
				$("#place_order").removeClass( "place_order_active" ).addClass( "place_order_inactive" );
					
				console.log('var error');
				return false;
				
				
			}
		  }
	});

	
	
	////  new event  ///////////////////////////////////
	//when click on summary edit button   
	$( "#summary_edit_btn" ).bind(
	{
		  click: function(e) 
		  {
				
			$("#shipping_address_details").show(2000);
			$("#address_summary").hide(2000);
			return false;
		  }
	});
	
	////  new event  ///////////////////////////////////
	//when click on summary edit button 2  
	$( "#summary_edit_btn2" ).bind(
	{
		  click: function(e) 
		  {
				
			$( "#spacer123564540" ).show();
			$("#payement_method").show(2000);
			$("#payment_summary").hide(2000);
			return false;
		  }
	});
	
	////  new event  ///////////////////////////////////
	//when click on SAME AS SHIPING ADDRESS
	$( "#same_as_shipping" ).bind(
	{
		  click: function(e) 
		  {
			// copy from shipping to billing
			
			$("#ba_firstname" ).val($("#na_firstname" ).val()) ;
    		$("#ba_lastname" ).val($("#na_lastname" ).val()) ;
    		$("#ba_sha_line1" ).val($("#na_sha_line1" ).val()) ;
    		$("#ba_sha_line2" ).val($("#na_sha_line2" ).val()) ;
    		$("#ba_city_select" ).val($("#na_city_select option:selected" ).val()) ;
    		$("#ba_county_select" ).val($("#na_county_select option:selected" ).val()) ;
    		$("#ba_zipcode" ).val($("#na_zipcode" ).val()) ;
    		
    		// remove the red alerts if any 
			$('#ba_fname_error').hide();
			$("#ba_firstname").css('border-color','rgb(157, 168, 179)'); 
	    	$("#ba_firstname").css('box-shadow','none');
	    	$("#ba_firstname").css('outline','0 none');
	    	
	    	$('#ba_lname_error').hide();
			$("#ba_lastname").css('border-color','rgb(157, 168, 179)'); 
	    	$("#ba_lastname").css('box-shadow','none');
	    	$("#ba_lastname").css('outline','0 none');
	    	
	    	$('#ba_line1_error').hide();
			$("#ba_sha_line1").css('border-color','rgb(157, 168, 179)'); 
	    	$("#ba_sha_line1").css('box-shadow','none');
	    	$("#ba_sha_line1").css('outline','0 none');
	    	
	    	$('#ba_line2_error').hide();
			$("#ba_sha_line2").css('border-color','rgb(157, 168, 179)'); 
	    	$("#ba_sha_line2").css('box-shadow','none');
	    	$("#ba_sha_line2").css('outline','0 none');
	    	
	    	$('#ba_zip_error').hide();
			$("#ba_zipcode").css('border-color','rgb(157, 168, 179)'); 
	    	$("#ba_zipcode").css('box-shadow','none');
	    	$("#ba_zipcode").css('outline','0 none');
			
		  }
	});
	
	
	
	////  new event  ///////////////////////////////////
	//WHEN CLICK ON SUBMIT 
	$( "#na_submit_btn , #na_submit_btn2" ).bind(
	{
		  click: function(e) 
		  {
				
			// loop through all form input elements, and focusin then focusout
			$("#na_form").each(function(){
		    input_elm = $(this).find(':input') //<-- Should return all input elements in that specific form.
		    $(input_elm).focus(); // focus in and out to trigger the validation mechanism
		        
		    
			});
	    	
	    	//e.preventDefault();
	    	if(na_firstname_errors == 0 && na_lastname_errors == 0 && na_sha_line1_errors == 0 && na_sha_line2_errors == 0 && na_zipcode_errors == 0 && na_phone_errors == 0 && na_attention_errors == 0 )
	    	{
	    		//submit
	    		return true;
	    		
	    		//alert('submitting...');
	    		//return false; // for debugging
			}
			else
			return false;
		  }
	});

	////////////////////////////////// do something else now 
	
	

}); // end document ready 

function check_email(email)
{
	//lets ajax
	//alert(email);

	var target_url = '<?php echo($secure_base_url."customer/xcheck_customer/") ; ?>' 
	
	var Data2send = {email:email};
	var email_flag = 0;
	  	 
	$.ajax(
	{
		url : target_url,
		data: Data2send,
		type: "GET",
		success: function(return_data)
		{
			//console.log(return_data);
			if(return_data == 1) email_flag = 1 ; else email_flag = 0;
			var oo = 55; 
			return email_flag;
			
		},
		error: function(jqXHR, textStatus, errorThrown)
		{
			console.log('textStatus='+textStatus);
			console.log('errorThrown='+errorThrown);
		}
	});
	
	return email_flag;
}

	////  new event  ///////////////////////////////////
	// CREDIT CARD 
	$( "#na_card_num" ).bind(
	{
		  focusin: function() {
		    	//console.log("focus in " );
		    	$('#na_card_num_error').hide();
		    	$(this).css('border-color','rgba(0, 0, 0, 0.8)');
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 4px rgba(0, 0, 0, 0.6)');
		    	$(this).css('outline','0 none');
		  },
		  blur: function() {
		   		    
		    var card_type = $('#na_ccard_select').val();
		    
		    var typed_txt = $(this).val();
		    // credit card regex
		    // if is a visa card 
		    if(card_type == "visa")
		    {
		    	//alert(card_type);
		    	var re = /^4[0-9]{12}(?:[0-9]{3})?$/; 
			    var m;
	 
				if ((m = re.exec(typed_txt)) !== null) {
				    if (m.index === re.lastIndex) {
				        re.lastIndex++;
				    }
				    //  m[0] etc... 
				}
				
				//if a match was found 
			    if(m)
			    {
			    	na_card_num_error = 0;
					$('#na_card_num_error').hide();
					$(this).css('border-color','rgb(157, 168, 179)'); 
			    	$(this).css('box-shadow','none');
			    	$(this).css('outline','0 none');
				}
				else
				{
			    	na_card_num_error = 1;
			    	$('#na_card_num_error').show();
					//red shadow
					$(this).css('border-color','rgba(215, 44, 44, 0.8)'); 
			    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
			    	$(this).css('outline','0 none');
			    	
				}
				
		    }
		    if(card_type == "mc")
		    {
		    	//alert(card_type);
		    	var re = /^(?:5[1-5][0-9]{2}|222[1-9]|22[3-9][0-9]|2[3-6][0-9]{2}|27[01][0-9]|2720)[0-9]{12}$/; 
			    var m;
	 
				if ((m = re.exec(typed_txt)) !== null) {
				    if (m.index === re.lastIndex) {
				        re.lastIndex++;
				    }
				    //  m[0] etc... 
				}
				
				//if a match was found 
			    if(m)
			    {
			    	na_card_num_error = 0;
					$('#na_card_num_error').hide();
					$(this).css('border-color','rgb(157, 168, 179)'); 
			    	$(this).css('box-shadow','none');
			    	$(this).css('outline','0 none');
				}
				else
				{
			    	na_card_num_error = 1;
			    	$('#na_card_num_error').show();
					//red shadow
					$(this).css('border-color','rgba(215, 44, 44, 0.8)'); 
			    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
			    	$(this).css('outline','0 none');
			    	
				}
		    }
		    if(card_type == "amex")
		    {
		    	//alert(card_type);
		    	var re = /^3[47][0-9]{13}$/; 
			    var m;
	 
				if ((m = re.exec(typed_txt)) !== null) {
				    if (m.index === re.lastIndex) {
				        re.lastIndex++;
				    }
				    //  m[0] etc... 
				}
				
				//if a match was found 
			    if(m)
			    {
			    	na_card_num_error = 0;
					$('#na_card_num_error').hide();
					$(this).css('border-color','rgb(157, 168, 179)'); 
			    	$(this).css('box-shadow','none');
			    	$(this).css('outline','0 none');
				}
				else
				{
			    	na_card_num_error = 1;
			    	$('#na_card_num_error').show();
					//red shadow
					$(this).css('border-color','rgba(215, 44, 44, 0.8)'); 
			    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
			    	$(this).css('outline','0 none');
			    	
				}
		    	
		    }
		    //console.log("focus out ..." + m)
		   
		    
		  }
	});
	
	
	////  new event  ///////////////////////////////////
	// expiration date month  
	$( "#na_ccard_month_select" ).bind(
	{
		  focusin: function() {
		  	
	    	$(this).css('border-color','rgba(0, 0, 0, 0.8)');
	    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 4px rgba(0, 0, 0, 0.6)');
	    	$(this).css('outline','0 none');
	    		
	  		var selected_year = $('#na_ccard_year_select').val();
	  		//alert(selected_year);
	  		if(selected_year !=0)
	  		{
	    		$('#na_ccard_date_select_error').hide();
			}
			else
			{
				$('#na_ccard_year_select').css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$('#na_ccard_year_select').css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$('#na_ccard_year_select').css('outline','0 none');
			}
		  },
		  blur: function() {
		   		    
		    var selected_itm = $(this).val();
		    var selected_year = $('#na_ccard_year_select').val();
		    
		    if(selected_itm == 0)
		    {
		    	na_ccard_date_select_error = 1;
		    	$('#na_ccard_date_select_error').show();
				//red shadow
				$(this).css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$(this).css('outline','0 none');
		    }
		    else
		    {
				$(this).css('border-color','rgb(157, 168, 179)'); 
			    $(this).css('box-shadow','none');
			    $(this).css('outline','0 none');
			    if(selected_year !=0)
		  		{
		    		na_ccard_date_select_error = 0;
				}
			}

		  }
	});
	
	////  new event  ///////////////////////////////////
	// expiration date month  
	$( "#na_ccard_year_select" ).bind(
	{
		  focusin: function() {
		  	
	    	$(this).css('border-color','rgba(0, 0, 0, 0.8)');
	    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 4px rgba(0, 0, 0, 0.6)');
	    	$(this).css('outline','0 none');
	    		
	  		var selected_year = $('#na_ccard_month_select').val();
	  		//alert(selected_year);
	  		if(selected_year !=0)
	  		{
	    		$('#na_ccard_date_select_error').hide();
			}
			else
			{
				$('#na_ccard_month_select').css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$('#na_ccard_month_select').css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$('#na_ccard_month_select').css('outline','0 none');
			}
		  },
		  blur: function() {
		   		    
		    var selected_itm = $(this).val();
		    var selected_year = $('#na_ccard_month_select').val();
		    
		    if(selected_itm == 0)
		    {
		    	na_ccard_date_select_error = 1;
		    	$('#na_ccard_date_select_error').show();
				//red shadow
				$(this).css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$(this).css('outline','0 none');
		    }
		    else
		    {
				$(this).css('border-color','rgb(157, 168, 179)'); 
			    $(this).css('box-shadow','none');
			    $(this).css('outline','0 none');
			    if(selected_year !=0)
		  		{
		    		na_ccard_date_select_error = 0;
				}
			}

		  }
	});
	
	
	$("#na_ccard_select	").change(function(){
		var card_type = $(this).val();
		
		var typed_txt = $("#na_card_num").val();
		if(typed_txt)
		{
			if(card_type == "visa")
		    {
		    	//alert(card_type);
		    	var re = /^4[0-9]{12}(?:[0-9]{3})?$/; 
			    var m;
	 
				if ((m = re.exec(typed_txt)) !== null) {
				    if (m.index === re.lastIndex) {
				        re.lastIndex++;
				    }
				    //  m[0] etc... 
				}
				
				//if a match was found 
			    if(m)
			    {
			    	na_card_num_error = 0;
					$('#na_card_num_error').hide();
					$("#na_card_num").css('border-color','rgb(157, 168, 179)'); 
			    	$("#na_card_num").css('box-shadow','none');
			    	$("#na_card_num").css('outline','0 none');
					
				}
				else
				{
			    	na_card_num_error = 1;
			    	$('#na_card_num_error').show();
					
			    	
				}
				
		    }
		    if(card_type == "mc")
		    {
		    	//alert(card_type);
		    	var re = /^(?:5[1-5][0-9]{2}|222[1-9]|22[3-9][0-9]|2[3-6][0-9]{2}|27[01][0-9]|2720)[0-9]{12}$/; 
			    var m;
	 
				if ((m = re.exec(typed_txt)) !== null) {
				    if (m.index === re.lastIndex) {
				        re.lastIndex++;
				    }
				    //  m[0] etc... 
				}
				
				//if a match was found 
			    if(m)
			    {
			    	na_card_num_error = 0;
					$('#na_card_num_error').hide();
					$("#na_card_num").css('border-color','rgb(157, 168, 179)'); 
			    	$("#na_card_num").css('box-shadow','none');
			    	$("#na_card_num").css('outline','0 none');
					
				}
				else
				{
			    	na_card_num_error = 1;
			    	$('#na_card_num_error').show();
					
			    	
				}
		    }
		     if(card_type == "amex")
		    {
		    	//alert(card_type);
		    	var re = /^3[47][0-9]{13}$/; 
			    var m;
	 
				if ((m = re.exec(typed_txt)) !== null) {
				    if (m.index === re.lastIndex) {
				        re.lastIndex++;
				    }
				    //  m[0] etc... 
				}
				
				//if a match was found 
			    if(m)
			    {
			    	na_card_num_error = 0;
					$('#na_card_num_error').hide();
					$("#na_card_num").css('border-color','rgb(157, 168, 179)'); 
			    	$("#na_card_num").css('box-shadow','none');
			    	$("#na_card_num").css('outline','0 none');
					
				}
				else
				{
			    	na_card_num_error = 1;
			    	$('#na_card_num_error').show();
					
			    	
				}
		    	
		    }
		    
			
		}
		
	});
	
	////  new event  ///////////////////////////////////
	$( "#na_sec_code" ).bind(
	{
		  focusin: function() {
		    	//console.log("focus in " );
		    	$(this).css('border-color','rgba(0, 0, 0, 0.8)');
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 4px rgba(0, 0, 0, 0.6)');
		    	$(this).css('outline','0 none');
		  },
		  blur: function() {
		    var typed_txt = $(this).val();
		   		    
		    // zipcode regex
		    var re = /^[0-9]{3,4}$/; 
		    var m;
 
			if ((m = re.exec(typed_txt)) !== null) {
			    if (m.index === re.lastIndex) {
			        re.lastIndex++;
			    }
			    //  m[0] etc... 
			}
			
			//if a match was found		    
		    if(m)
		    {
				na_sec_code_error = 0;
				$('#na_sec_code_error').hide();
				$(this).css('border-color','rgb(157, 168, 179)'); 
		    	$(this).css('box-shadow','none');
		    	$(this).css('outline','0 none');
			}
			else
			{
		    	na_sec_code_error = 1;
		    	$('#na_sec_code_error').show();
				//red shadow
				$(this).css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$(this).css('outline','0 none');
			}
		    
		    
		    //console.log("focus out ..." + m)
		   
		    
		  }
	});		
	

	
/*
	//check if form is ok 
	function validateMyForm()
	{
	  if(frm_errors == 1)
	  { 
	    alert("make sure all fields are filled");
	    return false;
	  }

	  //alert("validations passed");
	  //$('#na_form').submit();
	  return true;
	}
*/
		

		
		//search autocomplete
		/*$("#search").autocomplete
		({
	    	source: '<?php echo($secure_base_url."product/autosearch") ; ?>', // path to the autosearch method
	    	minLength: 2
	  	 });*/
	  	 

	  	 
		//do something else now here
	
	$(".tooltip").show();
	
		


// to escape special characters see  http://stackoverflow.com/a/9310752/1636522
RegExp.escape = function (text) {
    return text.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, '\\$&');
};

</script>



<?php // if ($this->cart->total_items() > 0): ?>
<script>
$(document).ready(function()
{

});		
</script>
<?php //endif ; ?>

<script>
	function eraseCookie(name) {
		
    createCookie(name,"",-1);
    
}
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
    
    function readCookie(name) 
    {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }
        



	



/// update customer


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


</script>

<?php include "script_email_collector_https.php"; ?>


</body>
</html>