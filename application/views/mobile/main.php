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
		<li><a href="">Sea Games 2017</a></li>
		<li><a href="">Liga Champions</a></li>
		<li><a href="">Indonesia Vs Malaysia</a></li>
	</ul>
	<div class="headline-news">
		<a href="">
			<img src="<?php echo base_url("public/image/news/timnas-basket-putra-saatnya-indonesia-rebut-emas-sea-games.jpg"); ?>" alt="" class="img-responsive">
		</a>
		<div class="content-headline">
			<a href="">
				<h1>Timnas Basket Putra Saatnya Indonesia Rebut Emas Sea Games</h1>
			</a>
			<div class="desc">8 Jam yang lalu</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	
</div>
<?php
$this->load->view('mobile/footer', $this->data);
/* End of file main.php */
/* Location: ./application/views/mobile/main.php */