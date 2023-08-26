<?php
if (!empty($_FILES["image"]["name"])) {
    $image = sha1_file($_FILES["image"]["tmp_name"]) . "-" . basename($_FILES["image"]["name"]);
    $image = htmlspecialchars(strip_tags($image));

    $target_directory = "uploads/";
    $target_file = $target_directory . $image;
    $file_type = pathinfo($target_file, PATHINFO_EXTENSION);

    // error message is empty
    $errormessage = array();

    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        // echo "File is an image";
    } else {
        $errormessage[] = "Submitted file is not an image.";
    }

    list($width, $height) = $check;
    if ($width > 300 || $height > 300) {
        $errormessage[] = "Image should be under 300x300.";
    }

    $allowed_file_types = array("jpg", "jpeg", "png", "gif");
    if (!in_array($file_type, $allowed_file_types)) {
        $errormessage[] = "Only JPG, JPEG, PNG, GIF files are allowed.";
    }

    if (file_exists($target_file)) {
        $errormessage[] = "Image already exists. Try to change file name.";
    }

    if ($_FILES["image"]["size"] > (512000)) {
        $errormessage[] = "Image must be less than 512 KB in size.";
    }

    if (!is_dir($target_directory)) {
        mkdir($target_directory, 0777, true);
    }

    // if $file_upload_error_messages is still empty
    if (empty($errormessage)) {
        // it means there are no errors, so try to upload the file
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // it means photo was uploaded
        } else {
            echo "<div class='alert alert-danger'>";
            echo "<div>Unable to upload photo.</div>";
            echo "</div>";
        }
    }
} else if ($_SESSION['image'] == "product") {
    $image = "product_image_coming_soon.jpg";
} else if ($_SESSION['image'] == "user") {
    $image = "default_user.png";
} else {
    $image = "";
}
?>