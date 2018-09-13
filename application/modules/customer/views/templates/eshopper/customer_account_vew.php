<?php 
$this->load->helper('url');
$CI =& get_instance();
$CI->load->library('cleanurl');
$CURRENCY = "$";
$RATE = 1;

/*echo "<pre>";
var_dump($customer_details);
echo "</pre>";*/

$email= $customer_details[0]->email;
$customer_id= $customer_details[0]->customer_id;
if(!empty($customer_details[0]->first_name)) 		$first_name = $customer_details[0]->first_name; else $first_name = "";
if(!empty($customer_details[0]->last_name))  		$last_name = $customer_details[0]->last_name; else $last_name = "";
if(!empty($customer_details[0]->birthdate))  		$birthdate = $customer_details[0]->birthdate; else $birthdate = "";
if(!empty($customer_details[0]->gender_id_fk)) 		$gender_id = $customer_details[0]->gender_id_fk; else $gender_id = "";
if(!empty($customer_details[0]->language_id_fk)) 	$language_id = $customer_details[0]->language_id_fk; else $language_id = 2;
$is_male_checked ="";
$is_female_checked ="";
if($gender_id == 1) $is_male_checked = "checked";
if($gender_id == 2) $is_female_checked = "checked";

$is_english_selected ="";
$is_turkish_selected ="";
if($language_id == 2) $is_english_selected ="selected";
if($language_id == 1) $is_turkish_selected ="selected";

//if session expired show message
if(isset($log_out_message)) : echo $log_out_message;

//else show page body
else:
?>
	<section>
		<div class="container">
		
		
			<div class="row">
				<div class="col-sm-3">
				
					<?php
					 include("customer_left_vew.php"); ?>
					
				</div>
				<div class="col-sm-6">
				
				
				<!--islam import start-->
				
					<form method="post" enctype="multipart/form-data" id="my_account">
						<fieldset class="col-sm-12">
							<legend>My Account</legend>
							<div class="row">
								<div class="col-sm-12" style="margin-bottom:3px;">
									<div class="col-sm-4">
										<label for="email"><?php echo $words['email']; ?></label>
									</div>
									<div class="col-sm-8">
										<input style="border: 1px solid #ccc;border-radius:4px;-webkit-border-radius:4px;-moz-border-radius:4px;padding-left:5px;height: 30px;" type="email" name="email" value="<?php echo $email; ?>" id="email" class="input-md" placeholder="" data-trigger="change" data-validation-minlength="1" data-type="text" data-required="true" data-error-message="Enter a valid E-mail."/>
									</div>
								</div>
								
								<div class="col-md-12" style="margin-bottom:3px;">
									<div class="col-sm-4">
										<label for="firstname"><?php echo $words['first_name']; ?></label>
									</div>
									<div class="col-sm-8">
										<input style="border: 1px solid #ccc;border-radius:4px;-webkit-border-radius:4px;-moz-border-radius:4px;padding-left:5px;height: 30px;" type="text" name="firstname" value="<?php echo $first_name; ?>" id="firstname" class="input-md" placeholder="" data-trigger="change" data-validation-minlength="1" data-type="text" data-required="true" data-error-message="Enter a valid First Name."/>
									</div>
								</div>
								
								<div class="col-md-12" style="margin-bottom:3px;">
									<div class="col-sm-4">
										<label for="lastname"><?php echo $words['last_name']; ?></label>
									</div>
									<div class="col-sm-8">
										<input style="border: 1px solid #ccc;border-radius:4px;-webkit-border-radius:4px;-moz-border-radius:4px;padding-left:5px;height: 30px;" type="text" name="lastname" value="<?php echo $last_name; ?>" id="lastname" class="input-md" placeholder="" data-trigger="change" data-validation-minlength="1" data-type="text" data-required="true" data-error-message="Enter a valid Last Name."/>
									</div>
								</div>
								
								<!--<div class="col-md-12" style="margin-bottom:3px;">
									<div class="col-sm-4">
										<label for="birthdate">Birth Date</label>
									</div>
									<div class="col-sm-8">
										<input style="border: 1px solid #ccc;border-radius:4px;-webkit-border-radius:4px;-moz-border-radius:4px;padding-left:5px;height: 30px;" type="date" name="birthdate" value="<?php echo $birthdate; ?>" id="birthdate" class="input-md" placeholder="" data-trigger="change" data-validation-minlength="1" data-type="text" data-required="true" data-error-message="Enter a valid Birth Date."/>
									</div>
								</div>-->
								
								<div class="col-md-12" style="margin-bottom:3px;">
									<div class="col-sm-4">
										<label>Gender</label>
									</div>
									<div class="col-sm-8">
										<div class="col-sm-4" style="padding-left:0px;padding-right:0px;">
											<input type="radio" name="gender" value="2" id="female" class="input-md" placeholder="" data-trigger="change" data-validation-minlength="1" data-type="text" data-required="true" <?php echo $is_female_checked; ?> />
											<label for="female"> Female</label>
										</div>
										<div class="col-sm-5" style="padding-right:0px;">
											<input type="radio" name="gender" value="1" id="male" class="input-md" placeholder="" data-trigger="change" data-validation-minlength="1" data-type="text" data-required="true" <?php echo $is_male_checked; ?> />
											<label for="male"> Male</label>
										</div>
										<div class="col-sm-3">
										</div>
									</div>
								</div>
								
								<div class="col-md-12" style="margin-bottom:3px;">
									<div class="col-sm-4">
										<label for="language">Language</label>
									</div>
									<div class="col-sm-5" style="padding-right:0px;">
										<select style="border: 1px solid #ccc;border-radius:4px;-webkit-border-radius:4px;-moz-border-radius:4px;padding-left:5px;height: 30px;" name="lang_id" value="" id="language" class="select-md" placeholder="" data-trigger="change" data-required="true" data-error-message="Enter a valid Birth Date.">
											<option value="2"  <?php echo $is_english_selected; ?>  >English</option>
											<option value="1"  <?php echo $is_turkish_selected; ?>  >Turkish</option>
										</select>
									</div>
									<div class="col-sm-3">
									</div>
								</div>
								<input type="hidden" name="id" value="<?php echo $customer_id; ?>" />
								<div class="col-sm-8 col-sm-offset-4" style="padding-left:20px;">
									<button id="update_btn" class="btn btn-success" type="button" value="update">update</button>
									<span  id="saving_box" class="alert alert-success" style="padding: 3px; display: none;" role="alert">Saving ... </span>
								</div>
							</div>
						</fieldset>
					</form>
					
					
					
				<!--islam import start-->
				
				</div>
				
				<div class="col-sm-3">
				</div>
			</div>
		
		</div>
		
	</section>	
<?php endif; ?>
<!--<script>
	webshims.setOptions('forms-ext', {types: 'date'});
	webshims.polyfill('forms forms-ext');
	$.webshims.formcfg = {
	en: {
		dFormat: '-',
		dateSigns: '-',
		patterns: {
			d: "yy-mm-dd"
			}
		}
	};
</script>-->

	