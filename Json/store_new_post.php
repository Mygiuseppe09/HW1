<?php
/**********************************************************************************************
                    INSERISCE NEL DB UNA NUOVA RIGA NELLA TABELLA posts
                           PRIMA PERO' AGGIUNGE UNA RIGA IN places
 *********************************************************************************************/

session_start();

$conn = mysqli_connect("127.0.0.1", "root", "", "TripBook")
or die(mysqli_connect_error());

$place_id = $_GET['id'];
$place_name = $_GET['name'];
$username = $_SESSION['username'];

$query1 = "insert into places(id, nome) values ('$place_id','$place_name')";
$query2 = "insert into posts(user, place) values ('$username','$place_id')";
$query3 = "select * from places where id = '$place_id'";


if (mysqli_num_rows(mysqli_query($conn, $query3)) > 0) {
    // se il luogo è già stato "travasato" dal db RoadGoat a quello locale,
    // allora procediamo direttamente con la pubblicazione del post

    if (mysqli_query($conn, $query2)) {
        // il post è stato salvato
        echo json_encode(array(
                'is_post_stored' => 'TRUE'
            )
        );
    }
    else {
        // errore nell'inserimento del post
        echo json_encode(array(
                'is_post_stored' => 'FALSE'
            )
        );
    }
}
else {
    // altrimenti, salviamo il luogo e dopo procediamo alla pubblicazione del post
    if (mysqli_query($conn,$query1)) {
        //  il luogo è stato inserito correttamente nel db
        if (mysqli_query($conn, $query2)) {
            // il post è stato salvato
            echo json_encode(array(
                    'is_post_stored' => 'TRUE'
                )
            );
        }
        else {
            // errore nell'inserimento del post
            echo json_encode(array(
                    'is_post_stored' => 'FALSE'
                )
            );
        }
    }
    else {
        // errore nell'inserimento del luogo in locale
        echo json_encode(array(
                'is_post_stored' => 'FALSE'
            )
        );
    }
}

mysqli_close($conn);

?>
