<?php 
$this->load->helper('url');
$CI =& get_instance();
$CI->load->library('cleanurl');
$CURRENCY = "$";
$RATE = 1;



$meta_description = " ";$meta_keyworks = " ";$meta_title = " "; $viewport = " ";
foreach ($meta_info as  $minfo  )
{
	if (!is_null($minfo->description)) 	$meta_description = $minfo->description;
	if (!is_null($minfo->keywords)) 	$meta_keyworks = $minfo->keywords; 	
	if (!is_null($minfo->title)) 		$meta_title = $minfo->title ;			
	if (!is_null($minfo->viewport)) 	$viewport = $minfo->viewport ;		
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

<!--____________________________________/ meta \____________________________________ -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
    <meta name="description " content="<?php echo($meta_description) ?> " >
	<meta name="keywords" content="<?php echo($meta_keyworks) ?>" >
    <meta name="author" content="TrendIT - Home baked" >
    
<!--____________________________________/ favicon \____________________________________ -->
<link rel='shortcut icon' type='image/ico' href= "<?php echo base_url().'assets/templates/eshopper/images/home/favicon.ico';?>"  >

<!--____________________________________/ title \____________________________________ -->
    <title> <?php echo($meta_title) ?> </title>
    
<!--____________________________________/ css \____________________________________-->

	<link href="<?php echo base_url().'assets/'.$template_info['path'].'/css/bootstrap.min.css';?>" rel="stylesheet">	
    <link href="<?php echo base_url().'assets/templates/eshopper/css/font-awesome.min.css';?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/templates/eshopper/css/prettyPhoto.css';?>"  rel="stylesheet">
    <link href="<?php echo base_url().'assets/templates/eshopper/css/price-range.css';?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/templates/eshopper/css/animate.css';?>" rel="stylesheet">
	<link href="<?php echo base_url().'assets/templates/eshopper/css/main.css';?>" rel="stylesheet">
	<link href="<?php echo base_url().'assets/templates/eshopper/css/responsive.css';?>" rel="stylesheet">
	<!--for autocomplete-->
	<link href="<?php echo base_url().'assets/templates/eshopper/css/jquery-ui.css';?>" rel="stylesheet">
	
<!--____________________________________/ responsive \____________________________________-->

    <!--[if lt IE 9]>
    <script src= "<?php echo base_url().'assets/templates/eshopper/css/js/html5shiv.js';?>"   ></script>
    <script src= "<?php echo base_url().'assets/templates/eshopper/css/js/respond.min.js';?>" ></script>
    <![endif]-->   
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url().'assets/templates/eshopper/images/ico/apple-touch-icon-144-precomposed.png';?>"  >
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url().'assets/templates/eshopper/images/ico/apple-touch-icon-114-precomposed.png';?>"  >
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url().'assets/templates/eshopper/images/ico/apple-touch-icon-72-precomposed.png';?>" 	  >
    <link rel="apple-touch-icon-precomposed" href="<?php echo base_url().'assets/templates/eshopper/images/home/gallery3.jpg';?>" >

<style>
    
 
	#brands_box 
	{
    -webkit-column-count: 10; /* Chrome, Safari*/
    -moz-column-count: 10; /* Firefox */
    column-count: 10; /* ie10+ and opera*/
	}

@media (max-width: 1280px) 
{
	#brands_box 
	{
    -webkit-column-count: 7; /* Chrome, Safari*/
    -moz-column-count: 5; /* Firefox */
    column-count: 7; /* ie10+ and opera*/
	}
	
}

@media (max-width: 1024px) 
{
	#brands_box 
	{
    -webkit-column-count: 7; /* Chrome, Safari*/
    -moz-column-count: 5; /* Firefox */
    column-count: 7; /* ie10+ and opera*/
	}
	
}

@media (max-width: 640px) 
{
	#brands_box 
	{
    -webkit-column-count: 2; /* Chrome, Safari*/
    -moz-column-count: 2; /* Firefox */
    column-count: 2; /* ie10+ and opera*/
	}
}

@media (max-width: 767px) 
{
	#search
	{
		width: 80%;
		background-color: pink;
	}
}


@media (max-width: 300px) 
{
	#brands_box 
	{
    -webkit-column-count: 1; /* Chrome, Safari*/
    -moz-column-count: 1; /* Firefox */
    column-count: 1; /* ie10+ and opera*/
	}
	
}

#loading {
position: absolute;
width: 100%;
}


