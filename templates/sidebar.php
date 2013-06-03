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
        <button class="btn btn-block btn-primary" type="submit" name="log_advising_session_form_submit">Log advising session</button>
      </form>

      <?php
        } else {
      ?>
      <p class="text-success">
        Logging current advising session
      </p>
      <a href="routes.php?action=new_search" class="btn btn-block btn-primary">Search for another student</a>

  <?php
    }
  ?>

</aside>
<aside class="well">
  <h4 class="title">Session Notes</h4>
  <form action="routes.php" method="post" name="advising_notes_form">
    <textarea class="input-block-level" name="note_content" rows="6" placeholder="Notes"></textarea>
    <button class="btn btn-block btn-primary" type="submit" name="advising_notes_form_submit">Add notes to current session</button>
  </form>
</aside>

  <?php
    }
  ?>