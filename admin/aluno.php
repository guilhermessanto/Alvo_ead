<?php

use Alvo\Aluno;
use Alvo\CtrAcesso;
use Alvo\Utilitarios;

$pagina = "Alunos (Consulta)";
require_once "../inc/cabecalho-admin.php";

$OBJctrAcesso = new CtrAcesso;
$OBJctrAcesso->verificaAcessoInstr();

// $listaDeAlunos = $OBJctrAcesso ->listarCtrAcessos();
$OBJalunos = new Aluno;
$listaDeAlunos = $OBJalunos ->listarAlunosADM();

// Utilitarios::dump($listaDeAlunos);

?>


<div class="row">
	<article class="col-12 bg-white rounded shadow py-4">
		
		<h2 class="text-center">
		Alunos <span class="badge bg-dark"></span>
		</h2>
				
		<div class="table-responsive">
		
			<table class="table table-hover">
				<thead class="table-light">
					<tr>
						<th>CNPJ/CPF</th>
						<th>Nome</th>
						<th>Status de Controle</th>
						<th class="text-center">Operações</th>
					</tr>
				</thead>

				<tbody>
				<?php foreach ($listaDeAlunos as $alunos) {?>
				<tr>
					<td><?=Utilitarios::formataCnpjcpf($alunos['cnpjcpf'])?></td>
					<td><?= $alunos['nome']?></td>
					<?php 
						if ( $alunos['indicador'] == "1" ) {
							$descIndicador = "Desativado";
						} else { 
							$descIndicador = "Ativo";
						}
					?>
					<td class="ml-5"><?=$descIndicador?></td>
					<td class="text-center">
					
					<!-- Desconsiderado a opção (ativo/desativado), deixamos para fazer no ctrAcesso -->
					<!-- <a class="btn btn-warning" 
						href="aluno-atualiza.php?ctrId=<?=$alunos['id']?>">
						<i class="bi bi-pencil">Atualiza</i> 
					</a> -->

					<a class="btn btn-success" 
						href="aluno-lista-curso.php?id=<?=$alunos['id']?>">
						<i class="bi bi-pencil">Consulta Curso</i> 
					</a>
					
					<a class="btn btn-primary" 
						href="aluno-curso.php?ctrId=<?=$alunos['id']?>">
						<i class="bi bi-pencil">Habilita Curso</i> 
					</a>
					
					</td>
				</tr>
				<?php }?>
					
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
