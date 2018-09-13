<?php 


//$this->load->helper('url');
$CI =& get_instance();
$CI->load->helper('url');
$CI->load->library('cleanurl');
$CURRENCY = "$";
$RATE = 1;
$CI->load->module("product");

/*echo "<pre>";
echo "<h2> product_vew->categories_for_menu (line14)</h2>";
print_r($categories_for_menu);
echo "</pre>";*/

//echo "<pre>";
//echo "<h2> product_vew->available_colors (line11)</h2>";
//print_r($available_colors->colorHistogram[0]);
//echo "</pre>";

//echo "<pre>";
//echo "<h2> product_vew->available_sizes (line16)</h2>";
//var_dump($available_sizes->sizeHistogram[0]);
//echo "</pre>";

//echo "<pre>";
//echo "<h2> product_vew->available_brands (line21)</h2>";
//var_dump($available_brands);
//echo "</pre>";

//echo "<pre>";
//echo "<h4> product_vew->current_url(line29)</h4>";
//echo($current_url);
//echo "</pre>";

//echo "<pre>";
//echo "<h4> product_vew->filters(line 32)</h4>";
//print_r($filters);
//echo "</pre>";

//echo "<pre>";
//echo "<h4> product_vew->price_id_values (line35)</h4>";
//var_dump($price_id_values);
//echo "</pre>";

//echo "<pre>";
//echo "<h2> product_vew->available_heelheights (line40)</h2>";
//var_dump($available_heelheights->heelHeightHistogram[0]);
//echo "</pre>";

//echo "<pre>";
//echo "<h2> product_vew->available_sales (line 45)</h2>";
//var_dump($available_sales->discountHistogram[7]);
//echo "</pre>";






//if( isset($is_search_result) ) echo "is_search_result---------->".$is_search_result." (product_vew line 9)<br>";

//if( isset($available_categories) )
//{
	//echo "<pre>";
	//echo "<h2> product_vew->available_categories (line13)</h2>";
	//var_dump($available_categories);
	//echo "</pre>";
//}


//echo "<pre>";
//echo "<h2> product_vew->available_cat_brands (line15)</h2>";
//var_dump($available_cat_brands);
//echo "</pre>";

//echo "<pre>";
//echo "<h2> product_vew->available_cat_colors (line10)</h2>";
//var_dump($available_cat_colors);
//echo "</pre>";


//echo "<pre>";
//echo "<h2> product_vew->available_cat_brands (line15)</h2>";
//var_dump($available_cat_brands);
//echo "</pre>";

//echo "<pre>";
//echo "<h2> product_vew->available_cat_sizes (line20)</h2>";
//var_dump($available_cat_sizes);
//echo "</pre>";

//echo "<pre>";
//echo "<h2> product_vew->available_cat_brands (line15)</h2>";
//var_dump($available_cat_brands);
//echo "</pre>";

//echo "<pre>";
//echo "<h2> product_vew->available_cat_sizes (line20)</h2>";
//var_dump($available_cat_sizes);
//echo "</pre>";



/*$meta_description = " ";$meta_keyworks = " ";$meta_title = " "; $viewport = " ";
foreach ($meta_info as  $minfo  )
{
	if (!is_null($minfo->description)) 	$meta_description = $minfo->description;
	if (!is_null($minfo->keywords)) 	$meta_keyworks = $minfo->keywords; 	
	if (!is_null($minfo->title)) 		$meta_title = $minfo->title ;			
	if (!is_null($minfo->viewport)) 	$viewport = $minfo->viewport ;		
}*/
?>



