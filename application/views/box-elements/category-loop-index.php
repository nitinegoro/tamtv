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
$box = $this->themes->get('category-loop-index');

$value = json_decode($box->meta_value);
?>
<div class="clearfix"></div>
<div class="box-big-loop" itemscope itemtype="http://schema.org/Article">
	<div class="block-box">
		<h3 class="featured-heading"> 
			<?php echo $box->meta_name ?> 
			<a href="<?php echo $this->category->get_category_uri($value->category); ?>" class="btn btn-read-all pull-right">Lihat Semua ..</a>
		</h3> 
		<div class="line"></div>
	</div>
	<?php  
	/**
	 * Get Latest Post
	 *
	 * @param String (post_type)
	 * @param Integer (limit)
	 * @param Integer (offset)
	 **/
	foreach( $this->posts->category($value->category, $value->limit, 0, 'results') as $key => $post) :
	?>
	<div class="big-loop-item">
		<a href="<?php echo $this->posts->permalink($post->ID) ?>" title="<?php echo $post->post_title; ?>">
			<img src="<?php echo $this->posts->get_thumbnail($post->image, 'small'); ?>" alt="<?php echo $post->post_title; ?>" class="img-responsive">
		</a>
		<div class="item-content">
			<time class="timeago" datetime="<?php echo $post->post_date; ?>"></time>
			<h4 class="item-heading">
				<a href="<?php echo $this->posts->permalink($post->ID) ?>" title="<?php echo $post->post_title; ?>">
					<?php if($this->posts->getmeta('video', $post->ID)) echo '<i class="fa fa-play-circle-o"></i> '; echo $post->post_title; ?>
				</a>
			</h4>
			<p><?php echo ($post->post_excerpt != '') ? strip_tags($post->post_excerpt) : strip_tags(word_limiter($post->post_content, 10)) ?></p>
		</div>
	</div>
	<?php endforeach; ?>
</div>
<?php
/* End of file category-loop-index.php */
/* Location: ./application/views/box-elements/category-loop-index.php */