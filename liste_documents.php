<?php
include 'config.php';

// Vérifier la connexion MySQL
if (!$conn) {
    die("Erreur de connexion : " . mysqli_connect_error());
}

$result = $conn->query("SELECT * FROM documents");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Documents</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .btn {
            border-radius: 5px;
        }
        .table td, .table th {
            vertical-align: middle;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center">📂 Liste des Documents</h2>

    <a href="upload_document.php" class="btn btn-success mb-3">
        ➕ Ajouter un Document
    </a>

    <table class="table table-bordered table-striped text-center">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Type</th>
                <th>Date d'ajout</th>
                <th>Fichier</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row["id"] ?></td>
                <td><?= $row["titre"] ?></td>
                <td><?= $row["categorie"] ?></td>
                <td><?= $row["uploaded_at"] ?></td>
                <td>
                    <a href="voir_document.php?id=<?= $row["id"] ?>" class="btn btn-info btn-sm">
                        📄 Voir Fichier
                    </a>
                </td>
                <td>
                    <a class="btn btn-warning btn-sm" href="modifier_document.php?id=<?= $row["id"] ?>">
                        ✏️ Modifier
                    </a>
                    <a class="btn btn-danger btn-sm" href="supprimer_document.php?id=<?= $row["id"] ?>" 
                       onclick="return confirm('Supprimer ce document ?');">
                        🗑 Supprimer
                    </a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="index.php" class="btn btn-secondary">🏠 Retour à l'Accueil</a>
</div>

</body>
</html>
       
