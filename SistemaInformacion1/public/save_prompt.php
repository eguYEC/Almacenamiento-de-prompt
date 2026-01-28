<?php
include '../config/db.php';

$id = $_POST['id_prompt'];
$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];
$ia = $_POST['ia'];
$contenido = $_POST['contenido'];

// Obtener versión actual
$stmt = $conn->prepare("SELECT version_actual FROM Prompt WHERE id = :id");
$stmt->execute(['id' => $id]);
$actual = $stmt->fetch(PDO::FETCH_ASSOC);
$nuevaVersion = $actual['version_actual'] + 1;

// Insertar nueva versión
$stmt = $conn->prepare("
    INSERT INTO Version (numero, contenido, id_prompt)
    VALUES (:num, :contenido, :id)
");
$stmt->execute([
    'num' => $nuevaVersion,
    'contenido' => $contenido,
    'id' => $id
]);

// Actualizar prompt
$stmt = $conn->prepare("
    UPDATE Prompt SET
        titulo_contenido = :titulo,
        descripcion = :descripcion,
        ia_destino = :ia,
        version_actual = :version
    WHERE id = :id
");
$stmt->execute([
    'titulo' => $titulo,
    'descripcion' => $descripcion,
    'ia' => $ia,
    'version' => $nuevaVersion,
    'id' => $id
]);

header("Location: edit.php");
exit;