#loading img{
 
  position: relative;
  left: 50%;
  margin-left:-107px;
}

.product_title{
	height: 45px;
}

</style>

    
</head>

<body>

 	<?php
 	
 	 include 'header.php';?>
 	
 	<div class="coverbox" style=" display: none;" >
		<div id="brands_box" style="  border-color:#0b0000 ; border-style: solid; min-height:50px; background-color:rgba(255, 255, 255, 0.82); "  > 
		<div id="loading" >   <img src="http://www.wsbonline.com/Images/Icons/Processing.gif" alt="processing" >   </div>
		</div>
	</div>
 	
	
	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
							<li data-target="#slider-carousel" data-slide-to="3"></li>
						</ol>
						
						<div class="carousel-inner">
							<div class="item active">
								<img src= "<?php echo base_url().'assets/templates/eshopper/images/home/slide_1.jpg';?>"   class="girl img-responsive" alt="" />
								<!--<div class="col-sm-6">
									<h1><span>YOUR</span>-SHOP</h1>
									<h2>Welcome to your shop</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div>
								<div class="col-sm-6">
									<img src= "<?php echo base_url().'assets/templates/eshopper/images/home/vase2.jpg';?>"   class="girl img-responsive" alt="" />
									<img src= "<?php echo base_url().'assets/templates/eshopper/images/home/pricing.png';?>"  class="pricing" alt="" />
								</div>-->
							</div>
							<div class="item">
								<img src= "<?php echo base_url().'assets/templates/eshopper/images/home/slide_2.jpg';?>"   class="girl img-responsive" alt="" />
								<!--<div class="col-sm-6">
									<h1><span>YOUR</span>-SHOP</h1>
									<h2>100% Responsive Design</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div>
								<div class="col-sm-6">
									<img src= "<?php echo base_url().'assets/templates/eshopper/images/home/vase1.jpg';?>"   class="girl img-responsive" alt="" />
									<img src= "<?php echo base_url().'assets/templates/eshopper/images/home/pricing.png';?>" class="pricing" alt="" />
								</div>-->
							</div>
							
							<div class="item">
								<img src= "<?php echo base_url().'assets/templates/eshopper/images/home/slide_3.jpg';?>"   class="girl img-responsive" alt="" />
								<!--<div class="col-sm-6">
									<h1><span>YOUR</span>-SHOP</h1>
									<h2>SEO Friendly</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div>
								<div class="col-sm-6">
									<img src="<?php echo base_url().'assets/templates/eshopper/images/home/vase3.jpg';?>" 	 class="girl img-responsive" alt="" />
									<img src="<?php echo base_url().'assets/templates/eshopper/images/home/pricing.png';?>"  class="pricing" alt="" />
								</div>-->
							</div>

							<div class="item">
								<img src= "<?php echo base_url().'assets/templates/eshopper/images/home/slide_4.jpg';?>"   class="girl img-responsive" alt="" />
							</div>
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Category</h2>
						<?php
						// load categories
						$CI->load->module("categories");
						$data["categories"] = $this->categories->index();
						?>	  	
							 
						
						
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
											<li><a href="#">Nike </a></li>
											<li><a href="#">Under Armour </a></li>
											<li><a href="#">Adidas </a></li>
											<li><a href="#">Puma</a></li>
											<li><a href="#">ASICS </a></li>
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
											<li><a href="#">Fendi</a></li>
											<li><a href="#">Guess</a></li>
											<li><a href="#">Valentino</a></li>
											<li><a href="#">Dior</a></li>
											<li><a href="#">Versace</a></li>
											<li><a href="#">Armani</a></li>
											<li><a href="#">Prada</a></li>
											<li><a href="#">Dolce and Gabbana</a></li>
											<li><a href="#">Chanel</a></li>
											<li><a href="#">Gucci</a></li>
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
											<li><a href="#">Fendi</a></li>
											<li><a href="#">Guess</a></li>
											<li><a href="#">Valentino</a></li>
											<li><a href="#">Dior</a></li>
											<li><a href="#">Versace</a></li>
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
								<?php 	foreach ($featured_items as $fitem) : ?>
								<!-- to do -->
								<?php endforeach; ?>
								
									<li><a href="#"> <span class="pull-right">(50)</span>Acne</a></li>
									<li><a href="#"> <span class="pull-right">(56)</span>Grüne Erde</a></li>
									<li><a href="#"> <span class="pull-right">(27)</span>Albiro</a></li>
									<li><a href="#"> <span class="pull-right">(32)</span>Ronhill</a></li>
									<li><a href="#"> <span class="pull-right">(5)</span>Oddmolly</a></li>
									<li><a href="#"> <span class="pull-right">(9)</span>Boudestijn</a></li>
									<li><a href="#"> <span class="pull-right">(4)</span>Rösch creative culture</a></li>
									<li id="more_brnds"  ><a href="#"> <span class="pull-right"></span>more...</a></li>
								</ul>
							</div>
						</div><!--/brands_products-->
						
						<div class="price-range"><!--price-range-->
							<h2>Price Range</h2>
							<div class="well text-center">
								 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
								 <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
							</div>
						</div><!--/price-range-->
						
						<div class="shipping text-center"><!--shipping-->
							<img 			"images/home/shipping.jpg" alt="" />
						</div><!--/shipping-->
					
					</div>
				</div>
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>
						<!--~~~ start featured products here ~~~-->
						<?php 	foreach ($featured_items as $fitem) : ?>
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<?php
											$item_url = $fitem->product_name ;
											$item_clean_url = base_url()."product/".$CI->cleanurl->slug($item_url).'-item-'.$fitem->prod_id.'.html' ; ?>
											<a href="<?php echo($item_clean_url );?>"> <img  src="<?php echo($fitem->product_image); ?>"  alt="" /> </a>
											<h2> <?php echo $CURRENCY.number_format($fitem->product_price, 2, ',', ' ');   ?></h2>
											<div class="product_title" ><?php echo ($fitem->product_name);   ?></div>
											<form method ="post" action="product_controller" >
											<a id="<?php echo($fitem->prod_id); ?>" href="#" class="btn btn-default add-to-cart">
											 
											 <i  class="fa fa-shopping-cart"></i>Add to cart</a> 
											</form>
										</div>
										<!--<img src="<?php echo base_url().'assets/templates/eshopper/images/home/new.png';?>"  class="new" alt="" />-->
										<!--<img src="<?php echo base_url().'assets/templates/eshopper/images/home/sale.png';?>" class="new" alt="" />-->
										<!--<div class="product-overlay">
										<div class="overlay-content">
											<div><a href="<?php echo( base_url()."product/item_".$fitem->id."-".$fitem->name.'.html');?>"> <img  src="<?php echo($fitem->url); ?>"  alt="" /> </a> </div>
											<p><?php echo($fitem->name); ?></p>
											<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										</div>
									</div>-->
								</div>
								<!--<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
									</ul>
								</div>-->
							</div>
						 
						</div>
						<?php endforeach; ?>
						<!--~~~ finish featured products here here  ~~~-->
						
						<!--<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<img src="<?php echo base_url().'assets/templates/eshopper/images/home/product2.jpg';?>"  alt="" />
										<h2>$56</h2>
										<p>Easy Polo Black Edition</p>
										<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
									</div>
									<div class="product-overlay">
										<div class="overlay-content">
											<h2>$56</h2>
											<p>Easy Polo Black Edition</p>
											<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										</div>
									</div>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
									</ul>
								</div>
							</div>
						</div>-->
						<!--<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<img src="<?php echo base_url().'assets/templates/eshopper/images/home/product3.jpg';?>"  alt="" />
										<h2>$56</h2>
										<p>Easy Polo Black Edition</p>
										<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
									</div>
									<div class="product-overlay">
										<div class="overlay-content">
											<h2>$56</h2>
											<p>Easy Polo Black Edition</p>
											<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										</div>
									</div>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
									</ul>
								</div>
							</div>
						</div>-->
						<!--<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<img src="<?php echo base_url().'assets/templates/eshopper/images/home/product4.jpg';?>" alt="" />
										<h2>$56</h2>
										<p>Easy Polo Black Edition</p>
										<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
									</div>
									<div class="product-overlay">
										<div class="overlay-content">
											<h2>$56</h2>
											<p>Easy Polo Black Edition</p>
											<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										</div>
									</div>
									<img src="<?php echo base_url().'assets/templates/eshopper/images/home/new.png';?>"  class="new" alt="" />
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
									</ul>
								</div>
							</div>
						</div>-->
						<!--<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<img src="<?php echo base_url().'assets/templates/eshopper/images/home/product5.jpg';?>" alt="" />
										<h2>$56</h2>
										<p>Easy Polo Black Edition</p>
										<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
									</div>
									<div class="product-overlay">
										<div class="overlay-content">
											<h2>$56</h2>
											<p>Easy Polo Black Edition</p>
											<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										</div>
									</div>
									<img src="<?php echo base_url().'assets/templates/eshopper/images/home/sale.png';?>" class="new" alt="" />
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
									</ul>
								</div>
							</div>
						</div>-->
						<!--<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<img src="<?php echo base_url().'assets/templates/eshopper/images/home/product6.jpg';?>" alt="" />
										<h2>$56</h2>
										<p>Easy Polo Black Edition</p>
										<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
									</div>
									<div class="product-overlay">
										<div class="overlay-content">
											<h2>$56</h2>
											<p>Easy Polo Black Edition</p>
											<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										</div>
									</div>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
									</ul>
								</div>
							</div>
						</div>-->
						
					</div><!--features_items-->
					
					<div class="category-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#tshirt" data-toggle="tab">T-Shirt</a></li>
								<li><a href="#blazers" data-toggle="tab">Blazers</a></li>
								<li><a href="#sunglass" data-toggle="tab">Sunglass</a></li>
								<li><a href="#kids" data-toggle="tab">Kids</a></li>
								<li><a href="#poloshirt" data-toggle="tab">Polo shirt</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="tshirt" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="<?php echo base_url().'assets/templates/eshopper/images/home/gallery1.jpg';?>"  alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src= "<?php echo base_url().'assets/templates/eshopper/images/home/gallery2.jpg';?>"  alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="<?php echo base_url().'assets/templates/eshopper/images/home/gallery3.jpg';?>"  alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="<?php echo base_url().'assets/templates/eshopper/images/home/gallery4.jpg';?>"  alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>
							</div>
							
							<div class="tab-pane fade" id="blazers" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="<?php echo base_url().'assets/templates/eshopper/images/home/gallery4.jpg';?>" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="<?php echo base_url().'assets/templates/eshopper/images/home/gallery3.jpg';?>"  alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="<?php echo base_url().'assets/templates/eshopper/images/home/gallery2.jpg';?>"  alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="<?php echo base_url().'assets/templates/eshopper/images/home/gallery1.jpg';?>"  alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>
							</div>
							
							<div class="tab-pane fade" id="sunglass" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="<?php echo base_url().'assets/templates/eshopper/images/home/gallery3.jpg';?>"  alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="<?php echo base_url().'assets/templates/eshopper/images/home/gallery4.jpg';?>"  alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="<?php echo base_url().'assets/templates/eshopper/images/home/gallery1.jpg';?>" 	 alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="<?php echo base_url().'assets/templates/eshopper/images/home/gallery2.jpg';?>"  alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>
							</div>
							
							<div class="tab-pane fade" id="kids" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="<?php echo base_url().'assets/templates/eshopper/images/home/gallery1.jpg';?>"  alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="<?php echo base_url().'assets/templates/eshopper/images/home/gallery2.jpg';?>"  alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="<?php echo base_url().'assets/templates/eshopper/images/home/gallery3.jpg';?>"  alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="<?php echo base_url().'assets/templates/eshopper/images/home/gallery4.jpg';?>"  alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>
							</div>
							
							<div class="tab-pane fade" id="poloshirt" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="<?php echo base_url().'assets/templates/eshopper/images/home/gallery2.jpg';?>"  alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="<?php echo base_url().'assets/templates/eshopper/images/home/gallery4.jpg';?>"  alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="<?php echo base_url().'assets/templates/eshopper/images/home/gallery3.jpg';?>"  alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="<?php echo base_url().'assets/templates/eshopper/images/home/gallery1.jpg';?>"  alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
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
													<img src="<?php echo base_url().'assets/templates/eshopper/images/home/recommend1.jpg';?>"  alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="<?php echo base_url().'assets/templates/eshopper/images/home/recommend2.jpg';?>"  alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="<?php echo base_url().'assets/templates/eshopper/images/home/recommend3.jpg';?>"  alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
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
													<img src="<?php echo base_url().'assets/templates/eshopper/images/home/recommend1.jpg';?>"  alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="<?php echo base_url().'assets/templates/eshopper/images/home/recommend2.jpg';?>"  alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="<?php echo base_url().'assets/templates/eshopper/images/home/recommend3.jpg';?>"  alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
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
										<img src="<?php echo base_url().'assets/templates/eshopper/images/home/iframe1.png';?>"  alt="" />
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
										<img src="<?php echo base_url().'assets/templates/eshopper/images/home/iframe2.png';?>"  alt="" />
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
										<img src="<?php echo base_url().'assets/templates/eshopper/images/home/iframe3.png';?>"  alt="" />
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
										<img src="<?php echo base_url().'assets/templates/eshopper/images/home/iframe4.png';?>"  alt="" />
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
							<img src="<?php echo base_url().'assets/templates/eshopper/images/home/map.png';?>"  alt="" />
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
								<li><a href="#">Online Help</a></li>
								<li><a href="#">Contact Us</a></li>
								<li><a href="#">Order Status</a></li>
								<li><a href="#">Change Location</a></li>
								<li><a href="#">FAQ’s</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Quock Shop</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">T-Shirt</a></li>
								<li><a href="#">Mens</a></li>
								<li><a href="#">Womens</a></li>
								<li><a href="#">Gift Cards</a></li>
								<li><a href="#">Shoes</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Policies</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Terms of Use</a></li>
								<li><a href="#">Privecy Policy</a></li>
								<li><a href="#">Refund Policy</a></li>
								<li><a href="#">Billing System</a></li>
								<li><a href="#">Ticket System</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Company Information</a></li>
								<li><a href="#">Careers</a></li>
								<li><a href="#">Store Location</a></li>
								<li><a href="#">Affillate Program</a></li>
								<li><a href="#">Copyright</a></li>
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
	
	<div id="cart_notice"  style=" border-color:#ff0000; border-style: solid; min-height:50px; background-color:#ffe6e6; "  > </div>
	
