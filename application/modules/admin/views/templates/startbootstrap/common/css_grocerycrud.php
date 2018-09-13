 	<?php
	// load the url helper for base_url 
	$this->load->helper('url');
	$template_path= base_url()."assets/templates/adminlte/";
	 ?>  
  
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>ShopAmerika AdminCP</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href='<?php echo($template_path."bootstrap/css/bootstrap.min.css")?>' rel="stylesheet" type="text/css" />
    
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    
    <!-- jvectormap -->
    <link href='<?php echo($template_path."plugins/jvectormap/jquery-jvectormap-1.2.2.css")?>' rel="stylesheet" type="text/css" />
    
    <!-- Theme style -->
    <link href='<?php echo($template_path."dist/css/AdminLTE.min.css")?>' rel="stylesheet" type="text/css" />
    
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href='<?php echo($template_path."dist/css/skins/_all-skins.min.css")?>' rel="stylesheet" type="text/css" />
	
	<!--for grocery crud css-->
	<?php 
	foreach($crud_data->css_files as $file): ?>
		<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
	<?php endforeach; ?>

	
	<style type='text/css'>
		body
		{
			font-family: Arial;
			font-size: 14px;
		}
		a {
		    color: blue;
		    text-decoration: none;
		    font-size: 14px;
		}
		a:hover
		{
			text-decoration: underline;
		}
	</style>
	<!--end for grocery crud css-->
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">
		
	  <?php	$this->load->helper('url'); ?>
		 
      <header class="main-header">

        <!-- Logo -->
        <a href="<?php echo base_url().'admin'; ?> " class="logo">
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