<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package Codeigniter
 * @subpackage Tamtv Template
 * @since Tamtv 1.0
 */
?>
<!DOCTYPE html>
<html lang="id-ID" itemscope="itemscope" itemtype="http://schema.org/WebPage">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Refresh" content="900" />
	<title><?php echo $title ?> - <?php echo $this->options->get('sitename') ?></title>
	<link rel="shortcut icon" href="<?php echo base_url("public/image/site/favicon.png"); ?>">
	<link rel="stylesheet" href="<?php echo base_url("public/bootstraps/css/bootstrap.min.css"); ?>">
	<link rel="stylesheet" href="<?php echo base_url("public/font-awesome/css/font-awesome.min.css"); ?>">
	<link rel="stylesheet" href="<?php echo base_url("public/theme/css/main.css?v=".md5(date('YmdHis'))); ?>">
	<link rel="stylesheet" href="<?php echo base_url("public/theme/css/daterangepicker-bs3.min.css"); ?>">
	<link rel="stylesheet" href="<?php echo base_url("public/bxslider/jquery.bxslider.css?v=".md5(date('YmdHis'))); ?>">
	<link rel="stylesheet" href="<?php echo base_url("public/viewer/viewer.min.css"); ?>">
	<link rel="stylesheet" href="<?php echo base_url('public/owlcarousel/assets/owl.carousel.min.css') ?>">
	<link type="text/css" rel="stylesheet" href="<?php echo base_url("public/lightgallery/dist/css/lightGallery.min.css") ?>" />  
	<?php  
	/*
	*  Meta Tags
	*/
	echo $this->meta_tags->generate_meta_tags();
	/*
	*	Meta Social
	*/
	echo $this->meta_tags->generate_meta_social();

	echo PHP_EOL;

	if($this->router->fetch_method() == 'getpost') :
	?>
	<meta property="article:modified_time" content="<?php echo $post->post_modified; ?>" />
	<meta property="article:published_time" content="<?php echo $post->post_date ?>" />
	<meta property="article:section" content="<?php echo $metacategory ?>" />
	<meta property="article:tag" content="<?php echo $news_keyword; ?>" />
	<?php endif; ?>
	<meta property="og:locale" content="id_ID" />
	<meta name="robots" content="index, follow" />
	<meta property="og:url" content="<?php echo current_url() ?>" />
	<meta name="google-site-verification" content="QUYkDXISa5DHjstLgiS03CcmVqXKc_K5ERqlE6jqwPQ" />
	<meta name="fb:admins" content="tamnewsbabel" />
	<meta property="fb:app_id" content="141250066463038"/>
	<meta property="fb:pages" content="426577360732884" />
	<meta name="twitter:card" content="summary_large_image"/>
	<meta name="twitter:site" content="@tamnewsid"/>
	<meta name="twitter:site:id" content="17128975" />
	<meta name="googlebot-news" content="index,follow" />
	<meta name="googlebot" content="index,follow" />
	<meta name="robots" content="index,follow" />
	<meta http-equiv="content-language" content="In-Id" />
	<meta name="twitter:creator" content="@tamnewsid" />
	<link rel="dns-prefetch" href="https://api-read.facebook.com" />
	<!-- Global Site Tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-106693435-1"></script>
	<script>
		/* TAG MANAGER */
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments)};
	  gtag('js', new Date());
	  gtag('config', 'UA-106693435-1');
	  /* ANALITICS */
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
	  ga('create', 'UA-106693435-1', 'auto');
	  ga('send', 'pageview');
	</script>

</head>
<body>
<?php

/* End of file header.php */
/* Location: ./application/views/header.php */