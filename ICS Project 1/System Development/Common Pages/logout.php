<?php 
session_start();
if(session_destroy()){

   header("Location: ../Common Pages/landingPage.html");

}
?>