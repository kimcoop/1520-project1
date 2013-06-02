<?php

  class Requirement {
    public $title, $reqs, $satisfied;

    function __construct( $line ) {
      $pieces = explode( ":", $line );
      $this->satisfied = false; // default
      // Req:Dept1,Number1|Dept2,Number2|...|DeptN,NumberN
      $this->title = $pieces[0];
      $this->reqs = explode( "|", $pieces[1] );
      
    }

    public function print_requirement() {
      echo "<strong>$this->title</strong>";
      echo "<br>";
      foreach( $this->reqs as $req ) {
        echo $req; // comma
      }
      echo "<br>";
    }
  }

?>