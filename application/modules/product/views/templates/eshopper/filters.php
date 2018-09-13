<?php $current_url_full=$current_url;?>
 <link href="http://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet"/>
      <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
      <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
      <style type="text/css" media="screen">

#slider_filter
{
	margin:2px;
	margin-top:21px;
}

.tooltip {
    position: absolute;
    z-index: 1020;
    display: block;
    padding: 5px;
    font-size: 11px;
    visibility: visible;
    margin-top: -2px;
    bottom:120%;
    margin-left: -2em;
    opacity: 1;
}

.tooltip .tooltip-arrow {
    bottom: 0;
    left: 50%;
    margin-left: -5px;
    border-top: 5px solid #000000;
    border-right: 5px solid transparent;
    border-left: 5px solid transparent;
    position: absolute;
    width: 0;
    height: 0;
}

.tooltip-inner {
    max-width: 200px;
    padding: 3px 8px;
    color: #ffffff;
    text-align: center;
    text-decoration: none;
    background-color: #000000;
    -webkit-border-radius: 4px;
       -moz-border-radius: 4px;
            border-radius: 4px;
}

.ui-slider {
    background: #F3F3F3 repeat-x bottom left;
    border-bottom: 1px solid #EBEAE5;
    height: 15px;
    margin: 0;
    padding: 0px;
}

/*.ui-slider-handle {
    background: #70E733 !important ;
    border-bottom: 1px solid #a8a79f;
    border-right: 1px solid #a8a79f;
    height: 20px;
    width: 10px;
    margin: 0;
    padding: 0px;
    display: inline-block;
}*/

.ui-slider-handle {
    background: #D996E3  !important;
   /* border-bottom: 1px solid #a8a79f !important;*/
    /*border-right: 1px solid #a8a79f !important;*/
    height: 20px !important;
    width: 10px !important;
    margin: 0 !important;
    padding: 0px !important;
    display: inline-block !important;
    top: -4px !important;
}

/* slider price  middle  */
.ui-widget-header
{
	background: #252D2D !important;
	border-radius: 0;
}

.ui-slider-range {
    height: 10px;
    border-bottom: 3px solid red;
    position: relative;
}
#filter_box_container{
	background-color: ECECEC;
}
.filter_box{
	position: relative;
	display: inline-block;
	border: 1px solid #eeeeee;
	height: 40px;
	line-height: 14px;
	padding: 12px;
	margin: 5px;
	cursor: pointer;
}
.filter_box:hover{
	background-color: #000000;
	color: #ffffff;
	
}
.xlose_fb{
	
	display: inline-block;
	cursor: pointer;
	color: #DEE0E1;
}


.clear_all
{
	position: relative;
	display: inline-block;
	border: 1px solid #eeeeee;
	height: 40px;
	line-height: 14px;
	padding: 12px;
	margin: 5px;
	cursor: pointer;
	
	background-color: #000000;
	color: #ffffff;
	cursor: pointer;
}

      </style>

<div id="" style="">

<?php // cat_id=112&mnp=75&mxp=150&s=2&s=4&brnd=30891&brnd=770&clr=15&clr=8&sz=20&sz=16&hl=4&hl=5&s=3 ?>
<?php if(!empty($clr_ids) || !empty($sale_ids) || !empty($brnd_ids) || !empty($sz_ids) || !empty($hl_ids) ) : ?>
<?php $cpt = 0;  ?>

