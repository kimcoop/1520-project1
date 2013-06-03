<h3>Advising Sessions</h3>

<table class="table table-hover">
  <?php
    $sessions = get_advising_sessions( $_SESSION['viewing_psid'] );
    foreach( $sessions as $session ) {
      ?>

      <tr>
        <td>
          Session
        </td>
        <td>

        <?php
          echo $session['timestamp'];
        ?>

        </td>
        <td>

          <form action="routes.php" method="post" name="display_comments_form">
            <button value="<?php echo $session_id ?>" class="btn" type="submit" name="display_comments_form_submit">View comments &raquo;</button>
          </form>

        </td>
      </tr>

      <?php
    }

  ?>
</table>
