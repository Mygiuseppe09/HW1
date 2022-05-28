<?php
// non avendo specificato alcun "action" sul form (method: POST), i dati ritornano alla stessa pagina

// prima di far compilare i campi all'utente... vediamo se c'è una sessione
// perchè se cosi fosse non dovrebbe essere qui
session_start();
if (isset($_SESSION["username"])) {
    header("Location: home.php");
    exit;
}

$error = array();

// controlliamo che i campi del form non siano nulli
if (isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["gender"])
    && isset($_POST["birthday"]) && isset($_POST["username"]) && isset($_POST["email"])
            && isset($_POST["password"]))
{
    // stabiliamo una connessione col database
    $conn = mysqli_connect("127.0.0.1", "root", "", "tripbook")
    or die(mysqli_connect_error());

    /****************************************************
          FACCIAMO DEI CONTROLLI PIU' SPECIFICI SU:
     * USERNAME => lunghezza, già in uso
     * MAIL => formato, già in uso
     * PASSWORD => lunghezza, corrispondenza con la conferma
     * SESSO => campo non specificato
     *****************************************************/

    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    if (strlen($username) < 8)
        $error[] = "username troppo corto: lunghezza minima 8 caratteri";
    else {
        // controlliamo se l'username è già presente nel database
        $query = "SELECT username FROM users WHERE username = '$username'";
        $res = mysqli_query($conn, $query);
        if (mysqli_num_rows($res) > 0)
            $error[] = "il nome utente risulta gia' iscritto";
    }

    $email =  mysqli_real_escape_string($conn, $_POST["email"]);
    $query = "SELECT Mail FROM users WHERE Mail = '$email'";
    if (!filter_var($email,FILTER_VALIDATE_EMAIL))
        $error[] = "email non valida";
    if (mysqli_num_rows(mysqli_query($conn,$query)) > 0)
        $error[] = "l'email risulta presente nel database";

    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    if ($password != $_POST["check_password"])
        $error[] = "le password non coincidono";
    if (strlen($_POST["password"]) < 8)
        $error[] = "Caratteri password insufficienti";

    if (empty($_POST['gender']))
        $error[] = "Sesso non specificato";


    // salviamo i dati sul database se non ci sono stati problemi durante le validazioni
    if (count($error) == 0) {
        $name = mysqli_real_escape_string($conn, $_POST["name"]);
        $surname = mysqli_real_escape_string($conn, $_POST["surname"]);
        $birthday = $_POST["birthday"];
        $gender = $_POST["gender"];

        $query = "INSERT INTO users(Username,Nome,Cognome,DataDiNascita,Sesso,Mail,Password) 
                        VALUES ('$username','$name','$surname','$birthday','$gender','$email','$password')";

        if (mysqli_query($conn, $query)) {
            // se la query va bene
            $_SESSION["username"] = $username;
            header("Location: home.php");
            mysqli_close($conn);
            exit;
        }
    }
    else {
        echo "<div class='error'>";
        echo    "<h3>SI SONO VERIFICATI I SEGUENTI ERRORI:</h3>";
        echo    "<ul>";
            for ($x = 0; $x < count($error); $x++)
                echo "<li>" . $error[$x] . "</li>";
        echo    "</ul>";
        echo    "<h4>Inserisci i nuovamente i campi in modo corretto e riprova</h4>";
        echo "</div>";
    }
}
// se invece uno dei campi è vuoto (e se è stato inviato il form => almeno uno dei campi $_POST è 'pieno')
else if (isset($_POST["name"]) || isset($_POST["surname"]) || isset($_POST["gender"])
    || isset($_POST["birthday"]) || isset($_POST["username"]) || isset($_POST["email"])
    || isset($_POST["password"]))
{
    echo "<div class='error'>";
    echo    "<h3>SI SONO VERIFICATI I SEGUENTI ERRORI:</h3>";
    echo    "<ul>";
    echo        "<li> Non hai inserito almeno uno dei campi </li>";
    echo    "</ul>";
    echo    "<h4>Inseriscili tutti e riprova</h4>";
    echo "</div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>TripBook - Registrati</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles/common-styles.css">
    <link rel="stylesheet" href="styles/signup.css">
    <script src="JS/signup.js" defer></script>
    <!-- FONT: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<body>

<div id="errorBox"></div>

<h1>Registrati a TripBook</h1>

<div class="signup_container">

    <div class="form_container">

        <form id="formSignup" method="post">
            <label for="inSignUpName"><input placeholder="nome" type="text" name="name" id="inSignUpName"></label>
            <label for="inSignUpSurname"><input placeholder="cognome" type="text" name="surname" id="inSignUpSurname"></label>
            <div class="input_radio_container">
                <label for=inSignUpSexMale""><input type="radio" name="gender" id="inSignUpSexMale" value="M">Maschio</label>
                <label for="inSignUpSexFemale"><input type="radio" name="gender" id="inSignUpSexFemale" value="F">Femmina</label>
            </div>
            <label for="inSignUpBirthday"><input type="date" name="birthday" id="inSignUpBirthday"></label>
            <label for="inSignUpUsername"><input placeholder="username" type="text" name="username" id="inSignUpUsername"></label>
            <label for="inSignUpemail"><input placeholder="email" type="email" name="email" id="inSignUpemail"></label>
            <label for="inSignUpPassword"><input placeholder="password" type="password" name="password" id="inSignUpPassword"></label>
            <label for="inSignUpCheckPassword"><input placeholder="digita nuovamente la password" type="password" name="check_password" id="inSignUpCheckPassword"></label>
            <input id="submitButton" class="button submit_button" type="submit" value="REGISTRATI">
        </form>
    </div>
</div>



</body>
</html>






