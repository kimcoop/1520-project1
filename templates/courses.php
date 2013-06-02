<div class="row">
  <div class="<?php echo (is_student() ? 'span12': 'span9') ?>">
    <h3>Courses taken by term</h3>
    <?php
    
      $courses = array();

      if ( is_student() )
        $courses_per_term = get_courses_by_term( $_SESSION['psid'], $_SESSION['all_courses'] );
      else
        $courses_per_term = get_courses_by_term( $_SESSION['student']['psid'], $_SESSION['all_courses'] );

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

<hr class="dotted">

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

<hr class="dotted">  

<div class="row">
  <div class="<?php echo (is_student() ? 'span12': 'span9') ?>">
    <h3>CS graduation requirements</h3>
    <?php
      
        $courses = array();

        if ( is_student() )
          $reqs = get_requirements( $_SESSION['psid'] );
        else
          $reqs = get_requirements( $_SESSION['student']['psid'] );

          ksort( $reqs );
          foreach( $reqs as $req ) {
            ?>

            <div class="<?php echo (is_student() ? 'span12': 'span9') ?>">

              <?php
              
              echo "<p>$req->title ";
              if ( $req->satisfied ) echo "<span class='text-success'>[S]</span>";
              else echo "<span class='text-error'>[N]</span>";
              echo "</p>";
              ?>

            </div>
            <?php
            
            
          }

      ?>
    </p>
    
  </div>
</div>