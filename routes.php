<?php
  
  require_once('functions.php');
  session_start();

  if ( isset($_POST['signin_form_submit']) ) {

    if ( $_POST['forgot_password'] == 'on' && isset($_POST['user_id']) ) {

      if ( send_password( $_POST['user_id'] ) ) {
        display_notice( 'Please check your email for the password and then try again.', 'success' );
      } else {
        display_notice( 'User ID not recognized. Please try again.', 'error' );
      }

      header( 'Location: index.php' );

    } else if ( signin( $_POST['user_id'], $_POST['password'] ) ) {

      if ( is_student() )
        header('Location: student.php');
      else
        header('Location: advisor.php');
      
    } else {
      display_notice( 'Error logging in.', 'error' );
      header( 'Location: index.php' );
    }

    exit();

  }

  if ( isset($_POST['log_advising_session_form_submit']) ) {
    log_advising_session( $_SESSION['viewing_psid'] );
    header('Location: advisor.php') ;
    exit();
  }

  if ( isset($_POST['advising_notes_form_submit']) ) {
    add_notes_to_session( $_POST['note_content'] );
    header('Location: advisor.php') ;
    exit();
  }

  if ( isset($_POST['display_notes_form_submit']) ) {
    get_advising_session_notes( $_SESSION['viewing_psid'], $_POST['display_notes_form_submit'] );
    header('Location: advisor.php?tab=advising_notes');
    exit();
  }

  if ( $_GET['action'] == 'logout' ) {

    session_destroy();
    header('Location: index.php') ;
    exit();

  } else if ( isset($_GET['student_search_term']) ) {
    if ( find_user_by_psid_or_name( $_GET['student_search_term'] )) {
      display_notice( 'User found.', 'success' );
      $user_id = $_SESSION['student']['user_id'];
      header( "Location: advisor.php?student_id=$user_id" );
    } else {
      $search = $_GET['student_search_term'];
      display_notice( "User '$search' not found.", 'error' );
      header( 'Location: advisor.php' );
    }

    exit();

  } else if ( $_GET['action'] == 'new_search' ) {

    $name = $_SESSION['student']['full_name'];
    unset( $_SESSION['student'] );
    unset( $_SESSION['viewing_psid'] );
    display_notice( "Advising session for $name ended.", 'success' );
    header( 'Location: advisor.php' );

  } else {

?>

<?php include('templates/header.php') ?>


  <div class="alert alert-error">

    <strong>Error</strong>

    Route '<?php echo $_GET['action'] ?>' not recognized.

  </div>

<?php include('templates/footer.php') ?>

<? } ?>