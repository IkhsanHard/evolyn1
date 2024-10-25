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
				<div id="home">
					<div class="container-fluid mt-2" id="kasircontainer">
						<div class="row">
							<div class="col-sm-8 mt-4">
								<div class="card card-rounded">
									<div class="card-header bg-primary text-white">
										<i class="fa fa-cubes"></i> Menu
									</div>
									<div class="card-body p-2">
										<div class="row">
											<div class="col-sm-3">
												<div class="dropdown open mb-3">
													<button class="btn btn-secondary btn-block dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														Semua Kategori </button>
													<div class="dropdown-menu" style="width:100%" aria-labelledby="triggerId">
														<a class="dropdown-item" href="#" onclick="displayCategory('(Makanan)')">Makanan</a>
														<div class="dropdown-divider"></div>
														<a class="dropdown-item" href="#" onclick="displayCategory('(Minuman)')">Minuman</a>
														<div class="dropdown-divider"></div>
														<a class="dropdown-item" href="#" onclick="displayCategory('Semua Kategori')">Semua Kategori</a>
													</div>
												</div>
											</div>
											<div class="col-sm-6 offset-sm-3 mb-3">
												<div class="input-group">
													<input type="text" class="form-control" value="" name="cari" id="cari" placeholder="Cari Menu">
													<div class="input-group-append">
														<button type="submit" class="btn btn-primary btn-md">
														</button>
													</div>
												</div>
											</div>
										</div>
										<div class="table-responsive-1 w-100">
											<div id="load-data" class="row-css">
												<?php foreach ($all_menu as $menu) : ?>
													<div class="col-50 mb-3">
														<button class="btn btn-outline-secondary btn-sm pt-2 pb-2 btn-menu btn-block pilih" onclick="addtocart(<?= $menu->id_menu ?>,'<?= $menu->nama_menu ?>','<?= $menu->harga ?>')">
															<img src="<?= $menu->gambar ?>" class="img-fluid w-100 mb-2" style="height:140px;object-fit:cover;">
															<br>
															<b style="font-size:10pt;" class="text-hitam">(ID : <?= $menu->id_menu ?>)</b>
															<br>
															<b style="font-size:10pt;" class="text-hitam kategori">(<?= $menu->kategori ?>)</b>
															<br>
															<b style="font-size:10pt;" class="text-hitam nama_menu"><?= $menu->nama_menu ?></b>
															<br>
															<b style="font-size:10pt;" class="text-hitam">Rp<?= number_format($menu->harga, 0, ',', '.') ?>,-</b>
															<br>
														</button>
													</div>
												<?php endforeach; ?>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-sm-4 mt-4">
								<div class="card card-rounded">
									<div class="card-header bg-primary text-white">
										<i class="fa fa-shopping-cart"></i> Order
									</div>
									<form method="post" id="AddKasir">
										<div class="card-body p-2">
											<div class="form-group row">
												<label for="" class="col-sm-4 col-form-label">ID Kasir</label>
												<div class="col-sm-8">
													<input type="text" value="<?= $this->session->login['id_user'] ?>" name="id_user" id="id_user" readonly class="form-control">
												</div>
											</div>
											<div class="form-group row">
												<label for="" class="col-sm-4 col-form-label">ID Pesanan</label>
												<div class="col-sm-8">
													<input type="text" readonly class="form-control" name="id_pesanan" id="id_pesanan" placeholder="ID Pesanan">
												</div>
											</div>
											<div class="form-group row">
												<label for="" class="col-sm-4 col-form-label">Nomor Meja</label>
												<div class="col-sm-8">
													<select class="form-control" name="meja" id="meja" required>
														<option value="">Select an item...</option>
													</select>
												</div>
											</div>
											<div class="float-left pt-2">
												<i class="fa fa-shopping-cart"></i> List Order
											</div>
											<div class="clearfix"></div>
										</div>
										<div class="keranjang">
											<table class="table table-striped table-sm w-100" id="keranjang" style="font-size:10pt;">
												<thead>
													<tr>
														<th>ID Menu</th>
														<th>Nama</th>
														<th>Harga</th>
														<th>Qty</th>
														<th>Sub Total</th>
														<th>#</th>
													</tr>
												</thead>
												<tbody>
												</tbody>
											</table>
										</div>
										<div class="card-footer p-2">
											<table class="aTable">
												<tbody>
													<tr>
														<th>Pembayaran</th>
														<td>
															<div class="input-group">
																<select class="form-control" name="jenis_pembayaran" id="jenis_pembayaran" required>
																	<option value="">Select an item...</option>
																	<option value="tunai">Tunai</option>
																	<option value="qris">Qris</option>
																</select>
															</div>
														</td>
													</tr>
													<tr id="dibayarRow" style="display:none;">
														<th>Dibayar</th>
														<td>
															<div class="input-group">
																<div class="input-group-prepend">
																	<span class="input-group-text" id="basic-addon1">Rp</span>
																</div>
																<input type="text" value="0" class="form-control form-lg" name="jumlahDibayar" id="jumlahDibayar">
															</div>
														</td>
													</tr>
													<tr id="kembalianRow" style="display:none;">
														<th>Kembalian</th>
														<td>
															<div class="input-group">
																<div class="input-group-prepend">
																	<span class="input-group-text" id="basic-addon1">Rp</span>
																</div>
																<input type="text" value="0" class="form-control form-lg" name="kembalian" id="kembalian" readonly="">
															</div>
														</td>
													</tr>
													<tr>
														<th>Total Bayar</th>
														<td>
															<div class="input-group">
																<div class="input-group-prepend">
																	<span class="input-group-text" id="basic-addon1">Rp</span>
																</div>
																<input type="text" value="0" class="form-control form-lg" name="total_bayar" id="totalBayar" readonly="">
															</div>
														</td>
													</tr>
												</tbody>
											</table>
											<button type="submit" id="prosesTransaksi" class="btn btn-primary btn-md btn-block mt-2">
												<i class="fa fa-save"></i> Simpan Transaksi
											</button>
										</div>
									</form>
								</div>
							</div>
							<div class="modal fade" id="modalStruk" tabindex="-1" role="dialog" aria-labelledby="modalStrukTitle" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
									<div class="modal-content">
										<!-- Konten Modal -->
										<div class="modal-header">
											<h5 class="modal-title" id="modalStrukTitle">Struk Pembayaran</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload();">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<!-- Isi Konten Modal -->
											<div id="contentStruk">
												<!-- Struk Pembayaran -->
												<div class="text-center mb-3">
													<h3>Elovyn Cafee</h3>
													<p>Jalan Gor barat, Pakansari, Kec. Cibinong, Kabupaten Bogor, Jawa Barat 16915</p>
													<p>Telp: 0877-8063-3798</p>
												</div>
												<hr>
												<div class="mb-3">
													<p><strong>Tanggal : </strong><span id="tanggal_pemesanan"><?= date('Y-m-d') ?></span></p>
													<p><strong>ID Pesanan : </strong><span id="id_pesanan_struk"></span></p>
													<p><strong>No Meja : </strong><span id="id_meja_struk"></span></p>
													<hr>

													<table class="table" id='idbodystruk'>
														<thead>
															<tr>
																<th scope="col">ID Menu</th>
																<th scope="col">ID Nama</th>
																<th scope="col">Harga</th>
																<th scope="col">Qty</th>
																<th scope="col">Sub Total</th>
															</tr>
														</thead>
														<tbody>
														</tbody>
													</table>
													<hr>
													<p><strong>Total : </strong>Rp. <span id="id_total_struk"></span>.00</p>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.reload();">Tutup</button>
											<button type="button" class="btn btn-primary" onclick="printStruk()">Cetak Struk</button>
										</div>
									</div>
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
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script>
		console.log(jQuery.fn.jquery);

		function addtocart(id_menu, nama, harga) {

			const newRow = `<tr>
			<td>${id_menu}</td>
			<td>${nama}</td>
			<td class="harga">${harga}</td>
			<td><input type="number" class="input-jumlah" style="width: 100px;" value="1" required></td>
			<td class="subtotal" data-price="${harga}"></td>
			<td><button type="button" class="btn btn-danger btn-sm tombol-hapus"><i class="fa fa-trash"></i></button></td>
		</tr>`;

			$('table#keranjang tbody').append(newRow);

			// Calculate and update the subtotal and total
			updateSubtotalAndTotal();

			// Add event listener to newly created delete button
			$('.tombol-hapus').off().on('click', function() {
				$(this).closest('tr').remove();
				updateSubtotalAndTotal();
			});

			$('.input-jumlah').off().on('input', function() {
				updateSubtotalAndTotal();
			});
		}

		function printStruk() {
			// Salin konten modal ke dalam popup cetak
			var printWindow = window.open('', '_blank');
			printWindow.document.write('<html><head><title>Struk Pembayaran</title></head><body>');
			printWindow.document.write('<div id="contentStruk">');
			printWindow.document.write(document.getElementById('contentStruk').innerHTML);
			printWindow.document.write('</div>');
			printWindow.document.write('</body></html>');
			printWindow.document.close();

			// Panggil fungsi print pada popup cetak
			printWindow.print();
		}

		// function updateSubtotalAndTotal() {
		// 	// Update subtotal
		// 	$('.input-jumlah').each(function() {
		// 		const quantity = $(this).val();
		// 		const price = parseFloat($(this).closest('tr').find('.harga').text());
		// 		const subtotal = quantity * price || 0;
		// 		$(this).closest('tr').find('.subtotal').text(subtotal.toFixed(2));
		// 	});

		// 	// Calculate total
		// 	let total = 0;
		// 	$('.subtotal').each(function() {
		// 		total += parseFloat($(this).text()) || 0;
		// 	});

		// 	// Update the total
		// 	$('#totalBayar').val(total.toFixed(2));
		// }
		$('#jenis_pembayaran').on('change', function() {
			var selectedPaymentType = $(this).val();

			// Sembunyikan/munculkan baris Dibayar dan Kembalian berdasarkan jenis pembayaran
			if (selectedPaymentType === 'tunai') {
				$('#dibayarRow, #kembalianRow').show();
			} else {
				$('#dibayarRow, #kembalianRow').hide();
			}

			// Lakukan pembaruan subtotal dan total
			updateSubtotalAndTotal();
		});

		$('#jumlahDibayar').on('input', function() {
			// Update kembalian setiap kali nilai jumlahDibayar berubah
			hitungKembalian();
		});

		function updateSubtotalAndTotal() {
			// Update subtotal
			$('.input-jumlah').each(function() {
				const quantity = $(this).val();
				const price = parseFloat($(this).closest('tr').find('.harga').text());
				const subtotal = quantity * price || 0;
				$(this).closest('tr').find('.subtotal').text(subtotal.toFixed(2));
			});

			// Calculate total
			let total = 0;
			$('.subtotal').each(function() {
				total += parseFloat($(this).text()) || 0;
			});

			// Update the total
			$('#totalBayar').val(total.toFixed(2));

			// Update kembalian
			if ($('#jenis_pembayaran').val() === 'tunai') {
				hitungKembalian();
			} else {
				// Jika jenis pembayaran bukan "Tunai," atur kembalian menjadi 0
				$('#kembalian').val('0.00');
			}
		}

		function hitungKembalian() {
			// Ambil nilai total dan jumlah dibayar
			const total = parseFloat($('#totalBayar').val()) || 0;
			const jumlahDibayar = parseFloat($('#jumlahDibayar').val()) || 0;

			// Hitung kembalian
			const kembalian = jumlahDibayar - total;

			// Tampilkan kembalian
			$('#kembalian').val(kembalian.toFixed(2));

			// Tampilkan kembalian juga di konsol
			console.log('Kembalian:', kembalian.toFixed(2));
		}

		// Panggil fungsi pertama kali untuk menginisialisasi total dan kembalian
		updateSubtotalAndTotal();

		// Function to fetch the id_user from the Kasir controller endpoint

		$(document).ready(function() {
			// Populate Meja dropdown using AJAX
			$.getJSON('<?php echo base_url('Penjualan/nomorMeja'); ?>', function(data) {
				// console.log(data);
				var dropdown = $('#meja');
				$.each(data, function(key, val) {
					dropdown.append('<option value="' + val.id_meja + '">' + val.nomor_meja + ' - ' + 'Kapasitas : ' + val.kapasitas + '</option>');
					// console.log(val.NOMOR_MEJA);
				});
			});

			// Activate the search feature using Select2
			// $('#meja').select2();

			// Handle form submission
			$('#AddKasir').submit(function(e) {
				e.preventDefault();

				// Ambil nilai kembalian
				const kembalian = parseFloat($('#kembalian').val()) || 0;

				// Pastikan kembalian tidak minus
				if (kembalian < 0) {
					// Munculkan alert bahwa kembalian tidak boleh minus
					Swal.fire({
						icon: 'error',
						title: 'Kembalian Tidak Valid',
						text: 'Kembalian tidak boleh minus!',
					});
				} else {
					// Kembalian tidak minus, lanjutkan dengan menyimpan transaksi
					$.ajax({
						url: 'penjualan/simpanTransaksi',
						method: 'POST',
						data: $(this).serialize(),
						success: function(response) {
							console.log('Transaksi berhasil disimpan.');
							simpanDetailOrderToServer();
							tampilkanModalStruk();
						},
						error: function(error) {
							console.error('Terjadi kesalahan:', error);
							// Handle error appropriately
						}
					});
				}
			});

			function performSearch() {
				var searchValue = $('#cari').val().toLowerCase(); // Get the search input value

				$('.btn-menu').each(function() {
					var menuName = $(this).find('.nama_menu').text().toLowerCase(); // Get the text content of the menu name
					var isMatch = menuName.includes(searchValue); // Check if the menu name contains the search value
					$(this).toggle(isMatch); // Show/hide the menu item based on the match result
				});
			}

			// Call the search function on keyup
			$('#cari').on('keyup', function() {
				performSearch();
			});

			// Call the search function on button click
			$('.btn-search').on('click', function() {
				performSearch();
			});
		});

		function tampilkanModalStruk() {
			// Mendapatkan konten struk dari server (misalnya dengan AJAX lagi)
			// Di sini Anda dapat menyiapkan konten struk berdasarkan data yang telah disimpan
			// var kontenStruk = $('#id_user').val(); // Ganti dengan konten struk yang sebenarnya
			$('#id_pesanan_struk').text($('#id_pesanan').val());
			// $('#id_meja_struk').text($('#meja').val());
			$('#id_meja_struk').text($('#meja option:selected').text());


			// Memasukkan konten struk ke dalam modal
			$('#contentStruk').html();

			// Menampilkan modal
			$('#modalStruk').modal('show');
		}


		function simpanDetailOrderToServer() {
			let detailOrder = [];
			let id_pesanan = $('#id_pesanan').val();

			$('#keranjang tbody tr').each(function() {
				let id_menu = $(this).find('td:eq(0)').text(); // ID Menu dari kolom pertama
				let jumlah_pesanan = $(this).find('.input-jumlah').val(); // Jumlah Pesanan dari input jumlah
				let harga_satuan = $(this).find('.harga').text(); // Harga Satuan dari kolom dengan kelas '.harga'
				let total_harga = $(this).find('.subtotal').text(); // Total Harga dari kolom dengan kelas '.subtotal'

				// Menambahkan data detail order ke dalam array
				detailOrder.push({
					id_pesanan: id_pesanan,
					id_menu: id_menu,
					jumlah_pesanan: jumlah_pesanan,
					harga_satuan: harga_satuan,
					total_harga: total_harga
				});
			});

			// Mengirim data ke server menggunakan AJAX
			$.ajax({
				url: 'penjualan/simpan_detail_order', // Sesuaikan dengan URL endpoint di server
				method: 'POST',
				contentType: 'application/json',
				data: JSON.stringify(detailOrder),
				success: function(response) {
					// Handle jika berhasil
					console.log(response);
					console.log('Data berhasil disimpan ke dalam database.');
					let jsonResponse = JSON.parse(response);

					// Mengakses properti objek
					let tableBody = document.getElementById('idbodystruk');

					var totalstruk = 0;


					// Mengisi tabel dengan data dari respons JSON
					jsonResponse.data.forEach(function(item) {
						let totalHarga = parseFloat(item.total_harga); // Jika nilai total_harga dalam format string numerik

						// Menambahkan nilai total_harga ke totalstruk
						totalstruk += totalHarga;

						let row = tableBody.insertRow(); // Menambahkan baris ke tabel

						let idMenuCell = row.insertCell(0);
						idMenuCell.innerHTML = item.id_menu;

						let idNamaCell = row.insertCell(1);
						idNamaCell.innerHTML = item.nama_menu;

						let hargaCell = row.insertCell(2);
						hargaCell.innerHTML = 'Rp ' + item.harga_satuan;

						let qtyCell = row.insertCell(3);
						qtyCell.innerHTML = item.jumlah_pesanan;

						let subTotalCell = row.insertCell(4);
						subTotalCell.innerHTML = 'Rp ' + item.total_harga;
					});

					$('#id_total_struk').text(totalstruk);



					// Mengakses setiap objek dalam array 'data'
				},
				error: function(error) {
					// Handle jika terjadi kesalahan
					console.error('Terjadi kesalahan saat menyimpan data:', error);
				}
			});
		}

		function generateRandomId() {
			const randomSixDigits = Math.floor(100000 + Math.random() * 900000); // Angka acak 6 digit
			return 'P' + randomSixDigits; // Menggabungkan 'P' dengan angka acak 6 digit
		}

		// Set nilai acak ke input saat halaman dimuat
		document.addEventListener('DOMContentLoaded', function() {
			document.getElementById('id_pesanan').value = generateRandomId();
		});

		function displayCategory(nama_kategori) {
			if (nama_kategori == 'Semua Kategori') {
				$('.kategori').each(function(i, v) {
					console.log($(this))
					$(this).parent().parent().show()
				})
			} else {
				$('.kategori').each(function(i, v) {
					console.log($(this).text())
					if ($(this).text() == nama_kategori) {
						$(this).parent().parent().show()
					} else {
						$(this).parent().parent().hide()
					}
				})
			}
			$('#triggerId').html(nama_kategori.replace(/\(|\)/g, ''));
		}
	</script>


</body>

</html>