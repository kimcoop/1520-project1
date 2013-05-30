<?php

$student_access_level = 0;
$advisor_access_level = 1;

function signin() {
  $_SESSION['first_name'] = 'Kim';
  $_SESSION['user_id'] = 3538156;
  $_SESSION['full_name'] = 'Kim Coop';
  // $_SESSION['access_level'] = 0;
  $_SESSION['access_level'] = 1;
}

function is_logged_in() {
  return isset( $_SESSION['user_id'] );
}

function is_student() {
  return $_SESSION['access_level'] == $GLOBALS['student_access_level'];
}

function is_advisor() {
  return $_SESSION['access_level'] == $GLOBALS['advisor_access_level'];
}

function is_viewing_student() {
 return isset( $_SESSION['student'] ); 
}

function notice_present() {
  return isset( $_SESSION['notice'] );
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


  /* 
  *

  UTILITY FUNCTIONS 

  *
  */

  function display_notice( $message, $type ) {
    $_SESSION['notice']['message'] = $message;
    $_SESSION['notice']['type'] = $type;
  }

  /* 
  *

  STUDENT FUNCTIONS 

  *
  */


function get_courses_by_term() {
  echo "A list of all courses he / she has taken, with grades, shown term by term";  
  echo "<br>";

  return array("foo", "bar", "hallo", "world");
}

function get_courses_by_department() {
  echo "A list of all courses he / she has taken, with grades, shown in alphabetical order by department and in numerical order within a department. For example, if the student has taken MATH 0230, MATH 0220, CS 0445, CS 1501, CS 0401, CHEM 0120 and BIOSC 0160, the resulting order should be: BIOSC 0160, CHEM 0120, CS 0401, CS 0445, CS 1501, MATH 0220, MATH 0230";
  echo "<br>";

  return array("course1", "course2", "course3", "course4");
}

function get_requirements() {
  echo "N – requirement is Not satisfied";
  echo "<br>";
  echo "<br>";
  echo "S [Course] [Term] [Grade] – requirements is Satisftied by the indicated course in the indicated term with the indicated grade. Note that all requirements must be satisfied with a grade of C or better. Any grades of C- or lower cannot satisfy any requirements. See below for details on the CS graduation requirements.";

  return array("foo1", "bar1", "hallo1", "world1");
}


  /* 
  *

  ADVISOR FUNCTIONS 

  *
  */

  function find_user_by_psid_or_name( $search_term ) {
    $_SESSION['student']['first_name'] = 'Kim';
    $_SESSION['student']['user_id'] = 3538156;
    $_SESSION['student']['psid'] = 3538156;
    $_SESSION['student']['full_name'] = 'Kim Coop';
    $_SESSION['student']['last_name'] = 'Coop';
  }

  function log_advising_session() {
    // Log advising session – this option will add a timestamp entry to a file indicating the date and time of this student's current advising session. See below for file format details.
   display_notice( 'Advising session logged.', 'success' );
  }


?>