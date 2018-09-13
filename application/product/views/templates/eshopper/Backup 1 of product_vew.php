<!DOCTYPE html>
<html lang="en">
<head>
<?php  $this->load->helper('url'); ?>
<?php include 'head.php';

$CURRENCY = "$";
$RATE = 1;
?>
<!--____________________________________/ cssII \____________________________________-->
<link href="<?php echo base_url().'assets/templates/Eshopper/css/rateit.css';?>" rel="stylesheet">
<link href="<?php echo base_url().'assets/templates/Eshopper/css/colorbox.css';?>" rel="stylesheet">
</head>

<body>
<?php include 'header.php';?>
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Category</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#sportswear">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											Sportswear
										</a>
									</h4>
								</div>
								<div id="sportswear" class="panel-collapse collapse">
									<div class="panel-body">
										<ul>
											<li><a href="">Nike </a></li>
											<li><a href="">Under Armour </a></li>
											<li><a href="">Adidas </a></li>
											<li><a href="">Puma</a></li>
											<li><a href="">ASICS </a></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#mens">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											Mens
										</a>
									</h4>
								</div>
								<div id="mens" class="panel-collapse collapse">
									<div class="panel-body">
										<ul>
											<li><a href="">Fendi</a></li>
											<li><a href="">Guess</a></li>
											<li><a href="">Valentino</a></li>
											<li><a href="">Dior</a></li>
											<li><a href="">Versace</a></li>
											<li><a href="">Armani</a></li>
											<li><a href="">Prada</a></li>
											<li><a href="">Dolce and Gabbana</a></li>
											<li><a href="">Chanel</a></li>
											<li><a href="">Gucci</a></li>
										</ul>
									</div>
								</div>
							</div>
							
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#womens">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											Womens
										</a>
									</h4>
								</div>
								<div id="womens" class="panel-collapse collapse">
									<div class="panel-body">
										<ul>
											<li><a href="">Fendi</a></li>
											<li><a href="">Guess</a></li>
											<li><a href="">Valentino</a></li>
											<li><a href="">Dior</a></li>
											<li><a href="">Versace</a></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Kids</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Fashion</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Households</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Interiors</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Clothing</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Bags</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Shoes</a></h4>
								</div>
							</div>
						</div><!--/category-products-->
					
						<div class="brands_products"><!--brands_products-->
							<h2>Brands</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
									<li><a href=""> <span class="pull-right">(50)</span>Acne</a></li>
									<li><a href=""> <span class="pull-right">(56)</span>Grüne Erde</a></li>
									<li><a href=""> <span class="pull-right">(27)</span>Albiro</a></li>
									<li><a href=""> <span class="pull-right">(32)</span>Ronhill</a></li>
									<li><a href=""> <span class="pull-right">(5)</span>Oddmolly</a></li>
									<li><a href=""> <span class="pull-right">(9)</span>Boudestijn</a></li>
									<li><a href=""> <span class="pull-right">(4)</span>Rösch creative culture</a></li>
								</ul>
							</div>
						</div><!--/brands_products-->
						
						<div class="price-range"><!--price-range-->
							<h2>Price Range</h2>
							<div class="well">
								 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
								 <b>$ 0</b> <b class="pull-right">$ 600</b>
							</div>
						</div><!--/price-range-->
						
						<div class="shipping text-center"><!--shipping-->
							<img src="images/home/shipping.jpg" alt="" />
						</div><!--/shipping-->
						
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div id="product_img" class="view-product">
								<a class="group1" href="<?php echo($product_img[0]->image); ?>"><img  style=" max-width: 100%; height:auto;" src="<?php echo($product_img[0]->image); ?>"  alt="" /> </a>
								<?php if(!$product_inStock) :?> 
								<h3>Sold Out</h3>
								<?php endif;?> 
							</div>
						    <?php $len = count($product_alt_img);?>
							<?php if ($len > 1 ) :?> 
							<div " id="similar-product" class="carousel slide" data-ride="carousel">
								
								  <!-- Wrapper for slides -->
								    <div class="carousel-inner">
								    
										<?php $j = 0 ; // will increment by 3  when  $i = 3K ?> 
										<?php  for($i = 0; $i< $len ; $i++) : ?> 
										    
										    <?php if ($i == 0 ) :?> 
										     <!--1st triplet-->
										     <div class="item active">
											     <a class="group1" href="<?php echo $product_alt_img[$i]->alt_image_original;  ?>"><img  src="<?php echo $product_alt_img[$i]->alt_image_medium; ?>"  alt="" /> </a>
											     
											     <?php if (isset($product_alt_img[$i+1]->alt_image_medium)) :?> 
											     	<a class="group1"  href="<?php echo $product_alt_img[$i+1]->alt_image_original;  ?>"><img  src="<?php echo $product_alt_img[$i+1]->alt_image_medium; ?>"  alt="" /> </a>
										         <?php endif ?>
										         
										         <?php if (isset($product_alt_img[$i+2]->alt_image_medium)) :?> 
											     	<a class="group1"  href="<?php echo $product_alt_img[$i+2]->alt_image_original;  ?>"><img  src="<?php echo $product_alt_img[$i+2]->alt_image_medium; ?>"  alt="" /> </a>
										         <?php endif ?>
										     </div>
										    <?php $j = $j+3 ?>
										    <?php endif ?>
										    
										    <?php if ($i == $j && $i!=0 ) :?> 
										     <!--next triplet-->
										     <div class="item">
											    <a class="group1"  href="<?php echo $product_alt_img[$i]->alt_image_original;  ?>"><img  src="<?php echo $product_alt_img[$i]->alt_image_medium; ?>"  alt="" /> </a>
											     
											     <?php if (isset($product_alt_img[$i+1]->alt_image_medium)) :?> 
											     	<a class="group1"  href="<?php echo $product_alt_img[$i+1]->alt_image_original;  ?>"><img  src="<?php echo $product_alt_img[$i+1]->alt_image_medium; ?>"  alt="" /> </a>
										         <?php endif ?>
										         
										         <?php if (isset($product_alt_img[$i+2]->alt_image_medium)) :?> 
											     	<a class="group1"  href="<?php echo $product_alt_img[$i+2]->alt_image_original;  ?>"><img  src="<?php echo $product_alt_img[$i+2]->alt_image_medium; ?>"  alt="" /> </a>
										         <?php endif ?>
										     </div>
										    <?php $j = $j+3 ?>
										    <?php endif ?>
										    
										<?php endfor ?>
										
									</div>

								  <?php if ($len > 4 ) :?> 
									  <!-- Controls -->
									  <a class="left item-control" href="#similar-product" data-slide="prev">
										<i class="fa fa-angle-left"></i>
									  </a>
									  <a class="right item-control" href="#similar-product" data-slide="next">
										<i class="fa fa-angle-right"></i>
									  </a>
								  <?php endif ?>
							</div>
							<?php endif ?>

						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="images/product-details/new.jpg" class="newarrival" alt="" />
								<h2> <?php echo $product_details[0]->name; ?> </h2>
								<p>Web ID: <?php echo $product_details[0]->idd; ?></p>
								<img src="images/product-details/rating.png" alt="" />
								<span>
									<?php $saleprice =  $product_details[0]->salePrice  ; ?>
									
									<span> <?php if(!$saleprice) echo $CURRENCY." ".number_format($product_details[0]->price*$RATE , 2, ',', ' ')  ; ?></span><br>
									<?php if($saleprice) :?>
									<div>
										<span style="color: #2ECC71;" > <?php  echo $CURRENCY." ".number_format($product_details[0]->salePrice*$RATE , 2, ',', ' ') ?></span>
										
										<span> <?php echo  "<strike>(".$CURRENCY." ".number_format($product_details[0]->price*$RATE , 2, ',', ' ').")</strike>" ?></span>
									</div>
									<?php endif ?>
									
									<?php if($product_sizes): ?>
										<select>
											<?php foreach($product_sizes as $size) : ?>
												<option>
													<?php // echo $size->size_name; ?>
													<?php echo $size->cannonical_size_name; ?>
												</option>
											<?php endforeach; ?>
										</select>
									<?php endif ?>
									
									<!--<label>Quantity:</label>
									<input type="text" value="3" />-->
									<?php if($product_inStock) :?> 
									<button class="btn btn-default add-to-cart" id="<?php echo $product_details[0]->id ;?> " style="margin-left:0px; " type="button" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</button>
									<?php endif;?> 
								</span>
								<?php 
								if( (!empty($product_colors[0])) && (count($product_colors) >1 )  )  :?>
									<!--<p style="color: #FE980F;" >Alternative colors</p>-->
									<div id="colors_container">
										
									<?php foreach ($product_colors as $pcolor): ?>
									<!--<span >-->
										<span><a class="group1" href=<?php   echo('"'.$pcolor->image_url.'"')  ?>   id=<?php   echo('"'.$pcolor->image_color_id.'"')  ?>  > <img src=<?php   echo('"'.$pcolor->swatch.'"')  ?> /> </a></span>
									<!--</span>-->
									<?php endforeach; ?>
									</div>
								<?php endif; ?>
								
								<?php if($product_inStock) :?> 
								<p><b>Availability:</b> <?php echo "In Stock"; ?> </p>
								<?php else : ?>
								<p><b>Availability:</b> <?php echo "Out Of Stock"; ?> </p>
								<?php endif; ?>
								
								<!--<p><b>Condition:</b> New</p>-->
								
								<?php if(isset($product_brand[0]->brand_name)) : ?>
								<p><b>Brand: </b><?php echo $product_brand[0]->brand_name; ?> </p>
									<?php if(isset($product_brand[0]->brand_logo_mobile)) : ?>
										<div><img src="<?php echo $product_brand[0]->brand_logo_mobile; ?>"/> </div>
									<?php endif; ?>
								<?php endif; ?>
								<table>
								  <tr>
								    <td>Overall: </td>
								    <td><span class="rateit" data-rateit-value="4.5" data-rateit-ispreset="true" data-rateit-readonly="true" ></span></td>
								  </tr>
								  <tr>
								    <td>Value:</td>
								    <td><span class="rateit" data-rateit-value="3.5" data-rateit-ispreset="true" data-rateit-readonly="true" ></span></td>
								  </tr>
								  <tr>
								    <td>Usability:</td>
								    <td><span class="rateit" data-rateit-value="5" data-rateit-ispreset="true" data-rateit-readonly="true" ></span></td>
								  </tr>
								  <tr>
								    <td>Durability:</td>
								    <td><span class="rateit" data-rateit-value="3" data-rateit-ispreset="true" data-rateit-readonly="true" ></span></td>
								  </tr>
								  <tr>
								    <td>Features:</td>
								    <td><span class="rateit" data-rateit-value="1" data-rateit-ispreset="true" data-rateit-readonly="true" ></span></td>
								  </tr>
								   <tr>
								    <td>Design:</td>
								    <td><span class="rateit" data-rateit-value="5" data-rateit-ispreset="true" data-rateit-readonly="true" ></span></td>
								  </tr>

								</table>
								
								
								
								
								
								
								
								
								
								
								<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
						</div>

					</div><!--/product-details-->
					
					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li><a href="#details" data-toggle="tab">Details</a></li>
								<li><a href="#companyprofile" data-toggle="tab">Company Profile</a></li>
								<li><a href="#tag" data-toggle="tab">Tag</a></li>
								<li class="active"><a href="#reviews" data-toggle="tab">Reviews (5)</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade" id="details" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery1.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery2.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery3.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery4.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="tab-pane fade" id="companyprofile" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery1.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery3.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery2.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery4.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="tab-pane fade" id="tag" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery1.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery2.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery3.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery4.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="tab-pane fade active in" id="reviews" >
								<div class="col-sm-12">
									<!--reviews--> 
									<?php foreach ($product_reviews as $prdct_review) : ?>
									<ul>
										<li><a href=""><i class="fa fa-user"></i><?php echo($prdct_review->username);?> </a></li>
										<li><a href=""><i class="fa fa-clock-o"></i><?php echo($prdct_review->datetime);?></a></li>
										<li><a href=""><i class="fa fa-calendar-o"></i><?php echo($prdct_review->datetime); ?></a></li>
									</ul>
									
									<span class="rateit" data-rateit-value="<?php echo($prdct_review->overall_stars); ?>" data-rateit-ispreset="true" data-rateit-readonly="true" ></span>
									<p><?php echo($prdct_review->review_title); ?></p>
									<p><?php echo($prdct_review->review_text); ?></p>

									<?php endforeach ; ?>
									<ul>
										<li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
										<li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
										<li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
									</ul>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>

									<!--end reviews-->
									
									<p><b>Write Your Review</b></p>
									<form action="#">
										<span>
											<input type="text" placeholder="Your Name"/>
											<input type="email" placeholder="Email Address"/>
										</span>
										<textarea name="" ></textarea>
										<b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
										<button type="button" class="btn btn-default pull-right">
											Submit
										</button>
									</form>
								</div>
							</div>
							
						</div>
					</div><!--/category-tab-->
					
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">recommended items</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">	
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend1.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend2.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend3.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="item">	
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend1.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend2.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend3.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<button  type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->
					
				</div>
			</div>
		</div>
	</section>
	
	<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span>e</span>-shopper</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe1.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe2.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe3.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe4.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="address">
							<img src="images/home/map.png" alt="" />
							<p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Service</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="">Online Help</a></li>
								<li><a href="">Contact Us</a></li>
								<li><a href="">Order Status</a></li>
								<li><a href="">Change Location</a></li>
								<li><a href="">FAQ’s</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Quock Shop</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="">T-Shirt</a></li>
								<li><a href="">Mens</a></li>
								<li><a href="">Womens</a></li>
								<li><a href="">Gift Cards</a></li>
								<li><a href="">Shoes</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Policies</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="">Terms of Use</a></li>
								<li><a href="">Privecy Policy</a></li>
								<li><a href="">Refund Policy</a></li>
								<li><a href="">Billing System</a></li>
								<li><a href="">Ticket System</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="">Company Information</a></li>
								<li><a href="">Careers</a></li>
								<li><a href="">Store Location</a></li>
								<li><a href="">Affillate Program</a></li>
								<li><a href="">Copyright</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<form action="#" class="searchform">
								<input type="text" placeholder="Your email address" />
								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
								<p>Get the most recent updates from <br />our site and be updated your self...</p>
							</form>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="http://www.trendit.com.tr/">TrendIT</a></span></p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
	
    <script src="<?php echo base_url().'assets/templates/Eshopper/js/jquery.js';?>"> </script>
	<script src="<?php echo base_url().'assets/templates/Eshopper/js/bootstrap.min.js';?>" ></script>
	<script src="<?php echo base_url().'assets/templates/Eshopper/js/jquery.scrollUp.min.js';?>" ></script>
	<script src="<?php echo base_url().'assets/templates/Eshopper/js/price-range.js';?>"> </script>
    <script src="<?php echo base_url().'assets/templates/Eshopper/js/jquery.prettyPhoto.js';?>"> </script>
    <script src="<?php echo base_url().'assets/templates/Eshopper/js/main.js';?>" > </script>
    
    <script src="<?php echo base_url().'assets/templates/Eshopper/js/jquery.colorbox.js';?>" > </script>
   <!-- <script src="<?php echo base_url().'assets/templates/Eshopper/js/jquery.colorbox-min.js';?>" > </script>-->
    <script src="<?php echo base_url().'assets/templates/Eshopper/js/jquery.rateit.min.js';?>" > </script>


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
	$(document).ready(function(){
		$(".group1").colorbox({rel:'group1', transition:"fade"});
		//$(".view-product").on("click",function(){			alert("bingo");		});
	});

	
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
		 //the target (cart controller / add method)
		 var target_url = '<?php echo(base_url()."cart/add") ; ?>';
	  	 
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