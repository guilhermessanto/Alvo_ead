<?php
use Alvo\Categoria;
use Alvo\Utilitarios;
use Alvo\CtrAcesso;

$pagina = "Categoria (Consulta)";
require_once "../inc/cabecalho-admin.php";

$OBJctrAcesso = new CtrAcesso;
$OBJctrAcesso->verificaAcessoAdmin();

$OBJcategoria = new Categoria;
$listaDeCategoria = $OBJcategoria->listarCategorias();

?>


<div class="row">
	<article class="col-12 bg-white rounded shadow py-4">
		
		<h2 class="text-center">
		Categorias <span class="badge bg-dark"><?=count($listaDeCategoria)?></span>
		</h2>

		<p class="text-center mt-5">
			<a class="btn btn-primary" href="categoria-insere.php">
			<i class="bi bi-plus-circle"></i>	
			Inserir nova Categoria</a>
		</p>
				
		<div class="table-responsive">
		
			<table class="table table-hover">
				<thead class="table-light">
					<tr>
						<th>Descrição</th>
						<th class="text-center">Operações</th>
					</tr>
				</thead>

				<tbody>
					<?php
						foreach($listaDeCategoria as $categoria) {
						?>
					<tr>
						<td><?=$categoria['descCategoria']?></td>
						<td class="text-center">
							<a class="btn btn-warning" 
							href="categoria-atualiza.php?id=<?=$categoria['id']?>">
							<i class="bi bi-pencil"></i> Atualizar
							</a>
						
							<!-- <a class="btn btn-danger excluir" 
							href="categoria-exclui.php?id=<?=$categoria['id']?>">
							<i class="bi bi-trash"></i> Excluir
							</a> -->
							
							<?php
								if ( $categoria['indicador'] == 1 ) { ?>
									
									<a class="btn btn-danger" id="indicador" name="indicador" value="0"
									href="categoria-status.php?id=<?=$categoria['id']?>&indicador=0">
										<i class="bi bi-save"></i> Desabilitado</a>
									
								<?php } else { ?>
									<a class="btn btn-success" id="indicador" name="indicador" value="1"
									href="categoria-status.php?id=<?=$categoria['id']?>&indicador=1">
										<i class="bi bi-save"></i> &nbsp; Habilitado &nbsp;</a>
									
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
</body>
</html>