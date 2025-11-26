<?php
session_start();
if (isset($_SESSION['user'])) {
    // User is already logged in, redirect to home page
    header('Location: index.php');
    exit();
}
require_once 'header.php';

if (isset($_POST['registerBtn'])) {
  // Handle form submission logic here
  $name = validate_data($_POST['name']);
  $email = validate_data($_POST['email']);
  $password = validate_data($_POST['password']);
  $accept_terms = isset($_POST['accept_terms']) ? 1 : 0;

  // accept terms logic here
  if (!$accept_terms) {
    $errAccept = "You must accept the terms and conditions.";
  } else {
    // validate name 
    if (empty($name)) {
      $errName = "Name is required.";
    } else {
      $currName = $conn->real_escape_string($name);
    }

    // validate Email
    if (empty($email)) {
      $errEmail = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errEmail = "Invalid email format.";
    } else {
      $currEmail = $conn->real_escape_string($email);
    }

    // validate password
    if (empty($password)) {
      $errPassword = "Password is required.";
    } elseif (strlen($password) < 6) {
      $errPassword = "Password must be at least 6 characters.";
    } else {
      $currPassword = $conn->real_escape_string($password);
    }

    // If no errors, proceed to register the user
    if (isset($currName) && isset($currEmail) && isset($currPassword)) {
      // Hash the password before storing
      $hashedPassword = password_hash($currPassword, PASSWORD_BCRYPT);

      // Insert user into database
      $insertQuery = "INSERT INTO users (`name`, `email`, `password`) VALUES ('$currName', '$currEmail', '$hashedPassword')";
      if ($conn->query($insertQuery) === TRUE) {
        // Registration successful, redirect to sign-in page
        echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Registration Successful',
                        text: 'Your account has been created successfully.',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = 'sign-in.php';
                    });
                </script>";
      } else {
        echo "Error: " . $conn->error;
      }
    }
  }
}

