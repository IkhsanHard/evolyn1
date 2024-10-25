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
			<div id="content" data-url="<?= base_url('meja') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
					<div class="clearfix">
						<div class="float-left">
							<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
						</div>
						<div class="float-right">
							<a href="<?= base_url('meja') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-6">
							<div class="card shadow">
								<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
								<div class="card-body">
									<form action="<?= base_url('meja/proses_ubah/' . $meja->id_meja) ?>" id="form-tambah" method="POST">
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="id_menu"><strong>ID Meja</strong></label>
												<input type="text" name="id_meja" placeholder="Masukkan ID Meja" autocomplete="off" class="form-control" required value="<?= $meja->id_meja ?>" maxlength="8" readonly>
											</div>
											<div class="form-group col-md-6">
												<label for="nama_menu"><strong>Nomor Meja</strong></label>
												<input type="text" name="nomor_meja" placeholder="Masukkan Nomor Meja" autocomplete="off" class="form-control" required value="<?= $meja->nomor_meja ?>">
											</div>
											<div class="form-group col-md-6">
												<label for="deskripsi"><strong>Kapasitas</strong></label>
												<input type="text" name="kapasitas" placeholder="Masukkan Kapasitas Meja" autocomplete="off" class="form-control" required value="<?= $meja->kapasitas ?>">
											</div>
											<div class="form-group col-md-6">
												<label for="deskripsi"><strong>Status</strong></label>
												<select class="form-control" name="status" id="Status" required>
												<option value="<?= $meja->Status ?>"><?= $meja->Status ?></option>
													<option value="tersedia">Tersedia</option>
													<option value="tidak_tersedia">Tidak Tersedia</option>
												</select>

											</div>
										</div>
										<hr>
										<div class="form-group">
											<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
											<button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>
										</div>
									</form>
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
</body>

</html>