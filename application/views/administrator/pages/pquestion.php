<div class="row">
	<div class="col-md-6 col-md-offset-3 col-xs-12"><?php echo $this->session->flashdata('alert'); ?></div>
	<?php echo form_open(current_url(), array('method' => 'get')); ?>
	<div class="col-md-12 bottom2x">
		<div class="col-md-4 top1x">
			<a href="<?php echo base_url("administrator/question/create") ?>" class="btn btn-default"><i class="fa fa-plus"></i> Tambah Baru</a>
		</div>
		<div class="col-md-4 pull-right">
            <div class="input-group input-group-sm">
            	<input type="text" name="query" class="form-control" value="<?php echo $this->input->get('query') ?>" placeholder="Pencarian ...">
            	<div class="input-group-btn">
                  	<button type="submit" class="btn btn-default"><i class="fa fa-search"></i> Pencarian</button>
            	</div>
            </div>
		</div>
	</div>
	<?php echo form_close(); ?>
	<div class="col-md-12">
		<div class="box box-default">
		<?php echo form_open(base_url("administrator/question/bulkaction")); ?>
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th width="30">
			                <div class="checkbox checkbox-inline">
			                    <input id="checkbox1" type="checkbox"> <label for="checkbox1"></label>
			                </div>
						</th>
						<th class="text-center">Polling</th>
						<th class="text-center">Jawaban</th>
						<th class="text-center">Responden</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach( $questions as $row) : ?>
					<tr>
						<td>
			                 <div class="checkbox checkbox-inline">
			                     <input id="checkbox1" type="checkbox" name="polling[]" value=""> <label for="checkbox1"></label>
			                 </div>
						</td>
						<td class="td-action">
							<strong>
								<?php echo anchor(base_url("administrator/question/update/{$row->question_id}"), $row->question); ?>
							</strong>
							<div class="button-action" id="action-">

								<a href="<?php echo base_url("administrator/question/update/{$row->question_id}") ?>">Update</a> |
								<a href="<?php echo base_url("administrator/stats/polling/{$row->question_id}") ?>" class="text-success">Statistik</a> |
								<a href="javascript:void(0)" data-action="delete" data-key="question" data-id="<?php echo $row->question_id ?>" class="red">Hapus</a>
							</div>
						</td>
						<td class="text-center">  
							<strong><?php echo $this->db->get_where('pollinganswer', array('question_id' => $row->question_id))->num_rows(); ?></strong>
						</td>
						<td class="text-center"><strong><?php echo $this->respondent->count_question_resp($row->question_id) ?></strong></td>
					</tr>
				<?php
				endforeach;
				if( $questions == FALSE )
						echo '<tr><td colspan="6">Tidak ada komentar yang ditemukan.</td></tr>';
				?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="4">
							<label>Yang terpilih :</label>
							<a href="javascript:void(0)" class="btn btn-xs btn-round btn-danger" data-toggle="modal" data-target="#modal-delete-polling-selected"><i class="fa fa-trash-o"></i> Hapus</a>
							<small class="pull-right"><?php echo count($questions) ?> dari <?php echo $this->polling->get_question_pg(null, null, 'num') ?> data.</small>
						</td>
					</tr>
				</tfoot>
			</table>
			<div class="modal" id="modal-delete-polling-selected">
				<div class="modal-dialog modal-sm modal-danger">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title"><i class="fa fa-info-circle"></i> Hapus!</h4>
							<span>Hapus data Polling yang terpilih dari database?</span>
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

<div class="modal" id="modal-delete-question">
	<div class="modal-dialog modal-sm modal-danger">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><i class="fa fa-info-circle"></i> Hapus!</h4>
				<span>Hapus data Polling ini dari database?</span>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Batal</button>
				<a href="#" id="btn-delete" class="btn btn-outline">Hapus</a>
			</div>
		</div>
	</div>
</div>


