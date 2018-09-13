
	<?php
	// load the url helper for base_url 
	$this->load->helper('url');
	$template_path= base_url()."assets/templates/adminlte/";
	 ?>  

      

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <img width="50%" src="http://eprocessingnetwork.com/assets/images/ePNlogo.png" />
          <h1>
            eProcessor accounts
            <small>AmerikaShop</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Customers</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
	        e-Processin accounts :
	        <?php
	        /*echo "<pre>";
	        var_dump($accounts_data);
	        echo "</pre>";*/
	         ?>
	        
	        <!------------------------------------------------------------------------------------->
	        <div class="row">
	            <!-- Left col -->
	            <div class="col-md-12">
	              <!-- TABLE: eProccessing Accounts -->
	              	<div class="box box-info">
		                <div class="box-header with-border">
		                  <h3 class="box-title">eProccessing Accounts</h3>
		                  <div class="box-tools pull-right">
		                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		                  </div>
		                </div><!-- /.box-header -->
		                
		                <div class="box-body">
		                  	<div class="table-responsive">
		                    	<table class="table no-margin">
				                    <thead>
					                    <tr>
							                <th>id</th>
						                    <th width="15%">epn_account</th>
						                    <th>restrict key</th>
						                    <th>transaction type</th>
						                    <th>cvv2 type</th>
						                    <th class="pull-right"> Status</th>
					                    </tr>
				                    </thead>
			                        <tbody>
					                    <?php foreach ($accounts_data as $account_data) :?>
					                    <tr>
					                        <td><?php echo $account_data->id;?></td>
					                        <td><?php echo $account_data->epn_account;?> </td>
					                        <td><?php echo $account_data->restrict_key;?></td>
					                        <td><?php echo $account_data->tran_type;?></td>
					                        <td><?php echo $account_data->cvv2type;?></td>
					                        <?php if($account_data->status) : ?>
					                        <td><span class="pull-right label label-success">Active</span></td>
					                        <?php else : ?>
					                        <td><span id="inactive_eproc_btn_<?php echo $account_data->id;?>" class="pull-right label label-danger inactive_eproc_btn">Inactive</span></td>
					                        <?php endif; ?>
				                        </tr>
				                        
				                      	<?php endforeach;?>
				                      
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
		                </div><!-- /.box-body -->
		                
		                <div class="box-footer clearfix">
		                 <!-- <a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>-->
		                </div><!-- /.box-footer -->
	              	</div><!-- /.box -->
	            </div><!-- /.col -->
	        </div><!-- /.row -->
	        <!------------------------------------------------------------------------------------->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      

 