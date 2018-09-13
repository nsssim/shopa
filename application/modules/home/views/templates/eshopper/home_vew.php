<style type="text/css">
body {
    overflow-x:hidden;
}
</style>
<?php $fitem = NULL;?>
<?php 
$CI =& get_instance();
$CI->load->helper('url');
$CI->load->library('cleanurl');

//this block should be on each page that has a price 
$CI->load->module('currency');
$CI->currency->set_currency(); // no parameter ==> usd will be the default
$CURRENCY = $CI->session->userdata("CUR_SIGN");
//$CURRENCY= '$';
$RATE = $CI->session->userdata("CUR_RATE");
//$RATE =1;
// this block should be used when the user changes the currency, here are the currency ids 
// 643	=>	Russian Ruble
// 840  =>	US Dollar
// 949  =>	Turkish Lira
// 978  =>	Euro
// $CI->currency->change_currency(949); // change currency to Turkish Lira can be called via ajax 
// $CURRENCY = $CI->session->userdata("CUR_SIGN");
// $RATE = $CI->session->userdata("CUR_RATE");

//echo "<h3>Home_vew->lists (Line 23)</h3>";
//echo "<pre>";
//var_dump($lists->lists[2]->favorites[5]->product->name);
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


 	<?php //include "css.php";?>
 	<?php //include "header.php";?>
 	<?php //include "slider.php";?>
 	<hr/>
	<section>
		<div class="container home-text">
			<div class="row">
				<div class="col-sm-6 vline">
					<h4><?php echo $words["left_txt1"]; ?></h4>
					<p class="home-signup-text"><?php echo $words["left_txt2"]; ?></p>
					<p><span  class="sign-up-button"><?php echo $CI->lang->line('wrd_home_sign_up'); ?></span></p>
				</div>
				
				<div class="col-sm-6">
					<h4><?php echo $words["right_txt1"]; ?></h4>
					<!--<p class="home-signup-text">Sale up to <b>70% off </b>designers selection</p>-->
					<p><span  class="sign-up-button"><?php echo $words["right_txt2"]; ?></span></p>
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
							<!--<h2 class="title text-center">Featured Items</h2>-->
							<h2 class="title text-center"><?php echo $words["featured_items"]; ?></h2>
							<!--~~~ start featured products here ~~~-->
							<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
								<div class="carousel-inner">
									<?php $c_count=0;$test=0;$ii=0;?>
								<?php 	for($ii=1;$ii<4;$ii+=2){
									foreach ($lists['featured_home'] as $fitem) : ?>
							
							<?php //if($fitem->product_price<76){?>
							<?php if($c_count==0){?><div class="item <?php if($test==0){$test++;?>active<?php }?>"><?php }?>
							<div class="col-sm-3">
								<div class="product-image-wrapper">
									<div class="single-products">
										<?php //list($width, $height) = getimagesize($fitem->product_image);?>
											<div class="productinfo-home-feachered text-center <?php //if($width<$height){?>f-home-portrate<?php //}else{?>f-home-landscape<?php //}?>">
												<?php
												if(!empty($fitem->categories[0]->numId)) $fitem_cat_id = $fitem->categories[0]->numId ;
												else $fitem_cat_id = 2 ; // set to women category in emergency cases ;
												$item_url = $fitem->name;
												$item_clean_url = base_url()."product/".$CI->cleanurl->slug($item_url).'-item-'.$fitem->id.'-cat_id-'.$fitem_cat_id.'.html' ; ?>
												<div class="home-fitem-img">
												<a href="<?php echo($item_clean_url );?>"> <img  src="<?php echo($fitem->image->sizes->XLarge->url); ?>"  alt="" /> </a></div>
												<h2> <?php if(empty($fitem->sale_price)){echo $CURRENCY.number_format($fitem->price, 2, ',', ' ');  }else{?><del style="color: #000;font-size: 13px;"><?php echo $CURRENCY.number_format($fitem->price, 2, ',', ' ');?></del><br/> <span class="price"><?php echo $CURRENCY.number_format($fitem->sale_price, 2, ',', ' ');?></span><?php  } ?></h2>
												<div class="product_title" ><?php echo ($fitem->name);   ?></div>
												
											</div>
											
									</div>
									
								</div>
							 
							</div>
							
							<?php $c_count++;if($c_count==4){?></div><?php $c_count=0; }?>
							<?php //}?>
							<?php endforeach;
								} ?>
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
		</section>
	
	
	