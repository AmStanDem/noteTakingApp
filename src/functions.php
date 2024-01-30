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

function getPasswordFromEmail($email, $connect):string
{
    $sql = "SELECT * FROM utenti WHERE EMAIL = ?";
    $query = $connect->prepare($sql);
    $query->bind_param("s", $email);
    $query->execute();
    $result = $query->get_result();
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    return $row['password'];
}

function checkDataLogin($email, $password): bool
{
    if (isset($email) && isset($password)) {
        return true;
    }
    return false;
}

function checkDataLink($url): bool
{
    if (isset($url)) {
        return true;
    }
    return false;
}

function getIdFromUser($email, $password, $connect): int
{
    $sql = "SELECT * FROM utenti  WHERE EMAIL = ? and password = ?";
    $query = $connect->prepare($sql);
    $query->bind_param("ss", $email, $password);
    $query->execute();
    $result = $query->get_result();
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    return $row['id'];
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
        $hashedPassword = getPasswordFromEmail($email, $connect);
        if (password_verify($password, $hashedPassword))
        {
            return true;
        }
    }
    return false;

}

function insertLinkUser($linkId, $userId, $titolo, $letto, $categoria, $connect)
{
    $sql = "INSERT INTO link_utente (id_utente, id_link, titolo, id_categoria, letto)
            VALUES 
            ('$userId','$linkId','$titolo','$categoria', '$letto')";
    if ($connect->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }

}

function checkLinkUserData($linkId, $userId, $titolo, $letto, $categoria)
{
    if (isset($linkId) && isset($userId) && isset($titolo) && isset($letto) && isset($categoria)) {
        return true;
    }
    return false;
}

function insertUrl($url, $connect)
{
    $sql = "INSERT INTO link (url)
            VALUES 
            ('$url')";
    if ($connect->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

function getLinkId($url, $connect)
{
    $sql = "SELECT * FROM link  WHERE url = ?";
    $query = $connect->prepare($sql);
    $query->bind_param("s", $url);
    $query->execute();
    $result = $query->get_result();
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    return $row['id'];
}
