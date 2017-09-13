<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
?>
<body class="hold-transition skin-black-light sidebar-collapse sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <nav class="navbar navbar-static-top">
                <?php  
                /**
                 * Displayed main logo
                 * form table options 
                 *
                 * @param String (main_logo)
                 **/
                if( $this->options->get('main_logo', TRUE)->image )
                    echo '<img src="'.$this->options->get('main_logo', TRUE)->image.'" width="200" style="padding:8px;">';
                ?>  
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu" data-toggle="tooltip" data-placement="bottom" title="Pengaturan Login">
                            <a href="<?php echo site_url('administrator/users/account'); ?>">
                                <i class="fa fa-user"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" data-toggle="modal" data-target="#logout" data-placement="bottom" title="Keluar dari Sistem">
                                <i class="fa fa-power-off"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
<?php  
/* End of file navbar.php */
/* Location: ./application/views/administrator/navbar.php */
?>

