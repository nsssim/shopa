
<!DOCTYPE html>
<html lang="en">
<head>

<?php

$this->load->helper('url');
$CI =& get_instance();


$meta_description = " ";$meta_keyworks = " ";$meta_title = " "; $viewport = " ";

if(!empty($meta_info))
{
	foreach ($meta_info as  $minfo  )
	{
		if (!empty($minfo->description)) 	$meta_description = $minfo->description;
		if (!empty($minfo->keywords)) 	$meta_keyworks = $minfo->keywords;
		if (!empty($minfo->title)) 		$meta_title = $minfo->title ;			
		if (!empty($minfo->viewport)) 	$viewport = $minfo->viewport ;		
	}
}
else
{
	$meta_description = "";
    $meta_title = "" ;			
 	$viewport = "" ;		
    $meta_keyworks = "";
}
?> 

<!--____________________________________/ meta \____________________________________ -->
    <meta charset="utf-8">
   <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0" >-->
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <meta name='viewport' content='width=1190'>
    <meta name="description " content="<?php echo($meta_description) ?> " >
	<meta name="keywords" content="<?php echo($meta_keyworks) ?>" >
    <meta name="author" content="TrendIT - Home baked" >
    
<!--____________________________________/ favicon \____________________________________ -->
<link rel='shortcut icon' type='image/ico' href= "<?php echo base_url().'assets/templates/eshopper/images/home/favicon.ico';?>"  >

<!--____________________________________/ title \____________________________________ -->
    <title> <?php echo($meta_title) ?> </title>
    
<!--____________________________________/ css \____________________________________-->

	<link href="<?php echo base_url().'assets/'.$template_info['path'].'/css/bootstrap.min.css';?>" rel="stylesheet">	
    <link href="<?php echo base_url().'assets/templates/eshopper/css/font-awesome.min.css';?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/templates/eshopper/css/prettyPhoto.css';?>"  rel="stylesheet">
    <link href="<?php echo base_url().'assets/templates/eshopper/css/price-range.css';?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/templates/eshopper/css/animate.css';?>" rel="stylesheet">
	<link href="<?php echo base_url().'assets/templates/eshopper/css/main.css';?>" rel="stylesheet">
	<link href="<?php echo base_url().'assets/templates/eshopper/css/responsive.css';?>" rel="stylesheet">
	<!--for autocomplete-->
	<link href="<?php echo base_url().'assets/templates/eshopper/css/jquery-ui.css';?>" rel="stylesheet">
	
	<!--islam single_vew-->
	<!--<link href="<?php echo base_url().'assets/zoom/css/cloudzoom.css';?>"  rel="stylesheet">
	<link href="<?php echo base_url().'assets/zoom/css/thumbelina.css';?>" rel="stylesheet">-->
	
	<!--magic zoom-->
	<link href="<?php echo base_url().'assets/templates/eshopper/magiczoomplus/magiczoomplus.css';?>" rel="stylesheet">
	
	<!--thumbnail slider-->
	<link href="<?php echo base_url().'assets/templates/eshopper/thumbnailslider/1/thumbnail-slider.css';?>" rel="stylesheet">
	<link href="<?php echo base_url().'assets/templates/eshopper/thumbnailslider/1/thumbs2.css';?>" rel="stylesheet">
	
	<!--opentip tooltip-->
	<link href="<?php echo base_url().'assets/templates/eshopper/opentip/opentip.css';?>" rel="stylesheet">
	
	<!--hint.css-->
	<link href="<?php echo base_url().'assets/templates/eshopper/css/hint.min.css';?>" rel="stylesheet">

<!--____________________________________/ responsive \____________________________________-->

    <!--[if lt IE 9]>
    <script src= "<?php echo base_url().'assets/templates/eshopper/css/js/html5shiv.js';?>"   ></script>
    <script src= "<?php echo base_url().'assets/templates/eshopper/css/js/respond.min.js';?>" ></script>
    <![endif]-->   
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url().'assets/templates/eshopper/images/ico/apple-touch-icon-144-precomposed.png';?>"  >
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url().'assets/templates/eshopper/images/ico/apple-touch-icon-114-precomposed.png';?>"  >
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url().'assets/templates/eshopper/images/ico/apple-touch-icon-72-precomposed.png';?>" 	  >
    <link rel="apple-touch-icon-precomposed" href="<?php echo base_url().'assets/templates/eshopper/images/home/gallery3.jpg';?>" >
    
