<?php 
$this->load->helper('url');
$CI =& get_instance();
$CI->load->library('cleanurl');
$CURRENCY = "$";
$RATE = 1;

 	
 	
 	
 	<?php //include "slider.php";?>
	
	<section>
		<div class="container">
			<div class="row">
				<?php include "cat_left.php";?>
				<div class="col-sm-9 padding-right">
					<?php include "slider.php";?>
						<div class="features_items"><!--features_items-->
					<?php 
						$temp=0;
						$menuItems = array_slice( $product_list, 0, 300 );
							foreach ($menuItems as $product) :
							if($product->product_id!=$temp){
								$temp=$product->product_id;
								 
					?>
						
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<?php
												$item_url = $product->name ;
						$item_clean_url = base_url()."product/".$CI->cleanurl->slug($item_url).'-item-'.$product->product_id.'.html' ; ?>
						
										<a href="<?php echo($item_clean_url );?>"><img src="<?php echo $product->image;?>" 
										alt=""onmouseover="this.src='<?php echo $product->alt_image_url;?>'"
onmouseout="this.src='<?php echo $product->image;?>'"></a>
										<h2><?php if(empty($product->salePrice)){echo $CURRENCY.number_format($product->price, 2, ',', ' ');  }else{?><del style="color: #929292;font-size: 16px;"><?php echo $CURRENCY.number_format($product->price, 2, ',', ' ');?></del><br/> <span class="price"><?php echo $CURRENCY.number_format($product->salePrice, 2, ',', ' ');?></span><?php } ?></h2>
										<p><?php echo $product->name;?></p>
										
									</div>
									
								</div>
								
							</div>
						</div>
					    <?php }?>
						<?php endforeach; ?>
					<!--	
						<ul class="pagination">
							<li class="active"><a href="">1</a></li>
							<li><a href="">2</a></li>
							<li><a href="">3</a></li>
							<li><a href="">»</a></li>
						</ul>
					-->
					</div>						
						
						
						
						
					</div>
				</div>
			</div>
		</section>
		