<?php
  session_start();
  require "connection.php";

  if (isset($_POST['purpose']) && $_POST['purpose'] == 'message') {
    $insert_message_query = "INSERT INTO messages (message_content, user_id, created_at, updated_at) VALUES ('{$_POST['message_content']}', '{$_SESSION['id']}', NOW(), NOW())";

    run_mysql_query($insert_message_query);

    header("Location: home.php");
  } elseif (isset($_POST['purpose']) && $_POST['purpose'] == 'comment') {
    $insert_comment_query = "INSERT INTO comments (comment_content, user_id, message_id, created_at, updated_at) VALUES ('{$_POST['comment_content']}', '{$_SESSION['id']}', '{$_POST['message_id']}', NOW(), NOW())";

    run_mysql_query($insert_comment_query);
    header("Location: home.php");
  }
?>