<?php  
/**
 * Main Template Mobile
 *
 * @package Codeigniter
 * @subpackage Tamtv Template
 * @since Tamtv 1.0
 * @author Vicky Nitinegoro <pkpvicky@gmail.com>
 **/
?>
<!DOCTYPE html>
<html lang="id">
<head>
  	<meta name="robots" content="index, follow"/>
  	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=7">
    
    <title><?php echo $title ?></title>

  	<meta name="language" content="ed-ID"/>
  	<meta name="author" content="tamtvbabel"/>
    <?php  
    /*
    *  Meta Tags
    */
    echo $this->meta_tags->generate_meta_tags();
    /*
    * Meta Social
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

  	<meta name="twitter:card" content="summary_large_image"/>
  	<meta name="twitter:image" content="">
  	<meta name="twitter:site" content="@TAMTVBabel"/>
  	<meta name="twitter:creator" content="@TAMTVBabel"/>
    <?php if($this->router->fetch_method() == 'index' AND $this->router->fetch_class() == 'main') : ?>
  	<meta name="msapplication-TileColor" content="#0000e5">
  	<meta name="theme-color" content="#0000e5">
    <?php endif; ?>
  	<meta name="mobile-web-app-capable" content="yes">
  	<meta name="apple-mobile-web-app-capable" content="yes">
  	<meta name="apple-mobile-web-app-title" content="Tempayan">
  	<meta name="apple-mobile-web-app-status-bar-style" content="black">  
  	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
  	<meta name="HandheldFriendly" content="true">

    <link rel="dns-prefetch" href="https://api-read.facebook.com" />
    <link rel="shortcut icon" href="<?php echo base_url("public/image/site/favicon.png"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("public/mobile/css/style.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("public/bootstraps/css/bootstrap.min.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("public/font-awesome/css/font-awesome.min.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("public/mobile/css/component.css?v=".md5(date('YmdHis'))); ?>">
    
    <script src="<?php echo base_url("public/theme/js/jquery-3.2.1.min.js"); ?>"></script>
    <script src="<?php echo base_url("public/bootstraps/js/bootstrap.min.js"); ?>"></script>
    <script src="<?php echo base_url("public/theme/js/jquery.timeago.js");?>" type="text/javascript"></script>
    <script src="<?php echo base_url("public/mobile/js/component.js"); ?>"></script>
    <script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=59227929b27f700011ad0da3&product=inline-share-buttons' async='async'></script>
    <script type="text/javascript">
        var base_url = '<?php echo site_url(); ?>',
            base_path  = '<?php echo base_url('public'); ?>';
            current_url = '<?php echo current_url(); ?>';
    </script>
    <script src="<?php echo base_url("public/appjs/app.js"); ?>"></script>
    <script src="<?php echo base_url("public/theme/mobile/js/main.js"); ?>"></script>
    <?php 

    /**
     * Load js from loader core
      *
     * @return CI_OUTPUT
     **/
    if($this->load->get_js_files() != FALSE) : 
        foreach($this->load->get_js_files() as $file) :  
    ?>
    <script src="<?php echo $file; ?>"></script>
    <?php 
        endforeach; 
    endif; 
    ?>
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?php if( $this->options->get('live-mode') == 'enable') : ?>
            <a href="<?php echo $this->options->get('live-streaming') ?>" class="btn-live left">
                <i class="fa fa-video-camera"></i>
            </a>
            <?php endif; ?>
            <a class="navbar-brand" href="<?php echo base_url() ?>">
                <?php  
                /**
                 * Displayed main logo
                 * form table options 
                 *
                 * @param String (main_logo)
                 **/
                if( $this->options->get('small_logo', TRUE)->image )
                    echo '<img src="'.$this->options->get('small_logo', TRUE)->image.'" alt="'.$this->options->get('small_logo', TRUE)->alt.'" class="main-logo">';
                ?>
            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <div class="user-menu">
                <ul class="menu">
                <?php 
                /**
                 * Displayed User Menu
                 * if permission ( akun ) else (login or signup )
                 *
                 **/
                if($this->user_login == FALSE) : 
                ?>
                    <li><a href="<?php echo base_url("signup"); ?>">Daftar</a></li>
                    <li><a href="<?php echo base_url("login") ?>">Masuk</a></li>
                <?php else : ?>
                    <li>
                      <a href="<?php echo base_url("login/signout?back-to=".current_url()); ?>">Logout</a>
                      <i class="fa fa-sign-out" style="padding-left: 10px;"></i>
                    </li>
                <?php endif; 
                /* End user menu */
                ?>
                </ul>
                <div href="" class="avatar">
                    <img src="<?php echo base_url("public/image/avatar/author.png") ?>" class="img-circle" alt="user avatar">
                    <span><?php if($this->user_login == FALSE) echo 'Halo Sobat pembaca'; else echo $this->session->userdata('user')->fullname ?></span>
                </div>
            </div>
            <form class="navbar-form" action="<?php echo base_url("search"); ?>" role="search">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Berita apa yang ingin anda baca hari ini?" name="q">
                <div class="input-group-btn">
                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                </div>
            </div>
            </form> 
            <ul class="nav navbar-nav">
                <li class="dropdown-header">MENU NAVIGASI</li>
                <?php  
                /**
                 * Displayed Queries menu
                 *
                 * @param String (key)
                 * @param Integer (parent)
                 **/
                foreach( $this->menus->get('primary_menu', NULL) as $row) 
                {
                    if( $this->menus->get('primary_menu', $row->ID) == FALSE)
                    {
                        echo '<li><a itemprop="url" href="'.$row->url.'" target="'.$row->target.'"><span itemprop="name">'.$row->label.'</span></a></li>';
                    } else {
                        echo '<li class="dropdown"><a class="dropdown-toggle" itemprop="name" data-toggle="dropdown" href="#">'.$row->label.'
                                    <span class="caret"></span></a>';

                        echo '<ul class="dropdown-menu">';

                        foreach( $this->menus->get('primary_menu', $row->ID) as $child)
                        {
                            echo '<li><a itemprop="url" href="'.$child->url.'" target="'.$child->target.'"><span itemprop="name">'.$child->label.'</span></a></li>';
                        }

                        echo '</ul></li>';
                    }
                }
                ?>
            </ul>
        </div><!--/.nav-collapse -->
</nav>