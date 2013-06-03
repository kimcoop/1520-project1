<h3>Advising Notes</h3>

<table class="table table-hover">

  <?php
    
    $notes = get_advising_notes( $_SESSION['viewing_psid'] );

    if ( count($notes) > 0 ) {

      foreach( $notes as $index => $note ) {
        ?>

        <tr>
          <td>
            Note <?php echo $index + 1 ?>
          </td>
          <td>

          <?php
            echo $note['timestamp'];
          ?>

          </td>
          <td>

            <?php

              if ( should_show_session_notes( $note['timestamp'] ) ) {
                echo show_session_notes( $note['timestamp'] );
              } else {


            ?>

            <form class="pull-right" action="routes.php" method="post" name="display_notes_form">
              <button value="<?php echo $note['timestamp'] ?>" class="btn" type="submit" name="display_notes_form_submit">View comments &raquo;</button>
            </form>

            <?php

              }

            ?>

          </td>
        </tr>

      <?php
      } // foreach
    } else {

    ?>

    No advising notes found.

    <?php
    }
  ?>

</table>
