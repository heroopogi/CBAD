<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];

  if ($username === "admin" && $password === "admin123") {
    $_SESSION["loggedin"] = true;
    header("Location: dashboard.html");
    exit();
  } else {
    $error = "Invalid credentials!";
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin Login</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-light">
<div class="container mt-5">
  <div class="col-md-4 offset-md-4">
    <div class="card p-4 shadow">
      <h3 class="text-center">Admin Login</h3>
      <form method="POST">
        <input type="text" name="username" class="form-control my-2" placeholder="Username" required>
        <input type="password" name="password" class="form-control my-2" placeholder="Password" required>
        <button class="btn btn-primary w-100">Login</button>
      </form>
      <?php if (isset($error)) echo "<div class='alert alert-danger mt-3'>$error</div>"; ?>
    </div>
  </div>
</div>
</body>
</html>
