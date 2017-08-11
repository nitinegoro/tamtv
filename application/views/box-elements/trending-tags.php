<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Box elements trending tags
 *
 **/

$box = $this->themes->get('trending-tags');

$tags = $this->db->query()
?>
<div class="box-topic-tag">
	<h3 class="sidebar-heading"><?php echo $box->meta_name ?></h3>
	<ul class="list-topic-tag">
		<li><a href="">Lorem ipsum dolor.</a></li>
	</ul>
</div>
<?php
/* End of file trending-tags.php */
/* Location: ./application/views/box-elements/trending-tags.php */