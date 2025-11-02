<?php
$genders = ["Male", "Female", "Others"];
$allSkill = ["HTML", "CSS", "JS", "PHP", "MySQL"];
$countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");

function safuda($data)
{
    if (gettype($data) == "array") {
        $newData = [];
        foreach ($data as $d) {
            $d = trim($d);
            $d = htmlspecialchars($d);
            $d = stripslashes($d);
            array_push($newData, $d);
        }
        return $newData;
    } else {
        $data = trim($data);
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        return $data;
    }
}

// $errName = $crrName = null;
if (isset($_POST['signup123'])) {
    $name = safuda($_POST['name']);
    $email = safuda($_POST['email']);
    $gender = safuda($_POST['gender'] ?? null);
    $skill = safuda($_POST['skill'] ?? []);
    $cntr = safuda($_POST['cntr'] ?? null);
    $password = safuda($_POST['password']);
    $confirmPassword = safuda($_POST['confirmPassword']);

    if (empty($name)) {
        $errName = "<span style='color: red;'>Please write your name</span>";
    } elseif (!preg_match('/^[A-Za-z-. ]*$/', $name)) {
        $errName = "<span style='color: red;'>Invalid Name!</span>";
    } else {
        $crrName = "<span style='color: green;'>Your name is : $name</span>";
    }

    if (empty($email)) {
        $errEmail = "<span style='color: red;'>Please provide the email address</span>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errEmail = "<span style='color: red;'>Invalid email address!</span>";
    } else {
        $crrEmail = "<span style='color: green;'>Your email is : $email</span>";
    }

    if (empty($gender)) {
        $errGender = "<span style='color: red;'>Please select your gender.</span>";
    } elseif (!in_array($gender, $genders)) {
        $errGender = "<span style='color: red;'>Invalid gender.</span>";
    } else {
        $crrGender = "<span style='color: green;'>Your gender is : $gender</span>";
    }

    if(empty($skill)){
        $errSkill = "<span style='color: red;'>Please select your skills.</span>";
    }elseif(count(array_diff($skill, $allSkill)) != 0){
        $errSkill = "<span style='color: red;'>Paknami bondho korun!</span>";
    }else{
        $strSkill = implode(", ", $skill);
        $crrSkill = "<span style='color: green;'>Your skills are : $strSkill</span>";
    }

    if(empty($cntr)) {
        $errCntr = "<span style='color: red'>Please select your country</span>";
    }elseif(!in_array($cntr, $countries)){
        $errCntr = "<span style='color: red'>Invalid country</span>";
    }else{
        $crrCntr = "<span style='color: green'>Your country is : $cntr</span>";
    }

    if(empty($password)){
        $errPassword = "<span style='color: red'>Please provide your password</span>";
    }elseif(!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z\d\s]).{8,}$/', $password)){
        $errPassword = "<span style='color: red'>Please provide at least 1 capital letter, 1 small letter, 1 special character, 1 number asn at least 8 letters in total</span>";
    }else{
        $crrPassword = $password;
    }

    if(empty($confirmPassword)){
        $errConfirmPassword = "<span style='color: red'>Please provide the confirm password</span>";
    }elseif($password != $confirmPassword){
        $errConfirmPassword = "<span style='color: red'>Confirm password didn't match with the password</span>";
    }else{
        $crrConfirmPassword = $confirmPassword;
    }

    if (isset($crrName) && isset($crrEmail) && isset($crrGender) && isset($crrCntr) && isset($crrPassword) && isset($crrConfirmPassword)) {
        $name = $email = $gender = $skill = $cntr = $password = $confirmPassword = null;
        $successMsg = "
                $crrName
                <br>
                $crrEmail
                <br>
                $crrGender
                <br>
                $crrSkill
                <br>
                $crrCntr
                <br>
                <span style='color: green'>Password matched with the confirm password.</span>
            ";
    }
}
?>

<form action="" method="post">
    <input type="text" placeholder="Your Name" name="name" value="<?= $name ?? null ?>">
    <?= $errName ?? null; ?>
    <br><br>
    <input type="text" placeholder="Your Email" name="email" value="<?= $email ?? null ?>">
    <?= $errEmail ?? null; ?>
    <br><br>
    Gender :
    <label for="male">
        <input type="radio" value="Male" name="gender" id="male" <?= (isset($gender) && $gender == "Male") ? "checked" : null ?>>Male
    </label>
    <label for="female">
        <input type="radio" value="Female" name="gender" id="female" <?= (isset($gender) && $gender == "Female") ? "checked" : null ?>>Female
    </label>
    <label for="others">
        <input type="radio" value="Others" name="gender" id="others" <?= (isset($gender) && $gender == "Others") ? "checked" : null ?>>Others
    </label>
    <?= $errGender ?? null ?>
    <br><br>
    Skills :
    <input type="checkbox" name="skill[]" value="HTML" <?= isset($skill) && in_array("HTML", $skill) ?"checked":null ?> >HTML
    <input type="checkbox" name="skill[]" value="CSS" <?= isset($skill) && in_array("CSS", $skill) ?"checked":null ?>>CSS
    <input type="checkbox" name="skill[]" value="JS" <?= isset($skill) && in_array("JS", $skill) ?"checked":null ?>>JS
    <input type="checkbox" name="skill[]" value="PHP" <?= isset($skill) && in_array("PHP", $skill) ?"checked":null ?>>PHP
    <input type="checkbox" name="skill[]" value="MySQL" <?= isset($skill) && in_array("MySQL", $skill) ?"checked":null ?>>MySQL
    <?= $errSkill ?? null ?>
    <br><br>
    <select name="cntr" id="">
        <option value="">--Select Country--</option>
        <?php foreach($countries as $country){ ?>
            <option value="<?= $country ?>" <?= isset($cntr) && $cntr == $country ? "selected":null ?>><?= $country ?></option>
        <?php } ?>
    </select>
    <?= $errCntr ?? null ?>
    <br><br>
    <input type="password" name="password" placeholder="Password" value="<?= $password ?? null ?>" id="password">
    <?= $errPassword ?? null ?>
    <br><br>
    <input type="password" name="confirmPassword" value="<?= $confirmPassword ?? null ?>" placeholder="Confirm Password" id="confirmPassword">
    <?= $errConfirmPassword ?? null ?>
    <br><br>
    <label for="showPass">
        <input type="checkbox" id="showPass"> Show Password
    </label>
    <br><br>
    <button type="submit" name="signup123">Sign up</button>
    <!-- <input type="submit" value="Register"> -->
</form>

<script>
    const showPass = document.getElementById("showPass");
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("confirmPassword");

    showPass.addEventListener("change", e => {
        if(e.target.checked){
            password.setAttribute("type", "text");
            confirmPassword.setAttribute("type", "text");
        }else{
            password.setAttribute("type", "password");
            confirmPassword.setAttribute("type", "password");
        }
    })
</script>

<?= $successMsg ?? null ?>