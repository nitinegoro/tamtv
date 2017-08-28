	<?php  
	/**
	 * Get Post By Type
	 *
	 * @param String (post_type)
	 * @param Integer (limit)
	 * @param Integer (offset)
	 **/
	$headline = 0;
	foreach( $this->posts->get_type('headline', 1, 0, 'result') as $post) :
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
				<a href="<?php echo base_url("kategori/{$category->slug}") ?>" class="category"><?php echo $category->name ?></a> 
				| <time class="timeago" datetime="<?php echo $post->post_date; ?>"></time>
			</div>
		</div>
	</div>
<?php endforeach; ?>