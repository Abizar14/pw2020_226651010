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

?>