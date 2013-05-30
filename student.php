<?php include('templates/header.php') ?>

<?php

  session_start(); // attempt to start session
  if ( is_logged_in() && is_student() ) {

?>
  
  <div class="hero-unit">
    <h1>
      <?php echo $_SESSION['first_name'] ?>'s Dashboard
    </h1>
    <p>
      Welcome to your dashboard. Here you'll find records of courses you've taken.
    </p>

  </div><!-- .hero-unit -->

  <hr>

  <?php include('templates/courses.php') ?>

<?php

  } else {

?>

  <br>
  <div class="alert alert-error">
    <strong>Sorry</strong> You must be logged in as a student to view this page.
  </div>

  <a class="btn btn-primary" href="index.php">Login</a>


<?php 

  }

?>

<?php include('templates/footer.php') ?>