</head>

<body>
	
	<!--for autocomplete-->
	<link href="<?php echo base_url().'assets/templates/eshopper/css/jquery-ui.css';?>" rel="stylesheet">
	
<!--____________________________________/ responsive \____________________________________-->

    <!--[if lt IE 9]>
    <script src= "<?php echo base_url().'assets/templates/eshopper/css/js/html5shiv.js';?>"   ></script>
    <script src= "<?php echo base_url().'assets/templates/eshopper/css/js/respond.min.js';?>" ></script>
    <![endif]-->   
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url().'assets/templates/eshopper/images/ico/apple-touch-icon-144-precomposed.png';?>"  >
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url().'assets/templates/eshopper/images/ico/apple-touch-icon-114-precomposed.png';?>"  >
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url().'assets/templates/eshopper/images/ico/apple-touch-icon-72-precomposed.png';?>" 	  >
    <link rel="apple-touch-icon-precomposed" href="<?php echo base_url().'assets/templates/eshopper/images/home/gallery3.jpg';?>" >

<style>
    
 
	#brands_box 
	{
    -webkit-column-count: 10; /* Chrome, Safari*/
    -moz-column-count: 10; /* Firefox */
    column-count: 10; /* ie10+ and opera*/
	}

@media (max-width: 1280px) 
{
	#brands_box 
	{
    -webkit-column-count: 7; /* Chrome, Safari*/
    -moz-column-count: 5; /* Firefox */
    column-count: 7; /* ie10+ and opera*/
	}
	
}

@media (max-width: 1024px) 
{
	#brands_box 
	{
    -webkit-column-count: 7; /* Chrome, Safari*/
    -moz-column-count: 5; /* Firefox */
    column-count: 7; /* ie10+ and opera*/
	}
	
}

@media (max-width: 640px) 
{
	#brands_box 
	{
    -webkit-column-count: 2; /* Chrome, Safari*/
    -moz-column-count: 2; /* Firefox */
    column-count: 2; /* ie10+ and opera*/
	}
}

@media (max-width: 767px) 
{
	#search
	{
		width: 80%;
		background-color: pink;
	}
}


@media (max-width: 300px) 
{
	#brands_box 
	{
    -webkit-column-count: 1; /* Chrome, Safari*/
    -moz-column-count: 1; /* Firefox */
    column-count: 1; /* ie10+ and opera*/
	}
	
}

#loading {
position: absolute;
width: 100%;
}


#loading img{
 
  position: relative;
  left: 50%;
  margin-left:-107px;
}

.product_title{
	height: 45px;
}


.letter_btn
{
	background-color: #fbfbfb;
    border-radius: 15px;
    cursor: pointer;
    font-size: 10px;
    line-height: 1.5;
    padding: 5px 7px;
	
}

.letter_btn:hover 
{
	color:white;
	background-color: black;
}

.letter_index{
	clear: both;
	background-color: black;
    color: white;
    line-height: 40px;
    margin-bottom: 5px;
    margin-top: 5px;
    text-align: center;
    vertical-align: middle;
	line-height: 40px;       /* the same as your div height */
}

/*islam*/


.shop-nav-tabs ul li a{
text-decoration: none;
    text-transform: uppercase;
}

.shop-nav li a {
    position: relative;
    display: block;
    padding: 5px 10px;
    width: 200px;
}

.shop-nav-tabs>li.active>a,
.shop-nav-tabs>li.active>a:hover,
.shop-nav-tabs>li.active>a:focus {
    color: #555;
    cursor: default;
    background-color: #fff;
    border: 1px solid #ddd;
	/*box-shadow: 6px 6px 0 #F0F0F0;*/
	box-shadow: 8px 0 16px #f0f0f0;
    border-bottom-color: transparent;
	z-index: 1;
}

.shop-nav-tabs ul li {
    list-style: none outside none;
    display: block;
    float: left;
    cursor: pointer;
    padding: 6px;
    text-align: center;
    border-bottom: 1px solid #ccc;
}

.tab-content {
    border-left: 1px solid #ccc;
    border-right: 1px solid #ccc;
    border-bottom: 1px solid #ccc;
    box-shadow: 6px 6px 0 #F0F0F0;
}

