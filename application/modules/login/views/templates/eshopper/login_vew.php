	
	<?php  $CI =& get_instance();  ?>
	<?php  $CI->load->module("msg");  ?>
	<?php  $CURRENCY = "$"; $RATE = 1; ?>
	<?php 
		if(isset($error_msg)) 
		{
		// this should be put in an error div like a message box
		echo($error_msg) ; 
			
		}
	
	?>
	
	<?php if(empty($CI->session->userdata("user_id"))) : ?>
	
	
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2><?php echo $words["login_to_account"]; ?> </h2>
						
						<?php $baseurl_login_user = base_url()."login/user" ;   ?>
						<form  method= "post" action="<?php echo($baseurl_login_user) ?>" >
							<input name="email" type="email" placeholder='<?php echo $words["email"]; ?>' />
							<input name="password" type="password" placeholder='<?php echo $words["password"]; ?>' />
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">	
							<span>
							    <input type="checkbox" class="checkbox" name="remember_me" value="remember_me" checked >
							    <?php echo $words["remember"] ?><br/>
							</span>
							
							<?php $baseurl_login_forgot_password = base_url()."login/forgot_password";   ?>
							<a href="<?php echo($baseurl_login_forgot_password) ?>" style="color: black"> <?php echo $words["forgot"]; ?> </a>
							
							<button type="submit" class="btn btn-default"><?php echo $words["login"]; ?></button>
						</form>
						
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or"><?php echo $words["or"] ?></h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2><?php echo $words["new_signup"]; ?></h2>
						<?php $baseurl_new_user = base_url()."customer/signup" ;   ?>
						<form  method= "post" action="<?php echo($baseurl_new_user) ?>" >
							<input type="text" name="name" placeholder='<?php echo $words["name"] ?>'/>
							<input type="email" name="email" placeholder='<?php echo $words["email"] ?>'/>
							<input type="password" name="password" placeholder='<?php echo $words["password"] ?>'/>
							
							<?php echo $widget;?>
							<?php echo $script;?><br>
							
							<button type="submit" class="btn btn-default"><?php echo $words["signup"]; ?></button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	
	<?php else : ?>
	<?php 
		//you must log out to log in with another account
		$CI->load->helper('url');
		redirect(base_url()."msg/show/50"); 
	?>
	<?php endif; ?>

     <script>
		//check if the browser is cookie capable / enabled
		//getCookieSupport()
		// Find out what cookies are supported. Returns:
		// null - no cookies
		// false - only session cookies are allowed
		// true - session cookies and persistent cookies are allowed
		// (though the persistent cookies might not actually be persistent, if the user has set
		// them to expire on browser exit)
		//
		function getCookieSupport() 
		{
		    var persist= true;
		    do {
		        var c= 'gCStest='+Math.floor(Math.random()*100000000);
		        document.cookie= persist? c+';expires=Tue, 01-Jan-2030 00:00:00 GMT' : c;
		        if (document.cookie.indexOf(c)!==-1) {
		            document.cookie= c+';expires=Sat, 01-Jan-2000 00:00:00 GMT';
		            return persist;
		        }
		    } while (!(persist= !persist));
		    return null;
		}
		if(getCookieSupport() == true)
		{
			// alert("yes cookies and persistent cookies are allowed")
		}
		if(getCookieSupport() == null)
		{
			//alert("this website uses cookies... for better performancem please enable cookies in your  browser")
		}
		</script>