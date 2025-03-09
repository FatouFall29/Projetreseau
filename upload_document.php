<?php
// Activer l'affichage des erreurs
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'config.php';

// Définir le répertoire de destination FTP
$repertoire_ftp = "/home/ftpuser/ftp/";

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["fichier"])) {
    $titre = $_POST['titre'] ?? '';
    $categorie = $_POST['categorie'] ?? 'Autre';

    // Vérifier si un fichier a été uploadé sans erreur
    if ($_FILES["fichier"]["error"] === UPLOAD_ERR_OK) {
        $nom_fichier = basename($_FILES["fichier"]["name"]);
        $chemin_final = $repertoire_ftp . $nom_fichier;

        // Déplacer le fichier vers le dossier FTP
        if (move_uploaded_file($_FILES["fichier"]["tmp_name"], $chemin_final)) {
            // Donner les bonnes permissions au fichier
            chmod($chemin_final, 0644);
            chown($chemin_final, "ftpuser");
            chgrp($chemin_final, "ftpuser");

            // Insérer le fichier dans la base de données
            $sql = "INSERT INTO documents (titre, fichier, categorie) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $titre, $nom_fichier, $categorie);
            $stmt->execute();

            // ✅ Redirection vers liste_documents.php après succès
            header("Location: liste_documents.php");
            exit();
        } else {
            echo "<div class='alert alert-danger text-center'>Erreur lors du déplacement du fichier.</div>";
        }
    } else {
        echo "<div class='alert alert-danger text-center'>Aucun fichier sélectionné ou erreur d'upload.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uploader un Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="text-center">Uploader un Document</h2>
    <form method="POST" enctype="multipart/form-data" class="bg-white p-4 shadow-sm rounded">
        <div class="mb-3">
            <label class="form-label">Titre du Document :</label>
            <input type="text" name="titre" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Catégorie :</label>
            <input type="text" name="categorie" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Sélectionner un fichier :</label>
            <input type="file" name="fichier" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success w-100">Envoyer</button>
        <a href="liste_documents.php" class="btn btn-secondary w-100 mt-2">Retour</a>
    </form>
</div>
</body>
</html>

