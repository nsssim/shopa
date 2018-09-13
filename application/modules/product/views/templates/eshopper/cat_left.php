<?php
if( isset($is_search_result) )
//echo "is_search_result---------->".$is_search_result." (cat_left line 2)<br>";
						// load categories
						$CI->load->module("categories");
						$data["categories"] = $this->categories->get_categories_list();
													?>
						
<div class="col-sm-3">
					<div class="left-sidebar">
						<?php 
							//foreach (array_reverse($ancestors_cat) as $ancestors_cat1) :
						  //   foreach ($ancestors_cat1 as $ancestors_cat1) :	
						// echo($ancestors_cat1->name.' / '); 
						// endforeach;
						//	endforeach;?>
								
		<div class="panel-group category-products" id="accordian">
			
			
			<div class="panel panel-default" style="padding-left:3px">
				
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordian" href="#women">
													<span class="badge pull-right"><i class="fa fa-plus"></i></span>
													<?php echo $words_left["women"] ?> 
												</a>
											</h4>
											
										</div>
										
										<div id="women" class="panel-collapse collapse <?php if($cat_id==2){echo "in";}?>">
											<div class="panel-body">
												<ul>
													<?php 
					foreach ($data['categories']['women_cat'] as $cat) :
					?>
<?php $subcat=$CI->categories->get_subcategories($cat->main_id);?>
		<li><?php if($subcat){?>
			<a data-toggle="collapse" data-parent="#accordianl0" href="#<?php echo $cat->main_id;?>">
				<?php }else{?>
				<a href="<?php  echo base_url();?>product/browse/?cat_id=<?php echo($cat->main_id);?>">
					<?php }?>
				<?php echo $cat->name;?> </a>	
		<div id="<?php echo $cat->main_id;?>"   name="catleft<?php echo $cat->name;?>" class="panel-collapse collapse ">
											<div class="panel-body">
		<ul>
			<?php //$subcat=$CI->categories->get_subcategories($cat->main_id);?>
					<?php foreach ($subcat as $subcat) :?>
					

		<li><a href="<?php  echo base_url();?>product/browse/?cat_id=<?php echo($subcat['id']);?>"><?php echo($subcat['name']);?></a></li>
		<?php endforeach; ?>

		</ul>
											</div>
		</div>
			</li>
													<?php endforeach; ?>

		
													
												</ul>
											</div>
										</div>
										
										
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordian" href="#bags">
													<span class="badge pull-right"><i class="fa fa-plus"></i></span>
													<?php echo $words_left["bags"] ?> 
												</a>
											</h4>
											
										</div>
										
										<div id="bags" class="panel-collapse collapse <?php if($cat_id==31){echo "in";}?>">
											<div class="panel-body">
												<ul>
													<?php 
					foreach ($data['categories']['women_bags_cat'] as $cat) :
					?>
		<?php $subcat=$CI->categories->get_subcategories($cat->main_id);?>
		<li><?php if($subcat){?>
			<a data-toggle="collapse" data-parent="#accordianl0" href="#<?php echo $cat->main_id;?>">
				<?php }else{?>
				<a href="<?php  echo base_url();?>product/browse/?cat_id=<?php echo($cat->main_id);?>">
					<?php }?>
				<?php echo $cat->name;?> </a>	
		<div id="<?php echo $cat->main_id;?>"   name="catleft<?php echo $cat->name;?>" class="panel-collapse collapse">
											<div class="panel-body">
		<ul>
			<?php //$subcat=$CI->categories->get_subcategories($cat->main_id);?>
					<?php foreach ($subcat as $subcat) :?>
					

		<li><a href="<?php  echo base_url();?>product/browse/?cat_id=<?php echo($subcat['id']);?>"><?php echo($subcat['name']);?></a></li>
		<?php endforeach; ?>

		</ul>
											</div>
		</div>
			</li>
													<?php endforeach; ?>

													
													<?php 
					foreach ($data['categories']['men_bags_cat'] as $cat) :
					?>
