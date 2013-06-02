<?php

  class Course {
    public $department, $number, $term, $psid, $grade;

    function __construct( $line ) {
      $pieces = explode( ":", $line );
      $this->department = $pieces[0];
      $this->number = $pieces[1];
      $this->term = $pieces[2];
      $this->psid = $pieces[3];
      $this->grade = preg_replace( '/[^(\x20-\x7F)]*/','', $pieces[4] );
    }

    public function is_passing_grade() {
      $passing_grades = array("A+", "A", "A-", "B+", "B", "B-", "C+", "C");
      return in_array( $this->grade, $passing_grades ); 
    }

    public function print_course() {
      echo "<strong>$this->department $this->number</strong> 
            $this->term
            $this->psid
            $this->grade";
    }
  }

?>