<!--	<div class="coverbox" >
		<div id="msgbox" >
			<span id="x">&nbsp;</span>
			<i>demo name : Liza</i><br>
			<i>demo email : eget.volutpat@eu.edu</i><br>
			<i>demo password : 112233</i><br>
		</div>
	</div>-->
	 
<!--____________________________________/ javascript \____________________________________-->   

    <script src="<?php echo base_url().'assets/templates/eshopper/js/jquery.js';?>"> </script>
	<script src="<?php echo base_url().'assets/templates/eshopper/js/bootstrap.min.js';?>" ></script>
	<script src="<?php echo base_url().'assets/templates/eshopper/js/jquery.scrollUp.min.js';?>" ></script>
	<script src="<?php echo base_url().'assets/templates/eshopper/js/price-range.js';?>"> </script>
    <script src="<?php echo base_url().'assets/templates/eshopper/js/jquery.prettyPhoto.js';?>"> </script>
    <script src="<?php echo base_url().'assets/templates/eshopper/js/main.js';?>" > </script>
    <script src="<?php echo base_url().'assets/templates/eshopper/js/jquery-ui.js';?>" > </script>
    <!-- <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>-->


<script>

/////

$("#cart_notice").hide();

//demo user 
$( "#x, .coverbox").click(function(e) {
	//prevent other selectors than #x and .coverbox to get selected
	if( e.target !== this ) 
    return;
  	$( ".coverbox" ).fadeOut( 800 , function() {
    // Animation complete.
  });
});


