<?php
include 'config.php';

// Vérifier si un ID est passé en paramètre
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID d'employé non spécifié.");
}

$id = intval($_GET['id']);

// Récupérer les infos de l'employé
$sql = "SELECT * FROM employes WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$employe = $result->fetch_assoc();

if (!$employe) {
    die("Employé introuvable.");
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $telephone = $_POST["telephone"];
    $adresse = $_POST["adresse"];
    $poste = $_POST["poste"];
    $salaire = $_POST["salaire"];
    $date_embauche = $_POST["date_embauche"];
    $departement = $_POST["departement"];
    $statut = $_POST["statut"];

    $sql = "UPDATE employes SET nom=?, prenom=?, email=?, telephone=?, adresse=?, poste=?, salaire=?, date_embauche=?, departement=?, statut=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssdsssi", $nom, $prenom, $email, $telephone, $adresse, $poste, $salaire, $date_embauche, $departement, $statut, $id);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success text-center'>Employé modifié avec succès !</div>";
        header("Refresh: 2; URL=liste_employes.php");
        exit();
    } else {
        echo "<div class='alert alert-danger text-center'>Erreur lors de la modification.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Employé</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center text-primary">Modifier un Employé</h2>
    
    <form method="POST" class="bg-white p-4 shadow-sm rounded">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Nom</label>
                <input type="text" name="nom" class="form-control" value="<?= $employe['nom'] ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Prénom</label>
                <input type="text" name="prenom" class="form-control" value="<?= $employe['prenom'] ?>" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="<?= $employe['email'] ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Téléphone</label>
                <input type="text" name="telephone" class="form-control" value="<?= $employe['telephone'] ?>">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Adresse</label>
            <input type="text" name="adresse" class="form-control" value="<?= $employe['adresse'] ?>">
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Poste</label>
                <input type="text" name="poste" class="form-control" value="<?= $employe['poste'] ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Salaire</label>
                <input type="number" step="0.01" name="salaire" class="form-control" value="<?= $employe['salaire'] ?>">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Date d'embauche</label>
                <input type="date" name="date_embauche" class="form-control" value="<?= $employe['date_embauche'] ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Département</label>
                <input type="text" name="departement" class="form-control" value="<?= $employe['departement'] ?>">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Statut</label>
            <select name="statut" class="form-control">
                <option value="Actif" <?= $employe['statut'] == "Actif" ? "selected" : "" ?>>Actif</option>
                <option value="En congé" <?= $employe['statut'] == "En congé" ? "selected" : "" ?>>En congé</option>
                <option value="Démissionnaire" <?= $employe['statut'] == "Démissionnaire" ? "selected" : "" ?>>Démissionnaire</option>
                <option value="Licencié" <?= $employe['statut'] == "Licencié" ? "selected" : "" ?>>Licencié</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary w-100">Modifier</button>
        <a href="liste_employes.php" class="btn btn-secondary w-100 mt-2">Annuler</a>
    </form>
</div>

</body>
</html>

