<?php
/**********************************************************************************************
                RITORNA GLI UTENTI CHE HANNO VISITATO UN LUOGO PASSATO COME 'GET'
                                ESCLUDENDO PERO' L'UTENTE LOGGATO
 *********************************************************************************************/
session_start();

$users = array();

$conn = mysqli_connect("127.0.0.1", "root", "", "tripbook")
or die(mysqli_connect_error());

$place = mysqli_real_escape_string($conn, $_GET["city"]);
$place_complete = $place . '%';
$logged_username = $_SESSION['username'];
$query = "select distinct user from visits where place = 
                    (select id from places where nome like '$place_complete') and user != '$logged_username'";
$res = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($res))
    $users[] = $row;

mysqli_free_result($res);
mysqli_close($conn);

echo json_encode($users);

?>

