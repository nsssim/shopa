<?php 
    $this->load->helper('url'); 
	//$this->load->library('firebug');  echo('Firebug woking behind the scene........ok <br>');
	//$this->firebug->info($user,"user");
	
?>

<html>
  <head>
	<title> <?php echo $words['welcome_to']; ?> <!--Welcome to--> SHOPAMERIKA.COM </title>
	<?php include('meta.php') ?>
	<style>
	<?php include('email.css') ?>
	
	</style>
  
  </head>
  <body>
    <h1 style="color: #000000; text-align: center;"><?php echo $words['welcome_to']; ?> <!--Welcome to--> <a style="color: red;" href= <?php echo base_url(); ?> >ShopAmerika.com</a></h1>
    
    <?php include('slogant.php') ?>
    
    <p>&nbsp;</p>
    

    
    <div id="anchor_frame">
    	
	    <?php include('categories_menu.php') ?>
	    
    
	    <div id="main_frame" >
	    	
		    <h2 style="color: #5e9ca0;">
		    <span style="color: #000000;"><?php echo $words['thank_u_for_creating']; ?> <!--THANK YOU FOR CREATING AN ACCOUNT WITH--></span> 
		    <a style="color: red;" href= <?php echo base_url(); ?> >SHOPAMERIKA.COM</a> 
		    <!--<span style="color: #000000;">ACCOUNT</span>-->
		    </h2>
		    <hr />
		    <div id="container" >
		      <div style="width: 80%;/* background-color: pink;*/ float: left;">
		      <p style="padding-left: 20px;" ><?php echo $words['dear']; ?> <!--Dear--> <?php echo strtoupper($user->first_name)." ". strtoupper($user->last_name)   ?>,</p>
		      
			        <p style="padding-left: 20px;" >
			        <?php echo $words['thanku_paragraph']; ?> <!--Thank you for creating an account with-->  <a class="" href="<?php echo base_url() ?>">ShopAmerika.com.</a> .<br><br>
			        <?php echo $words['u_ll_b_one']; ?> <!--You will be one of the first to know about ShopAmerika&apos;s special offers and dicounts.--><br><br>
			        <?php echo $words['u_can_view_ur_orders']; ?> <!--You can view your order status and history at any time by visiting--> <a class="" href="<?php echo base_url() ?>customer/myorders">My Orders.</a>
			        </p>
					
					<p style="padding-left: 20px;" >
						<?php echo $words['u_ll_b_one']; ?> <!--Thank you,--> <br>
						<?php echo $words['sa_custmr_srvc']; ?> <!--ShopAmerika Customer Service--> <br>
						1-800-445-0380 <br> 
						<?php echo $words['we_r_dedicated']; ?> <!--We are dedicated to our customers 24/7--> <br>
						<a href="mailto:customer_service@ShopAmerika.com" target="_top">customer_service@ShopAmerika.com</a>
						
					</p>
					
					
					<div class="title_line" > <?php echo $words['help_topics']; ?> <!--CUSTOMER SERVICE HELP TOPICS--></div>
					
					<div style= "two_cols">
						<div style="width:50%;float:left;" >
							<ul>
								<li><a href="<?php echo base_url();?>customer/myorders" > <?php echo $words['order_status']; ?> <!--Order Status--> </a> </li>
								<li><a href="<?php echo base_url();?>about/shipping" > <?php echo $words['shipping_policy']; ?><!--Shipping Policy--> </a> </li>
								<li><a href="<?php echo base_url();?>about" > <?php echo $words['about_us']; ?><!--About us--> </a> </li>
							</ul>
						</div>	
						<div style="width:50%; float:left;" >
							<ul>
								<li><a href="<?php echo base_url();?>about/returns" > <?php echo $words['return_n_xchange']; ?><!--Returns & Exchanges--> </a> </li>
								<li><a href="<?php echo base_url();?>about/contact" > <?php echo $words['contact_us']; ?><!--Contact Us--> </a> </li>
								<li><a href="<?php echo base_url();?>customer/myaccount" ><?php echo $words['my_account']; ?><!-- My Account--> </a> </li>
							</ul>
						</div>
						
						<p> </p>	
						<div style="margin-left: 20px;" > <?php echo $words['still_have_question']; ?> <!--Still have a question about your order?--> <a href="<?php echo base_url();?>about/contact" > <?php echo $words['contact_us']; ?> <!--Contact Us--> </a> </div>	
						
						
					</div>
					
					
					
					
					<!------------------------------------------------------------------------------------------------>
				
		      </div> <!--end main content-->
		      
		      <?php include("right_block.php") ?>
			  
		    </div> <!--end 100%-->
		    
	    </div> <!--end main_frame-->
	    
		<?php include("footer.php") ?>
    </div> <!--end anchor_frame-->
    
  </body>
</html>
