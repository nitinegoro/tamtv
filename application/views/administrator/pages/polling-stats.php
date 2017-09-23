<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="col-md-12 bottom2x">
			<label>Pertanyaan Polling</label>
			<select name="pollingquestion" id="inputPollingquestion" class="form-control" style="width:80%" onchange="return location.href = '<?php echo base_url("administrator/stats/polling?get=") ?>' + $(this).val();">
				<option value="">-- PILIH --</option>
			<?php foreach($this->polling->get_all_question() as $row) : ?>
				<option value="<?php echo $row->question_id ?>" <?php if($this->polling_stats == $row->question_id) echo 'selected'; ?>><?php echo $row->question; ?></option>
			<?php endforeach; ?>
			</select>
		</div>
		<div id="pie-feedback"></div>
		<script>
		Highcharts.chart('pie-feedback', {
		    chart: {
		        plotBackgroundColor: null,
		        plotBorderWidth: null,
		        plotShadow: false,
		        type: 'pie'
		    },
		    title: {
		        text: 'Umpan Balik Terhadap Berita'
		    },
		    tooltip: {
		        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		    },
		    plotOptions: {
		        pie: {
		            allowPointSelect: true,
		            cursor: 'pointer',
		            dataLabels: {
		                enabled: true,
		                format: '<b>{point.name}</b> : {point.percentage:.1f} %',
		                style: {
		                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
		                }
		            }
		        }
		    },
		    series: [{
		        name: 'Perasaan ',
		        colorByPoint: true,
		        data: [
		        <?php foreach( $this->polling->get_answers($this->polling_stats) as $q) : ?>
		        {
		            name: '<?php echo $q->label ?>',
		            y: <?php echo $this->respondent->count($this->polling_stats, $q->answer_id) ?>
		        },<?php endforeach; ?>]
		    }]
		});
		</script>
	</div>
</div>