<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre = $_POST["titre"];
    $categorie = $_POST["categorie"];
    $uploaded_at = date("Y-m-d H:i:s");

    // Vérifier si un fichier a été uploadé
    if (!empty($_FILES["fichier"]["name"])) {
        $dossier_upload = "uploads/";
        if (!is_dir($dossier_upload)) {
            mkdir($dossier_upload, 0777, true);
        }

        $nom_fichier = basename($_FILES["fichier"]["name"]);
        $chemin_fichier = $dossier_upload . $nom_fichier;

        if (move_uploaded_file($_FILES["fichier"]["tmp_name"], $chemin_fichier)) {
            $sql = "INSERT INTO documents (titre, fichier, categorie, uploaded_at) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $titre, $chemin_fichier, $categorie, $uploaded_at);

            if ($stmt->execute()) {
                header("Location: liste_documents.php");
                exit();
            } else {
                echo "Erreur : " . $stmt->error;
            }
        } else {
            echo "Erreur lors du téléchargement du fichier.";
        }
    } else {
        echo "Veuillez sélectionner un fichier.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center">Ajouter un Document</h2>
    <form method="POST" enctype="multipart/form-data" class="bg-white p-4 shadow-sm rounded">
        <div class="mb-3">
            <label class="form-label">Titre du Document</label>
            <input type="text" name="titre" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Catégorie</label>
            <input type="text" name="categorie" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Fichier</label>
            <input type="file" name="fichier" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Ajouter</button>
        <a href="liste_documents.php" class="btn btn-secondary">Retour</a>
    </form>
</div>

</body>
</html>

