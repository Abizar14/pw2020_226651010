<?php

function koneksi()
{
  return mysqli_connect("localhost", "root", "", "tim_226651010");
}

function query ($query) {
  $conn = koneksi();
  
  $result = mysqli_query($conn, $query);

  if(mysqli_num_rows($result) == 1){
    return mysqli_fetch_assoc($result);
  }
  
  $rows = [];
  while($row = mysqli_fetch_assoc($result)){
    $rows[] = $row;
  }

  return $rows;
}

function upload() {
  $nama_file = $_FILES['gambar']['name'];
  $tipe_file = $_FILES['gambar']['type'];
  $ukuran_file = $_FILES['gambar']['size'];
  $error = $_FILES['gambar']['error'];
  $tmp_file = $_FILES['gambar']['tmp_name'];

  if ($error == 4) {
    return 'default.png';
  }

  // bikin ekstensi file
  $daftar_gambar = ['jpg', 'jpeg', 'pdf'];
  $ekstensi_file = explode('.', $nama_file);
  $ekstensi_file = strtolower(end($ekstensi_file));

  if(!in_array($ekstensi_file, $daftar_gambar)) {
    echo "<script>
    
        alert('yang anda pilih bukan gambar!')
    
    </script>";
    return false;
  }

  // cek type file 
  if($tipe_file == 'image/jpeg' && $tipe_file == 'image/png') {
    echo "<script>
    
        alert('yang anda asdasdpilih bukan gambar!')
    
    </script>";
    return false;
  }

  // cek ukuran gambar
  if($ukuran_file > 5000000) {
    echo "<script>
    
        alert('ukuran gambar terlalu besar!')
    
    </script>";
    return false;
  }

  // lolos pengecekan
  // siap uplod file
  // generate nama baru
  $nama_file_baru = uniqid();
  $nama_file_baru .= '.';
  $nama_file_baru .= $ekstensi_file;
  var_dump($nama_file_baru);

  move_uploaded_file($tmp_file, 'img/' . $nama_file);

  return $nama_file_baru;
}

function tambah($data) {
  $nama = htmlspecialchars($data['nama']);
  $nim = htmlspecialchars($data['nim']);
  $email = htmlspecialchars($data['email']);
  $jurusan = htmlspecialchars($data['jurusan']);
  // $gambar = htmlspecialchars($data['gambar']);

  $gambar = upload();
  if (!$gambar) {
    return false;
  }

  $conn = koneksi();
  $query = "INSERT INTO mahasiswa VALUES(null, '$nama', '$nim', '$email', '$jurusan', '$gambar')" or die(mysqli_error($conn));
  
  mysqli_query($conn, $query);
  echo mysqli_error($conn);
  return mysqli_affected_rows($conn);


}



function hapus($id) {
  $conn = koneksi();

  // mengahapus gambar difolder img
  $mhs = query("SELECT * FROM mahasiswa WHERE id = $id");
  if($gambar != 'default.png'){
    unlink('img/' . $mhs['gambar']);
  }


  mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = '$id'") or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}

function ubah($data) {
  $id = $data['id'];
  $nama = htmlspecialchars($data['nama']);
  $nim = htmlspecialchars($data['nim']);
  $email = htmlspecialchars($data['email']);
  $jurusan = htmlspecialchars($data['jurusan']);
  $gambar_lama = htmlspecialchars($data['gambar_lama']);

  $gambar = upload();
  if(!$gambar) {
    return false;
  }

  if($gambar == default.png) {
    $gambar = $gambar_lama;
  }

  $conn = koneksi();
  $query = "UPDATE mahasiswa SET 
           nama = '$nama',
           nim = '$nim',
           email = '$email',
           jurusan = '$jurusan',
           gambar = '$gambar' 
           WHERE id = $id ";
  
  mysqli_query($conn, $query);
  echo mysqli_error($conn);
  return mysqli_affected_rows($conn);


}

function cari($keyword) {
  $conn = koneksi();

  $query = "SELECT * FROM mahasiswa
            WHERE nama LIKE '%$keyword%' OR
            nim LIKE '%$keyword%'";
  $result = mysqli_query($conn, $query);


$rows = [];
while($row = mysqli_fetch_assoc($result)){
  $rows[] = $row;
}

return $rows;
}

function login($data) {
  $conn = koneksi();

  $username = htmlspecialchars($data['username']);
  $password = htmlspecialchars($data['password']);

  // login berhasil

  // cek username terlebih dahulu
  if ($user = query("SELECT * FROM user WHERE username = '$username'")) {
    
    // cek password 
    if (password_verify($password, $user['password'])) {

      // set session
      $_SESSION['login'] = true;
  
      header("Location: index.php");
      exit;
    }
    
  }
    return [
      'error' => true,
      'pesan' => 'Username / Password Salah'
    ];
}

function register($data) {
  $conn = koneksi();

  $username = htmlspecialchars(strtolower($data['username']));
  $password1 = mysqli_real_escape_string($conn, $data['password1']);
  $password2 = mysqli_real_escape_string($conn, $data['password2']);

  if(empty($username) || empty($password1) || empty($password2)) {
    echo "<script>
        alert('username / password tidak boleh kosong');
        document.location.href = register.php;
    
    </script>";
    return false;
  }


  // cek jika username sudah ada
  if (query("SELECT * FROM user WHERE username = '$username' ")) {
    echo "<script>
          alert('Username Telah Terpakai!');
          document.location.href = register.php;
    
    </script>";
    return false;
  }

  // cek jika konfirmasi password beda
  if ($password1 != $password2) {
    echo "<script> 
    alert('Konfirmasi Password Salah, Harap Memasukan Password Yang Sama'); 
    document.location.href = register.php;
    </script>";
    return false;
  }

  // jika password < 5 digit
  if (strlen($password1) < 5) {
    echo '<script>
    
      alert("Password Ini Terlalu Pendek");
      document.location.href = register.php;
    
    </script>';
    return false;
  }

  // jika username dan password sudah sesuai
  // buat enkripsi key
  $password_baru = password_hash($password1, PASSWORD_DEFAULT);
  // insert ke data user
  $query = "INSERT INTO user VALUES(null, '$username', '$password_baru')";

  mysqli_query($conn, $query) or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}

?>