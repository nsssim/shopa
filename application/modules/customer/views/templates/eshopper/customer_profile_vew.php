<?php 
$this->load->helper('url');
$CI =& get_instance();
$CI->load->library('cleanurl');
$CURRENCY = "$";
$RATE = 1;
//if session expired show message
if(isset($log_out_message)) : echo $log_out_message;

//else show page body
else:
?>
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
				
					<?php include("customer_left_vew.php"); ?>
					
				</div>
				<div class="col-sm-9" style="border: solid 1px" >
					
					<?php
					echo '<pre>';
					echo "<h2> customer_vew->customer_details (line 33)</h2>";
					var_dump($customer_details);
					echo '</pre>';
					
					echo '<pre>';
					echo "<h2> customer_vew->customer_orders (line 38)</h2>";
					var_dump($customer_orders);
					echo '</pre>';
					?>
					
					
				</div>
			</div>
		</div>
	</section>	
<?php endif; ?>
	