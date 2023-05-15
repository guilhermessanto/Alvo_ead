<?php
use Alvo\Nivel;
use Alvo\Utilitarios;
use Alvo\CtrAcesso;

$pagina = "Nível (Consulta)";
require_once "../inc/cabecalho-admin.php";

// Utilitarios::dump($_SESSION['nivel_id']);
$OBJctrAcesso = new CtrAcesso;
$OBJctrAcesso->verificaAcessoAdmin();

$OBJnivel = new Nivel;
$listaDeNiveis = $OBJnivel->listarNiveis();

// Utilitarios::dump($listaDeNiveis);
?>


<div class="row">
	<article class="col-12 bg-white rounded shadow py-4">
		
		<h2 class="text-center">
		Nível <span class="badge bg-dark"><?=count($listaDeNiveis)?></span>
		</h2>

		<p class="text-center mt-5">
			<a class="btn btn-primary" href="nivel-insere.php">
			<i class="bi bi-plus-circle"></i>	
			Inserir novo Nível</a>
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
						foreach($listaDeNiveis as $nivel) {
						?>
					<tr>
						<td><?=$nivel['codNivel']?></td>
						<td><?=$nivel['descNivel']?></td>
						<td class="text-center">
							<a class="btn btn-warning" 
							href="nivel-atualiza.php?id=<?=$nivel['id']?>">
							<i class="bi bi-pencil"></i> Atualizar
							</a>
						
							<!-- <a class="btn btn-danger excluir" 
							href="nivel-exclui.php?id=<?=$nivel['id']?>">
							<i class="bi bi-trash"></i> Excluir
							</a> -->

							<?php
								if ( $nivel['indicador'] == 1 ) { ?>
									
									<a class="btn btn-danger" id="indicador" name="indicador" value="0"
									href="nivel-status.php?id=<?=$nivel['id']?>&indicador=0">
										<i class="bi bi-save"></i> Desabilitado</a>
									
								<?php } else { ?>
									<a class="btn btn-success" id="indicador" name="indicador" value="1"
									href="nivel-status.php?id=<?=$nivel['id']?>&indicador=1">
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