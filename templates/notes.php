<?php
  
  $_SESSION['advising_session_id'] = 1234; // TODO
  $notes = get_advising_session_notes( $_SESSION['advising_session_id'] );
  foreach( $notes as $note ) {
    ?>
    <div class="row">
      <div class="span9">
        <h3>Notes</h3>
      <?php
        echo $note;
      ?>
      <p><a class="btn" href="#">View details &raquo;</a></p>
      </div><!-- .span9 -->
    </div><!-- .row -->
    <?php
  }

?>