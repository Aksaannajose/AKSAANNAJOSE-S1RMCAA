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
                    header('Location: ./sucess.php');
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
        background-image: url("./image/index1.jpg");
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
                    <h4 class="register-text"><b>PAYMENT<b></h4><br><br>

<!-------------------------------------Return if name is invalid------------------------------------->
                    <?php
                        if(isset($_GET['invalidName'])){
                            $message = $_GET['invalidName'];
                            $message = "Please enter a valid name";
                    ?>
                        <div class="alert alert-danger text-center"><?php echo $message ?></div>
                    <?php
                        }
                    ?>
<!-------------------------------------------------Return if email is invalid--------------------------------------->
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
                        <input type="text" name="select bank" class="login-form" placeholder="bank" required><br><br>
                        <input type="text" name="type of account" class="login-form" placeholder="account" required><br><br>
                        <input type="text" name="Amount" class="login-form" placeholder="Amount" required><br><br>
                        <input type="submit" name="submit" value="Submit"class="btn btn-success" style="margin-left: 44%; margin-right: 45%;">
						
                        </div>
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