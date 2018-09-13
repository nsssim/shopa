/*price range*/
function prepareList() {
  $('#expList').find('li:has(ul)')
  	.click( function(event) {
  		if (this == event.target) {
  			$(this).toggleClass('expanded');
  			$(this).children('ul').toggle('medium');
  		}
  		return false;
  	})
  	.addClass('collapsed')
  	.children('ul').hide();
  };
 
  $(document).ready( function() {
      prepareList();
  });
  
 //$('#price_sld').slider();
function swapImage(imgID) {
     var theImage = document.getElementById('theImage');
     var newImg;
     newImg = imgArray[imgID];
     theImage.src = imgPath + newImg;
}

	var RGBChange = function() {
	  $('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
	};	
		
/*scroll to top*/
/*
$(function() {
    // Stick the #nav to the top of the window
    var nav = $('#nav');
    var navHomeY = nav.offset().top;
    var isFixed = false;
    var $w = $(window);
    $w.scroll(function() {
        var scrollTop = $w.scrollTop();
        var shouldBeFixed = scrollTop > navHomeY;
        if (shouldBeFixed && !isFixed) {
            nav.css({
                position: 'fixed',
                top: 0,
                paddingLeft:180,
                background: '#fff',
                zIndex: 999,
                left: nav.offset().left,
                width: nav.width()
            });
            isFixed = true;
        }
        else if (!shouldBeFixed && isFixed)
        {
            nav.css({
                position: 'static',
                 paddingLeft:0
            });
            isFixed = false;
        }
    });
});
*/

//color filter
function setcolorfilter(colorfilterid,colorfiltername){
	document.getElementById("color_id_input").value=colorfilterid;
	document.getElementById("color_name_input").value=colorfiltername;
	
	
};
function colorphoto_list(imgurl,prodidimage){
	 alert(document.getElementsByName(prodidimage)[0].src);
	 toto=document.getElementsByName(prodidimage)[0];
	toto.src=imageurl;
	
};
$(document).ready(function(){
	//brand filter 
	$( "input[name='brand_filter']" ).change(function() {
  var brandF=$("input[name='brand_filter']:checked").val();
  var a = brandF.split(',');
document.getElementById("brand_id_input").value=a[0];
document.getElementById("brand_name_input").value=a[1];
});
//size filter
$( "input[name='size_filter']" ).change(function() {
  var sizeF=$("input[name='size_filter']:checked").val();
   var b = sizeF.split(',');
document.getElementById("size_id").value=b[0];
document.getElementById("size_name").value=b[1];

});
//order filter
$( "input[name='sortrad']" ).change(function() {
  var sortrad=$("input[name='sortrad']:checked").val();
document.getElementById("price_order").value=sortrad;

});
//onsale filter 
$("#onsalefilter").click(function() {
    // this function will get executed every time the #home element is clicked (or tab-spacebar changed)
    if($(this).is(":checked")) // "this" refers to the element that fired the event
    {
        document.getElementById("on_sale").value="TRUE";
    }
    else
    {
		document.getElementById("on_sale").value="FALSE";    
    }
});
//product list 


//price filter
$( "input[name='pricefilterrad']" ).change(function() {
  var brandF=$("input[name='pricefilterrad']:checked").val();
  if(brandF=="a1")
  {
	  document.getElementById("min_price_input").value=0;
	   document.getElementById("max_price_input").value=75;  
  }
  else{if(brandF=="a2")
  {
	  document.getElementById("min_price_input").value=75;
	   document.getElementById("max_price_input").value=300;
  }
  else{if(brandF=="a3")
  {
	  document.getElementById("min_price_input").value=300;
	   document.getElementById("max_price_input").value=600;
  }else{if(brandF=="a4")
  {
	  document.getElementById("min_price_input").value=600;
	   document.getElementById("max_price_input").value=1200;
  }else{if(brandF=="a5")
 {
	  document.getElementById("min_price_input").value=1200;
	   document.getElementById("max_price_input").value='';
  }}
  }
}
  }


//document.getElementById("brand_id_input").value=brandF;
});

	$(function () {
		$.scrollUp({
	        scrollName: 'scrollUp', // Element ID
	        scrollDistance: 300, // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top', // 'top' or 'bottom'
	        scrollSpeed: 300, // Speed back to top (ms)
	        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
	        animation: 'fade', // Fade, slide, none
	        animationSpeed: 200, // Animation in speed (ms)
	        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
					//scrollTarget: false, // Set a custom target element for scrolling to the top
	        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
	        scrollTitle: false, // Set a custom <a> title if required.
	        scrollImg: false, // Set true to use image
	        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        zIndex: 2147483647 // Z-Index for the overlay
		});
	});
});
 var clickedOnce = false;
function toggle_visibility(id) {
       var e = document.getElementById(id);
      
       if(!clickedOnce) {
			clickedOnce = true;
       if(e.style.display == 'block')
          e.style.display = 'none';
       else
          e.style.display = 'block';}
    }
    
    
   