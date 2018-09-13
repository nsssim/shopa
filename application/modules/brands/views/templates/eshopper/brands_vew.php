	<?php 
	$this->load->helper('url');
	$CI =& get_instance();
	$CI->load->library('cleanurl');
	$CURRENCY = "$";
	$RATE = 1;
	$CI->load->module("product");
	
	
	/*echo "<pre>";
	var_dump($categories_list);
	echo "</pre>";*/
	
	//echo "<pre>";
	//echo "<h2> brands_vew->brands_alpha (line 12)</h2>";
	//var_dump($brands_alpha['A'][0]['name']);
	//echo "</pre>";
	
	//echo "<pre>";
	//echo "<h2> brands_vew->left_categories_ids (line 17)</h2>";
	//var_dump($left_categories_ids);
	//echo "</pre>";
	
	/*echo "<pre>";
	echo "<h2> brands_vew->brands_list (line 22)</h2>";
	var_dump($brands_list);
	echo "</pre>";*/
	
	/*echo "<pre>";
	echo($brands_list->metadata->category->numId);
	echo "</pre>";*/
	
	
	?>
	
	
	
	<!--</script>-->
	
	 	
	
	<?php //$cat_id = $CI->session->userdata("cat_id");
	//$ancestors_cat=$CI->categories->get_ancestors_categories($cat_id);
	?>
	
		<section>
			<div class="container">
				
				<div class="row">
					<!--<div class="col-sm-12 product-navi">
						<ul>
							<?php 
								foreach (array_reverse($ancestors_cat) as $ancestors_cat1) :
							     foreach ($ancestors_cat1 as $ancestors_cat1) :	
							?>
							<li><a><?php echo($ancestors_cat1->name.' / ');?></a></li>
							<?php endforeach;
								endforeach;?>
						</ul>
					</div>-->
					
					<?php include "brands_cat_left.php";?>
					<div class="col-sm-9 ">
						
						<?php // include "slider.php";?>
						
						<section class="products-list"><!--slider-->
		
							<div class="row">
								<div class="col-sm-12">
							
								<img src="<?php echo base_url().'assets/templates/eshopper/banner/women/02.jpg';?>" class="girl img-responsive" alt="" />
										
								</div>
							</div>
								
						</section>

						
						<?php //include "filters_top.php";?>
														
							<hr/>
							<div class="brand-letters-area">
							<!--
								<?php 
		                        $alphas = range('A', 'Z');
		                        foreach($alphas as $key=>$value): ?>
		                        
								<?php 
								$to=0;
								
								foreach ($brands_alpha as $key1 =>$brands_pre) :
										if($key1==$value)
										{$to=1;}
									endforeach; ?>
					
								<span <?php if($to==1){?>class="brand_letters" onclick="gototoletter('#divbrand<?php echo $value;?>')"<?php }else{?>class="brand_letters-gray"<?php }?>>
								<?php echo ($value);?> </span>
								<?php endforeach; ?><span class="brand_letters">#</span>
							
							</div>-->
							
							<hr/>
							
							<?php
		                    $alphas = range('A', 'Z');
		                    $alphas_lowercase = range('a', 'z');
		                    ?>
		                    
							<?php foreach($alphas as $letter): ?>
		                    	<span class="letter_btn" onclick="scrollToAnchor('<?php echo $letter; ?>')"  ><?php echo $letter; ?> </span>
							<?php endforeach; ?>
		                    
		                    
		                    <span class="letter_btn" onclick="scrollToAnchor('pound')" >#</span><?php
							
							$flaga = $flagb = 0;
							
							//generate alphabet flags flag_A flag_B...flag_Z and intialize them to false
							foreach($alphas as $letter)
							{
								${"flag_".$letter} = 0;
							}
							
							//special flag for non alphabetic letters
							$flag_non_alpha = 0;
							
							
							foreach($brands_list->brandHistogram as $brand )
							{
								// first brand chacacter 
								$first_letter  = substr($brand->name,0,1);
								
								// for Brands starting with A B C D ...Z
								foreach($alphas as $letter)
								{
									if ($first_letter == $letter )
									{
										if (!${"flag_".$letter}) 
										{
											?>
											<a name="<?php echo $letter ?>"></a> <?php
											echo '<div class="letter_index" >'.$letter.'</div>';
											${"flag_".$letter} =1;
										}
										?>
										<div class="col-sm-4 " >
											<a style="color: black;" href="<?php echo base_url().'product/browse/?cat_id='.$brands_list->metadata->category->numId.'&brnd='.$brand->id; ?>">
											<?php
											echo $brand->name." <span style='color: grey;'>(".$brand->count.")</span>"."<br>";
											?>
											</a>
										</div>
										<?php
									} 
								
									
								}
								
								// for # - other brands 
								if (!in_array($first_letter, $alphas) and !in_array($first_letter,$alphas_lowercase)) 
									{
									    //echo $brand->name."<br>";
									    if (!$flag_non_alpha) 
										{
											?> <a name="<?php echo 'pound' ?>"></a> <?php
											echo '<div class="letter_index">#</div>';	$flag_non_alpha =1;
										}
										
											//echo $brand->name." <span style='color: grey;'>(".$brand->count.")</span>"."<br>";
										?>
										<div class="col-sm-4 " >
											<a style="color: black;" href="<?php echo base_url().'product/browse/?cat_id='.$brands_list->metadata->category->numId.'&brnd='.$brand->id; ?>">
											<?php
											echo $brand->name." <span style='color: grey;'>(".$brand->count.")</span>"."<br>";
											?>
											</a>
										</div>
										<?php
									    
									}

								/*if ($first_letter == "B")
								{
									if (!$flagb) 
									{echo '<hr/> <a name="B"></a>  <div name="B" class ="col-sm-12 brand_letters"><strong>B</strong></div>';	$flagb =1;}
									?>
									<div class="col-sm-4 brand-back" >
										<?php
										echo $brand->name."<br>";
										?>
									</div>
									<?php
								}*/
								
								//////////////////////////////////////////
								/*
								if ($first_letter == "A" )
								{
									if (!$flaga) 
									{echo '<div class ="brand_letters"><strong>A</strong></div>';	$flaga =1;}
									?>
									<div class="col-sm-4 brand-back" >
										<a style="color: black;" href="<?php echo base_url().'product/browse/?cat_id='.$brands_list->metadata->category->numId.'&brnd='.$brand->id; ?>">
										<?php
										echo $brand->name." <span style='color: grey;'>(".$brand->count.")</span>"."<br>";
										?>
										</a>
									</div>
									<?php
								} 
								
								if ($first_letter == "B")
								{
									if (!$flagb) 
									{echo '<hr/> <a name="B"></a>  <div name="B" class ="col-sm-12 brand_letters"><strong>B</strong></div>';	$flagb =1;}
									?>
									<div class="col-sm-4 brand-back" >
										<?php
										echo $brand->name."<br>";
										?>
									</div>
									<?php
								}
								*/
								//////////////////////////////////////////
								 
							}
							
							
							 ?>
							
							
							
							
							
							
							
							
							
							
							<!--<?php foreach ($brands_alpha as $key =>$brands_pre) : ?>
							<div class="row">
								<div class="col-sm-10" id="divbrand<?php echo $key;?>">
									<h2><?php echo($key);?></h2>
								</div>
								<div class="col-sm-2 brand-back">
										<div class="brand-top" onclick="gototop()">BACK TO TOP</div>
								</div>
									<?php
									foreach ($brands_pre as $brands) :
									//if($product_main_images[0]->actualWidth>$product_main_images[0]->actualHeight)
								//$poduct_id=$product->id;
								//$poduct_instock=$product->inStock;
								//$available=$CI->product->get_product_availability($poduct_id);			 
								if(1==1){
								?>
								
								
								<div class="col-sm-3">

								<a  class="brand-name" href="<?php  echo base_url();?>product/browse/?cat_id=<?php echo $category_id;?>&brnd=<?php echo $brands['id'];?>"><?php echo $brands['name'];?></a>
												
								</div>
							    
							    
								<?php 
									}
									endforeach;?>
							</div>
								<hr/>
								<?php
								endforeach;
								?>-->
								
															 
						
						</div>						
					
							
					</div>
				</div>
			</div>
						
			</section>
		