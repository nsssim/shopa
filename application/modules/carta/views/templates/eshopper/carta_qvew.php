<?php $this->load->helper('url'); ?>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~cart not empty ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<?php if($this->cart->total_items() > 0) : ?>
<!--cart quick view not empty-->									
<div class="col-sm-12">
	
	<div class="container-fluid">
		<div class="row"> &nbsp;  </div>
		
		<div class="row">
			<div class="col-md-9">
				<a id="cart_empty_msg" style="text-decoration: underline; font-size: 12px;font-weight: bold;color:black;" href="<?php echo base_url().'carta/details' ?>" > 	<?php echo $words['my_cart']; ?>: <?php echo $this->cart->total_items();  ?> <?php echo $words['item']; ?> </a><br>
			</div>
			<div class="col-md-1 ">
				<a id="xclose" style="cursor: pointer;" ><img src="<?php echo base_url().'assets/templates/eshopper/images/common/xclose.jpg' ?>" /></a>
			</div>
		</div>
		
		<div class="row"> &nbsp;  </div>
		
		
		<div class="row">
			<div class="col-md-12" style="font-size: 13px; text-align: justify;" >
				<?php echo $words['notice']; ?>
			</div>
		</div>
		
		<hr>
		
		<div class="row"> &nbsp;  </div>
		
		<!--list of items-->
		<div id="list_of_items" class="col-md-12" style=" max-height:250px; overflow-y : auto;  ">
			<?php $nrows = sizeof($this->cart->contents()); $n = 0;  ?>
			<?php foreach ($this->cart->contents() as $item) : $n++; ?>
				<!--item-->
				<div class="row"  id="qv_<?php echo($item['rowid']); ?>" >
					<div class="col-md-4">
						<!--thumbnail-->
							<?php if(!empty($item['cat_id'])) : ?>
								<a style=" vertical-align:middle; " href="<?php echo(base_url().'product/cart-details-item-'.$item['id'] .'-cat_id-'. $item['cat_id'].'.html') ?>"><img width="100%" src="<?php 	echo($item['thumbnail'])  ?>" alt=""></a>
							<?php else : ?>
								<a style=" vertical-align:middle; " href="<?php echo(base_url().'product/cart-details-item-'.$item['id'].'.html') ?>"><img width="100%" src="<?php 	echo($item['thumbnail'])  ?>" alt=""></a>
							<?php endif; ?>
						<!--/thumbnail-->
					
					</div>
					
					<div class="col-md-8">
					<!--color if any-->
					<?php if($item['color_name']!=""){?><span style="font-size: 10px" > <?php echo $words['color']; ?>: <?php echo($item['color_name']) ;?> </span><br> <?php }?>
					<!--size if any -->
					<?php if($item['size_name']!=""){?><span style="font-size: 10px" >  <?php echo $words['size']; ?>: <?php 	echo($item['size_name']) ; ?> </span><br> <?php }?>
					<!--qty-->
					<span style="font-size: 10px" ><?php echo $words['qty']; ?>:<?php echo $item['qty']; ?> </span><br>
					<!--price-->
					<span style="font-size: 10px" ><?php echo $words['price']; ?>:</span><span style="font-size: 10px" ><?php echo($currency);?><?php   echo(number_format($item['price'], 2, '.', ','))  ?></span><br>
					<!--details and remove -->
					<?php if(!empty($item['cat_id'])) : ?>
						<a href="<?php echo(base_url().'product/cart-details-item-'.$item['id'] .'-cat_id-'. $item['cat_id'].'.html') ?>"><span class="no_link2" style="font-size: 12px" ><?php echo $words['details']; ?></span></a>
					<?php else : ?>
						<a href="<?php echo(base_url().'product/cart-details-item-'.$item['id'].'.html') ?>"><span class="no_link2" style="font-size: 12px" ><?php echo $words['details']; ?></span></a>
					<?php endif; ?>
					
					<span>&nbsp;</span>
					<a id='qvrmv_<?php echo $item["rowid"]; ?>' class="qrmv" href="#"><span class="no_link2" style="font-size: 12px" ><?php echo $words['remove']; ?></span></a>
					</div>
					
					<hr>
				</div>
				<!--/item-->
				<?php if(($n < $nrows) && ($nrows > 1)  ): ?>
				<!--spacer and border-->
				<div id='ftr_<?php echo $item["rowid"]; ?>' style="padding: 0; margin:0;  ">
					<div class="row"> &nbsp;  </div>
					<div class="col-md-12" style="border-bottom: 1px dotted black;">  </div>
					<div class="row"> &nbsp;  </div>
				</div>
				<!--/spacer and border-->
				<?php endif; ?>
			<?php endforeach; ?>
			
			
			
		</div> <!--/list of items-->
		<div class="col-md-12">
			<hr>
			<div class="row"> &nbsp;  </div>
		</div>
			
		
	</div>
	
	<div id="my_car_details"  >
		<a style="text-decoration: underline; font-size: 12px;font-weight: bold;color:black;" href="<?php echo base_url().'carta/details' ?>" > 	<?php echo $words['my_cart']; ?>: <?php echo $this->cart->total_items();  ?> <?php echo $words['item']; ?> </a><br>
		<span style="font-size: 13px" > <?php echo $words['subtotal'] ?>:</span> <span style="font-size: 13px" ><?php echo($currency);?><?php   echo(number_format($this->cart->total(), 2, '.', ','))  ?></span> <br>
	</div>
	
	<div class="col-sm-12 button-checkout">
		<div class="row">
			<a href="<?php echo base_url().'carta/details' ; ?>" class="btn btn-primary"><?php echo $words['checkout'] ?></a>
		</div>
	</div>
	
	
	
	<div class="col-sm-12"> &nbsp;	</div>
</div>	

<!--/cart quick view -->




<?php else : ?>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~cart empty ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~cart empty ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~cart empty ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<!--cart quick view -->									
<div class="col-sm-12">
	
	<div class="container-fluid">
		<div class="row"> &nbsp;  </div>
		
		<div class="row">
			<div class="col-md-9">
				<?php echo $words['cart_is_empty'] ?> <br>
			</div>
			<div class="col-md-1 ">
				<a id="xclose" style="cursor: pointer;" ><img src="<?php echo base_url().'assets/templates/eshopper/images/common/xclose.jpg' ?>" /></a>
			</div>
		</div>
		
		<div class="row"> &nbsp;  </div>
		
	</div>

</div>	
	
<!--/cart quick view -->
<?php endif; ?>
										