<?php
include 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - SmartTech</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container text-center mt-5">
    <h1 class="mb-4">Bienvenue sur SmartTech</h1>
    <p class="lead">Plateforme de gestion des employés, clients et documents.</p>

    <!-- Boutons en dessous avec couleur verte -->
    <div class="d-grid gap-3 col-6 mx-auto mt-4">
        <a href="liste_employes.php" class="btn btn-success btn-lg">Gestion des Employés</a>
        <a href="liste_clients.php" class="btn btn-success btn-lg">Gestion des Clients</a>
        <a href="liste_documents.php" class="btn btn-success btn-lg">Gestion des Documents</a>
    </div>
</div>

<footer class="bg-dark text-white text-center py-3 mt-5">
    &copy; 2025 SmartTech - Tous droits réservés.
</footer>

</body>
</html>

