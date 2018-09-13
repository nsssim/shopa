<p style="padding: 20px;" >
	<?php echo $words['thank_you']; ?><!--Thank you,--> <br>
	<?php echo $words['sa_custmr_srvc']; ?><!--ShopAmerika Customer Service--> <br>
	<?php echo $words['tel_num']; ?> <!--1-800-445-0380--> <br> 
	<?php echo $words['we_r_dedicated']; ?><!--We are dedicated to our customers 24/7--> <br>
	<a href="mailto:customer_service@ShopAmerika.com" target="_top">customer_service@ShopAmerika.com</a>
						
</p>
					
<div class="title_line" > <?php echo $words['help_topics']; ?> <!--CUSTOMER SERVICE HELP TOPICS--></div>

<div style= "two_cols">
	<div style="width:50%;float:left;" >
		<ul>
			<li><a href="<?php echo base_url();?>customer/myorders" > <?php echo $words['order_status']; ?> <!--Order Status--> </a> </li>
			<li><a href="<?php echo base_url();?>about/shipping" > <?php echo $words['shipping_policy']; ?> <!--Shipping Policy--> </a> </li>
			<li><a href="<?php echo base_url();?>about" > <?php echo $words['about_us']; ?> <!--About us--> </a> </li>
		</ul>
	</div>	
	<div style="width:50%; float:left;" >
		<ul>
			<li><a href="<?php echo base_url();?>about/returns" > <?php echo $words['return_n_xchange']; ?><!-- Returns & Exchanges--> </a> </li>
			<li><a href="<?php echo base_url();?>about/contact" > <?php echo $words['contact_us']; ?> <!--Contact Us--> </a> </li>
			<li><a href="<?php echo base_url();?>customer/myaccount" > <?php echo $words['my_account']; ?> <!--My Account--> </a> </li>
		</ul>
	</div>
	
	<p> </p>	
	<div style="margin-left: 5px;" > <?php echo $words['still_have_question']; ?> <!--Still have a question about your order?--> <a href="<?php echo base_url();?>about/contact" > <?php echo $words['contact_us']; ?> <!--Contact Us--> </a> </div>	
	
	
</div>