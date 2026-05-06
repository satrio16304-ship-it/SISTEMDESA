<?php
require '../config/koneksi.php';
require '../vendor/autoload.php';

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Desa.xls");

echo "Laporan Kependudukan Desa\n\n";

$data = mysqli_query($conn, "SELECT * FROM penduduk");

while($d = mysqli_fetch_assoc($data)){
    echo $d['nama']."\t".$d['nik']."\n";
}
?>