//click on add to cart 
$(document).ready(function(){


$(".add-to-cart").click(function()
	{
		 //the target (cart controller / add method)
		 var target_url = '<?php echo(base_url()."cart/add") ; ?>';
	  	 
	  	 // somme alers for degbugging 
	  	 //alert( target_url );
	  	 //alert( $(this).attr('id') );
	  	 
	  	// get the product id from the DOM
	  	var prod_id = $(this).attr("id");
	  	var qty = 1;
		var ProductData = {product_id:prod_id,quantity:qty};
		
		
		
		
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
				//document.getElementById("cart").scrollIntoView({block: "end", behavior: "smooth"});
				
				// scroll up to the cart id 
				$('html, body').animate({
			        scrollTop: $("#cart").offset().top
			    }, 1000);
				

		        
		        
		        
		        
		        setTimeout(function ()
		        	{
		        		$("#cart").css("color","#ffffff"); 
		        		setTimeout(function ()
		        			{
		        			   $("#cart").css("color","#FE980F");
		        			   setTimeout(function ()
				        			{
				        			   $("#cart").css("color","#ffffff");
				        			   setTimeout(function ()
					        			{
					        			   $("#cart").css("color","#FE980F");
					        			   setTimeout(function ()
						        			{
						        			   $("#cart").css("color","#ffffff");
						        			   setTimeout(function ()
							        			{
							        			   $("#cart").css("color","#696763"); 
							        			}, 1000);  
						        			}, 1000);   
					        			}, 1000);  
				        			}, 1000); 
		        			}, 1000);
		        	}, 1000);
		        
		        $("#cart").css("color","#696763");
		       

				
			},
			error: function(jqXHR, textStatus, errorThrown)
			{
				$("#cart_notice").show();
				$("#cart_notice").html('<pre><code class="prettyprint">AJAX Request Failed<br/> textStatus='+textStatus+', errorThrown='+errorThrown+'</code></pre>');
			}
		});
		
		
		
		// prevent default
		return false;
	});
});
/////


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
// convert any string to a url friendly string
function convertToSlug(Text)
{
    return Text
        .toLowerCase()
        .replace('/ /g','-' )
        .replace(/[^\w-]+/g,'-')
        ;
}


 $( document ).ready(function() 
 	{
		// load brands via ajax
		$("#more_brnds").bind("click",function()
		{
			//alert("you requested morebrandsm here u go ..");
			$(".coverbox").show();
			//
			var target_url = '<?php echo(base_url()."brands/all") ; ?>';
			$.ajax
			(
			{
				url : target_url,
				type: "POST",
				cache: false,
				success: function(data)
				{
					//alert(data);
					
					//brands = Array();
					brands = JSON && JSON.parse(data) || $.parseJSON(data);
					$("#brands_box").empty();
					$("#brands_box").append("<ul>");
					for(var i = 0; i < brands.length; i++) 
					{
						//$("#brands_box").append('<li id="'+brands[i].id+'" >'+brands[i].name+'</li>' ) ;
						$("#brands_box").append('<li id="'+brands[i].id+'" ><a href='+convertToSlug(brands[i].name)+'_brnid_'+brands[i].id+'>'+brands[i].name+'</a></li>' ) ;
					}
					$("#brands_box").append("</ul>");
				
				},
				error: function(jqXHR, textStatus, errorThrown)
				{
					alert("error during loading brands");
				}
			});
			
			//
			
		});// endload brands via ajax
		
		//search autocomplete
		$("#search").autocomplete
		({
	    	source: '<?php echo(base_url()."product/autosearch") ; ?>' // path to the autosearch method
	  	 });
		//do something else now here
		
 	});


