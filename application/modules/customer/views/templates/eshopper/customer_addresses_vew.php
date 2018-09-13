<?php 
//$this->load->helper('url');
$CI =&get_instance();
$CI->load->library('cleanurl');
$CURRENCY = "$";
$RATE = 1;
//var_dump($countries);

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
				<div class="col-sm-9"  >
					<div class="row">
						<h2>Delivery Addresses</h2>
						<div class="col-sm-2"  >
								<button id="new_delivery_address_btn" data-popup-open="add_new_address" type="button" class="btn btn-success  ">Add new address</button>
						</div> 
						
						<?php
						if(!empty($customer_delivery_addresses))
						{
							
							foreach($customer_delivery_addresses as $d_delivery_addresses)
							{
							?>
								<div id="<?php echo('mail-envelope_'.$d_delivery_addresses->id); ?>" class="<?php echo('col-sm-12 mail-envelope'); ?>" >
									<?php
									$this_address_id = $d_delivery_addresses->id;
									foreach($d_delivery_addresses as $key => $value)
									{
										if ( ($key == "id") or ($key == "other_details") or ($key == "is_deleted") or ($key == "is_active")  )
										{
											//print_r($value);
											?>
											<div style="display: none" class="col-sm-4"  ><?php echo $key;?></div>
											<div style="display: none" class="col-sm-8"  ><input id="<?php echo $key.'_'.$this_address_id ?>" type="text" value="<?php echo $value;?>"/></div>
											<?php 
										}
										else
										{
											//print_r($value);
											?>
											<div class="col-sm-4"  >
												<?php echo $key;?>
											</div>
											<div class="col-sm-8"  ><input id="<?php echo $key.'_'.$this_address_id ?>"  type="text" value="<?php echo $value;?>" readonly />	</div>
											<?php 
										}
									}?>
									
									<div style="float: right;" class="btn-group" role="group" aria-label="...">
									  <button id="<?php echo 'upd'.$d_delivery_addresses->id ?>" data-popup-open="edit_address" type="button" class="btn btn-default edit_address_btn">Edit</button>
									  <button id="<?php echo 'del'.$d_delivery_addresses->id ?>" type="button" class="btn btn-default delete_address_btn">Delete</button>
									</div>
									
								</div>
								
								
							
								<?php 
							}
						}
						?>
					</div>
					
					<div class="row">
						<h2>Billing Address</h2>
						<div id="<?php echo('mail-envelope_'.$customer_billing_addresses[0]->id); ?>" class="<?php echo('col-sm-12 mail-envelope'); ?>" >
							<?php 
							//var_dump($customer_billing_addresses) ;
							$this_address_id = $customer_billing_addresses[0]->id;
							foreach($customer_billing_addresses[0] as $key => $value)
							{
								if ( ($key == "id") or ($key == "other_details") or ($key == "is_deleted") or ($key == "is_active")  )
								{
									//print_r($value);
									?>
									<div style="display: none" class="col-sm-4"  ><?php echo $key;?></div>
									<div style="display: none" class="col-sm-8"  ><input id="<?php echo $key.'_'.$this_address_id ?>" type="text" value="<?php echo $value;?>"/></div>
									<?php 
								}
								else
								{
									//print_r($value);
									?>
									<div class="col-sm-4"  >
										<?php echo $key;?>
									</div>
									<div class="col-sm-8"  ><input id="<?php echo $key.'_'.$this_address_id ?>"  type="text" value="<?php echo $value;?>" readonly />	</div>
									<?php 
								}
							}?>
							
							<div style="float: right;" class="btn-group" role="group" aria-label="...">
									  <button id="<?php echo 'upd'.$this_address_id ?>" data-popup-open="edit_address" type="button" class="btn btn-default edit_address_btn">Edit</button>
							</div>
						</div>
					</div>
					
					<!--pop up add address div here -->
					<div class="popup" data-popup="add_new_address">
					    <div class="popup-inner">
					    	
					        <h2>Shipping address details </h2>
					        <img class="map-img" src="https://lh3.ggpht.com/wUMyWFnPqB7kPUQ9-8pHqSDGjcv9fWPFvDlFO8uQBe5iJbQW70sR9P2XjadMg-Wh9Vc=w300" align="right" >
					        <p>Enter address details below.</p>
					    	<form id="add_new_shipping_address_form">
						    	<table>
						    	  <tr>
								    <td><label for="address1"> Line 1<span class="required" > *</span> </label></td>
								    <td>
								    	<input id="address1" class="form-control input-md" type="text" placeholder="street address 1" value="" name="address1" required="">
								    </td>
								  </tr>
								  
								  <tr>
								    <td><label for="address2"> Line 2<span class="required" > *</span> </label></td>
								    <td>
								    	<input id="address2" class="form-control input-md" type="text" placeholder="street address 2" value="" name="address2" required="">
								    </td>
								  </tr>
								  
								   <tr>
								    <td><label for="address3"> Line 3</label></td>
								    <td>
								    	<input id="address3" class="form-control input-md" type="text" placeholder="street address 3" value="" name="address3">
								    </td>
								  </tr>
								  
								  <tr>
								    <td><label for="city"> City <span class="required" > *</span> </label></td>
								    <td>
								    <input id="city" class="form-control input-md" type="text" placeholder="city" value="" name="city" required="">
								    </td>
								  </tr>
								  
								  <tr>
								    <td><label for="region"> country province <span class="required" > *</span> </label></td>
								    <td>
								    <input id="region" class="form-control input-md" type="text" placeholder="region" value="" name="region" required="">
								    </td>
								  </tr>
								  <tr>
								    <td><label for="zipcode"> zip code <span class="required" > *</span> </label></td>
								    <td>
								    <input id="zipcode" class="form-control input-md" type="text" placeholder="zip code" value="" name="zipcode" required="">
								    </td>
								  </tr>
								  <tr>
								    <td><label for="country"> country <span class="required" > *</span> </label></td>
								    <td>
								    	<select id="country" class="form-control input-md" name="country" required="">
											<option value="">Country...</option>
											<?php foreach ($countries as $country) : ?>
											<option value="<?php echo $country->Name; ?>"><?php echo $country->Name; ?></option>
											<?php endforeach; ?>
										</select>
								    </td>
								  </tr>
								  
								  <tr>
								  <td></td>
								  <td><a id="add_btn" href="#" class="btn btn-primary btn-success">Add</a></td>
								  </tr>
								</table>
								  
								
								  <input id="user_id" type="hidden" value="<?php echo( $CI->session->userdata('user_id') ); ?>" >  </input>
					    	</form>
					    
					       <!-- <p><a data-popup-close="add_new_address" href="#">Close</a></p>-->
					        <a class="popup-close" data-popup-close="add_new_address" href="#">x</a>
					    </div>
					</div>
					<!--end pop up add address div-->
					
					
					<!--pop up update address div -->
					<div class="popup" data-popup="edit_address">
					    <div class="popup-inner edit-box">
					    	
					        <h2>Update address </h2>
					        <img class="map-img" src="https://lh3.ggpht.com/wUMyWFnPqB7kPUQ9-8pHqSDGjcv9fWPFvDlFO8uQBe5iJbQW70sR9P2XjadMg-Wh9Vc=w300" align="right" >
					        <p>Enter address details below.</p>
					    	<form id="update_shipping_address_form">
						    	<table>
						    	  <tr>
								    <td><label for="edit_address1"> Line 1<span class="required" > *</span> </label></td>
								    <td>
								    	<input id="edit_address1" class="form-control input-md" type="text" placeholder="street address 1" value="" name="address1" required="">
								    </td>
								  </tr>
								  
								  <tr>
								    <td><label for="edit_address2"> Line 2<span class="required" > *</span> </label></td>
								    <td>
								    	<input id="edit_address2" class="form-control input-md" type="text" placeholder="street address 2" value="" name="address2" required="">
								    </td>
								  </tr>
								  
								   <tr>
								    <td><label for="edit_address3"> Line 3</label></td>
								    <td>
								    	<input id="edit_address3" class="form-control input-md" type="text" placeholder="street address 3" value="" name="address3">
								    </td>
								  </tr>
								  
								  <tr>
								    <td><label for="edit_city"> City <span class="required" > *</span> </label></td>
								    <td>
								    <input id="edit_city" class="form-control input-md" type="text" placeholder="city" value="" name="city" required="">
								    </td>
								  </tr>
								  
								  <tr>
								    <td><label for="edit_region"> country province <span class="required" > *</span> </label></td>
								    <td>
								    <input id="edit_region" class="form-control input-md" type="text" placeholder="region" value="" name="region" required="">
								    </td>
								  </tr>
								  <tr>
								    <td><label for="edit_zipcode"> zip code <span class="required" > *</span> </label></td>
								    <td>
								    <input id="edit_zipcode" class="form-control input-md" type="text" placeholder="zip code" value="" name="zipcode" required="">
								    </td>
								  </tr>
								  <tr>
								    <td><label for="edit_country"> country <span class="required" > *</span> </label></td>
								    <td>
								    	<select id="edit_country" class="form-control input-md" name="country" required="">
											<option value="">Country...</option>
											<?php foreach ($countries as $country) : ?>
											<option value="<?php echo $country->Name; ?>"><?php echo $country->Name; ?></option>
											<?php endforeach; ?>
										</select>
								    </td>
								  </tr>
								  
								  <tr>
								  <td></td>
								  <td><a id="save_btn" href="#" class="btn btn-primary btn-success">Save</a></td>
								  </tr>
								</table>
								  
								
								  <input id="edit_address_id" name="address_id" type="hidden" value="" >  </input>
					    	</form>
					    
					       <!-- <p><a data-popup-close="add_new_address" href="#">Close</a></p>-->
					        <a class="popup-close" data-popup-close="edit_address" href="#">x</a>
					    </div>
					</div>
					<!--end pop up update address div-->
					<?php 
					
					
					
					//echo '<pre>';
					//echo "<h2> customer_addresses_vew->customer_billing_addresses (line 32)</h2>";
					//var_dump($customer_billing_addresses);
					//echo '</pre>';
					
					/*echo '<pre>';
					echo "<h2> customer_addresses_vew->customer_details (line 37)</h2>";
					//var_dump($customer_details);
					echo '</pre>';
					
					echo '<pre>';
					echo "<h2> customer_addresses_vew->customer_orders (line 42)</h2>";
					//var_dump($customer_orders);
					echo '</pre>';
					*/?>
					
					
				</div>
			</div>
		</div>
	</section>	
<?php endif; ?>
	