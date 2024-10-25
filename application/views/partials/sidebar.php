<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dashboard') ?>">
		<div class="sidebar-brand-icon mx-3">
			Elovyn<sup> Cafee</sup>
		</div>
	</a>
	<hr class="sidebar-divider my-0">
	<li class="nav-item <?= $aktif == 'dashboard' ? 'active' : '' ?>">
		<?php if ($this->session->login['role'] == 'admin') : ?>
			<a class="nav-link" href="<?= base_url('dashboard') ?>">
				<i class="fas fa-fw fa-tachometer-alt"></i>
				<span>Dashboard</span>
			</a>
		<?php endif; ?>
	</li>
	<hr class="sidebar-divider">

	<div class="sidebar-heading">
		Master
	</div>

	<li class="nav-item <?= $aktif == 'menu' ? 'active' : '' ?>">
		<?php if ($this->session->login['role'] == 'admin') : ?>
			<a class="nav-link" href="<?= base_url('menu') ?>">
				<i class="fas fa-fw fa-box"></i>
				<span>Master Menu</span>
			</a>
		<?php endif; ?>
	</li>

	<li class="nav-item <?= $aktif == 'kasir' ? 'active' : '' ?>">
		<?php if ($this->session->login['role'] == 'admin') : ?>
			<a class="nav-link" href="<?= base_url('kasir') ?>">
				<i class="fas fa-fw fa-cash-register"></i>
				<span>Master Kasir</span>
			</a>
		<?php endif; ?>
	</li>

	<li class="nav-item <?= $aktif == 'meja' ? 'active' : '' ?>">
		<?php if ($this->session->login['role'] == 'admin') : ?>
			<a class="nav-link" href="<?= base_url('meja') ?>">
				<i class="fas fa-fw fa-landmark"></i>
				<span>Master Meja</span>
			</a>
		<?php endif; ?>
	</li>

	<li class="nav-item <?= $aktif == 'penjualan' ? 'active' : '' ?>">
		<?php if ($this->session->login['role'] == 'kasir') : ?>
			<a class="nav-link" href="<?= base_url('penjualan') ?>">
				<i class="fas fa-fw fa-file-invoice"></i>
				<span>Transaksi</span>
			</a>
		<?php endif; ?>
	</li>

	<li class="nav-item <?= $aktif == 'auth' ? 'active' : '' ?>">
		<?php if ($this->session->login['role'] == 'kasir' || $this->session->login['role'] == 'admin') : ?>
			<a class="nav-link" href="<?= base_url('auth') ?>">
				<i class="fas fa-fw fa-file-invoice"></i>
				<span>Ganti Password</span>
			</a>
		<?php endif; ?>
	</li>

	<!-- Divider -->
	<hr class="sidebar-divider">

	<?php if ($this->session->login['role'] == 'admin') : ?>
		<div class="sidebar-heading">
			Riwayat Transaksi
		</div>

		<li class="nav-item <?= $aktif == '/penjualan/riwayat' ? 'active' : '' ?>">
			<a class="nav-link" href="<?= base_url('penjualan/riwayat') ?>">
				<i class="fas fa-fw fa-building"></i>
				<span>Riwayat Transaksi</span>
			</a>
		</li>
	<?php endif; ?>



	<!-- <hr class="sidebar-divider"> -->
	<!-- <?php if ($this->session->login['role'] == 'admin') : ?>
		<div class="sidebar-heading">
			Pengaturan
		</div>

		<li class="nav-item <?= $aktif == 'pengguna' ? 'active' : '' ?>">
			<a class="nav-link" href="<?= base_url('pengguna') ?>">
				<i class="fas fa-fw fa-users"></i>
				<span>Manajemen Pengguna</span></a>
		</li>

		<li class="nav-item <?= $aktif == 'toko' ? 'active' : '' ?>">
			<a class="nav-link" href="<?= base_url('toko') ?>">
				<i class="fas fa-fw fa-building"></i>
				<span>Profil Toko</span></a>
		</li>
		<hr class="sidebar-divider d-none d-md-block">
	<?php endif; ?> -->

	<!-- Sidebar Toggler (Sidebar) -->
	<div class="text-center d-none d-md-inline">
		<button class="rounded-circle border-0" id="sidebarToggle"></button>
	</div>
</ul>