<?php

use Alvo\Curso;
use Alvo\Aluno;
use Alvo\CtrAcesso;
use Alvo\Utilitarios;

$pagina = "cursos";
require_once "../inc/cabecalho-user.php";
$OBJctrAcesso = new CtrAcesso;
// $OBJctrAcesso->verificaAcessoAluno();

/* Utilitarios::dump($_SESSION); */
$OBJalunos = new Aluno;
$OBJalunos ->setCtrAcessoId($_SESSION['id']);
$cursosDosAluno = $OBJalunos ->cursosAtivosAlunos();

?>

<section class="row d-flex justify-content-evenly ajusfigura pt-5">
    <?php foreach($cursosDosAluno as $curso){?>
        <div class="card text-center card col-3 mb-5 ajusRaio" style="width: 18rem;">
            <img src="../imagem/<?=$curso['imagem']?>" class="card-img-top ajusImagem" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?=$curso['nomeCurso']?></h5>
                <p class="card-text"></p>
                <a href="videos.php?cursoId=<?=$curso['id']?>" class="btn btn-primary">Assistir</a>
            </div>
        </div>
    <?php }?>
    
</section>

<?php 
require_once "../inc/rodape-admin.php"
?>