<fieldset>
               


    <input type="checkbox" id="onsalefilter" value="true" /> On Sale

 </fieldset>
 <br/>
 <input class="submit_filter_btn" type="button" value="apply filter" style="margin-left: 53%; " onclick="submit_filter_form()" />  
 <fieldset>
                <legend>Sort By</legend>
                        <input type="radio" name="sortrad" value="none"  checked=""/> none<br />
                        <input type="radio" name="sortrad" value="up" /> Highest Price<br />
                        <input type="radio" name="sortrad" value="down" /> Lowest Price<br />
                        
                      
        </fieldset>
<br/>
<input class="submit_filter_btn" type="button" value="apply filter" style="margin-left: 53%; " onclick="submit_filter_form()" />  
        <fieldset>
                <legend>Price</legend>
                        <input type="radio" name="pricefilterrad" value="a1"/> Under $75<br />
                        <input type="radio" name="pricefilterrad" value="a2" /> $75 - $300<br />
                        <input type="radio" name="pricefilterrad" value="a3" /> $300 - $600<br />
                        <input type="radio" name="pricefilterrad" value="a4" /> $600 - $1200<br />
                        <input type="radio" name="pricefilterrad" value="a5" /> $1200 and Over<br />
                       <label>from</label>
						<input id="min_price_input1" style="width: 50px" type="text" value=""  name="min_price1" >
						<label>to $</label>
						<input id="max_price_input1" style="width: 50px"  type="text" value="" name="max_price1" >
        </fieldset>
<br/>
<input class="submit_filter_btn" type="button" value="apply filter" style="margin-left: 53%; " onclick="submit_filter_form()" />  
 <fieldset>
                <legend>Brand</legend>
<div class="brand-filter-box brandbox">
    <input type="radio" id="brand_filter0"  name="brand_filter" value="0,any brand" /> Any brand <br/>
<?php foreach ($available_cat_brands as $available_cat_brands):?>
    <input type="radio" id="brand_filter<?php echo($available_cat_brands->brand_id);?>" name="brand_filter" value="<?php echo($available_cat_brands->brand_id);?>,<?php echo($available_cat_brands->name);?>" /> <?php echo($available_cat_brands->name);?>
 <br/>
 <?php endforeach;?>
</div>
 </fieldset>
 
 <br/>
 <input class="submit_filter_btn" type="button" value="apply filter" style="margin-left: 53%; " onclick="submit_filter_form()" />  
 <fieldset >
                <legend>Colors</legend>
                
 <div class="color-filter-box" onclick="setcolorfilter('0','any color'),set_active()" style="background-image:url('<?php echo base_url().'assets/templates/eshopper/images/products-list/all.png';?>');width: 33px;height: 33px; background-position: -46px -49px;cursor:pointer; "></div>               
                
<?php 	foreach ($available_cat_colors as $available_cat_colors):?>
		  	<?php //echo($available_cat_colors->cannonical_name);
			   //if($available_cat_colors->swatchUrl)
			   //{
		   		?>
		   		<div class="color-filter-box" onclick="setcolorfilter('<?php echo($available_cat_colors->id);?>','<?php echo($available_cat_colors->cannonical_name);?>'),set_active()"
		   		style="background-color:<?php echo($available_cat_colors->cannonical_name);?>;"></div>
		 	<?php //} 
 		endforeach;?>
 </fieldset><br/>
 <input class="submit_filter_btn" type="button" value="apply filter" style="margin-left: 53%; " onclick="submit_filter_form()" />   
<fieldset>
                <legend>Size</legend>
<input type="radio" name="size_filter" value="0,Any size" /> Any size <br/>
<div class="brand-filter-box sizebox">
<?php foreach ($available_cat_sizes as $available_cat_sizes):?>
    <input type="radio" name="size_filter" value="<?php echo($available_cat_sizes->id);?>,<?php echo($available_cat_sizes->name);?>" /> <?php echo($available_cat_sizes->name);?>
 <br/>
 <?php endforeach;?>
</div>
 </fieldset>
 
 <br/> 
<input class="submit_filter_btn" type="button" value="apply filter" style="margin-left: 53%; " onclick="submit_filter_form()" />  
 
<div style="border:solid 1px red;">
				<form id="hidden_filter_form" method="get" action="<?php echo base_url();?>product/listing/id<?php echo $cat_id;?>" >
						
						<input id="min_price_input" style="width: 50px" type="text" value=""  name="min_price"  >
						
						<input id="max_price_input" style="width: 80px"  type="text" value="" name="max_price"   >
						
						
						<input id="brand_id_input"  type="text" value="" name="brand_id" placeholder="brand_id" >
						
												<input id="brand_name_input"  type="text" value="" name="brand_name_id" >
						

						
						<input id="size_id"  type="text" value="" name="size_id"  placeholder="size_id">
						<input id="size_name"  type="text" value="" name="size_name" >
						
					
						
						<input id="color_id_input"  type="text" value="" name="color_id"  placeholder="color_id">
						<input id="color_name_input"  type="text" value="" name="color_name" >
						
						
						<input id="on_sale"  type="text" value="FALSE" name="on_sale" >
						
						<input id="price_order"  type="text" value="" name="price_order" >
						
						<button type="submit"> submit</button>
				</form>
</div>