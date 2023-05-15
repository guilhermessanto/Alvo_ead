<?php

use Alvo\Generico;
use Alvo\Utilitarios;
use Alvo\CtrAcesso;

$pagina = "Favorecido (Pesquisa)";
require_once "../inc/cabecalho-admin.php";

$OBJctrAcesso = new CtrAcesso;
$OBJctrAcesso->verificaAcessoAdmin();

$OBJgenerico = new Generico;
$OBJgenerico->setStrConsulta($_GET['buscaFavorecido']);
$resultados = $OBJgenerico->buscaFavorecido();

$listaTipoFavorecido = Utilitarios::tipoFavorecido();
// Utilitarios::dump($resultados);
?>


<div class="row bg-white rounded shadow py-4">
    <h2 class="col-12 fw-light">
        Você procurou por <span class="badge bg-dark"><?=$OBJgenerico->getStrConsulta()?></span> e
        obteve <span class="badge bg-info"><?=count($resultados)?></span> resultado(s).
    </h2>
    <div><label for=""></label></div>
    <div><label for=""></label></div>
    
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
						foreach($resultados as $generico) {
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



</div>        



<?php 
    require_once "../inc/rodape-admin.php";
?>

