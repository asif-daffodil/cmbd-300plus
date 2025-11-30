<?php  
  require_once 'header.php';

  // Update profile
  if (isset($_POST['update_profile'])) {
      $name = validate_data($_POST['name']);
      $email = validate_data($_POST['email']);
      $mobile = validate_data($_POST['mobile']);
      $gender = validate_data($_POST['gender']);
      $address = $_POST['address']; // Will sanitize later
        // Basic validation
      if (empty($name) || empty($email) || empty($mobile) || empty($gender) || empty($address)) {
        $updateProfileQuery = "UPDATE users SET 
            name='" . $conn->real_escape_string($name) . "',
            email='" . $conn->real_escape_string($email) . "',
            mobile='" . $conn->real_escape_string($mobile) . "',
            gender='" . $conn->real_escape_string($gender) . "',
            address='" . $conn->real_escape_string($address) . "'
          WHERE id='" . $conn->real_escape_string($_SESSION['user']['id']) . "'";
          if ($conn->query($updateProfileQuery) === TRUE) {
              echo "<script>Swal.fire({icon: 'success', title: 'Profile Updated', text: 'Your profile has been updated.'});</script>";
          } else {
              echo "<script>Swal.fire({icon: 'error', title: 'Update Error', text: 'There was an error updating your profile.'});</script>";
          }
          exit;
      }

      // Update session data
      $_SESSION['user']['name'] = $name;
      $_SESSION['user']['email'] = $email;
      $_SESSION['user']['mobile'] = $mobile;
      $_SESSION['user']['gender'] = $gender;
      $_SESSION['user']['address'] = $address;

      // Provide a small success feedback using SweetAlert (header.php already includes SweetAlert)
      echo "<script>Swal.fire({icon: 'success', title: 'Profile Updated', text: 'Your profile has been updated.'});</script>";
  }

  // Change Password
    if (isset($_POST['change_password'])) {
        $current_password = validate_data($_POST['current_password']);
        $new_password = validate_data($_POST['new_password']);
        $confirm_password = validate_data($_POST['confirm_password']);
    
        // Fetch current password hash from database
        $userId = $conn->real_escape_string($_SESSION['user']['id']);
        $selectQuery = "SELECT password FROM users WHERE id='$userId'";
        $result = $conn->query($selectQuery);
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $hashedPassword = $user['password'];
    
            // Verify current password
            if (password_verify($current_password, $hashedPassword)) {
                // Check if new password and confirm password match
                if ($new_password === $confirm_password) {
                    // Hash the new password
                    $newHashedPassword = password_hash($new_password, PASSWORD_BCRYPT);
                    // Update password in database
                    $updatePasswordQuery = "UPDATE users SET password='$newHashedPassword' WHERE id='$userId'";
                    if ($conn->query($updatePasswordQuery) === TRUE) {
                        echo "<script>Swal.fire({icon: 'success', title: 'Password Changed', text: 'Your password has been changed successfully.'});</script>";
                    } else {
                        echo "<script>Swal.fire({icon: 'error', title: 'Update Error', text: 'There was an error updating your password.'});</script>";
                    }
                } else {
                    echo "<script>Swal.fire({icon: 'error', title: 'Mismatch', text: 'New password and confirm password do not match.'});</script>";
                }
            } else {
                echo "<script>Swal.fire({icon: 'error', title: 'Incorrect Password', text: 'The current password you entered is incorrect.'});</script>";
            }
        }
    }
  // change_image
  if (isset($_POST['change_image'])) {
      // Handle profile picture upload
      if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
          $fileTmpPath = $_FILES['image']['tmp_name'];
          $fileName = $_FILES['image']['name'];
          $fileSize = $_FILES['image']['size'];
          $fileType = $_FILES['image']['type'];
          $fileNameCmps = explode(".", $fileName);
          $fileExtension = strtolower(end($fileNameCmps));
  
          // Sanitize file name
          $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
  
          // Check if file size is within limit (e.g., 2MB)
          if ($fileSize > 2 * 1024 * 1024) {
              echo "<script>Swal.fire({icon: 'error', title: 'File Too Large', text: 'The profile picture must be less than 2MB.'});</script>";
              exit;
          }
  
          // Allowed file extensions
          $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg');
          if (in_array($fileExtension, $allowedfileExtensions)) {
              // Directory in which the uploaded file will be moved
              $uploadFileDir = './uploads/images/';
              $dest_path = $uploadFileDir . $newFileName;

             // Remove previous profile picture if exists   
              if (isset($_SESSION['user']['image'])) {
                  $oldFilePath = $_SESSION['user']['image'];
                  if (file_exists($oldFilePath)) {
                      unlink($oldFilePath);
                  }
              }

             // Crete directory if not exists
                if (!is_dir($uploadFileDir)) {
                    mkdir($uploadFileDir, 0755, true);
                }   

              if(move_uploaded_file($fileTmpPath, $dest_path)) {
                  // Update user's profile picture path in database
                  $userId = $conn->real_escape_string($_SESSION['user']['id']);
                  $updatePictureQuery = "UPDATE users SET `image`='" . $conn->real_escape_string($dest_path) . "' WHERE id='$userId'";
                  if ($conn->query($updatePictureQuery) === TRUE) {
                      // Update session data
                      $_SESSION['user']['image'] = $dest_path;
                      echo "<script>Swal.fire({icon: 'success', title: 'Profile Picture Updated', text: 'Your profile picture has been updated.'});</script>";
                  } else {
                      echo "<script>Swal.fire({icon: 'error', title: 'Update Error', text: 'There was an error updating your profile picture.'});</script>";
                  }
              } else {
                  echo "<script>Swal.fire({icon: 'error', title: 'Upload Error', text: 'There was an error uploading your profile picture.'});</script>";
              }
          } else {
              echo "<script>Swal.fire({icon: 'error', title: 'Invalid File Type', text: 'Only JPG, GIF, PNG, and JPEG files are allowed.'});</script>";
          }
      } else {
          echo "<script>Swal.fire({icon: 'error', title: 'Upload Error', text: 'There was an error uploading your profile picture.'});</script>";
      }
  }

