
	
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

<!--<script type="text/javascript" src="<?php echo base_url().'assets/templates/eshopper/js/thumbnailviewer2.js';?>"></script>-->

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

function gototop(){
	$('html, body').animate({ scrollTop: 0 }, 'slow');
}

//globals
var frm_errors = na_firstname_errors = na_lastname_errors = na_sha_line1_errors = na_sha_line2_errors = na_zipcode_errors = na_date_errors = na_email_errors = na_confirm_email_errors = na_confirm_email_errors2 = na_login_password_errors = na_confirm_password_errors = 1;
 
 $( document ).ready(function() 
 	{
	 	
	 	//// login email focus in and out ///////////////////////////////////
	 	$( "#login_email" ).bind(
	 	{
		  focusin: function() {
		    	//console.log("focus in " );
		    	$(this).css('border-color','rgba(0, 0, 0, 0.8)');
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 4px rgba(0, 0, 0, 0.6)');
		    	$(this).css('outline','0 none');
		  },
		  blur: function() {
		    // Do something on mouseenter
		    var typed_email = $(this).val();
		    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  			var is_valid_email =  re.test(typed_email);
		    
		    if(!is_valid_email)
		    {
		    	frm_errors = 1;
				$('#email_error').show();
				//red shadow
				$(this).css('border-color','rgba(215, 44, 44, 0.8)');
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$(this).css('outline','0 none');
			}
			else
			{
				frm_errors = 0;
				$('#email_error').hide();
				$(this).css('border-color','black');
		    	$(this).css('box-shadow','none');
		    	$(this).css('outline','0 none');
			}
		    
		    
		    console.log("focus out ..." + is_valid_email)
		   
		    
		  }
		});
		
	 	//// login password focus in and out ///////////////////////////////////
		$( "#login_password" ).bind(
	 	{
		  focusin: function() {
		    	//console.log("focus in " );
		    	$(this).css('border-color','rgba(0, 0, 0, 0.8)');
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 4px rgba(0, 0, 0, 0.6)');
		    	$(this).css('outline','0 none');
		  },
		  blur: function() {
		    // Do something on mouseenter
		    var typed_password = $(this).val();
		    var password_length_ok = false;
		    password_length = typed_password.length;
		    if((password_length > 4) && (password_length < 17) )
		    {
				password_length_ok = true;
			}
		    //alert(password_length_ok);
		    
		    password_length_bad = !password_length_ok;
		    
		    var re = /(.*\+)|(.*\=)|(.*,)|(.*\\)|(.*\+)|(.*\-)|(.*\|)|(.*\/)|(.* )|(.*%)/; 
		    var m;
 
			if ((m = re.exec(typed_password)) !== null) {
			    if (m.index === re.lastIndex) {
			        re.lastIndex++;
			    }
			    // View your result using the m-variable.
			    // eg m[0] etc.
			}
			
			//if a match was found		    
		    if(m || password_length_bad)
		    {
				frm_errors = 1;
				$('#password_error').show();
				//red shadow
				$(this).css('border-color','rgba(215, 44, 44, 0.8)');
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$(this).css('outline','0 none');
			}
			else
			{
				frm_errors = 0;
				$('#password_error').hide();
				$(this).css('border-color','black');
		    	$(this).css('box-shadow','none');
		    	$(this).css('outline','0 none');
			}
		    
		    
		   // console.log("focus out ..." + m)
		   
		    
		  }
		});
		
	 	//// get city id and find its counties and populate the na_county_select drop down ///////////////////////////////////
	 	//1 when user clicks 		
	 	$( "#na_city_select" ).bind( "change keyup", function() {
	 		var cityid = $(this).val();
	 		//lets ajax 
	 		///// update via 
			var Data2send = {city_id:cityid};
			var target_url = '<?php echo(base_url()."addressman/get_counties_tr/") ; ?>';
			//alert(111);
	  	 	
			$.ajax(
			{
				url : target_url,
				data: Data2send,
				type: "GET",
				success: function(data)
				{
					counties_tr = JSON && JSON.parse(data) || $.parseJSON(data);
	 				//console.info(cities_tr);
	 				$('#na_county_select').empty();
	 				var option_line;
					$.each(counties_tr, function(indx,val){
					    option_line += '<option value=' + val.id + '>' + val.name + '</option>';
					});
					$('#na_county_select').append(option_line);
	 				
					
				},
				error: function(jqXHR, textStatus, errorThrown)
				{
					console.log('textStatus='+textStatus);
					console.log('errorThrown='+errorThrown);
				}
			});
	 		
	 		//console.info(cityid);
	 	});
	 	
	 	//2 when page is loaded 
	 	var cityid = $( "#na_city_select" ).val();
	 	var Data2send = {city_id:cityid};
		var target_url = '<?php echo(base_url()."addressman/get_counties_tr/") ; ?>';
		$.ajax(
			{
				url : target_url,
				data: Data2send,
				type: "GET",
				success: function(data)
				{
					counties_tr = JSON && JSON.parse(data) || $.parseJSON(data);
	 				//console.info(cities_tr);
	 				$('#na_county_select').empty();
	 				var option_line= '<option value="">--County--</option>';
					$.each(counties_tr, function(indx,val){
					    option_line += '<option value=' + val.id + '>' + val.name + '</option>';
					});
					$('#na_county_select').append(option_line);
	 				
					
				},
				error: function(jqXHR, textStatus, errorThrown)
				{
					console.log('textStatus='+textStatus);
					console.log('errorThrown='+errorThrown);
				}
			});
			
			
	////  when first name gets and loses focus  ///////////////////////////////////
	$( "#na_firstname" ).bind(
	{
		  focusin: function() {
		    	//console.log("focus in " );
		    	$(this).css('border-color','rgba(0, 0, 0, 0.8)');
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 4px rgba(0, 0, 0, 0.6)');
		    	$(this).css('outline','0 none');
		  },
		  blur: function() {
		    // Do something on mouseenter
		    var typed_firstname = $(this).val();
		    var firstname_length_ok = false;
		    firstname_length = typed_firstname.length;
		    if((firstname_length > 2) )
		    {
				firstname_length_ok = true;
			}
		    //alert(password_length_ok);
		    
		    firstname_length_bad = !firstname_length_ok;
		    
		    // any special charachters
		    var re = /(.*\+)|(.*\=)|(.*,)|(.*\\)|(.*\+)|(.*\|)|(.*\/)|(.*%)|(.*#)|(.*\$)|(.*\@)|(.*\~)|(.*\?)|(.*\>)|(.*\<)|(.*\!)|(.*\[)|(.*\])|(.*\{)|(.*\})|(.*\^)|(.*\&)|(.*\*)|(.*\()|(.*\))|(.*\=)|(.*\:)|(.*\;)/; 
		    var m;
 
			if ((m = re.exec(typed_firstname)) !== null) {
			    if (m.index === re.lastIndex) {
			        re.lastIndex++;
			    }
			    //  m[0] etc... 
			}
			
			//if a match was found		    
		    if(m || firstname_length_bad)
		    {
				na_firstname_errors = 1;
				$('#fname_error').show();
				//red shadow
				$(this).css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$(this).css('outline','0 none');
			}
			else
			{
				na_firstname_errors = 0;
				$('#fname_error').hide();
				$(this).css('border-color','rgb(157, 168, 179)'); 
		    	$(this).css('box-shadow','none');
		    	$(this).css('outline','0 none');
			}
		    
		    
		    //console.log("focus out ..." + m)
		   
		    
		  }
	});		
	
	////  when last name gets and loses focus  ///////////////////////////////////
	$( "#na_lastname" ).bind(
	{
		  focusin: function() {
		    	//console.log("focus in " );
		    	$(this).css('border-color','rgba(0, 0, 0, 0.8)');
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 4px rgba(0, 0, 0, 0.6)');
		    	$(this).css('outline','0 none');
		  },
		  blur: function() {
		    var typed_txt = $(this).val();
		    var txt_length_ok = false;
		    var txt_length = typed_txt.length;
		    if((txt_length > 2) )
		    {
				txt_length_ok = true;
			}
		    //alert(password_length_ok);
		    
		    txt_length_bad = !txt_length_ok;
		    
		    // any special charachters
		    var re = /(.*\+)|(.*\=)|(.*,)|(.*\\)|(.*\+)|(.*\|)|(.*\/)|(.*%)|(.*#)|(.*\$)|(.*\@)|(.*\~)|(.*\?)|(.*\>)|(.*\<)|(.*\!)|(.*\[)|(.*\])|(.*\{)|(.*\})|(.*\^)|(.*\&)|(.*\*)|(.*\()|(.*\))|(.*\=)|(.*\:)|(.*\;)/; 
		    var m;
 
			if ((m = re.exec(typed_txt)) !== null) {
			    if (m.index === re.lastIndex) {
			        re.lastIndex++;
			    }
			    //  m[0] etc... 
			}
			
			//if a match was found		    
		    if(m || txt_length_bad)
		    {
				na_lastname_errors = 1;
				$('#lname_error').show();
				//red shadow
				$(this).css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$(this).css('outline','0 none');
			}
			else
			{
				na_lastname_errors = 0;
				$('#lname_error').hide();
				$(this).css('border-color','rgb(157, 168, 179)'); 
		    	$(this).css('box-shadow','none');
		    	$(this).css('outline','0 none');
			}
		    
		    
		    //console.log("focus out ..." + m)
		   
		    
		  }
	});
	
	////  when address line1 gets and loses focus  ///////////////////////////////////
	$( "#na_sha_line1" ).bind(
	{
		  focusin: function() {
		    	//console.log("focus in " );
		    	$(this).css('border-color','rgba(0, 0, 0, 0.8)');
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 4px rgba(0, 0, 0, 0.6)');
		    	$(this).css('outline','0 none');
		  },
		  blur: function() {
		    var typed_txt = $(this).val();
		    var txt_length_ok = false;
		    var txt_length = typed_txt.length;
		    if((txt_length > 2) )
		    {
				txt_length_ok = true;
			}
		    //alert(password_length_ok);
		    
		    txt_length_bad = !txt_length_ok;
		    
		    // some special charachters
		    var re = /(.*\+)|(.*\=)|(.*%)|(.*\$)|(.*\~)|(.*\{)|(.*\})|(.*\^)|(.*\*)|(.*\;)|(.*\\)/; 
		    var m;
 
			if ((m = re.exec(typed_txt)) !== null) {
			    if (m.index === re.lastIndex) {
			        re.lastIndex++;
			    }
			    //  m[0] etc... 
			}
			
			//if a match was found		    
		    if(m || txt_length_bad)
		    {
				na_sha_line1_errors = 1;
				$('#na_line1_error').show();
				//red shadow
				$(this).css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$(this).css('outline','0 none');
			}
			else
			{
				na_sha_line1_errors = 0;
				$('#na_line1_error').hide();
				$(this).css('border-color','rgb(157, 168, 179)'); 
		    	$(this).css('box-shadow','none');
		    	$(this).css('outline','0 none');
			}
		    
		    
		    //console.log("focus out ..." + m)
		   
		    
		  }
	});
			
	////  when address line1 gets and loses focus  ///////////////////////////////////
	$( "#na_sha_line2" ).bind(
	{
		  focusin: function() {
		    	//console.log("focus in " );
		    	$(this).css('border-color','rgba(0, 0, 0, 0.8)');
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 4px rgba(0, 0, 0, 0.6)');
		    	$(this).css('outline','0 none');
		  },
		  blur: function() {
		    var typed_txt = $(this).val();
		    var txt_length_ok = false;
		    var txt_length = typed_txt.length;
		    if((txt_length >= 0) ) // not important :p 
		    {
				txt_length_ok = true;
			}
		    //alert(password_length_ok);
		    
		    txt_length_bad = !txt_length_ok;
		    
		    // some special charachters
		    var re = /(.*\+)|(.*\=)|(.*%)|(.*\$)|(.*\~)|(.*\{)|(.*\})|(.*\^)|(.*\*)|(.*\;)|(.*\\)/; 
		    var m;
 
			if ((m = re.exec(typed_txt)) !== null) {
			    if (m.index === re.lastIndex) {
			        re.lastIndex++;
			    }
			    //  m[0] etc... 
			}
			
			//if a match was found		    
		    if(m || txt_length_bad)
		    {
				na_sha_line2_errors = 1;
				$('#na_sha_line2_error').show();
				//red shadow
				$(this).css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$(this).css('outline','0 none');
			}
			else
			{
				na_sha_line2_errors = 0;
				$('#na_sha_line2_error').hide();
				$(this).css('border-color','rgb(157, 168, 179)'); 
		    	$(this).css('box-shadow','none');
		    	$(this).css('outline','0 none');
			}
		    
		    
		    //console.log("focus out ..." + m)
		   
		    
		  }
	});		
	
	////  when address line1 gets and loses focus  ///////////////////////////////////
	$( "#na_zipcode" ).bind(
	{
		  focusin: function() {
		    	//console.log("focus in " );
		    	$(this).css('border-color','rgba(0, 0, 0, 0.8)');
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 4px rgba(0, 0, 0, 0.6)');
		    	$(this).css('outline','0 none');
		  },
		  blur: function() {
		    var typed_txt = $(this).val();
		   		    
		    // zipcode regex
		    var re = /^\d{5}(?:[-\s]\d{4})?$/; 
		    var m;
 
			if ((m = re.exec(typed_txt)) !== null) {
			    if (m.index === re.lastIndex) {
			        re.lastIndex++;
			    }
			    //  m[0] etc... 
			}
			
			//if a match was found		    
		    if(m)
		    {
				na_zipcode_errors = 0;
				$('#na_zip_error').hide();
				$(this).css('border-color','rgb(157, 168, 179)'); 
		    	$(this).css('box-shadow','none');
		    	$(this).css('outline','0 none');
			}
			else
			{
		    	na_zipcode_errors = 1;
		    	$('#na_zip_error').show();
				//red shadow
				$(this).css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$(this).css('outline','0 none');
			}
		    
		    
		    //console.log("focus out ..." + m)
		   
		    
		  }
	});	
	
	////  when address line1 gets and loses focus  ///////////////////////////////////
	$( "#na_month_select,#na_date_select,#na_year_select" ).bind(
	{
		  focusin: function() {
		    	//console.log("focus in " );
		    	$(this).css('border-color','rgba(0, 0, 0, 0.8)');
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 4px rgba(0, 0, 0, 0.6)');
		    	$(this).css('outline','0 none');
		  },
		  blur: function() {
		    var month_val = $('#na_month_select').val();
		    var date_val = $('#na_date_select').val();
		    var year_val = $('#na_year_select').val();
		   		    
		  	    
		    if(month_val!="" && date_val!="" && year_val!="" )
		    {
				na_date_errors = 0;
				$('#na_birthdate_error').hide();
				$(this).css('border-color','rgb(157, 168, 179)'); 
		    	$(this).css('box-shadow','none');
		    	$(this).css('outline','0 none');
			}
			else
			{
		    	na_date_errors = 1;
		    	$('#na_birthdate_error').show();
				//red shadow
				
				$(this).css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$(this).css('outline','0 none');
			}
		    
		    
		    //console.log("focus out ..." + m)
		   
		    
		  }
	});	
	
	
	////  when na_email gets and loses focus  ///////////////////////////////////
	$( "#na_email" ).bind(
	{
		  focusin: function() {
		    	//console.log("focus in " );
		    	$(this).css('border-color','rgba(0, 0, 0, 0.8)');
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 4px rgba(0, 0, 0, 0.6)');
		    	$(this).css('outline','0 none');
		  },
		  blur: function() {
		    var typed_txt = $(this).val();
		    var txt_length_ok = false;
		    var txt_length = typed_txt.length;
		    if((txt_length > 4) )
		    {
				txt_length_ok = true;
			}
		    //alert(password_length_ok);
		    
		    txt_length_bad = !txt_length_ok;
		    
		    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  			var is_valid_email =  re.test(typed_txt);
  			
		    if(is_valid_email && txt_length_ok)
		    {
				na_email_errors = 0;
				$('#na_email_error').hide();
				$(this).css('border-color','rgb(157, 168, 179)'); 
		    	$(this).css('box-shadow','none');
		    	$(this).css('outline','0 none');
			}
			else
			{
		    	na_email_errors = 1;
				$('#na_email_error').show();
				//red shadow
				$(this).css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$(this).css('outline','0 none');
			}
   
		    
		  }
	});
	
	////  when na_email_confirm gets and loses focus  ///////////////////////////////////
	$( "#na_confirm_email" ).bind(
	{
		  focusin: function() {
		    	//console.log("focus in " );
		    	$(this).css('border-color','rgba(0, 0, 0, 0.8)');
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 4px rgba(0, 0, 0, 0.6)');
		    	$(this).css('outline','0 none');
		  },
		  blur: function() {
		    var na_email_value =  $( "#na_email" ).val();
		    var typed_txt = $(this).val();
		    var txt_length_ok = false;
		    var txt_length = typed_txt.length;
		    if((txt_length > 4) )
		    {
				txt_length_ok = true;
			}
		    //alert(password_length_ok);
		    
		    txt_length_bad = !txt_length_ok;
		    
		    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  			var is_valid_email =  re.test(typed_txt);
  			
		    if(is_valid_email && txt_length_ok)
		    {
				na_confirm_email_errors = 0;
				$('#na_confirm_email_error').hide();
				$(this).css('border-color','rgb(157, 168, 179)'); 
		    	$(this).css('box-shadow','none');
		    	$(this).css('outline','0 none');
			}
			else
			{
		    	na_confirm_email_errors = 1;
				$('#na_confirm_email_error').show();
				//red shadow
				$(this).css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$(this).css('outline','0 none');
			}
			
			if(typed_txt != na_email_value )
			{
				na_confirm_email_errors2 = 1;
				$('#na_confirm_email_error2').show();
				//red shadow
				$(this).css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$(this).css('outline','0 none');
			}
			else
			{
		    	na_confirm_email_errors2 = 0;
				$('#na_confirm_email_error2').hide();
				$(this).css('border-color','rgb(157, 168, 179)'); 
		    	$(this).css('box-shadow','none');
		    	$(this).css('outline','0 none');
			}
   
		    
		  }
	});
	
	
	////  when na_login_password gets and loses focus  ///////////////////////////////////
	$( "#na_login_password" ).bind(
	{
		  focusin: function() {
		    	//console.log("focus in " );
		    	$(this).css('border-color','rgba(0, 0, 0, 0.8)');
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 4px rgba(0, 0, 0, 0.6)');
		    	$(this).css('outline','0 none');
		  },
		  blur: function() {
		    var typed_txt = $(this).val();
		    var typed_password2 = $('#na_confirm_password').val();
		    var txt_length_ok = false;
		    var txt_length = typed_txt.length;
		    if((txt_length > 4) && (txt_length < 17) )
		    {
				txt_length_ok = true;
			}
		    //alert(password_length_ok);
		    
		    txt_length_bad = !txt_length_ok;
		    
			var re = /(.*\+)|(.*\=)|(.*,)|(.*\\)|(.*\+)|(.*\-)|(.*\|)|(.*\/)|(.* )|(.*%)/; 
		    var m;
 
			if ((m = re.exec(typed_txt)) !== null) {
			    if (m.index === re.lastIndex) {
			        re.lastIndex++;
			    }
			    // View your result using the m-variable.
			    // eg m[0] etc.
			}
			
			//if a match was found		    
		    if(m || txt_length_bad)  		
		    {
				na_login_password_errors = 1;
				$('#na_login_password_error').show();
				//red shadow
				$(this).css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$(this).css('outline','0 none');
			}
			else
			{
		    	
		    	na_login_password_errors = 0;
				$('#na_login_password_error').hide();
				$(this).css('border-color','rgb(157, 168, 179)'); 
		    	$(this).css('box-shadow','none');
		    	$(this).css('outline','0 none');
			}
			if(typed_password2.length > 0  && typed_txt != typed_password2)
			{
				na_login_password_errors = 1;
				$('#na_login_password_error2').show();
				//red shadow
				$(this).css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$(this).css('outline','0 none');
			}
			else
			{
				na_login_password_errors = 0;
				$('#na_login_password_error2').hide();
				$(this).css('border-color','rgb(157, 168, 179)'); 
		    	$(this).css('box-shadow','none');
		    	$(this).css('outline','0 none');
			}
			/*
			if(typed_txt != na_email_value )
			{
				frm_errors = 1;
				$('#na_confirm_email_error2').show();
				//red shadow
				$(this).css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$(this).css('outline','0 none');
			}
			else
			{
		    	frm_errors = 0;
				$('#na_confirm_email_error2').hide();
				$(this).css('border-color','rgb(157, 168, 179)'); 
		    	$(this).css('box-shadow','none');
		    	$(this).css('outline','0 none');
			}*/
   
		    
		  }
	});
	
	
	
	////  when na_confirm_password gets and loses focus  ///////////////////////////////////
	$( "#na_confirm_password" ).bind(
	{
		  focusin: function() {
		    	console.log("focus in " );
		    	$(this).css('border-color','rgba(0, 0, 0, 0.8)');
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 4px rgba(0, 0, 0, 0.6)');
		    	$(this).css('outline','0 none');
		  },
		  blur: function() {
		    var typed_txt = $(this).val();
		    var txt_length_ok = false;
		    var txt_length = typed_txt.length;
		    if((txt_length > 4) && (txt_length < 17) )
		    {
				txt_length_ok = true;
			}
		    //alert(password_length_ok);
		    
		    txt_length_bad = !txt_length_ok;
		    
		    var pass1 = $( "#na_login_password" ).val();
		    
		    if(pass1 != typed_txt )
		    {
				//password not matching
				na_confirm_password_errors = 1;
				$('#na_confirm_password_error2').show();
			}
			else
			{
				na_confirm_password_errors = 0;
				$('#na_confirm_password_error2').hide();
				
			}
		    
			var re = /(.*\+)|(.*\=)|(.*,)|(.*\\)|(.*\+)|(.*\-)|(.*\|)|(.*\/)|(.* )|(.*%)/; 
		    var m;
 
			if ((m = re.exec(typed_txt)) !== null) {
			    if (m.index === re.lastIndex) {
			        re.lastIndex++;
			    }
			    // View your result using the m-variable.
			    // eg m[0] etc.
			}
			
			//if a match was found		    
		    if(m || txt_length_bad)  		
		    {
				na_confirm_password_errors = 1;
				$('#na_confirm_password_error').show();
				//red shadow
				$(this).css('border-color','rgba(215, 44, 44, 0.8)'); 
		    	$(this).css('box-shadow',' 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(215, 44, 44, 0.6)');
		    	$(this).css('outline','0 none');
			}
			else
			{
		    	
		    	na_confirm_password_errors = 0;
				$('#na_confirm_password_error').hide();
				$(this).css('border-color','rgb(157, 168, 179)'); 
		    	$(this).css('box-shadow','none');
		    	$(this).css('outline','0 none');
			}
   
		    
		  }
	});
	
	//WHEN CLICK ON SUBMIT 
	$( "#na_submit_btn" ).bind(
	{
		  click: function(e) 
		  {
				
				// loop through all form input elements, and focusin then focusout
				$("#na_form").each(function(){
			    input_elm = $(this).find(':input') //<-- Should return all input elements in that specific form.
			    $(input_elm).focus(); // focus in and out to trigger the validation mechanism
			        
			    
				});
		    	
		    	//e.preventDefault();
		    	if(na_firstname_errors == 0 && na_lastname_errors == 0 && na_sha_line1_errors == 0 && na_sha_line2_errors == 0 && na_zipcode_errors == 0 && na_date_errors == 0 && na_email_errors == 0 && na_confirm_email_errors == 0 && na_confirm_email_errors2 == 0 && na_login_password_errors == 0 && na_confirm_password_errors == 0 )
		    	{
		    		return true;
				}
				else
				return false;
		  }
	});

	////////////////////////////////// do something else now 

}); // end document ready 
	
/*
	//check if form is ok 
	function validateMyForm()
	{
	  if(frm_errors == 1)
	  { 
	    alert("make sure all fields are filled");
	    return false;
	  }

	  //alert("validations passed");
	  //$('#na_form').submit();
	  return true;
	}
*/
		

		
		//search autocomplete
		$("#search").autocomplete
		({
	    	source: '<?php echo(base_url()."product/autosearch") ; ?>', // path to the autosearch method
	    	minLength: 2
	  	 });
	  	 

	  	 
		//do something else now here
	
	$(".tooltip").show();
	
		


// to escape special characters see  http://stackoverflow.com/a/9310752/1636522
RegExp.escape = function (text) {
    return text.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, '\\$&');
};

</script>



<?php // if ($this->cart->total_items() > 0): ?>
<script>
$(document).ready(function()
{

});		
</script>
<?php //endif ; ?>

<script>
	function eraseCookie(name) {
		
    createCookie(name,"",-1);
    
}
	function createCookie(name,value,days) 
	{
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
        



	



/// update customer





</script>




</body>
</html>