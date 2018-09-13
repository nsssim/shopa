<?php 
$this->load->helper('url');
$CI =& get_instance();
$CI->load->library('cleanurl');
$CURRENCY = "$";
$RATE = 1;

//$CI->load->library('firebug');  echo('Firebug woking behind the scene........ok <br>');
//$CI->firebug->info($customer_orders,"customer_orders");
	//$CI->firebug->info($cart_content,"cart_content");

$ssl_port_num = ":".SSL_PORT;  // :443 is the default
$base_url_str = base_url(); 
$sbu = str_replace("http","https",$base_url_str );
$secure_base_url = str_replace(".com",".com$ssl_port_num",$sbu );


?>
	<div class="col-sm-12" style="height: 15px;"> &nbsp; </div>
	<section>
		<div class="container">
			<div class="row">
				<form id="login_frm" method="post" action="<?php echo $secure_base_url.'login/change_pass' ?> " >
					<div class="col-sm-1">
					</div>
					
					<div class="col-sm-10">
						
						
								
						
						<!--<div style="border-bottom: 1px solid black; width: 100%; margin-bottom: 15px;" ></div>-->
						
						<!----------------------------------------left side -------------------------------------->
						<div class="col-sm-12" style="">
							<div class="col-sm-12" >
								<!--<div style="margin-bottom: 5px"> <img src="<?php echo $secure_base_url.'/assets/templates/eshopper/images/forgot_password.png' ?>" > </div>-->
								<div style="margin-bottom: 5px"> <img height="32px" src="<?php echo $secure_base_url.$words['reset_pwd_img'];  ?>" > </div>
								<hr>
								<div class="col-sm-12" style="height: 5px;" > &nbsp  </div>
								l
								
									<div class="col-sm-6" style="padding: 0" >
										<!------------------------------------------>
										<label class="na-label"> <?php echo $words['new_password']; ?> <!--New password-->  </label> <span style="float: right; color: grey; font-size: 10px;" > <?php echo $words['password_notice']; ?><!--Passwords are case sensitive--> </span><br>
										<input id="na_login_password" type="password" name = "na_login_password" class="input-txt"  /><br>
										<div id="na_login_password_error" class="error-span-container"  >
										<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
										<span  style="font-size: 12px;font-family: Nunito,Helvetica,Verdana,sans-serif; " ><?php echo $words['error_password']; ?><!--Your password must be between 5-16 characters, and cannot include . , - | \ / = _ % or spaces. Please try again.--> </span>
										</div>
										<div id="na_login_password_error2" class="error-span-container"  >
										<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
										<span  style="font-size: 12px;font-family: Nunito,Helvetica,Verdana,sans-serif; " ><?php echo $words['password_mismatch']; ?> <!--Passwords not matching ... --></span>
										</div>
										
										
										<div style="height: 15px" > &nbsp;</div>
										
										<label class="na-label"><?php echo $words['confirm_new_password']; ?> <?php echo $words['confirm_new_password']; ?> <!--Confirm new password-->  </label> <span style="float: right; color: grey; font-size: 10px;" > <?php echo $words['password_notice']; ?> <!--Passwords are case sensitive--> </span><br>
										<input id="na_confirm_password" type="password" name = "na_confirm_password" class="input-txt"  /><br>
										<div id="na_confirm_password_error" class="error-span-container"  >
										<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
										<span  style="font-size: 12px;font-family: Nunito,Helvetica,Verdana,sans-serif; " ><?php echo $words['error_password']; ?> <!--Your password must be between 5-16 characters, and cannot include . , - | \ / = _ % or spaces. Please try again.--> </span>
										</div>
										<div id="na_confirm_password_error2" class="error-span-container"  >
										<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
										<span  style="font-size: 12px;font-family: Nunito,Helvetica,Verdana,sans-serif; " > <?php echo $words['password_mismatch']; ?> <!--Passwords not matching ...--></span>
										</div>	
										<!------------------------------------------>
										
										<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">	
										
										<input type="hidden" name="email_token_str" value="<?php echo $email_token_str; ?>">	
										
										<div style="height: 15px" > &nbsp;</div>
										
										<div  style="text-align:left;">
											<button id="forgot_submit_btn" type="submit"  style="
												background-color:#000000 ;  
												border: none; 
												color: #ffffff;
												padding: 15px 32px;
												margin-top: 5px;
												text-align: center;
												text-decoration: none;
												display: inline-block;
												font-size: 16px;
												cursor: pointer;"> <?php echo $words['submit']; ?><!--SUBMIT-->  </button>
												
										
										</div><br>
									</div>
								
							</div>
						</div>
						
						
						
					</div>
				
				</form>
				<!-------------->
				

			</div>
		</div>
	</section>
	
		<section>	
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					
					<div style="border-bottom: 1px solid black; width: 100%; margin-top: 15px;" ></div>
					
					<div>
						<p>
							
						<div  style="margin-top: 10px;"  > &nbsp; </div>
						<span style="font-size: 14px" ><b><?php echo $words['stay_safe_online']; ?><!--STAY SAFE ONLINE--></b><br></span>
						<?php echo $words['remember_pswd_rules']; ?><!--Remember basic password rules:-->

						    <ul  >
								<li style="list-style-type: circle;" > <?php echo $words['rule1']; ?><!--Change your passwords periodically--></li>
								<li style="list-style-type: circle;"> <?php echo $words['rule2']; ?><!--Avoid re-using passwords for multiple sites--></li>
								<li style="list-style-type: circle;"> <?php echo $words['rule3']; ?><!--Use uppercase and numbers--></li>
							</ul>
						    
						    

						<?php echo $words['remember_shopamerika']; ?><!--Remember, SHOPAMERIKA will never ask you to disclose your password by email or by phone.-->

						</p>
					</div>
						
				</div>
					
			</div>
		</div>
	</section>		
	