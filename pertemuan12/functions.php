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

function tambah($data) {
  $nama = htmlspecialchars($data['nama']);
  $nim = htmlspecialchars($data['nim']);
  $email = htmlspecialchars($data['email']);
  $jurusan = htmlspecialchars($data['jurusan']);
  $gambar = htmlspecialchars($data['gambar']);

  $conn = koneksi();
  $query = "INSERT INTO mahasiswa VALUES(null, '$nama', '$nim', '$email', '$jurusan', '$gambar')" or die(mysqli_error($conn));
  
  mysqli_query($conn, $query);
  echo mysqli_error($conn);
  return mysqli_affected_rows($conn);


}

function hapus($id) {
  $conn = koneksi();
  mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = '$id'") or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}

function ubah($data) {
  $id = $data['id'];
  $nama = htmlspecialchars($data['nama']);
  $nim = htmlspecialchars($data['nim']);
  $email = htmlspecialchars($data['email']);
  $jurusan = htmlspecialchars($data['jurusan']);
  $gambar = htmlspecialchars($data['gambar']);

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