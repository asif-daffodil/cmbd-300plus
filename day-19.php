<?php

    $conn = mysqli_connect("localhost", "root", "", "b309");
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $selectStudentsQuery = "SELECT * FROM `students`";
    $studentsResult = $conn->query($selectStudentsQuery);

    if (isset($_POST['submit'])) {
        $name = test_input($_POST['name']);
        $gender = test_input($_POST['gender']);
        $isMarried = test_input($_POST['isMarried'] ?? null);
        $mobile = test_input($_POST['mobile']);

        // validation
        if(empty($name)){
            $errName = "<span style='color:red;'>Name is required</span>";
        }else if(!preg_match("/^[a-zA-Z-'. ]*$/", $name)){
            $errName = "<span style='color:red;'>Only letters and white space allowed</span>";
        }else{
            $currName = $conn->real_escape_string($name);
        }

        // Gender enum('Male', 'Female') and required
        if(empty($gender)){
            $errGender = "<span style='color:red;'>Gender is required</span>";
        }else if(!in_array($gender, ['male', 'female'])){
            $errGender = "<span style='color:red;'>Invalid gender</span>";
        }else{
            $currGender = $conn->real_escape_string($gender);
        }

        // isMarried tinyint(1) required
        if(!isset($isMarried)){
            $errIsMarried = "<span style='color:red;'>Marital status is required</span>";
        }else if($isMarried !== 'yes' && $isMarried !== 'no'){
            $errIsMarried = "<span style='color:red;'>Invalid marital status</span>";
        }else{
            $currIsMarried = $conn->real_escape_string($isMarried === 'yes' ? 1 : 0);
        }

        // mobile varchar(11) required
        if(empty($mobile)){
            $errMobile = "<span style='color:red;'>Mobile number is required</span>";
        }else if(!preg_match("/^[0-9]{11}$/", $mobile)){
            $errMobile = "<span style='color:red;'>Invalid mobile number</span>";
        }else{
            $currMobile = $conn->real_escape_string($mobile);
        }

        // If no errors, insert into database
        if(isset($currName) && isset($currGender) && isset($currIsMarried) && isset($currMobile)){
            $insertQuery = "INSERT INTO `students` (`name`, `gender`, `isMarried`, `mobile`) VALUES ('$currName', '$currGender', $currIsMarried, '$currMobile')";
            $insert = $conn->query($insertQuery);
            if($insert){
                echo "<script>alert('Student added successfully');</script>";
            }else{
                echo "<script>alert('Error adding student');</script>";
            }
        }else{
            echo "<script>alert('Error: Missing required fields');</script>";
        }
    }

    if (isset($_POST['update'])) {
        $editId = $_GET['eid'];
        $name = test_input($_POST['name']);
        $gender = test_input($_POST['gender']);
        $isMarried = test_input($_POST['isMarried'] ?? null);
        $mobile = test_input($_POST['mobile']);

        // validation
        if(empty($name)){
            $errName = "<span style='color:red;'>Name is required</span>";
        }else if(!preg_match("/^[a-zA-Z-'. ]*$/", $name)){
            $errName = "<span style='color:red;'>Only letters and white space allowed</span>";
        }else{
            $currName = $conn->real_escape_string($name);
        }

        // Gender enum('Male', 'Female') and required
        if(empty($gender)){
            $errGender = "<span style='color:red;'>Gender is required</span>";
        }else if(!in_array($gender, ['male', 'female'])){
            $errGender = "<span style='color:red;'>Invalid gender</span>";
        }else{
            $currGender = $conn->real_escape_string($gender);
        }

        // isMarried tinyint(1) required
        if(!isset($isMarried)){
            $errIsMarried = "<span style='color:red;'>Marital status is required</span>";
        }else if($isMarried !== 'yes' && $isMarried !== 'no'){
            $errIsMarried = "<span style='color:red;'>Invalid marital status</span>";
        }else{
            $currIsMarried = $conn->real_escape_string($isMarried === 'yes' ? 1 : 0);
        }

        // mobile varchar(11) required
        if(empty($mobile)){
            $errMobile = "<span style='color:red;'>Mobile number is required</span>";
        }else if(!preg_match("/^[0-9]{11}$/", $mobile)){
            $errMobile = "<span style='color:red;'>Invalid mobile number</span>";
        }else{
            $currMobile = $conn->real_escape_string($mobile);
        }

        // If no errors, update database
        if(isset($currName) && isset($currGender) && isset($currIsMarried) && isset($currMobile)){
            $updateQuery = "UPDATE `students` SET `name` = '$currName', `gender` = '$currGender', `isMarried` = $currIsMarried, `mobile` = '$currMobile' WHERE `id` = $editId";
            $update = $conn->query($updateQuery);
            if($update){
                echo "<script>alert('Student updated successfully');</script>";
            }else{
                echo "<script>alert('Error updating student');</script>";
            }
        }else{
            echo "<script>alert('Error: Missing required fields');</script>";
        }
    }

    if (isset($_GET['did'])) {
        $deleteId = $_GET['did'];
        $deleteQuery = "DELETE FROM `students` WHERE `id` = $deleteId";
        $delete = $conn->query($deleteQuery);
        if($delete){
            echo "<script>alert('Student deleted successfully');location.href='./day-19.php';</script>";
        }else{
            echo "<script>alert('Error deleting student');</script>";
        }
    }