<fieldset id="filters">	
	<div id="filter_box_container" >
		<h3 style="font-size: 18px;" >  <?php echo $words_left["applied_filters"]; ?>  <!--Applied Filters--> </h3>
		
		<!--Sales-->
		<?php	if(!empty($sale_ids)) :?> 
			<?php	foreach ($sale_ids as $sale_id) : ?>
			<?php $cpt++;  ?>
			
				<?php foreach ($available_sales->discountHistogram as $available_cat_discount) : ?>
					
					<?php if($available_cat_discount->id == $sale_id ): ?>
						 <?php if ($available_cat_discount->name =="On Sale") : ?> 				<div class="filter_box" id="s_<?php echo $available_cat_discount->id ;?>" > <?php echo $words_left["on_sale"]; ?> <div class="xlose_fb">x</div> </div> 		
		                 <?php  elseif ($available_cat_discount->name =="New today") : ?>		<div class="filter_box" id="s_<?php echo $available_cat_discount->id ;?>" > <?php echo $words_left["new_today"]; ?> <div class="xlose_fb">x</div> </div>	
		                 <?php  elseif ($available_cat_discount->name =="New this week") : ?>	<div class="filter_box" id="s_<?php echo $available_cat_discount->id ;?>" > <?php echo $words_left["new_this_week"]; ?> <div class="xlose_fb">x</div> </div>
		                 <?php  else	: ?>							                        <div class="filter_box" id="s_<?php echo $available_cat_discount->id ;?>" > <?php echo $available_cat_discount->name; ?> <div class="xlose_fb">x</div> </div> 
						<?php	endif ; ?>
					<?php	endif ; ?>
					
				<?php	endforeach ; ?>
			
			<?php	endforeach ; ?>
		
		<?php endif;?> 
		
		<!--brands-->
		<?php	if(!empty($brnd_ids)) :?> 
			<?php	foreach ($brnd_ids as $brnd_id) : ?>
			<?php $cpt++;  ?>
				
				<?php foreach ($available_brands->brandHistogram as $available_cat_brands) : ?>
					
					<?php if($available_cat_brands->id == $brnd_id ): ?>
					
						<div class="filter_box" id="brnd_<?php echo $available_cat_brands->id ;?>" > <?php echo $available_cat_brands->name; ?> <div class="xlose_fb">x</div> </div>	
					
					<?php	endif ; ?>
					
				<?php	endforeach ; ?>
				
			<?php	endforeach ; ?>
		
		<?php endif;?> 
		
		<!--colors-->
		<?php	if(!empty($clr_ids)) :?> 
			<?php	foreach ($clr_ids as  $clr_id) : ?>
			<?php $cpt++;  ?>
			
				<?php	foreach ($available_colors->colorHistogram as $available_cat_colors) : ?>
				
					<?php if($available_cat_colors->id == $clr_id ): ?>
					
						<div class="filter_box" id="clr_<?php echo $available_cat_colors->id ;?>"  > <?php echo $available_cat_colors->name; ?> <div class="xlose_fb">x</div> </div>	
					
					<?php	endif ; ?>
				
				<?php	endforeach ; ?>
			
			<?php	endforeach ; ?>
		
		<?php endif;?> 
		
		<!--sizes-->
		<?php	if(!empty($sz_ids)) :?> 
			<?php	foreach ($sz_ids as $sz_id) : ?>
			<?php $cpt++;  ?>
			
				<?php	foreach ($available_sizes->sizeHistogram as $available_cat_sizes) : ?>
				
					<?php if($available_cat_sizes->id == $sz_id ): ?>
					
						<div class="filter_box" id="sz_<?php echo $available_cat_sizes->id ;?>" > <?php echo $available_cat_sizes->name; ?> <div class="xlose_fb">x</div> </div>
					
					<?php	endif ; ?>
				
				<?php	endforeach ; ?>
			
			<?php	endforeach ; ?>
		
		<?php endif;?> 
		
		<!--heel height-->
		<?php	if(!empty($hl_ids))  :?> 
			<?php	foreach ($hl_ids as $hl_id) : ?>
			<?php $cpt++;  ?>
			
				<?php	foreach ($available_heelheights->heelHeightHistogram as $available_cat_heel) : ?>
				
					
					<?php if($available_cat_heel->id == $hl_id ): ?>
					
						<div class="filter_box" id="hl_<?php echo $available_cat_heel->id ;?>" > <?php echo $available_cat_heel->name; ?> <div class="xlose_fb">x</div> </div>
					
					<?php	endif ; ?>
				
				<?php	endforeach ; ?>
			
			<?php	endforeach ; ?>
		
		<?php endif;?> 
		
		<!--clear all-->
		<?php	if($cpt > 1)  :?> 
			<div class="clear_all" id="clear_filters" title="CLEAR ALL" > <?php echo $words_left["clear_all"]; ?>  </div> 
		<?php endif;?> 
		
	</div>	
