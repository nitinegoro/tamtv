<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * The template for displaying the Headline News
 *
 * Displays all of the headline News right element.
 *
 * @package Codeigniter
 * @subpackage Tamtv Template
 * @since Tamtv 1.0
 */
$box = $this->themes->get('most-viewer');

$value = json_decode($box->meta_value);
?>
<div class="col-xs-12"> <hr> </div>
<div class="box-thumbnail">
	<h3 class="featured-heading"> <?php echo $box->meta_name ?> </h3> 
	<?php  
	/**
	 * Get Post By Type
	 *
	 * @param String (post_type)
	 * @param Integer (limit)
	 * @param Integer (offset)
	 **/
	foreach( $this->posts->most_viewer($value->limit, 0) as $key => $post) :
		if( $key++ == 3 )
			echo '<div class="clearfix"></div>';
	?>
	<div class="box-category-1 c3">
		<a href="<?php echo base_url($post->post_slug) ?>" title="<?php echo $post->post_title; ?>">
			<img src="<?php echo $this->posts->get_thumbnail($post->image, 'small'); ?>" alt="<?php echo $post->post_title; ?>" class="img-responsive">
		</a>
		<div class="item-featured">
			<h4 class="item-heading">
				<a href="<?php echo base_url($post->post_slug) ?>" title="<?php echo $post->post_title; ?>">
					<?php echo $post->post_title; ?>
				</a>
			</h4>
		</div>
	</div>
	<?php endforeach; ?>
</div>