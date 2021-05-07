<?php
session_start();

include "../classes/user.php";
$user = new User;
$user_list = $user->getUsers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/1eaebda83d.js" crossorigin="anonymous"></script>
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
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <form action="../actions/dashboard.php" method="post">
                        <label for="first_name">First Name</label>
                        <input type="text" name="db_first_name"  id="first_name" class="form-control mb-2" required autofocus>

                        <label for="last_name">Last Name</label>
                        <input type="text" name="db_last_name"  id="last_name" class="form-control mb-2" required>

                        <label for="username" class="font-weight-bold">Username</label>
                        <input type="text" name="db_username"  id="username" class="form-control mb-2 font-weight-bold" maxlength="15" required>

                        <label for="password">Password</label>
                        <input type="password" name="db_password"  id="password" class="form-control mb-5" minlength="8" required>

                        <button type="submit" class="btn btn-success btn-block">Register</button>
                        </form>
                    </div>

                    <?php
                        if(isset($_SESSION['msg'])){
                    ?>
                    
                    <h3 class="text-danger text-center"><?php echo $_SESSION['msg'];?></h3>
                    
                    <?php
                        }
                        unset($_SESSION['msg']);
                    ?>
                </div>
            </div>
            <div class="col-6">
                <h2 class="text-muted">User List</h2>
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Username</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        while($user_details = $user_list->fetch_assoc()){
                            if($user_details['id'] != $_SESSION['user_id']){
                            
                    ?>

                    <tr>
                            <td><?= $user_details['id']?></td>
                            <td><?= $user_details['first_name']?></td>
                            <td><?= $user_details['last_name']?></td>
                            <td><?= $user_details['username']?></td>
                            <td>
                                <a href="editUser.php?user_id=<?php echo $user_details['id']; ?>" class="btn btn-outline-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                <a href="../actions/delete.php?user_id=<?php echo $user_details['id'];?>" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                            </td>
                    </tr>
                    
                    <?php
                            }
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>