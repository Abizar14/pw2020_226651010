<?php 

require "functions.php";

if(isset($_POST['register'])) {
  if(register($_POST) > 0) {
    echo '<script>
    
      alert("User berhasil ditambahkan, silahkan login");
      document.location.href = "login.php";
    
    </script>';
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Register Mahasiswa</title>
</head>
<body>

<style>
  .container {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 120px;
}

form {
  width: 400px;
  padding: 50px 70px 50px 70px;
  border: 1px solid #ddd;
  border-radius: 5px;
  background-color: #f5f5f5;
}

h2 {
  margin-top: 0;
}

label {
  display: block;
  margin-bottom: 10px;
}

input[type="text"],
input[type="password"] {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 3px;
  margin-bottom: 20px;
}

button {
  width: 421px;
  margin-top: 5px;
  background-color: #4CAF50;
  color: white;
  padding: 10px;
  border: none;
  border-radius: 3px;
  cursor: pointer;
}

.header-text {
    text-align: center;
    position: relative;
    top: 90px;
}

.header-text p {
  color: red;
  font-style: italic;
  font-weight: bold;
}

</style>
<div class="header-text">

<h2>Registrasi Mahasiswa</h2>
<?php if(isset($login['error'])) : ?>
<p><?= $login['pesan'] ?></p>
<?php endif; ?>
</div>
<div class="container">
  <form action="" method="post">
    <label for="name">Username:</label>
    <input type="text" id="username" name="username" required autofocus autocomplete="off" placeholder="Masukan Username Anda...">
    <label for="email">Password:</label>
    <input type="password" id="password" name="password1" required placeholder="Masukan Password Anda...">
    <label for="password">Konfirmasi Password:</label>
    <input type="password" id="password" name="password2" required placeholder="Konfirmasi Password Anda...">
    <button type="submit" name="register">Registrasi</button>
  </form>
</div>

</body>
</html>
