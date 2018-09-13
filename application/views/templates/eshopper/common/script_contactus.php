
	
	<?php $CI =& get_instance();?>

	 
<!--____________________________________/ javascript \____________________________________-->   
	
	
    <script src="<?php echo base_url().'assets/templates/eshopper/js/jquery.js';?>"> </script>
	<script src="<?php echo base_url().'assets/templates/eshopper/js/bootstrap.min.js';?>" ></script>
	<script src="<?php echo base_url().'assets/templates/eshopper/js/jquery.scrollUp.min.js';?>" ></script>
	<script src="<?php echo base_url().'assets/templates/eshopper/js/price-range.js';?>"> </script>
    <script src="<?php echo base_url().'assets/templates/eshopper/js/jquery.prettyPhoto.js';?>"> </script>
    <script src="<?php echo base_url().'assets/templates/eshopper/js/jquery-ui.js';?>" > </script>
    <!-- <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>

<script type="text/javascript" src="<?php echo base_url().'assets/templates/eshopper/js/thumbnailviewer2.js';?>"></script>

<script>



  
	//search autocomplete just text
	/*$("#search").autocomplete
		({
	    	source: '<?php echo(base_url()."product/autocomplete") ; ?>', // path to the autosearch method
	    	//source: 'http://www.usa.com/usa/product/autocomplete', // path to the autosearch method 
	    	minLength: 2
	  	 });*/
	
	//search autocomplete full
	  $("#search").autocomplete({
	   source: '<?php echo(base_url()."product/autocomplete") ; ?>', // path to the autosearch method
	   minLength: 2,
	   // set cursor to wait on input and body 
	   search: function( event, ui ) { $("body").css({'cursor' : 'wait'}); $(this).css({'cursor' : 'wait'});}
	  })
	  .data( "ui-autocomplete" )._renderItem = function( ul, item ) 
	    {
	        // reset cursor to default after search is complete on input and body
	        $("#search").css({'cursor' : 'default'}); 
	        $("body").css({'cursor' : 'default'});
	        var item_img = item.image.sizes.Medium.url;
	        var item_clean_name=convertToSlug(item.name);
	        var item_cat_id = item.categories[0].numId;
	        var inner_html = '<a href="<?php echo(base_url());?>product/search-' + item_clean_name + '-item-'+ item.id +'-cat_id-'+ item_cat_id +'.html"><div class="list_autocomplete"><div class="image_autocomplete"><img src="'+ item_img + '"/></div><div class="label_autocomplete">' + item.name + '</div></div></a>';
	         
	        return $( "<li></li>" )
	            .data( "item.autocomplete", item )
	            .append(inner_html)
	            .appendTo( ul );
	    };

//change language
$(".country_flag").click(function(e) {
	var lang_str_id = this.id;
	var lang_id = lang_str_id.slice(-1);
	
	//alert(lang_id);
	
	//the target (language controller / change_language method)
	var target_url = '<?php echo(base_url()."lng/set_language_id/") ; ?>' + lang_id;
	  	 
	$.ajax(
	{
		url : target_url,
		type: "GET",
		success: function(return_data)
		{
			console.log(return_data);
			location.reload(); 
			
			// refresh page
			//location.reload(); 
		},
		error: function(jqXHR, textStatus, errorThrown)
		{
			console.log('textStatus='+textStatus);
			console.log('errorThrown='+errorThrown);
		}
	});
	
	//var oo = 55 ;
	//oo++;
});

/////
function convertToSlug(Text)
{
    return Text
        .toLowerCase()
        .replace('/ /g','-' )
        .replace(/[^\w-]+/g,'-')
        ;
}
$("#cart_notice").hide();

//demo user 
$( "#x, .coverbox").click(function(e) {
	//prevent other selectors than #x and .coverbox to get selected
	if( e.target !== this ) 
    return;
  	$( ".coverbox" ).fadeOut( 800 , function() {
    // Animation complete.
  });
});


