<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * The template for displaying the Infinite Loop
 *
 * Displays all of the Infinite Loop right element.
 *
 * @package Codeigniter
 * @subpackage Tamtv Template
 * @since Tamtv 1.0
 */
?>
<div class="box-thumbnail top3x">
	<?php  
	/**
	 * Get Similar Post by Tag
	 *
	 * @param String (IN tag_id)
	 **/
	foreach( $vidio_posts as $key =>  $post) :
		
		if($key % 3 == 0 )
			echo '<div class="clearfix"></div>';
	?> 
	<div class="box-category-1 c3">
		<a href="<?php echo $this->posts->permalink($post->ID) ?>" title="<?php echo $post->post_title; ?>">
			<img src="<?php echo $this->posts->get_thumbnail($post->image, 'small'); ?>" alt="<?php echo $post->post_title; ?>" height="100">
		</a>
		<div class="item-featured">
			<h4 class="item-heading">
				<a href="<?php echo $this->posts->permalink($post->ID) ?>" itemprop="name" title="<?php echo $post->post_title; ?>">
					<?php echo $post->post_title; ?>
				</a>
			</h4>
		</div>
	</div>
	<?php endforeach; ?>
	<div class="text-center col-md-12">
		<?php if($vidio_posts) echo $this->pagination->create_links(); ?>
	</div>
</div>
<?php
/* End of file default-loop-live.php */
/* Location: ./application/views/box-elements/default-loop-live.php */