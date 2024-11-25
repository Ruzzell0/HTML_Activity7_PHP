<?php
session_start();

if (!isset($_SESSION['students'])) {
    $_SESSION['students'] = [];
}

$students = $_SESSION['students'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'insert') {
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

            $index = $_POST['index'];
            array_splice($_SESSION['students'], $index, 1);
        }

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
                    <h1 class="mt-4">Show Details</h1>
                    <div class="card mb-4">
                        <div class="card-header">Students List</div>
                        <div class="card-body">
                            <?php if (count($students) > 0): ?>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Student ID</th>
                                            <th>Name</th>
                                            <th>Course</th>
                                            <th>Year</th>
                                            <th>Section</th>
                                            <th>Age</th>
                                            <th>Gender</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($students as $index => $student): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($student['student_id']); ?></td>
                                                <td><?php echo htmlspecialchars($student['name']); ?></td>
                                                <td><?php echo htmlspecialchars($student['course']); ?></td>
                                                <td><?php echo htmlspecialchars($student['year']); ?></td>
                                                <td><?php echo htmlspecialchars($student['section']); ?></td>
                                                <td><?php echo htmlspecialchars($student['age']); ?></td>
                                                <td><?php echo htmlspecialchars($student['gender']); ?></td>
                                                <td>
                                                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#insertModal">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#updateModal" onclick="openUpdateModal(<?php echo $index; ?>)">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="openDeleteModal(<?php echo $index; ?>)">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <p>No student records available.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </main>
            <?php include('../layout/footer.php'); ?>
        </div>
    </div>
    <?php include('../layout/script.php'); ?>

    <!-- Insert Modal -->
    <div class="modal fade" id="insertModal" tabindex="-1" aria-labelledby="insertModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="insertModalLabel">Insert Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <input type="hidden" name="action" value="insert">
                        <div class="mb-3">
                            <label for="student_id" class="form-label">Student ID</label>
                            <input type="text" class="form-control" id="student_id" name="student_id" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Student Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
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
                        <div class="mb-3">
                            <label for="year" class="form-label">Year</label>
                            <select class="form-control" id="year" name="year" required>
                                <option value="default" disabled selected>--Select Year--</option>
                                <option value="1st Year">1st Year</option>
                                <option value="2nd Year">2nd Year</option>
                                <option value="3rd Year">3rd Year</option>
                                <option value="4th Year">4th Year</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="section" class="form-label">Section</label>
                            <input type="text" class="form-control" id="section" name="section" required>
                        </div>
                        <div class="mb-3">
                            <label for="age" class="form-label">Age</label>
                            <input type="number" class="form-control" id="age" name="age" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gender</label><br>
                            <input type="radio" id="male" name="gender" value="Male" required>
                            <label for="male">Male</label>
                            <input type="radio" id="female" name="gender" value="Female" required>
                            <label for="female">Female</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Update Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="index" id="updateIndex">
                        <div class="mb-3">
                            <label for="student_id_update" class="form-label">Student ID</label>
                            <input type="text" class="form-control" id="student_id_update" name="student_id" required>
                        </div>
                        <div class="mb-3">
                            <label for="name_update" class="form-label">Student Name</label>
                            <input type="text" class="form-control" id="name_update" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="course_update" class="form-label">Course</label>
                            <select class="form-control" id="course_update" name="course" required>
                                <option value="default" disabled selected>--Select Course--</option>
                                <option value="BSIS">BS Information System</option>
                                <option value="Beed">Bachelor of Elementary Education</option>
                                <option value="BSTM">BS Tourism Management</option>
                                <option value="BSAIS">BS Accountng Info. System</option>
                                <option value="PolSci"> BS Political Science</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="year_update" class="form-label">Year</label>
                            <select class="form-control" id="year_update" name="year" required>
                                <option value="default" disabled selected>--Select Year--</option>
                                <option value="1st Year">1st Year</option>
                                <option value="2nd Year">2nd Year</option>
                                <option value="3rd Year">3rd Year</option>
                                <option value="4th Year">4th Year</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="section_update" class="form-label">Section</label>
                            <input type="text" class="form-control" id="section_update" name="section" required>
                        </div>
                        <div class="mb-3">
                            <label for="age_update" class="form-label">Age</label>
                            <input type="number" class="form-control" id="age_update" name="age" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gender</label><br>
                            <input type="radio" id="male_update" name="gender" value="Male" required>
                            <label for="male_update">Male</label>
                            <input type="radio" id="female_update" name="gender" value="Female" required>
                            <label for="female_update">Female</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this student?</p>
                    <form action="" method="POST">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="index" id="deleteIndex">
                        <button type="submit" class="btn btn-danger">Delete</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openUpdateModal(index) {
            const student = <?php echo json_encode($students); ?>[index];
            document.getElementById('updateIndex').value = index;
            document.getElementById('student_id_update').value = student.student_id;
            document.getElementById('name_update').value = student.name;
            document.getElementById('course_update').value = student.course;
            document.getElementById('year_update').value = student.year;
            document.getElementById('section_update').value = student.section;
            document.getElementById('age_update').value = student.age;
            document.getElementById('male_update').checked = student.gender === 'Male';
            document.getElementById('female_update').checked = student.gender === 'Female';
        }
        function openDeleteModal(index) {
            document.getElementById('deleteIndex').value = index;
        }
    </script>
</body>
</html>
