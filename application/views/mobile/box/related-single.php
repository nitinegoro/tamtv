<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * The template for displaying the Category Post
 *
 * Displays all of the Category Post right element.
 *
 * @package Codeigniter
 * @subpackage Tamtv Template
 * @author Vicky Nitinegoro <pkpvicky@gmail.com>
 * @since Tamtv 1.0
 */

$inputTags = array_map(function ($object) { 
		return $object->tag_id; 
	}, 
	$this->posts->get_post_tags($post->ID)
);

$tags = implode(', ', $inputTags);
if( $this->posts->similar($tags, $post->ID, 6, NULL) ) :
?>
<div class="box-thumbnail">
	<?php  
	if( $this->posts->similar($tags, 6) ) :
	?>
	<h3 class="featured-heading padding"> Berita Terkait </h3>
	<?php  
	endif;
	/**
	 * Get Similar Post by Tag
	 *
	 * @param String (IN tag_id)
	 **/
	foreach( $this->posts->similar($tags, $post->ID, 6, NULL) as $key => $row) :
		if($key % 2 == 0 )
			echo '<div class="clearfix"></div>';
	?> 
	<div class="box-category-1 col-xs-6">
		<a href="<?php echo $this->posts->permalink($row->ID) ?>" title="<?php echo $row->post_title; ?>">
			<img src="<?php echo $this->posts->get_thumbnail($row->image, 'small'); ?>" alt="<?php echo $row->post_title; ?>" class="img-responsive">
		</a>
		<div class="item-featured">
			<h4 class="item-heading">
				<a href="<?php echo $this->posts->permalink($row->ID) ?>" itemprop="name" title="<?php echo $row->post_title; ?>">
					<?php echo $row->post_title; ?>
				</a>
			</h4>
		</div>
	</div>
	<?php endforeach; ?>
</div>
<?php
endif;
/* End of file similar-one.php */
/* Location: ./application/views/box-elements/similar-one.php */