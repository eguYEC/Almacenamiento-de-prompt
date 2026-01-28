<?php
session_start();
require_once '../config/db.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validación básica
    if (!$nombre || !$apellido || !$email || !$password) {
        $error = "Todos los campos son obligatorios";
    } else {
        // Verificar si ya existe el correo
        $check = $conn->prepare("SELECT id FROM Usuario WHERE email = ?");
        $check->execute([$email]);

        if ($check->fetch()) {
            $error = "Ese correo ya está registrado";
        } else {
            // Encriptar contraseña
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            // Insertar usuario (rol por defecto: usuario)
            $sql = "INSERT INTO Usuario (nombre, apellido, email, password, rol, estado)
                    VALUES (?, ?, ?, ?, 'usuario', 1)";
            $stmt = $conn->prepare($sql);

            if ($stmt->execute([$nombre, $apellido, $email, $passwordHash])) {
                $success = "Usuario registrado correctamente. Ya puedes iniciar sesión.";
            } else {
                $error = "Error al registrar usuario";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>

    <style>
        body {
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            color: #fff;
        }

        .register-card {
            background: #162a32;
            padding: 35px;
            border-radius: 15px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.6);
        }

        .register-card h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #00ff9c;
        }

        .register-card input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 8px;
            border: none;
            outline: none;
            background: #223c45;
            color: white;
        }

        .btn-register {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            border: none;
            background: linear-gradient(135deg, #00ff9c, #00c7ff);
            font-weight: bold;
            cursor: pointer;
        }

        .btn-register:hover {
            opacity: 0.9;
        }

        .register-card a {
            color: #00c7ff;
            text-decoration: none;
        }

        .register-card a:hover {
            text-decoration: underline;
        }

        .success {
            background: #113322;
            padding: 8px;
            border-radius: 6px;
            color: #4dffb0;
            margin-bottom: 10px;
        }

        .error {
            background: #331111;
            padding: 8px;
            border-radius: 6px;
            color: #ff5b5b;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

<div class="register-card">
    <h2>Crear Cuenta</h2>

    <?php if ($error): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="success"><?= $success ?></div>
    <?php endif; ?>

    <form method="POST">
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="text" name="apellido" placeholder="Apellido" required>
        <input type="email" name="email" placeholder="Correo" required>
        <input type="password" name="password" placeholder="Contraseña" required>

        <button class="btn-register" type="submit">Crear Cuenta</button>
    </form>
    <form method="POST" onsubmit="return validarFormulario()">


    <p style="margin-top:15px;text-align:center">
        ¿Ya tienes cuenta? <a href="login.php">Iniciar sesión</a>
    </p>
</div>
<script>
function validarFormulario() {
    const inputs = document.querySelectorAll("input");
    for (let input of inputs) {
        if (input.value.trim() === "") {
            alert("Por favor completa todos los campos");
            input.focus();
            return false;
        }
    }
    return true;
}
</script>

</body>
</html>

