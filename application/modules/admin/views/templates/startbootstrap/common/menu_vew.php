<?php
$this->load->helper('url');
$CI =& get_instance();
$orders_page = base_url().'admin' ; 
?>
                     
       <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p>Admin</p>

              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> 
              </a>
             
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Orders</span>
                <span class="label label-primary pull-right">4</span>
              </a>
              
            </li>
            <li>
              <a href="#">
                <i class="fa fa-th"></i> <span>Products</span> 
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-group"></i>
                <span>Members</span>
                
              </a>
             
            </li>
            <li class="treeview">
              <a href="Stml">
                <i class="fa fa-laptop"></i>
                <span>logout</span>
                
              </a>
              
            </li>
            
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>