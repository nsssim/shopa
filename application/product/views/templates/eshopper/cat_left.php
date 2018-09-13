<?php
						// load categories
						$CI->load->module("categories");
						$data["categories"] = $this->categories->get_categories_list();
						//echo "<pre>";
						//print_r($data['categories']['women_bags_cat']);
						
					//	echo("</pre>");
						?>
<div class="col-sm-3">
					<div class="left-sidebar">
						
								
		<div class="panel-group category-products" id="accordian">
			
			
			<div class="panel panel-default">
				
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordian" href="#women">
													<span class="badge pull-right"><i class="fa fa-plus"></i></span>
													Women
												</a>
											</h4>
											
										</div>
										
										<div id="women" class="panel-collapse collapse">
											<div class="panel-body">
												<ul>
													<?php 
					foreach ($data['categories']['women_cat'] as $cat) :
					?>
		<li><a href="<?php  echo base_url();?>product/get_category_decendents_products/<?php echo $cat->main_id;?>"><?php echo $cat->name;?> </a></li>
													<?php endforeach; ?>
		
													
												</ul>
											</div>
										</div>
										
										
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordian" href="#bags">
													<span class="badge pull-right"><i class="fa fa-plus"></i></span>
													Bags
												</a>
											</h4>
											
										</div>
										
										<div id="bags" class="panel-collapse collapse">
											<div class="panel-body">
												<ul>
													<?php 
					foreach ($data['categories']['women_bags_cat'] as $cat) :
					?>
		<li><a href="<?php  echo base_url();?>product/get_category_decendents_products/<?php echo $cat->main_id;?>"><?php echo $cat->name;?> </a></li>
													<?php endforeach; ?>
													
													<?php 
					foreach ($data['categories']['men_bags_cat'] as $cat) :
					?>
		<li><a href="<?php  echo base_url();?>product/get_category_decendents_products/<?php echo $cat->main_id;?>"><?php echo $cat->name;?> </a></li>
													<?php endforeach; ?>
		
													
												</ul>
											</div>
										</div>
										
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordian" href="#Shoes">
													<span class="badge pull-right"><i class="fa fa-plus"></i></span>
													Shoes
												</a>
											</h4>
											
										</div>
										
										<div id="Shoes" class="panel-collapse collapse">
											<div class="panel-body">
												<ul>
													<?php 
					foreach ($data['categories']['women_shoes_cat'] as $cat) :
					?>
		<li><a href="<?php  echo base_url();?>product/get_category_decendents_products/<?php echo $cat->main_id;?>"><?php echo $cat->name;?> </a></li>
													<?php endforeach; ?>
													
													<?php 
					foreach ($data['categories']['men_shoes_cat'] as $cat) :
					?>
		<li><a href="<?php  echo base_url();?>product/get_category_decendents_products/<?php echo $cat->main_id;?>"><?php echo $cat->name;?> </a></li>
													<?php endforeach; ?>
		
													
												</ul>
											</div>
										</div>
										
										
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordian" href="#JEWELRY">
													<span class="badge pull-right"><i class="fa fa-plus"></i></span>
													JEWELRY
												</a>
											</h4>
											
										</div>
										
										<div id="JEWELRY" class="panel-collapse collapse">
											<div class="panel-body">
												<ul>
													<?php 
					foreach ($data['categories']['women_jewelry_cat'] as $cat) :
					?>
		<li><a href="<?php  echo base_url();?>product/get_category_decendents_products/<?php echo $cat->main_id;?>"><?php echo $cat->name;?> </a></li>
													<?php endforeach; ?>
													
													<?php 
					foreach ($data['categories']['men_jewelry_cat'] as $cat) :
					?>
		<li><a href="<?php  echo base_url();?>product/get_category_decendents_products/<?php echo $cat->main_id;?>"><?php echo $cat->name;?> </a></li>
													<?php endforeach; ?>
		
													
												</ul>
											</div>
										</div>
										
										
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordian" href="#ACCESSORIES">
													<span class="badge pull-right"><i class="fa fa-plus"></i></span>
													ACCESSORIES
												</a>
											</h4>
											
										</div>
										
										<div id="ACCESSORIES" class="panel-collapse collapse">
											<div class="panel-body">
												<ul>
													<?php 
					foreach ($data['categories']['women_accessories_cat'] as $cat) :
					?>
		<li><a href="<?php  echo base_url();?>product/get_category_decendents_products/<?php echo $cat->main_id;?>"><?php echo $cat->name;?> </a></li>
													<?php endforeach; ?>
													
													<?php 
					foreach ($data['categories']['men_accessories_cat'] as $cat) :
					?>
		<li><a href="<?php  echo base_url();?>product/get_category_decendents_products/<?php echo $cat->main_id;?>"><?php echo $cat->name;?> </a></li>
													<?php endforeach; ?>
		
													
												</ul>
											</div>
										</div>
										
										
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordian" href="#BEAUTY">
													<span class="badge pull-right"><i class="fa fa-plus"></i></span>
													BEAUTY
												</a>
											</h4>
											
										</div>
										
										<div id="BEAUTY" class="panel-collapse collapse">
											<div class="panel-body">
												<ul>
													<?php 
					foreach ($data['categories']['women_beauty_cat'] as $cat) :
					?>
		<li><a href="<?php  echo base_url();?>product/get_category_decendents_products/<?php echo $cat->main_id;?>"><?php echo $cat->name;?> </a></li>
													<?php endforeach; ?>
													
													<?php 
					foreach ($data['categories']['men_grooming_cat'] as $cat) :
					?>
		<li><a href="<?php  echo base_url();?>product/get_category_decendents_products/<?php echo $cat->main_id;?>"><?php echo $cat->name;?> </a></li>
													<?php endforeach; ?>
		
													
												</ul>
											</div>
										</div>



										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordian" href="#MEN">
													<span class="badge pull-right"><i class="fa fa-plus"></i></span>
													MEN
												</a>
											</h4>
											
										</div>
										
										<div id="MEN" class="panel-collapse collapse">
											<div class="panel-body">
												<ul>
													<?php 
					foreach ($data['categories']['men_cat'] as $cat) :
					?>
		<li><a href="<?php  echo base_url();?>product/get_category_decendents_products/<?php echo $cat->main_id;?>"><?php echo $cat->name;?> </a></li>
													<?php endforeach; ?>
													
													
		
													
												</ul>
											</div>
										</div>


										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordian" href="#kids">
													
													KIDS & BABIES
												</a>
											</h4>
											
										</div>
										
										<div id="kids" class="panel-collapse collapse">
											<div class="panel-body">
												<ul>
													<?php 
					foreach ($data['categories']['kids_cat'] as $cat) :
					?>
		<li><a data-toggle="collapse" data-parent="#accordian" href="#<?php echo $cat->name;?>"><?php echo $cat->name;?> </a>	
		<div id="<?php echo $cat->name;?>" class="panel-collapse collapse">
											<div class="panel-body">
		<ul>
		<li>lolo</li>
		</ul>
											</div>
		</div>
			</li>
													<?php endforeach; ?>
													
													
		
													
												</ul>
											</div>
										</div>
										

			
										
										
										
										
										
										
																	</div>
									
		
		</div>
		
					
					</div>
				</div>
						