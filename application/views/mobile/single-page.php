<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Single Page Mobile Template
 *
 *
 * @package Codeigniter
 * @subpackage Tamtv Template
 * @since Tamtv 1.0
 */

$this->load->view('mobile/header', $this->data);
?>
<div class="start"></div>
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
		<time class="padding" itemprop="datePublished"><?php echo $this->posts->date_format($post->post_date); ?></time>
	</div>
	<?php  
	if( $post->image AND $post->post_type != 'vidio') :
	?>
	<figure class="top2x" align="center">
		<img src="<?php echo $this->posts->get_thumbnail($post->image) ?>" alt="<?php echo $post->post_title ?>" class="img-responsive">
		<figcaption><?php echo $post->post_excerpt; ?> </figcaption>
	</figure>
	<?php elseif($post->post_type == 'vidio') : ?>
	<figure class="top2x" align="center">
		<iframe width="100%" height="250" src="https://www.youtube.com/embed/<?php echo $this->posts->getmeta('vidio', $post->ID) ?>?autoplay=1" frameborder="0" allowfullscreen></iframe>
		<figcaption><?php echo $post->post_excerpt; ?> </figcaption>
	</figure>
	<?php endif; ?>
	<div class="sharethis-inline-share-buttons padding"></div>
	<section class="padding" itemprop="description">
		<?php echo str_replace('<p>[related_news]</p>', $this->content_parser->related_news($post->ID, 4), $post->post_content); ?>
	</section>
</article>
<?php
$this->load->view('mobile/footer', $this->data);
/* End of file main.php */
/* Location: ./application/views/mobile/main.php */