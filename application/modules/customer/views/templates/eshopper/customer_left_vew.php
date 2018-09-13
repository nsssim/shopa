<?php 

$CI =& get_instance();

$ssl_port_num = ":".SSL_PORT;  // :443 is the default
$base_url_str = base_url(); 
$sbu = str_replace("http","https",$base_url_str );
$secure_base_url = str_replace(".com",".com$ssl_port_num",$sbu );

if(!empty($customer_details[0]->is_admin))
{
	$is_admin = $customer_details[0]->is_admin;
}
else
{
	$is_admin = NULL;
}

?>
					<div class="col-sm-3 account-left">
						<!--<h3>My Account</h3>
						<div> <a <?php if(isset($is_account_page)) 	echo 'style="color:red;"';else echo 'style="color:black;"';?> 	href="<?php echo base_url().'customer/myaccount'; ?>" >		My Account	</a> </div>
						<div> <a <?php if(isset($is_order_page)) 	echo 'style="color:red;"';else echo 'style="color:black;"';?> 	href="<?php echo base_url().'customer/myorders'; ?>" >		My Orders	</a> </div>
						<div> <a <?php if(isset($is_address_page)) 	echo 'style="color:red;"';else echo 'style="color:black;"';?> 	href="<?php echo base_url().'customer/myaddresses'; ?>" >	My Adresses	</a> </div>
						<div> <a <?php if(isset($is_password_page)) echo 'style="color:red;"';else echo 'style="color:black;"';?> 	href="<?php echo base_url().'customer/mypassword'; ?>" >	My Password	</a> </div>
						<hr>
						-->
						<!--<div> <a <?php if(isset($is_account_page)) 			echo 'style="color:red;"';else echo 'style="color:black;"';?> 	href="<?php echo $secure_base_url.'customer/my_account'; ?>" >	My Account	</a> </div>-->
						<div style=" height:15px;" ></div>
						<div> <a style="font-size: 15px; font-weight: bold; color: black;" 																href="<?php echo $secure_base_url.'customer/my_account'; ?>" ><?php echo $lwords['my_account'] ?>		</a> </div>
						<div> <a <?php if(isset($is_profile_page)) 			echo 'style="color:red;"';else echo 'style="color:black;"';?> 	href="<?php echo $secure_base_url.'customer/my_profile'; ?>" >	<?php echo $lwords['my_profile'] ?>	</a> </div>
						<div> <a <?php if(isset($is_address_book_page)) 	echo 'style="color:red;"';else echo 'style="color:black;"';?> 	href="<?php echo $secure_base_url.'customer/my_address_book'; ?>" >	<?php echo $lwords['my_addresses_book'] ?>	</a> </div>
						
						<div style=" height:15px;" ></div>
						<div style="font-size: 15px; font-weight: bold; color: black;" 	> <?php echo $lwords['order_history'] ?> </div>
						<div> <a <?php if(isset($is_order_page)) 	echo 'style="color:red;"';else echo 'style="color:black;"';?> 	href="<?php echo base_url().'customer/myorders'; ?>" >		<?php echo $lwords['o_status_n_history'] ?>	</a> </div>
						
						<?php if($is_admin == 1) : ?>
							<div style=" height:15px;" ></div>
							<div style="font-size: 15px; font-weight: bold; color: black;" 	> <?php echo $lwords['o_status_n_history'] ?>	 </div>
						
							<div > <a href="<?php echo base_url().'admin/'  ?> "> <img width="100px" src="<?php echo $secure_base_url.'assets/templates/eshopper/images/common/admin.png'; ?> " />	</a> </div>
						<?php endif; ?>
					
					</div>	