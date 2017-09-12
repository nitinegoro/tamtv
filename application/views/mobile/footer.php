<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Footer Template Mobile
 *
 * @package Codeigniter
 * @subpackage Tamtv Template
 * @since Tamtv 1.0
 * @author Vicky Nitinegoro <pkpvicky@gmail.com>
 **/
?>
	<footer>
		<div class="container-fluid text-center">
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
				<ul class="social-icon">
					<li><a href=""><img src="<?php echo base_url("public/image/component/facebook.png") ?>" alt=""></a></li>
					<li><a href=""><img src="<?php echo base_url("public/image/component/twitter.png") ?>" alt=""></a></li>
					<li><a href=""><img src="<?php echo base_url("public/image/component/gplus.png") ?>" alt=""></a></li>
					<li><a href=""><img src="<?php echo base_url("public/image/component/youtube.png") ?>" alt=""></a></li>
					<li><a href=""><img src="<?php echo base_url("public/image/component/instagram.png") ?>" alt=""></a></li>
				</ul>
			</div>
			<p class="copyright"><small>&copy; Hak Cipta 2017 Tam TV Bangka Belitung  <br> Develop By <a href="https://www.google.co.id/maps/place/Teitra+Mega/@-2.1345868,106.1080505,15z/" target="_blank">Teitra Mega</a></small></p>
		</div>
	</footer>
	</body>
</html>
<?php
/* End of file footer.php */
/* Location: ./application/views/mobile/footer.php */