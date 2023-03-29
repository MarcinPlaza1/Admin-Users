<?php
session_start();
include 'includes/config.php';
include 'includes/functions.php';

if (isset($_SESSION['user_id'])) {
  header('Location: admin.php');
  exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $query = "SELECT * FROM users WHERE username = '$username'";
  $result = mysqli_query($conn, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    if (password_verify($password, $user['password'])) {
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['username'] = $user['username'];
      header('Location: admin.php');
      exit;
    } else {
      $error = "Nieprawidłowe hasło!";
    }
  } else {
    $error = "Nieprawidłowa nazwa użytkownika!";
  }
}

include 'includes/header.php';
include 'includes/navbar.php';
?>

<div class="container">
  <h1>Zaloguj się</h1>
  <?php if (isset($error)) { ?>
    <div class="alert alert-danger" role="alert">
      <?php echo $error; ?>
    </div>
  <?php } ?>
  <form method="post">
    <div class="form-group">
      <label for="username">Nazwa użytkownika:</label>
      <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="form-group">
      <label for="password">Hasło:</label>
      <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <button type="submit" class="btn btn-primary">Zaloguj się</button>
  </form>
</div>

<?php include 'includes/footer.php'; ?>
