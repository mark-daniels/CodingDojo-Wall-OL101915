<?php
  session_start();
  require "connection.php";

  if (isset($_POST['purpose']) && $_POST['purpose'] == 'register') {
    register_user($_POST);
    header("Location: home.php");
  } else if (isset($_POST['purpose']) && $_POST['purpose'] == 'login') {
    $user = login_user($_POST);
    if (count($user) > 0) {
      header("Location: home.php");
    } else {
      $_SESSION['errors'] = array("Wrong email or password");
      header("Location: index.php");
    }
  }


  function register_user($post) {
    $register_query = "INSERT INTO users (first_name, last_name, email, password, created_at, updated_at) VALUES ('{$post['first_name']}', '{$post['last_name']}', '{$post['email']}', '{$post['password']}', NOW(), NOW())";
    run_mysql_query($register_query);
  }

  function login_user($post) {
    $login_query = "SELECT * FROM users WHERE email = '{$post['email']}' AND password = '{$post['password']}'";
    return fetch_record($login_query);
  }

?>