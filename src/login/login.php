<?php

if(empty($_POST['login'])) {
    header('Location: .');
    exit();
}

session_start();

require_once "../connect.php";

try {
    $conn = @new mysqli($host, $db_user, $db_password, $db_name);

    if($conn->connect_errno != 0)
        throw new Exception("Error: ".$conn->connect_errno);

    $login = $_POST['login'];
    $password = $_POST['password'];

    $login = htmlentities($login, ENT_QUOTES, "UTF-8");
    $password = htmlentities($password, ENT_QUOTES, "UTF-8");

    $query = sprintf("SELECT * FROM users WHERE login='%s'",
            mysqli_real_escape_string($conn, $login));

    $result = $conn->query($query);
    if(!$result) {
        $conn->close();
        throw new Exception("Wystąpił błąd z logowaniem");
    }

    $users_number = $result->num_rows;
    if($users_number == 0) {
        $conn->close();
        throw new Exception("Niepoprawna nazwa użytkownika lub hasło");
    }

    $row = $result->fetch_assoc();
    $password_hash = $row['password'];
    if(!password_verify($password, $password_hash)) {
        $conn->close();
        throw new Exception("Niepoprawna nazwa użytkownika lub hasło");
    }

    $_SESSION['id'] = $row['id'];
    $_SESSION['login'] = $row['login'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['role_id'] = $row['role_id'];
    $_SESSION['img'] = $row['img'];
    $_SESSION['signup_date'] = $row['signup_date'];

    $conn->close();
} catch(Exception $e) {
    $_SESSION['login_error'] = $e->getMessage();
}

header('Location: ../profile');

?>