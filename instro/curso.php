<?php
$pagina = "Cursos";

use Alvo\CtrAcesso;
use Alvo\Curso;
use Alvo\Instrutor;
use Alvo\Modalidade;
use Alvo\Utilitarios;

 require_once "../inc/cabecalho-admin.php";
 $OBJctrAcesso = new CtrAcesso;
$OBJctrAcesso->verificaAcessoInstr();

 $OBJinstro = new Instrutor;

 $listaDeInstrutores = $OBJinstro -> listarInstrutores();
 foreach($listaDeInstrutores as $instrutor){
	 if($instrutor['ctrAcesso_id'] == $_SESSION['id'] ){
		 $_SESSION['id_tabRel'] = $instrutor['id'];
	 }
 }
 

 $modalidade = new Modalidade;
 $listarModalidade = $modalidade-> listarModalidade();
 $curso = new Curso;
 $curso ->setId($_SESSION['id_tabRel']);

$listarCursos = $curso->cursosAtivos();
?>


<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">
		
		<h2 class="text-center">
		Meus Cursos <span class="badge bg-dark"><!-- count --></span>
		</h2>

		<p class="text-center mt-5">
			<a class="btn btn-primary" href="cadastrar-curso.php">
			<i class="bi bi-plus-circle"></i>	
			Inserir novo Curso</a>
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
							<a class="btn btn-primary" 
							href="video.php?cursoId=<?= $curso['id']?>">
							<i class="bi bi-pencil"></i>Videos
							</a>
						
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

