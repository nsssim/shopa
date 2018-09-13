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
		#cart_icon
		{
			-webkit-animation-duration: 1s;
			 -moz-animation-duration: 1s;
			 -MS-animation-duration: 1s;
			 -o-animation-duration: 1s;
			  
			 -webkit-animation-iteration-count: 3;
			 -moz-animation-iteration-count: 3;
			 -MS-animation-iteration-count: 3;
			 -o-animation-iteration-count: 3;
			 
			  /*-vendor-animation-delay: 2s;
			  -vendor-animation-iteration-count: infinite;*/
		}
		#cart_quickview{
			right: 0;
			border: 1px solid #330A0A;
			position: absolute;
			width: 50%;
			z-index: 99;
			padding: 0px;
			margin: 0px;
			text-align: left;
			background-color: #FFF;
			color: #1D0F0F;
			box-shadow: -2px 4px 4px #888;
			z-index: 999;
		}
		.no_link2{
			color: black;
			text-decoration: underline;
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
										<span class="toplink" ><!--WELCOME--><?php echo $words["welcome"]; ?>  <?php echo strtoupper($first_name);?> </span> <span class="clm" >|</span>
										<a class="toplink" href= "<?php echo $secure_base_url;?>customer/my_account" ><!--MY ACCOUNT--><?php echo $words["my_account"]; ?></a><span class="clm" >|</span>
										<a class="toplink" href= "<?php echo base_url();?>login/logout" ><?php echo strtoupper($words["logout"]);?></a><span class="clm" >|</span>
									<?php else: ?>
										<a href= "<?php echo $secure_base_url;?>customer/my_account" ><?php echo strtoupper($words["login"]) ;?> </a><span class="clm" >|</span>
									<?php endif ?>
									
									<a id="cart" <?php if($CI->cart->total_items()!=0){?>href="<?php echo base_url();?>carta/details"<?php  }else { ?>href="#"<?php }?>> 
										<!--<i class="fa fa-shopping-cart cart_icon">  </i> -->
										<img id="cart_icon"  height="15px" src='<?php echo base_url()."assets/templates/eshopper/images/common/shopping cart.png" ?>'   style=" " />
										<span class="toplink" ><?php echo strtoupper($words["cart"]);?> </span> 
										
										<span id="cart_num" class="toplink" style= "backround-color: #ffd7d7;"  ></span> 
									</a>
									<img height="15p" src="http://icons.veryicon.com/256/Object/Shop%20Cart/shop%20cart%20apply.png"  id="cart_hint"  style="display: none;  margin: 0px 5px 0px -5px;" />
									
									
									<!--cart quick view-->									
									<div id="cart_quickview" style="display: none;"  > 
										<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~cart not empty ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
										<?php if($this->cart->total_items() > 0) : ?>
										<!--cart quick view not empty-->									
										<div class="col-sm-12">
											
											<div class="container-fluid">
												<div class="row"> &nbsp;  </div>
												
												<div class="row">
													<div class="col-md-9">
														<a id="cart_empty_msg" style="text-decoration: underline; font-size: 12px;font-weight: bold;color:black;" href="<?php echo base_url().'carta/details' ?>" > 	<?php echo $words['my_cart']; ?>: <?php echo $this->cart->total_items();  ?> <?php echo $words['item']; ?> </a><br>
													</div>
													<div class="col-md-1 ">
														<a id="xclose" style="cursor: pointer;" ><img src="<?php echo base_url().'assets/templates/eshopper/images/common/xclose.jpg' ?>" /></a>
													</div>
												</div>
												
												<div class="row"> &nbsp;  </div>
												
												
												<div class="row">
													<div class="col-md-12" style="font-size: 13px; text-align: justify;" >
														<?php echo $words['notice']; ?>
													</div>
												</div>
												
												<hr>
												
												<div class="row"> &nbsp;  </div>
												
												<!--list of items-->
												<div id="list_of_items" class="col-md-12" style=" max-height:250px; overflow-y : auto;  ">
													<?php $nrows = sizeof($this->cart->contents()); $n = 0;  ?>
													<?php foreach ($this->cart->contents() as $item) : $n++; ?>
														<!--item-->
														<div class="row"  id="qv_<?php echo($item['rowid']); ?>" >
															<div class="col-md-4">
																<!--thumbnail-->
																	<?php if(!empty($item['cat_id'])) : ?>
																		<a style=" vertical-align:middle; " href="<?php echo(base_url().'product/cart-details-item-'.$item['id'] .'-cat_id-'. $item['cat_id'].'.html') ?>"><img width="100%" src="<?php 	echo($item['thumbnail'])  ?>" alt=""></a>
																	<?php else : ?>
																		<a style=" vertical-align:middle; " href="<?php echo(base_url().'product/cart-details-item-'.$item['id'].'.html') ?>"><img width="100%" src="<?php 	echo($item['thumbnail'])  ?>" alt=""></a>
																	<?php endif; ?>
																<!--/thumbnail-->
															
															</div>
															
															<div class="col-md-8">
															<!--color if any-->
															<?php if($item['color_name']!=""){?><span style="font-size: 10px" > <?php echo $words['color']; ?>: <?php echo($item['color_name']) ;?> </span><br> <?php }?>
															<!--size if any -->
															<?php if($item['size_name']!=""){?><span style="font-size: 10px" >  <?php echo $words['size']; ?>: <?php 	echo($item['size_name']) ; ?> </span><br> <?php }?>
															<!--qty-->
															<span style="font-size: 10px" ><?php echo $words['qty']; ?>:<?php echo $item['qty']; ?> </span><br>
															<!--price-->
															<span style="font-size: 10px" ><?php echo $words['price']; ?>:</span><span style="font-size: 10px" ><?php echo($currency);?><?php   echo(number_format($item['price'], 2, '.', ','))  ?></span><br>
															<!--details and remove -->
															<?php if(!empty($item['cat_id'])) : ?>
																<a href="<?php echo(base_url().'product/cart-details-item-'.$item['id'] .'-cat_id-'. $item['cat_id'].'.html') ?>"><span class="no_link2" style="font-size: 12px" ><?php echo $words['details']; ?></span></a>
															<?php else : ?>
																<a href="<?php echo(base_url().'product/cart-details-item-'.$item['id'].'.html') ?>"><span class="no_link2" style="font-size: 12px" ><?php echo $words['details']; ?></span></a>
															<?php endif; ?>
															
															<span>&nbsp;</span>
															<a id='qvrmv_<?php echo $item["rowid"]; ?>' class="qrmv" href="#"><span class="no_link2" style="font-size: 12px" ><?php echo $words['remove']; ?></span></a>
															</div>
															
															<hr>
														</div>
														<!--/item-->
														<?php if(($n < $nrows) && ($nrows > 1)  ): ?>
														<!--spacer and border-->
														<div id='ftr_<?php echo $item["rowid"]; ?>' style="padding: 0; margin:0;  ">
															<div class="row"> &nbsp;  </div>
															<div class="col-md-12" style="border-bottom: 1px dotted black;">  </div>
															<div class="row"> &nbsp;  </div>
														</div>
														<!--/spacer and border-->
														<?php endif; ?>
													<?php endforeach; ?>
													
													
													
												</div> <!--/list of items-->
												<div class="col-md-12">
													<hr>
													<div class="row"> &nbsp;  </div>
												</div>
													
												
											</div>
											
											<div id="my_car_details"  >
												<a style="text-decoration: underline; font-size: 12px;font-weight: bold;color:black;" href="<?php echo base_url().'carta/details' ?>" > 	<?php echo $words['my_cart']; ?>: <?php echo $this->cart->total_items();  ?> <?php echo $words['item']; ?> </a><br>
												<span style="font-size: 13px" > <?php echo $words['subtotal'] ?>:</span> <span style="font-size: 13px" ><?php echo($currency);?><?php   echo(number_format($this->cart->total(), 2, '.', ','))  ?></span> <br>
											</div>
											
											<div class="col-sm-12 button-checkout">
												<div class="row">
													<a href="<?php echo base_url().'carta/details' ; ?>" class="btn btn-primary"><?php echo $words['checkout'] ?></a>
												</div>
											</div>
											
											
											
											<div class="col-sm-12"> &nbsp;	</div>
										</div>	

										<!--/cart quick view -->




										<?php else : ?>
										<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~cart empty ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
										<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~cart empty ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
										<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~cart empty ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
										<!--cart quick view -->									
										<div class="col-sm-12">
											
											<div class="container-fluid">
												<div class="row"> &nbsp;  </div>
												
												<div class="row">
													<div class="col-md-9">
														<?php echo $words['cart_is_empty'] ?> <br>
													</div>
													<div class="col-md-1 ">
														<a id="xclose" style="cursor: pointer;" ><img src="<?php echo base_url().'assets/templates/eshopper/images/common/xclose.jpg' ?>" /></a>
													</div>
												</div>
												
												<div class="row"> &nbsp;  </div>
												
											</div>

										</div>	
											
										<!--/cart quick view -->
										<?php endif; ?>
																				
									</div> 
									<!--/cart quick view -->
										
										
								
									
									
								
									<?php $lang_id = $CI->lng->get_n_set_language_id(); ?>
									<a href="#" >
									<?php if($lang_id == 1): ?>
									<img title="Türkçe"  class="country_flag country_flag_active" id="flg_1"  src="<?php echo base_url().'assets/templates/eshopper/images/flags/tr.jpg';?>" width="25"/>
									<?php else: ?>
									<img title="Türkçe" class="country_flag country_flag_grey" id="flg_1"  src="<?php echo base_url().'assets/templates/eshopper/images/flags/tr.jpg';?>" width="25"/>
									<?php endif; ?>
									</a>
									
									<a href="#" >
									<?php if($lang_id == 2): ?>
									<img title="English"  class="country_flag country_flag_active" id="flg_2"  src="<?php echo base_url().'assets/templates/eshopper/images/flags/en.jpg';?>" width="25"/>
									<?php else: ?>
									<img title="English" class="country_flag country_flag_grey" id="flg_2"  src="<?php echo base_url().'assets/templates/eshopper/images/flags/en.jpg';?>" width="25"/>
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
								<img src="<?php echo base_url().'assets/templates/eshopper/images/home/logo.png';?>" alt="" /></a>
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
				<?php include "mega.php";?>				
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