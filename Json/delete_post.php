<?php
/**********************************************************************************************
                ELIMINA DAL DB UNA RIGA DALLA TABELLA posts e ne ritorna l'id
 *********************************************************************************************/

session_start();

$conn = mysqli_connect("127.0.0.1", "root", "", "tripbook")
or die(mysqli_connect_error());

$logged_username = $_SESSION['username'];
$postId = $_GET['id'];

$query = "delete from posts where user = '$logged_username' and id = '$postId'";

if(mysqli_query($conn, $query)) {
    //post eliminato correttamente
    echo json_encode(array(
            'deleted' => 'TRUE',
            'postId' => $postId
        )
    );
} else {
    echo json_encode(array(
            'deleted' => 'FALSE',
            'postId' => $postId
        )
    );
}

mysqli_close($conn);

?>
