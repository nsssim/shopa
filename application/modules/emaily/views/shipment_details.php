<div class="title_line" ><?php echo $words['shipment_details']; ?><!--SHIPMENT DETAILS--></div>
						
						<div style="width:100%; ">
							<div style="width:50%;/* background-color:green;*/float:left;">
								
								<div style="text-align:left; margin-left:5px; margin-top:5px;">
									<strong> <?php echo $words['delivery_methd']; ?><!--Delivery Method--> </strong> : <?php echo $words['standard']; ?><!--STANDARD--><br>
									<?php if(!empty($od->tracking_num)) :?>
									<strong> <?php echo $words['tracking_num']; ?><!--Tracking #:--> </strong>   <?php echo $od->tracking_num; ?> <br>
									<?php endif; ?>
								</div>
								<br>
								
								<?php if(!empty($od->tracking_num)) :?>
								<div style="text-align:center;">
									<a class="button" style=" position:relative;top:50%;" href="https://wwwapps.ups.com/WebTracking/track?loc=en_US&track.x=Track&trackNums=<?php echo $od->tracking_num; ?>" ><?php echo $words['track_order']; ?><!--TRACK ORDER--> </a>
								</div><br>
								<?php endif; ?>
							</div>
							<div style="width:50%; /*background-color:orange;*/float:left;">
								<div style="width:50%; /*background-color:orange;*/float:left;">
									<p style="float:right;"><?php echo $words['shipping']; ?><!--Shipping--><br><?php echo $words['address']; ?><!--Address-->:</p>
								</div>
								<div style="width:50%; /*background-color:orange;*/float:left;">
									<p style="margin-left:5px;">
										<?php echo strtoupper($od->customer_first_name)." ". strtoupper($od->customer_last_name)."<br>";   ?> 
										<?php if(!empty($od->delivery_address_line_1)) 					echo ucfirst($od->delivery_address_line_1)."<br>"; ?> 
										<?php if(!empty($od->delivery_address_line_2)) 					echo ucfirst($od->delivery_address_line_2).","; ?> 
										<?php if(!empty($od->delivery_address_line_3)) 					echo ucfirst($od->delivery_address_line_3)."," ; ?> 
										<?php if(!empty($tr_city_county_name_delivery[0]->city_name)) 	echo ucfirst($tr_city_county_name_delivery[0]->city_name."<br>") ; ?> 
										<?php if(!empty($tr_city_county_name_delivery[0]->county_name)) echo ucfirst($tr_city_county_name_delivery[0]->county_name)."<br>"	; ?> 
										<?php if(!empty($od->delivery_address_zip_code)) 				echo $od->delivery_address_zip_code."," ; ?> 
										<?php if(!empty($delivery_country_name)) 						echo ucfirst($delivery_country_name)."." ; ?> 
									</p>
								</div>
							</div>
						</div>
						
						<p></p>