<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Main Mobile Template
 *
 *
 * @package Codeigniter
 * @subpackage Tamtv Template
 * @since Tamtv 1.0
 */

$this->load->view('mobile/header', $this->data);
?>
<div class="start"></div>
<div class="bg-blue">
	<ul class="top-trending-tags">
		<?php  
			foreach ($this->tags->box(3) as $row) 
			{
				echo '<li><a href="'.base_url("tag/{$row->slug}").'">'.$row->name.'</a></li>';
			}
		?>
	</ul>
	<?php  
	/**
	 * Headline News
	 *
	 * @var string
	 **/
	$this->load->view('mobile/box/headline', $this->data, FALSE);
	?>
</div>
<div class="top2x"></div>
<div class="container-fluid">
	<?php  
	/**
	 * Headline News
	 *
	 * @var string
	 **/
	$this->load->view('mobile/box/latest', $this->data, FALSE);
	?>
</div>
<div class="top2x"></div>
<div class="bg-blue">
	<div class="container-fluid">
		<div class="box">
			<h3 class="box-heading">FOKUS TOPIK</h3>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="box">
		<ol class="list-article">
		<?php  
			foreach ($this->tags->box(5) as $row) 
			{
				echo '<li><a href="'.base_url("tag/{$row->slug}").'">'.$row->name.'</a></li>';
			}
		?>
		</ol>
	</div>
</div>
<div class="bg-blue">
	<div class="container-fluid">
		<div class="box">
			<a href="" class="more-button-icon"><i class="fa fa-plus"></i></a>
			<h3 class="box-heading">Most popular</h3>
		</div>
	</div>
	<?php  
	/**
	 * Headline News
	 *
	 * @var string
	 **/
	$this->load->view('mobile/box/popular', $this->data, FALSE);
	?>
</div>
<?php
$this->load->view('mobile/footer', $this->data);
/* End of file main.php */
/* Location: ./application/views/mobile/main.php */