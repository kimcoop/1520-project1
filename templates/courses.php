<div class="row">
  <div class="<?php echo (is_student() ? 'span12': 'span9') ?>">
    <h3>Courses taken by term</h3>
    <table class="table table-hover">
      <?php

        $courses_per_term = get_courses_by_term( $_SESSION['viewing_psid'], $_SESSION['all_courses'] );

        ksort( $courses_per_term );
        foreach( $courses_per_term as $term => $courses ) {
        ?>

          <tr>
            <td>
              <?php echo $term ?>
            </td>
            <td>

              <?php
              
              foreach( $courses as $course ) {
                $course->print_with_grade();
                echo "<br>";
              }

              ?>

            </td>
          </tr>

        <?php
          } // foreach $courses_per_term
        ?>
    </table>
  </div>
</div>

<br>

<div class="row">
  <div class="<?php echo (is_student() ? 'span12': 'span9') ?>">
    <h3>Courses taken by department</h3>
     <table class="table table-hover">
      <?php

        $courses_by_department = get_courses_by_department( $_SESSION['viewing_psid'], $_SESSION['all_courses'] );

        ksort( $courses_by_department );
        foreach( $courses_by_department as $department => $courses ) {
          ?>

          <tr>
            <td>
              <?php echo $department ?>
            </td>
            <td>
              <?php
              
              foreach( $courses as $course ) {
                echo $course->get_with_grade();
                echo "<br>";
              }

              ?>

            </td>
          <?php
        }
      ?>
    </table>
  </div>
</div>

<br>  

<div class="row">
  <div class="<?php echo (is_student() ? 'span12': 'span9') ?>">
    <h3>CS graduation requirements</h3>
    <table class="table table-hover">

    <?php

        $reqs = get_requirements( $_SESSION['viewing_psid'] );

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
                  $req->print_satisfying_course( $_SESSION['viewing_psid'], $_SESSION['user_courses'] );
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