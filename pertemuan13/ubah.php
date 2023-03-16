<?php 

session_start();
// membuat logika login jika dia belum login maka kembalikan ke halaman login
if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

require "functions.php";

// jika id tidak ada 
if (!isset($_GET['id'])) {
  header("Location: index.php");
  exit;
}

// ambil id dari url 
$id = $_GET['id'];

// query mahasiswa 
$m = query("SELECT * FROM mahasiswa WHERE id = '$id'");

// cek apakah tombol sudah ditekan apa belum
if(isset($_POST['ubah'])) {
  if (ubah($_POST)) {
    echo '<script>
    
    alert("data berhasil diubah");
    document.location.href = "index.php";
    
    </script>';
  } else {
    echo 'data gagal ditambahkan';
  }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ubah Data Mahasiswa</title>
</head>
<body>
  <style>

    h2 {
      text-align: center;
      top: 30px;
      position: relative;
    }

    form {
  display: flex;
  flex-direction: column;
  max-width: 600px;
  margin: 100px auto;
  padding: 20px;
  border: 1px solid #ddd;
  border-radius: 5px;
}

label {
  font-weight: bold;
  margin-bottom: 5px;
}

input,
textarea {
  padding: 10px;
  margin-bottom: 20px;
  border: 1px solid #ddd;
  border-radius: 5px;
  font-size: 16px;
}

textarea {
  height: 150px;
}

button {
  padding: 10px;
  border: none;
  border-radius: 5px;
  background-color: #007bff;
  color: #fff;
  font-size: 16px;
  cursor: pointer;
}

button:hover {
  background-color: #0062cc;
}
  </style>
  <h2>Ubah Data Mahasiswa</h2>
  <form action="" method="post" enctype="multipart/form-data" >
  <input type="hidden" name="id" value="<?= $m['id'] ?>">
  <label for="nama">Nama  :</label>
  <input type="text" id="nama" name="nama" autofocus required value="<?= $m['nama'] ?>">

  <label for="nim">NIM   :</label>
  <input type="text" id="nim" name="nim" required value="<?= $m['nim'] ?>">
  
  <label for="email">Email :</label>
  <input type="email" id="email" name="email" required value="<?= $m['email'] ?>">

  <label for="jurusan">Jurusan :</label>
  <input type="text" id="jurusan" name="jurusan" required value="<?= $m['jurusan'] ?>">
  
  <input type="hidden" name="gambar_lama" value="<?= $m['gambar'] ?>">
  <label for="gambar">Gambar :</label>
  <input type="file" id="gambar" name="gambar" class="gambar" onchange="previewImage()">
  <img src="img/<?= $m['gambar'] ?>" alt="" width="120px" style="display: block;" class="img-preview">

  <button type="submit" name="ubah">Kirim</button>
  </form>

  <script src="js/script.js"></script>
</body>
</html>
