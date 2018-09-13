<?php 
$this->load->helper('url');
$CI =& get_instance();
$CI->load->library('cleanurl');


//this block should be on each page that has a price 
$CI->load->module('currency');
$CI->currency->set_currency(); // no parameter ==> usd will be the default
$CURRENCY = $CI->session->userdata("CUR_SIGN");
//$CURRENCY= '$';
$RATE = $CI->session->userdata("CUR_RATE");
//$RATE =1;
// this block should be used when the user changes the currency, here are the currency ids 
// 643	=>	Russian Ruble
// 840  =>	US Dollar
// 949  =>	Turkish Lira
// 978  =>	Euro
// $CI->currency->change_currency(949); // change currency to Turkish Lira can be called via ajax 
// $CURRENCY = $CI->session->userdata("CUR_SIGN");
// $RATE = $CI->session->userdata("CUR_RATE");



/*$meta_description = " ";$meta_keyworks = " ";$meta_title = " "; $viewport = " ";
foreach ($meta_info as  $minfo  )
{
	if (!is_null($minfo->description)) 	$meta_description = $minfo->description;
	if (!is_null($minfo->keywords)) 	$meta_keyworks = $minfo->keywords; 	
	if (!is_null($minfo->title)) 		$meta_title = $minfo->title ;			
	if (!is_null($minfo->viewport)) 	$viewport = $minfo->viewport ;		
}*/

