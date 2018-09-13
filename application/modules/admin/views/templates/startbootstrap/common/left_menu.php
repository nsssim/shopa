	<?php
	// load the url helper for base_url 
	$this->load->helper('url');
	$template_path= base_url()."assets/templates/adminlte/";
	
	$this->load->helper('url');
	$CI =& get_instance();
	
	$ssl_port_num = ":".SSL_PORT;  // :443 is the default
	$base_url_str = base_url(); 
	$sbu = str_replace("http","https",$base_url_str );
	$secure_base_url = str_replace(".com",".com$ssl_port_num",$sbu );
	
	?>  
<!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel" style="height:42px ;" >
            <div class="pull-left image">
              <!--<img src="" class="img-circle" alt="User Image" />-->
            </div>
            <div class="pull-left info" >
              <p><?php echo $user_details->first_name." ".$user_details->last_name ?> </p>
              <p><?php //var_dump($user_details); ?> </p>
              

              <!--<a href="#"><i class="fa fa-circle text-success"></i> Online</a>-->
            </div>
          </div>
          
          <!-- search form -->
	          <!--<form action="#" method="get" class="sidebar-form">
	            <div class="input-group">
	              <input type="text" name="q" class="form-control" placeholder="Search..."/>
	              <span class="input-group-btn">
	                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
	              </span>
	            </div>
	          </form>-->
          <!-- /.search form -->
          
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            
            <?php $is_active = 'treeview'; ?>
            
            <?php if($current_admin_privileges[0]->dashboard): ?>
	            <?php if($menu_flag == 'index'){$is_active = "active treeview";} else{$is_active = "treeview";} ?>
	            <li class=" <?php echo($is_active) ; ?>">
	              <a href="<?php echo base_url().'admin' ?> ">
	                <i class="fa fa-dashboard"></i> <span>Dashboard</span> 
	              </a>
	             
	            </li>
            <?php endif; ?>
            
            <?php if($current_admin_privileges[0]->order): ?>
	            <?php if(($menu_flag == 'orders') or ($menu_flag == 'who_what_when') ){$is_active = "active treeview"; $display_style =' style="display: block; "'; } else{$is_active = "treeview";$display_style ='style="display: none; "';} ?>
		            <li class=" <?php echo($is_active) ; ?> ">
		                <a href="<?php echo base_url().'admin/orders/0?-ob-date_add%3Ad' ?> ">
		                	<i class="fa fa-files-o"></i>
		                	<span>Orders</span>
		                    <!--<span class="label label-primary pull-right">4</span>-->
			            	<i class="fa fa-angle-left pull-right"></i>
		                </a>
		                <ul class="treeview-menu menu-open" <?php echo $display_style; ?>>
	            			<?php if(($menu_flag == 'orders') )       {$item_stylea = ' style="color: white;" '; } else{$item_stylea = '';} ?>
	            			<?php if(($menu_flag == 'who_what_when') ){$item_styleb = ' style="color: white;" '; } else{$item_styleb = '';} ?>
			            	<li><a href="<?php echo base_url().'admin/orders/0?-ob-date_add%3Ad' ?> " <?php echo $item_stylea; ?> ><i class="fa fa-circle-o"></i> Status</a></li>
			            	<?php if($current_admin_privileges[0]->whowhatwhen): ?>
			            	<li><a href="<?php echo base_url().'admin/listing/who_what_when' ?>"      <?php echo $item_styleb; ?> ><i class="fa fa-circle-o"></i> Audit trail</a></li>
			            	<?php endif; ?>
			          	</ul>
		            </li>
		            
		            <!--<li class="treeview ">
			          	<a href="#">
			            	<i class="fa fa-pie-chart"></i>
			            	<span>Charts</span>
			            	<i class="fa fa-angle-left pull-right"></i>
			          	</a>
			          	<ul class="treeview-menu menu-open" style="display: none;">
			            	<li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a></li>
			            	<li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
			            	<li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
			            	<li><a href="pages/charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
			          	</ul>
        			</li>-->
		            
            <?php endif; ?>
            <!--<li>
              <a href="<?php echo base_url().'admin/products' ?> ">
                <i class="fa fa-th"></i> <span>Products</span> 
              </a>
            </li>-->
            
            <?php if($current_admin_privileges[0]->customers): ?>
	            <?php if($menu_flag == 'customers'){$is_active = "active treeview";} else{$is_active = "treeview";} ?>
		            <li class=" <?php echo($is_active) ; ?>">
		              <a href="<?php echo base_url().'admin/listing/customers' ?> ">
		                <i class="fa fa-group"></i>
		                <span>Customers</span>
		              </a>
		            </li>
            <?php endif; ?>
            
            <?php if($current_admin_privileges[0]->price_rules): ?>
	            <?php if($menu_flag == 'price_rules'){$is_active = "active treeview";} else{$is_active = "treeview";} ?>
		            <li class=" <?php echo($is_active) ; ?>">
		              <a href="<?php echo base_url().'admin/listing/price_rules' ?> ">
		                	<i class="fa fa-plane"></i>
		                	<span>Price Rules</span>
		              </a>
		            </li>
            <?php endif; ?>
            
            <?php if($current_admin_privileges[0]->eprocessors): ?>
	            <?php if($menu_flag == 'eprocessor'){$is_active = "active treeview";} else{$is_active = "treeview";} ?>
		            <li class=" <?php echo($is_active) ; ?>">
		              <a href="<?php echo base_url().'admin/eprocessor' ?> ">
		               		<i class="fa fa-bank"></i>
		                	<span>eProcessors</span>
		              </a>
		            </li>
            <?php endif; ?>
            
            <?php if($current_admin_privileges[0]->Admins): ?>
	            <?php if($menu_flag == 'admins'){$is_active = "active treeview";} else{$is_active = "treeview";} ?>
		            <li class=" <?php echo($is_active) ; ?>">
		              <a href="<?php echo base_url().'admin/admins' ?> ">
		               		<i class="fa fa-user-secret"></i>
		                	<span>Admins...</span>
		              </a>
		             
		            </li>
            <?php endif; ?>
            
            <?php if($current_admin_privileges[0]->misc): ?>
	            <?php if($menu_flag == 'misc'){$is_active = "active treeview";} else{$is_active = "treeview";} ?>
		            <li class=" <?php echo($is_active) ; ?>">
		              <a href="<?php echo base_url().'admin/misc' ?> ">
		               		<i class="fa fa-cogs"></i>
		                	<span>Miscellaneous...</span>
		              </a>
		             
		            </li>
            <?php endif; ?>
            
             <?php if($current_admin_privileges[0]->lists): ?>
	            <?php if($menu_flag == 'lists'){$is_active = "active treeview";} else{$is_active = "treeview";} ?>
		            <li class=" <?php echo($is_active) ; ?>">
		              <a href="<?php echo base_url().'admin/listing/lists' ?> ">
		               		<i class="fa fa-star"></i>
		                	<span>Lists</span>
		              </a>
		             
		            </li>
            <?php endif; ?>
            
            <?php if($current_admin_privileges[0]->categories): ?>
	            <?php if($menu_flag == 'categories'){$is_active = "active treeview";} else{$is_active = "treeview";} ?>
		            <li class=" <?php echo($is_active) ; ?>">
		              <a href="<?php echo base_url().'admin/categories' ?> ">
		               		<i class="fa fa-list"></i>
		                	<span>Categories...</span>
		              </a>
		             
		            </li>
            <?php endif; ?>
            
            <?php if($current_admin_privileges[0]->emails): ?>
	            <?php if($menu_flag == 'emails'){$is_active = "active treeview";} else{$is_active = "treeview";} ?>
		            <li class=" <?php echo($is_active) ; ?>">
		              <a href="<?php echo base_url().'admin/listing/emails' ?> ">
		               		<i class="fa fa-envelope"></i>
		                	<span>Emails</span>
		              </a>
		             
		            </li>
            <?php endif; ?>
            
            
            <li class="treeview">
              <a href="<?php echo $secure_base_url.'customer/my_account'; ?>"> 
                <i class="fa fa-user"></i>
                <span>My account</span>
              </a>
            </li>
            
            <li class="treeview">
              <a href="<?php echo base_url().'' ?> ">
                <i class="fa fa-power-off"></i>
                <span>Exit</span>
                
              </a>
            </li>
            
            
            
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>