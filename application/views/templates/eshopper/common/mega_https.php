<?php
// load categories
$CI =& get_instance();

$CI->load->module("categories");
//$data["categories"] = $this->categories->get_categories_list();
$categories = $this->categories->get_categories_list();
/*echo "<pre>";
var_dump($categories);
echo "</pre>";*/
$oo=55;
//echo "<pre>";
//	print_r($data['categories']['women_bags_cat']);
//echo("</pre>");
?>

<?php 
$ssl_port_num = ":".SSL_PORT;  // :443 is the default
$base_url_str = base_url(); 
$secure_base_url = str_replace("http","https",$base_url_str );
$secure_base_url = str_replace(".com",".com$ssl_port_num",$secure_base_url );
?>

<nav class="navbar navbar-default">
    <div class="navbar-header">
		<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		
	</div>
	
	
	<div class="collapse navbar-collapse js-navbar-collapse">
		<ul class="nav navbar-nav" style="width: 1024px;">
			<li class="dropdown mega-dropdown"> <!--BRANDS-->
			<a href="<?php  echo base_url();?>brands/brands_list" class="dropdown-toggle"><?php echo $words["brands"];?> <span class="glyphicon glyphicon-chevron-down pull-right"></span></a>
				
				<ul class="dropdown-menu mega-dropdown-menu">
							<div class="row">
								<div class="col-sm-12">
									<img src="<?php echo $secure_base_url.'assets/templates/eshopper/banner/women/06.jpg';?>"/>
								</div>
							</div>
							<div class="row"> 
								<div class="col-sm-6">
									<h5><?php echo $words["brands"];?> </h5>
									<ul>
										<?php 
	                        			$alphas = range('A', 'Z');
	                        			foreach($alphas as $key=>$value):
	                      				?>
	                      				<a href="<?php  echo base_url();?>brands/brands_list#<?php echo ($value);?>">
										<?php echo ($value);?></a>
										<?php endforeach; ?>
	                      				<a href="<?php  echo base_url();?>brands/brands_list#pound">#</a>
									</ul>
								</div>
								
								<div class="col-sm-6">
									
									<div style="margin-top: 5px;" >
									<span>More than 9000 Brands</span>
									<img src="<?php echo $secure_base_url.'assets/templates/eshopper/images/brands/brands.png';?>" />
									</div>
									<!--<ul>
										<li>New Arrivals <font size="2px" color="red">soon</font></li>
										<li>New Brands <font size="2px" color="red">soon</font></li>
									</ul>
									<hr/>
									<h5>BRANDS ON SALE <font size="2px" color="red">soon</font></h5>
									<ul>
										<li><?php echo $words["see_all"];?></li>
									</ul>
									<hr/>
									<h5>FEATURED BRANDS ITEMS <font size="2px" color="red">soon</font></h5>
									<ul>
										<li><?php echo $words["see_all"];?></li>
									</ul>
									<hr/>-->
								</div>
								
							</div>
				</ul>
			</li>
					
			<li class="dropdown mega-dropdown"> <!--WOMEN-->
			<a href="<?php  echo base_url();?>product/browse/?cat_id=2" class="dropdown-toggle">
				<?php echo $words["women"];?> <span class="glyphicon glyphicon-chevron-down pull-right"></span>
			</a>
				
				<ul class="dropdown-menu mega-dropdown-menu">
							<div class="row">
								<div class="col-sm-12">
									<img src="<?php echo $secure_base_url.'assets/templates/eshopper/banner/women/04.jpg';?>"/>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<h5><?php echo $words["clothing"];?></h5>
									<ul>
										<?php foreach ($categories['women_cat'] as $cat) :	?>
										<li><a href="<?php  echo base_url();?>product/browse/?cat_id=<?php echo $cat->main_id;?>">
												<?php echo $cat->name;?> 
											</a>
										</li>
										<?php endforeach; ?>
									</ul>
								</div>
								<div class="col-sm-6">
									<!--<h5>WHAT'S NEW </h5>
									<ul>
										<li><a href=" <?php echo base_url();?>product/browse/?cat_id=2&s=101&s=100 "> New Arrivals </a> </li> 
									</ul>
									<hr/>-->
									<h5><?php echo $words["sale"];?> </h5>
									<ul>
										<li><a href=" <?php echo base_url();?>product/browse/?cat_id=2&s=0 "> <?php echo $words["see_all"];?> </a> </li> 
										<li><a href=" <?php echo base_url();?>product/browse/?cat_id=2&s=0&s=100 "> <?php echo $words["today"];?> </a> </li> 
										<li><a href=" <?php echo base_url();?>product/browse/?cat_id=2&s=0&s=101 "> <?php echo $words["this_week"];?> </a> </li> 
									</ul>
									<!--<hr/>-->
									<!--<h5>FEATURED ITEMS <font size="2px" color="red">soon</font></h5>
									<ul>
										<li><?php echo $words["see_all"];?></li>
									</ul>
									<hr/>-->
								</div>
							</div>
				</ul>
			</li>
			
			<li class="dropdown mega-dropdown"> <!--BAGS-->
			<a href="<?php  echo base_url();?>product/browse/?cat_id=31" class="dropdown-toggle"><?php echo $words["bags"];?> <span class="glyphicon glyphicon-chevron-down pull-right"></span></a>
				
				<ul class="dropdown-menu mega-dropdown-menu">
							<div class="row">
								<div class="col-sm-12">
									<img src="<?php echo $secure_base_url.'assets/templates/eshopper/banner/bags/03.jpg';?>"/>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<h5><?php echo $words["women"];?></h5>
									<ul>
										<?php foreach ($categories['women_bags_cat'] as $cat) :	?>
											<li><a href="<?php  echo base_url();?>product/browse/?cat_id=<?php echo $cat->main_id;?>"><?php echo $cat->name;?> </a></li>
										<?php endforeach; ?>
									</ul>
									<h5><?php echo $words["men"];?></h5>
									<ul>
										<?php foreach ($categories['men_bags_cat'] as $cat) :?>
											<li><a href="<?php  echo base_url();?>product/browse/?cat_id=<?php echo $cat->main_id;?>"><?php echo $cat->name;?> </a></li>
										<?php endforeach; ?>
									</ul>
								</div>
								<div class="col-sm-6">
									<!--<h5>WHAT'S NEW </h5>
									<ul>
										<li><a href=" <?php echo base_url();?>product/browse/?cat_id=31&s=101&s=100 "> New Arrivals </a> </li> 
									</ul>
									<hr/>-->
									<!--<h5><?php echo $words["sale"];?></h5>-->
									<h5><?php echo "SALE WOMAN";?></h5>
										<ul>
											<li><a href=" <?php echo base_url();?>product/browse/?cat_id=31&s=0 "> <?php echo $words["see_all"];?> </a> </li> 
											<li><a href=" <?php echo base_url();?>product/browse/?cat_id=31&s=0&s=100 "> <?php echo $words["today"];?> </a> </li> 
											<li><a href=" <?php echo base_url();?>product/browse/?cat_id=31&s=0&s=101 "> <?php echo $words["this_week"];?> </a> </li> 
										</ul>
									<h5><?php echo "SALE MEN";?></h5>
										<ul>
											<li><a href=" <?php echo base_url();?>product/browse/?cat_id=168&s=0 "> <?php echo $words["see_all"];?> </a> </li> 
											<li><a href=" <?php echo base_url();?>product/browse/?cat_id=168&s=0&s=100 "> <?php echo $words["today"];?> </a> </li> 
											<li><a href=" <?php echo base_url();?>product/browse/?cat_id=168&s=0&s=101 "> <?php echo $words["this_week"];?> </a> </li> 
										</ul>
									
									<!--<hr/>-->
									<!--<h5>FEATURED ITEMS <font size="2px" color="red">soon</font></h5>
									<ul>
										<li><?php echo $words["see_all"];?></li>
									</ul>
									<hr/>-->
								</div>
							</div>
				</ul>
			</li>
			
			<li class="dropdown mega-dropdown"> <!--SHOES-->
			<a href="<?php  echo base_url();?>product/browse/?cat_id=109" class="dropdown-toggle"><?php echo $words["shoes"];?> <span class="glyphicon glyphicon-chevron-down pull-right"></span></a>
				
				<ul class="dropdown-menu mega-dropdown-menu">
							<div class="row">
								<div class="col-sm-12">
									<img src="<?php echo $secure_base_url.'assets/templates/eshopper/banner/shoes/01.jpg';?>"/>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<h5><?php echo $words["women"];?></h5>
									<ul>
										<?php 
					foreach ($categories['women_shoes_cat'] as $cat) :
					?>
		<li><a href="<?php  echo base_url();?>product/browse/?cat_id=<?php echo $cat->main_id;?>"><?php echo $cat->name;?> </a></li>
													<?php endforeach; ?>
									</ul>
									<h5><?php echo $words["men"];?></h5>
									<ul>
										<?php 
					foreach ($categories['men_shoes_cat'] as $cat) :
					?>
		<li><a href="<?php  echo base_url();?>product/browse/?cat_id=<?php echo $cat->main_id;?>"><?php echo $cat->name;?> </a></li>
													<?php endforeach; ?>
									</ul>
								</div>
								<div class="col-sm-6">
									<!--<h5>WHAT'S NEW </h5>
									<ul>
										<li><a href=" <?php echo base_url();?>product/browse/?cat_id=109&s=101&s=100 "> New Arrivals </a> </li> 
										
									</ul>
									<hr/>-->
									<h5><?php echo $words["sale"];?> </h5>
									<ul>
										<!--<li><a href=" <?php echo base_url();?>product/browse/?cat_id=109&s=0 "> <?php echo $words["see_all"];?> </a> </li> 
										<li><a href=" <?php echo base_url();?>product/browse/?cat_id=109&s=0&s=100 "> <?php echo $words["today"];?> </a> </li> 
										<li><a href=" <?php echo base_url();?>product/browse/?cat_id=109&s=0&s=101 "> <?php echo $words["this_week"];?> </a> </li> -->
										
										<!--men + women sale-->
										
									<!--<h5><?php echo $words["fsdfs"];?> </h5>
										<li><a href=" <?php echo base_url();?>product/browse/?cat_id=219&s=0&s=101 "> Men </a> </li> 
										<li><a href=" <?php echo base_url();?>product/browse/?cat_id=109&s=0&s=101 "> Women </a> </li> -->
									
									<h5><?php echo "SALE WOMAN";?></h5>
										<ul>
											<li><a href=" <?php echo base_url();?>product/browse/?cat_id=109&s=0 "> <?php echo $words["see_all"];?> </a> </li> 
											<li><a href=" <?php echo base_url();?>product/browse/?cat_id=109&s=0&s=100 "> <?php echo $words["today"];?> </a> </li> 
											<li><a href=" <?php echo base_url();?>product/browse/?cat_id=109&s=0&s=101 "> <?php echo $words["this_week"];?> </a> </li> 
										</ul>
									<h5><?php echo "SALE MEN";?></h5>
										<ul>
											<li><a href=" <?php echo base_url();?>product/browse/?cat_id=219&s=0 "> <?php echo $words["see_all"];?> </a> </li> 
											<li><a href=" <?php echo base_url();?>product/browse/?cat_id=219&s=0&s=100 "> <?php echo $words["today"];?> </a> </li> 
											<li><a href=" <?php echo base_url();?>product/browse/?cat_id=219&s=0&s=101 "> <?php echo $words["this_week"];?> </a> </li> 
										</ul>
										
									</ul>
									<!--<hr/>-->
									<!--<h5>FEATURED ITEMS <font size="2px" color="red">soon</font></h5>
									<ul>
										<li><?php echo $words["see_all"];?></li>
									</ul>
									<hr/>-->
								</div>
							</div>
				</ul>
			</li>
			
		<li class="dropdown mega-dropdown"> <!--ACCESSORIES-->
			<a href="<?php  echo base_url();?>product/browse/?cat_id=3" class="dropdown-toggle"><?php echo $words["accessories"];?> <span class="glyphicon glyphicon-chevron-down pull-right"></span></a>
				
				<ul class="dropdown-menu mega-dropdown-menu">
							<div class="row">
								<div class="col-sm-12">
									<img src="<?php echo $secure_base_url.'assets/templates/eshopper/banner/jewelery/03.jpg';?>"/>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<h5><?php echo $words["women"];?></h5>
									<ul>
										<?php 
					foreach ($categories['women_accessories_cat'] as $cat) :
					?>
		<li><a href="<?php  echo base_url();?>product/browse/?cat_id=<?php echo $cat->main_id;?>"><?php echo $cat->name;?> </a></li>
													<?php endforeach; ?>
									</ul>
									<h5><?php echo $words["men"];?></h5>
									<ul>
										<?php 
					foreach ($categories['men_accessories_cat'] as $cat) :
					?>
		<li><a href="<?php  echo base_url();?>product/browse/?cat_id=<?php echo $cat->main_id;?>"><?php echo $cat->name;?> </a></li>
													<?php endforeach; ?>
									</ul>
								</div>
								<div class="col-sm-6">
									<!--<h5>WHAT'S NEW </h5>
									<ul>
										<li><a href=" <?php echo base_url();?>product/browse/?cat_id=3&s=101&s=100 "> New Arrivals </a> </li> 
										
									</ul>
									<hr/>-->
									<!--<h5><?php echo $words["sale"];?></h5>
									<ul>
										<li><a href=" <?php echo base_url();?>product/browse/?cat_id=3&s=0 "> <?php echo $words["see_all"];?> </a> </li> 
										<li><a href=" <?php echo base_url();?>product/browse/?cat_id=3&s=0&s=100 "> <?php echo $words["today"];?> </a> </li> 
										<li><a href=" <?php echo base_url();?>product/browse/?cat_id=3&s=0&s=101 "> <?php echo $words["this_week"];?> </a> </li> 
									</ul>-->
									
									<h5><?php echo "SALE WOMAN";?></h5>
										<ul>
											<li><a href=" <?php echo base_url();?>product/browse/?cat_id=3&s=0 "> <?php echo $words["see_all"];?> </a> </li> 
											<li><a href=" <?php echo base_url();?>product/browse/?cat_id=3&s=0&s=100 "> <?php echo $words["today"];?> </a> </li> 
											<li><a href=" <?php echo base_url();?>product/browse/?cat_id=3&s=0&s=101 "> <?php echo $words["this_week"];?> </a> </li> 
										</ul>
									<h5><?php echo "SALE MEN";?></h5>
										<ul>
											<li><a href=" <?php echo base_url();?>product/browse/?cat_id=167&s=0 "> <?php echo $words["see_all"];?> </a> </li> 
											<li><a href=" <?php echo base_url();?>product/browse/?cat_id=167&s=0&s=100 "> <?php echo $words["today"];?> </a> </li> 
											<li><a href=" <?php echo base_url();?>product/browse/?cat_id=167&s=0&s=101 "> <?php echo $words["this_week"];?> </a> </li> 
										</ul>
									
									<!--<hr/>-->
									<!--<h5>FEATURED ITEMS <font size="2px" color="red">soon</font></h5>
									<ul>
										<li><?php echo $words["see_all"];?></li>
									</ul>
									<hr/>-->
								</div>
							</div>
				</ul>
			</li>
			
		<li class="dropdown mega-dropdown"> <!--BEAUTY-->
			<a href="<?php  echo base_url();?>product/browse/?cat_id=413" class="dropdown-toggle"><?php echo $words["beauty"];?> <span class="glyphicon glyphicon-chevron-down pull-right"></span></a>
				
				<ul class="dropdown-menu mega-dropdown-menu">
							<div class="row">
								<div class="col-sm-12">
									<img src="<?php echo $secure_base_url.'assets/templates/eshopper/banner/women/11.jpg';?>"/>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<h5><?php echo $words["women"];?></h5>
									<ul>
										<?php 
					foreach ($categories['women_beauty_cat'] as $cat) :
					?>
		<li><a href="<?php  echo base_url();?>product/browse/?cat_id=<?php echo $cat->main_id;?>"><?php echo $cat->name;?> </a></li>
													<?php endforeach; ?>
									</ul>
									<h5><?php echo $words["men"];?></h5>
									<ul>
										<?php 
					foreach ($categories['men_grooming_cat'] as $cat) :
					?>
		<li><a href="<?php  echo base_url();?>product/browse/?cat_id=<?php echo $cat->main_id;?>"><?php echo $cat->name;?> </a></li>
													<?php endforeach; ?>
									</ul>
								</div>
								<div class="col-sm-6">
									<!--<h5>WHAT'S NEW </h5>
									<ul>
										<li><a href=" <?php echo base_url();?>product/browse/?cat_id=413&s=101&s=100 "> New Arrivals </a> </li> 
									</ul>
									<hr/>-->
									<!--<h5><?php echo $words["sale"];?> </h5>
									<ul>
										<li><a href=" <?php echo base_url();?>product/browse/?cat_id=413&s=0 "> <?php echo $words["see_all"];?> </a> </li> 
										<li><a href=" <?php echo base_url();?>product/browse/?cat_id=413&s=0&s=100 "> <?php echo $words["today"];?> </a> </li> 
										<li><a href=" <?php echo base_url();?>product/browse/?cat_id=413&s=0&s=101 "> <?php echo $words["this_week"];?> </a> </li> 
									</ul>-->
									
									<h5><?php echo $words["sale_women"];?> </h5>
										<ul>
											<li><a href=" <?php echo base_url();?>product/browse/?cat_id=413&s=0 "> <?php echo $words["see_all"];?> </a> </li> 
											<li><a href=" <?php echo base_url();?>product/browse/?cat_id=413&s=0&s=100 "> <?php echo $words["today"];?> </a> </li> 
											<li><a href=" <?php echo base_url();?>product/browse/?cat_id=413&s=0&s=101 "> <?php echo $words["this_week"];?> </a> </li> 
										</ul>
										
									<h5><?php echo $words["sale_men"];?> </h5>
										<ul>
											<li><a href=" <?php echo base_url();?>product/browse/?cat_id=172&s=0 "> <?php echo $words["see_all"];?> </a> </li> 
											<li><a href=" <?php echo base_url();?>product/browse/?cat_id=172&s=0&s=100 "> <?php echo $words["today"];?> </a> </li> 
											<li><a href=" <?php echo base_url();?>product/browse/?cat_id=172&s=0&s=101 "> <?php echo $words["this_week"];?> </a> </li> 
										</ul>
									
									<!--<hr/>-->
									<!--<h5>FEATURED ITEMS <font size="2px" color="red">soon</font></h5>
									<ul>
										<li><?php echo $words["see_all"];?></li>
									</ul>
									<hr/>-->
								</div>
							</div>
				</ul>
			</li>
			
			<li class="dropdown mega-dropdown"> <!--MEN-->
			<a href="<?php  echo base_url();?>product/browse/?cat_id=166" class="dropdown-toggle"><?php echo $words["men"];?> <span class="glyphicon glyphicon-chevron-down pull-right"></span></a>
				
				<ul class="dropdown-menu mega-dropdown-menu">
							<div class="row">
								<div class="col-sm-12">
									<img src="<?php echo $secure_base_url.'assets/templates/eshopper/banner/men/01.jpg';?>"/>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<h5><?php echo $words["clothing"];?></h5>
									<ul>
										<?php 
					foreach ($categories['men_cat'] as $cat) :
					?>
		<li><a href="<?php  echo base_url();?>product/browse/?cat_id=<?php echo $cat->main_id;?>"><?php echo $cat->name;?> </a></li>
													<?php endforeach; ?>
									</ul>
								</div>
								<div class="col-sm-6">
									<!--<h5>WHAT'S NEW </h5>
									<ul>
										<li><a href=" <?php echo base_url();?>product/browse/?cat_id=166&s=101&s=100 "> New Arrivals </a> </li> 
										
									</ul>
									<hr/>-->
									<h5><?php echo $words["sale"];?></h5>
									<ul>
										<li><a href=" <?php echo base_url();?>product/browse/?cat_id=166&s=0 "> <?php echo $words["see_all"];?> </a> </li> 
										<li><a href=" <?php echo base_url();?>product/browse/?cat_id=166&s=0&s=100 "> <?php echo $words["today"];?> </a> </li> 
										<li><a href=" <?php echo base_url();?>product/browse/?cat_id=166&s=0&s=101 "> <?php echo $words["this_week"];?> </a> </li> 
									</ul>
									<!--<hr/>-->
									<!--<h5>FEATURED ITEMS <font size="2px" color="red">soon</font></h5>
									<ul>
										<li><?php echo $words["see_all"];?></li>
									</ul>
									<hr/>-->
								</div>
							</div>
				</ul>
			</li>
			
			<li class="dropdown mega-dropdown"> <!--KIDS-->
			<a href="<?php  echo base_url();?>product/browse/?cat_id=323" class="dropdown-toggle"><?php echo $words["kids"];?> <span class="glyphicon glyphicon-chevron-down pull-right"></span></a>
				
				<ul class="dropdown-menu mega-dropdown-menu">
							<div class="row">
								<div class="col-sm-12">
									<img src="<?php echo $secure_base_url.'assets/templates/eshopper/banner/kids/02.jpg';?>"/>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<h5><?php echo $words["kids"];?></h5>
									<ul>
										<?php 
					foreach ($categories['kids_cat'] as $cat) :
					?>
		<li><a href="<?php  echo base_url();?>product/browse/?cat_id=<?php echo $cat->main_id;?>"><?php echo $cat->name;?> </a></li>
													<?php endforeach; ?>
									</ul>
								</div>
								<div class="col-sm-6">
									<!--<h5>WHAT'S NEW </h5>
									<ul>
										<li><a href=" <?php echo base_url();?>product/browse/?cat_id=323&s=101&s=100 "> New Arrivals </a> </li> 
									</ul>
									<hr/>-->
									<h5><?php echo $words["sale"];?> </h5>
									<ul>
										<li><a href=" <?php echo base_url();?>product/browse/?cat_id=323&s=0 "> <?php echo $words["see_all"];?> </a> </li> 
										<li><a href=" <?php echo base_url();?>product/browse/?cat_id=323&s=0&s=100 "> <?php echo $words["today"];?> </a> </li> 
										<li><a href=" <?php echo base_url();?>product/browse/?cat_id=323&s=0&s=101 "> <?php echo $words["this_week"];?> </a> </li> 
									</ul>
									<!--<hr/>-->
									<!--<h5>FEATURED ITEMS <font size="2px" color="red">soon</font></h5>
									<ul>
										<li><?php echo $words["see_all"];?></li>
									</ul>
									<hr/>-->
								</div>
							</div>
				</ul>
			</li>
			
			<li class="dropdown mega-dropdown"> <!--Home-->
			<a href="<?php  echo base_url();?>product/browse/?cat_id=806" class="dropdown-toggle"><?php echo $words["home"];?> <span class="glyphicon glyphicon-chevron-down pull-right"></span></a>
				
				<ul class="dropdown-menu mega-dropdown-menu" >
							<div class="row">
								<div class="col-sm-12">
									<img src="<?php echo $secure_base_url.'assets/templates/eshopper/banner/home/04.jpg';?>"/>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<h5><?php echo $words["home"];?></h5>
									<ul>
										<?php foreach ($categories['home_cat'] as $cat) : ?>
											<li><a href="<?php  echo base_url();?>product/browse/?cat_id=<?php echo $cat->main_id;?>"><?php echo $cat->name;?> </a></li>
										<?php endforeach; ?>
									</ul>
								</div>
								<div class="col-sm-6">
									<h5><?php echo $words["sale"];?> </h5>
									<ul>
										<li><a href=" <?php echo base_url();?>product/browse/?cat_id=806&s=0 "> <?php echo $words["see_all"];?> </a> </li> 
										<li><a href=" <?php echo base_url();?>product/browse/?cat_id=806&s=0&s=100 "> <?php echo $words["today"];?> </a> </li> 
										<li><a href=" <?php echo base_url();?>product/browse/?cat_id=806&s=0&s=101 "> <?php echo $words["this_week"];?> </a> </li> 
									</ul>
									<!--<hr/>-->
									<!--<h5>FEATURED ITEMS <font size="2px" color="red">soon</font></h5>
									<ul>
										<li><?php echo $words["see_all"];?></li>
									</ul>
									<hr/>-->
								</div>
							</div>
				</ul>
			</li>

			<li class="dropdown mega-dropdown"> <!--SALE-->
			<a href="<?php  echo base_url();?>product/browse/?cat_id=2&s=0" class="dropdown-toggle pull-right"><?php echo $words["sale"];?> <span class="glyphicon glyphicon-chevron-down "></span></a>
				
				<ul class="dropdown-menu mega-dropdown-menu">
							<div class="row">
								<div class="col-sm-12">
									<img src="<?php echo $secure_base_url.'assets/templates/eshopper/banner/women/09.jpg';?>"/>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<h5><?php echo $words["sale"];?> </h5>
									<ul>
										
										<li><a href="<?php  echo base_url();?>product/browse/?cat_id=2&s=0"><?php echo $words["women"];?> </a></li>
										<li><a href="<?php  echo base_url();?>product/browse/?cat_id=31&s=0"><?php echo $words["bags"];?> </a></li>
										<li><a href="<?php  echo base_url();?>product/browse/?cat_id=109&s=0"><?php echo $words["shoes"];?> </a></li>
										<li><a href="<?php  echo base_url();?>product/browse/?cat_id=3&s=0"><?php echo $words["accessories"];?> </a></li>
										<!--<li><a href="<?php  echo base_url();?>product/browse/?cat_id=3"><?php echo $words["accessorie"];?> </a></li>-->
										<li><a href="<?php  echo base_url();?>product/browse/?cat_id=413&s=0"><?php echo $words["beauty"];?> </a></li>
										<li><a href="<?php  echo base_url();?>product/browse/?cat_id=166&s=0"><?php echo $words["men"];?> </a></li>
										<li><a href="<?php  echo base_url();?>product/browse/?cat_id=323&s=0"><?php echo $words["kids"];?> </a></li>
										<li><a href="<?php  echo base_url();?>product/browse/?cat_id=806&s=0"><?php echo $words["home"];?> </a></li>

												
									</ul>
								</div>
								<div class="col-sm-6">
									<!--<h5>WHAT'S NEW </h5>
									<ul>
										<li><a href=" <?php echo base_url();?>product/browse/?cat_id=<?php echo $cat->main_id;?>&s=101&s=100 "> New Arrivals </a> </li> 
									</ul>
									<hr/>-->
									<h5><?php echo $words["sale"];?></h5>
									<ul>
										<li><a href="<?php  echo base_url();?>product/browse/?cat_id=2&s=0"><?php echo $words["see_all"];?></a></li>
									</ul>
									<!--<hr/>-->
									<!--<h5>FEATURED ITEMS <font size="2px" color="red">soon</font></h5>
									<ul>
										<li><?php echo $words["see_all"];?></li>
									</ul>
									<hr/>-->
								</div>
							</div>
				</ul>
			</li>
			
		</ul>
	</div>
</nav>
			
			
		