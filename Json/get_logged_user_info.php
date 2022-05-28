<?php
/**********************************************************************************************
RITORNA USERNAME, NOME, COGNOME, SESSO, MAIL DELL'UTENTE LOGGATO + N° POST E N° LUOGHI VISITATI
 *********************************************************************************************/

session_start();

$conn = mysqli_connect("127.0.0.1", "root", "", "tripbook")
or die(mysqli_connect_error());

$username = mysqli_real_escape_string($conn, $_SESSION["username"]);
$query = "select * from users where Username = '$username'";
$query2 = "select count(distinct place) as luoghi_visitati from visits where user = '$username'";
$res = mysqli_query($conn, $query);
$res2 = mysqli_query($conn, $query2);
$row = mysqli_fetch_assoc($res);
$row2 = mysqli_fetch_assoc($res2);

mysqli_free_result($res);
mysqli_free_result($res2);
mysqli_close($conn);

echo json_encode(array(
    'Username' => $row['Username'],
    'Nome' => $row['Nome'],
    'Cognome' => $row['Cognome'],
    'Sesso' => $row['Sesso'],
    'Mail' => $row['Mail'],
    'nposts' => $row['nposts'],
    'numero_luoghi_visitati' => $row2['luoghi_visitati']
));

?>
