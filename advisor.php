<?php include('templates/header.php') ?>

<?php

  session_start(); // attempt to start session
  if ( is_logged_in() && is_advisor() ) {

?>
  
  <div class="hero-unit">
    <h1>
      <?php echo $_SESSION['first_name'] ?>'s Advisor Dashboard
    </h1>

    <?php 

      if ( $_SESSION['student'] ) {

    ?>
      <p class="text-info">
        Currently viewing report for: <?php echo $_SESSION['student']['full_name'] ?>, user ID <?php echo $_SESSION['student']['user_id'] ?>, PeopleSoft #<?php echo $_SESSION['student']['psid'] ?>
      </p>

    <?php
        
      } else {

    ?>
    <p>Welcome to your advisor dashboard. Use the search form below to look up a student by student's PeopleSoft ID or first name/last name.</p>

    <form class="navbar-search pull-left" action="routes.php" method="post" name="search_student_form">
      <div class="input-prepend">
          <span class="add-on"><i class="icon-search"></i></span>
          <input placeholder="Search" type="text" name="search_term">
      </div>
      <button type="submit" class="btn search-button" name="search_student_form_submit">Search</button>
    </form>

    <? 

      }

    ?>

    <br>

  </div><!-- .hero-unit -->

  <hr>

  <div class="row">
    <div class="span12">
      <h2>Courses taken by term</h2>
      <p>
        A list of all courses he / she has taken, with grades, shown term by term
      </p>
      <p>
      <?php

      $courses = get_courses_by_term(); 
      foreach( $courses as $course ) {
        echo $course;
      }

      ?>
      </p>
    </div>
  </div>

  <hr>

  <div class="row">
    <div class="span12">
      <h2>Courses taken by department</h2>
      <p>
        
      <?php

      $courses = get_courses_by_department(); 
      foreach( $courses as $course ) {
        echo $course;
      }

      ?>
      </p>
    </div>
  </div>

  <hr>  

  <div class="row">
    <div class="span12">
      <h2>CS graduation requirements</h2>
      <p>
        
      <?php

      $courses = get_requirements(); 
      foreach( $courses as $course ) {
        echo $course;
      }

      ?>
      </p>
      
    </div>
  </div>

  <hr>
  
  <div class="row">
    <div class="span4">
      <h2>Heading</h2>
      <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
      <p><a class="btn" href="#">View details &raquo;</a></p>
    </div>
    <div class="span4">
      <h2>Heading</h2>
      <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
      <p><a class="btn" href="#">View details &raquo;</a></p>
   </div>
    <div class="span4">
      <h2>Heading</h2>
      <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
      <p><a class="btn" href="#">View details &raquo;</a></p>
    </div>
  </div>

<?php

  } else {
    
?>

  

  <br>
  <div class="alert alert-error">
    <strong>Sorry</strong> You must be logged in as an advisor to view this page.
  </div>

  <a class="btn btn-primary" href="index.php">Login</a>


<?php 

  }

?>

<?php include('templates/footer.php') ?>


