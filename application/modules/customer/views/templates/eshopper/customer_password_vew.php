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
				<div class="col-sm-9"  >
					<p style="color:green;">To change your account password, type in your current password and the new password , confirm it and click on update password</p>
					
					<form method="post" action="update_password" >
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
					
					</form>
					
					
				</div>
			</div>
		</div>
	</section>	
<?php endif; ?>
	