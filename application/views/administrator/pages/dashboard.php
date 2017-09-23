<div class="row">
	<div class="col-lg-3 col-xs-6">
		<div class="small-box bg-aqua">
			<div class="inner"> <h3><?php echo $this->cpost->count_all(); ?></h3> <p>Berita</p> </div>
			<div class="icon"> <i class="fa fa-pencil"></i> </div>
			<a href="<?php echo base_url("administrator/post"); ?>" class="small-box-footer">Selengkapnya... <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<div class="col-lg-3 col-xs-6">
		<div class="small-box bg-aqua">
			<div class="inner"> <h3><?php echo $this->db->count_all('comments'); ?></h3> <p>Komentar</p> </div>
			<div class="icon"> <i class="fa fa-comments"></i> </div>
			<a href="<?php echo base_url("administrator/cm"); ?>" class="small-box-footer">Selengkapnya... <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<div class="col-lg-3 col-xs-6">
		<div class="small-box bg-aqua">
			<div class="inner"> <h3><?php echo $this->db->count_all('tags'); ?></h3> <p>Topik</p> </div>
			<div class="icon"> <i class="fa fa-tags"></i> </div>
			<a href="<?php echo base_url("administrator/post_tags"); ?>" class="small-box-footer">Selengkapnya... <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<div class="col-lg-3 col-xs-6">
		<div class="small-box bg-aqua">
			<div class="inner"> <h3>+<?php echo $this->visitors->count_by_date(date('Y-m-d')); ?></h3> <p>Pengunjung Hari Ini</p> </div>
			<div class="icon"> <i class="fa fa-users"></i> </div>
			<a href="<?php echo base_url("administrator/stats"); ?>" class="small-box-footer">Selengkapnya... <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-7">
		<div id="chart-visitors"></div>
		<script>
		Highcharts.chart('chart-visitors', {
		    chart: {
		        type: 'area' 
		    },
		    title: {
		        text: 'STATISTIK PENGUNJUNG'
		    },
		    subtitle: {
		        text: '10 Hari Terakhir'
		    },
		    xAxis: {
		        allowDecimals: false,
		        labels: {
		            formatter: function () {
		                return this.value;
		            }
		        },
		        categories: [
		              <?php  
		              foreach (date_range($this->lastweek, date('Y-m-d')) as $date) :
		              		$dt = new DateTime($date);
		              		echo "'".$dt->format('d')." ".$dt->format('F')."',";
		              endforeach;
		              ?>
		        ]
		    },
		    yAxis: {
		        title: {
		            text: 'Jumlah'
		        }
		    },
		    tooltip: {
		        pointFormat: '{series.name} <b>{point.y:,.0f}</b> Pengunjung'
		    },
		    series: [{
		        name: 'Total ',
		        data: [
		        	<?php  
		              foreach (date_range($this->lastweek, date('Y-m-d')) as $date) :
		              		$dt = new DateTime($date);
		              		echo $this->visitors->count_by_date($date).',';
		              endforeach;
		        	?>
		        ]
		    }]
		});
		</script>
	</div>
	<div class="col-md-5">
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
		        <?php foreach( $this->polling->get_answers(1) as $q) : ?>
		        {
		            name: '<?php echo $q->label ?>',
		            y: <?php echo $this->respondent->count(1, $q->answer_id) ?>
		        },<?php endforeach; ?>]
		    }]
		});
		</script>
	</div>
	<div class="col-md-7" style="margin-top: 20px;">
		<div class="box box-default">
			<div class="box-header with-border">
				<strong class="box-heading">Live Streaming Channel</strong>
			</div>
			<div class="box-body">
				<form id="save-streaming" method="post">
				<div class="col-md-10">
					<input type="text" name="live" class="form-control" placeholder="Masukkan URL youtube" value="<?php echo $this->options->get('live-streaming') ?>">
				</div>
				<div class="col-md-2">
					<button type="submit" id="saveStreaming" class="btn btn-primary">Simpan</button>
				</div>
				</form>
			</div>
		</div>
	</div>

</div>