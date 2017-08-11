<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Box elements trending tags
 *
 **/

$box = $this->themes->get('trending-tags');

$tags = json_decode($box->meta_value);
?>
<div class="box-topic-tag">
	<h3 class="sidebar-heading"><?php echo $box->meta_name ?></h3>
	<ul class="list-topic-tag">
	<?php  
		foreach ($this->tags->box($tags->limit) as $row) 
		{
			echo '<li><a href="'.base_url("tag/{$row->slug}").'">'.$row->name.'</a></li>';
		}
	?>
	</ul>
</div>
<?php
/* End of file trending-tags.php */
/* Location: ./application/views/box-elements/trending-tags.php */