//click on add to cart 
$(document).ready(function(){
	
$('#main-contact-form').validator();
	
	
	
	
navicount=document.getElementById("navicount").innerHTML;
if(navicount){
	toto=document.getElementById("navitop"+navicount).getAttribute( 'name' );
	if(toto=="Bags"||toto=="Shoes"||toto=="Jewelry"||toto=="Beauty Products"||toto=="Men's Fashion"||toto=="Kids' Nursery, Clothes and Toys")
	{
		
		countnavtemp=navicount;
			if(toto=="Beauty Products")
		{
			document.getElementById("navitop"+countnavtemp).innerHTML="Beauty /";
		}
			if(toto=="Kids' Nursery, Clothes and Toys")
		{
			document.getElementById("navitop"+countnavtemp).innerHTML="Kids /";
		}
		
		document.getElementById("navitop"+countnavtemp).style.fontSize = "x-large";
		while(countnavtemp>0)
		{
			countnavtemp--;
			document.getElementById("navitop"+countnavtemp).innerHTML=" ";
			
		}
	}
	else{
		
		countnavtemp2=navicount;
		
		while(countnavtemp2>0)
		{
			countnavtemp2--;
			coco=document.getElementById("navitop"+countnavtemp2).getAttribute( 'name' );
			
			//document.getElementById("catleft"+coco).innerHTML=" ";}
			var element = document.getElementsByName("catleftsisi");
			//getElementsByClassName("example");
			//fofo=document.getElementsByName(element.[0]).getAttribute( 'id' );
			//alert(element.length);
			//element[0].style.color="red";
			//alert(element.textContent);
			element.className += "in";
			if(coco=="Clothes and Shoes"||coco=="Clothing")
			{document.getElementById("navitop"+countnavtemp2).innerHTML=" ";}
			if(coco=="Bags"||coco=="Shoes"||coco=="Jewelry"||coco=="Beauty Products"||coco=="Men's Grooming")
			{
				document.getElementById("navitop2").innerHTML=" ";
			}
			if(coco=="Beauty Products")
			{
				document.getElementById("navitop"+countnavtemp2).innerHTML="Beauty /";
			}
			if(coco=="Kids' Nursery, Clothes and Toys")
			{
				document.getElementById("navitop"+countnavtemp2).innerHTML="Kids /";
			}
			
		}
		
	}
	
}
/*
$(".add-to-cart").click(function()
	{
		
		 //the target (cart controller / add method)
		 var target_url = '<?php echo(base_url()."cart/add") ; ?>';
	  	 
	  	 // somme alers for degbugging 
	  	 //alert( target_url );
	  	 //alert( $(this).attr('id') );
	  	 
	  	// get the product id from the DOM
	  	var prod_id = $(this).attr("id");
	  	var qty = 1;
		var ProductData = {product_id:prod_id,quantity:qty};
		
		
		
		
		$.ajax(
		{
			url : target_url,
			type: "POST",
			data : ProductData,
			success: function(data)
			{
				//alert('product added!\n' + data);
				//$("#cart_notice").show();
				//$("#cart_notice").html(data);
				//setInterval(function(){$("#cart").css()
				//update cart icon Number
				cart = JSON && JSON.parse(data) || $.parseJSON(data);
				
				//alert('there are \n' + cart.num_of_items + ' items in your cart');
				//alert('you r going to pay \n' + cart.total_price + 'dolars today');
				
				//var num_of_items = "<?php echo($this->cart->total_items());?>";
				//setTimeout(function(){    alert('there are \n' + num_of_items + ' items in your cart');$("#cart_num").html("( " + num_of_items + ")");}, 5000);
				//alert('there are \n' + num_of_items + ' items in your cart');
				$("#cart_num").html("( " + cart.num_of_items + " )");
				//document.getElementById("cart").scrollIntoView({block: "end", behavior: "smooth"});
				
				// scroll up to the cart id 
				$('html, body').animate({
			        scrollTop: $("#cart").offset().top
			    }, 1000);
				

		        
		        
		        
		        
		        setTimeout(function ()
		        	{
		        		$("#cart").css("color","#ffffff"); 
		        		setTimeout(function ()
		        			{
		        			   $("#cart").css("color","#FE980F");
		        			   setTimeout(function ()
				        			{
				        			   $("#cart").css("color","#ffffff");
				        			   setTimeout(function ()
					        			{
					        			   $("#cart").css("color","#FE980F");
					        			   setTimeout(function ()
						        			{
						        			   $("#cart").css("color","#ffffff");
						        			   setTimeout(function ()
							        			{
							        			   $("#cart").css("color","#696763"); 
							        			}, 1000);  
						        			}, 1000);   
					        			}, 1000);  
				        			}, 1000); 
		        			}, 1000);
		        	}, 1000);
		        
		        $("#cart").css("color","#696763");
		       

				
			},
			error: function(jqXHR, textStatus, errorThrown)
			{
				$("#cart_notice").show();
				$("#cart_notice").html('<pre><code class="prettyprint">AJAX Request Failed<br/> textStatus='+textStatus+', errorThrown='+errorThrown+'</code></pre>');
			}
		});
		
		
		
		// prevent default
		return false;
	});
*/



}); // end document ready





