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
            <div id="content" data-url="<?= base_url('auth') ?>">
                <!-- load Topbar -->
                <?php $this->load->view('partials/topbar.php') ?>

                <div class="container-fluid">
                    <div class="clearfix">
                        <div class="float-left">
                            <h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card shadow">
                                <div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
                                <div class="card-body">
                                    <form action="<?= base_url('auth/proses_ubah/') ?>" id="form-ubah" method="POST">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="username"><strong>Username</strong></label>
                                                <input type="text" name="username" placeholder="Masukkan Username" autocomplete="off" class="form-control" required value="<?= $this->session->login['username'] ?>" maxlength="8" readonly>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="password"><strong>Password</strong></label>
                                                <input type="password" name="password" placeholder="Masukkan Password" id="password" autocomplete="off" class="form-control" required value="">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="confirm_password"><strong>Confirm Password</strong></label>
                                                <input type="password" name="confirm_password" id="confirm_password" placeholder="Konfirmasi Password" autocomplete="off" class="form-control" required value="">
                                                <div id="password-error" style="color: red;"></div>
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
    <!-- Include SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        $(document).ready(function() {
            $('#form-ubah').submit(function(e) {
                e.preventDefault();

                // Check if passwords match
                var password = $('#password').val();
                var confirm_password = $('#confirm_password').val();

                if (password !== confirm_password) {
                    $('#password-error').text('Password and Confirm Password do not match');
                } else {
                    // Reset error message
                    $('#password-error').text('');

                    // Show SweetAlert for successful password change
                    Swal.fire({
                        icon: 'success',
                        title: 'Password Changed Successfully!',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        // Reload the page after SweetAlert is closed
                        location.reload();
                    });

                    // Uncomment the following line if you want to submit the form after SweetAlert
                    // $(this).unbind('submit').submit();
                }
            });
        });
    </script>
</body>


</html>