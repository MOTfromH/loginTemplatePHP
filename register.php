<?php


require("connection.php");

if (isset($_POST["submit"])) {

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = PASSWORD_HASH($_POST["password"], PASSWORD_DEFAULT);

    $stmt = $con->prepare("SELECT * FROM users WHERE username =:username OR email =:email");
    $stmt->bindParam(":username", $usermane);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $userAlreadyExists = $stmt->fetchColumn();

    if (!$userAlreadyExists) {
           registerUser($username, $email, $password);
    } else {
        echo "Username oder Email bereits vergeben";
    }
}
function registerUser($username, $email, $password)
{
    global $con;
    $stmt = $con->prepare("INSERT INTO users(username, email, password) VALUES (:username, :email, :password)");
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password", $password);
    $stmt->execute();
    session_start();

    $_SESSION["username"] = $username;

    header("Location: memberarea.php");
    exit;
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
                        <form action="register.php" method="POST">
                            <div class="text-center mt-3">
                                <h1>Account Erstellen</h1>
                            </div>
                            <input type="text" class="form-control my-3 py-2" placeholder="Benutzername" name="username"
                                   autocomplete="off">
                            <input type="text" class="form-control my-3 py-2" placeholder="Email" name="email"
                                   autocomplete="off">
                            <input type="text" class="form-control my-3 py-2" placeholder="Passwort" name="password"
                                   autocomplete="off">
                            <div class="text-center mt-3">
                                <button name="submit" class="btn btn-primary">Erstellen</button>
                                <a href="#" class="nav-link mt-1">Bereits registriert?</a>
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