<head>
	
	<style>
		.msgbox-center
		{
		    display: inline-block;
		    position: fixed;
		    top: 0;
		    bottom: 0;
		    left: 0;
		    right: 0;
		    width: 200px;
		    height: 150px;
		    margin: auto;
		    padding: 0;
		    background-color: #f3f3f3;
		}
		
		.msg-body
		{
			text-align: center;
			/*position: absolute;*/
			top: 30%;
			transform: translateY(-50%);
			padding: 10px;
			margin-top: 5px;
		}
    
		
	</style>
</head>
<?php


$CI =& get_instance();
$CI->load->library('cleanurl');

//$CI->load->library('firebug');  // for using firebug 
//$CI->firebug->info($product_details,"product_details");

//$CI->firebug->log($meta_info,"meta-info");

//$CI->firebug->log($lists,"my_lists");
/*
$CI->firebug->warn($product_details,"product_details");
$CI->firebug->info($product_details,"product_details");
$CI->firebug->error($product_details,"product_details");
*/

/*
echo "<pre>";
var_dump($words);
echo "</pre>";
*/

/*echo "<pre>";
var_dump($breadcrumbs);
echo "</pre>";*/




/*echo "<pre>";
var_dump($product_details);
echo "</pre>";*/

//$CI->load->module("product");

$CURRENCY = "$";
$RATE = 1;



$product_main_image 	 	= $product_details->image->sizes->Best->url;
$product_main_image_zoom 	= $product_details->image->sizes->Best->url;
$product_main_image_small 	= $product_details->image->sizes->Small->url;
//$product_main_image_tub = $product_details->image->sizes->Medium->url;
$product_alt_images 		= $product_details->alternateImages;
//$product_colors 			= $product_details->colors;



$product_colors = array();
foreach($product_details->colors as $product_color)
{
	$key = $product_color->name;
	$product_colors[$key]['name'] = $key;
	if(!empty($product_color->swatchUrl))$product_colors[$key]['swatch_url'] 					  = $product_color->swatchUrl; 
	if(!empty($product_color->canonicalColors[0]->name))$product_colors[$key]['cannonical_color'] = $product_color->canonicalColors[0]->name;
	if(!empty($product_color->image))$product_colors[$key]['image'] 							  = $product_color->image->sizes->Best->url; 
}

$product_sizes = array();
foreach($product_details->sizes as $product_size)
{
	$key = $product_size->name;
	$product_sizes[$key]['name'] = $key;
	if(!empty($product_size->canonicalSize->id))$product_sizes[$key]['cannonical_id']     = $product_size->canonicalSize->id; 
	if(!empty($product_size->canonicalSize->name))$product_sizes[$key]['cannonical_name'] = $product_size->canonicalSize->name; 
}



//$CI->firebug->info($stock_matrix,"stock_matrix");

//try to sort ... but it doesn't work on mixed sizes
sort($product_sizes);

?>


