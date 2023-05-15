<?php
use Alvo\Modalidade;
use Alvo\Utilitarios;
use Alvo\CtrAcesso;

$pagina = "Modalidade (Consulta)";
require_once "../inc/cabecalho-admin.php";

$OBJctrAcesso = new CtrAcesso;
$OBJctrAcesso->verificaAcessoAdmin();

$OBJmodalidade = new Modalidade;
$listaDeModalidades = $OBJmodalidade->listarModalidade();

// Utilitarios::dump($listaDeNiveis);
?>


<div class="row">
	<article class="col-12 bg-white rounded shadow py-4">
		
		<h2 class="text-center">
		Modalidade <span class="badge bg-dark"><?=count($listaDeModalidades)?></span>
		</h2>

		<p class="text-center mt-5">
			<a class="btn btn-primary" href="modalidade-insere.php">
			<i class="bi bi-plus-circle"></i>	
			Inserir nova Modalidade</a>
		</p>
				
		<div class="table-responsive">
		
			<table class="table table-hover">
				<thead class="table-light">
					<tr>
						<th>Código</th>
						<th>Descrição</th>
						<th class="text-center">Operações</th>
					</tr>
				</thead>

				<tbody>
					<?php
						foreach($listaDeModalidades as $modalidade) {
						?>
					<tr>
						<td><?=$modalidade['codModalidade']?></td>
						<td><?=$modalidade['descModalidade']?></td>
						<td class="text-center">
							<a class="btn btn-warning" 
							href="modalidade-atualiza.php?id=<?=$modalidade['id']?>">
							<i class="bi bi-pencil"></i> Atualizar
							</a>
						
							<!-- <a class="btn btn-danger excluir" 
							href="modalidade-exclui.php?id=<?=$modalidade['id']?>">
							<i class="bi bi-trash"></i> Excluir
							</a> -->

							<?php
								if ( $modalidade['indicador'] == 1 ) { ?>
									
									<a class="btn btn-danger" id="indicador" name="indicador" value="0"
									href="modalidade-status.php?id=<?=$modalidade['id']?>&indicador=0">
										<i class="bi bi-save"></i> Desabilitado</a>
									
								<?php } else { ?>
									<a class="btn btn-success" id="indicador" name="indicador" value="1"
									href="modalidade-status.php?id=<?=$modalidade['id']?>&indicador=1">
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




