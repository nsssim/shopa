<div class="col-sm-12 padding-right right-side-product">
						<div class="features_items"><!--features_items-->
							<h2 class="title text-center"></h2>
							<!--~~~ start featured products here ~~~-->
							
							<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
								<div class="carousel-inner">
									<?php 
										
										//$random_items=$CI->product->get_category_random_products($product_cat_id,16);
										//print_r($random_items);
										$c_count=0;$test=0;?>
									
							<?php
								if($combo){ 	
								foreach ($combo as $fitem) :?>
							<?php if($fitem->price<76){?>
							<?php
								
								$product_main_images=$CI->product->get_product_images($fitem->id); 
								$product_alt_images=$CI->product->get_product_alt_images($fitem->id);?>
							<?php if($c_count==0){?><div class="item <?php if($test==0){$test++;?>active<?php }?>"><?php }?>
							<div class="col-sm-12" style=" padding-left: 0px; padding-right: 0px; ">
								
								<div class="product-image-wrapper">
									<div>
											<div class="productinfo-rightside text-center">
												<?php
												$item_url = $fitem->name ;
					$item_clean_url = base_url()."product/".$CI->cleanurl->slug($item_url).'-item-'.$fitem->id.'.html' ; ?>
												<div >
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
							<?php $c_count++;if($c_count==3){?></div><?php $c_count=0; }?>
							<?php }?>
							<?php endforeach; 
								}
							?>
									</div>
								</div>
							</div>
							
						</div><!--features_items-->
						
						
						
						
						
					</div>
