<?php
include 'includes/config.php';
include 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $email = $_POST['email'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  if ($password !== $confirm_password) {
    $error = "Hasła nie są takie same.";
  } else {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO users (first_name, last_name, email, username, password) VALUES ('$first_name', '$last_name', '$email', '$username', '$hashed_password')";
    $result = mysqli_query($conn, $query);
    if ($result) {
      header('Location: login.php');
    } else {
      $error = "Błąd rejestracji. Spróbuj ponownie.";
    }
  }
}

include 'includes/header.php';
include 'includes/navbar.php';
?>
<div class="container">
  <h1>Zarejestruj się</h1>
  <?php if (isset($error)) { ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
  <?php } ?>
  <form action="register.php" method="post">
    <div class="form-group">
      <label for="first_name">Imię:</label>
      <input type="text" class="form-control" id="first_name" name="first_name" required>
    </div>
    <div class="form-group">
      <label for="last_name">Nazwisko:</label>
      <input type="text" class="form-control" id="last_name" name="last_name" required>
    </div>
    <div class="form-group">
      <label for="email">Adres email:</label>
      <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="form-group">
      <label for="username">Login:</label>
      <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="form-group">
      <label for="password">Hasło:</label>
      <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <div class="form-group">
      <label for="confirm_password">Potwierdź hasło:</label>
      <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
    </div>
    <button type="submit" name="register" class="btn btn-primary">Zarejestruj</button>
  </form>
</div>
<?php include 'includes/footer.php'; ?>
