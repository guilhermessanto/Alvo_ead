<?php
use Alvo\Generico;
use Alvo\Utilitarios;
use Alvo\CtrAcesso;

$pagina = "Favorecido (Consulta)";
require_once "../inc/cabecalho-admin.php";

$OBJctrAcesso = new CtrAcesso;
$OBJctrAcesso->verificaAcessoAdmin();

$OBJgenerico = new Generico;
$listaDeGenerico = $OBJgenerico->listarGenerico();

$listaTipoFavorecido = Utilitarios::tipoFavorecido();

?>

<div class="row position-relative">
	<article class="col-12 bg-white rounded shadow py-4 ">
		
		
		<h2 class="text-center ">
		Favorecido <span class="badge bg-dark"><?=count($listaDeGenerico)?></span>
		</h2>	

		<form autocomplete="off" class="ms-5 col-2 d-flex  position-absolute top-25 end-0 translate-middle" action="generico-pesquisa.php" method="GET">
			
			<input name="buscaFavorecido" class="form-control me-2 col-2" type="search" placeholder="Pesquise aqui" aria-label="Pesquise aqui">
			<button class="btn btn-outline-secondary my-2 my-sm-0 col-3" type="submit">OK</button>
			
      	</form>

		<p class="text-center mt-5">
			<a class="btn btn-primary" href="generico-insere.php">
			<i class="bi bi-plus-circle"></i>	
			Inserir novo Favorecido</a>
		</p>
				
		<div class="table-responsive">
		
			<table class="table table-hover">
				<thead class="table-light">
					<tr>
					    <th>Tipo Favorecido</th>	
                        <th>CNPJ/CPF</th>
						<th>Nome</th>
						<th>E-mail</th>
						<th class="text-center">Operações</th>
					</tr>
				</thead>

				<tbody>
					<?php
						$i = 0;
						foreach($listaDeGenerico as $generico) {
						$i ++;
						if ( $i>10 ) { break; }
						?>
					<tr>
						<td>
							<?=$generico['tipoFavorecido']?> - <?=$listaTipoFavorecido[$generico['tipoFavorecido']]?>
						</td>
						<td><?=Utilitarios::formataCnpjcpf($generico['cnpjcpf'])?></td>
						<td><?=$generico['nome']?></td>
                        <td><?=$generico['email']?></td>
						
                        <td class="text-center">
							<a class="btn btn-warning" 
							href="generico-atualiza.php?id=<?=$generico['id']?>">
							<i class="bi bi-pencil"></i> Atualizar
							</a>
						
						<?php if ( !($generico['ctrAcesso_id']) ) { ?>
							<a class="btn btn-danger excluir" 
							href="generico-exclui.php?id=<?=$generico['id']?>">
							<i class="bi bi-trash"></i> Excluir
							</a>
							<a class="btn btn-secondary" 
							href="generico-habilita.php?id=<?=$generico['id']?>">
							<i class="bi bi-door-open"></i> Habilitar
							</a>
						<?php } else { ?>
							<a class="btn btn-secondary" 
							href="generico-ctracesso.php?id=<?=$generico['id']?>">
							<i class="bi bi-door-open"></i> Ctr Acesso
							</a>
						<?php }	?>
						</td>
					</tr>
					<?php }	?>
				</tbody>                
			</table>
			<?php if ($i > 10 ) { ?>
               <p class="my-2 alert alert-warning text-center">Refine Sua Busca ..</p>
            <?php } ?>
			
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