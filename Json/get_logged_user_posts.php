<?php
/**********************************************************************************************
RITORNA TUTTI I POST PRESENTI NEL DB PUBBLICATI DALL'UTENTE (DAL PIU' RECENTE AL MENO RECENTE)
n.b. Ritorna anche il NOME del luogo associato al corrispondente ID
 *********************************************************************************************/

$conn = mysqli_connect("127.0.0.1", "root", "", "tripbook")
or die(mysqli_connect_error());

session_start();

$posts = array();

$logged_user = $_SESSION['username'];
$query = "select * from posts where user = '$logged_user' ORDER BY time DESC ";
$res = mysqli_query($conn, $query);

if (mysqli_num_rows($res) > 0)
    // ci sono posts nel db
    while ($row = mysqli_fetch_assoc($res)) {

        $place_id =  $row['place'];
        $query2 = "select nome from places where id = '$place_id'";
        $place_row = mysqli_fetch_assoc(mysqli_query($conn, $query2));

        // aggiungiamo il nuovo campo a $row
        $row['name_place'] = $place_row['nome'];

        $posts[] = $row;
    }

mysqli_free_result($res);
mysqli_close($conn);

echo json_encode($posts);

/*
 * esempio output json
{
    "id":"31",
    "user":"Mygiuseppe09",
    "time":"2022-05-26 11:31:04",
    "nlikes":"2",
    "place":"10626288",
    "name_place":"Miami, FL"
}
 */
?>