</fieldset>	
<?php endif; ?>
 

<!--<fieldset id="filters">
	<div id="filter_box_container" >
		<h3 style="font-size: 18px;" >  Applied Filters </h3>
		<div class="filter_box"  > red <div class="xlose_fb">x</div> </div> 
		<div class="filter_box"  > green <div class="xlose_fb">x</div> </div> 
		<div class="filter_box"  > xxl  <div class="xlose_fb">x</div> </div> 
		<div class="filter_box"  > sale20% <div class="xlose_fb">x</div> </div> 
		<div class="filter_box"  > Badgley Mischka  <div class="xlose_fb">x</div> </div> 
		<div class="filter_box"  > 11.5   <div class="xlose_fb">x</div> </div> 
		<div class="filter_box clear_all" title="CLEAR ALL" >CLEAR ALL  </div> 
	</div>
</fieldset>-->

	 <!-- <input class="submit_filter_btn" type="button" value="apply filter" style="margin-left: 53%; " onclick="submit_filter_form()" />-->  


<fieldset>
    <legend>  <?php echo $words_left["sales_deals"]; ?> </legend>
    <div class="brand-filter-box brandbox">
    	<?php foreach ($available_sales->discountHistogram as $available_cat_discount):?>
          
            <span onclick="applyfilter('s',<?php echo $available_cat_discount->id;?>)" class="filter-place">
            <input type="checkbox" name="sortrad" 
            value="<?php echo $_SERVER["REQUEST_URI"];?>&s=<?php echo $available_cat_discount->id;?>" id="s<?php echo $available_cat_discount->id;?>"> 
            <?php 
             if ($available_cat_discount->name =="On Sale") 			echo $words_left["on_sale"];
             elseif ($available_cat_discount->name =="New today") 		echo $words_left["new_today"];
             elseif ($available_cat_discount->name =="New this week") 	echo $words_left["new_this_week"];
             else								                        echo $available_cat_discount->name;
            ?>
            </span>
        	<span class="size-filter-count"><?php if($available_cat_discount->count<1000){
            echo $available_cat_discount->count;
            }else{ echo (round($available_cat_discount->count/1000,1)."K");}?></span><br />
        <?php endforeach;?>
            
    </div>       
</fieldset>
	       
<br/>
		<!-- <input class="submit_filter_btn" type="button" value="apply filter" style="margin-left: 53%; " onclick="submit_filter_form()" />-->  

<!--prices-->
	<?php 
	
	/*echo "<pre>";
	var_dump($price_id_value); 
	echo "</pre>";
	echo "----------------";
	echo $max_price_admin_id;*/
	
	?>

