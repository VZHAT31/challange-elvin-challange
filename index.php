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

$sql = "SELECT Kode_Barang, Nama_Barang, Persediaan, Harga, Jumlah FROM penjualan";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjualan</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    /* CSS yang sudah ada */
    body {
        background: linear-gradient(135deg, #ff7e5f, #feb47b);
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
    h2 {
        text-align: center;
        position: relative; /* Untuk animasi relatif pada elemen ini */
    }
    
    /* Animasi lampu */
    @keyframes disco {
        0% {
            color: #ff00ff; /* Warna pertama */
        }
        25% {
            color: #00ff00; /* Warna kedua */
        }
        50% {
            color: #0000ff; /* Warna ketiga */
        }
        75% {
            color: #ffff00; /* Warna keempat */
        }
        100% {
            color: #ff00ff; /* Kembali ke warna pertama */
        }
    }
    
    /* Terapkan animasi ke h2 */
    h2 {
        animation: disco 2s infinite; /* Animasi berjalan selama 2 detik dan berulang tanpa henti */
    }
</style>
    <script>
        function confirmDelete() {
            return confirm('Apakah Anda yakin ingin menghapus data ini?');
        }
    </script>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Data Penjualan</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Persediaan</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1; // Inisialisasi nomor urut
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $no . "</td>
                                <td>" . $row["Kode_Barang"]. "</td>
                                <td>" . $row["Nama_Barang"]. "</td>
                                <td>" . $row["Persediaan"]. "</td>
                                <td>Rp " . number_format($row["Harga"], 0, ',', '.') . "</td>
                                <td>Rp " . number_format($row["Jumlah"], 0, ',', '.') . "</td>
                                <td>
                                    <a href='update.php?Kode_Barang=" . $row["Kode_Barang"] . "' class='btn btn-warning btn-sm'>Update</a>
                                    <form method='post' action='delete.php' style='display:inline;' onsubmit='return confirmDelete()'>
                                        <input type='hidden' name='Kode_Barang' value='" . $row["Kode_Barang"] . "'>
                                        <button type='submit' class='btn btn-danger btn-sm'>Hapus</button>
                                    </form>
                                </td>
                              </tr>";
                        $no++; // Increment nomor urut
                    }
                } else {
                    echo "<tr><td colspan='7'>Tidak ada data</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="create.php" class="btn btn-primary mt-4">Tambah Data</a>
    </div>
</body>
</html>

<?php
$conn->close();
?>