</script>



<?php 
//update the login menu and cart icon 

//show the nmber of items in the cart
if ($this->cart->total_items() > 0)
{?>
	<script>
	 $("#cart_num").html('( <?php echo($this->cart->total_items());?> )');
	</script> 
<?php 	 
}
?>

<?php 
//if the user is logged hide the login btn
if ($this->session->userdata('user_id'))
{?>
	 <script>
	 $("#login_btn").hide();
	 $("#account_btn").html('<i class="fa fa-user"></i>'+ ' <?php echo($this->session->userdata('usrname'));?>'  );
	 </script> 
<?php 	 
}
//if the user is not logged hide the loginout btn
else
{
	?><script>
	$("#logout_btn").hide(); 
	</script>
<?php 	
}
?>    

<script>
// convert any string to a url friendly string
function convertToSlug(Text)
{
    return Text
        .toLowerCase()
        .replace('/ /g','-' )
        .replace(/[^\w-]+/g,'-')
        ;
}
function gototop(){
	$('html, body').animate({ scrollTop: 0 }, 'slow');
}
function gototoletter(divleter){
	//alert(divleter)
	 $('html,body').animate({
        scrollTop: $(divleter).offset().top},
        'slow');
	//$(document).scrollTo('#divbrandM');
	//document.getElementById('divbrandM').scrollIntoView();
	//window.location.hash = '#divbrandM';
}
 $( document ).ready(function() 
 	{
	 	
	 	
	 	
	 	$("#cart_num").html('( <?php echo($this->cart->total_items());?> )');
	 	// increment the qty and update the price in the row
	 	(function() {

	var img = document.getElementById('my_image');
	
	// Original
	var width, height;
	
	// Display
	var d_width = img.width;
	var d_height = img.height;});											
    	$(".cart_quantity_down").click(function()
		{
			var qty = $(this).next(".cart_quantity_input" ).val();
			if (qty > 1) qty--;
			$(this).next(".cart_quantity_input" ).val(qty);
			//update cart
			var rowid = $(this).parents(".crow").attr('id');
			//$(this).parent().parent().prev().find("p").css( "background", "#f99" );
			var price = document.getElementById("price"+rowid).innerText;
			//price = price.slice(1);
			//price = Number(price);
			//var price = $(this).prev(".cart_price p" ).val();
			//alert(price);
			$(this).parent().parent().next().find("p").text("$"+(price * qty).formatMoney(2,',','.'));
			$(this).next(".cart_total_price" ).val( price * qty );
			
			///// update via 
			var ProductData = {row_id:rowid,quantity:qty};
			var target_url = '<?php echo(base_url()."carta/change_qty/") ; ?>';
			//alert(111);
	  	 	
			$.ajax(
			{
				url : target_url,
				data: ProductData,
				type: "POST",
				success: function(data)
				{
					cart = JSON && JSON.parse(data) || $.parseJSON(data);
					
					var price_n_fees = cart.prices;
					
					$("#sub_total").html("$"+price_n_fees.total_price.formatMoney(2,',','.'));
					$("#shipping_fee").html("$"+price_n_fees.shipping_fee);
					$("#service_fee").html("$"+price_n_fees.service_fee.formatMoney(2,',','.'));
					$("#custom_fee").html("$"+price_n_fees.custom_fees.formatMoney(2,',','.'));
					$("#grand_total").html("$"+price_n_fees.grand_total.formatMoney(2,',','.'));
					
					
					
					$("#cart_num").html("( " + cart.num_of_items + " )");
					 document.getElementById("cart").href="<?php echo base_url();?>carta/details";
					
					// scroll up to the cart id 
					$('html, body').animate({
				        scrollTop: $("#cart").offset().top
				    }, 1000);
					
    
			        // make the cart flash for 3 times
			        setTimeout(function ()
			        	{
			        		$("#cart").css("color","#ffffff"); 
			        		setTimeout(function ()
			        			{
			        			   $("#cart").css("color","#FE980F");
			        			   setTimeout(function ()
					        			{
					        			   $("#cart").css("color","#ffffff");
					        			   setTimeout(function ()
						        			{
						        			   $("#cart").css("color","#FE980F");
						        			   setTimeout(function ()
							        			{
							        			   $("#cart").css("color","#ffffff");
							        			   setTimeout(function ()
								        			{
								        			   $("#cart").css("color","#696763"); 
								        			}, 1000);  
							        			}, 1000);   
						        			}, 1000);  
					        			}, 1000); 
			        			}, 1000);
			        	}, 1000);
			        
			        $("#cart").css("color","#696763");
							
					// refresh page
					//location.reload(); 
				},
				error: function(jqXHR, textStatus, errorThrown)
				{
					console.log('textStatus='+textStatus);
					console.log('errorThrown='+errorThrown);
				}
			});
			//location.reload();
				
		});
		Number.prototype.formatMoney = function(decPlaces, thouSeparator, decSeparator) {
    var n = this,
        decPlaces = isNaN(decPlaces = Math.abs(decPlaces)) ? 2 : decPlaces,
        decSeparator = decSeparator == undefined ? "." : decSeparator,
        thouSeparator = thouSeparator == undefined ? "," : thouSeparator,
        sign = n < 0 ? "-" : "",
        i = parseInt(n = Math.abs(+n || 0).toFixed(decPlaces)) + "",
        j = (j = i.length) > 3 ? j % 3 : 0;
    return sign + (j ? i.substr(0, j) + thouSeparator : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thouSeparator) + (decPlaces ? decSeparator + Math.abs(n - i).toFixed(decPlaces).slice(2) : "");
};
		// increment the qty and update the price in the row
		$(".cart_quantity_up").click(function()
		{
			//;
			var qty = $(this).prev(".cart_quantity_input" ).val();
			 qty++;
			$(this).prev(".cart_quantity_input" ).val(qty);
			//$(this).parent().parent().prev().find("p").css( "background", "#41f81b" );
			//var price = $(this).parent().parent().prev().find("p").text();
			//get rid of currency sign
			var rowid = $(this).parents(".crow").attr('id');
			var price = document.getElementById("price"+rowid).innerText;
			//price = price.slice(1);
			//price = Number(price);
			//var price = $(this).prev(".cart_price p" ).val();
			//price=parseFloat(price);
			//alert(price);
			 //$(this).parent().parent().next().find("p").css( "background", "#aa5ab8" );
			 $(this).parent().parent().next().find("p").text("$"+(price * qty).formatMoney(2,',','.'));
			$(this).next(".cart_total_price" ).val( price * qty );
			//updating the cart 
			
			
			//alert(rowid);
			//alert(qty);
			
			///// update via 
			var ProductData = {row_id:rowid,quantity:qty};
			var target_url = '<?php echo(base_url()."carta/change_qty/") ; ?>';
	  	 	
			$.ajax(
			{
				url : target_url,
				data: ProductData,
				type: "POST",
				success: function(data)
				{
					
					cart = JSON && JSON.parse(data) || $.parseJSON(data);
					
					var price_n_fees = cart.prices;
					
					$("#sub_total").html("$"+price_n_fees.total_price.formatMoney(2,',','.'));
					$("#shipping_fee").html("$"+price_n_fees.shipping_fee);
					$("#service_fee").html("$"+price_n_fees.service_fee.formatMoney(2,',','.'));
					$("#custom_fee").html("$"+price_n_fees.custom_fees.formatMoney(2,',','.'));
					$("#grand_total").html("$"+price_n_fees.grand_total.formatMoney(2,',','.'));
					
					
					$("#cart_num").html("( " + cart.num_of_items + " )");
					 document.getElementById("cart").href="<?php echo base_url();?>carta/details";
					
					// scroll up to the cart id 
					$('html, body').animate({
				        scrollTop: $("#cart").offset().top
				    }, 1000);
					
			        // make the cart flash for 3 times
			        setTimeout(function ()
			        	{
			        		$("#cart").css("color","#ffffff"); 
			        		setTimeout(function ()
			        			{
			        			   $("#cart").css("color","#FE980F");
			        			   setTimeout(function ()
					        			{
					        			   $("#cart").css("color","#ffffff");
					        			   setTimeout(function ()
						        			{
						        			   $("#cart").css("color","#FE980F");
						        			   setTimeout(function ()
							        			{
							        			   $("#cart").css("color","#ffffff");
							        			   setTimeout(function ()
								        			{
								        			   $("#cart").css("color","#696763"); 
								        			}, 1000);  
							        			}, 1000);   
						        			}, 1000);  
					        			}, 1000); 
			        			}, 1000);
			        	}, 1000);
			        
			        $("#cart").css("color","#696763");
					
					
					// refresh page
					//location.reload(); 
				},
				error: function(jqXHR, textStatus, errorThrown)
				{
					console.log('textStatus='+textStatus);
					console.log('errorThrown='+errorThrown);
				}
			});
			//location.reload();	
		});
		//delete product = delete row + remove productfrom the cart in the session 
		$(".cart_quantity_delete").click(function()
		{ 
			alert("1111ok ok ok ");
			$(this).parents(".crow").css( "background", "#ffc4c4" );
			$(this).parents(".crow").fadeOut( 1000 , function() { /*fade complete.*/  });
			//$(this).remove();
			
			///////////// ajax cart update below
			
					 //the target (cart controller / add method)
					 var target_url = '<?php echo(base_url()."carta/remove") ; ?>';
				  	 				  	 
				  	// get the product id from the DOM
					var row_id = $(this).parents(".crow").attr('id');
					//alert(row_id);
				  	//var qty = 1;
				  	// must work on product size and color //////////////////////////////
					var ProductData = {r_id:row_id,quantity:0};
					
					$.ajax(
					{
						url : target_url,
						type: "POST",
						cache: false,
						data : ProductData,
						success: function(data)
						{
							//update the cart icon
							cart = JSON && JSON.parse(data) || $.parseJSON(data);
							//alert(cart.num_of_items);
							var num_items = "( "+ cart.num_of_items + " )";
							$("#cart_num").html(num_items);
							//var num_items = $('.crow').length-1;
							//$("#cart_num").text(num_items);
							
							//alert('product deleted!\n' + data);
							//cart = JSON && JSON.parse(data) || $.parseJSON(data);
							//alert('there are \n' + cart.num_of_items + ' items in your cart');
						},
						error: function(jqXHR, textStatus, errorThrown)
						{
							//  to do
							//$("#cart_notice").show();
							//$("#cart_notice").html('<pre><code class="prettyprint">AJAX Request Failed<br/> textStatus='+textStatus+', errorThrown='+errorThrown+'</code></pre>');
						}
					});
			//////////// end ajax cart update
			//location.reload();
			// prevent default
			return false; 
		});
		
		// load brands via ajax
		$("#more_brnds").bind("click",function()
		{
			//alert("you requested morebrandsm here u go ..");
			$(".coverbox").show();
			//
			var target_url = '<?php echo(base_url()."brands/all") ; ?>';
			$.ajax
			(
			{
				url : target_url,
				type: "POST",
				cache: false,
				success: function(data)
				{
					//alert(data);
					
					//brands = Array();
					brands = JSON && JSON.parse(data) || $.parseJSON(data);
					$("#brands_box").empty();
					$("#brands_box").append("<ul>");
					for(var i = 0; i < brands.length; i++) 
					{
						//$("#brands_box").append('<li id="'+brands[i].id+'" >'+brands[i].name+'</li>' ) ;
						$("#brands_box").append('<li id="'+brands[i].id+'" ><a href='+convertToSlug(brands[i].name)+'_brnid_'+brands[i].id+'>'+brands[i].name+'</a></li>' ) ;
					}
					$("#brands_box").append("</ul>");
				
				},
				error: function(jqXHR, textStatus, errorThrown)
				{
					alert("error during loading brands");
				}
			});
			
			//
			
		});// endload brands via ajax
		
		//search autocomplete
		$("#search").autocomplete
		({
	    	source: '<?php echo(base_url()."product/autosearch") ; ?>', // path to the autosearch method
	    	minLength: 2
	  	 });
	  	 
	  	 
	  	 
	  	$("#promo_code_btn").click(function()
		{ 
			var promotion_code = $("#promo_code_field").val();
		
			if(promotion_code)
			{
				//show the spinning wheel while processing
				$("#loadingDiv").css("display", "block");
				//hide the message box
				$("#message_box").css("background-color", "#FFE6E6");
				$("#message_box").hide();
				
				var DataPromotion = {promotion_code_value:promotion_code};
				//
				var target_url = '<?php echo(base_url()."carta/apply_code") ; ?>';
				$.ajax
				(
					{
						url : target_url,
						type: "POST",
						cache: false,
						data:DataPromotion,
						success: function(data)
						{
							//parse json data
							data = JSON && JSON.parse(data) || $.parseJSON(data);
							
							$("#loadingDiv").css("display", "none");
							if(data == "empty")
							{
								// no promotion code was entred 
							}
							if(data == "not_valid")
							{
								// no valid code entered
								$("#message_box").show();
								$("#message_box").html("<strong>code not valid</storng>");
								//alert("not_valid");
							}
							if(data == "expired")
							{
								// the code entered was expired 
								$("#message_box").show();
								$("#message_box").html("<strong>this code has expired!</storng>");
							}
							if(data == "empty_cart")
							{
								// the cart is empty (or session expired) 
								//refresh page
								location.reload();
							}
							if(data == "price_trigger_not_reached")
							{
								// the cart order subtotal did not reach the minimum price for this code
								$("#message_box").show();
								$("#message_box").html("<strong>your subtotal is not enough to use this promotional code!</storng>");
							}
							if(data == null)
							{
								// no operation (nop)
							}
							// check if data.total_price exists
							if(!(typeof data.total_price === 'undefined'))
							{
								//show message box with green bgrnd
								$("#message_box").css("background-color", "#DCFFDC");
								$("#message_box").show();
								$("#message_box").html("<strong>code applied</storng>");
								
								var price_n_fees = data;
								
								//alert(price_n_fees.total_price);
								
								$("#sub_total").html("$"+price_n_fees.total_price.formatMoney(2,',','.'));
								$("#shipping_fee").html("$"+price_n_fees.shipping_fee);
								$("#service_fee").html("$"+price_n_fees.service_fee.formatMoney(2,',','.'));
								$("#custom_fee").html("$"+price_n_fees.custom_fees.formatMoney(2,',','.'));
								$("#grand_total").html("$"+price_n_fees.grand_total.formatMoney(2,',','.')+"(saving =$"+ price_n_fees.saving.formatMoney(2,',','.') +")");
							}
							//alert(data);
						
						
						},
						error: function(jqXHR, textStatus, errorThrown)
						{
							//$("#loadingDiv").css("display", "none");
							alert("error during loading brands");
						}
					}
				);
			}
			
		});
	  	 
	  	 
		//do something else now here
	
	$(".tooltip").show();
	
		
 	});


