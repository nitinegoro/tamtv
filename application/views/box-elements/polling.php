<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * The template for displaying the polling Box
 *
 * Displays all of the polling Box element.
 *
 * @package Codeigniter
 * @subpackage Tamtv Template
 * @author Vicky Nitinegoro <pkpvicky@gmail.com>
 * @since Tamtv 1.0
 */

$question = $this->posts->get_polling_post( $post->ID );
if( $question ) :
?>
<section class="box-polling">
	<h2 class="polling-question"><?php echo $question->question; ?></h2>
	<ul class="polling-answer">
	<?php  
	/**
	 * Loop Polling answer
	 *
	 * @var string
	 **/
	foreach( $this->polling->get_answers($question->question_id) as $row) :
	?>
		<li>
			<a href="#polling-click" id="set-polling" data-id="<?php echo $row->answer_id; ?>" data-post="<?php echo $question->pollingpost_id ?>">
				<img src="<?php echo base_url("public/image/polling/{$row->icon}"); ?>" alt="<?php echo $row->label ?>"><br>
				<span><?php echo $row->label ?></span>
			</a>
		</li>
	<?php endforeach; ?>
	</ul>
</section>
<?php
endif;
/* End of file polling.php    data-toggle="tooltip" data-placement="top" title="Hooray!"*/ 
/* Location: ./application/views/box-elements/polling.php */