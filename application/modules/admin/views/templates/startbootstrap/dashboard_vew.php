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
            Dashboard
            <small>general</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
        <?php /*
          <div class="row">
          
            <div class="col-md-4">
              <div class="box box-solid">
                <div class="box-header">
                  <h3 class="box-title text-danger">Sparkline Pie</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body text-center">
                  <div class="sparkline" data-type="pie" data-offset="90" data-width="100px" data-height="100px"><canvas height="100" width="100" style="display: inline-block; width: 100px; height: 100px; vertical-align: top;"></canvas></div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->

            <div class="col-md-4">
              <div class="box box-solid">
                <div class="box-header">
                  <h3 class="box-title text-blue">Sparkline line</h3>
                  <div  class="box-tools pull-right">

                    <button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body text-center">
                  <div class="sparkline" data-type="line" data-spot-radius="3" data-highlight-spot-color="#f39c12" data-highlight-line-color="#222" data-min-spot-color="#f56954" data-max-spot-color="#00a65a" data-spot-color="#39CCCC" data-offset="90" data-width="100%" data-height="100px" data-line-width="2" data-line-color="#39CCCC" data-fill-color="rgba(57, 204, 204, 0.08)"><canvas height="100" width="323" style="display: inline-block; width: 323px; height: 100px; vertical-align: top;"></canvas></div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->

            <div class="col-md-4">
              <div class="box box-solid">
                <div class="box-header">
                  <h3 class="box-title text-warning">Sparkline Bar</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body text-center">
                  <div class="sparkline" data-type="bar" data-width="97%" data-height="100px" data-bar-width="14" data-bar-spacing="7" data-bar-color="#f39c12"><canvas height="100" width="224" style="display: inline-block; width: 224px; height: 100px; vertical-align: top;"></canvas></div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
            
          </div>
          */
          ?>
          
          <div class="row">
          <!--facebook and co-->
          		<div class="col-md-4 col-sm-6 col-xs-12">
	              <div class="info-box">
	                <span class="info-box-icon bg-blue"><i class="fa fa-facebook"></i></span>
	                <div class="info-box-content">
	                  <span class="info-box-text">Likes</span>
	                  <span class="info-box-number"><?php echo number_format($fb_num_of_likes); ?></span>
	                </div><!-- /.info-box-content -->
	              </div><!-- /.info-box -->
	            </div><!-- /.col -->

	            <!-- fix for small devices only -->
	            <div class="clearfix visible-sm-block"></div>

	            <div class="col-md-4 col-sm-6 col-xs-12">
	              <div class="info-box">
	                <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>
	                <div class="info-box-content">
	                  <span class="info-box-text">Orders</span>
	                  <span class="info-box-number"> <?php echo number_format($num_total_orders); ?></span>
	                </div><!-- /.info-box-content -->
	              </div><!-- /.info-box -->
	            </div><!-- /.col -->
	            <div class="col-md-4 col-sm-6 col-xs-12">
	              <div class="info-box">
	                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
	                <div class="info-box-content">
	                  <span class="info-box-text">All CUSTOMERS</span>
	                  <span class="info-box-number"><?php echo number_format($number_of_customers) ?></span>
	                </div><!-- /.info-box-content -->
	              </div><!-- /.info-box -->
	            </div><!-- /.col -->
	        </div><!-- /.row -->
          <!--/facebook and co-->
          	
            
            <div class="col-md-6" style="background-color: white;" >
       			<canvas id="myChart" width="400" height="250"></canvas>
          	</div>
          	
          	<div class="col-md-6" style="background-color: white;" >
       			<canvas id="myChart2" width="400" height="250"></canvas>
          	</div>
          	
          </div>
          
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      

 