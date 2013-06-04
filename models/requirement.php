<?php

  class Requirement {
    public $title, $reqs, $satisfied;

    function __construct( $line ) {
      $pieces = explode( ":", $line );
      $this->satisfied = false; // default
      $this->title = $pieces[0];
      $this->reqs = explode( "|", $pieces[1] );
      
    }

    public function print_satisfying_course( $psid, $user_courses ) {
      $course = $this->get_satisfying_course( $psid, $user_courses );
      echo $course->titleize();
    }

    public function get_satisfying_course( $psid, $user_courses ) {
      foreach( $this->reqs as $req ) {
        $pieces = explode( ",", $req );
        $req_course_department = $pieces[0];
        $req_course_number = (int) $pieces[1];
        $course = get_user_course_record( $psid, $req_course_department, $req_course_number);

        if ( isset( $course ) )
          return $course;
      }
    }

    public function print_requirements() {
      foreach( $this->reqs as $index => $req ) {
        $pieces = explode( ",", $req );
        $department = $pieces[0];
        $number = (int) $pieces[1];
        echo $department . "" . $number; // strip comma
        if ( $index != count($this->reqs) -1 )
          echo ", ";
      }
    }
  }

?>