<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['nome']) && isset($_SESSION['cognome'])) {
    // Connessione al database
    include "../database_connetion.php";

    // Recupero dell'indirizzo email dell'utente dalla sessione
    $email = $_SESSION['email'];

    // Verifica se il modulo è stato inviato
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Recupera i dati inviati dal modulo
        $nome_evento = $_POST['nome_evento'];
        // Recupera data nel formato "YYYY-MM-DD"
        $data_evento = $_POST['data_evento']; 
        // Recupera orario nel formato "HH:MM"
        $orario_evento = $_POST['orario_evento']; 

        // Combina la data e l'orario nel formato DATETIME
        $data_ora_evento = "$data_evento $orario_evento:00"; 

        // Esegui la query per inserire l'evento nel database utilizzando il valore combinato
        $query = "INSERT INTO eventi (attendees, nome_evento, data_evento) VALUES ('$email', '$nome_evento', '$data_ora_evento')";
        $result = mysqli_query($conn, $query);

        if ($result) {  
            header('Location: ../home.php');
            exit;
        } else {
            // Messaggio di errore
            echo 'Si è verificato un errore durante la creazione dell\'evento.';
        }
    }
} else {
    // Reindirizza l'utente alla pagina di login se non è autenticato
    header('Location: ../login.php');
    exit;
}
?>