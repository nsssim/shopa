<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head>
	<style>
	table, th, td 
	{
    	border: 1px solid black;
	    padding: 5px;
	    border-collapse: collapse;
	    margin-right: 10px;
	}
	
	.container
	{
		/*border:solid 1px red;*/
		width:29cm;	
	}
	.top_left
	{
		float: left;
		padding: 8px;
	}
	.top_right
	{
		float: right;
		padding: 8px;
	}
	.from_to_container
	{
		width: 100%;
		
	}
	.from
	{
		float: left;
		padding: 8px;
	}
	.to
	{
		float: right;
		padding: 8px;
	}
	
	.subject{
		width: 100%;
		text-align: center;
		text-decoration: underline;
	}
	
	.price_summary
	{
		width: 300px;
		float: right;
		padding: 5px;
		margin-right: 10px;
		/*border:1px  #ffaeae solid;*/
	}
	
	
	.price_summary_line
	{
		text-align: left;
		border-top: 1px solid;
	}
	.right_float
	{
		float:right;
	}
	
	
		
	</style>
</head>

<html>  

        <div class="container">
         
	        <div class="top_left">
	        	<img width="160px" src="<?php echo base_url().'assets/templates/eshopper/images/home/logo.png' ?>" />
	        </div> 
         
	        <div class="top_right">
	        	<span class="pull-right">Date: <?php  echo($order_details->date_add);?></span>
	        </div> 
	        
	        <div class="separator" >  	&nbsp;   <br/><br/>	<hr/>        </div> 
	        
	        <div class="from_to_container">
	        	<div class="from">
						Shop Amerika <br>
	        			27 East 21st Street, Ninth Floor<br>
						New York, New York 10010 <br>
						Phone: 800-445-0380 <br>
						Email: info@shopamerika.com<br>
				</div>
				
				<div class="to">
	        			<strong><?php  echo($order_details->first_name);?> <?php  echo($order_details->last_name);?> </strong><br>
						<?php  echo($order_details->line_1);?> ,
                		<?php  echo($order_details->line_2);?> <br/>
                		<!--<?php  echo($order_details->line_3);?> ,-->
                		<?php  echo($order_details->country_province);?> ,
                		<?php  echo($order_details->city);?> ,
                		<?php  echo($order_details->coutry);?> ,
                		<?php  echo($order_details->zip_code);?><br>
		                Phone:  <?php  echo($order_details->phone);?><br/>
		                Mobile:  <?php echo($order_details->alt_phone);?><br/>
		                Email:  <?php  echo($order_details->email);?><br/>
				</div>
				
	        	<div class="separator" style="clear: all;" >  	&nbsp;   <br/><br/>	        </div> 
	        </div>
          
	        <div class="separator" style="clear: all;" >  	&nbsp;   <br/><br/>	        </div> 
	        <div class="separator" style="clear: all;" >  	&nbsp;   <br/><br/>	        </div> 
	        <div class="separator" style="clear: all;" >  	&nbsp;   <br/><br/>	        </div> 
          	
          	<div class="subject" > <b>Order # <?php  echo($order_details->id);?> </b> </div>
          	
          
	        <div class="separator" style="clear: all;" >  	&nbsp;   <br/><br/>	        </div> 
          
          	<table  >
	               
	                  <tr>
	                    <th align="center"><b>Product Name</b></th>
	                    <th align="center" width="35px" ><b>Qty</b></th>
	                    <th align="center"><b>Web Id</b></th>
	                    <th align="center"><b>Size/Color</b></th>
	                    <th align="center"><b>Price</b></th> 
	                    <th align="center"><b>Promo Price</b></th>
	                  </tr>
	                
	                
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
	                    <td align="center" style="vertical-align: center" ><?php  echo($order_details->sign);?> <?php  echo number_format((float)$items->price, 2, '.', '');		?> </td>
	                    <td align="center" style="vertical-align: center" ><?php  echo($order_details->sign);?> <?php  echo number_format((float)$items->subtotal_promo, 2, '.', '');		?> </td>
	                  </tr>
	                   <?php  endforeach;?>
	                </tbody>
	        </table>

	        <div class="separator"  >  	&nbsp;   <br/><br/>	        </div> 
	        
	        <div class="price_summary" >
		        
        		<div class="price_summary_line" >
        			<span style="width: 500pt;"> Order Subtotal: 	</span> 
        			<span class="right_float" > <?php  echo($order_details->sign);?> <?php echo number_format((float)$order_details->v_order_sub_total, 2, '.', '');?> </span> 
        		</div>
        		
        		<div class="price_summary_line"  >
        			<span> Shipping: 	</span> 
        			<span class="right_float" ><?php  echo($order_details->sign);?> <?php echo number_format((float)$order_details->v_shipping_and_handling_fee, 2, '.', '') ;?> </span> 
        		</div>
        		
        		<?php if(!empty($order_details->v_discount_total)): ?>
        		<div class="price_summary_line"  >
        			<span> Total Discount: 	</span> 
        			<span class="right_float" ><?php  echo($order_details->sign);?> <?php echo number_format((float)$order_details->v_discount_total, 2, '.', '') ?> </span> 
        		</div>
        		<?php endif; ?>
        		
        		<div class="price_summary_line"  >
        			<span> Subtotal: 	</span> 
        			<span class="right_float" ><?php  echo($order_details->sign);?> <?php echo number_format((float)$order_details->v_subtotal, 2, '.', ''); ?> </span> 
        		</div>
        		
        		<div class="price_summary_line"  >
        			<span> Customs: 	</span> 
        			<span class="right_float" ><?php  echo($order_details->sign);?> <?php  echo number_format((float)$order_details->v_optional_custom_fees, 2, '.', '');?> </span> 
        		</div>
        		
        		<div class="price_summary_line"  >
        			<span> Grand Total: 	</span> 
        			<span class="right_float" ><?php  echo($order_details->sign);?> <?php  echo number_format((float)$order_details->v_grand_total, 2, '.', '') ;?> </span> 
        		</div>
        		
        		
				
	        </div>
		
        </div><!-- /.content -->
 
</html>