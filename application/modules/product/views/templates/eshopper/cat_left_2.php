<head>
	<style>
		.panel-heading .panel-title a
		{
		font-size: 10px !important;
		}
		.plus_sign
		{
			color: #000000;
			font-size: 10px;
			font-family: Nunito,Helvetica,Verdana,Sans-serif;
		}
		
		.category-products .panel-default .panel-heading
		{
			padding: 0px;
		}
		
		.panel-heading .panel-title:nth-child(1)
		{
			/*color: pink !important;*/
			padding-top: 5px;
		}
		
		h4 
		{
		    line-height: 0.85 !important;	
		}
		
		.panel-group .panel+.panel 
		{
	    	 margin-top: 0px !important ;		}

	</style>
	
</head>
<?php

/*echo "<pre>";
var_dump($breadcrumbs);
echo "</pre>";*/

$breadcrumbs_ids = array();
foreach($breadcrumbs as $breadcrumb)
{
	$breadcrumbs_ids[] =  $breadcrumb->id_category;
}

				
if( isset($is_search_result) )
//echo "is_search_result---------->".$is_search_result." (cat_left line 2)<br>";

// load categories
$CI =& get_instance();
$CI->load->module("categories");
$data["categories"] = $CI->categories->get_categories_list();
							?>
						
