<?php 
$this->load->helper('url');
$CI =& get_instance();
$CI->load->library('cleanurl');
$CURRENCY = "$";
$RATE = 1;

$ssl_port_num = ":".SSL_PORT;  // :443 is the default
$base_url_str = base_url(); 
$sbu = str_replace("http","https",$base_url_str );
$secure_base_url = str_replace(".com",".com$ssl_port_num",$sbu );


//$CI->load->library('firebug');  echo('Firebug woking behind the scene........ok <br>');
//$CI->firebug->info($customer_orders,"customer_orders");
	//$CI->firebug->info($cart_content,"cart_content");




	
//if session expired show message
if(isset($log_out_message)) 
{ 
echo $log_out_message;
}
//else show page body
else{
?>
	<section>
		<form id="na_form" method="post" action="<?php echo $secure_base_url.'customer/add_new' ; ?>"  >
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
				
					<?php include("customer_left_vew.php"); ?>
					
				</div>
				<div class="col-sm-9">
					
							
					<!--<a style="color: grey;" href="<?php echo base_url().'ffghgfh/sdfdsf' ?>"  > My Account </a>  <span style="font-size: 12px; color: grey;" > >Create Profile </span>-->
					
					<a style="color: grey;" href="<?php echo $secure_base_url.'customer/my_account' ?>"  > <?php echo $words['my_account_brdcrmp'] ?> <!--My Account-->	</a>
					<img style="padding: 0; height: 12px;" src="<?php echo $secure_base_url.'assets/templates/eshopper/images/grey_arrow_right.png' ?>" />
					<span style="font-size: 12px; color: grey;" > <?php echo $words['new_profile_brdcrmp'] ?> <!--Create Profile-->  </span>
					
					
					<!--<div style="background-color: #F0F0F0; font-size: 10px; text-align:center;line-height: 4em;margin-top: 10px; " >CREATE A SHOPAMERIKA.COM ACCOUNT TO EXPEDITE CHECKOUT, TRACK ORDERS, MANAGE YOUR LOYALLIST ACCOUNT & MORE.</div>-->
					<br>
					<!--<div style="margin-bottom: 5px"> <img src="<?php echo base_url().'/assets/templates/eshopper/images/signin.png' ?>" > </div>-->
					
					<!--<div style="border-bottom: 1px solid black; width: 100%; margin-bottom: 15px;" ></div>-->
					
					<div style="color: white; background-color:black; padding: 5px 5px 5px 10px;font-weight: bold; "> <?php echo $words['mailing_add_n_info'] ?> <!--MAILING ADDRESS & INFORMATION--> </div>
						<div class="col-sm-12" style="border: 1px solid black;">
							<!---------------------------------left side ------------------------------------->
							<div id="na-left" class="col-sm-6">
								
								
								
								<div style="height: 15px" > &nbsp;</div>
								
								<label class="na-label" > <?php echo $words['fname'] ?> <!--First Name-->  </label><br>
								<input id="na_firstname" type="text" maxlength="20" class="na-input" name = "na_firstname" /><br>
								<div id="fname_error" class="error-span-container"  >
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
									<span  class="input-error-span" > <?php echo $words['error_fname'] ?> <!--Please enter a valid first name. special charachters like +=,\|/%#$@~?<>![]{}^&*():; are not allowed--> </span>
								</div>
								
								<div style="height: 15px" > &nbsp;</div>
								
								<label class="na-label"> <?php echo $words['lname'] ?> <!--Last Name-->  </label><br>
								<input id="na_lastname" type="text" maxlength="30" class="input-txt" name = "na_lastname" /><br>
								<div id="lname_error" class="error-span-container"  >
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
									<span class="input-error-span"  > <?php echo $words['error_lname'] ?>  <!--Please enter a valid last name.  special charachters like +=,\|/%#$@~?<>![]{}^&*():; are not allowed--> </span>
								</div>
								
								<div style="height: 15px" > &nbsp;</div>
								
								<label class="na-label"> <?php echo $words['address_line1'] ?> <!--Mailing Address &amp; Infromation-->  </label><br>
								<input id="na_sha_line1" type="text" class="input-txt"  name = "na_sha_line1" /><br>
								<div id="na_line1_error" class="error-span-container"  >
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
									<span  class="input-error-span" > <?php echo $words['error_add1'] ?> <!--Please enter an address. the following characters are not acepted +=%$~{}\^*;--> </span>
								</div>
								
								<div style="height: 15px" > &nbsp;</div>
								
								<label class="na-label"> <?php echo $words['address_line2'] ?> <!--Apt/Suite-->  </label><br>
								<input id="na_sha_line2" type="text" class="input-txt"  name = "na_sha_line2" /><br>
								<div id="na_sha_line2_error" class="error-span-container"  >
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
									<span  class="input-error-span" >  <?php echo $words['error_add2'] ?>  <!--Special characters like +=%$~{}\^*; are not allowed--> </span>
								</div>
								
								<div style="height: 15px" > &nbsp;</div>
								
								<label class="na-label"> <?php echo $words['country'] ?> <!--country-->  </label><br>
								<select id="na_country_select" class="selct-menu" name = "na_country_select" >
									<ul>
										<li><option value="1" selected="1">Turkey</option></li>
										<!--<li><option value="2">usa</option></li>-->
									</ul>
								</select>
								
								<div style="height: 15px" > &nbsp;</div>
								
								<label class="na-label"> <?php echo $words['city'] ?> <!--city (Şehir)-->  </label><br>
								<select id="na_city_select" class="selct-menu" name = "na_city_select" >
									<ul>
										<?php foreach($cities_tr as $city_tr): ?>
											<li><option value="<?php echo $city_tr->id ?>"><?php echo $city_tr->name ?></option></li>
										<?php endforeach; ?>
									</ul>
								</select>
								
								<div style="height: 15px" > &nbsp;</div>
								
								<label class="na-label"> <?php echo $words['county'] ?> <!--county (İlçe)-->  </label><br>
								<select id="na_county_select" class="selct-menu" name = "na_county_select" >
									<ul>
										<!--<li><option value="">county (İlçe)</option></li>-->
									</ul>
								</select>
								
								<!--<div id="email_error" class="error-span-container"  >
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
									<span  class="input-error-span" >Please enter an email address </span>
								</div>-->
								
								<div style="height: 15px" > &nbsp;</div>
								
								<label class="na-label"> <?php echo $words['zipcode'] ?> <!--zipcode-->  </label><br>
								<input id="na_zipcode" type="text" maxlength="10" class="input-txt" name = "na_zip" /><br>
								<div id="na_zip_error" class="error-span-container" name = "na_zip_error" >
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
									<span  class="input-error-span" > <?php echo $words['error_zip'] ?>  <!--Please enter a  5-digit or a 5+4-digit zip code.--> </span>
								</div>
								
								<div style="height: 15px" > &nbsp;</div>
								
								<label class="na-label"> <?php echo $words['birth_date'] ?> <!--Date Of Birth-->  </label><br>
								<div class="col-sm-12" style="padding: 0" >
									<div class="col-sm-4" style="padding: 0" >
									<select id="na_month_select" class="selct-menu" name = "na_month_select" style="width: 96% ; overflow-y: auto;max-height: 18.75rem; " >
										<ul>
											<option selected  value=''><?php echo $words['month'] ?> </option>
										    <option value='1'><?php echo $words['jan'] ?></option>
										    <option value='2'><?php echo $words['feb'] ?></option>
										    <option value='3'><?php echo $words['mar'] ?></option>
										    <option value='4'><?php echo $words['apr'] ?></option>
										    <option value='5'><?php echo $words['may'] ?></option>
										    <option value='6'><?php echo $words['jun'] ?></option>
										    <option value='7'><?php echo $words['jul'] ?></option>
										    <option value='8'><?php echo $words['aug'] ?></option>
										    <option value='9'><?php echo $words['sep'] ?></option>
										    <option value='10'><?php echo $words['oct'] ?></option>
										    <option value='11'><?php echo $words['nov'] ?></option>
										    <option value='12'><?php echo $words['dec'] ?></option>
											
										</ul>
										
										
									</select>
									
									</div>
																	
									<div class="col-sm-4" style="padding: 0;" >
									<select id="na_date_select" class="selct-menu" name = "na_date_select" style="width: 96% ;overflow-y: auto;max-height: 18.75rem;" >
										<ul>
											<option selected  value=''><?php echo $words['date'] ?> <!--Date--></option>
											<?php for($i=1; $i<32; $i++) : ?>
												<li><option value="<?php echo $i; ?>"> <?php echo $i; ?> </option></li>
											<?php endfor ?>
										</ul>
									</select>
									</div>
									
									<div class="col-sm-4" style="padding: 0"  >
									<?php date_default_timezone_set('Europe/Istanbul');	$date2  =  date('Y',strtotime('-12 year'));	$date1 =  date('Y',strtotime('-100 year'));	 ?>
									<select id="na_year_select" class="selct-menu" name = "na_year_select" style="width: 96% ;overflow-y: auto;max-height: 18.75rem; " >
											
										<ul>
											<option selected  value=''><?php echo $words['year'] ?><!--Year--></option>
											
											<?php for($i = $date1; $i<$date2; $i++ ): ?>
												<option value='<?php echo $i ; ?> '><?php echo $i; ?></option>
											<?php endfor  ?>
										</ul>
									</select>
									</div>
									
									<div id="na_birthdate_error" class="error-span-container"  >
										<div class="col-sm-12"  style="height: 5px; padding: 0" >&nbsp;</div>
										<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
										<span  class="input-error-span" ><?php echo $words['error_b_date'] ?><!--The Birth Date you entered is invalid.--> </span>
									</div>
									
									
									
								</div>
								
								
								<div class="col-sm-12"  style="height: 15px; padding: 0" >&nbsp;</div>
								
								<label class="na-label"> <?php echo $words['gender'] ?> <!--Gender-->  </label><br>
								<div class="col-sm-12" >
									<div class="col-sm-6" >
										<input type="radio" id="gender2" name="na_gender" value="2" checked>	<label for="gender2"><?php echo $words['female'] ?></label><br>
									</div>
									
									<div class="col-sm-6" >
										<input type="radio" id="gender1" name="na_gender" value="1">			<label for="gender1"><?php echo $words['male'] ?></label><br>
									</div>
									
								</div>
								
								<!--//////////-->
								<!--//////////-->
								
								<div class="col-sm-12"  style="height: 50px; padding: 0" >&nbsp;</div>
								
								
								
								<!--<div style="text-align:left;">
									<a class="button" style="
										background-color:#000000 ;   
										color: #ffffff;
										padding: 15px 32px;
										margin-top: 5px;
										text-align: center;
										text-decoration: none;
										display: inline-block;
										font-size: 16px;
										cursor: pointer;"  >SIGN IN 
									</a>
								</div><br>-->
								
								<!--<div> <a style="color: black; text-decoration: underline;" href="<?php echo base_url().'dfgfd/fdgfdg' ?>"> forgot ur password ? </a>  </div>-->
							</div>
							
							<!---------------------------------right side ------------------------------------->
							<div class="col-sm-6" >
															
								<div style="height: 15px" > &nbsp;</div>
								
								<label class="na-label"> <?php echo $words['email'] ?> <!--Email Address-->  </label><br>
								<input id="na_email" type="email" name = "na_email" class="input-txt"  /><br>
								<div id="na_email_error" class="error-span-container"  >
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
									<span  class="input-error-span" ><?php echo $words['error_email'] ?><!--Please enter an email address--> </span>
								</div>
								<div id="na_email_already_in_use_error" class="error-span-container"  >
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
									<span  class="input-error-span" ><?php echo $words['email_exists'] ?><!--An account with this email already exists. Please enter a different one, or--> <a style="color:black; text-decoration: underline;" href="<?php echo $secure_base_url.'customer/my_account' ?>" ><?php echo $words['sign_in'] ?><!--Sign In--></a> .  </span>
								</div>
								
								<div style="height: 15px" > &nbsp;</div>
								
								<label class="na-label" > <?php echo $words['confirm_email'] ?><!--Confirm Email Address-->  </label><br>
								<input id="na_confirm_email"  type="email" name = "na_confirm_email" class="input-txt"  /><br>
								<div id="na_confirm_email_error" class="error-span-container"  >
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
									<span  class="input-error-span" ><?php echo $words['error_email'] ?><!--Please enter an email address--> </span>
								</div>
								<div id="na_confirm_email_error2" class="error-span-container"  >
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
									<span  class="input-error-span" ><?php echo $words['error_email_mismatch'] ?><!--emails do not match--> </span>
								</div>
								
								<div style="height: 15px" > &nbsp;</div>
								
								<label class="na-label"> <?php echo $words['password'] ?> <!--Password-->  </label> <span style="float: right; color: grey; font-size: 10px;" > <?php echo $words['pswrd_notice'] ?> <!--Passwords are case sensitive--> </span><br>
								<input id="na_login_password" type="password" name = "na_login_password" class="input-txt"  /><br>
								<div id="na_login_password_error" class="error-span-container"  >
								<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
								<span  style="font-size: 12px;font-family: Nunito,Helvetica,Verdana,sans-serif; " ><?php echo $words['error_pass'] ?><!--Your password must be between 5-16 characters, and cannot include . , - | \ / = _ % or spaces. Please try again.--> </span>
								</div>
								<div id="na_login_password_error2" class="error-span-container"  >
								<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
								<span  style="font-size: 12px;font-family: Nunito,Helvetica,Verdana,sans-serif; " ><?php echo $words['pass_no_match'] ?><!--Passwords not matching ...--> </span>
								</div>
								
								
								<div style="height: 15px" > &nbsp;</div>
								
								<label class="na-label"> <?php echo $words['confirm_pass'] ?> <!--Confirm Password-->  </label> <span style="float: right; color: grey; font-size: 10px;" > <?php echo $words['pswrd_notice'] ?><!--Passwords are case sensitive--> </span><br>
								<input id="na_confirm_password" type="password" name = "na_confirm_password" class="input-txt"  /><br>
								<div id="na_confirm_password_error" class="error-span-container"  >
								<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
								<span  style="font-size: 12px;font-family: Nunito,Helvetica,Verdana,sans-serif; " ><?php echo $words['error_pass'] ?><!--Your password must be between 5-16 characters, and cannot include . , - | \ / = _ % or spaces. Please try again.--> </span>
								</div>
								<div id="na_confirm_password_error2" class="error-span-container"  >
								<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
								<span  style="font-size: 12px;font-family: Nunito,Helvetica,Verdana,sans-serif; " ><?php echo $words['pass_no_match'] ?><!--Passwords not matching ...--></span>
								</div>
								
								<div style="height: 15px" > &nbsp;</div>
								
								<label class="na-label" ><?php echo $words['phone'] ?> <!--Phone Number (optional)-->  </label><br>
								<input id="na_phone" type="text" maxlength="20" class="na-input" name = "na_phone" /><br>
								<div id="na_phone_error" class="error-span-container"  >
								<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
								<span  style="font-size: 12px;font-family: Nunito,Helvetica,Verdana,sans-serif; " ><?php echo $words['error_phone'] ?><!--only numbers ( ) + - and X are allowed --></span>
								</div>
								
								<div style="height: 15px" > &nbsp;</div>
								
								<label class="na-label"><?php echo $words['primary_language'] ?> <!--primary language-->  </label><br>
								<select id="na_primary_lang" class="selct-menu" name = "na_primary_lang" >
									<ul>
										<li><option value="1" >Türkçe</option></li>
										<li><option value="2" selected="1">english</option></li>
										<!--<li><option value="2">usa</option></li>-->
									</ul>
								</select>
								
								<div style="height: 15px" > &nbsp;</div>
								
								<div class="col-sm-12" style="padding-left: 0" >
									<div class="col-sm-1"  style="padding-left: 0">
										<input type="checkbox" name="na_newsletter" checked />
									</div>
									
									<div class="col-sm-10" style="padding-left: 0; margin-left: 0;padding-right: 0;" >
										<label class="na-label"> <?php echo $words['sign_up_for_emails'] ?><!--Sign up for emails and be the first to learn of the latest arrivals, email-only offers and so much more.-->  </label>
									</div>
									
								</div>
								
								
								
								

								
								<div style="height: 15px" > &nbsp;</div>
								
							
																
								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">			
								<input type="hidden" name = "lastvisit_stmp2" value="<?php echo $this->security->get_csrf_hash(); ?>" />
								
								<?php /*
								<label class="na-label"> Security Question  </label><br>
								<select id="na-security-question" class="selct-menu"  >
									
									<option value="best_cartoon">What was the name of your favorite cartoon series as a child?</option>
									<option value="child_nickname">What was your oldest sibling's nickname as a child?</option>
									<option value="best_pet">What was your best pet name?</option>
									<option value="teacher_name">What was the name of your first supervisor?</option>
									
								</select>
								
								<div style="height: 15px" > &nbsp;</div>
								
								<label class="na-label"> Answer  </label>
								<input id="na-answer" type="password" class="input-txt"  /><br>
								<div id="password_error" class="error-span-container"  >
								<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
								<span  style="font-size: 12px;font-family: Nunito,Helvetica,Verdana,sans-serif; " >Your password must be between 5-16 characters, and cannot include . , - | \ / = _ % or spaces. Please try again. </span>
								</div>
								
								*/?>
								
								<div style="height: 15px" > &nbsp;</div>
								
								<!--<div style="text-align:left;">
									<a class="button" style="
										background-color:#000000 ;   
										color: #ffffff;
										padding: 15px 32px;
										margin-top: 5px;
										text-align: center;
										text-decoration: none;
										display: inline-block;
										font-size: 16px;
										cursor: pointer;"  >SIGN IN 
									</a>
								</div><br>-->
								
								<!--<div> <a style="color: black; text-decoration: underline;" href="<?php echo base_url().'dfgfd/fdgfdg' ?>"> forgot ur password ? </a>  </div>-->
							</div>
						
				</div>
					
					<!----------------------------------------right side -------------------------------------->
					<!--<div class="col-sm-6" >
						<p> DON'T HAVE AN ACCOUNT YET? </p>
						<div style="border-bottom: 1px dashed black; width: 100%;" ></div>
						<p>Sign up with shopamerika.com to use our convenient site features and expedited check out. </p>
						<div style="text-align:center;">
							<a class="button" style="
								background-color:#000000;   
								color: #ffffff;
								padding: 15px 32px;
								text-align: center;
								text-decoration: none;
								display: inline-block;
								font-size: 16px;
								cursor: pointer;"  >SIGN UP 
							</a>
						</div><br>
						
						
					
					</div>-->
			</div>
				
				<div class="col-sm-12">
						<div class="col-sm-8">	
						
						</div>
						
						<div class="col-sm-4" style="margin: 10px 0 10px 0;">
						<div style="text-align:right;">
							<!--<a class="button" style="
								background-color:#797979;   
								color: #ffffff;
								padding: 15px 32px;
								text-align: center;
								text-decoration: none;
								display: inline-block;
								font-size: 16px;
								margin-right: 10px;
								cursor: pointer;"  >CANCEL 
							</a>-->
							
							<input type="submit" value="<?php echo $words['submit_btn'] ?>" id="na_submit_btn" class="button" style="
								background-color:#000000;   
								color: #ffffff;
								padding: 15px 32px;
								text-align: center;
								text-decoration: none;
								display: inline-block;
								font-size: 16px;
								cursor: pointer;"  />
								
						</div>
						
						
							
							
							
						</div>
				</div>
				
			</div>
		</div>
		</form>	
	</section>	
<?php } ?>
	