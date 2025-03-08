<?php
// Activer l'affichage des erreurs
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'config.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"] ?? '';
    $prenom = $_POST["prenom"] ?? '';
    $email = $_POST["email"] ?? '';
    $telephone = $_POST["telephone"] ?? '';
    $adresse = $_POST["adresse"] ?? '';
    $poste = $_POST["poste"] ?? '';
    $salaire = $_POST["salaire"] ?? '';
    $date_embauche = $_POST["date_embauche"] ?? '';
    $departement = $_POST["departement"] ?? '';


    // Vérifier si les champs obligatoires sont remplis
    if (!empty($nom) && !empty($prenom) && !empty($email)) {
        $sql = "INSERT INTO employes (nom, prenom, email, telephone, adresse, poste, salaire, date_embauche, departement) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssdss", $nom, $prenom, $email, $telephone, $adresse, $poste, $salaire, $date_embauche, $departement);
        if ($stmt->execute()) {
            echo "<div class='alert alert-success text-center'> Employé ajouté avec succès !</div>";
            header("Refresh: 2; URL=liste_employes.php"); // Redirection après 2 secondes
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
    <title>Ajouter un Employé</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            max-width: 800px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .form-label {
            font-weight: bold;
        }
        .form-control {
            border-radius: 5px;
            transition: 0.3s;
        }
        .form-control:focus {
            border-color: #28a745;
            box-shadow: 0px 0px 5px rgba(40, 167, 69, 0.5);
        }
        .btn-primary {
            background-color: #28a745;
            border: none;
        }
        .btn-primary:hover {
            background-color: #218838;
        }
        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="form-container">
        <h2 class="text-center">Ajouter un Employé</h2>
        <form method="POST">
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
                <label class="form-label">Adresse</label>
                <input type="text" name="adresse" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Poste</label>
                <input type="text" name="poste" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Salaire</label>
                <input type="number" step="0.01" name="salaire" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Date d'embauche</label>
                <input type="date" name="date_embauche" class="form-control">
            </div>
<div class="mb-3">
                <label class="form-label">Departement</label>
                <input type="text" name="departement" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary w-100">Ajouter</button>
            <a href="liste_employes.php" class="btn btn-secondary w-100 mt-2">Retour</a>
        </form>
    </div>
</div>

</body>
</html>

