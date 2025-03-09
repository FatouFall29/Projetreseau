<?php
include 'config.php';

if (!isset($_GET["id"]) || empty($_GET["id"])) {
    die("ID du document manquant.");
}

$id = $_GET["id"];

$sql = "DELETE FROM documents WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: liste_documents.php");
    exit();
} else {
    echo "Erreur lors de la suppression.";
}
?>
