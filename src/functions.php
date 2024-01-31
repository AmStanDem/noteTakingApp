<?php

function checkSignUpValues($nome, $cognome,$email, $password): bool
{
    if (isset($nome) && isset($cognome) && isset($email) && isset($password)) {
        return true;
    }
    return false;
}

function checkIfUserExistSignUp($email, $connect): bool
{
    $sql = "SELECT * FROM utenti  WHERE email = ?";
    $query = $connect->prepare($sql);
    $query->bind_param("s", $email);
    $query->execute();
    $result = $query->get_result();

    if (mysqli_num_rows($result)) {
        return true;
    }
    return false;
}

function insertUser($nome, $cognome,$email, $password, $connect): bool
{

    $sql = "INSERT INTO utenti (nome, cognome, email, password)
            VALUES 
            ('$nome','$cognome','$email','$password')";
    if ($connect->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }

}



function checkDataLogin($email, $password): bool
{
    if (isset($email) && isset($password)) {
        return true;
    }
    return false;
}
function getIdFromUtente($email, $connect): int
{
    $sql = "SELECT * FROM utenti  WHERE EMAIL = ?";
    $query = $connect->prepare($sql);
    $query->bind_param("s", $email);
    $query->execute();
    $result = $query->get_result();
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    return $row['id'];
}
function getNomeFromUtente($email, $connect): string
{
    $sql = "SELECT * FROM utenti  WHERE EMAIL = ?";
    $query = $connect->prepare($sql);
    $query->bind_param("s", $email);
    $query->execute();
    $result = $query->get_result();
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    return $row['nome'];
}
function getCognomeFromUtente($email, $connect): string
{
    $sql = "SELECT * FROM utenti  WHERE EMAIL = ?";
    $query = $connect->prepare($sql);
    $query->bind_param("s", $email);
    $query->execute();
    $result = $query->get_result();
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    return $row['cognome'];
}
function getEmailFromUtente($id, $connect): string
{
    $sql = "SELECT * FROM utenti  WHERE id = ?";
    $query = $connect->prepare($sql);
    $query->bind_param("s", $id);
    $query->execute();
    $result = $query->get_result();
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    return $row['email'];
}
function getPasswordFromUtente($email, $connect):string
{
    $sql = "SELECT * FROM utenti WHERE EMAIL = ?";
    $query = $connect->prepare($sql);
    $query->bind_param("s", $email);
    $query->execute();
    $result = $query->get_result();
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    return $row['password'];
}

function checkUserExistLogin($email, $password, $connect): bool
{
    $sql = "SELECT * FROM utenti WHERE EMAIL = ?";
    $query = $connect->prepare($sql);
    $query->bind_param("s", $email);
    $query->execute();
    $result = $query->get_result();

    if (mysqli_num_rows($result))
    {
        $hashedPassword = getPasswordFromUtente($email, $connect);
        if (password_verify($password, $hashedPassword))
        {
            return true;
        }
    }
    return false;

}

function insertNota($contenuto, $titolo,$id_cartella, $id_categoria, $connect)
{
    $sql = "INSERT INTO note (contenuto,titolo,id_cartella,id_categoria)
            VALUES 
            ('$contenuto','$titolo','$id_cartella','$id_categoria')";
    if ($connect->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}
function updateNota($id,$contenuto,$titolo,$id_cartella, $id_categoria, $connect)
{
    $sql = "UPDATE table note 
            set contenuto = '$contenuto', titolo = '$titolo', id_cartella = '$id_cartella', id_categoria = '$id_categoria'
            where id = '$id'";

    if ($connect->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}
function deleteNota($id,$connect)
{
    $sql = "DELETE * from note where id = '$id'";

    if ($connect->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}


