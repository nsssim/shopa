<?php 
$this->load->helper('url');
$CI =& get_instance();
$CI->load->library('cleanurl');
$CURRENCY = "$";

$meta_description = " ";$meta_keyworks = " ";$meta_title = " "; $viewport = " ";

if (!empty($minfo)){
	foreach ($meta_info as  $minfo  )
	{
		if (!empty($minfo->description)) 	$meta_description = $minfo->description;
		if (!empty($minfo->keywords)) 	$meta_keyworks = $minfo->keywords; 	
		if (!empty($minfo->title)) 		$meta_title = $minfo->title ;			
		if (!empty($minfo->viewport)) 	$viewport = $minfo->viewport ;		
	}
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
<link rel='shortcut icon' type='image/ico' href= "<?php echo base_url().'assets/templates/Eshopper/images/home/favicon.ico';?>"  >

<!--____________________________________/ title \____________________________________ -->
    <title> <?php echo($meta_title) ?> </title>
    

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
	
	<!--____________________________________/ css \____________________________________-->

	<link href="<?php echo base_url().'assets/'.$template_info['path'].'/css/bootstrap.min.css';?>" rel="stylesheet">	
    <link href="<?php echo base_url().'assets/templates/Eshopper/css/font-awesome.min.css';?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/templates/Eshopper/css/prettyPhoto.css';?>"  rel="stylesheet">
    <link href="<?php echo base_url().'assets/templates/Eshopper/css/price-range.css';?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/templates/Eshopper/css/animate.css';?>" rel="stylesheet">
	<link href="<?php echo base_url().'assets/templates/Eshopper/css/main.css';?>" rel="stylesheet">
	<link href="<?php echo base_url().'assets/templates/Eshopper/css/responsive.css';?>" rel="stylesheet">
	<!--for autocomplete-->
	<link href="<?php echo base_url().'assets/templates/Eshopper/css/jquery-ui.css';?>" rel="stylesheet">
	
	
	<!--____________________________________/ responsive \____________________________________-->

    <!--[if lt IE 9]>
    <script src= "<?php echo base_url().'assets/templates/Eshopper/css/js/html5shiv.js';?>"   ></script>
    <script src= "<?php echo base_url().'assets/templates/Eshopper/css/js/respond.min.js';?>" ></script>
    <![endif]-->   
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url().'assets/templates/Eshopper/images/ico/apple-touch-icon-144-precomposed.png';?>"  >
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url().'assets/templates/Eshopper/images/ico/apple-touch-icon-114-precomposed.png';?>"  >
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url().'assets/templates/Eshopper/images/ico/apple-touch-icon-72-precomposed.png';?>" 	  >
    <link rel="apple-touch-icon-precomposed" href="<?php echo base_url().'assets/templates/Eshopper/images/home/gallery3.jpg';?>" >



</head>

<body>

	<?php include 'header.php';?>

	
	<section id="advertisement">
		<div class="container">
			<img src= <?php echo '"'.base_url().'assets/templates/Eshopper/images/shop/advertisement.jpg'.'"';?> alt="" />
		</div>
	</section>
	
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
						</div><!--/category-productsr-->
					
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
								 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="1000" data-slider-step="5" data-slider-value="<?php echo $prince_range ?>" id="price_sld" ><br />
								 <b id="min_range"><?php echo $CURRENCY ?>0</b> <b id="max_range" class="pull-right"><?php echo $CURRENCY ?>1000</b>
								 <br><br>
								 <div id="update_btn" class="pull-right" style = "color: #FFF;
									background-color: #FE980F;
									width: 53px;
									margin: 2px 0px 0px;
									padding: 0px 0px 0px 4px;
									border-radius: 9px;
									cursor: pointer;" > update 
								</div>
							</div>
						</div><!--/price-range-->
						
						<div class="shipping text-center"><!--shipping-->
							<img src="images/home/shipping.jpg" alt="" />
						</div><!--/shipping-->
						
					</div>
				</div>
				
					
				 
						<div class="col-sm-9 padding-right">
							<div class="features_items"><!--features_items-->
							<h2 class="title text-center">Search Result(s)</h2>
								<?php if($data):?>
									<?php foreach($data as $product):?>
									<?php $saleprice =  $product["product_details"][0]->salePrice ?>
									<!--<div style="border-style: solid;"><? print("<pre>".print_r($product,true)."</pre>");?> </div>-->
										<div class="col-sm-4">
											<div class="product-image-wrapper">
												<div class="single-products">
													<div class="productinfo text-center">
														<?php $item_clean_url = base_url()."product/".$CI->cleanurl->slug($product["product_details"][0]->name).'-item-'.$product["id"].'.html' ; ?>
														<a href="<?php echo($item_clean_url );?>">
														<img src=<?php 
														 if(!empty($product["product_img"][0]->image))
														 {echo $product["product_img"][0]->image;}
														 else 
														 {echo("https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/225px-No_image_available.svg.png");} ?> alt="" 
														 />
														</a>
														
														<h2> <?php if(!$saleprice) echo $CURRENCY." ".number_format($product["product_details"][0]->price, 2, ',', ' ') ;?> </h2>
														<h2> <?php if($saleprice) echo "<strike>".$CURRENCY." ".number_format($product["product_details"][0]->price, 2, ',', ' ')."<br></strike>"." <span style='color:#2ECC71;'>".$CURRENCY." ".number_format($saleprice, 2, ',', ' ')."</span>" ;?> </h2>
														<p><?php echo( $product["product_details"][0]->name ) ?> </p>
														<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
													</div>
													<!--<div class="product-overlay">-->
													<!--	<div class="overlay-content">
															<!--<h2>$56</h2>-->
															<!--<p>product title </p>-->
															<!--<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>-->
														<!--</div> -->
													<!--</div>-->
													<?php if ($saleprice) :?>
														
														<img src="<?php echo base_url().'assets/templates/Eshopper/images/home/sale.png';?>" class="new" alt="">
													<?php endif ?>
												</div>
												<!--<div class="choose">
													<ul class="nav nav-pills nav-justified">
														<li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
														<li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
													</ul>
												</div>-->
											</div>
										</div>
																
										
									<?php endforeach ?>
								<div class="pagination" style="padding: 0;margin-left: 35%;"><?php echo $pagination; ?>	</div>
								<?php endif ?>
								<?php if(!$data):?>
								<div style="font-size: 17px !important;line-height: 1.255 !important;font-family: Arial,sans-serif;text-rendering: optimizelegibility;" >
									Your search "<strong><?php echo $this->session->userdata("search_term"); ?></strong>"  did not match any product.
								</div>
								<?php endif ?>
										
							</div><!--features_items-->
							
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
					<p class="pull-left">Copyright © 2013 E-Shopper. All rights reserved.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
	

  <!--____________________________________/ javascript \____________________________________-->   

    <script src="<?php echo base_url().'assets/templates/Eshopper/js/jquery.js';?>"> </script>
	<script src="<?php echo base_url().'assets/templates/Eshopper/js/bootstrap.min.js';?>" ></script>
	<script src="<?php echo base_url().'assets/templates/Eshopper/js/jquery.scrollUp.min.js';?>" ></script>
	<script src="<?php echo base_url().'assets/templates/Eshopper/js/price-range.js';?>"> </script>
    <script src="<?php echo base_url().'assets/templates/Eshopper/js/jquery.prettyPhoto.js';?>"> </script>
    <script src="<?php echo base_url().'assets/templates/Eshopper/js/main.js';?>" > </script>
    <script src="<?php echo base_url().'assets/templates/Eshopper/js/jquery-ui.js';?>" > </script>
    
<script>

	var min_price = 0;
	var max_price = 1000 ;
	
	$("#price_sld").on("slide", function(slideEvt){
	var slide_val = $("#price_sld").val();
	if(!slide_val){
	var slide_val = slideEvt.value();
		
	}
	var price_range_array = slide_val.split(',')
	 min_price = price_range_array[0];
	 max_price = price_range_array[1];
	$("#min_range").text("<?php echo $CURRENCY ?>"+ min_price);
	$("#max_range").text("<?php echo $CURRENCY ?>"+ max_price);
	
	
	});
	
	
	$( "#update_btn" ).bind( "click", function() {
	
	  alert(min_price);
	  alert(max_price);
	  
	  
	  window.location.replace("http://www.usa.com/ushop/product/presearch/?min_price=10&max_price=300");
	  
	});
</script>

<!-- 
<input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" 
 data-slider-value="[250,450]" id="price_sld" ><br />
 -->

</body>
</html>