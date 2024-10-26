<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nerko+One&family=Permanent+Marker&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Pendaftaran Sembayangan OMK</title>
    <style>
        .form-group {
            font-family: Rubik;
            font-weight: 500;
            font-size: 0.9rem; /* font lebih kecil */
        }

        li {
            font-size: 1rem;
        }
    </style>
</head>

<body class="bg-gray-100 flex items-center">
    <div class="container mx-auto p-4 sm:p-8 bg-white rounded-lg max-w-lg sm:max-w-3xl">
        <div class="form-group bg-blue-500 text-white rounded-xl border-2 mb-6 p-4 sm:p-8">
            <h2 class="text-xl sm:text-2xl font-semibold mb-2 text-center">
                Form Pendaftaran Sembayangan OMK
            </h2>
            <hr class="my-2 sm:my-3">
            <h3 class="text-center text-white-700 text-sm sm:text-base mt-2 sm:mt-3">
                "Bersinar di Dunia: Menjadi Terang Kristus bagi Sesama"
            </h3>
        </div>
        <form id="pendaftaranForm" method="POST" class="space-y-4 sm:space-y-6">
            <div class="form-group rounded-xl border-2 mb-4 sm:mb-6 shadow-xl p-4 sm:p-8">
                <label for="nama" class="block text-gray-700 font-medium mb-1 text-sm sm:text-base">Nama Lengkap:</label>
                <input type="text" class="form-control w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring focus:border-blue-300 text-sm sm:text-base" id="nama" name="nama" placeholder="Masukkan nama di sini..." required>
            </div>
            <div class="form-group rounded-xl border-2 mb-4 sm:mb-6 shadow-xl p-4 sm:p-8">
                <label for="stasi" class="block text-gray-700 font-medium mb-1 text-sm sm:text-base">Asal Stasi:</label>
                <select name="stasi" id="stasi" class="form-select w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring focus:border-blue-300 text-sm sm:text-base" required>
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
            <div class="form-group rounded-xl border-2 mb-4 sm:mb-6 shadow-xl p-4 sm:p-8">
                <label class="block text-gray-700 font-medium mb-1 text-sm sm:text-base" for="pesan">Pesan:</label>
                <textarea class="form-control w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring focus:border-blue-300 text-sm sm:text-base" name="pesan" id="pesan" rows="3" placeholder="Apakah kamu mempunyai pesan yang ingin disampaikan untuk acara ini?"></textarea>
            </div>
            <div class="form-group rounded-xl border-2 mb-4 sm:mb-6 shadow-xl p-4 sm:p-8">
                <h4 class="text-gray-800 font-semibold text-sm sm:text-base">*Reminder Note</h4>
                <small>
                    <ul class="list-disc pl-5 text-gray-600 space-y-1">
                        <li>Tumbler</li>
                        <li>Pakaian ganti (Outbound)</li>
                        <li>Obat - obatan pribadi</li>
                        <li>Alat mandi</li>
                    </ul>
                </small>
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300 text-sm sm:text-base">Kirim</button>
        </form>
        
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            header('Content-Type: application/json'); // Menetapkan header JSON
            
            $nama = $_POST['nama'];
            $stasi = $_POST['stasi'];
            $pesan = $_POST['pesan'];

            // URL Google Apps Script
            $url = "https://script.google.com/macros/s/AKfycbzDxXxcbEoYyBj6dmWpPkSZgGM9BmapWaOEWThw3pvDqKRlxiz11uFVAFjigzgTMIQKYA/exec";

            $data = [
                'nama' => $nama,
                'stasi' => $stasi,
                'pesan' => $pesan,
            ];

            // Inisialisasi CURL
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

            $response = curl_exec($ch);
            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($http_code === 200 && $response) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Data berhasil dikirim!'
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Data gagal dikirim! Kode status: '
                ]);
            }
        }
?>
    <div class="footer">
        <p class="mt-10 text-center text-gray-400 text-sm sm:text-base">Copyright &copy; 2023 OMK Santo Martinus. All rights reserved.</p>
    </div>
    </div>

    <script>
        const form = document.getElementById('pendaftaranForm');
        form.addEventListener('submit', (event) => {
            event.preventDefault(); // Mencegah pengiriman form secara default

            // Tampilkan loading alert
            Swal.fire({
                title: 'Sedang diproses...',
                text: 'Mohon tunggu sebentar.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Kirim data ke server setelah loading tampil
            const formData = new FormData(form);
            fetch('', { // Kirim ke halaman yang sama
                method: 'POST',
                body: formData
            })
            .then(response => response.json()) // Mengharapkan respons dalam format JSON
            .then(data => {
                Swal.close(); // Menutup alert loading

                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: data.message, // Menampilkan pesan dari respons
                        confirmButtonText: 'OK'
                    }).then(() => {
                        form.reset(); // Reset form setelah sukses
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: data.message, // Menampilkan pesan dari respons yang lebih terperinci
                        confirmButtonText: 'Coba Lagi'
                    });
                }
            })
            .catch(error => {
                console.error('Error!', error);
                Swal.close(); // Menutup alert loading
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data berhasil dikiri!',
                    confirmButtonText: 'Oke'
                });
            });
        });
    </script>



</body>

</html>
