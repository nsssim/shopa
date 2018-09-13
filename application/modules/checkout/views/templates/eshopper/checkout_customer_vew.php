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
/*echo "<pre>";
var_dump($shipping_address_details);
echo "</pre>";*/
?>




	<section>
			<div class="container">
				<div class="row">
					<!--<div class="col-sm-3">

					</div>-->
					<div id="checkout_data_input" class="col-sm-12" style="/*display: none;*/">
					
						<div class="col-sm-12"  style="height: 30px; padding: 0" >&nbsp;</div>

						<!--left side -->
						<div class="col-sm-7" style=" padding: 0; /*background-color: yellow;*/ ">
							
							<!--address summary -->
							<div id="address_summary" class="col-sm-12" style="border: solid 1px #CCCCCC; " >
								<div class="col-sm-12" style="padding:0;padding-top: 15px;" >
									<div class="col-sm-8" style="padding:0" >
										<h3 style="font-weight: bold;" ><?php echo $words['shipping_address']; ?></h3>
									</div>
									<div class="col-sm-4" style="padding:0" >
										<a href="#" id="sha_change_btn" class="button" style="
										background-color:#e2e2e2;
										color: #000000;
										padding: 15px 25px;
										text-align: center;
										text-decoration: none;
										display: inline-block;
										font-size: 16px;
										border: none;
										width: 100%;
										cursor: pointer;"  > <?php echo $words['change']; ?> </a>
									</div>
								</div>
								
								<div class="col-sm-12" style="height: 1px;" > <hr> </div>
								<hr>
								<div class="col-sm-12" style="height: 15px;" > &nbsp;</div>
								<!--LLeft-->
								<div  id="v_sha_address_box" class="col-sm-6" style="padding: 0;" >
									<div > <span id="summary_first_name" > <?php echo $shipping_address_details[0]->address_f_name ?>  </span>  <span id="summary_last_name" > <?php echo $shipping_address_details[0]->address_l_name ?> </span> </div>
									<div > <span id="summary_line1" ><?php echo $shipping_address_details[0]->line_1 ?></span> , <span id="summary_line2" > <?php echo $shipping_address_details[0]->line_2 ?> </span>  </div>
									<div > <span id="summary_city" > <?php echo $shipping_address_details[0]->city_name ?> </span> , <span id="summary_county" ><?php echo $shipping_address_details[0]->county_name ?> </span> , <span id="summary_zip" ><?php echo $shipping_address_details[0]->zip_code ?> </span> </div>
									<div > <span id="summary_phone" ><?php echo $shipping_address_details[0]->tel ?></span> </div>
									<div > <span id="summary_sha_id" style="display: none;" ><?php echo $shipping_address_details[0]->address_id ?></span> </div>
								</div>
								<!--RRight-->
								<div class="col-sm-6" style="padding: 0;" >
									<div > <span style="font-weight:bold" ></span> </div>
									<div > <span>  </span> </div>
									<div > <span> </span> </div>
								</div>
								<!--EEdit-->
								<div class="col-sm-12" style="height:15px;" > 	</div>
								
								<div id="addresses_container" class="col-sm-12" style="padding: 0; margin:0;padding-bottom: 15px;display: none;">
									<?php foreach($shipping_address_details as $sh_add) : ?>
									<!--a shipping address-->
									<div class="col-sm-12" style="padding: 5px 0px; border: solid 1px #CCCCCC;display: flex; align-items: center;" >
										<!--LLeft-->
										<div class="col-sm-1" style="padding: 0;text-align: center;" > 
											<input id="sha__radio_<?php echo $sh_add->address_id ?>" class="sha__radio" type="radio" name="shipping_address"  />
										</div>
										
										<div class="col-sm-8" style="padding: 0;" > 
											<div > <span id="sha__first_name_<?php echo $sh_add->address_id ?>" > <?php echo $sh_add->address_f_name  ?> </span>  <span id="sha__last_name_<?php echo $sh_add->address_id ?>" ><?php echo $sh_add->address_l_name  ?></span> </div>
											<div > <span id="sha__line1_<?php echo $sh_add->address_id ?>" ><?php echo $sh_add->line_1  ?> </span> , <span id="sha__line2_<?php echo $sh_add->address_id ?>" ><?php echo $sh_add->line_2  ?> </span>  </div>
											<div > <span id="sha__city_<?php echo $sh_add->address_id ?>" ><?php echo $sh_add->city_name  ?> </span> , <span id="sha__county_<?php echo $sh_add->address_id ?>" ><?php echo $sh_add->county_name  ?>  </span> , <span id="sha__zip_<?php echo $sh_add->address_id ?>" ><?php echo $sh_add->zip_code  ?> </span> </div>
											<div > <span id="sha__phone_<?php echo $sh_add->address_id ?>" ><?php echo $sh_add->tel  ?></span> </div>
											<div style="display: none;" > <span id="sha__id_<?php echo $sh_add->address_id ?>" ><?php echo $sh_add->address_id  ?></span> </div>
											<?php if(!empty($sh_add->is_default)):   ?>
											<div > <span style="font-weight:bold ;" ><?php echo $words['prim_ship_addrss']; ?> <!--Primary shipping address--></span> </div>
											<?php endif;   ?>
										</div>
										
										<!--RRight-->
										<div class="col-sm-3" style="padding: 0;" >
												<div class="col-sm-12" style="padding:0; background-color: #green;" >
													<a href="<?php echo $secure_base_url.'customer/my_address_book?edit_'.$sh_add->address_id ; ?>" id="sha_edit_id_btn_<?php echo $sh_add->address_id ?>" class="button sha_edit_id_btn" style="
													background-color:#e2e2e2;
													color: #000000;
													padding: 15px 25px;
													text-align: center;
													text-decoration: none;
													display: inline-block;
													font-size: 16px;
													border: none;
													width: 90%;
													cursor: pointer;"  > <?php echo $words['edit']; ?> </a>
												</div>
										</div>
									
									</div>
									<div class="col-sm-12" style="padding: 0; " >&nbsp; </div>
									<!--a shipping address-->
									<?php endforeach; ?>
									

									
									<div class="col-sm-12" style="padding: 0; " >
										<div class="col-sm-6" style="padding: 0; " >
											<div class="col-sm-12" style="padding:0; background-color: #green;" >
													<a href="<?php echo $secure_base_url.'customer/my_address_book'; ?>" id="add_sha_btn" class="button" style="
													color: #000000;
													padding: 15px 25px;
													text-align: center;
													text-decoration: none;
													display: inline-block;
													font-size: 16px;
													border: solid 1px #000000;
													width: 90%;
													cursor: pointer;"  > <?php echo $words['add_address']; ?>	 </a>
												</div>
										</div>
										
										<div class="col-sm-3" style="padding: 0; " >
											<div class="col-sm-12" style="padding:0; background-color: #green;" >
													<a href="#" id="save_sha_btn" class="button" style="
													background-color:#000000;
													color: #ffffff;
													padding: 15px 25px;
													text-align: center;
													text-decoration: none;
													display: inline-block;
													font-size: 16px;
													border: solid 1px #000000;
													width: 90%;
													cursor: pointer;"  > <?php echo $words['save']; ?> </a>
												</div>
										</div>
										
										<div class="col-sm-3" style="padding: 0; " >
											<div class="col-sm-12" style="padding:0; background-color: #green;" >
													<a href="#" id="cancel_sha_btn" class="button" style="
													background-color:#000000;
													color: #ffffff;
													padding: 15px 25px;
													text-align: center;
													text-decoration: none;
													display: inline-block;
													font-size: 16px;
													border: solid 1px #000000;
													width: 90%;
													cursor: pointer;"  > <?php echo $words['cancel']; ?>	 </a>
												</div>
										</div>
									</div>
									
									
								</div> 
								<!--addresses container-->
								
							</div>
							<!--/address summary-->
							
							
							<!--payement method-->
							<div id="payement_method_container" class="col-sm-12"  style="padding: 0"  >
								<div id="spacer123564540" class="col-sm-12" style="height: 30px;" >	&nbsp;	</div>
								<div id="payement_method" class="col-sm-12" style="padding-right: 0px;border: solid 1px #CCCCCC; " >
									
									<div id="card_details_box" class="col-sm-12"  style="padding: 0; font-size: 12px; padding:0;  " >
										<form id="ba_form" method="post" action="<?php echo $secure_base_url.'customer/add_update_shipping_address' ; ?>"  >
											
											<!--credit card details-->
											<div id="card_details" class="col-sm-12"  style="padding: 0;padding: 25px;padding:0; padding-right:15px;  " >
												<div class="col-sm-12"  style="padding: 15px 0 5px 0; font-size: 2rem;font-weight: bold; " > <?php echo $words['credit_card']; ?> </div>
												<!--Credit card -->
											 	<div class="col-sm-12" style="padding:0;padding-top: 15px; border-bottom: 1px solid #eee;" > </div>
												
												<!--<div class="col-sm-12"  style="height: 15px" >	&nbsp; </div>-->

												<!--card type -->
												<label class="na-label"> <span style="font-size: 14px;" ><?php echo $words['car_type']; ?></span> </label><br>
												
												<select id="na_ccard_select" class="selct-menu" name = "na_ccard_select" style="height: 50px; font-size:14px; font-weight: normal; " >
													<option value="visa"  > Visa</option>
													<option value="mc"  > MasterCard</option>
													<option value="amex"  > American express</option>
												</select>
												<!--/card type -->
																						
												<div class="col-sm-12"  style="height: 15px" >	&nbsp; </div>
				
												<!--card number -->
												<label class="na-label"> <span style="font-size: 14px;" ><?php echo $words['card_number']; ?></span> </label><br>
												<input id="na_card_num" type="text" maxlength="20" class="na-input" name = "na_card_num" style="height: 50px; font-size: 16px;"   /><br>
												<div id="na_card_num_error" class="error-span-container"  >
													<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true">	</span>
													<span  style="font-size: 12px;font-family: Nunito,Helvetica,Verdana,sans-serif; " >
														<?php echo $words['invalid_card']; ?>
													</span>
												</div>
												<!--/card number -->
												
												<div class="col-sm-12"  style="height: 15px" >	&nbsp; </div>
												
												<!--expiration date -->
												<label class="na-label"> <span style="font-size: 14px;" ><?php echo $words['exp_date']; ?></span> </label><br>
												<div class="col-sm-12"  style="padding: 0; " > 
													<!--ccard Month-->
													<div class="col-sm-6"  style="padding: 0; " > 
												 		<select id="na_ccard_month_select" class="selct-menu" name = "na_ccard_month_select" style="height: 50px; font-size:14px; font-weight: normal;" >
															<option value="0"  > <?php echo $words['month']; ?></option>
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
																<option value='0'  > <?php echo $words['year']; ?> </option>
															<?php for($i = 0; $i <10; $i++) :?>
																<option value='<?php echo date("Y", strtotime("+$i year")); ?>'  > <?php echo date("Y", strtotime("+$i year")); ?> </option>
															<?php endfor; ?>
														</select>
													</div>
													<!--/ccard Year-->
												<div id="na_ccard_date_select_error" class="error-span-container"  >
													<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true">	</span>
													<span  style="font-size: 12px;font-family: Nunito,Helvetica,Verdana,sans-serif; " >
														<?php echo $words['invalid_exp_date']; ?>	
													</span>
												</div>
												</div>
												
												<!--/expiration date -->
												
												<div class="col-sm-12"  style="height: 15px" >	&nbsp; </div>
												
												<!--Security code -->
												<div class="col-sm-4"  style="padding: 0; " > 
													<label class="na-label"> <span style="font-size: 14px;" ><?php echo $words['security_code']; ?></span> </label><br>
													<input id="na_sec_code" type="text" maxlength="20" class="na-input" name = "na_sec_code" style="height: 50px; font-size: 16px;"   /><br>
												</div>
												
												<div class="col-sm-12"  style="padding: 0; " > 
													<div id="na_sec_code_error" class="error-span-container"  >
														<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true">	</span>
														<span  style="font-size: 12px;font-family: Nunito,Helvetica,Verdana,sans-serif; " >
															<?php echo $words['invalid_sec_code']; ?>
														</span>
													</div>
												</div>
												<!--/Security code -->
												
												<div class="col-sm-12"  style="height: 15px" >	&nbsp; </div>
												<div class="col-sm-12"  style="height: 15px" >	&nbsp; </div>
												
												
											</div>
											<!--/credit card details-->
											
											<!--credit card summary-->
											<div id="credit_card_summary" class="col-sm-12" style="padding-right: 0px;font-size: 14px;font-weight: normal; padding-left: 0;padding-right: 15px;display: none; ">
												
												
												<div class="col-sm-12" style="padding:0;padding-top: 15px;" >
													<div class="col-sm-8" style="padding:0" >
														<h3 style="font-weight: bold;" >Payment summary</h3>
													</div>
													
													<div class="col-sm-4" style="padding:0" >
														<a href="#" id="summary_edit_btn2" class="button" style="
														background-color:#e2e2e2;
														color: #000000;
														padding: 15px 25px;
														text-align: center;
														text-decoration: none;
														display: inline-block;
														font-size: 16px;
														border: none;
														width: 100%;
														cursor: pointer;"  > <?php echo $words['change']; ?> </a>
													</div>
												</div>
											 	
												<div class="col-sm-12" style="padding:0;padding-top: 15px; border-bottom: 1px solid #eee;" > </div>
												<div class="col-sm-12" style="height: 5px;" > &nbsp;</div>
												
												<!--LLeft-->
												<div class="col-sm-6" style="padding: 0;">
													<div id="summary_ccard"> <span >Credit Card</span> </div>
													<div> <span id="summary_card_type"> </span>  </div>
													<div> <span id="summary_card_number"> </span>  </div>
													<div> <span id="summary_exiration_month">  </span> / <span id="summary_exiration_year">  </span> </div>
												</div>
												<!--RRight-->
												<div class="col-sm-6" style="padding: 0;">
													<div> <span style=""><?php echo $words['contact_info']; ?></span> </div>
													<div> <span id="summary_email"></span> </div>
													<div> <span id="summary_phone_2" >&nbsp; </span> </div>
												</div>
												
												
												<div class="col-sm-12" style="height:15px;"> 	</div>
										
											</div>
											<!--/credit card summary-->
											
											
										</form>
									</div>
									
									
									
								
								</div>	<!--/payement method-->	
							</div> <!--payement method container--> 
							
							
							<div class="col-sm-12" style="padding:0; height: 30px"> &nbsp; </div>
							
							<!--contact summary -->
							<div id="contact_summary" class="col-sm-12" style="border: solid 1px #CCCCCC; " >
								<div class="col-sm-12" style="padding:0;padding-top: 15px;" >
									<div class="col-sm-8" style="padding:0" >
										<h3 style="font-weight: bold;" ><?php echo $words['contact_info']; ?></h3>
									</div>
									
									<div class="col-sm-4" style="padding:0" >
										<a href="#" id="edit_contact_btn" class="button" style="
										background-color:#e2e2e2;
										color: #000000;
										padding: 15px 25px;
										text-align: center;
										text-decoration: none;
										display: inline-block;
										font-size: 16px;
										border: none;
										width: 100%;
										cursor: pointer;"  > <?php echo $words['change']; ?> </a>
									</div>
								</div>
								
								<div class="col-sm-12" style="height: 1px;" > <hr> </div>
								<hr>
								<div class="col-sm-12" style="height: 15px;" > &nbsp;</div>
								<!--LLeft-->
								<div id="contact_info_box" class="col-sm-6" style="padding: 0; " >
									<div > <span id="summary_contact_phone" ><?php echo $customer->phone ?></span>  </div>
								</div>
								
								<!--EEdit-->
								<div class="col-sm-12" style="height:15px;" > 	</div>
								
								<div id="contact_info_container" class="col-sm-12" style="padding: 0; margin:0;padding-bottom: 15px; display: none;">
								
									<div class="col-sm-12" style="padding: 0;" >
										<div class="col-sm-12" style="padding: 0;" > 
											<p><?php echo $words['where_to_find_u']; ?></p>							
										</div>
										
										<!--phone input-->
										<div class="col-sm-10" style="padding: 0;" >
											<label class="na-label" >
												<?php echo $words['phone_number']; ?>	
											</label><br>
											<input id="na_phone" type="text" maxlength="20" class="na-input" value="<?php echo $customer->phone ?>" name = "na_phone"   /><br>
											<div id="na_phone_error" class="error-span-container"  >
												<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true">
												</span>
												<span  style="font-size: 12px;font-family: Nunito,Helvetica,Verdana,sans-serif; " >
													<?php echo $words['invalid_phone_number']; ?>	
												</span>
											</div>
										</div>
										<!--/phone input-->
										
										<div class="col-sm-12" style="height: 15px;" > &nbsp;</div>
										
										<!--email input-->
										<!--<div class="col-sm-10" style="padding: 0;" >
											<label class="na-label"> Email Address  </label><br>
											<input id="ba_email" type="email" class="input-txt" value="<?php echo $customer->email ?>" name = "ba_email"  /><br>
											<div id="ba_email_error" class="error-span-container"  >
												<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
												<span  class="input-error-span" >Please enter an email address </span>
											</div>
											<div id="ba_email_already_in_use_error" class="error-span-container"  >
												<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
												<span  class="input-error-span" >This email is already in use  </span>
											</div>
										</div>-->
										<!--/email input-->
										
										<div class="col-sm-12" style="padding: 0; " >&nbsp; </div>
										
										<div class="col-sm-12" style="padding: 0; " >
											<div class="col-sm-5" style="padding: 0; " >
												<div class="col-sm-12" style="padding:0; " >
													<a href="#" id="save_contact_info_btn" class="button" style="
													background-color:#000000;
													color: #ffffff;
													padding: 15px 25px;
													text-align: center;
													text-decoration: none;
													display: inline-block;
													font-size: 16px;
													border: solid 1px #000000;
													width: 90%;
													cursor: pointer;"  > <?php echo $words['save']; ?> </a>
												</div>
											</div>
											
											<div class="col-sm-5" style="padding: 0; " >
												<div class="col-sm-12" style="padding:0; " >
													<a href="#" id="cancel_contact_info_btn" class="button" style="
													background-color:#000000;
													color: #ffffff;
													padding: 15px 25px;
													text-align: center;
													text-decoration: none;
													display: inline-block;
													font-size: 16px;
													border: solid 1px #000000;
													width: 90%;
													cursor: pointer;"  > <?php echo $words['cancel']; ?> </a>
												</div>
											</div>
										</div>	
									</div>
									
									<!--a shipping address-->
									
								</div> 
								<!--addresses container-->
								
							</div>
							<!--/contact summary-->
							<div class="col-sm-12" style="padding:0; height:15px; " > &nbsp; </div>
							<div class="col-sm-12" style="padding:0; text-align:right; " >
								<a href="#" id="review_order_btn" class="button" style="
									background-color:#000000;
									color: #ffffff;
									padding: 15px 25px;
									text-align: center;
									text-decoration: none;
									display: inline-block;
									font-size: 16px;
									border: none;
									width: 50%;
									cursor: pointer;"> <?php echo $words['preview_order']; ?> </a>
							</div>
							
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
									<div> <span style="font-weight:bold"><?php echo $words['contact_info']; ?></span> </div>
									<div> <span id="summary_email"> </span> </div>
									<div> <span id="summary_phone" > </span> </div>
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
											cursor: pointer;"> EDIT </a>
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
										<?php echo $words['promo_hint']; ?>
									</div>
									<ul style="padding-left: 30px;">
										
									<?php foreach($applied_promotions as $applied_promotion):?>
										<div class="col-sm-12">
											<li style="list-style: disc; color: green;" >	<?php echo $applied_promotion ;?> <span style="float: right;"><?php echo $words['applied']; ?></span> </li> 
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
										<?php echo $words['enter_promo']; ?>
									</label>
								</div>
								
								<div class="col-sm-8">
									<input id="promo_code_field" type="text" maxlength="20" class="na-input" name = "na_firstname" />								
								</div>
								<div class="col-sm-4"  >
									<button id="promo_code_btn" type="submit" style="margin-top: 0;line-height: 50px;border: none;background-color: black;color: white;padding: 0 15px 0 15px;" ><?php echo $words['apply']; ?></button>							
									
									<div class="col-sm-12" style="height: 5px;" > </div>
								
								</div>
								<div class="col-sm-12" > 
									<!--error or success messages -->
									<div class="col-sm-12" id="error_promo_msg" style="color: red; padding-top: 10px; display:none; ">
										<span><?php echo $words['invalid_promo_code']; ?> </span>
									</div>
									<div class="col-sm-12" id="success_promo_msg" style="color: green; padding-top: 10px; display:none; ">
										<span ><?php echo $words['promo_code_success']; ?></span>
									</div>
									<div class="col-sm-12" id="promo_code_field_error" style="color: red; padding-top: 10px; display:none; ">
										<span><?php echo $words['character_error']; ?> </span>
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
									<label  for="ctcoc1"> <?php echo $words['pay_duties_now']; ?>  </label> <span data-toggle="tooltip" title="<?php echo $words['pay_tax_now_info'] ?>  " class="glyphicon glyphicon-info-sign" aria-hidden="true" style="color: #124fe1;" ></span>
								</div>
								
								<div class="col-sm-12" style="padding: 5px 0 5px 0; margin-left: 15px;" > 
									<input  id="ctcoc0" type="radio" class="customer_take_care_of_customs" name="customer_take_care_of_customs" value="1">
									<label for="ctcoc0">  <?php echo $words['pay_duties_later']; ?>   </label> <span data-toggle="tooltip" title="<?php echo $words['pay_tax_latr_info'] ?> " class="glyphicon glyphicon-info-sign" aria-hidden="true" style=" color: #124fe1;" ></span>
								</div>
								
								<div class="col-sm-12" style="height:5px;" > </div>
								
								
							</div>
							<!--/grey block handling customs-->
							
							<div class="col-sm-12"  style="height: 30px; padding: 0" >&nbsp;</div>
							
							<!--grey block prices-->
							<div class="col-sm-12" style=" background-color:#EEEEEE; padding: 5px; font-size: 1.16667rem;" >
								
								<div class="col-sm-12" style="padding: 5px 0 5px 0;background-color: #666666; color: white;" > 
									<div class="col-sm-6" style="" > <?php echo $words['order_subtotal']; ?>  </div>
									<div class="col-sm-6" style="font-weight: bold;text-align: right;" > <span  id="order_sub_total" ><?php echo($currency.number_format($order_sub_total, 2, '.', ','));?></span> </div>
								</div>
								
								<div class="col-sm-12" style="height:5px;" > </div>
								
								<div class="col-sm-12" style="padding: 5px 0 5px 0;background-color: #666666; color: white;" > 
									<div class="col-sm-9"> <?php echo $words['shipping_fees']; ?>  </div>
									<div class="col-sm-3" style="font-weight: bold;text-align: right;" >  <span  id="shipping_fee" ><?php echo($currency.number_format($shipping_and_handling_fee, 2, '.', ','));?></span> </div>
								</div>
								
								<div class="col-sm-12" style="height:5px;" > </div>
								
								<?php if($discount_total > 0): ?>
								<div class="col-sm-12" style="padding: 5px 0 5px 0;color: #090909;border: 1px solid green;" > 
									<div class="col-sm-6"> <?php echo $words['discount_total']; ?>   </div>
									<div class="col-sm-6" style="font-weight: bold;text-align: right;" >  <span  id="total_discount" ><?php echo("- ".$currency.number_format($discount_total, 2, '.', ','));?></span> </div>
								</div>
								<?php else: ?>
								<div class="col-sm-12" style="padding: 5px 0 5px 0;color: #090909;border: 1px solid green; display: none;" > 
									<div class="col-sm-6"> <?php echo $words['discount_total']; ?>  </div>
									<div class="col-sm-6" style="font-weight: bold;text-align: right;" >  <span  id="total_discount" ><?php echo("- ".$currency.number_format($discount_total, 2, '.', ','));?></span> </div>
								</div>
								<?php endif; ?>
								
								<div class="col-sm-12" style="height:5px;" > </div>
								
								<div class="col-sm-12" style="padding: 5px 0 5px 0;background-color: #666666; color: white;" >  
									<div class="col-sm-6"> <?php echo $words['sub_total']; ?> </div>
									<div class="col-sm-6" style="font-weight: bold;text-align: right;" > <span  id="sub_total" > <?php echo($currency.number_format($subtotal, 2, '.', ','));?> </span> </div>
								</div>
								
								<div class="col-sm-12" style="height:5px;" > </div>
								
								<div class="col-sm-12" id="custom_fee_line" style="padding: 5px 0 5px 0;background-color: #666666; color: white;" > 
									<div class="col-sm-6"> <?php echo $words['custom_fees']; ?></div>
									<div class="col-sm-6" style="font-weight: bold;text-align: right;" > <span  id="custom_fee" >  <?php echo($currency.number_format($optional_custom_fees, 2, '.', ','));?> </span> </div>
								</div>
								
								<div class="col-sm-12" style="height:5px;" > </div>
								<div class="col-sm-12" style="height:5px;" > </div>
								<div class="col-sm-12" style="height:5px;" > </div>
								
								<div class="col-sm-12" style="padding: 5px 0 5px 0;background-color: #666666; color: white;" > 
									<div class="col-sm-6" style="font-weight: bold;" > <?php echo $words['grand_total']; ?> </div>
									<div class="col-sm-6" style="font-weight: bold;text-align: right;" > <span id="grand_total" ><?php echo($currency.number_format($grand_total, 2, '.', ','));?></span> </div>
								</div>
								
								<div class="col-sm-12" style="height:25px;" > </div>
								
								<div class="col-sm-12" style="padding: 5px 0 5px 0; text-align: center;" > 
									<button id="place_order" class="place_order_inactive" type="submit"  ><?php echo $words['place_order']; ?></button>							
								</div>
								
								<div id="progress_bar" class="col-sm-12" style="padding: 5px 0 5px 0; text-align: center; display: none;" > 
									<div class="col-sm-12" style="height:5px;" > </div>
									<img src="<?php echo $secure_base_url.'assets/system/processing.gif' ?>" />
									
								</div>
								
								<div id="declined" class="col-sm-12" style="padding: 5px 0 5px 0; text-align: center; display: none;" > 
									<div class="col-sm-12" style="height:5px;" > </div>
									<h2 style="color: red;" >Declined!</h2>
									
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
						<h2> <img height="50px" src="<?php echo $secure_base_url.'assets/templates/eshopper/images/check-mark-success.png'; ?>" /> ORDER SUCCESS !</h2>
						
						<p> <span  id="user__name">Customer</span> ,</p>
						<p><?php echo $words['thank_you_line1']; ?>  #<span id="order__no" ></span>.</p>
						<p><?php echo $words['thank_you_line2']; ?></p>
						<p><?php echo $words['thank_you_line3']; ?></p>
						<p><?php echo $words['thank_you_line4']; ?></p>
						
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
									cursor: pointer;"  > <?php echo $words['see_my_orders']; ?> </a>
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
									cursor: pointer;"  > <?php echo $words['continue_shopping']; ?> </a>
								</div>
						</div>
						
						
						<div class="col-sm-7"  style="height: 30px; padding: 0" >&nbsp;</div>					
						
					</div>
					
					
				</div>
			</div>

				

		
	</section>