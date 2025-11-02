<?php  
    // basename
    $url = "https://myweb.com/index.php";
    echo basename($url)."<br>";
    echo dirname($url)."<br>";

    /*
    // copy()
    $source = "day-10.php";
    $destination = "day-10-copy.php";
    if (copy($source, $destination)) {
        echo "File copied successfully.";
    } else {
        echo "Failed to copy file.";
    }

    // file_get_contents
    $fileContent = file_get_contents("day-10.php");
    echo nl2br(htmlspecialchars($fileContent));
    */

    // link()
    // link("./day-10.php", "./day-10-link.php");

    // JSON (encode, decode)
    $data = ["name" => "John", "age" => 30];
    $json = json_encode($data);
    echo $json;

    $decoded = json_decode($json, true);
    print_r($decoded);
    echo "<br>";

    // Date Time
    date_default_timezone_set("Asia/Dhaka");
    echo date("Y-m-d H:i:s a D")."<br>";
    echo date("y-M-d h:i:s A l")."<br>";
    echo date("y-F-d h:i:s A l")."<br>";

    // mktime()
    $timestamp = mktime(15, 30, 0, 12, 25, 2024);
    echo date("Y-m-d H:i:s l", $timestamp)."<br>";

    // strtotime()
    $timeString = "next Friday";
    $timestamp = strtotime($timeString);
    echo date("Y-m-d H:i:s l", $timestamp)."<br>";
    $timestamp = strtotime("+2 weeks 3 days 5 hours");
    echo date("Y-m-d H:i:s l", $timestamp)."<br>";

?>