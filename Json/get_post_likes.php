<?php
/**********************************************************************************************
                        RITORNA nlikes di un POST ed il suo id
 *********************************************************************************************/

$conn = mysqli_connect("127.0.0.1", "root", "", "tripbook")
or die(mysqli_connect_error());

$postId = $_GET['id'];
$query = "select nlikes from posts where id = '$postId'";
$res = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($res);

mysqli_free_result($res);
mysqli_close($conn);

echo json_encode(array(
    'nlikes' => $row['nlikes'],
    'postId' => $postId
));

?>