?>

<!-- User Profile Section -->
<!-- Fields: `name`, `email`, `mobile`, `gender`, `address` -->
<!-- Form with previous data from session -->
<form action="" method="post">
  <div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold mb-6">User Profile</h2>
    
    <div class="mb-4">
      <label for="name" class="block text-gray-700 font-medium mb-2">Name</label>
      <input type="text" id="name" name="name" value="<?php echo isset($_SESSION['user']['name']) ? htmlspecialchars($_SESSION['user']['name']) : ''; ?>" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
    </div>
    
    <div class="mb-4">
      <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
      <input type="email" id="email" name="email" value="<?php echo isset($_SESSION['user']['email']) ? htmlspecialchars($_SESSION['user']['email']) : ''; ?>" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
    </div>
    
    <div class="mb-4">
      <label for="mobile" class="block text-gray-700 font-medium mb-2">Mobile</label>
      <input type="text" id="mobile" name="mobile" value="<?php echo isset($_SESSION['user']['mobile']) ? htmlspecialchars($_SESSION['user']['mobile']) : ''; ?>" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>
    
    <div class="mb-4">
      <label for="gender" class="block text-gray-700 font-medium mb-2">Gender</label>
      <select id="gender" name="gender" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        <option value="male" <?php echo (isset($_SESSION['user']['gender']) && $_SESSION['user']['gender'] === 'male') ? 'selected' : ''; ?>>Male</option>
        <option value="female" <?php echo (isset($_SESSION['user']['gender']) && $_SESSION['user']['gender'] === 'female') ? 'selected' : ''; ?>>Female</option>
        <option value="other" <?php echo (isset($_SESSION['user']['gender']) && $_SESSION['user']['gender'] === 'other') ? 'selected' : ''; ?>>Other</option>
      </select>
    </div>

    <div class="mb-4">
      <label for="address" class="block text-gray-700 font-medium mb-2">Address</label>
      <!-- Keep the textarea for form submission; CKEditor will replace it in the UI -->
      <textarea id="address" name="address" rows="6" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"><?php echo isset($_SESSION['user']['address']) ? htmlspecialchars($_SESSION['user']['address']) : ''; ?></textarea>
    </div>

    <div class="mb-4">
      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg" name="update_profile">Update Profile</button>
    </div>
  </div>
</form>

