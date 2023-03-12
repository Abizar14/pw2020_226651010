<?php 

require "../pertemuan10/functions.php";

// ambil id dari URL
$id = $_GET['id'];

// query berdasarkan id
$m = query("SELECT * FROM mahasiswa WHERE id = $id");
var_dump($m);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Mahasiswa</title>
</head>
<body>

<h3>Daftar Mahasiswa</h3>

<ul>
  <li><img src="#" alt=""></li>
  <li>Nama : <?= $m['nama'] ?></li>
  <li>NIM : <?= $m['nim'] ?></li>
  <li>Email : <?= $m['email'] ?> </li>
  <li>Jurusan : <?= $m['jurusan'] ?> </li>
  <li>
    <a href="">ubah</a>
    <a href="">hapus</a>
  </li>
  <li><a href="index.php">Kembali Ke daftar mahasiswa</a></li>
</ul>
  
</body>
</html>