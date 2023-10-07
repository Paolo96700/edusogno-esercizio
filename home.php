<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['nome']) && isset($_SESSION['cognome']))

// Connessione al database 
include "database_connetion.php";


// Recupero dell'indirizzo email dell'utente dalla sessione
$email = $_SESSION['email'];

 // Query per recuperare gli eventi associati all'indirizzo email dell'utente
 $query = "SELECT * FROM eventi WHERE attendees LIKE '%$email%'";
 $result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="assets/styles/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/styles/home.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php
    include "header.php";
    ?>

    <div class="container">
        

        <div>
            <h1>Ciao 
                <span class="title">
                    <?php echo $_SESSION['nome']; ?>
                    <?php echo $_SESSION['cognome']; ?>
                </span>
                ecco i tuoi eventi
            </h1>
        </div>
        <div class="cont_button_event">
            <button class="button_event">
                <a href="./event/create_event.php" class="link_button">CREA UN NUOVO EVENTO</a>
            </button>
        </div>
        
        <div class="container_event">
            
            
            <?php
            // In questa parte, verranno visualizzati gli eventi recuperati dal database
            if (mysqli_num_rows($result) > 0) {    
                // Ciclo attraverso gli eventi e li mostro
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="event">
                    <div class="form_event">
                        
                        <div class="title_event">
                            <?php echo $row['nome_evento']; ?>
                        </div>
                        <div class="date_event">
                        <?php
                            $data_evento = $row['data_evento'];
                            $orario = date("Y-m-d H:i", strtotime($data_evento));
                            echo $orario;
                        ?>
                        </div>
                        
                        <div class="container_button">
                            <button class="button_event">
                                <a class="link_button" href="./event/edit_event.php?evento_id=<?php echo $row['id']; ?>">MODIFICA EVENTO</a>
                            </button>
                            <form method="post" action="./event/delete_event.php">
                                <input 
                                    type="hidden" 
                                    name="evento_id" 
                                    value="<?php echo $row['id']; ?>"
                                >
                                <button 
                                    type="submit" 
                                    name="delete_event" 
                                    class="button_event"
                                >
                                    CANCELLA EVENTO
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                
                
                <?php
                }
            } else {
                // Messaggio se non ci sono eventi associati all'utente
                echo 'Nessun evento associato al tuo account.';
            }
            ?>
            
        </div>
        
    </div>

    
    
</body>