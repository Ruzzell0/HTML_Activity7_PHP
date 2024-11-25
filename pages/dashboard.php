<?php
session_start();

if (!isset($_SESSION['students'])) {
    $_SESSION['students'] = [];
}

$students = $_SESSION['students'];

// Handle form submissions for Insert, Update, and Delete
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'insert') {
            // Insert a new student
            $newStudent = [
                'student_id' => $_POST['student_id'],
                'name' => $_POST['name'],
                'course' => $_POST['course'],
                'year' => $_POST['year'],
                'section' => $_POST['section'],
                'age' => $_POST['age'],
                'gender' => $_POST['gender']
            ];
            $_SESSION['students'][] = $newStudent;
        } elseif ($_POST['action'] === 'update') {
            // Update an existing student
            $index = $_POST['index'];
            $_SESSION['students'][$index] = [
                'student_id' => $_POST['student_id'],
                'name' => $_POST['name'],
                'course' => $_POST['course'],
                'year' => $_POST['year'],
                'section' => $_POST['section'],
                'age' => $_POST['age'],
                'gender' => $_POST['gender']
            ];
        } elseif ($_POST['action'] === 'delete') {
            // Delete a student
            $index = $_POST['index'];
            array_splice($_SESSION['students'], $index, 1);
        }
        // Redirect to prevent form resubmission
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <?php include('../layout/style.php'); ?>
</head>
<body class="sb-nav-fixed">
    <?php include('../layout/header.php'); ?>
    <div id="layoutSidenav">
        <?php include('../layout/navigation.php'); ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>

                    <!-- Search Bar -->
                    <form method="POST" class="mb-4">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search_term" placeholder="Search by Name or ID">
                            <button class="btn btn-outline-secondary" type="submit">Search</button>
                        </div>
                    </form>

                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-area me-1"></i>
                                    Area Chart Example
                                </div>
                                <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar me-1"></i>
                                    Bar Chart Example
                                </div>
                                <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <?php include('../layout/footer.php'); ?>
        </div>
    </div>
    <?php include('../layout/script.php'); ?>
</body>
</html>
