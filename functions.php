<?php

require_once('models/course.php');
require_once('models/requirement.php');
require_once('models/advising_session.php');

define( "STUDENT_ACCESS_LEVEL", 0 );
define( "ADVISOR_ACCESS_LEVEL", 1 );
define( "USERS_FILE", 'files/users.txt' );
define( "COURSES_FILE", 'files/courses.txt' );
define( "REQS_FILE", 'files/reqs.txt' );
define( "SESSIONS_FILE", 'files/sessions.txt' );
define( "NOTES_FILE", 'files/notes.txt' );

define( "MAILER_SUBJECT", "Your AdvisorCloud Credentials" );
define( "MAILER_SENDER", "kac162@pitt.edu" );

function signin( $user_id, $password ) {
  $valid = false;
  if ( $user_id && $password ) {

    $file_handle = fopen( USERS_FILE , "r" );
    
    while ( !feof($file_handle) ) {
      $line = fgets( $file_handle );
      $pieces = explode( ":", $line );
      if ( $pieces[0] == $user_id && $pieces[1] == $password ) {
        $valid = true;
        $_SESSION['user_id'] = $user_id;
        $_SESSION['psid'] = $pieces[2];
        $_SESSION['email'] = $pieces[3];
        $_SESSION['last_name'] = $pieces[4];
        $_SESSION['first_name'] = $pieces[5];
        $_SESSION['full_name'] = "$pieces[5] $pieces[4]";
        $_SESSION['access_level'] = $pieces[6];

        // so we can use one variable for both roles. overwrite if/when advisor looks up student
        $_SESSION['viewing_psid'] = $_SESSION['psid'];
        break;
      }
    }

    fclose( $file_handle );
    
  }

  if ( $valid && is_student() ) {
    $_SESSION['user_courses'] = get_courses_for_user( $_SESSION['psid'], $_SESSION['all_courses'] );
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

function get_root_url() {
  if ( is_student() ) 
    return 'student.php'; 
  else
    return 'advisor.php';
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

session_start();
$_SESSION['all_courses'] = populate_courses(); // populate onload for faster recall. TODO: make global not session

function populate_courses() {
  $courses = array();
  $file_handle = fopen( COURSES_FILE , "r" );
  
  while ( !feof($file_handle) ) {
    $line = fgets( $file_handle );
    $course = new Course( $line );
    $courses[] = $course;
  }

  fclose( $file_handle );
  return $courses;

}

function populate_reqs() {
  $reqs = array();
  $file_handle = fopen( REQS_FILE , "r" );
  
  while ( !feof($file_handle) ) {
    $line = fgets( $file_handle );
    $req = new Requirement( $line );
    $reqs[] = $req;
  }

  fclose( $file_handle );
  return $reqs;

}


function get_courses_for_user( $psid, $courses ) {
  $user_courses = array();

  foreach( $courses as $course ) {
    if ( $course->psid == $psid ) {
      $user_courses[] = $course;
    }
  }
  
  return $user_courses;
}

function get_courses_by_term( $psid, $courses ) {
  
  foreach( $courses as $course ) {
    if ( $course->psid == $psid ) {
      $courses_by_term[ $course->term ][] = $course;
    }
  }
  return $courses_by_term;
}

function get_courses_by_department( $psid, $courses ) {
  
  $courses_by_department = array();

  foreach( $courses as $course ) {
    if ( $course->psid == $psid ) {
      $courses_by_department[ $course->department ][] = $course;
    }
  }
  
  return $courses_by_department;
}

function get_requirements( $psid ) {
  $requirements = [];
  $graduation_reqs = populate_reqs();

  foreach( $graduation_reqs as $requirement ) {
    $requirement->satisfied = requirements_met( $psid, $requirement->reqs );
    $requirements[] = $requirement;
  }
  
  return $requirements;

}

function get_user_course_record( $psid, $department, $number ) {

  foreach( $_SESSION['user_courses'] as $user_course ) {
    if ( $user_course->is_passing_grade() && $user_course->department == $department && $user_course->number == $number ) {
      return $user_course;
    }
  }

  return NULL;

}

function requirements_met( $psid, $course_options ) {
  
  foreach( $course_options as $req ) {
    
    $req_course_department = explode( ",", $req )[0];
    $req_course_number = (int) explode( ",", $req )[1];

    $user_course = get_user_course_record( $psid, $req_course_department, $req_course_number);
    if ( isset($user_course) ) {
      return true;
    }

  }
  return false;
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

          $_SESSION['viewing_psid'] = $_SESSION['student']['psid'];
          $_SESSION['user_courses'] = get_courses_for_user( $_SESSION['viewing_psid'], $_SESSION['all_courses'] );

          break;
        }
      }

      fclose( $file_handle );
      
    }

    return $valid;

  }

  function log_advising_session( $psid ) {
    
    $date = new DateTime();
    $session_timestamp = $date->format('Y-m-d-H-i-s');
    $log_timestamp = sprintf( "%d:%s", $psid, $session_timestamp );

    if ( file_put_contents( SESSIONS_FILE, "\n" . $log_timestamp, FILE_APPEND | LOCK_EX ) ) {
      $_SESSION['student']['logging_session'] = true;
      $_SESSION['student']['logging_session_timestamp'] = $log_timestamp;
      display_notice( 'Advising session logged.', 'success' );
    } else {
      display_notice( 'Error logging advising session.', 'error' );
    }

  }

  function add_notes_to_session( $notes ) {

    $log_timestamp = $_SESSION['student']['logging_session_timestamp'];
    $filename = sprintf( "files/notes/%s.txt", $log_timestamp );

    if ( file_put_contents( NOTES_FILE, "\n" . $log_timestamp, FILE_APPEND | LOCK_EX ) && file_put_contents( $filename, $notes, FILE_APPEND | LOCK_EX ) ) {
      display_notice( 'Advising session notes added.', 'success' );
    } else {
      display_notice( 'Error logging advising notes.', 'error' );
    }
  }


  function get_advising_notes( $psid ) {

    $advising_notes = array();
    $file_handle = fopen( NOTES_FILE, "r" );

    while ( !feof($file_handle) ) {
      $line = fgets( $file_handle );
      
      $pieces = explode( ":", $line );
      if ( $pieces[0] == $psid ) {
        $advising_note = array( "timestamp" => make_date( $pieces[1]) );
        $advising_notes[] = $advising_note;
      }

    }

    fclose( $file_handle );
    return $advising_notes;

  }

  function should_show_session_notes( $session_timestamp ) {
    $should_show = isset( $_SESSION['notes'][ $session_timestamp ]);
    return $should_show;
  }

  function show_session_notes( $session_timestamp ) {
    
    return $_SESSION['notes'][ $session_timestamp ];
  }

  function get_advising_session_notes( $psid, $session_timestamp ) {
    $filename = sprintf( "files/notes/%d:%s.txt", $psid, $session_timestamp );
    $notes = file_get_contents( $filename );

    $_SESSION['notes'][ $session_timestamp ] = $notes;

    return $notes;

  }

  function make_date( $timestamp ) {
    $format = 'l F jS, Y \a\t g:ia';

    $pieces = explode( "-", $timestamp );
    $year = $pieces[0];
    $month = $pieces[1];
    $day = $pieces[2];
    $hour = $pieces[3];
    $minute = $pieces[4];
    $second = $pieces[5];

    return date( $format, mktime( $hour, $minute, $second, $month, $day, $year ));
  }

  function get_advising_sessions( $psid ) {
    
    $advising_sessions = array();
    $file_handle = fopen( SESSIONS_FILE , "r" );

    while ( !feof($file_handle) ) {
      $line = fgets( $file_handle );
      
      $pieces = explode( ":", $line );
      if ( $pieces[0] == $psid ) {
        $advising_session = array( "timestamp" => make_date( $pieces[1]) );
        $advising_sessions[] = $advising_session;
      }

    }

    fclose( $file_handle );
    return $advising_sessions;
  }

  /*
  *
  *
  */

  function get_user_details( $user_id ) {
    $file_handle = fopen( USERS_FILE , "r" );
    $details = NULL;
      
    while ( !feof($file_handle) ) {
      $line = fgets( $file_handle );
      $pieces = explode( ":", $line );
      if ( $pieces[0] == $user_id ) {
        $details = array( "email"=> $pieces[3], "password"=>$pieces[1] );
        break;
      }
    }

    fclose( $file_handle );
    return $details;
    
  }

  function send_password( $user_id ) {

    $details = get_user_details( $user_id );

    if ( isset( $details ) ) {

      $email = $details[ 'email' ];
      $password = $details[ 'password' ];
      $format = "Your password is $s (for user ID %s)";

      $to      = $email;
      $subject = MAILER_SUBJECT;
      $message = sprintf( $format, $password, $user_id );
      $headers = 'From: ' .MAILER_SENDER . '' . "\r\n" .
          'Reply-To: ' .MAILER_SENDER . '' . "\r\n" .
          'X-Mailer: PHP/' . phpversion();

      mail( $to, $subject, $message, $headers );
      return true;

    } else {
      return false;
    }

  }

?>