
	<?php
	// load the url helper for base_url 
	$this->load->helper('url');
	$template_path= base_url()."assets/templates/adminlte/";
	 ?>  

      

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
             Miscellaneous...
            <small>AmerikaShop</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Miscellaneous... </li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
        
	       		<!--other links -->
			       	<div class="col-md-12" style="/*background-color: orange*/" >
			       	 	<div class="col-md-4" style="border: solid 1px #777;  line-height: 20px; width: 250px; text-align: center;">
			       	 		
				       		<a href="<?php echo base_url().'admin/reset_redis_via_ssh' ?>" target="_blank" style="color: black;" >
				       			<img height="100px" src="<?php echo base_url().'assets/system/icon-redis.png';  ?>" /><br>
				       			Restart Redis Server
				       		</a>
			       	 	</div>
			       	 	
			       	 	<div class="col-md-1"> &nbsp; </div>
			       	 	
			       	 	<div class="col-md-4" style="border: solid 1px #777;  line-height: 20px; width: 250px; text-align: center;">
				       		<a  href="https://shopamerika.com:10000" target="_blank" style="color: black;" >
				       			<img height="100px" src="<?php echo base_url().'assets/system/webmin-icon.png';  ?> " /><br>
				       			Access Webmin
				       		</a>
			       	 	</div>
			       	 	
			       	 	<div class="col-md-1"> &nbsp; </div>
			       	 	
			       	 	<div class="col-md-4" style="border: solid 1px #777;  line-height: 20px; width: 250px; text-align: center;">
				       		<a  href="<?php echo base_url().'doc/html/classes.html' ?>" target="_blank" style="color: black;" >
				       			<img height="100px" src="<?php echo base_url().'assets/system/code.png';  ?> " /><br>
				       			Doc For developers
				       		</a>
			       	 	</div>
			       	 	
			       	 	
			       	</div>

			       	 	<div class="col-md-1"> &nbsp; </div>
			       	
			       	<div class="col-md-12" style="/*background-color: orange*/" >

				       	<div class="col-md-4" style="border: solid 1px #777;  line-height: 20px; width: 250px; text-align: center;" 
				       	title="this will generate the sitemap as an xml file and shoul be placed in a public location  and then should be registered to search engines like Google , Bing ond others , make sure you add the generated xml to robot.txt  ">
				       		<a href="<?php echo base_url().'sitemapman/gen_sitemap/2' ?>" target="_blank" style="color: black;" >
				       			<img height="100px" src="<?php echo base_url().'assets/system/sitemap.png';  ?>" /><br>
				       			Generate Sitemap 
				       			<a href="<?php echo base_url().'sitemapman/gen_sitemap/2' ?>" target="_blank" style="color: red;" >En</a>	-
				       			<a href="<?php echo base_url().'sitemapman/gen_sitemap/1' ?>" target="_blank" style="color: red;" >Tr</a>
				       		</a>
			       	 	</div>
			       	 	
			       	 	<div class="col-md-1"> &nbsp; </div>
			       	 	
			       	 	<div class="col-md-4" style="border: solid 1px #777;  line-height: 20px; width: 250px; text-align: center;" 
			       	 	title="this will generate the routes code from the categories in the database and should go inside routes.php, you need to generate new routes whenever the category database changes (new category added / deleted )  " >
				       		<a href="<?php echo base_url().'sitemapman/generate_routes/2' ?>" target="_blank" style="color: black;" >
				       			<img height="100px" src="<?php echo base_url().'assets/system/route.png';  ?>" /><br>
				       			Generate Routes 
				       			<a href="<?php echo base_url().'sitemapman/generate_routes/2' ?>" target="_blank" style="color: red;" >En</a>	-
				       			<a href="<?php echo base_url().'sitemapman/generate_routes/1' ?>" target="_blank" style="color: red;" >Tr</a>
				       			 
				       		</a>
			       	 	</div>
			       	 	
			       	 	<div class="col-md-1"> &nbsp; </div>
			       	 	
			       	 	
			       	 	<div class="col-md-4" style="border: solid 1px #777;  line-height: 20px; width: 250px; text-align: center;" 
			       	 		title=" Show the categories update log" >
				       		<a href="<?php echo base_url().'data/logs/category_synch_log.html'; ?>" target="_blank" style="color: black;" >
				       			<img height="100px" src="<?php echo base_url().'assets/system/categories_update.png';  ?>" /><br>
				       			Categories updates log
				       		</a>
			       	 	</div>
				       			
			       	
			       	</div>
			    <!--other links -->
       
        
        
    
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      

 