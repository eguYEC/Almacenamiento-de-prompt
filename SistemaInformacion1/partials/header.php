<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PromptVault</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<!-- Barra superior -->
<header class="top-bar">
    <div class="top-bar-user">
        <span class="user-name">
            👤 <?= htmlspecialchars($_SESSION['user_name']) ?>
        </span>
        <a href="../auth/logout.php" class="logout-btn">Cerrar sesión</a>
    </div>
</header>

<?php if (basename($_SERVER['PHP_SELF']) != 'index.php'): ?>
    <div class="menu-back"></div>
<?php endif; ?>

<div class="container-center">
