<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view('partials/head.php') ?>
</head>

<body id="page-top">
	<div id="wrapper">
		<!-- load sidebar -->
		<?php $this->load->view('partials/sidebar.php') ?>

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('kasir') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
					<div class="clearfix">
						<div class="float-left">
							<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
						</div>
					</div>
					<hr>
					<?php if ($this->session->flashdata('success')) : ?>
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<?= $this->session->flashdata('success') ?>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php elseif ($this->session->flashdata('error')) : ?>
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<?= $this->session->flashdata('error') ?>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php endif ?>
					<div class="row">

						<!-- Earnings (Monthly) Card Example -->
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-primary shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Menu</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_menu ?></div>
										</div>
										<div class="col-auto">
											<i class="fas fa-box fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Earnings (Monthly) Card Example -->
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-success shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Kasir</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_kasir ?></div>
										</div>
										<div class="col-auto">
											<i class="fas fa-cash-register fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Earnings (Monthly) Card Example -->
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-info shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jumlah Transaksi</div>
											<div class="row no-gutters align-items-center">
												<div class="col-auto">
													<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $jumlah_penjualan ?></div>
												</div>
											</div>
										</div>
										<div class="col-auto">
											<i class="fas fa-file-invoice fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Pending Requests Card Example -->
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-warning shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Bayar</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800">Rp.<?= number_format($total_bayar, 0, ',', '.') ?>,-</div>
										</div>
										<div class="col-auto">
											<i class="fas fa-users fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xl-8 col-lg-7">
							<!-- Area Chart -->
							<div class="card shadow mb-4">
								<div class="card-header py-3">
									<h6 class="m-0 font-weight-bold text-primary">Ringkasan Pendapatan</h6>
								</div>
								<div class="card-body">
									<div class="chart-area">
										<!-- Pastikan elemen canvas dengan ID "myAreaChart" sudah ada di sini -->
										<canvas id="myChart"></canvas>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-lg-5">
							<div class="card shadow mb-4">
								<!-- Card Header - Dropdown -->
								<div class="card-header py-3">
									<h6 class="m-0 font-weight-bold text-primary">Sumber Pendapatan</h6>
								</div>
								<!-- Card Body -->
								<div class="card-body">
									<div class="chart-pie pt-4">
										<canvas id="myPieChart"></canvas>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- <div class="row">
						<div class="col-md-6">
							<div class="card shadow">
								<div class="card-header"><strong>Profil Cafee</strong></div>
								<div class="card-body">
									<strong>Nama Cafee : </strong><br>
									<input type="text" value="Elovyn Caffe" readonly class="form-control mt-2 mb-2">
									<strong>Nama Pemilik : </strong><br>
									<input type="text" value="Indra" readonly class="form-control mt-2 mb-2">
									<strong>No Telepon : </strong><br>
									<input type="text" value="089922113322" readonly class="form-control mt-2 mb-2">
									<strong>Alamat : </strong><br>
									<input type="text" value="Cibinong" readonly class="form-control mt-2">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card shadow">
								<div class="card-header"><strong>User Sedang Login</strong></div>
								<div class="card-body">
									<strong>Nama : </strong><br>
									<input type="text" value="<?= $this->session->login['nama'] ?>" readonly class="form-control mt-2 mb-2">
									<strong>Username : </strong><br>
									<input type="text" value="<?= $this->session->login['username'] ?>" readonly class="form-control mt-2 mb-2">
									<strong>Role : </strong><br>
									<input type="text" value="<?= $this->session->login['role'] ?>" readonly class="form-control mt-2 mb-2">
									<strong>Jam Login : </strong><br>
									<input type="text" value="<?= $this->session->login['jam_masuk'] ?>" readonly class="form-control mt-2">
								</div>
							</div>
						</div>
					</div> -->
					<!-- </div> -->
				</div>
				<!-- load footer -->
			</div>
			<?php $this->load->view('partials/footer.php') ?>
		</div>
		<?php $this->load->view('partials/js.php') ?>
		<!-- Sambungkan script Chart.js setelah elemen HTML -->
		<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->

		<!-- Sambungkan script chart-area-demo.js dengan menggunakan base_url() -->
		<!-- <script src="<?= base_url('sb-admin/js/demo/chart-area-demo.js') ?>"></script> -->
		<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
		<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
		<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

		<script>
			$(document).ready(function() {

				var areaData = {
					labels: [], // Label harian akan diisi setelah menerima data dari server
					datasets: [{
						label: "Pendapatan",
						lineTension: 0.3,
						backgroundColor: "rgba(78, 115, 223, 0.05)",
						borderColor: "rgba(78, 115, 223, 1)",
						pointRadius: 3,
						pointBackgroundColor: "rgba(78, 115, 223, 1)",
						pointBorderColor: "rgba(78, 115, 223, 1)",
						pointHoverRadius: 3,
						pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
						pointHoverBorderColor: "rgba(78, 115, 223, 1)",
						pointHitRadius: 10,
						pointBorderWidth: 2,
						data: [], // Data harian akan diisi setelah menerima data dari server
					}],
				};

				var areaOptions = {
					maintainAspectRatio: false,
					layout: {
						padding: {
							left: 10,
							right: 25,
							top: 25,
							bottom: 0
						}
					},
					scales: {
						xAxes: [{
							gridLines: {
								display: false,
								drawBorder: false
							},
						}],
						yAxes: [{
							ticks: {
								maxTicksLimit: 5,
								padding: 10,
								// Include a dollar sign in the ticks
								callback: function(value, index, values) {
									return '$' + number_format(value);
								}
							},
							gridLines: {
								color: "rgb(234, 236, 244)",
								zeroLineColor: "rgb(234, 236, 244)",
								drawBorder: false,
								borderDash: [2],
								zeroLineBorderDash: [2]
							}
						}],
					},
					legend: {
						display: false
					},
					tooltips: {
						backgroundColor: "rgb(255,255,255)",
						bodyFontColor: "#858796",
						titleMarginBottom: 10,
						titleFontColor: '#6e707e',
						titleFontSize: 14,
						borderColor: '#dddfeb',
						borderWidth: 1,
						xPadding: 15,
						yPadding: 15,
						displayColors: false,
						intersect: false,
						mode: 'index',
						caretPadding: 10,
					}
				};

				// Ambil data ringkasan pendapatan harian dari server dengan AJAX
				$.ajax({
					url: '<?= base_url('dashboard/get_daily_summary'); ?>',
					method: 'GET',
					dataType: 'json',
					success: function(response) {
						// Memisahkan tanggal dan total harian dari response
						var dates = response.map(entry => entry.tanggal_pemesanan);
						var totalHarian = response.map(entry => entry.total_harian);

						// Mengisi data harian ke dalam objek chart
						areaData.labels = dates;
						areaData.datasets[0].data = totalHarian;

						// Setup chart setelah mendapatkan data
						var areaCtx = document.getElementById('myChart').getContext('2d');
						var areaChart = new Chart(areaCtx, {
							type: 'line', // Ganti menjadi line chart
							data: areaData,
							options: areaOptions
						});

						// Tampilkan total pendapatan di luar chart
						$('#totalPendapatan').text('Total Pendapatan: Rp ' + totalHarian.reduce((a, b) => a + parseFloat(b), 0).toFixed(2));
					},
					error: function(xhr, status, error) {
						console.error(error);
					}
				});


				// Ambil data grafik menggunakan Ajax
				$.ajax({
					url: '<?= base_url("dashboard/getGraphData"); ?>',
					type: 'GET',
					dataType: 'json',
					success: function(graphData) {
						// Proses data grafik
						var labels = [];
						var data = [];

						for (var i = 0; i < graphData.length; i++) {
							labels.push(graphData[i].kategori);
							data.push(graphData[i].jumlah_menu);
						}

						// Konfigurasi grafik pie
						var pieData = {
							labels: labels,
							datasets: [{
								data: data,
								backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f8d7da', '#d4edda'],
								hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#f5c6cb', '#c3e6cb'],
								hoverBorderColor: "rgba(234, 236, 244, 1)",
							}],
						};

						var pieOptions = {
							maintainAspectRatio: false,
							tooltips: {
								backgroundColor: "rgb(255,255,255)",
								bodyFontColor: "#858796",
								borderColor: '#dddfeb',
								borderWidth: 1,
								xPadding: 15,
								yPadding: 15,
								displayColors: false,
								caretPadding: 10,
							},
							legend: {
								display: false
							},
							cutoutPercentage: 80,
						};

						// Render grafik pie
						var pieCtx = document.getElementById("myPieChart").getContext('2d');
						var myPieChart = new Chart(pieCtx, {
							type: 'doughnut',
							data: pieData,
							options: pieOptions
						});
					}
				});
			});
		</script>

</body>

</html>