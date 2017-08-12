<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * The template for displaying the Sidebar Ads
 *
 * Displays all of the Sidebar Ads right element.
 *
 * @package Codeigniter
 * @subpackage Tamtv Template
 * @author Vicky Nitinegoro <pkpvicky@gmail.com>
 * @since Tamtv 1.0
 */
$box = $this->themes->get('ads-300x100');
?>
<div class="box-adsvertising">
	<?php echo $box->meta_value; ?>
</div>
<?php
/* End of file ads-300x100.php */
/* Location: ./application/views/box-elements/ads-300x100.php */