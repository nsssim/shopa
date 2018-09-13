<?php 
$this->load->helper('url');
$CI =& get_instance();
$CI->load->library('cleanurl');
$CURRENCY = "$";
$RATE = 1;

//$CI->load->library('firebug');  echo('Firebug woking behind the scene........ok <br>');
//$CI->firebug->info($customer_details,"customer_details");
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
				<div class="col-sm-9">
					
							
					<!--<a style="color: grey;" href="<?php echo base_url().'ffghgfh/sdfdsf' ?>"  > My Account </a>  <span style="font-size: 12px; color: grey;" > >My Account </span>-->
					
					<a style="color: grey;" href="<?php echo $secure_base_url.'customer/my_account' ?>"  > <?php echo $words['my_account_brdcrmp'];?>	</a>
					<img style="padding: 0; height: 12px;" src="<?php echo $secure_base_url.'assets/templates/eshopper/images/grey_arrow_right.png' ?>" />
					<span style="font-size: 12px; color: grey;" ><?php echo $words['my_account_brdcrmp'];?>  </span>
					
					<div class="col-sm-12"  style="height: 15px; padding: 0" >&nbsp;</div>
					
					<div style="margin-bottom: 5px"> <img height="32px" src="<?php echo $secure_base_url.$words['my_account_img']?>" > </div>
					
					<div style="border-bottom: 1px solid black; width: 100%; margin-bottom: 15px;" ></div>
					
					<div class="col-sm-12"  style="height: 15px; padding: 0" >&nbsp;</div>
					
					<div class="col-sm-12" style="padding: 0;">
						
						<!----------------------------------------left side -------------------------------------->
						<div class="col-sm-6" style="border: 1px solid black;padding: 0; font-family: Nunito,Helvetica,Verdana,Sans-serif;font-size: 12px;">
							<div style=" background-color: black; color:white; width: 100%; padding-left:15px; font-weight: bold; font-size: 1.15em;line-height: 2em; "> <?php echo $words['my_profile'];?> <!--MY PROFILE--></div>
							<div style="padding: 15px;" >
								<p style="color: red;" ><?php echo $words['welcome'];?> <!--WELCOME,--> <?php echo strtoupper($customer_details[0]->first_name); ?>! </p>
								
								<div class="col-sm-12"  style="height: 15px; padding: 0" >&nbsp;</div>
								
								<p><?php echo $words['update_your_personal'];?>  <!--Update your personal information, email and eReceipt preferences and more.--></p>
								
								<div class="col-sm-12"  style="height: 15px; padding: 0" >&nbsp;</div>
								
								<a href="<?php echo $secure_base_url.'customer/my_profile'; ?>" style="color: black; text-decoration: underline; cursor: pointer; " ><?php echo $words['view_edit_my_profile'];?> <!--View/Edit My Profile--></a>
								<div class="col-sm-12"  style="height: 15px; padding: 0" >&nbsp;</div>
							</div>
						</div>
						
						<!----------------------------------------middle -------------------------------------->
						<div class="col-sm-1" >
						&nbsp;
						</div>
						<!----------------------------------------right side -------------------------------------->
						<!--<div class="col-sm-5" style="border: 1px solid black;padding: 0; font-family: Nunito,Helvetica,Verdana,Sans-serif;font-size: 12px;">
							<div style=" background-color: black; color:white; width: 100%; padding-left:15px; font-weight: bold; font-size: 1.15em;line-height: 2em; "> MY PROFILE</div>
							<div style="padding: 15px;" >
								<p style="color: #FF5995;" >WELCOME, NAME! </p>
								
								<div class="col-sm-12"  style="height: 15px; padding: 0" >&nbsp;</div>
								
								<p>Update your personal information, email and eReceipt preferences and more.</p>
								
								<div class="col-sm-12"  style="height: 15px; padding: 0" >&nbsp;</div>
								
								<a style="color: black; text-decoration: underline; cursor: pointer; " >View/Edit My Profile</a>
								<div class="col-sm-12"  style="height: 15px; padding: 0" >&nbsp;</div>
							</div>
						</div>-->
						
						
						
						
					</div>
				</div>
				
				<div class="col-sm-12">
					<div class="col-sm-3">	
					
					</div>
					<div class="col-sm-9">
						<div style="border-bottom: 1px solid black; width: 100%; margin-top: 15px;" ></div>
						
						<div>
							<p>
								
							<div  style="margin-top: 10px;"  > &nbsp; </div>
							<span style="font-size: 14px" ><b><?php echo $words['view_edit_my_profile'];?> <!--STAY SAFE ONLINE--></b><br></span>
							<?php echo $words['remember_security_rl'];?> <!--Remember basic security rules:-->

							    <ul  >
									<li style="list-style-type: circle;" > <?php echo $words['rule1'];?> <!--Change your passwords periodically--> </li>
									<li style="list-style-type: circle;">  <?php echo $words['rule2'];?> <!--Avoid re-using passwords for multiple sites--> </li>
									<li style="list-style-type: circle;">  <?php echo $words['rule3'];?> <!--Use uppercase and numbers--></li>
								</ul>
							    
							    

							<?php echo $words['remember_shopamerika'];?> <!--Remember, SHOPAMERIKA will never ask you to disclose your password by email or by phone.-->

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
	