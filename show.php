<?php
include "students.php";

if (isset($_GET['id'])) {
    $student = students::find($_GET['id']);
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
    <title>Student Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h1>Student Details</h1>
        <ul>
            <li><strong>ID:</strong> <?= $student->id ?></li>
            <li><strong>Familiya:</strong> <?= htmlspecialchars($student->familiya) ?></li>
            <li><strong>Ism:</strong> <?= htmlspecialchars($student->ism) ?></li>
            <li><strong>Manzil:</strong> <?= htmlspecialchars($student->manzil) ?></li>
            <li><strong>Image:</strong> <img src="<?= htmlspecialchars($student->image) ?>" alt="Student Image" style="width:100px;height:100px;"></li>
        </ul>
        <a href="index.php" class="btn btn-primary">Back</a>
    </div>
</body>

</html>
