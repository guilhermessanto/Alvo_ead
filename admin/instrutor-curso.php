<?php

use Alvo\Instrutor;
use Alvo\Utilitarios;

$pagina = "Instrutor (Cursos Habilitados)";
require_once "../inc/cabecalho-admin.php";

$OBJinstrutor = new Instrutor;
$OBJinstrutor ->setId($_GET['id']);

$cursosDoInstrutor = $OBJinstrutor -> listarCursoInstrutor();
// Utilitarios::dump($cursosDoInstrutor);

?>

<div class="row">
	<article class="col-12 bg-white rounded shadow py-4">
		
		<h2 class="text-center">
			Instrutor <span class="badge bg-dark"><?=$cursosDoInstrutor[0]['nome'] ?></span>
			<a class="btn btn-primary ms-5" href="instrutor.php"><i class="bi bi-pencil">Voltar</i></a>
		</h2>
				
		<div class="table-responsive">
		
			<table class="table table-hover">
				<thead class="table-light">
					<tr>
						<th>Curso</th>
						<th>Descrição do Curso</th>
						<th>Status Curso</th>
						<th>Modalidade</th>
					</tr>
				</thead>

				<tbody>
					<?php
						foreach($cursosDoInstrutor as $curso) {
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
						<td><?=$curso['descModalidade']?></td>
					</tr>
					<?php } ?>
				</tbody>                
			</table>
			<br class="mb-5">
			<br class="mb-5">
	</div>
		
	</article>
</div>

<?php 
require_once "../inc/rodape-admin.php";
?>

</body>
</html>