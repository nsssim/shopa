
<!DOCTYPE html>
<html lang="en">
<head>

<!--____________________________________/ meta \____________________________________ -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
    <meta name="description " content="<?php //echo($meta_description) ?> " >
	<meta name="keywords" content="<?php //echo($meta_keyworks) ?>" >
    <meta name="author" content="TrendIT - Home baked" >
    
<!--____________________________________/ favicon \____________________________________ -->
<link rel='shortcut icon' type='image/ico' href= "<?php echo base_url().'assets/templates/eshopper/images/home/favicon.ico';?>"  >

<!--____________________________________/ title \____________________________________ -->
    <title> <?php //echo($meta_title) ?> </title>
    
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

</style>