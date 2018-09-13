<?php
	// load the url helper for base_url 
	$this->load->helper('url');
	$template_path= base_url()."assets/templates/adminlte/";
?>  
  

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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
     	<style>
        	.sort_arrow
        	{
				cursor: pointer;
				font-size:10px;
				display: none;	
				color: #939e99;
			}
			.sortable
			{
				cursor: pointer;
			}
			.save_alert
			{
				display: none;	
			}
			.clickable
			{
				cursor: pointer;
			}
			
			.clickable:hover
			{
				color: green;
			}
			.save_tracking_number
			{
				display: none;
			}
			.trackit
			{
				cursor: pointer;
				color: blue;
			}
			.od_tracknum
			{
				font-family: monospace;
    			font-size: 12px;
			}
			
			.category_li
			{
				color:#e91616;
				padding-top: 6px;
				padding-bottom: 6px;
				margin-top: 2px;
				margin-bottom: 2px;
				line-height: 1em;
			}
			
			
			#boxy
			{
				/*background-color: pink;*/
				width: 87%;
			}
			.righty
			{
				float:right;
				height: 0px;
			}
			
			.cat_txt
			{
				width: 100px;
			}
			
			
			
        </style>
        
  </head>

	  	
