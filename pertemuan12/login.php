<?php 
session_start();
// membuat logika login jika dia sudah login maka kembalikan ke halaman index
if (isset($_SESSION['login'])) {
  header("Location: index.php");
  exit;
}

require "functions.php";

// ketika login ditekan
if (isset($_POST['login'])) {
  $login = login($_POST);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Login Mahasiswa</title>
</head>
<body>
<style>
.login-form {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  position: relative;
  bottom: 120px;
  
}

form {
  width: 300px;
  padding: 60px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

label {
  display: block;
  margin-bottom: 5px;
}

input[type="text"],
input[type="password"] {
  width: 100%;
  padding: 5px;
  margin-bottom: 10px;
  border-radius: 3px;
  border: 1px solid #ccc;
}

button[type="submit"] {
  width: 104%;
  position: relative;
  top: 10px;
  
  padding: 5px;
  background-color: #4CAF50;
  color: #fff;
  border: none;
  border-radius: 3px;
  cursor: pointer;
}

button[type="submit"]:hover {
  background-color: #3e8e41;
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

<h2>Login Mahasiswa</h2>
<?php if(isset($login['error'])) : ?>
<p><?= $login['pesan'] ?></p>
<?php endif; ?>
</div>

<div class="login-form">
  <form action="" method="post" autocomplete="off">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" autocomplete="off" autofocus required>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required autocomplete="off">
    <button type="submit" name="login">Login</button>
    <br><br>
    <a href="register.php" class= "registerasimahasiswa">Registrasi</a>
  </form>
</div>
  
</body>
</html>