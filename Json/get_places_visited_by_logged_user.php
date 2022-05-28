<?php
/**********************************************************************************************
                    RITORNA I LUOGHI VISITATI DALL'UTENTE LOGGATO
 *********************************************************************************************/

session_start();

$places = array();

$conn = mysqli_connect("127.0.0.1", "root", "", "tripbook")
or die(mysqli_connect_error());

$username = mysqli_real_escape_string($conn, $_SESSION["username"]);
$query = "select nome from places where id in (select place from visits where user = '$username')";
$res = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($res))
        $places[] = $row;

mysqli_free_result($res);
mysqli_close($conn);

echo json_encode($places);

?>
