<?php
use Alvo\Generico;
use Alvo\Utilitarios;
use Alvo\CtrAcesso;

$pagina = "Administrativo";
require_once "../inc/cabecalho-admin.php";

$OBJctrAcesso = new CtrAcesso;
$OBJctrAcesso->verificaAcessoAdmin();

?>


<article class="p-5 rounded-3 bg-white shadow">
    <div class="container-fluid py-1">        
        <h2 class="display-4">Olá <?=$_SESSION['nome']?></h2>
				<!-- <p class="my-2 alert alert-primary text-center">
				</p> -->

        <p class="fs-5">Você está no <b>painel de controle e administração</b> do
		site Alvo e seu <b>nível de acesso</b> é <span class="badge bg-primary"> <?=$_SESSION['descNivel']?></span>.</p>
        <hr class="my-4">
        <div class="d-grid gap-2 d-md-block text-center">
            <a class="btn btn-primary bg-gradient btn-lg" href="documentacao.php">
                <i class="fa fa-book" aria-hidden="true"></i> <br>
                Documentação
            </a>
            <a class="btn btn-primary bg-gradient btn-lg" href="categoria.php">
                <i class="fa fa-diamond" aria-hidden="true"></i> <br>
                Categoria
            </a>
			<a class="btn btn-primary bg-gradient btn-lg" href="nivel.php">
                <i class="fa fa-leaf"></i> <br>
                Nível
            </a>
            <a class="btn btn-primary bg-gradient btn-lg" href="modalidade.php">
                <i class="fa fa-bars"></i> <br>
                Modalidade
            </a>
            <a class="btn btn-primary bg-gradient btn-lg" href="generico.php">
                <i class="fa fa-person"></i> <br>
                Favorecido
            </a>

            <a class="btn btn-primary bg-gradient btn-lg" href="instrutor.php">
                <i class="fa fa-graduation-cap"></i> <br>
                Instrutor
            </a>
            <a class="btn btn-primary bg-gradient btn-lg" href="aluno.php">
                <i class="fa fa-users"></i> <br>
                Alunos
            </a>
			
        </div>
    </div>
</article>

    </body>
</html>