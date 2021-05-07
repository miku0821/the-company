<?php
require "database.php";
class User extends Database {

    public function checkUsername($username){

        $sql = "SELECT username FROM users WHERE username = '$username'";
        $result = $this->conn->query($sql);

        if($result->num_rows == 0){
            return false;
        }else{
            return true;
        }
    }



    public function createUser($first_name, $last_name, $username, $password){
        $sql = "INSERT INTO users (first_name, last_name, username, `password`) VALUES ('$first_name', '$last_name', '$username', '$password')";

            if($this->conn->query($sql)){
                header("location:../views");
            }else{
                die("Error creating user: ". $this->conn->error);
            }
    }

    public function login($username, $password){
        $error = "<script>alert('The username or password is incorrect.')</script>";
        $sql = "SELECT id, username, `password` FROM users WHERE username = '$username'";

        $result = $this->conn->query($sql);
        //Check if username exists
        if($result->num_rows == 1){
            //Check if the password is correct
            $user_details = $result->fetch_assoc();
            // $user_details is an associative array that holds the record of the person who is trying to log in
            if(password_verify($password, $user_details['password'])){
                session_start();

                $_SESSION['user_id'] = $user_details['id'];
                $_SESSION['username'] = $username['username'];

                header("location: ../views/dashboard.php");
                exit;
                //same as die(). terminate the current script.
            }else{
                echo $error;
            }
        }else{
            echo $error;
        }
    }

    public function getUsers(){
        $sql = "SELECT id, first_name, last_name, username FROM users";

        if($result = $this->conn->query($sql)){
            return $result;
        }else{
            die("Error retrieving all users: " . $this->conn->error);
        }
    }

    public function getCurrentDetails($user_id){
        $sql = "SELECT * FROM users WHERE id = '$user_id'";
        $result = $this->conn->query($sql);
        if($result->num_rows == 1){
            return $result->fetch_assoc();
        }else{
            die("Error retrieving currnt user detail:" . $this->conn->error);
        }
    }


    public function checkUpdateUsername($username){

        $sql = "SELECT username FROM users WHERE username = '$username'";
        $result = $this->conn->query($sql);

        if($result->num_rows == 0){
            return false;
        }else{
            return true;
        }
    }

    public function updateUser($user_id, $new_first_name, $new_last_name, $new_username, $photo_name, $tmp_name){
        $sql = "UPDATE users
                SET first_name = '$new_first_name',
                    last_name = '$new_last_name',
                    username = '$new_username',
                    photo = '$photo_name'
                WHERE id = '$user_id'
                ";

        if($this->conn->query($sql)){
            $destination = "../images/".basename($photo_name);

            if(move_uploaded_file($tmp_name, $destination)){
                header("location: ../views/dashboard.php");
                exit;           
            }else{
                die("Error moving photo.");
            }

        }else{
            die("Error in updating user: " . $this->conn->error);
        }
    }

    public function deleteUser($user_id){
        $sql = "DELETE FROM users
                WHERE id = '$user_id'";
        
        if($this->conn->query($sql)){
            header("location: ../views/dashboard.php");
            exit;
        }
    }

}
?>