<div class="row">
	<div class="col-md-6 col-md-offset-3 col-xs-12"><?php echo $this->session->flashdata('alert'); ?></div>
	<?php echo form_open_multipart(current_url(), array('method' => 'post')); ?>
	<div class="col-md-6 col-md-offset-3 bottom2x">
		<div class="form-group">
			<label>Pertanyaan Polling </label>
			<textarea name="question" rows="3" class="form-control" required=""><?php echo (set_value('question')==FALSE) ? $question->question : set_value('question'); ?></textarea>
		</div>
		<?php foreach( $this->polling->get_answers($question->question_id) as $row) : ?>
		<div class="form-group" id="answer-<?php echo $row->answer_id ?>">
			<label>Jawaban</label>
			<a href="javascript:void(0)" data-action="delete" data-key="answer" data-id="<?php echo $row->answer_id ?>" class="btn btn-xs btn-danger pull-right bottom1x" id="delete-form" data-id="<?php echo $row->answer_id ?>" title="Hapus Jawaban ini">
				<i class="fa fa-times"></i>
			</a>
			<input type="file" name="icon[<?php echo $row->answer_id ?>]">
			<input type="text" class="form-control top1x" name="label[<?php echo $row->answer_id ?>]" value="<?php echo $row->label; ?>" required>
		</div>
		<?php endforeach; ?>
		<div class="form-dynamic" data-start="0">
			<div class="form-group">
				<button type="button" class="btn btn-xs pull-right top1x bottom2x" id="addFormUpload"><i class="fa fa-plus"></i> Tambah Jawaban</button>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="form-group top2x">
			<div class="col-md-6 col-md-offset-3">
				<button type="submit" class="btn btn-primary btn-block"><i class="fa fa-save"></i> Update Polling</button>
			</div>
		</div>
	</div>
	<?php echo form_close(); ?>
</div>

<div class="modal" id="modal-delete-answer">
	<div class="modal-dialog modal-sm modal-danger">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><i class="fa fa-info-circle"></i> Hapus!</h4>
				<span>Hapus data Jawaban ini dari database?</span>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Batal</button>
				<a href="javascript:void(0)" id="btn-delete" class="btn btn-outline">Hapus</a>
			</div>
		</div>
	</div>
</div>
