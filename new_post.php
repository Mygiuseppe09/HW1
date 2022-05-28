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
    <title> NUOVO POST </title>
    <link rel="stylesheet" href="styles/new_post.css">
    <link rel="stylesheet" href="styles/common-styles.css">
    <script src='JS/new_post.js' defer></script>
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

  <div class="video_background_container">
      <div class="overlay"></div>

      <div class="on_video">

          <div id="formOutputContainer">

              <form action="" id="newPostForm">
                  <h2>DOVE SEI STATO?</h2>
                  <label for="inNewPostPlace"><input placeholder="es: Rome" type="text" name="place" id="inNewPostPlace"></label>
                  <input id="submitButton" class="button" type="submit" value="CERCA">
              </form>

              <?php require_once "Common Elements/loader.php"?>

              <div id="placesResults" class="hidden"></div> <!-- feedback sulla ricerca -->

              <div id="outputPlaces" class="hidden"> <!-- da generare dinamicamente --> </div>

              <div id="isPostedFeedback" class="hidden"></div>

              <div id="API_attribution" class=""> 
                  Powered by
                  <img src="assets/icons/logo-API.png" alt="">
              </div>


          </div>



      </div>
      <video autoplay muted loop>
          <source src="assets/videos/new_post_video_background.mp4" type="video/mp4"/>
      </video>
  </div>


  </body>

</html>
