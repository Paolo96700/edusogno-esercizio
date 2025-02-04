<?php

$token = $_POST["token"];

$token_hash = hash("sha256", $token);

$mysqli = require __DIR__ . "/database_connetion.php";

$sql = "SELECT * FROM utenti
        WHERE reset_token_hash = ?";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("s", $token_hash);

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

if ($user === null) {
    die("token non trovato");
}

if (strtotime($user["reset_token_expires_at"]) <= time()) {
    die ("Il token è scaduto");
}


$password_hash = $_POST["password"];

$sql = "UPDATE utenti
        SET password = ?,
            reset_token_hash = NULL,
            reset_token_expires_at = NULL
        WHERE id = ?";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("ss", $password_hash, $user["id"]);

$stmt->execute();

echo 'Password aggiornata. Puoi tornare al <a href="index.php"><button>Torna al Login</button></a>.';