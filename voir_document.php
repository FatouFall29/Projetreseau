<?php
include 'config.php';

// Vérifier si un ID est présent dans l'URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID de document non valide.");
}

$id = intval($_GET['id']);

// Récupérer le document depuis la base de données
$sql = "SELECT * FROM documents WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// Vérifier si le document existe
if ($result->num_rows === 0) {
    die("Document introuvable.");
}

$document = $result->fetch_assoc();
$fichier = "/home/ftpuser/ftp/" . $document["fichier"]; // Chemin du fichier sur le serveur

// Vérifier si le fichier existe sur le serveur
if (!file_exists($fichier)) {
    die("Le fichier n'existe pas sur le serveur.");
}

// Déterminer le type MIME du fichier
$mime = mime_content_type($fichier);

// Envoyer les en-têtes pour afficher le fichier dans le navigateur
header("Content-Type: $mime");
header("Content-Disposition: inline; filename=\"" . basename($fichier) . "\"");
readfile($fichier);
exit;
?>

