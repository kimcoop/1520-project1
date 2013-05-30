<?php include('templates/header.php') ?>

<?php

  session_start(); // attempt to start session
  if ( is_logged_in() && is_advisor() ) {

?>

  <div class="row">
    <div class="main-content span9">
      
      <div class="hgroup">

        <?php
          if ( should_show_notice() ) {
        ?>

          <div class="alert alert-<?php echo $_SESSION['notice']['type'] ?>">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $_SESSION['notice']['message'] ?>
          </div>

        <?php
          unset( $_SESSION['notice'] );
          }
        ?>

        <h2>
          <?php echo $_SESSION['first_name'] ?>'s 
          <span class="light">Advisor Dashboard</span>
        </h2>

        </div><!-- .hgroup -->

        <?php
          if ( is_viewing_student() ) {
        ?>

          <ul class="nav nav-tabs">
            <li class="active"><a href="#courses" data-toggle="tab">Courses</a></li>
            <li><a href="#advising" data-toggle="tab">Advising</a></li>
          </ul>

          <div class="tab-content">

            <div class="tab-pane active" id="courses">
              <?php include('templates/courses.php') ?>
            </div><!-- #courses -->

            <div class="tab-pane" id="advising">
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
            </div><!-- #advising -->

          </div><!-- .tab-content -->

          
          

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
        <br>
      </div><!-- .hgroup -->

      <? 

        }

      ?>

    
    </div><!-- .main-content -->

    <div class="span3 side-content">
        <?php 

          if ( is_viewing_student() ) {

            $format = "%s, user ID %u, PeopleSoft #%u";
            $student_summary = sprintf( $format, $_SESSION['student']['full_name'], $_SESSION['student']['user_id'], $_SESSION['student']['psid'] );

        ?>
      <aside class="well">
        <h4 class="title">Status</h4>

          <p>
            Currently viewing report for: <?php echo $student_summary ?>
          </p>

            <?php
              if ( !is_logging_session() ) {
            ?>

            <form action="routes.php" method="post" name="log_advising_session_form">
              <button class="btn btn-block" type="submit" name="log_advising_session_form_submit">Log advising session</button>
            </form>

            <?php
              } else {
            ?>
            <p class="text-success">
              Logging current advising session
            </p>

        <?php
          }
        ?>

      </aside>
      <aside class="well">
        <h4 class="title">Actions</h4>
        <form action="routes.php" method="post" name="advising_notes_form">
          <textarea class="input-block-level" name="note_content" rows="6" placeholder="Notes"></textarea>
          <button class="btn btn-block" type="submit" name="advising_notes_form_submit">Add notes to current session</button>
        </form>
      </aside>

        <?php
          }
        ?>

    </div><!-- .side-content -->

  </div><!-- .row -->


<?php

  } else {
    
?>

  

  <br>
  <div class="alert alert-error">
    <strong>Sorry</strong> You must be logged in to view this page.
  </div>

  <a class="btn btn-primary" href="index.php">Login</a>


<?php 

  }

?>

<?php include('templates/footer.php') ?>


