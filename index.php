<?php
session_start();
require_once('./backend/config/connect.php')
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="style.css">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css" rel="stylesheet" />
</head>

<body class="bg-light">
  <div class="container d-flex justify-content-center">
    <div class="card w-75 mt-5">
      <div class="card-body">
          <form action="./frontend/auth/login_db.php" method="post">
            <h3 class="text-center">Login</h3>
            <?php if (isset($_SESSION['error'])) { ?>
              <div class="alert alert-danger" role="alert">
                <?php
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?>
              </div>
            <?php } ?>
            <?php if (isset($_SESSION['success'])) { ?>
              <div class="alert alert-success" role="alert">
                <?php
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?>
              </div>
            <?php } ?>
            <div class="form-outline mb-4">
              <input type="email" id="email" name="email" class="form-control" />
              <label class="form-label" for="email">Email...</label>
            </div>
            <div class="form-outline mb-4">
              <input type="password" id="password" name="password" class="form-control" />
              <label class="form-label" for="password">Password...</label>
            </div>
            <button type="submit" name="login" class="btn btn-primary btn-block mb-4">Sign in</button>
            <div class="text-center">
              <p>Not a member? <a href="./frontend/auth/register_form.php">Register</a></p>
            </div>
          </form>
      </div>
    </div>

  </div>



  <!-- MDB -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>
</body>

</html>