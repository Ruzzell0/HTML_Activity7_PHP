<?php 
$email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : "";
$password = isset($_POST['password']) ? htmlspecialchars(trim($_POST['password'])) : "";
$message = "";

if ($email === "delmundorussell10@gmail.com" && $password === "admin") {
    $message = "<div class='alert alert-success'>Login Successfully</div>";
    header("Location: pages/dashboard.php");
    exit();
} elseif (empty($email) || empty($password)) {
    $message = "<div class='alert alert-danger'>Please Enter Email and Password</div>";
} else {
    $message = "<div class='alert alert-danger'>Login Failed</div>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #2c2c54;
            color: #f1f1f1;
        }
        .card {
            background-color: #40407a;
            color: #f1f1f1;
        }
        .form-control {
            background-color: #2c2c54;
            color: #f1f1f1;
        }
        .btn-primary {
            background-color: #706fd3;
            border-color: #706fd3;
        }
        .btn-primary:hover {
            background-color: #575fcf;
        }
    </style>
</head>
<body>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-lg border-0 rounded-lg">
            <div class="card-header text-center">
                <h3 class="font-weight-light">Login</h3>
            </div>
            <div class="card-body">
                <?php echo $message; ?>
                <form action="" method="post" onsubmit="return confirm('Do you want to submit?');">
                    <div class="form-floating mb-3">
                        <input class="form-control" name="email" id="inputEmail" type="email" placeholder="name@example.com" required />
                        <label for="inputEmail">Email address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" name="password" id="inputPassword" type="password" placeholder="Password" required />
                        <label for="inputPassword">Password</label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" id="inputRememberPassword" type="checkbox" />
                        <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a class="small" href="password.html">Forgot Password?</a>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center">
                <div class="small"><a href="register.html">Need an account? Sign up!</a></div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
