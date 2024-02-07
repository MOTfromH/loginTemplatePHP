<?php

require("connection.php");


if (isset($_POST["submit"])) {


    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $con->prepare("SELECT * FROM users WHERE username=:username");
    $stmt->bindParam(":username", $username);
    $stmt->execute();
    $userExists = $stmt->fetch();

    $passwordHashed = $userExists["password"];
    $checkPassword = password_verify($password, $passwordHashed);

    if ($checkPassword === false) {

        echo "Login fehlgeschlagen, Passwort stimmt nicht überein";

    }

    if ($checkPassword === true) {
        session_start();

        $_SESSION["username"] = $userExists["username"];

        header("Location: memberarea.php");
        exit;


    }

}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>


<section>
    <div class="container mt-5 pt-5">
        <div class="row">
            <div class="col-12 col-sm-8 col-md-6 m-auto">
                <div class="card">
                    <div class="card-body">
                        <form action="login.php" method="POST">
                            <div class="text-center mt-3">
                                <h1>Login</h1>
                            </div>
                            <input type="text" class="form-control my-3 py-2" placeholder="Benutzername" name="username"
                                   autocomplete="off">
                            <input type="text" class="form-control my-3 py-2" placeholder="Passwort" name="password"
                                   autocomplete="off">
                            <div class="text-center mt-3">
                                <button name="submit" class="btn btn-primary">Login</button>
                                <a href="register.php" class="nav-link mt-1">Regestriert?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!--Scripts-->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>
</html>
