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
 
	<section>
		<div class="container">
			<div class="row">
				
				<div class="col-sm-12">
					<div class="blog-post-area">
						
						<div class="single-blog-post">
							
		
							<img src="<?php echo base_url().'assets/templates/eshopper/images/blog/blog-one.jpg';?>" alt="">
							
							<h2> <?php echo $words['about_us']; ?></h2>
							
							<p>	<?php echo $words['p1']; ?> </p> <br>

							<p>	<?php echo $words['p2']; ?> </p> <br>

							<p>	<?php echo $words['p3']; ?> </p> <br>
							
							<p><?php  echo $words['p4']; ?>	</p>
							<p>
								<?php echo $words['p5']; ?>	</p>
						</div>
						
					</div><!--/blog-post-area-->


					
					
									</div>	
			</div>
		</div>
	</section>

	
	
	