<head>
<style>
.place_order_inactive
{
	margin-top: 0;
	line-height: 50px;
	border: none;
	background-color: #CCCCCC;
	color: white;
	padding: 0 15px 0 15px;
	width: 100%; 
	font-size: 1.5rem;
	cursor: not-allowed;  	
}

.place_order_active
{
	margin-top: 0;
	line-height: 50px;
	border: none;
	background-color: #000000;
	color: white;
	padding: 0 15px 0 15px;
	width: 100%; 
	font-size: 1.5rem;
	
}
	
</style>
</head>

<?php
$this->load->helper('url');
$CI              =& get_instance();
$CI->load->library('cleanurl');
$CURRENCY        = "$";
$RATE            = 1;

$ssl_port_num    = ":".SSL_PORT;  // :443 is the default
$base_url_str    = base_url();
$sbu             = str_replace("http","https",$base_url_str );
$secure_base_url = str_replace(".com",".com$ssl_port_num",$sbu );

/*
?><img height="50px" src="https://avatars1.githubusercontent.com/u/386750?v=3&s=400" /><?
$CI->load->library('firebug');  echo(' Woking behind the scene........ok <br>');
$CI->firebug->info($shipping_address_details,"shipping_address_details");
$CI->firebug->info($cities_tr,"cities_tr");
//$CI->firebug->info($cart_content,"cart_content");
*/
?>




	<section>
			<div class="container">
				<div class="row">
					<!--<div class="col-sm-3">

					</div>-->
					<div id="checkout_data_input" class="col-sm-12" style="/*display: none;*/" >
					
						<div class="col-sm-12"  style="height: 30px; padding: 0" >&nbsp;</div>

						<!--left side -->
						<div class="col-sm-7" style=" padding: 0; /*background-color: yellow;*/ ">
							
								<form id="na_form" method="post" action="<?php echo $secure_base_url.'customer/add_update_shipping_address' ; ?>"  >
									<!--shipping address details--> 
									<div class="col-sm-12" style=" padding: 0; " >
									<div id="shipping_address_details" class="col-sm-12" style="border: 1px solid #CCCCCC;">
										<h2 style="font-size: 2rem;font-weight: bold;" ><?php echo $words['shipping'];?></h2>
										<label class="na-label" > <?php echo $words['attention'];?>	</label>
										<input id="na_attention" type="text" maxlength="20" class="na-input" name = "na_attention" /><br>
										<div id="na_attention_error" class="error-span-container"  >
											<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true">
											</span>
											<span  class="input-error-span" >
												<!--Please enter a valid name. special charachters like +=,\|/%#$@~?<>![]{}^&*():; are not allowed-->
												<?php echo $words['error_att'];?>
											</span>
										</div>
										
										<div style="height: 15px" >
											&nbsp;
										</div>

										<label class="na-label" >
											<?php echo $words['fname'];?>
										</label>
										<input id="na_firstname" type="text" maxlength="20" class="na-input" name = "na_firstname" /><br>
										<div id="fname_error" class="error-span-container"  >
											<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true">
											</span>
											<span  class="input-error-span" >
												<!--Please enter a valid first name. special charachters like +=,\|/%#$@~?<>![]{}^&*():; are not allowed-->
												<?php echo $words['error_fname'];?>
											</span>
										</div>

										<div style="height: 15px" >
											&nbsp;
										</div>

										<label class="na-label">
											<?php echo $words['lname'];?>
										</label><br>
										<input id="na_lastname" type="text" maxlength="30" class="input-txt" name = "na_lastname"  /><br>
										<div id="lname_error" class="error-span-container"  >
											<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true">
											</span>
											<span class="input-error-span"  >
												<!--Please enter a valid last name.  special charachters like +=,\|/%#$@~?<>![]{}^&*():; are not allowed-->
												<?php echo $words['error_lname'];?>
											</span>
										</div>

										<div style="height: 15px" >
											&nbsp;
										</div>

										<label class="na-label">
											<?php echo $words['address_line1'];?>
										</label><br>
										<input id="na_sha_line1" type="text" class="input-txt"  name = "na_sha_line1"  /><br>
										<div id="na_line1_error" class="error-span-container"  >
											<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true">
											</span>
											<span  class="input-error-span" >
												<!--Please enter an address. the following characters are not acepted +=%$~{}\^*;-->
												<?php echo $words['error_add1'];?>
											</span>
										</div>

										<div style="height: 15px" >
											&nbsp;
										</div>

										<label class="na-label">
											<!--Apt/Suite-->
											<?php echo $words['address_line2'];?>
										</label><br>
										<input id="na_sha_line2" type="text" class="input-txt"  name = "na_sha_line2"  /><br>
										<div id="na_sha_line2_error" class="error-span-container"  >
											<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true">
											</span>
											<span  class="input-error-span" >
												<!--Special characters like +=%$~{}\^*; are not allowed-->
												<?php echo $words['error_add2'];?>
											</span>
										</div>

										<div style="height: 15px" >
											&nbsp;
										</div>

										<label class="na-label">
											<?php echo $words['country'] ?> 
										</label><br>
										<select id="na_country_select" class="selct-menu" name = "na_country_select" >
											<ul>
												<li>
													<option value="1" selected="1">
														Turkey
													</option>
												</li>
												<!--<li><option value="2">usa</option></li>-->
											</ul>
										</select>

										<div style="height: 15px" >
											&nbsp;
										</div>

										<label class="na-label">
											<?php echo $words['city'] ?> 
										</label><br>
										<select id="na_city_select" class="selct-menu" name = "na_city_select" >
											<ul>
												<?php
												foreach($cities_tr as $city_tr): ?>
												<?php
												if($city_tr->id == $ba_city ) $city_selected = 'selected="1"';
												else $city_selected = ''; ?>
												<li >
													<option value="<?php echo $city_tr->id ?>" <?php echo $city_selected; ?> >
														<?php echo $city_tr->name ?>
													</option>
												</li>
												<?php endforeach; ?>
											</ul>
										</select>

										<div style="height: 15px" >
											&nbsp;
										</div>

										<label class="na-label">
											<?php echo $words['county'] ?> 
										</label><br>
										<select id="na_county_select" class="selct-menu" name = "na_county_select" >
											<ul>
												<?php
												foreach($counties_tr as $county_tr): ?>
												<li>
													<option value="<?php echo $county_tr->id ?>"  >
														<?php echo $county_tr->name ?>
													</option>
												</li>
												<?php endforeach; ?>
											</ul>
										</select>
								
										<div style="height: 15px" >
											&nbsp;
										</div>

										<label class="na-label">
											<?php echo $words['zipcode'];?>
										</label><br>
										<input id="na_zipcode" type="text" maxlength="10" class="input-txt" name = "na_zip"  /><br>
										
										<div id="na_zip_error" class="error-span-container" name = "na_zip_error" >
											<span class="glyphicon glyphicon-exclamation-sign" > </span>
											<span  class="input-error-span" >
												<!--Please enter a  5-digit or a 5+4-digit zip code.-->
												<?php echo $words['error_zip'];?>
											</span>
										</div>

										<div style="height: 15px" >
											&nbsp;
										</div>






										<label class="na-label" >
											<!--Phone Number-->
											<?php echo $words['phone_num'];?>
										</label><br>
										<input id="na_phone" type="text" maxlength="20" class="na-input" name = "na_phone"   /><br>
										<div id="na_phone_error" class="error-span-container"  >
											<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true">
											</span>
											<span  style="font-size: 12px;font-family: Nunito,Helvetica,Verdana,sans-serif; " >
												<!--enter a valid phone number only numbers ( ) + - and X are allowed-->
												<?php echo $words['error_phone'];?>
											</span>
										</div>

										<div style="height: 15px" >
											&nbsp;
										</div>

										<input id="address_id" type="hidden" name="address_id" value="new" >
										
										<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
										<input type="hidden" name = "lastvisit_stmp2" value="<?php echo $this->security->get_csrf_hash(); ?>" />



										<div style="height: 15px" >	&nbsp;	</div>
										
										<a id="na_continue_btn" class="button" style="
													background-color:#000000;
													color: #ffffff;
													padding: 15px 25px;
													text-align: center;
													text-decoration: none;
													display: inline-block;
													font-size: 16px;
													border: none;
													cursor: pointer;"  > <?php echo $words['continue'];?> </a>
										
										<div class="col-sm-12" style="height: 50px" >	&nbsp;	</div>
										
										
										
									</div> <!--end shipping_address_details-->
									
									
									
								</div>
							</form>
							<!--/shipping address details-->
							
							<div id="spcer4654321" class="col-sm-12" style="height: 50px" >	&nbsp;	</div>
							
							<!--address summary -->
							<div id="address_summary" class="col-sm-12" style="padding-right: 0px;border: solid 1px #CCCCCC; display: none;" >
								<h3><?php echo $words['shipping'] ?> <!--Shipping--></h3>
								<!--LLeft-->
								<div class="col-sm-6" style="padding: 0;" >
									<div id="summary_shipping_address"> <span style="font-weight:bold" > <?php echo $words['shipping_address'] ?> <!--Shipping address--></span> </div>
									<div > <span id="summary_first_name" >&nbsp; </span>  <span id="summary_last_name" >last name</span> </div>
									<div > <span id="summary_line1" >&nbsp; </span> , <span id="summary_line2" >LINE2 </span>  </div>
									<div > <span id="summary_city" >&nbsp; </span> , <span id="summary_county" >COUNTY </span> , <span id="summary_zip" >11111 </span> </div>
									<div > <span id="summary_phone" >&nbsp;</span> </div>
								</div>
								<!--RRight-->
								<div class="col-sm-6" style="padding: 0;" >
									<div > <span style="font-weight:bold" ><?php echo $words['shipping_method'] ?> <!--Shipping Method--></span> </div>
									<div > <span> <?php echo $words['express'] ?> <!--Express--> </span> </div>
									<div > <span><?php echo $words['6_8_business_days'] ?> <!--(6-8 business days)--> </span> </div>
								</div>
								<!--EEdit-->
								<div class="col-sm-12" style="padding:0" >
											<div class="col-sm-12" style="padding:0; height: 15px" > &nbsp; </div>
									<div class="col-sm-6" style="padding:0" >
										<a href="#" id="summary_edit_btn" class="button" style="
											background-color:#000000;
											color: #ffffff;
											padding: 15px 25px;
											text-align: center;
											text-decoration: none;
											display: inline-block;
											font-size: 16px;
											border: none;
											width: 90%;
											cursor: pointer;"  > <?php echo $words['edit'] ?> <!--EDIT--> </a>
									</div>
								</div>
								
							<div class="col-sm-12" style="height:15px;" > 	</div>
							
							</div>
							<!--/address summary-->
							
							<div id="spacer123564540" class="col-sm-12" style="height: 50px; display: none;" >	&nbsp;	</div>
							
							<!--payement method-->
							<div id="payement_method" class="col-sm-12" style="padding-right: 0px;border: solid 1px #CCCCCC; display: none;" >
								
								<div id="card_details" class="col-sm-12"  style="padding: 0; font-size: 2rem;font-weight: bold;padding: 25px;padding:0; " >
									<form id="ba_form" method="post" action="<?php echo $secure_base_url.'customer/add_update_shipping_address' ; ?>"  >
										
										<div class="col-sm-12"  style="padding: 0; font-size: 2rem;font-weight: bold;padding: 25px; padding-left: 0;" > <?php echo $words['payment_mthd'] ?> <!--Payment Method--></div>
										<!--Credit card -->
										<?php echo $words['credit_card'] ?> 
										 <hr>
										<div id="card_details" class="col-sm-12"  style="padding: 0;padding: 25px;padding:0; padding-right:15px; " >
											
											<div class="col-sm-12"  style="height: 15px" >	&nbsp; </div>

											<!--card type -->
											<label class="na-label"> <span style="font-size: 14px;" ><?php echo $words['card_type'] ?> </span> </label><br>
											
											<select id="na_ccard_select" class="selct-menu" name = "na_ccard_select" style="height: 50px; font-size:14px; font-weight: normal; " >
												<option value="visa"  > Visa</option>
												<option value="mc"  > MasterCard</option>
												<option value="amex"  > American express</option>
											</select>
											<!--/card type -->
																					
											<div class="col-sm-12"  style="height: 15px" >	&nbsp; </div>
			
											<!--card number -->
											<label class="na-label"> <span style="font-size: 14px;" ><?php echo $words['card_numbr'] ?>  <!--Card number--></span> </label><br>
											<input id="na_card_num" type="text" maxlength="20" class="na-input" name = "na_card_num" style="height: 50px;"   /><br>
											<div id="na_card_num_error" class="error-span-container"  >
												<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true">	</span>
												<span  style="font-size: 12px;font-family: Nunito,Helvetica,Verdana,sans-serif; " >
													<!--this card number is not valid-->
													<?php echo $words['error_c_num'] ?>
												</span>
											</div>
											<!--/card number -->
											
											<div class="col-sm-12"  style="height: 15px" >	&nbsp; </div>
											
											<!--expiration date -->
											<label class="na-label"> <span style="font-size: 14px;" > <?php echo $words['card_exp'] ?> <!--Expiration date--></span> </label><br>
											<div class="col-sm-12"  style="padding: 0; " > 
												<!--ccard Month-->
												<div class="col-sm-6"  style="padding: 0; " > 
											 		<select id="na_ccard_month_select" class="selct-menu" name = "na_ccard_month_select" style="height: 50px; font-size:14px; font-weight: normal;" >
														<option value="0"  > <?php echo $words['month'] ?></option>
														<?php for($i = 1; $i <13; $i++) :?>
															<option value="<?php echo $i ?>"  > <?php printf("%02d\n", $i); ?> </option>
														<?php endfor; ?>
													</select>
												</div>
												<!--/ccard Month-->
												<div class="col-sm-1"  style="padding: 0; " > 						</div>
												
												<!--ccard Year-->
												<div class="col-sm-5"  style="padding: 0; " > 
											 		<select id="na_ccard_year_select" class="selct-menu" name = "na_ccard_year_select" style="height: 50px; font-size:14px; font-weight: normal;" >
															<option value='0'  > <?php echo $words['year'] ?> </option>
														<?php for($i = 0; $i <10; $i++) :?>
															<option value='<?php echo date("Y", strtotime("+$i year")); ?>'  > <?php echo date("Y", strtotime("+$i year")); ?> </option>
														<?php endfor; ?>
													</select>
												</div>
												<!--/ccard Year-->
											<div id="na_ccard_date_select_error" class="error-span-container"  >
												<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true">	</span>
												<span  style="font-size: 12px;font-family: Nunito,Helvetica,Verdana,sans-serif; " >
													<!--invalid expiration date -->
													<?php echo $words['error_c_exp'] ?> 
												</span>
											</div>
											</div>
											
											<!--/expiration date -->
											
											<div class="col-sm-12"  style="height: 15px" >	&nbsp; </div>
											
											<!--Security code -->
											<div class="col-sm-4"  style="padding: 0; " > 
												<label class="na-label"> <span style="font-size: 14px;" > <?php echo $words['card_sec'] ?> </span> </label><br>
												<input id="na_sec_code" type="text" maxlength="20" class="na-input" name = "na_sec_code" style="height: 50px;"   /><br>
											</div>
											
											<div class="col-sm-12"  style="padding: 0; " > 
												<div id="na_sec_code_error" class="error-span-container"  >
													<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true">	</span>
													<span  style="font-size: 12px;font-family: Nunito,Helvetica,Verdana,sans-serif; " >
														<!--this security code is not valid-->
														<?php echo $words['error_c_cvv'] ?>
													</span>
												</div>
											</div>
											<!--/Security code -->
											
											<div class="col-sm-12"  style="height: 15px" >	&nbsp; </div>
											<div class="col-sm-12"  style="height: 15px" >	&nbsp; </div>
											
											
										</div>
										
										<h3> <?php echo $words['billing_address'] ?> <!--Billing address--> </h3>
										
										<hr>
										<!--billing address details--> 
										<div class="col-sm-12" style="padding-left:0; padding-right:15px; font-size:14px; font-weight: normal;  " >
											<div class="col-sm-12"  style="height: 15px" >	&nbsp; </div>
											<div id="billing_address_details" class="col-sm-12" style="padding: 0;">
												
												<p ><?php echo $words['enter_name_add'] ?>  <!--Enter your full name and address exactly as it appears on your statement.--> </p>
												
												<div class="col-sm-12" style="height: 15px;" > </div>
												
												<div class="col-sm-12" style="padding-left:0; padding-right:15px; font-size:14px; font-weight: normal;  " >
													<div class="col-sm-1" style=" padding: 0;width: 7%; " >
														<input id="same_as_shipping" type="checkbox" maxlength="20" class="na-input" name = "same_as_shipping" /><br>
													</div>
													<div class="col-sm-11" style="padding-left:0; padding-right:15px; font-size:14px; font-weight: normal;  " >
														<label class="na-label" for="same_as_shipping" ><?php echo $words['use_my_ship_ad'] ?> <!--Use my shipping address-->	</label>
													</div>
												</div>
												
												<div class="col-sm-12" style="height: 15px;" > </div>
												
												<label class="na-label" > <?php echo $words['fname'] ?> <!--First Name-->	</label>
												<input id="ba_firstname" type="text" maxlength="20" class="na-input" name = "ba_firstname" /><br>
												<div id="ba_fname_error" class="error-span-container"  >
													<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true">
													</span>
													<span  class="input-error-span" >
														<!--Please enter a valid first name. special charachters like +=,\|/%#$@~?<>![]{}^&*():; are not allowed-->
														<?php echo $words['error_fname'] ?>
													</span>
												</div>

												<div style="height: 15px" > &nbsp;	</div>

												<label class="na-label">
													<?php echo $words['lname'] ?> <!--Last Name-->
												</label><br>
												<input id="ba_lastname" type="text" maxlength="30" class="input-txt" name = "ba_lastname"  /><br>
												<div id="ba_lname_error" class="error-span-container"  >
													<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true">
													</span>
													<span class="input-error-span"  >
														<!--Please enter a valid last name.  special charachters like +=,\|/%#$@~?<>![]{}^&*():; are not allowed-->
														<?php echo $words['error_lname'] ?>
													</span>
												</div>

												<div style="height: 15px" >
													&nbsp;
												</div>

												<label class="na-label">
													<?php echo $words['address_line1'] ?> 
													<!--Mailing Address &amp; Infromation-->
												</label><br>
												<input id="ba_sha_line1" type="text" class="input-txt"  name = "ba_sha_line1"  /><br>
												<div id="ba_line1_error" class="error-span-container"  >
													<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true">
													</span>
													<span  class="input-error-span" >
														<!--Please enter an address. the following characters are not acepted +=%$~{}\^*;-->
														<?php echo $words['error_add1'] ?> 
													</span>
												</div>

												<div style="height: 15px" >
													&nbsp;
												</div>

												<label class="na-label">
													<?php echo $words['address_line2'] ?> 
												</label><br>
												<input id="ba_sha_line2" type="text" class="input-txt"  name = "ba_sha_line2"  /><br>
												<div id="ba_sha_line2_error" class="error-span-container"  >
													<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true">
													</span>
													<span  class="input-error-span" >
														<!--Special characters like +=%$~{}\^*; are not allowed-->
														<?php echo $words['error_add2'] ?> 
													</span>
												</div>

												<div style="height: 15px" >
													&nbsp;
												</div>

												<label class="na-label">
													<?php echo $words['address_line2'] ?> 
												</label><br>
												<select id="ba_country_select" class="selct-menu" name = "ba_country_select" >
													<ul>
														<li>
															<option value="1" selected="1">
																Turkey
															</option>
														</li>
														<!--<li><option value="2">usa</option></li>-->
													</ul>
												</select>

												<div style="height: 15px" >
													&nbsp;
												</div>

												<label class="na-label">
													<?php echo $words['city'] ?> 
												</label><br>
												<select id="ba_city_select" class="selct-menu" name = "ba_city_select" >
													<ul>
														<?php
														foreach($cities_tr as $city_tr): ?>
														<?php
														if($city_tr->id == $ba_city ) $city_selected = 'selected="1"';
														else $city_selected = ''; ?>
														<li >
															<option value="<?php echo $city_tr->id ?>" <?php echo $city_selected; ?> >
																<?php echo $city_tr->name ?>
															</option>
														</li>
														<?php endforeach; ?>
													</ul>
												</select>

												<div style="height: 15px" >
													&nbsp;
												</div>

												<label class="na-label">
													<?php echo $words['county'] ?> 
												</label><br>
												<select id="ba_county_select" class="selct-menu" name = "ba_county_select" >
													<ul>
														<?php
														foreach($counties_tr as $county_tr): ?>
														<li>
															<option value="<?php echo $county_tr->id ?>"  >
																<?php echo $county_tr->name ?>
															</option>
														</li>
														<?php endforeach; ?>
													</ul>
												</select>
										
												<div style="height: 15px" >
													&nbsp;
												</div>

												<label class="na-label">
													<!--zipcode-->
													<?php echo $words['zipcode'] ?> 
												</label><br>
												<input id="ba_zipcode" type="text" maxlength="10" class="input-txt" name = "ba_zip"  /><br>
												
												<div id="ba_zip_error" class="error-span-container" name = "ba_zip_error" >
													<span class="glyphicon glyphicon-exclamation-sign" > </span>
													<span  class="input-error-span" >
														<!--Please enter a  5-digit or a 5+4-digit zip code.-->
														<?php echo $words['error_zip'] ?> 
													</span>
												</div>



												<input id="ba_address_id" type="hidden" name="ba_address_id" value="new" >
												
												<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
												<input type="hidden" name = "lastvisit_stmp2" value="<?php echo $this->security->get_csrf_hash(); ?>" />

												<div style="height: 15px" >	&nbsp;	</div>
												<h3> <?php echo $words['contact_info'] ?>  <!--Contact Information--> </h3>
									
												<hr>
												
												<div style="height: 15px" >	&nbsp;	</div>
												
												<p ><?php echo $words['where_reach_u'] ?> <!--Where can we reach you if we have questions about your order?--> </p>
												
												<div style="height: 15px" >	&nbsp;	</div>
												
												<label class="na-label" >
													<?php echo $words['phone'] ?> <!--Phone Number-->
												</label><br>
												<input id="ba_phone" type="text" maxlength="20" class="na-input" name = "ba_phone"   /><br>
												<div id="ba_phone_error" class="error-span-container"  >
													<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true">
													</span>
													<span  style="font-size: 12px;font-family: Nunito,Helvetica,Verdana,sans-serif; " >
														<!--enter a valid phone number only numbers ( ) + - and X are allowed-->
														<?php echo $words['error_phone'] ?>
													</span>
												</div>
												
												<div style="height: 15px" > &nbsp;	</div>
												
												<label class="na-label"> <?php echo $words['email'] ?> <!--Email Address-->  </label><br>
												
												<input id="ba_email" type="email" name = "ba_email" class="input-txt"   /><br>
												<div id="ba_email_error" class="error-span-container"  >
													<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
													<span  class="input-error-span" ><?php echo $words['error_email'] ?> <!--Please enter an email address--> </span>
												</div>
												<div id="ba_email_already_in_use_error" class="error-span-container"  >
													<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
													<span  class="input-error-span" ><?php echo $words['email_exists'] ?> <!--An account with this email already exists.--> Please enter a different one, or <a style="color:black; text-decoration: underline;" href="<?php echo $secure_base_url.'customer/my_account' ?>" >Sign In</a> .  </span>
												</div>
												
												<div style="height: 15px" >	&nbsp;	</div>
												<h3> <?php echo $words['login_info'] ?> </h3>
												<hr>
												
												<div style="height: 15px" > &nbsp;</div>
								
												<label class="na-label"> <?php echo $words['password'] ?> <!--Password-->  </label> <span style="float: right; color: grey; font-size: 10px;" > <?php echo $words['pswrd_notice'] ?> <!--Passwords are case sensitive--> </span><br>
												<input id="na_login_password" type="password" name = "na_login_password" class="input-txt" /><br>
												<div id="na_login_password_error" class="error-span-container"  >
												<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
												<span  style="font-size: 12px;font-family: Nunito,Helvetica,Verdana,sans-serif; " > <?php echo $words['error_pass'] ?> <!--Your password must be between 5-16 characters, and cannot include . , - | \ / = _ % or spaces. Please try again.--> </span>
												</div>
												<div id="na_login_password_error2" class="error-span-container"  >
												<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
												<span  style="font-size: 12px;font-family: Nunito,Helvetica,Verdana,sans-serif; " ><?php echo $words['pass_no_match'] ?> <!--Passwords not matching ...--> </span>
												</div>
												
												
												<div style="height: 15px" > &nbsp;</div>
												
												<label class="na-label"> <?php echo $words['confirm_pass'] ?> <!--Confirm Password-->  </label> <span style="float: right; color: grey; font-size: 10px;" > <?php echo $words['pswrd_notice'] ?> <!--Passwords are case sensitive--> </span><br>
												<input id="na_confirm_password" type="password" name = "na_confirm_password" class="input-txt"  /><br>
												<div id="na_confirm_password_error" class="error-span-container"  >
												<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
												<span  style="font-size: 12px;font-family: Nunito,Helvetica,Verdana,sans-serif; " ><?php echo $words['error_pass'] ?> <!--Your password must be between 5-16 characters, and cannot include . , - | \ / = _ % or spaces. Please try again.--> </span>
												</div>
												<div id="na_confirm_password_error2" class="error-span-container"  >
												<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
												<span  style="font-size: 12px;font-family: Nunito,Helvetica,Verdana,sans-serif; " ><?php echo $words['pass_no_match'] ?> <!--Passwords not matching ...--></span>
												</div>
	
												
												
												

												<div style="height: 15px" >	&nbsp;	</div>
												
												
												<div class="col-sm-12" style="padding:0; height: 15px"> &nbsp; </div>
												<div class="col-sm-6" style="padding:0">
													<a href="#" id="review_order_btn" class="button" style="
														background-color:#000000;
														color: #ffffff;
														padding: 15px 25px;
														text-align: center;
														text-decoration: none;
														display: inline-block;
														font-size: 16px;
														border: none;
														width: 90%;
														cursor: pointer;"> <?php echo $words['review_order'] ?> </a>
												</div>
								
												<div class="col-sm-12" style="padding:0; height: 30px"> &nbsp; </div>
												
											</div>
											
										</div>
										<!--/billing address details-->
										
										
									</form>
								</div>
								
								
							
							</div>
							<!--/payement method-->	
							
							<div class="col-sm-12" style="padding:0; height: 15px"> &nbsp; </div>
							
							<!--billing summary-->
							<div id="payment_summary" class="col-sm-12" style="padding-right: 0px;border: solid 1px #CCCCCC;display:none; ">
								<h3>Payment Method</h3>
								<!--LLeft-->
								<div class="col-sm-6" style="padding: 0;">
									<div id="summary_ccard"> <span style="font-weight:bold">Credit Card</span> </div>
									<div> <span id="summary_card_type">summary_card_type </span>  </div>
									<div> <span id="summary_card_number">summary_card_number </span>  </div>
									<div> <span id="summary_exiration_month"> summary_exiration_month </span> / <span id="summary_exiration_year"> summary_exiration_year </span> </div>
								</div>
								<!--RRight-->
								<div class="col-sm-6" style="padding: 0;">
									<div> <span style="font-weight:bold">Contact Information</span> </div>
									<div> <span id="summary_email">email@provider.com</span> </div>
									<div> <span id="summary_phone" >32145687987</span> </div>
								</div>
								<!--EEdit-->
								<div class="col-sm-12" style="padding:0">
											<div class="col-sm-12" style="padding:0; height: 15px"> &nbsp; </div>
									<div class="col-sm-6" style="padding:0">
										<a href="#" id="summary_edit_btn2" class="button" style="
											background-color:#000000;
											color: #ffffff;
											padding: 15px 25px;
											text-align: center;
											text-decoration: none;
											display: inline-block;
											font-size: 16px;
											border: none;
											width: 90%;
											cursor: pointer;"> <?php echo $words['edit'] ?><!--EDIT--> </a>
									</div>
								</div>
								
								<div class="col-sm-12" style="height:15px;"> 	</div>
						
							</div>
							<!--/billing summary-->						
							
							
						</div>
						<!--/left side-->
						
						<!--right side -->
						<div id="na-left" class="col-sm-5">
						
							<!--grey block applied prom ocodes -->
							<?php if(!empty($applied_promotions)): ?>
							<div class="col-sm-12" style="background-color:#EEEEEE; padding: 5px 5px 15px 5px;" >
									<div class="col-sm-12">
										Promotions automatically applied
									</div>
									<ul style="padding-left: 30px;">
										
									<?php foreach($applied_promotions as $applied_promotion):?>
										<div class="col-sm-12">
											<li style="list-style: disc; color: green;" >	<?php echo $applied_promotion ;?> <span style="float: right;">APPLIED</span> </li> 
										</div>
									<?php endforeach;?>
									</ul>
									
									
							</div>
							<div class="col-sm-12"  style="height: 30px; padding: 0" >&nbsp;</div>
							<?php endif; ?>
							<!--/grey block applied prom ocodes -->
							
							
								
							<!--grey block promo code input-->
							<div class="col-sm-12" style="background-color:#EEEEEE; padding: 5px 5px 15px 5px;" >
								<div class="col-sm-12">
									<label class="na-label" >
										<?php echo $words['enter_promo'] ?> <!--Enter your promo code-->
									</label>
								</div>
								
								<div class="col-sm-8">
									<input id="promo_code_field" type="text" maxlength="20" class="na-input" name = "na_firstname" />								
								</div>
								<div class="col-sm-4"  >
									<button id="promo_code_btn" type="submit" style="margin-top: 0;line-height: 50px;border: none;background-color: black;color: white;padding: 0 15px 0 15px;" >APPLY</button>							
									
									<div class="col-sm-12" style="height: 5px;" > </div>
								
								</div>
								<div class="col-sm-12" > 
									<!--error or success messages -->
									<div class="col-sm-12" id="error_promo_msg" style="color: red; padding-top: 10px; display:none; ">
										<span> <?php echo $words['invalid_promo'] ?> <!--invalid prmotion code--> </span>
									</div>
									<div class="col-sm-12" id="success_promo_msg" style="color: green; padding-top: 10px; display:none; ">
										<span ><?php echo $words['promo_ok'] ?> <!--prmotion code was successfully applied !--></span>
									</div>
									<div class="col-sm-12" id="promo_code_field_error" style="color: red; padding-top: 10px; display:none; ">
										<span><?php echo $words['error_char'] ?><!--Character not allowed --></span>
									</div>
									<!--//error or success messages //-->
								</div>
							</div>
							<!--/grey block promo code input-->
							
							<div class="col-sm-12"  style="height: 30px; padding: 0" >&nbsp;</div>
							
							<!--grey block handling customs-->
							<div class="col-sm-12" style=" padding: 5px; font-size: 1.16667rem; border: solid 1px grey;" >
								
								<div class="col-sm-12" style="padding: 5px 0 5px 0; margin-left: 15px; " > 
									<input  id="ctcoc1" type="radio" class="customer_take_care_of_customs" name="customer_take_care_of_customs" value="0" >
									<label  for="ctcoc1"> <?php echo $words['pay_tax_now'] ?> <!--Pay Duties and taxes now (Recommended)-->  </label> <span data-toggle="tooltip" title="<?php echo $words['pay_tax_now_info'] ?>  " class="glyphicon glyphicon-info-sign" aria-hidden="true" style="color: #124fe1;" ></span>
								</div>
								
								<div class="col-sm-12" style="padding: 5px 0 5px 0; margin-left: 15px;" > 
									<input  id="ctcoc0" type="radio" class="customer_take_care_of_customs" name="customer_take_care_of_customs" value="1">
									<label for="ctcoc0"> <?php echo $words['pay_tax_latr'] ?> <!--Pay Duties and taxes upon delivery --> </label> <span data-toggle="tooltip" title="<?php echo $words['pay_tax_latr_info'] ?> " class="glyphicon glyphicon-info-sign" aria-hidden="true" style=" color: #124fe1;" ></span>
								</div>
								
								<div class="col-sm-12" style="height:5px;" > </div>
								
								
							</div>
							<!--/grey block handling customs-->
							
							<div class="col-sm-12"  style="height: 30px; padding: 0" >&nbsp;</div>
							
							<!--grey block prices-->
							<div class="col-sm-12" style=" background-color:#EEEEEE; padding: 5px; font-size: 1.16667rem;" >
								
								<div class="col-sm-12" style="padding: 5px 0 5px 0;background-color: #666666; color: white;" > 
									<div class="col-sm-6" style="" > <?php echo $words['order_subtotal'] ?> <!--ORDER SUBTOTAL-->  </div>
									<div class="col-sm-6" style="font-weight: bold;text-align: right;" > <span  id="order_sub_total" ><?php echo($currency.number_format($order_sub_total, 2, '.', ','));?></span> </div>
								</div>
								
								<div class="col-sm-12" style="height:5px;" > </div>
								
								<div class="col-sm-12" style="padding: 5px 0 5px 0;background-color: #666666; color: white;" > 
									<div class="col-sm-9"> <?php echo $words['shipping_fees'] ?> <!--SHIPPING AND HANDLING FEES-->  </div>
									<div class="col-sm-3" style="font-weight: bold;text-align: right;" >  <span  id="shipping_fee" ><?php echo($currency.number_format($shipping_and_handling_fee, 2, '.', ','));?></span> </div>
								</div>
								
								<div class="col-sm-12" style="height:5px;" > </div>
								
								<?php if($discount_total > 0): ?>
								<div id="discount_total_line" class="col-sm-12" style="padding: 5px 0 5px 0;color: #090909;border: 1px solid green;" > 
									<div class="col-sm-6"> <?php echo $words['discount_total'] ?> <!--DISCOUNT TOTAL-->  </div>
									<div class="col-sm-6" style="font-weight: bold;text-align: right;" >  <span  id="total_discount" ><?php echo("- ".$currency.number_format($discount_total, 2, '.', ','));?></span> </div>
								</div>
								<?php else: ?>
								<div id="discount_total_line" class="col-sm-12" style="padding: 5px 0 5px 0;color: #090909;border: 1px solid green; display: none;" > 
									<div class="col-sm-6"> <?php echo $words['discount_total'] ?> <!--DISCOUNT TOTAL-->  </div>
									<div class="col-sm-6" style="font-weight: bold;text-align: right;" >  <span  id="total_discount" ><?php echo("- ".$currency.number_format($discount_total, 2, '.', ','));?></span> </div>
								</div>
								<?php endif; ?>
								
								<div class="col-sm-12" style="height:5px;" > </div>
								
								<div class="col-sm-12" style="padding: 5px 0 5px 0;background-color: #666666; color: white;" >  
									<div class="col-sm-6"> <?php echo $words['sub_total'] ?> <!--SUB-TOTAL--> </div>
									<div class="col-sm-6" style="font-weight: bold;text-align: right;" > <span  id="sub_total" > <?php echo($currency.number_format($subtotal, 2, '.', ','));?> </span> </div>
								</div>
								
								<div class="col-sm-12" style="height:5px;" > </div>
								
								<div class="col-sm-12" id="custom_fee_line" style="padding: 5px 0 5px 0;background-color: #666666; color: white;" > 
									<div class="col-sm-6"> <?php echo $words['custom_fee'] ?> <!--CUSTOM FEES--> </div>
									<div class="col-sm-6" style="font-weight: bold;text-align: right;" > <span  id="custom_fee" >  <?php echo($currency.number_format($optional_custom_fees, 2, '.', ','));?> </span> </div>
								</div>
								
								<div class="col-sm-12" style="height:5px;" > </div>
								<div class="col-sm-12" style="height:5px;" > </div>
								<div class="col-sm-12" style="height:5px;" > </div>
								
								<div class="col-sm-12" style="padding: 5px 0 5px 0;background-color: #666666; color: white;" > 
									<div class="col-sm-6" style="font-weight: bold;" > <?php echo $words['grand_total'] ?> <!--GRAND TOTAL-->  </div>
									<div class="col-sm-6" style="font-weight: bold;text-align: right;" > <span id="grand_total" ><?php echo($currency.number_format($grand_total, 2, '.', ','));?></span> </div>
								</div>
								
								<div class="col-sm-12" style="height:25px;" > </div>
								
								<div class="col-sm-12" style="padding: 5px 0 5px 0; text-align: center;" > 
									<button id="place_order" class="place_order_inactive" type="submit"  > <?php echo $words['place_order'] ?> <!--PLACE ORDER--></button>							
								</div>
								
								<div id="progress_bar" class="col-sm-12" style="padding: 5px 0 5px 0; text-align: center; display: none;" > 
									<div class="col-sm-12" style="height:5px;" > </div>
									<img src="<?php echo $secure_base_url.'assets/system/processing.gif' ?>" />
									
								</div>
								
								<div id="declined" class="col-sm-12" style="padding: 5px 0 5px 0; text-align: center; display: none;" > 
									<div class="col-sm-12" style="height:5px;" > </div>
									<h2 style="color: red;" ><?php echo $words['declined'] ?> <!--Declined!--></h2>
									
								</div>
								
							</div>
							<!--/grey block prices-->
							
							<div class="col-sm-12"  style="height: 30px; padding: 0" >&nbsp;</div>
							
							
							
							
							
						</div>
						
						<div class="col-sm-7"  style="height: 30px; padding: 0" >&nbsp;</div>
						
						
						
						<div class="col-sm-7"  style="height: 30px; padding: 0" >&nbsp;</div>
						
						
						
						<div class="col-sm-7"  style="height: 30px; padding: 0" >&nbsp;</div>
							
					</div>
					
					<!--==========================================================================================================-->
					
					<div id="checkout_data_output_out_success" class="col-sm-12" style="display: none;">
						<h2> <img height="50px" src="<?php echo $secure_base_url.'assets/templates/eshopper/images/check-mark-success.png'; ?>" /> <?php echo $words['order_success'] ?> <!--ORDER SUCCESS !--></h2>
						
						<p> <span  id="user__name">&nbsp;</span> ,</p>
						<p><?php echo $words['thanks_line1'] ?> <!--Thank you for shopping at ShopAmerika.com. We have already begun processing your order-->  #<span id="order__no" ></span>.</p>
						<p><?php echo $words['thanks_line2'] ?> <!--You can view your order status and history at any time by visiting My Orders.--></p>
						<p><?php echo $words['thanks_line3'] ?> <!--We will keep you informed for every step of your order until it is delivered to you.--></p>
						<p><?php echo $words['thanks_line4'] ?> <!--Thank you again! and looking forward to seeing you very soon.--></p>
						
						<div class="col-sm-3" style="padding: 0;" >
								<div class="col-sm-12" style="padding:0; background-color: #green;" >
									<a href="<?php echo base_url().'customer/myorders' ; ?>" class="button sha_edit_id_btn" style="
									background-color:#000000;
									color: #ffffff;
									padding: 15px 25px;
									text-align: center;
									text-decoration: none;
									display: inline-block;
									font-size: 16px;
									border: none;
									width: 90%;
									cursor: pointer;"  > <?php echo $words['see_my_orders'] ?> <!--see my orders--> </a>
								</div>
						</div>
						
						<div class="col-sm-5" style="padding: 0;" >
								<div class="col-sm-12" style="padding:0; background-color: #green;" >
									<a href="<?php echo base_url(); ?>" class="button sha_edit_id_btn" style="
									background-color:#000000;
									color: #ffffff;
									padding: 15px 25px;
									text-align: center;
									text-decoration: none;
									display: inline-block;
									font-size: 16px;
									border: none;
									width: 90%;
									cursor: pointer;"  > <?php echo $words['continue_shopping'] ?> <!--Continue Shopping--> </a>
								</div>
						</div>
						
						
						<div class="col-sm-7"  style="height: 30px; padding: 0" >&nbsp;</div>					
						
					</div>
					
				</div>
			</div>

				

		
	</section>
