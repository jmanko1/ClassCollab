<?php
    if(empty($_POST['login'])) {
        header('Location: .');
        exit();
    }

    session_start();
    
    $all_ok = true;

    try {
        $login = $_POST['login'];
        if(strlen($login) > 20 || strlen($login) < 3) {
            throw new Exception('<div class="mt-3 text-danger text-center">Nazwa użytkownika musi posiadać od 3 do 20 znaków</div>');
        }
        if(!ctype_alnum($login)) {
            throw new Exception('<div class="mt-3 text-danger text-center">Nazwa użytkownika może składać się tylko z liter i cyfr (bez polskich znaków)")</div>');
        }

        $email = $_POST['email'];
        $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
        if(!filter_var($emailB, FILTER_VALIDATE_EMAIL) || $email != $emailB) {
            throw new Exception('<div class="mt-3 text-danger text-center">Podaj poprawny adres email</div>');
        }

        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];
        if(strlen($password1) > 20 || strlen($password1) < 8) {
            throw new Exception('<div class="mt-3 text-danger text-center">Hasło musi posiadać od 8 do 20 znaków"</div>');  
        }
        if($password1 != $password2) {
            throw new Exception('<div class="mt-3 text-danger text-center">Podane hasła nie są identyczne</div>');
        }

        if(!isset($_POST['check'])) {
            throw new Exception('<div class="mt-3 text-danger text-center">Zaakceptuj regulamin</div>');
        }

        require_once "../connect.php";
        $conn = @new mysqli($host, $db_user, $db_password, $db_name);
        if($conn->connect_errno != 0) {
            throw new Exception('<div class="mt-3 text-danger text-center">Error: " . $conn->connect_errno</div>');
        }

        $result = $conn->query("SELECT id FROM users WHERE login='$login'");
        if($result->num_rows != 0) {
            $conn->close();
            throw new Exception('<div class="mt-3 text-danger text-center">Użytkownik o takiej nazwie już istnieje</div>');
        }
        
        $result = $conn->query("SELECT id FROM users WHERE email='$email'");
        if($result->num_rows != 0) {
            $conn->close();
            throw new Exception('<div class="mt-3 text-danger text-center">Istnieje już użytkownik przypisany do tego adresu email</div>');
        }

        $password_hash = password_hash($password1, PASSWORD_DEFAULT);
        $conn->query("INSERT INTO users VALUES(NULL, '$login', '$email', '$password_hash', 1, NULL, now())");
        $_SESSION['register_result'] = '<div class="mt-3 text-success text-center">Rejestracja zakończona pomyślnie. Możesz teraz się zalogować.</div>';
        $conn->close();
    } catch(Exception $e) {
        $_SESSION['register_result'] = $e->getMessage();
        $_SESSION['reg_login'] = $_POST['login'];
        $_SESSION['reg_email'] = $_POST['email'];
        $_SESSION['reg_pass1'] = $_POST['password1'];
        $_SESSION['reg_pass2'] = $_POST['password2'];
        if(isset($_POST['check']))
            $_SESSION['reg_check'] = true;
    }

    header('Location: .');
?>