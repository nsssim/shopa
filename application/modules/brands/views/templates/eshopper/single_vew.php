<!DOCTYPE html>
<html lang="en">
<head>
<?php  $this->load->helper('url'); 
	
	$CI =& get_instance();
	$CI->load->library('cleanurl');
	$CI->load->module("product");
?>
<?php 

$CURRENCY = "$";
$RATE = 1;
?>

</head>

<body>

<section>
		<div class="container">
		<div class="row">
			<div class="col-sm-12 home-text">
				<h4>Sign up for savings  <small>Get exclusive emails <span style="color:#f00">coupons</span> and <span style="color:#f00">deals</span> and much more</small></h4>
			</div>
		</div>
		</div>
	</section>	

<? $product_cat_id=$CI->categories->get_product_category_id($product_details[0]->id);?>



	<section>
		<div class="container">
			<div class="row">
				
				<div class="col-sm-10" style=" padding-left: 0px; padding-right: 0px; ">
					<div class="black-single-text">
						THIS ITEM IS ELIGIBLE TOWARD OUR BUY MORE,SAVE MORE OFFERS 
					</div>
					<div class="product-details"><!--product-details-->
						<div class="col-sm-4" style=" padding-left: 0px; padding-right: 0px; ">
							
							<div id="loadarea" <?php if(($product_img[0]->actualWidth<$product_img[0]->actualHeight)){?>
													class="view-product1"<?php }else{ ?>class="view-product2"<?php }?> >
								<img  id="image2" mouseover="alert(1)" src="<?php echo($product_img[0]->image); ?>" alt="" onmouseover="" /> 
								
	
							</div>
						    <?php $len = count($product_alt_img);?>
							<?php if ($len > 1 ) :?> 
							<div id="similar-product" class="carousel slide" data-ride="">
								
								  <!-- Wrapper for slides -->
								    <div class="carousel-inner">
								    
										<?php $j = 0 ; // will increment by 3  when  $i = 3K ?> 
										<?php  for($i = 0; $i< $len ; $i++) : ?> 
										    
										    <?php if ($i == 0 ) :?> 
										     <!--1st triplet-->
										     <div class="item active">
											    <span class="thub hvr-grow-shadow"> 
											    <span  onclick="setthumorder('<?php echo $product_alt_img[$i]->alt_image_original; ?>')" onmouseover="thubover('<?php echo $product_alt_img[$i]->alt_image_original; ?>')" onmouseout="orginalimage()">
											    <img  src="<?php echo $product_alt_img[$i]->alt_image_medium; ?>"  />
											    </span></span>
											     
											     <?php if (isset($product_alt_img[$i+1]->alt_image_medium)) :?> 
											      <span class="thub hvr-grow-shadow">	
											      <span onclick="setthumorder('<?php echo $product_alt_img[$i+1]->alt_image_original; ?>')" onmouseover="thubover('<?php echo $product_alt_img[$i+1]->alt_image_original; ?>')" onmouseout="orginalimage()">
