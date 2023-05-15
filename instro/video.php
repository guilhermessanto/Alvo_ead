<?php

use Alvo\CtrAcesso;
use Alvo\Curso;
use Alvo\Utilitarios;
use Alvo\Video;

 require_once "../inc/cabecalho-admin.php";

 $OBJctrAcesso = new CtrAcesso;
$OBJctrAcesso->verificaAcessoInstr();

 $cursoId = $_GET['cursoId'] ?? null;

 $curso =  new Curso;
 $curso -> setId($cursoId);
 $umCurso = $curso -> listarUmCurso();
 
 $video = new Video;
 $video ->setCursoId($cursoId);
 $videos = $video -> listarVideo();
/* Utilitarios::dump($videos); */
?>



<div class="row tabelaVideos">
	<article class="col-12 bg-white rounded shadow my-1 py-4">
		
		<h2 class="text-center">
			<?=$umCurso['nomeCurso'] ?>
		</h2>

		<p class="text-center mt-5">
			<a class="btn btn-primary" href="cadastrar-video.php?cursoId=<?=$cursoId?>">
				<i class="bi bi-plus-circle"></i> Inserir video</a>
			<a class="btn btn-secondary ms-5" href="curso.php"><i class="bi bi-pencil">Voltar</i></a>
		</p>
				
		<div class="table-responsive">
		
			<table class="table table-hover">
				<thead class="table-light">
					<tr>
                        <th>nome do video</th>											
                        
						<th class="text-center">Operação</th>
					</tr>
				</thead>

				<tbody>
				<?php foreach($videos as $video){ ?>
					<tr>
                      <td><?=$video['nomeVideo']?></td>
                   
                      <td class="text-center">
							<a class="btn btn-warning" 
							href="atualizar-video.php?cursoId=<?=$cursoId?>&videoId=<?=$video['id']?>">
							<i class="bi bi-pencil"></i> Atualizar
							</a>
							<a class="btn btn-danger" 
							href="excluir-video.php?cursoId=<?=$cursoId?>&videoId=<?=$video['id']?>">
							<i class="bi bi-pencil"></i> Excluir
							</a>
						</td>
					</tr>
					</a>
              <?php }?>
				</tbody>                
			</table>
	</div>
		
	</article>
</div>



<?php 
require_once "../inc/rodape-admin.php";
?>