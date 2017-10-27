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
$box = $this->themes->get('headline-slider');

$value = json_decode($box->meta_value);
?>
<div class="box-headline-slider">
	<div class="headline-slider">
	<?php 
	/**
	 * Get Headline Post
	 *
	 * @param String (Type)
	 **/
	foreach( $this->posts->get_type('headline', $value->limit, 0, 'result') as $post) :
	?>
	<div class="c2 headline-slider-item">
		<a href="<?php echo $this->posts->permalink($post->ID) ?>" title="<?php echo $post->post_title; ?>">
		<div class="media">
			<img class="media-object pull-left" src="<?php echo $this->posts->get_thumbnail($post->image, 'x-small'); ?>" height="80" width="100" alt="<?php echo $post->post_title; ?>">
			<div class="media-body">
				<time class="timeago" datetime="<?php echo $post->post_date; ?>"></time>
				<h4 class="media-heading"><?php echo $post->post_title; ?></h4>
			</div>
		</div>		
		</a>
	</div>
	<?php endforeach; ?>
	</div>
</div>

<?php
/* End of file headline-slider.php */
/* Location: ./application/views/box-elements/headline-slider.php */