?>
<div class="md:min-h-screen flex items-center justify-center p-4">
  <div class="max-w-4xl mx-auto shadow-[0_2px_10px_-3px_rgba(14,14,14,0.3)] rounded-xl overflow-hidden">
    <div class="grid md:grid-cols-5 items-center">
      <div class="md:col-span-2 max-md:order-1 relative before:absolute before:inset-0 before:bg-blue-800/70 overflow-hidden w-full h-full">
        <div class="md:aspect-[6/10] max-sm:aspect-[6/7]">
          <img src="https://readymadeui.com/images/real-estate-img.webp" class="w-full h-full object-cover" alt="signup-image" />
        </div>
        <div class="absolute inset-0 m-auto flex items-end justify-center max-md:text-center">
          <div class="bg-gradient-to-t from-black/50 via-black/50 to-transparent p-6 w-full">
            <div class="max-w-md mx-auto">
              <h1 class="text-white text-3xl font-semibold">Join Us Today</h1>
              <p class="text-slate-300 text-[15px] font-medium mt-6 leading-relaxed">
                Create your free account and unlock access to powerful tools, personalized features, and exclusive content.
                <br /><br />
                Sign up now and take the first step toward your next big opportunity.
              </p>
            </div>
          </div>
        </div>
      </div>

      <div class="md:col-span-3 w-full p-6 md:p-8 max-w-lg mx-auto">
        <form action="" method="post">
          <div class="mb-8">
            <h2 class="text-slate-900 text-2xl font-semibold">Register Now</h2>
          </div>

          <div class="space-y-6">
            <div>
              <label class="text-slate-900 text-sm font-medium block mb-2">Name</label>
              <div class="relative flex items-center">
                <input name="name" type="text" class="w-full text-sm text-slate-900 border-b border-slate-300 focus:border-blue-600 pr-8 px-2 py-3 outline-none" placeholder="Enter name" value="<?php if (isset($currName)) echo $currName; ?>" />
                <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-[18px] h-[18px] absolute right-2" viewBox="0 0 24 24">
                  <circle cx="10" cy="7" r="6" data-original="#000000"></circle>
                  <path d="M14 15H6a5 5 0 0 0-5 5 3 3 0 0 0 3 3h12a3 3 0 0 0 3-3 5 5 0 0 0-5-5zm8-4h-2.59l.3-.29a1 1 0 0 0-1.42-1.42l-2 2a1 1 0 0 0 0 1.42l2 2a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42l-.3-.29H22a1 1 0 0 0 0-2z" data-original="#000000"></path>
                </svg>
              </div>
              <div class="mb-2 text-sm text-red-600">
                <?php if (isset($errName)) {
                  echo $errName;
                } ?>
              </div>
            </div>
            <div>
              <label class="text-slate-900 text-sm font-medium block mb-2">Email</label>
              <div class="relative flex items-center">
                <input name="email" type="text" class="w-full text-sm text-slate-900 border-b border-slate-300 focus:border-blue-600 pr-8 px-2 py-3 outline-none" placeholder="Enter email" value="<?php if (isset($currEmail)) echo $currEmail; ?>" />
                <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-[18px] h-[18px] absolute right-2" viewBox="0 0 682.667 682.667">
                  <defs>
                    <clipPath id="a" clipPathUnits="userSpaceOnUse">
                      <path d="M0 512h512V0H0Z" data-original="#000000"></path>
                    </clipPath>
                  </defs>
                  <g clip-path="url(#a)" transform="matrix(1.33 0 0 -1.33 0 682.667)">
                    <path fill="none" stroke-miterlimit="10" stroke-width="40" d="M452 444H60c-22.091 0-40-17.909-40-40v-39.446l212.127-157.782c14.17-10.54 33.576-10.54 47.746 0L492 364.554V404c0 22.091-17.909 40-40 40Z" data-original="#000000"></path>
                    <path d="M472 274.9V107.999c0-11.027-8.972-20-20-20H60c-11.028 0-20 8.973-20 20V274.9L0 304.652V107.999c0-33.084 26.916-60 60-60h392c33.084 0 60 26.916 60 60v196.653Z" data-original="#000000"></path>
                  </g>
                </svg>
              </div>
              <div class="mb-2 text-sm text-red-600">
                <?php if (isset($errEmail)) {
                  echo $errEmail;
                } ?>
              </div>
            </div>
            <div>
              <label class="text-slate-900 text-sm font-medium block mb-2">Password</label>
              <div class="relative flex items-center">
                <input name="password" type="password" class="w-full text-sm text-slate-900 border-b border-slate-300 focus:border-blue-600 pr-8 px-2 py-3 outline-none" placeholder="Enter password" value="<?php if (isset($currPassword)) echo $currPassword; ?>" />
                <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-[18px] h-[18px] absolute right-2 cursor-pointer" viewBox="0 0 128 128">
                  <path d="M64 104C22.127 104 1.367 67.496.504 65.943a4 4 0 0 1 0-3.887C1.367 60.504 22.127 24 64 24s62.633 36.504 63.496 38.057a4 4 0 0 1 0 3.887C126.633 67.496 105.873 104 64 104zM8.707 63.994C13.465 71.205 32.146 96 64 96c31.955 0 50.553-24.775 55.293-31.994C114.535 56.795 95.854 32 64 32 32.045 32 13.447 56.775 8.707 63.994zM64 88c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm0-40c-8.822 0-16 7.178-16 16s7.178 16 16 16 16-7.178 16-16-7.178-16-16-16z" data-original="#000000"></path>
                </svg>
              </div>
              <div class="mb-2 text-sm text-red-600">
                <?php if (isset($errPassword)) {
                  echo $errPassword;
                } ?>
              </div>
            </div>
            <div class="flex items-center">
              <input id="remember-me" name="accept_terms" type="checkbox" class="h-4 w-4 shrink-0 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" <?php if (isset($accept_terms) && $accept_terms) echo 'checked'; ?> />
              <label for="remember-me" class="ml-3 block text-sm text-slate-600">
                I accept the <a href="javascript:void(0);" class="text-blue-600 font-medium hover:underline ml-1">Terms and Conditions</a>
              </label>
            </div>
            <div class="mb-2 text-sm text-red-600" style="margin-top: -20px;">
              <?php if (isset($errAccept)) {
                echo $errAccept;
              } ?>
            </div>
          </div>
          <div class="mt-8">
            <button type="submit" class="w-full py-2.5 px-4 tracking-wider text-sm rounded-md text-white bg-slate-800 hover:bg-slate-900 focus:outline-none cursor-pointer" name="registerBtn">
              Create an account
            </button>
          </div>
          <p class="text-slate-600 text-sm mt-6 text-center">Already have an account? <a href="./sign-in.php" class="text-blue-600 font-medium hover:underline ml-1">Login here</a></p>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
require_once 'footer.php';
?>