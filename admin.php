<?php
session_start();

require_once 'includes/config.php';
require_once 'includes/functions.php';

if (!is_admin()) {
  redirect('index.php');
}

$users = get_users();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['delete'])) {
    $id = $_POST['delete'];
    $result = delete_user($id);
    if ($result) {
      $success = "Użytkownik został usunięty";
    } else {
      $error = "Nie udało się usunąć użytkownika";
    }
  } else if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $is_admin = isset($_POST['is_admin']) ? 1 : 0;

    $result = update_user($id, $username, $email, $is_admin);

    if ($result) {
      $success = "Zmiany zostały zapisane";
    } else {
      $error = "Nie udało się zapisać zmian";
    }
  } else if (isset($_POST['add_user'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $is_admin = isset($_POST['is_admin']) ? 1 : 0;

    $result = register($username, $email, $password);

    if ($result) {
      $success = "Użytkownik został dodany";
    } else {
      $error = "Nie udało się dodać użytkownika";
    }

    $users = get_users();
  }
}

include 'includes/header.php';
include 'includes/navbar.php';
?>

<div class="container">
  <h1>Panel administratora</h1>

  <?php if (isset($success)): ?>
  <div class="alert alert-success" role="alert">
    <?= $success ?>
  </div>
  <?php endif; ?>

  <?php if (isset($error)): ?>
  <div class="alert alert-danger" role="alert">
    <?= $error ?>
  </div>
  <?php endif; ?>

  <h2>Użytkownicy</h2>

  <div class="table-responsive">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>Username</th>
          <th>Email</th>
          <th>Admin</th>
          <th>Akcje</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $user): ?>
        <tr>
          <form method="post">
            <input type="hidden" name="id" value="<?= $user['id'] ?>">
            <td><?= $user['id'] ?></td>
            <td><input type="text" class="form-control" name="username" value="<?= $user['username'] ?>" required></td>
            <td><input type="email" class="form-control" name="email" value="<?= $user['email'] ?>" required></td>
            <td><input type="checkbox" name="is_admin" <?= $user['is_admin'] ? 'checked' : '' ?>></td>
            <td>
            <button type="submit" name="update" class="btn btn-primary">Zapisz zmiany</button>
              <button type="submit" name="delete" class="btn btn-danger" onclick="return confirm('Czy na pewno chcesz usunąć użytkownika?')">Usuń</button>
            </td>
          </form>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <hr>

  <h2>Dodaj użytkownika</h2>

  <?php if (isset($error)): ?>
  <div class="alert alert-danger" role="alert">
    <?= $error ?>
  </div>
  <?php endif; ?>

  <form method="post">
    <div class="form-group">
      <label for="username">Nazwa użytkownika:</label>
      <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="form-group">
      <label for="email">Adres email:</label>
      <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="form-group">
      <label for="password">Hasło:</label>
      <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <div class="form-group form-check">
      <input type="checkbox" class="form-check-input" id="is_admin" name="is_admin">
      <label class="form-check-label" for="is_admin">Administrator</label>
    </div>
    <button type="submit" name="add_user" class="btn btn-primary">Dodaj użytkownika</button>
  </form>

</div>

<?php include 'includes/footer.php'; ?>