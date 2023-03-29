<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="#">Moja aplikacja</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <?php if (isset($_SESSION['user_id'])) { ?>
          <li class="nav-item">
            <a class="nav-link" href="admin.php">Panel administratora</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php">Panel użytkownika</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Wyloguj się</a>
          </li>
        <?php } else { ?>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Zaloguj się</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register.php">Zarejestruj się</a>
          </li>
        <?php } ?>
      </ul>
    </div>
  </div>
</nav>
