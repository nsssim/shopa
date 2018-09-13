<div class="title_line" ><?php echo $words['order_details']; ?><!--ORDER DETAILS--></div>
<div style="width:100%;">
	<div style="width:50%; /*background-color:green*/;float:left;">
		
		<div style="text-align:center; margin-top:5px;">
			Order Number :  <?php echo $od->order_id; ?><br>
			<?php 
			$phpmysql_date = strtotime( $od->date_add );
			$o_date = date("d/m/y", $phpmysql_date);
			?>
			Order Date : <?php echo $o_date; ?><br>
		</div>
		<br>
		<div style="text-align:center;">
			<a class="button" style=" position:relative;top:50%;"  href="<?php echo base_url() ?>customer/myorders" ><?php echo $words['check_o_status']; ?><!--CHECK ORDER STATUS--></a>
		</div><br>
	</div>
	<div style="width:50%;/* background-color:orange;*/float:left;">
		<div style="width:50%; /*background-color:orange;*/float:left;">
			<p style="float:right;"><?php echo $words['billing']; ?><!--Billing--><br><?php echo $words['address']; ?><!--Address-->:</p>
		</div>
		<div style="width:50%; /*background-color:orange;*/float:left;">
			<p style="margin-left:5px;">
				 <?php echo strtoupper($od->customer_first_name)." ". strtoupper($od->customer_last_name)."<br>";   ?> 
				  <?php echo strtoupper($od->customer_first_name)." ". strtoupper($od->customer_last_name)."<br>";   ?> 
				  <?php if(!empty($od->invoice_address_line_1)) 				 echo ucfirst($od->invoice_address_line_1)."<br>"; ?> 
				  <?php if(!empty($od->invoice_address_line_2)) 				 echo ucfirst($od->invoice_address_line_2).","; ?> 
				  <?php if(!empty($od->invoice_address_line_3)) 				 echo ucfirst($od->invoice_address_line_3.",") ; ?> 
				  <?php if(!empty($tr_city_county_name_invoice[0]->city_name)) 	 echo ucfirst($tr_city_county_name_invoice[0]->city_name."<br>") ; ?> 
				  <?php if(!empty($tr_city_county_name_invoice[0]->county_name)) echo ucfirst($tr_city_county_name_invoice[0]->county_name)."<br>"	; ?> 
				  <?php if(!empty($od->invoice_address_zip_code)) 				 echo $od->invoice_address_zip_code."," ; ?> 
				  <?php if(!empty($invoice_country_name)) 						 echo ucfirst($invoice_country_name)."." ; ?> 
			</p>
		</div>
	</div>
</div>