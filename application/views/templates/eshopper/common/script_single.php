<!--____________________________________/ javascript \____________________________________-->   
	
	
 	<!--   <script src="<?php echo base_url().'assets/templates/eshopper/js/jquery.js';?>"> </script>-->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"> </script>
	<script src="<?php echo base_url().'assets/templates/eshopper/js/bootstrap.min.js';?>" ></script>
	<script src="<?php echo base_url().'assets/templates/eshopper/js/jquery.scrollUp.min.js';?>" ></script>
	<script src="<?php echo base_url().'assets/templates/eshopper/js/price-range.js';?>"> </script>
    <script src="<?php echo base_url().'assets/templates/eshopper/js/jquery.prettyPhoto.js';?>"> </script>
    <script src="<?php echo base_url().'assets/templates/eshopper/js/main.js';?>" > </script>
    <script src="<?php echo base_url().'assets/templates/eshopper/js/jquery-ui.js';?>" > </script>
    <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>-->
	    
    <!--magic zoom plus -->
    <script src="<?php echo base_url().'assets/templates/eshopper/magiczoomplus/magiczoomplus.js';?>" > </script>
    
    <!--thumbnail silder-->
    <script src="<?php echo base_url().'assets/templates/eshopper/thumbnailslider/1/thumbnail-slider.js';?>" > </script>
  
    <!--opentip tooltip-->
    <script src="<?php echo base_url().'assets/templates/eshopper/opentip/opentip-jquery.js';?>" > </script>
    
<?php

//pass variable from php to javascript 
echo '<script>var stock_matrix = '.$stock_matrix. ';</script>'; 
echo '<script>var currency_backend = '.$currency. ';</script>'; 
echo '<script>var rate_backend = '.$rate. ';</script>'; 
echo '<script>var click_to_expand  = "'.$words["click_to_expand"]. '"; </script>'; 
echo '<script>var hover_to_zoom  = "'.$words["hover_to_zoom"]. '"; </script>'; 
echo '<script>var category_id = '.$cat_id. ';</script>'; 
echo '<script>var product_is_in_stock = '.$in_stock. ';</script>'; 
?>

<script>





//~~ magic zoom options
var mzOptions = {
  //cssClass: "thmbnail_selector",
  variableZoom: true,
  upscale: false,
  textHoverZoomHint: hover_to_zoom,  // working fine
  textExpandHint: click_to_expand, // <----why this is not working ? 
  selectorTrigger: "hover"
};

