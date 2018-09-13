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
//$CI->firebug->info($customer,"customer");
	//$CI->firebug->info($cart_content,"cart_content");




	
//if session expired show message
if(isset($log_out_message)) 
{ 
echo $log_out_message;
}
//else show page body
else{
?>
<?php 
if(!empty($customer->first_name )) 			$first_name 		= ucfirst($customer->first_name) ; 
if(!empty($customer->last_name ))  			$last_name 			= ucfirst($customer->last_name) ;
if(!empty($customer->gender_id_fk ))    	$gender 			= $customer->gender_id_fk ; else $gender=2;
if(!empty($customer->email ))    			$email 				= $customer->email ;
if(!empty($customer->password ))    		$password 			= $customer->password ;
if(!empty($customer->phone ))    			$phone 				= $customer->phone ; else $phone="";
if(!empty($customer->language_id_fk ))    	$prim_lang		 	= $customer->language_id_fk ; else $prim_lang=2;
if(!empty($customer->newsletter ))    		$newsletter		 	= $customer->newsletter ; else $newsletter=0;
if(!empty($customer->birthdate ))    		
{
	$birthdate_month 	= substr($customer->birthdate,5,2 )  ;
	$birthdate_date 	= substr($customer->birthdate,8,2 )  ;
	$birthdate_year 	= substr($customer->birthdate,0,4 )  ;
}
else
{
	$birthdate_month = $birthdate_date = $birthdate_year = "";
}

if(!empty($customer->line_1 ))     			$ba_line1 		= $customer->line_1 ;  							else $ba_line1="";
if(!empty($customer->line_2 ))     			$ba_line2 		= $customer->line_2 ;  							else $ba_line2="";
if(!empty($customer->line_3 ))     			$ba_line3 		= $customer->line_3 ;  							else $ba_line3="";
if(!empty($customer->coutry ))     			$ba_coutry 		= $customer->coutry ;  							else $ba_coutry=1;
if(!empty($customer->city ))       			$ba_city 		= $customer->city ;	   							else $ba_city=1;
if(!empty($customer->country_province ))    $ba_county 		= $customer->country_province;					else $ba_county=1;
if(!empty($customer->zip_code ))    		$ba_zip_code 	= str_replace(' ', '', $customer->zip_code) ;	else $ba_zip_code="";



?>



	<section>
		<form id="na_form" method="post" action="<?php echo $secure_base_url.'customer/update_profile' ; ?>"  >
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
				
					<?php include("customer_left_vew.php"); ?>
					
				</div>
				<div class="col-sm-9">
					
							
					<!--<a style="color: grey;" href="<?php echo base_url().'ffghgfh/sdfdsf' ?>"  > My Account </a>  <span style="font-size: 12px; color: grey;" > >My Profile </span>-->
					
					<a style="color: grey;" href="<?php echo $secure_base_url.'customer/my_account' ?>"  >  <?php echo $words['my_account_brdcrmp']; ?> <!--My Account-->	</a>
					<img style="padding: 0; height: 12px;" src="<?php echo $secure_base_url.'assets/templates/eshopper/images/grey_arrow_right.png' ?>" />
					<span style="font-size: 12px; color: grey;" > <?php echo $words['my_profile_brdcrmp']; ?> <!--My Profile-->  </span>
					
					
					
					
					
					<div class="col-sm-12"  style="height: 15px; padding: 0" >&nbsp;</div>
					
					<?php $profile_updated = $this->input->get('profile_updated'); ?>
					<?php if(!empty($profile_updated)) : ?>
					
					<div class="alert alert-success" style="margin-top: 15px;">	 <span class="glyphicon glyphicon-ok-sign" > </span>  <?php echo $words['profile_updated_ok']; ?> <!--Your profile was successfully updated--> </div>
					
					<?php endif; ?>
					
					
					<div style="margin-bottom: 5px"> <img height="32px;" src="<?php echo $secure_base_url.$words['my_profile_img'] ?>" > </div>
					<div style="border-bottom: 1px solid black; width: 100%; margin-bottom: 15px;" ></div>
					
					<div style="color: white; background-color:black; padding: 5px 5px 5px 10px;font-weight: bold; "> <?php echo $words['mailing_add_n_info']; ?> <!--MAILING ADDRESS & INFORMATION--></div>
						<div class="col-sm-12" style="border: 1px solid black;">
							<!---------------------------------left side ------------------------------------->
							<div id="na-left" class="col-sm-6">
								
								
								
								<div style="height: 15px" > &nbsp;</div>
								
								<label class="na-label" > <?php echo $words['fname']; ?> <!--First Name-->  </label><br>
								<input id="na_firstname" type="text" maxlength="20" class="na-input" name = "na_firstname" value="<?php echo $first_name ?>" /><br>
								<div id="fname_error" class="error-span-container"  >
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
									<span  class="input-error-span" ><?php echo $words['error_fname']; ?><!--Please enter a valid first name. special charachters like +=,\|/%#$@~?<>![]{}^&*():; are not allowed--> </span>
								</div>
								
								<div style="height: 15px" > &nbsp;</div>
								
								<label class="na-label"> <?php echo $words['lname']; ?> <!--Last Name-->  </label><br>
								<input id="na_lastname" type="text" maxlength="30" class="input-txt" name = "na_lastname" value="<?php echo $last_name ?>" /><br>
								<div id="lname_error" class="error-span-container"  >
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
									<span class="input-error-span"  ><?php echo $words['error_lname']; ?> <!--Please enter a valid last name.  special charachters like +=,\|/%#$@~?<>![]{}^&*():; are not allowed--> </span>
								</div>
								
								<div style="height: 15px" > &nbsp;</div>
								
								<label class="na-label"> <?php echo $words['address_line1']; ?> <!--Mailing Address &amp; Infromation --> </label><br>
								<input id="na_sha_line1" type="text" class="input-txt"  name = "na_sha_line1" value="<?php echo $ba_line1 ?>" /><br>
								<div id="na_line1_error" class="error-span-container"  >
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
									<span  class="input-error-span" ><?php echo $words['error_add1']; ?> <!--Please enter an address. the following characters are not acepted +=%$~{}\^*;--> </span>
								</div>
								
								<div style="height: 15px" > &nbsp;</div>
								
								<label class="na-label"> <?php echo $words['address_line2']; ?> <!--Apt/Suite-->  </label><br>
								<input id="na_sha_line2" type="text" class="input-txt"  name = "na_sha_line2" value="<?php echo $ba_line2 ?>" /><br>
								<div id="na_sha_line2_error" class="error-span-container"  >
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
									<span  class="input-error-span" ><?php echo $words['error_add2']; ?><!--Special characters like +=%$~{}\^*; are not allowed--> </span>
								</div>
								
								<div style="height: 15px" > &nbsp;</div>
								
								<label class="na-label"> <?php echo $words['country']; ?> <!--country-->  </label><br>
								<select id="na_country_select" class="selct-menu" name = "na_country_select" >
									<ul>
										<li><option value="1" selected="1">Turkey</option></li>
										<!--<li><option value="2">usa</option></li>-->
									</ul>
								</select>
								
								<div style="height: 15px" > &nbsp;</div>
								
								<label class="na-label"> <?php echo $words['city']; ?> <!--city (Şehir)-->  </label><br>
								<select id="na_city_select" class="selct-menu" name = "na_city_select" >
									<ul>
										<?php foreach($cities_tr as $city_tr): ?>
											<?php if($city_tr->id == $ba_city ) $city_selected = 'selected="1"'; else $city_selected = ''; ?>
											<li><option value="<?php echo $city_tr->id ?>" <?php echo $city_selected; ?> > <?php echo $city_tr->name ?>  </option></li>
										<?php endforeach; ?>
									</ul>
								</select>
								
								<div style="height: 15px" > &nbsp;</div>
								
								<label class="na-label"> <?php echo $words['county']; ?> <!--county (İlçe)-->  </label><br>
								<select id="na_county_select" class="selct-menu" name = "na_county_select" >
									<ul>
										<?php foreach($counties_tr as $county_tr): ?>
											<?php if($county_tr->id == $ba_county ) $county_selected = 'selected="1"'; else $county_selected = ''; ?>
											<li><option value="<?php echo $county_tr->id ?>" <?php echo $county_selected; ?> > <?php echo $county_tr->name ?>  </option></li>
										<?php endforeach; ?>
									</ul>
								</select>
								
								<!--<div id="email_error" class="error-span-container"  >
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
									<span  class="input-error-span" >Please enter an email address </span>
								</div>-->
								
								<div style="height: 15px" > &nbsp;</div>
								
								<label class="na-label"> <?php echo $words['zipcode']; ?> <!--zipcode-->  </label><br>
								<input id="na_zipcode" type="text" maxlength="10" class="input-txt" name = "na_zip" value='<?php echo $ba_zip_code; ?>' /><br>
								<div id="na_zip_error" class="error-span-container" name = "na_zip_error" >
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
									<span  class="input-error-span" ><?php echo $words['error_zip']; ?> <!--Please enter a  5-digit or a 5+4-digit zip code.--> </span>
								</div>
								
								<div style="height: 15px" > &nbsp;</div>
								
								<label class="na-label"> Date Of Birth  </label><br>
								<div class="col-sm-12" style="padding: 0" >
								
									<div class="col-sm-5" style="padding: 0" >
									<select id="na_month_select" class="selct-menu" name = "na_month_select" style="width: 96% ; overflow-y: auto;max-height: 18.75rem; " >
										<ul>
											<option selected  value=''><?php echo $words['month']; ?> <!--Month--></option>
										    <option value='1' <?php if($birthdate_month == 1) echo 'selected="1";' ?> > <?php echo $words['jan']; ?></option>
										    <option value='2' <?php if($birthdate_month == 2) echo 'selected="1";' ?> > <?php echo $words['feb']; ?></option>
										    <option value='3' <?php if($birthdate_month == 3) echo 'selected="1";' ?> > <?php echo $words['mar']; ?></option>
										    <option value='4' <?php if($birthdate_month == 4) echo 'selected="1";' ?> > <?php echo $words['apr']; ?></option>
										    <option value='5' <?php if($birthdate_month == 5) echo 'selected="1";' ?> > <?php echo $words['may']; ?></option>
										    <option value='6' <?php if($birthdate_month == 6) echo 'selected="1";' ?> > <?php echo $words['jun']; ?></option>
										    <option value='7' <?php if($birthdate_month == 7) echo 'selected="1";' ?> > <?php echo $words['jul']; ?></option>
										    <option value='8' <?php if($birthdate_month == 8) echo 'selected="1";' ?> > <?php echo $words['aug']; ?></option>
										    <option value='9' <?php if($birthdate_month == 9) echo 'selected="1";' ?> > <?php echo $words['sep']; ?></option>
										    <option value='10' <?php if($birthdate_month == 10) echo 'selected="1";' ?> > <?php echo $words['oct']; ?></option>
										    <option value='11' <?php if($birthdate_month == 11) echo 'selected="1";' ?> > <?php echo $words['nov']; ?></option>
										    <option value='12' <?php if($birthdate_month == 12) echo 'selected="1";' ?> > <?php echo $words['dec']; ?></option>
											 
											
										</ul>
										
										
									</select>
									
									</div>
																	
									<div class="col-sm-3" style="padding: 0;" >
									<select id="na_date_select" class="selct-menu" name = "na_date_select" style="width: 96% ;overflow-y: auto;max-height: 18.75rem;" >
										<ul>
											<option selected  value=''><?php echo $words['date']; ?></option>
											<?php for($i=1; $i<32; $i++) : ?>
												<?php if($birthdate_date == $i)  $date_selected = 'selected="1"'; else $date_selected = '';  ?>
												<li><option value="<?php echo $i; ?>" <?php echo $date_selected; ?> > <?php echo $i; ?> </option></li>
											<?php endfor ?>
										</ul>
									</select>
									</div>
									
									<div class="col-sm-4" style="padding: 0"  >
									<?php date_default_timezone_set('Europe/Istanbul');	$date2  =  date('Y',strtotime('-12 year'));	$date1 =  date('Y',strtotime('-100 year'));	 ?>
									<select id="na_year_select" class="selct-menu" name = "na_year_select" style="width: 96% ;overflow-y: auto;max-height: 18.75rem; " >
											
										<ul>
											<option selected  value=''><?php echo $words['year']; ?></option>
											
											<?php for($i = $date1; $i<$date2; $i++ ): ?>
												<?php if($birthdate_year == $i)  $year_selected = 'selected="1"'; else $year_selected = '';  ?>
												<option value='<?php echo $i ; ?> ' <?php echo $year_selected; ?> ><?php echo $i; ?></option>
											<?php endfor  ?>
										</ul>
									</select>
									</div>
									
									<div id="na_birthdate_error" class="error-span-container"  >
										<div class="col-sm-12"  style="height: 5px; padding: 0" >&nbsp;</div>
										<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
										<span  class="input-error-span" ><?php echo $words['error_b_date']; ?> <!--The Birth Date you entered is invalid.--> </span>
									</div>
									
									
									
								</div>
								
								
								<div class="col-sm-12"  style="height: 15px; padding: 0" >&nbsp;</div>
								
								<label class="na-label"> <?php echo $words['gender']; ?> <!--Gender-->  </label><br>
								<div class="col-sm-12" >
									<div class="col-sm-6" >
										<?php if($gender == 2)  $gender_selected = 'checked'; else $gender_selected = '';  ?>
										<input type="radio" id="gender2" name="na_gender" value="2" <?php echo $gender_selected  ?> >	<label for="gender2"><?php echo $words['female']; ?></label><br>
									</div>
									
									<div class="col-sm-6" >
										<?php if($gender == 1)  $gender_selected = 'checked'; else $gender_selected = '';  ?>
										<input type="radio" id="gender1" name="na_gender" value="1" <?php echo $gender_selected  ?> >	<label for="gender1"><?php echo $words['male']; ?></label><br>
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
								
								<label class="na-label"> <?php echo $words['email']; ?> <!--Email Address-->  </label><br>
								<input id="na_email" type="email" name = "na_email" class="input-txt" value="<?php echo $email; ?>"  /><br>
								<div id="na_email_error" class="error-span-container"  >
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
									<span  class="input-error-span" ><?php echo $words['error_email']; ?>  <!--Please enter an email address--> </span>
								</div>
								<div id="na_email_already_in_use_error" class="error-span-container"  >
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
									<span  class="input-error-span" > <?php echo $words['email_exists']; ?>  <!--An account with this email already exists. Please enter a different one, or--> <a style="color:black; text-decoration: underline;" href="<?php echo $secure_base_url.'customer/my_account' ?>" > <?php echo $words['sign_in']; ?>  </a> .  </span>
								</div>
								
								<div style="height: 15px" > &nbsp;</div>
								
								<label class="na-label" > <?php echo $words['confirm_email']; ?>  </label><br>
								<input id="na_confirm_email"  type="email" name = "na_confirm_email" class="input-txt" value="<?php echo $email; ?>"  /><br>
								<div id="na_confirm_email_error" class="error-span-container"  >
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
									<span  class="input-error-span" >  <?php echo $words['error_email']; ?>  <!--Please enter an email address--> </span>
								</div>
								<div id="na_confirm_email_error2" class="error-span-container"  >
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
									<span  class="input-error-span" > <?php echo $words['error_email_mismatch']; ?> <!--emails do not match--> </span>
								</div>
								
								<div style="height: 15px" > &nbsp;</div>
								
								<label class="na-label"> <?php echo $words['password']; ?> <!--Password-->  </label> <span style="float: right; color: grey; font-size: 10px;" > <?php echo $words['pswrd_notice']; ?> <!--Passwords are case sensitive--> </span><br>
								<input id="na_login_password" type="password" name = "na_login_password" class="input-txt" value="stUZaW000M3W7" /><br>
								<div id="na_login_password_error" class="error-span-container"  >
								<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
								<span  style="font-size: 12px;font-family: Nunito,Helvetica,Verdana,sans-serif; " > <?php echo $words['error_pass']; ?> <!--Your password must be between 5-16 characters, and cannot include . , - | \ / = _ % or spaces. Please try again.--> </span>
								</div>
								<div id="na_login_password_error2" class="error-span-container"  >
								<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
								<span  style="font-size: 12px;font-family: Nunito,Helvetica,Verdana,sans-serif; " ><?php echo $words['pass_no_match']; ?><!--Passwords not matching ...--> </span>
								</div>
								
								
								<div style="height: 15px" > &nbsp;</div>
								
								<label class="na-label"> Confirm Password  </label> <span style="float: right; color: grey; font-size: 10px;" > <?php echo $words['pswrd_notice']; ?>  <!--Passwords are case sensitive--> </span><br>
								<input id="na_confirm_password" type="password" name = "na_confirm_password" class="input-txt" value="stUZaW000M3W7" /><br>
								<div id="na_confirm_password_error" class="error-span-container"  >
								<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
								<span  style="font-size: 12px;font-family: Nunito,Helvetica,Verdana,sans-serif; " > <?php echo $words['error_pass']; ?> <!--Your password must be between 5-16 characters, and cannot include . , - | \ / = _ % or spaces. Please try again.--> </span>
								</div>
								<div id="na_confirm_password_error2" class="error-span-container"  >
								<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
								<span  style="font-size: 12px;font-family: Nunito,Helvetica,Verdana,sans-serif; " ><?php echo $words['pass_no_match']; ?><!--Passwords not matching ...--></span>
								</div>
								
								<div style="height: 15px" > &nbsp;</div>
								
								<label class="na-label" > <?php echo $words['phone']; ?> <!--Phone Number (optional)-->  </label><br>
								<input id="na_phone" type="text" maxlength="20" class="na-input" name = "na_phone"  value="<?php echo $phone; ?>" /><br>
								<div id="na_phone_error" class="error-span-container"  >
								<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
								<span  style="font-size: 12px;font-family: Nunito,Helvetica,Verdana,sans-serif; " ><?php echo $words['error_phone']; ?><!--only numbers ( ) + - and X are allowed--> </span>
								</div>
								
								<div style="height: 15px" > &nbsp;</div>
								
								<label class="na-label"> <?php echo $words['primary_language']; ?> <!--primary language (Birincil dil)-->  </label><br>
								<select id="na_primary_lang" class="selct-menu" name = "na_primary_lang" >
									<ul>
										<option value='1' <?php if($prim_lang == 1) echo 'selected="1";' ?> >Türkçe</option>
										<option value='2' <?php if($prim_lang == 2) echo 'selected="1";' ?> >English</option>
									</ul>
								</select>
								
								<div style="height: 15px" > &nbsp;</div>
								
								<div class="col-sm-12" style="padding-left: 0" >
									<div class="col-sm-1"  style="padding-left: 0">
										<?php if($newsletter == 1)  $newsletter_checked = 'checked'; else $newsletter_checked = '';  ?>
										<?php $oo =55;  ?>
										<input type="checkbox" name="na_newsletter" <?php echo $newsletter_checked; ?> />
									</div>
									
									<div class="col-sm-10" style="padding-left: 0; margin-left: 0;padding-right: 0;" >
										<label class="na-label"> <?php echo $words['sign_up_for_emails']; ?> <!--Sign up for emails and be the first to learn of the latest arrivals, email-only offers and so much more.-->  </label>
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
							
							<input type="submit" value="<?php echo $words['update']; ?>" id="na_submit_btn" class="button" style="
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
	