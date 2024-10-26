<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- Link SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f2f5f9;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .container {
            width: 100%;
            max-width: 600px;
            padding: 0 20px;
            margin: 0 auto;
        }
        .card {
            padding: 30px;
            border: none;
            border-radius: 12px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.15);
            background-color: #ffffff;
        }
        .form-label {
            font-weight: 600;
            color: #333;
        }
        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #ced4da;
            box-shadow: inset 0px 1px 2px rgba(0, 0, 0, 0.1);
        }
        .form-control:focus, .form-select:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
        button[type="submit"] {
            font-weight: 600;
            border-radius: 8px;
            padding: 10px;
            width: 100%;
            background-color: #007bff;
            border: none;
            color: white;
            transition: background-color 0.3s ease;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h2 class="text-center mb-4">Form Pendaftaran Sembayangan</h2>
            <form id="pendaftaranForm" action="" method="post">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama:</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama lengkap" required>
                </div>

                <div class="mb-3">
                    <label for="stasi" class="form-label">Stasi:</label>
                    <select name="stasi" id="stasi" class="form-select" required>
                        <option value="" disabled selected>Pilih Stasi</option>
                        <option value="Jojog">Jojog</option>
                        <option value="Tulusrejo">Tulusrejo</option>
                        <option value="Batanghari">Batanghari</option>
                        <option value="Balekencono">Balekencono</option>
                        <option value="Selorejo">Selorejo</option>
                        <option value="Sambikarto">Sambikarto</option>
                        <option value="Glagah">Glagah</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Daftar</button>
            </form>
        </div>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama = $_POST['nama'];
        $stasi = $_POST['stasi'];

        // URL Google Apps Script
        $url = "https://script.google.com/macros/s/AKfycbzabHmuZ27cKL3kZg_KaALA99nhIEArzrT8g1EanGtwXqgfrIzCUp72xI9huTutTpji1A/exec";

        // Data yang akan dikirim
        $data = [
            'nama' => $nama,
            'stasi' => $stasi
        ];

        // Inisialisasi CURL
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

        // Eksekusi dan cek hasilnya
        $response = curl_exec($ch);
        curl_close($ch);

        // Notifikasi SweetAlert
        echo "<script>
            document.getElementById('pendaftaranForm').addEventListener('submit', function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Mengirim data...',
                    html: 'Harap tunggu',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            });
        </script>";
        if ($response) {
            echo "<script>
                    Swal.close();
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Data berhasil dikirim!',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        document.getElementById('pendaftaranForm').reset();
                    });
                </script>";
        } else {
            echo "<script>
                    Swal.close();
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Data gagal dikirim!',
                        confirmButtonText: 'Coba Lagi'
                    });
                </script>";
        }
    }
    ?>

    <!-- Link Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
