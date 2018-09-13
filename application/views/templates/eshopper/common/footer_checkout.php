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
							<p class="footer-p address">We're Dedicated to Our Customers 24/7</p>
						</div>
						<div class="col-sm-3">
							
								
								<p class="footer-p-small address">Over 2 Million Fashion Products</p>
							
						</div>
					</div>
				</div>
			</div>
			

			<div class="footer-widget">
				
					<div class="container">
					<div class="row">
						<div class="col-sm-3">
							<div class="single-widget">
						<h2>categories</h2>
						<ul>
							<li><a href="<?php  echo base_url();?>product/get_category_decendents_products/2">Women</a></li>
							<li><a href="<?php  echo base_url();?>product/get_category_decendents_products/31">Bags </a></li>
							<li><a href="<?php  echo base_url();?>product/get_category_decendents_products/109">Shoes</a></li>
							<li><a href="<?php  echo base_url();?>product/get_category_decendents_products/65">Jewellery & Accessories</a></li>
							<li><a href="<?php  echo base_url();?>product/get_category_decendents_products/413">Beauty</a></li>
							<li><a href="<?php  echo base_url();?>product/get_category_decendents_products/166">Men</a></li>
							<li><a href="<?php  echo base_url();?>product/get_category_decendents_products/323">Kids</a></li>
						</ul>
						</div>
						</div>
						
						<div class="col-sm-3 ">
							<div class="single-widget">
						<h2>Customer Service </h2>
						<ul>
							<li><a>FAQ</a></a></li>
							<li><a>Order Status</a></li>
							<!--li><a>terms and conditions</a></li>
							<li><a>Policy</a></li>
							<li><a>payment methods </a></li-->
							<li><a>Shipping information</a></li>
							<li><a>Return information</a></li>
							
						</ul>
						</div>
						</div>
				
						<div class="col-sm-3 ">
							<div class="single-widget">
						<h2> </h2>
						<ul>
							<li><a>About Us</a></li>
							<li><a>Contact Us</a></li>
							<li><a>Sign up</a></li>
							<li><a>Site Map</a></li>
							
							
						</ul>
						</div>
						</div>
						
						
						<div class="col-sm-3 ">
							<div class="single-widget">
								<h2>About ShopAmerika</h2>
								<form action="#" class="searchform">
									<input type="text" placeholder="Your email address" />
									<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
									<p>Get the most recent updates from <br />our site and be updated your self...</p>
								</form>
							</div>
						</div>
						
					</div>
				</div>
			</div>
			
			<div class="footer-bottom">
				<div class="container">
					<div class="row">
						<p class="pull-left">Copyright © 2015 Shopamerika Inc. All rights reserved.</p>
						<p class="pull-right">Designed by <span><a target="_blank" href="http://www.trendit.com.tr/">TrendIT</a></span></p>
					</div>
		</div>
			</div>
		
		</footer><!--/Footer-->