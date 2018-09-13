<?php
// load the url helper for base_url 
$this->load->helper('url');
$template_path= base_url()."assets/templates/adminlte/";
 ?>  



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo($title_text);  ?>
      </h1>
        
      <ol class="breadcrumb">
        <li><a href='<?php echo base_url()."admin" ?>' "><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php echo $title_text ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
   
   <div>
		<?php echo $crud_data->output; ?>
   </div>
   
   <div style="margin: 5px;">
	<?php if($title_text == "Who What When") : ?>
	
		<a target="_blank" href="<?php echo($link_order_emails_log); ?>" > orders emails log</a>
	<?php endif; ?>
	
   </div>
   
	<?php if($title_text == "Price Rules") : ?>
   		<hr>
   		
   		<div style="display: block;		padding: 9.5px;		margin: 0 0 10px;		font-size: 13px;		line-height: 1.42857143;		color: #333;		word-break: break-all;
		word-wrap: break-word;		background-color: #f5f5f5;		border: 1px solid #ccc;		border-radius: 4px;">
   			<label for="max_price" > Max Price</label>
   			<select id="max_price" name="admin_max_price" >
   				<option id="not" > NO MAX </option>
   				<?php foreach($price_rules as $pr) :?>
	   				<?php $is_selected = (!empty($pr->is_max))?  "selected":"";   ?>
	   				<?php if(!empty($pr->max_price)) : ?>
	   				<option id="<?php echo $pr->id; ?>" <?php echo $is_selected; ?> > <?php echo "$".$pr->max_price; ?> </option>
	   				<?php endif; ?>
   				<?php endforeach;?>
   			</select>
   			
   			<button id="apply_max_price" > APPLY</button>
   			<span id="max_price_msg_ok" style="background: #a3fb8c ; display: none; " > max price updated ! </span>
   			<span id="max_price_msg_error" style="background: pink ; display: none; " > error during update, refresh page and try again !!! </span>
   		</div>
	<?php endif; ?>
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->