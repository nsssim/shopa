<?php 
$this->load->helper('url');
$CI =& get_instance();
$CI->load->library('cleanurl');
//$RATE = 1;
$currency = "$";
//var_dump($order_details);
$cart_content_file_path = $order_details->orders_detail_cart_content; 
$cart_content = NULL;
		if(file_exists($cart_content_file_path))
		{
			$cart_content_file_gz = file_get_contents($cart_content_file_path); // read file
			$cart_file_json = gzdecode($cart_content_file_gz); // uncompress the file
			$cart_content = json_decode($cart_file_json, true); // decode from json to object
		}
//var_dump($cart_content);
//var_dump($this->cart->contents());
$oo=55;
?>
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<h3> <?php echo $words['order_details'] ?> <!--ORDER DETAILS--></h3>
				
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image"><!--item--> <?php echo $words['item'];?></td>
							<td class="description"></td>
							<td class="description"> <?php echo $words['delivery'];?></td>
							<td class="price"> <?php echo $words['price'];?></td>
							<td class="quantity"> <?php echo $words['qty'];?></td>
							<td class="total"> <?php echo $words['subtotal_tbl_hdr'];?></td>
							<td class="total"> &nbsp; </td>
						</tr>
					</thead>
					<tbody>
					<?php if(!empty($cart_content))	  
					{ 
						foreach ($cart_content as $item) : 
					?>
						<!-- this where we get the price without any coma or dots  -->
						<span id="price<?php echo($item['rowid']);?>" style="display:none"><?php echo $item['price'];?></span>
						
					<tr id="<?php 	echo($item['rowid'])  ?>" class="crow" >
							<td class="cart_product">
								<?php if(!empty($item['cat_id'])) : ?>
									<a href="<?php echo(base_url().'product/cart-details-item-'.$item['id'] .'-cat_id-'. $item['cat_id'].'.html') ?>"><img src="<?php 	echo($item['thumbnail'])  ?>" alt=""></a>
								<?php else : ?>
									<a href="<?php echo(base_url().'product/cart-details-item-'.$item['id'].'.html') ?>"><img src="<?php 	echo($item['thumbnail'])  ?>" alt=""></a>
								<?php endif; ?>
							</td>
							<td class="cart_description" style="/*background-color: yellow;*/ width: 15%;">
								<?php if(!empty($item['cat_id'])) : ?>
								<h4><a href="<?php echo(base_url().'product/cart-details-item-'.$item['id'] .'-cat_id-'. $item['cat_id'].'.html') ?>"> <?php 	echo($item['name'])  ?> </a></h4> 
								<?php else : ?>
								<h4><a href="<?php echo(base_url().'product/cart-details-item-'.$item['id'].'.html') ?>"> <?php 	echo($item['name'])  ?> </a></h4> 
								<?php endif; ?>
								
								<p><?php if($item['color_name']!=""){?><span class="scaprt">Color: </span><font size="small" > <?php echo($item['color_name'].'</br>') ;?> </font> <?php }?>
								<?php if($item['size_name']!=""){?><span class="scaprt">Size: </span><?php 	echo($item['size_name'].'</br>') ; ?><?php }?>
								<br/><span class="scaprt">Web ID: </span><?php 	echo($item['id'])  ?> </p>
							</td>
							<td class="xxxxxxxxxxxx" style="/*background-color: pink*/">
								<?php //echo $words['delivery_msg']; ?>
							</td>
							<td class="cart_price">
								<p><span ><?php echo($currency);?><?php   echo(number_format($item['price'], 2, '.', ','))  ?></span> </p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<!--<a class="cart_quantity_down" style=" cursor: pointer; " > - </a>-->
									<span class="cart_quantity_input">  <?php echo($item['qty']) ; ?> </span>
									<!--<a class="cart_quantity_up" style=" cursor: pointer; "> + </a>-->
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">   <?php echo($currency.(number_format($item['price']*$item['qty'], 2, '.', ',')));?>  </p>
							</td>
							<td class="cart_total">
								<!--<p  class="cart_quantity_delete" style=" cursor: pointer;" >	<i class="fa fa-times"></i> </p>-->
							</td>
							
							
							
						</tr>
					
					 <?php endforeach; ?>
					 <?php 
					} 
					else
					{
					?>
						<div class="alert alert-danger">
						  <strong>Order content not found !</strong> this order details has been deleted Contact us for more more information .
						</div>
					<?php } ?> 
						
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading">
				
			</div>
			<div id="container2" class="row">
			
			
				
<!--				<div class="col-sm-6 pull-left">
					<div class="cart_box" style="padding-left: 26%;">
						<label for="promo_code_field"><?php echo $words['promotion_coupon'];?></label><br>
						<input id="promo_code_field" type="text" name="promo_code" style="line-height: 2em;"/>
						<a id="promo_code_btn" class="btn btn-default " style="display: inline;background-color: black;color: white;" href='#'> <?php echo $words['apply'];?></a>
						<div style="display: none;" id="loadingDiv"> <img src='<?php echo base_url()."assets/templates/eshopper/images/loadingwsm.gif";?>' /> </div>
						<div style="display: none; margin-top: 10px;" id="message_box">  </div>
					</div>
				</div>