// to escape special characters see  http://stackoverflow.com/a/9310752/1636522
RegExp.escape = function (text) {
    return text.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, '\\$&');
};


// for highlighting the text that was typed
/*window.addEventListener('load', function () {
    var rtrim = /^ +| +$/g, rsplit = /(\\ )+/g;
    var wrapper = '<span style="color:red">$&</span>';
    var input = document.getElementById('term');
    var list = document.getElementById('ul-id');
    var items = list.getElementsByTagName('li');
    var l = items.length;
    var source = Array.prototype.map.call(
        items, function (li) { return li.textContent; }
    );
    var delay = function (fn, ms) {
        var id, scope, args;
        return function () {
            scope = this;
            args = arguments;
            id && clearTimeout(id);
            id = setTimeout(function () { 
                fn.apply(scope, args); 
            }, ms);
        };
    };
    term.addEventListener('keyup', delay(function () {
        var i;
        var val = RegExp.escape(this.value.replace(rtrim, ''));
        var re = new RegExp(val.replace(rsplit, '|'), 'g');
        for (i = 0; i < l; i++) {
            items[i].innerHTML = source[i].replace(re, wrapper);
        }
    }, 500));
});*/

// loading logo while ajax is fetching data
//$('#loading').hide().ajaxStart(function(){$(this).show();}).ajaxStop(function() {$(this).hide();});

