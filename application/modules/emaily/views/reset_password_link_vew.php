<?php 
    $this->load->helper('url'); 
	//$this->load->library('firebug');  echo('Firebug woking behind the scene........ok <br>');
	//$this->firebug->info($user,"user");
	$CI              =& get_instance();
	$ssl_port_num    = ":".SSL_PORT;  // :443 is the default
	$base_url_str    = base_url();
	$sbu             = str_replace("http","https",$base_url_str );
	$secure_base_url = str_replace(".com",".com$ssl_port_num",$sbu );

	
?>

<html>
  <head>
	<title> <?php echo $words['subject_email']; ?>  </title> 
	<?php include('meta.php') ?>
	<style>
	<?php include('email.css') ?>
	
	</style>
  
  </head>
  <body>
   
   <?php include('slogant.php') ?>
   
   <p>&nbsp;</p>
    

    
    <div id="anchor_frame">
    	
	  <?php include('categories_menu.php') ?>
    
	    <div id="main_frame" >
	    	
		    <h2 style="color: #5e9ca0;"> <span style="color: #000000;"><?php echo $words['reset_your_pswd']; ?><!--RESET YOUR PASSWORD--></span> 		   </h2>
		    <hr />
		    <div id="container" >
		      <div style="width: 100%;/* background-color: pink;*/ float: left;">
		      <p style="padding-left: 20px;" ><?php echo $words['dear']; ?><!--Dear--> <?php echo strtoupper($user->first_name)." ". strtoupper($user->last_name)   ?>,</p>
		      
			        <p style="padding-left: 20px;" >
			        	<?php echo $words['we_recvd_rqst']; ?> <!--We received a request to change the password for the--> <a class="" href="<?php echo base_url() ?>">ShopAmerika.com.</a><?php echo $words['profile_assosiated']; ?> <!--profile associated with this email address.--> 	
			        </p>
			        
			        <p style="padding-left: 20px;" >
			        	<?php echo $words['to_reset_click']; ?><!--To reset your password, click this--> <a href=" <?php echo $secure_base_url.'login/reset_password/'.$email_token; ?> " > <?php echo $words['link']; ?><!--link--> </a>  <?php echo $words['valid_x_hour']; ?><!--(valid for 4 hours).-->
						
			        </p>
			        
			        <p style="padding-left: 20px;" >
			        	<?php echo $words['if_u_didnt']; ?><!--If you didn't request a password reset, please let us know immediately by calling--> <?php echo $words['phone_num']; ?><!--1-800-445-0380--> <?php echo $words['or_send_us']; ?><!--or send us an email to--> <a href="mailto:customer_service@ShopAmerika.com" target="_top">customer_service@ShopAmerika.com</a>
			        </p>

					<p style="padding-left: 20px;" >
						<?php echo $words['thnku']; ?><!--Thank you,--> <br>
						<?php echo $words['customer_srvc']; ?><!--ShopAmerika Customer Service--> <br>
						<?php echo $words['phone_num']; ?><!--1-800-445-0380--> <br> 
						<?php echo $words['we_r_dedictd']; ?><!--We are dedicated to our customers 24/7--> <br>
						<a href="mailto:customer_service@ShopAmerika.com" target="_top">customer_service@ShopAmerika.com</a>
						
					</p>
					
					<div class="title_line" ><?php echo $words['customer_srvc']; ?><!--CUSTOMER SERVICE HELP TOPICS--></div>
					
					<div style= "two_cols">
						<div style="width:50%;float:left;" >
							<ul>
								<li><a href="<?php echo base_url();?>customer/myorders" > <?php echo $words['order_sttus']; ?><!--Order Status--> </a> </li>
								<li><a href="<?php echo base_url();?>about/shipping" > <?php echo $words['ship_policy']; ?><!--Shipping Policy--> </a> </li>
								<li><a href="<?php echo base_url();?>about" > <?php echo $words['about_us']; ?><!--About us--> </a> </li>
							</ul>
						</div>	
						<div style="width:50%; float:left;" >
							<ul>
								<li><a href="<?php echo base_url();?>about/returns" > <?php echo $words['retrn_exchnge']; ?><!--Returns & Exchanges--> </a> </li>
								<li><a href="<?php echo base_url();?>about/contact" > <?php echo $words['contact_us']; ?><!--Contact Us--> </a> </li>
								<li><a href="<?php echo base_url();?>customer/myaccount" > <?php echo $words['my_account']; ?><!--My Account--> </a> </li>
							</ul>
						</div>
						
						<p> </p>	
						<div style="margin-left: 20px;" > <?php echo $words['still_hv_qstion']; ?><!--Still have a question about your order?--> <a href="<?php echo base_url();?>about/contact" > <?php echo $words['contact_us']; ?><!--Contact Us--> </a> </div>	
						
						
					</div>
					
					
					
					
					<!------------------------------------------------------------------------------------------------>
				
		      </div> <!--end main content-->
		      
		      
			  
		    </div> <!--end 100%-->
		    
	    </div> <!--end main_frame-->
	    
		<?php include("footer.php") ?>
		
    </div> <!--end anchor_frame-->
    
  </body>
</html>