// to escape special characters see  http://stackoverflow.com/a/9310752/1636522
RegExp.escape = function (text) {
    return text.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, '\\$&');
};


// for highlighting the text that was typed
/*window.addEventListener('load', function () {
    var rtrim = /^ +| +$/g, rsplit = /(\\ )+/g;
    var wrapper = '<span style="color:red">$&</span>';
    var input = document.getElementById('term');
    var list = document.getElementById('ul-id');
    var items = list.getElementsByTagName('li');
    var l = items.length;
    var source = Array.prototype.map.call(
        items, function (li) { return li.textContent; }
    );
    var delay = function (fn, ms) {
        var id, scope, args;
        return function () {
            scope = this;
            args = arguments;
            id && clearTimeout(id);
            id = setTimeout(function () { 
                fn.apply(scope, args); 
            }, ms);
        };
    };
    term.addEventListener('keyup', delay(function () {
        var i;
        var val = RegExp.escape(this.value.replace(rtrim, ''));
        var re = new RegExp(val.replace(rsplit, '|'), 'g');
        for (i = 0; i < l; i++) {
            items[i].innerHTML = source[i].replace(re, wrapper);
        }
    }, 500));
});*/

// loading logo while ajax is fetching data
//$('#loading').hide().ajaxStart(function(){$(this).show();}).ajaxStop(function() {$(this).hide();});

