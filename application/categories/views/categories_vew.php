<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">

<style>
#category_menu{
	/*width: 213px;*/
	background-color: #e0def5;
	
	color: #696763;
	font-family: "Roboto",sans-serif;
	font-size: 90%;
	text-decoration: none;
	text-transform: uppercase;
}
.L0
{
	background-color: #fffefb;
	list-style-type: none;
	padding-left: 0;
	padding: 0px;
	border: solid 1px #F0F0F0;

}

.L0 > li > div,.L1 > li > div,.L2 > li > div,.L3 > li > div,.L4 > li > div
{
padding:5px;	
}

.L1 span,.L2  span,.L3  span,.L4 span
{
  /*background-color:#d6cfef;*/
  position: relative;
  top: 25%;
  display: inline-block;
  vertical-align: middle;
  line-height: normal;
}

.L0>li:before
{
    //content: '[+]';
   // margin: 0 1em;    /* any design */
}

.L1, .L2, .L3, .L4
{
	display: none;
	list-style-type: none;
	padding-left: 0px;
	
}

.L0 div, .L1 div, .L2 div, .L3 div, .L4 div{
	height: 35px;
}

.L1
{
	background-color: #fff9ec;
	font-size: 90%;
	
}

.L2
{
	background-color: #fef0d6;
	font-size: 90%;
}

.L3
{
	background-color: #fee9c0;
	font-size: 90%;
}

.L4
{
	background-color: #fdcf7b;
	font-size: 90%;
}

.plus>div{
    padding: 0px;
    background-image: url("http://www.pluscarestore.com/catalog/view/theme/ioc7-pro/image/icons/icon-plus-dark.png");
    background-position: 97% 50%;
    background-repeat: no-repeat;
    
    /*border:solid 1px red;	*/
}

.minus>div{
	position: relative;
    padding: 0px;
   /* background: transparent linear-gradient(to right, #28231F, #28231F, #483F36, #28231F) repeat scroll 0% 0%;*/
    background-image: url("http://www.pluscarestore.com/catalog/view/theme/ioc7-pro/image/icons/icon-minus-dark.png");
    background-position: 97% 50%;
    background-repeat: no-repeat;
    
    
    /*border:solid 1px red;	*/
}

.L1>.minus>div:after
{
content: "";
position: absolute;
    top: 100%;
    left: 45%;
    content: '';
    width: 0;
    height: 0;
border-top: 10px solid #fff9ec;
border-left: 10px solid rgba(254, 13, 13, 0);
border-right: 10px solid rgba(255, 0, 45, 0);
}

.L2>.minus>div:after
{
content: "";
position: absolute;
    top: 100%;
    left: 45%;
    content: '';
    width: 0;
    height: 0;
border-top: 10px solid #fef0d6;
border-left: 10px solid rgba(254, 13, 13, 0);
border-right: 10px solid rgba(255, 0, 45, 0);
}

.L3>.minus>div:after
{
content: "";
position: absolute;
    top: 100%;
    left: 45%;
    content: '';
    width: 0;
    height: 0;
border-top: 10px solid #fee9c0;
border-left: 10px solid rgba(254, 13, 13, 0);
border-right: 10px solid rgba(255, 0, 45, 0);
}

.L4>.minus>div:after
{
content: "";
position: absolute;
    top: 100%;
    left: 45%;
    content: '';
    width: 0;
    height: 0;
border-top: 10px solid #fdcf7b;
border-left: 10px solid rgba(254, 13, 13, 0);
border-right: 10px solid rgba(255, 0, 45, 0);
}

/*.minus>.selected:after
{
content: "";
position: absolute;
    top: 100%;
    left: 45%;
    content: '';
    width: 0;
    height: 0;
border-top: 10px solid #3F69B1;
border-left: 10px solid rgba(254, 13, 13, 0);
border-right: 10px solid rgba(255, 0, 45, 0);
}*/
.minus>div:after
{
content: "";
position: absolute;
    top: 100%;
    left: 45%;
    content: '';
    width: 0;
    height: 0;
border-top: 10px solid #ED5012;
border-left: 10px solid rgba(254, 13, 13, 0);
border-right: 10px solid rgba(255, 0, 45, 0);
}

.plus:before
{
    //content: '[+]';
    //margin: 0 1em;    /* any design */
}

.minus:before
{
    //content: '[-]';
    //margin: 0 1em;    /* any design */
}

.selected{
	background-color: #3F69B1;
	color: #f1f1f1;
}


</style>
</head>


<div id="category_menu">

