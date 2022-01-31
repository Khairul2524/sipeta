<script src="<?= base_url('assets/backand/css/leaflet.js') ?>"></script>
<script src="<?= base_url('assets/backand/js/Chart.min.js') ?>"></script>
<script src="<?= base_url('assets/backand/js/utils.js') ?>"></script>

<main id="main" class="main">

	<div class="pagetitle">
		<h1><?= $judul; ?></h1>
	</div><!-- End Page Title -->

	<section class="section">

		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Pasien Covid Di Setiap Dusun</h5>
				<!-- Bar Chart -->
				<canvas id="barChart" style="max-height: 400px;"></canvas>
				<script>
					var chartData = {
						labels: ['Prai Timuk', 'Meke Timuk', 'Meke Bat', 'Nyangget', 'Alat', 'Dasan Baru', 'Monjok'],
						datasets: [{
							fillColor: "#79D1CF",
							strokeColor: "#79D1CF",
							data: ['100', '69', '80', '70', '70', '80', '80 ', ],
							backgroundColor: ['rgba(255, 195, 48, 1)', 'rgba(255, 195, 48, 1)', 'rgba(255, 195, 48, 1)', 'rgba(255, 195, 48, 1)', 'rgba(255, 195, 48, 1)', 'rgba(255, 195, 48, 1)', 'rgba(255, 195, 48, 1)', ],
							borderColor: [
								'rgba(255, 195, 48, 1)', 'rgba(255, 195, 48, 1)', 'rgba(255, 195, 48, 1)', 'rgba(255, 195, 48, 1)', 'rgba(255, 195, 48, 1)', 'rgba(255, 195, 48, 1)',
							],
						}]

					};

					var opt = {
						events: false,
						tooltips: {
							enabled: false
						},
						hover: {
							animationDuration: 0
						},
						animation: {
							duration: 1,
							onComplete: function() {
								var chartInstance = this.chart,
									ctx = chartInstance.ctx;
								ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
								ctx.textAlign = 'center';
								ctx.textBaseline = 'bottom';

								this.data.datasets.forEach(function(dataset, i) {
									var meta = chartInstance.controller.getDatasetMeta(i);
									meta.data.forEach(function(bar, index) {
										var data = dataset.data[index];
										ctx.fillText(data, bar._model.x, bar._model.y - 5);
									});
								});
							}
						},
						legend: {
							display: false
						},
						tooltips: {
							callbacks: {
								label: function(tooltipItem) {
									console.log(tooltipItem)
									return tooltipItem.yLabel;
								}
							}
						}
					};
					var ctx = document.getElementById("barChart"),
						myLineChart = new Chart(ctx, {
							type: 'bar',
							data: chartData,
							options: opt
						});
				</script>
				<!-- End Bar CHart -->

			</div>
		</div>




		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Peta</h5>
				<div id="map" style="width: 100%; height: 500px;"></div>
			</div>
		</div>

	</section>

</main><!-- End #main -->
<script>
	var map = L.map('map').setView([-8.7080623, 116.3190586], 15);

	var tiles = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		maxZoom: 18,
		id: 'mapbox/streets-v11',
		tileSize: 512,
		zoomOffset: -1
	}).addTo(map);
	var myIcon = L.icon({
		iconUrl: '<?= base_url('assets/backand/img/marker-icon-2x.png') ?>',
		iconSize: [40, 55], // size of the icon
	});
	<?php
	foreach ($dusun as $d) {
	?>
		var marker = L.marker([<?= $d->lat ?>, <?= $d->lng ?>], {
				icon: myIcon
			}).addTo(map)
			.bindPopup('<b><?= $d->dusun ?></b>').openPopup();
	<?php } ?>
</script>