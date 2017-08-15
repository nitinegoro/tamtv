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

$author = $this->posts->get_post_author($post->ID);
?>
	<div class="container content-wrapper">
		<div class="col-xs-12 single-content">
			<div class="content-breadcrumb pull-right">
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
				<div class="author-box border-bottom">
					<div class="media">
						<time itemprop="datePublished"><?php echo $this->posts->date_format($post->post_date); ?></time>
					</div>
					<div class="sharethis-inline-share-buttons"></div>
				</div>
				<section itemprop="description">
					<?php echo $post->post_content; ?>
				</section>
			</article>
		</div>
	</div>
<?php
/* End of file page.php */
/* Location: ./application/views/pages/page.php */