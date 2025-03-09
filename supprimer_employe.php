<?php
include 'config.php';

// Vérifier si un ID est passé en paramètre
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID d'employé non spécifié.");
}

$id = intval($_GET['id']);

// Préparer la requête de suppression
$sql = "DELETE FROM employes WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "<div class='alert alert-success text-center'>Employé supprimé avec succès !</div>";
    header("Refresh: 2; URL=liste_employes.php"); // Redirige vers la liste après 2 secondes
    exit();
} else {
    echo "<div class='alert alert-danger text-center'>Erreur lors de la suppression.</div>";
}

$stmt->close();
$conn->close();
?>
