<div class="row">
	<div class="col-md-6 col-md-offset-3 col-xs-12"><?php echo $this->session->flashdata('alert'); ?></div>
	<?php echo form_open(current_url(), array('method' => 'get')); ?>
	<div class="col-md-12 bottom2x">
		<div class="col-md-4">
			<a href="<?php echo base_url("administrator/cm?filter=all&query={$this->query}"); ?>" class="btn btn-link">
				(<?php echo $this->db->count_all('comments'); ?>) Semua
			</a> |
			<a href="<?php echo base_url("administrator/cm?filter=pending&query={$this->query}"); ?>" class="btn btn-link">
				(<?php echo $this->comment->count_by_status('no'); ?>) Tertunda
			</a> |
			<a href="<?php echo base_url("administrator/cm?filter=approve&query={$this->query}"); ?>" class="btn btn-link">
				(<?php echo $this->comment->count_by_status('yes'); ?>) Disetujui
			</a> 
		</div>
		<div class="col-md-4 pull-right">
            <div class="input-group input-group-sm">
            	<input type="text" name="query" class="form-control" value="<?php echo $this->input->get('query') ?>" placeholder="Pencarian ...">
            	<div class="input-group-btn">
                  	<button type="submit" class="btn btn-default"><i class="fa fa-search"></i> Cari Komentar</button>
            	</div>
            </div>
		</div>
	</div>
	<?php echo form_close(); ?>
	<div class="col-md-12">
		<div class="box box-default">
		<?php echo form_open(base_url("administrator/cm/bulkaction")); ?>
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th width="30">
			                <div class="checkbox checkbox-inline">
			                    <input id="checkbox1" type="checkbox"> <label for="checkbox1"></label>
			                </div>
						</th>
						<th class="text-center">Penulis</th>
						<th class="text-center">Komentar</th>
						<th class="text-center">Berita</th>
						<th class="text-center">Tanggal</th>
					</tr>
				</thead>
				<tbody>
				<?php  
				foreach( $comments as $row) :
				?>
					<tr>
						<td>
			                 <div class="checkbox checkbox-inline">
			                     <input id="checkbox1" type="checkbox" name="comments[]" value="<?php echo $row->comment_id ?>"> <label for="checkbox1"></label>
			                 </div>
						</td>
						<td width="200"> <strong><?php echo $row->fullname ?></strong> </td>
						<td class="td-action">
								<small>	<?php 	echo $row->comment_content ?></small>
							<div class="button-action" id="action-<?php echo $row->comment_id ?>">
								<?php if($row->comment_approved == 'yes') : ?>
								<a id="set-status" data-id="<?php echo $row->comment_id ?>" data-status="no" class="text-yellow">Tolak</a> 
								<?php else : ?>
								<a id="set-status" data-id="<?php echo $row->comment_id ?>" data-status="yes" class="text-success">Terima</a> 
								<?php endif; ?>
								|
								<a data-toggle="collapse" data-target="#reply-<?php echo $row->comment_id ?>">Balas</a> |
								<a href="#" data-action="delete" data-key="comment" data-id="<?php echo $row->comment_id ?>" class="red">Hapus</a>
							</div>
							<div id="reply-<?php echo $row->comment_id ?>" class="collapse pad">
								<textarea name="comment_reply_<?php echo $row->comment_id ?>" cols="30" rows="6" class="form-control"></textarea>
								<div class="pad">	
									<button class="btn btn-default" type="button" data-toggle="collapse" data-target="#reply-<?php echo $row->comment_id ?>">Batal</button>
									<button id="set-reply" class="btn btn-primary pull-right" data-id="<?php echo $row->comment_id ?>" data-post="<?php echo $row->comment_post_ID ?>" type="button">Balas</button>
								</div>
							</div>
						</td>
						<td width="300">
							<strong>	
								<?php echo anchor(base_url("administrator/post/update/{$row->comment_post_ID}"), $row->post_title); ?>
							</strong>
						</td>
						<td width="180">
							<small>
								<time><?php echo $this->posts->date_format($row->comment_date); ?></time><br>
							</small>
						</td>
					</tr>
				<?php
				endforeach;
				if( $comments == FALSE )
						echo '<tr><td colspan="6">Tidak ada komentar yang ditemukan.</td></tr>';
				?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="6">
							<label>Yang terpilih :</label>
							<a class="btn btn-xs btn-round btn-danger" data-toggle="modal" data-target="#modal-delete-post-selected"><i class="fa fa-trash-o"></i> Hapus</a>
							<small class="pull-right"><?php echo count($comments) ?> dari <?php echo $this->comment->getall(null, null, 'num') ?> data.</small>
						</td>
					</tr>
				</tfoot>
			</table>
			<div class="modal" id="modal-delete-post-selected">
				<div class="modal-dialog modal-sm modal-danger">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title"><i class="fa fa-info-circle"></i> Hapus!</h4>
							<span>Hapus data komentar yang terpilih dari database?</span>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Batal</button>
							<button type="submit" name="action" value="delete" class="btn btn-outline">Hapus</button>
						</div>
					</div>
				</div>
			</div>
		<?php echo form_close(); ?>
		</div>
	</div>
	<div class="col-md-12 text-center">
		<?php echo $this->pagination->create_links(); ?>
	</div>
</div>

<div class="modal" id="modal-delete-comment">
	<div class="modal-dialog modal-sm modal-danger">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><i class="fa fa-info-circle"></i> Hapus!</h4>
				<span>Hapus data komentar ini dari database?</span>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Batal</button>
				<a href="#" id="btn-delete" class="btn btn-outline">Hapus</a>
			</div>
		</div>
	</div>
</div>


