<?php

include_once "config.php";
$connection = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
if ( !$connection ) {
    echo mysqli_error( $connection );
    throw new Exception( "Database cannot Connect" );
}




$email = "";
$action ="";
$password = "";
$role = "";
$csrf_token = "";
$_password = "";

if (isset($_POST['submit'])) {
    $action = mysqli_real_escape_string($connection, $_POST['action']);
    $role = mysqli_real_escape_string($connection, $_POST['role']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $csrf_token = mysqli_real_escape_string($connection, $_POST['csrf_token']);

if(!isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $csrf_token)){
    header("location:404.html");
    exit;
}

if($role=='admins' && $action=='login'){
$admsql = "SELECT * FROM admins WHERE email = '$email'";
$result = mysqli_query($connection, $admsql);
if(mysqli_num_rows($result) == 1){
    $row = mysqli_fetch_assoc($result);
    $_email = $row['email'];
    $_password = $row['password'];
    $_id = $row['id'];
    $_role = $row['role'];

    if ( password_verify( $password, $_passsword )) {
        $_SESSION['role'] = $_role;
        $_SESSION['id'] = $_id;
        header( "location:index.php" );
        die();
    } else {
        header( "location:login.php?error" );
    }    
}

}

if($role=='managers' && $action=='login'){
    $mgtsql = "SELECT * FROM managers WHERE email = '$email'";
    $result = mysqli_query($connection, $mgtsql);
    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
        $_email = $row['email'];
        $_password = $row['password'];
        $_id = $row['id'];
        $_role = $row['role'];
    
        if ( password_verify( $password, $_passsword ) ) {
            $_SESSION['role'] = $_role;
            $_SESSION['id'] = $_id;
            header( "location:index.php" );
            die();
        } else {
            header( "location:login.php?error" );
        }    
    }
    
    }

    if($role=='pharmacists' && $action=='login'){
        $pmssql = "SELECT * FROM pharmacists WHERE email = '$email'";
        $result = mysqli_query($connection, $pmssql);
        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_assoc($result);
            $_email = $row['email'];
            $_password = $row['password'];
            $_id = $row['id'];
            $_role = $row['role'];
        
            if ( password_verify( $password, $_passsword ) ) {
                $_SESSION['role'] = $_role;
                $_SESSION['id'] = $_id;
                header( "location:index.php" );
                die();
            } else {
                header( "location:login.php?error" );
            }    
        }
        
        }

        if($role=='salesmans' && $action=='login'){
            $slsql = "SELECT * FROM salesmans WHERE email = '$email'";
            $result = mysqli_query($connection, $slsql);
            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_assoc($result);
                $_email = $row['email'];
                $_password = $row['password'];
                $_id = $row['id'];
                $_role = $row['role'];
            
                if ( password_verify( $password, $_passsword ) ) {
                    $_SESSION['role'] = $_role;
                    $_SESSION['id'] = $_id;
                    header( "location:index.php" );
                    die();
                } else {
                    header( "location:login.php?error" );
                }    
            }
            
            }
        
}

?>

