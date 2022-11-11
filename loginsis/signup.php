<?php


$showAlert = false;
$showError = false;

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'partials/dbconnect.php';

    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
//    $exits = false;
//    $result=false;
    $existSql = "SELECT * FROM `users` WHERE username = '$username'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    if ($numExistRows > 0)
    {
        $showError = "Username Already exists";

    }
    else {

        if (($password == $cpassword)) {

            $hash = password_hash($password, PASSWORD_DEFAULT);



            $sql = "INSERT INTO `users`(`username`,`password`,`dt`) VALUES ('$username','$hash' ,current_timestamp())";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $showAlert = true;
            }}
        else {
                $showError = "password does not matched";
            }

    }

}


?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
<?php require 'partials/nav.php' ?>
<?php
if($showAlert) {
   echo "<div class='alert alert-success alert-dismissible fade show' role = 'alert' >
    <strong > Success!</strong > Your account has been created successfully .
    <button type = 'button' class='btn-close' data - bs - dismiss = 'alert'' aria - label = 'Close' ></button >
</div >";
}
if($showError) {
   echo "<div class='alert alert-danger alert-dismissible fade show' role = 'alert' >
    <strong > Warning!</strong > .'$showError'.
    <button type = 'button' class='btn-close' data - bs - dismiss = 'alert'' aria - label = 'Close' ></button >
</div >";
}
?>
<div class="container my-4">
<h1 class="text-center">Sign Up to our website </h1>

    <form action="/loginsis/signup.php" method="post" >
        <div class="mb-3 ">
            <label for="username" class="form-label">User Name</label>
            <input type="text" class="form-control" name="username" id="username" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>  <div class="mb-3 ">
            <label for="cpassword" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="cpassword" name="cpassword">
            <div id="Help" class="form-text">Make sure to type the same password</div>

        </div>

        <button type="submit" class="btn btn-primary">Sign Up</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>