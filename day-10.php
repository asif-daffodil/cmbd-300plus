<?php
$allowedExt = ["jpg", "jpeg", "png", "webp", "gif"];
if (isset($_POST['upload123'])) {
    $image = $_FILES['image'];
    $imageName = $image["name"];
    $tmpName = $image["tmp_name"];
    $size = $image["size"];

    if (empty($imageName)) {
        $imageMsg = "<span style='color: red'>Please upload an image file</span>";
    } else {
        $ext = pathinfo($imageName, PATHINFO_EXTENSION);
        if (!in_array($ext, $allowedExt)) {
            $imageMsg = "<span style='color: red'>Invalid image file</span>";
        } elseif ($size > 2097152) {
            $imageMsg = "<span style='color: red'>Image size is more then 2 MB</span>";
        } else {
            $capital = "ABCEFGHIJKLMNOPQRSTUVWXYZ";
            $small = "abcdefghijklmnopqrstuvwxyz";
            $numbers = "0123456789";
            $randomName = str_shuffle(uniqid() . date("hisalFdY") . rand(100000, 999999) . substr(str_shuffle($capital), 0, 6) . substr(str_shuffle($small), 0, 6) . substr(str_shuffle($numbers), 0, 6));
            $ext = pathinfo($imageName, PATHINFO_EXTENSION);
            $newFileName =  $randomName . "." . $ext;
            $destination = "./uploads/" . $newFileName;
            if (!getimagesize($tmpName)) {
                $imageMsg = "<span style='color: red'>Invalid image file</span>";
            } else {
                if (!is_dir("./uploads")) {
                    mkdir("./uploads");
                }
                $move = move_uploaded_file($tmpName, $destination);
                if (!$move) {
                    $imageMsg = "<span style='color: red'>Image upload failed</span>";
                } else {
                    $imageMsg = "<span style='color: green'>Image upload successful</span>";
                }
            }
        }
    }
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="image">
    <button type="submit" name="upload123">Upload File</button>
</form>
<?= $imageMsg ?? null ?>