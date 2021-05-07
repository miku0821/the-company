<?php
session_start();
$user_id = $_GET['user_id'];

include "../classes/user.php";
$user = new User;
$current_details = $user->getCurrentDetails($user_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a href="dashboard/php" class="navbar-brand">
            <h1 class="h3">The Company</h1>
        </a>
        <div class="ml-auto">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="profile.php" class="nav-link"><?= $_SESSION['username'] ?></a></li>
                <li class="nav-item"><a href="../actions/logout.php" class="nav-link text-danger">Log out</a></li>
            </ul>
        </div>
    </nav>

    <main class="container" style="padding-top: 80px">
        <div class="card w-50 mx-auto border-0">
            <div class="card-header bg-white border-0">
                <h2 class="text-center">EDIT USER</h2>
            </div>
            <div class="card-body">
            <?php 
                $pic = $current_details['photo'];
                echo "<img src='../images/$pic' class='w-50'>";
                // echo "<img src='../images/'" .. "'>";
            ?>
                <form action="../actions/update.php?user_id=<?= $user_id; ?>" method="post" enctype="multipart/form-data">
                    <input type="file" name="pic" class="form-control mb-3">

                    <label for="first_name">First name</label>
                    <input type="text" name="new_first_name" id="first_name" value="<?= $current_details['first_name']?>" class="form-control">

                    <label for="last_name">Last name</label>
                    <input type="text" name="new_last_name" id="last_name" value="<?= $current_details['last_name']?>"class="form-control">

                    <label for="username" class="font-weight-bold">Username</label>
                    <input type="text" name="new_username" id="username" value="<?= $current_details['username']?>" class="form-control fornt-weight-bold mb-5">
                    <div class="text-right">
                        <button type="submit" class="btn btn-warning col-3">Save</button>
                        <a href="dashboard.php" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>

                <?php
                    if(isset($_SESSION['msg'])){
                ?>
                <h3 class="text-danger text-center mt-3"><?php echo $_SESSION['msg'];?></h3>
                
                <?php
                    } 
                    unset($_SESSION['msg']);
                ?>
            </div>
        </div>
    </main>
    
</body>
</html>