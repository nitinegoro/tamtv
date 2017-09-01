<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * The template for displaying the Headline News
 *
 * Displays all of the headline News right element.
 *
 * @package Codeigniter
 * @subpackage Tamtv Template
 * @author Vicky Nitinegoro <pkpvicky@gmail.com>
 * @since Tamtv 1.0
 */
$box = $this->themes->get('box-thumbnail-foto');

$value = json_decode($box->meta_value);
?>
<section class="box-foto">
	<div class="block-box">
		<h3 class="featured-heading"> <?php echo $box->meta_name ?> </h3> 
		<div class="line"></div>
	</div>
	<div class="left-foto">
		<div class="foto-icon">
			<img src="https://cf.dvh.bz/v2/images/foto-b.png" width="12" height="12">
		</div>
		<a href="" title="HUT Ke-72, DPR Gelar Pameran Foto Warna-warni Parlemen">
			<img alt="" src="https://cf.dvh.bz/library/3/1/9/8/3/31983_300x206.JPG">
		</a>
		<div class="text-foto">
            <h2 class="title">
            	<a href=""> HUT Ke-72, DPR Gelar Pameran Foto Warna-warni Parlemen </a>
            </h2>
        </div>
	</div>
	<div class="right-foto">
		<ul class="foto-other">
			<li>
                <div class="cover-foto">
                    <div class="foto-icon">
                    	<img src="https://cf.dvh.bz/v2/images/foto-b.png" width="12" height="12">
                    </div>
                    <a href="" title="Blusukan di Tanah Suci, Memantau Pelayanan Haji">
                    	<img alt="Blusukan di Tanah Suci, Memantau Pelayanan Haji" src="https://cf.dvh.bz/library/3/1/8/3/4/31834_224x153.jpeg">
                    </a>
                </div>
                <h2 class="title">
                   <a href="" title="">Blusukan di Tanah Suci, Memantau Pelayanan Haji</a>
                </h2>
            </li>
			<li>
                <div class="cover-foto">
                    <div class="foto-icon">
                    	<img src="https://cf.dvh.bz/v2/images/foto-b.png" width="12" height="12">
                    </div>
                    <a href="" title="Blusukan di Tanah Suci, Memantau Pelayanan Haji">
                    	<img alt="Blusukan di Tanah Suci, Memantau Pelayanan Haji" src="https://cf.dvh.bz/library/3/1/8/3/4/31834_224x153.jpeg">
                    </a>
                </div>
                <h2 class="title">
                   <a href="" title="">Blusukan di Tanah Suci, Memantau Pelayanan Haji</a>
                </h2>
            </li>
		</ul>
	</div>
</section>