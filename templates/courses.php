<div class="row">
  <div class="<?php echo (is_student() ? 'span12': 'span9') ?>">
    <h3>Courses taken by term</h3>
    <?php
    
      $courses = array();

      if ( is_student() )
        $courses_per_term = get_courses_by_term( $_SESSION['psid'] );
      else
        $courses_per_term = get_courses_by_term( $_SESSION['student']['psid'] );

        ksort( $courses_per_term );
        foreach( $courses_per_term as $term => $courses ) {
          echo "<div class='span3 well outlined'>";
          echo "<h4>$term</h4>";
          foreach( $courses as $course ) {
            echo "<strong>$course->department $course->number</strong> 
            $course->grade";
            echo "<br>";
          }
          echo "</div>";
        }

    ?>
  </div>
</div>

<hr>

<div class="row">
  <div class="<?php echo (is_student() ? 'span12': 'span9') ?>">
    <h3>Courses taken by department</h3>
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
  <div class="<?php echo (is_student() ? 'span12': 'span9') ?>">
    <h3>CS graduation requirements</h3>
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