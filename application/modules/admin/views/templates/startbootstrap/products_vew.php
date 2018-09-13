  <?php
/*  
include "connection.php";
  
 $sql = "SELECT
customers.id,
customers.email,
customers.first_name AS cus_fname,
customers.last_name AS cus_lname,
customers.phone,
cart_product.quantity,
product_lang.`name`,
products.price,
products.id As prod_id
FROM
orders
INNER JOIN carts ON orders.cart_id_fk = carts.id_cart
INNER JOIN cart_product ON cart_product.id_cart = carts.id_cart
INNER JOIN products ON cart_product.id_product = products.id
INNER JOIN customers ON orders.customer_id_fk = customers.id AND carts.id_customer = customers.id
INNER JOIN product_lang ON product_lang.id_product = products.id
GROUP BY
orders.id";
$result = mysqli_query($con,$sql);

*/

//$arr = mysqli_fetch_array($result);


/*while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    echo $row['id']."<br>";
}*/

  ?>

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
            <small>Version 2.0</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Info boxes -->
          <div class="row">
            
            <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-blue"><i class="fa fa-facebook"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Likes</span>
                  <span class="info-box-number">41,410</span>
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
                  <span class="info-box-number">760</span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">New Members</span>
                  <span class="info-box-number">2,000</span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

         
          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <div class="col-md-12">
              <!-- MAP & BOX PANE -->
                           <div class="row">
               
               
              </div><!-- /.row -->

              <!-- TABLE: LATEST ORDERS -->
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Latest Orders</h3>
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
                          <th>Order ID</th>
                          <th>Customer</th>
                          <th>email</th>
                          <th>Total Price</th>
                          <th>Date</th>
                        </tr>
                      </thead>
                      <?php //while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))  : ?>
					  

                      <tbody>
	                     <tr>
                          <td><a href="order details "> order id </a></td>
                          <td>customer name </td>
                          <td>customer  f name </td>
                          <!--<td><span class="label label-success">Shipped</span></td>-->
                          <td><div class="sparkbar" data-color="#00a65a" data-height="20">340 </div></td>
                          <td>2015-07-18</td>
                        </tr>
                       <?php //endwhile ;?>
                       <!--
                        <tr>
                          <td><a href="#">OR9842</a></td>
                          <td>2</td>
                          <td><span class="label label-success">Shipped</span></td>
                          <td><div class="sparkbar" data-color="#00a65a" data-height="20">26.6</div></td>
                          <td>2015-07-20</td>
                        </tr>
                        <tr>
                          <td><a href="pages/examples/invoice.html">OR1848</a></td>
                          <td>5</td>
                          <td><span class="label label-warning">Pending</span></td>
                          <td><div class="sparkbar" data-color="#f39c12" data-height="20">340</div></td>
                           <td>2015-07-20</td>
                        </tr>
                        <tr>
                          <td><a href="pages/examples/invoice.html">OR7429</a></td>
                          <td>1</td>
                          <td><span class="label label-danger">Delivered</span></td>
                          <td><div class="sparkbar" data-color="#f56954" data-height="20">12</div></td>
                           <td>2015-06-29</td>
                        </tr>
                        <tr>
                          <td><a href="pages/examples/invoice.html">OR7429</a></td>
                          <td>12</td>
                          <td><span class="label label-info">Processing</span></td>
                          <td><div class="sparkbar" data-color="#00c0ef" data-height="20">1024</div></td>
                           <td>2015-05-30</td>
                        </tr>
                        <tr>
                          <td><a href="pages/examples/invoice.html">OR1848</a></td>
                          <td>9</td>
                          <td><span class="label label-warning">Pending</span></td>
                          <td><div class="sparkbar" data-color="#f39c12" data-height="20">788</div></td>
                           <td>2015-07-21</td>
                        </tr>
                        <tr>
                          <td><a href="pages/examples/invoice.html">OR7429</a></td>
                          <td>17</td>
                          <td><span class="label label-danger">Delivered</span></td>
                          <td><div class="sparkbar" data-color="#f56954" data-height="20">2801</div></td>
                           <td>2015-07-21</td>
                        </tr>
                        <tr>
                          <td><a href="pages/examples/invoice.html">OR9842</a></td>
                          <td>5</td>
                          <td><span class="label label-success">Shipped</span></td>
                          <td><div class="sparkbar" data-color="#00a65a" data-height="20">378</div></td>
                           <td>2015-07-21</td>
                        </tr>-->
                      </tbody>
                    </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  <a href="javascript::;" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
                  <a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
            </div><!-- /.col -->

            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      

 