<!-- Change password form -->
<form action="" method="post" novalidate>
    <div class="max-w-2xl mx-auto p-6 bg-white rounded-xl shadow-lg mt-8 ring-1 ring-gray-100">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center space-x-4">
                <div class="bg-gradient-to-br from-green-400 to-blue-500 w-12 h-12 flex items-center justify-center rounded-lg shadow-md">
                    <!-- lock icon -->
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m0-10a3 3 0 00-3 3v2h6v-2a3 3 0 00-3-3zM5 11V9a7 7 0 0114 0v2" />
                        <rect x="3" y="11" width="18" height="10" rx="2" ry="2" stroke-linecap="round" stroke-linejoin="round"></rect>
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800">Change Password</h2>
                    <p class="text-sm text-gray-500">Choose a strong password to keep your account secure.</p>
                </div>
            </div>
        </div>

        <div class="space-y-4">
            <div>
                <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">Current Password</label>
                <div class="relative">
                    <input type="password" id="current_password" name="current_password" class="w-full pr-12 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required aria-required="true">
                    <button type="button" class="absolute right-2 top-2.5 text-gray-500 hover:text-gray-800" data-toggle="#current_password" aria-label="Toggle current password visibility">
                        <!-- eye icon -->
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </button>
                </div>
            </div>

            <div>
                <label for="new_password" class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                <div class="relative">
                    <input type="password" id="new_password" name="new_password" class="w-full pr-12 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required aria-describedby="pwd-help" aria-required="true">
                    <button type="button" class="absolute right-2 top-2.5 text-gray-500 hover:text-gray-800" data-toggle="#new_password" aria-label="Toggle new password visibility">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </button>
                </div>

                <div class="mt-2" id="pwd-help">
                    <div class="flex items-center justify-between text-xs text-gray-500">
                        <div>Strength:</div>
                        <div id="pwd-score" class="font-medium">Very weak</div>
                    </div>

                    <div class="mt-2 bg-gray-200 rounded-full h-2 overflow-hidden">
                        <div id="pwd-strength" class="h-2 w-0 bg-red-500 transition-all"></div>
                    </div>

                    <ul class="mt-3 grid grid-cols-2 gap-2 text-xs text-gray-500">
                        <li id="chk-length">• 8+ characters</li>
                        <li id="chk-upper">• Uppercase letter</li>
                        <li id="chk-number">• Number</li>
                        <li id="chk-symbol">• Special character</li>
                    </ul>
                </div>
            </div>

            <div>
                <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-2">Confirm New Password</label>
                <div class="relative">
                    <input type="password" id="confirm_password" name="confirm_password" class="w-full pr-12 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required aria-required="true">
                    <button type="button" class="absolute right-2 top-2.5 text-gray-500 hover:text-gray-800" data-toggle="#confirm_password" aria-label="Toggle confirm password visibility">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </button>
                </div>
                <p id="confirm-msg" class="mt-2 text-sm text-gray-500 hidden">Passwords match</p>
            </div>

            <div class="pt-3 border-t border-gray-100 flex items-center justify-between">
                <div class="text-sm text-gray-500">Make sure your new password is unique and hard to guess.</div>
                <button type="submit" class="inline-flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg shadow-sm" name="change_password">
                    <!-- check icon -->
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    Change Password
                </button>
            </div>
        </div>
    </div>

    <script>
        (function(){
            // Toggle visibility for password fields
            document.querySelectorAll('button[data-toggle]').forEach(btn => {
                btn.addEventListener('click', () => {
                    const selector = btn.getAttribute('data-toggle');
                    const input = document.querySelector(selector);
                    if (!input) return;
                    input.type = input.type === 'password' ? 'text' : 'password';
                    // simple icon inversion (swap fill) — keep it simple
                    btn.classList.toggle('text-blue-600');
                });
            });

            // Password strength meter
            const pwd = document.getElementById('new_password');
            const strengthBar = document.getElementById('pwd-strength');
            const scoreText = document.getElementById('pwd-score');
            const chkLength = document.getElementById('chk-length');
            const chkUpper = document.getElementById('chk-upper');
            const chkNumber = document.getElementById('chk-number');
            const chkSymbol = document.getElementById('chk-symbol');
            const confirm = document.getElementById('confirm_password');
            const confirmMsg = document.getElementById('confirm-msg');

            function evaluatePassword(value){
                let score = 0;
                const tests = {
                    length: value.length >= 8,
                    upper: /[A-Z]/.test(value),
                    number: /[0-9]/.test(value),
                    symbol: /[^A-Za-z0-9]/.test(value)
                };
                score = Object.values(tests).filter(Boolean).length;
                // update checklist styles
                chkLength.classList.toggle('text-green-600', tests.length);
                chkUpper.classList.toggle('text-green-600', tests.upper);
                chkNumber.classList.toggle('text-green-600', tests.number);
                chkSymbol.classList.toggle('text-green-600', tests.symbol);

                // bar and text
                const percent = (score / 4) * 100;
                strengthBar.style.width = percent + '%';
                if (score <= 1) {
                    strengthBar.className = 'h-2 bg-red-500 transition-all';
                    scoreText.textContent = 'Very weak';
                } else if (score === 2) {
                    strengthBar.className = 'h-2 bg-yellow-400 transition-all';
                    scoreText.textContent = 'Fair';
                } else if (score === 3) {
                    strengthBar.className = 'h-2 bg-yellow-600 transition-all';
                    scoreText.textContent = 'Good';
                } else {
                    strengthBar.className = 'h-2 bg-green-500 transition-all';
                    scoreText.textContent = 'Strong';
                }
            }

            pwd.addEventListener('input', () => {
                evaluatePassword(pwd.value);
                // update confirm match state
                if (confirm.value.length) {
                    const match = (pwd.value === confirm.value);
                    confirmMsg.classList.toggle('hidden', match);
                    confirmMsg.textContent = match ? 'Passwords match' : 'Passwords do not match';
                    confirmMsg.classList.toggle('text-green-600', match);
                    confirmMsg.classList.toggle('text-red-600', !match);
                }
            });

            confirm.addEventListener('input', () => {
                const match = (pwd.value === confirm.value);
                confirmMsg.classList.toggle('hidden', match && confirm.value === '');
                confirmMsg.textContent = match ? 'Passwords match' : 'Passwords do not match';
                confirmMsg.classList.toggle('text-green-600', match);
                confirmMsg.classList.toggle('text-red-600', !match);
            });
        })();
    </script>
