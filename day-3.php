<?php  
    // Mathematical functions
    echo abs(-223);
    echo "<br>";
    echo round(5.4);
    echo "<br>";
    echo floor(5.9);
    echo "<br>";
    echo ceil(5.1);
    echo "<br>";
    echo pi();
    echo "<br>";
    echo rand(1, max: 100);
    echo "<br>";
    echo sqrt(64);
    echo "<br>";
    echo uniqid();
    echo "<br>";
    echo pow(2, 3);
    echo "<br>";

    // if, else if, else
    $age = -20;
    if($age < 12 && $age > 0) {
        echo "You are a child";
    } else if ($age < 20 && $age > 12) {
        echo "You are a teenager";
    } else if ($age < 30 && $age > 20) {
        echo "You are a young adult";
    } else if ($age < 50 && $age > 30) {
        echo "You are a middle-aged adult";
    } else if ($age < 150 && $age > 50) {
        echo "You are an old person";
    }else {
        echo "You are not in this world";
    }

    echo "<br>";

    // Switch case
    $day = Date("l");
    switch($day) {
        case("Sunday");
        echo "Today is Sunday";
        break;
        case("Monday");
        echo "Today is Monday";
        break;
        case("Tuesday");
        echo "Today is Tuesday";
        break;
        case("Wednesday");
        echo "Today is Wednesday";
        break;
        case("Thursday");
        echo "Today is Thursday";
        break;
        case("Friday");
        echo "Today is Friday";
        break;
        case("Saturday");
        echo "Today is Saturday";
        break;
    }

    echo "<br>";
    // ternary
    $num = 12;
    echo ($num < 10) ? "The number is smaller than 10" : "The number is grater than 10";
    echo "<br>";

    // null safe
    echo $city ?? "Dhaka";
    echo "<br>";

    $unit = 275;
    $bill = 0;
    if($unit <= 50) {
        $bill = 50 * 3.50;
    }else if($unit > 50 && $unit <= 150) {
        $bill = (50 * 3.50) + (($unit-50) * 4);
    }else if($unit > 150 && $unit <= 250){
        $bill = (50 * 3.50) + (100 * 4) + (($unit - 150) * 5.20);
    }elseif ($unit > 250) {
        $bill = (50 * 3.50) + (100 * 4) + (100 * 5.20) + (($unit - 250) * 6.50);
    }
    echo $bill;
?>