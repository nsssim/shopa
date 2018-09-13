<?php  $this->load->helper('url');   ?>
<?php  $CI =& get_instance();  ?>
<?php  
$CURRENCY = "$"; 
$RATE = 1;
 ?>
 
 <?php 
$ssl_port_num = ":".SSL_PORT;  // :443 is the default
$base_url_str = base_url(); 
$secure_base_url = str_replace("http","https",$base_url_str );
$secure_base_url = str_replace(".com",".com$ssl_port_num",$secure_base_url );
?>


 
<?php //include "css_secure.php";?>
<?php //include "header.php";?>
<?php 
//echo "<pre>";
//echo "<h3>checkout_vew->customer_details (Line 8)</h3>";
//var_dump($customer_details);
//echo "</pre>";

/*echo "<pre>";
echo "<h3>checkout_vew->customer_delivery_addresses (Line 13)</h3>";
if (isset($customer_delivery_addresses))var_dump($customer_delivery_addresses);
echo "</pre>";*/

// put the php array into a hiddem dom element for easy read from js
if (isset($customer_delivery_addresses) and !empty($customer_delivery_addresses))
{
	$address_id =NULL;
	foreach ($customer_delivery_addresses as $cd)
	{
		foreach($cd as $key=>$value)
		{
			if($key == "id") $address_id = $value;
			?>
			<span style="display: none;"  id = "<?php echo $address_id.'-'.$key ?>" ><?php echo $value; ?> </span>
			<?php
		}
	}
}

/*echo "<pre>";
echo "<h3>checkout_vew->delivery_address (Line 8)</h3>";
var_dump($delivery_address);
echo "</pre>";*/


//echo "<pre>";
//echo "<h3>checkout_vew->product_ids_not_in_stock (Line 19)</h3>";
//if (isset($product_ids_not_in_stock))var_dump($product_ids_not_in_stock);
//echo "</pre>";

//echo "<pre>";
//echo "<h3>checkout_vew->customer_billing_addresses (Line 23)</h3>";
//if (isset($customer_billing_addresses))var_dump($customer_billing_addresses);
//echo "</pre>";

?>

