<?php
include 'db_config.php';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id > 0) {
    mysqli_query($conn, "DELETE FROM data_kalibrasi WHERE id='$id'"); // ignore result
}
header('Location: index.php');
exit;
?>
