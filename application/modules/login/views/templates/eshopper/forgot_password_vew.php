	
	<?php  $CI =& get_instance();  ?>
	<?php  $CI->load->module("msg");  ?>
	<?php  $CURRENCY = "$"; $RATE = 1; ?>
	
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2><?php echo $words["your_email"]; ?></h2>
						
						<form  method= "post" action='<?php echo base_url()."customer/confirm_reset_password" ?>' >
							<input name="email" type="email" placeholder='<?php echo $words["email"]; ?>' />
							
							<button type="submit" class="btn btn-default"><?php echo $words["reset_password"]; ?> </button>
						</form>
						
					</div><!--/login form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	
