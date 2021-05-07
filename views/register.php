<?php
   include "../classes/user.php";
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>
<body class="bg-light">
    <div style="height: 100vh">
    <!-- 100% of the viewport height -->
        <div class="row h-100 m-0">
            <div class="card w-25 my-auto mx-auto">
                <div class="card-header bg-white border-0">
                    <h1 class="text-center">REGISTER</h1>
                </div>
                <div class="card-body">
                    <form action="../actions/register.php" method="post">
                        <label for="first_name">First Name</label>
                        <input type="text" name="first_name"  id="first_name" class="form-control mb-2" required autofocus>

                        <label for="last_name">Last Name</label>
                        <input type="text" name="last_name"  id="last_name" class="form-control mb-2" required>

                        <label for="username" class="font-weight-bold">Username</label>
                        <input type="text" name="username"  id="username" class="form-control mb-2 font-weight-bold" maxlength="15" required>

                        <label for="password">Password</label>
                        <input type="password" name="password"  id="password" class="form-control mb-5" minlength="8" required>

                        <button type="submit" class="btn btn-success btn-block">Register</button>
                    </form>

                    <p class="text-center mt-3 small">Registered already? <a href="../views">Log in.</a></p>
                    <!-- go to index.php inside veiws folder.  index.php is the Login page. -->
                    <!-- theCompany/views  -->
                    <!-- theCompany/views/index.php -->

                    <?php
                        if(isset($_SESSION['msg'])){
                    ?>
                    <h3 class="text-danger text-center"><?php echo $_SESSION['msg']; ?></h3>
                    
                    <?php
                        }
                        unset($_SESSION['msg']);
                    ?>

                </div>
            </div>
        </div>
    </div>

</body>
</html>