
<?php include('templates/header.php') ?>

      <form class="form-signin">


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
        <input autofocus type="text" class="input-block-level" placeholder="User ID">
        <input type="password" class="input-block-level" placeholder="Password">

        <!-- <button class="btn btn-block btn-large btn-primary" type="submit">Sign in</button> -->
        <a href="routes.php?action=signin" class="btn btn-block btn-large btn-primary">Sign in</a>

        <br>
        <span class="pull-right">
          <a href="?forgot_password=true">Forgot your password?</a>
        </span>


        <?php } ?>
        
      </form>

<?php include('templates/footer.php') ?>