</form>

<!-- show previous profile picture if exists or a demo placeholder profile picture image and also a form to change it -->
<form action="" method="post" enctype="multipart/form-data" class="mt-8">
    <div class="max-w-3xl mx-auto bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-lg overflow-hidden ring-1 ring-gray-100">
        <div class="md:flex items-center gap-6 p-6">
            <!-- Image preview column -->
            <div class="flex-shrink-0 flex flex-col items-center md:items-start">
                <div class="relative">
                    <div class="w-36 h-36 rounded-full bg-gradient-to-tr from-indigo-500 to-pink-500 p-1">
                        <img id="profilePreview" src="<?php echo isset($_SESSION['user']['image']) ? htmlspecialchars($_SESSION['user']['image']) : 'https://placehold.co/400x400'; ?>" alt="Profile Picture" class="w-34 h-34 rounded-full object-cover bg-white" />
                    </div>
                    <span id="previewBadge" class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 bg-white text-xs px-2 py-1 rounded-full shadow-sm text-gray-600">Current</span>
                </div>
                <p class="mt-4 text-sm text-gray-500 text-center md:text-left">Square images (min 150×150) look best. Max 2 MB.</p>
            </div>

            <!-- Upload column -->
            <div class="flex-1 mt-6 md:mt-0">
                <label for="image" id="dropZone" class="block cursor-pointer rounded-lg border-2 border-dashed border-gray-200 bg-white hover:border-indigo-300 hover:bg-indigo-50 p-4 transition-colors text-center">
                    <input id="image" name="image" type="file" accept="image/*" class="sr-only">
                    <div class="flex flex-col items-center justify-center gap-2">
                        <svg class="w-10 h-10 text-indigo-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 15a4 4 0 008 0 4 4 0 018 0M12 3v9" />
                        </svg>
                        <div class="text-sm font-medium text-gray-700">Click to select or drag & drop an image</div>
                        <div class="text-xs text-gray-400">PNG, JPG, GIF — up to 2 MB</div>
                    </div>
                </label>

                <div id="fileInfo" class="mt-4 text-sm text-gray-700 flex items-center justify-between">
                    <div>
                        <div id="fileName" class="font-medium"></div>
                        <div id="fileSize" class="text-xs text-gray-500"></div>
                    </div>
                    <div class="flex items-center gap-2">
                        <button id="clearFile" type="button" class="text-sm text-red-600 hover:underline hidden">Remove</button>
                    </div>
                </div>

                <div class="mt-6 flex items-center gap-3">
                    <button type="submit" name="change_image" id="uploadBtn" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow-sm disabled:opacity-50" disabled>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 12v9m0-9l-3 3m3-3l3 3"/><path stroke-linecap="round" stroke-linejoin="round" d="M7 8a5 5 0 0110 0"/></svg>
                        Upload
                    </button>

                    <button id="removeServerPic" type="button" class="inline-flex items-center gap-2 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 px-3 py-2 rounded-lg shadow-sm">
                        Remove current
                    </button>

                    <div id="clientMsg" class="text-sm text-red-500 ml-2"></div>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" name="remove_image" id="remove_image" value="0">
</form>

