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
				<h5 class="card-title">Pasien Covid Di Setiap Dusun</h5>
				<!-- Bar Chart -->
				<canvas id="bar" style="max-height: 400px;"></canvas>
				<script>
					var chartData = {
						labels: ['Prai Timuk', 'Meke Timuk', 'Meke Bat', 'Nyangget', 'Alat', 'Dasan Baru', 'Monjok'],
						datasets: [{
							fillColor: "#79D1CF",
							strokeColor: "#79D1CF",
							data: ['100', '69', '80', '70', '70', '80', '80 ', ],
							backgroundColor: ['rgba(255, 195, 8, 1)', 'rgba(255, 195, 48, 1)', 'rgba(255, 195, 48, 1)', 'rgba(255, 195, 48, 1)', 'rgba(255, 195, 48, 1)', 'rgba(255, 195, 48, 1)', 'rgba(255, 195, 48, 1)', ],
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
					var ctx = document.getElementById("bar"),
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
				<div id='map'></div>
			</div>
		</div>

	</section>

</main><!-- End #main -->
<script>
	var map = L.map('map').setView([51.505, -0.09], 13);

	var tiles = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		maxZoom: 18,
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
			'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox/streets-v11',
		tileSize: 512,
		zoomOffset: -1
	}).addTo(map);

	var marker = L.marker([51.5, -0.09]).addTo(map)
		.bindPopup('<b>Hello world!</b><br />I am a popup.').openPopup();

	var circle = L.circle([51.508, -0.11], {
		color: 'red',
		fillColor: '#f03',
		fillOpacity: 0.5,
		radius: 500
	}).addTo(map).bindPopup('I am a circle.');

	var polygon = L.polygon([
		[51.509, -0.08],
		[51.503, -0.06],
		[51.51, -0.047]
	]).addTo(map).bindPopup('I am a polygon.');


	var popup = L.popup()
		.setLatLng([51.513, -0.09])
		.setContent('I am a standalone popup.')
		.openOn(map);

	function onMapClick(e) {
		popup
			.setLatLng(e.latlng)
			.setContent('You clicked the map at ' + e.latlng.toString())
			.openOn(map);
	}

	map.on('click', onMapClick);
</script>