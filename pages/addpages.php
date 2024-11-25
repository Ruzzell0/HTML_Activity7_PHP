<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['students'])) {
        $_SESSION['students'] = [];
    }

    $_SESSION['students'][] = [
        'student_id' => $_POST['student_id'],
        'name' => $_POST['name'],
        'course' => $_POST['course'],
        'year' => $_POST['year'],
        'section' => $_POST['section'],
        'age' => $_POST['age'],
        'gender' => $_POST['gender']
    ];

    header('Location: showdetails.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Dashboard - University of Oxford</title>
    <?php include('../layout/style.php'); ?>
    <!-- Add Bootstrap 5 link for modern styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container-fluid {
            background-color: #f4f4f9;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #2a2a2a;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
        }
        .form-control, .form-select {
            border-radius: 8px;
            padding: 10px;
        }
        .btn-primary {
            background-color: #003366;
            border-color: #003366;
            border-radius: 8px;
        }
        .btn-primary:hover {
            background-color: #0055a5;
            border-color: #0055a5;
        }
        label {
            font-weight: 600;
        }
        .radio-container {
            display: flex;
            gap: 15px;
        }
    </style>
</head>
<body class="sb-nav-fixed">
    <?php include('../layout/header.php'); ?>
    <div id="layoutSidenav">
        <?php include('../layout/navigation.php'); ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-5 py-4">
                    <div class="card mx-auto" style="max-width: 600px;">
                        <div class="card-header text-center">Add User Information</div>
                        <div class="card-body">
                            <form method="POST">
                                <div class="mb-4">
                                    <label for="student_id" class="form-label">Student ID</label>
                                    <input type="text" class="form-control" id="student_id" name="student_id" value="OXF22S" pattern="OXF22S\w{4}" required>
                                </div>
                                <div class="mb-4">
                                    <label for="name" class="form-label">Student Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="Russell" required>
                                </div>
                                <div class="mb-4">
                                    <label for="course" class="form-label">Course</label>
                                    <select class="form-select" id="course" name="course" required>
                                        <option value="default" disabled selected>--Select Course--</option>
                                        <option value="Computer Science">Computer Science</option>
                                        <option value="Law">Law</option>
                                        <option value="Medicine">Medicine</option>
                                        <option value="Philosophy">Philosophy</option>
                                        <option value="History">History</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label for="year" class="form-label">Year</label>
                                    <select class="form-select" id="year" name="year" required>
                                        <option value="default" disabled selected>--Select Year--</option>
                                        <option value="1st Year">1st Year</option>
                                        <option value="2nd Year">2nd Year</option>
                                        <option value="3rd Year">3rd Year</option>
                                        <option value="4th Year">4th Year</option>
                                        <option value="Postgraduate">Postgraduate</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label for="section" class="form-label">Section</label>
                                    <input type="text" class="form-control" id="section" name="section" value="A" required>
                                </div>
                                <div class="mb-4">
                                    <label for="age" class="form-label">Age</label>
                                    <input type="number" class="form-control" id="age" name="age" value="20" required>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Gender</label><br>
                                    <div class="radio-container">
                                        <div>
                                            <input type="radio" id="male" name="gender" value="Male" required>
                                            <label for="male">Male</label>
                                        </div>
                                        <div>
                                            <input type="radio" id="female" name="gender" value="Female" required>
                                            <label for="female">Female</label>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Submit</button>
                            </form>
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