<fieldset>
    <legend> <?php echo $words_left["price"]; ?> </legend>
    <div id="price_filter" >
    	<?php foreach($available_prices->priceHistogram as $price_histogram ) :?>
    		<?php 
    			//if the price id from api is less or equal to the price id from the admin panel then show the price name 
    			if( ($price_histogram->id <= $max_price_admin_id) or empty($max_price_admin_id) ) : ?>
    			<input type="checkbox" name="price_filter" class="pf" id="<?php echo('p'.$price_histogram->id); ?>"  value=" <?php echo($price_histogram->id); ?>" >   <label for="<?php echo('p'.$price_histogram->id); ?>" style="font-weight: normal;margin: 0;" > <?php echo($price_histogram->name); ?></label>
	    		<span class="size-filter-count">
	    			<?php if($price_histogram->count<1000)
	    			{
					    echo $price_histogram->count;
					}
					else
					{
						 echo (round($price_histogram->count/1000,1)."K");
					}?>
	    			
	    		</span>
	    		<br>
    		<?php endif; ?>    		
    	<?php endforeach; ?>

    	<!--<input type="checkbox" name="price_filter" class="pf" id="p7"  value="7">   <label for="p7" style="font-weight: normal;margin: 0;" > $0 - $25			</label> <br>
		<input type="checkbox" name="price_filter" class="pf" id="p8"  value="8">   <label for="p8" style="font-weight: normal;margin: 0;" > $25 - $50			</label>  <br>
		<input type="checkbox" name="price_filter" class="pf" id="p9"  value="9">   <label for="p9" style="font-weight: normal;margin: 0;" > $50 - $100		</label>  <br>
		<input type="checkbox" name="price_filter" class="pf" id="p10" value="10">  <label for="p10" style="font-weight: normal;margin: 0;" > $100 - $150		</label>  <br>
		<input type="checkbox" name="price_filter" class="pf" id="p11" value="11">  <label for="p11" style="font-weight: normal;margin: 0;" > $150 - $250		</label>  <br>
		<input type="checkbox" name="price_filter" class="pf" id="p12" value="11">  <label for="p12" style="font-weight: normal;margin: 0;" > $250 - $500		</label>  <br>
		<input type="checkbox" name="price_filter" class="pf" id="p13" value="12">  <label for="p13" style="font-weight: normal;margin: 0;" > $500 - $1000		</label>  <br>
		<input type="checkbox" name="price_filter" class="pf" id="p14" value="13">  <label for="p14" style="font-weight: normal;margin: 0;" > $500 - $1000		</label>  <br>
		<input type="checkbox" name="price_filter" class="pf" id="p15" value="14">  <label for="p15" style="font-weight: normal;margin: 0;" > $1000 - $2500	</label>  <br>
		<input type="checkbox" name="price_filter" class="pf" id="p16" value="15">  <label for="p16" style="font-weight: normal;margin: 0;" > $2500 - $5000	</label>  <br>
		<input type="checkbox" name="price_filter" class="pf" id="p17" value="16">  <label for="p17" style="font-weight: normal;margin: 0;" > $5000+			</label>  <br>-->
		
		<div style="margin-top: 5px;" >
			<!--<button style="line-height: 25px;background: black;color: white;width: 60px;border: none; " > Apply </button>-->
			<button id="clr_fp" style="line-height: 25px;background: black;color: white;width: 100px;border: none; display: none; " > Clear Prices </button>
		</div>
	</div>
</fieldset>

<br/>
		<!-- <input class="submit_filter_btn" type="button" value="apply filter" style="margin-left: 53%; " onclick="submit_filter_form()" />-->  

<!--brands-->
<fieldset>
	<legend><?php echo $words_left["brands"]; ?></legend>
	<input id="bqflrt" type="text" placeholder='<?php echo $words_left["search_brand"]; ?>' style="    width: 100%;    margin-bottom: 5px;    line-height: 26px;" />
	<div class="brand-filter-box brandbox" style="">
		<?php foreach ($available_brands->brandHistogram as $available_cat_brands):?>
		    <div class="bspan" id="bspan_<?php echo $available_cat_brands->id;?>" style="" >
			    <span onclick="applyfilter('brnd',<?php echo $available_cat_brands->id;?>)" class="filter-place">
				<input type="checkbox" name="sortrad" value="<?php echo $_SERVER["REQUEST_URI"];?>&brnd=<?php echo $available_cat_brands->id;?>"
				                        id="brnd<?php echo $available_cat_brands->id;?>">
			    <?php echo($available_cat_brands->name);?>
			     </span>
			     <span class="size-filter-count"><?php if($available_cat_brands->count<1000){
				                        echo $available_cat_brands->count;
				                        }else{ echo (round($available_cat_brands->count/1000,1)."K");}?></span>
		 	</div>
		 <?php endforeach;?>
	</div>
</fieldset>

 <br/>

 <!-- <input class="submit_filter_btn" type="button" value="apply filter" style="margin-left: 53%; " onclick="submit_filter_form()" />--> 
	 <?php //if(!empty($response->showColorFilter)){?>  

