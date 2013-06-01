<?php

  class Course {
    public $department, $number, $term, $psid, $grade;

    function __construct( $line ) {
      $pieces = explode( ":", $line );
      $this->department = $pieces[0];
      $this->number = $pieces[1];
      $this->term = $pieces[2];
      $this->psid = $pieces[3];
      $this->grade = $pieces[4];
    }

    public function commatize() {
      return "$this->department,$this->number";
    }

    public function print_course() {
      echo "<strong>$this->department $this->number</strong> 
            $this->term
            $this->psid
            $this->grade";
    }
  }

?>