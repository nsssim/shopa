<?php 
$CI =& get_instance(); 
$CI->load->module('lng'); 

$ssl_port_num = ":".SSL_PORT;  // :443 is the default
$base_url_str = base_url(); 
$sbu = str_replace("http","https",$base_url_str );
$secure_base_url = str_replace(".com",".com$ssl_port_num",$sbu );

//var_dump($words);
?>
<head>
	<style>
		.clm{
			
			font-size: 10px !important;
			margin:0;
			padding: 0;
			position: inline-block;
		}
		.toplink{
			
			vertical-align: bottom;
		    font-size: 10px !important;
		    font-weight: bold;
		    padding-right: 6px;
		    font-family: Nunito,Helvetica,Verdana,Sans-serif;
    		position: relative;
			
		}
		.cart_icon
		{
			font-size:9px;	
		}
	</style>
</head>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					
					<div class="col-sm-4">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><?php echo $words["top_txt"]; ?></li>
								
							</ul>
						</div>
					</div>
					
					<div class="col-sm-1">
						&nbsp;
					</div>
					
					<div class="col-sm-7" style="margin-top: 4px;margin-bottom: 4px;" >
								<div style="float: right;" >
									<?php $first_name = $CI->session->userdata("first_name") ?>  
									<?php if(!empty($first_name)): ?>  
										<span class="toplink" >WELCOME <?php echo strtoupper($first_name);?> </span> <span class="clm" >|</span>
										<a class="toplink" href= "<?php echo $secure_base_url;?>customer/my_account" >MY ACCOUNT</a><span class="clm" >|</span>
										<a class="toplink" href= "<?php echo base_url();?>login/logout" ><?php echo strtoupper($words["logout"]);?></a><span class="clm" >|</span>
									<?php else: ?>
										<a href= "<?php echo $secure_base_url;?>customer/my_account" ><?php echo strtoupper($words["login"]) ;?> </a><span class="clm" >|</span>
									<?php endif ?>
									
									<a id="cart" <?php if($CI->cart->total_items()!=0){?>href="<?php echo base_url();?>carta/details"<?php  }else { ?>href="#"<?php }?>> 
										<i class="fa fa-shopping-cart cart_icon">  </i> 
										<span class="toplink" ><?php echo strtoupper($words["cart"]);?> </span> 
										
										<span id="cart_num" class="toplink" style= "backround-color: #ffd7d7;"  ></span> 
									</a>
								
								
									<?php $lang_id = $CI->lng->get_n_set_language_id(); ?>
									<a href="#" >
									<?php if($lang_id == 1): ?>
									<img title="Türkçe"  class="country_flag country_flag_active" id="flg_1"  src="<?php echo $secure_base_url.'assets/templates/eshopper/images/flags/tr.jpg';?>" width="25"/>
									<?php else: ?>
									<img title="Türkçe" class="country_flag country_flag_grey" id="flg_1"  src="<?php echo $secure_base_url.'assets/templates/eshopper/images/flags/tr.jpg';?>" width="25"/>
									<?php endif; ?>
									</a>
									
									<a href="#" >
									<?php if($lang_id == 2): ?>
									<img title="English"  class="country_flag country_flag_active" id="flg_2"  src="<?php echo $secure_base_url.'assets/templates/eshopper/images/flags/en.jpg';?>" width="25"/>
									<?php else: ?>
									<img title="English" class="country_flag country_flag_grey" id="flg_2"  src="<?php echo $secure_base_url.'assets/templates/eshopper/images/flags/en.jpg';?>" width="25"/>
									<?php endif; ?>
									</a>
								</div>
								
							
							    <!-- <div id="cart_preview" > 
									<ul>
										<li>hi</li>
									</ul>
					
								</div> -->
							
								
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
					<div class="col-sm-4">&nbsp;</div>
					<div class="col-sm-4">
						<div class="shop-menu pull-right">
							<div class="search_box pull-right">
								<form method="get" style="border: none;" action="<?php echo base_url().'product/browse/';?>">
								<span class="search_slogan" > <?php echo $words['seach_slogan']; ?> </span>
								<input name="term" id="search" class="search-input ui-autocomplete-input" type="text" placeholder="<?php echo $words['search']; ?>"/>
								
								<!--<input class="search_btn" type="submit" value="hello there... click here plz"  
								style="border: 1px solid red;
								background-color: #ffb0b0;
								z-index: 99;
								margin-top: 1px;
								display: block;" />-->
								</form>
							</div>

						</div>
					</div>
				</div>
				<?php include "mega_https.php";?>				
		</div><!--/header-bottom-->
		</div>
	</header><!--/header-->
	<hr class="line"/>
	<section>
		<div class="container">
		<div class="row">
			<div class="col-sm-12 home-text">
				<a class="no_link" href="<?php echo base_url().'login';?>"><h4><?php echo $words["top2_txt"]; ?></h4></a>
			</div>
		</div>
		<div class="black-single-text"><?php echo $words["top3_txt"]; ?></div>
		
		</div>
	</section>	