<script>
    (function(){
        const dropZone = document.getElementById('dropZone');
        const input = document.getElementById('image');
        const preview = document.getElementById('profilePreview');
        const fileInfo = document.getElementById('fileInfo');
        const fileNameEl = document.getElementById('fileName');
        const fileSizeEl = document.getElementById('fileSize');
        const clearFileBtn = document.getElementById('clearFile');
        const uploadBtn = document.getElementById('uploadBtn');
        const clientMsg = document.getElementById('clientMsg');
        const removeServerBtn = document.getElementById('removeServerPic');
        const removeHidden = document.getElementById('remove_image');

        const MAX_BYTES = 2 * 1024 * 1024; // 2MB
        const fallbackSrc = '<?php echo isset($_SESSION['user']['image']) ? htmlspecialchars($_SESSION['user']['image']) : 'https://placehold.co/400x400/black/white?text=No+Image'; ?>';

        function humanFileSize(bytes){
            const i = bytes === 0 ? 0 : Math.floor(Math.log(bytes) / Math.log(1024));
            return ( bytes / Math.pow(1024, i) ).toFixed( i ? 1 : 0 ) + ' ' + ['B','KB','MB','GB'][i];
        }

        function resetSelection(){
            input.value = '';
            preview.src = fallbackSrc;
            fileInfo.classList.add('hidden');
            clearFileBtn.classList.add('hidden');
            uploadBtn.disabled = true;
            clientMsg.textContent = '';
            removeHidden.value = '0';
        }

        function handleFile(file){
            if (!file) return resetSelection();
            if (!file.type.startsWith('image/')) {
                Swal.fire({icon:'error', title:'Invalid file', text:'Please select an image file.'});
                return resetSelection();
            }
            if (file.size > MAX_BYTES) {
                Swal.fire({icon:'error', title:'File too large', text:'Image must be 2 MB or smaller.'});
                return resetSelection();
            }
            // preview
            const url = URL.createObjectURL(file);
            preview.src = url;
            fileNameEl.textContent = file.name;
            fileSizeEl.textContent = humanFileSize(file.size);
            fileInfo.classList.remove('hidden');
            clearFileBtn.classList.remove('hidden');
            uploadBtn.disabled = false;
            clientMsg.textContent = '';
        }

        // click to open file dialog
        dropZone.addEventListener('click', () => input.click());

        // drag & drop
        ['dragenter','dragover'].forEach(evt => {
            dropZone.addEventListener(evt, e => {
                e.preventDefault();
                dropZone.classList.add('border-indigo-300', 'bg-indigo-50');
            });
        });
        ['dragleave','drop'].forEach(evt => {
            dropZone.addEventListener(evt, e => {
                e.preventDefault();
                dropZone.classList.remove('border-indigo-300', 'bg-indigo-50');
            });
        });
        dropZone.addEventListener('drop', e => {
            const dt = e.dataTransfer;
            if (!dt || !dt.files) return;
            input.files = dt.files;
            handleFile(dt.files[0]);
        });

        input.addEventListener('change', () => {
            handleFile(input.files[0]);
        });

        clearFileBtn.addEventListener('click', () => {
            resetSelection();
        });

        removeServerBtn.addEventListener('click', () => {
            Swal.fire({
                title: 'Remove profile picture?',
                text: "This will remove your current picture and revert to the placeholder.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Remove',
                cancelButtonText: 'Cancel'
            }).then(result => {
                if (result.isConfirmed) {
                    // mark server-side removal and submit form
                    removeHidden.value = '1';
                    // ensure no file is selected
                    input.value = '';
                    // submit the form to server for removal
                    dropZone.closest('form').submit();
                }
            });
        });

        // Initialize: keep upload disabled until user selects
        resetSelection();
    })();
</script>

<!-- CKEditor 5 Classic (CDN) -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
  // Initialize CKEditor and ensure editor data is placed into the textarea before submit
  let addressEditor;
  ClassicEditor
    .create( document.querySelector( '#address' ), {
      toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo' ]
    } )
    .then( editor => {
        addressEditor = editor;
    } )
    .catch( error => {
        console.error( error );
    } );

  // On form submit, update the textarea value with editor data so PHP receives it
  (function(){
    const form = document.querySelector('form[action=""]') || document.querySelector('form');
    if (!form) return;
    form.addEventListener('submit', function(e){
      if (addressEditor) {
        const data = addressEditor.getData();
        // place the data back into the textarea
        const textarea = document.getElementById('address');
        if (textarea) textarea.value = data;
      }
    });
  })();
</script>
<?php
    require_once 'footer.php';
?>