<?php 
echo "<ul class='L0 plus' >"	;	
		for ($i = 0; $i < $total_cat; $i++)
		{
			$c[$i]=$json->categories[$i];
			
			if( ($c[$i]->parentId)== "clothes-shoes-and-jewelry")
			{
			 //level 0
			 echo "<li>";
			 echo  '<div id = "'.$c[$i]->localizedId.'"><span>'.$c[$i]->name.'</span></div>' ;
			 echo "<ul class='L1'  >"	;
			 for ($j = 0; $j < $total_cat; $j++)
			 {
			 	$c[$j]=$json->categories[$j];
			 	if( $c[$j]->parentId == $c[$i]->localizedId)
			 	{
			 		//level 1
			 		echo "<li>";
			 		echo  "<div id = '".$c[$j]->localizedId."'><span>".$c[$j]->name."</span></div>" ;
			 		
			 		echo "<ul class='L2' >";
			 		for ($k = 0; $k < $total_cat; $k++)
					{
					 	$c[$k]=$json->categories[$k];
					 	if( $c[$k]->parentId == $c[$j]->localizedId)
					 	{
					 		//level 2
					 		echo "<li>";
					 		echo  "<div id = '".$c[$k]->localizedId."'><span>".$c[$k]->name."</span></div>" ;
					 		
					 		//test child3
							 		$child3 = FALSE;
							 		for ($l = 0; $l < $total_cat; $l++)
									{
									 	$c[$l]=$json->categories[$l];
									 	if( $c[$l]->parentId == $c[$k]->localizedId)
									 	{
									 		$child3 = TRUE;
									 		
										}
									}
							if($child3)
							{
						 		echo "<ul class='L3' >";
						 		for ($l = 0; $l < $total_cat; $l++)
								{
								 	$c[$l]=$json->categories[$l];
								 	if( $c[$l]->parentId == $c[$k]->localizedId)
								 	{
								 		//level 3
								 		echo "<li>";
								 		echo  "<div id = '".$c[$l]->localizedId."'><span>".$c[$l]->name."</span></div>" ;
								 		
								 		//test child4
								 		$child4 = FALSE;
								 		for ($m = 0; $m < $total_cat; $m++)
										{
										 	$c[$m]=$json->categories[$m];
										 	if( $c[$m]->parentId == $c[$l]->localizedId)
										 	{
										 		$child4 = TRUE;
										 		
											}
										}
								 		
								 		if($child4)
								 		{
											echo "<ul class='L4' >";
									 		for ($m = 0; $m < $total_cat; $m++)
											{
											 	$c[$m]=$json->categories[$m];
											 	if( $c[$m]->parentId == $c[$l]->localizedId)
											 	{
											 		//level 4
											 		echo "<li>";
											 		echo  "<div id = '".$c[$m]->localizedId."'>".$c[$m]->name."</div>" ;
											 		echo "</li>";
											 		
												}//end if c
											}//end for m
									 		echo "</ul>";
										}
								 		
								        echo "</li>";
								 		
									}//end if l
								}//end for l
								echo "</ul>";
							}		
							
							
							echo "</li>";
						}//end if k
					}//end for k
					echo "</ul>";
					echo "</li>";
				}//end if j
			 }// enf for j
			 echo "</ul>"	;
			 echo "</li>";	
			}// end if i
			
		}// end for i
		echo "</ul>"	;	
?>
</div>
<script src="<?php echo base_url().'assets/templates/eshopper/js/jquery.js';?>" > </script>
<!--<script src="https://code.jquery.com/jquery-1.11.3.min.js" > </script>-->
<script>
	//script for the category menu 
	
	$(".L0 li").click(function(event)
	{
		event.stopPropagation();
		
		$(this).find('.L1').toggle( "fast", function() {  // Animation complete.
		 	});
		
		
		$(".L0 *").css("border-style","none");
		//$(this).first().css("border","solid 1px red");
		//$(this).find("div").first().css("border","solid 1px red");
		
		$(".L0 *").removeClass("selected");
		$(this).find("div").first().addClass("selected");
		
		$(this).find('.L1 li').has( "ul" ).addClass("plus");
		
		//$(this).toggleClass("plus minus");
		
		// toggle my way 
		var flag = 0;
		if( $( this ).hasClass( "plus" ) )
		{
			flag = 1;
			$( this ).removeClass("plus");
			$( this ).addClass("minus");
		}
		if( $( this ).hasClass( "minus" ) && flag ==0 )
		{
			$( this ).removeClass("minus");
			$( this ).addClass("plus");
		}
			
	});
	
	$(".L1 li").click(function(event)
	{
		event.stopPropagation();
		$(this).find('.L2').toggle( "fast", function() {  // Animation complete.
		 	});
		 	
		$(".L0 *").css("border-style","none");
		//$(this).first().css("border","solid 1px red");
		//$(this).find("div").first().css("border","solid 1px red");
		//$(this).find('.L2 li').has( "ul" ).css( "background-color", "#dafadf" );
		
	});
	
	$(".L2 li").click(function(event)
	{
		event.stopPropagation();
		$(this).find('.L3').toggle( "fast", function() {  // Animation complete.
		 	});
		 	
		$(".L0 *").css("border-style","none");
		//$(this).first().css("border","solid 1px red");
		//$(this).find("div").first().css("border","solid 1px red");
		
		//$(this).find('.L3 li').has( "ul" ).css( "background-color", "#f7dbf9" );
		
	});
	
	$(".L3 li").click(function(event)
	{
		event.stopPropagation();
		$(this).find('.L4').toggle( "fast", function() {  // Animation complete.
		 	});
		 	
		$(".L0 *").css("border-style","none");
		//$(this).first().css("border","solid 1px red");
		//$(this).find("div").first().css("border","solid 1px red");
		 	
		//$(this).find('.L4 li').has( "ul" ).css( "background-color", "#dcdff8" );
		
	});
	
</script>





</html>
