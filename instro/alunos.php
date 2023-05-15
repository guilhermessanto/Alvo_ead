<?php

use Alvo\CtrAcesso;
use Alvo\Instrutor;
use Alvo\Modalidade;
use Alvo\Utilitarios;

$pagina = "Alunos";
require_once "../inc/cabecalho-admin.php";
$OBJctrAcesso = new CtrAcesso;
$OBJctrAcesso->verificaAcessoInstr();

// Utilitarios::dump($_SESSION);
$OBJmodalidade = new Modalidade;
$listarModalidade = $OBJmodalidade-> listarModalidade();

$OBJinstrutor = new Instrutor;
$listaDeInstrutores = $OBJinstrutor -> listarInstrutores();
foreach($listaDeInstrutores as $instrutor){
	if($instrutor['ctrAcesso_id'] == $_SESSION['id'] ){
		$_SESSION['id_tabRel'] = $instrutor['id'];
	}
}

$OBJinstrutor ->setId($_SESSION['id_tabRel']);
$listaDeAlunos = $OBJinstrutor -> listarCursoAlunoInst();

?>

<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">
		
		<h2 class="text-center">
		Alunos do Instrutor <span class="badge bg-dark"><?=$_SESSION['nome']?></span>
		</h2>
				
		<div class="table-responsive">
		
			<table class="table table-hover">
				<thead class="table-light">
					<tr>
						<th>Nome Aluno</th>
						<th>E-mail</th>
						<th>Curso</th>
						<th>Descrição Curso</th>
						<th>Modalidade</th>
					</tr>
				</thead>

				<tbody>
				<?php foreach($listaDeAlunos as $alunos){ ?>
					<tr>
						<td><?=$alunos['nomeAluno']?></td>
						<td><?=$alunos['email']?></td>
						<td><?=$alunos['nomeCurso']?></td>
						<td><?=$alunos['descCurso']?></td>
						<td>
							<?php foreach($listarModalidade as $OBJmodalidade) {
								if($alunos['modalidade_id'] === $OBJmodalidade['id']) echo $OBJmodalidade['descModalidade'];?>	
							<?php } ?>
						</td>
					</tr>
				<?php } ?>
				</tbody>                
			</table>
			<br class="mb-5">
			<br class="mb-5">
			<br class="mb-5">
	</div>
		
	</article>
</div>

<?php 
require_once "../inc/rodape-admin.php";
?>