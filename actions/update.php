<?php
session_start();
include "../classes/user.php";
$user_id = $_GET['user_id'];
$user = new User;

$new_first_name = $_POST['new_first_name'];
$new_last_name = $_POST['new_last_name'];
$new_username = $_POST['new_username'];


$photo_name = $_FILES['pic']['name'];
$tmp_name = $_FILES['pic']['tmp_name'];


// You have to specify where to upload the pictures



$current_details = $user->getCurrentDetails($user_id);
$check_username = $user->checkUpdateUsername($new_username);

if($new_username !== $current_details['username']){

    if($check_username == TRUE){
        $_SESSION['msg'] = "The username is already taken";
        header("location: ../views/editUser.php?user_id=$user_id");
        $user->getCurrentDetails($user_id);
    }
}else{
    $user->updateUser($user_id, $new_first_name, $new_last_name, $new_username, $photo_name, $tmp_name);
}
?>