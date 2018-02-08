<?php
include("../validation/check.php");
echo '<link rel="stylesheet" href="../../default.css">';
$returnURL = "../../" . $_SESSION['username'] . ".php";

$target_dir = "../../uploads/";
$fname = $_SESSION['UserID'].".";
$target_file = $target_dir . $fname . "jpg";
$imageFileType = strtolower(pathinfo(basename($_FILES["fileToUpload"]["name"]),PATHINFO_EXTENSION));
$uploadOk = 1;
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
		echo "<br>";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif") {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	echo "<br>";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
	echo "<br>";
	echo "<a href = $returnURL> Click here to return</a>";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		header("Location: $returnURL");
    } else {
        echo "Sorry, there was an error uploading your file.";
		echo "<a href = $returnURL> Click here to return</a>";
    }
}

?>