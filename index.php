
<?php include('templates/header.php') ?>

  <form class="form-signin" action="routes.php" name="signin_form" method="post">

    <?php 

      if( $_GET['forgot_password'] ) {

    ?>

    <div class="alert alert-success">
      <strong>Don't worry!</strong>&nbsp;
      Your password has been emailed to you.
    </div>

    <a href="index.php" class="btn btn-block btn-large">Ok</a>

    <?php

      } else {
      
    ?>


    <h2 class="text-center form-signin-heading">Please Sign In</h2>

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
    
    <input autofocus type="text" class="input-block-level" placeholder="User ID" name="user_id" />
    <input type="password" class="input-block-level" placeholder="Password" name="password" />
    <button type="submit" class="btn btn-block btn-large btn-primary" name="signin_form_submit">Sign in</button>

    <br>
    <span class="pull-right">
      <a href="?forgot_password=true">Forgot your password?</a>
    </span>
    </form>



    <?php } ?>
    
  </form>

<?php include('templates/footer.php') ?>