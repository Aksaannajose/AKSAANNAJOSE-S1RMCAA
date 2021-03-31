<?php

  include './connection.php';
  session_start();

  if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM register WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    if($row = mysqli_fetch_assoc($result)){
      $hash = password_verify($password, $row['password']);
      if($hash == false){
        header('Location: ./login.php?invalidPassword');
        exit();
      }elseif($hash == true){
        $_SESSION['fname'] = $row['fname'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['address'] = $row['address'];
        $_SESSION['phone'] = $row['number'];
        header('Location: ./index1.php');
        exit();
      }
    }else{
      header('Location: ./login.php?invalidEmail');
      exit();
    }

  }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/loginLay.css">
  </head>
  <style>
    body{
      background-image: url("./image/login1.jpg");
      background-attachment: fixed;
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      
    }
  </style>
  <body>

    <div class="container">
      <div class="row">
        <div class="col-3"></div>
        <div class="col-6 register-div" style="background-color: rgba(255,0,0, 0.3); border-radius: 10px;"><br><br>

          <h4 class="register-text">Login</h4><br><br>

<!-----------------------------------------------------------Invalid Email-------------------------------->
                    <?php
                        if(isset($_GET['invalidEmail'])){
                            $message = $_GET['invalidEmail'];
                            $message = "Please enter a valid email or username";
                    ?>
                        <div class="alert alert-danger text-center"><?php echo $message ?></div>
                    <?php
                        }
                    ?>
<!-----------------------------------------------------------Invalid Password-------------------------------->
                    <?php
                        if(isset($_GET['invalidPassword'])){
                            $message = $_GET['invalidPassword'];
                            $message = "The password you entered is incorrect";
                    ?>
                        <div class="alert alert-danger text-center"><?php echo $message ?></div>
                    <?php
                        }
                    ?>

                    <form action="" method="POST">
                        <input type="email" name="email" class="login-form" placeholder="Email" required><br><br>
                        <input type="password" name="password" class="login-form" placeholder="Password" required><br><br>
                        <input type="submit" name="submit" value="Login" class="btn btn-success" style="margin-left: 44%; margin-right: 45%;"><br>
                        <h4 style="font-family: cursive; color: white; font-size: 18px;">Dont't have account?</h4><a href="./register.php" style="color: lightblue;">Sign up</a><br><br>
                    </form>

        </div>
        <div class="col-3"></div>
      </div>
    </div>

  </body>
</html>