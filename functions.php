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

//Dept:Number:Term:PSID:Grade
class StudentCourse {
  var $department, $number, $term, $psid, $grade;

  function __construct() {
    print "In constructor\n";
    $this->$department = "";
    $this->$number = "1234";
    $this->$term = "";
    $this->$psid = "";
    $this->$grade = "";
  }

  function print_student_course() {
    echo $this->$department;
    echo $this->$number;
    echo $this->$term;
    echo $this->$psid;
    echo $this->$grade;
  }
}

function get_courses_by_term() {
  echo 'testing<br>';
  return array("foo", "bar", "hallo", "world");
}

?>