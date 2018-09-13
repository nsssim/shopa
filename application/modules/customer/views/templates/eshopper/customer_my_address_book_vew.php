<?php
$this->load->helper('url');
$CI              =& get_instance();
$CI->load->library('cleanurl');
$CURRENCY        = "$";
$RATE            = 1;

$ssl_port_num    = ":".SSL_PORT;  // :443 is the default
$base_url_str    = base_url();
$sbu             = str_replace("http","https",$base_url_str );
$secure_base_url = str_replace(".com",".com$ssl_port_num",$sbu );

/*
?><img height="50px" src="https://avatars1.githubusercontent.com/u/386750?v=3&s=400" /><?
$CI->load->library('firebug');  echo(' Woking behind the scene........ok <br>');
$CI->firebug->info($shipping_address_details,"shipping_address_details");
$CI->firebug->info($cities_tr,"cities_tr");
//$CI->firebug->info($cart_content,"cart_content");
*/




//if session expired show message
if(isset($log_out_message)){
	echo $log_out_message;
}
//else show page body
else
{
	?>
	<?php

	//if(!empty($customer_and_shipping_addresses[0]->attention )) 			$attention = ucfirst($customer_and_shipping_addresses[0]->attention) ;

	?>



	<section>
		<form id="na_form" method="post" action="<?php echo $secure_base_url.'customer/add_update_shipping_address' ; ?>"  >
			<div class="container">
				<div class="row">
					<div class="col-sm-3">

						<?php include("customer_left_vew.php"); ?>

					</div>
					<div class="col-sm-9">


						<a style="color: grey;" href="<?php echo $secure_base_url.'customer/my_account' ?>"  > <?php echo $words['my_account_brdcrmp']; ?> <!--My Account-->	</a>
						<img style="padding: 0; height: 12px;" src="<?php echo $secure_base_url.'assets/templates/eshopper/images/grey_arrow_right.png' ?>" />
						<span style="font-size: 12px; color: grey;" > <?php echo $words['my_adrs_book_brdcrmp']; ?> <!--My Address Book--> </span>

						<div class="col-sm-12"  style="height: 15px; padding: 0" >
							&nbsp;
						</div>

						<?php
						$address_updated= $this->input->get('address_updated');
						$address_added= $this->input->get('address_added');
						$address_set= $this->input->get('address_set');
						$address_deleted= $this->input->get('address_deleted');
						
						if(!empty($address_updated)) : ?>

						<div class="alert alert-success" style="margin-top: 15px;">
							<span class="glyphicon glyphicon-ok" >	</span>
							<?php echo $words['your_adrs_updated_ok'] ?> <!--Your address was successfully <b>updated</b>-->
						</div>

						<?php endif; ?>
						
						<?php if(!empty($address_added)) : ?>

						<div class="alert alert-success" style="margin-top: 15px;">
							<span class="glyphicon glyphicon-ok" >	</span>
							<?php echo $words['your_adrs_added_ok'] ?> <!--Your address was successfully <b>added</b>-->
						</div>

						<?php endif; ?>
						
						<?php if(!empty($address_set)) : ?>

						<div class="alert alert-success" style="margin-top: 15px;">
							<span class="glyphicon glyphicon-ok" >	</span>
							<?php echo $words['your_adrs_updated_ok'] ?> <!--Your address was successfully <b>updated</b>-->
						</div>

						<?php endif; ?>
						
						<?php if(!empty($address_deleted)) : ?>

						<div class="alert alert-success" style="margin-top: 15px;">
							<span class="glyphicon glyphicon-ok" >	</span>
							<?php echo $words['adrs_deleted'] ?>  <!--Address   <b>deleted</b>-->
						</div>

						<?php endif; ?>


						<div style="margin-bottom: 5px">
							<img height="32px" src="<?php echo $secure_base_url.$words['my_adrs_book_img'] ?>" >
						</div>
						<div style="border-bottom: 1px solid black; width: 100%; margin-bottom: 15px;" >
						</div>

						<div style="font-family: Nunito,Helvetica,Verdana,Sans-serif; font-size: 0.89em; " >
							<?php echo $words['on_this_page'] ?> <!--On this page you may:-->
							<div style="height: 15px" >
								&nbsp;
							</div>
							<ul >
								<li style="list-style: disc;margin-bottom: 5px;" >
									<?php echo $words['create_n_store_adrs'] ?> <!--<strong> Create and store new shipping addresses:</strong>click "Add Address" on the left and enter info in text fields on the right. Click "Save Address" to save.-->
								</li>
								<li style="list-style: disc;margin-bottom: 5px;" >
									<?php echo $words['edit_n_detete_adrs'] ?> <!--<strong>Edit or delete existing shipping addresses: </strong>click "Edit" beneath the shipping address and input changes in the text fields on the right. Click "Update Address" to update. Click "Delete" to remove an address.-->
								</li>
								<li style="list-style: disc;margin-bottom: 5px;" >
									<?php echo $words['change_prim_adrs'] ?> <!--<strong>Change your primary shipping address:</strong>click "Make Primary" beneath the shipping address you wish to automatically ship to.-->
								</li>
							</ul>

						</div>

						<!--<div style="color: white; background-color:black; padding: 5px 5px 5px 10px;font-weight: bold; ">MAILING ADDRESS & INFORMATION</div>-->
						
						<!--left side -->
						<div class="col-sm-6" style="border: 1px solid black; padding: 0;">
							<div style="background-color: grey; color:white; text-align: center;">
								<?php echo $words['your_ship_adrs'] ?> <!--Your Shipping Address(es)-->
							</div>
							<div style="padding: 5px;">
							
								<div class="address_box" >
									<?php foreach( $shipping_address_details as $shipadd ): ?>
									 	<div id="sid_<?php echo $shipadd->address_id;  ?>"  >
									 		
										 	<?php if ($shipadd->is_default == 1 ) :  ?> 
										 	<span style="font-weight: bold;"><?php echo $words['prim_ship_adrs'] ?> <!--Primary shipping address--></span> <br>
										 	<?php endif ;  ?> 

											<div class="col-sm-12" style="height:10px "> &nbsp; </div> 
											
										 	<?php if(!empty($shipadd->attention)) echo $shipadd->attention."<br>";  ?> 
										 	
										 	<?php echo $shipadd->address_f_name.' ';  ?> 	<?php echo $shipadd->address_l_name;  ?> <br>
										 	
										 	<?php echo $shipadd->line_1;  ?> ,
										 	
										 	<?php echo $shipadd->line_2;  ?> <br>
										 	
										 	<?php foreach($cities_tr as $tr_city):?>
											 	<?php if($tr_city->id == $shipadd->city): ?>
											 		<?php echo $tr_city->name;  ?> , 
											 	<?php endif; ?>
										 	<?php endforeach;?>
										 	
										 	<?php foreach($counties_tr as $tr_county):?>
											 	<?php if($tr_county->id == $shipadd->country_province): ?>
											 		<?php echo $tr_county->name;  ?> <br>
											 	<?php endif; ?>
										 	<?php endforeach;?>
										 	
										 	<?php echo $shipadd->zip_code;  ?> <br>
										 	
										 	<?php if($shipadd->coutry == 1 ): ?>
												Turkey <br>
											 <?php endif; ?>
											 
											<?php if($shipadd->coutry == 2 ): ?>
												USA <br>
											 <?php endif; ?> 
											
											<div class="col-sm-12" style="height:15px "> &nbsp; </div> 
											 	
											<div style="font-size:12px; color: black">
												<a id='<?php echo "edit_address_".$shipadd->address_id;?>' class="edit_address" style="color: black; text-decoration: underline; cursor: pointer; "><?php echo $words['edit'] ?></a>
												|  <a id='<?php echo "del_address_".$shipadd->address_id;?>' class="delete_address" style="color: black; text-decoration: underline; cursor: pointer; "><?php echo $words['delete'] ?> </a> 
												<?php if ($shipadd->is_default != 1 ) :  ?>
												|  <a id='<?php echo "set_address_".$shipadd->address_id;?>' class="set_address" style="color: black; text-decoration: underline; cursor: pointer; "><?php echo $words['make_primary'] ?></a> 
											 	<?php endif; ?> 
											</div>
											
											
											
											<hr>
									 	</div>
									<?php endforeach; ?>
									
								</div>
								
							</div>
							
							<div class="col-sm-12">
								<div class="col-sm-3">

								</div>

								<div class="col-sm-9" style="margin: 10px 0 10px 0;">
									<div style="text-align:right;">
										<!--<a class="button" style="
										background-color:#797979;
										color: #ffffff;
										padding: 15px 32px;
										text-align: center;
										text-decoration: none;
										display: inline-block;
										font-size: 16px;
										margin-right: 10px;
										cursor: pointer;"  >CANCEL
										</a>-->

										<a href="<?php echo $secure_base_url.'customer/my_address_book' ?>"  id="na_add_address_btn"  style="
										background-color:#000000;
										color: #ffffff;
										padding: 15px 25px;
										text-align: center;
										text-decoration: none;
										display: inline-block;
										font-size: 16px;
										border: none;
										cursor: pointer;"  > <?php echo $words['add_adrs'] ?> <!--Add Address--> </a>

									</div>
								</div>
							</div>
							
						</div>
						<!--right side -->
						<div id="na-left" class="col-sm-6">

								<label class="na-label" >
									<?php echo $words['attention'] ?> <!--Attention-->
								</label>
								<input id="na_attention" type="text" maxlength="20" class="na-input" name = "na_attention" /><br>
								<div id="na_attention_error" class="error-span-container"  >
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true">
									</span>
									<span  class="input-error-span" >
										<?php echo $words['error_att'] ?> <!--Please enter a valid name. special charachters like +=,\|/%#$@~?<>![]{}^&*():; are not allowed-->
									</span>
								</div>
								
								<div style="height: 15px" >
									&nbsp;
								</div>

								<label class="na-label" >
									<?php echo $words['fname'] ?> <!--First Name-->
								</label>
								<input id="na_firstname" type="text" maxlength="20" class="na-input" name = "na_firstname" /><br>
								<div id="fname_error" class="error-span-container"  >
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true">
									</span>
									<span  class="input-error-span" >
										<?php echo $words['error_fname'] ?> <!--Please enter a valid first name. special charachters like +=,\|/%#$@~?<>![]{}^&*():; are not allowed-->
									</span>
								</div>

								<div style="height: 15px" >
									&nbsp;
								</div>

								<label class="na-label">
									<?php echo $words['lname'] ?> <!--Last Name-->
								</label><br>
								<input id="na_lastname" type="text" maxlength="30" class="input-txt" name = "na_lastname"  /><br>
								<div id="lname_error" class="error-span-container"  >
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true">
									</span>
									<span class="input-error-span"  >
										<?php echo $words['error_lname'] ?> <!--Please enter a valid last name.  special charachters like +=,\|/%#$@~?<>![]{}^&*():; are not allowed-->
									</span>
								</div>

								<div style="height: 15px" >
									&nbsp;
								</div>

								<label class="na-label">
									<?php echo $words['address_line1'] ?> <!--Mailing Address &amp; Infromation-->
								</label><br>
								<input id="na_sha_line1" type="text" class="input-txt"  name = "na_sha_line1"  /><br>
								<div id="na_line1_error" class="error-span-container"  >
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true">
									</span>
									<span  class="input-error-span" >
										<?php echo $words['error_add1'] ?> <!--Please enter an address. the following characters are not acepted +=%$~{}\^*;-->
									</span>
								</div>

								<div style="height: 15px" >
									&nbsp;
								</div>

								<label class="na-label">
									<?php echo $words['address_line2'] ?> <!--Apt/Suite-->
								</label><br>
								<input id="na_sha_line2" type="text" class="input-txt"  name = "na_sha_line2"  /><br>
								<div id="na_sha_line2_error" class="error-span-container"  >
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true">
									</span>
									<span  class="input-error-span" >
										<?php echo $words['error_add2'] ?> <!--Special characters like +=%$~{}\^*; are not allowed-->
									</span>
								</div>

								<div style="height: 15px" >
									&nbsp;
								</div>

								<label class="na-label">
									<?php echo $words['country'] ?> <!--country-->
								</label><br>
								<select id="na_country_select" class="selct-menu" name = "na_country_select" >
									<ul>
										<li>
											<option value="1" selected="1">
												Turkey
											</option>
										</li>
										<!--<li><option value="2">usa</option></li>-->
									</ul>
								</select>

								<div style="height: 15px" >
									&nbsp;
								</div>

								<label class="na-label">
									<?php echo $words['city'] ?> <!--city (Şehir)-->
								</label><br>
								<select id="na_city_select" class="selct-menu" name = "na_city_select" >
									<ul>
										<?php
										foreach($cities_tr as $city_tr): ?>
										<?php
										if($city_tr->id == $ba_city ) $city_selected = 'selected="1"';
										else $city_selected = ''; ?>
										<li>
											<option value="<?php echo $city_tr->id ?>" <?php echo $city_selected; ?> >
												<?php echo $city_tr->name ?>
											</option>
										</li>
										<?php endforeach; ?>
									</ul>
								</select>

								<div style="height: 15px" >
									&nbsp;
								</div>

								<label class="na-label">
									<?php echo $words['county'] ?> <!--county (İlçe)-->
								</label><br>
								<select id="na_county_select" class="selct-menu" name = "na_county_select" >
									<ul>
										<?php
										foreach($counties_tr as $county_tr): ?>
										<?php
										if($county_tr->id == $ba_county ) $county_selected = 'selected="1"';
										else $county_selected = ''; ?>
										<li>
											<option value="<?php echo $county_tr->id ?>" <?php echo $county_selected; ?> >
												<?php echo $county_tr->name ?>
											</option>
										</li>
										<?php endforeach; ?>
									</ul>
								</select>
						
								<div style="height: 15px" >
									&nbsp;
								</div>

								<label class="na-label">
									<?php echo $words['zipcode'] ?> <!--zipcode-->
								</label><br>
								<input id="na_zipcode" type="text" maxlength="10" class="input-txt" name = "na_zip"  /><br>
								
								<div id="na_zip_error" class="error-span-container" name = "na_zip_error" >
									<span class="glyphicon glyphicon-exclamation-sign" > </span>
									<span  class="input-error-span" >
										<?php echo $words['error_zip'] ?> <!--Please enter a 5-digit or a 5+4-digit zip code.-->
									</span>
								</div>

								<div style="height: 15px" >
									&nbsp;
								</div>






							<label class="na-label" >
								<?php echo $words['phone_num'] ?> <!--Phone Number-->
							</label><br>
							<input id="na_phone" type="text" maxlength="20" class="na-input" name = "na_phone"   /><br>
							<div id="na_phone_error" class="error-span-container"  >
								<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true">
								</span>
								<span  style="font-size: 12px;font-family: Nunito,Helvetica,Verdana,sans-serif; " >
									<?php echo $words['error_phone'] ?> <!--enter a valid phone number only numbers ( ) + - and X are allowed-->
								</span>
							</div>

							<div style="height: 15px" >
								&nbsp;
							</div>

							<input id="address_id" type="hidden" name="address_id" value="new" >
							
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
							<input type="hidden" name = "lastvisit_stmp2" value="<?php echo $this->security->get_csrf_hash(); ?>" />



							<div style="height: 15px" >	&nbsp;	</div>
							
							
							<div class="col-sm-12" style="padding-right: 0px;" >
								<div class="col-sm-5">

								</div>

								<div class="col-sm-7" style="margin: 10px 0 10px 0; padding-right: 0">
									<div style="text-align:right;">
										<!--<a class="button" style="
										background-color:#797979;
										color: #ffffff;
										padding: 15px 32px;
										text-align: center;
										text-decoration: none;
										display: inline-block;
										font-size: 16px;
										margin-right: 10px;
										cursor: pointer;"  >CANCEL
										</a>-->

										<input type="submit" value="<?php echo $words['save_adrs_btn'] ?>" id="na_submit_btn" class="button" style="
										background-color:#000000;
										color: #ffffff;
										padding: 15px 25px;
										text-align: center;
										text-decoration: none;
										display: inline-block;
										font-size: 16px;
										border: none;
										cursor: pointer;"  />
										
										<input type="hidden" value="<?php echo $words['update_adrs_btn'] ?>" id="na_submit_btn2" class="button" style="
										background-color:#000000;
										color: #ffffff;
										padding: 15px 20px;
										text-align: center;
										text-decoration: none;
										display: inline-block;
										font-size: 16px;
										border: none;
										cursor: pointer;"  />

									</div>
								</div>
							</div>
							
							<div class="col-sm-12" style="height: 50px" >	&nbsp;	</div>

						</div>
							
					</div>

				</div>

				
			</div>

				

		</form>
	</section>
	<?php
} ?>
