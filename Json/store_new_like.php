<?php
/**********************************************************************************************
   INSERISCE NEL DB UNA NUOVA RIGA TABELLA likes e ritorna l'id del post su cui è stato messo
 *********************************************************************************************/

session_start();

$conn = mysqli_connect("127.0.0.1", "root", "", "tripbook")
or die(mysqli_connect_error());

$logged_username = $_SESSION['username'];
$postId = $_GET['id'];

$query = "insert into likes(user,post) values ('$logged_username', '$postId')";
$res = mysqli_query($conn, $query);


mysqli_close($conn);

echo json_encode(array(
        'postId' => $postId
    )
);

?>
