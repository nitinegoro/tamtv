<div class="row">
	<div class="col-md-12 bottom2x">
		<?php echo form_open(current_url(), array('method' => 'get')); ?>
		<div class="col-md-2">
		    <div class="input-group">
		        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
		        <input type="text" id="datepicker1" value="<?php echo $this->start_date ?>" class="form-control" placeholder="Mulai Tanggal...">
		    </div>
		</div>
		<div class="col-md-2">
		    <div class="input-group">
		        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
		        <input type="text" id="datepicker2" value="<?php echo $this->end_date ?>" class="form-control" placeholder="Sampai Tanggal...">
		    </div>
		</div>
		<div class="col-md-2">
		    <button type="submit" class="btn btn-default"><i class="fa fa-filter"></i> Filter Data</button>
		</div>
		<?php echo form_close(); ?>
	</div>
	<div class="col-md-12">
		<div id="chart-visitors"></div>
		<script>
		Highcharts.chart('chart-visitors', {
		    chart: {
		        type: 'area' 
		    },
		    title: {
		        text: 'STATISTIK PENGUNJUNG'
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
		              foreach (date_range($this->start_date, $this->end_date) as $date) :
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
		              foreach (date_range($this->start_date, $this->end_date) as $date) :
		              		$dt = new DateTime($date);
		              		echo $this->visitors->count_by_date($date).',';
		              endforeach;
		        	?>
		        ]
		    }]
		});
		</script>
	</div>