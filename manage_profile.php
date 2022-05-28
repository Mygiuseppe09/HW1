<?php
// se non c'è una sessione attiva facciamo fare il login all'utente
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <title> GESTISCI PROFILO </title>
    <link rel="stylesheet" href="styles/home.css">
    <link rel="stylesheet" href="styles/manage_profile.css">
    <link rel="stylesheet" href="styles/common-styles.css">
    <script src='JS/manage_profile.js' defer></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- FONT: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700&display=swap" rel="stylesheet">
</head>

<body>

<?php
require_once "Common Elements/navbar.php";
?>

<div class="home_container">

    <div class="profile">
        <h1 id="name"><!-- da generare dinamicamente --></h1>
        <h3 id="username"><!-- da generare dinamicamente --></h3>
        <div id="userAvatar" class="rounded_image_container"><!-- da generare dinamicamente --></div>
        <div class="user_informations">
            <div class="user_informations__posts">
                <h3>POST</h3>
                <p> <!-- da generare dinamicamente --> </p>
            </div>
            <div class="user_informations__places">
                <h3>LUOGHI VISITATI</h3>
                <p> <!-- da generare dinamicamente --> </p>
            </div>
        </div>

        <a class="button" id="new_post" href="new_post.php"> NUOVO POST </a>

    </div>

    <div class="feed">
        <h1> I tuoi post: </h1>

        <div class="feed__posts">
            <!-- da generare dinamicamente -->
        </div>
    </div>

    <div class="home_container__right">
        <div class="places_visited_by_logged_user">
            <h3 class="margin"> HAI VISITATO: </h3>
            <div class="list_places"> <!-- da generare dinamicamente --> </div>
        </div>
        <div class="deleteFeedback hidden"></div>
        <div class="delete_posts">
            <a class="button" id="deletePostsButton"> ELIMINA POST </a>
        </div>
    </div>
</div>

<?php  include_once "Common Elements/like_modal_view.php"?>

<?php include "Common Elements/footer.php" ?>

</body>
</html>

