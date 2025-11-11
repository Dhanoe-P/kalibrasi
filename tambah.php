<?php
include 'db_config.php';
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($conn, trim($_POST['nama_alat']));
    $merk = mysqli_real_escape_string($conn, trim($_POST['merk']));
    $model = mysqli_real_escape_string($conn, trim($_POST['model']));
    $nomor = mysqli_real_escape_string($conn, trim($_POST['nomor_seri']));
    $tgl = mysqli_real_escape_string($conn, trim($_POST['tanggal_kalibrasi']));
    $teknisi = mysqli_real_escape_string($conn, trim($_POST['teknisi']));
    $hasil = mysqli_real_escape_string($conn, trim($_POST['hasil']));
    $keterangan = mysqli_real_escape_string($conn, trim($_POST['keterangan']));

    if ($nama === '') $errors[] = 'Nama alat wajib diisi.';

    if (empty($errors)) {
        $sql = "INSERT INTO data_kalibrasi (nama_alat, merk, model, nomor_seri, tanggal_kalibrasi, teknisi, hasil, keterangan)
                VALUES ('$nama', '$merk', '$model', '$nomor', '$tgl', '$teknisi', '$hasil', '$keterangan')";
        if (mysqli_query($conn, $sql)) {
            header('Location: index.php');
            exit;
        } else {
            $errors[] = 'Gagal menyimpan: ' . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Tambah Data Kalibrasi</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
  <h2>Tambah Data Kalibrasi</h2>
  <form method="POST" action="">
    <label>Nama Alat</label>
    <input type="text" name="nama_alat" required>

    <label>Merk</label>
    <input type="text" name="merk">

    <label>Model</label>
    <input type="text" name="model">

    <label>Nomor Seri</label>
    <input type="text" name="nomor_seri">

    <label>Tanggal Kalibrasi</label>
    <input type="date" name="tanggal_kalibrasi">

    <label>Teknisi</label>
    <input type="text" name="teknisi">

    <label>Hasil</label>
    <select name="hasil" required>
      <option value="">-- Pilih --</option>
      <option value="Lulus">Lulus</option>
      <option value="Tidak Lulus">Tidak Lulus</option>
    </select>

    <label>Keterangan</label>
    <textarea name="keterangan" rows="3"></textarea>

    <button type="submit" name="submit">Simpan</button>
    <a href="index.php" class="btn-back">Kembali</a>
  </form>
</div>

<?php
if (isset($_POST['submit'])) {
  $nama_alat = $_POST['nama_alat'];
  $merk = $_POST['merk'];
  $model = $_POST['model'];
  $nomor_seri = $_POST['nomor_seri'];
  $tanggal_kalibrasi = $_POST['tanggal_kalibrasi'];
  $teknisi = $_POST['teknisi'];
  $hasil = $_POST['hasil'];
  $keterangan = $_POST['keterangan'];

  // validasi sederhana (cek wajib isi)
  if ($nama_alat == "" || $hasil == "") {
    echo "<p style='color:red;'>Harap isi semua data wajib!</p>";
  } else {
    $query = "INSERT INTO data_kalibrasi 
              (nama_alat, merk, model, nomor_seri, tanggal_kalibrasi, teknisi, hasil, keterangan)
              VALUES ('$nama_alat', '$merk', '$model', '$nomor_seri', '$tanggal_kalibrasi', '$teknisi', '$hasil', '$keterangan')";
    if (mysqli_query($conn, $query)) {
      echo "<script>alert('Data berhasil disimpan!'); window.location='index.php';</script>";
    } else {
      echo "<p style='color:red;'>Error: " . mysqli_error($conn) . "</p>";
    }
  }
}
?>
</body>
</html>