<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * The template for displaying the Specifik two by Tag
 *
 * Displays all of the Specifik two right element.
 *
 * @package Codeigniter
 * @subpackage Tamtv Template
 * @author Vicky Nitinegoro <pkpvicky@gmail.com>
 * @since Tamtv 1.0
 */
//$box = $this->themes->get('specific-one');

switch ($this->router->fetch_method()) {
	case 'getpost':
		$box = $this->themes->get('specific-one','sidebar-single');
		break;
	default:
		$box = $this->themes->get('specific-one', 'sidebar-index');
		break;
}
if( $box ) :
$value = json_decode($box->meta_value);
?>
<div id="<?php if($value->sticky == 'yes') echo 'sticker'; ?>">
<div class="box-category-1" itemscope itemtype="http://schema.org/Article">
	<?php  
	/**
	 * Get Post By Type
	 *
	 * @param Integer (tag_id)
	 * @param Integer (limit)
	 * @param Integer (offset)
	 **/
	foreach( $this->posts->tags($value->tags, 1, 0 , 'results') as $post) :
	?>
	<h3 class="sidebar-heading"><?php echo $box->meta_name; ?></h3>
	<a href="<?php echo $this->posts->permalink($post->ID) ?>" title="<?php echo $post->post_title; ?>">
		<img src="<?php echo $this->posts->get_thumbnail($post->image, 'small'); ?>" alt="<?php echo $post->post_title; ?>" class="img-responsive">
	</a>
	<div class="item-featured">
		<h4 class="item-heading">
			<a href="<?php echo $this->posts->permalink($post->ID) ?>" itemprop="name" title="<?php echo $post->post_title; ?>"><?php echo $post->post_title; ?></a>
		</h4>
	</div>
	<?php endforeach; ?>
	<div class="media-news">
	<?php  
	foreach( $this->posts->tags($value->tags, --$value->limit, 1 , 'results') as $post) :
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
endif;
/* End of file specific-one.php */
/* Location: ./application/views/box-elements/specific-one.php */