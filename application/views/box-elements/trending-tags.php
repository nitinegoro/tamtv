<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Box elements trending tags
 *
 **/
switch ($this->router->fetch_method()) {
	case 'gettag':
		$box = $this->themes->get('trending-tags', 'sidebar-tag');
		break;
	case 'getpost':
		$box = $this->themes->get('trending-tags', 'sidebar-single');
		break;
	default:
		$box = $this->themes->get('trending-tags', 'sidebar-index');
		break;
}
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