<?php

use Alvo\CtrAcesso;
use Alvo\Utilitarios;

$pagina = "Inicio";
require_once "../inc/cabecalho-user.php";
$OBJctrAcesso = new CtrAcesso;
$OBJctrAcesso->verificaAcessoAluno();


/* $teste = $_SESSION;*/
/* Utilitarios::dump($OBJctrAcesso->verificaAcessoAluno());  */
?>


<article class="p-5 my-4 rounded-3 bg-white shadow">
    <div class="container-fluid py-1">        
    <h2 class="display-4">Olá <?=$_SESSION['nome']?></h2>
				<!-- <p class="my-2 alert alert-primary text-center">
				</p> -->

        <p class="fs-5">Você está no <b>painel de controle e administração</b> do
		site Alvo e seu <b>nível de acesso</b> é <span class="badge bg-primary"><?=$_SESSION['descNivel']?></span>.</p>
        <hr class="my-4">
        <div class="d-grid gap-2 d-md-block text-center">

            <a class="btn btn-primary bg-gradient btn-lg" href="meuperfil.php">
                <i class="fa fa-user"></i> <br>
                Meu Perfil
            </a>
            <a class="btn btn-primary bg-gradient btn-lg" href="cursos.php">
                <i class="fa fa-book"></i> <br>
                cursos
            </a>
            
			
        </div>
    </div>
</article>

<?php 
 require_once "../inc/rodape-admin.php"
 ?>