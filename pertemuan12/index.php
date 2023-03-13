<?php
session_start();

// membuat logika login jika dia belum login maka kembalikan ke halaman login
if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

require "functions.php";
$mahasiswa = query("SELECT * FROM mahasiswa");

// jika tombol cari udah ditekan
if (isset($_POST['cari'])){
  $mahasiswa = cari($_POST['keyword']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mahasiswa</title>
</head>

<body>
  <style>

  .header-text {
    text-align: center;
    position: relative;
    top: 60px;
  }

  .tombolCari {
    position: relative;
    left: 10px;
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

.logoutBtn {
  display: flex;
  justify-content: center;
  align-items: center;
  
  position: relative;
  bottom: 400px;
  
}

.logoutbtn {
  background-color: red;
  text-align: center;
  width: 5%;
  padding: 10px;
  text-decoration: none;
  color: white;
  border-radius: 10px;
}

.logoutbtn:hover {
  background-color: darkred;
}

  </style>
  <div class="header-text">

    <h2>Daftar Mahasiswa</h2>
    <a href="tambah.php">Tambah Mahasiswa</a>
    <br><br>
    <form action="" method="post" class="tombolCari">
      <input type="text" name="keyword" autocomplete="off" autofocus>
      <button type="submit" name="cari">Cari!</button>
    </form>
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
    <?php if(empty($mahasiswa)) : ?>
    <tr>
      <td colspan="5"><p style="color: red; text-align: center;">Data Tidak Ditemukan</p></td>
    </tr>
    <?php endif; ?>


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
  <div class="logoutBtn">
    <a href="logout.php" class="logoutbtn">Logout</a>
  </div>
</body>

</html>