</script>



<?php // if ($this->cart->total_items() > 0): ?>
<script>
$(document).ready(function()
{
		// update cart information every 5 seconds
		//setInterval(update_cart_details, 5000);
		
		//update cart on hover
		$('#cart').hover(update_cart_details);
		
		function update_cart_details()
		{
			
			// get the cart details 	
			var target_url = '<?php echo(base_url()."carta/info") ; ?>';
			$.ajax
			(
			{ 
				url : target_url,
				type: "POST",
				cache: false,
				success: function(data)
					{
						jstring = JSON && JSON.parse(data) || $.parseJSON(data);
						console.log(data);
						console.log(jstring);
						alert(data);
					
			        $("#cart_preview ul").html("");
			        var i = 0 ; // number of items in the cart
			        var price = 0 ;
			        var currency = "<?php echo $CURRENCY ?>";		
			        var rate = "<?php echo $RATE ?>";		
					for (var key in jstring) 
					{
					  if (jstring.hasOwnProperty(key)) 
					  {
					    node0 = jstring[key] 
					    for (var key2 in node0) 
					    	{
							  if (node0.hasOwnProperty(key2)) 
							  {
							    i++;
							    //alert(key2 + " -> " + node0[key2]);
							    node1 = node0[key2] 
							    //alert(node1[key3]);
							    for (var key3 in node1) 
							    	{
									  if (node1.hasOwnProperty(key3)) 
									  {
									    
									   //alert(key3 + " -> " + node1[key3]);
									    if(key3 == "thumbnail")
									    {
									    	//var image_html = ;
									    	//alert(image_html);
									    	if(node1[key3] != ""){
												
									    	$("#cart_preview ul").append('<img src="' + node1[key3] + '" alt="thumbnail" > ' );
											}
									    	//alert(node1[key3]);
										} 
									    if(key3 == "name")
									    {
									    	// add name to the preview
									    	
									    	$("#cart_preview ul").append("<li>"+node1[key3]+"</li>");
									    	
									    	//alert(node1[key3]);
										}  
										if(key3 == "price")
									    {
									    	//add price to preview
									    	
												
									    	$("#cart_preview ul").append("<li> Price : "+currency+" "+rate*node1[key3]+"<li>");
									    	//alert(node1[key3]);
									    	price += parseInt(node1[key3]);
											
										}
										if(key3 == "id")
									    {
									    	
									    	var target_url_remove_item = '<?php echo base_url()."cart/remove_item/" ; ?>';
									    	var remove_item_url = '<a  class="remove_itm" id ="'+key2+'" href="'+target_url_remove_item+key2+'" > remove </a> ';
									    	$("#cart_preview ul").append(remove_item_url);
										}
									  	
									  }
									}
							    
							  }
							}
					  }
					}
					
					//alert("i = " + i );
					//alert("price = " + price );
					
					//add total cart price if number of items > 0  
					if(i > 0)
					{
					$("#cart_preview ul").append("<li> TOTAL: "+currency+" "+rate*price+"<li>");
						
					}
					
					// update the number on the cart icon
					$("#cart_num").html("( " + i + " )");
				},
				error: function(jqXHR, textStatus, errorThrown)
				{
					console.log("error while getting cart data from the server ");
				}
			});
		
		}
});		
</script>
<?php //endif ; ?>

