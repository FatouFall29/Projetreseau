<?php
// Activer l'affichage des erreurs
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'config.php';

// Vérifier la connexion MySQL
if (!$conn) {
    die("Erreur de connexion MySQL : " . mysqli_connect_error());
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"] ?? '';
    $prenom = $_POST["prenom"] ?? '';
    $email = $_POST["email"] ?? '';
    $telephone = $_POST["telephone"] ?? '';
    $adresse = $_POST["adresse"] ?? '';
    $entreprise = $_POST["entreprise"] ?? '';

    // Vérifier si les champs obligatoires sont remplis
    if (!empty($nom) && !empty($prenom) && !empty($email)) {
        $sql = "INSERT INTO clients (nom, prenom, email, telephone, adresse, entreprise) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $nom, $prenom, $email, $telephone, $adresse, $entreprise);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success text-center'> Client ajouté avec succès ! Redirection en cours...</div>";
            header("Refresh: 2; URL=liste_clients.php"); // Redirection après 2 secondes
            exit();
        } else {
            echo "<div class='alert alert-danger text-center'> Erreur SQL : " . $stmt->error . "</div>";
        }
    } else {
        echo "<div class='alert alert-warning text-center'>Tous les champs obligatoires doivent être remplis.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Client</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center">Ajouter un Client</h2>
    <form method="POST" class="bg-white p-4 shadow-sm rounded">
        <div class="mb-3">
            <label class="form-label">Nom <span class="text-danger">*</span></label>
            <input type="text" name="nom" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Prénom <span class="text-danger">*</span></label>
            <input type="text" name="prenom" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email <span class="text-danger">*</span></label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Téléphone</label>
            <input type="text" name="telephone" class="form-control">
        </div>
<div class="mb-3">
            <label class="form-label">adresse</label>
            <input type="text" name="adresse" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Entreprise</label>
            <input type="text" name="entreprise" class="form-control">
        </div>
        <button type="submit" class="btn btn-success w-100">Ajouter</button>
        <a href="liste_clients.php" class="btn btn-secondary w-100 mt-2">Retour</a>
    </form>
</div>

</body>
</html>
