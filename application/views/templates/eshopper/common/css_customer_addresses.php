
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
	<link href="<?php echo base_url().'assets/templates/eshopper/css/main.css';?>" rel="stylesheet">
	<link href="<?php echo base_url().'assets/templates/eshopper/css/responsive.css';?>" rel="stylesheet">
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
</style>