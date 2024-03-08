<?php
  session_start();
  if(!empty($_SESSION['id'])) {
    header('Location: ../profile');
    exit();
  }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ClassCollab - zarejestruj się</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
  <nav class="navbar navbar-expand-lg bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand text-light" href="#">ClassCollab</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active text-light" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="#">Link</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Dropdown
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item text-light" href="#">Action</a></li>
              <li><a class="dropdown-item text-light" href="#">Another action</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item text-light" href="#">Something else here</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled text-light" aria-disabled="true">Disabled</a>
          </li>
        </ul>
        <a href="#">
          <button type="button" class="btn btn-primary">Zaloguj się</button>
        </a>
      </div>
    </div>
  </nav>
  <form class="mt-5 border border-dark p-4 col-4 me-auto ms-auto" method="post" action="register.php">
    <fieldset class="text-center">
      <legend>Zarejestruj się</legend>
      <div class="mb-3">
        <label for="login" class="form-label">Login:</label>
        <input type="text" class="form-control" id="login" name="login"<?php 
          if(!empty($_SESSION['reg_login']))
            echo ' value="'.$_SESSION['reg_login'].'"';
        ?>>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Adres e-mail:</label>
        <input type="email" class="form-control" id="email" name="email"<?php 
          if(!empty($_SESSION['reg_email']))
            echo ' value="'.$_SESSION['reg_email'].'"';
        ?>>
      </div>
      <div class="mb-3">
        <label for="password1" class="form-label">Hasło:</label>
        <input type="password" class="form-control" id="password1" name="password1"<?php 
          if(!empty($_SESSION['reg_pass1']))
            echo ' value="'.$_SESSION['reg_pass1'].'"';
        ?>>
      </div>
      <div class="mb-3">
        <label for="password2" class="form-label">Potwierdź hasło:</label>
        <input type="password" class="form-control" id="password2" name="password2"<?php 
          if(!empty($_SESSION['reg_pass2']))
            echo ' value="'.$_SESSION['reg_pass2'].'"';
        ?>>
      </div>
      <div class="mb-3">
        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" name="check"<?php 
          if(isset($_SESSION['reg_check']))
            echo " checked";
        ?>>
        <label class="form-check-label" for="defaultCheck1">
          Akceptuję regulamin
        </label>
      </div>
      <button type="submit" class="btn btn-primary">Zarejestruj się</button>
      <div class="text-center mt-3">
        Masz już konto?
        <a href="../login">Zaloguj się</a>
      </div>
    </fieldset>
  </form>
  <?php
    if(!empty($_SESSION['register_result'])) {
      echo $_SESSION['register_result'];
    }
    session_unset();
  ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>