<!--colors-->
<fieldset >
<?php //if(!empty($available_colors)){?>  
<!--<div class="color-filter-box" onclick="setcolorfilter('0','any color'),set_active()" style="background-image:url('<?php echo base_url().'assets/templates/eshopper/images/products-list/all.png';?>');width: 33px;height: 33px; background-position: -46px -49px;cursor:pointer; "></div>  -->  
<?php if(!empty($available_colors)) :?>
    <legend><?php echo $words_left["colors"]; ?></legend>
    <div class="brand-filter-box brandbox"> 
		
			
		
	<?php foreach ($available_colors->colorHistogram as $available_cat_colors):?>
		  	<?php //echo($available_cat_colors->cannonical_name);
			   //if($available_cat_colors->swatchUrl)
			   //{
		   		?>
		   		<span onclick="applyfilter('clr',<?php echo $available_cat_colors->id;?>)" class="filter-place">
	                        <input type="checkbox" name="sortrad" id="clr<?php echo $available_cat_colors->id;?>"
	                        value="<?php echo $_SERVER["REQUEST_URI"];?>&hl=<?php echo $available_cat_colors->id;?>">
                        <?php echo $available_cat_colors->name;?>
                </span>
                       <span class="size-filter-count"><?php if($available_cat_colors->count<1000){
	                        echo $available_cat_colors->count;
	                        }else{ echo (round($available_cat_colors->count/1000,1)."K");}?></span>
                      
                      
                      <br />
	          <!--              
		   	 	<div class="color-filter-box filter-place" onclick="applyfilter('clr',<?php //echo $available_cat_colors->id;?>)" 	   	
		   		style="background-color:<?php echo($available_cat_colors->name);?>;"
			   		id="clr=<?php echo $available_cat_colors->id;?>"></div>
			   		-->
		   		<?php //echo($available_cat_colors->count);?>
		 	<?php //} 
 		endforeach;	
 		
 		
 		?>
    </div>
<?php endif; ?>
</fieldset>

 <br/>
<?php //}?>

 <!-- <input class="submit_filter_btn" type="button" value="apply filter" style="margin-left: 53%; " onclick="submit_filter_form()" />--> 


<!--sizes-->
<?php if(!empty($available_sizes->sizeHistogram)){?>  
<fieldset>
	<legend><?php echo $words_left["size"]; ?> <!--Size--></legend>

	<div class="brand-filter-box sizebox">
		<?php foreach ($available_sizes->sizeHistogram as $available_cat_sizes):?>
			<span onclick="applyfilter('sz',<?php echo $available_cat_sizes->id;?>)" class="filter-place">
		    <input type="checkbox" name="sortrad" id="sz<?php echo $available_cat_sizes->id;?>"
		        value="<?php echo $_SERVER["REQUEST_URI"];?>&sz=<?php echo $available_cat_sizes->id;?>">
			<?php echo($available_cat_sizes->name);?>
			</span>
			<span class="size-filter-count"><?php if($available_cat_sizes->count<1000){
		            echo $available_cat_sizes->count;
		            }else{ echo (round($available_cat_sizes->count/1000,1)."K");}?></span>
			<br/>
		<?php endforeach;?>
	</div>
</fieldset>

<br/> 
<?php }?>

<?php if(!empty($available_heelheights->heelHeightHistogram)){?> 
<fieldset>
	<legend><?php echo $words_left["heel_hight"]; ?> <!--Heel Hights--> </legend>
	<div class="brand-filter-box sizebox">
	<?php foreach ($available_heelheights->heelHeightHistogram as $available_cat_heel):?>
	<span onclick="applyfilter('hl',<?php echo $available_cat_heel->id;?>)" class="filter-place">
	            <input type="checkbox" name="sortrad" id="hl<?php echo $available_cat_heel->id;?>"
	            value="<?php echo $_SERVER["REQUEST_URI"];?>&hl=<?php echo $available_cat_heel->id;?>">
	        <?php echo $available_cat_heel->name;?>
	</span>
	       <span class="size-filter-count"><?php if($available_cat_heel->count<1000){
	            echo $available_cat_heel->count;
	            }else{ echo (round($available_cat_heel->count/1000,1)."K");}?></span>
	            <br />
	         <?php endforeach;?>
	</div>
</fieldset>
	        
<br/>
<?php }?>

