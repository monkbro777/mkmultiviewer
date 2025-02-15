<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize inputs
    $fullname = trim(htmlspecialchars($_POST['fullname']));
    $username = trim(htmlspecialchars($_POST['username']));
    $email = trim(htmlspecialchars($_POST['email']));
    $phone = trim(htmlspecialchars($_POST['phone']));
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate inputs
    if(empty($fullname) || empty($username) || empty($email) || empty($phone) || empty($password) || empty($confirm_password)) {
        header("Location: register.php?error=empty");
        exit();
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: register.php?error=invalidemail");
        exit();
    }

    if(!preg_match('/^[0-9]{10}$/', $phone)) {
        header("Location: register.php?error=phone");
        exit();
    }

    if($password !== $confirm_password) {
        header("Location: register.php?error=password");
        exit();
    }

    // Check existing users
    $users = file_exists('users.txt') ? file('users.txt') : [];
    foreach($users as $user) {
        $userData = explode('|', trim($user));
        if(isset($userData[2]) && $userData[2] === $email) {
            header("Location: register.php?error=exists");
            exit();
        }
    }

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Save user data
    $userData = implode('|', [
        $fullname,
        $username,
        $email,
        $phone,
        $hashedPassword
    ]);
    
    file_put_contents('users.txt', $userData.PHP_EOL, FILE_APPEND);
    
    header("Location: login.php?registered=1");
    exit();
} 