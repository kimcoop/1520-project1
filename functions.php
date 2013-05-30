<?php

function signin() {
  $_SESSION['first_name'] = 'Kim';
  $_SESSION['user_id'] = 3538156;
  $_SESSION['full_name'] = 'Kim Coop';
  $_SESSION['access_level'] = 0;
}

function is_student() {
  return $_SESSION['access_level'] == 0; // 0 for students, 1 for advisors
}

function is_advisor() {
  return $_SESSION['access_level'] == 1;
}


?>