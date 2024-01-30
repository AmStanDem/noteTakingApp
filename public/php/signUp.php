<?php
global $connect;
require '../../config/connect.php';
require '../../src/functions.php';
?>
<!doctype html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrazione</title>
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
                            <h2 style="color: #080A0B" class="text-uppercase text-center mb-5">Crea un'account</h2>
                            <form action="<?=htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                                <div class="form-outline mb-4">
                                    <input type="text" name="nome" id="nome" class="form-control form-control-lg" maxlength="50" placeholder="Nome" required/>
                                    <label class="form-label" for="nome">Nome</label>
                                </div>
                                <div class="form-outline mb-4">
                                    <input type="text" name="cognome" id="cognome" class="form-control form-control-lg" maxlength="50" placeholder="Cognome" required/>
                                    <label class="form-label" for="cognome">Cognome</label>
                                </div>
                                <div class="form-outline mb-4">
                                    <input type="email" name="email" id="email" class="form-control form-control-lg" maxlength="100" placeholder="Email" required/>
                                    <label class="form-label" for="email">Email</label>
                                </div>
                                <div class="form-outline mb-4">
                                    <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Password" required/>
                                    <label class="form-label" for="password">Password</label>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" style="background-color: teal;" class="btn btn-primary btn-lg">Registrati!</button>
                                </div>
                                <p class="text-center mt-5 mb-0">Hai già un'account? <a style="text-decoration: none !important;" href="login.php">Accedi qui</a></p>
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
    echo 'fff';
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (!checkSignUpValues($nome, $cognome, $email, $password))
    {
        echo "<script>alert('Invalid values')</script>";
        exit();
    }
    else
    {
        if (checkIfUserExistSignUp($email, $connect))
        {
            echo "<script>alert('User already present')</script>";
            exit();
        }
        else
        {
            echo 'ddd';
            $password = password_hash($password, PASSWORD_DEFAULT);
            if(insertUser($nome, $cognome, $email, $password, $connect))
            {
                header('location:../../public/php/login.php');
            }
            else
            {
                echo "<script>alert('Something went wrong')</script>";
                exit();
            }
        }
    }
    $connect->close();
}
?>
</body>
</html>