<script>
	function eraseCookie(name) {
		
    createCookie(name,"",-1);
    
}
	function createCookie(name,value,days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
        
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/";
}
        function readCookie(name) 
        {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }
        
        function clearfilters()
        {
			//clear form cookies
			document.cookie = "min_price= null; path=/;";
			document.cookie = "max_price= null; path=/;";
			document.cookie = "brand_id= null; path=/;";
			document.cookie = "color_id= null; path=/;";
			document.cookie = "size_id= null; path=/;";
			document.cookie = "size_name= null; path=/;";
			document.cookie = "color_name= null; path=/;";
			document.cookie = "brand_name_id= null; path=/;";
			
			// clear all form
			$("#min_price_input").val(0);
			$("#min_price").text('min: 0'); 
			
			$("#max_price_input").val(0);
			$("#max_price").text('max: no limit');
			
			$("#brand_id_input").val(0);
			$("#brand_id").text('any brand');
			
			$("#color_id_input").val(0);
			$("#color_id").text('any color');
			
			$("#size_id").val(0);
			$("#size_name_div").text('any size');
			
			
			document.getElementById("hidden_filter_form").submit();
			
			//document.getElementById("size_name_div_d").style.display = 'block';
			
			
			//don't refresh the page redirect instead us baseurl ...etc 
			//location.reload();	
	}
	function submit_filter_form()
	{
		document.getElementById("hidden_filter_form").submit();
	}
	function set_active()
	{
		;
		//$('color-filter-box').css("border","none");
		$( this ).css( "background-color", "yellow" );
	}
	
	
