<style>
/*.active_cat{
	border: 2px solid #807c7c;
	border-radius: 7px;    
	box-shadow: 3px 3px #dcd7d7;
}*/

.active_cat a
{
	text-decoration: underline;
    color: red !important;
}


.active_cat #cat_2
{
	text-decoration: underline;
    color: red !important;
}

.active_cat #cat_166
{
	text-decoration: underline;
    color: red !important;
}

.active_cat #cat_323
{
	text-decoration: underline;
    color: red !important;
}

.active_cat #cat_806
{
	text-decoration: underline;
    color: red !important;
}

.plus{
	cursor: pointer;
}

.minus{
	cursor: pointer;
}

.subcat_flag_on{
	display: block;
}

.subcat_flag_off{
	display: none;
}
.show_inline
{
 	display: inline;	
}
.hide_inline{
	display: none;
}

.main_cat{
	cursor: pointer;
}

	
</style>

<!--<?php echo $subcat_flag; ?>-->



<?php
if( isset($is_search_result) )echo "is_search_result---------->".$is_search_result." (cat_left line 2)<br>";
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
								
		<div class="panel-group category-products " id="accordian">
			
			<div class="brand-cat-panel">
			<div class="panel panel-default ">
				
				<div class="brand-cat ">
					<div  >
											<h1>
												Categories 
											</h1>
											
										</div>
										
										<!--Women-->
										<hr/>
										
										<!--<div <?php if(($category_id == 1)||($category_id == 2)) echo 'class = "active_cat"'; ?>   >
											<h4  >
												<img src='<?php echo base_url()."assets/templates/eshopper/images/brands/women.jpg"?>' />
												<span class="plus" id="plus_2" >[+]</span>
												<span class="minus" id="minus_2" >[-]</span>
												<a href='<?php echo base_url()."brands/brands_list/2"; ?>'>
													
													<?php echo $words['women']; ?> >
												</a>
											</h4>
										</div>-->
										
										
										
										
										<!--////////women//////////-->
										<?php ($subcat_flag == 2)?  $subcat_flag_class = "subcat_flag_on" : $subcat_flag_class = "subcat_flag_off" ; ?>
										<?php ($subcat_flag == 2)?  $sign_class_minus = "show_inline" : $sign_class_minus = "hide_inline"; ?>
										<?php ($subcat_flag == 2)?  $sign_class_plus = "hide_inline" : $sign_class_plus = "show_inline"; ?>
										
										<div  <?php if(($category_id == 2) or ($category_id == 1)) echo 'class = "active_cat"'; ?> >
											<h4  >
												<a style="text-decoration: none; padding: 0" title="<?php echo $words['see_all']; ?>" href='<?php echo base_url()."brands/brands_list/2"; ?>'>
													<img style="padding: 0" src='<?php echo $categories_icons[2];?>'/>
												</a>
												
												<span class="plus <?php echo $sign_class_plus ?>" id="plus_2" >[+]</span>
												<span class="minus <?php echo $sign_class_minus ?>" id="minus_2" >[-]</span>
												<!--<a href='<?php echo base_url()."brands/brands_list/2"; ?>'>
													
													<?php echo $words['women']; ?>
												</a>-->
												<span class="main_cat" id="cat_2" > <?php echo $words['women']; ?> </span>
											</h4>
											
										</div>
										<hr/>
										
										<div class="sub_cat <?php echo $subcat_flag_class ?> " id="sub_2" style="margin-left: 30px;"  >
											<div <?php if(($category_id == 31)) echo 'class = "active_cat"'; ?>   >
											<h4>
												<img src='<?php echo $categories_icons[31];?>'/>
												<a   href='<?php echo base_url()."brands/brands_list/31"; ?>'>
													
													<?php echo $words_cat['bags']; ?> <!--Bags-->
												</a>
											</h4>
											</div>
											
											<hr/>
											
											<div <?php if(($category_id == 413)) echo 'class = "active_cat"'; ?>   >
											<h4>
												<img src='<?php echo $categories_icons[413];?>'/>
												<a   href='<?php echo base_url()."brands/brands_list/413"; ?>'>
													
													<?php echo $words_cat['beauty']; ?> <!--Beauty-->
												</a>
											</h4>
											</div>
											<hr/>
											
											<div <?php if(($category_id == 544)) echo 'class = "active_cat"'; ?>   >
											<h4>
												<img src='<?php echo $categories_icons[544];?>'/>
												<a   href='<?php echo base_url()."brands/brands_list/544"; ?>'>
													
													<?php echo $words_cat['clothing']; ?> <!--Clothing-->
												</a>
											</h4>
											</div>
											<hr/>
											
											<div <?php if(($category_id == 109)) echo 'class = "active_cat"'; ?>   >
											<h4>
												<img src='<?php echo $categories_icons[109];?>'/>
												<a   href='<?php echo base_url()."brands/brands_list/109"; ?>'>
													
													<?php echo $words_cat['shoes']; ?> <!--Shoes-->
												</a>
											</h4>
											</div>
											<hr/>
											
										</div>
										<!--////////end women//////////-->
										
										
										<!--////////men//////////-->
										<?php ($subcat_flag == 166)?  $subcat_flag_class = "subcat_flag_on" : $subcat_flag_class = "subcat_flag_off" ; ?>
										<?php ($subcat_flag == 166)?  $sign_class_minus = "show_inline" : $sign_class_minus = "hide_inline"; ?>
										<?php ($subcat_flag == 166)?  $sign_class_plus = "hide_inline" : $sign_class_plus = "show_inline"; ?>
										
										<div  <?php if(($category_id == 166)) echo 'class = "active_cat"'; ?> >
											<h4  >
												<a style="text-decoration: none; padding: 0" title="<?php echo $words['see_all']; ?>" href='<?php echo base_url()."brands/brands_list/166"; ?>'>
													<img style="padding: 0" src='<?php echo $categories_icons[166];?>'/>
												</a>
												<span class="plus <?php echo $sign_class_plus ?>" id="plus_166" >[+]</span>
												<span class="minus <?php echo $sign_class_minus ?>" id="minus_166" >[-]</span>
												<!--<a   href='<?php echo base_url()."brands/brands_list/166"; ?>'>
													
													<?php echo $words['men']; ?>
												</a>-->
												<span class="main_cat" id="cat_166" > <?php echo $words['men']; ?> </span>
											</h4>
											
										</div>
										<hr/>
										
										<div class="sub_cat <?php echo $subcat_flag_class ?> " id="sub_166" style="margin-left: 30px;"  >
											<div <?php if(($category_id == 168)) echo 'class = "active_cat"'; ?>   >
											<h4>
												<img src='<?php echo $categories_icons[168];?>'/>
												<a   href='<?php echo base_url()."brands/brands_list/168"; ?>'>
													
													<?php echo $words_cat['bags']; ?> <!--Bags-->
												</a>
											</h4>
											</div>
											
											<hr/>
											
											<div <?php if(($category_id == 1741)) echo 'class = "active_cat"'; ?>   >
											<h4>
												<img src='<?php echo $categories_icons[1741];?>'/>
												<a   href='<?php echo base_url()."brands/brands_list/1741"; ?>'>
													
													<?php echo $words_cat['clothing']; ?> <!--Clothing-->
												</a>
											</h4>
											</div>
											<hr/>
											
											<div <?php if(($category_id == 172)) echo 'class = "active_cat"'; ?>   >
											<h4>
												<img src='<?php echo $categories_icons[172];?>'/>
												<a   href='<?php echo base_url()."brands/brands_list/172"; ?>'>
													
													<?php echo $words_cat['grooming']; ?> <!--Grooming-->
												</a>
											</h4>
											</div>
											<hr/>
											
											<div <?php if(($category_id == 219)) echo 'class = "active_cat"'; ?>   >
											<h4>
												<img src='<?php echo $categories_icons[219];?>'/>
												<a   href='<?php echo base_url()."brands/brands_list/219"; ?>'>
													
													<?php echo $words_cat['shoes']; ?> <!--Shoes-->
												</a>
											</h4>
											</div>
											<hr/>
											
										</div>
										<!--////////end men//////////-->
										
										
										
										<!--////////Kids//////////-->
										<?php ($subcat_flag == 323)?  $subcat_flag_class = "subcat_flag_on" : $subcat_flag_class = "subcat_flag_off" ; ?>
										<?php ($subcat_flag == 323)?  $sign_class_minus = "show_inline" : $sign_class_minus = "hide_inline"; ?>
										<?php ($subcat_flag == 323)?  $sign_class_plus = "hide_inline" : $sign_class_plus = "show_inline"; ?>
										
										<div  <?php if(($category_id == 323)) echo 'class = "active_cat"'; ?> >
											<h4  >
												<a style="text-decoration: none; padding: 0" title="<?php echo $words['see_all']; ?>" href='<?php echo base_url()."brands/brands_list/323"; ?>'>
													<img style="padding: 0" src='<?php echo $categories_icons[323];?>'/>
												</a>
												<span class="plus <?php echo $sign_class_plus ?>" id="plus_323" >[+]</span>
												<span class="minus <?php echo $sign_class_minus ?>" id="minus_323" >[-]</span>
												<!--<a   href='<?php echo base_url()."brands/brands_list/323"; ?>'>
													
													<?php echo $words['kids']; ?>
												</a>-->
												<span class="main_cat" id="cat_323" > <?php echo $words['kids']; ?> </span>
											</h4>
											
										</div>
										<hr/>
										
										<div class="sub_cat <?php echo $subcat_flag_class ?> " id="sub_323" style="margin-left: 30px;"  >
											<div <?php if(($category_id == 1037)) echo 'class = "active_cat"'; ?>   >
											<h4>
												<img src='<?php echo $categories_icons[1037];?>'/>
												<a   href='<?php echo base_url()."brands/brands_list/1037"; ?>'>
													
													<?php echo $words_cat['baby_gear']; ?> <!--Baby gear-->
												</a>
											</h4>
											</div>
											
											<hr/>
											
											<div <?php if(($category_id == 839)) echo 'class = "active_cat"'; ?>   >
											<h4>
												<img src='<?php echo $categories_icons[839];?>'/>
												<a   href='<?php echo base_url()."brands/brands_list/839"; ?>'>
													
													<?php echo $words_cat['bath']; ?> <!--Bath-->
												</a>
											</h4>
											</div>
											<hr/>
											
											<div <?php if(($category_id == 1699)) echo 'class = "active_cat"'; ?>   >
											<h4>
												<img src='<?php echo $categories_icons[1699];?>'/>
												<a   href='<?php echo base_url()."brands/brands_list/1699"; ?>'>
													
													<?php echo $words_cat['bedroom']; ?> <!--Bedroom-->
												</a>
											</h4>
											</div>
											<hr/>
											
											<div <?php if(($category_id == 1099)) echo 'class = "active_cat"'; ?>   >
											<h4>
												<img src='<?php echo $categories_icons[1099];?>'/>
												<a   href='<?php echo base_url()."brands/brands_list/1099"; ?>'>
													
													<?php echo $words_cat['clothing']; ?> <!--Clothing-->
												</a>
											</h4>
											</div>
											<hr/>
											
											<div <?php if(($category_id == 1122)) echo 'class = "active_cat"'; ?>   >
											<h4>
												<img src='<?php echo $categories_icons[1122];?>'/>
												<a   href='<?php echo base_url()."brands/brands_list/1122"; ?>'>
													
													<?php echo $words_cat['nursery']; ?> <!--Nursery-->
												</a>
											</h4>
											</div>
											<hr/>
											
											<div <?php if(($category_id == 1135)) echo 'class = "active_cat"'; ?>   >
											<h4>
												<img src='<?php echo $categories_icons[1135];?>'/>
												<a   href='<?php echo base_url()."brands/brands_list/1135"; ?>'>
													
													<?php echo $words_cat['toys']; ?> <!--Toys-->
												</a>
											</h4>
											</div>
											<hr/>
										</div>
										<!--////////end Kids//////////-->
										
										<!--////////home//////////-->
										<?php ($subcat_flag == 806)?  $subcat_flag_class = "subcat_flag_on" : $subcat_flag_class = "subcat_flag_off" ; ?>
										<?php ($subcat_flag == 806)?  $sign_class_minus = "show_inline" : $sign_class_minus = "hide_inline"; ?>
										<?php ($subcat_flag == 806)?  $sign_class_plus = "hide_inline" : $sign_class_plus = "show_inline"; ?>
										
										<div  <?php if(($category_id == 806)) echo 'class = "active_cat"'; ?> >
											<h4  >
												<a style="text-decoration: none; padding: 0" title="<?php echo $words['see_all']; ?>" href='<?php echo base_url()."brands/brands_list/806"; ?>'>
													<img style="padding: 0" src='<?php echo $categories_icons[806];?>'/>
												</a>
												<span class="plus <?php echo $sign_class_plus ?>" id="plus_806" >[+]</span>
												<span class="minus <?php echo $sign_class_minus ?>" id="minus_806" >[-]</span>
												<!--<a   href='<?php echo base_url()."brands/brands_list/806"; ?>'>
													
													<?php echo $words['home']; ?>
												</a>-->
												<span class="main_cat" id="cat_806" > <?php echo $words['home']; ?> </span>
											</h4>
											
										</div>
										<hr/>
										
										<div class="sub_cat <?php echo $subcat_flag_class ?> " id="sub_806" style="margin-left: 30px;"  >
											<div <?php if(($category_id == 837)) echo 'class = "active_cat"'; ?>   >
											<h4>
												<img src='<?php echo $categories_icons[837];?>'/>
												<a   href='<?php echo base_url()."brands/brands_list/837"; ?>'>
													
													<?php echo $words_cat['bath']; ?> <!--Bath-->
												</a>
											</h4>
											</div>
											
											<hr/>
											
											<div <?php if(($category_id == 838)) echo 'class = "active_cat"'; ?>   >
											<h4>
												<img src='<?php echo $categories_icons[838];?>'/>
												<a   href='<?php echo base_url()."brands/brands_list/838"; ?>'>
													
													<?php echo $words_cat['bedding']; ?> <!--Bedding-->
												</a>
											</h4>
											</div>
											<hr/>
											
											<div <?php if(($category_id == 805)) echo 'class = "active_cat"'; ?>   >
											<h4>
												<img src='<?php echo $categories_icons[805];?>'/>
												<a   href='<?php echo base_url()."brands/brands_list/805"; ?>'>
													
													<?php echo $words_cat['decor']; ?> <!--Decor-->
												</a>
											</h4>
											</div>
											<hr/>
											
											<div <?php if(($category_id == 621)) echo 'class = "active_cat"'; ?>   >
											<h4>
												<img src='<?php echo $categories_icons[621];?>'/>
												<a   href='<?php echo base_url()."brands/brands_list/621"; ?>'>
													
													<?php echo $words_cat['furniture']; ?> <!--Furniture-->
												</a>
											</h4>
											</div>
											<hr/>
											
											<div <?php if(($category_id == 736)) echo 'class = "active_cat"'; ?>   >
											<h4>
												<img src='<?php echo $categories_icons[736];?>'/>
												<a   href='<?php echo base_url()."brands/brands_list/736"; ?>'>
													
													<?php echo $words_cat['kitchen']; ?> <!--Kitchen-->
												</a>
											</h4>
											</div>
											<hr/>
											
											<div <?php if(($category_id == 746)) echo 'class = "active_cat"'; ?>   >
											<h4>
												<img src='<?php echo $categories_icons[746];?>'/>
												<a   href='<?php echo base_url()."brands/brands_list/746"; ?>'>
													
													<?php echo $words_cat['lighting']; ?> <!--Lighting-->
												</a>
											</h4>
											</div>
											<hr/>
											
											<div <?php if(($category_id == 1237)) echo 'class = "active_cat"'; ?>   >
											<h4>
												<img src='<?php echo $categories_icons[1237];?>'/>
												<a   href='<?php echo base_url()."brands/brands_list/1237"; ?>'>
													
													<?php echo $words_cat['luggage']; ?> <!--Luggage-->
												</a>
											</h4>
											</div>
											<hr/>
											
											<div <?php if(($category_id == 760)) echo 'class = "active_cat"'; ?>   >
											<h4>
												<img src='<?php echo $categories_icons[760];?>'/>
												<a   href='<?php echo base_url()."brands/brands_list/760"; ?>'>
													
													<?php echo $words_cat['rugs']; ?> <!--Rugs-->
												</a>
											</h4>
											</div>
											<hr/>
											
											<div <?php if(($category_id == 673)) echo 'class = "active_cat"'; ?>   >
											<h4>
												<img src='<?php echo $categories_icons[673];?>'/>
												<a   href='<?php echo base_url()."brands/brands_list/673"; ?>'>
													
													<?php echo $words_cat['tabletop']; ?> <!--Tabletop-->
												</a>
											</h4>
											</div>
											<hr/>
											
											
											
										</div>
										<!--////////end home//////////-->
										
										
										<div >
											
											
										</div>
										<hr/>
										
										
										
										

			
										
										
										
										
										
				</div>
																	</div>
			</div>
									
		
		</div>
		<?php //include "price_filter.php";?>
					
					</div>
				</div>
						
						
						
						
						
						
						
						
						
						
						
						