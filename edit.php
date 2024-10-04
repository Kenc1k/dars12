<?php
include "students.php";

if (isset($_GET['id'])) {
    $student = students::find($_GET['id']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'familiya' => $_POST['familiya'],
        'ism' => $_POST['ism'],
        'manzil' => $_POST['manzil']
    ];

    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                $data['image'] = $targetFile; 
            } else {
                echo "Error uploading the file.";
            }
        } else {
            echo "File is not an image.";
        }
    }

    students::update($_POST['id'], $data);
    header("Location: index.php");
    exit();
}

if (!$student) {
    die("Student not found.");
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1>Edit Student</h1>
        <form action="edit.php?id=<?= $student->id ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $student->id ?>">
            <div class="mb-3">
                <label for="familiya" class="form-label">Familiya</label>
                <input type="text" name="familiya" class="form-control" value="<?= htmlspecialchars($student->familiya) ?>" required>
            </div>
            <div class="mb-3">
                <label for="ism" class="form-label">Ism</label>
                <input type="text" name="ism" class="form-control" value="<?= htmlspecialchars($student->ism) ?>" required>
            </div>
            <div class="mb-3">
                <label for="manzil" class="form-label">Manzil</label>
                <input type="text" name="manzil" class="form-control" value="<?= htmlspecialchars($student->manzil) ?>" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Upload New Image (optional)</label>
                <input type="file" name="image" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
</body>

</html>
