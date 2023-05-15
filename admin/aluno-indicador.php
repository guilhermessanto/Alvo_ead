<?php

use Alvo\Aluno;
use Alvo\CtrAcesso;
use Alvo\Utilitarios;

$pagina = "Alunos(atualizar)";
require_once "../inc/cabecalho-admin.php";

$OBJctrAcesso = new CtrAcesso;
$OBJctrAcesso->verificaAcessoAdmin();

$OBJaluno = new Aluno;
$OBJaluno ->setId($_GET['alunoId']);
$umAluno = $OBJaluno -> listarUmCurso();

/* Utilitarios::dump($umAluno); */

if( isset ($_POST['atualizar'])) {
    $OBJaluno->setId($_GET['alunoId']);
	$OBJaluno->setIndicador($_POST['indicador']);
	$OBJaluno->setCtrAcessoId($_GET['ctrId']);

    $OBJaluno->atualizaIndicador();
	header("location:aluno-atualiza.php?ctrId=".$umAluno['ctrAcesso_id']);
}

?>


<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">
	
        <h2 class="text-center">
        Atualizar dados do usuário
		 <span class="badge bg-dark"><?=$umAluno['nome']?></span>
		</h2>
				
		<form class="mx-auto w-75" action="" method="post" id="form-atualizar" name="form-atualizar">

			<div class="mb-3">
				<label class="form-label" for="nome">Curso:</label>
				<input class="form-control" type="text" id="curso_id" name="curso_id"  value="<?=$umAluno['nomeCurso']?>" readonly>
				
			</div>
		
			<div class="mb-3">
				<label class="form-label" for="indicador">Status de Controle:</label>
                <select class="form-select" name="indicador" id="indicador" required>
                    <option value=""></option>
                    <option value="0">Ativo</option>
                    <option value="1">Desativado</option>
                </select>
			</div>
			
			<button class="btn btn-primary" name="atualizar"><i class="bi bi-arrow-clockwise"></i> Atualizar</button>
			<br class="mb-5">
			<br class="mb-5">
			<br class="mb-5">
			
		</form>
		
	</article>
</div>


</body>
</html>
