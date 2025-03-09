<?php
define('FTP_SERVER', '192.168.1.3'); // Remplace par l'IP de ton serveur FTP
define('FTP_USER', 'ftpuser');
define('FTP_PASS', 'toufa2909'); // Mets ici ton mot de passe FTP
define('FTP_UPLOAD_DIR', '/home/ftpuser/ftp/'); // Dossier de stockage sur le serveur

$servername = "localhost";
$username = "iredadmin";  // Ton utilisateur MySQL
$password = "toufa2909";  // Ton mot de passe MySQL
$dbname = "smarttec";    // Nom de la base de données

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erreur de connexion à MySQL : " . $conn->connect_error);
}
?>
