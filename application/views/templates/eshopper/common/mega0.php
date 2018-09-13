<?php
						// load categories
						$CI =& get_instance();
						$CI->load->module("categories");
						$data["categories"] = $this->categories->get_categories_list();
						//echo "<pre>";
						//	print_r($data['categories']['women_bags_cat']);
						//echo("</pre>");
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
		<ul class="nav navbar-nav">
			<li class="dropdown mega-dropdown">
			<a href="<?php  echo base_url();?>brands/brands_list" class="dropdown-toggle">Brands <span class="glyphicon glyphicon-chevron-down pull-right"></span></a>
				
				<ul class="dropdown-menu mega-dropdown-menu">
							<div class="row">
								<div class="col-sm-12">
									<img src="<?php echo base_url().'assets/templates/eshopper/banner/women/05.jpg';?>"/>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<h5>Brands </h5>
									<ul>
										<?php 
	                        $alphas = range('A', 'Z');
	                        foreach($alphas as $key=>$value):
	                      ?>
	                      <a href="<?php  echo base_url();?>brands/brands_list#divbrand<?php echo ($value);?>">
		<?php echo ($value);?></a>
													<?php endforeach; ?>
									</ul>
								</div>
								<div class="col-sm-6">
									
									<ul>
										<li>New Arrivals <font size="2px" color="red">soon</font></li>
										<li>New Brands <font size="2px" color="red">soon</font></li>
									</ul>
									<hr/>
									<h5>BRANDS ON SALE <font size="2px" color="red">soon</font></h5>
									<ul>
										<li>See All</li>
									</ul>
									<hr/>
									<h5>FEATURED BRANDS ITEMS <font size="2px" color="red">soon</font></h5>
									<ul>
										<li>See All</li>
									</ul>
									<hr/>
								</div>
							</div>
				</ul>
			</li>		
			<li class="dropdown mega-dropdown">
			<a href="<?php  echo base_url();?>product/browse/?cat_id=2" class="dropdown-toggle">Women <span class="glyphicon glyphicon-chevron-down pull-right"></span></a>
				
				<ul class="dropdown-menu mega-dropdown-menu">
							<div class="row">
								<div class="col-sm-12">
									<img src="<?php echo base_url().'assets/templates/eshopper/banner/women/01.jpg';?>"/>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<h5>CLOTHING</h5>
									<ul>
										<?php 
					foreach ($data['categories']['women_cat'] as $cat) :
					?>
		<li><a href="<?php  echo base_url();?>product/listing/id<?php echo $cat->main_id;?>"><?php echo $cat->name;?> </a></li>
													<?php endforeach; ?>
									</ul>
								</div>
								<div class="col-sm-6">
									<h5>WHAT'S NEW <font size="2px" color="red">soon</font></h5>
									<ul>
										<li>New Arrivals</li>
										<li>New Brands</li>
									</ul>
									<hr/>
									<h5>SALE </h5>
									<ul>
										<li><a href="<?php  echo base_url();?>product/onsale/c2">See All</a></li>
									</ul>
									<hr/>
									<h5>FEATURED ITEMS <font size="2px" color="red">soon</font></h5>
									<ul>
										<li>See All</li>
									</ul>
									<hr/>
								</div>
							</div>
				</ul>
			</li>
			<li class="dropdown mega-dropdown">
			<a href="<?php  echo base_url();?>product/browse/?cat_id=31" class="dropdown-toggle">Bags <span class="glyphicon glyphicon-chevron-down pull-right"></span></a>
				
				<ul class="dropdown-menu mega-dropdown-menu">
							<div class="row">
								<div class="col-sm-12">
									<img src="<?php echo base_url().'assets/templates/eshopper/banner/bags/01.jpg';?>"/>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<h5>Women</h5>
									<ul>
										<?php 
					foreach ($data['categories']['women_bags_cat'] as $cat) :
					?>
		<li><a href="<?php  echo base_url();?>product/listing/id<?php echo $cat->main_id;?>"><?php echo $cat->name;?> </a></li>
													<?php endforeach; ?>
									</ul>
									<h5>Men</h5>
									<ul>
										<?php 
					foreach ($data['categories']['men_bags_cat'] as $cat) :
					?>
		<li><a href="<?php  echo base_url();?>product/listing/id<?php echo $cat->main_id;?>"><?php echo $cat->name;?> </a></li>
													<?php endforeach; ?>
									</ul>
								</div>
								<div class="col-sm-6">
									<h5>WHAT'S NEW <font size="2px" color="red">soon</font></h5>
									<ul>
										<li>New Arrivals</li>
										<li>New Brands</li>
									</ul>
									<hr/>
									<h5>SALE</h5>
									<ul>
										<li><a href="<?php  echo base_url();?>product/onsale/c31">See All</a></li>
									</ul>
									<hr/>
									<h5>FEATURED ITEMS <font size="2px" color="red">soon</font></h5>
									<ul>
										<li>See All</li>
									</ul>
									<hr/>
								</div>
							</div>
				</ul>
			</li>
			<li class="dropdown mega-dropdown">
			<a href="<?php  echo base_url();?>product/listing/id109" class="dropdown-toggle">Shoes <span class="glyphicon glyphicon-chevron-down pull-right"></span></a>
				
				<ul class="dropdown-menu mega-dropdown-menu">
							<div class="row">
								<div class="col-sm-12">
									<img src="<?php echo base_url().'assets/templates/eshopper/banner/shoes/01.jpg';?>"/>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<h5>Women</h5>
									<ul>
										<?php 
					foreach ($data['categories']['women_shoes_cat'] as $cat) :
					?>
		<li><a href="<?php  echo base_url();?>product/listing/id<?php echo $cat->main_id;?>"><?php echo $cat->name;?> </a></li>
													<?php endforeach; ?>
									</ul>
									<h5>Men</h5>
									<ul>
										<?php 
					foreach ($data['categories']['men_shoes_cat'] as $cat) :
					?>
		<li><a href="<?php  echo base_url();?>product/listing/id<?php echo $cat->main_id;?>"><?php echo $cat->name;?> </a></li>
													<?php endforeach; ?>
									</ul>
								</div>
								<div class="col-sm-6">
									<h5>WHAT'S NEW <font size="2px" color="red">soon</font></h5>
									<ul>
										<li>New Arrivals</li>
										<li>New Brands</li>
									</ul>
									<hr/>
									<h5>SALE </h5>
									<ul>
										<li><a href="<?php  echo base_url();?>product/onsale/c109">See All</a></li>
									</ul>
									<hr/>
									<h5>FEATURED ITEMS <font size="2px" color="red">soon</font></h5>
									<ul>
										<li>See All</li>
									</ul>
									<hr/>
								</div>
							</div>
				</ul>
			</li>
