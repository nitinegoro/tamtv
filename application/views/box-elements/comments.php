<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * The template for displaying the Comments Box
 *
 * Displays all of the Comments Box element.
 *
 * @package Codeigniter
 * @subpackage Tamtv Template
 * @author Vicky Nitinegoro <pkpvicky@gmail.com>
 * @since Tamtv 1.0
 */
?>
<section class="box-comments">
	<form action="" method="post">
		<div class="form-group">
			<textarea name="comment" class="input" rows="3" placeholder="Tuliskan Komentar anda..."></textarea>
		</div>
		<button class="btn btn-block btn-primary"><i class="fa fa-comments"></i> Tulis Komentar</button>
	</form>
</section>
<?php
/* End of file comments.php */
/* Location: ./application/views/box-elements/comments.php */