</script>



<?php // if ($this->cart->total_items() > 0): ?>
<script>
$(document).ready(function()
{
		// update cart information every 5 seconds
		//setInterval(update_cart_details, 5000);
		
		//update cart on hover
		$('#cart').hover(update_cart_details);
		
		function update_cart_details()
		{
			
			// get the cart details 	
			var target_url = '<?php echo(base_url()."cart/info") ; ?>';
			$.ajax
			(
			{
				url : target_url,
				type: "POST",
				cache: false,
				success: function(data)
					{
						jstring = JSON && JSON.parse(data) || $.parseJSON(data);
						//console.log(data);
						//console.log(jstring);
						//alert(data);
					
			        $("#cart_preview ul").html("");
			        var i = 0 ; // number of items in the cart
			        var price = 0 ;
			        var currency = "<?php echo $CURRENCY ?>";		
			        var rate = "<?php echo $RATE ?>";		
					for (var key in jstring) 
					{
					  if (jstring.hasOwnProperty(key)) 
					  {
					    node0 = jstring[key] 
					    for (var key2 in node0) 
					    	{
							  if (node0.hasOwnProperty(key2)) 
							  {
							    i++;
							    //alert(key2 + " -> " + node0[key2]);
							    node1 = node0[key2] 
							    //alert(node1[key3]);
							    for (var key3 in node1) 
							    	{
									  if (node1.hasOwnProperty(key3)) 
									  {
									    
									   //alert(key3 + " -> " + node1[key3]);
									    if(key3 == "thumbnail")
									    {
									    	//var image_html = ;
									    	//alert(image_html);
									    	if(node1[key3] != ""){
												
									    	$("#cart_preview ul").append('<img src="' + node1[key3] + '" alt="thumbnail" > ' );
											}
									    	//alert(node1[key3]);
										} 
									    if(key3 == "name")
									    {
									    	// add name to the preview
									    	
									    	$("#cart_preview ul").append("<li>"+node1[key3]+"<li>");
									    	
									    	//alert(node1[key3]);
										}  
										if(key3 == "price")
									    {
									    	//add price to preview
									    	
												
									    	$("#cart_preview ul").append("<li> Price : "+currency+" "+rate*node1[key3]+"<li>");
									    	//alert(node1[key3]);
									    	price += parseInt(node1[key3]);
											
										}
										if(key3 == "id")
									    {
									    	
									    	var target_url_remove_item = '<?php echo base_url()."cart/remove_item/" ; ?>';
									    	var remove_item_url = '<a  class="remove_itm" id ="'+key2+'" href="'+target_url_remove_item+key2+'" > remove </a> ';
									    	$("#cart_preview ul").append(remove_item_url);
										}
									  	
									  }
									}
							    
							  }
							}
					  }
					}
					
					//alert("i = " + i );
					//alert("price = " + price );
					
					//add total cart price if number of items > 0  
					if(i > 0)
					{
					$("#cart_preview ul").append("<li> TOTAL: "+currency+" "+rate*price+"<li>");
						
					}
					
					// update the number on the cart icon
					$("#cart_num").html("( " + i + " )");
				},
				error: function(jqXHR, textStatus, errorThrown)
				{
					console.log("error while getting cart data from the server ");
				}
			});
		
		}
});		
</script>
<?php //endif ; ?>

