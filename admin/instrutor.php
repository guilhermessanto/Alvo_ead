<?php
use Alvo\Instrutor;
use Alvo\Utilitarios;
use Alvo\Categoria;
use Alvo\CtrAcesso;

$pagina = "Instrutor (Consulta)";
require_once "../inc/cabecalho-admin.php";

$OBJctrAcesso = new CtrAcesso;
$OBJctrAcesso->verificaAcessoAdmin();

$instrutor = new Instrutor;
$listaDeInstrutores = $instrutor->listarInstrutores();

$OBJcategoria = new Categoria;
$listaDeCategoria = $OBJcategoria->listarCategorias();

// Utilitarios::dump($listaDeInstrutores);

?>


<div class="row">
	<article class="col-12 bg-white rounded shadow py-4">
		
		<h2 class="text-center">
		Instrutores <span class="badge bg-dark"><?=count($listaDeInstrutores)?></span>
		</h2>

		<!-- <p class="text-center mt-5">
			<a class="btn btn-primary" href="instrutor-insere.php">
			<i class="bi bi-plus-circle"></i>	
			Inserir um novo Instrutor</a>
		</p> -->
				
		<div class="table-responsive">
		
			<table class="table table-hover">
				<thead class="table-light">
					<tr>
						<th>Nome</th>
						<th>Limite de cursos</th>
						<th>Categoria</th>
						<th>Status de Controle</th>
						<th class="text-center">Operações</th>
					</tr>
				</thead>

				<tbody>
					<?php
						foreach($listaDeInstrutores as $instrutor) {
						?>
					<tr>
						<td><?=$instrutor['nome']?></td>
						<td><?=$instrutor['limiteCurso']?></td>
						<td><?=$instrutor['descCategoria']?></td>
						<?php 
						if ( $instrutor['indicador'] == "1" ) {
							$descIndicador = "Desativado";
						} else { 
							$descIndicador = "Ativo";
						}
						?>
						<td class="ml-5"><?=$descIndicador?></td>

						<td class="text-center">

							<a class="btn btn-warning" 
							href="instrutor-atualiza.php?id=<?=$instrutor['id']?>">
							<i class="bi bi-pencil"></i> Atualizar
							</a>
						
							<a class="btn btn-secondary" 
							href="instrutor-curso.php?id=<?=$instrutor['id']?>">
							<i class="bi bi-trash"></i> Cursos
							</a>

						</td>
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