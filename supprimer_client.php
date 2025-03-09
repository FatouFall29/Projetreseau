<?php
include 'config.php';

// Vérifier si l'ID est présent
if (!isset($_GET["id"]) || empty($_GET["id"])) {
    die("ID du client manquant.");
}

$id = $_GET["id"];

// Supprimer le client
$sql = "DELETE FROM clients WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: liste_clients.php");
    exit();
} else {
    echo "Erreur lors de la suppression.";
}
?>
