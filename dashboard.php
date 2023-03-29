<?php
include 'includes/config.php';
include 'includes/functions.php';

if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
}

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = '$user_id'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

include 'includes/header.php';
include 'includes/navbar.php';
?>
<div class="container">
  <h1>Panel użytkownika</h1>
  <p>Witaj, <?php echo $user['first_name'] . ' ' . $user['last_name']; ?>!</p>
  <p>Adres email: <?php echo $user['email']; ?></p>
  <p>Login: <?php echo $user['username']; ?></p>
  <a href="logout.php" class="btn btn-primary">Wyloguj się</a>
</div>
<?php include 'includes/footer.php'; ?>
