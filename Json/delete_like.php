<?php
/**********************************************************************************************
  ELIMINA DAL DB UNA RIGA DALLA TABELLA likes e ritorna l'id del post su cui è stato tolto
 *********************************************************************************************/

session_start();

$conn = mysqli_connect("127.0.0.1", "root", "", "tripbook")
or die(mysqli_connect_error());

$logged_username = $_SESSION['username'];
$postId = $_GET['id'];

$query = "delete from likes where user = '$logged_username' and post = '$postId'";

mysqli_close($conn);

echo json_encode(array(
        'postId' => $postId
    )
);

?>
