<?php 
 
 	$CI =& get_instance();
 	$this->load->helper('url');
 
?>
	<section id="form">
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
				<?php
			 
				echo($msg_txt."...");
				if(!empty($xtra_data))
				echo($xtra_data);
				
				?>
				</div>
				
				
			</div>
		</div>
	</section>
	