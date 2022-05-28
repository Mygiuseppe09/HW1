<?php
/**********************************************************************************************
 RITORNA VERO SE ESISTE UN MI PIACE AD UN POST DA PARTE DELL'UTENTE LOGGATO, FALSO ALTRIMENTI.
                  restituisce anche l'id del post controllato
 *********************************************************************************************/

session_start();

$conn = mysqli_connect("127.0.0.1", "root", "", "tripbook")
or die(mysqli_connect_error());


$logged_username = $_SESSION['username'];
$postId = $_GET['id'];
$query = "select * from likes where user = '$logged_username' and post = $postId";
if (mysqli_num_rows(mysqli_query($conn, $query)) > 0) {
    // il like c'è già
    echo json_encode(array(
            'is_liked' => 'TRUE',
            'postId' => $postId
        )
    );
}
else {
    // bisogna mettere like
    echo json_encode(array(
            'is_liked' => 'FALSE',
            'postId' => $postId
        )
    );
}

mysqli_close($conn);

?>
