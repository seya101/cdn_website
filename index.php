<?php session_start(); 

      //IF ALREADY LOGIN USER CANNOT GO BACK TO LOGIN PAGE
      if(isset($_SESSION["id"]) && isset($_SESSION["loggedin"])){
      header("Location:home.php");
      exit();
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link href="css/style.css" rel="stylesheet" type="text/css">
        <script src="js/jquery.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </head>
    <body>
        <div class="login">
            <h1>Login</h1>
            <form action="authenticate.php" method="post">
                <!-- Username -->
                <label for="username">
                    <i class="fas fa-user"></i>
                </label>
                <input type="text" name="username" placeholder="Username (ex: user01)" id="username" >
                
                <!-- Password -->
                <label for="password">
                    <i class="fas fa-lock"></i>
                </label>
                <input name="password" class="form-control" type="password" id="password" placeholder="Password" value="<?php if (isset($_SESSION['pwd_input'])) { echo $_SESSION['pwd_input'];} ?>" id="password" >

                <!-- Show/Hide Password -->
                <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>

                <!-- Submit Button -->
                <input type="submit" value="Login" name="login">
            </form>
        </div>

        <!-- Footer -->
        <div class="footer">
          <p>version 1.10.0</p>
        </div>
        
        <!-- Script -->
        <script src="js/jquery.js"></script>
        <script src="js/show-hide.js"></script>

        <!-- SWEETALERT -->
        <?php 
            if (isset($_SESSION['error_inc'])) { 
            echo '<script>
                swal({
                    title: "Incorrect!",
                    text: "'.$_SESSION['error_inc'].'",
                    icon: "warning",
                });
                </script>
            ';
            unset($_SESSION['error_inc']);
           }
            elseif (isset($_SESSION['error_message'])) {
                echo '<script>
                swal({
                    title: "Oops!..",
                    text: "'.$_SESSION['error_message'].'",
                    icon: "error",
                });
                </script>
            ';
                unset($_SESSION['error_message']);
                
            }
        ?>

    </body>
</html>