<li class="dropdown mega-dropdown">
			<a href="<?php  echo base_url();?>product/listing/id65" class="dropdown-toggle">Jewellery & Accessories <span class="glyphicon glyphicon-chevron-down pull-right"></span></a>
				
				<ul class="dropdown-menu mega-dropdown-menu">
							<div class="row">
								<div class="col-sm-12">
									<img src="<?php echo base_url().'assets/templates/eshopper/banner/jewelery/01.jpg';?>"/>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<h5>Women</h5>
									<ul>
										<?php 
					foreach ($data['categories']['women_jewelry_cat'] as $cat) :
					?>
		<li><a href="<?php  echo base_url();?>product/listing/id<?php echo $cat->main_id;?>"><?php echo $cat->name;?> </a></li>
													<?php endforeach; ?>
									</ul>
									<h5>Men</h5>
									<ul>
										<?php 
					foreach ($data['categories']['men_jewelry_cat'] as $cat) :
					?>
		<li><a href="<?php  echo base_url();?>product/listing/id<?php echo $cat->main_id;?>"><?php echo $cat->name;?> </a></li>
													<?php endforeach; ?>
									</ul>
								</div>
								<div class="col-sm-6">
									<h5>WHAT'S NEW <font size="2px" color="red">soon</font></h5>
									<ul>
										<li>New Arrivals</li>
										<li>New Brands</li>
									</ul>
									<hr/>
									<h5>SALE</h5>
									<ul>
										<li><a href="<?php  echo base_url();?>product/onsale/c65">See All</a></li>
									</ul>
									<hr/>
									<h5>FEATURED ITEMS <font size="2px" color="red">soon</font></h5>
									<ul>
										<li>See All</li>
									</ul>
									<hr/>
								</div>
							</div>
				</ul>
			</li>
<li class="dropdown mega-dropdown">
			<a href="<?php  echo base_url();?>product/listing/id413" class="dropdown-toggle">Beauty<span class="glyphicon glyphicon-chevron-down pull-right"></span></a>
				
				<ul class="dropdown-menu mega-dropdown-menu">
							<div class="row">
								<div class="col-sm-12">
									<img src="<?php echo base_url().'assets/templates/eshopper/banner/women/10.jpg';?>"/>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<h5>Women</h5>
									<ul>
										<?php 
					foreach ($data['categories']['women_beauty_cat'] as $cat) :
					?>
		<li><a href="<?php  echo base_url();?>product/listing/id<?php echo $cat->main_id;?>"><?php echo $cat->name;?> </a></li>
													<?php endforeach; ?>
									</ul>
									<h5>Men</h5>
									<ul>
										<?php 
					foreach ($data['categories']['men_grooming_cat'] as $cat) :
					?>
		<li><a href="<?php  echo base_url();?>product/listing/id<?php echo $cat->main_id;?>"><?php echo $cat->name;?> </a></li>
													<?php endforeach; ?>
									</ul>
								</div>
								<div class="col-sm-6">
									<h5>WHAT'S NEW <font size="2px" color="red">soon</font></h5>
									<ul>
										<li>New Arrivals</li>
										<li>New Brands</li>
									</ul>
									<hr/>
									<h5>SALE </h5>
									<ul>
										<li><a href="<?php  echo base_url();?>product/onsale/c413">See All</a></li>
									</ul>
									<hr/>
									<h5>FEATURED ITEMS <font size="2px" color="red">soon</font></h5>
									<ul>
										<li>See All</li>
									</ul>
									<hr/>
								</div>
							</div>
				</ul>
			</li>
