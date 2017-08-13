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
?>
<div class="featured-news" itemscope itemtype="http://schema.org/Article">
	<?php  
	/**
	 * Get Post By Type
	 *
	 * @param String (post_type)
	 * @param Integer (limit)
	 * @param Integer (offset)
	 **/
	foreach( $this->posts->latest(1, 0) as $post) :
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
			<p><?php echo strip_tags(word_limiter($post->post_content, 15)) ?></p>
		</div>
	</div>
	<?php endforeach;  ?>
	<div class="item-box-related">
		<h4 class="related-heading"><?php echo $box->meta_name; ?></h4>
		<ul class="list-related">
			<?php foreach( $this->posts->latest((--$value->limit), 1) as $row) : ?>
			<li>
				<a href="<?php echo $this->posts->permalink($row->ID) ?>" itemprop="relatedLink" title="<?php echo $row->post_title; ?>">
					<?php echo $row->post_title; ?>
				</a>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>