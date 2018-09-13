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
	<section>
		<div class="container">
			<div class="row">
				<form id="login_frm" method="post" action="<?php echo $secure_base_url.'login/user_checkout' ?> " >
					<div class="col-sm-1">
					</div>
					
					<div class="col-sm-10">
						
						
								
						
						<!--<div style="border-bottom: 1px solid black; width: 100%; margin-bottom: 15px;" ></div>-->
						
						<!----------------------------------------left side -------------------------------------->
						<div class="col-sm-7" style="border-right: 1px solid black;">
							<div class="col-sm-10" >
								<p style="font-weight: bold;" ><?php echo $words['i_have_an_account'] ?>  </p>
								
								<p><?php echo $words['sign_in'] ?> </p>
								
								<label class="na-label" style="font-weight: bold;" > <?php echo $words['email'] ?>  </label><br>
								<input id="login_email" type="email" class="input-txt" name="email" /><br>
								
								<!--email errors-->
								<div id="email_error" class="error-span-container"  >
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
									<span  class="input-error-span"> <?php echo $words['error_email'] ?> </span>
								</div>
								
								<?php if($wrong_email == 1): ?>
								<div id="email_not_found" class="error-span-container" style="display: block;"  >
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
									<span  class="input-error-span" ><?php echo $words['error_email_2'] ?> <a style="color: black; text-decoration: underline;" href="<?php echo $secure_base_url.'customer/my_profile' ?> " > <?php echo $words['create_new_account'] ?>  </a> </span>
								</div>
								<?php endif; ?>
								<!--/email errors-->
								
								<div style="height: 15px" > &nbsp;</div>
								<label class="na-label" style="font-weight: bold;"> <?php echo $words['password'] ?>  </label> <span style="float: right; color: grey;" > <?php echo $words['password_info'] ?> </span><br>
								<input id="login_password" type="password" class="input-txt" name="password" /><br>
								
								<!--password errors-->
								<div id="password_error" class="error-span-container"  >
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
									<span class="input-error-span"   ><?php echo $words['error_password'] ?> </span>
								</div>
								
								<?php if($wrong_email_or_password == 1): ?>
								<div id="email_not_found" class="error-span-container" style="display: block;"  >
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
									<span  class="input-error-span" ><?php echo $words['email_password_error'] ?> <a style="color: black; text-decoration: underline;" href="<?php echo $secure_base_url.'customer/reset_my_password' ?> " > <?php echo $words['reset_now'] ?> </a> </span>
								</div>
								<?php endif; ?>
								<!--/password errors-->
								
								<input type="hidden" name="checkout" value="1">	
								
								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">	
								
								<div style="height: 15px" > &nbsp;</div>
								
								<div  style="text-align:left;">
									<button id="login_submit_btn" type="submit"  style="
										background-color:#000000 ;  
										border: none; 
										color: #ffffff;
										padding: 15px 32px;
										margin-top: 5px;
										text-align: center;
										text-decoration: none;
										display: inline-block;
										font-size: 16px;
										cursor: pointer;"> <?php echo $words['checkout'] ?>  </button>
										
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
								<div> <a style="color: black; text-decoration: underline;" href="<?php echo $secure_base_url.'login/frgt_pwd' ?>"> <?php echo $words['forgot_password'] ?> </a>  </div>
							</div>
						</div>
						
						<!----------------------------------------right side -------------------------------------->
						<div class="col-sm-5" >
							
							<div style="text-align:center;">
								<p style="font-weight:bold;" > <?php echo $words['no_have_account_yet'] ?> </p>
								<a 
									href="<?php echo $secure_base_url.'checkout/guest_checkout' ?> "
									class="button" style="
									background-color:#000000;   
									color: #ffffff;
									padding: 15px 32px;
									text-align: center;
									text-decoration: none;
									display: inline-block;
									font-size: 16px;
									cursor: pointer;"  ><?php echo $words['checkout_as_guest'] ?>
								</a>
								
								<div style="height: 15px" > &nbsp;</div>
								
								<a href="<?php echo $secure_base_url.'customer/my_account' ; ?>" > <img width="50%" src='<?php echo $secure_base_url.$words["sign_up_now_img"] ?>' /></a>	
								
							</div><br>
							
							
						
						</div>
					</div>
				
				</form>
				<!-------------->
				
				<div class="col-sm-12">
					<div class="col-sm-1">	
					
					</div>
					<div class="col-sm-10">
						<div style="border-bottom: 1px solid black; width: 100%; margin-top: 15px;" ></div>
						
						<div>
							<p>
								
							<div  style="margin-top: 10px;"  > &nbsp; </div>
							<span style="font-size: 14px" ><b><?php echo $words['stay_safe'] ?></b><br></span>
							<?php echo $words['remember_basic_pass'] ?>

							    <ul  >
									<li style="list-style-type: circle;" > <?php echo $words['rule1'] ?></li>
									<li style="list-style-type: circle;">  <?php echo $words['rule2'] ?></li>
									<li style="list-style-type: circle;">  <?php echo $words['rule3'] ?></li>
								</ul>
							    
							    

							<?php echo $words['remember_shopamerika'] ?>

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
	