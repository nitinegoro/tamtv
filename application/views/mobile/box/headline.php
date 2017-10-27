<?php  
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Get Post By Type
 *
 * @param String (post_type)
 * @param Integer (limit)
 * @param Integer (offset)
 **/
?>
<div class="clearfix"></div>
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">  
	<?php  
	/**
	 * Get Post By Type
	 *
	 * @param String (post_type)
	 * @param Integer (limit)
	 * @param Integer (offset)
	 **/
	foreach( $this->posts->get_type('headline', 5, 0, 'result') as $key => $post) :
		$date = new DateTime($post->post_date);

	?>
        <div class="item <?php if($key==0) echo 'active'; ?>">
        	<img src="<?php echo $this->posts->get_thumbnail($post->image, 'large'); ?>" alt="<?php echo $post->post_title; ?>" class="img-responsive">
           <div class="carousel-caption">
            	<a href="<?php echo $this->posts->permalink($post->ID) ?>">
            		<?php echo $post->post_title; ?> <br>
            		<span><?php echo $date->format('d/m/Y H:i')." WIB"; ?></span>
           		</a>
          </div>
        </div><!-- End Item -->
    <?php  
	endforeach;
    ?>
    </div><!-- End Carousel Inner -->
    <div class="carousel-controls">
		<a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
		</a>
		<a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
		</a>
    </div>
</div><!-- End Carousel -->
<?php
/* End of file headline.php */
/* Location: ./application/views/mobile/box/headline.php */