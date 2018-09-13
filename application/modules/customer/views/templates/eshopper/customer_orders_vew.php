<?php 
$this->load->helper('url');
$CI =& get_instance();
$CI->load->library('cleanurl');
$CURRENCY = "$";
$RATE = 1;

//$CI->load->library('firebug');  echo('Firebug woking behind the scene........ok <br>');
//$CI->firebug->info($customer_orders,"customer_orders");
	//$CI->firebug->info($cart_content,"cart_content");




	
//if session expired show message
if(isset($log_out_message)) 
{ 
echo $log_out_message;
}
//else show page body
else{
?>
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
				
					<?php include("customer_left_vew.php"); ?>
					
				</div>
				<div class="col-sm-9">
					<a style="color: grey;" href="<?php echo $secure_base_url.'customer/my_account' ?>"  > <?php echo $words['my_account'] ?> <!--My Account-->	</a>
						<img style="padding: 0; height: 12px;" src="<?php echo $secure_base_url.'assets/templates/eshopper/images/grey_arrow_right.png' ?>" />
						<span style="font-size: 12px; color: grey;" > <?php echo $words['my_orders'] ?> <!--My Orders-->  </span>
						
					<span class="pagination;"> <?php echo $pagination; ?> </span>
					<div class="panel panel-default" style="border-style: none;">
					  <!-- Default panel contents -->
						<!--<h2 style="margin-left:5px;">My Orders <span style="font-size: 25px;"> ( <?php echo $total_rows;?> )</span> </h2> -->
						<div style="margin-bottom: 5px; margin-top: 10px;">
							<img src="<?php echo $secure_base_url.$words['my_orders_img'] ?>" > 
						</div>
						<div style="border-bottom: 1px solid black; width: 100%; margin-bottom: 15px;" >
						</div>
						
							<?php
							/*
							foreach($customer_orders as $order)
							echo $order->id.
							"--".$order->orders_date_add.
							"--".$order->orders_detail_grand_total.
							"--".$order->orders_detail_number_of_items.
							"--".$order->addresses_line_1
							."...click"."<br>";
							*/
							?>
					<?php if(!empty($customer_orders)) : ?>
					    <!--ORDERS-->
					    <div class="table-responsive cart_info">
					      <table class="table table-condensed">
					        <thead>
					          <tr class="cart_menu">
					            <td class="image"> <?php echo $words['order_id'] ?> <!--ORDER ID--></td>
					            <td class="description"> <?php echo $words['order_date'] ?>  </td>
					            <td class="price"> <?php echo $words['order_amount'] ?> </td>
					            <td class="description"><?php echo $words['num_o_items'] ?></td>
					            <td class="quantity"><?php echo $words['delivery_address'] ?></td>
					            <td class="quantity"><?php echo $words['status'] ?></td>
					            <td class="quantity"><?php echo $words['tracking_num'] ?></td>
					            <td class="quantity"> </td>
					          </tr>
					        </thead>
					        
					        <?php	foreach($customer_orders as $order) :?>
					        
					        <?php
					        //prepare the status string
					        
					        /*
					        orders_detail.is_placed,
							orders_detail.is_arrived_to_warehouse,
							orders_detail.is_packed,
							orders_detail.is_shipped,
							orders_detail.is_customs_cleared,
							orders_detail.is_arrived_to_office,
							orders_detail.is_relabled,
							orders_detail.is_delivered,
							orders_detail.tracking_num*/
							
							$order_status = "Pending";
							if($order->is_taken) 					$order_status = $words['taken'];
							if($order->is_customer_charged)			$order_status = $words['customer_charged'];
							if($order->is_placed) 					$order_status = $words['placed'];
							if($order->is_arrived_to_warehouse) 	$order_status = $words['arrived_to_warehouse'];
							if($order->is_packed) 					$order_status = $words['packed'];
							if($order->is_shipped) 					$order_status = $words['shipped'];
							if($order->is_customs_cleared) 			$order_status = $words['customs_cleared'];
							if($order->is_arrived_to_office) 		$order_status = $words['arrived_to_office'];
							if($order->is_relabled) 				$order_status = $words['relabled'];
							if($order->is_delivered) 				$order_status = $words['delivered'];
					        
					         ?>
					        
					        
					        
					        
					        
					        <tbody>
					          <tr class="crow">
					            <td >
					             <?php  echo $order->id; ?>
					            </td>
					            
					            <td class="cart_description" >
					            	<?php date_default_timezone_set("Europe/Istanbul") ; $time = strtotime($order->orders_date_add);$myFormatForView = date("m/d/y g:i A", $time); echo  $myFormatForView; ?>
					            </td>
					            
					            <td style="width: 80px;" >
					            	<?php  echo $CURRENCY." ". round($order->orders_detail_grand_total,2); ?>
					            </td>
					            
					            <td align="center" >
					              	<?php  echo $order->orders_detail_number_of_items; ?>
					            </td>
					            
					            <td>
					            	<?php  echo $order->addresses_line_1; ?> 
					            </td>
					            
					            <td>
					            	<?php  echo $order_status; ?> 
					            </td>
					            
					            <td>
					            	<?php  echo $order->tracking_num; ?> 
					            </td>
					            
					            <td class="cart_total">
					             <a style="color: red;" href="<?php echo base_url().'customer/order_details/'.$order->id ; ?>" > <?php echo $words['details'] ?> <!--Details-->  </a> 
					            </td>
					            
					          </tr>
					        </tbody>
					        <?php endforeach; ?>
					      </table>
					    </div>
					    <!--//ORDERS-->
					<?php endif; ?>
					    
					</div>


				</div>
			</div>
		</div>
	</section>	
<?php } ?>
	