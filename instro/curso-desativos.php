<?php

use Alvo\CtrAcesso;
use Alvo\Curso;
use Alvo\Modalidade;
use Alvo\Utilitarios;

 require_once "../inc/cabecalho-admin.php";

 $OBJctrAcesso = new CtrAcesso;
$OBJctrAcesso->verificaAcessoInstr();

$curso = new Curso;
$modalidade = new Modalidade;
$listarModalidade = $modalidade-> listarModalidade();

$listarCursos = $curso->cursosDesativos();
?>


<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">
		
		<h2 class="text-center">
		Cursos desativados<span class="badge bg-dark"><!-- count --></span>
		</h2>

		<p class="text-center mt-5">
			<a class="btn btn-success" href="curso.php">
			<i class="bi bi-plus-circle"></i>	
			Cursos Ativos</a>
			<a class="btn btn-danger" href="curso-desativos.php">
			<i class="bi bi-plus-circle"></i>	
			Cursos desativados</a>
		</p>
				
		<div class="table-responsive">
		
			<table class="table table-hover">
				<thead class="table-light">
					<tr>
                        <th>nome do curso</th>											
                        <th>categoria</th>
						<th class="text-center">Operações</th>
					</tr>
				</thead>

				<tbody>
				<?php foreach($listarCursos as $curso){ ?>
					<tr>
                        <td><?=$curso['nomeCurso']?></td>
						<td>
						<?php foreach($listarModalidade as $modalidade){ ?> 
								<?php if($curso['modalidade_id'] === $modalidade['id']) echo $modalidade['descModalidade'];?>	
									<?php } ?>
							</td>                      
							<td class="text-center">
							<a class="btn btn-warning" 
							href="curso-atualiza.php?id=<?= $curso['id']?>">
							<i class="bi bi-pencil"></i> Atualizar
							</a>
						
						</td>
					</tr>
                <?php } ?>
				</tbody>                
			</table>
	</div>
		
	</article>
</div>

<br class="mb-5">
			<br class="mb-5">
<?php 
require_once "../inc/rodape-admin.php";
?>

