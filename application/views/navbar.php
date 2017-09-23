<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * The template for displaying the navbar
 *
 * Displays all of the navbar element.
 *
 * @package Codeigniter
 * @subpackage Tamtv Template
 * @since Tamtv 1.0
 */
?>
	<div class="container">
		<nav class="navbar navbar-default">
	    	<div class="navbar-header">
	      		<a class="navbar-brand" href="<?php echo base_url(); ?>">
	      		<?php  
	    		/**
	    		 * Displayed main logo
	    		 * form table options 
	    		 *
	    		 * @param String (main_logo)
	    		 **/
	      		if( $this->options->get('main_logo', TRUE)->image )
	      			echo '<img src="'.$this->options->get('main_logo', TRUE)->image.'" alt="'.$this->options->get('main_logo', TRUE)->alt.'" class="main-logo">';
	      		?>
	      		</a>
	    	</div>
		    <form class="navbar-form navbar-left" action="<?php echo base_url("search") ?>" itemprop="potentialAction" itemscope itemtype="http://schema.org/SearchAction">
		      	<div class="form-group">
		        	<input type="text" class="form-control" itemprop="query-input" name="q" value="<?php echo $this->input->get('q') ?>" placeholder="Berita apa yang ingin Anda Baca hari ini?">
		        <?php  
					if( $this->router->fetch_method() == 'search' )
						echo '<meta itemprop="target" content="'.base_url().'search?q={q}"/>';
		        ?>
		      	</div>
		      	<button type="submit" class="btn btn-default">Cari</button>
		    </form>
    		<ul class="nav navbar-nav navbar-right navbar-user">
	    		<?php 
	    		/**
	    		 * Displayed User Menu
	    		 * if permission ( akun ) else (login or signup )
	    		 *
	    		 **/
	    		if($this->user_login == FALSE) : 
	    		?>
      			<li><a href="<?php echo base_url("login?back-to=".current_url()) ?>">Masuk</a></li>
      			<li><a href="<?php echo base_url("signup?back-to=".current_url()); ?>">Daftar</a></li>
	      		<?php else : ?>
 	      		<li class="dropdown">
	        		<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					<i class="fa fa-user-o" style="padding-right: 10px;"></i>
	        		<?php echo $this->session->userdata('user')->fullname; ?>
	        		<span class="caret"></span></a>
	        		<ul class="dropdown-menu">
	          			<li><a href="<?php echo base_url("me/{$this->session->userdata('user')->username}") ?>">Profil Saya</a></li>
	          			<li><a href="<?php echo base_url("me/change_password"); ?>">Ganti Password</a></li>
	          			<li><a href="<?php echo base_url("login/signout?back-to=".current_url()); ?>">Logout</a></li>
	        		</ul>
	      		</li>
	      		<?php endif; 
	      		/* End user menu */
	      		?>
    		</ul>
    		<ul class="nav navbar-nav coloring navbar-primary text-center" itemscope itemtype="https://schema.org/SiteNavigationElement">
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
    		<?php if( $this->router->fetch_class() == 'main' AND $this->router->fetch_method() != 'live') :
    		if( $this->options->get('live-mode') == 'enable') :
    		?>
    		<ul class="nav navbar-nav navbar-right navbar-live">
    			<li class="live-menu">
    				<a href="<?php echo base_url("live"); ?>">
    					<div class="live-circle"><i class="fa fa-play-circle-o "></i></div>
    					<div class="text-live-menu">live Streaming</div>
    				</a>
    			</li>
    		</ul>
    		<?php endif; endif; ?>
		</nav>
	</div>
<?php
/* End of file navbar.php */
/* Location: ./application/views/navbar.php */