<?php //include "zoom.php";?>
<div class="spacer">&nbsp; </div>
<div class="spacer">&nbsp; </div>
<section>
		
		
		<div class="container">
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
			
			<!--if is a search result-->
			
			<?php elseif(!empty($search_breadcrumbs)): ?>
				<a class="no_link" href="<?php echo base_url().'product/browse/?cat_id='.$search_breadcrumbs[1] ?>" > <?php echo($search_breadcrumbs[0]) ?> </a> >
				<a class="no_link" href="#" onClick="history.go(-1);return true;" > Back to Results </a> 
				<!--<a class="no_link" href="#" > <?php echo($search_breadcrumbs[3]) ?> </a> -->
			
			<!--if is a product from the cart-->
			
			<?php elseif(!empty($is_from_cart)): ?>
				<a class="no_link" href="#" onClick="history.go(-1);return true;" > Back To Cart </a> 
			
			<?php else: ?>
				<a class="no_link" href="#" onClick="history.go(-1);return true;" > Go Back </a> 
			<?php endif; ?>
		</span>
		
			<div class="row">
				
				<div class="col-sm-10" >
					
					<div class="product-details">
						
						<!--start left side -->
						<div class="col-sm-5"  style=" padding-left: 0px; padding-right: 0px;" >
							<div>
								<div class="single_image_container">
									<!--zoom start-->
									        <!--main image-->
									        <a id="Zoom-1" class="MagicZoom" title="<?php echo $product_details->name; ?>"  href="<?php echo $product_main_image_zoom; ?>" >
									            <img id="foo" src="<?php echo $product_main_image_zoom; ?>" alt="" style="max-height:700px !important;"  />
									        </a>
									<!--zoom finish-->
								</div>
							</div>
							<!--thumbnails start-->
							<div class="selectors col-sm-5">
							        <!--start thumbnail-->
								    <div class="ccccccccccc">
							
								        <div style="float:left;padding-top:0px;">
								            <div id="thumbnail-slider">
								                <div class="inner">
								                    <ul>
								                       		<li>
								                            	<!--<a class="thumb" href="<?php echo $alt_img->sizes->Small->url; ?>"></a>-->
								                            	<a class="thmbnail_selector"
														            data-zoom-id="Zoom-1"
														            href="<?php echo $product_main_image_zoom; ?>"
														            data-image="<?php echo $product_main_image_zoom; ?>"
														        >
														            <img srcset="<?php echo $product_main_image_small; ?>" src="<?php echo $product_main_image_zoom; ?>"/>
														        </a>
								                        	</li>
								                       
								                        <?php foreach ($product_alt_images as $alt_img) : ?>
							       							<li>
								                            	<!--<a class="thumb" href="<?php echo $alt_img->sizes->Small->url; ?>"></a>-->
								                            	<a class="thmbnail_selector"
														            data-zoom-id="Zoom-1"
														            href="<?php echo $alt_img->sizes->Best->url ?>"
														            data-image="<?php echo $alt_img->sizes->Best->url; ?>"
														        >
														            <img srcset="<?php echo $alt_img->sizes->Small->url; ?>" src="<?php echo $alt_img->sizes->Best->url; ?>"/>
														        </a>
								                        	</li>
							       						<?php endforeach; ?>
							       						
								                    </ul>
								                </div>
								            </div>
								        </div>
								        <div style="clear:both;"></div>
							
								    </div>
								    <!--end thumbnail-->
							       
							       
							       
							       <?php // foreach ($product_alt_images as $alt_img) : ?>
							       <!--<img src="<?php echo $alt_img->sizes->Best->url ?>">-->
							       
							       <!--<a class="thmbnail_selector"
							            data-zoom-id="Zoom-1"
							            href="<?php echo $alt_img->sizes->Best->url ?>"
							            data-image="<?php echo $alt_img->sizes->Best->url; ?>"
							        >
							            <img srcset="<?php echo $alt_img->sizes->Small->url; ?>" src="<?php echo $alt_img->sizes->Best->url; ?>"/>
							        </a>-->
							       <?php // endforeach; ?>
							       
							     
							</div><!--thumbnails finish-->
						</div>	<!--end left side -->
						
						<div class="col-sm-7" >
							<div class="product-information">
							 <!--product information SM 7-->
							 <div >
								 <!--//////-->
								 <h2> <?php echo $product_details->name; ?></h2>
									<p>Web ID: <?php echo $product_details->id; ?></p>
									<p> <?php echo $words['availability']; ?> : 
									<?php //$product_details->inStock = 0 ; // for testing?>
									<?php if ($product_details->inStock): ?>
										<?php echo $words['in_stock']; ?>
									<?php else: ?>
										<?php echo $words['out_of_stock']; ?>
									<?php endif; ?>
									
									</p>
									
									<div><?php echo $words['price']; ?>:
										
										<?php if(empty($product_details->salePrice)) echo $CURRENCY." ".number_format($product_details->price*$RATE , 2, '.', ',')  ; ?>
										
										<div style="display: inline">
											<?php if(!empty($product_details->salePrice)) :?>
												<div  style="display: inline;" >
													<span style="color: #f44;" > <?php  echo $CURRENCY." ".number_format($product_details->salePrice*$RATE , 2, ',', ' ') ?></span>
													<span style="color: #000000;" > <?php echo  "<strike>(".$CURRENCY." ".number_format($product_details->price*$RATE , 2, '.', ',').")</strike>" ?></span>
												</div>
											<?php endif ?>
										</div>
									</div>
								 <!--//////-->
								 <div class="spacer">&nbsp; </div>
							 	
							 </div>
							
							<?php if ($product_details->inStock): ?> 
							<div class="col-sm-12 prod_details" >
								<div class="col-sm-8 color_size" > <!--left side-->
									<div class="color_section" >
									<?php //if product has more than one color show them ?>
									<?php if(!empty($product_color->canonicalColors) /*and !empty($product_color->image)*/  and sizeof($product_color->canonicalColors) >= 1): ?>
										<span><?php echo $words['colors']; ?></span> <div id="colorname_hint" ></div>
										<div><!--colorlist-->
										 	<ul class="colorlist" >
										 		<?php foreach ($product_colors as $color): ?>
										 			 
										 			<?php if(!empty($color['swatch_url'])): // if no swatch image then use cannonical color name ?>
										 				<li class="licolorbox" > <div class="pcolorbox" id="<?php echo uniqid(); ?>" > <img title="<?php echo($color['name']); ?>" id="<?php echo sha1($color['name']); ?>" class="swatch_img" src="<?php echo $color['swatch_url']; ?>" data-image="<?php echo $color['image']; ?>" />  </div></li>
										 			<?php elseif(!empty($color['cannonical_color']) ): // use cannonical color name ?>
										 					<li class="licolorbox" > <div class="pcolorbox" id="<?php echo uniqid(); ?>" > <div title="<?php echo($color['name']); ?>" id="<?php echo sha1($color['name']); ?>" class="swatch_color_box" style="background-color: <?php echo $color['cannonical_color']; ?>" data-image="<?php if(!empty($color['image'])) echo $color['image']; ?>" >&nbsp;</div>   </div></li>
										 			<?php endif;?>
												<?php endforeach; ?>
										 		<!--
										 		<li class="licolorbox" > <div class="pcolorbox"> <img class="swatch_img" src="http://images.zoovillage.com/images/pi/10093975/Dr_Martens-1461_Z_Boots_black_11838_002_d2.jpg" />  </div></li>
										 		<li class="licolorbox" > <div class="pcolorbox"> <img class="swatch_img" src="https://images-eu.ssl-images-amazon.com/images/G/31/img15/Shoes/CatNav/p._V293117552_.jpg" /> </div></li>
										 		<li class="licolorbox" > <div class="pcolorbox"> <img class="swatch_img" src="http://www.yomister.com/image/large/iPZ8kLwDT=tBk=pDkPJxjukCku3si47uTuVDjYhh/imgshop/800-1280/shopping/pixs/16920/g/g-364brown_pic1._egoss-mens-leather-shoes-casual-g-364-brown.jpg" /> </div></li>-->
										 	</ul>
										</div>	<!--end colorlist-->
										<hr class="style4">
									<?php endif; ?>	
									</div>
									<div class="size_section" >
										
										<?php if(!empty($product_sizes)) :?>
										<span><?php echo $words['size']; ?></span>
										
										<div>
											<div ><!--sizelist-->
										 	<ul class="sizelist" >
										 		<?php foreach ($product_sizes as $product_size) : ?>
										 			<li class="lisizebox " > 
										 				<div class="psizebox" >
										 					<div  class="sizebox_single" data-sizename="<?php echo $product_size['name']; ?>" id="<?php echo sha1($product_size['name']); ?>"    >	
										 						<?php echo $product_size['name']; ?>  
										 					</div>
										 				</div>
										 			</li>
										 			<!--<div class="hint--top  hint--no-animate" aria-label="Get a simple show/hide tooltip" >hint</div>-->
										 		<?php endforeach; ?>
										 		<li class="clear" ></li>
										 		<!--<div data-ot="Shown after 2 seconds" data-ot-delay="0" data-ot-target="true">ok</div>-->
										 		
										 		<!--<li class="licolorbox" > <div class="pcolorbox_false"> 	<div class="sizebox_false" >	5.25	</div> </div></li>
										 		<li class="licolorbox" > <div class="pcolorbox"> 		<div class="sizebox_true" >	123.25	</div> </div></li>
										 		<li class="licolorbox" > <div class="pcolorbox"> 		<div class="sizebox_true" >	7N(AA)	</div> </div></li>
										 		<li class="licolorbox" > <div class="pcolorbox_false"> 	<div class="sizebox_false" >	8N(AA)	</div> </div></li>
										 		<li class="licolorbox" > <div class="pcolorbox"> 		<div class="sizebox_true" >	7N(CCC)	</div> </div></li>-->
										 	</ul>
											</div>	<!--end sizelist-->
										</div>
										
										<?php endif; ?>
										 
									</div>
								</div> <!--endleft side-->
							
								<div class="col-sm-4 qty"><!--right side-->
									<div>
										<label style="font-size: 12px;" ><?php echo $words['quantity']; ?>:</label>
										<select id="qty" style="width: auto;">
										  <option value="1">1</option>
										  <option value="2">2</option>
										  <option value="3">3</option>
										  <option value="4">4</option>
										  <option value="5">5</option>
										  <option value="6">6</option>
										</select> 
									</div> 
									<br/>
									
									<a id="add_to_cart_btn" class="btn btn-default add-to-cart" href="#">
										<i class="fa fa-shopping-cart"></i>	<?php echo $words['add_to_cart']; ?>
									</a>
									
									<?php if(isset($product_details->brand->name)) : ?>
										<span><?php echo $words['brand']; ?>: </span> <?php echo $product_details->brand->name ?>
										<?php if(isset($product_details->brand->logo->sizes->mobile->url)) : ?>
											<div style="padding-bottom: 10px;">
												<img class="brand_img" src="<?php echo $product_details->brand->logo->sizes->mobile->url; ?>"/>
											</div>
										<?php endif; ?>
									<?php endif; ?>
								</div><!--right side-->
							
							</div> 
							<?php endif ; ?>
							<!------------------------->
							
							 
							</div>
						</div>
				
					</div>
			
						<!--product details and shipping -->
						<div class="col-sm-12 tabdivs"  >
							<ul class="shop-nav-tabs shop-nav nav nav-tabs">
								<li class="active">
									<a data-toggle="tab" href="#details"> <?php echo $words['details']; ?> </a>
								</li>
								<li>
									<a data-toggle="tab" href="#shippingPolicy"> <?php echo $words['ship_policy_title']; ?> </a>
								</li>
								<li>
									<a data-toggle="tab" href="#shippingReturn"> <?php echo $words['return_title']; ?></a>
								</li>
							</ul>

							<div class="tab-content shop-tab-content">
							  
							  <!--tab1 content-->
							  <div id="details" class="tab-pane fade in active">
								
								  <strong><?php echo $product_details->brandedName ; ?></strong><br>
								  <p><?php echo $product_details->description; ?></p>
								  <div class="clear"></div>
							  </div>
							  
							  <!--tab2 content-->
							  <div id="shippingPolicy" class="tab-pane fade">
									<div id="shippingPolicy_qa1">
									  <strong class="question"><?php echo $words['ship_policy_q1']; ?> </strong><br>
									  <p class="answer"><?php echo $words['ship_policy_a1']; ?> </p>
									</div>
									
									<div id="shippingPolicy_qa2">
									  <strong class="question"><?php echo $words['ship_policy_q2']; ?> </strong><br>
									  <p class="answer"><?php echo $words['ship_policy_a2']; ?> </p>
									</div>
									
									<div id="shippingPolicy_qa3">
									  <strong class="question"><?php echo $words['ship_policy_q3']; ?> </strong><br>
									  <p class="answer"><?php echo $words['ship_policy_a3']; ?> </p>
									</div>
							  </div>
							  
							  <!--tab3 content-->
							  <div id="shippingReturn" class="tab-pane fade">
									<div id="return_qa1">
									  <strong class="question" ><?php echo $words['return_q1']; ?> </strong><br>
									  <p class="answer" ><?php echo $words['return_a1']; ?> </p>
									</div>
									
									<div id="return_qa2">
									  <strong class="question"><?php echo $words['return_q2']; ?> </strong><br>
									  <p class="answer"><?php echo $words['return_a2']; ?> </p>
									</div>
									
									<div id="return_qa3">
									  <strong class="question"><?php echo $words['return_q3']; ?> </strong><br>
									  <p class="answer"><?php echo $words['return_a3']; ?> </p>
									</div>
									
									<div id="return_qa4">
									  <strong class="question"><?php echo $words['return_q4']; ?> </strong><br>
									  <p class="answer"><?php echo $words['return_a4']; ?> </p>
									</div>
							  </div>
							  
							</div>
						</div>
						<!--end product details and shipping -->
			
				</div>
		
				<div class="col-sm-2" style="float: right;">
					<?php include "right_side.php";?>
				</div>
		
			</div>
		</div>
		
