<?php

    include './connection.php';

    if(isset($_POST['submit'])){
        $fname = $_POST['fname'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $pincode = $_POST['pincode'];
        $password = $_POST['password'];

        if(!preg_match("/^[A-Za-z]*$/", $fname)){
            header('Location: ./register.php?invalidName');
        }else{
            
                $sql = "SELECT * FROM register WHERE email='$email'";
                $result = mysqli_query($conn, $sql);
                if(mysqli_fetch_assoc($result)){
                    header('Location: ./register.php?emailExist');
                }else{
                    $hash = password_hash($password, PASSWORD_DEFAULT);
                    $sql = "INSERT INTO register(fname, address, email, phone, pincode, password)
                    VALUES('$fname', '$address', '$email', '$phone', '$pincode','$hash')";
                    mysqli_query($conn, $sql);
                    header('Location: ./login.php');
                }
            // }
        }

    }

?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Register Page</title>
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
        <br><br>
        
        <div class="container">
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6" class="register-div" style="background-color: rgba(255,0,0, 0.3); border-radius: 10px;"><br><br>
                    <h4 class="register-text"><b>Register<b></h4><br><br>

                    <?php
                        if(isset($_GET['invalidName'])){
                            $message = $_GET['invalidName'];
                            $message = "Please enter a valid name";
                    ?>
                        <div class="alert alert-danger text-center"><?php echo $message ?></div>
                    <?php
                        }
                    ?>

                    <?php
                        if(isset($_GET['invalidEmail'])){
                            $message = $_GET['invalidEmail'];
                            $message = "Please enter a valid email";
                    ?>
                        <div class="alert alert-danger text-center"><?php echo $message ?></div>
                    <?php
                        }
                    ?>
<!-----------------------------------------------------Return if email already exists--------------------->
                    <?php
                        if(isset($_GET['emailExist'])){
                            $message = $_GET['emailExist'];
                            $message = "This email already exists";
                    ?>
                        <div class="alert alert-danger text-center"><?php echo $message ?></div>
                    <?php
                        }
                    ?>

                    <form action="" method="POST" name="form-register" onSubmit = "return checkPassword(this)" enctype="multipart/form-data">
                        <input type="text" name="fname" class="login-form" placeholder="Name" required><br><br>
                        <input type="text" name="address" class="login-form" placeholder="Address" required><br><br>
                        <input type="email" id="email" name="email" onClick="emailValidate" class="login-form" placeholder="Email" required><br><br>
                        <input type="phone" name="phone" class="login-form" placeholder="Mobile Number" minlength="10" maxlength="12" required><br><br>
                        <input type="pincode" name="pincode" class="login-form" placeholder="Pincode" required><br><br>
                        <input type="password" name="password" class="login-form" placeholder="Password" required><br><br>
                        <input type="password" name="confirm_passwd" class="login-form" placeholder="Re-type password" required><br><br>
                        <input type="submit" name="submit" value="Register" class="btn btn-success" style="margin-left: 40%; margin-right: 45%;"><br><a href="./login.php" style="color: lightblue;">Sign in</a><br><br>
                    </form>
                </div>
        <div class="col-3"></div>
            </div>
        </div>

    </body>

    <script>
        function checkPassword(form){
            passw1 = form.passwd.value;
                passw2 = form.confirm_passwd.value;

                if(passw1.length < 8){
                    alert("Please make your password of atleast 8 characters");
                }
                else if(passw1 != passw2){
                    alert("Please enter the same password");
                    return false;
                }   
                else{
                    return true;
                }
        }
    </script>

</html>