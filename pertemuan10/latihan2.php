<?php

// Koneksi Ke DataBase

// Ambil query Data Dari DataBase
$result = mysqli_query($conn, "SELECT * FROM mahasiswa");

// ubah data ke array lalu di looping
$rows = [];
while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
}

// tampung ke variabel mahasiswa
$mahasiswa = $rows;

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
  <h3>Daftar Mahasiswa</h3>

  <table border="1" cellpadding="10" cellspacing="0">
    <tr>
      <th>#</th>
      <th>Gambar</th>
      <th>Nama</th>
      <th>Nim</th>
      <th>Email</th>
      <th>Jurusan</th>
      <th>Aksi</th>
    </tr>
    <?php $i = 1;
foreach ($mahasiswa as $m): ?>
    <tr>
      <td><?=$i++?></td>
      <td> <img src="img/<?=$m['gambar']?>" width="60"></td>
      <td><?=$m['nama']?></td>
      <td><?=$m['nim']?></td>
      <td><?=$m['email']?></td>
      <td><?=$m['jurusan']?></td>
      <td>
        <a href="#">Ubah</a>
        <a href="#">Hapus</a>
      </td>
    </tr>
    <?php endforeach;?>
  </table>
</body>

</html>