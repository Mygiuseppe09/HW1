<?php
/**********************************************************************************************
        RITORNA il nome e il sesso degli utenti che hanno messo mi piace ad un POST
 *********************************************************************************************/

$conn = mysqli_connect("127.0.0.1", "root", "", "tripbook")
or die(mysqli_connect_error());

$users = array();

$postId = $_GET['id'];

$query = "select user from likes where post = '$postId'";

$res = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($res)) {
    $username = $row['user'];
    $query2 = "select Sesso from users where Username = '$username'";
    $gender = mysqli_fetch_assoc(mysqli_query($conn, $query2));

    $row['sesso'] = $gender['Sesso'];
    $users[] = $row;

}


mysqli_free_result($res);
mysqli_close($conn);

echo json_encode($users);

?>
