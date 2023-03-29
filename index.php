<?php
session_start();
require_once 'includes/config.php';

if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit;
}

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
  $user = mysqli_fetch_assoc($result);
} else {
  die('Nie można pobrać danych użytkownika');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];
  $email = $_POST['email'];

  $query = "UPDATE users SET username = '$username', email = '$email' WHERE id = $user_id";
  $result = mysqli_query($conn, $query);

  if ($result) {
    $success = "Zmiany zostały zapisane";
    $user['username'] = $username;
    $user['email'] = $email;
  } else {
    $error = "Nie udało się zapisać zmian";
  }
}

include 'includes/header.php';
include 'includes/navbar.php';
?>

<div class="container">
  <h1>Profil użytkownika</h1>
  <?php if (isset($success)) { ?>
    <div class="alert alert-success" role="alert">
      <?php echo $success; ?>
    </div>
  <?php } ?>
  <?php if (isset($error)) { ?>
    <div class="alert alert-danger" role="alert">
      <?php echo $error; ?>
    </div>
  <?php } ?>
  <form method="post">
    <div class="form-group">
      <label for="username">Nazwa użytkownika:</label>
      <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username']; ?>" required>
    </div>
    <div class="form-group">
      <label for="email">Adres e-mail:</label>
      <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
  </form>
</div>

<?php
include 'includes/footer.php';
?>