<li class="dropdown mega-dropdown">
			<a href="<?php  echo base_url();?>product/listing/id166" class="dropdown-toggle">Men <span class="glyphicon glyphicon-chevron-down pull-right"></span></a>
				
				<ul class="dropdown-menu mega-dropdown-menu">
							<div class="row">
								<div class="col-sm-12">
									<img src="<?php echo base_url().'assets/templates/eshopper/banner/men/01.jpg';?>"/>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<h5>CLOTHING</h5>
									<ul>
										<?php 
					foreach ($data['categories']['men_cat'] as $cat) :
					?>
		<li><a href="<?php  echo base_url();?>product/listing/id<?php echo $cat->main_id;?>"><?php echo $cat->name;?> </a></li>
													<?php endforeach; ?>
									</ul>
								</div>
								<div class="col-sm-6">
									<h5>WHAT'S NEW <font size="2px" color="red">soon</font></h5>
									<ul>
										<li>New Arrivals</li>
										<li>New Brands</li>
									</ul>
									<hr/>
									<h5>SALE</h5>
									<ul>
										<li><a href="<?php  echo base_url();?>product/onsale/c166">See All</a></li>
									</ul>
									<hr/>
									<h5>FEATURED ITEMS <font size="2px" color="red">soon</font></h5>
									<ul>
										<li>See All</li>
									</ul>
									<hr/>
								</div>
							</div>
				</ul>
			</li>
			
			<li class="dropdown mega-dropdown">
			<a href="<?php  echo base_url();?>product/listing/id323" class="dropdown-toggle">Kids <span class="glyphicon glyphicon-chevron-down pull-right"></span></a>
				
				<ul class="dropdown-menu mega-dropdown-menu">
							<div class="row">
								<div class="col-sm-12">
									<img src="<?php echo base_url().'assets/templates/eshopper/banner/kids/01.jpg';?>"/>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<h5>KIDS</h5>
									<ul>
										<?php 
					foreach ($data['categories']['kids_cat'] as $cat) :
					?>
		<li><a href="<?php  echo base_url();?>product/listing/id<?php echo $cat->main_id;?>"><?php echo $cat->name;?> </a></li>
													<?php endforeach; ?>
									</ul>
								</div>
								<div class="col-sm-6">
									<h5>WHAT'S NEW <font size="2px" color="red">soon</font></h5>
									<ul>
										<li>New Arrivals</li>
										<li>New Brands</li>
									</ul>
									<hr/>
									<h5>SALE </h5>
									<ul>
										<li><a href="<?php  echo base_url();?>product/onsale/c323">See All</a></li>
									</ul>
									<hr/>
									<h5>FEATURED ITEMS <font size="2px" color="red">soon</font></h5>
									<ul>
										<li>See All</li>
									</ul>
									<hr/>
								</div>
							</div>
				</ul>
			</li>

<li class="dropdown mega-dropdown">
			<a href="<?php  echo base_url();?>product/onsale/c2" class="dropdown-toggle pull-right">Sale <span class="glyphicon glyphicon-chevron-down "></span></a>
				
				<ul class="dropdown-menu mega-dropdown-menu">
							<div class="row">
								<div class="col-sm-12">
									<img src="<?php echo base_url().'assets/templates/eshopper/banner/women/01.jpg';?>"/>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<h5>SALE </h5>
									<ul>
										
		<li><a href="<?php  echo base_url();?>product/onsale/c2">WOMEN </a></li>
		<li><a href="<?php  echo base_url();?>product/onsale/c31">BAGS </a></li>
		<li><a href="<?php  echo base_url();?>product/onsale/c109">SHOES </a></li>
		<li><a href="<?php  echo base_url();?>product/onsale/c65">JEWELRY </a></li>
		<li><a href="<?php  echo base_url();?>product/onsale/c3">ACCESSORIES </a></li>
		<li><a href="<?php  echo base_url();?>product/onsale/c413">BEAUTY </a></li>
		<li><a href="<?php  echo base_url();?>product/onsale/c166">MEN </a></li>
		<li><a href="<?php  echo base_url();?>product/onsale/c323">KIDS & BABIES </a></li>

												
									</ul>
								</div>
								<div class="col-sm-6">
									<h5>WHAT'S NEW <font size="2px" color="red">soon</font></h5>
									<ul>
										<li>New Arrivals</li>
										<li>New Brands</li>
									</ul>
									<hr/>
									<h5>SALE</h5>
									<ul>
										<li><a href="<?php  echo base_url();?>product/onsale/c2">See All</a></li>
									</ul>
									<hr/>
									<h5>FEATURED ITEMS <font size="2px" color="red">soon</font></h5>
									<ul>
										<li>See All</li>
									</ul>
									<hr/>
								</div>
							</div>
				</ul>
			</li>
			
		</ul>
	</div>
</nav>
			
			
		