<img  src="<?php echo $product_alt_img[$i+1]->alt_image_medium; ?>"  alt=""  /></span>
</span>
										         <?php endif ?>
										         
										         <?php if (isset($product_alt_img[$i+2]->alt_image_medium)) :?> 
											      <span class="thub hvr-grow-shadow">	
											       <span onclick="setthumorder('<?php echo $product_alt_img[$i+2]->alt_image_original; ?>')"
											        onmouseover="thubover('<?php echo $product_alt_img[$i+2]->alt_image_original; ?>')" onmouseout="orginalimage()">
											      <img  src="<?php echo $product_alt_img[$i+2]->alt_image_medium; ?>"  alt="" /> </span></span>
										         <?php endif ?>
										     </div>
										    <?php $j = $j+3 ?>
										    <?php endif ?>
										    <div id="loadarea2"></div>
										    
										    <?php if ($i == $j && $i!=0 ) :?> 
										     <!--next triplet-->
										     <div class="item">
											   <span class="thub hvr-grow-shadow"> 
											    <a class="group1"  href="<?php echo $product_alt_img[$i]->alt_image_original;  ?>">
												    <img  src="<?php echo $product_alt_img[$i]->alt_image_medium; ?>"  alt="" />
												     </a>
											     </span>
											     <?php if (isset($product_alt_img[$i+1]->alt_image_medium)) :?> 
											     	 <span class="thub hvr-grow-shadow"><a class="group1"  href="<?php echo $product_alt_img[$i+1]->alt_image_original;  ?>"><img  src="<?php echo $product_alt_img[$i+1]->alt_image_medium; ?>"  alt=""  /> </a></span>
										         <?php endif ?>
										         
										         <?php if (isset($product_alt_img[$i+2]->alt_image_medium)) :?> 
											     	 <span class="thub hvr-grow-shadow">
											     	 <a class="group1"  href="<?php echo $product_alt_img[$i+2]->alt_image_original;  ?>">
												     	 <img  src="<?php echo $product_alt_img[$i+2]->alt_image_medium; ?>"  alt="" /> 
												     	 </a>
												     	 </span>
										         <?php endif ?>
										     </div>
										    <?php $j = $j+3 ?>
										    <?php endif ?>
										    
										<?php endfor ?>
										
									</div>

								   <?php if(1==2){?>
									  <!-- Controls 
									  <a class="left item-control" href="#similar-product" data-slide="prev">
										<i class="fa fa-angle-left"></i>
									  </a>
									  <a class="right item-control" href="#similar-product" data-slide="next">
										<i class="fa fa-angle-right"></i>
									  </a>
								  <?php }?>
							</div>
							<?php endif ?>

						</div>
						<div class="col-sm-8">
							<div class="product-information"><!--/product-information-->
							<?php if($product_details[0]->salePrice!=0){?><h4 class="">On Sale</h4><?php }?>
								
								<h2> <?php echo $product_details[0]->name; ?> </h2>
								<p>Web ID: <?php echo $product_details[0]->idd; ?></p>
								
								<p>Price:
									 <?php $saleprice =  $product_details[0]->salePrice  ; ?>
									
									
									<?php if(!$saleprice) echo $CURRENCY." ".number_format($product_details[0]->price*$RATE , 2, '.', ',')  ; ?>
									
									<?php if($saleprice) :?></p>
									<div>
									 	<span style="color: #f44;" > <?php  echo $CURRENCY." ".number_format($product_details[0]->salePrice*$RATE , 2, ',', ' ') ?></span>
										
										<span> <?php echo  "<strike>(".$CURRENCY." ".number_format($product_details[0]->price*$RATE , 2, '.', ',').")</strike>" ?></span>
									</div>
									<?php endif ?>
									<div class="prod-tab col-sm-12" style=" padding-left: 0px; padding-right: 0px; ">
									<div class="col-sm-8" style=" padding-left: 12px; padding-top: 7px; ">
																		<?php 
								if( (!empty($product_colors[0])) && (count($product_colors) >1 )  )  :?>
									
									
										<span>Colors:</span><br/>
										
									<?php foreach ($product_colors as $pcolor): ?>
									<!--<span >-->
									
									<div name="colorboxalt" id="colorbox<?php echo($pcolor->color_id);?>" class="color-filter-box-single" onclick="setcolororder('<?php echo($pcolor->color_id);?>','<?php echo($pcolor->image_url);?>')" onmouseover="colorphoto('<?php echo($pcolor->image_url);?>')" onmouseout="orginalimage()"
   style="background-color:<?php echo($pcolor->canonical_name);?>;">
									</div>
										
									<!--</span>-->
									<?php endforeach; ?>
										
									<hr class="style4">
								<?php endif; ?>
								<?php if($product_sizes): ?>
										<span>Size:</span> <br/>
											<?php foreach($product_sizes as $size) :?>
											
												<span id="size-box<?php echo($size->size_id);?>" class="size-box" onclick="setsizeorder('<?php echo($size->size_id);?>')" name="size-box">
													
													<?php echo $size->cannonical_size_name; ?>
												</span>
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
									<?php if($product_inStock) :?> 
									<br/>
									<button class="btn btn-default add-to-cart" id="<?php echo $product_details[0]->id ;?> " style="margin-left:0px; " type="button" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</button>
									<?php endif;?> 
								</span>
								
								
								<?php if($product_inStock) :?> 
								<p><b>Availability:</b> <?php echo "In Stock"; ?> </p>
								<?php else : ?>
								<p><b>Availability:</b> <?php echo "Out Of Stock"; ?> </p>
								<?php endif; ?>
								
								<!--<p><b>Condition:</b> New</p>-->
								
								<?php if(isset($product_brand[0]->brand_name)) : ?>
								<p><b>Brand: </b><?php echo $product_brand[0]->brand_name; ?>
									<?php if(isset($product_brand[0]->brand_logo_mobile)) : ?>
										<div><img src="<?php echo $product_brand[0]->brand_logo_mobile; ?>"/> </div>
									<?php endif; ?>
								<?php endif; ?>
							</div>
							</div>
							<ul class="social-btn">
								<li>
							<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.5&appId=158833044457257";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="fb-share-button" data-href="https://www.facebook.com/Shopamerikacom-1428932180656351/" data-layout="button_count"></div>
								</li>
								<li>