<?php  if (!empty($error_msg)) echo $error_msg; ?>
<?php  $this->load->helper('url'); ?>
<?php // include 'css.php';
	 // include 'header.php';?>
	<?php echo validation_errors(); ?> 
	
	<?php // echo form_open('checkout/info'); ?>
	<?php 
	$ssl_port_num = ":".SSL_PORT;  // :443 is the default
	$base_url_str = base_url(); 
	$secure_base_url = str_replace("http","https",$base_url_str );
	$secure_base_url = str_replace(".com",".com$ssl_port_num",$secure_base_url );
	?>
	<form action= '<?php echo $secure_base_url."checkout/info"; ?>' method="post" accept-charset="utf-8">
		
		<section class="chechout">
			<div class="container">
				<div class="row">
					<?php $user_id = $CI->session->userdata("user_id");  ?>
					<div class="col-sm-4">
						
						<!--PERSONAL INFO-->
						
						<?php if( empty($user_id) ) :  ?>
						<fieldset style="margin: 0 -8px 20px;" style="checkoutview">
							<legend><?php echo $words['personal_info']; ?></legend>
							<div class="row">
								<div class="col-md-12" style="margin-bottom:3px;">
									<label for="firstname"><?php echo $words['first_name']; ?>*</label>
										<?php 
											if(!empty($customer_details[0]->first_name)) 
											{
												$first_name_value =  $customer_details[0]->first_name;
											}
											else
											{
												$first_name_value =  set_value('firstname');
											}	
										?>
									<input style="float:right;border: 1px solid #ccc;border-radius:4px;-webkit-border-radius:4px;-moz-border-radius:4px;padding-left:5px;height: 30px;" type="text" name="firstname" value="<?php  echo $first_name_value; ?>" id="firstname" class="input-md" placeholder="" data-trigger="change" data-validation-minlength="1" data-type="text" data-required="true" data-error-message="Enter a valid First Name."/>
								</div>
							
								<div class="col-md-12" style="margin-bottom:3px;">
									<label for="lastname"><?php echo $words['last_name']; ?>*</label>
										<?php 
											if(!empty($customer_details[0]->last_name)) 
											{
												$lasname_name_value =  $customer_details[0]->last_name;
											}
											else
											{
												$lasname_name_value =  set_value('lasname');
											}	
										?>
									<input style="float:right;border: 1px solid #ccc;border-radius:4px;-webkit-border-radius:4px;-moz-border-radius:4px;padding-left:5px;height: 30px;" type="text" name="lasname" value="<?php echo $lasname_name_value; ?>" id="lastname" class="input-md" placeholder="" data-trigger="change" data-validation-minlength="1" data-type="text" data-required="true" data-error-message="Enter a valid Last Name."/>
								</div>
								
								<div class="col-md-12" style="margin-bottom:3px;">
									<label for="phone"><?php echo $words['phone1']; ?>*</label>
										<?php 
											if(!empty($customer_details[0]->phone)) 
											{
												$phone_value =  $customer_details[0]->phone;
											}
											else
											{
												$phone_value =  set_value('phone');
											}	
										?>
									<input style="float:right;border: 1px solid #ccc;border-radius:4px;-webkit-border-radius:4px;-moz-border-radius:4px;padding-left:5px;height: 30px;" type="phone" name="phone" value="<?php echo $phone_value; ?>" id="phone" class="input-md" placeholder="" data-trigger="change" data-validation-minlength="1" data-type="phone" data-required="true" data-error-message="Enter a valid Phone."/>
								</div>
								
								<div class="col-md-12" style="margin-bottom:3px;">
									<label for="alt_phone"><?php echo $words['phone2']; ?>*</label>
										<?php 
											if(!empty($customer_details[0]->alt_phone)) 
											{
												$alt_phone_value =  $customer_details[0]->alt_phone;
											}
											else
											{
												$alt_phone_value =  set_value('alt_phone');
											}	
										?>
									<input style="float:right;border: 1px solid #ccc;border-radius:4px;-webkit-border-radius:4px;-moz-border-radius:4px;padding-left:5px;height: 30px;" type="phone" name="alt_phone" value="<?php echo $alt_phone_value; ?>" id="alt_phone" class="input-md" placeholder="" data-trigger="change" data-validation-minlength="1" data-type="phone" data-required="true" data-error-message="Enter a valid Phone 2."/>
								</div>
								
								<div class="col-md-12" style="margin-bottom:3px;">
									<label for="email"><?php echo $words['email']; ?>*</label>
										<?php 
											if(!empty($customer_details[0]->email)) 
											{
												$email_value =  $customer_details[0]->email;
											}
											else
											{
												$email_value =  set_value('email');
											}	
										?>
									<input style="float:right;border: 1px solid #ccc;border-radius:4px;-webkit-border-radius:4px;-moz-border-radius:4px;padding-left:5px;height: 30px;" type="email" name="email" value="<?php echo $email_value; ?>" id="email" class="input-md" placeholder="" data-trigger="change" data-validation-minlength="1" data-type="email" data-required="true" data-error-message="Enter a valid E-mail."/>
								</div>
								
								<div class="col-md-12" style="margin-bottom:3px;">
									<label for="email_confirm"><?php echo $words['confirm_email']; ?>*</label>
										<?php 
											if(!empty($customer_details[0]->email)) 
											{
												$email_confirm_value =  $customer_details[0]->email;
											}
											else
											{
												$email_confirm_value =  set_value('email_confirm');
											}	
										?>
									<input style="float:right;border: 1px solid #ccc;border-radius:4px;-webkit-border-radius:4px;-moz-border-radius:4px;padding-left:5px;height: 30px;" type="email" name="email_confirm" value="<?php echo $email_confirm_value; ?>" id="email_confirm" class="input-md" placeholder="" data-trigger="change" data-validation-minlength="1" data-type="email" data-required="true" data-error-message="Enter a valid Confim E-mail."/>
								</div>
							</div>
						</fieldset>
						<?php else :  ?>
						<fieldset style="margin: 0 -8px 20px;" class="checkoutview">
							<legend><?php echo $words['personal_info']; ?></legend>
							<div class="personal_infobox" >
								<div> <?php echo ucfirst($customer_details[0]->first_name);   ?> </div>
								<div> <?php echo ucfirst($customer_details[0]->last_name );   ?> </div>
								<div> <?php echo $customer_details[0]->email;  ?> </div>
							</div>
							<!--hidden inputs -->
							<input type="hidden"	 name="firstname"    	 value="<?php echo $customer_details[0]->first_name; ?>"      id="firstname"     />
							<input type="hidden"	 name="lasname" 	 	 value="<?php echo $customer_details[0]->last_name;?>"        id="lastname"      />
							<input type="hidden"	 name="email"		 	 value="<?php echo $customer_details[0]->email; ?>"           id="confirm" />
							<input type="hidden"	 name="email_confirm"	 value="<?php echo $customer_details[0]->email; ?>"           id="email_confirm" />
							<input type="hidden"	 name="phone"       	 value="<?php echo $customer_details[0]->phone; ?>"           id="email_confirm" />
							<input type="hidden"	 name="alt_phone"    	 value="<?php echo $customer_details[0]->alt_phone;?>"        id="alt_phone"     />
						
						</fieldset>
						<?php endif;  ?>
						<!--SHIPPING ADRESS-->
						
						<fieldset style="margin: 0 -8px 20px;" class="checkoutview">
							<legend><?php echo $words['shipping_address']; ?></legend>
							<?php if( isset($customer_delivery_addresses) and sizeof($customer_delivery_addresses)>1) : ?>
								<ul>
									<?php foreach($customer_delivery_addresses as $customer_delivery_address ) : ?>
									
										<?php $address_value =  $customer_delivery_address->line_1.'...'.$customer_delivery_address->line_2 ;  ?>
										<input type="radio" name="delivery_address" id="<?php echo $customer_delivery_address->id ;?>" class="delivery_address" value="<?php echo $address_value ?>" ><?php echo $address_value ?><br>
										
									<?php endforeach; ?>
									<!--<a style="color:green;" href="<?php echo base_url().'customer/myaddresses'; ?> " >Manage addresses</a>-->
									<a href="<?php echo base_url().'customer/myaddresses'; ?> " class="btn btn-sm btn-success"><span class="glyphicon glyphicon-globe"></span> <?php echo $words['manage_addresses']; ?> </a>
								</ul>
							<?php endif; ?>
							<div class="row">
								<div class="col-md-12" style="margin-bottom:3px;">
									<?php 
										if(isset($customer_delivery_addresses[0]->id))  $shipping_address_id =  $customer_delivery_addresses[0]->id; 
										else $shipping_address_id =  "";
									?>
									<input style="display: none; float:right;border: 1px solid #ccc;border-radius:4px;-webkit-border-radius:4px;-moz-border-radius:4px;padding-left:5px;height: 30px;" id="shipping_address_id" required="" name="shipping_address_id" value="<?php echo $shipping_address_id; ?>" placeholder="" class="form-control input-md" type="text"  >
								</div>
								<div class="col-md-12" style="margin-bottom:3px;">
									<label for="address1"><?php echo $words['address_line1']; ?>*</label>
										<?php 
											if(!empty($customer_delivery_addresses[0]->line_1)) 
											{
												$address1_value =  $customer_delivery_addresses[0]->line_1;
											}
											else
											{
												$address1_value =  set_value('address1');
											}	
										?>
									<input style="float:right;border: 1px solid #ccc;border-radius:4px;-webkit-border-radius:4px;-moz-border-radius:4px;padding-left:5px;height: 30px;" type="text" name="address1" value="<?php echo $address1_value; ?>" id="address1" class="input-md" placeholder="" data-trigger="change" data-validation-minlength="1" data-type="text" data-required="true" data-error-message="Enter a valid Adress." />
								</div>
								
								<div class="col-md-12" style="margin-bottom:3px;">
									<label for="address2"><?php echo $words['address_line2']; ?></label>
										<?php 
											if(!empty($customer_delivery_addresses[0]->line_2)) 
											{
												$address2_value =  $customer_delivery_addresses[0]->line_2;
											}
											else
											{
												$address2_value =  set_value('address2');
											}	
										?>
									<input style="float:right;border: 1px solid #ccc;border-radius:4px;-webkit-border-radius:4px;-moz-border-radius:4px;padding-left:5px;height: 30px;" type="text" name="address2" value="<?php echo $address2_value; ?>" id="address2" class="input-md" placeholder="" data-trigger="change" data-validation-minlength="1" data-type="text" data-required="true" data-error-message="Enter a valid Adress." />
								</div>
								
								<div class="col-md-12" style="margin-bottom:3px;">
									<label for="address3"><?php echo $words['address_line3']; ?></label>
										<?php 
											if(!empty($customer_delivery_addresses[0]->line_3)) 
											{
												$address3_value =  $customer_delivery_addresses[0]->line_3;
											}
											else
											{
												$address3_value =  set_value('address3');
											}	
										?>
									<input style="float:right;border: 1px solid #ccc;border-radius:4px;-webkit-border-radius:4px;-moz-border-radius:4px;padding-left:5px;height: 30px;" type="text" name="address3" value="<?php echo $address3_value; ?>" id="address3" class="input-md" placeholder="" data-trigger="change" data-validation-minlength="1" data-type="text" data-required="true" data-error-message="Enter a valid Adress." />
								</div>
								
								<div class="col-md-12" style="margin-bottom:3px;">
									<label for="city"><?php echo $words['city']; ?>*</label>
										<?php 
											if(!empty($customer_delivery_addresses[0]->city)) 
											{
												$city_value =  $customer_delivery_addresses[0]->city;
											}
											else
											{
												$city_value =  set_value('city');
											}	
										?>
									<input style="float:right;border: 1px solid #ccc;border-radius:4px;-webkit-border-radius:4px;-moz-border-radius:4px;padding-left:5px;height: 30px;" type="text" name="city" value="<?php echo $city_value; ?>" id="city" class="input-md" placeholder="" data-trigger="change" data-validation-minlength="1" data-type="text" data-required="true" data-error-message="Enter a valid City." />
								</div>
								
								<div class="col-md-12" style="margin-bottom:3px;">
									<label for="region"><?php echo $words['region']; ?></label>
										<?php 
											if(!empty($customer_delivery_addresses[0]->country_province)) 
											{
												$region_value =  $customer_delivery_addresses[0]->country_province;
											}
											else
											{
												$region_value =  set_value('region');
											}	
										?>
									<input style="float:right;border: 1px solid #ccc;border-radius:4px;-webkit-border-radius:4px;-moz-border-radius:4px;padding-left:5px;height: 30px;" type="text" name="region" value="<?php echo $region_value; ?>" id="region" class="input-md" placeholder="" data-trigger="change" data-validation-minlength="1" data-type="text" data-required="true" data-error-message="Enter a valid Region." />
								</div>
								
								<div class="col-md-12" style="margin-bottom:3px;">
									<label for="zip"><?php echo $words['zip']; ?>*</label>
										<?php 
											if(!empty($customer_delivery_addresses[0]->zip_code)) 
											{
												$zipcode_value =  $customer_delivery_addresses[0]->zip_code;
											}
											else
											{
												$zipcode_value =  set_value('zipcode');
											}	
										?>
									<input style="float:right;border: 1px solid #ccc;border-radius:4px;-webkit-border-radius:4px;-moz-border-radius:4px;padding-left:5px;height: 30px;width: 56%;" type="text" name="zipcode" value="<?php echo $zipcode_value; ?>" id="zipcode" class="form-control input-md" placeholder="" data-trigger="change" data-validation-minlength="1" data-type="text" data-required="true" data-error-message="Enter a valid Zipcode." />
								</div>
								
								<div class="col-md-12" style="margin-bottom:3px;">
									<label for="country"><?php echo $words['country']; ?>*</label>
										<?php 
											if(!empty($customer_delivery_addresses[0]->coutry)) 
											{
												$country_value =  $customer_delivery_addresses[0]->coutry;
											}
											else
											{
												$country_value =  set_value('country');
											}	
										?>
									<!--<input  type="text" name="country" value="<?php echo $country_value; ?>" id="country" class="form-control input-md" placeholder="" data-trigger="change" data-validation-minlength="1" data-type="text" data-required="true" data-error-message="Enter a valid Country." style="float:right;border: 1px solid #ccc;border-radius:4px;-webkit-border-radius:4px;-moz-border-radius:4px;padding-left:5px;height: 30px;width: 56%;" />-->
									
									<select id="country" class="form-control input-md" name="country" required="true" data-error-message="Enter a valid Country." style="float:right;border: 1px solid #ccc;border-radius:4px;-webkit-border-radius:4px;-moz-border-radius:4px;padding-left:5px;width: 56%;">
											<option value="<?php echo $country_value; ?>" ><?php echo $country_value; ?></option>
											<?php foreach ($countries as $country) : ?>
											<option value="<?php echo $country->Name; ?>"><?php echo $country->Name; ?></option>
											<?php endforeach; ?>
									</select>
									
									
									
								</div>
								
								
							</div>
						</fieldset>
						
						<!--BILLING ADRESS-->
						
						<fieldset style="margin: 0 -8px 20px;" style="checkoutview">
							<legend><?php echo $words['billing_address']; ?></legend>
							<div class="row">
								<div class="col-md-12" style="margin-bottom:3px;">
									<input id="same_as_shipping" name="same_as_shipping" type="checkbox" value="Billing Address" unchecked >
									<label for="same_as_shipping" > <?php echo $words['same_as_shipping_add']; ?> </label>
								</div>
							</div>
							
							<div class="row" id="billing_address">
								<div class="col-md-12" style="margin-bottom:3px;">
									<?php 
										if(isset( $customer_billing_addresses[0]->id))  $billing_address_id  =  $customer_billing_addresses[0]->id; 
										  	else $billing_address_id = "";
									?>
									<input style="display: none;" id="billing_address_id" required="" name="billing_address_id" value="<?php echo $billing_address_id; ?>" placeholder="" class="form-control input-md" type="text">
								</div>
								
								<div class="col-md-12" style="margin-bottom:3px;">
									<label for="billing_address1"><?php echo $words['address_line1']; ?>*</label>
										<?php 
											if(!empty($customer_billing_addresses [0]->line_1)) 
											{
												$billing_address1_value =  $customer_billing_addresses[0]->line_1;
											}
											else
											{
												$billing_address1_value =  set_value('billing_address1');
											}	
										?>
									<input style="float:right;border: 1px solid #ccc;border-radius:4px;-webkit-border-radius:4px;-moz-border-radius:4px;padding-left:5px;height: 30px;" type="text" name="billing_address1" value="<?php echo $billing_address1_value; ?>" id="billing_address1" class="input-md" placeholder="" data-trigger="change" data-validation-minlength="1" data-type="text" data-required="true" data-error-message="Enter a valid Billing Adress." />
								</div>
								
								<div class="col-md-12" style="margin-bottom:3px;">
									<label for="billing_address2"><?php echo $words['address_line2']; ?></label>
										<?php 
											if(!empty($customer_billing_addresses [0]->line_2)) 
											{
												$billing_address2_value =  $customer_billing_addresses[0]->line_2;
											}
											else
											{
												$billing_address2_value =  set_value('billing_address2');
											}	
										?>
									<input style="float:right;border: 1px solid #ccc;border-radius:4px;-webkit-border-radius:4px;-moz-border-radius:4px;padding-left:5px;height: 30px;" type="text" name="billing_address2" value="<?php echo $billing_address2_value; ?>" id="billing_address2" class="input-md" placeholder="" data-trigger="change" data-validation-minlength="1" data-type="text" data-required="true" data-error-message="Enter a valid Billing Adress 2." />
								</div>
								
								<div class="col-md-12" style="margin-bottom:3px;">
									<label for="billing_address3"><?php echo $words['address_line3']; ?></label>
										<?php 
											if(!empty($customer_billing_addresses [0]->line_3)) 
											{
												$billing_address3_value =  $customer_billing_addresses[0]->line_3;
											}
											else
											{
												$billing_address3_value =  set_value('billing_address3');
											}	
										?>
									<input style="float:right;border: 1px solid #ccc;border-radius:4px;-webkit-border-radius:4px;-moz-border-radius:4px;padding-left:5px;height: 30px;" type="text" name="billing_address3" value="<?php echo $billing_address3_value; ?>" id="billing_address3" class="input-md" placeholder="" data-trigger="change" data-validation-minlength="1" data-type="text" data-required="true" data-error-message="Enter a valid Billing Adress 3." />
								</div>
								
								<div class="col-md-12" style="margin-bottom:3px;">
									<label for="billing_city"><?php echo $words['city']; ?></label>
										<?php 
											if(!empty($customer_billing_addresses[0]->city)) 
											{
												$billing_city_value =  $customer_billing_addresses[0]->city;
											}
											else
											{
												$billing_city_value =  set_value('billing_city');
											}	
										?>
									<input style="float:right;border: 1px solid #ccc;border-radius:4px;-webkit-border-radius:4px;-moz-border-radius:4px;padding-left:5px;height: 30px;" type="text" name="billing_city" value="<?php echo $billing_city_value; ?>" id="billing_city" class="input-md" placeholder="" data-trigger="change" data-validation-minlength="1" data-type="text" data-required="true" data-error-message="Enter a valid Billing Adress 3." />
								</div>
								
								<div class="col-md-12" style="margin-bottom:3px;">
									<label for="billing_region"><?php echo $words['region']; ?></label>
										<?php 
											if(!empty($customer_billing_addresses[0]->country_province)) 
											{
												$billing_region_value =  $customer_billing_addresses[0]->country_province;
											}
											else
											{
												$billing_region_value =  set_value('billing_region');
											}	
										?>
									<input style="float:right;border: 1px solid #ccc;border-radius:4px;-webkit-border-radius:4px;-moz-border-radius:4px;padding-left:5px;height: 30px;" type="text" name="billing_region" value="<?php echo $billing_region_value; ?>" id="billing_region" class="input-md" placeholder="" data-trigger="change" data-validation-minlength="1" data-type="text" data-required="true" data-error-message="Enter a valid Billing Region." />
								</div>
								
								<div class="col-md-12" style="margin-bottom:3px;">
									<label for="billing_zipcode"><?php echo $words['zip']; ?>*</label>
										<?php 
											if(!empty($customer_billing_addresses[0]->zip_code)) 
											{
												$billing_zipcode_value =  $customer_billing_addresses[0]->zip_code;
											}
											else
											{
												$billing_zipcode_value =  set_value('billing_zipcode');
											}	
										?>
									<input style="float:right;border: 1px solid #ccc;border-radius:4px;-webkit-border-radius:4px;-moz-border-radius:4px;padding-left:5px;height: 30px;" type="text" name="billing_zipcode" value="<?php echo $billing_zipcode_value; ?>" id="billing_zipcode" class="input-md" placeholder="" data-trigger="change" data-validation-minlength="1" data-type="text" data-required="true" data-error-message="Enter a valid Zipcode." />
								</div>
								
								<div class="col-md-12" style="margin-bottom:3px;">
									<label for="billing_country"><?php echo $words['country']; ?>*</label>
										<?php 
											if(!empty($customer_billing_addresses[0]->coutry)) 
											{
												$billing_country_value =  $customer_billing_addresses[0]->coutry;
											}
											else
											{
												$billing_country_value =  set_value('billing_country');
											}	
										?>
									<!--<input style="float:right;border: 1px solid #ccc;border-radius:4px;-webkit-border-radius:4px;-moz-border-radius:4px;padding-left:5px;height: 30px;" type="text" name="billing_country" value="<?php echo $billing_country_value; ?>" id="billing_country" class="input-md" placeholder="" data-trigger="change" data-validation-minlength="1" data-type="text" data-required="true" data-error-message="Enter a valid Zipcode." />-->
									
									<select id="billing_country" class="form-control input-md" name="billing_country" required="true" data-error-message="Enter a valid Country." style="float:right;border: 1px solid #ccc;border-radius:4px;-webkit-border-radius:4px;-moz-border-radius:4px;padding-left:5px;width: 56%;">
											<option value="<?php echo $country_value; ?>" ><?php echo $country_value; ?></option>
											<?php foreach ($countries as $country) : ?>
												<option value="<?php echo $country->Name; ?>"><?php echo $country->Name; ?></option>
											<?php endforeach; ?>
									</select>
									
								</div>
								
							</div>
						</fieldset>	
					</div>
					
					
					<div class="col-sm-8">
						<div class="panel panel-default credit-card-box">
	<div class="panel-heading display-table" >
		<div class="row display-tr" >
			<h3> <?php echo $words["payment_details"]; ?> </h3>
			<!--<div class="display-td" >                            
				<img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png">
			</div>-->
		</div>                    
	</div>
	<div class="panel-body">
		<form role="form" id="payment-form">
			<div class="row">
				<div class="col-xs-7">
					<div class="form-group">
						<label for="cardNumber"><?php echo $words["card_number"]; ?></label>
						<div class="input-group">
							<?php $card_no =  set_value('card_no'); ?>
						      
							<input 
								id="card_no"
								type="tel"
								class="form-control"
								name="card_no"
								placeholder='<?php echo $words["valid_card_number"]; ?>'
								autocomplete="cc-number"
								value="<?php echo $card_no; ?>"
								required autofocus 
							/>
							<span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
						</div>
					</div>                            
				</div>
			</div>
			<div class="row">
				<div class="col-xs-3 col-md-3">
					<div class="form-group">
						<label for="cardExpiry"><span class="visible-xs-inline"> <?php echo $words["exp_date"]; ?> </span> </label>
							<table>
								<tr>
									<td>
						  		<?php $exp_month =  set_value('exp_month'); ?>
						     <input id="exp_month" required="" type=text name="exp_month" value="<?php echo $exp_month; ?>" placeholder='<?php echo $words["month"]; ?>' class="form-control input-sm" type="tel" style="width: 40px" required>
									</td>
									<td>
						      	<?php $exp_year =  set_value('exp_year'); ?>
						      <input id="exp_year" required="" type=text name="exp_year" value="<?php echo $exp_year; ?>" placeholder='<?php echo $words["year"]; ?>' class="form-control input-sm" type="tel" style="width: 40px" required> 
									</td>
								</tr>
							</table>
					</div>
				</div>
				<div class="col-xs-3 col-md-3">
					<div class="form-group">
						<?php $cvv2 =  set_value('cvv2'); ?>
						      
						<label for="cardCVC"><?php echo $words["cv_code"]; ?></label>
						<input 
							type="tel" 
							class="form-control"
							name="cvv2"
							id="cvv2"
							placeholder="CVC"
							autocomplete="cc-csc"
							value="<?php echo $cvv2; ?>"
							required
						/>
					</div>
				</div>
				<div class="col-xs-6 col-md-6">
					<img src="<?php echo $secure_base_url."assets/templates/eshopper/images/comodo_secure.png"; ?>"/>
				</div>
			</div>
			
			
			<div class="row" style="display:none;">
				<div class="col-xs-12">
					<p class="payment-errors"></p>
				</div>
			</div>
			
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">			
			<input type="hidden" name = "lastvisit_stmp2" value="<?php echo $this->security->get_csrf_hash(); ?>" />
			
		</form>
	</div>
