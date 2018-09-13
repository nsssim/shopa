
<?php $CI =& get_instance(); ?>
<?php 
$ssl_port_num = ":".SSL_PORT;  // :443 is the default
$base_url_str = base_url(); 
$secure_base_url = str_replace("http","https",$base_url_str );
$secure_base_url = str_replace(".com",".com$ssl_port_num",$secure_base_url );
?>

	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><?php echo $CI->lang->line('wrd_top_slogan'); ?></li>
								
							</ul>
						</div>
					</div>
					<div class="col-sm-8">
						<div class=" pull-right">
							<ul class="btn-group navbar-nav top-bar">
							<li>
							<?php $fn = $CI->session->userdata("first_name") ?>  
							<?php if(!empty($fn)): ?>  
								<a href= "<?php echo base_url();?>customer/myaccount" > <?php echo($fn);?> </a>
								<a href= "<?php echo base_url();?>login/logout" > logout </a>
							<?php else: ?>
								<a href= "<?php echo base_url();?>login" > Login </a>
							<?php endif ?>
							
							</li>
							<li>
								<a id="cart" <?php if($this->cart->total_items()!=0){?>href="<?php echo base_url();?>carta/details"<?php  }else { ?>href="#"<?php }?>> 
									<i class="fa fa-shopping-cart">  </i> 
									Cart
									 <span id="cart_num" style= "backround-color: #ffd7d7;"  ></span> 
									   </a>
									  <!-- <div id="cart_preview" > 
								<ul>
									<li>hi</li>
								</ul>
				
								</div> -->
							</li>
								<!--
								<li data-toggle="dropdown">
									<a href="#" >
									<img class="country_flag" id="2"  src="<?php echo $secure_base_url.'assets/templates/eshopper/images/flags/en.jpg';?>" width="25"/>
									</a>
									<ul class="dropdown-menu">
										<li><a href="#">USD</a></li>
										<li><a href="#">TRY</a></li>
									</ul>
								</li>
								
								<li  data-toggle="dropdown"><a href="#"> USD</a></li>
								<ul class="dropdown-menu">
									<li><a href="#">USD</a></li>
									<li><a href="#">TRY</a></li>
								</ul>
								-->
								
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
		
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="<?php echo base_url().'home/';?>">
								<img src="<?php echo $secure_base_url.'assets/templates/eshopper/images/home/logo.png';?>" alt="" /></a>
						</div>
						
					</div>
					
					<!--<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<div class="search_box pull-right">
								<input name="q" id="search" class="search-input ui-autocomplete-input" type="text" placeholder="Search"/>
							</div>
						</div>
					</div>-->
					
				</div>
				<!--<?php include "mega_checkout.php";?>-->				
		</div><!--/header-bottom-->
		</div>
		</div>
	</header><!--/header-->
	<hr class="line"/>
	<section>
		<div class="container">
		<div class="row">
			<div class="col-sm-12 home-text">
				<h4><?php echo $CI->lang->line('wrd_middle_slogan'); ?></h4><hr/>
			</div>
		</div>
		</div>
	</section>	