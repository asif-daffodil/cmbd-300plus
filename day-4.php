<?php  
    $x = 0;
    while($x < 10) {
        echo $x . "<br>";
        $x++;
    }

    $y = 20;
    do {
        echo $y . "<br>";
        $y++;
    }while ($y < 10);

    for ($i=0; $i < 10; $i++) { 
        echo $i . "<br>";
    }

    $cityList = ["Dhaka", "Rajshahi", "Khulna", "Rangpur"];
    foreach($cityList as $city) {
        echo $city . "<br>";
    }

    // Indexed array
    echo "<pre>";
    echo print_r($cityList);
    echo "</pre>";

    // Associative array
    $studentInfo = ["studentName" => "Adiba Sarker", "studentCity" => "Dhaka", "studentGender" => "Female"];

    echo "<pre>";
    echo print_r($studentInfo);
    echo "</pre>";

    echo $cityList[0] . "<br>";
    echo $studentInfo["studentName"] . "<br>";

    // Multidimensional array
    $students = [["Kamal", 22], ["Jamal", 23], ["Tamal", 25]];
    echo "<pre>";
    echo print_r($students);
    echo "</pre>";
    echo $students[2][0]."<br>";

    for ($i=0; $i < count($cityList); $i++) { 
        echo $cityList[$i] . "<br>";
    }

    foreach ($studentInfo as $key => $stdInfo) {
        echo ucfirst($key) . " : " . ucfirst($stdInfo) . "<br>";
    }

    foreach($students as $stds){
        foreach($stds as $std) {
            echo $std. " ";
        }
        echo "<br>";
    }

    // array()
    $countryArr = array("Bangladesh", "India", "Pakistan");
    echo $countryArr[0] . "<br>";

    // is_array()
    if (is_array($countryArr)) {
        echo "This is an array" . "<br>";
    } else {
        echo "This is not an array" . "<br>";
    }

    // in_array()
    if (in_array("India", $countryArr)) {
        echo "India is found in the array" . "<br>";
    } else {
        echo "India is not found in the array" . "<br>";
    }

    // array_merge()
    $newCountryArr = array("USA", "UK", "Canada");
    $allCountryArr = array_merge($countryArr, $newCountryArr);
    echo "<pre>";
    echo print_r($allCountryArr);
    echo "</pre>";

    // array_keys()
    $allStudentInfoKeys = array_keys($studentInfo);
    echo "<pre>";
    echo print_r($allStudentInfoKeys);
    echo "</pre>";

    // array_key_exists()
    if (array_key_exists("studentName", $studentInfo)) {
        echo "Key 'studentName' exists in the array" . "<br>";
    } else {
        echo "Key 'studentName' does not exist in the array" . "<br>";
    }

    // array_shift()
    $firstStudent = array_shift($students);
    echo "First Student: " . print_r($firstStudent, true) . "<br>";
    echo "<pre>";
    echo print_r($students);
    echo "</pre>";

    // array_unshift()
    array_unshift($students, ["Salam", 24]);
    echo "<pre>";
    echo print_r($students);
    echo "</pre>";

    // array_push()
    array_push($students, ["Akmal", 26]);
    echo "<pre>";
    echo print_r($students);
    echo "</pre>";

    // array_pop()
    $lastStudent = array_pop($students);
    echo "Last Student: " . print_r($lastStudent, true) . "<br>";
    echo "<pre>";
    echo print_r($students);
    echo "</pre>";

    // array_values()
    $studentInfoValues = array_values($studentInfo);
    echo "<pre>";
    echo print_r($studentInfoValues);
    echo "</pre>";

    // array_map()
    function square($n) {
        return $n * $n;
    }

    $numbers = [1, 2, 3, 4, 5];
    $squaredNumbers = array_map("square", $numbers);
    echo "<pre>";
    echo print_r($squaredNumbers);
    echo "</pre>";

    // array_unique()
    $duplicateNumbers = [1, 2, 2, 3, 4, 4, 5];
    $uniqueNumbers = array_unique($duplicateNumbers);
    echo "<pre>";
    echo print_r($uniqueNumbers);
    echo "</pre>";

    // array_slice()
    $slicedArray = array_slice($numbers, 1, 3);
    echo "<pre>";
    echo print_r($slicedArray);
    echo "</pre>";

    // array_diff()
    $array1 = [1, 2, 3, 4, 5];
    $array2 = [4, 5, 6, 7, 8];
    $difference = array_diff($array1, $array2);
    echo "<pre>";
    echo print_r($difference);
    echo "</pre>";

    // array_search()
    $searchKey = array_search(3, $array1);
    if ($searchKey !== false) {
        echo "Value 3 found at index: " . $searchKey . "<br>";
    } else {
        echo "Value 3 not found in the array" . "<br>";
    }

    // array_reverse()
    $reversedArray = array_reverse($numbers);
    echo "<pre>";
    echo print_r($reversedArray);
    echo "</pre>";
?>