</div>   
						<!--<h3>Payment information</h3>
						<table> 
						  	
						  	<TR>  <TD>CardNo:</TD> 
						  		<?php $card_no =  set_value('card_no'); ?>
						      <TD><input id="card_no" required="" type=text name="card_no" value="<?php echo $card_no; ?>" placeholder="" class="form-control input-md" type="text" ></TD> 
						  	</TR> 
						  	
						  	<TR>  <TD>ExpMonth:</TD> 
						  		<?php $exp_month =  set_value('exp_month'); ?>
						      <TD><input id="exp_month" required="" type=text name="exp_month" value="<?php echo $exp_month; ?>" placeholder="" class="form-control input-md" type="text" ></TD> 
						 	</TR> 
						  	
						  	<TR>  <TD>ExpYear:</TD> 
						      	<?php $exp_year =  set_value('exp_year'); ?>
						      <TD><input id="exp_year" required="" type=text name="exp_year" value="<?php echo $exp_year; ?>" placeholder="" class="form-control input-md" type="text" ></TD> 
							</TR> 
						  	
						  	<TR>  <TD>Security Code:</TD> 
						  		<?php $cvv2 =  set_value('cvv2'); ?>
						      <TD><input id="cvv2" required="" type=text name="cvv2" value="<?php echo $cvv2; ?>" placeholder="" class="form-control input-md" type="text" ></TD> 
							</TR> 
						</table> -->
						<div class="breadcrumbs">
						<h3><?php echo $words["your_cart"]; ?></h3>
						</div>
						<div class="table-responsive cart_info">
							<table class="table table-condensed">
							<thead>
								<tr class="cart_menu">
									<!--<td class="image"></td>-->
									<td class="description"><?php echo $words["item"]; ?></td>
									<td class="price"><?php echo $words["price"]; ?></td>
									<td class="quantity"><?php echo $words["qty"]; ?></td>
									<td class="total"><?php echo $words["total"]; ?></td>
									<td></td>
								</tr>
							</thead>
							<tbody>
								<?php 
								//echo "<pre>";
								//var_dump($this->cart->contents());
								//echo "</pre>";
								foreach ($this->cart->contents() as $item) : ?>
									<tr id="<?php 	echo($item['rowid'])  ?>" class="crow" >
										<!--<td class="cart_product_check">
											<a href=""><img src="<?php 	echo($item['thumbnail'])  ?>" alt=""></a>
										</td>-->
										<td class="cart_description-check">
											<h4><?php 	echo($item['name'])  ?></h4> 
											<p><?php if($item['color_name']!=""){?><span class="scaprt">Color: </span><?php echo($item['color_name']) ;?> <?php }?>
											<?php if($item['size_name']!=""){?><span class="scaprt">Size: </span><?php 	echo($item['size_name']) ; ?><?php }?>
											 </p>
										</td>
										<td class="cart_price_check">
											<p><?php echo($CURRENCY);?><?php   echo(number_format($item['price'], 2, '.', ','))  ?> </p>
										</td>
										<td class="cart_quantity_check">
											
												
												<?php echo($item['qty'])  ?> 
												
										</td>
									<td class="cart_total">
										<p class="cart_total_price_check">   <?php echo($CURRENCY.(number_format($item['price']*$item['qty'], 2, '.', ',')));?>  </p>
									</td>
									</tr>
									
								<?php endforeach; ?>
							</tbody>
							</table>
							
							<section id="do_action">
								
									<div class="col-sm-12">
										<div class="heading">
											
										</div>
										<div class="row">
												<div class="total_area" style="margin-bottom: 15px;">
													<ul>
														<li> <?php echo $words['o_subtotal'];?> <span id="order_sub_total" ><?php echo($currency.number_format($order_sub_total, 2, '.', ','));?></span></li>
							
														<li><?php echo $words['shipping'];?> <span  id="shipping_fee" ><?php echo($currency.number_format($shipping_and_handling_fee, 2, '.', ','));?></span></li>
														
														<?php if($discount_total > 0): ?>
														<li id="discount_total_line" >       <?php echo $words['total_discount'];?>            <span  id="total_discount" ><?php echo($currency.number_format($discount_total, 2, '.', ','));?></span></li>
														<?php endif; ?>
														
														<li>      <?php echo $words['sub_total'];?>             <span  id="sub_total" ><?php echo($currency.number_format($subtotal, 2, '.', ','));?></span></li>
														
														<li id="custom_fee_line" ><?php echo $words['custom'];?> <span    id="custom_fee"><?php echo($currency.number_format($optional_custom_fees, 2, '.', ','));?></span>  </li>
														
														<li style="background-color: #ffffff;margin: 0;padding: 0;" > &nbsp; </li>
														
														<li><?php echo $words['grand_total'];?> <span id="grand_total" ><?php echo($currency.number_format($grand_total, 2, '.', ','));?></span></li>
														
													</ul>
														<!--<a class="btn btn-default update" href="#">Update</a>-->
														<!--<a class="btn btn-default check_out" href='<?php echo base_url()."checkout/info"; ?>'>Check Out</a>-->
													<!--<div style="margin-top: 27px;" class="col-sm-2 pull-right"><button id="Checkout" name="Checkout" class="btn btn-primary"><?php echo $words["checkout"]; ?></button></div>-->
												</div>
												
												
												<div class="total_area" style="margin-bottom: 15px;padding-left: 15px;">
														<form>
															<table>
															    <tr>
															        <td><input  id="ctcoc1" type="radio" class="customer_take_care_of_customs" name="customer_take_care_of_customs" value="0" > </td>
															        <td><label  for="ctcoc1"> <?php echo $words['pay_duties_now'];?> </label> <span  data-toggle="tooltip" title="<?php echo $words['pay_duties_now_hint'];?>" class="glyphicon glyphicon-info-sign" aria-hidden="true" style="color: #124fe1;margin-left: 5px;" ></span> </td> 
															    </tr>
															    <tr>
															        <td><input id="ctcoc0" type="radio" class="customer_take_care_of_customs" name="customer_take_care_of_customs" value="1"></td>
															        <td><label for="ctcoc0"> <?php echo $words['pay_duties_dlvry'];?> </label> <span  data-toggle="tooltip" title="<?php echo $words['pay_duties_dlvry_hin'];?>" class="glyphicon glyphicon-info-sign" aria-hidden="true" style=" color: #124fe1;margin-left: 5px;" ></span> </td>
															    </tr>
															</table>
														</form> 
												</div>
												
												<div class="total_area" style="padding-left: 26%;">
													<label for="promo_code_field"><?php echo $words['promotion_coupon'];?></label><br>
													<input id="promo_code_field" type="text" name="promo_code" style="line-height: 2em;"/>
													<!--<button id="promo_code_btn" ><?php echo $words['apply'];?></button>-->
													<a id="promo_code_btn" class="btn btn-default " style="display: inline;background-color: black;color: white;" href='#'> <?php echo $words['apply'];?></a>
													<div style="display: none;" id="loadingDiv"> <img src='<?php echo $secure_base_url."assets/templates/eshopper/images/loadingwsm.gif";?>' /> </div>
													<div style="display: none; margin-top: 10px;" id="message_box">  </div>
													
													<div style="margin-top: 40px;" class="col-sm-2 pull-right"><button id="Checkout" name="Checkout" class="btn btn-primary"><?php echo $words["checkout"]; ?></button></div>
												</div>
												
												
												
												
										</div>
									</div>
									
									<div class="col-sm-12">
										<div class="heading">
											
										</div>
										<div class="row">
												
										</div>
									</div>
									
									
								
							</section><!--/#do_action-->
							
							
							
						</div>
					</div>
								
				</div>
				
			</div>
			
		</section>
	</form>
	
	<?php // include "footer.php";?>
<?php // include "script_checkout.php";?>
	
	