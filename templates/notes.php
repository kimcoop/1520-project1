<?php
  
  $_SESSION['advising_session_id'] = 1234; // TODO
  $notes = get_advising_session_notes( $_SESSION['advising_session_id'] );
  foreach( $notes as $note ) {
    echo $note;
  }

?>

<div class="row">
  <div class="span4">
    <h2>Notes</h2>
    <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
    <p><a class="btn" href="#">View details &raquo;</a></p>
  </div>
  <div class="span4">
    <h2>Notes</h2>
    <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
    <p><a class="btn" href="#">View details &raquo;</a></p>
 </div>
  <div class="span4">
    <h2>Notes</h2>
    <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
    <p><a class="btn" href="#">View details &raquo;</a></p>
  </div>
</div>