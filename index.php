<?php
  include 'connectdb.php';

  if(isset($_SESSION['isLoggedin']) && $_SESSION['isLoggedin'] == true) {
    header("Location: portfolio-form");
  } else {
    header("Location: login.php");
  }
?>