-->				
				
				
				
				
				
				<div class="col-sm-6 pull-right">
					<!--<div id="CartPromoTotals">
						
						<div class="tot_row">
							<div class="total_title"> 
								<div class="orderTotalItemKey"><?php echo $words['subtotal'];?> </div>
								<div class="orderTotalItemValue"><span id="sub_total" ><?php echo($currency.number_format($total_items, 2, '.', ','));?></span></div>
							</div>
						</div>
						
						<form id="bagPromoCodesForm" class=" ">
							<div id="promoCodeContainer">
								<div class="promoCopy">
								HAVE A PROMO CODE?
								</div>
								<div id="promoFields">
									<div class="promoFieldContainer " id="PromoCodeOneContainer">
									<input class="promoText" maxlength="30" value="" title="Promo Code" id="promoCode" type="text">
									</div>
									
									<div id="applyPromoContainer" class="">
									<input id="lnkApplyPromos" class="button" name="APPLY_BUTTON" value="Apply" type="submit">
									</div>
								</div>
								<div class="clearBoth"></div>
							</div>
						</form>
						
						<div class="tot_row">
							<div class="total_title"> HAVE A PROMO CODE ?</div>
							<div><span><input /></span> <button>okfdoks</button></div>
						</div>
					
					</div>-->
					
					
					
					
					<div class="total_area">
						<ul>
							<li> <?php echo $words['order_subtotal'];?> <span id="order_sub_total" ><?php echo($currency.number_format($order_details->v_order_sub_total , 2, '.', ','));?></span></li>
							
							<li><?php echo $words['shipping'];?> <span  id="shipping_fee" ><?php echo($currency.number_format($order_details->v_shipping_and_handling_fee, 2, '.', ','));?></span></li>
							
							<?php if($order_details->v_discount_total > 0): ?>
							<li id="discount_total_line" >       <?php echo $words['total_discount'];?>            <span  id="total_discount" ><?php echo($currency.number_format($order_details->v_discount_total , 2, '.', ','));?></span></li>
							<?php endif; ?>
							
							<li>      <?php echo $words['subtotal'];?>             <span  id="sub_total" ><?php echo($currency.number_format($order_details->v_subtotal, 2, '.', ','));?></span></li>
							
							<li id="custom_fee_line" ><?php echo $words['customs'];?> <span    id="custom_fee"><?php echo($currency.number_format($order_details->v_optional_custom_fees, 2, '.', ','));?></span>  </li>
							
							<li style="background-color: #ffffff;margin: 0;padding: 0;" > &nbsp; </li>
							
							<li><?php echo $words['grand_total'];?> <span id="grand_total" ><?php echo($currency.number_format($order_details->v_grand_total, 2, '.', ','));?></span></li>
						</ul>
					</div>
				</div>
				
				<!--<div class="col-sm-6 pull-left">
						
					<div class="cart_box">
						<form>
							<table>
							    <tr>
							        <td><input  id="ctcoc1" type="radio" class="customer_take_care_of_customs" name="customer_take_care_of_customs" value="0" > </td>
							        <td><label  for="ctcoc1"> <?php echo $words['pay_duties_now'];?> </label> <span data-toggle="tooltip" title="<?php echo $words['pay_duties_now_hint'];?>" class="glyphicon glyphicon-info-sign" aria-hidden="true" style="color: #124fe1;" ></span> </td> 
							    </tr>
							    <tr>
							        <td><input id="ctcoc0" type="radio" class="customer_take_care_of_customs" name="customer_take_care_of_customs" value="1"></td>
							        <td><label for="ctcoc0"> <?php echo $words['pay_duties_dlvry'];?> </label> <span data-toggle="tooltip" title="<?php echo $words['pay_duties_dlvry_hin'];?>" class="glyphicon glyphicon-info-sign" aria-hidden="true" style=" color: #124fe1;" ></span> </td>
							    </tr>
							</table>
						</form> 
					</div>
						
						
				</div>
					<br>
				<div class="col-sm-6 pull-left">
						<div><?php echo $words['delivered_in_x_day'];?></div>
				</div>-->
				
				
			</div>
		</div>
	</section><!--/#do_action-->
	
	<!--<button id="foo" data-popup-open="pop_up_box" type="button" class="btn btn-default edit_address_btn">pop up window</button>-->
	
	<!--pop up update address div -->
	<div class="popup" data-popup="pop_up_box">
	    <div class="popup-inner edit-box">
	        <img class="map-img" src="http://www.confessionsofacouponaholic.com/wp-content/uploads/2012/12/double-coupons.jpg"  >
	        <a class="popup-close" data-popup-close="pop_up_box" href="#">x</a>
	    </div>
	</div>
	<!--end pop up update address div-->
	

?>
	