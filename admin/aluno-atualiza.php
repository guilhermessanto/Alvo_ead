<?php

use Alvo\Aluno;
use Alvo\Utilitarios;
use Alvo\CtrAcesso;

$pagina = "Alunos (Consulta)";
require_once "../inc/cabecalho-admin.php";

$OBJctrAcesso = new CtrAcesso;
$OBJctrAcesso->verificaAcessoAdmin();

$OBJaluno = new Aluno;
$OBJaluno -> setCtrAcessoId($_GET['ctrId']);
$umAluno = $OBJaluno ->listarUmAluno();
Utilitarios::dump($umAluno);
// $cursosAtivos = $OBJaluno ->cursosAtivosAlunos();

if( isset ($_POST['atualizar'])) {
	$OBJaluno -> setId($_GET['alunoId']);
	$OBJaluno->setIndicador($_POST['indicador']);
	$OBJaluno->atualizaIndicador();
	header("location:aluno.php");
}
?>


<div class="row">
	<article class="col-12 bg-white rounded shadow py-4">
		
	<h2 class="text-center">
			Atualizar dados do Aluno
		</h2>
				
		<form class="mx-auto w-75" action="" method="post" id="form-atualizar" name="form-atualizar">

			<div class="mb-3">
				<label class="form-label" for="text">Aluno:</label>
				<input class="form-control" type="text" id="nome" name="nome" value="<?=$umAluno['nome']?>" readonly>
			</div>

			<div class="mb-3">
				<label class="form-label" for="indicador">Status de Controle:</label>
                <select class="form-select" name="indicador" id="indicador" required>
                    <option value="<?=$umAluno['indicador']?>"></option>
                    <option 
					<?php if ($umAluno['indicador'] == "0") echo " selected "?>
					value="0">Ativo</option>
                    <option 
					<?php if ($umAluno['indicador'] == "1") echo " selected "?>
					value="1">Desativado</option>
                </select>
			</div>
			
			<button class="btn btn-primary" name="atualizar"><i class="bi bi-arrow-clockwise"></i> Atualizar</button>
			<br class="mb-5">
			<br class="mb-5">
			<br class="mb-5">

		</form>
		
	</article>
</div>

<?php 
require_once "../inc/rodape-admin.php";
?>
</body>
</html>