?>

<?php if(!isset($_GET['eid'])){ ?>
<form action="" method="post">
    <h2>Add Student</h2>
    <!-- Fields: name, gender, isMarried, mobile -->
    Name: <input type="text" name="name" placeholder="Enter your name">
    <?= $errName ?? '' ?>
    <br>
    Gender: 
    <select name="gender">
        <option value="">Select gender</option>
        <option value="male">Male</option>
        <option value="female">Female</option>
    </select>
    <?= $errGender ?? '' ?>
    <br>
    Is Married: 
    <input type="radio" name="isMarried" value="yes"> Yes
    <input type="radio" name="isMarried" value="no"> No
    <?= $errIsMarried ?? '' ?>
    <br>
    Mobile: <input type="text" name="mobile" placeholder="Enter your mobile number">
    <?= $errMobile ?? '' ?>
    <br>
    <button type="submit" name="submit">Submit</button>
</form>


<?php  
    if ($studentsResult->num_rows > 0) {
?>
    <h2>Students List</h2>
    <table border="1">
        <tr>
            <th>S.No</th>
            <th>Name</th>
            <th>Gender</th>
            <th>Marital Status</th>
            <th>Mobile</th>
            <th>Action</th>
        </tr>
    <?php
        $sn = 1;
        while($row = $studentsResult->fetch_assoc()) {
    ?>
        <tr>
            <td><?php echo $sn++; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['gender']; ?></td>
            <td><?php echo $row['isMarried'] ? 'Yes' : 'No'; ?></td>
            <td><?php echo $row['mobile']; ?></td>
            <td>
                <a href="./day-19.php?eid=<?php echo $row['id']; ?>">Edit</a> | 
                <a href="./day-19.php?did=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
            </td>
        </tr>
    <?php } ?>
    </table>
<?php }else{ ?>
    <h2>No Students Found</h2>
<?php } ?>
<?php } ?>

<?php 
    if(isset($_GET['eid'])){
        $editId = $_GET['eid'];
        $editQuery = "SELECT * FROM `students` WHERE `id` = $editId";
        $editResult = $conn->query($editQuery);
        if($editResult->num_rows === 1){
            $editRow = $editResult->fetch_assoc();
            $name = $editRow['name'];
            $gender = $editRow['gender'];
            $isMarried = $editRow['isMarried'] ? 'yes' : 'no';
            $mobile = $editRow['mobile'];
        }
?>
<form action="" method="post">
    <h2>Edit Student</h2>
    <!-- Fields: name, gender, isMarried, mobile -->
    Name: <input type="text" name="name" value="<?php echo $name ?? ''; ?>">
    <?= $errName ?? '' ?>
    <br>
    Gender: 
    <select name="gender">
        <option value="">Select gender</option>
        <option value="Male" <?php echo (isset($gender) && $gender === 'Male') ? 'selected' : ''; ?>>Male</option>
        <option value="Female" <?php echo (isset($gender) && $gender === 'Female') ? 'selected' : ''; ?>>Female</option>
    </select>
    <?= $errGender ?? '' ?>
    <br>
    Is Married: 
    <input type="radio" name="isMarried" value="yes" <?php echo (isset($isMarried) && $isMarried === 'yes') ? 'checked' : ''; ?>> Yes
    <input type="radio" name="isMarried" value="no" <?php echo (isset($isMarried) && $isMarried === 'no') ? 'checked' : ''; ?>> No
    <?= $errIsMarried ?? '' ?>
    <br>
    Mobile: <input type="text" name="mobile" value="<?php echo $mobile ?? ''; ?>">
    <?= $errMobile ?? '' ?>
    <br>
    <button type="submit" name="update">Update</button>
    <!-- back button -->
    <button type="button" onclick="location.href='./day-19.php'">Back</button>
</form>

<?php 
    }
?>