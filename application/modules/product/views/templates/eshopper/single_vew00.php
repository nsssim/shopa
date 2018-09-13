<?php


$CI =& get_instance();
$CI->load->library('cleanurl');

$CI->load->library('firebug');  // for using firebug 
$CI->firebug->info($product_details,"product_details");

$CI->firebug->log($lists,"my_lists");
/*
$CI->firebug->log($product_details,"product_details");
$CI->firebug->info($product_details,"product_details");
$CI->firebug->warn($product_details,"product_details");
$CI->firebug->error($product_details,"product_details");
*/

/*
echo "<pre>";
var_dump($words);
echo "</pre>";
*/
//blah

//echo "<pre>";
//var_dump($product_details);
//echo "</pre>";

$CI->load->module("product");

$CURRENCY = "$";
$RATE = 1;



$product_main_image = $product_details->image->sizes->XLarge->url;
$product_main_image_zoom = $product_details->image->sizes->Best->url;
$product_main_image_tub = $product_details->image->sizes->Medium->url;
$product_alt_images = $product_details->alternateImages;


?>


<?php //include "zoom.php";?>
<section>
		<div class="container">
			<div class="row">
				
				<div class="col-sm-10">
					<div class="black-single-text">
						THIS ITEM IS ELIGIBLE TOWARD OUR BUY MORE,SAVE MORE OFFERS 
					</div>
					<div class="product-details">
						<div class="col-sm-4" style=" padding-left: 0px; padding-right: 0px; ">
							
							<!--<div  id="loadarea" class="view-product1" >-->
								<!--<img  id="image2" mouseover="" src="<?php echo($product_main_image); ?>" class="thumbnail-single-test" /> -->
								<?php include "zoom.php";?>
							<!--</div>	-->						
						</div>
						<div class="col-sm-8">
							<div class="product-information">
								<h2> <?php echo $product_details->name; ?></h2>
								<p>Web ID: <?php echo $product_details->id; ?></p>
								<p>Price:
									<?php //$saleprice =  $product_details->salePrice  ; ?>
									
									
									<?php if(empty($product_details->salePrice)) echo $CURRENCY." ".number_format($product_details->price*$RATE , 2, '.', ',')  ; ?>
									
									<?php if(!empty($product_details->salePrice)) :?>
										
								</p>
								<div>
									<span style="color: #f44;" > <?php  echo $CURRENCY." ".number_format($product_details->salePrice*$RATE , 2, ',', ' ') ?></span>
										
									<span> <?php echo  "<strike>(".$CURRENCY." ".number_format($product_details->price*$RATE , 2, '.', ',').")</strike>" ?></span>
								</div>
									<?php endif ?>
									
									<div class="prod-tab col-sm-12" style=" padding-left: 0px; padding-right: 0px; ">
									<div class="col-sm-8" style=" padding-left: 12px; padding-top: 7px; ">
																	
																		<?php 
								if( (!empty($product_details->colors)) && (count($product_details->colors) >1 )  )  :?>
									
									
										<span id="color_flag">Colors:</span><br/>
										
									<?php $tempcolornametester[0]="tempcolornametester";
										foreach ($product_details->colors as $pcolor): ?>
									
									<span>
								<?php if(empty($pcolor->swatchUrl)){
									
									if(!in_array($pcolor->canonicalColors[0]->name, $tempcolornametester)){
										array_push($tempcolornametester,$pcolor->canonicalColors[0]->name);
										
								?>	
									<div name="colorboxalt" id="colorbox<?php echo($pcolor->canonicalColors[0]->id);?>" class="color-filter-box-single" 
										onclick="setcolororder('<?php echo($pcolor->canonicalColors[0]->id);?>','<?php if(!empty($pcolor->image->sizes->Best))echo($pcolor->image->sizes->Best->url);?>')" onmouseover="colorphoto('<?php if(!empty($pcolor->image->sizes->Best))echo($pcolor->image->sizes->Best->url);?>')" onmouseout="orginalimage()"
											
   style="background-color:<?php echo($pcolor->canonicalColors[0]->name);?>;">
	   
									</div><?php }}else{?>
								<img name="colorboxalt" id="colorbox<?php if(!empty($pcolor->image->id)){echo($pcolor->image->id);}else{
									echo($pcolor->canonicalColors[0]->id);
								}?>" class="color-filter-box-single"
								<?php if(!empty($pcolor->image->id)){?> onclick="setcolororder('<?php echo($pcolor->image->id);?>','<?php echo($pcolor->image->sizes->Best->url);?>')" onmouseover="colorphoto('<?php echo($pcolor->image->sizes->Best->url);?>')" onmouseout="orginalimage()" <?php }
									else{?>onclick="setcolororder('<?php echo($pcolor->canonicalColors[0]->id);?>','')"<?php }
								?>
								 src="<?php echo $pcolor->swatchUrl;?>"/>	
								<?php }?>	
									</span>
									<?php endforeach; ?>
										
									<hr class="style4">
								<?php endif; ?>
									
			<?php if(!empty($product_details->sizes[0]->canonicalSize->name)): ?>
										<span id="size_flag">Size:</span> <br/>
											<?php 
												$tempsizenametester[0]="tempsizenametester";
												foreach($product_details->sizes as $size) :?>
											<?php if(!empty($size->canonicalSize->name)){ 
												if(!in_array($size->canonicalSize->name, $tempsizenametester)){
										array_push($tempsizenametester,$size->canonicalSize->name);
												
											?>
<span id="size-box<?php echo($size->canonicalSize->name);?>" class="size-box" onclick="setsizeorder('<?php echo($size->canonicalSize->name);?>')" name="size-box">
													
													<?php echo $size->canonicalSize->name; ?>
												</span>
												<?php }}?>
											<?php endforeach; ?>
										<hr class="style4">
									<?php endif ?>
									
									
									</div>
							<div class="col-sm-4">
								<br/>
									<label>Quantity:</label>
									<input id="qty" type="text" value="1" style="width:20px;"/>
									<input id="color_id" type="hidden"  />
									<input id="size_id" type="hidden"  />
									<?php //if($product_inStock) :
										if(11==11):
									?> 
									<br/>
									<!--<button class="btn btn-default add-to-cart" id="<?php echo $product_details->id ;?> " style="margin-left:0px; " type="button" name="add-to-cart" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</button>-->
		<a id="add_to_cart_btn" href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i> <?php echo $words["add_to_cart"]; ?> </a>
									<?php endif;?> 
								</span>
								
								
								<?php if($product_details->inStock==1) :?> 
								<p><b>Availability:</b> <?php echo "In Stock"; ?> </p>
								<?php else : ?>
								<p><b>Availability:</b> <?php echo "Out Of Stock"; ?> </p>
								<?php endif; ?>
								
								<!--<p><b>Condition:</b> New</p>-->
								
								<?php if(isset($product_details->brand->name)) : ?>
								<p><b>Brand: </b><?php echo $product_details->brand->name ?>
									<?php if(isset($product_details->brand->logo->sizes->mobile->url)) : ?>
										<div style="padding-bottom: 10px;"><img src="<?php echo $product_details->brand->logo->sizes->mobile->url; ?>"/> </div>
									<?php endif; ?>
								<?php endif; ?>
							</div>

						</div>
					</div>
					
				</div>
				
			</div>
			
			<!--product info -->
			<div class="col-sm-12">
				<ul class="shop-nav-tabs shop-nav nav nav-tabs">
					<li class="active">
						<a data-toggle="tab" href="#details">DETAILS</a>
					</li>
					<li>
						<a data-toggle="tab" href="#shippingReturn">SHIPPING INFORMATION</a>
					</li>
				</ul>

				<div class="tab-content shop-tab-content">
				  <div id="details" class="tab-pane fade in active">
					<div id="pdp_tabs_body_left">
						<div class="pdp_longDescription">
							The modern minimalist's dream: these simplified platform sandals in soft leather by Eileen Fisher that flaunt a sporty edge.
						</div>
						<ul>
							<li id="productDetailsBulletText">Available in full and half sizes</li>
							<li id="productDetailsBulletText">Open toe; VELCRO® strap closure </li>
							<li id="productDetailsBulletText">2" heel, 1" platform, feels like 1" heel </li>
							<li id="productDetailsBulletText">Leather upper, leather lining, rubber sole</li>
							<li id="productDetailsBulletText">Imported</li>
							<li id="productWebID">Web ID: 1634940</li>
						</ul>
					</div>
					<div class="clear"></div>
				  </div>
				  <div id="shippingReturn" class="tab-pane fade">
					<p>SHIPPING INFORMATION</p>
				  </div>
				</div>
			</div>
		
		<!--end product info -->
			
		</div>
		
		
		
		<div class="col-sm-2" style="float: right;">
			<?php include "right_side.php";?>
		</div>
		
	</div>
		
		
</section>
<?php include "featured_single_bottom.php";?>
<pre>
<?php
//print_r($product_alt_images);
?>
</pre>


