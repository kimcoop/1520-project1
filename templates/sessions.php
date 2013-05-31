<?php
  $session_id = '12345';
  $sessions = get_advising_sessions( $_SESSION['student']['psid'] );
  foreach( $sessions as $session ) {
    ?>

    <div class="row">
      <div class="span9">
        <h3>Session</h3>
      <?php
        echo $session;

      ?>

        <form action="routes.php" method="post" name="display_comments_form">
          <button value="<?php echo $session_id ?>" class="btn" type="submit" name="display_comments_form_submit">View comments &raquo;</button>
        </form>

      </div><!-- .span9 -->
    </div><!-- .row -->

    <?php
  }

?>

</form>