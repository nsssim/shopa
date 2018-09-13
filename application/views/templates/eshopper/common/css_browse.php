
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
	<link href="<?php echo base_url().'assets/templates/eshopper/css/main.css';?>" type="text/css" rel="stylesheet">
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

/* --------------------------browse page css -------------------------*/
/*
regex css
div[id^='accordian_level'] > div > div > h4 {
    color: green;  
}*/

.sa_cat_active
{
	color: red !important;
	text-decoration: underline !important;
}

.category-products{
	padding: 0;
}

.is_active_parent
{
	text-decoration: underline !important;
}

/* --------------------------finish browse page css -------------------------*/




</style>