<?php
session_start();

if (isset($_SESSION['admin_login']) && $_SESSION['admin_login'] === true) {
    header("Location: admin.php");
    exit;
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Akun demo untuk pengembangan lokal
    if (
        hash_equals("admin", $username) &&
        hash_equals("HomiStay2026!", $password)
    ) {
        session_regenerate_id(true);
        $_SESSION['admin_login'] = true;

        header("Location: admin.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - HomiStay</title>
    <link rel="stylesheet" href="assets/style.css">

    <style>
        .login-container {
            max-width: 420px;
            margin: 70px auto;
            padding: 30px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 25px;
        }

        .login-container input {
            width: 100%;
            padding: 12px;
            margin: 10px 0 20px;
            box-sizing: border-box;
        }

        .login-container button {
            width: 100%;
        }

        .error {
            color: #c62828;
            background: #ffebee;
            padding: 10px;
            border-radius: 6px;
        }
    </style>
</head>

<body>

<header class="navbar">
    <div class="logo">HomiStay.</div>
</header>

<div class="login-container">

    <h2>Login Admin</h2>

    <p style="text-align:center;">
        Silakan masuk untuk mengelola reservasi
    </p>

    <?php if ($error != ""): ?>
        <p class="error">
            <?php echo htmlspecialchars($error); ?>
        </p>
    <?php endif; ?>

    <form method="POST" action="login.php">

        <label>Username</label>
        <input type="text" name="username"
               placeholder="Masukkan username" required>

        <label>Password</label>
        <input type="password" name="password"
               placeholder="Masukkan password" required>

        <button type="submit" class="btn">
            Login
        </button>

    </form>

</div>

<footer class="footer">
    © 2026 HomiStay.
</footer>

</body>
</html>