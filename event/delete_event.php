<?php
// Connessione al database
include("../database_connetion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_event'])) {
    $evento_id = $_POST['evento_id'];

    // Query SQL per cancellare l'evento
    $query = "DELETE FROM eventi WHERE id = $evento_id";

    // Esegui la query e gestisci gli errori
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die('Errore nella cancellazione: ' . mysqli_error($conn));
    }

    // Reindirizza l'utente alla pagina di visualizzazione degli eventi o a una pagina di conferma
    header("Location: ../home.php"); // Modifica il percorso a seconda delle tue esigenze
    exit();
}
?>