//-------------------------------------------------------------------------------

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


 $( document ).ready(function() 
	 	{
	 		$('.black-single-text').click(function(){
	 			var ff = $("#foo").attr('src');
	 			//alert(ff);
	 			
	 		});
	 		
	 		/*$("#foo").html('something').triggerHandler('customAction');*/


			$('#content').unbind().bind('customAction', function(event, data) {
			   //Custom-action
			});
					 	
			  //console.log( "ready!" );

			//globals
			var has_color_option = has_size_option = false;
			var color_is_set = size_is_set = false;
			var color_image = false;
			var cart_color_image = cart_color_name = cart_size_name = "";



			//~~ hover the color or image swtach - when hover is in do change the main image , when hover is out do put back the previous image
			var main_image="";
			$('.swatch_img, .swatch_color_box').hover(
			function(e) // function in 
			{
					
				var color_name = $(this).attr('title');
				var color_image_preview = $(this).attr('data-image');
				$('#colorname_hint').html(color_name);
				//get main image and save it to restore it in the hover out function 
				main_image = $('figure img').attr('src');
				//console.log("main_image : "+main_image);
				//change main image	in zoom
				$('figure img').attr({src: color_image_preview,href:color_image_preview});
				$('#Zoom-1').attr({href:color_image_preview});
				$('.magic-hidden-wrapper img').attr({src:color_image_preview});
				
			},function(e) // function out 
			{
				$('#colorname_hint').html("");
				
				//change back the main image in zoom
				$('figure img').attr({src: main_image,href:main_image});
				$('#Zoom-1').attr({href:main_image});
				$('.magic-hidden-wrapper img').attr({src:main_image});
				
			});

			//~~ click the color or image swtach - change the main image and let it be
			$('.swatch_img, .swatch_color_box').click(function(e) 
			{
				color_is_set = true;
				var color_name = $(this).attr('title');
				color_image = $(this).attr('data-image');
				$('#colorname_hint').html(color_name);
				//get main image and save it to restore it in the hover out function 
				main_image = $('figure img').attr('src');
				//change main image	in zoom
				$('figure img').attr({src: color_image,href:color_image});
				$('#Zoom-1').attr({href:color_image});
				$('.magic-hidden-wrapper img').attr({src:color_image});
				
				//we need those for the cart
				cart_color_name  = color_name;
				if(color_image)
				cart_color_image = color_image;
			});




			//~~ click the color or image swtach - do the matrix thing (color x size)
			$('.swatch_img, .swatch_color_box').click(function(e) 
			{
				//desactivate all size boxes
				//$('.sizebox_single').css("background-color","red");
				// flag them all as out of stock
				$('.sizebox_single').removeClass("in_stock");
				$('.sizebox_single').addClass("out_of_stock");
				
				
				//read the id from the clicked color swatch
				swatch_color_id = $(this).attr('id');

				//for each row in StockMatrix check if the swatch_img id == key (left side of the key befor ~)
				$.each(stock_matrix, function(key, value) 
				{
					//split the key into 2 elements	via regex 
					///// start regex /////
					var re = /(.+)~(.+)/; 
				    var str = key; // someting like 'b1d5781111d84f7b3fe45a0852e59758cd7a87e5~615a4f6f9a7ff27fbd2c54a60fb194d2ad62b0a0';
				    var matches; // we are interested in matches[1] and matches[2] 
				     
				    if ((matches = re.exec(str)) !== null) {
				        if (matches.index === re.lastIndex) {
				            re.lastIndex++;
				        }
				        // View results using the matches-variable.
				        // eg matches[0] matches[1] etc.
				    }
					///// end regex //////
					
					if(swatch_color_id == matches[1]) 
					{
						// activate the size box element with id = matches[2]
						//$('#'+matches[2]).css("background-color","green");
						//document.getElementsByClassName("sizebox").className = "";
						
						//$('.sizebox_single').toggleClass( "out_of_stock" );
						
						
						$('#'+matches[2]).removeClass("out_of_stock");
						$('#'+matches[2]).addClass("in_stock");
						
						//$('#'+matches[2]).removeClass("out_of_stock");
					}
					//alert(key + "---->"+value);
				});
			});
			// end swatch_img click do the matrix thing

			//~~ click pcolorbox - make it highlighted an unhilight the others
			$('.pcolorbox').click(function(e) 
			{
				//var unique_id = $(this).attr('id');
				$('.pcolorbox').css('border-bottom', "none");
				$(this).css('border-bottom', "2px solid");
				// unhighlight the size boxes  and set the size_is_set to false
				$('.psizebox').css('border-bottom', "none");
				size_is_set = false;
				
			});

			//~~ click psizebox - make it highlighted an unhilight the others
			$('.psizebox').click(
			function(e) // function in 
			{
				// check if it is out of stock
				var not_in_stock = $(this).children('.sizebox_single').hasClass('out_of_stock') ; 
				if(not_in_stock)
				{
					//alert("this size is not available in the selected color ,please choose another color !")
					$("#snafsc").fadeIn();
					$("#curtain").show();
				}
				else
				{
					$('.psizebox').css('border-bottom', "none");
					$(this).css('border-bottom', "2px solid");
					size_is_set = true;
					
				}
				
			});
			
			//we need this for the cart
			$('.sizebox_single').click(function(e){
			
				cart_size_name = $(this).text();
				//alert(cart_size_name);
				
			});

			//~~ check if swatch_color is visible
			if($('.swatch_color_box').is(':visible')) 
			{
				var n = 0;
				//get the number of occurence
				n = $( ".swatch_color_box" ).length;
		    	if (n>0)
		    	{
		    		has_color_option = true;
		    		//alert("swatch_color_box is visible and is more than 1 option");
				}
				else
		    	{
					//$( ".color_section" ).hide();
				}
			}
			//same as previous but swatch image
			if($('.swatch_img').is(':visible')) 
			{
		    	var n = 0;
				//get the number of occurence
		    	n = $( ".swatch_img" ).length;
		    	if (n>0) 
		    	{
			    	has_color_option = true;
		    		//alert("swatch_img is visible and is more than 1 option");
				}
				else
		    	{
					//$( ".color_section" ).hide();
				}
			}
			
			//~~ check if sizebox is visible
			if($('.sizebox_single').is(':visible')) 
			{
		    	var n = 0;
				//get the number of occurence
				n = $( ".sizebox_single" ).length;
		    	if (n>0) 
		    	{
		    		has_size_option = true;
		    		//alert("sizebox is visible and is more than 1 option");
		    	}
		    	else
		    	{
					//$( ".size_section" ).hide();
				}
		    	
			}
			
			
			function can_add()
			{
				can_add_to_cart = 0; //false
				
				if(!has_color_option && !has_size_option )
				can_add_to_cart = 1; //true
				
				if(has_color_option && has_size_option && color_is_set && size_is_set )
				can_add_to_cart = 1; //true
				
				if(has_color_option && !has_size_option && color_is_set )
				can_add_to_cart = 1; //true
				
				if(!has_color_option && has_size_option && size_is_set )
				can_add_to_cart = 1; //true
				
				
				
				return	can_add_to_cart;
			
			}
			
			function check_stock()
			{
				var res = 1; //true
				
				if(product_is_in_stock == 0)
				res = 0; //false
				
				return	res;
					
				
			}
			
			/*$('.home-text').click(function(e) 
			{
				var flag = can_add();
				alert(flag);
			});*/
				
			
				
		 	/////////////////////-------------------------------------------------------------------------------------------------
		 	if (!document.getElementById('color_flag'))
			{
    		//alert('Does not exist!');
			}
		 	else{
		 	var colorboxalt = document.getElementById("color_flag").innerHTML;
		 	if(colorboxalt)
		 	{
			 	
			 	document.getElementsByName("add-to-cart").bgcolor='#f00';
			 	 $("[name='add-to-cart']").attr("disabled", "disabled");
			 	
			 	//alert(toto);
		 	}
		 	}
		 	if (!document.getElementById('size_flag')){
    		//alert('Does not exist!');
}
		 	else{
		 	var colorboxalt = document.getElementById("size_flag").innerHTML;
		 	if(colorboxalt)
		 	{
			 	
			 	document.getElementsByName("add-to-cart").bgcolor='#f00';
			 	 $("[name='add-to-cart']").attr("disabled", "disabled");
			 	
			 	//alert(toto);
		 	}
		 	}
		 	
			$("#snafsc_ok").click(function()
			{
				$("#curtain").hide();
				$("#snafsc").fadeOut();
					
			});
			
			$("#pacoas_ok").click(function()
			{
				$("#curtain").hide();
				$("#pacoas").fadeOut();
					
			});
			
			
			
			///////////// start testing new add button
			// add to cart via ajax 
			$("#add_to_cart_btn").click(function()
			{
			
			var in_stock = check_stock();
			if(in_stock)
			{
			 	
				 //if the color and size are selected we can add to the cart else we inform user that he must pick a size/color 
				 var color_size_selected = can_add();
				 
				 if	(color_size_selected)
				 {
					 //alert("adding...")
					 var prod_id = parseInt("<?php echo($product_details->id) ?>") ;
					 
					 //the target (cart controller / add method)
					 var target_url = '<?php echo(base_url()."carta/add") ; ?>';
				  	 
				  	 // somme alers for degbugging 
				  	 //alert( target_url );
				  	 //alert( $(this).attr('id') );
				  	 
				  	// get the product id from the DOM
				  	//var prod_id = $(this).attr("id");
				  	//var qty = $("#qty").val();
				  	//var color__id = $("#color_id").val();
				  	//var size__id = $("#size_id").val();
				  	//----------------------------------------- testing values --------------------------------
				  //	alert(1);
				  	var prod_id = prod_id;
				  	//var qty = 1;
				  	//var color__name = 'red suede__408206C20006339';
				  	//var size__name = '34.5 = 4.5 US';
				  	var qty = $("#qty").val();
				  	var color__name = $("#color_id").val();
				  	var size__name = $("#size_id").val();
				  //	alert(qty);
				  //	alert(color__id);
				  //	alert(size__id);
				  	//alert(target_url);
				  	//cart_color_image / cart_color_name / cart_size_name 
					var ProductData = 
					{
						product_id:prod_id,
						cat_id:category_id,
						quantity:qty,
						color_name:cart_color_name,
						color_image:cart_color_image,
						size_name:cart_size_name
						
					};
					
					 $('html, body').css("cursor", "wait");
					 $('#add_to_cart_btn').hide();

					
					
					$.ajax(
					{
						
						url : target_url,
						type: "GET",
						data : ProductData,
						success: function(data)
						{
							
							$('html, body').css("cursor", "auto");
							$('#add_to_cart_btn').show();
							$('#cart_quickview').fadeIn();
							
							//append item to the car quick_view box 
							
							
							//alert (prod_id);
							//alert('product added!\n' + data);
							//$("#cart_notice").show();
							//$("#cart_notice").html(data);
							//setInterval(function(){$("#cart").css()
							//update cart icon Number
							
							//alert(data);
							
							//parse the json file 
							cart = JSON && JSON.parse(data) || $.parseJSON(data);
							
							//empty the cart quickview and fill it with the new data
							$("#cart_quickview").empty();
							$("#cart_quickview").append(cart.cart_qview);
							
							var num_of_items = cart.num_of_items ;
							$oo= 55;
							//alert('there are \n' + cart.num_of_items + ' items in your cart');
							//alert('you r going to pay \n' + cart.total_price + 'dolars today');
							
							//var num_of_items = "<?php echo($this->cart->total_items());?>";
							//setTimeout(function(){    alert('there are \n' + num_of_items + ' items in your cart');$("#cart_num").html("( " + num_of_items + ")");}, 5000);
							//alert('there are \n' + num_of_items + ' items in your cart');
							$("#cart_num").html("( " + cart.num_of_items + " )");
							 document.getElementById("cart").href="<?php echo base_url();?>carta/details";
							
							//document.getElementById("cart").scrollIntoView({block: "end", behavior: "smooth"});
							
							// scroll up to the cart id 
							$('html, body').animate({
						        scrollTop: $("#cart").offset().top
						    }, 1000);
							
					        
					        /*setTimeout(function ()
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
					        
					        $("#cart").css("color","#696763");*/
					        
					         $('#cart_icon').removeClass().addClass('bounce' + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function()
								{
					      			$(this).removeClass();
					    			
					    		});
					       
							
						},
							error: function(jqXHR, textStatus, errorThrown)
							{
								$('html, body').css("cursor", "auto");
								$('#add_to_cart_btn').show();
								$("#cart_notice").show();
								$("#cart_notice").html('<pre><code class="prettyprint">AJAX Request Failed<br/> textStatus='+textStatus+', errorThrown='+errorThrown+'</code></pre>');
							}
					});
						// prevent default
						return false;
						
						
				}
				else
				{
					//alert("please pick a color and or a size");
					$('#curtain').show();
					$('#pacoas').fadeIn();
					
				}
			}
			// prevent default
			return false;
		});
		///////////// end testing 
		
		 	//alert( <?php echo($this->cart->total_items());?>);
			// add to cart via ajax 
			//old should be deleted 
			$(".add-to-carttttttttttttttttt").click(function()
		{
			//alert (1);
			 //the target (cart controller / add method)
			 var target_url = '<?php echo(base_url()."carta/add") ; ?>';
		  	 
		  	 // somme alers for degbugging 
		  	 //alert( target_url );
		  	 //alert( $(this).attr('id') );
		  	 
		  	// get the product id from the DOM
		  	var prod_id = $(this).attr("id");
		  	var qty = $("#qty").val();
		  	var color__id = $("#color_id").val();
		  	var size__id = $("#size_id").val();
		  	//alert(target_url);
			var ProductData = 
			{
				product_id:prod_id,
				quantity:qty,
				color_id:color__id,
				size_id:size__id
				
			};
			
			
			
			
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
					
					//alert(data);
					
					//parse the json file 
					cart = JSON && JSON.parse(data) || $.parseJSON(data);
					
					//alert('there are \n' + cart.num_of_items + ' items in your cart');
					//alert('you r going to pay \n' + cart.total_price + 'dolars today');
					
					//var num_of_items = "<?php echo($this->cart->total_items());?>";
					//setTimeout(function(){    alert('there are \n' + num_of_items + ' items in your cart');$("#cart_num").html("( " + num_of_items + ")");}, 5000);
					//alert('there are \n' + num_of_items + ' items in your cart');
					$("#cart_num").html("( " + cart.num_of_items + " )");
					 document.getElementById("cart").href="<?php echo base_url();?>carta/details";
					
					//document.getElementById("cart").scrollIntoView({block: "end", behavior: "smooth"});
					
					// scroll up to the cart id 
					$('html, body').animate({
				        scrollTop: $("#cart").offset().top
				    }, 1000);
					

			        
			       /* setTimeout(function ()
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
			        
			        $("#cart").css("color","#696763");*/
			        
			        $('#cart_icon').removeClass().addClass('tada' + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function()
					{
		      			$(this).removeClass();
		    			
		    		});
    		
			       

					
				},
				error: function(jqXHR, textStatus, errorThrown)
				{
					$("#cart_notice").show();
					$("#cart_notice").html('<pre><code class="prettyprint">AJAX Request Failed<br/> textStatus='+textStatus+', errorThrown='+errorThrown+'</code></pre>');
				}
			});
			
			
			
			// prevent default
			return false;
		});// end add to cart via ajax
		
		
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
		
		//$("#search").autocomplete
		//({
	    //	source: '<?php echo(base_url()."product/autosearch") ; ?>' // path to the autosearch method
	  	// });
		//do something else now here
		
		
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
		//$('#cart0000').hover(update_cart_details);
		
		function update_cart_details()
		{
			
			// get the cart details 	
			var target_url = '<?php echo(base_url()."cart/info") ; ?>';
			$.ajax
			(
			{
				url : target_url,
				type: "POST",
				cache: false,
				success: function(data)
					{
						jstring = JSON && JSON.parse(data) || $.parseJSON(data);
						//console.log(data);
						//console.log(jstring);
						//alert(data);
					
			        $("#cart_preview ul").html("");
			        var i = 0 ; // number of items in the cart
			        var price = 0 ;
			        var currency = currency_backend;		
			        var rate = rate_backend;		
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
									    	
									    	$("#cart_preview ul").append("<li>"+node1[key3]+"<li>");
									    	
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
	var flag_tester_x=0;
	flag_tester_y=0;
	function setcolororder(colororderid,colororderphoto){
	//alert(colororderid);
	var colours=document.getElementsByName("colorboxalt")
	for(var k=0;k<colours.length;k++){
	colours[k].className='color-filter-box-single';}
	document.getElementById("colorbox"+colororderid).className='color-filter-box-single-cliked';
	document.getElementById("color_id").value=colororderid;
	orginal_photo=colororderphoto;
	flag_tester_x=1;
	if (!document.getElementById('size_flag')){
	$("[name='add-to-cart']").attr("disabled", false);
	}
	else
	{
	 if(flag_tester_y==1){$("[name='add-to-cart']").attr("disabled", false);}
	}
	
	
	
};
function setthumorder(altimg){

	orginal_photo=altimg;
	
	
};


function setsizeorder(sizeorderid){
	var sizez=document.getElementsByName("size-box")
	for(var k=0;k<sizez.length;k++){
	sizez[k].className='size-box';}
	document.getElementById("size-box"+sizeorderid).className='size-box-clicked ';
	document.getElementById("size_id").value=sizeorderid;
	//document.getElementById("color_name_input").value=colorfiltername;
	flag_tester_y=1;
	if (!document.getElementById('color_flag')){
	$("[name='add-to-cart']").attr("disabled", false);
	}
	else
	{
	 if(flag_tester_x==1){$("[name='add-to-cart']").attr("disabled", false);}
	}
	
};
function colorphoto(imageurl){
	document.getElementById("image2").src=imageurl;
	
};
function thubover(imageurl){
	document.getElementById("image2").src=imageurl;
	
};
function orginalimage(){
 document.getElementById("image2").src=orginal_photo;
};

$(document).ready(function(){
	
$("#cart_num").html('( <?php echo($this->cart->total_items());?> )');
	
	//orginal_photo=document.getElementById("image2").src;
	
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
		
		var target_url = '<?php echo(base_url()."carta/remove") ; ?>';
		 				  	 
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
</script>

<?php include "script_qcart.php"; ?>

<?php include "script_email_collector.php"; ?>


</body>
</html>