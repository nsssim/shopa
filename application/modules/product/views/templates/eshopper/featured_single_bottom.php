<section>
		<div class="container">
			<div class="row">
				<?php //include "cat_left.php";?>
				<div class="col-sm-12 padding-right">
						<div class="features_items"><!--features_items-->
							<h2 class="featured_items_title text-center"> <?php echo $words['featured_items'] ?> </h2>
							<!--~~~ start featured products here ~~~-->
							<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
								<div class="carousel-inner">
									<?php $c_count=0;$test=0;$ii=0;?>
								<?php 	for($ii=1;$ii<4;$ii+=2){
									foreach ($lists['featured_single_bottom'] as $fitem) : ?>
							
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
														$item_url = $fitem->name ;
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