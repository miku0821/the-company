<?php
include "../classes/user.php";
session_start();
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);


$user = new User;
$check_username = $user->checkUsername($username);
// echo $check_username;
if($check_username == TRUE){

   $_SESSION['msg'] = "The username is already taken";
    header("location: ../views/register.php");
    }else{
        $user = new User;
        $user->createUser($first_name, $last_name, $username, $password);
    }
?>
