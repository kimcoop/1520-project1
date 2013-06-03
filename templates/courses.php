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
    <table class="table table-hover">

    <?php

        if ( is_student() )
          $viewing_psid = $_SESSION['psid'];
        else
          $viewing_psid = $_SESSION['student']['psid'];

        $reqs = get_requirements( $viewing_psid );

          ksort( $reqs );
          foreach( $reqs as $req ) {
          ?>
            <tr>  
              <td>
                <?php echo $req->title ?>
              </td>

              <td>
                <?php
                
                  if ( $req->satisfied ) {

                ?>

                  <span class='text-success'>S</span>

                <?php

                  } else { 

                ?>
                  <span class='text-error'>N</span>
              
                <?php } ?>
              </td>
              <td>
            
              <?php
                if ( $req->satisfied ) {
                  $req->print_satisfying_course( $viewing_psid, $_SESSION['user_courses'] );
                } else {
                  echo "<span class='muted'>Courses that satisfy this requirement: ";
                  $req->print_requirements();
                  echo "</span>";
                }
              ?>

              </td>
            </tr>

            
            <?php
            
            } // foreach

          ?>
    </table>
    
  </div>
</div>