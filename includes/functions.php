<?php

function is_logged_in()
{
  return isset($_SESSION['user_id']);
}

function fetch_current_user()
{
  global $conn;
  if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM users WHERE id = $user_id";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
    return $user;
  } else {
    return null;
  }
}

function is_admin()
{
  $user = fetch_current_user();
  return $user && $user['is_admin'];
}

function redirect($url)
{
  header("Location: $url");
  exit();
}

function login($username, $password)
{
  global $conn;
  $query = "SELECT * FROM users WHERE username = '$username'";
  $result = mysqli_query($conn, $query);
  if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    if (password_verify($password, $user['password'])) {
      $_SESSION['user_id'] = $user['id'];
      return true;
    } else {
      return false;
    }
  } else {
    return false;
  }
}

function register($username, $email, $password)
{
  global $conn;
  $hash = password_hash($password, PASSWORD_DEFAULT);
  $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hash')";
  $result = mysqli_query($conn, $query);
  return $result;
}

function get_users()
{
  global $conn;
  $query = "SELECT * FROM users";
  $result = mysqli_query($conn, $query);
  $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
  return $users;
}

function get_user_by_id($id)
{
  global $conn;
  $query = "SELECT * FROM users WHERE id = $id";
  $result = mysqli_query($conn, $query);
  $user = mysqli_fetch_assoc($result);
  return $user;
}

function update_user($id, $username, $email, $is_admin)
{
  global $conn;
  $query = "UPDATE users SET username = '$username', email = '$email', is_admin = $is_admin WHERE id = $id";
  $result = mysqli_query($conn, $query);
  return $result;
}

function delete_user($id) {
  global $conn;
  $id = mysqli_real_escape_string($conn, $id);
  $query = "DELETE FROM users WHERE id = $id";
  return mysqli_query($conn, $query);
}
?>