<?php 
$ssl_port_num = ":".SSL_PORT;  // :443 is the default
$base_url_str = base_url(); 
$secure_base_url = str_replace("http","https",$base_url_str );
$secure_base_url = str_replace(".com",".com$ssl_port_num",$secure_base_url );
?>

<footer id="footer"><!--Footer-->
	<div class="footer-top">
		<div class="container">
			<div class="row">
				<div class="col-sm-2">
					<div class="companyinfo">
						<h2><span>Shop</span>Amerika</h2>
						
					</div>
				</div>
				<div class="col-sm-7">
					<p class="footer-p address"><?php echo $words["top_txt"]; ?> </p>
				</div>
				<div class="col-sm-3">
						<p class="footer-p-small address"> <?php echo $words["top_txt2"]; ?> </p>
				</div>
			</div>
		</div>
	</div>
			

	<div class="footer-widget">
		
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="single-widget">
						<h2 style="margin-bottom: 5px;" ><?php echo $words["categories"]; ?> </h2>
						<ul style="padding-left: 0;">
							<li><a href="<?php  echo base_url();?>product/browse/?cat_id=2">	<?php echo $words["women"];?>		</a></li>
							<li><a href="<?php  echo base_url();?>product/browse/?cat_id=31">	<?php echo $words["categories"];?>  </a></li>
							<li><a href="<?php  echo base_url();?>product/browse/?cat_id=109">	<?php echo $words["shoes"]; ?> 		</a></li>
							<li><a href="<?php  echo base_url();?>product/browse/?cat_id=3">	<?php echo $words["accessories"]; ?> 	</a></li>
							<li><a href="<?php  echo base_url();?>product/browse/?cat_id=413">	<?php echo $words["beauty"]; ?> 	</a></li>
							<li><a href="<?php  echo base_url();?>product/browse/?cat_id=166">	<?php echo $words["men"]; ?> 		</a></li>
							<li><a href="<?php  echo base_url();?>product/browse/?cat_id=323">	<?php echo $words["kids"]; ?> 		</a></li>
						</ul>
					</div>
				</div>
				
				<div class="col-sm-3 ">
					<div class="single-widget">
						<h2 style="margin-bottom: 5px;" ><?php echo $words["customer_service"]; ?>  </h2>
						<ul style="padding-left: 0;">
							<!--<li><a>FAQ</a></a></li>
							<li><a>Order Status</a></li>
							li><a>terms and conditions</a></li>
							<li><a>Policy</a></li>
							<li><a>payment methods </a></li-->
							<li><a href="<?php  echo base_url();?>about/shipping"><?php echo $words["shipping"]; ?></a></li>
							<li><a href="<?php  echo base_url();?>about/returns"><?php echo $words["returns"]; ?></a></li>
							<!--<li><a>Return information</a></li>-->
							
						</ul>
					</div>
				</div>
		
				<div class="col-sm-2 ">
					<div class="single-widget">
						<h2 style="margin-bottom: 5px;" ><?php echo $words["company"]; ?>   </h2>
						<ul style="padding-left: 0;">
							<li><a href="<?php  echo base_url();?>about">			<?php echo $words["about_us"]; ?>	</a></li>
							<li><a href="<?php  echo base_url();?>about/contact">	<?php echo $words["contact_us"]; ?>	</a></li>
							<li><a href="<?php  echo base_url();?>login">			<?php echo $words["sign_up"]; ?>	</a></li>
							<!--<li><a>Site Map</a></li>-->
						</ul>
					</div>
				</div>
				
				<div class="col-sm-1 " class="vdots" style="positio: absolute;max-height: 250px; overflow-y: hidden;  ">
					<img src="<?php echo $secure_base_url.'assets/templates/eshopper/images/common/vdots.png' ?>" />
				</div>
				
				<div class="col-sm-3 ">
					<div class="single-widget">
						<img width="100%" src='<?php echo $secure_base_url.$words["customer_service_img"] ?>' />
						<div style="overflow-x: hidden;" >	<img src="<?php echo $secure_base_url.'assets/templates/eshopper/images/common/hzdots.png' ?>" />	</div>
						<div>
							<!--input-->
							<div class="col-sm-12 " style="padding: 0; margin-top: 5px;" >
								<div class="col-sm-10 " style="padding: 0;" >
									<input id="clctem_input" style="width:100%; line-height:30px; " type="email" />
									<span id="email_footer_error" style="display: none;"> <?php echo $words["error_email"]; ?>  </span>
									<span id="email_footer_ok" style="display: none;"> <?php echo $words["thank_you"]; ?>  </span>
									<span id="email_footer_ok2" style="display: none;"> <?php echo $words["alredy_registred"]; ?> </span>
								</div>
								<div class="col-sm-2 " id="clctem" style="padding:0;margin:0 ; background-color: #ff0000; color: white;text-align: center; cursor: pointer;" ><span  style=" line-height:36px; text-align: center;" > <i class="fa fa-arrow-circle-o-right"></i> </span>	</div>
							</div>
							<!--/input-->
							<div class="col-sm-12 " style="height: 10px;" > &nbsp;</div>
							<div style="text-align: center; color: #666663;" >
								<?php echo $words["leave_email"]; ?> 										
							</div>
						</div>
						
						<div style="overflow-x: hidden;" >	<img src="<?php echo $secure_base_url.'assets/templates/eshopper/images/common/hzdots.png' ?>" />	</div>
						
						<div style="text-align: center;" > 
							<a href="https://www.facebook.com/shopamerikacom" > <div class="social_media" style=" display: inline-block ; background-position: -42px  -3px;background-size: 155px;width: 35px;height: 43px;" > &nbsp;  </div> </a>
							<span style="width: 5px;" >&nbsp;</span>
							<a href="https://twitter.com/shopamerika" > <div class="social_media" style=" display: inline-block ; background-position: -162px  -3px;background-size: 155px;width: 35px;height: 43px;" > &nbsp  </div> </a>
							<span style="width: 5px;" >&nbsp;</span>
							<a href="https://www.instagram.com/shopamerika" > <div class="social_media" style=" display: inline-block ; background-position: -112px  -3px;background-size: 155px;width: 35px;height: 43px;" > &nbsp  </div> </a>
						</div>
						
					</div>
				</div>
				
			</div>
		</div>
	</div>
			
	<div class="footer-bottom">
		<div class="container">
			<div class="row">
				<p class="pull-left">Copyright © 2017 Shopamerika Inc. All rights reserved.</p>
				<!--<p class="pull-right">Designed by <span><a target="_blank" href="http://koyuncubtm.com/">KoyuncuBTM</a></span></p>-->
			</div>
		</div>
	</div>
		
		</footer><!--/Footer-->