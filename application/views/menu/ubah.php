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
			<div id="content" data-url="<?= base_url('menu') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
					<div class="clearfix">
						<div class="float-left">
							<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
						</div>
						<div class="float-right">
							<a href="<?= base_url('menu') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-6">
							<div class="card shadow">
								<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
								<div class="card-body">
									<form action="<?= base_url('menu/proses_ubah/' . $menu->id_menu) ?>" id="form-tambah" method="POST">
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="id_menu"><strong>ID Menu</strong></label>
												<input type="text" name="id_menu" placeholder="Masukkan Kode Barang" autocomplete="off" class="form-control" required value="<?= $menu->id_menu ?>" maxlength="8" readonly>
											</div>
											<div class="form-group col-md-6">
												<label for="nama_menu"><strong>Nama Menu</strong></label>
												<input type="text" name="nama_menu" placeholder="Masukkan Nama Menu" autocomplete="off" class="form-control" required value="<?= $menu->nama_menu ?>">
											</div>
											<div class="form-group col-md-6">
												<label for="deskripsi"><strong>Deskripsi</strong></label>
												<input type="textarea" name="deskripsi" placeholder="Masukkan Deskripsi" autocomplete="off" class="form-control" required value="<?= $menu->deskripsi ?>">
											</div>
											<div class="form-group col-md-6">
												<label for="harga"><strong>Harga</strong></label>
												<input type="number" name="harga" placeholder="Masukkan Harga" autocomplete="off" class="form-control" required value="<?= $menu->harga ?>">
											</div>
											<div class="form-group col-md-6">
												<label for="kategori"><strong>Kategori</strong></label>
												<select name="kategori" class="form-control">
													<option value="Makanan" <?= ($menu->kategori == 'Makanan') ? 'selected' : '' ?>>Makanan</option>
													<option value="Minuman" <?= ($menu->kategori == 'Minuman') ? 'selected' : '' ?>>Minuman</option>
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