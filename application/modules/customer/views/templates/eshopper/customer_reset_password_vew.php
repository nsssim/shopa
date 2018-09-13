<?php 
$this->load->helper('url');
$CI =& get_instance();
$CI->load->library('cleanurl');
$CI->load->module('msg');
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
				
					<?php // include("customer_left_vew.php"); ?>
					
				</div>
				<div class="col-sm-9"  >
					<?php if(isset($error_embarassing)) :?>
						<!--Well that's embarassing ...we had a technical problem during emailing your email-->
						<p style="color:green;"> <?php echo $CI->msg->get_translated_message(40); ?> </p>
						<img src="https://pixabay.com/static/uploads/photo/2015/11/06/12/42/mask-1027228_960_720.jpg" />
						
					<?php elseif(isset($email_ok_change_password_link)):?>
						<!--A password verification message was sent, in order to reset your password, please check your email.If you are missing emails from ShopAmerika.com , please check your email account's...-->
						<p style="color:green;"><?php echo $CI->msg->get_translated_message(10); ?> </p>
						<img src="https://pixabay.com/static/uploads/photo/2015/11/03/09/03/at-1019990_960_720.jpg" />
						
					<?php elseif(isset($email_ok_password_reset)):?>
						<!--<p style="color:green;">your password was reset, check your email for the new password. don't forget to login to your account and change it, If you are missing emails from ShopAmerika.com , please check your email account's <strong>Spam</strong> or <strong>Junk</strong> folder to ensure the message was not filtered. If the message was filtered, you may find an option to 'Mark as good' or 'Add sender to white-list.' This will aid in receiving future emails from ShopAmerika.com. ' . </p>-->
						<p style="color:green;"> <?php echo $CI->msg->get_translated_message(100); ?>  </p>
						<img src="https://pixabay.com/static/uploads/photo/2015/10/30/10/40/key-1013662_960_720.jpg" />
					<?php endif?>
					
					<!--<form method="post" action="update_password" >
					<table>
					  
					  <tr>
					    <td><label for="old_pass">Current password</label></td>
					    <td><input type="password" name="old_pass" /><br></td>
					  </tr>
					  
					  <tr>
	 					<td><br></td>
					  </tr>
					  
					  <tr>
					    <td><label for="old_pass">New password</label></td>
					    <td><input type="password" name="new_pass" /><br></td>
					  </tr>
					
					  <tr>
					    <td><label for="old_pass">Confirm password &nbsp;&nbsp;</label></td>
					    <td><input type="password" name="new_pass_cc" /><br><br></td>
					  </tr>  
					  
					  <tr>
					    <td></td>
					    <td><input type="submit" value="update my password" /></td>
					  </tr>
					
					</table>
					
					</form>-->
					
					
				</div>
			</div>
		</div>
	</section>	
<?php endif; ?>
	