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
			<div id="content" data-url="<?= base_url('penjualan') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
					<div class="clearfix">
						<div class="float-left">
							<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
						</div>
						<div class="float-right">
							<a href="<?= base_url('penjualan/riwayat') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
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
					<div class="card shadow">
						<div class="card-header"><strong>Detail Penjualan - <?= $penjualan->id_pesanan ?></strong></div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-6">
									<table class="table table-borderless">
										<tr>
											<td><strong>ID Pesanan</strong></td>
											<td>:</td>
											<td><?= $penjualan->id_pesanan ?></td>
										</tr>
										<tr>
											<td><strong>ID Kasir</strong></td>
											<td>:</td>
											<td><?= $penjualan->id_user ?></td>
										</tr>
										<tr>
											<td><strong>No Meja</strong></td>
											<td>:</td>
											<td><?= $penjualan->id_meja ?></td>
										</tr>
										<tr>
											<td><strong>Tanggal Penjualan</strong></td>
											<td>:</td>
											<td><?= $penjualan->tanggal_pemesanan ?></td>
										</tr>
									</table>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-md-12">
									<table class="table table-bordered">
										<thead>
											<tr>
												<td><strong>No</strong></td>
												<td><strong>Nama Menu</strong></td>
												<td><strong>Harga Menu</strong></td>
												<td><strong>Jumlah</strong></td>
												<td><strong>Sub Total</strong></td>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($all_detail_penjualan as $detail_penjualan) : ?>
												<tr>
													<td><?= $no++ ?></td>
													<td><?= $detail_penjualan->nama_menu ?></td>
													<td>Rp <?= number_format($detail_penjualan->harga_satuan, 0, ',', '.') ?></td>
													<td><?= $detail_penjualan->jumlah_pesanan ?></td>
													<td>Rp <?= number_format($detail_penjualan->total_harga, 0, ',', '.') ?></td>
												</tr>
											<?php endforeach ?>
										</tbody>
										<tfoot>
											<tr>
												<td colspan="4" align="right"><strong>Total : </strong></td>
												<td>Rp <?= number_format($penjualan->total_bayar, 0, ',', '.') ?></td>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- load footer -->
			<?php $this->load->view('partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('partials/js.php') ?>
	<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>

</html>