<script>
$(document).ready(function(){

	/*$(".remove").click(function(){
		alert(11);
		//var row_id = $(this).attr("id");
		//alert(row_id);
		//remove_cart_item(row_id);
		
		//prevent default
		return false;
		
	});*/
	function remove_itm(){
		alert(11);
		console.log("removing item ... ");
		return false;
	}
	
	function remove_cart_item(row_id)
	{
		///////////// ajax cart update below
		
		var target_url = '<?php echo(base_url()."cart/remove") ; ?>';
		 				  	 
		var ProductData = {r_id:row_id,quantity:0};
		
		$.ajax(
		{
			url : target_url,
			type: "POST",
			cache: false,
			data : ProductData,
			success: function(data)
			{
				//update the cart icon
				cart = JSON && JSON.parse(data) || $.parseJSON(data);
				//alert(cart.num_of_items);
				var num_items = "( "+ cart.num_of_items + " )";
				$("#cart_num").html(num_items);
			},
			error: function(jqXHR, textStatus, errorThrown)
			{
				//  to do
				//$("#cart_notice").show();
				//$("#cart_notice").html('<pre><code class="prettyprint">AJAX Request Failed<br/> textStatus='+textStatus+', errorThrown='+errorThrown+'</code></pre>');
			}
		});
		//////////// end ajax cart update
	}
});
</script>



</body>
</html>