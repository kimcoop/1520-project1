<?php

require_once('models/course.php');

define( "STUDENT_ACCESS_LEVEL", 0 );
define( "ADVISOR_ACCESS_LEVEL", 1 );
define( "USERS_FILE", 'files/users.txt' );
define( "COURSES_FILE", 'files/courses.txt' );
define( "REQS_FILE", 'files/reqs.txt' );

function signin( $user_id, $password ) {
  $valid = false;
  if ( $user_id && $password ) {

    $file_handle = fopen( USERS_FILE , "r");
    
    while ( !feof($file_handle) ) {
      $line = fgets( $file_handle );
      $pieces = explode( ":", $line );
      if ( $pieces[0] == $user_id && $pieces[1] == $password ) {
        //UserID:Password:PSID:Email:LastName:FirstName:Access_Level
        $valid = true;
        $_SESSION['user_id'] = $user_id;
        $_SESSION['psid'] = $pieces[2];
        $_SESSION['email'] = $pieces[3];
        $_SESSION['last_name'] = $pieces[4];
        $_SESSION['first_name'] = $pieces[5];
        $_SESSION['full_name'] = "$pieces[5] $pieces[4]";
        $_SESSION['access_level'] = $pieces[6];
        break;
      }
    }

    fclose( $file_handle );
    
  }

  return $valid;
}

function is_logged_in() {
  return isset( $_SESSION['user_id'] );
}

function is_student() {
  return $_SESSION['access_level'] == STUDENT_ACCESS_LEVEL;
}

function is_advisor() {
  return $_SESSION['access_level'] == ADVISOR_ACCESS_LEVEL;
}

function is_viewing_student() {
 return isset( $_SESSION['student'] ); 
}

function is_logging_session() {
 return isset( $_SESSION['student']['logging_session'] ); 
}

function should_show_notice() {
  return isset( $_SESSION['notice'] );
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

  function is_active_tab( $tab_id ) {
    if ( $tab_id=='courses' && empty($_GET['tab']) )
      return true;
    else
      return $_GET['tab'] == $tab_id;
  }

  /* 
  *

  STUDENT FUNCTIONS 

  *
  */
  
$courses = populate_courses();
$reqs = array();

function populate_courses() {
  $courses = array();
  $file_handle = fopen( COURSES_FILE , "r");
  
  while ( !feof($file_handle) ) {
    $line = fgets( $file_handle );
    $course = new Course( $line );
    $courses[] = $course;
  }

  fclose( $file_handle );
  return $courses;

}

function populate_reqs() {

}


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
    $valid = false;
    if ( $search_term ) {

      $file_handle = fopen( USERS_FILE , "r");
      
      while ( !feof($file_handle) ) {
        $line = fgets( $file_handle );
        $pieces = explode( ":", $line );
        $psid = $pieces[2];
        $full_name = "$pieces[5] $pieces[4]";
        if ( $psid == $search_term || $full_name == $search_term ) {

          $valid = true;
          $_SESSION['student']['user_id'] = $pieces[0];
          $_SESSION['student']['psid'] = $pieces[2];
          $_SESSION['student']['email'] = $pieces[3];
          $_SESSION['student']['last_name'] = $pieces[4];
          $_SESSION['student']['first_name'] = $pieces[5];
          $_SESSION['student']['full_name'] = $full_name;
          $_SESSION['student']['access_level'] = $pieces[6];

          break;
        }
      }

      fclose( $file_handle );
      
    }

    return $valid;

  }

  function log_advising_session() {
    // Log advising session – this option will add a timestamp entry to a file indicating the date and time of this student's current advising session. See below for file format details.
    // TODO: log session
    $_SESSION['student']['logging_session'] = true;
    display_notice( 'Advising session logged.', 'success' );
  }

  function add_notes_to_session( $notes ) {
    // TODO: add notes to session
    // $_SESSION['student']['logging_session'] = true;
    display_notice( 'Advising session notes added.', 'success' );
  }

  function get_advising_session_notes( $session_id ) {
    //this option will show a list of advising note timestamps, ordered from most recent to least recent. Also shown will be a radiobutton for each timestamp, so that the advisor may select one of them. When a timestamp is selected and submitted, the advisor will see the comments associated with that timestamp.
    return array("notes1", "notes2", "notes3", "notes4");
  }

  function get_advising_sessions( $psid ) {
    // Show advising sessions – this option will show a list of previous advising sessions for this student, ordered from most recent to least recent.
    return array("session1", "session2", "session3", "session4");
  }

  function get_session_comments( $session_id ) {
   return array("comment1", "comment2", "comment3", "comment4"); 
  }

?>