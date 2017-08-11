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
	<title><?php echo $title ?></title>
	<link rel="stylesheet" href="<?php echo base_url("public/bootstraps/css/bootstrap.css"); ?>">
	<link rel="stylesheet" href="<?php echo base_url("public/font-awesome/css/font-awesome.min.css"); ?>">
	<link rel="stylesheet" href="<?php echo base_url("public/theme/css/main.css"); ?>">
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
	?>
	<meta name="fb:admins" content="tamtvbabel" />
	<meta property="fb:app_id" content=""/>
	<meta property="fb:pages" content="426577360732884" />
	<meta name="twitter:card" content="summary_large_image"/>
	<meta name="twitter:site" content="@[PROFILE HERE]"/>
	<meta name="twitter:site:id" content="17128975" />
	<meta name="googlebot-news" content="index,follow" />
	<meta name="googlebot" content="index,follow" />
	<meta name="robots" content="index,follow" />
	<meta http-equiv="content-language" content="In-Id" />
	<meta name="twitter:creator" content="@[PROFILE HERE]" />
	<link rel="dns-prefetch" href="https://api-read.facebook.com" />
	<link rel="author" href="https://plus.google.com/[YOUR PERSONAL G+ PROFILE HERE]"/>
</head>
<body>
<?php
/* End of file header.php */
/* Location: ./application/views/header.php */