</section>
<div class="spacer">&nbsp; </div>
<div class="spacer">&nbsp; </div>
<div class="spacer">&nbsp; </div>
<div class="spacer">&nbsp; </div>

<?php include "featured_single_bottom.php";?>

<!--SFX below-->

<div id="curtain" style="position: absolute;top: 0; left: 0; width: 100%; height: 100%; background:#33323299;z-index:1;display: none " > &nbsp;</div>

<!--messagebox-->
<div id="snafsc"  class="msgbox-center"  style="z-index:5; display: none">
    <div class="col-sm-12 msg-body" > this size is not available in the selected color ,please pick another color !</div>
 
    <div class="col-sm-12 button-checkout">
		<div class="row" style="text-align: center;">
			<span id="snafsc_ok"  class="btn btn-primary" style="width: 80%;"><?php echo $words['i_understand']; ?></span>
		</div>
	</div>
    
</div>
<!-- /messagebox-->

<!--messagebox-->
<div id="msg2"  class="msgbox-center"  style="z-index:5;display: none">
    <div class="col-sm-12 msg-body" > this item is out of stock </div><br>
 
    <div class="col-sm-12 button-checkout" >
		<div class="row" style="text-align: center;">
			<span   class="btn btn-primary" style="width: 80%;	margin-top: 27px;"><?php echo $words['i_understand']; ?></span>
		</div>
	</div>
    
</div>
<!-- /messagebox-->

<!--messagebox-->
<div id="pacoas"  class="msgbox-center"  style="z-index:5;display: none">
    <div class="col-sm-12 msg-body" > <?php echo $words['pick_color_size']; ?> </div><br>
 
    <div class="col-sm-12 button-checkout" >
		<div class="row" style="text-align: center;">
			<span  id="pacoas_ok" class="btn btn-primary" style="width: 80%; margin-top: 27px;"><?php echo $words['i_understand']; ?></span>
		</div>
	</div>
    
</div>
<!-- /messagebox-->