<!--</script>-->


	<section>
		<div class="container">
		
		<div style="height: 20px" > &nbsp; </div>
		<span id="breadcrumbs">
			<?php if(!empty($breadcrumbs)): ?>
				<?php 
				$breadcrumbs_count= sizeof($breadcrumbs);
				$i =0;
				foreach($breadcrumbs as $bcrmp):?>
					<?php if($bcrmp->id_category != 1) : //hide main category ?>
						<?php if($i < $breadcrumbs_count-1):?>
							<a class="no_link" href="<?php echo base_url().'product/browse/?cat_id='.$bcrmp->id_category ?>" > <?php echo($bcrmp->shortName) ?> </a> >
						<?php else: ?>
							<a class="no_link" href="<?php echo base_url().'product/browse/?cat_id='.$bcrmp->id_category ?>" > <?php echo($bcrmp->shortName) ?> </a> 
						<?php endif;?>
					<?php endif;?>
				<?php $i++; endforeach;?>
				<?php // echo $product_details->name; ?>
			<?php endif; ?>
		</span>
			
			<div class="row">
				
				<?php  include "cat_left_2.php"; ?>
				<div class="col-sm-9 ">
					<?php //include "banner.php";?>
					
					<section class="products-list"><!--slider-->
						<div class="row">
							<div class="col-sm-12">
								
								<?php $banner_flag = 0; ?>
								<?php $reversed_breadcrumbs = array_reverse($breadcrumbs); ?>

								<?php foreach($reversed_breadcrumbs as $bcrmp) : ?>
								
									<!--Home-->
									<?php if($bcrmp->id_category == 806 && $banner_flag ==0) :?>
										<?php $banner_flag = 1; ?>
										<img src="<?php echo base_url().'assets/templates/eshopper/banner/home/04.jpg';?>" class="girl img-responsive" alt="" />
									<?php endif; ?>
									
									<!--Kids -->
									<?php if($bcrmp->id_category == 323 && $banner_flag ==0) :?>
										<?php $banner_flag = 1; ?>
										<img src="<?php echo base_url().'assets/templates/eshopper/banner/kids/02.jpg';?>" class="girl img-responsive" alt="" />
									<?php endif; ?>
									
									<!--Men -->
									<?php if($bcrmp->id_category == 166 && $banner_flag ==0) :?>
										<?php $banner_flag = 1; ?>
										<img src="<?php echo base_url().'assets/templates/eshopper/banner/men/01.jpg';?>" class="girl img-responsive" alt="" />
									<?php endif; ?>
									
									<!--jewellery and accessories -->
									<?php if($bcrmp->id_category == 65 && $banner_flag ==0) :?>
										<?php $banner_flag = 1; ?>
										<img src="<?php echo base_url().'assets/templates/eshopper/banner/jewelery/02.jpg';?>" class="girl img-responsive" alt="" />
									<?php endif; ?>
									
									<!--Beauty-->
									<?php if(($bcrmp->id_category == "413") && ($banner_flag ==0) ) :?>
										<?php $banner_flag = 1; ?>
										<img src="<?php echo base_url().'assets/templates/eshopper/banner/jewelery/02.jpg';?>" class="girl img-responsive" alt="" />
									<?php endif; ?>
									
									<!--Shoes -->
									<?php if($bcrmp->id_category == 109 && $banner_flag ==0) :?>
										<?php $banner_flag = 1; ?>
										<img src="<?php echo base_url().'assets/templates/eshopper/banner/shoes/01.jpg';?>" class="girl img-responsive" alt="" />
									<?php endif; ?>
									
									<!--bags -->
									<?php if($bcrmp->id_category == 31 && $banner_flag ==0) :?>
										<?php $banner_flag = 1; ?>
										<img src="<?php echo base_url().'assets/templates/eshopper/banner/bags/06.jpg';?>" class="girl img-responsive" alt="" />
									<?php endif; ?>
									
									<!--Women -->
									<?php if($bcrmp->id_category == 2 && $banner_flag ==0) :?>
										<?php $banner_flag = 1; ?>
										<img src="<?php echo base_url().'assets/templates/eshopper/banner/women/07.jpg';?>" class="girl img-responsive" alt="" />
									<?php endif; ?>
									
								<?php endforeach; ?>
									
							</div>
						</div>
							
					</section>
					
					<?php //include "filters_top.php";?>
						<div class="row" id="loading" >
							<div class="col-sm-7"  style="text-align: center ; margin-top: 50px;" >
								<div> 
									<h1> <img src="<?php echo base_url().'assets/templates/eshopper/images/common/loader.gif' ?>" > </h1>   
								</div>
							</div>
						</div>
						
						<div class="row" id="sort_n_number_n_pagination" >
							<div class="col-sm-12" >
								
								<!--sort by-->
								
								<div class="col-sm-2 ">
									<form enctype="multipart/form-data" action="<?php //echo $trgt_url;?>" method="post" id="myForm">
									    <input name="per_page" type="hidden" id="key" value="val" />

									<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
																		<!--Sort by--> <?php echo $words['sort_by']; ?>
																		<span class="caret"></span>
																	</button>
																	<ul class="dropdown-menu ppp">
																		<li  ><a class="dropdown-menu-li-a" href="#" onclick="productperpage('PriceLoHi')"><!--PriceLoHi-->	<?php echo $words['price_lo_hi']; ?></a></li>
																		<li  ><a class="dropdown-menu-li-a" href="#" onclick="productperpage('PriceHiLo')"><!--PriceHiLo-->	<?php echo $words['price_hi_lo']; ?></a></li>
																		<li  ><a class="dropdown-menu-li-a" href="#" onclick="productperpage('Recency')"><!--Recency-->		<?php echo $words['recency']; ?>	</a></li>
																		<li  ><a class="dropdown-menu-li-a" href="#" onclick="productperpage('Popular')"><!--Popularity-->		<?php echo $words['popularity']; ?>	</a></li>
																		
																	</ul>
																	</form>
																	
									<script>
									    function post(numm) 
									    {
									       var key = document.getElementById("key").setAttribute('value','My  value');;
									       key=numm;
									       document.getElementById("key").value=key;
									       var key1 = document.getElementById("key").value;
									       //alert(key1);
									       document.getElementById("myForm").submit();
									    }
									</script>

									<?php 
									if(isset($is_search_result))
									{
										$trgt_url =  base_url().'product/listing/srch';
									}
									else
									{
										$trgt_url =  base_url().'product/listing/id'.$cat_id;
									}

									?>

								</div>
								
								<!--prod num-->
								
								<div class="col-sm-6 item-number">
									<div class="col-sm-12" style="text-align: center;" >
										<?php $num_of_pages = round($response->metadata->total/$response->metadata->limit);
											$curent_page = round($response->metadata->offset/$response->metadata->limit)+1;
											
											//echo  $curent_page."/".$num_of_pages." pages";
											echo  $response->metadata->total." ".$words['products'];
										?> 
									</div>
								</div>
								
								<!--pagination-->
								
								<div class="col-sm-4" >
									<div class="col-sm-3 pagination_select_style " style="padding: 0; margin: 0;" ><span style="line-height: 35px; float: right;"><?php echo $words['page'];  ?></span></div>
									<div class="col-sm-9 pagination_select_style " style="padding: 0; margin: 0;" > <?php echo $pagination;?> </div>
								</div>
								
								
							</div>
						</div>
						
						<div class="features_items" id="products_list" style="display: none;margin-top: 20px;" ><!--features_items-->
					<?php
						//$_SESSION['startTime'] = microtime();
							/*echo "<pre>";
							var_dump($products);
							echo "</pre>";*/
							
							//echo "<h2>product_vew.php (line 164)</h2>";
							//echo "<pre>";
							//print_r($response->metadata);
							//echo "</pre>";
							
							foreach ($response->products as $product) :
							//if($product_main_images[0]->actualWidth>$product_main_images[0]->actualHeight)
					$poduct_id=$product->id;
					$poduct_instock=$product->inStock;
					//$available=$CI->product->get_product_availability($poduct_id);			 
					//if($poduct_instock==1){
					?>
					
						
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<?php
												$item_url =  $product->name ;
												$item_clean_url = base_url()."product/".$CI->cleanurl->slug($item_url).'-item-'.$poduct_id.'-cat_id-'.$cat_id_url.'.html' ; ?>
						
										<a href="<?php echo($item_clean_url );?>">
											<?php  
												$product_main_images=$CI->product->get_product_images($poduct_id);
												$product_alt_images=$CI->product->get_product_alt_images($poduct_id);
												//$product_colors=$CI->product->get_product_colors($poduct_id);?>
												<?php //list($widthp, $heightp) = getimagesize($product_main_images[0]->image);
													//$wh=$CI->product->get_image_wh($product_main_images[0]->image);
													// print_r($wh);
													
													//$widthp=$wh->width;
													//$heightp=$wh->height;
													//echo($widthp);
												?>
												
												<?php //echo $product_main_images[0]->actualHeight;?>
												<?php //echo $product_main_images[0]->actualWidth;?>
												
												
												
											<div  id="loadarea<?php echo $poduct_id;?>" style="height: 250px;">
												
												<div id="image-box-prod" class="image-box1">
													
													<img id="product_main_images" name="n<?php echo $poduct_id;?>" src="<?php echo($product->image->sizes->Best->url);?>" 
													alt=""
													<?php if(!empty($product->alternateImages[0]->sizes->Best->url))
														{?>
															onmouseover="this.src='<?php echo($product->alternateImages[0]->sizes->Best->url);?>'"<?php 
														}?>
													
														onmouseout="this.src='<?php echo($product->image->sizes->Best->url);?>'"/>
													
											
												</div>
											</div>
											</a>
											<?php 
												  //$difference = microtime() - $_SESSION['startTime'];
												//echo $difference;?>
											<?php if(!empty($product->colors)){?>
											<ul class="color-thub">
											<?php $color_num=0;$color_flag=0;
												foreach ($product->colors as $color) :
												if(!empty($color->canonicalColors[0]->name)&&!empty($color->image->sizes->Best->url)){
													//if(!empty($color->canonicalColors[0]->name)&&!empty($color->swatchUrl)){
														//if(!empty($color->canonicalColors[0]->name)){
												?>
												
											<?php if($color_num<4){$color_num++;?>
											<!--<div name="colorboxalt" id="colorbox<?php echo($color->color_id);?>" class="color-filter-box-single" onclick="setcolororder('<?php echo($color->color_id);?>','<?php echo($color->image_url);?>')" onmouseover="colorphoto_list('<?php echo($color->image_url);?>','n<?php echo $poduct_id;?>')" onmouseout="orginalimage()"
   											style="background-color:<?php echo($color->canonical_name);?>;">
											</div>-->
											<li>
											<a href="<?php echo($color->image->sizes->Best->url);?>" onclick="return false;" rel="enlargeimage" rev="targetdiv:loadarea<?php echo $poduct_id;?>">
											<?php if(!empty($color->swatchUrl)){?>	
											<img src="<?php echo($color->swatchUrl);?>"/>
											<?php }elseif(!empty($color->canonicalColors[0]->name)){?>
											<div name="colorboxalt" id="colorbox<?php /* echo($color->color_id)*/ ;?>" 
												class="color-filter-box-single" 
   												style="background-color:<?php echo($color->canonicalColors[0]->name);?>;">
   												<?php }?>
											</a>
											</li>
											<?php }else{$color_flag=1;}?>
											<?php 
												}
												endforeach;?>
											<?php if($color_flag==2){?>
											<li>
											<a href="#" 
											rel="enlargeimage" rev="">
											more
											</a>
											</li>
											<?php }?>
											</ul><br/>
											<?php }?>
										<h2><br/><?php if(empty($product->salePrice)){echo $CURRENCY.number_format($product->price, 2, '.', ',');  }else{?><del style="color: #929292;font-size: 16px;"><?php echo $CURRENCY.number_format($product->price, 2, '.', ',');?></del><br/> <span class="price"><?php echo $CURRENCY.number_format($product->salePrice, 2, '.', '.');?></span><?php } ?></h2>
										<p><?php echo $product->name;?></p>
										
									</div>
									
								</div>
								
							</div>
						</div>
					    
					    
						<?php 
							//}
							endforeach;
							?>
							
							
								<div class="col-sm-12" id="pagination_footer" >
									
									<!--stump-->
									
									<div class="col-sm-7 "> &nbsp;</div>
									
									<!--pagination-->
									
									<div class="col-sm-5" >
										<div class="col-sm-4 pagination_select_style " style="padding: 0; margin: 0;" ><span style="line-height: 35px; float: right;"><?php echo $words['page'];  ?></span></div>
										<div class="col-sm-8 pagination_select_style " style="padding: 0; margin: 0;" > <?php echo $pagination;?> </div>
									</div>
									
									
								</div>
							
							
							<div class="row" > <div class="col-sm-12" style="height: 150px;" > &nbsp; </div> </div>
					
					</div>						
				
						
					</div>
				</div>
					
			</div>
		</section>
	
	