.shop-nav-tabs ul li{
}

.shop-nav-tabs li a {
    border-radius:0;
	text-align:center;
	font-family:Avenir, Helvetica, Arial, sans-serif;
	font-size:13px;
}


.shop-nav>li>a,
.shop-nav>li>a {
    text-decoration: none;
    background-color: #fff;
    border:none;
	color:#555;
}

.shop-nav>li>a:hover,
.shop-nav>li>a:focus {
    text-decoration: none;
    background-color: #fff;
    border:none;
	color:#D90EAC;
}

#pdp_tabs_body_left {
    float: left;
    width: 360px;
    margin: 25px 0;
    padding: 10px 48px 10px 24px;
    line-height: 1.5;
}

.pdp_longDescription {
	display:block;
    padding-bottom: 14px;
    color: #333;
	font-size: 12px;
}

.clear {
    display: block;
    clear: both;
}

#details #pdp_tabs_body_left ul {
    padding-left: 40px;
	list-style-type:disc;
}

#details #pdp_tabs_body_left ul li{
	list-style:disc;
	font-size:12px;
}

.single_image_container
{
	width: 316px;
	height: 446px;
	/*float: left;*/
	

	display: table-cell;
	vertical-align:bottom;
	text-align:center;
	
	
	
	/*background-color: yellow;*/

}

.single_image
{
	width: 315px;
	max-height: 446px;
	bottom: 0;
}

.thmbnail_selector
{
	width: 48px;
}


/* ------------------  login css -------------------------- */

.input-error-span{
	font-size: 12px;
	font-family: Nunito,Helvetica,Verdana,sans-serif;
}

.error-span-container
{
	color: red;
	margin: 5px 0 5px 0;
	display: none;
}

.selct-menu
{
	height: 3.5em;
	width: 100%; 
	border: 1px solid #9DA8B3; 
	padding: 5px; 
	background-color: #ffffff;
}




.input-txt{
	line-height: 2em;
	width: 100%; 
	border: 1px solid #9DA8B3; 
	padding: 10px;
}
.select-big{
	
}


.yay:checked{
	background-color: grey;
	line-height: 3em;
}

/* ------------------ end login css -------------------------- */


/* --------------------------start new-account css -------------------------*/
.na-label
{
	font-weight: normal;
}

.na-input {
	line-height: 2em;
	width: 100%;
	border: 1px solid #9DA8B3;
	padding: 10px;
}





  
/* end .roundedOne */


/* --------------------------finish new-account css -------------------------*/


/* --------------------------start cart css -------------------------*/
.your-bag{
	font-size:18px;
	font-weight:bold;
	color:#000;
	padding: 10px 9px 0 0;
	float: left;
}

.bag-id{
	padding: 14px 26px 0;
	float: left;
}

.chat{
	padding: 14px 0 0;
	float: right;
}

.choose-store{
	margin-top: 15px;
	border: 1px solid #ccc;
    text-align: center;
    width: 100%;
	height:auto;
    padding: 23px 0 5px 0;
}

.choose-store p{
	display: inline-block;
}


.choose-store .color{
	padding-right: 7px;
	font-weight: bold;
	font-size: 14px;
	color: #d90eac;
}

.choose-store a{
	text-decoration:underline;
	font-size:14px;
	color:#000;
}

.choose-store a:hover{
	color:#d90eac;
}

.choose-store p span.left{
	float:left;
	padding-top: 4px;
}

.choose-store .btn{
	border-color: #000;
	background: #000;
	color:#fff;
	font-size: 12px;
	float:left;
	text-transform:uppercase;
	text-decoration:none;
	border-radius:0;
}

.choose-store .btn:hover{
	color:#fff;
}

.shop-table .table-bordered {
    border: none;
}

.shop-table {
    margin-top: 10px;
}

.shop-table table > thead > tr > th{
	text-transform:uppercase;
}

.shop-table table{
	font-size: 12px;
}

.shop-table .table-bordered > thead > tr {
    background-color:#666;
}

.shop-table .table-bordered > tbody > tr {
	border-top:1px dotted #666;
}

.shop-table .table-bordered > tbody {
	background-color:#F3F3F3;
}

.shop-table .table-bordered > thead > tr > th {
    color:#fff;
}

.shop-table .table-bordered > thead > tr > th:first-child {
    width:240px;
}

