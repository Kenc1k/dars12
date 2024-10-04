<?php
include "students.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                $data = [
                    'familiya' => $_POST['familiya'],
                    'ism' => $_POST['ism'],
                    'manzil' => $_POST['manzil'],
                    'image' => $targetFile 
                ];
                students::create($data);
                header("Location: index.php");
                exit();
            } else {
                echo "Error uploading the file.";
            }
        } else {
            echo "File is not an image.";
        }
    } else {
        echo "No file uploaded or there was an error.";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1>Add New Student</h1>
        <form action="create.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="familiya" class="form-label">Familiya</label>
                <input type="text" name="familiya" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="ism" class="form-label">Ism</label>
                <input type="text" name="ism" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="manzil" class="form-label">Manzil</label>
                <input type="text" name="manzil" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Student</button>
        </form>
    </div>
</body>

</html>
