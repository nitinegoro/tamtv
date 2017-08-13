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
$box = $this->themes->get('infinite-loop');

$value = json_decode($box->meta_value);
?>
<div class="box-big-loop" itemscope itemtype="http://schema.org/Article">
	<hr>
	<?php  
	/**
	 * Get Latest Post
	 *
	 * @param String (post_type)
	 * @param Integer (limit)
	 * @param Integer (offset)
	 **/
	foreach( $this->posts->category($category->category_id, $value->limit, 7) as $post) :
	?>
	<div class="big-loop-item">
		<a href="<?php echo $this->posts->permalink($post->ID) ?>" title="<?php echo $post->post_title; ?>">
			<img src="<?php echo $this->posts->get_thumbnail($post->image, 'small'); ?>" alt="<?php echo $post->post_title; ?>" class="img-responsive">
		</a>
		<div class="item-content">
			<time class="timeago" datetime="<?php echo $post->post_date; ?>"></time>
			<h4 class="item-heading">
				<a href="<?php echo $this->posts->permalink($post->ID) ?>" title="<?php echo $post->post_title; ?>">
					<?php echo $post->post_title; ?>
				</a>
			</h4>
			<p><?php echo strip_tags(word_limiter($post->post_content, 10)) ?></p>
		</div>
	</div>
	<?php endforeach; ?>
</div>

<!-- <div class="col-md-12 text-center" align="center">
	<a href="" class="btn btn-default"><i class="fa fa-refresh"></i> Indeks Berita</a>
</div> -->