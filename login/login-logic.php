
<?php
session_start();
include "../database_connetion.php";
if (isset($_POST['email']) && isset($_POST['password'])){
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $email = validate($_POST['email']);
    $password = validate($_POST['password']);

    if (empty($email)) {
        header("Location: index.php?error=email is required");
        exit();
    }else if (empty($password)){
        header("Location: index.php?error=password is required");
        exit();
    }else{
        //Hashing password
        // $password = md5($password);
        
        $sql = "SELECT * FROM utenti WHERE email= '$email' AND password='$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['email'] === $email && $row['password'] === $password) {
                $_SESSION['email']       = $row['email'];
                $_SESSION['password']    = $row['password'];
                $_SESSION['nome']        = $row['nome'];
                $_SESSION['cognome']     = $row['cognome'];
                $_SESSION['id']          = $row['id'];
                header("Location: ../home.php");
                exit();
            }
            else{
                header("Location: ../index.php?error=Email o password errata");
                exit();
            }
        }
        else{
            header("Location: ../index.php?error=Email o password errata");
            exit();
        }
    }
}else{
    // Dopo aver verificato con successo le credenziali dell'utente - per eventi sulla home
    $_SESSION['email'] = $email;

    header("Location: ../index.php?error");
    exit();
}