<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dagang";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Kode_Barang = $_POST["Kode_Barang"];
    $Nama_Barang = $_POST["Nama_Barang"];
    $Persediaan = $_POST["Persediaan"];
    $Harga = $_POST["Harga"];
    $Jumlah = $_POST["Jumlah"];

    $sql = "INSERT INTO penjualan (Kode_Barang, Nama_Barang, Persediaan, Harga, Jumlah) VALUES ('$Kode_Barang', '$Nama_Barang', '$Persediaan', '$Harga', '$Jumlah')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Penjualan</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #43e97b, #38f9d7); /* Gradient warna hijau dan biru */
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Tambah Data Penjualan</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="Kode_Barang">Kode Barang:</label>
                <input type="text" class="form-control" id="Kode_Barang" name="Kode_Barang" required>
            </div>
            <div class="form-group">
                <label for="Nama_Barang">Nama Barang:</label>
                <input type="text" class="form-control" id="Nama_Barang" name="Nama_Barang" required>
            </div>
            <div class="form-group">
                <label for="Persediaan">Persediaan:</label>
                <input type="number" class="form-control" id="Persediaan" name="Persediaan" required>
            </div>
            <div class="form-group">
                <label for="Harga">Harga:</label>
                <input type="number" class="form-control" id="Harga" name="Harga" required>
            </div>
            <div class="form-group">
                <label for="Jumlah">Jumlah:</label>
                <input type="text" class="form-control" id="Jumlah" name="Jumlah" readonly>
            </div>
            <div class="form-group">
                <label for="Total">Total Harga:</label>
                <input type="text" class="form-control" id="TotalHarga" name="TotalHarga" readonly>
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>

    <script>
        // Ambil elemen input yang diperlukan
        const persediaanInput = document.getElementById('Persediaan');
        const hargaInput = document.getElementById('Harga');
        const jumlahInput = document.getElementById('Jumlah');
        const totalHargaInput = document.getElementById('TotalHarga');

        // Tambahkan event listener untuk menghitung total harga saat input berubah
        persediaanInput.addEventListener('input', updateTotalHarga);
        hargaInput.addEventListener('input', updateTotalHarga);

        function updateTotalHarga() {
            const persediaan = parseFloat(persediaanInput.value) || 0;
            const harga = parseFloat(hargaInput.value) || 0;
            const totalHarga = persediaan * harga;

            jumlahInput.value = totalHarga.toFixed(2); // Tampilkan total harga pada input Jumlah dengan 2 angka di belakang koma
            totalHargaInput.value = totalHarga.toFixed(2); // Tampilkan total harga dengan 2 angka di belakang koma
        }
    </script>
</body>
</html>
