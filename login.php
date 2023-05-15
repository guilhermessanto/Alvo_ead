<?php
ob_start();
use Alvo\Generico;
use Alvo\CtrAcesso;
use Alvo\Utilitarios;
use Alvo\Nivel;
require "./vendor/autoload.php";

// Mensagens de feedback relacionadas ao login
if( isset($_GET['acesso_proibido'])) {
	$feedback = 'Você deve logar primeiro! <i class="bi bi-x-circle"></i>';
} elseif (isset($_GET['campos_obrigatorios'])) {
	$feedback = 'Você deve preencher os dois campos! <i class="bi bi-exclamation-circle"></i>';
} elseif (isset ($_GET['nao_encontrado'])) {
    $feedback = 'Usuário não encontrado! <i class="bi bi-x-circle"></i> ';
} elseif (isset ($_GET['senha_incorreta'])) {
	$feedback = 'Senha incorreta! <i class="bi bi-x-circle"></i> ';
} elseif (isset ($_GET['logout'])) {
	$feedback = 'Você saiu do sistema!';
} elseif (isset ($_GET['acesso_bloqueado'])) {
    $feedback = 'Acesso do Usuário Bloquedo! <i class="bi bi-x-circle"></i>';
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Alvo</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/alvo_favicon.ico" type="image/x-icon">
    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="js/bootstrap.min.css">
    <link rel="stylesheet" href="js/all.min.css">
    <!-- CSS Proprio -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="container-fluid d-flex flex-column h-100">
<div class="row">

<div class="bg-geral col-12 col-md-4 py-4 vh-100">
    
    <div class=" text-center pt-5 pb-5">
        <a href="index.php">
            <img src="assets/logo-alvo-figma.png" alt="">
        </a>
    </div>
        
    <main class="mainLogin principalLogin pt-3 mt-2">     
    <h2 class="fw-light text-light text-center">Login</h2>
        <form action="" method="post" id="form-login" name="form-login" class="w-75 container-fluid" >
        <?php if(isset($feedback)){?>
				<p class="my-2 alert alert-warning text-center">
					<?= $feedback?>
				</p>
                <?php } ?>

				<div class="mb-3">
					<label for="email" class="form-label text-light mt-2">E-mail:</label>
					<input class="form-control" type="email" id="email" name="email" placeholder="Insira seu E-mail">
				</div>

				<div class="mb-3">
					<label for="senha" class="form-label text-light mt-2">Senha:</label>
					<input class="form-control" type="password" id="senha" name="senha" placeholder="Insira sua senha">
				</div>

				<button class="btn btn-warning btn-lg w-100 mt-3" name="entrar" type="submit">Entrar</button>
                <div class="d-flex">

                <p class="text-center p-2">
                    <a href="cadastro.php" class="text-light">Cadastre-se</a>
                </p> 

                <p class="text-center p-2">
                    <a href="index.php" class="text-light">Voltar a home</a>
                </p>

                </div>
			</form> 
            <?php
                if(isset($_POST['entrar'])){
                    // Verificação de campos do formulário
                    if(empty($_POST['email']) || empty($_POST['senha'])) {
                        header("location:login.php?campos_obrigatorios");
                    } else {
                        // Capturando o e-mail informado
                        $generico = new Generico;
                        $generico->setEmail($_POST['email']);
                        
                        // buscando um usuário no banco a partir do e-mail
                        $dados = $generico->buscar();
                        
                        // Recuperando o nível do usuário logado
                        $OBJnivel = new Nivel;
                        $dadosNivel = $OBJnivel->listarNiveis();
                        $arrayNivel = $dadosNivel[ $dados['nivel_id'] - 1];
                        $descNivel = $arrayNivel['descNivel'];
                       
                        /* Se os dados forem falso (ou seja, não tem nenhum usuário cadastrado e da um feedback*/
                        if(!$dados){
                            header("location:login.php?nao_encontrado");
                        } elseif ( $dados['indicador'] == 1 ) {
                            header("location:login.php?acesso_bloqueado");
                        } else {
                            /* Verificação da senha e login*/
                            if (password_verify($_POST['senha'], $dados['senha'])){
                                // die($dados['senha']);
                                // Estando certo, será feito o login
                                $sessao = new CtrAcesso;
                                $sessao->login($dados['id'], $dados['email'], $dados['nivel_id'], $dados['nome'], $descNivel);
                                if ( $dados['nivel_id'] == 1 ) {
                                    $direct = "admin";
                                } elseif ( $dados['nivel_id'] == 2 ) {
                                    $direct = "instro";
                                } else { $direct = "alunos"; }
                                header("location:".$direct."/index.php");
                            } else {
                                // caso contrário, mantenha na página login e apresente uma mensagem
                                header("location:login.php?senha_incorreta");
                            }
                        }
                    }
                }
            ?>
    </main> 
</div>

<section class="imagemLogin bg-white col-12 col-md-8 align-self-center">
    <div class="d-flex justify-content-center pt-4 mt-5">
        <img src="assets/imagem-login-colorida.jpg" class="img-fluid" alt="" srcset="">
    </div>
</section>

</div>        
</body>
</html>
<?php ob_end_flush(); ?>