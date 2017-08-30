<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Main Search Mobile Template
 *
 *
 * @package Codeigniter
 * @subpackage Tamtv Template
 * @since Tamtv 1.0
 */

$this->load->view('mobile/header', $this->data);
?>
<div class="start"></div>
<div class="container-fluid" style="margin-top: 20px; min-height: 500px;">
	<form action="<?php echo base_url("search"); ?>" role="search">
   	<div class="input-group">
       <input type="text" class="form-control" placeholder="Berita apa yang ingin anda baca hari ini?" name="q" value="<?php echo $this->query ?>">
       <div class="input-group-btn">
           <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
       </div>
   	</div>
   	<div class="results">
   	<?php if( $results_count ) : ?>
   	<p>
   		Hasil pencarian "<strong><?php echo $this->query; ?></strong>", <?php echo $results_count  ?> hasil ditemukan.	
   	</p>
   	<?php else : ?>
		<p><i class="fa fa-warning"></i> Maaf, kami tidak menemukan pencarian <strong><mark><?php echo $this->query; ?></mark></strong> yang Anda lakukan</p>
		<p>Coba ulangi dengan cara :</p>
		<ul>
			<li>Memeriksa kesalahan penulisan</li>
			<li>Menggunakan kata yang lebih umum</li>
			<li>Mengurangi jumlah kata kunci</li>
			<li>Mengganti kata kunci.</li>
		</ul>
   	<?php endif; ?>
   	</div>
   	</form>
	<?php  
	/**
	 * Get Latest Post
	 *
	 * @param String (post_type)
	 * @param Integer (limit)
	 * @param Integer (offset)
	 **/
	foreach($contents as $post) :
	?>
	<div class="media">
  		<div class="media-left">
			<a href="<?php echo $this->posts->permalink($post->ID) ?>" title="<?php echo $post->post_title; ?>">
				<img src="<?php echo $this->posts->get_thumbnail($post->image, 'x-small'); ?>" alt="<?php echo $post->post_title; ?>" class="media-object" width="100">
			</a>
  		</div>
  		<div class="media-body">
 			<?php  
			/**
			 * Get Post Categories
			 *
			 * @param String (category_id)
			 **/
			$category = $this->posts->get_post_category($post->ID);

			if( $category ) 
				echo anchor(
						base_url("kategori/{$category->slug}"), 
						'<span class="category-title">'.$category->name.'</span>', 
						array('titel' => $category->name)
					);
			?>	
			<time class="timeago" datetime="<?php echo $post->post_date; ?>"></time>
		  	<a href="<?php echo $this->posts->permalink($post->ID) ?>" title="<?php echo $post->post_title; ?>">
		    	<h4 class="media-heading"><?php echo highlight_phrase($post->post_title, $this->query, '<mark>', '</mark>') ?></h4>
		    </a>
  		</div>
	</div>
	<?php endforeach; ?>
	<div class="clearfix"></div>
	<div class="text-center">
		<?php echo $this->pagination->create_links(); ?>
	</div>
</div>
<?php
$this->load->view('mobile/footer', $this->data);
/* End of file search.php */
/* Location: ./application/views/mobile/search.php */