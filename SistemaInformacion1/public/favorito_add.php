session_start();
require '../config/db.php';

$id_usuario = $_SESSION['id_usuario'];
$id_prompt = $_POST['id_prompt'];

$sql = "INSERT IGNORE INTO Favorito (id_usuario, id_prompt) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->execute([$id_usuario, $id_prompt]);

echo "ok";
