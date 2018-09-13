
<?php 
	for ($i = 0; $i < $total_cat; $i++)
		{$c[$i]=$json->categories[$i];
			if( ($c[$i]->parentId)== "clothes-shoes-and-jewelry")
			{
	?>

	<?php ?><div class="col-sm-2">
						<div class="single-widget">
							
							<h2><a href="<?php  echo base_url();?>categories/get_subcat_details/<?php echo $c[$i]->id;?>"><?php echo($c[$i]->name);?></a></h2>
							<ul class="nav nav-pills nav-stacked">
								<?php 	for ($j = 0; $j < $total_cat; $j++)
			 {
			 	$c[$j]=$json->categories[$j];
			 	if( $c[$j]->parentId == $c[$i]->localizedId)
			 	{?>

								<li><a href="<?php  echo base_url();?>categories/get_subcat_details/<?php echo $c[$j]->id;?>"><?php echo($c[$j]->name);?></a></li>
								<?php }}?>
							</ul>
						</div>
					</div>
	
<?php }}?>
