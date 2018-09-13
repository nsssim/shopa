<!DOCTYPE html>
<html>  
<?php echo $head; ?>

        <section class="invoice">
          
          <table>
          	<tr>
          		<th>SHOPAMERIKA</th>
          		<th>&nbsp;</th>
          		<th>&nbsp;</th>
          		<th><span class="pull-right">Date: <?php  echo($order_details->date_add);?></span></th>
          	</tr>
          	<tr>
          		<td colspan="4" >
          			<hr>
          		</td>
          	</tr>
          	
          	<tr>
          		<td>
          			<div>From <br>
						Shop Amerika <br>
						795 Folsom Ave, Suite 600 <br>
						San Francisco, CA 94107 <br>
						Phone: (804) 123-5432 <br>
						Email: info@almasaeedstudio.com <br>
						
					</div>
				</td>
          		<td>&nbsp;</td>
          		<td>&nbsp;</td>
          		<td>
          			<div>To
			            <address>
			            <strong><?php  echo($order_details->first_name);?> <?php  echo($order_details->last_name);?> </strong><br>Address:<?php  echo($order_details->line_1);?> ,
			            <?php  echo($order_details->line_2);?> ,
			            <?php  echo($order_details->line_3);?> ,
			            <?php  echo($order_details->country_province);?> ,
			            <?php  echo($order_details->city);?> ,
			            <?php  echo($order_details->coutry);?> ,
			            <?php  echo($order_details->zip_code);?>.<br>
Phone:  <?php  echo($order_details->phone);?><br>
Mobile:  <?php echo($order_details->alt_phone);?><br>
Email:  <?php  echo($order_details->email);?><br>
			           	</address>
					</div>
          		</td>
          	</tr>
          </table>
          
          
          <table>
          	<tr>
          		<td style="text-align: center;" > <b>Order ID: <?php  echo($order_details->id);?> </b> </td>
          	</tr>
          	<tr>
          		<td> <b> Customer ID: <?php  echo($order_details->customer_id);?> </b> </td>
          	</tr>
          </table>
          

          <!-- Table row -->
          <div class="row">
	            <div class="col-xs-12 table-responsive">
		               <?php //	$cart_resurected = json_decode($order_details->cart_content); ?>
		              <?php
	              		/*echo "<pre>";
			              	print_r($cart_resurected);
	              		echo "</pre>";*/
		              ?>
		              
	              <table  border="1" >
	                <thead>
	                  <tr>
	                    <th align="center"><b>Product Name</b></th>
	                    <th align="center" width="35px" ><b>Qty</b></th>
	                    <th align="center"><b>Web Id</b></th>
	                    <th align="center"><b>Size/Color</b></th>
	                    <th align="center" width="35px" ><b>CatID</b></th>
	                    <th align="center"><b>Shipping Factor</b></th>
	                    <th align="center"><b>Promo Code</b></th>
	                    <th align="center"><b>Service Fee ?</b></th>
	                    <th align="center"><b>Discount $</b></th>
	                    <th align="center"><b>Discount %</b></th>
	                    <th align="center"><b>Price</b></th> 
	                    <th align="center"><b>Promo Price</b></th>
	                  </tr>
	                </thead>
	                
	                <tbody>
	                  <?php  foreach ($cart_content as $items) :?>
	                  <?php 
		                $size_name = $color_name = "NULL";
		                if(!empty($items->size_name)) $size_name = $items->size_name;
		                if(!empty($items->color_name)) $color_name = $items->color_name; 
		              ?>
	                  <tr>
		                 
	                    <td align="center" style="vertical-align: center" ><?php  echo ($items->name);			?> </td>
	                    <td align="center" style="vertical-align: center" width="35px"><?php  echo ($items->qty); 			?> </td>
	                    <td align="center" style="vertical-align: center" ><?php  echo ($items->id); ?>  </td>
	                    <td align="center" style="vertical-align: center" ><?php  echo ($size_name.'/'.$color_name);?></td>
	                    <td align="center" style="vertical-align: center" width="35px"><?php  echo ($items->cat_id);		?> </td>
	                    <td align="center" style="vertical-align: center" ><?php  echo ($items->cat_shipping_factor);		?> </td>
	                    <td align="center" style="vertical-align: center" ><?php  echo ($items->promo_code);		?> </td>
	                    <td align="center" style="vertical-align: center" ><?php  echo ($items->has_service_fee);		?> </td>
	                    <td align="center" style="vertical-align: center" ><?php  echo ($items->discount_money);		?> </td>
	                    <td align="center" style="vertical-align: center" ><?php  echo ($items->discount_percentage);		?> </td>
	                    <td align="center" style="vertical-align: center" ><?php  echo ($items->price);		?> </td>
	                    <td align="center" style="vertical-align: center" ><?php  echo ($items->subtotal_promo);		?> </td>
	                  </tr>
	                   <?php  endforeach;?>
	                </tbody>
	              </table>
	          
					<div> &nbsp;</div>
					
					<table  >
					
					<tbody>
						
				        <tr>
				        
				        	<td>&nbsp;</td>	
				        	<td width="295px;"  >
				        	
				        		<div style="background-color: #f2f2f2; " >
				        			
					        		
					        		<div style="text-align: left;" >
					        			<span style="width: 500pt; background-color: pink;"> Order Subtotal: 	</span> 
					        			<span> <?php  echo($order_details->sign);?> <?php echo(round($order_details->order_sub_total,2));?> </span> 
					        		</div>
					        		
					        		<div style="text-align: left;" >
					        			<span> Total Tax: 	</span> 
					        			<span><?php  echo($order_details->sign);?> <?php echo(round($order_details->total_tax,2));?> </span> 
					        		</div>
					        		
					        		<div style="text-align: left;" >
					        			<span> shipping factor $ value: 	</span> 
					        			<span><?php  echo(round($order_details->shipping_factor_money_value,2));?> </span> 
					        		</div>
					        		
					        		<div style="text-align: right;" >
					        			<span> Start Up Shipping Value: 	</span> 
					        			<span><?php  echo($order_details->sign);?> <?php  echo(round($order_details->start_up_shipping_value,2));?> </span> 
					        		</div>
					        		
					        		<div style="text-align: right;" >
					        			<span> Total Shipping Fee: 	</span> 
					        			<span><?php  echo($order_details->sign);?> <?php  echo(round($order_details->shipping_fee_total,2));?> </span> 
					        		</div>
					        		
					        		<div style="text-align: center;" >
					        			<span> Total Credit Card Fee: 	</span> 
					        			<span><?php  echo($order_details->sign);?> <?php  echo(round($order_details->total_credit_card_fee,2));?> </span> 
					        		</div>
					        		
					        		<div style="text-align: center;" >
					        			<span> Service Fee: 	</span> 
					        			<span><?php  echo($order_details->sign);?><?php  echo(round($order_details->service_fee,2));?> </span> 
					        		</div>
					        		
					        		<div style="text-align: center;" >
					        			<span> Total Custom Fee: 	</span> 
					        			<span><?php  echo($order_details->sign);?> <?php  echo(round($order_details->total_custom_fee,2));?> </span> 
					        		</div>
					        		
					        		<div style="text-align: center;" >
					        			<span> Grand Total: 	</span> 
					        			<span><?php  echo($order_details->sign);?> <?php  echo(round($order_details->grand_total,2));?> </span> 
					        		</div>
					        		
				        		</div>
				        		
				        	</td>	
				                
					   
				          
				        </tr>
					</tbody>
			        </table>
			        
	          	</div><!-- /.col -->
          	</div><!-- /.row -->
		
        </section><!-- /.content -->
 
</html>