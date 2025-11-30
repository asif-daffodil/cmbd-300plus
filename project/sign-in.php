<?php
if (isset($_SESSION['user'])) {
    // User is already logged in, redirect to home page
    header('Location: index.php');
    exit();
}
require_once 'header.php';

if (isset($_POST['loginBtn'])) {
  // Handle form submission logic here
  $email = validate_data($_POST['email']);
  $password = validate_data($_POST['password']);

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
  } else {
    $currPassword = $conn->real_escape_string($password);
  }

  // If no errors, proceed to authenticate the user
  if (isset($currEmail) && isset($currPassword)) {
    $selectQuery = "SELECT * FROM users WHERE email='$currEmail'";
    $result = $conn->query($selectQuery);

    if ($result->num_rows > 0) {
      $user = $result->fetch_assoc();
      // Verify the password
      if (password_verify($currPassword, $user['password'])) {
        // Authentication successful, redirect to dashboard or home page
        $_SESSION['user'] = $user;
        echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Login Successful',
                        text: 'Welcome back!',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = './';
                    });
                </script>";
      } else {
        echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Login Failed',
                        text: 'Incorrect password.',
                        confirmButtonText: 'OK'
                    });
                </script>";
      }
    } else {
      echo "<script>
                  Swal.fire({
                      icon: 'error',
                      title: 'Login Failed',
                      text: 'No account found with that email.',
                      confirmButtonText: 'OK'
                  });
              </script>";
    }
  }
}

?>
<div class="bg-gray-100 lg:h-screen flex items-center justify-center p-4">
  <div class="max-w-6xl bg-white [box-shadow:0_2px_10px_-3px_rgba(6,81,237,0.3)] p-4 lg:p-5 rounded-md">
    <div class="grid md:grid-cols-2 items-center gap-y-8">
      <form action="" method="post" class="max-w-md mx-auto w-full p-4 md:p-6">
        <div class="mb-8">
          <a href="javascript:void(0)" class="inline-block">
            <img src="https://readymadeui.com/readymadeui.svg" alt="logo" class="w-40" />
          </a>
        </div>

        <div class="space-y-6">
          <div>
            <label class="text-slate-900 text-sm font-medium mb-2 block">Email</label>
            <div class="relative flex items-center">
              <input name="email" type="text" class="w-full text-sm text-slate-900 bg-slate-100 focus:bg-transparent pl-4 pr-10 py-3 rounded-md border border-slate-100 focus:border-blue-600 outline-none transition-all" placeholder="Enter email" value="<?php if (isset($currEmail)) echo $currEmail; ?>" />
              <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-[18px] h-[18px] absolute right-4" viewBox="0 0 682.667 682.667">
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
            <label class="text-slate-900 text-sm font-medium mb-2 block">Password</label>
            <div class="relative flex items-center">
              <input name="password" type="password" class="w-full text-sm text-slate-900 bg-slate-100 focus:bg-transparent pl-4 pr-10 py-3 rounded-md border border-slate-100 focus:border-blue-600 outline-none transition-all" placeholder="Enter password" value="<?php if (isset($currPassword)) echo $currPassword; ?>" />
              <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-[18px] h-[18px] absolute right-4 cursor-pointer" viewBox="0 0 128 128">
                <path d="M64 104C22.127 104 1.367 67.496.504 65.943a4 4 0 0 1 0-3.887C1.367 60.504 22.127 24 64 24s62.633 36.504 63.496 38.057a4 4 0 0 1 0 3.887C126.633 67.496 105.873 104 64 104zM8.707 63.994C13.465 71.205 32.146 96 64 96c31.955 0 50.553-24.775 55.293-31.994C114.535 56.795 95.854 32 64 32 32.045 32 13.447 56.775 8.707 63.994zM64 88c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm0-40c-8.822 0-16 7.178-16 16s7.178 16 16 16 16-7.178 16-16-7.178-16-16-16z" data-original="#000000"></path>
              </svg>
            </div>
            <div class="mb-2 text-sm text-red-600">
              <?php if (isset($errPassword)) {
                echo $errPassword;
              } ?>
            </div>
          </div>
          <div class="flex flex-wrap items-center gap-4 justify-between">
            <div class="flex items-center">
              <input id="remember-me" name="remember-me" type="checkbox" class="shrink-0 h-4 w-4 text-blue-600 focus:ring-blue-500 border-slate-300 rounded-md" />
              <label for="remember-me" class="ml-3 block text-sm text-slate-900">
                Remember me
              </label>
            </div>
            <div class="text-sm">
              <a href="jajvascript:void(0);" class="text-blue-600 font-medium hover:underline">
                Forgot password?
              </a>
            </div>
          </div>
        </div>

        <div class="mt-12">
          <button type="submit" class="w-full shadow-xl py-2 px-4 text-[15px] tracking-wide font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none cursor-pointer" name="loginBtn">
            Sign in
          </button>
          <p class="text-sm mt-6 text-center text-slate-600">Don't have an account? <a href="./sign-up.php" class="text-blue-600 font-medium tracking-wide hover:underline ml-1">Register here</a></p>
        </div>
      </form>

      <div class="w-full h-full">
        <div class="aspect-square bg-gray-50 relative before:absolute before:inset-0 before:bg-indigo-600/70 rounded-md overflow-hidden w-full h-full">
          <img src="https://readymadeui.com/team-image.webp" class="w-full h-full object-cover" alt="login img" />
          <div class="absolute inset-0 m-auto max-w-sm p-6 flex items-center justify-center">
            <div>
              <h1 class="text-white text-4xl font-semibold">Sign in</h1>
              <p class="text-slate-100 text-[15px] font-medium mt-6 leading-relaxed">Sign in to your account and explore a world of possibilities. Your journey begins here.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
require_once 'footer.php';
?>