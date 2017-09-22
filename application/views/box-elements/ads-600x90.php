<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * The template for displaying the Content Ads
 *
 * Displays all of the Content Ads right element.
 *
 * @package Codeigniter
 * @subpackage Tamtv Template
 * @author Vicky Nitinegoro <pkpvicky@gmail.com>
 * @since Tamtv 1.0
 */
if( $this->router->fetch_method() == 'index' )
{
	$box = $this->themes->get('ads-600x90', 'content-index');
} else {
	$box = $this->themes->get('ads-600x90', 'content-single');
}
?>
<div class="box-adsvertising text-center top">
	<?php echo $box->meta_value; ?>
</div>
<?php
/* End of file ads-300x400.php */
/* Location: ./application/views/box-elements/ads-300x400.php */