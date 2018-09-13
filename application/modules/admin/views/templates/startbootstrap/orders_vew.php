
	<?php
	$this->load->helper('url');
	$CI =& get_instance();
	$CI->load->library('cleanurl');
	$CURRENCY = "$";
	$RATE = 1;
	//$CI->load->module("orders");
	// load the url helper for base_url 
	$this->load->helper('url');
	$template_path= base_url()."assets/templates/adminlte/";
	//$orders=$CI->orders->get_last_orders(100);
	
	
	 ?>  

      

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
	        <!--<pre>
			<?php print_r($orders);?>
			</pre>-->
        	<!-- Content Header (Page header) -->
	        <section class="content-header">
	          <h1>
	            Orders
	            <!--<small>Version 2.0</small>-->
	          </h1>
	          <ol class="breadcrumb">
	            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	            <li class="active">Dashboard</li>
	          </ol>
	        </section>

        	<!-- Main content -->
        <section class="content">
          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <div class="col-md-12">
              <!-- TABLE:  ORDERS -->
              <div class="box box-info">
	                <!--<div class="box-header with-border">
	                  <h3 class="box-title">Orders</h3>
	                  <div class="box-tools pull-right">
	                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
	                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
	                  </div>
	                </div>
	                -->
	                <!-- /.box-header -->
	                <div class="box-body">
	                  <div class="table-responsive">
	                    <?php echo($pagination);    ?>
	                    <div class="save_alert alert alert-success">
  							<strong>Sending data!</strong> saving actions.
						</div>
	                    <table class="table no-margin">
		                    <thead>
			                    <tr>
					                <th>#</th>
				                    <th id="date_add_hdr"  class="sortable" width="auto">Date <span id="date_add_up" class="sort_arrow glyphicon glyphicon-arrow-up"  aria-hidden="true"></span> <span id="date_add_dn" class="sort_arrow glyphicon glyphicon-arrow-down" aria-hidden="true"></span></th>
				                    <th id="email_hdr" class="sortable"  width="auto" >Email  <span id="email_up" class=" sort_arrow glyphicon glyphicon-arrow-up"  aria-hidden="true"></span> <span id="email_dn" class="sort_arrow glyphicon glyphicon-arrow-down" aria-hidden="true"></span> </th>
				                    <th>Order <br/> taken</th>
				                    <th>Customer<br/> charged</th>
				                    <th>Order <br/>placed</th>
				                    <th>Arrived to <br/> warehouse</th>
				                    <th>Packed</th>
				                    <th>Tracking #</th>
				                    <th>Shipped</th>
				                    <th>Cleared <br/> customs</th>
				                    <th>Arrived to <br/> office</th>
				                    <th>Relabled</th>
				                    <th>Delivered</th>
				                    <th>Action</th>
				                    <!--<th class="pull-right"> Status</th>-->
			                    </tr>
		                    </thead>
	                        <tbody>
	                        	<?php 
								/*
								echo "<pre>";
								var_dump($orders) ;
								echo "</pre>";
								*/
	                        	?>
			                    <?php foreach ($orders as $order) :?>
			                    <tr>
			                        <td><a href="<?php  echo base_url();?>admin/order_details/<?php echo $order->id;?>"> <?php echo $order->id;?> </a> </td>
			                        <td><?php echo $order->date_add;?></td>
			                        <td><?php echo $order->email;?> </td>
			                        <td><input title="Order Taken" 			id="is_taken--<?php echo $order->id;?>" 			  	class="od_chbox"	type="checkbox" <?php echo ($order->is_taken) ? "checked":""; ?> />					</td>
			                        <td><input title="customer charged" 	id="is_customer_charged--<?php echo $order->id;?>" 		class="od_chbox"	type="checkbox" <?php echo ($order->is_customer_charged) ? "checked":""; ?> />		</td>
			                        <td><input title="Order Placed" 		id="is_placed--<?php echo $order->id;?>" 				class="od_chbox"	type="checkbox" <?php echo ($order->is_placed) ? "checked":""; ?> />				</td>
			                        <td><input title="In Warehouse" 		id="is_arrived_to_warehouse--<?php echo $order->id;?>" 	class="od_chbox" 	type="checkbox" <?php echo ($order->is_arrived_to_warehouse) ? "checked":""; ?> />	</td>
			                        <td><input title="Order Packed" 		id="is_packed--<?php echo $order->id;?>" 				class="od_chbox"	type="checkbox" <?php echo ($order->is_packed) ? "checked":""; ?> />				</td>
			                        
			                        <td><input title="Tracking number" 		id="tracking_number--<?php echo $order->id;?>" 			class="od_tracknum"	type="text" value="<?php echo $order->tracking_num; ?>"  placeholder="tracking Number" /> 	<span title="save modification" id="save_btn--<?php echo $order->id;?>" 	 class="save_tracking_number clickable glyphicon glyphicon-floppy-save" aria-hidden="true"></span> 				</td>
			                        
			                        <td><input title="Order Shipped" 		id="is_shipped--<?php echo $order->id;?>" 				class="od_chbox" 	type="checkbox" <?php echo ($order->is_shipped) ? "checked":""; ?> />				</td>
			                        <td><input title="Customs Cleared" 		id="is_customs_cleared--<?php echo $order->id;?>" 		class="od_chbox"	type="checkbox" <?php echo ($order->is_customs_cleared) ? "checked":""; ?> />		</td>
			                        <td><input title="Arrived to Office" 	id="is_arrived_to_office--<?php echo $order->id;?>" 	class="od_chbox" 	type="checkbox" <?php echo ($order->is_arrived_to_office) ? "checked":""; ?> />		</td>
			                        <td><input title="Relabled" 			id="is_relabled--<?php echo $order->id;?>" 				class="od_chbox" 	type="checkbox" <?php echo ($order->is_relabled) ? "checked":""; ?> />				</td>
			                        <td><input title="Order Delivered" 		id="is_delivered--<?php echo $order->id;?>" 			class="od_chbox" 	type="checkbox" <?php echo ($order->is_delivered) ? "checked":""; ?> />				</td>
			                        
			                        <td><span title="Track Order" 			id="trackit--<?php echo $order->id;?>" 					class="trackit" > Track it  </span> 																		</td>
			                        
			                        <!--<td><?php echo round($order->grand_total,2);?><?php echo $order->currency;?>(<?php echo $order->number_of_items;?>)</td>-->
			                        <!--<td><span class="pull-right label label-success">Shipped</span></td>-->
		                        </tr>
		                        
		                      	<?php endforeach; ?>
		                      	
		                      	<!--  <tr>
		                          <td><span class="label label-success">Shipped</span></td>
								  <td><span class="label label-warning">Pending</span></td>
		                          <td><span class="label label-danger">Delivered</span></td>
		                          <td><span class="label label-info">Processing</span></td>
		                        </tr>
		                       	-->
	                        </tbody>
	                    </table>
	                  </div><!-- /.table-responsive -->
	                	<?php echo($pagination);    ?>
	                </div><!-- /.box-body -->
	                
	                <div class="box-footer clearfix">
	                  <!--<a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">Save All </a>-->
	                </div><!-- /.box-footer -->
              </div><!-- /.box -->
              
              <!--another box here  -->
              
            
              
              <!--end boxes-->
            </div><!-- /.col -->

          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->