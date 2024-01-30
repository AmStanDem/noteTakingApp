<?php
global $connect;
require '../../config/connect.php';
require '../../src/functions.php';
require '../../includes/sessions.php';
?>
<!doctype html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Accedi</title>
    <link rel="icon" href="../../public/assets/images/appIcon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<section class="vh-100 bg-image"
         style="background-color: #04243D">
    <div class="mask d-flex align-items-center h-100 gradient-custom-3">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card" style="border-radius: 15px; background-color: white;">
                        <div class="card-body p-5">
                            <h2 style="color: #080A0B" class="text-uppercase text-center mb-5">Accedi</h2>
                            <form action="<?=htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                                <div class="form-outline mb-4">
                                    <input type="email" name="email" id="email" class="form-control form-control-lg" maxlength="100" placeholder="Email" required/>
                                    <label class="form-label" for="email">Email</label>
                                </div>
                                <div class="form-outline mb-4">
                                    <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Password" required/>
                                    <label class="form-label" for="password">Password</label>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" style="background-color: teal;" class="btn btn-primary btn-lg">Accedi!</button>
                                </div>
                                <p class="text-center mt-5 mb-0">Non hai un account? <a style="text-decoration: none !important;" href="signUp.php">Registrati qui</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</section>
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (!checkDataLogin($email, $password))
    {
        echo "<script>alert('Invalid values')</script>";
        exit();
    }
    else
    {
        if (checkUserExistLogin($email, $password, $connect))
        {

            $hashedPassword = getPasswordFromEmail($email,$connect);

            $userId = getIdFromUser($email, $hashedPassword, $connect);
            login($email);
            /*
            $_SESSION['userId'] = $userId;
            $_SESSION['email'] = $email;
            $_SESSION['hashedPassword'] = $hashedPassword;
            $_SESSION['logged_in'] = true;
            */
            header('location:../../public/index.php');
        }
        else
        {
            echo "<script>alert('email or password wrong')</script>";
            exit();
        }
    }
    $connect->close();
}
?>
</body>
</html>
