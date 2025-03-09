<?php
include 'config.php';

// Vérifier si l'ID du client est bien présent
if (!isset($_GET["id"]) || empty($_GET["id"])) {
    die("ID du client manquant.");
}

$id = $_GET["id"];

// Récupérer les informations actuelles du client
$sql = "SELECT * FROM clients WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$client = $result->fetch_assoc();

if (!$client) {
    die("Client introuvable.");
}

// Mettre à jour le client
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $telephone = $_POST["telephone"];
	 $adresse = $_POST["adresse"];
    $entreprise = $_POST["entreprise"];

    $sql = "UPDATE clients SET nom=?, prenom=?, email=?, telephone=?, adresse=?, entreprise=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $nom, $prenom, $email, $telephone, $adresse, $entreprise, $id);

    if ($stmt->execute()) {
        header("Location: liste_clients.php");
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
    <title>Modifier un Client</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center">Modifier un Client</h2>
    <form method="POST" class="bg-white p-4 shadow-sm rounded">
        <div class="mb-3">
            <label class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control" value="<?= $client['nom'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Prénom</label>
            <input type="text" name="prenom" class="form-control" value="<?= $client['prenom'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?= $client['email'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Téléphone</label>
            <input type="text" name="telephone" class="form-control" value="<?= $client['telephone'] ?>">
        </div>
 <div class="mb-3">
            <label class="form-label">adresse</label>
            <input type="text" name="adresse" class="form-control" value="<?= $client['entreprise'] ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Entreprise</label>
            <input type="text" name="entreprise" class="form-control" value="<?= $client['entreprise'] ?>">
        </div>
        <button type="submit" class="btn btn-success">Modifier</button>
        <a href="liste_clients.php" class="btn btn-secondary">Retour</a>
    </form>
</div>

</body>
</html>
