<?php

use Alvo\Aluno;
use Alvo\CtrAcesso;
use Alvo\Utilitarios;

$pagina = "Alunos (Cursos Habilitados)";
require_once "../inc/cabecalho-admin.php";

$OBJctrAcesso = new CtrAcesso;
$OBJctrAcesso->verificaAcessoAdmin();

$OBJaluno = new Aluno;
$OBJaluno ->setId($_GET['id']);
$listaUmAluno = $OBJaluno -> listarUmAlunoADM();
// Utilitarios::dump($_GET['id']);

$cursosDoAlunoADM = $OBJaluno -> listarCursoAlunoADM();
// Utilitarios::dump($cursosDoAlunoADM);

?>

<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">
		
		<h2 class="text-center">
			Aluno <span class="badge bg-dark"><?=$listaUmAluno['nome'] ?></span>
			<a class="btn btn-primary ms-5" href="aluno.php"><i class="bi bi-pencil">Voltar</i></a>
		</h2>
				
		<div class="table-responsive">
		
			<table class="table table-hover">
				<thead class="table-light">
					<tr>
						<th>Curso</th>
						<th>Descrição do Curso</th>
						<th>Status Curso</th>
						<th>Instrutor</th>
						<th>Operação</th>
					</tr>
				</thead>
				<?php
					if (empty ($cursosDoAlunoADM)) { ?>
					<td></td>
					<td></td>
					<td class="fw-bold text-danger">"** Não Passui Curso Habilitado **"</td>
					<td></td>

				<?php } ?>

				<tbody>
					<?php
						foreach($cursosDoAlunoADM as $curso) {
						?>
					<tr>
						<td><?=$curso['nomeCurso']?></td>
						<td><?=$curso['descCurso']?></td>
						<?php 
							if ( $curso['indicador'] == "1" ) {
								$descIndicador = "Desativado";
							} elseif ( $curso['indicador'] == "0" ) {
								$descIndicador = "Ativo";
							} else {
								$descIndicador = "** Não Passui Curso Habilitado **";
							}
						?>
						<td class="ml-5"><?=$descIndicador?></td>
						<td><?=$curso['nomeInstrutor']?></td>
						<td><a class="btn btn-warning" 
							href="aluno-atualiza-curso.php?id=<?=$curso['cursoId']?>">
							<i class="bi bi-pencil"></i> Atualizar
						</a></td>
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