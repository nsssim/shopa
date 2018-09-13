<?php 
$this->load->helper('url');
$CI =& get_instance();
$CI->load->library('cleanurl');
$CURRENCY = "$";
$RATE = 1;
$CI->load->module("product");

//if( isset($is_search_result) ) echo "is_search_result---------->".$is_search_result." (product_vew line 9)<br>";

//if( isset($available_categories) )
//{
	//echo "<pre>";
	//echo "<h2> product_vew->available_categories (line13)</h2>";
	//var_dump($available_categories);
	//echo "</pre>";
//}


//echo "<pre>";
//echo "<h2> product_vew->available_cat_brands (line15)</h2>";
//var_dump($available_cat_brands);
//echo "</pre>";

//echo "<pre>";
//echo "<h2> product_vew->available_cat_colors (line10)</h2>";
//var_dump($available_cat_colors);
//echo "</pre>";


//echo "<pre>";
//echo "<h2> product_vew->available_cat_brands (line15)</h2>";
//var_dump($available_cat_brands);
//echo "</pre>";

//echo "<pre>";
//echo "<h2> product_vew->available_cat_sizes (line20)</h2>";
//var_dump($available_cat_sizes);
//echo "</pre>";

//echo "<pre>";
//echo "<h2> product_vew->available_cat_brands (line15)</h2>";
//var_dump($available_cat_brands);
//echo "</pre>";

//echo "<pre>";
//echo "<h2> product_vew->available_cat_sizes (line20)</h2>";
//var_dump($available_cat_sizes);
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



</script>

 	

<?php $cat_id = $CI->session->userdata("cat_id");
$ancestors_cat=$CI->categories->get_ancestors_categories($cat_id);
?>

	<section>
		<div class="container">
			
			<div class="row">
				<div class="col-sm-12 product-navi">
					<ul>
						<?php 
							$navicount=0;
							foreach (array_reverse($ancestors_cat) as $ancestors_cat1) :
						     foreach ($ancestors_cat1 as $ancestors_cat1) :	
						     $navicount++;
						    // print_r($ancestors_cat1);
						?>
						
						<li name="<?php echo($ancestors_cat1->name);?>" id="navitop<?php echo($navicount);?>"><?php echo($ancestors_cat1->name.' / ');?></li>
												<?php endforeach;
							endforeach;?>
					</ul>
					<span id="navicount" style="display: none"><?php echo($navicount);?></span>
				</div>
			
					
				<?php include "cat_left.php";?>
				<div class="col-sm-9 ">
					<?php include "slider.php";?>
					<?php include "filters_top.php";?>
						<div class="features_items"><!--features_items-->
						<div class="row">
							<div class="col-sm-5">
					<div class="pagination">
					<?php echo $pagination;?>
					</div>
							</div>
							<div class="col-sm-2">
					<?php $num_of_item = $this->session->userdata("num_of_item");
						echo  $num_of_item;
					?> items
							</div>
							<div class="col-sm-3">
							</div>
							<div class="col-sm-2 ">

								
<script>
    function post(numm) 
    {
       var key = document.getElementById("key").setAttribute('value','My  value');;
       key=numm;
       document.getElementById("key").value=key;
       var key1 = document.getElementById("key").value;
       //alert(key1);
       document.getElementById("myForm").submit();
    }
</script>

<?php 
if(isset($is_search_result))
{
	$trgt_url =  base_url().'product/listing/srch';
}
else
{
	$trgt_url =  base_url().'product/listing/id'.$cat_id;
}

?>
<form enctype="multipart/form-data" action="<?php echo $trgt_url;?>" method="post" id="myForm">
    <input name="per_page" type="hidden" id="key" value="val" />