$(document).ready(function(){
	
				//;
				// read cookies
				var cookie_min_price = readCookie("min_price");
				var cookie_max_price = readCookie("max_price");
				var cookie_brand_id  = readCookie("brand_id");
				var cookie_color_id  = readCookie("color_id");
				if (cookie_min_price == 0 ) 		cookie_min_price = "0";
				if (cookie_max_price >= 100000000 ) cookie_max_price = "100000000";
				var cookie_size_id  = readCookie("size_id");
				var cookie_size_name  = readCookie("size_name");
				
				//alert( $.cookie("min_price") );
					var cookie_brand_name_id  = readCookie("brand_name_id");
					var cookie_color_name  = readCookie("color_name");
				//set the input value from the cookies	
				$("#min_price_input").val(cookie_min_price);
				$("#min_price").text('min: '+cookie_min_price); 
				$("#max_price_input").val(cookie_max_price);
				$("#max_price").text('max: '+cookie_max_price);
				$("#brand_id_input").val(cookie_brand_id);
				if(cookie_brand_name_id!=null){
				$("#brand_id").text(cookie_brand_name_id);
				document.getElementById("brand_id_d").style.display = 'block';
				}
				$("#color_id_input").val(cookie_color_id);
				if(cookie_color_name!=null){
				$("#color_id").text(cookie_color_name);
				document.getElementById("color_id_d").style.display = 'block';
				}
				$("#size_id").val(cookie_size_id);
				if(cookie_size_name!=null){
				$("#size_name_div").text(cookie_size_name);
				document.getElementById("size_name_div_d").style.display = 'block';
				}
				
				// it goes like this  : select the class brandbox ( i added it to the div in price_filter) then the input child with the value that
				// equals the id of the cookie and then make it checked / active / whatever 
				
				// this is just a test line to make sure selector is set properly 
				//$(".brandbox").css("background-color","pink");
				
				$('.brandbox :input[value="'+cookie_brand_id+'"]').attr('checked', 'checked');
				
				// do the same thing for sizes and the same technique for color_id except its not an input but a div    
				
	
	

	/*$(".remove").click(function(){
		alert(11);
		//var row_id = $(this).attr("id");
		//alert(row_id);
		//remove_cart_item(row_id);
		
		//prevent default
		return false;
		
	});*/
	function remove_itm(){
		alert(11);
		console.log("removing item ... ");
		return false;
	}
	
	function remove_cart_item(row_id)
	{
		///////////// ajax cart update below
		
		var target_url = '<?php echo(base_url()."cart/remove") ; ?>';
		 				  	 
		var ProductData = {r_id:row_id,quantity:0};
		
		$.ajax(
		{
			url : target_url,
			type: "POST",
			cache: false,
			data : ProductData,
			success: function(data)
			{
				//update the cart icon
				cart = JSON && JSON.parse(data) || $.parseJSON(data);
				//alert(cart.num_of_items);
				var num_items = "( "+ cart.num_of_items + " )";
				$("#cart_num").html(num_items);
			},
			error: function(jqXHR, textStatus, errorThrown)
			{
				//  to do
				//$("#cart_notice").show();
				//$("#cart_notice").html('<pre><code class="prettyprint">AJAX Request Failed<br/> textStatus='+textStatus+', errorThrown='+errorThrown+'</code></pre>');
			}
		});
		//////////// end ajax cart update
	}
	

	
	
	
});


/// update customer

$("#update_btn").click(function()
	{
		
		var target_url = '<?php echo(base_url()."customer/update") ; ?>'; // the script where you handle the form input.
		var form_data = $("#my_account").serialize();
		$('#saving_box').show();
		$.ajax(
		{
			url : target_url,
			data: form_data,
			type: "POST",
			success: function(return_data)
			{
				//alert(return_data)
				$('#saving_box').fadeOut(500);
				//console.log(return_data);
				
				// refresh page
				//location.reload(); 
			},
			error: function(jqXHR, textStatus, errorThrown)
			{
				console.log('textStatus='+textStatus);
				console.log('errorThrown='+errorThrown);
			}
		});
		
		// prevent default
		return false;
	});




</script>

<?php include "script_qcart.php"; ?>

<?php include "script_email_collector.php"; ?>


<script src="<?php echo base_url().'assets/templates/eshopper/js/main.js';?>" > </script>


</body>
</html>