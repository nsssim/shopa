<div id="right-block" >
    <?php foreach($featured_items as $fi): ?>
    <div class="alt_items">
    <?php $cat_id = $fi->categories[0]->numId; ?>
    <a href= <?php echo base_url()."product/detail-item-$fi->id-cat_id-$cat_id.html";?> >
   		<!--<img class="rimage" src="https://resources.shopstyle.com/pim/6f/a9/6fa962efa447ead79e83f7b50de0dc1c_best.jpg">-->
   		<img class="rimage" src="<?php echo $fi->image->sizes->Best->url ?>">
    </a>
    <hr style="border-top: 1px dashed grey;">
    </div>
    <?php endforeach; ?>
    
    <div class="social" style="text-align: center;">
    	<div style="font-size: 10px;padding: 5px 0px;font-weight: bold;line-height: 2.2em;" > <?php echo $words['join_the_conversatio']; ?> <!--JOIN THE CONVERSATION--> </div>
		<a href="https://www.facebook.com/shopamerikacom/" ><img style="height: 30px;" src=<?php echo base_url()."assets/emails/fb.png";?>  ></a>
		<a href="https://www.instagram.com/shopamerika/" ><img style="height: 30px;" src=<?php echo base_url()."assets/emails/insta.png";?>  ></a>
		<a href="https://twitter.com/shopamerika" ><img style="height: 30px;" src=<?php echo base_url()."assets/emails/tweeter.png";?> ></a>
		<a href="#" ><img style="height: 30px;" src=<?php echo base_url()."assets/emails/printest.png";?> ></a>
	</div>
</div>