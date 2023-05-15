<?php
require_once "vendor/autoload.php";
?>
<!DOCTYPE html>
<html lang="pt-br" class="h-100">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Alvo - <?=$pagina?></title>
  <!-- Favicon -->
  <link rel="shortcut icon" href="assets/alvo_favicon.ico" type="image/x-icon">
  <!-- CSS Bootstrap -->
  <link rel="stylesheet" href="js/bootstrap.min.css">
  <link rel="stylesheet" href="js/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- CSS Proprio -->
  <link rel="stylesheet" href="css/style.css">
  
</head>

<body class="d-flex flex-column ">

<!-- header -->
<header>
  <nav class="navbar navbar-expand-lg bg-light ">
    <div class="container-fluid">
      <a class="navbar-brand col-lg-3 d-flex justify-content-lg-center" href="index.php"><img class="logo" src="assets/logo_alvo.png" alt="Logo Alvo"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav col-lg-8 d-flex justify-content-lg-center  fs-5 fw-semibold">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cursos.php">Cursos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link pb-md-0 pb-sm-3" href="contato.php">Contato</a>
          </li>
        </ul>

        <div class="col-lg-4 d-flex justify-content-lg-center justify-content-sm-start">
        <a href="login.php" class="btn btn-outline-primary me-2">Login</a>
          <a href="cadastro.php" class="btn btn-primary">Cadastre-se</a>
        </div>
      </div>
    </div>
  </nav>
</header>
