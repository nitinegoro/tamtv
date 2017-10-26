<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * The template for displaying the Headline News
 *
 * Displays all of the headline News right element.
 *
 * @package Codeigniter
 * @subpackage Tamtv Template
 * @author Vicky Nitinegoro <pkpvicky@gmail.com>
 * @since Tamtv 1.0
 */
$box = $this->themes->get('headline-news');

$value = json_decode($box->meta_value);
if( $this->posts->get_type('headline', 1, 0, 'result') == TRUE) :
?>

<div class="clearfix"></div>
<div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Wrapper for slides -->
      <div class="carousel-inner">  
	<?php  
	/**
	 * Get Post By Type
	 *
	 * @param String (post_type)
	 * @param Integer (limit)
	 * @param Integer (offset)
	 **/
	foreach( $this->posts->get_type('headline', 3, 0, 'result') as $key => $post) :
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
    <ul class="list-group list-group-horizontal">
    <?php  
    foreach( $this->posts->get_type('headline', 3, 0, 'result') as $key => $post) :
    ?>
        <li data-slide-to="<?php echo $key ?>" data-target="#myCarousel" class="list-group-item">
			<img src="<?php echo $this->posts->get_thumbnail($post->image, 'small'); ?>" alt="<?php echo $post->post_title; ?>" class="img-responsive">
			<div class="title">
				<a href="<?php echo $this->posts->permalink($post->ID) ?>"><?php echo $post->post_title; ?></a>
			</div>
        </li>
    <?php endforeach; ?>
    </ul>
<!-- <div class="featured-news" itemscope itemtype="http://schema.org/Article">
	<?php  
	/**
	 * Get Post By Type
	 *
	 * @param String (post_type)
	 * @param Integer (limit)
	 * @param Integer (offset)
	 **/
	$headline = 0;
	foreach( $this->posts->get_type('headline', 1, 0, 'result') as $post) :
		$headline = $post->ID;

		$inputTags = array_map(function ($object) { 
				return $object->tag_id; 
			}, 
			$this->posts->get_post_tags($headline)
		);

		$tags = implode(', ', $inputTags);

	?>
	<a href="<?php echo $this->posts->permalink($post->ID) ?>" title="<?php echo $post->post_title; ?>">
		<img src="<?php echo $this->posts->get_thumbnail($post->image); ?>" alt="<?php echo $post->post_title; ?>" class="img-responsive">
	</a>
	<div class="item-featured">
		<time class="timeago" datetime="<?php echo $post->post_date; ?>"></time>
		<h3 class="item-heading">
			<a href="<?php echo $this->posts->permalink($post->ID) ?>" itemprop="name" title="<?php echo $post->post_title; ?>"><?php echo $post->post_title; ?></a>
		</h3>
		<div class="item-content">
			<p><?php echo ($post->post_excerpt != '') ? strip_tags($post->post_excerpt) : strip_tags(word_limiter($post->post_content, 10)) ?></p>
		</div>
	</div>
	<?php endforeach;  ?>
	<div class="item-box-related">
		<h4 class="related-heading"><?php echo $box->meta_name; ?></h4>
		<ul class="list-related">
			<?php 
			foreach( $this->posts->similar($tags, $headline, (--$value->limit), 1) as $row) : ?>
			<li>
				<a href="<?php echo $this->posts->permalink($row->ID) ?>" itemprop="relatedLink" title="<?php echo $row->post_title; ?>">
					<?php echo $row->post_title; ?>
				</a>
			</li>
			<?php 
			endforeach; 
			?>
		</ul>
	</div>
</div> -->
<div class="clearfix"></div>
<?php endif; ?>