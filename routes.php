<?php
  
  require_once('functions.php');
  session_start();
  
  if ( isset($_POST['search_student_form_submit']) ) {
    find_user_by_psid_or_name( $_POST['search_term'] );
    header('Location: advisor.php') ;
    exit();
  }

  if ( isset($_POST['log_advising_session_form_submit']) ) {
    log_advising_session();
    header('Location: advisor.php') ;
    exit();
  }

  if( $_GET['action'] == 'signin' ) {
    // TODO: check credentials
    signin();

    if ( is_student() ) {
      header('Location: student.php') ;
    } else {
      header('Location: advisor.php') ;
    }

    exit();

  } else if ( $_GET['action'] = 'logout' ) {

    session_destroy();
    // TODO: logout page
    header('Location: index.php') ;
    exit();

  } else {

?>

<?php include('templates/header.php') ?>


  <div class="alert alert-error">

    <strong>Error</strong>

    Route '<?php echo $_GET['action'] ?>' not recognized.

  </div>

<?php include('templates/footer.php') ?>

<? } ?>