<?php
/**********************************************************************************************
            RITORNA I PRIMI 10 POST PRESENTI NEL DB (DAL PIU' RECENTE AL MENO RECENTE)
           n.b. Ritorna anche:
                - il nome del luogo associato al corrispondente ID
                - il sesso associato all'utente che l'ha postato (per stabilire l'avatar)
 *********************************************************************************************/

$posts = array();

$conn = mysqli_connect("127.0.0.1", "root", "", "tripbook")
or die(mysqli_connect_error());


$query = "select * from posts ORDER BY time DESC limit 10";
$res = mysqli_query($conn, $query);

if (mysqli_num_rows($res) > 0)
    // ci sono posts nel db
    while ($row = mysqli_fetch_assoc($res)) {

        $place_id =  $row['place'];
        $username = $row['user'];

        $query2 = "select nome from places where id = '$place_id'";
        $query3 = "select * from users where Username = '$username'";
        $res2 = mysqli_query($conn, $query2);
        $res3 = mysqli_query($conn, $query3);
        $place_row = mysqli_fetch_assoc($res2);
        $user_row = mysqli_fetch_assoc($res3);


        // aggiungiamo i nuovi campi a $row
        $row['name_place'] = $place_row['nome'];
        $row['user_gender'] = $user_row['Sesso'];


        $posts[] = $row;
    }

mysqli_free_result($res);
mysqli_close($conn);

echo json_encode($posts);

?>