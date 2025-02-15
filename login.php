<?php
session_start();
if(isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MK Viewer</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #1a1a1a;
            color: #fff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .header {
            background: #2d2d2d;
            padding: 1rem;
            text-align: center;
            border-bottom: 2px solid #3d3d3d;
        }

        .website-title {
            color: #2ecc71;
            font-size: 2.5rem;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .auth-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }

        .auth-box {
            background: #2d2d2d;
            padding: 2.5rem;
            border-radius: 12px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        }

        .auth-box h2 {
            color: #2ecc71;
            text-align: center;
            margin-bottom: 2rem;
        }

        .input-group {
            margin-bottom: 1.5rem;
        }

        input {
            width: 100%;
            padding: 12px 15px;
            background: #1f1f1f;
            border: 2px solid #3d3d3d;
            border-radius: 6px;
            color: #fff;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        input:focus {
            outline: none;
            border-color: #2ecc71;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #2ecc71;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: background 0.3s;
        }

        button:hover {
            background: #27ae60;
        }

        .links {
            text-align: center;
            margin-top: 1.5rem;
        }

        .links a {
            color: #2ecc71;
            text-decoration: none;
            font-size: 14px;
            transition: opacity 0.3s;
        }

        .links a:hover {
            opacity: 0.8;
        }

        .error-msg {
            color: #e74c3c;
            text-align: center;
            margin-bottom: 1.5rem;
            padding: 12px;
            background: rgba(231, 76, 60, 0.1);
            border-radius: 6px;
        }
    </style>
</head>
<body>
    <header class="header">
        <h1 class="website-title">MK Viewer</h1>
    </header>

    <div class="auth-container">
        <div class="auth-box">
            <h2>Login</h2>
            <?php if(isset($_GET['error'])): ?>
            <div class="error-msg">Invalid credentials</div>
            <?php endif; ?>
            <form method="POST" action="authenticate.php">
                <div class="input-group">
                    <input type="text" name="login" placeholder="Username or Email" required>
                </div>
                <div class="input-group">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit">Login</button>
            </form>
            <div class="links">
                New user? <a href="register.php">Create account</a>
            </div>
        </div>
    </div>
</body>
</html> 