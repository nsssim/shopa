<?php 
    $this->load->helper('url'); 
	//$this->load->library('firebug');  echo('Firebug woking behind the scene........ok <br>');
	
	//$this->firebug->info($featured_items,"featured_items");
	//$this->firebug->info($order_data,"order_data");
	
	$od = $order_data;
	//date_default_timezone_set('Europe/Istanbul');
?>

<html>
  <head>
    <title> ORDER DELIVERED - SHOPAMERIKA.COM   </title>
	
	<?php include('meta.php') ?>
	<style>
	
	<?php include('email.css') ?>
	
	</style>
  
  </head>
  <body>
    <h1 style="color: #000000; text-align: center;"><?php echo $words['thank_u_for_shoppin']; ?><!--Thank you for shopping at--> <a style="color: red;" href= <?php echo base_url(); ?> >ShopAmerika.com</a></h1>
    
    <?php include('slogant.php') ?>
    
    <p>&nbsp;</p>
    

    
    <div id="anchor_frame">
    	
	    <?php include('categories_menu.php') ?>
    
	    <div id="main_frame" >
	    	
		    <h1 style="color: #5e9ca0;">
		    <span style="color: #000000;"><?php echo $words['your']; ?><!--YOUR--></span> 
		    <span style="color: #ff0000;"><?php echo $words['delivery']; ?><!--DELIVERY--></span> 
		    <span style="color: #000000;"><?php echo $words['confirmation']; ?><!--CONFIRMATION--></span></h1>
		    <hr />
		    <div id="container" >
		      <div style="width: 80%;/* background-color: pink;*/ float: left;">
		      <p><?php echo $words['dear']; ?><!--Dear--> <?php echo strtoupper($od->customer_first_name)." ". strtoupper($od->customer_last_name)   ?> ,</p>
			        <p>
				        <?php echo $words['thank_u_for_shoppin']; ?><!--Thank you for shopping at -->
				        <a class="" href="<?php echo base_url() ?>">ShopAmerika.com.</a> 
				        <?php echo $words['your_ordr_num']; ?><!--Your order #-->
				        <?php echo $od->order_id; ?>  
				       <?php echo $words['was_delivered']; ?><!-- was delivered. The status of all items in your order is listed below under shipment details.-->
				        <br>
				       <?php echo $words['u_can_view_ur_orders']; ?> <!-- You can view your order status and history at any time by visiting--> 
				        <a class="" href="<?php echo base_url() ?>customer/myorders">
				        <?php echo $words['my_orders']; ?> <!--My Orders.-->
				        </a>
			        </p>
			        
					<div class="tbl">
						<?php include('order_details.php') ?>
						<p> &nbsp;</p>
					</div>
					
					<div class="tbl">
						<?php include('shipment_details.php') ?>
					</div>
					
			        
					<table class="cart" width="100%">
					  <tr>
						<th class="tbl_th" colspan="2" ><?php echo $words['item']; ?><!--ITEM--></th>
						<th class="tbl_th" ><?php echo $words['details']; ?><!--DETAILS--></th>
						<th class="tbl_th" ><?php echo $words['ship_date']; ?><!--SHIP DATE--></th>
						<th class="tbl_th" ><?php echo $words['price']; ?><!--PRICE--></th>
					  </tr>
					  
					  <?php 
					  		$file_full_name = $od->cart_content;
							if(file_exists($file_full_name))
							{
								$cart_file_gz = file_get_contents($file_full_name); // read file
								$cart_file_json = gzdecode($cart_file_gz); // uncompress the file
								$cart_content = json_decode($cart_file_json); // decode from json to object
							}
					  		

							/*echo "-----------------<br>";
							echo "<pre>";
							var_dump($cart_content) ;
							echo "</pre>";
							echo "-----------------<br>";*/
					   ?>
					   <?php foreach ($cart_content as $crow) :?>
					   	
					   	<tr>
						<td class="cart_img" ><img style="width:50px; display: block; margin-left: auto; margin-right: auto;" src="<?php echo $crow->thumbnail;  ?> " /> </td>
						<td class="item_col"  style="width: 20%;" >  <?php echo $crow->name;  ?>  Web ID: <?php echo $crow->id;  ?> </td>
						<td class="detail-col" ><?php echo $words['qty']; ?><!--Qty-->:  <?php echo $crow->qty;  ?><br>
						
						<?php if(!empty($crow->size_name)) : ?>
						<?php echo $words['size']; ?><!--Size:-->  <?php echo $crow->size_name;  ?> <br>
						<?php endif; ?>
						
						<?php if(!empty($crow->color_name)) : ?>
						<?php echo $words['color']; ?> <!--Color:-->  <?php echo $crow->color_name;  ?></td>
						<?php endif; ?>
						
						<td class="ship-col" >  <?php echo $od->is_shipped_last_time_changed;  ?>   </td>
						<td class="price-col" > <strong>  <?php echo $currency.number_format((float)$crow->subtotal_promo, 2, '.', '');  ?>  </strong>  	 </td>
					  	</tr>
					   <?php endforeach ;?>
					 <!-- <tr>
						<td class="cart_img" ><img style="width:50px; display: block; margin-left: auto; margin-right: auto;" src="http://kingofwallpapers.com/orange/orange-003.jpg" /> </td>
						<td class="item_col"  style="width: 20%;" >  Converse Lace Up High Top Sneakers - Metallic Web ID: 1058986</td>
						<td class="detail-col" >Qty:  1<br> Size:  8 <br>Color:  Black</td>
						<td class="ship-col" >  11/19/2014 </td>
						<td class="price-col" > <strong>  $44.80 </strong>  	 </td>
					  </tr>-->
					  
					</table>
					
					<div class="order_xtotal" ><?php echo $words['order_subtotal']; ?><!--ORDER SUBTOTAL--> <span class="pull-right" >  <?php echo $currency.number_format((float)$od->v_order_sub_total, 2, '.', ''); ?>  </span></div>
					<div class="grey_line" style="border-bottom: 1px dashed grey;" > <?php echo $words['shipping_n_handling']; ?><!--SHIPPING AND HANDLING--> <span class="pull-right"> <?php echo $currency.number_format((float)$od->v_shipping_and_handling_fee, 2, '.', '');  ?> </span> </div>
					
					<?php if(!empty($od->v_discount_total)) : ?>
					<div class="grey_line" style="border-bottom: 1px dashed grey;" > <?php echo $words['total_discount']; ?><!--TOTAL DISCOUNT--> <span class="pull-right"> <?php echo "- ".$currency.number_format((float)$od->v_discount_total, 2, '.', '');  ?> </span> </div>
					<?php endif; ?>
					
					<?php if(!empty($od->v_optional_custom_fees)) : ?>
					<div class="grey_line"  > <?php echo $words['total_customs']; ?><!--TOTAL CUSTOMS--> <span class="pull-right"> <?php echo $currency.number_format((float)$od->v_optional_custom_fees, 2, '.', '');  ?> </span> </div>
					<?php endif; ?>
					
					<div class="order_xtotal" style="background-color:#666666" ><?php echo $words['order_total']; ?><!--ORDER TOTAL--> <span class="pull-right"> <?php echo $currency.number_format((float)$od->v_grand_total, 2, '.', '');  ?> </span> </div>
					<div class="grey_line" ><?php echo $words['paymnet_method']; ?><!--PAYMENT METHOD--> : <?php echo $words['credit_card']; ?><!--Credit Card--> <span class="pull-right"><?php echo $currency.number_format((float)$od->v_grand_total, 2, '.', '');  ?></span></div>
					<div style="border-bottom: 1px dashed grey;" > &nbsp; </div>
					
					<?php include('block_bottom.php') ?>
					
					
					
					<!------------------------------------------------------------------------------------------------>
				
		      </div> <!--end main content-->
		      
		      <?php include("right_block.php") ?>
			  
		    </div> <!--end 100%-->
		    
	    </div> <!--end main_frame-->
	    
		<?php include("footer.php") ?>
    </div> <!--end anchor_frame-->
    
  </body>
</html>