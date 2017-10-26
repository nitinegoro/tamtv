	<?php  
	/**
	 * Get Latest Post
	 *
	 * @param String (post_type)
	 * @param Integer (limit)
	 * @param Integer (offset)
	 **/
	foreach( $this->posts->latest(15, 0, 'result') as $key => $post) :
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