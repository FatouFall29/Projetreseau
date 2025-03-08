<?php
include 'config.php';

// Vérifier si la connexion est bien établie
if (!isset($conn) || $conn === null) {
    die("Erreur : Connexion à la base de données échouée.");
}

$result = $conn->query("SELECT * FROM employes");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Employés</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>

<nav>
    <a href="index.php">Accueil</a>
    <a href="ajouter_employe.php">Ajouter un Employé</a>
</nav>

<div class="container mt-5">
    <h2 class="text-center">Liste des Employés</h2>

    <table class="table table-striped">
        <tr>
            <th>ID</th> 
            <th>Nom</th> 
            <th>Prénom</th> 
            <th>Email</th> 
            <th>Téléphone</th>
            <th>Adresse</th>
            <th>Poste</th>
            <th>Salaire</th>
            <th>Date d'embauche</th>
            <th>Département</th>
            <th>Statut</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row["id"] ?></td>
            <td><?= $row["nom"] ?></td>
            <td><?= $row["prenom"] ?></td>
            <td><?= $row["email"] ?></td>
            <td><?= $row["telephone"] ?></td>
            <td><?= $row["adresse"] ?></td>
            <td><?= $row["poste"] ?></td>
            <td><?= number_format($row["salaire"], 2) ?> €</td>
            <td><?= $row["date_embauche"] ?></td>
            <td><?= $row["departement"] ?></td>
            <td><?= $row["statut"] ?></td>
            <td>
    <a class="btn btn-warning btn-sm d-inline-flex align-items-center" href="modifier_employe.php?id=<?= $row["id"] ?>">
        <i class="fas fa-edit me-1"></i> 
    </a>
    <a class="btn btn-danger btn-sm d-inline-flex align-items-center" href="supprimer_employe.php?id=<?= $row["id"] ?>" 
       onclick="return confirm('Voulez-vous vraiment supprimer cet employé ?');">
        <i class="fas fa-trash-alt me-1"></i> 
    </a>
</td>

        </tr>
        <?php } ?>
    </table>
</div>

<footer>
    <p>&copy; 2025 SmartTech - Tous droits réservés.</p>
</footer>

</body>
</html>

