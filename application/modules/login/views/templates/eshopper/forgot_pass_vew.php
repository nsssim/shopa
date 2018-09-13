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



	
//if session expired show message
if(isset($log_out_message)) 
{ 
echo $log_out_message;
}
//else show page body
else{
?>
	<div class="col-sm-12" style="height: 15px;"> &nbsp; </div>
	<?php if (empty($email_sent)) : ?>
	<section>
		<div class="container">
			<div class="row">
				<form id="login_frm" method="post" action="<?php echo $secure_base_url.'login/forgot_password_ctrl' ?> " >
					<div class="col-sm-1">
					</div>
					
					<div class="col-sm-10">
						
						
								
						
						<!--<div style="border-bottom: 1px solid black; width: 100%; margin-bottom: 15px;" ></div>-->
						
						<!----------------------------------------left side -------------------------------------->
						<div class="col-sm-12" style="">
							<div class="col-sm-12" >
								<div style="margin-bottom: 5px"> <img src="<?php echo $secure_base_url.$words['forgot_pass_img'] ?>" > </div>
								<hr>
								<div class="col-sm-12" style="height: 5px;" > &nbsp  </div>
								<p><?php echo $words['enter_ur_email'] ?><!--Enter your email address and we'll send you an email with a link to reset your password.--> </p>
								
									<div class="col-sm-6" style="padding: 0" >
										<label class="na-label" style="font-weight: bold;" ><?php echo $words['email_adrs'] ?> <!--Email Address-->  </label><br>
										<input id="login_email" type="email" class="input-txt" name="email" /><br>
										
										<!--email errors-->
										<div id="email_error" class="error-span-container"  >
											<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
											<span  class="input-error-span" ><?php echo $words['error_email'] ?><!--Please enter an email address--> </span>
										</div>
										<!--/email errors-->
										
										<div style="height: 15px" > &nbsp;</div>
										
										<?php echo $widget;?>
										<?php echo $script;?>
										
										
										
										<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">	
										
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
												cursor: pointer;"> <?php echo $words['submit'] ?><!--SUBMIT-->  </button>
												
										
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
	<?php else: ?>
	<section>	
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div style="margin-bottom: 5px"> <img src="<?php echo $secure_base_url.$words['forgot_pass_img'] ?>" > </div>
					<hr>
					
					<div class="col-sm-12" style="height: 5px;"> &nbsp; </div>
					<p><?php echo $words['if_ur_email_adrs_is'] ?><!--If your email address is associated with a shopamerika.com profile, we'll email you instructions for resetting your password.--></p>

					<p><?php echo $words['if_u_dont_recv_eml'] ?><!--If you don't receive this email, please look for it in your spam folder or double check the spelling of your email. For more information, visit our Customer Service pages.--></p>
				</div>
				
				<div class="col-sm-12">
					
					<div style="border-bottom: 1px solid black; width: 100%; margin-top: 15px;" ></div>
					
					<div>
						<p>
							
						<div  style="margin-top: 10px;"  > &nbsp; </div>
						<span style="font-size: 14px" ><b><?php echo $words['stay_safe_online'] ?><!--STAY SAFE ONLINE--></b><br></span>
						<?php echo $words['remember_pass_rules'] ?><!--Remember basic password rules:-->

						    <ul  >
								<li style="list-style-type: circle;" > <?php echo $words['rule1'] ?><!--Change your passwords periodically--></li>
								<li style="list-style-type: circle;"> <?php echo $words['rule2'] ?><!--Avoid re-using passwords for multiple sites--></li>
								<li style="list-style-type: circle;"> <?php echo $words['rule3'] ?><!--Use uppercase and numbers--></li>
							</ul>
						    
						    

						<?php echo $words['remember_shopamerika'] ?><!--Remember, SHOPAMERIKA will never ask you to disclose your password by email or by phone.-->

						</p>
					</div>
						
				</div>
					
			</div>
		</div>
	</section>	
	
	<?php endif ; //endif(empty($email_sent))  ?>
<?php } ?>
	