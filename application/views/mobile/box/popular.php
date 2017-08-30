<?php  
/**
 * Get Latest Post
 *
 * @param String (post_type)
 * @param Integer (limit)
 * @param Integer (offset)
 **/
foreach($this->posts->most_viewer(1, 0) as $key => $post) :
	$category = $this->posts->get_post_category($post->ID);
?>
	<div class="headline-news">
		<a href="">
			<img src="<?php echo $this->posts->get_thumbnail($post->image, 'large'); ?>" alt="" class="img-responsive">
		</a>
		<div class="content-headline">
			<a href="">
				<h1><?php echo $post->post_title; ?></h1>
			</a>
			<div class="desc">
				<a href="<?php echo base_url("kategori/{$category->slug}") ?>" class="category"><?php echo $category->name ?></a> 
				| <time class="timeago" datetime="<?php echo $post->post_date; ?>"></time>
			</div>
		</div>
	</div>
<?php endforeach; ?>
</div>
<div class="container-fluid padding">
	<?php  
	/**
	 * Get Latest Post
	 *
	 * @param String (post_type)
	 * @param Integer (limit)
	 * @param Integer (offset)
	 **/
	foreach($this->posts->most_viewer(10, 1) as $key => $post) :
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
						array('title' => $category->name)
					);
			?>
			<time class="timeago" datetime="<?php echo $post->post_date; ?>"></time>
		  	<a href="<?php echo $this->posts->permalink($post->ID) ?>" title="<?php echo $post->post_title; ?>">
		    	<h4 class="media-heading"><?php echo $post->post_title ?></h4>
		    </a>
  		</div>
	</div>
<?php endforeach; ?>