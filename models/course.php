<?

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

    function print_course() {
      echo "<br>".$this->department;
      echo "<br>".$this->number;
      echo "<br>".$this->term;
      echo "<br>".$this->psid;
      echo "<br>".$this->grade;
    }
  }

?>