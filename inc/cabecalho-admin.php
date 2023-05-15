<?php
ob_start();
use Alvo\CtrAcesso;
use Alvo\Utilitarios;

require_once "../vendor/autoload.php";

// criamos o obj para acessar os recursos de PHP na classe ControleDeAcesso

$OBJsessao = new CtrAcesso;

// Executamos verificaAcesso para checar se tem alguém logado
$OBJsessao->verificaAcesso();

// Se tiver o parâmetro ?sair existir, então faça o logout
if ( isset($_GET['sair']) ) $OBJsessao->logout();

// Cria um controle com o nome da página de acesso
// $pagina = basename($_SERVER['PHP_SELF']);

?>
<!DOCTYPE html>
<html lang="pt-br" class="h-100">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Alvo - <?=$pagina?></title>
  <!-- Favicon -->
  <link rel="shortcut icon" href="../assets/alvo_favicon.ico" type="image/x-icon">
  <!-- CSS Bootstrap -->
  <link rel="stylesheet" href="../js/bootstrap.min.css">
  <link rel="stylesheet" href="../js/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- CSS Proprio -->
  <link rel="stylesheet" href="../css/style.css">
  
</head>

<body class="d-flex flex-column  cor-fundo ">

<!-- header -->
<header class="mb-4">
  <nav class="navbar navbar-expand-lg bg-light ">
    <div class="container-fluid">
      <a class="navbar-brand col-lg-3 d-flex justify-content-lg-center" href="../index.php"><img class="logo" src="../assets/logo_alvo.png" alt="Logo Alvo"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav col-lg-8 d-flex justify-content-lg-center  fs-5 fw-semibold">
         
        
          <!-- Adminstrador -->
          <?php if( $_SESSION['nivel_id'] == 1 ) { ?>
            <li class="nav-item">
              <a class="nav-link" href="../admin/index.php">Início</a>
            </li>
         </ul>
        <?php } else if( $_SESSION['nivel_id'] == 2 ) { ?>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Inicio</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="../instro/curso.php">Cursos</a>
          </li>
        </ul>
        <?php } ?>

        <!-- Aluno -->
        <?php if( $_SESSION['nivel_id'] >= 5 ) { ?>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../alunos/cursos.php">Cursos</a>
          </li>
        </ul>
        <?php } ?>

        <div class="col-lg-4 d-flex justify-content-lg-center justify-content-sm-start">
        <a href="?sair" class="btn btn-outline-primary me-2">Sair</a>
        </div>
      </div>
    </div>
  </nav>
</header>
<!-- </header> -->
