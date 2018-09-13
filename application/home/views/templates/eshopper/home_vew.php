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


 	<?php // include "css.php";?>
 	<?php // include "header.php";?>
 	<?php // include "slider.php";?>

 	<hr/>
	<section>
		<div class="container home-text">
			<div class="row">
				<div class="col-sm-6 vline">
					<h4>SIGN UP FOR EMAIL</h4>
					<p><b><u>sign up now</u></b></p>
					
				</div>
				
				<div class="col-sm-6">
					<h4>PRODUCT ON SALE</h4>
					<p>sale up to 70% off designers selection<br/><b><u>Shop Now</u></b></p>
					
				</div>
			</div>
		</div>
	</section>
	<hr/>
	
	<section>
		<div class="container home-text">
			<div class="row">
				<div class="col-sm-6 homban">
					<img src="<?php echo base_url().'assets/templates/eshopper/banner/bn1.jpg';?>" class="girl img-responsive" alt="" />
					
				</div>
				
				<div class="col-sm-6 homban">
					<img src="<?php echo base_url().'assets/templates/eshopper/banner/bn2.jpg';?>" class="girl img-responsive" alt="" />
				</div>
			</div>
		</div>
	</section>
	<hr/>
	<section>
		<div class="container">
			<div class="row">
				<?php //include "cat_left.php";?>
				<div class="col-sm-12 padding-right">
						<div class="features_items"><!--features_items-->
							<h2 class="title text-center">Features Items</h2>
							<!--~~~ start featured products here ~~~-->
							<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
								<div class="carousel-inner">
									<?php $c_count=0;$test=0;?>
									
							<?php 	foreach ($featured_items as $fitem) : ?>
							<?php if($c_count==0){?><div class="item <?php if($test==0){$test++;?>active<?php }?>"><?php }?>
							<?php if($fitem->product_price<75||$fitem->product_sale_price<75){?>
							<div class="col-sm-3">
								<div class="product-image-wrapper">
									<div class="single-products">
											<div class="productinfo text-center">
												<?php
												$item_url = $fitem->product_name ;
					$item_clean_url = base_url()."product/".$CI->cleanurl->slug($item_url).'-item-'.$fitem->prod_id.'.html' ; ?>
												<div class="home-fitem-img">
												<a href="<?php echo($item_clean_url );?>"> <img  src="<?php echo($fitem->product_image); ?>"  alt="" /> </a></div>
												<h2> <?php if(empty($fitem->product_sale_price)){echo $CURRENCY.number_format($fitem->product_price, 2, ',', ' ');  }else{?><del style="color: #000;font-size: 13px;"><?php echo $CURRENCY.number_format($fitem->product_price, 2, ',', ' ');?></del><br/> <span class="price"><?php echo $CURRENCY.number_format($fitem->product_sale_price, 2, ',', ' ');?></span><?php } ?></h2>
												<div class="product_title" ><?php echo ($fitem->product_name);   ?></div>
												<!--form method ="post" action="product_controller" >
												<a id="<?php echo($fitem->prod_id); ?>" href="#" class="btn btn-default add-to-cart">
												 
												 <i  class="fa fa-shopping-cart"></i>Add to cart</a> 
												</form>-->
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
							<?php }?>
							<?php $c_count++;if($c_count==4){?></div><?php $c_count=0; }?>
							<?php endforeach; ?>
									</div>
								</div>
							</div>
							<a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								  </a>
								  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
									<i class="fa fa-angle-right"></i>
								  </a>	
						</div><!--features_items-->
						
						
						
						
						
					</div>
				</div>
			</div>
		</section>
	<?php //	include "footer.php";
 	      //    include "script.php";
 	 ?>
	
	