<?php $subcat=$CI->categories->get_subcategories($cat->main_id);?>
		<li><?php if($subcat){?>
			<a data-toggle="collapse" data-parent="#accordianl0" href="#<?php echo $cat->main_id;?>">
				<?php }else{?>
				<a href="<?php  echo base_url();?>product/browse/?cat_id=<?php echo($cat->main_id);?>">
					<?php }?>
				<?php echo $cat->name;?> </a>	
		<div id="<?php echo $cat->main_id;?>"   name="catleft<?php echo $cat->name;?>" class="panel-collapse collapse">
											<div class="panel-body">
		<ul>
			<?php //$subcat=$CI->categories->get_subcategories($cat->main_id);?>
					<?php foreach ($subcat as $subcat) :?>
					

		<li><a href="<?php  echo base_url();?>product/browse/?cat_id=<?php echo($subcat['id']);?>"><?php echo($subcat['name']);?></a></li>
		<?php endforeach; ?>

		</ul>
											</div>
		</div>
			</li>
													<?php endforeach; ?>

		
													
												</ul>
											</div>
										</div>
										
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordian" href="#Shoes">
													<span class="badge pull-right"><i class="fa fa-plus"></i></span>
													<?php echo $words_left["shoes"] ?> 
												</a>
											</h4>
											
										</div>
										
										<div id="Shoes" class="panel-collapse collapse <?php if($cat_id==109){echo "in";}?>">
											<div class="panel-body">
												<ul>
													<?php 
					foreach ($data['categories']['women_shoes_cat'] as $cat) :
					?>
<?php $subcat=$CI->categories->get_subcategories($cat->main_id);?>
		<li><?php if($subcat){?>
			<a data-toggle="collapse" data-parent="#accordianl0" href="#<?php echo $cat->main_id;?>">
				<?php }else{?>
				<a href="<?php  echo base_url();?>product/browse/?cat_id=<?php echo($cat->main_id);?>">
					<?php }?>
				<?php echo $cat->name;?> </a>	
		<div id="<?php echo $cat->main_id;?>"   name="catleft<?php echo $cat->name;?>" class="panel-collapse collapse">
											<div class="panel-body">
		<ul>
			<?php //$subcat=$CI->categories->get_subcategories($cat->main_id);?>
					<?php foreach ($subcat as $subcat) :?>
					

		<li><a href="<?php  echo base_url();?>product/browse/?cat_id=<?php echo($subcat['id']);?>"><?php echo($subcat['name']);?></a></li>
		<?php endforeach; ?>

		</ul>
											</div>
		</div>
			</li>
													<?php endforeach; ?>

													
													<?php 
					foreach ($data['categories']['men_shoes_cat'] as $cat) :
					?>
		<?php $subcat=$CI->categories->get_subcategories($cat->main_id);?>
		<li><?php if($subcat){?>
			<a data-toggle="collapse" data-parent="#accordianl0" href="#<?php echo $cat->main_id;?>">
				<?php }else{?>
				<a href="<?php  echo base_url();?>product/browse/?cat_id=<?php echo($cat->main_id);?>">
					<?php }?>
				<?php echo $cat->name;?> </a>	
		<div id="<?php echo $cat->main_id;?>"   name="catleft<?php echo $cat->name;?>" class="panel-collapse collapse">
											<div class="panel-body">
		<ul>
			<?php //$subcat=$CI->categories->get_subcategories($cat->main_id);?>
					<?php foreach ($subcat as $subcat) :?>
					

		<li><a href="<?php  echo base_url();?>product/browse/?cat_id=<?php echo($subcat['id']);?>"><?php echo($subcat['name']);?></a></li>
		<?php endforeach; ?>

		</ul>
											</div>
		</div>
			</li>
													<?php endforeach; ?>

		
													
												</ul>
											</div>
										</div>
										
										
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordian" href="#JEWELRY">
													<span class="badge pull-right"><i class="fa fa-plus"></i></span>
													<?php echo $words_left["jewellery"] ?> 
												</a>
											</h4>
											
										</div>
										
										<div id="JEWELRY" class="panel-collapse collapse <?php if($cat_id==65){echo "in";}?>">
											<div class="panel-body">
												<ul>
													<?php 
					foreach ($data['categories']['women_jewelry_cat'] as $cat) :
					?>
