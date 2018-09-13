
	
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
    <script src="<?php echo base_url().'assets/templates/eshopper/js/timer.jquery.min.js';?>" > </script>

<script>

//https://github.com/walmik/timer.jquery
$('#ttt').timer({
    duration: '30s',
    callback: function() 
    {
        //alert('Time up!');
        
        var target_url = '<?php echo(base_url()."autorun/check_cart/") ; ?>';
	  	 
		$.ajax(
		{
			url : target_url,
			type: "GET",
			success: function(return_data)
			{
				console.log(return_data);
				
				// refresh page
				//location.reload(); 
			},
			error: function(jqXHR, textStatus, errorThrown)
			{
				console.log('textStatus='+textStatus);
				console.log('errorThrown='+errorThrown);
			}
		});
        
        
    },
    repeat: true
});


</script>



</body>
</html>