<div class="col-sm-3">
	<div class="left-sidebar">
	<?php
		//echo '<img height="50px" src="https://avatars1.githubusercontent.com/u/386750?v=3&s=400" />';
		//$CI->load->library('firebug');  echo(' Woking behind the scene........ok <br>');
		//$CI->firebug->info($main_cats,"main_cats");

		//$data['main_cats'] = $this->categories->get_subcategories_plus(1); //get the 4 main categories 

		$oo=55;
		$i = 0;
		$j = 1000;						
		$k = 2000;						
		$l = 3000;						
		$m = 4000;						
		$n = 5000;						

		$reordered_main_cats = array();
		//reorder  women then men then kids then home 
		foreach($main_cats as $main_cat)
		{
			if($main_cat['id'] == 2 ) // women 
			{
				$reordered_main_cats[0]['id'] = $main_cat['id'];
				$reordered_main_cats[0]['name'] = $main_cat['name'];
			}
			elseif($main_cat['id'] == 166 ) // men 
			{
				$reordered_main_cats[1]['id'] = $main_cat['id'];
				$reordered_main_cats[1]['name'] = $main_cat['name'];
			}
			elseif($main_cat['id'] == 323 ) // kids 
			{
				$reordered_main_cats[2]['id'] = $main_cat['id'];
				$reordered_main_cats[2]['name'] = $main_cat['name'];
			}
			else
			{
				$reordered_main_cats[3]['id'] = $main_cat['id'];
				$reordered_main_cats[3]['name'] = $main_cat['name'];
			}
		}

		sort($reordered_main_cats);

								?>
		<!--~~Level1~~-->						
		<div class="panel-group category-products" id="accordian_level1" style="color: black;">
		<?php	foreach($reordered_main_cats as $category_level1): ?> <?php  $categories_level2 = $CI->categories->get_subcategories_plus_for_view($category_level1['id']); ?>
					
					<?php $i++ ; ?>						
					<div class="panel panel-default">
					   	<?php if(!empty($categories_level2)) :?>
						   	<div class="panel-heading">
						   		<h4 class="panel-title">
						   			<?php $is_active_parent =''; if( in_array($category_level1['id'], $breadcrumbs_ids) ) $is_active_parent ='is_active_parent';  ?>
						   			<?php $is_active = ""; if($category_level1['id'] == $cat_id) $is_active = ' sa_cat_active" '; ?>
									<span class="plus_sign" >[+]</span>
									<a class="<?php echo $is_active_parent.$is_active ?>"   data-toggle="collapse" data-parent="#accordian_level1" href="#collapse_<?php echo $category_level1['id']; ?>"><?php echo $category_level1['name']; ?></a>
						   		</h4>
							</div>
							<?php $is_in =''; if( in_array($category_level1['id'], $breadcrumbs_ids) ) $is_in ='in';  ?>	
							<div id="collapse_<?php echo $category_level1['id']; ?>" class="panel-collapse collapse  <?php echo $is_in; ?> ">
								<div class="panel-body">
									<!--~~Level2~~-->
									<div class="panel-group category-products" id="<?php echo 'accordian_level2_'.$i ?>" style="color: black;">
									<?php	foreach($categories_level2 as $category_level2): ?>	<?php $categories_level3 = $CI->categories->get_subcategories_plus_for_view($category_level2['id']); ?>
												<?php $j++ ; ?>	
												<div class="panel panel-default">
												   	<?php if(!empty($categories_level3)) :?>
													   	<div class="panel-heading">
													   		<h4 class="panel-title">
													   			<?php $is_active_parent =''; if( in_array($category_level2['id'], $breadcrumbs_ids) ) $is_active_parent ='is_active_parent';  ?>
													   			<?php $is_active = ""; if($category_level2['id'] == $cat_id) $is_active = ' sa_cat_active" '; ?>
																<span class="plus_sign" >[+]</span>
																<a class="<?php echo $is_active_parent.$is_active ?>"  data-toggle="collapse" data-parent="#<?php echo 'accordian_level2_'.$i ?>" href="#collapse_<?php echo $category_level2['id']; ?>"><?php echo $category_level2['name']; ?></a>
													   		</h4>
														</div>
														
														<?php $is_in =''; if( in_array($category_level2['id'], $breadcrumbs_ids) ) $is_in ='in';  ?>		
														<div id="collapse_<?php echo $category_level2['id']; ?>" class="panel-collapse collapse <?php echo $is_in; ?>">
															<div class="panel-body">
																<!--~~Level3~~-->
																<div class="panel-group category-products" id="<?php echo 'accordian_level3_'.$j ?>" style="color: black;">
																<?php	foreach($categories_level3 as $category_level3): ?>	<?php $categories_level4 = $CI->categories->get_subcategories_plus_for_view($category_level3['id']); ?>
																			<?php $k++ ; ?>	
																			<div class="panel panel-default">
																			   	<?php if(!empty($categories_level4)) :?>
																				   	<div class="panel-heading">
																				   		<h4 class="panel-title">
																				   			<?php $is_active_parent =''; if( in_array($category_level3['id'], $breadcrumbs_ids) ) $is_active_parent ='is_active_parent';  ?>
																				   			<?php $is_active = ""; if($category_level3['id'] == $cat_id) $is_active = ' sa_cat_active" '; ?>
																							<span class="plus_sign" >[+]</span>
																							<a class="<?php echo $is_active_parent.$is_active ?>"  data-toggle="collapse" data-parent="#<?php echo 'accordian_level3_'.$j ?>" href="#collapse_<?php echo $category_level3['id']; ?>"><?php echo $category_level3['name']; ?></a>
																				   		</h4>
																					</div>
																					
																					<?php $is_in =''; if( in_array($category_level3['id'], $breadcrumbs_ids) ) $is_in ='in';  ?>		
																					<div id="collapse_<?php echo $category_level3['id']; ?>" class="panel-collapse collapse <?php echo $is_in; ?>">
																						<div class="panel-body">
																								<!--~~Level4~~-->
																								<div class="panel-group category-products" id="<?php echo 'accordian_level4_'.$k ?>" style="color: black;">
																								<?php	foreach($categories_level4 as $category_level4): ?>	<?php $categories_level5 = $CI->categories->get_subcategories_plus_for_view($category_level4['id']); ?>
																											<?php $l++ ; ?>	
																											<div class="panel panel-default">
																											   	<?php if(!empty($categories_level5)) :?>
																												   	<div class="panel-heading">
																												   		<h4 class="panel-title">
																												   			<?php $is_active_parent =''; if( in_array($category_level4['id'], $breadcrumbs_ids) ) $is_active_parent ='is_active_parent';  ?>
																												   			<?php $is_active = ""; if($category_level4['id'] == $cat_id) $is_active = ' sa_cat_active" '; ?>
																															<span class="plus_sign" >[+]</span>
																															<a class="<?php echo $is_active_parent.$is_active ?>" data-toggle="collapse" data-parent="#<?php echo 'accordian_level4_'.$k ?>" href="#collapse_<?php echo $category_level4['id']; ?>"><?php echo $category_level4['name']; ?></a>
																												   		</h4>
																													</div>
																														
																													<?php $is_in =''; if( in_array($category_level4['id'], $breadcrumbs_ids) ) $is_in ='in';  ?>	
																													<div id="collapse_<?php echo $category_level4['id']; ?>" class="panel-collapse collapse <?php echo $is_in; ?>">
																														<div class="panel-body">
																															<!--~~Level5~~-->
																															<div class="panel-group category-products" id="<?php echo 'accordian_level5_'.$l ?>" style="color: black;">
																															<?php	foreach($categories_level5 as $category_level5): ?>	<?php $categories_level5 = $CI->categories->get_subcategories_plus_for_view($category_level5['id']); ?>
																																		<?php $m++ ; ?>	
																																		<div class="panel panel-default">
																																		   	<?php if(!empty($categories_level5)) :?>
																																			   	<div class="panel-heading">
																																			   		<h4 class="panel-title">
																																			   			<?php $is_active_parent =''; if( in_array($category_level5['id'], $breadcrumbs_ids) ) $is_active_parent ='is_active_parent';  ?>
																																						<?php $is_active = ""; if($category_level5['id'] == $cat_id) $is_active = ' class=" sa_cat_active" '; ?>
																																						<span class="plus_sign" >[+]</span>
																																						<a class="<?php echo $is_active_parent.$is_active ?>" data-toggle="collapse" data-parent="#<?php echo 'accordian_level5_'.$l ?>" href="#collapse_<?php echo $category_level5['id']; ?>"><?php echo $category_level5['name']; ?></a>
																																			   		</h4>
																																				</div>
																																					
																																				<?php $is_in =''; if( in_array($category_level5['id'], $breadcrumbs_ids) ) $is_in ='in';  ?>	
																																				<div id="collapse_<?php echo $category_level5['id']; ?>" class="panel-collapse collapse <?php echo $is_in; ?>">
																																					<div class="panel-body">
																																						next level here 
																																					</div>
																																				</div>
																																		   	<?php else :?>
																																		   		<div class="panel-heading" style="padding-left: 15px;">
																																			   		<h4 class="panel-title">
																																			   			<?php $is_active =''; if( in_array($category_level5['id'], $breadcrumbs_ids) ) $is_active = ' class="sa_cat_active" ';  ?>
																																			   			<!--<img height="12px" src="<?php echo base_url().'assets/templates/eshopper/images/products-list/User-Interface-Blank-icon.png' ?>" > 	-->
																																						<a style="font-size: 9px;" <?php echo $is_active ?> href="<?php echo base_url().'product/browse/?cat_id='.$category_level5['id'] ?>"><?php echo $category_level5['name']; ?></a>
																																			   		</h4>
																																				</div>
																																		   	<?php endif;?>
																																		</div>
																															<?php	endforeach; ?>		
																															</div>
																															<!--~~/Level5~~-->  
																														</div>
																													</div>
																											   	<?php else :?>
																											   		<div class="panel-heading">
																												   		<h4 class="panel-title">
																												   			<?php $is_active =''; if( in_array($category_level4['id'], $breadcrumbs_ids) ) $is_active = ' class="sa_cat_active" ';  ?>	
																												   			<img height="12px" src="<?php echo base_url().'assets/templates/eshopper/images/products-list/User-Interface-Blank-icon.png' ?>" > 	
																															<a <?php echo $is_active ?> href="<?php echo base_url().'product/browse/?cat_id='.$category_level4['id'] ?>"><?php echo $category_level4['name']; ?></a>
																												   		</h4>
																													</div>
																											   	<?php endif;?>
																											</div>
																								<?php	endforeach; ?>		
																								</div>
																								<!--~~/Level4~~--> 
																						</div>
																					</div>
																			   	<?php else :?>
																			   		<div class="panel-heading">
																				   		<h4 class="panel-title">
																				   			<?php $is_active =''; if( in_array($category_level3['id'], $breadcrumbs_ids) ) $is_active = ' class="sa_cat_active" ';  ?>	
																				   			<img height="12px" src="<?php echo base_url().'assets/templates/eshopper/images/products-list/User-Interface-Blank-icon.png' ?>" > 	
																							<a <?php echo $is_active ?> href="<?php echo base_url().'product/browse/?cat_id='.$category_level3['id'] ?>"><?php echo $category_level3['name']; ?></a>
																				   		</h4>
																					</div>
																			   	<?php endif;?>
																			</div>
																<?php	endforeach; ?>		
																</div>
																<!--~~/Level3~~-->	
															</div>
														</div>
												   	<?php else :?>
												   		<div class="panel-heading">
													   		<h4 class="panel-title">
													   			<?php $is_active =''; if( in_array($category_level2['id'], $breadcrumbs_ids) ) $is_active = ' class="sa_cat_active" ';  ?>	
													   			<img height="12px" src="<?php echo base_url().'assets/templates/eshopper/images/products-list/User-Interface-Blank-icon.png' ?>" > 	
																<a <?php echo $is_active ?> href="<?php echo base_url().'product/browse/?cat_id='.$category_level2['id'] ?>"><?php echo $category_level2['name']; ?></a>
													   		</h4>
														</div>
												   	<?php endif;?>
												</div>
									<?php	endforeach; ?>		
									</div>
									<!--~~/Level2~~-->	
								</div>
							</div>
					   	<?php else :?>
					   		<div class="panel-heading">
						   		<h4 class="panel-title">
						   			<?php $is_active =''; if( in_array($category_level1['id'], $breadcrumbs_ids) ) $is_active = ' class="sa_cat_active" ';  ?>	
						   			<img height="12px" src="<?php echo base_url().'assets/templates/eshopper/images/products-list/User-Interface-Blank-icon.png' ?>" > 	
									<a <?php echo $is_active ?> href="<?php echo base_url().'product/browse/?cat_id='.$category_level1['id'] ?>"><?php echo $category_level1['name']; ?></a>
						   		</h4>
							</div>
					   	<?php endif;?>
					</div>
		<?php	endforeach; ?>		
		</div>
		<!--~~/Level1~~-->						
				
		<hr>		
				
		<?php include "filters.php";?>
		<?php // include "price_filter.php";?>
							
	</div>
</div>