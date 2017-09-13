<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Main Category Mobile Template
 *
 *
 * @package Codeigniter
 * @subpackage Tamtv Template
 * @since Tamtv 1.0
 */

$this->load->view('mobile/header', $this->data);
?>
<div class="start"></div>
<?php  
	echo $this->themes->get_element('mobile-index','top-index');
?>
<div class="bg-blue">
	<?php  
	$this->load->view('mobile/box/topic-trend-top', $this->data );
	?>
	<div class="container-fluid border-top">
		<div class="box">
			<h3 class="box-heading no-padding"><?php echo $category->name; ?></h3>
			<p class="category-description"><?php echo $category->description ?></p>
		</div>
	</div>
	<?php  
	/**
	 * Get Post By Type
	 *
	 * @param String (post_type)
	 * @param Integer (limit)
	 * @param Integer (offset)
	 **/
	$headline = 0;
	foreach( $this->posts->category($category->category_id, 1, 0, 'result') as $post) :
		$category = $this->posts->get_post_category($post->ID);
	?>
	<div class="headline-news">
		<a href="">
			<img src="<?php echo $this->posts->get_thumbnail($post->image, 'large'); ?>" alt="<?php echo $post->post_title; ?>" class="img-responsive">
		</a>
		<div class="content-headline">
		  	<a href="<?php echo $this->posts->permalink($post->ID) ?>" title="<?php echo $post->post_title; ?>">
		    	<h1><?php echo $post->post_title ?></h1>
			</a>
			<div class="desc">
				<time class="timeago" datetime="<?php echo $post->post_date; ?>"></time>
			</div>
		</div>
	</div>
	<?php endforeach; ?>
</div>
<div class="clearfix"></div>
<div class="padding">
	<?php  
	/**
	 * Get Latest Post
	 *
	 * @param String (post_type)
	 * @param Integer (limit)
	 * @param Integer (offset)
	 **/
	foreach( $categories as $q => $post) :
	?>
	<div class="media">
  		<div class="media-left">
			<a href="<?php echo $this->posts->permalink($post->ID) ?>" title="<?php echo $post->post_title; ?>">
				<img src="<?php echo $this->posts->get_thumbnail($post->image, 'x-small'); ?>" alt="<?php echo $post->post_title; ?>" class="media-object" width="100">
			</a>
  		</div>
  		<div class="media-body">
			<time class="no-left timeago" datetime="<?php echo $post->post_date; ?>"></time>
		  	<a href="<?php echo $this->posts->permalink($post->ID) ?>" title="<?php echo $post->post_title; ?>">
		    	<h4 class="media-heading"><?php echo $post->post_title ?></h4>
		    </a>
  		</div>
	</div>
<?php endforeach; ?>
</div>
<?php if( count($categories) >= 10) : ?>
<div class="bg-blue">
	<div class="container-fluid">
		<div class="box">
			<a href="" class="more-button-icon"><i class="fa fa-plus"></i></a>
			<h3 class="box-heading">Most popular</h3>
		</div>
	</div>
	<?php  
	/**
	 * Headline News
	 *
	 * @var string
	 **/
	$this->load->view('mobile/box/popular', $this->data, FALSE);
	?>
</div>
<?php endif; ?>
<?php
$this->load->view('mobile/footer', $this->data);
/* End of file main.php */
/* Location: ./application/views/mobile/main.php */