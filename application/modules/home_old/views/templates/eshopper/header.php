<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
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
							<a href="<?php echo base_url();?>"><img src= "<?php echo base_url().'assets/templates/eshopper/images/home/logo.png';?>"  alt="" /></a>
						</div>
						<div class="btn-group pull-right">
							
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									USA
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li id="tr" ><a href= "<?php echo base_url().'home/tr';?>" >Türkçe</a></li>
									<li id="ru" ><a href= "<?php echo base_url().'home/ru';?>" >русский</a></li>
									<li id="fr" ><a href= "<?php echo base_url().'home/fr';?>" >français</a></li>
									<!--<li><a href="xx">xxxx</a></li> for more languages -->
									
								</ul>
							</div>
							
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									DOLLAR
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">Canadian Dollar</a></li>
									<li><a href="#">Pound</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<li><a id="account_btn" href="#"><i class="fa fa-user"></i> Account</a></li>
								<li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li>
								<li><a href="checkout.html"><i class="fa fa-crosshairs"></i> Checkout</a></li>
								<li><a id="cart" href="<?php echo base_url()."cart/details"; ?>"> <i class="fa fa-shopping-cart">  </i> Cart <span id="cart_num" style= "backround-color: #ffd7d7;"  ></span>   </a>
								<div id="cart_preview" > 
								<ul>
									
								</ul>
				
								</div> 
								
								</li>
								<li><a id="login_btn" href="<?php echo base_url()."login"; ?>"><i class="fa fa-lock"></i> Login</a></li>
								<li><a id="logout_btn" href="<?php echo base_url()."login/logout"; ?>"><i class="fa fa-lock"></i> Logout</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<!--<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="index.html" class="active">Home</a></li>
								<li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="shop.html">Products</a></li>
										<li><a href="product-details.html">Product Details</a></li> 
										<li><a href="checkout.html">Checkout</a></li> 
										<li><a href="cart.html">Cart</a></li> 
										<li><a href="login.html">Login</a></li> 
                                    </ul>
                                </li> 
								<li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="blog.html">Blog List</a></li>
										<li><a href="blog-single.html">Blog Single</a></li>
                                    </ul>
                                </li> 
								<li><a href="404.html">404</a></li>
								<li><a href="contact-us.html">Contact</a></li>
							</ul>
						</div>
					</div>-->
					<div class="col-sm-9" style="border: none ;left: 12%; padding: 0 0 0 0">
						<!--<div class="search_box pull-right"> uncomment to pull right-->
						<div class="search_box">
						<form method="get" style="border: none;" action=<?php echo(base_url()."product/presearch/")?> >

						<input id="search" name="q" class="search-input" type="text" placeholder="Search" style="width: 60%;"/>
						
						<div class="cat-search" style="width: 20%; display: inline-block;">
						<?php $this->load->module("categories"); ?>	
						 <select id="search-dropdown-box" class="cat-drop-list" name="cat">
						  
				          <option selected="true" value="0">All Categories</option>
				          <option value=<?php echo '"'.$women_cat_id.'"' ?> >Women&#39;s Clothing &amp; Accessories</option>
				          <option value=<?php echo '"'.$men_cat_id.'"' ?>>Men&#39;s Clothing &amp; Accessories</option>
				          <option value=<?php echo '"'.$kids_cat_id .'"' ?>>Kids' Nursery, Clothes and Toys</option>
				          <option value=<?php echo '"'.$living_cat_id.'"' ?>>Home & Living</option>
				          <option  disabled="disabled">----</option>
	
						  <optgroup label="Women's Fashion">
						  <ul>
						  	
							  <?php foreach($women_subcat as $row): ?>
					          <li style="background-color: green;">
					          	<option style="color:#E10D7D;" value=<?php echo '"'.$row["id"].'"' ?>><?php echo $row["name"] ?> </option>
					          </li>
							  <?php endforeach ?>
						  </ul>
				    	  </optgroup>
				    	  
				    	  <optgroup label="Men's Fashion">
				    	  	  <?php foreach($men_subcat as $row): ?>
					           <option value=<?php echo '"'.$row["id"].'"' ?>><?php echo $row["name"] ?> </option>
							  <?php endforeach ?>
				    	  </optgroup>
				    	  
				    	  <optgroup label="Kids' Nursery, Clothes and Toys">
				    	  	  <?php foreach($kids_and_babies_subcat as $row): ?>
					           <option style="color:#406bee;"  value=<?php echo '"'.$row["id"].'"' ?>><?php echo $row["name"] ?> </option>
							  <?php endforeach ?>
				    	  </optgroup> 
				    	  
				    	  <optgroup label="Home & Living">
				    	  	  <?php foreach($living_subcat as $row): ?>
					           <option value=<?php echo '"'.$row["id"].'"' ?>><?php echo $row["name"] ?> </option>
							  <?php endforeach ?>
				    	  </optgroup>
				    	  
				          <option value="0">All Categories</option>
				        </select>
				        
				        </div>
						
						<input class="search_btn" type="submit" value="Search.."  />

						</form>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->