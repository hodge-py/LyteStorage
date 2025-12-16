<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="./static/css/login.css">
</head>
<body>

    <div class="login-container">
        <h2>User Login</h2>
        <form action="./server/login_handler.php" method="POST">
            
            <div class="form-group">
                <label for="username">Email:</label>
                <input type="text" id="username" name="username" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit">Login</button>
            <button id="registerButton" type="button" onclick="registerUser()">Register</button>
            
        </form>
    </div>

    <div class="login-container" id="register" hidden>
        <h2>Register User</h2>
        <form action="./server/register_handler.php" method="POST">
            
            <div class="form-group">
                <label for="username">Email:</label>
                <input type="text" id="username" name="username" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit">Signup</button>
            
        </form>
    </div>

</body>
<script src="./scripts/login.js"></script>
</html>