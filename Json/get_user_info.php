<?php
/**********************************************************************************************
RITORNA USERNAME, NOME, COGNOME, SESSO, MAIL DELL'UTENTE DI CUI E' PASSATO L'USERNAME ('GET')
 *********************************************************************************************/

$conn = mysqli_connect("127.0.0.1", "root", "", "tripbook")
or die(mysqli_connect_error());

$username = $_GET['username'];
$query = "select * from users where Username = '$username'";
$res = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($res);

mysqli_free_result($res);
mysqli_close($conn);

echo json_encode(array(
    'Username' => $row['Username'],
    'Nome' => $row['Nome'],
    'Cognome' => $row['Cognome'],
    'Sesso' => $row['Sesso'],
    'Mail' => $row['Mail'],
));

?>