<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									num
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#" onclick="post('60')">60</a></li>
									<li><a href="#" onclick="post('90')">90</a></li>
									<li><a href="#" onclick="post('120')">120</a></li>
									<li><a href="#" onclick="post('180')">180</a></li>
								</ul>
								</form>
												</div>
						</div>
					<?php
						//$_SESSION['startTime'] = microtime();
							/*echo "<pre>";
							var_dump($products);
							echo "</pre>";*/
							foreach ($products as $product) :
							//if($product_main_images[0]->actualWidth>$product_main_images[0]->actualHeight)
					$poduct_id=$product->id;
					$poduct_instock=$product->inStock;
					//$available=$CI->product->get_product_availability($poduct_id);			 
					if($poduct_instock==1){
					?>
					
						
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<?php
												$item_url =  $product->name ;
												$item_clean_url = base_url()."product/".$CI->cleanurl->slug($item_url).'-item-'.$poduct_id.'.html' ; ?>
						
										<a href="<?php echo($item_clean_url );?>">
											<?php  
												$product_main_images=$CI->product->get_product_images($poduct_id);
												$product_alt_images=$CI->product->get_product_alt_images($poduct_id);
												$product_colors=$CI->product->get_product_colors($poduct_id);?>
												<?php //list($widthp, $heightp) = getimagesize($product_main_images[0]->image);
													//$wh=$CI->product->get_image_wh($product_main_images[0]->image);
													// print_r($wh);
													
													//$widthp=$wh->width;
													//$heightp=$wh->height;
													//echo($widthp);
												?>
												
												<?php //echo $product_main_images[0]->actualHeight;?>
												<?php //echo $product_main_images[0]->actualWidth;?>
												
												
												
											<div  id="loadarea<?php echo $poduct_id;?>" style="height: 250px;">
												
												<div id="image-box-prod" 
													class="image-box1">
													
											<img id="product_main_images" name="n<?php echo $poduct_id;?>" src="<?php echo($product_main_images[0]->image);?>" 
											alt=""
											<?php if($product_alt_images)
							{?>onmouseover="this.src='<?php echo($product_alt_images[0]->alt_image_best);?>'"<?php }?>
											
											onmouseout="this.src='<?php echo($product_main_images[0]->image);?>'"/>
											
											
												</div>
											</div>
											</a>
											<?php 
												  //$difference = microtime() - $_SESSION['startTime'];
												//echo $difference;?>
											<?php if(count($product_colors)>1){?>
											<ul class="color-thub">
											<?php $color_num=0;$color_flag=0;
												foreach ($product_colors as $color) :?>
											<?php if($color_num<4){$color_num++;?>
											<!--<div name="colorboxalt" id="colorbox<?php echo($color->color_id);?>" class="color-filter-box-single" onclick="setcolororder('<?php echo($color->color_id);?>','<?php echo($color->image_url);?>')" onmouseover="colorphoto_list('<?php echo($color->image_url);?>','n<?php echo $poduct_id;?>')" onmouseout="orginalimage()"
   style="background-color:<?php echo($color->canonical_name);?>;">
									</div>-->
											<li>
											<a href="<?php echo($color->image_url);?>" onclick="return false;" rel="enlargeimage" rev="targetdiv:loadarea<?php echo $poduct_id;?>">
											<!--<img src="<?php echo($color->swatch);?>"/>-->
											<div name="colorboxalt" id="colorbox<?php echo($color->color_id);?>" 
												class="color-filter-box-single" 
   style="background-color:<?php echo($color->canonical_name);?>;">
											</a>
											</li>
											<?php }else{$color_flag=1;}?>
											<?php endforeach;?>
											<?php if($color_flag==2){?>
											<li>
											<a href="#" 
											rel="enlargeimage" rev="">
											more
											</a>
											</li>
											<?php }?>
											</ul><br/>
											<?php }?>
										<h2><br/><?php if(empty($product->salePrice)){echo $CURRENCY.number_format($product->price, 2, '.', ',');  }else{?><del style="color: #929292;font-size: 16px;"><?php echo $CURRENCY.number_format($product->price, 2, '.', ',');?></del><br/> <span class="price"><?php echo $CURRENCY.number_format($product->salePrice, 2, '.', '.');?></span><?php } ?></h2>
										<p><?php echo $product->name;echo($poduct_instock);?></p>
										
									</div>
									
								</div>
								
							</div>
						</div>
					    
					    
						<?php 
							}
							endforeach;
							?>
							<div class="pagination">
								<?php 
							echo $pagination;
							 ?>
							</div>
														 
					
					</div>						
				
						
					</div>
				</div>
					
			</div>
		</section>
	
	