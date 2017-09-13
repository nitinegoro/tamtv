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
<div class="bg-blue">
	<?php  
	$this->load->view('mobile/box/topic-trend-top', $this->data );
	?>
	<div class="tag-header">
		<h1 class="tag-heading"><?php echo $tag->name; ?></h1>
		<ul class="tag-cloud-image">
		<?php foreach( $posttags as $key => $row) : ?>
			<li>
				<img src="<?php echo $this->posts->get_thumbnail($row->image, 'x-small'); ?>" alt="<?php echo $row->post_title; ?>">
			</li>
		<?php endforeach; ?>
		</ul>
		<p class="tag-description"><?php echo $tag->description ?></p>
	</div>
</div>
<?php  
	echo $this->themes->get_element('mobile-index','top-index');
?>
<div class="padding">
	<?php  
	/**
	 * Get Latest Post
	 *
	 * @param String (post_type)
	 * @param Integer (limit)
	 * @param Integer (offset)
	 **/
	foreach( $posttags as $q => $post) :
	?>
	<div class="media">
  		<div class="media-left">
			<a href="<?php echo $this->posts->permalink($post->ID) ?>" title="<?php echo $post->post_title; ?>">
				<img src="<?php echo $this->posts->get_thumbnail($post->image, 'x-small'); ?>" alt="<?php echo $post->post_title; ?>" class="media-object" width="100">
			</a>
  		</div>
  		<div class="media-body">
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
		  	<a href="<?php echo $this->posts->permalink($post->ID) ?>" title="<?php echo $post->post_title; ?>">
		    	<h4 class="media-heading"><?php echo $post->post_title ?></h4>
		    </a>
  		</div>
	</div>
<?php endforeach; ?>
</div>
<div class="clearfix"></div>
<div class="padding text-center">
	<?php echo $this->pagination->create_links(); ?>
</div>
<?php
$this->load->view('mobile/footer', $this->data);
/* End of file tags.php */
/* Location: ./application/views/mobile/tags.php */