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
$box = $this->themes->get('box-thumbnail-foto');

$value = json_decode($box->meta_value);

if( $this->posts->get_type('photo', 1, 0, 'result') ) :
?>
<section class="box-foto">
	<div class="block-box">
		<h3 class="featured-heading"> <?php echo $box->meta_name ?> </h3> 
		<div class="line"></div>
	</div>
	<div class="photo-galery">
		<?php foreach( $this->posts->get_type('photo', 1, 0, 'result') as $post) : ?>
		<div class="one-photo">
  			<img alt="<?php echo $post->post_title; ?>" src="<?php echo $this->posts->get_thumbnail($post->image); ?>" class="imagepone">
  			<a href="<?php echo $this->posts->permalink($post->ID) ?>#lg=1&slide=0" title="<?php echo $post->post_title; ?>"> <?php echo $post->post_title; ?></a>
  			<span class="camera-icon"><i class="fa fa-camera"></i> <?php echo count($this->posts->getphoto($post->ID)) ?> Foto</span>
  			<div class="one-overlay"> </div>
		</div>
		<?php
		endforeach;  
		foreach( $this->posts->get_type('photo', 5, 1, 'result') as $post) :
		?>
		<div class="photo">
  			<img alt="<?php echo $post->post_title; ?>" src="<?php echo $this->posts->get_thumbnail($post->image); ?>" class="imagepone">
  			<a href="<?php echo $this->posts->permalink($post->ID) ?>#lg=1&slide=0" title="<?php echo $post->post_title; ?>"> <?php echo $post->post_title; ?></a>
  			<span class="camera-icon"><i class="fa fa-camera"></i> <?php echo count($this->posts->getphoto($post->ID)) ?> Foto</span>
  			<div class="one-overlay"> </div>
		</div>
		<?php
		endforeach;
		?>
	</div>
</section>
<div class="col-xs-12"><hr></div>
<!-- <div class="box-big-loop" itemscope itemtype="http://schema.org/Article">
	<?php  
	/**
	 * Get Latest Post
	 *
	 * @param String (post_type)
	 * @param Integer (limit)
	 * @param Integer (offset)
	 **/
	foreach( $this->posts->get_type('photo', $value->limit, 6, 'result') as $key => $post) :
	?>
	<div class="big-loop-item">
		<a href="<?php echo $this->posts->permalink($post->ID) ?>" title="<?php echo $post->post_title; ?>">
			<img src="<?php echo $this->posts->get_thumbnail($post->image, 'small'); ?>" alt="<?php echo $post->post_title; ?>" class="img-responsive">
		</a>
		<div class="item-content">
		<?php  
		/**
		 * Get Post Categories
		 *
		 * @param String (category_id)
		 **/
		$category = $this->posts->get_post_category($post->ID);

		if( $category ) 
			echo anchor(
					base_url("kategori/{$category->slug}"), 
					'<span class="category-title">'.$category->name.'</span>', 
					array('titel' => $category->name)
				);
		?>
			<time class="timeago" datetime="<?php echo $post->post_date; ?>"></time>
			<h4 class="item-heading">
				<a href="<?php echo $this->posts->permalink($post->ID) ?>" title="<?php echo $post->post_title; ?>">
					<?php if($this->posts->getmeta('video', $post->ID)) echo '<i class="fa fa-play-circle-o"></i> '; echo $post->post_title; ?>
				</a>
			</h4>
			<p><?php echo strip_tags(word_limiter($post->post_content, 10)) ?></p>
		</div>
	</div>
	<?php endforeach; ?>
</div> -->
<?php
endif;
/* End of file box-thumbnail-foto.php */
/* Location: ./application/views/box-elements/box-thumbnail-foto.php */