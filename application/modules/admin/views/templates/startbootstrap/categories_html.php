<?php
$subcat4 = $subcat3 = $subcat2 = $subcat1 = $subcat = $cat = $cid = $oo = NULL; // for debugging 
$CI =& get_instance();
$CI->load->module('categories');?>

<div id="boxy" >
	<div class="panel-body">
		<ul>
			<?php foreach ($categories as $cat) :	?>
			<?php if(!empty($cat['active'])) $status ="checked"; else $status ="";  ?>	
			<?php if(!empty($cat['shipping_factor'])) $shipping_factor =$cat['shipping_factor']; else $shipping_factor ="";  ?>	
			<?php if(!empty($cat['promotion_code'])) $promotion_code =$cat['promotion_code']; else $promotion_code ="";  ?>	
			<?php if(!empty($cat['discount_money'])) $discount_money =$cat['discount_money']; else $discount_money ="";  ?>	
			<?php if(!empty($cat['discount_percentage'])) $discount_percentage =$cat['discount_percentage']; else $discount_percentage ="";  ?>	
			<?php if(!empty($cat['service_fee'])) $service_fee ="checked"; else $service_fee ="";  ?>	
				<?php $subcat = $CI->categories->get_subcategories_plus((int)$cat['id']);?>
				<li>
					<?php if(!empty($subcat)){?>
					<!--start if-->
						
						<input title="Active/Inactive" id="status_<?php echo $cat['id']; ?>" class="cat_status has_sub"  type="checkbox" <?php echo($status); ?> /> 
						<span class="sign" id="sign_<?php echo $cat['id'] ;?>" >[+]</span>
						<a id="<?php echo 'catid_'.$cat['id']; ?>" class="catline" data-toggle="collapse" data-parent="#accordianl0" href="#<?php echo $cat['id'];?>"><?php echo $cat['name'];?> </a>
						<div class="righty" >
							<input class="cat_txt ship_fact"    value="<?php echo $shipping_factor; ?>" 	  title="Shipping Factor" 				 placeholder="Shipping Factor" 	id="shipfact_<?php echo $cat['id'] ?>"  type="text"/>
							<input class="cat_pcod"   		   value="<?php echo $promotion_code; ?>" 	  title="Category Promotion Code" 		 placeholder="Promotion Code" 	id="promcode_<?php echo $cat['id'] ?>"  	type="text"/> 
							<input class="cat_txt disc_mon"    value="<?php echo $discount_money; ?>" 	  title="Discount $" 					 placeholder="Discount $" 		id="dismoney_<?php echo $cat['id'] ?>"  	type="text"/> 
							<input class="cat_txt disc_per"    value="<?php echo $discount_percentage; ?>" title="Discount % (example 10% = 0.1)" placeholder="Discount %" 		id="discperc_<?php echo $cat['id'] ?>"  	type="text"/> 
							<input class="cat_srvfee" 		 title="Service Fee" 	id="servifee_<?php echo $cat['id'] ?>"  	type="checkbox" <?php echo($service_fee); ?> />
						</div>
						
						<div id="<?php echo $cat['id'];?>"   name="catleft<?php echo $cat['name'];?>" class="panel-collapse collapse ">
							<div class="panel-body">
								<ul>
								<?php  	 foreach ($subcat as $subcat1) :?>
									<?php if(!empty($subcat1['active'])) $status ="checked"; else $status ="";  ?>
									<?php if(!empty($subcat1['shipping_factor'])) $shipping_factor =$subcat1['shipping_factor']; else $shipping_factor ="";  ?>	
									<?php if(!empty($subcat1['promotion_code'])) $promotion_code =$subcat1['promotion_code']; else $promotion_code ="";  ?>	
									<?php if(!empty($subcat1['discount_money'])) $discount_money =$subcat1['discount_money']; else $discount_money ="";  ?>	
									<?php if(!empty($subcat1['discount_percentage'])) $discount_percentage =$subcat1['discount_percentage']; else $discount_percentage ="";  ?>	
									<?php if(!empty($subcat1['service_fee'])) $service_fee ="checked"; else $service_fee ="";  ?>	
									<?php $subcat2 = $CI->categories->get_subcategories_plus((int)$subcat1['id']);?>
									<li>
									<?php if(!empty($subcat2)){ ?>
									<!--start if-->
										<input id="status_<?php echo $subcat1['id']; ?>" title="active/inactive"  class="cat_status" type="checkbox" <?php echo($status); ?> /> 
										<span class="sign" id="sign_<?php echo $subcat1['id'] ;?>" >[+]</span>
										<a id="<?php echo 'catid_'.$subcat1['id']; ?>" class="catline" data-toggle="collapse" data-parent="#accordianl0" href="__#<?php echo $subcat1['id'];?>"> <?php echo($subcat1['name']);?> </a>
										<div class="righty" >
											<input class="cat_txt ship_fact"  value="<?php echo $shipping_factor; ?>" 	  title="Shipping Factor" 				 placeholder="Shipping Factor" 	id="shipfact_<?php echo $subcat1['id'] ?>"  type="text"/>
											<input class="cat_pcod"   		  value="<?php echo $promotion_code; ?>" 	  title="Category Promotion Code" 		 placeholder="Promotion Code" 	id="promcode_<?php echo $subcat1['id'] ?>"  	type="text"/> 
											<input class="cat_txt disc_mon"   value="<?php echo $discount_money; ?>" 	  title="Discount $" 					 placeholder="Discount $" 		id="dismoney_<?php echo $subcat1['id'] ?>"  	type="text"/> 
											<input class="cat_txt disc_per"   value="<?php echo $discount_percentage; ?>" title="Discount % (example 10% = 0.1)" placeholder="Discount %" 		id="discperc_<?php echo $subcat1['id'] ?>"  	type="text"/> 
											<input class="cat_srvfee" 		  title="Service Fee" 	id="servifee_<?php echo $subcat1['id'] ?>"  	type="checkbox" <?php echo($service_fee); ?> />
										</div>
										
										<div id="<?php echo $subcat1['id'];?>"   name="catleft<?php echo $subcat1['name'] ;?>" class="panel-collapse collapse ">
											<div class="panel-body">
											
												<ul>
													<?php foreach($subcat2 as $subcat3) :  ?>
													<?php if(!empty($subcat3['active'])) $status ="checked"; else $status ="";  ?>
													<?php if(!empty($subcat3['shipping_factor'])) $shipping_factor =$subcat3['shipping_factor']; else $shipping_factor ="";  ?>	
													<?php if(!empty($subcat3['promotion_code'])) $promotion_code =$subcat3['promotion_code']; else $promotion_code ="";  ?>	
													<?php if(!empty($subcat3['discount_money'])) $discount_money =$subcat3['discount_money']; else $discount_money ="";  ?>	
													<?php if(!empty($subcat3['discount_percentage'])) $discount_percentage =$subcat3['discount_percentage']; else $discount_percentage ="";  ?>	
													<?php if(!empty($subcat3['service_fee'])) $service_fee ="checked"; else $service_fee ="";  ?>	
													<?php $subcat4 = $CI->categories->get_subcategories_plus((int)$subcat3['id']);?>
													<li>
														<?php if(!empty($subcat4)){ ?>
														<!--start if-->
														<input id="status_<?php echo $subcat3['id']; ?>" title="active/inactive"  class="cat_status" type="checkbox" <?php echo($status); ?> />
														<span class="sign" id="sign_<?php echo $subcat3['id'] ;?>" >[+]</span>
														<a id="<?php echo 'catid_'.$subcat3['id']; ?>" class="catline" data-toggle="collapse" data-parent="#accordianl0" href="__#<?php echo $subcat3['id'];?>"> <?php echo($subcat3['name']);?> </a>
														<div class="righty" >
																<input class="cat_txt ship_fact"  value="<?php echo $shipping_factor; ?>" 	  title="Shipping Factor" 				 placeholder="Shipping Factor" 	id="shipfact_<?php echo $subcat3['id'] ?>"  type="text"/>
																<input class="cat_pcod"   		  value="<?php echo $promotion_code; ?>" 	  title="Category Promotion Code" 		 placeholder="Promotion Code" 	id="promcode_<?php echo $subcat3['id'] ?>"  	type="text"/> 
																<input class="cat_txt disc_mon"   value="<?php echo $discount_money; ?>" 	  title="Discount $" 					 placeholder="Discount $" 		id="dismoney_<?php echo $subcat3['id'] ?>"  	type="text"/> 
																<input class="cat_txt disc_per"   value="<?php echo $discount_percentage; ?>" title="Discount % (example 10% = 0.1)" placeholder="Discount %" 		id="discperc_<?php echo $subcat3['id'] ?>"  	type="text"/> 
																<input class="cat_srvfee" 		  title="Service Fee" 	id="servifee_<?php echo $subcat3['id'] ?>"  	type="checkbox" <?php echo($service_fee); ?> />
														</div>
						
														<div id="<?php echo $subcat3['id'];?>"   name="catleft<?php echo $subcat3['name'] ;?>" class="panel-collapse collapse ">
															<div class="panel-body">
															
															<ul>
																<?php foreach($subcat4 as $subcat5) :  ?>
																<?php if(!empty($subcat5['active'])) $status ="checked"; else $status ="";  ?>
																<?php if(!empty($subcat5['shipping_factor'])) $shipping_factor =$subcat5['shipping_factor']; else $shipping_factor ="";  ?>	
																<?php if(!empty($subcat5['promotion_code'])) $promotion_code =$subcat5['promotion_code']; else $promotion_code ="";  ?>	
																<?php if(!empty($subcat5['discount_money'])) $discount_money =$subcat5['discount_money']; else $discount_money ="";  ?>	
																<?php if(!empty($subcat5['discount_percentage'])) $discount_percentage =$subcat5['discount_percentage']; else $discount_percentage ="";  ?>	
																<?php if(!empty($subcat5['service_fee'])) $service_fee ="checked"; else $service_fee ="";  ?>		
																<?php $subcat6 = $CI->categories->get_subcategories_plus((int)$subcat5['id']);?>
																<li>
																	<?php if(!empty($subcat6)){ ?>
																	<!--start if-->
																	<input id="status_<?php echo $subcat5['id']; ?>" title="active/inactive"  class="cat_status" type="checkbox" <?php echo($status); ?> /> 
																	<span class="sign" id="sign_<?php echo $subcat5['id'] ;?>" >[+]</span>
																	<a id="<?php echo 'catid_'.$subcat5['id']; ?>" class="catline" data-toggle="collapse" data-parent="#accordianl0" href="__#<?php echo $subcat5['id'];?>"> <?php echo($subcat5['name']);?> </a>
																	<div class="righty" >
																		<input class="cat_txt ship_fact"  value="<?php echo $shipping_factor; ?>" 	  title="Shipping Factor" 				 placeholder="Shipping Factor" 	id="shipfact_<?php echo $subcat5['id'] ?>"  type="text"/>
																		<input class="cat_pcod"   		  value="<?php echo $promotion_code; ?>" 	  title="Category Promotion Code" 		 placeholder="Promotion Code" 	id="promcode_<?php echo $subcat5['id'] ?>"  	type="text"/> 
																		<input class="cat_txt disc_mon"   value="<?php echo $discount_money; ?>" 	  title="Discount $" 					 placeholder="Discount $" 		id="dismoney_<?php echo $subcat5['id'] ?>"  	type="text"/> 
																		<input class="cat_txt disc_per"   value="<?php echo $discount_percentage; ?>" title="Discount % (example 10% = 0.1)" placeholder="Discount %" 		id="discperc_<?php echo $subcat5['id'] ?>"  	type="text"/> 
																		<input class="cat_srvfee" 		  title="Service Fee" 	id="servifee_<?php echo $subcat5['id'] ?>"  	type="checkbox" <?php echo($service_fee); ?> />
																	</div>
						
																	<div id="<?php echo $subcat5['id'];?>"   name="catleft<?php echo $subcat5['name'] ;?>" class="panel-collapse collapse ">
																		<div class="panel-body">
																		
																		<ul>
																			<?php foreach($subcat6 as $subcat7) :  ?>
																			<?php if(!empty($subcat7['active'])) $status ="checked"; else $status ="";  ?>
																			<?php if(!empty($subcat7['shipping_factor'])) $shipping_factor =$subcat7['shipping_factor']; else $shipping_factor ="";  ?>	
																			<?php if(!empty($subcat7['promotion_code'])) $promotion_code =$subcat7['promotion_code']; else $promotion_code ="";  ?>	
																			<?php if(!empty($subcat7['discount_money'])) $discount_money =$subcat7['discount_money']; else $discount_money ="";  ?>	
																			<?php if(!empty($subcat7['discount_percentage'])) $discount_percentage =$subcat7['discount_percentage']; else $discount_percentage ="";  ?>	
																			<?php if(!empty($subcat7['service_fee'])) $service_fee ="checked"; else $service_fee ="";  ?>		
																			<?php $subcat8 = $CI->categories->get_subcategories_plus((int)$subcat7['id']);?>
																			<li>
																				<?php if(!empty($subcat8)){ ?>
																				<!--start if-->
																				<input id="status_<?php echo $subcat7['id']; ?>" title="active/inactive"  class="cat_status" type="checkbox" <?php echo($status); ?> /> 
																				<span class="sign" id="sign_<?php echo $subcat7['id'] ;?>" >[+]</span>
																				<a id="<?php echo 'catid_'.$subcat7['id']; ?>" class="catline" data-toggle="collapse" data-parent="#accordianl0" href="__#<?php echo $subcat7['id'];?>"> <?php echo($subcat7['name']);?> </a>
																				<div class="righty" >
																					<input class="cat_txt ship_fact"  value="<?php echo $shipping_factor; ?>" 	  title="Shipping Factor" 				 placeholder="Shipping Factor" 	id="shipfact_<?php echo $subcat7['id'] ?>"  type="text"/>
																					<input class="cat_pcod"   		  value="<?php echo $promotion_code; ?>" 	  title="Category Promotion Code" 		 placeholder="Promotion Code" 	id="promcode_<?php echo $subcat7['id'] ?>"  	type="text"/> 
																					<input class="cat_txt disc_mon"   value="<?php echo $discount_money; ?>" 	  title="Discount $" 					 placeholder="Discount $" 		id="dismoney_<?php echo $subcat7['id'] ?>"  	type="text"/> 
																					<input class="cat_txt disc_per"   value="<?php echo $discount_percentage; ?>" title="Discount % (example 10% = 0.1)" placeholder="Discount %" 		id="discperc_<?php echo $subcat7['id'] ?>"  	type="text"/> 
																					<input class="cat_srvfee" 		  title="Service Fee" 	id="servifee_<?php echo $subcat7['id'] ?>"  	type="checkbox" <?php echo($service_fee); ?> />
																				</div>
						
																				<div id="<?php echo $subcat7['id'];?>"   name="catleft<?php echo $subcat7['name'] ;?>" class="panel-collapse collapse ">
																					<div class="panel-body">
																					<ul>
																						<li>....<!--maximum depth reached --> </li>
																					</ul>
																					</div>
																				</div>
																				<?php }
																				else {?>
																				<input id="status_<?php echo $subcat7['id']; ?>" title="active/inactive"  class="cat_status" type="checkbox" <?php echo($status); ?> /> 
																				<a id="<?php echo 'catid_'.$subcat7['id']; ?>" class="catline" href="#"> <?php echo($subcat7['name']);?> </a>
																				<div class="righty" >
																					<input class="cat_txt ship_fact"  value="<?php echo $shipping_factor; ?>" 	  title="Shipping Factor" 				 placeholder="Shipping Factor" 	id="shipfact_<?php echo $subcat7['id'] ?>"  type="text"/>
																					<input class="cat_pcod"   		  value="<?php echo $promotion_code; ?>" 	  title="Category Promotion Code" 		 placeholder="Promotion Code" 	id="promcode_<?php echo $subcat7['id'] ?>"  	type="text"/> 
																					<input class="cat_txt disc_mon"   value="<?php echo $discount_money; ?>" 	  title="Discount $" 					 placeholder="Discount $" 		id="dismoney_<?php echo $subcat7['id'] ?>"  	type="text"/> 
																					<input class="cat_txt disc_per"   value="<?php echo $discount_percentage; ?>" title="Discount % (example 10% = 0.1)" placeholder="Discount %" 		id="discperc_<?php echo $subcat7['id'] ?>"  	type="text"/> 
																					<input class="cat_srvfee" 		  title="Service Fee" 	id="servifee_<?php echo $subcat7['id'] ?>"  	type="checkbox" <?php echo($service_fee); ?> />
																				</div>
																				<?php } ?>
																			</li>
																			<?php endforeach; ?>
																		</ul>
																		
																		
																		</div>
																	</div>
																	<?php }
																	else {?>
																	<input id="status_<?php echo $subcat5['id']; ?>" title="active/inactive"  class="cat_status" type="checkbox" <?php echo($status); ?> /> 
																	<a id="<?php echo 'catid_'.$subcat5['id']; ?>" class="catline" href="#"> <?php echo($subcat5['name']);?> </a>
																	<div class="righty" >
																	<input class="cat_txt ship_fact"  value="<?php echo $shipping_factor; ?>" 	  title="Shipping Factor" 				 placeholder="Shipping Factor" 	id="shipfact_<?php echo $subcat5['id'] ?>"  type="text"/>
																	<input class="cat_pcod"   		  value="<?php echo $promotion_code; ?>" 	  title="Category Promotion Code" 		 placeholder="Promotion Code" 	id="promcode_<?php echo $subcat5['id'] ?>"  	type="text"/> 
																	<input class="cat_txt disc_mon"   value="<?php echo $discount_money; ?>" 	  title="Discount $" 					 placeholder="Discount $" 		id="dismoney_<?php echo $subcat5['id'] ?>"  	type="text"/> 
																	<input class="cat_txt disc_per"   value="<?php echo $discount_percentage; ?>" title="Discount % (example 10% = 0.1)" placeholder="Discount %" 		id="discperc_<?php echo $subcat5['id'] ?>"  	type="text"/> 
																	<input class="cat_srvfee" 		  title="Service Fee" 	id="servifee_<?php echo $subcat5['id'] ?>"  	type="checkbox" <?php echo($service_fee); ?> />
																	</div>
																	<?php } ?>
																</li>
																<?php endforeach; ?>
															</ul>
															
															</div>
														</div>
														<?php }
														else {?>
														<input id="status_<?php echo $subcat3['id']; ?>" title="active/inactive"  class="cat_status" type="checkbox" <?php echo($status); ?> /> 
														<a id="<?php echo 'catid_'.$subcat3['id']; ?>" class="catline" href="#"> <?php echo($subcat3['name']);?> </a>
														<div class="righty" >
															<input class="cat_txt ship_fact"  value="<?php echo $shipping_factor; ?>" 	  title="Shipping Factor" 				 placeholder="Shipping Factor" 	id="shipfact_<?php echo $subcat3['id'] ?>"  type="text"/>
															<input class="cat_pcod"   		  value="<?php echo $promotion_code; ?>" 	  title="Category Promotion Code" 		 placeholder="Promotion Code" 	id="promcode_<?php echo $subcat3['id'] ?>"  	type="text"/> 
															<input class="cat_txt disc_mon"   value="<?php echo $discount_money; ?>" 	  title="Discount $" 					 placeholder="Discount $" 		id="dismoney_<?php echo $subcat3['id'] ?>"  	type="text"/> 
															<input class="cat_txt disc_per"   value="<?php echo $discount_percentage; ?>" title="Discount % (example 10% = 0.1)" placeholder="Discount %" 		id="discperc_<?php echo $subcat3['id'] ?>"  	type="text"/> 
															<input class="cat_srvfee" 		  title="Service Fee" 	id="servifee_<?php echo $subcat3['id'] ?>"  	type="checkbox" <?php echo($service_fee); ?> />
														</div>
														<?php } ?>
													</li>
													<?php endforeach; ?>
												</ul>
												
											</div>
										</div>
									<?php }
									 else { ?>
										<input id="status_<?php echo $subcat1['id']; ?>" title="active/inactive"  class="cat_status" type="checkbox" <?php echo($status); ?> /> 
										<a id="<?php echo 'catid_'.$subcat1['id']; ?>" class="catline" href="#"> <?php echo($subcat1['name']);?> </a>
										<div class="righty" >
											<input class="cat_txt ship_fact"  value="<?php echo $shipping_factor; ?>" 	  title="Shipping Factor" 				 placeholder="Shipping Factor" 	id="shipfact_<?php echo $subcat1['id'] ?>"  type="text"/>
											<input class="cat_pcod"   		  value="<?php echo $promotion_code; ?>" 	  title="Category Promotion Code" 		 placeholder="Promotion Code" 	id="promcode_<?php echo $subcat1['id'] ?>"  	type="text"/> 
											<input class="cat_txt disc_mon"   value="<?php echo $discount_money; ?>" 	  title="Discount $" 					 placeholder="Discount $" 		id="dismoney_<?php echo $subcat1['id'] ?>"  	type="text"/> 
											<input class="cat_txt disc_per"   value="<?php echo $discount_percentage; ?>" title="Discount % (example 10% = 0.1)" placeholder="Discount %" 		id="discperc_<?php echo $subcat1['id'] ?>"  	type="text"/> 
											<input class="cat_srvfee" 		  title="Service Fee" 	id="servifee_<?php echo $subcat1['id'] ?>"  	type="checkbox" <?php echo($service_fee); ?> />
										</div>
									<?php } ?>	
									<!--end else-->
									
									</li>
								<?php endforeach; ?>
								</ul>
							</div>
						</div>
						<?php }
						  else{ ?>
						<input id="status_<?php echo $cat['id']; ?>" title="active/inactive"  class="cat_status" type="checkbox" <?php echo($status); ?> /> 
						<a id="<?php echo 'catid_'.$cat['id']; ?>" class="catline" href="#"><?php echo $cat['name'];?> </a>
						<div class="righty" >
							<input class="cat_txt ship_fact"  value="<?php echo $shipping_factor; ?>" 	  title="Shipping Factor" 				 placeholder="Shipping Factor" 	id="shipfact_<?php echo $cat['id'] ?>"  type="text"/>
							<input class="cat_pcod"   		  value="<?php echo $promotion_code; ?>" 	  title="Category Promotion Code" 		 placeholder="Promotion Code" 	id="promcode_<?php echo $cat['id'] ?>"  	type="text"/> 
							<input class="cat_txt disc_mon"   value="<?php echo $discount_money; ?>" 	  title="Discount $" 					 placeholder="Discount $" 		id="dismoney_<?php echo $cat['id'] ?>"  	type="text"/> 
							<input class="cat_txt disc_per"   value="<?php echo $discount_percentage; ?>" title="Discount % (example 10% = 0.1)" placeholder="Discount %" 		id="discperc_<?php echo $cat['id'] ?>"  	type="text"/> 
							<input class="cat_srvfee" 		  title="Service Fee" 	id="servifee_<?php echo $cat['id'] ?>"  	type="checkbox" <?php echo($service_fee); ?> />
						</div>
						
					<?php }?>
					<!--end else-->
					
					
				</li>
				
			<?php endforeach; ?>
		</ul>
	</div>
</div>
