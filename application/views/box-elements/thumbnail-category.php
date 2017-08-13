<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * The template for displaying the Post by categoru
 *
 * Displays all of the Post  by categoru element.
 *
 * @package Codeigniter
 * @subpackage Tamtv Template
 * @author Vicky Nitinegoro <pkpvicky@gmail.com>
 * @since Tamtv 1.0
 */
$box = $this->themes->get('similar-one');

$value = json_decode($box->meta_value);
?>
<div class="box-thumbnail">
	<?php  
	/**
	 * Get Similar Post by Tag
	 *
	 * @param String (IN tag_id)
	 **/
	foreach( $this->posts->category($category->category_id, $value->limit, 0) as $key =>  $post) :
		if( ++$key == 4)
			echo '<div class="clearfix"></div>';
	?> 
	<div class="box-category-1 c3">
		<a href="<?php echo $this->posts->permalink($post->ID) ?>" title="<?php echo $post->post_title; ?>">
			<img src="<?php echo $this->posts->get_thumbnail($post->image, 'small'); ?>" alt="<?php echo $post->post_title; ?>" class="img-responsive">
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
</div>
<?php
/* End of file thumbnail-category.php */
/* Location: ./application/views/box-elements/thumbnail-category.php */