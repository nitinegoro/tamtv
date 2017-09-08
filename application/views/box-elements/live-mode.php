<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * The template for displaying the live streaming page
 *
 * Displays all of the live streaming element.
 *
 * @package Codeigniter
 * @subpackage Tamtv Template
 * @author Vicky Nitinegoro <pkpvicky@gmail.com>
 * @since Tamtv 1.0
 */
?>
<div class="container-fluid mode-vidio">
	<div class="container-fluid">
		<div class="col-xs-2"> </div>
		<div class="col-xs-8 col-md-8 col-lg-8">
<!-- 			<iframe width="100%" height="550" src="https://www.youtube.com/embed/<?php echo $this->options->get('live-streaming') ?>?autoplay=1" frameborder="0" allowfullscreen></iframe> -->
			<script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
			<video id="video"></video>
			<script>
			  if(Hls.isSupported()) {
			    var video = document.getElementById('video');
			    var hls = new Hls();
			    hls.loadSource('<?php echo $this->options->get('live-streaming') ?>');
			    hls.attachMedia(video);
			    hls.on(Hls.Events.MANIFEST_PARSED,function() {
			      video.play();
			  });
			 }
			</script>
			<div class="col-md-8">
				<h1 class="live-title">LIVE STREAMING</h1>
			</div>
			<div class="col-md-4 pull-right">
				<div class="sharethis-inline-share-buttons" style="margin-top: 20px;"></div>
			</div>
		</div>
		<div class="col-xs-2"> </div>
	</div>
</div>