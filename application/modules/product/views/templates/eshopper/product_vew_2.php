<?php 
$this->load->helper('url');
$CI =& get_instance();
$CI->load->library('cleanurl');
$CURRENCY = "$";
$RATE = 1;
$CI->load->module("product");

echo "<pre>";
			var_dump($response);
echo "</pre>";

?>
<div class="pagination" >
	<?php echo($pagination); ?>
</div>
