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
							
							<img src="<?php echo base_url().'assets/templates/eshopper/images/blog/shipping.jpg';?>" alt="">
							<h2><?php echo $words['page_title']; ?></h2>
							
							<h3 id="ship_policy_q1"><?php echo $words['question1']; ?>	</h3>
							<p><?php echo $words['answer1']; ?></p> 
							
							<h3 id="ship_policy_q2"><?php echo $words['question2']; ?></h3>
							<p><?php echo $words['answer2']; ?></p>
							 
							<h3 id="ship_policy_q3"><?php echo $words['question3']; ?></h3>
							<p><?php echo $words['answer3']; ?></p>
							
						</div>
					</div>
				</div>	
			</div>
		</div>
	</section>

	
	
	