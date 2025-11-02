<?php  
    session_start();
    $_SESSION['name'] = "Asif Abir";
    echo $_SESSION['name'];
    /*
    $myName = "Asif Abir";

    function myFunc () {
        $myOtherName = "PHP Developer";
        // return $myName;
        return $GLOBALS['myName']. " ". $myOtherName;
    }

    echo myFunc() . "<br>";
    // echo $myOtherName;

    echo $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

    echo "<pre>";
    print_r($_SERVER);
    echo "</pre>";
    */

    // if(isset($_GET['sub123'])) {
    //     echo $_GET['uName'];
    // }

    // if(isset($_REQUEST['sub123'])) {
    //     echo $_REQUEST['uName'];
    // }

    if(isset($_POST['sub123'])) {
        echo $_POST['uName'];
    }
?>

<form action="" method="get">
    <input type="text" placeholder="your name" name="uName">
    <input type="submit" name="sub123">
</form>

<?php 
// $_ENV
$_ENV['PATH'] = "This is PATH variable";
echo $_ENV['PATH'];

// $_COOKIE
setcookie('user', 'Fakir Alamgir', time() + (86400 * 30), "/"); 
?>