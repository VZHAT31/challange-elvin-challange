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
    
    $sql = "DELETE FROM penjualan WHERE Kode_Barang='$Kode_Barang'";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
