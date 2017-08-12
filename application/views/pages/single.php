<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * The template for displaying the single page
 *
 * Displays all of the single element.
 *
 * @package Codeigniter
 * @subpackage Tamtv Template
 * @author Vicky Nitinegoro <pkpvicky@gmail.com>
 * @since Tamtv 1.0
 */

?>
	<div class="container content-wrapper">
		<div class="col-xs-8 single-content">
			<div class="content-breadcrumb">
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
				<h1 itemprop="name"><?php echo $post->post_title; ?></h1>
				<div class="author-box">
					<div class="media">
					  	<div class="media-left media-middle">
					    	<a href="#">
					      		<img class="media-object img-circle" src="public/image/site/author.png" alt="..." width="40">
					    	</a>
					  	</div>
					  	<div class="media-body">
					    	<a class="media-heading">Middle aligned media</a> <br>
					   		<time itemprop="datePublished"><?php echo $this->posts->date_format($post->post_date); ?></time>
					  	</div>
					</div>
					<div class="sharethis-inline-share-buttons"></div>
				</div>
				<?php  
				if( $post->image ) :
				?>
				<figure>
				  	<img src="<?php echo $this->posts->get_thumbnail($post->image) ?>" alt="" class="img-responsive">
				  	<figcaption><?php echo $post->post_excerpt; ?> {news_keyword}</figcaption>
				</figure>
				<?php endif; ?>
				<section itemprop="description">
					<?php echo str_replace('[related_news]', $this->content_parser->related_news($post->ID, 4), $post->post_content); ?>
				</section>
			</article>
			<?php  
			/**
			 * Load the elements sidebar
			 *
			 * @param string ( themes layout )
			 **/
			foreach ($this->themes->layout('content-single') as $row) 
				$this->load->view('box-elements/'.$row->meta_key);
			?>
		</div>
<?php
/* End of file single.php */
/* Location: ./application/views/pages/single.php */