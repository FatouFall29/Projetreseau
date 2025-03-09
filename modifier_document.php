<?php
include 'config.php';

if (!isset($_GET["id"]) || empty($_GET["id"])) {
    die("ID du document manquant.");
}

$id = $_GET["id"];

$sql = "SELECT * FROM documents WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$document = $result->fetch_assoc();

if (!$document) {
    die("Document introuvable.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre = $_POST["titre"];
    $categorie = $_POST["categorie"];

    $sql = "UPDATE documents SET titre=?, categorie=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $titre, $categorie, $id);

    if ($stmt->execute()) {
        header("Location: liste_documents.php");
        exit();
    } else {
        echo "Erreur lors de la mise à jour.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center">Modifier un Document</h2>
    <form method="POST" class="bg-white p-4 shadow-sm rounded">
        <div class="mb-3">
            <label class="form-label">Titre</label>
            <input type="text" name="titre" class="form-control" value="<?= $document['titre'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Catégorie</label>
            <input type="text" name="categorie" class="form-control" value="<?= $document['categorie'] ?>">
        </div>
        <button type="submit" class="btn btn-success">Modifier</button>
        <a href="liste_documents.php" class="btn btn-secondary">Retour</a>
    </form>
</div>

</body>
</html>
