<?php 
    class Day_13 {
        public $subject = "PHP";
        const myName = "Asif Abir \n";
        public static $city = "Dhaka \n";
        public function __construct($msg) {
            echo "Subject $this->subject $msg \n";
        }

        public function myFunc () {
            echo "this is $this->subject\n";
        }

        public static function sFunc () {
            return "This is a demo data \n";
        }

        public function __destruct() {
            echo "this is a destruct function.\n";
        }
    }

    $obj = new Day_13("This is my message"); 
    $obj->subject = "JavaScript";
    $obj->myFunc();
    echo $obj::myName;
    echo $obj::$city;
    echo $obj::sFunc();

    class otherClass {
        public static string $country = "Bangladesh\n";

        public static function myMethod (): string {
            return "This is a static method\n";
        }
        private function __construct () {
            return ;
        }
    }

    // $otherObj = new otherClass;
    echo otherClass::$country;
    echo otherClass::myMethod();
?>