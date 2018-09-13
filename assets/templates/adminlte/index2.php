  <?php include "connection.php";
  
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
//$arr = mysqli_fetch_array($result);


/*while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    echo $row['id']."<br>";
}*/

  ?>
  
 
  
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>ShopAmerika AdminCP</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>shop</b><font color="#ff5555" >amerika</font></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p>Admin</p>

              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> 
              </a>
             
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Orders</span>
                <span class="label label-primary pull-right">4</span>
              </a>
              
            </li>
            <li>
              <a href="#">
                <i class="fa fa-th"></i> <span>Products</span> 
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-group"></i>
                <span>Members</span>
                
              </a>
             
            </li>
            <li class="treeview">
              <a href="Stml">
                <i class="fa fa-laptop"></i>
                <span>logout</span>
                
              </a>
              
            </li>
            
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

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
                      <?php while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))  : ?>
					  

                      <tbody>
	                     <tr>
                          <td><a href="<?php echo 'order_details'.$row['id'];  ?>"> <?php echo $row['id'];  ?> </a></td>
                          <td><?php echo $row['cus_fname']." ".$row['cus_lname'];  ?></td>
                          <td><?php echo $row['cus_fname']." ".$row['cus_lname'];  ?></td>
                          <!--<td><span class="label label-success">Shipped</span></td>-->
                          <td><div class="sparkbar" data-color="#00a65a" data-height="20">340 </div></td>
                          <td>2015-07-18</td>
                        </tr>
                       <?php endwhile ;?>
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

      <footer class="main-footer">
       
        <strong>Copyright &copy; 2015-2016 <a href="http://www.trendit.com.tr">TrendIT</a>.</strong> All rights reserved.
      </footer>

      <!-- Control Sidebar -->
     
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class='control-sidebar-bg'></div>

    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="plugins/chartjs/Chart.min.js" type="text/javascript"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard2.js" type="text/javascript"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js" type="text/javascript"></script>
  </body>
</html>