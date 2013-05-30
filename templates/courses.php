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