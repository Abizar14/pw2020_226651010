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
  $query = "INSERT INTO mahasiswa VALUES(null, '$nama', '$nim', '$email', '$jurusan', $gambar)";
  
  mysqli_query($conn, $query);
  echo mysqli_error($conn);
  return mysqli_affected_rows($conn);


}



?>