.shop-table .table-bordered > thead > tr > th:nth-child(2) {
    width:200px;
}

.shop-table .table-bordered > thead > tr > th:last-child, .shop-table .table-bordered > thead > tr > th:nth-child(3) {
    width:100px;
}

.shop-table .table-bordered > thead > tr > th:nth-child(4) {
    width:120px;
}

.shop-table .table-bordered > thead > tr > th, .shop-table .table-bordered > thead > tr > td {
    border-bottom-width: 0;
}

.shop-table .table-bordered > thead > tr > th, .shop-table .table-bordered > tbody > tr > th, .shop-table .table-bordered > tfoot > tr > th, .shop-table .table-bordered > thead > tr > td, .shop-table .table-bordered > tbody > tr > td, .shop-table .table-bordered > tfoot > tr > td {
    border: none;
}

.shop-table .cart_product, .shop-table .cart_description {
    width: 50%;
    float: left;
}

.shop-table .cart_description h6{
    margin-top:0;
}

.shop-table .cart_description h6 a{
    color:#000;
    text-decoration:underline;
	font-weight:600;
}

.shop-table .cart_description h6 a:hover, .shop-table .cart_description h6 a:focus {
    /*color: #D90EAC;*/
    color: red;
}

.shop-table .cart_description .scaprt {
    color: #000;
}

.shop-table .cart_quantity .cart_quantity_input {
    background: #fff;
	height: 42px !important;
	padding: 6px 12px 6px 0;
	width:60px;
}

.shop-table .cart_quantity p {
	float: left;
	margin-top: 20px;
	font-size: 14px;
	text-decoration: underline;
	color: #000;
}

.cart-note{
	padding-top:20px;
	margin-bottom:30px;
}

.shop-details{
	display:block;
	width:100%;
	height:auto;
	background:#EFEFEE;
	padding: 0 0 14px;
}

.shop-details .btn.btn-primary {
    background: #000;
    margin-top: 25px;
}

.shop-details .input-lg {
    border-radius: 0;
}

.shop-details .cart-subtotal {
	background:#666;
	margin-top:10px;
	margin-left:0px;
	margin-right:0px;
}

.shop-details .cart-subtotal p {
    padding: 7px 15px;
	color:#fff;
}

.shop-details .cart-subtotal p span {
    float:right;
}

.button-checkout .btn.btn-primary, .button-shopping .btn.btn-primary {
	width:100%;
	margin-top:10px;
	padding-top:10px;
	padding-bottom:10px;
}

.button-shopping .btn.btn-primary {
	background:#fff;
	color:#000;
	border:1px solid #000;
}

.button-checkout .btn.btn-primary {
	background:#000;
	color:#fff;
}

.shop-sidebar{
	width:100%;
	height:auto;
}

.shop-sidebar h5{
	color: #333;
	font-size: 11px;
	margin: 10px 0 20px;
	padding: 0 19px;
	text-align: center;
	text-transform: uppercase;
}

.shop-sidebar .clr, .shop-sidebar .clr .item{
	padding-left:0;
}

.shop-sidebar .carousel a {
    color: #000;
    display: inline-block;
    width: 30px;
    height: 30px;
	font-size:18px;
    border: 1px solid #000;
	margin: 10px;
	
}

.shop-sidebar .carousel a span.glyphicon.glyphicon-chevron-up {
    padding-left: 6px;
    padding-top: 3px;
}

.shop-sidebar .carousel a span.glyphicon.glyphicon-down {
    padding-left: 6px;
    padding-top: 3px;
}

.shop-sidebar .carousel .carousel-caption {
    position: relative;
    right: 0;
    bottom: 20px;
    left: 0;
    z-index: 10;
    padding-top: 20px;
    padding-bottom: 20px;
    color: #000;
    text-align: center;
    text-shadow:none;
}

.shop-sidebar {
    background:#F3F3F3;
	padding-left:10px;
	padding-right:10px;
}

.shop-sidebar .carousel .carousel-caption p {
    margin:0;
	margin-top:1px;
	font-size:12px;
}

.shop-sidebar .carousel .carousel-caption p.bar-title {
    background:#ccc;
	color:#fff;
}

.shop-sidebar .window {
    height:500px;
	overflow:hidden;
}
/* --------------------------finish cart css -------------------------*/

</style>











