<?php 
    // string
    $data1 = "Ami vaat khai";
    var_dump($data1);
    echo "<br>";

    // integer
    $data2 = 123;
    var_dump($data2);
    echo "<br>";

    // float
    $data3 = 12.3;
    var_dump($data3);
    echo "<br>";

    // boolean
    $data4 = true;
    var_dump($data4);
    echo "<br>";

    // null
    $data5 = null;
    var_dump($data5);
    echo "<br>";

    // array
    $data6 = [1,2,3,4];
    var_dump($data6);
    echo "<br>";

    // object
    $obj = new class {
        public $pro;
    };
    var_dump($obj);
    echo "<br>";

    // resource
    $file = fopen("./day-1.php", "r");
    var_dump($file);
    echo "<br>";

    // Constants
    const x = 123;
    echo x."<br>";

    // define
    define("y", 123);
    echo y."<br>";

    // Comments

    // single line comment
    # this is also a single line comment
    /*
        this is 
        a 
        multiline 
        comment
    */
    /**
     * Bangladesh
     * Dhaka
     * Chittagong
     * Rajshahi
     * Khulna
     */

    echo "$data1 <br>";
    echo '$data1 <br>';

    // operators
    /**
     * Arithmetic Operators
     * + Sum
     * - Subtract
     * * Multiply
     * / Divide
     * % Modulus
     * ** Exponentiation
     */

    /**
     * Assignment Operators
     * = Assign
     * += Add and Assign
     * -= Subtract and Assign
     * *= Multiply and Assign
     * /= Divide and Assign
     * %= Modulus and Assign
     * **= Exponentiation and Assign
     */

    /**
     * Comparison Operators
     * == Equal
     * === Identical
     * != Not Equal
     * !== Not Identical
     * > Greater Than
     * < Less Than
     * >= Greater Than or Equal To
     * <= Less Than or Equal To
     */

    /**
     * Increment / Decrement Operators
     * ++$a Pre-increment
     * $a++ Post-increment
     * --$a Pre-decrement
     * $a-- Post-decrement
     */

    /**
     * Logical Operators
     * && And
     * || Or
     * ! Not
     */

    6 > 3 && 5 === "5"; // false
    6 > 3 || 5 === "5"; // true
?>