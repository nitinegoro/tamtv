<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Main Mobile Template
 *
 *
 * @package Codeigniter
 * @subpackage Tamtv Template
 * @since Tamtv 1.0
 */

$this->load->view('mobile/header', $this->data);

$author = $this->posts->get_post_author($post->ID);
?>
<div class="start"></div>
<div class="bg-white">
<div class="content-breadcrumb padding">
	<?php  
	/**
	 * Displayed Breadcrumbs
	 *
	 * @return string
	 **/
	echo $this->breadcrumbs->show();
	?>
</div>
<article class="content-news" itemscope itemtype="http://schema.org/NewsArticle">
	<h1 class="padding" itemprop="name"><?php echo $post->post_title ?></h1>
	<div class="box-author">
		<span class="author">
		<?php 
		if($this->posts->get_post_author($post->ID)) 
			echo 'Oleh <a class="author-name">'.$author->fullname.'</a>,';
		?>
		</span>
		<time class="padding" itemprop="datePublished"><?php echo $this->posts->date_format($post->post_date); ?></time>
	</div>
	<?php  
	if( $post->image AND $post->post_type != 'video' AND $this->posts->getphoto($post->ID) == FALSE) :
	?>
	<figure class="top2x" align="center">
		<img src="<?php echo $this->posts->get_thumbnail($post->image) ?>" alt="<?php echo $post->post_title ?>" class="img-responsive">
		<figcaption><?php echo $post->post_excerpt; ?> </figcaption>
	</figure>
	<?php elseif($post->post_type == 'video') : ?>
	<figure class="top2x" align="center">
		<iframe width="100%" height="250" src="https://www.youtube.com/embed/<?php echo $this->posts->getmeta('video', $post->ID) ?>?autoplay=1" frameborder="0" allowfullscreen></iframe>
		<figcaption><?php echo $post->post_excerpt; ?> </figcaption>
	</figure>
	<?php endif; ?>
	<div class="sharethis-inline-share-buttons padding"></div>
	<?php
		foreach( $this->posts->getphoto($post->ID) as $row) :
			$img = json_decode($row->meta_value);
	?>
	<figure class="top2x">
		<img src="<?php echo base_url("public/image/news/photos/$img->image") ?>" alt="<?php echo $img->caption; ?>" class="img-responsive">
		<figcaption><?php echo $img->caption; ?> </figcaption>
	</figure>
	<?php endforeach; ?>
	<section class="padding" itemprop="description">
		<?php echo str_replace('<p>[related_news]</p>', $this->content_parser->related_news($post->ID, 4), $post->post_content); ?>
	</section>
	
	<section class="box-tag padding">
		<ul class="list-tag">
		<?php  
		/**
		 * Get displaye post tag
		 *
		 * @param Integer
		 **/
		foreach($this->posts->get_post_tags($post->ID) as $row)
			echo '<li>'.anchor(base_url("tag/{$row->slug}"), $row->name).'</li>';
		?>
		</ul>
	</section>
	<?php if( str_word_count($post->post_content) >= 100) : ?>
	<div class="sharethis-inline-share-buttons padding"></div>
	<?php endif; ?>
	<section class="pager">
		<div class="col-xs-6">
			<?php if($prevpost) : ?>
			<a href="<?php echo $this->posts->permalink($prevpost->ID) ?>" title="<?php echo $prevpost->post_title; ?>">
				<div class="pager-info"><span class="grey">&larr;</span> Sebelumnya</div>
				<span class="news-title"><?php echo $prevpost->post_title; ?></span>
			</a>
			<?php endif; ?>
		</div>
		<div class="col-xs-6">
			<?php if($nextpost) : ?>
			<a href="<?php echo $this->posts->permalink($nextpost->ID) ?>" title="<?php echo $nextpost->post_title; ?>">	
				<div class="pager-info">Berikutnya <span class="grey">&rarr;</span></div>
				<span class="news-title"><?php echo $nextpost->post_title; ?></span>
			</a>
			<?php endif; ?>
		</div>
	</section>
	<?php  
	/**
	 * Get Polling Post
	 *
	 * @var string
	 **/
	$this->load->view('mobile/box/box-polling', $this->data);

	/**
	 * Get Comment Post
	 *
	 * @var string
	 **/
	$this->load->view('mobile/box/box-comment', $this->data);
	?>
</article>
<section class="box-thumbnail">
<?php 
	/**
	 * Get Comment Post
	 *
	 * @var string
	 **/
	$this->load->view('mobile/box/related-single', $this->data);
?>
</section>
</div>
<div class="clearfix"></div>
<div class="container-fluid">
	<h3 class="featured-heading"> Berita Populer </h3>
	<?php  
	/**
	 * Get Latest Post
	 *
	 * @param String (post_type)
	 * @param Integer (limit)
	 * @param Integer (offset)
	 **/
	foreach($this->posts->most_viewer(6, 1) as $key => $post) :
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
</div>
<?php
$this->load->view('mobile/footer', $this->data);
/* End of file main.php */
/* Location: ./application/views/mobile/main.php */