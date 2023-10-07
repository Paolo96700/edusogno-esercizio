
<?php
session_start();
include "../database_connetion.php";
if (isset($_POST['nome']) && isset($_POST['cognome']) && isset($_POST['email']) && isset($_POST['password'])){
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $nome       = validate($_POST['nome']);
    $cognome    = validate($_POST['cognome']);
    $email      = validate($_POST['email']);
    $password   = validate($_POST['password']);

    $user_data = 'email' . $email. '&nome=' . $nome. '&cognome=' . $cognome;


    if (empty($nome)) {
        header("Location: ../register.php?error= Il nome è richiesto&$user_data");
        exit();
    }else if (empty($cognome)){
        header("Location: ../register.php?error=Il cognome è richiesto&$user_data");
        exit();
    }else if (empty($email)) {
        header("Location: ../register.php?error=l'email è richiesta&$user_data");
        exit();
    }else if (empty($password)){
        header("Location: ../register.php?error=La password è richiesta&$user_data");
        exit();
    }else{
        //Hashing password
        // $password = md5($password);

        $sql = "SELECT * FROM utenti WHERE nome= '$nome'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
             // Il nome esiste già nel database, restituisci un errore
            header("Location: ../register.php?error= Il nome è già presente nel database&$user_data");
            exit();
        }else{
            $sql2 = "INSERT INTO utenti(nome, cognome, email, password) VALUES('$nome', '$cognome', '$email', '$password')";
            $result2 = mysqli_query($conn, $sql2);
            if($result2){
                 // Salva le informazioni dell'utente nella sessione
                    $_SESSION['id'] = mysqli_insert_id($conn); // L'id potrebbe essere utile in futuro
                    $_SESSION['nome'] = $nome;
                    $_SESSION['cognome'] = $cognome;
                    $_SESSION['email'] = $email; 

                    // Reindirizza l'utente alla pagina home.php
                    header("Location: ../home.php");
            }else{
                header("Location: ../register.php?error= Assicurati di aver compilato tutti i campi&$user_data");
                exit();
            }
           
        }
    }
}else{
    header("Location: ../register.php");
    exit();
}