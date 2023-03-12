<?php

require "../pertemuan10/functions.php";
$mahasiswa = query("SELECT * FROM mahasiswa");

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <style>

  .header-text {
    text-align: center;
    position: relative;
    top: 60px;
  }

  .container {
  display: flex;
  justify-content: center;
  margin: 80px 0 ;
}

table {
  border-collapse: collapse;
  width: 50%;
}

th, td {
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

th {
  background-color: #4CAF50;
  color: white;
}

  </style>
  <div class="header-text">

    <h2>Daftar Mahasiswa</h2>
    <a href="tambah.php">Tambah Mahasiswa</a>
    <br><br>
  </div>

  <div class="container">
  <table border="1" cellpadding="10" cellspacing="0">
    <tr>
      <th>#</th>
      <th>Gambar</th>
      <th>Nama</th>
      <th>Detail</th>
      <th>Aksi</th>
      
    </tr>
    <?php $i = 1;
foreach ($mahasiswa as $m): ?>
    <tr>
      <td><?=$i++?></td>
      <td> <img src="img/<?=$m['gambar']?>" width="60"></td>
      <td><?=$m['nama']?></td>
      <td>

        <a href="detail.php?id=<?= $m['id'] ?>">Lihat Detail</a>
      </td>
      <td>
        <a href="ubah.php?id=<?= $m['id'] ?>" onclick="return confirm('APAKAH YAKIN MENGUBAH DATA?')">Ubah</a>
        <a href="hapus.php?id=<?= $m['id'] ?>" onclick="return confirm('APAKAH ANDA YAKIN MAU HAPUS?')">Hapus</a>
      </td>
      
    </tr>
    <?php endforeach; ?>
  </table>
  </div>
</body>

</html>