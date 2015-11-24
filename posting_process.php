<?php
  session_start();
  require "connection.php";


  $insert_message_query = "INSERT INTO messages (message_content, user_id, created_at, updated_at) VALUES ('{$_POST['message_content']}', '{$_SESSION['id']}', NOW(), NOW())";

  run_mysql_query($insert_message_query);

  header("Location: home.php");
?>