<?php $subcat=$CI->categories->get_subcategories($cat->main_id);?>
		<li><?php if($subcat){?>
			<a data-toggle="collapse" data-parent="#accordianl0" href="#<?php echo $cat->main_id;?>">
				<?php }else{?>
				<a href="<?php  echo base_url();?>product/browse/?cat_id=<?php echo($cat->main_id);?>">
					<?php }?>
				<?php echo $cat->name;?> </a>	
		<div id="<?php echo $cat->main_id;?>"   name="catleft<?php echo $cat->name;?>" class="panel-collapse collapse">
											<div class="panel-body">
		<ul>
			<?php //$subcat=$CI->categories->get_subcategories($cat->main_id);?>
					<?php foreach ($subcat as $subcat) :?>
					

		<li><a href="<?php  echo base_url();?>product/browse/?cat_id=<?php echo($subcat['id']);?>"><?php echo($subcat['name']);?></a></li>
		<?php endforeach; ?>

		</ul>
											</div>
		</div>
			</li>
													<?php endforeach; ?>

													
													<?php 
					foreach ($data['categories']['men_jewelry_cat'] as $cat) :
					?>
		<?php $subcat=$CI->categories->get_subcategories($cat->main_id);?>
		<li><?php if($subcat){?>
			<a data-toggle="collapse" data-parent="#accordianl0" href="#<?php echo $cat->main_id;?>">
				<?php }else{?>
				<a href="<?php  echo base_url();?>product/browse/?cat_id=<?php echo($cat->main_id);?>">
					<?php }?>
				<?php echo $cat->name;?> </a>	
		<div id="<?php echo $cat->main_id;?>"   name="catleft<?php echo $cat->name;?>" class="panel-collapse collapse">
											<div class="panel-body">
		<ul>
			<?php //$subcat=$CI->categories->get_subcategories($cat->main_id);?>
					<?php foreach ($subcat as $subcat) :?>
					

		<li><a href="<?php  echo base_url();?>product/browse/?cat_id=<?php echo($subcat['id']);?>"><?php echo($subcat['name']);?></a></li>
		<?php endforeach; ?>

		</ul>
											</div>
		</div>
			</li>
													<?php endforeach; ?>

		
													
												</ul>
											</div>
										</div>
										
										
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordian" href="#ACCESSORIES">
													<span class="badge pull-right"><i class="fa fa-plus"></i></span>
													<?php echo $words_left["accessories"] ?> 
												</a>
											</h4>
											
										</div>
										
										<div id="ACCESSORIES" class="panel-collapse collapse">
											<div class="panel-body">
												<ul>
													<?php 
					foreach ($data['categories']['women_accessories_cat'] as $cat) :
					?>
		<?php $subcat=$CI->categories->get_subcategories($cat->main_id);?>
		<li><?php if($subcat){?>
			<a data-toggle="collapse" data-parent="#accordianl0" href="#<?php echo $cat->main_id;?>">
				<?php }else{?>
				<a href="<?php  echo base_url();?>product/browse/?cat_id=<?php echo($cat->main_id);?>">
					<?php }?>
				<?php echo $cat->name;?> </a>	
		<div id="<?php echo $cat->main_id;?>"   name="catleft<?php echo $cat->name;?>" class="panel-collapse collapse">
											<div class="panel-body">
		<ul>
			<?php //$subcat=$CI->categories->get_subcategories($cat->main_id);?>
					<?php foreach ($subcat as $subcat) :?>
					

		<li><a href="<?php  echo base_url();?>product/browse/?cat_id=<?php echo($subcat['id']);?>"><?php echo($subcat['name']);?></a></li>
		<?php endforeach; ?>

		</ul>
											</div>
		</div>
			</li>
													<?php endforeach; ?>

													
													<?php 
					foreach ($data['categories']['men_accessories_cat'] as $cat) :
					?>
