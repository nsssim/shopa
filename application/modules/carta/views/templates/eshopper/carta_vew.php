<?php 
$this->load->helper('url');
$CI =& get_instance();
$CI->load->library('cleanurl');
//$RATE = 1;

$ssl_port_num = ":".SSL_PORT;  // :443 is the default
$base_url_str = base_url(); 
$sbu = str_replace("http","https",$base_url_str );
$secure_base_url = str_replace(".com",".com$ssl_port_num",$sbu );

if($CI->cart->total_items() > 0)
{

?>


 	<?php
 	//include "css.php";?>
 	<?php //include "header.php";?>
 	
	
	
	<section id="cart_items">
		<div class="container">
		<div class="row">
		<div class="col-md-10">
			<div class="row">
				<div class="col-sm-12">
					<p><span class="your-bag"><!--Your Cart--> <?php echo $words['your_cart'];?>  </span> <span class="bag-id"><!--Bag ID:1686-48969--></span></p> <!--<span class="chat"><img src='<?php echo base_url()."assets/templates/eshopper/images/chatOffline.gif" ?>'></span>-->
				</div>
				<!--<div class="col-sm-12">
					<div class="choose-store">
						<p><span class="color left">WANT IT TODAY?</span> <span class="left">Item(s) in this order may be available for in-store pickup.</span> <span class="left"><a href="#" title="">details</a></span><button href="#" class="btn">CHOOSE A STORE</button></p>
					</div>
				</div>-->
			</div>
				<!--<td><p id="<?php echo('upr_'.$itefm['rowid']) ; ?>" ><span ><?php echo($currency);?><?php   echo(number_format($item['price'], 2, '.', ','))  ?></span> </p></td>-->
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive shop-table"> 
						<table class="table table-bordered">
							<thead>
								<tr>
									<th><?php echo $words['item'];?></th>

									<th><?php echo $words['delivery'];?></th>

									<th><?php echo $words['price'];?></th>

									<th><?php echo $words['qty'];?></th>

									<th><?php echo $words['total'];?></th>
								</tr>
							</thead>

							<tbody>
							
							<?php $row_flag = 0 ?>
							<?php foreach ($this->cart->contents() as $item) : ?>
							<span id="price<?php echo($item['rowid']);?>" style="display:none"><?php echo $item['price'];?></span>
								
								<?php $row_style=""; if($row_flag == 0) $row_style='border-top:none;' ; else $row_style='border-top: 1px dashed #666;';  ?>
								<tr style= "<?php echo $row_style; ?>"  id="<?php 	echo($item['rowid'])  ?>">
								<?php $row_flag++; ?>
								
									<td>
									<div class="cart_product">
									<?php if(!empty($item['cat_id'])) : ?>
										<a href="<?php echo(base_url().'product/cart-details-item-'.$item['id'] .'-cat_id-'. $item['cat_id'].'.html') ?>"><img src="<?php 	echo($item['thumbnail'])  ?>" alt=""></a>
									<?php else : ?>
										<a href="<?php echo(base_url().'product/cart-details-item-'.$item['id'].'.html') ?>"><img src="<?php 	echo($item['thumbnail'])  ?>" alt=""></a>
									<?php endif; ?>
									</div>
									
									<div class="cart_description">
									<?php if(!empty($item['cat_id'])) : ?>
									<h6><a href="<?php echo(base_url().'product/cart-details-item-'.$item['id'] .'-cat_id-'. $item['cat_id'].'.html') ?>"> <?php 	echo($item['name'])  ?> </a></h6> 
									<?php else : ?>
									<h6><a href="<?php echo(base_url().'product/cart-details-item-'.$item['id'].'.html') ?>"> <?php 	echo($item['name'])  ?> </a></h6>
									<?php endif; ?>
									
									<p><?php if($item['color_name']!=""){?><span class="scaprt"><?php echo $words['color'];?>: </span><font size="small" > <?php echo($item['color_name'].'</br>') ;?> </font> <?php }?>
									<?php if($item['size_name']!=""){?><span class="scaprt"><?php echo $words['size'];?>: </span><?php 	echo($item['size_name']) ; ?><?php }?>
									<br/><span class="scaprt">Web ID: </span><?php 	echo($item['id'])  ?> </p>
									</div>
									</td>

									<td><p><?php echo $words['delivery_msg']; ?></p></td>

									<td><p id="<?php echo('upr_'.$item['rowid']) ; ?>" ><span ><?php echo($currency);?><?php   echo(number_format($item['price'], 2, '.', ','))  ?></span> </p></td>

									<td class="cart_quantity">
										<div class="cart_quantity_button">
											<!--<a class="cart_quantity_down" style=" cursor: pointer; " > - </a>-->
											<select id="<?php 	echo('qty_'.$item['rowid'])  ?>" class="cart_quantity_input" name="quantity" value="" autocomplete="off" size="1">
												<option value="1" <?php if($item['qty'] == 1) echo " selected "; ?> > 1</option>
												<option value="2" <?php if($item['qty'] == 2) echo " selected "; ?> > 2 </option>
												<option value="3" <?php if($item['qty'] == 3) echo " selected "; ?> > 3 </option>
												<option value="4" <?php if($item['qty'] == 4) echo " selected "; ?> > 4 </option>
												<option value="5" <?php if($item['qty'] == 5) echo " selected "; ?> > 5 </option>
												<option value="6" <?php if($item['qty'] == 6) echo " selected "; ?> > 6 </option>
											</select>
											<!--<a class="cart_quantity_up" style=" cursor: pointer; "> + </a>-->
										</div>
										
										<p  id="<?php 	echo('rmv_'.$item['rowid'])  ?>" class="row_quantity_delete" style=" cursor: pointer;" ><?php echo $words['remove']; ?> </p>
									</td>

									<td><p style="font-weight: bold;" id="<?php echo('tpr_'.$item['rowid'])  ?>" class="cart_total_price"><?php echo($currency.(number_format($item['price']*$item['qty'], 2, '.', ',')));?>  </p></td>
								</tr>
							<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-sm-6">
					<p class="cart-note"><?php echo $words['note'];?> </p>
					
					<div class="cart_box">
							<form>
								<table>
									<tr>
										<td><input  id="ctcoc1"  style="cursor: pointer;" type="radio" class="customer_take_care_of_customs" name="customer_take_care_of_customs" value="0" > </td>
										<td><label  for="ctcoc1" style=" margin-left: 5px; cursor: pointer;" > <?php echo $words['pay_duties_now'];?> <span data-toggle="tooltip" title="<?php echo $words['pay_duties_now_hint'];?>" class="glyphicon glyphicon-info-sign" aria-hidden="true" style="color: #124fe1;" ></span> </label>  </td> 
									</tr>
									<tr>
										<td><input id="ctcoc0"  style="cursor: pointer; "type="radio" class="customer_take_care_of_customs" name="customer_take_care_of_customs" value="1"></td>
										<td><label for="ctcoc0" style=" margin-left: 5px; cursor: pointer;" > <?php echo $words['pay_duties_dlvry'];?> <span data-toggle="tooltip" title="<?php echo $words['pay_duties_dlvry_hin'];?>" class="glyphicon glyphicon-info-sign" aria-hidden="true" style=" color: #124fe1;" ></span> </label>  </td>
									</tr>
								</table>
							</form> 
						</div>
					
						<!--<div style="display: none; margin-top: 10px;" id="message_box">  </div>-->
						<div><?php echo $words['delivered_in_x_day'];?></div>
				</div>
				<div class="col-sm-6">
					<div class="shop-details clearfix">
						<div class="col-sm-12">
							<form class="form-inline">
								<div class="row">
									<div class="col-sm-8">
										<div class="form-group">
											<div class="col-sm-12" style="height: 15px;"  > &nbsp;</div>
											<label for="promo_code_field"><?php echo $words['promotion_coupon'];?></label>
											<input id="promo_code_field" type="text" class="form-control input-lg">
										</div>
									</div>
									<div class="col-sm-4">
										<div class="col-sm-12" style="height: 15px;"  > &nbsp;</div>
										<button id="promo_code_btn" type="submit" class="btn btn-primary btn-lg"><?php echo $words['apply'];?></button>
									</div>
									<div class="col-sm-12" id="error_promo_msg" style="color: red; padding-top: 10px; display:none; ">
										<span><!--invalid prmotion code --> <?php echo $words['wrong_promo'];?></span>
									</div>
									<div class="col-sm-12" id="success_promo_msg" style="color: green; padding-top: 10px; display:none; ">
										<span ><!--prmotion code was successfully applied --> <?php echo $words['promo_success'];?></span>
									</div>
									<div class="col-sm-12" id="promo_code_field_error" style="color: red; padding-top: 10px; display:none; ">
										<span><!--Character not allowed--> <?php echo $words['not_allowed'];?> </span>
									</div>
									
								</div>
							</form>
						</div>
						<div class="col-sm-12">
							<div class="row">
								 <div class="cart-subtotal">
									<p> <?php echo $words['o_subtotal'];?> <span id="order_sub_total" ><?php echo($currency.number_format($order_sub_total, 2, '.', ','));?></span></p>
								</div>
								
								<div class="cart-subtotal">
									<p><?php echo $words['shipping'];?>   <span  id="shipping_fee" ><?php echo($currency.number_format($shipping_and_handling_fee, 2, '.', ','));?></span></p>
								</div>
								
								<div class="cart-subtotal" >
								<?php if($discount_total > 0): ?>
									<p style="color: black;border: solid 1px #0CB408; background-color: #EFEFEE;" id="discount_total_line" >       <?php echo $words['total_discount'];?>            <span  id="total_discount" ><?php echo("- ".$currency.number_format($discount_total, 2, '.', ','));?></span></p>
								<?php else: ?>
									<p style="color: black;border: solid 1px #0CB408; background-color: #EFEFEE; display: none" id="discount_total_line" >       <?php echo $words['total_discount'];?>            <span  id="total_discount" ><?php echo("- ".$currency.number_format($discount_total, 2, '.', ','));?></span></p>
								<?php endif; ?>
								</div>
								
								<div class="cart-subtotal">
									<p>      <?php echo $words['sub_total'];?>             <span  id="sub_total" ><?php echo($currency.number_format($subtotal, 2, '.', ','));?></span></p>
								</div>
								
								<div class="cart-subtotal">
									<p id="custom_fee_line" ><?php echo $words['custom'];?> <span    id="custom_fee"><?php echo($currency.number_format($optional_custom_fees, 2, '.', ','));?></span>  </p>
								</div>
								
								<div class="cart-subtotal">
									<p><?php echo $words['grand_total'];?> <span id="grand_total" ><?php echo($currency.number_format($grand_total, 2, '.', ','));?></span></p>
								</div>
								
							</div>
								<!--<p>Shipping, duties & taxes calculated at checkout (if applicable)</p>-->
						</div>
					</div>
						<div class="col-sm-12 button-checkout">
							<div class="row">
								<!--<button type="submit" class="btn btn-primary">CONTINUE CHECKOUT</button>-->
								<a href="<?php echo $secure_base_url.'checkout/check' ; ?>" class="btn btn-primary"><?php echo $words['continue_checkout'];?> </a>
							</div>
						</div>
						<div class="col-sm-12 button-shopping">
							<div class="row">
								<a href="<?php echo base_url(); ?>"  class="btn btn-primary"><?php echo $words['continue_shopping'];?></a>
							</div>
						</div>
						<div class="col-sm-12"> &nbsp; </div>
				</div>
			</div>
		</div>
			<!--------------------->
			<div class="container">
			<div class="row">
					<div class="col-md-2" style="padding-left: 1px;padding-right: 1px;width: 15.2%;" >
						<!--ticker begin-->
						<?php if(!empty($lists['featured_single_right'])) :?> 	
						<div class="panel panel-default" style="background-color: #F3F3F3;border-radius: 0; border:none; "  >
							<div class="col-md-12" style="text-align: center;" class="xxxxx"> 
							<p><!--Customers Also Bought--> <?php echo $words['related'];?> </p>
							<a href="#" class="prev" style="color: black; text-decoration: none;"> <img style="width: 40px;" src="<?php echo base_url().'assets/templates/eshopper/images/down_arrow.png' ?>" /> </a>
							<a href="#" class="next" style="color: black;"> <img style="width: 40px;" src="<?php echo base_url().'assets/templates/eshopper/images/up_arrow.png' ?>" /> </a>
							<div class="col-md-12" style="height: 10px;" ></div>
								<!--<div class="clearfix"></div> 
								<ul class="pagination" style="margin: 0px;">
								<li><a href="#" class="prev"><span class="glyphicon glyphicon-chevron-down"></span></a></li>
								<li><a href="#" class="next"><span class="glyphicon glyphicon-chevron-up"></span></a></li>
								</ul>
								<div class="clearfix"></div> -->
							</div>
							<!--<div class="panel-heading"> <span class="glyphicon glyphicon-list-alt"></span><b>News</b></div> -->
							<div class="panel-body" style="padding: 0;"  >
								<div class="row" style="width: 100%;margin-right: 0;margin-left: 0;" >
									<div class="col-xs-12">
										<ul id="ticker" style="padding-left: 0px" >
											<?php foreach ($lists['featured_single_right'] as $fitem) :?>
											
											<!--<li class="news-item"> <img width="100%" src="https://resources.shopstyle.com/pim/7f/73/7f7329fed96935939a19ad007f8fb9d2_best.jpg" > <div class="product_d" > rhoncus neque id, fringilla dolor. <a href="#">Read more...</a> </div> </li>-->
											<li class="news-item">
												<?php 
												$item_url = $fitem->name ;
												$cat_id = $fitem->categories[0]->numId;
												$item_clean_url = base_url()."product/".$CI->cleanurl->slug($item_url).'-item-'.$fitem->id.'-cat_id-'.$cat_id.'.html' ; ?>
												<div style="text-align: center;" >
													<a href="<?php echo($item_clean_url );?>"> 
														<img width="100%"  src="<?php echo $fitem->image->sizes->Large->url;?>"alt=""/>
														<div> <?php echo $fitem->name; ?>  </div>
														<?php $pprice =NULL; if(!empty($fitem->salePrice)) $pprice =$fitem->salePrice; else $pprice =$fitem->price; ?>
														<div> <?php echo($currency.number_format($pprice, 2, '.', ','));?> </div>
													</a>
												</div>
												<div class="col-md-12" style="height: 10px;" ></div>
											 </li>
											<?php endforeach ;?>
										</ul>
									</div>
								</div>
								<div class="col-md-12" style="text-align: center;"> 
									<a href="#" class="prev" style="color: black; text-decoration: none;"> <img style="width: 40px;" src="<?php echo base_url().'assets/templates/eshopper/images/down_arrow.png' ?>" /> </a>
									<a href="#" class="next" style="color: black;"> <img style="width: 40px;" src="<?php echo base_url().'assets/templates/eshopper/images/up_arrow.png' ?>" /> </a>
									<div class="col-md-12" style="height: 10px;" ></div>
								</div>
							</div>
						</div>
						<?php endif; ?> 	
						<!--ticker end-->
						
						<div class="col-md-12" >
							<div style="height: 15px;" class="col-sm-12">  </div>
							<a href="<?php echo $secure_base_url.'customer/my_account' ; ?>" > <img width="100%" src='<?php echo base_url().$words["signup_now_img"] ?>' /></a>	
							<div style="height: 15px;" class="col-sm-12">  </div>
							<!--<div style="height: 15px;" class="col-sm-12">  </div>
							<img width="100%" src="<?php echo base_url().'assets/templates/eshopper/images/cart/signup-now2.gif' ?>" />
							<div style="height: 15px;" class="col-sm-12">  </div>
							<img width="100%" src="<?php echo base_url().'assets/templates/eshopper/images/cart/signup-now.gif' ?>" />
							-->
						</div>
						
					</div>
				</div>
			</div>
			
			
		</div>
	</div>
	</section> <!--/#cart_items-->

	
	<!--pop up update address div -->
	<div class="popup" data-popup="pop_up_box">
	    <div class="popup-inner edit-box">
	    	
	        <img class="map-img" src="http://www.confessionsofacouponaholic.com/wp-content/uploads/2012/12/double-coupons.jpg">
	        <a class="popup-close" data-popup-close="pop_up_box" href="#">x</a>
	    </div>
	</div>
	<!--end pop up update address div-->

<?php
}// end of if cart is not  empty

//else =  if cart is empty 
else
{
	
	redirect( $secure_base_url."customer/my_account" ) ; 
	//echo("<h3 style='text-align: center;' >did you miss something ?<h3><img style='position: relative;left: 50%;margin-left: -270px' src='http://www.mintagetrading.com/template/img/empty_cart.jpeg' />");
}
?>	

<script>

</script>