<a href="https://twitter.com/share" class="twitter-share-button" data-count="none" data-hashtags="shopamerika">Tweet</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
								</li>
								<li>
<a data-pin-do="buttonBookmark" null href="//www.pinterest.com/pin/create/button/"><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_gray_20.png" /></a>
<!-- Please call pinit.js only once per page -->
<script async defer src="//assets.pinterest.com/js/pinit.js"></script>
								</li>
							</ul>
					</div><!--/product-details-->
							   <?php //echo $product_details[0]->description; ?>
							   
							</div><!--/product-information-->
							
						</div>
						
					
<div class="col-sm-12" >
	<div>
							<ul class="nav nav-tabs">
								<li class="active"> <a href="#details" data-toggle="tab">Details</a></li>
								
							</ul>
	</div>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="details" >
								<div class="description-box">
							   <?php echo $product_details[0]->description; ?>
								</div>
							</div>
							
						</div>
</div>
					
					
					<div class="col-sm-2"   >

<?php include "right_side.php";?>

</div>
				</div>
				
			</div>
		</div>
	</section>
	<section>
		<div class="container">
			<div class="row">
				<?php //include "cat_left.php";?>
				<div class="col-sm-12 padding-right">
						<div class="features_items"><!--features_items-->
							<h2 class="title text-center">Recommended Items</h2>
							<!--~~~ start featured products here ~~~-->
							
							<div id="recommended-item-carousel1" class="carousel slide" data-ride="carousel">
								<div class="carousel-inner">
									<?php 
										
										//$random_items=$CI->product->get_category_random_products(2,16);
										//print_r($random_items);
										$c_count=0;$test=0;?>
									
							<?php 	foreach ($related_products as $fitem) :
								$product_main_images=$CI->product->get_product_images($fitem->id); 
								$product_alt_images=$CI->product->get_product_alt_images($fitem->id);?>
								<?php if($fitem->price<76){?>
							<?php if($c_count==0){?><div class="item <?php if($test==0){$test++;?>active<?php }?>"><?php }?>
							
							<div class="col-sm-3">
								
								<div class="product-image-wrapper">
									<div class="single-products">
											<div class="productinfo text-center">
												<?php
												$item_url = $fitem->name ;
					$item_clean_url = base_url()."product/".$CI->cleanurl->slug($item_url).'-item-'.$fitem->id.'.html' ; ?>
												<div class="home-fitem-img">
												<a href="<?php echo($item_clean_url );?>"> 
													<img  src="<?php echo($product_main_images[0]->image);?>" 
											alt=""
											<?php if($product_alt_images)
							{?>onmouseover="this.src='<?php echo($product_alt_images[0]->alt_image_best);?>'"<?php }?>
											
											onmouseout="this.src='<?php echo($product_main_images[0]->image);?>'"/>
												</a>
												</div>
												<h6><?php if(empty($fitem->salePrice)){echo $CURRENCY.number_format($fitem->price, 2, ',', ' ');  }else{?><del style="color: #000;font-size: 13px;"><?php echo $CURRENCY.number_format($fitem->price, 2, ',', ' ');?></del><br/> <span class="price">
												<?php echo $CURRENCY.number_format($fitem->salePrice, 2, ',', ' ');?></span><?php } ?></h6>
												<?php echo ($fitem->name);   ?>
												
												
											</div>
											
									</div>
									
								</div>
							 
							</div>
							<?php $c_count++;if($c_count==4){?></div><?php $c_count=0; }?>
							<?php }?>
							<?php endforeach; ?>
									</div>
								</div>
							</div>
							<a class="left recommended-item-control" href="#recommended-item-carousel1" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								  </a>
								  <a class="right recommended-item-control" href="#recommended-item-carousel1" data-slide="next">
									<i class="fa fa-angle-right"></i>
								  </a>	
						</div><!--features_items-->
						
						
						
						
						
					</div>
					
				</div>
			</div>
		</section>
			
		<?php // include "footer.php";?>
			<?php //include "script.php";?>
