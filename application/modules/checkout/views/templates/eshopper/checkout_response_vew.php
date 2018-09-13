<!DOCTYPE html>
<html lang="en">
<head>

<?php  $this->load->helper('url');   ?>
<?php  $CI =& get_instance();  ?>
<?php  $CURRENCY = "$"; ?>
<?php  $this->load->helper('url'); ?>

<?php  
/*echo "<h3>checkout_response_vew->first_character (line 11)</h3>";
echo "<pre>";
var_dump($first_character); 
echo "</pre>";*/

/*echo "<h3>checkout_response_vew->response (line 16)</h3>";
echo "<pre>";
var_dump($response); 
echo "</pre>";*/

/*echo "<h3>checkout_response_vew->order_email_was_sent (line 16)</h3>";
echo "<pre>";
// this is set to TRUE when the confirmation email is sent to the customer after his order was succesfully processed
if(isset($order_email_was_sent))
	var_dump($order_email_was_sent); 
echo "</pre>";*/


?>

</head><!--/head-->


<body>

	<?php if($first_character == "Y") : ?>
		
		<div class="row">
		  <div class="col-sm-12">
		  	<div class="alert alert-success">
	  			<strong>Success!</strong> thank you for shopping at ShopAmerika.com
			</div>
			<img src="https://www.buyaway.net/image/data/Shopping%20Bags/shopping%20bags125.jpg" alt="thank you for shopping with us" />
		  	<a href="<?php echo base_url() ; ?>" class="btn btn-info" role="button"><span class="fa fa-shopping-cart" ></span> continue shopping !</a>
		  </div>
		  		  
		  <!--<div class="col-sm-4">
		  <div style="background-color:pink; " >
		  	Advertisment here 
		  </div>
		  </div>-->
		</div>
		
		
		
		

		
	<?php else: ?>
	<div class="alert alert-danger">
	  <strong>Error!</strong> we could not process your order!.
	</div>
	<?php endif; ?>


</body>
</html>