<?php $subcat=$CI->categories->get_subcategories($cat->main_id);?>
		<li><?php if($subcat){?>
			<a data-toggle="collapse" data-parent="#accordianl0" href="#<?php echo $cat->main_id;?>">
				<?php }else{?>
				<a href="<?php  echo base_url();?>product/browse/?cat_id=<?php echo($cat->main_id);?>">
					<?php }?>
				<?php echo $cat->name;?> </a>	
		<div id="<?php echo $cat->main_id;?>"   name="catleft<?php echo $cat->name;?>" class="panel-collapse collapse">
											<div class="panel-body">
		<ul>
			<?php //$subcat=$CI->categories->get_subcategories($cat->main_id);?>
					<?php foreach ($subcat as $subcat) :?>
					

		<li><a href="<?php  echo base_url();?>product/browse/?cat_id=<?php echo($subcat['id']);?>"><?php echo($subcat['name']);?></a></li>
		<?php endforeach; ?>

		</ul>
											</div>
		</div>
			</li>
													<?php endforeach; ?>
		
													
												</ul>
											</div>
										</div>
										
										
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordian" href="#BEAUTY">
													<span class="badge pull-right"><i class="fa fa-plus"></i></span>
													<?php echo $words_left["beauty"] ?> 
												</a>
											</h4>
											
										</div>
										
										<div id="BEAUTY" class="panel-collapse collapse <?php if($cat_id==413){echo "in";}?>">
											<div class="panel-body">
												<ul>
													<?php 
					foreach ($data['categories']['women_beauty_cat'] as $cat) :
					?>
		<?php $subcat=$CI->categories->get_subcategories($cat->main_id);?>
		<li><?php if($subcat){?>
			<a data-toggle="collapse" data-parent="#accordianl0" href="#<?php echo $cat->main_id;?>">
				<?php }else{?>
				<a href="<?php  echo base_url();?>product/browse/?cat_id=<?php echo($cat->main_id);?>">
					<?php }?>
				<?php echo $cat->name;?> </a>	
		<div id="<?php echo $cat->main_id;?>"   name="catleft<?php echo $cat->name;?>" class="panel-collapse collapse">
											<div class="panel-body">
		<ul>
			<?php //$subcat=$CI->categories->get_subcategories($cat->main_id);?>
					<?php foreach ($subcat as $subcat) :?>
					

		<li><a href="<?php  echo base_url();?>product/browse/?cat_id=<?php echo($subcat['id']);?>"><?php echo($subcat['name']);?></a></li>
		<?php endforeach; ?>

		</ul>
											</div>
		</div>
			</li>
													<?php endforeach; ?>

													
													<?php 
					foreach ($data['categories']['men_grooming_cat'] as $cat) :
					?>
		<?php $subcat=$CI->categories->get_subcategories($cat->main_id);?>
		<li><?php if($subcat){?>
			<a data-toggle="collapse" data-parent="#accordianl0" href="#<?php echo $cat->main_id;?>">
				<?php }else{?>
				<a href="<?php  echo base_url();?>product/browse/?cat_id=<?php echo($cat->main_id);?>">
					<?php }?>
				<?php echo $cat->name;?> </a>	
		<div id="<?php echo $cat->main_id;?>"   name="catleft<?php echo $cat->name;?>" class="panel-collapse collapse">
											<div class="panel-body">
		<ul>
			<?php //$subcat=$CI->categories->get_subcategories($cat->main_id);?>
					<?php foreach ($subcat as $subcat) :?>
					

		<li><a href="<?php  echo base_url();?>product/browse/?cat_id=<?php echo($subcat['id']);?>"><?php echo($subcat['name']);?></a></li>
		<?php endforeach; ?>

		</ul>
											</div>
		</div>
			</li>
													<?php endforeach; ?>

		
													
												</ul>
											</div>
										</div>



										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordian" href="#MEN">
													<span class="badge pull-right"><i class="fa fa-plus"></i></span>
													<?php echo $words_left["men"] ?> 
												</a>
											</h4>
											
										</div>
										
										<div id="MEN" class="panel-collapse collapse <?php if($cat_id==166){echo "in";}?>">
											<div class="panel-body">
												<ul>
													<?php 
					foreach ($data['categories']['men_cat'] as $cat) :
					?>
		<?php $subcat=$CI->categories->get_subcategories($cat->main_id);?>
		<li><?php if($subcat){?>
			<a data-toggle="collapse" data-parent="#accordianl0" href="#<?php echo $cat->main_id;?>">
				<?php }else{?>
				<a href="<?php  echo base_url();?>product/browse/?cat_id=<?php echo($cat->main_id);?>">
					<?php }?>
				<?php echo $cat->name;?> </a>	
		<div id="<?php echo $cat->main_id;?>"   name="catleft<?php echo $cat->name;?>" class="panel-collapse collapse">
											<div class="panel-body">
		<ul>
			<?php //$subcat=$CI->categories->get_subcategories($cat->main_id);?>
					<?php foreach ($subcat as $subcat) :?>
					

		<li><a href="<?php  echo base_url();?>product/browse/?cat_id=<?php echo($subcat['id']);?>"><?php echo($subcat['name']);?></a></li>
		<?php endforeach; ?>

		</ul>
											</div>
		</div>
			</li>
													<?php endforeach; ?>

													
													
		
													
												</ul>
											</div>
										</div>


										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordian" href="#kids">
													
													<?php echo $words_left["kids"] ?> 
												</a>
											</h4>
											
										</div>
										
										<div id="kids" class="panel-collapse collapse <?php if($cat_id==323){echo "in";}?>">
											<div class="panel-body">
												<ul>
													<?php foreach ($data['categories']['kids_cat'] as $cat) :?>
					<?php $subcat=$CI->categories->get_subcategories($cat->main_id);?>
		<li><?php if($subcat){?>
			<a data-toggle="collapse" data-parent="#accordianl0" href="#<?php echo $cat->main_id;?>">
				<?php }else{?>
				<a href="<?php  echo base_url();?>product/browse/?cat_id=<?php echo($cat->main_id);?>">
					<?php }?>
				<?php echo $cat->name;?> </a>	
		<div id="<?php echo $cat->main_id;?>"   name="catleft<?php echo $cat->name;?>" class="panel-collapse collapse ">
											<div class="panel-body">
		<ul>
			<?php //$subcat=$CI->categories->get_subcategories($cat->main_id);?>
					<?php foreach ($subcat as $subcat) :?>
					

		<li><a href="<?php  echo base_url();?>product/browse/?cat_id=<?php echo($subcat['id']);?>"><?php echo($subcat['name']);?></a></li>
		<?php endforeach; ?>

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
		<?php include "price_filter.php";?>
					
					</div>
				</div>
						
						
						
						
						
						
						
						
						
						
						
						