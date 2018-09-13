

	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li>Over <span class="red">2 Million</span> Fashion <span class="red">Items</span></li>
								
							</ul>
						</div>
					</div>
					<div class="col-sm-8">
						<div class=" pull-right">
							<ul class="btn-group navbar-nav top-bar">
							<li>
								<a id="cart" href="<?php echo base_url()."carta/details"; ?>"> 
									<i class="fa fa-shopping-cart">  </i> 
									Cart
									 <span id="cart_num" style= "backround-color: #ffd7d7;"  ></span> 
									   </a>
							</li>
								<li data-toggle="dropdown">
								<a href="#" >
								<img src="<?php echo base_url().'assets/templates/eshopper/images/flags/tr.jpg';?>"/>
								</a>
								<ul class="dropdown-menu">
									<li><a href="#">Canada</a></li>
									<li><a href="#">UK</a></li>
								</ul>
								</li>
								<li  data-toggle="dropdown"><a href="#"> USD</a></li>
								<ul class="dropdown-menu">
									<li><a href="#">Canadian Dollar</a></li>
									<li><a href="#">Pound</a></li>
								</ul>
								
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
		
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="<?php echo base_url().'home/';?>">
								<img src="<?php echo base_url().'assets/templates/eshopper/images/home/logo.png';?>" alt="" /></a>
						</div>
						
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<div class="search_box pull-right">
							<input type="text" placeholder="Search"/>
						</div>

						</div>
					</div>
				</div>
				<?php include "mega.php";?>				
		</div><!--/header-bottom-->
		</div>
		</div>
	</header><!--/header-->
	<hr class="line"/>
