<?php
// vediamo se c'è già una sessione attiva
session_start();
if (isset($_SESSION["username"])) {
    header("Location: home.php");
    exit;
}

$error = array();


if (isset($_POST["username"]) && isset($_POST["password"]))
{
    $conn = mysqli_connect("127.0.0.1", "root", "", "tripbook")
    or die(mysqli_connect_error());

    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    $query = "SELECT * FROM users WHERE Username = '$username'";

    if (mysqli_num_rows(mysqli_query($conn, $query)) > 0) {
        // allora l'utente è già registrato... vediamo se ricorda la password
        $user = mysqli_fetch_assoc(mysqli_query($conn, $query));

        if ($_POST["password"] !== $user["Password"]) {
            // password non corretta
            $error[] = "Password non corretta";
        }
    }
    else {
        // nome utente non corretto
        $error[] = "Nome utente non corretto";
    }

    if (count($error) == 0) {
        $_SESSION["username"] = $username;
        header("Location: home.php");
        mysqli_close($conn);
        exit;
        }
        else {
            // ci sono stati errori, mostriamoli
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
    else if (isset($_POST["username"]) || isset($_POST["password"]))
    // se invece è stato inviato il form con uno dei campi vuoto
    {
        echo "<div class='error'>";
        echo    "<h3>SI SONO VERIFICATI I SEGUENTI ERRORI:</h3>";
        echo    "<ul>";
        echo        "<li> Non hai inserito uno dei campi </li>";
        echo    "</ul>";
        echo    "<h4>Inseriscili tutti e riprova</h4>";
        echo "</div>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>TripBook - Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles/common-styles.css">
    <link rel="stylesheet" href="styles/login.css">
    <!-- FONT: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<body>
    <h1>Accedi a TripBook</h1>

    <div class="login_container">

        <div class="video_intro_container">
            <video autoplay muted loop>
                <source src="assets/videos/intro.mp4" type="video/mp4"/>
            </video>
        </div>

        <div class="form_container">
            <form method="post">
                <div><label for="inLoginUsername"><input placeholder="nome utente" type="text" name="username" id="inLoginUsername"></label></div>
                <div><label for="inLoginPassword"><input placeholder="password" type="password" name="password" id="inLoginPassword"></label></div>
                <input class="button submit_button" type="submit" value="ACCEDI">
            </form>
        </div>
    </div>
    <p> Non hai ancora un account? <a id="signup_button" class="button" href="signup.php">Registrati</a></p>


</body>
</html>


