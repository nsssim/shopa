<?php 
$this->load->helper('url');
$CI =& get_instance();
$CI->load->library('cleanurl');
$CURRENCY = "$";
$RATE = 1;

?>


 	<?php
 	include "css.php";?>
 	<?php include "header.php";?>
 	
 	
	<section>
		<div class="container">
		<div class="row">
			<div class="col-sm-12 home-text">
				<h4>Sign up for savings  <small>Get exclusive emails <span style="color:#f00">coupons</span> and <span style="color:#f00">deals</span> and much more</small></h4><hr/>
			</div>
		</div>
		</div>
	</section>
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<h3>Your Cart</h3>
				
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">ITEM</td>
							<td class="description"></td>
							<td class="price">PRICE</td>
							<td class="quantity">QTY.</td>
							<td class="total">TOTAL</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
					<?php 	foreach ($this->cart->contents() as $item) : ?>
					<tr id="<?php 	echo($item['rowid'])  ?>" class="crow" >
							<td class="cart_product">
								<a href=""><img src="<?php 	echo($item['thumbnail'])  ?>" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href=""> <?php 	echo($item['name'])  ?> </a></h4> 
								<p><span class="scaprt">Color: </span><?php echo($item['options']['Color']) ;?> 
								<span class="scaprt">Size: </span><?php 	echo($item['options']['Size']) ; ?>
								<br/><span class="scaprt">Web ID: </span><?php 	echo($item['web_id'])  ?> </p>
							</td>
							<td class="cart_price">
								<p><?php echo($item['price'])  ?> </p> 
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_up" style=" cursor: pointer; " > - </a>
									<input class="cart_quantity_input" type="text" name="quantity" value="<?php echo($item['qty'])  ?> " autocomplete="off" size="2">
									<a class="cart_quantity_down" style=" cursor: pointer; "> + </a>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">   <?php echo($CURRENCY.$this->cart->total());?>  </p>
							</td>
							<td class="cart_delete">
								<a  class="cart_quantity_delete" style=" cursor: pointer;" ><i class="fa fa-times"></i></a>
							</td>
						</tr>
					
					<?php endforeach; ?>
						
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading">
				
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
								<input type="checkbox">
								<label>Use Coupon Code</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Use Gift Voucher</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Estimate Shipping & Taxes</label>
							</li>
						</ul>
						<ul class="user_info">
							<li class="single_field">
								<label>Country:</label>
								<select>
									<option>United States</option>
									<option>Bangladesh</option>
									<option>UK</option>
									<option>India</option>
									<option>Pakistan</option>
									<option>Ucrane</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
								
							</li>
							<li class="single_field">
								<label>Region / State:</label>
								<select>
									<option>Select</option>
									<option>Dhaka</option>
									<option>London</option>
									<option>Dillih</option>
									<option>Lahore</option>
									<option>Alaska</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
							
							</li>
							<li class="single_field zip-field">
								<label>Zip Code:</label>
								<input type="text">
							</li>
						</ul>
						<a class="btn btn-default update" href="">Get Quotes</a>
						<a class="btn btn-default check_out" href="">Continue</a>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Cart Sub Total <span>$59</span></li>
							<li>Eco Tax <span>$2</span></li>
							<li>Shipping Cost <span>Free</span></li>
							<li>Total <span>$61</span></li>
						</ul>
							<a class="btn btn-default update" href="">Update</a>
							<a class="btn btn-default check_out" href="">Check Out</a>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->

<?php //include "footer.php";?>
	<?php include "script.php";?>
	