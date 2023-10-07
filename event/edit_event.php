


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/styles/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../assets/styles/event.css?v=<?php echo time(); ?>">
</head>

<body>
<?php

include("../database_connetion.php");
?>
<div class="container">
    <div class="container_form">
    <h2 class="title_event_form">Modifica evento</h2>
        <?php
        // Assicurati di avere l'ID dell'evento disponibile
        if (isset($_GET['evento_id'])) {
            $evento_id = $_GET['evento_id'];
            
            // Esegui la query per selezionare l'evento specifico
            $query = "SELECT * FROM eventi WHERE id = $evento_id";

            // Esegui la query e gestisci gli errori
            $result = mysqli_query($conn, $query);
            if (!$result) {
                die('Errore nella query: ' . mysqli_error($conn));
            }

            // Verifica se ci sono risultati e mostra i dettagli dell'evento
            if (mysqli_num_rows($result) > 0) { 
                $row = mysqli_fetch_assoc($result);?>
                
                <form method="post" action="edit_event-logic.php" class="form_style">
                    <input type="hidden" name="evento_id" value="<?php echo $row['id']; ?>">
                    <label for="nome_evento" class="write_event">Nome dell'evento:</label>
                    <input type="text" name="nome_evento" id="nome_evento" value="<?php echo $row['nome_evento']; ?>" required>

                    <label for="data_evento" class="write_event">Data dell'evento:</label>
                    <?php
                        // Estrai la data dalla colonna 'data_evento'
                        $data_evento = $row['data_evento'];

                        // Converti la data nel formato desiderato (ad esempio, 'Y-m-d' per 'anno-mese-giorno')
                        $formatted_date = date('Y-m-d', strtotime($data_evento));
                    ?>
                    
                    <input type="date" name="data_evento" id="data_evento" value="<?php echo $formatted_date; ?>" required>
                    <?php
                        // Estrai l'orario dalla colonna 'data_evento'
                        $data_evento = $row['data_evento'];

                        // Converti la data in formato DateTime
                        $date = new DateTime($data_evento);

                        // Estrai l'orario dal formato DateTime
                        $orario_evento = $date->format('H:i');
                    ?>

                    <label for="orario_evento" class="write_event">Orario dell'evento:</label>
                    <input type="time" name="orario_evento" id="orario_evento" value="<?php echo $orario_evento; ?>" required>

                
                    <button type="submit">Modifica evento</button>
                </form>
            <?php
            } else {
                // Messaggio se l'evento specificato non è stato trovato
                echo 'L\'evento specificato non è stato trovato.';
            }

        
        } else {
            // Messaggio se l'ID dell'evento non è stato specificato
            echo 'ID dell\'evento non specificato.';
        }
        ?>
    </div>
</div>






</body>
</html>