?>


 	<?php //include "css.php";?>
 	<?php //include "header.php";?>
 	<?php //include "slider.php";?>
 
	 <div id="contact-page" class="container">
    	<div class="bg">
	    	<div class="row">    		
	    		<div class="col-sm-12" style="margin-top: 5px;">    			   			
					   			    				    				
					<div class="col-sm-8" style="padding: 0">    			   			
						<div id="gmap" class="contact-map">
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d24184.117641874855!2d-74.00615192685551!3d40.73970194375665!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c259a160e3b6fb%3A0x9a793285a96b3fe8!2s27+E+21st+St%2C+New+York%2C+NY+10010%2C+USA!5e0!3m2!1sen!2str!4v1451065036675" width="610" height="388" frameborder="0" style="border:0" allowfullscreen></iframe>
							<!--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6170.232882788236!2d-74.44533648403184!3d39.353599645029696!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c0ee641dca9f39%3A0x2c5763a1b0922de0!2s2801+Pacific+Ave+%23203%2C+Atlantic+City%2C+NJ+08401%2C+USA!5e0!3m2!1sen!2str!4v1471288599464" width="610" height="388" frameborder="0" style="border:0" allowfullscreen></iframe>-->
						</div>
					</div>
					
					<div class="col-sm-4 pull-right" style="height: 388px; padding:0; ">    			   			
						 
						<img height="388px" width="305px" src="<?php echo base_url().'assets/templates/eshopper/images/contact/customer_service.jpg'; ?>" />
					</div>
					
				</div>			 		
			</div>    
			<?php if (!empty($email_was_sent)) :?>
				<?php if ($email_was_sent == "ok" ) :?>
					<div class="alert alert-success">
					   <?php echo $words["thank_you"];?> 
					   <!--Thank you for contacting us , we will get back to you as soon as possible.-->
					</div>
					
				<?php elseif ($email_was_sent == "math_error" ) :?>
					<div class="alert alert-danger">
					  <strong>wrong result! !</strong> .
					</div>
				<?php endif; ?>
			<?php endif; ?>
			
			<h2 class="title text-center"><?php echo $words["contact_us"];?> <!--Contact Us--></h2> 
    		<div class="row">  	
	    		<div class="col-sm-8">
	    			<div class="contact-form">
	    				<h2 class="title text-center"> <?php echo $words["get_in_ttch"];?> <!--Get In Touch--></h2>
	    				<div class="status alert alert-success" style="display: none"></div>
				    	<form id="main-contact-form" class="contact-form row" name="contact-form" method="post" role="form" data-toggle="validator" action="<?php echo base_url().'about/contact_us'; ?>">
				            <div class="form-group col-md-6">
				                <input type="text" name="name" class="form-control" required="required" placeholder='<?php echo $words["name"];?>' required>
				            </div>
				            <div class="form-group col-md-6">
				                <input type="email" name="email" class="form-control" required="required" placeholder='<?php echo $words["email"];?>' data-error="That email address is invalid"  required>
				            </div>
				            <div class="form-group col-md-12">
				                <input type="text" name="subject" class="form-control" required="required" placeholder='<?php echo $words["subject"];?>' required>
				            </div>
				            <div class="form-group col-md-12">
				                <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder='<?php echo $words["ur_msg"];?>' required></textarea>
				            </div>                        
				            
				            <input type="hidden" value="<?php echo $var1 ?>" name="var1" />
				            
				            <input type="hidden" value="<?php echo $var2 ?>" name="var2" />
				            
				            <div class="form-group col-md-12">
				            	
				            	<!--<div style="line-height: 3em;" class="form-group col-md-1">
				            	</div>-->
				            	
				            	<div class="form-group col-md-5">
					            	<div style="line-height: 3em;"> 
					            	  <?php //echo $var1 ?>  <?php //echo// $var2 ?>    
					            	<img style="display: inline;" width="47px" src="<?php echo base_url().'assets/templates/eshopper/images/contact/n'.$var1.'.jpg'; ?>" /> 
					            	<img style="display: inline;" width="47px" src="<?php echo base_url().'assets/templates/eshopper/images/contact/plus.jpg'; ?>" /> 
					            	<img style="display: inline;" width="47px" src="<?php echo base_url().'assets/templates/eshopper/images/contact/n'.$var2.'.jpg'; ?>" /> 
					            	<img style="display: inline;" width="47px" src="<?php echo base_url().'assets/templates/eshopper/images/contact/equal.jpg'; ?>" /> 
					            	</div> 
					            </div>
					            
				            	<div class="form-group col-md-3">
					                <input type="text" name="var3" class="form-control" required="required" maxlength="2" pattern="^([0-9]{1,2}$)" placeholder="?" data-error="invalid result" required>
					            </div>
					            
					            <div class="form-group col-md-4 ">
					                <!--<input type="submit" name="submit" class="btn btn-primary pull-right" value="Submit">-->
					                <input type="submit" class="btn btn-info btn-lg" value='<?php echo $words["submit"];?>' style="padding-right:62px;padding-left:62px;" >
					            </div>
				            </div>
				            
				            
				        </form>
	    			</div>
	    		</div>
	    		<div class="col-sm-4">
	    			<div class="contact-info">
	    				<h2 class="title text-center"><?php echo $words["contact_info"];?> <!--Contact Info--></h2>
	    				<address>
	    					
	    					



	    					
							<p> <?php echo $words["address_line1"];?> </p>
							<p> <?php echo $words["address_line2"];?> </p>
							<p><?php echo $words["phone"];?></p>
							<p><?php echo $words["email_info"];?></p>
	    				</address>
	    				<div class="social-networks">
	    					<h2 class="title text-center"><?php echo $words["social_net"];?> <!--Social Networking--></h2>
							<ul>
								<li>
									<a href="https://www.facebook.com/shopamerikacom"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href=" https://twitter.com/shopamerika"><i class="fa fa-twitter"></i></a>
								</li>
								<!--<li>
									<a href="#"><i class="fa fa-google-plus"></i></a>
								</li>-->
								<li>
									<a href="https://www.instagram.com/shopamerika"><i class="fa fa-instagram"></i></a>
								</li>
							</ul>
	    				</div>
	    			</div>
    			</div>    			
	    	</div>  
    	</div>	
    </div><!--/#contact-page-->
	
	
	