<?php
session_start();
include '../config/db.php';

$idPrompt = $_POST['idPrompt'];
$idUsuario = $_SESSION['user_id'];

// Verificar si ya es favorito
$sql = "SELECT id FROM Favorito 
        WHERE id_prompt = :idPrompt 
          AND id_usuario = :idUsuario";
$stmt = $conn->prepare($sql);
$stmt->execute([
    'idPrompt' => $idPrompt,
    'idUsuario' => $idUsuario
]);

$favorito = $stmt->fetch();

if ($favorito) {
    // Si ya existe, eliminar (quitar favorito)
    $sql = "DELETE FROM Favorito 
            WHERE id_prompt = :idPrompt 
              AND id_usuario = :idUsuario";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        'idPrompt' => $idPrompt,
        'idUsuario' => $idUsuario
    ]);
    echo "removed";
} else {
    // Si no existe, insertar (agregar favorito)
    $sql = "INSERT INTO Favorito (id_prompt, id_usuario, fecha)
            VALUES (:idPrompt, :idUsuario, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        'idPrompt' => $idPrompt,
        'idUsuario' => $idUsuario
    ]);
    echo "added";
}
