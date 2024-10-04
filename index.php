<?php

include "students.php";
include "helpers.php";

if (isset($_POST['delete'])) {
    students::delete($_POST['id']);
    header("Location: index.php");
    exit();
}

$limit = 5;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$offset = ($page - 1) * $limit;

$total_students = students::count();

$students = students::paginate($limit, $offset);

$total_pages = ceil($total_students / $limit);

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php
    $students = students::all();
    ?>

    <div class="container mt-5">
        <h1>Student List</h1>
        <a href="create.php" class="btn btn-primary mb-3">Add Student</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Familiya</th>
                    <th scope="col">Ism</th>
                    <th scope="col">Manzil</th>
                    <th scope="col">Image</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student) { ?>
                    <tr>
                        <td><?= $student->id ?></td>
                        <td><?= htmlspecialchars($student->familiya) ?></td>
                        <td><?= htmlspecialchars($student->ism) ?></td>
                        <td><?= htmlspecialchars($student->manzil) ?></td>
                        <td><img src="<?= htmlspecialchars($student->image) ?>" alt="Student Image" style="width:50px;height:50px;"></td>
                        <td>
                            <a href="show.php?id=<?= $student->id ?>" class="btn btn-info">Show</a>
                            <a href="edit.php?id=<?= $student->id ?>" class="btn btn-warning">Edit</a>
                            <form action="index.php" method="post" style="display:inline-block;">
                                <input type="hidden" name="id" value="<?= $student->id ?>">
                                <button type="submit" name="delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this student?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <nav>
            <ul class="pagination">
                <!-- Previous Page Link -->
                <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= $page - 1 ?>">Previous</a>
                </li>

                <!-- Page Number Links -->
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>

                <!-- Next Page Link -->
                <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= $page + 1 ?>">Next</a>
                </li>
            </ul>
        </nav>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>