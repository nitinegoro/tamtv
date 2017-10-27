	<nav class="navbar navbar-default" id="sticky-navbar" style="background-color: white; margin-top: 0px;">
	  	<div class="container navbar-sticky">
	     	<div class="collapse navbar-collapse">
	    		<ul class="nav navbar-nav coloring navbar-primary text-center">
	    			<li>
	    				<a href="<?php echo base_url(); ?>" class="sticky-logo" alt="Logo Website">
			      		<?php  
			    		/**
			    		 * Displayed small logo
			    		 * form table options 
			    		 *
			    		 * @param String (small_logo)
			    		 **/
			      		if( $this->options->get('small_logo', TRUE)->image )
			      			echo '<img src="'.$this->options->get('small_logo', TRUE)->image.'" alt="'.$this->options->get('small_logo', TRUE)->alt.'" class="main-logo">';
			      		?>
	    				</a>
	    			</li>
		    		<?php  
		    		/**
		    		 * Displayed Queries sticky_menu
		    		 *
		    		 * @param String (key)
		    		 * @param Integer (parent)
		    		 **/
		    		foreach( $this->menus->get('sticky_menu', NULL) as $row) 
		    		{
		    			if( $this->menus->get('sticky_menu', $row->ID) == FALSE)
		    			{
		    				echo '<li><a href="'.$row->url.'" target="'.$row->target.'">'.$row->label.'</a></li>';
		    			} else {
		    				echo '<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">'.$row->label.'
										<span class="caret"></span></a>';

							echo '<ul class="dropdown-menu">';

							foreach( $this->menus->get('sticky_menu', $row->ID) as $child)
							{
								echo '<li><a href="'.$child->url.'" target="'.$child->target.'">'.$child->label.'</a></li>';
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
	     	</div>
	  	</div>
	</nav>
	
	<footer>
		<div class="container">	
			<div class="navigation-footer">	
				<ul class="navigation">
		    		<?php  
		    		/**
		    		 * Displayed Queries footer_menu
		    		 *
		    		 * @param String (key)
		    		 * @param Integer (parent)
		    		 **/
		    		foreach( $this->menus->get('footer_menu', NULL) as $row) 
		    		{
		    			echo '<li><a href="'.$row->url.'" target="'.$row->target.'">'.$row->label.'</a></li>';
		    		}
		    		?>
				</ul>
				<ul class="social-icon pull-right">
					<?php  
					foreach( $this->options->result('socialmedia') as $row) :

						$social = json_decode($row->option_value);
					?>
					<li>
						<a href="<?php echo $social->url ?>" target="_blank"><img src="<?php echo base_url("public/image/component/{$social->media}.png") ?>" alt=""></a>
					</li>
					<?php  
					endforeach;
					?>
				</ul>
				<div class="col-xs-6">
					<p class="copyright"><small>Hak Cipta 2017 Tam TV Babel - Develop By <a href="http://www.teitramega.co.id">Teitra Mega</a></small></p>
				</div>
			</div>
		</div>
	</footer>
	<script src="<?php echo base_url("public/theme/js/jquery-3.2.1.min.js"); ?>"></script>
	<script src="<?php echo base_url("public/bootstraps/js/bootstrap.min.js"); ?>"></script>
	<script src="<?php echo base_url("public/theme/js/jquery.sticky.min.js"); ?>"></script>
	<script src="<?php echo base_url("public/theme/js/jquery.timeago.js");?>" type="text/javascript"></script>
	<script src="<?php echo base_url("public/theme/js/moment.min.js"); ?>"></script>
	<script src="<?php echo base_url("public/theme/js/daterangepicker.js"); ?>"></script>
	<script src="<?php echo base_url("public/bxslider/jquery.bxslider.min.js"); ?>"></script>
	<script src="<?php echo base_url("public/viewer/viewer.min.js"); ?>"></script>
	<script src="<?php echo base_url("public/owlcarousel/owl.carousel.min.js"); ?>"></script>
	<script src="<?php echo base_url("public/lightgallery/dist/js/lightGallery-all.min.js") ?>"></script>
	<script>
		var base_url = '<?php echo base_url(); ?>',
			current_url = '<?php echo current_url(); ?>',
			user_login = '<?php echo json_encode($this->user_login) ?>';
	</script>
	<script src="<?php echo base_url("public/theme/js/main.js?v=".md5(date('YmdHis'))); ?>"></script>
	<script src="<?php echo base_url("public/appjs/app.js?v=".md5(date('YmdHis'))); ?>"></script>
	<script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=59227929b27f700011ad0da3&product=inline-share-buttons' async='async'></script>
</body>
</html>