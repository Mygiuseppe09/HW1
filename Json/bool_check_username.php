<?php
/**********************************************************************************************
        RITORNA VERO SE ESISTE UN USERNAME nel DB (passato come get), FALSO ALTRIMENTI.
 *********************************************************************************************/

$conn = mysqli_connect("127.0.0.1", "root", "", "tripbook")
or die(mysqli_connect_error());

$username = mysqli_real_escape_string($conn, $_GET['username']);
$query = "select * from users where Username = '$username'";

if ( mysqli_num_rows(mysqli_query($conn, $query)) > 0 ) {
    // nome utente già registrato
    echo json_encode(array(
            'exists' => 'TRUE'
        )
    );
}
else {
    echo json_encode(array(
            'exists' => 'FALSE'
        )
    );
}

mysqli_close($conn);

?>
