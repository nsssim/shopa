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
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
				
					<?php include("customer_left_vew.php"); ?>
					
				</div>
				
				<form id="login_frm" method="post" action="<?php echo $secure_base_url.'login/user' ?> " >
					
					<div class="col-sm-9">
						
								
						<!--<a style="color: grey;" href="<?php echo base_url().'ffghgfh/sdfdsf' ?>"  > My Account </a>  <span style="font-size: 12px; color: grey;" > >Sign In </span>-->
						
						<a style="color: grey;" href="<?php echo $secure_base_url.'customer/my_account' ?>"  > <?php echo $words['my_account_brdcrmp'] ?> <!--My Account-->	</a>
						<img style="padding: 0; height: 12px;" src="<?php echo $secure_base_url.'assets/templates/eshopper/images/grey_arrow_right.png' ?>" />
						<span style="font-size: 12px; color: grey;" > <?php echo $words['sign_in_brdcrmp'] ?> <!--Sign In--> </span>
						
						
						
						
						<div style="background-color: #F0F0F0; font-size: 10px; text-align:center;line-height: 4em;margin-top: 10px; " >
							<?php echo $words['top_msg'] ?> <!--CREATE A SHOPAMERIKA.COM ACCOUNT TO EXPEDITE CHECKOUT, TRACK ORDERS, MANAGE YOUR LOYALLIST ACCOUNT & MORE.-->
						</div>
						<br>
						<div style="margin-bottom: 5px"> <img src="<?php echo $secure_base_url.$words['signin_img'] ?>" > </div>
						
						<div style="border-bottom: 1px solid black; width: 100%; margin-bottom: 15px;" ></div>
						
						<!----------------------------------------left side -------------------------------------->
						<div class="col-sm-7" style="border-right: 1px solid black;">
							<p> <?php echo $words['returning_customer'] ?> <!--RETURNING CUSTOMERS, PLEASE SIGN IN--> </p>
							<div style="border-bottom: 1px dashed black; width: 100%;" ></div>
							<p><?php echo $words['if_you_already'] ?> <!--If you already have a shopamerika.com account, please sign in.--></p>
							
							<label class="na-label"> <?php echo $words['email'] ?> <!-- Email Address-->  </label><br>
							<input id="login_email" type="email" class="input-txt" name="email" /><br>
							<div id="email_error" class="error-span-container"  >
								<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
								<span  class="input-error-span" ><?php echo $words['error_email'] ?> <!--Please enter an email address--> </span>
							</div>
							
							<div style="height: 15px" > &nbsp;</div>
							<label class="na-label"> <?php echo $words['password'] ?> <!--Password-->  </label> <span style="float: right; color: grey;" > <?php echo $words['password_notice'] ?> <!--Passwords are case sensitive--> </span><br>
							<input id="login_password" type="password" class="input-txt" name="password" /><br>
							<div id="password_error" class="error-span-container"  >
							<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
							<span class="input-error-span"   > <?php echo $words['error_password'] ?> <!--Your password must be between 5-16 characters, and cannot include . , - | \ / = _ % or spaces. Please try again.--> </span>
							
							</div>
							
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">	
							
							
							<div id="login_submit_btn" style="text-align:left;">
								<button type="submit"  style="
									background-color:#000000 ;  
									border: none; 
									color: #ffffff;
									padding: 15px 32px;
									margin-top: 5px;
									text-align: center;
									text-decoration: none;
									display: inline-block;
									font-size: 16px;
									cursor: pointer;"> <?php echo $words['signin_btn'] ?>  <!--SIGN IN-->  </button>
									
								<!--<a class="button" style="
									background-color:#000000 ;   
									color: #ffffff;
									padding: 15px 32px;
									margin-top: 5px;
									text-align: center;
									text-decoration: none;
									display: inline-block;
									font-size: 16px;
									cursor: pointer;"  >SIGN IN 
								</a>-->
							</div><br>
							<div> <a style="color: black; text-decoration: underline;" href="<?php echo $secure_base_url.'login/frgt_pwd' ?>"> <?php echo $words['forgot_password'] ?> <!--forgot your password ?--> </a>  </div>
						</div>
						
						<!----------------------------------------right side -------------------------------------->
						<div class="col-sm-5" >
							<p> <?php echo $words['dont_have_account'] ?> <!--DON'T HAVE AN ACCOUNT YET?--> </p>
							<div style="border-bottom: 1px dashed black; width: 100%;" ></div>
							<p> <?php echo $words['signup_with_shopamer'] ?> <!--Sign up with shopamerika.com to use our convenient site features and expedited check out.--> </p>
							
							<div style="text-align:center;">
								<a 
									href="<?php echo $secure_base_url.'customer/my_profile' ?> "
									class="button" style="
									background-color:#000000;   
									color: #ffffff;
									padding: 15px 32px;
									text-align: center;
									text-decoration: none;
									display: inline-block;
									font-size: 16px;
									cursor: pointer;"  >  <?php echo $words['signup_btn'] ?> <!--SIGN UP--> 
								</a>
							</div><br>
							
							
						
						</div>
					</div>
				
				</form>
				<!-------------->
				
				<div class="col-sm-12">
					<div class="col-sm-3">	
					
					</div>
					<div class="col-sm-9">
						<div style="border-bottom: 1px solid black; width: 100%; margin-top: 15px;" ></div>
						
						<div>
							<p>
								
							<div  style="margin-top: 10px;"  > &nbsp; </div>
							<span style="font-size: 14px" ><b> <?php echo $words['stay_safe_online'] ?> <!--STAY SAFE ONLINE--></b><br></span>
							Remember basic password rules:

							    <ul  >
									<li style="list-style-type: circle;" > <?php echo $words['rule1'] ?> <!--Change your passwords periodically--></li>
									<li style="list-style-type: circle;"> <?php echo $words['rule2'] ?> <!--Avoid re-using passwords for multiple sites--></li>
									<li style="list-style-type: circle;"> <?php echo $words['rule3'] ?> <!--Use uppercase and numbers--></li>
								</ul>
							    
							    

							<?php echo $words['remember_shopamerika'] ?> <!--Remember, SHOPAMERIKA will never ask you to disclose your password by email or by phone.-->

							</p>
						</div>
						
					</div>
					</div>
				
				
				
					
					<!--<div class="panel panel-default" style="border-style: 1px solid black ;">
				
					
					    <div class="table-responsive cart_info">
					      
					    </div>
					
					    
					</div>-->
			</div>
		</div>
	</section>	
<?php } ?>
	