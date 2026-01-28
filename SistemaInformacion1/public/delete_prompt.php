<?php
session_start();
include '../config/db.php';

// Seguridad: solo ADMIN
if ($_SESSION['rol'] !== 'admin') {
    die("Acceso denegado");
}

$idPrompt = $_POST['idPrompt'];

// Borrar en orden por claves foráneas
$conn->prepare("DELETE FROM Favorito WHERE id_prompt = ?")->execute([$idPrompt]);
$conn->prepare("DELETE FROM Version WHERE id_prompt = ?")->execute([$idPrompt]);
$conn->prepare("DELETE FROM Actividad WHERE id_prompt = ?")->execute([$idPrompt]);
//$conn->prepare("DELETE FROM PromptEtiqueta WHERE id_prompt = ?")->execute([$idPrompt]);
$conn->prepare("DELETE FROM Compartido WHERE id_prompt = ?")->execute([$idPrompt]);
$conn->prepare("DELETE FROM Prompt WHERE id = ?")->execute([$idPrompt]);

header("Location: search.php");
exit;
