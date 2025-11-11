<?php
include 'db_config.php';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) { header('Location: index.php'); exit; }

//menambahkan validasi dan sanitasi input
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
        $sql = "UPDATE data_kalibrasi SET
                 nama_alat='$nama', merk='$merk', model='$model', nomor_seri='$nomor',
                 tanggal_kalibrasi='$tgl', teknisi='$teknisi', hasil='$hasil', keterangan='$keterangan'
                 WHERE id='$id'";
        if (mysqli_query($conn, $sql)) {
            header('Location: index.php');
            exit;
        } else {
            $errors[] = 'Gagal memperbarui: ' . mysqli_error($conn);
        }
    }
}

$res = mysqli_query($conn, "SELECT * FROM data_kalibrasi WHERE id='$id'");
if (!$res || mysqli_num_rows($res) == 0) { header('Location: index.php'); exit; }
$row = mysqli_fetch_assoc($res);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Edit Data Kalibrasi</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header><h1>Edit Data Kalibrasi</h1></header>
<div class="container">
  <a href="index.php" class="btn btn-secondary" style="margin-bottom:12px;">← Kembali</a>
  <?php if (!empty($errors)): ?>
    <div class="alert alert-error"><?php foreach($errors as $e) echo htmlspecialchars($e) . '<br>'; ?></div>
  <?php endif; ?>

  <form method="post" action="">
    <label>Nama Alat</label>
    <input type="text" name="nama_alat" required value="<?php echo htmlspecialchars($row['nama_alat']); ?>">

    <label>Merk</label>
    <input type="text" name="merk" value="<?php echo htmlspecialchars($row['merk']); ?>">

    <label>Model</label>
    <input type="text" name="model" value="<?php echo htmlspecialchars($row['model']); ?>">

    <label>Nomor Seri</label>
    <input type="text" name="nomor_seri" value="<?php echo htmlspecialchars($row['nomor_seri']); ?>">

    <label>Tanggal Kalibrasi</label>
    <input type="date" name="tanggal_kalibrasi" value="<?php echo htmlspecialchars($row['tanggal_kalibrasi']); ?>">

    <label>Teknisi</label>
    <input type="text" name="teknisi" value="<?php echo htmlspecialchars($row['teknisi']); ?>">

    <label>Hasil</label>
    <select name="hasil">
      <option value="Lulus" <?php echo ($row['hasil']=='Lulus')?'selected':''; ?>>Lulus</option>
      <option value="Tidak Lulus" <?php echo ($row['hasil']=='Tidak Lulus')?'selected':''; ?>>Tidak Lulus</option>
    </select>

    <label>Keterangan</label>
    <textarea name="keterangan" rows="4"><?php echo htmlspecialchars($row['keterangan']); ?></textarea>

    <div style="display:flex; gap:8px; margin-top:8px;">
      <button type="submit" class="btn btn-primary">Perbarui</button>
      <a href="index.php" class="btn btn-secondary">Batal</a>
    </div>
  </form>
</div>
<footer>© <?= date('Y'); ?> Sistem Kalibrasi Alat</footer>
</body>
</html>
