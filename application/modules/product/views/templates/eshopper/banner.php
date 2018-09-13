<section class="products-list"><!--slider-->
<?php global  $banner_flag ; ?>
<?php $banner_flag = 0; ?>
<?php $banner_flag = 1; ?>
<?php $banner_flag = 0; ?>
		
			<div class="row">
				<div class="col-sm-12">
					
					<?php foreach($breadcrumbs as $bcrmp) : ?>
					
						<!--Home-->
						<?php if($bcrmp->id_category == 806 && $banner_flag ==0) :?>
							<?php $banner_flag = 1; ?>
							<img src="<?php echo base_url().'assets/templates/eshopper/banner/home/04.jpg';?>" class="girl img-responsive" alt="" />
						<?php endif; ?>
						
						<!--Kids -->
						<?php if($bcrmp->id_category == 323 && $banner_flag ==0) :?>
							<?php $banner_flag = 1; ?>
							<img src="<?php echo base_url().'assets/templates/eshopper/banner/kids/02.jpg';?>" class="girl img-responsive" alt="" />
						<?php endif; ?>
						
						<!--Men -->
						<?php if($bcrmp->id_category == 166 && $banner_flag ==0) :?>
							<?php $banner_flag = 1; ?>
							<img src="<?php echo base_url().'assets/templates/eshopper/banner/men/01.jpg';?>" class="girl img-responsive" alt="" />
						<?php endif; ?>
						
						<!--jewellery and accessories -->
						<?php if($bcrmp->id_category == 65 && $banner_flag ==0) :?>
							<?php $banner_flag = 1; ?>
							<img src="<?php echo base_url().'assets/templates/eshopper/banner/jewelery/02.jpg';?>" class="girl img-responsive" alt="" />
						<?php endif; ?>
						
						<!--Beauty-->
						<?php if($bcrmp->id_category == 413 && $banner_flag ==0) :?>
							<?php $banner_flag = 1; ?>
							<img src="<?php echo base_url().'assets/templates/eshopper/banner/jewelery/02.jpg';?>" class="girl img-responsive" alt="" />
						<?php endif; ?>
						
						<!--Shoes -->
						<?php if($bcrmp->id_category == 109 && $banner_flag ==0) :?>
							<?php $banner_flag = 1; ?>
							<img src="<?php echo base_url().'assets/templates/eshopper/banner/shoes/01.jpg';?>" class="girl img-responsive" alt="" />
						<?php endif; ?>
						
						<!--bags -->
						<?php if($bcrmp->id_category == 31 && $banner_flag ==0) :?>
							<?php $banner_flag = 1; ?>
							<img src="<?php echo base_url().'assets/templates/eshopper/banner/bags/06.jpg';?>" class="girl img-responsive" alt="" />
						<?php endif; ?>
						
						<!--Women -->
						<?php if($bcrmp->id_category == 2 && $banner_flag ==0) :?>
							<?php $banner_flag = 1; ?>
							<img src="<?php echo base_url().'assets/templates/eshopper/banner/women/07.jpg';?>" class="girl img-responsive" alt="" />
						<?php endif; ?>
						
					<?php endforeach; ?>
						
				</div>
			</div>
		
</section>
