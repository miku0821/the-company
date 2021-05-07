<?php
include "../classes/user.php";
session_start();

$first_name = $_POST['db_first_name'];
$last_name = $_POST['db_last_name'];
$usernmae = $_POST['db_username'];
$password = password_hash($_POST['db_password'], PASSSWORD_DEFAULT);

$user = new User;
$check_username = $user->checkUsername($username);

if($check_username == TRUE){
    $_SESSION['msg'] = "This username is already taken";
    header("location: ../views/dashboard.php");
}else{
    $user->createUser($first_name, $last_name, $username, $password);
}
?>