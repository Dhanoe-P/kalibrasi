<?php
include 'db_config.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Data Kalibrasi</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header><h1>Sistem Kalibrasi Alat</h1></header>
<div class="container">
  <div class="page-title">
    <h2>Daftar Data Kalibrasi</h2>
    <div>
      <a href="tambah.php" class="btn btn-primary">+ Tambah Data</a>
      <a href="index.php" class="btn btn-secondary">Refresh</a>
    </div>
  </div>

  <div class="table-wrapper">
    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Alat</th>
          <th>Merk</th>
          <th>Model</th>
          <th>No. Seri</th>
          <th>Tgl Kalibrasi</th>
          <th>Teknisi</th>
          <th>Hasil</th>
          <th>Keterangan</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
<?php
$q = mysqli_query($conn, "SELECT * FROM data_kalibrasi ORDER BY id DESC");
if (!$q) {
    echo '<tr><td colspan="10">Error: '.htmlspecialchars(mysqli_error($conn)).'</td></tr>';
} else {
    if (mysqli_num_rows($q) == 0) {
        echo '<tr><td colspan="10">Belum ada data.</td></tr>';
    } else {
        $no = 1;
        while ($r = mysqli_fetch_assoc($q)) {
            echo '<tr>';
            echo '<td>'.($no++).'</td>';
            echo '<td>'.htmlspecialchars($r['nama_alat']).'</td>';
            echo '<td>'.htmlspecialchars($r['merk']).'</td>';
            echo '<td>'.htmlspecialchars($r['model']).'</td>';
            echo '<td>'.htmlspecialchars($r['nomor_seri']).'</td>';
            echo '<td>'.htmlspecialchars($r['tanggal_kalibrasi']).'</td>';
            echo '<td>'.htmlspecialchars($r['teknisi']).'</td>';
            echo '<td>'.htmlspecialchars($r['hasil']).'</td>';
            echo '<td>'.nl2br(htmlspecialchars($r['keterangan'])).'</td>';
            echo '<td class="actions">
                    <a class="btn btn-warning" href="edit.php?id='. $r['id'] .'">Edit</a>
                    <a class="btn btn-danger" href="hapus.php?id='. $r['id'] .'" onclick="return confirm(\'Hapus data ini?\')">Hapus</a>
                  </td>';
            echo '</tr>';
        }
    }
}
?>
      </tbody>
    </table>
  </div>
</div>
<footer>© <?= date('Y'); ?> Sistem Kalibrasi Alat</footer>
</body>
</html>
