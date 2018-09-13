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
	
	<!---------------------------------------------------------------------------------------------------------------------->
	
			<style>  
			/* for the popup div */
		.popup {
		    width:100%;
		    height:100%;
		    display:none;
		    position:fixed;
		    top:0px;
		    left:0px;
		    background:rgba(0,0,0,0.75);
		    z-index: 99;
		}
		 
		/* Inner */
		.popup-inner {
		    max-width:700px;
		    width:90%;
		    padding:40px;
		    position:absolute;
		    top:50%;
		    left:50%;
		    -webkit-transform:translate(-50%, -50%);
		    transform:translate(-50%, -50%);
		    box-shadow:0px 2px 6px rgba(0,0,0,1);
		    border-radius:3px;
		    background:#fff;
		}
		 
		/* Close Button */
		.popup-close {
		    width:30px;
		    height:30px;
		    padding-top:4px;
		    display:inline-block;
		    position:absolute;
		    top:0px;
		    right:0px;
		    transition:ease 0.25s all;
		    -webkit-transform:translate(50%, -50%);
		    transform:translate(50%, -50%);
		    border-radius:1000px;
		    background:rgba(0,0,0,0.8);
		    font-family:Arial, Sans-Serif;
		    font-size:20px;
		    text-align:center;
		    line-height:100%;
		    color:#fff !important;
		}
		 
		.popup-close:hover {
		    -webkit-transform:translate(50%, -50%) rotate(180deg);
		    transform:translate(50%, -50%) rotate(180deg);
		    background:rgba(0,0,0,1);
		    text-decoration:none;
		    color:#ff0000 !important;
		}

		.map-img {
		    width:25%;
		    //height:30px;
		    padding-top:4px;
		    display:inline-block;
		    position:absolute;
		    top:6px;
		    right:6px;
		    
		}

		.required
		{
			color:red;
		}

		.mail-envelope
		{
			background-color: #fdfdea;
			/* background-image: url('http://www.clker.com/cliparts/k/m/j/b/j/n/post-office-stamp-generic-md.png');*/
			background-image: url("<?php echo base_url().'assets/templates/eshopper/images/user_address/envelope.jpg';?>");
			background-position: 98% 5%;
			background-repeat: no-repeat;
			/*background-size: 25% auto;*/
			background-size: 100% 100%;
			/*border: 10px dashed pink;*/
			margin: 5px;
			padding: 40px;
		}
		
		#new_admin_btn
		{
			margin-bottom:5px;
		}
		#update_permissions_btn, #cancel_permissions_btn{
			display: none;
			margin-bottom:5px;
		}
		</style>
	
	<!---------------------------------------------------------------------------------------------------------------------->
	
	
	
	
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
