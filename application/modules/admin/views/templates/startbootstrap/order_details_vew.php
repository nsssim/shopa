
<?php //
	$this->load->helper('url');
	$CI =& get_instance();
	$CI->load->library('cleanurl');
	//$CI->load->library('firebug');  echo('Firebug woking behind the scene........ok <br>');
	//$CI->firebug->info($order_details,"order_details");
	//$CI->firebug->info($cart_content,"cart_content");
	
	$CURRENCY = "$";
	$RATE = 1;
	//$CI->load->module("orders");
	// load the url helper for base_url 
	$this->load->helper('url');
	$template_path= base_url()."assets/templates/adminlte/";
	//$order_details=$CI->orders->get_order_details($order_id);
	 ?>

   

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            ORDER DETAILS
            <!--<small>Version 2.0</small>-->
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Orders</li>
            <li class="active">Orders details</li>
          </ol>
          
        <?php 
       /* echo "<h2>order_details_vew line 34";
        echo "<pre>";
		var_dump($order_details) ;
		echo "</pre>";*/
		
		
		
		$oo = 55 ; 
        ?>
        </section>

        <!-- Main content -->
        <!--<section class="content">
		<!--<pre><?php // print_r(	$order_details);?></pre>
        </section><!-- /.content --> 
        <section class="invoice">
          <!-- title row -->
          <div class="row">
            <div class="col-xs-12">
              <h2 class="page-header">
                <i class="fa fa-globe"></i> Shop Amerika
                <small class="pull-right">Date: <?php  echo($order_details->date_add);?></small>
              </h2>
            </div><!-- /.col -->
          </div>
          <!-- info row -->
          <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
              <address>
                Shop Amerika <br>
    			27 East 21st Street, Ninth Floor<br>
				New York, New York 10010 <br>
				Phone: 800-445-0380 <br>
				Email: info@shopamerika.com<br>
              </address>
            </div><!-- /.col -->
            <div class="col-sm-4 invoice-col">
              <address>
                <?php  echo($order_details->first_name);?> <?php  echo($order_details->last_name);?> <br>
               <!-- Country:<?php  echo($order_details->coutry);?><br>-->
               <!-- City:<?php  echo($order_details->city);?><br>-->
                		<?php  echo($order_details->line_1);?> ,
                		<?php  echo($order_details->line_2);?> <br/>
                		<!--<?php  echo($order_details->line_3);?> ,-->
                		<?php  echo($order_details->country_province);?> ,
                		<?php  echo($order_details->city);?> ,
                		<?php  echo($order_details->coutry);?> ,
                		<?php  echo($order_details->zip_code);?><br>
                		
                Phone:  <?php  echo($order_details->phone);?><br/>
                Mobile:  <?php echo($order_details->alt_phone);?><br/>
                Email:  <?php  echo($order_details->email);?><br/>
              </address>
            </div><!-- /.col -->
            <div class="col-sm-4 invoice-col">
              <b>Order ID:</b> <?php  echo($order_details->id);?><br/>
              <b>Order Date &amp; Time</b> <?php  echo($order_details->date_add);?><br/>
              <b>Customer ID:</b> <?php  echo($order_details->customer_id);?>
            </div><!-- /.col -->
          </div><!-- /.row -->

          <!-- Table row -->
          <div class="row">
            <div class="col-xs-12 table-responsive">
	               <?php //	$cart_resurected = json_decode($order_details->cart_content); ?>
	              <?php
              		/*echo "<pre>";
		              	print_r($cart_resurected);
              		echo "</pre>";*/
	              ?>
	              
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Qty</th>
                    <th>Product Name</th>
                    <th>Web Id</th>
                    <th>Size/Color</th>
                    <th>CatID</th>
                    <th>Shipping Factor</th>
                    <th>Promo Code</th>
                    <th>Service Fee ?</th>
                    <th>Discount $</th>
                    <th>Discount %</th>
                    <th>Price</th> 
                    <th>Promo Price</th>
                  </tr>
                </thead>
                <tbody>
                  <?php  foreach ($cart_content as $items) :?>
                  <tr>
	                 
                    <td><?php  echo ($items->qty); 			?> </td>
                    <td><?php  echo ($items->name);			?> </td>
                    <td><a href="<?php echo base_url().'product/product-item-'.$items->id.'.html' ?>" > <?php  echo ($items->id); ?>  </a></td>
	                <?php $size_name = $color_name = "NULL"; if(!empty($items->size_name)) $size_name = $items->size_name; if(!empty($items->color_name)) $color_name = $items->color_name; ?>
                    <td><?php  echo ($size_name.'/'.$color_name);?></td>
                    <td><?php  echo ($items->cat_id);		?> </td>
                    <td><?php  echo ($items->cat_shipping_factor);		?> </td>
                    <td><?php  echo ($items->promo_code);		?> </td>
                    <td><?php  echo ($items->has_service_fee);		?> </td>
                    <td><?php  echo ($items->discount_money);		?> </td>
                    <td><?php  echo ($items->discount_percentage);		?> </td>
                    <td> <?php  echo($order_details->sign);?> <?php echo(number_format($items->price, 2, '.', ','));?>  </td>
                    <td> <?php  echo($order_details->sign);?> <?php echo(number_format($items->subtotal_promo, 2, '.', ','));?>  </td>
                  </tr>
                   <?php  endforeach;?>
                </tbody>
              </table>
            </div><!-- /.col -->
          </div><!-- /.row -->

          <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6">
             <!-- <p class="lead">Payment Methods:</p>
              <img src="../../dist/img/credit/visa.png" alt="Visa"/>
              <img src="../../dist/img/credit/mastercard.png" alt="Mastercard"/>
              <img src="../../dist/img/credit/american-express.png" alt="American Express"/>
              <img src="../../dist/img/credit/paypal2.png" alt="Paypal"/>
              <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
              </p>-->
            </div><!-- /.col -->
            <div class="col-xs-6">
              <!--<p class="lead">Amount Due 2/22/2014</p>-->
              <div class="table-responsive">
                <table class="table">
                
                  <tr>
                    <th style="width:50%">Order Subtotal:</th>
                    <td><?php  echo($order_details->sign);?> <?php echo(number_format($order_details->order_sub_total, 2, '.', ','));?>  </td>
                  </tr>
                  
                  <tr>
                    <th>Total Tax</th>
                    <td><?php  echo($order_details->sign);?> <?php echo(number_format($order_details->total_tax, 2, '.', ','));?> </td>
                  </tr>
                  
                  <tr>
                    <th>shipping factor $ value:</th>
                    <td> <?php echo(number_format($order_details->shipping_factor_money_value, 2, '.', ','));?> </td>
                  </tr>
                  
                  <tr>
                    <th>Start Up Shipping Value :</th>
                    <td><?php  echo($order_details->sign);?>  <?php echo(number_format($order_details->start_up_shipping_value, 2, '.', ','));?> </td>
                  </tr>
                  
                  <tr>
                    <th>Total Shipping Fee :</th>
                    <td><?php  echo($order_details->sign);?> <?php echo(number_format($order_details->shipping_fee_total, 2, '.', ','));?> </td>
                  </tr>
                  
                  <tr>
                    <th>Total Credit Card Fee</th>
                    <td><?php  echo($order_details->sign);?> <?php echo(number_format($order_details->total_credit_card_fee, 2, '.', ','));?> </td>
                  </tr>
                  
                  <tr>
                    <th>Service Fee</th>
                    <td><?php  echo($order_details->sign);?> <?php echo(number_format($order_details->service_fee, 2, '.', ','));?> </td>
                  </tr>
                  
                  <tr>
                    <th>Total Custom Fee</th>
                    <td><?php  echo($order_details->sign);?> <?php echo(number_format($order_details->total_custom_fee, 2, '.', ','));?> </td>
                  </tr>
                  
                  <tr>
                    <th>Grand Total:</th>
                    <td><?php  echo($order_details->sign);?> <?php echo(number_format($order_details->grand_total, 2, '.', ','));?> </td>
                  </tr>
                  
                </table>
              </div>
            </div><!-- /.col -->
          </div><!-- /.row -->

          <!-- this row will not appear when printing -->
          <div class="row no-print">
            <div class="col-xs-12">
              <!--<a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>-->
              <a href="<?php echo $print_for_admin_link ?>"    target="_blank" class="btn btn-default pull-right"><i class="fa fa-print"></i> Generate PDF for Admin</a>
              <span class=" pull-right">  &nbsp;&nbsp; </span>
              <a href="<?php echo $print_for_customer_link ?>" target="_blank" class="btn btn-default pull-right"><i class="fa fa-print"></i> Generate PDF for Customer</a>
              <!--<button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>-->
              <!--<button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</button>-->
            </div>
          </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      

 