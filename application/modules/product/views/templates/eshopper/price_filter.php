<?php $current_url_full=$current_url;?>
 <link href="http://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
      <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
      <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
      <!-- Javascript -->
      <script>
         $(function() 
         	{
	         	PriceData = [
		         <?php foreach($price_id_values as $price_id_value)
			         {echo $price_id_value->min_val.",";}?>5000];
			         
 				var initialValue = 0;
				var max_price = 5000;

				var foo = function( event, ui ) 
				{
				  // Set the real value into the inputs
				  $('#from').val( PriceData[ ui.values[0] ] );
				  $('#to').val( PriceData[ ui.values[1] ] );

				  //
				  var LeftcurValue = PriceData[ui.values[0] ] || initialValue;
				  var RightcurValue = PriceData[ui.values[1] ] || max_price;
				  
				  var Lefttooltip = '<div class="tooltip"><div class="tooltip-inner">' + LeftcurValue + '</div><div class="tooltip-arrow"></div></div>';
				  
				  var Righttooltip = '<div class="tooltip"><div class="tooltip-inner">' + RightcurValue + '</div><div class="tooltip-arrow"></div></div>';

				    //$('.ui-slider-handle').html(Lefttooltip);
				    //$('a.ui-slider-handle:nth-child(2)').html(Lefttooltip);
				    $('span.ui-slider-handle:nth-child(2)').html(Lefttooltip);
				    //$('a.ui-slider-handle:nth-child(3)').html(Righttooltip);
				    $('span.ui-slider-handle:nth-child(3)').html(Righttooltip);
				    
				    
				    //$('zxvzcvzcv').html(xcvzxcv)
				    //$('.a.ui-slider-handle:nth-child(3)').html('ok');
				}
					var bar = function() 
				{ 
					$min_price =<?php if(isset($_GET['mnp'])){echo $_GET['mnp'];}else {echo 0;}?>;
                    $min_index = PriceData.indexOf($min_price);
                    
                    $max_price =<?php if(isset($_GET['mxp'])){echo $_GET['mxp'];}else {echo 5000;}?>;
                    $max_index = PriceData.indexOf($max_price);
                    
                    $(this).slider('values',0,$min_index);
                    $(this).slider('values',1,$max_index);
                    
                    var Lefttooltip = '<div class="tooltip"><div class="tooltip-inner">' + $min_price + '</div><div class="tooltip-arrow"></div></div>';
  
					var Righttooltip = '<div class="tooltip"><div class="tooltip-inner">' +  $max_price + '</div><div class="tooltip-arrow"></div></div>';

					//$('.ui-slider-handle').html(Lefttooltip);
					//$('a.ui-slider-handle:nth-child(2)').html(Lefttooltip);
					$('span.ui-slider-handle:nth-child(2)').html(Lefttooltip);
					//$('a.ui-slider-handle:nth-child(3)').html(Righttooltip);
					$('span.ui-slider-handle:nth-child(3)').html(Righttooltip);
                                    
                    //$(this).slider('values',1,PriceData.length - 1);
            	}

				slider_config = 
				{
					range: true,
					min: 0,
					max: PriceData.length - 1,
		      		//max: 5000,
					step: 1,
					slide: foo,
		      		create: bar
				};

				// Render Slider
				$('#slider_filter').slider(slider_config);
         	});
      </script>
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
		<h3 style="font-size: 18px;" >  Applied Filters </h3>
		
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
			<div class="clear_all" id="clear_filters" title="CLEAR ALL" > CLEAR ALL  </div> 
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
        <fieldset>
	        <legend> <?php echo $words_left["price"]; ?> </legend>
            <div id="slider_filter" ></div>
			<input type="hidden" name="from" id="from" value="" placeholder="from" onchange="priceslider()"/>
			<input type="hidden" name="to" id="to" value="" placeholder="to" onchange="priceslider()"/>  
			<button onclick="priceslider()">set</button>                      
        </fieldset>
		<br/>
		<!-- <input class="submit_filter_btn" type="button" value="apply filter" style="margin-left: 53%; " onclick="submit_filter_form()" />-->  
	 <fieldset>
		<legend><?php echo $words_left["brands"]; ?></legend>
		<div class="brand-filter-box brandbox" style="">
			<?php foreach ($available_brands->brandHistogram as $available_cat_brands):?>
			    <span onclick="applyfilter('brnd',<?php echo $available_cat_brands->id;?>)" class="filter-place">
				<input type="checkbox" name="sortrad" value="<?php echo $_SERVER["REQUEST_URI"];?>&brnd=<?php echo $available_cat_brands->id;?>"
				                        id="brnd<?php echo $available_cat_brands->id;?>">
			    <?php echo($available_cat_brands->name);?>
			     </span>
			     <span class="size-filter-count"><?php if($available_cat_brands->count<1000){
				                        echo $available_cat_brands->count;
				                        }else{ echo (round($available_cat_brands->count/1000,1)."K");}?></span>
			 <br/>
			 <?php endforeach;?>
		</div>
	 </fieldset>
	 
	 <br/>
	 <!-- <input class="submit_filter_btn" type="button" value="apply filter" style="margin-left: 53%; " onclick="submit_filter_form()" />--> 
	 <?php //if(!empty($response->showColorFilter)){?>  
	 <fieldset >
		<?php //if(!empty($available_colors)){?>  
		<!--<div class="color-filter-box" onclick="setcolorfilter('0','any color'),set_active()" style="background-image:url('<?php echo base_url().'assets/templates/eshopper/images/products-list/all.png';?>');width: 33px;height: 33px; background-position: -46px -49px;cursor:pointer; "></div>  -->  
		<?php if(!empty($available_colors)) :?>
		    <legend>Colors</legend>
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
	 <?php if(!empty($available_sizes->sizeHistogram)){?>  
	<fieldset>
	                <legend>Size</legend>

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
	                <legend>Heel Hights</legend>
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
	 
	<div >
					<!--<form id="hidden_filter_form" method="get" action="<?php echo base_url();?>product/listing/id<?php echo $cat_id;?>" >
							
							<input id="min_price_input" style="width: 50px" type="hidden" value=""  name="min_price"  >
							
							<input id="max_price_input" style="width: 80px"  type="hidden" value="" name="max_price"   >
							
							
							<input id="brand_id_input"  type="hidden" value="" name="brand_id" placeholder="brand_id" >
							
													<input id="brand_name_input"  type="hidden" value="" name="brand_name_id" >
							

							
							<input id="size_id"  type="hidden" value="" name="size_id"  placeholder="size_id">
							<input id="size_name"  type="hidden" value="" name="size_name" >
							
						
							
							<input id="color_id_input"  type="hidden" value="" name="color_id"  placeholder="color_id">
							<input id="color_name_input"  type="hidden" value="" name="color_name" >
							
							
							<input id="on_sale"  type="hidden" value="FALSE" name="on_sale" >
							
							<input id="price_order"  type="hidden" value="" name="price_order" >
							
							<button type="submit" style="
	    position: fixed; 
	    bottom:0%; 
	    opacity: 1;">Apply Filter</button>
					</form>-->
	</div>
</div>
<script type="text/javascript">
	//applyfilter
	$( document ).ready(function() {
   var url=window.location.href ;
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