<?php 
//if the user is logged hide the login btn
if ($this->session->userdata('user_id'))
{?>
	 <script>
	 $("#login_btn").hide();
	 $("#account_btn").html('<i class="fa fa-user"></i>'+ ' <?php echo($this->session->userdata('usrname'));?>'  );
	 </script> 
<?php 	 
}
//if the user is not logged hide the loginout btn
else
{
	?><script>
	$("#logout_btn").hide(); 
	</script>
	
	
<?php 	
}
?>   


<script>
	// colorbox
		
	//change Image width to fit in container
	var image_actualWidth = "<?php echo($product_img[0]->actualWidth);  ?>";
	var container_width = document.getElementById('product_img').offsetWidth;
	if(image_actualWidth < container_width ){
		$("#product_img>a>img").width("<?php echo($product_img[0]->actualWidth);  ?>");
	}
	else
		$("#product_img>a>img").width("100%");
		
	
	// click to change main picture to the color picture
	$("#colors_container span a").click(function()
	{
		
		// clear css (border and padding)
		$("#colors_container span a").css({"border-style":"none","padding":"0px 0px 0px"});
		
		// apply css(border and padding)
		$(this).css({"padding":"8px 8px 10px","border-color": "rgb(254, 152, 15)", 
             "border-width":"1px", 
             "border-style":"solid"});
             
		// remove id from other
		$("#colors_container span a img").removeAttr("id");
		$(this).children("img").attr("id","selected_color");
		
		// get the color image url
		var img_url = $(this).attr("href");
		
		// assign the colored image to the main image
		$("#product_img img").attr("src",img_url);
		
		
		
		
		//prevent default 
		return false;
		
	});
	
	
	
	//click on add to cart 
	$(".add-to-cart").click(function()
	{
		alert(1);
		 //the target (cart controller / add method)
		 var target_url = '<?php echo(base_url()."carta/add") ; ?>';
	  	 
	  	 // somme alers for degbugging 
	  	 //alert( target_url );
	  	 //alert( $(this).attr('id') );
	  	 
	  	// get the product id from the DOM
	  	
	  	var prod_id = $(this).attr("id");
	  	//var prod_id = '<?php echo (string)$product_details[0]->id; ?>';
	  	
	  	// get the color if from the DOM
	  	var color_id = $("#selected_color").parent("a").attr("id");
	  	
	  	var prod_name = '<?php echo (string)$product_details[0]->name; ?>';
	  	
	  	// qty is always set to 1
	  	var qty = 1;
	  	
		// prepare the data to be sent
		var ProductData = 
						{
							product_id:prod_id,
							quantity:qty,
							color_id:color_id,
							product_name:prod_name
						};
		
		$.ajax(
		{
			url : target_url,
			type: "POST",
			data : ProductData,
			success: function(data)
			{
				//alert('product added!\n' + data);
				//$("#cart_notice").show();
				//$("#cart_notice").html(data);
				//setInterval(function(){$("#cart").css()
				//update cart icon Number
				cart = JSON && JSON.parse(data) || $.parseJSON(data);
				
				//alert('there are \n' + cart.num_of_items + ' items in your cart');
				//alert('you r going to pay \n' + cart.total_price + 'dolars today');
				
				//var num_of_items = "<?php echo($this->cart->total_items());?>";
				//setTimeout(function(){    alert('there are \n' + num_of_items + ' items in your cart');$("#cart_num").html("( " + num_of_items + ")");}, 5000);
				//alert('there are \n' + num_of_items + ' items in your cart');
				$("#cart_num").html("( " + cart.num_of_items + " )");
				
				document.getElementById("cart").scrollIntoView();
				
			},
			error: function(jqXHR, textStatus, errorThrown)
			{
				//alert('product not added!\n');
				//$("#cart_notice").show();
				//$("#cart_notice").html('<pre><code class="prettyprint">AJAX Request Failed<br/> textStatus='+textStatus+', errorThrown='+errorThrown+'</code></pre>');
			}
		});
		
		
		
		// prevent default
		return false;
	});

</script>

<?php 
//update the login menu and cart icon 

//show the nmber of items in the cart
if ($this->cart->total_items() > 0)
{?>
	<script>
	 $("#cart_num").html('( <?php echo($this->cart->total_items());?> )');
	</script> 
<?php 	 
}
?>
	    
</body>
</html>