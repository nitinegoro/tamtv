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
$box = $this->themes->get('category-two');

$value = json_decode($box->meta_value);
?>
<div id="sticker">
<div class="box-category-1">
	<h3 class="sidebar-heading"> <?php echo $box->meta_name; ?> </h3> 
	<div class="media-news">
	<?php  
	/**
	 * Get Post By Type
	 *
	 * @param Integer (category_id)
	 * @param Integer (limit)
	 * @param Integer (offset)
	 **/
	foreach( $this->posts->category($value->category, ++$value->limit, 0) as $post) :
	?>
		<div class="media-item">
			<div class="media-image">
				<a href="<?php echo $this->posts->permalink($post->ID) ?>" title="<?php echo $post->post_title; ?>">
					<img src="<?php echo $this->posts->get_thumbnail($post->image, 'x-small'); ?>" alt="<?php echo $post->post_title; ?>" class="img-responsive">
				</a>
			</div>
			<div class="media-content">
				<h4 class="media-title">
					<a href="<?php echo $this->posts->permalink($post->ID) ?>" itemprop="name" title="<?php echo $post->post_title; ?>">
						<?php echo $post->post_title; ?>
					</a>
				</h4>
			</div>
		</div>
	<?php endforeach; ?>
	</div>
</div>
</div>
<?php
/* End of file category-two.php */
/* Location: ./application/views/box-elements/category-two.php */