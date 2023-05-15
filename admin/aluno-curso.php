<?php

use Alvo\Aluno;
use Alvo\CtrAcesso;
use Alvo\Curso;
use Alvo\Utilitarios;

$pagina = "Alunos (Habilita Curso)";
require_once "../inc/cabecalho-admin.php";

$OBJctrAcesso = new CtrAcesso;
$OBJctrAcesso->verificaAcessoAdmin();

$OBJcursos = new Curso;
$cursos = $OBJcursos -> todosOsCursos();

$OBJaluno = new Aluno;
$OBJaluno ->setCtrAcessoId($_GET['ctrId']);

$umAluno = $OBJaluno -> listarUmAluno();

// Utilitarios::dump($umAluno);

if( isset ($_POST['atualizar'])) {

	$OBJaluno->setIndicador($_POST['indicador']);
	$OBJaluno->setCursoId($_POST['curso_id']);
	$OBJaluno->setCtrAcessoId($_GET['ctrId']);
	
	$OBJaluno->habilitaCurso();
	header("location:aluno.php");
}

?>

<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">
		
		<h2 class="text-center">
		Habilitar Curso do Aluno
		</h2>
				
		<form class="mx-auto w-75" action="" method="post" id="form-atualizar" name="form-atualizar">

			<div class="mb-3">
				<label class="form-label" for="nome">Nome:</label>
				<input class="form-control" type="text" id="nome" name="nome"  value="<?=$umAluno['nome']?>" readonly>
				
			</div>

			<div class="mb-3">
				<label class="form-label" for="email">E-mail:</label>
				<input class="form-control" type="email" id="email" name="email" value="<?=$umAluno['email']?>" readonly >
			</div>		
			<div class="mb-3">
				<label class="form-label" for="curso_id">Cursos:</label>
                <select class="form-select" name="curso_id" id="curso_id" required>
                    <option value=""></option>
					<?php foreach($cursos as $curso){?>
                    <option value="<?=$curso['id']?>"><?=$curso['nomeCurso']?></option>
					<?php } ?>
                </select>
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
			<a class="btn btn-secondary ms-5" href="aluno.php"><i class="bi bi-pencil"> Voltar</i></a>
			
            <br class="mb-5">
			<br class="mb-5">
            <br class="mb-5">

		</form>
		
	</article>
</div>

<?php 
require_once "../inc/rodape-admin.php";
?>