<!-- <input class="submit_filter_btn" type="button" value="apply filter" style="margin-left: 53%; " onclick="submit_filter_form()" />-->  
	 
</div>
<script type="text/javascript">
	//applyfilter
	$( document ).ready(function() {
   		var url=window.location.href ;
	   
	   // autocheck the filter boxes from url - rabea
	   arr_url=url.split("&");
	   for(i=1;i<arr_url.length;i++)
	  {
		   arr_url_temp=arr_url[i].split("=");
		  
			  if(arr_url_temp[0]!="ppp"&&arr_url_temp[0]!="mnp"&&arr_url_temp[0]!="mxp")
			 { 
				 document.getElementById(arr_url_temp[0]+arr_url_temp[1]).checked = true;
			 }
			
			
	   }
});
   function applyfilter(filter_type,filter_id){
	   var url=window.location.href ;
	   
	   //remove the 1st pagination number if any
	   //var url = url.replace(/browse\/[0-9]+\?/, "browse/0?");
	   
	   arr_url=url.split("&");
	   for(i=0;i<arr_url.length;i++){
		   arr_url_temp=arr_url[i].split("=");
		   if(arr_url_temp[0]==filter_type)
		   		{ 
			   		if(arr_url_temp[1]==filter_id)
			   		{
				   		//remove from url
				   		temp="&"+filter_type+"="+filter_id;
				   		final_url=url.replace(temp,'');				
				   		//window.location.href =final_url;
			   		}
			   		else
			   		{
				   		//add to url
				   		final_url=url+"&"+filter_type+"="+filter_id;
				   		//window.location.href =final_url;
			   		}
			   	}
			   	else
			   	{
				   		//add to url
				   		final_url=url+"&"+filter_type+"="+filter_id;
				   		//window.location.href =final_url;
			   	}
	   }
	  window.location.href =final_url;
	   
   }
   function priceslider(){
	     <?php if(isset($_GET['mnp'])){?>
		 var url1=window.location.href ;
	   arr_url1=url1.split("&");
	   for(i=0;i<arr_url1.length;i++){
		   arr_url1_temp=arr_url1[i].split("=");
		   if(arr_url1_temp[0]=="mnp")
		   		{ 
			   		arr_url1_temp_mnp=arr_url1_temp[1];
			   	}
		   if(arr_url1_temp[0]=="mxp")
		   		{ 
			   		arr_url1_temp_mxp=arr_url1_temp[1];
			   	}	
				   		//remove from url
				   		

			   		}
			   		
			   		temp1="&mnp="+arr_url1_temp_mnp+"&mxp="+arr_url1_temp_mxp;
			   		
			   		final_price="&mnp="+document.getElementById("from").value+"&mxp="+document.getElementById("to").value;							
			   		final_url1=url1.replace(temp1,final_price);				
				   		window.location.href =final_url1;

  <?php }else{?>
 						 var url1=window.location.href ;
				   		final_url1=url1+"&mnp="+document.getElementById("from").value+"&mxp="+document.getElementById("to").value;
				   		window.location.href =final_url1;
  <?php }?>
   }
   function productperpage(srt){
	  
	   <?php if(isset($_GET['srt'])){?>
		 var url2=window.location.href ;
	   arr_url2=url2.split("&");
	   for(i=0;i<arr_url2.length;i++){
		   arr_url2_temp=arr_url2[i].split("=");
		   if(arr_url2_temp[0]=="srt")
		   		{ 
			   		arr_url2_temp_ppp=arr_url2_temp[1];
			   	}
			   		}
			   		temp2="&srt="+arr_url2_temp_ppp;
			   		final_ppp="&srt="+srt;
			   		final_url2=url2.replace(temp2,final_ppp);				
				   		window.location.href =final_url2;

  <?php }else{?>

 						 var url2=window.location.href ;
				   		final_url2=url2+"&srt="+srt;
				   		window.location.href =final_url2;
  <?php }?>
   }

	</script>