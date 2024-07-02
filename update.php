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

    $sql = "UPDATE penjualan SET Nama_Barang='$Nama_Barang', Persediaan='$Persediaan', Harga='$Harga', Jumlah='$Jumlah' WHERE Kode_Barang='$Kode_Barang'";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    if (isset($_GET['Kode_Barang'])) {
        $Kode_Barang = $_GET['Kode_Barang'];
        $sql = "SELECT * FROM penjualan WHERE Kode_Barang='$Kode_Barang'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $Nama_Barang = $row["Nama_Barang"];
            $Persediaan = $row["Persediaan"];
            $Harga = $row["Harga"];
            $Jumlah = $row["Jumlah"];
        } else {
            echo "Data tidak ditemukan!";
            exit();
        }
    } else {
        echo "Kode Barang tidak ditemukan!";
        exit();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data Penjualan</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Update Data Penjualan</h2>
        <form method="post" action="">
            <input type="hidden" name="Kode_Barang" value="<?php echo $Kode_Barang; ?>">
            <div class="form-group">
                <label for="Nama_Barang">Nama Barang:</label>
                <input type="text" class="form-control" id="Nama_Barang" name="Nama_Barang" value="<?php echo $Nama_Barang; ?>" required>
            </div>
            <div class="form-group">
                <label for="Persediaan">Persediaan:</label>
                <input type="number" class="form-control" id="Persediaan" name="Persediaan" value="<?php echo $Persediaan; ?>" required>
            </div>
            <div class="form-group">
                <label for="Harga">Harga:</label>
                <input type="number" class="form-control" id="Harga" name="Harga" value="<?php echo $Harga; ?>" required>
            </div>
            <div class="form-group">
                <label for="Jumlah">Jumlah:</label>
                <input type="number" class="form-control" id="Jumlah" name="Jumlah" value="<?php echo $Jumlah; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>
