<?php

require '../functions.php';

$mahasiswa = cari($_GET['keyword']);


?>

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