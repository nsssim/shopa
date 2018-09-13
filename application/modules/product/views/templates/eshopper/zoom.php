

	
	<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/zoom/css/cloudzoom.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/zoom/css/thumbelina.css" />

        
        <style>
            
            /* div that surrounds Cloud Zoom image and content slider. */
            #surround {
                width:50%;
                min-width: 256px;
                max-width: 480px;
            }
            
            /* Image expands to width of surround */
            img.cloudzoom {
                width:100%;
            }
            
            /* CSS for slider - will expand to width of surround */
            #slider1 {
                margin-left:20px;
                margin-right:20px;
                height:119px;
                border-top:1px solid #aaa;
                border-bottom:1px solid #aaa;
                position:relative;
            }
            
        </style>

<!--islam start-->
<div id="surround">
    
    <img class="cloudzoom" alt ="Cloud Zoom small image" id ="zoom1" src="<?php echo($product_main_image_zoom); ?>"
       data-cloudzoom='
           zoomSizeMode:"image",
           autoInside: 550
       '>
 
 
    <div id="slider1" style="margin-top:10px;">
        <div class="thumbelina-but horiz left">&#706;</div>
        <ul>
            <li><img class='cloudzoom-gallery' src="<?php echo($product_main_image_tub); ?>" 
                     data-cloudzoom ="useZoom:'.cloudzoom', image:'<?php echo($product_main_image_zoom); ?>' "></li>
				<?php foreach($product_alt_images as $alt_images){?>
            <li><img class='cloudzoom-gallery' src="<?php echo $alt_images->sizes->Medium->url;?>" 
                     data-cloudzoom ="useZoom:'.cloudzoom', image:'<?php echo $alt_images->sizes->XLarge->url;?>' "></li>

				<?php }?>
        </ul>
        <div class="thumbelina-but horiz right">&#707;</div>
    </div>
    
</div>
<!--islam finish-->

			<script src="<?php echo base_url(); ?>/assets/zoom/dist/jquery-1.6.js"></script>
			<script src="<?php echo base_url(); ?>/assets/zoom/dist/cloudzoom.js"></script>
			<script src="<?php echo base_url(); ?>/assets/zoom/dist/thumbelina.js"></script>
			        <script type="text/javascript">
            
             // The following piece of code can be ignored.
             $(function(){
                 $(window).resize(function() {
                     $('#info').text("Page width: "+$(this).width());
                 });
                 $(window).trigger('resize');
             });
             
        </script>
<script type = "text/javascript">
            CloudZoom.quickStart();
            
            // Initialize the slider.
            $(function(){
                $('#slider1').Thumbelina({
                    $bwdBut:$('#slider1 .left'), 
                    $fwdBut:$('#slider1 .right')
                });
            });

            
        </script>
</body>

		
</html>
