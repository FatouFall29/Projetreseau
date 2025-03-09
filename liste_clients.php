<?php
include 'config.php';

// Vérifier la connexion MySQL
if (!$conn) {
    die("Erreur de connexion : " . mysqli_connect_error());
}

$result = $conn->query("SELECT * FROM clients");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Clients</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center">Liste des Clients</h2>
    
    <a href="ajouter_client.php" class="btn btn-success mb-3">Ajouter un Client</a>
	<a href="index.php" class="btn btn-success mb-3"> Retour à l'accueil</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Adresse</th>
                <th>Entreprise</th>
                <th>Date de Création</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row["id"] ?></td>
                <td><?= $row["nom"] ?></td>
                <td><?= $row["prenom"] ?></td>
                <td><?= $row["email"] ?></td>
                <td><?= $row["telephone"] ?></td>
                <td><?= $row["adresse"] ?></td>
                <td><?= $row["entreprise"] ?></td>
                <td><?= $row["created_at"] ?></td>
                            <td>
    <a class="btn btn-warning btn-sm d-inline-flex align-items-center" href="modifier_client.php?id=<?= $row["id"] ?>">
        <i class="fas fa-edit me-1"></i> 
    </a>
    <a class="btn btn-danger btn-sm d-inline-flex align-items-center" href="supprimer_client.php?id=<?= $row["id"] ?>" 
       onclick="return confirm('Voulez-vous vraiment supprimer ce client ?');">
        <i class="fas fa-trash-alt me-1"></i> 
    </a>
</td>


            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>

