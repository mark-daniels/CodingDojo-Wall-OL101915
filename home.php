<?php
  session_start();
  require "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Welcome to the Wall</title>
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

  <!-- jQuery Library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
</head>
<body>

  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">The Wall</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="">Welcome <?= $_SESSION['first_name'] ?></a></li>
          <li>
            <form action="process.php" method="post">
              <input type="hidden" name="purpose" value="signout">
              <button type="submit" class="btn btn-default">Sign out</button>
            </form>
          </li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>

  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <form action="posting_process.php" method="post">
          <input type="hidden" name="purpose" value="message">
          <label>Post a message</label>
          <textarea class="form-control" rows="3" name="message_content"></textarea>
          <button type="submit" class="btn btn-default">Post</button>
        </form>
      </div>
    </div>


    <div class="row">
      <div class="col-md-12">
        <?php
          $get_all_messages_and_comments_query = "SELECT * FROM messages JOIN users ON messages.user_id = users.id LEFT JOIN comments ON messages.id = comments.message_id";
          $messages = fetch_all($get_all_messages_and_comments_query);
          foreach ($messages as $message) {
        ?>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title"><?= $message['first_name'] . " " . $message['last_name'] ?></h3>
            </div>
            <div class="panel-body">
              <?= $message['message_content'] ?>

              <?php
                foreach ($messages as $message) {
                   
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Panel title</h3>
                  </div>
                  <div class="panel-body">
                    Panel content
                  </div>
                </div>
                }
              ?>
            </div>

            <form action="posting_process.php" method="post">
              <input type="hidden" name="purpose" value="comment">
              <input type="hidden" name="message_id" value="<?= $message['id'] ?>">
              <label>Post a comment</label>
              <textarea class="form-control" rows="3" name="comment_content"></textarea>
              <button type="submit" class="btn btn-default">Comment</button>
            </form>
          </div>
        <?php
          }
        ?>




      </div>
    </div>
  </div>  









</body>
</html>