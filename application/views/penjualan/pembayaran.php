<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pembayaran</title>
    <script src="https://cdn.jsdelivr.net/npm/qrious@4.0.2/dist/qrious.min.js"></script>
</head>

<body>

    <h2>Metode Pembayaran</h2>

    <form action="proses_pembayaran.php" method="post">

        <div class="form-group row">
            <label for="metode_pembayaran" class="col-sm-4 col-form-label">Pilih Metode Pembayaran</label>
            <div class="col-sm-8">
                <select class="form-control" name="metode_pembayaran" id="metode_pembayaran" required>
                    <option value="cash">Cash</option>
                    <option value="qris">QRIS</option>
                </select>
            </div>
        </div>

        <div id="qrisDetail" style="display:none;">
            <div class="form-group row">
                <label for="nomor_qris" class="col-sm-4 col-form-label">Nomor QRIS</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="nomor_qris" id="nomor_qris">
                    <div id="qrisCodeContainer"></div>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-8 offset-sm-4">
                <button type="submit" class="btn btn-primary">Proses Pembayaran</button>
            </div>
        </div>

    </form>

    <script>
        document.getElementById('metode_pembayaran').addEventListener('change', function() {
            var qrisDetail = document.getElementById('qrisDetail');
            if (this.value === 'qris') {
                qrisDetail.style.display = 'block';
                generateQrCode();
            } else {
                qrisDetail.style.display = 'none';
            }
        });

        function generateQrCode() {
            var nomorQris = document.getElementById('nomor_qris').value;
            var qrisCodeContainer = document.getElementById('qrisCodeContainer');

            // Hapus QR Code sebelumnya jika ada
            qrisCodeContainer.innerHTML = '';

            // Buat instance QR Code generator
            var qr = new QRious({
                value: nomorQris,
                size: 200
            });

            // Tambahkan gambar QR Code ke dalam container
            var qrImage = document.createElement('img');
            qrImage.src = qr.toDataURL();
            qrCodeContainer.appendChild(qrImage);
        }
    </script>

</body>

</html>