<?php
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = trim(htmlspecialchars($_POST['login']));
    $password = $_POST['password'];
    
    $users = file_exists('users.txt') ? file('users.txt') : [];
    
    foreach($users as $user) {
        $userData = explode('|', trim($user));
        if(count($userData) === 5) {
            // Check both email and username
            if((strtolower($login) === strtolower($userData[1]) || 
                strtolower($login) === strtolower($userData[2])) && 
               password_verify($password, $userData[4])) {
                $_SESSION['user'] = [
                    'fullname' => $userData[0],
                    'username' => $userData[1],
                    'email' => $userData[2],
                    'phone' => $userData[3]
                ];
                header("Location: index.php");
                exit();
            }
        }
    }
    
    header("Location: login.php?error=1");
    exit();
} 