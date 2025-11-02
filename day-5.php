<?php  
    // echo uniqid();
    $capitalLetter = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $smallLetter = "abcdefghijklmnopqrstuvwxyz";
    $numbers = "0123456789";
    $specialCharacters = "!@#$%^&*()_+";

    echo str_shuffle(substr(str_shuffle($capitalLetter), 0, 2) . substr(str_shuffle($smallLetter), 0, 2) . substr(str_shuffle($numbers), 0, 2) . substr(str_shuffle($specialCharacters), 0, 2)).uniqid();

    // Numeric built-in functions
    echo "<br>";
    $num = -5.67;
    echo abs($num);
    echo "<br>";
    echo round($num);
    echo "<br>";
    echo ceil($num);
    echo "<br>";
    echo floor($num);

    // ++ --
    // .
    echo "<br>" . "Hello" . " World" . "!" . "<br>";
    // trim()
    $text = "   Hello World!   ";
    echo trim($text) . "<br>";
    // stripslashes()
    $str = "Hello\\ World!";
    echo stripslashes($str) . "<br>";

    // built-in string functions
    // strlen()
    $string = "Hello World!";
    echo strlen($string) . "<br>";

    // str_word_count()
    echo str_word_count($string) . "<br>";
    // strrev()
    echo strrev($string) . "<br>";
    // substr()
    echo substr($string, 0, 5) . "<br>";
    // str_replace()
    echo str_replace("World", "PHP", $string) . "<br>";
    // strtolower()
    echo strtolower($string) . "<br>";
    // strtoupper()
    echo strtoupper($string) . "<br>";
    // strpos()
    echo ucfirst($string) . "<br>";

    function myInfo ($fName = "Kuddus", $lName = "Boyati") {
        return "My full name is " . $fName . " " . $lName;
    }

    echo myInfo("Asif", "Khan") . "<br>";
    echo myInfo("Priyongkor", "Sarkar") . "<br>";
    echo myInfo() . "<br>";
    echo myInfo("Adiba") . "<br>";

    // Regular expression
    $myName = "Asif";
    if(preg_match("/^[A-Za-z. ]*$/", $myName)) {
        echo "Matched perfectly";
    }
?>