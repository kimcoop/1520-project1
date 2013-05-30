<?php

  require( 'functions.php' );
  session_start();

  if( $_GET['action'] == 'signin' ) {
      
    // TODO: check credentials
    signin();
    header('Location: student.php') ;
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