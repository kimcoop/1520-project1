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

?>